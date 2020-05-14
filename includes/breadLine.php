<div class="breadLine">
            <ul class="breadcrumb">
                <li><a href="#">Home</a> <span class="divider">></span></li>
            </ul>
                        
            <ul class="buttons">
                <li>
                    <a href="#" class="link_bcPopupList"><span class="icon-user"></span><span class="text">Find Friends</span></a>

                    <div id="bcPopupList" class="popup">
                        <div class="head clearfix">
                            <div class="arrow"></div>
                            <span class="isw-users"></span>
                            <span class="name">People You May Know</span>
                        </div>
                        <div class="body-fluid users">
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
                            <div class="item clearfix">
                                <div class="image"><a href="#"><img src="img/users/<?php echo $friends['profile_photo']; ?>" width="30" height="35"/></a></div>
                                <div class="info">
                                    <a href="user_profile.php?member_id=<?php echo $friends['user_id']; ?>" class="name"><?php echo $friends['first_name'] . " " . $friends['last_name']; ?></a>                                    
                                </div>
                            </div>
							<?php } }?>
                        </div>
                        <div class="footer">
                            <a href="find_friends.php" class="btn btn-danger">See All</a>
                        </div>
                    </div>                    
                    
                </li>                
                <li>
                    <a href="#" class="link_bcPopupSearch"><span class="icon-search"></span><span class="text">Search</span></a>
                    
                    <div id="bcPopupSearch" class="popup">
                        <div class="head clearfix">
                            <div class="arrow"></div>
                            <span class="isw-zoom"></span>
                            <span class="name">Search</span>
                        </div>
                        <form action="search.php" method="post">
                        <div class="body search">
                            <input type="text" name="searcText" id="searcText" placeholder="Some text for search..."/>
                        </div>
                        <div class="footer">
                            <button class="btn" type="submit" name="btnSubmit" id="btnSubmit">Search</button>
                            <button class="btn btn-danger link_bcPopupSearch" type="button">Close</button>
                            <a href="advance_search.php" class="btn"> Advance Search </a>
                        </div>
                        </form>
                    </div>                
                </li>
            </ul>
        </div>
        