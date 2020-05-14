<?php 	include("includes/connection.php");
		include("includes/CheckStatus.php");
		include("includes/header.php");
?>
<?php include("includes/Navigation.php"); ?>
    <div class="content" style="min-height: 600px;">

<?php include("includes/breadLine.php"); ?>      
  
    <div class="workplace">
        <div class="row-fluid">
        	<?php
				$strFriends = "SELECT * FROM friends WHERE (requestedMemberID = $_SESSION[user_ID] OR toMemberID = $_SESSION[user_ID])";
				$strFriendsQuery = mysqli_query($conn, $strFriends);
				while($strRows = mysqli_fetch_assoc($strFriendsQuery)) {
					$fromId = $strRows['requestedMemberID'];
					$toId = $strRows['toMemberID'];
					if($fromId == $_SESSION['user_ID']) {
						$user_id = $toId;
					} else if($toId == $_SESSION['user_ID']) {
						$user_id = $fromId;
					}
					$user_id;
					
				$strSelectFriends = "SELECT * FROM users WHERE user_ID = $user_id";

				$strResult = mysqli_query($conn, $strSelectFriends);
				while($friends = mysqli_fetch_assoc($strResult)) {
						
			?>
            <div class="span4">                    
                    <div class="wBlock red clearfix">
                        <div class="dSpace" style="width:100px; height:100px;">
                            <img src="img/users/<?php echo $friends['profile_photo']; ?>" width="100" height="100" alt="User Image" title="User Image" />
                        </div>
                        <div class="rSpace">                                                                           
                            <span style="font-family:Baskerville, 'Palatino Linotype', Palatino, 'Century Schoolbook L', 'Times New Roman', serif; font-size: 14px; font-weight:bold; margin-bottom: 10px;"><?php echo $friends['first_name'] . " " . $friends['last_name']; ?></span>
                            <span style="margin-bottom: 10px; font-weight: bold;"><?php echo $friends['gender']; ?></span>
                            <span><a href="user_profile.php?member_id=<?php echo $friends['user_id']; ?>" class="btn">View Profile</a></span>                                                        
                        </div>
                    </div>                                 
                </div>
          <?php } } ?>
        </div>
    </div>

<?php include("includes/chatroom.php"); ?>

<?php include("includes/footer.php"); ?>