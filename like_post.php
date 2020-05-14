<?php
	include("includes/connection.php");
	if(isset($_GET['post_id'])) {
		$postID = $_GET['post_id'];
		$member_id = $_GET['member_id'];
		$query = "SELECT * FROM friends WHERE requestedMemberID = $member_id OR toMemberID = $member_id";
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_assoc($result)) {
			$requested_id = $row['requestedMemberID'];
			$MemberID = $row['toMemberID'];
			
			if($requested_id == $member_id) {
				$friend_id = $requested_id;
			} else if($MemberID == $member_id) {
				$friend_id = $MemberID;
			}
		}
		$status = 'True';
		
	echo $strQuery = "INSERT INTO like_post (post_id,member_id,friend_id,status) VALUES ($postID, $member_id, $friend_id, '$status')";
		if(mysqli_query($conn, $strQuery)) {
				header("Location: posts.php?post_id=$_GET[post_id]&member_id=$member_id");
		}
	}
?>