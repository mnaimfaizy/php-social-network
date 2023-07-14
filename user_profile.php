<?php
include("includes/CheckStatus.php");
include("includes/connection.php");
if($_SERVER['REQUEST_METHOD'] == "POST"){

	if($_POST['btnFriend'] == "Send Friend Request"){
		$requestDate = time();
		echo $query = "INSERT INTO friends (requestedMemberID, toMemberID,RequestedDate, Status)
				  VALUES ($_SESSION[user_ID], $_GET[member_id], $requestDate, 'Pending')";
		if(mysqli_query($conn, $query)){
            echo '<script>window.location ="'. $full_url .'/user_profile.php?member_id='. $_GET["member_id"]. '"'.'</script>';
		}
	}else if ($_POST['btnFriend'] == "Accept Friend Request"){
		//Accept Friend Request
		
		$query = "UPDATE friends SET Status = 'Accepted' WHERE requestedMemberID=$_GET[member_id] AND toMemberID=$_SESSION[user_ID]";
		if(mysqli_query($conn, $query)){
            echo '<script>window.location ="'. $full_url .'/user_profile.php?member_id='. $_GET["member_id"]. '"'.'</script>';
		}
		
	}else if($_POST['btnFriend'] == "Reject Friend Request"){
		// Reject
		$query = "UPDATE friends SET Status = 'Rejected' WHERE requestedMemberID=$_GET[member_id] AND toMemberID=$_SESSION[user_ID]";
		if(mysqli_query($conn, $query)){
            echo '<script>window.location ="'. $full_url .'/user_profile.php?member_id='. $_GET["member_id"]. '"'.'</script>';
		}
	}
	
}
include("includes/header.php");
?>
<?php include("includes/Navigation.php"); ?>
    <div class="content">

<?php 
include("includes/breadLine.php"); 
	if(isset($_GET['member_id'])) {
		$strQuery = "SELECT * FROM users WHERE user_ID = " . $_GET['member_id'];	
	} else {
		$strQuery = "SELECT * FROM users WHERE user_ID = " . $_SESSION['user_ID'];
	}
	$result = mysqli_query($conn, $strQuery);
	$rows = mysqli_fetch_assoc($result);
