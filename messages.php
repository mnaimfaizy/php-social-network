<?php 	include("includes/connection.php");
		include("includes/CheckStatus.php");
		include("includes/header.php");
?>

<link rel="stylesheet" type="text/css" href="css/style.css">
<script type='text/javascript' src='js/chat.js'></script>
<?php include("includes/Navigation.php"); ?>
    <div class="content" style="min-height: 600px;">

<?php include("includes/breadLine.php"); ?>      
  
    <div class="workplace">
        <div class="row-fluid">
        	<div class="span4">
                    <div class="head clearfix">
                        <div class="isw-list"></div>
                        <h1>Friends</h1>    
                    </div>
                    <div class="block messages scrollBox">
                        <div class="scroll" id="scrolls" style="height: 280px;">
                        	
                         <?php
                            	$strQuery = "SELECT friends_ID, `requestedMemberID`, `toMemberID` FROM `friends` WHERE (requestedMemberID = $_SESSION[user_ID] OR toMemberID = $_SESSION[user_ID]) AND Status = 'Accepted'";
								$strResult = mysqli_query($conn, $strQuery);
								while($friends = mysqli_fetch_assoc($strResult)) {
									
									$from_id = $friends['requestedMemberID'];
									$to_id = $friends['toMemberID'];
									
									$userID = $from_id;
									
									if($from_id == $_SESSION['user_ID']){
										$userID = $to_id;
									}
									
									$firstname = "";
									$lastname = "";
									$profilephoto = "";
									$member_id = "";
									
									$m_info = mysqli_query($conn, "SELECT * from users where user_ID = $userID");
									$m_info = mysqli_fetch_assoc($m_info);
									$firstname = $m_info['first_name'];
									$lastname = $m_info['last_name'];
									$member_id = $m_info['user_ID'];
									$profilephoto = $m_info['profile_photo'];
									
                            ?>
                        <div class="item clearfix">
                            <div class="image"><a href="img/users/<?php echo $profilephoto; ?>">
                            <img class="img-polaroid" src="img/users/<?php echo $profilephoto; ?>" width="25" height="25"></a></div>
                            <div class="info">
                                <a class="name" href="messages.php?user_id=<?php echo $member_id; ?>">
								<?php echo $firstname . " " . $lastname; ?></a>
                                <p><?PHP
									$unread_msgs = "SELECT 1 FROM message WHERE from_user_id = $member_id AND to_user_id = $_SESSION[user_ID] AND status='Unread'";
									$unread_query = mysqli_query($conn, $unread_msgs);
									$total = mysqli_num_rows($unread_query);
									if( $total > 0 ){
										echo "<span style=\"color:#FF0004; font-weight:bold\">( $total ) Messages</span>";
									} else {
										echo "No New Messages";	
									}
								?></p>
                            </div>
                        </div>
						<?php } ?>
                        </div>                      
                    </div>
                </div>
            
            <?php if(isset($_GET['user_id'])) { ?>
            
            <div class="span8">
            	<div id="page-wrap">
    
                    <h2>Messages</h2>
                    
                    <p id="name-area">Your Chating With: <span> 
                    <?php if(isset($_GET['user_id'])) {
							$quer = "SELECT first_name, last_name FROM users WHERE user_ID=$_GET[user_id] LIMIT 1";
							$rest = mysqli_query($conn, $quer);
							while($name = mysqli_fetch_assoc($rest)) {
								echo $name['first_name'] . " " . $name['last_name'];
							}
					}	
					
					?></span></p>
                    
                    <div id="chat-wrap"><div id="chat-area">
                    	<?PHP
						if( isset($_GET['user_id']) ){
						
						mysqli_query($conn, "UPDATE message SET Status = 'Read' WHERE from_user_id = $_GET[user_id] AND to_user_id = $_SESSION[user_ID]");
						
						$strMsgQuery = "SELECT * FROM message WHERE 
										(from_user_id = $_GET[user_id] AND to_user_id = $_SESSION[user_ID]) OR
										(from_user_id = $_SESSION[user_ID] AND to_user_id = $_GET[user_id])";
						$msgs = mysqli_query($conn, $strMsgQuery);
						while($m_result = mysqli_fetch_assoc($msgs)){
							
							$from_id = $m_result['from_user_id'];
							
							$Iid = $m_result['from_user_id'];
							
							$userInfo = mysqli_query($conn, "SELECT first_name, last_name, profile_photo from users WHERE user_ID=$Iid") or die(mysqli_error());
							$userInfo = mysqli_fetch_array($userInfo);
							$first_name = $userInfo['first_name'];
							$last_name = $userInfo['last_name'];
							$profilePhoto = $userInfo['profile_photo'];
							$msg_Date = $m_result['message_date'];
							$msg_TEXT = $m_result['message_text'];
							$messageDate = '';
					?>
                    	<p class="<?PHP echo ( $from_id == $_SESSION['user_ID'] ) ? "from_msg" : "to_msg"; ?>">
									<?php /*$db_Date = @$msg_Date;
										  $current_Date = time();
										  $timeOfMessage = ($current_Date - $db_Date);
										  if($timeOfMessage == 0) {
											  $messageDate = " just Now";
										  } else if($timeOfMessage <= 60) {
											$messageDate .= $timeOfMessage . " Seconds Ago";  
										  } else if($timeOfMessage > 60 && $timeOfMessage < 3600) {
												$timeOfMessageInMinutes = $timeOfMessage / 60;
												$timeOfMessageInMinutes = floor($timeOfMessageInMinutes);
												if($timeOfMessageInMinutes == 1) {  
													$messageDate .= $timeOfMessageInMinutes . " Minute Ago";
												} else {
													$messageDate .= $timeOfMessageInMinutes . " Minutes Ago";
												}
										  } else if($timeOfMessage >= 3600 && $timeOfMessage < 86400 ) {
											  	$timeOfMessageInHours = $timeOfMessage / (60 * 60);
												$timeOfMessageInHours = floor($timeOfMessageInHours);
												if($timeOfMessageInHours == 1) {  
													$messageDate .= $timeOfMessageInHours . " Hour Ago";
												} else {
													$messageDate .= $timeOfMessageInHours . " Hours Ago";
												}
										  } else if($timeOfMessage >= 86400) {
											  $timeOfMessageInDays = $timeOfMessage / ((60 * 60) * 24);
											  $timeOfMessageInDays = floor($timeOfMessageInDays);
												if($timeOfMessageInDays == 1) {  
													$messageDate .= " Yesterday";
												} else {
													$messageDate .= date("M-d",$db_Date);
												}
										  }
										  echo $messageDate;*/
									 ?>
                         <?php echo $msg_TEXT; ?></p>
                    <?php }} ?>
                    </div></div>
                    
                    <form method="post" id="msgForm" name="msgForm" >
                        <button type="submit" class="btn" name="btnSendMessage" id="btnSendMessage">Send message</button>
                        <textarea name="userMessage" id="userMessage" maxlength = '100' ></textarea>
                        <input type="hidden" name="to_user_id_hid" id="to_user_id_hid" value="<?php echo $_GET['user_id']; ?>">
                        <input type="hidden" name="fullName" id="fullName" value="<?php echo $first_name . " " . $last_name; ?>">
                    </form>
                
                </div>
            </div>
            <?php } ?>
                        
        </div> <!-- row-fluid -->
    </div> <!-- workplace -->
    </div> <!-- content -->

<?php include("includes/chatroom.php"); ?>

<?php include("includes/footer.php"); ?>