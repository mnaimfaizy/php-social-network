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
				 if(isset($_POST['btnSubmit'])){
			$textToSearch = $_POST['searcText'];
			$strQuery = "SELECT * FROM users WHERE first_name LIKE '%$textToSearch%' OR last_name LIKE '%$textToSearch%'";
			
				if($s_query = mysqli_query($conn, $strQuery)) {
					if(mysqli_num_rows($s_query) > 0) {
				while($s_result = mysqli_fetch_assoc($s_query)){

				$firstname = $s_result['first_name'];
				$lastname = $s_result['last_name'];
				$member_id = $s_result['user_ID'];
				$user_gender = $s_result['gender'];
				$profilephoto = $s_result['profile_photo'];
				}
		}
						
			?>
            <div class="span4">                    
                    <div class="wBlock red clearfix">
                        <div class="dSpace" style="width:100px; height:100px;">
                            <img src="img/users/<?php echo $profilephoto; ?>" width="100" height="100" alt="User Image" title="User Image" />
                        </div>
                        <div class="rSpace">                                                                           
                            <span style="font-family:Baskerville, 'Palatino Linotype', Palatino, 'Century Schoolbook L', 'Times New Roman', serif; font-size: 14px; font-weight:bold; margin-bottom: 10px;"><?php echo $firstname . " " . $lastname; ?></span>
                            <span style="margin-bottom: 10px; font-weight: bold;"><?php echo $user_gender; ?></span>
                            <span><a href="user_profile.php?member_id=<?php echo $member_id; ?>" class="btn">View Profile</a></span>                                                        
                        </div>
                    </div>                                 
                </div>
          <?php 	}
		   		} else {
				echo "Such Record Not Found!";  
		   } ?>
        </div>
    </div>

<?php include("includes/chatroom.php"); ?>

<?php include("includes/footer.php"); ?>