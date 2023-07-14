<!-- Latest Messages Area, All the latest messages from friends will come here -->
                <div id="messages" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <?php
					$strQueryMessages = "SELECT * FROM message WHERE to_user_id = " . $_SESSION['user_ID'] . " AND Status = 'Unread'";
					$restult = mysqli_query($conn, $strQueryMessages);
					$count = mysqli_num_rows($restult);
					if($count > 0) {
						if($count == 1) {
				?>
                        <h3 id="myModalLabel"><?php echo " You Have " . $count . " Unread message"; ?></h3>
                    <?php } else if($count > 1) { ?>
                    	<h3 id="myModalLabel"><?php echo "You Have " . $count . " Unread messages"; ?></h3>
					<?php } ?> 
                    <?php } else { ?>
						<h3 id="myModalLabel"><?php echo " You have No Unread message"; ?></h3>
					<?php } ?>
                    </div>
                    <div class="block messages scrollBox">
                    	<div class="scroll" style="height: 270px;">
                <?php
                    $strQuery = "SELECT friends_ID, `requestedMemberID`, `toMemberID` FROM `friends` WHERE (requestedMemberID = $_SESSION[user_ID] OR toMemberID = $_SESSION[user_ID]) AND Status = 'Accepted'";
                    $strResult = mysqli_query($conn, $strQuery);
                    while($friends = mysqli_fetch_assoc($strResult)) {

                        $from_id = $friends['toMemberID'];
                        $to_id = $friends['requestedMemberID'];


                        $firstname = "";
                        $lastname = "";
                        $profilephoto = "";

                        $strMsgQuery = "select * from message where to_user_id=$to_id AND from_user_id=$from_id AND Status='Unread'";
						$msgs = mysqli_query($conn, $strMsgQuery);
						while($m_result = mysqli_fetch_assoc($msgs)){
							$userId = $m_result['from_user_id'];
							$userInfo = "SELECT user_ID, first_name, last_name, profile_photo from users WHERE user_ID=$userId";
							$uers = mysqli_query($conn, $userInfo);
							$userInfo = mysqli_fetch_array($uers);
							$firstname = $userInfo['first_name'];
							$lastname = $userInfo['last_name'];
							$member_id = $userInfo['user_ID'];
							$profilephoto = $userInfo['profile_photo'];

								?>
                        
                        <div class="item clearfix">
                            <div class="image">
                                <a href="messages.php?user_id=<?php echo $member_id; ?>">
                                	<img class="img-polaroid" src="img/users/<?php echo $profilephoto; ?>" width="30" height="35" />
                                </a>
                            </div>
                            <div class="info" style="margin: -10px 0px 0px 5px;">
                            	<a class="name" href="messages.php?user_id=<?php echo $member_id; ?>">
								<?php echo $firstname . " " . $lastname; ?></a>
                                <?PHP
									$unread_msgs = "SELECT * FROM message WHERE 
										(from_user_id = $member_id OR from_user_id = $_SESSION[user_ID]) AND
										(to_user_id = $_SESSION[user_ID] OR to_user_id = $member_id) AND Status = 'Unread'";
									$unread_query = mysqli_query($conn, $unread_msgs);
									if(mysqli_num_rows($unread_query)) {
									while($res = mysqli_fetch_assoc($unread_query)) {
									$messageText =  $res['message_text'];
									$message_date = $res['message_date'];
								?><p> <?php echo $messageText; ?> &nbsp; 
                                <span style="float:right; margin: 0px 20px 0px 5px; color:#636363;">
								<?php echo date("m-d",$message_date); ?></span>
                                </p>
                                <?php } } ?>
                            </div>
                        </div>
                        <?php } } ?>
                   
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="messages.php" class="btn btn-warning">See All</a> 
                    </div>
                </div>