<?php
session_start();
// 1. write the http protocol
$full_url = "http://";

// 2. check if your server use HTTPS
if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on") {
    $full_url = "https://";
}

$full_url .= $_SERVER["HTTP_HOST"];
	include("includes/connection.php");
	if(isset($_GET['post_id'])) {
		$postID = $_GET['post_id'];
		$member_id = $_GET['member_id'];
        $friend_id = $_SESSION['user_ID'];
		$status = 'True';

        $check_liked_post_sql = "select count(*) as total from like_post where post_id=$postID and friend_id=$friend_id";
        $query = mysqli_query($conn, $check_liked_post_sql);
        $result = mysqli_fetch_assoc($query);

        if($result['total'] > 0) {
            echo '<script>window.location="'.$full_url.'/posts.php?post_id='. $_GET["post_id"].'&member_id='. $member_id.'&msg=true"</script>';
        } else {
            $strQuery = "INSERT INTO like_post (post_id,member_id,friend_id,status) VALUES ($postID, $member_id, $friend_id, '$status')";
            if(mysqli_query($conn, $strQuery)) {
                echo '<script>window.location="'. $full_url .'/posts.php?post_id='. $_GET["post_id"]. '&member_id='.$member_id.'&msg=false"</script>';
            }
        }
	}