?>      
  
    <div class="workplace">
        
     <div class="row-fluid block-fluid" style="height: 280px;">
     <div class="banner">
     	<a class="fancybox" rel="group" href="img/banner.jpg">
        <img src="img/banner.jpg" width="500px" height="120px" /></a>
     </div>
     
     <div class="left">
    <div class="image">
    <a class="fancybox" rel="group" href="img/users/<?php echo $rows['profile_photo']; ?>">
    <img class="img-polaroid" src="img/users/<?php echo $rows['profile_photo']; ?>" width="100" height="120">
    </a>
    </div>
    <ul class="control" style="list-style: none; margin-left: 0px; margin-top: 10px;">
    <li style="margin-bottom: 5px;">
    <span class="icon-user"></span>
    <span><?php echo $rows['first_name'] . " " . $rows['last_name']; ?></span>
    </li>
    <li>
    <span class="isb-picture"></span>
    <a href="photos.php">Photo Albums</a>
    </li>
    <form action="" method="post">
    <?PHP
		if(isset($_GET['member_id'])) {
		  	$query = "SELECT Status from friends WHERE requestedMemberID = $_SESSION[user_ID] AND toMemberID = $_GET[member_id]";
			$result = mysqli_query($conn, $query);
			
			if($result && mysqli_num_rows($result) > 0){
				
				$fetch = mysqli_fetch_assoc($result);
				$status = $fetch['Status'];
				
				if($status == "Pending"){ ?>
                <li>
                <a href="#">Request Pending...</a>
                </li>
         
		 <?php
				}else{
					
				}
		  ?>
    	<?PHP }else{ 
		  		
				$query2 = "SELECT Status FROM friends WHERE requestedMemberID=$_GET[member_id] AND toMemberID=$_SESSION[user_ID]";
				$result2 = mysqli_query($conn, $query2);
				
				if( $result2 && mysqli_num_rows($result2) > 0){
				
					$fetch2 = mysqli_fetch_assoc($result2);
					$status2 = $fetch2['Status'];
					
					if($status2 == "Pending"){
			?>
         
		<li style="margin: 10px 20px;">
            <input type="submit" name="btnFriend" id="btnFriend" class="btn btn-mini" value="Accept Friend Request">
        </li>
        <li style="margin: 10px 20px;">
            <input type="submit" name="btnFriend" id="btnFriend" class="btn btn-mini" value="Reject Friend Request">
        </li>

		<?PHP
				}
				}else{
		  ?>
        <li style="margin: 10px 20px;">
            <input type="submit" name="btnFriend" id="btnFriend" class="btn btn-big" value="Send Friend Request">
        </li>
    	<?PHP }}} else { ?>
			<li>
    <span class=" isb-edit"></span>
    <a href="edit_profile.php">Edit Profile</a>
    </li>
		<?php } ?>
    </ul></form>
    </div>
    </div> 
       
    <div class="dr"><span></span></div>
       
    <div class="row-fluid">
        <div class="span6">
        <div class="info">
        <div class="head clearfix">
                <div class="isw-text_document"></div>
                <h1>Information</h1>
            </div>
        <ul class="rows">
        <li>
        <div class="title">First Name:</div>
        <div class="text"><?php echo $rows['first_name']; ?></div>
        </li>
        <li>
        <div class="title">Last Name:</div>
        <div class="text"><?php echo $rows['last_name']; ?></div>
        </li>
        <li>
        <div class="title">Email:</div>
        <div class="text"><?php echo $rows['email']; ?></div>
        </li>
        <li>
        <div class="title">Phone:</div>
        <div class="text">
			<?php if($rows['phone'] === '') {
					echo 'No Phone number';
			} else {
			echo $rows['phone']; } ?></div>
        </li>
        <li>
        <div class="title">Date of Birth:</div>
        <div class="text"><?php echo $rows['dob']; ?></div>
        </li>
        <li>
        <div class="title">Gender:</div>
        <div class="text"><?php echo $rows['gender']; ?></div>
        </li>
        </ul>
        </div>
        </div>
        
        <div class="span6">
            <div class="head clearfix">
                <div class="isw-favorite"></div>
                <h1>Recent activity</h1>
            </div>
        <div class="block-fluid scrollBox withList">
        <div class="scroll" style="height: 200px;">
                <ul class="list">
                   <?php 
				   		if(isset($_GET['member_id'])) {
							$strQuery = "SELECT * FROM posts WHERE member_id = " . $_GET['member_id'] . " ORDER BY post_time DESC LIMIT 10";	
						} else {
				   		$strQuery = "SELECT * FROM posts WHERE member_id = " . $_SESSION['user_ID'] . " ORDER BY post_time DESC LIMIT 10";
						}
						$strResult = mysqli_query($conn, $strQuery);
						while($strRows = mysqli_fetch_assoc($strResult)) {
				   ?> 
                    <li style="display: list-item;">
                    <span class="date">
                    <b><?php $postTime = $strRows['post_time'];
						$date = date("M-d", $postTime);
						echo $date;
					?></b></span>
                    <?php echo $strRows['post_content']; ?>
                    </li>
                    <?php } ?>
                </ul>
        </div>
        </div>
        </div>
    </div>
    <div class="dr"><span></span></div>
    
        <div class="row-fluid">
        <div class="span8">
                    <div class="head clearfix">
                        <div class="isw-picture"></div>
                        <h1>User images</h1>                       
                    </div>
                    <div class="block gallery clearfix">
                        <?php
                            $strUsersImages = '';
							if(isset($_GET['member_id'])) {
								@$strUsersImages    = "SELECT * FROM files WHERE member_id = " . $_GET['member_id'];
							} else {
								@$strUsersImages = "SELECT * FROM files WHERE member_id = " . $_SESSION['user_ID'];
							}
                            @$strResult = mysqli_query($conn, @$strUsersImages);
							if($strResult) {
							while($strImage = mysqli_fetch_assoc($strResult)) {
						?>
                        <a class="fancybox" rel="group" href="img/<?php echo $strImage["file_name"]; ?>"><img src="img/<?php echo $strImage["file_name"]; ?>" class="img-polaroid" width="100" height="75"/></a>
                        <?php }
                            } ?>
                    </div>
                </div>
                
                <div class="span4">
                    <div class="head clearfix">
                        <div class="isw-users"></div>
                        <h1>Friends</h1>
                    </div>
                    
                    <div class="block-fluid users">                                                
						<div class="scroll" style="height: 500px;">
                            <?php 
							    $strFriends ="select u.first_name, u.last_name, u.profile_photo, f.requestedMemberID, f.toMemberID from friends f
                                                inner join users u ON u.user_ID = f.toMemberID
                                                where f.requestedMemberID=" . $_SESSION['user_ID'] . "
                                                and f.Status='Accepted'";
							$strFriendsResult = mysqli_query($conn, $strFriends);
							while($strRows = mysqli_fetch_assoc($strFriendsResult)) {
							?>
                            <div class="item clearfix">
                                <div class="image"><a href="#"><img src="img/users/<?php echo $strRows['profile_photo']; ?>" width="32"/></a></div>
                                <div class="info">
                                    <a href="#" class="name"><?php echo $strRows['first_name'] . " " . $strRows['last_name']; ?></a>                                
                                    <div class="controls">                    
                                        <a href="#" class="icon-pencil"></a> 
                                        <a href="#" class="icon-envelope"></a>                                         
                                        <a href="#" class="icon-remove"></a>
                                    </div>                                      
                                </div>                                
                            </div>                        
							<?php } ?>
                    </div>
                    </div>
                    </div>
        </div>
        <div class="dr"><span></span></div>
    </div>
<?php include("includes/chatroom.php"); ?>

<?php include("includes/footer.php"); ?>

