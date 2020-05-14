<!-- Latest Notifications Area, All the latest Things which has happen by or with your frineds are shown here -->
                <div id="friendRequest" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">You Have
						<?php 
							$strQuery = "SELECT * FROM friends WHERE toMemberID = " . $_SESSION['user_ID'] . " AND status = 'Pending'";
					$strResult = mysqli_query($conn, $strQuery);
					$requests = mysqli_num_rows($strResult);
					if($requests > 0) {
						?>
                        <?php  echo $requests; 
					} else { echo "NO"; }
						?>
                    
                    Friend Request</h3>
                    </div>
                    <div class="block messages scrollBox">
                    	<div class="scroll" style="height: 270px;">
                        <?php
					
							$SelectFriendRequest = "SELECT users.user_ID, users.first_name, users.last_name, users.profile_photo, friends.requestedMemberID, friends.RequestedDate FROM `friends` 
LEFT JOIN users ON users.user_ID = friends.requestedMemberID WHERE toMemberID = " . $_SESSION['user_ID'] . " AND status = 'Pending'";
							$strResult = mysqli_query($conn, $SelectFriendRequest);
							while($strFriends = mysqli_fetch_assoc($strResult)) {
						?>
                        <div class="item clearfix">
                            <div class="image">
                                <a href="#">
                                	<img class="img-polaroid" src="img/users/<?php echo $strFriends['profile_photo']; ?>" width="30" height="35" />
                                </a>
                            </div>
                            <div class="info" style="margin: 0px 0px 0px 5px;">
                            	<a class="name" href="#"><?php echo $strFriends['first_name'] . " " . $strFriends['last_name']; ?></a>
                                <p>Send Request to you. <span style="font-weight:bold;">
                                <a href="user_profile.php?member_id=<?php echo $strFriends['user_ID']; ?>">
                                View Profile...</a></span></p>
                                <span><?php $requestDate = $strFriends['RequestedDate'];
											$date = date("Y-M-d", $requestDate);
											echo $date; ?></span>
                            </div>
                        </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>