
    <div class="chatroom">
        <div class="span3 position">                 
                    <div class="header clearfix">
                        <div class="isw-favorite"></div>
                        <p class="logo">Chat Room</p>
                    </div>
                    <div class="block messages scrollBox">
                             
                        <div class="scroll" style="height: 500px; margin-top: 40px;">
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
									$lastOnline = $m_info['LastOnline'];
									$now = time() - 60;
                            ?>
                            <div class="item clearfix">
                                <div class="image"><a href="img/users/<?php echo $profilephoto; ?>">
                                <img src="img/users/<?php echo $profilephoto; ?>" class="img-polaroid" width="25" height="25"/></a></div>
                                <div class="info">
                                    <a class="name" href="messages.php?user_id=<?php echo $member_id; ?>">
									<?php echo $firstname . " " . $lastname; ?></a>
                                    <?php 
									
									if( $lastOnline >= $now ){
										echo '<span class="online"> online</span>';
									} else {
										echo '<span class="offline"> offline</span>';	
									}
									 ?>
                                </div>
                            </div>
                            <?php } ?>
                           
                     </div> 
                                                        
    </div>   
    	</div>
    </div>