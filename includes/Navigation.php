<div style="position: fixed; top: 0px; left: 0px;">
<div class="menu">                
        
        <div class="breadLine">            
            <div class="arrow"></div>
            <div class="adminControl active">
                Hi, <span style="font-weight:bold;"><?php echo $_SESSION['FullName']; ?></span>
            </div>
        </div>
        
        <div class="admin">
            <div class="image">
                <a class="fancybox" href="img/users/<?php echo @$_SESSION['profile_photo']; ?>" rel="group">
                <img src="img/users/<?php echo @$_SESSION['profile_photo']; ?>" class="img-polaroid" width="50" height="70"/>  
                </a>              
            </div>
            <ul class="control">                
                <li>
                <?php
					$strQueryMessages = "SELECT * FROM message WHERE to_user_id = " . $_SESSION['user_ID'] . " AND Status = 'Unread'";
					$restult = mysqli_query($conn, $strQueryMessages);
					$count = mysqli_num_rows($restult);
					if($count > 0) {
				?>
                <span class="label label-important"><?php echo $count; ?></span>
                <?php } else { } ?>
                <span class="icon-comment"></span> 
                <a href="#messages" role="button" data-toggle="modal">Messages</a> 
                </li>
                <li> 
                <span class="icon-globe"></span>
                <a href="#notifications" role="button" data-toggle="modal">Notifications</a>
                </li>
                <li> 
                <?php 
					$strQuery = "SELECT * FROM friends WHERE toMemberID = " . $_SESSION['user_ID'] . " AND status = 'Pending'";
					$strResult = mysqli_query($conn, $strQuery);
					$requests = mysqli_num_rows($strResult);
					if($requests > 0) {
				?>
                <span class="label label-important"><?php echo $requests; ?></span>
                <?php } else { } ?>
                <span class="icon-user"></span><a href="#friendRequest" role="button" data-toggle="modal">Friend Request</a>
                
                </li>
                <li><span class="icon-share-alt"></span> <a href="logout.php">Logout</a></li>
            </ul>
            <div class="info">
                <span>Welcom back! Your last visit: 
                <?php echo $_SESSION['lastOnline']; ?></span>
            </div>
        </div>
        
        <ul class="navigation">            
            <li>
                <a href="index.php">
                    <span class="isw-grid"></span><span class="text">Latest Posts</span>
                </a>
            </li>
            
            <li>
                <a href="user_profile.php">
                    <span class="isw-calendar"></span><span class="text">My Profile</span>
                </a>
            </li>
            
            <li>
                <a href="index.html">
                    <span class="isw-calendar"></span><span class="text">Events</span>
                </a>
            </li>
                     
            <li>
                <a href="messages.php">
                    <span class="isw-chat"></span><span class="text">Messages</span>  
                </a>
            </li> 
            <li>
                <a href="friends.php">
                    <span class="isw-users"></span><span class="text">Friends</span>
                </a>
            </li>                                      
            <li>
                <a href="#">
                    <span class="isw-text_document"></span><span class="text">Pages</span>
                </a>
            </li>   
            <li>
                <a href="#">
                    <span class="isw-documents"></span><span class="text">Groups</span>
                </a>                
            </li>                          
        </ul>
        
        <div class="dr"><span></span></div>
        
    </div>
    </div>