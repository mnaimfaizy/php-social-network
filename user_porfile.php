<?php 
include("includes/CheckStatus.php");
include("includes/connection.php");
include("includes/header.php"); ?>
<?php include("includes/Navigation.php"); ?>
    <div class="content">

<?php 
include("includes/breadLine.php"); 
	$strQuery = "SELECT * FROM users WHERE user_ID = " . $_SESSION['user_ID'];
	$result = mysqli_query($conn, $strQuery);
	$rows = mysqli_fetch_assoc($result);
?>      
  
    <div class="workplace">
        
     <div class="row-fluid block-fluid" style="height: 250px;">
     <div class="banner">
     	<a class="fancybox" rel="group" href="img/banner.jpg">
        <img src="img/banner.jpg" width="500px" height="100px" /></a>
     </div>
     
     <div class="left">
    <div class="image">
    <a class="fancybox" rel="group" href="img/users/<?php echo @$_SESSION['profile_photo']; ?>">
    <img class="img-polaroid" src="img/users/<?php echo @$_SESSION['profile_photo']; ?>" width="100" height="120">
    </a>
    </div>
    <ul class="control" style="list-style: none; margin-left: 0px; margin-top: 10px;">
    <li style="margin-bottom: 5px;">
    <span class="icon-user"></span>
    <span><?php echo $rows['first_name'] . " " . $rows['last_name']; ?></span>
    </li>
    <li>
    <span class="icon-pencil"></span>
    <a href="edit_profile.php">Edit Profile</a>
    </li>
    </ul>
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
        <div class="scroll mCustomScrollbar _mCS_1" style="height: 200px;">
        <div id="mCSB_1" class="mCustomScrollBox" style="position:relative; height:100%; overflow:hidden; max-width:100%;">
            <div class="mCSB_container mCS_no_scrollbar" style="position:relative; top:0;">
                <ul class="list">
                    <li style="display: list-item;">
                    <span class="date">
                    <b>Nov 7</b>
                    12:45
                    </span>
                    Aqvatarius commented on
                    <a href="#">Some news name</a>
                    </li>
                    <li style="display: list-item;">
                    <span class="date">
                    <b>Nov 7</b>
                    12:45
                    </span>
                    Aqvatarius commented on
                    <a href="#">Some news name</a>
                    </li>
                    <li style="display: list-item;">
                    <span class="date">
                    <b>Nov 7</b>
                    12:45
                    </span>
                    Aqvatarius commented on
                    <a href="#">Some news name</a>
                    </li>
                    <li style="display: list-item;">
                    <span class="date">
                    <b>Nov 7</b>
                    12:45
                    </span>
                    Aqvatarius commented on
                    <a href="#">Some news name</a>
                    </li>
                
                </ul>
            </div>
            <div class="mCSB_scrollTools" style="position: absolute; display: none;">
                <div class="mCSB_draggerContainer" style="position:relative;">
                    <div class="mCSB_dragger ui-draggable" style="position: absolute; top: 0px; height: 68px;">
                        <div class="mCSB_dragger_bar" style="position: relative; line-height: 68px;"></div>
                    </div>
                <div class="mCSB_draggerRail"></div>
                </div>
            </div>
        </div>
        </div>
            <div class="footer">
            <button class="btn btn-small more" type="button">show more...</button>
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
                        
                        <a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_mini.jpg" class="img-polaroid"/></a>
                        <a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_mini.jpg" class="img-polaroid"/></a>
                        <a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_mini.jpg" class="img-polaroid"/></a>
                        <a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_mini.jpg" class="img-polaroid"/></a>
                        <a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_mini.jpg" class="img-polaroid"/></a>
                        <a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_mini.jpg" class="img-polaroid"/></a>
                        <a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_mini.jpg" class="img-polaroid"/></a>
                        <a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_mini.jpg" class="img-polaroid"/></a>
                        <a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_mini.jpg" class="img-polaroid"/></a>
                        <a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_mini.jpg" class="img-polaroid"/></a>                        
                        
                    </div>
                </div>
                
                <div class="span4">
                    <div class="head clearfix">
                        <div class="isw-users"></div>
                        <h1>Friends</h1>
                    </div>
                    
                    <div class="block-fluid users">                                                
						<div class="scroll" style="height: 500px;">
                            <div class="item clearfix">
                                <div class="image"><a href="#"><img src="img/users/olga_s.jpg" width="32"/></a></div>
                                <div class="info">
                                    <a href="#" class="name">Olga</a>                                
                                    <div class="controls">                    
                                        <a href="#" class="icon-pencil"></a> 
                                        <a href="#" class="icon-envelope"></a>                                         
                                        <a href="#" class="icon-remove"></a>
                                    </div>                                      
                                </div>                                
                            </div>                        

                            <div class="item clearfix">
                                <div class="image"><a href="#"><img src="img/users/alexey_s.jpg" width="32"/></a></div>
                                <div class="info">
                                    <a href="#" class="name">Alexey</a>  
                                    <div class="controls">                    
                                        <a href="#" class="icon-pencil"></a> 
                                        <a href="#" class="icon-envelope"></a>                                         
                                        <a href="#" class="icon-remove"></a>
                                    </div>                                                                
                                </div>
                            </div>
                            
                            <div class="item clearfix">
                                <div class="image"><a href="#"><img src="img/users/alexey_s.jpg" width="32"/></a></div>
                                <div class="info">
                                    <a href="#" class="name">Alexey</a>  
                                    <div class="controls">                    
                                        <a href="#" class="icon-pencil"></a> 
                                        <a href="#" class="icon-envelope"></a>                                         
                                        <a href="#" class="icon-remove"></a>
                                    </div>                                                                
                                </div>
                            </div>
                            
                            
                            <div class="item clearfix">
                                <div class="image"><a href="#"><img src="img/users/alexey_s.jpg" width="32"/></a></div>
                                <div class="info">
                                    <a href="#" class="name">Alexey</a>  
                                    <div class="controls">                    
                                        <a href="#" class="icon-pencil"></a> 
                                        <a href="#" class="icon-envelope"></a>                                         
                                        <a href="#" class="icon-remove"></a>
                                    </div>                                                                
                                </div>
                            </div>
                            
                            <div class="item clearfix">
                                <div class="image"><a href="#"><img src="img/users/alexey_s.jpg" width="32"/></a></div>
                                <div class="info">
                                    <a href="#" class="name">Alexey</a>  
                                    <div class="controls">                    
                                        <a href="#" class="icon-pencil"></a> 
                                        <a href="#" class="icon-envelope"></a>                                         
                                        <a href="#" class="icon-remove"></a>
                                    </div>                                                                
                                </div>
                            </div>
                            
                            <div class="item clearfix">
                                <div class="image"><a href="#"><img src="img/users/alexey_s.jpg" width="32"/></a></div>
                                <div class="info">
                                    <a href="#" class="name">Alexey</a>  
                                    <div class="controls">                    
                                        <a href="#" class="icon-pencil"></a> 
                                        <a href="#" class="icon-envelope"></a>                                         
                                        <a href="#" class="icon-remove"></a>
                                    </div>                                                                
                                </div>
                            </div>
                            
                            <div class="item clearfix">
                                <div class="image"><a href="#"><img src="img/users/alexey_s.jpg" width="32"/></a></div>
                                <div class="info">
                                    <a href="#" class="name">Alexey</a>  
                                    <div class="controls">                    
                                        <a href="#" class="icon-pencil"></a> 
                                        <a href="#" class="icon-envelope"></a>                                         
                                        <a href="#" class="icon-remove"></a>
                                    </div>                                                                
                                </div>
                            </div>                              
                        
                            <div class="item clearfix">
                                <div class="image"><a href="#"><img src="img/users/dmitry_s.jpg" width="32"/></a></div>
                                <div class="info">
                                    <a href="#" class="name">Dmitry</a>                                    
                                    <div class="controls">                    
                                        <a href="#" class="icon-pencil"></a> 
                                        <a href="#" class="icon-envelope"></a>                                         
                                        <a href="#" class="icon-remove"></a>
                                    </div>                                                                
                                </div>
                            </div>                         

                            <div class="item clearfix">
                                <div class="image"><a href="#"><img src="img/users/helen_s.jpg" width="32"/></a></div>
                                <div class="info">
                                    <a href="#" class="name">Helen</a>                                                                        
                                    <div class="controls">                    
                                        <a href="#" class="icon-pencil"></a> 
                                        <a href="#" class="icon-envelope"></a>                                         
                                        <a href="#" class="icon-remove"></a>
                                    </div>                                                                
                                </div>
                            </div>                                  

                            <div class="item clearfix">
                                <div class="image"><a href="#"><img src="img/users/alexander_s.jpg" width="32"/></a></div>
                                <div class="info">
                                    <a href="#" class="name">Alexander</a>                                                                        
                                    <div class="controls">                    
                                        <a href="#" class="icon-pencil"></a> 
                                        <a href="#" class="icon-envelope"></a>                                         
                                        <a href="#" class="icon-remove"></a>
                                    </div>                                                                
                                </div>
                            </div>                                                          
                        
                    </div>
                    </div>
                    </div>
        </div>
        <div class="dr"><span></span></div>
    </div>
<?php include("includes/chatroom.php"); ?>

<?php include("includes/footer.php"); ?>

