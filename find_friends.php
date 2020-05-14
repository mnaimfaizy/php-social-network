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
				 $strSelectFriends = "
SELECT users.user_id,users.first_name, users.last_name, users.gender, friends.friends_ID, profile_photo FROM users LEFT JOIN friends ON friends.requestedMemberID = users.user_id WHERE user_id <> " . $_SESSION['user_ID']; 

				$strResult = mysqli_query($conn, $strSelectFriends);
				while($friends = mysqli_fetch_assoc($strResult)) {
					$userID = $friends['user_id'];
					$strqueryR = "SELECT * FROM friends";
					$strFriendsAdded = mysqli_query($conn, $strqueryR);
					$strrr = mysqli_fetch_assoc($strFriendsAdded);
					$requestID = $strrr['requestedMemberID'];
					$tomemberID = $strrr['toMemberID'];
					if( $userID == $tomemberID || $userID == $requestID) {
						// Do nothing 
					} else {
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