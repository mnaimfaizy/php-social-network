<?php
include("includes/CheckStatus.php"); 
include("includes/connection.php");
include("includes/header.php"); ?>
<?php
	// Here it will check the image and upload it to the database
	if(isset($_POST['changePhoto'])) {
		
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["image"]["name"]);
		$extension = end($temp);
		
		if((($_FILES["image"]["type"] == "image/gif")
		|| ($_FILES["image"]["type"] == "image/jpeg")
		|| ($_FILES["image"]["type"] == "image/jpg")
		|| ($_FILES["image"]["type"] == "image/pjpeg")
		|| ($_FILES["image"]["type"] == "image/x-png")
		|| ($_FILES["image"]["type"] == "image/png"))
		&& ($_FILES["image"]["size"] < 2000000)
		&& in_array($extension, $allowedExts)) {
			if($_FILES["image"]["error"] > 0) {
				$msg = "Error: " . $_FILES["image"]["error"] . "<br />";
			} else {
				$file_name = $_FILES["image"]["name"];
				$file_type = $_FILES["image"]["type"];
				$file_size = ($_FILES["image"]["size"] / 1024);
				$file_temp_name = $_FILES["image"]["tmp_name"];
				
				if(file_exists("img/users/" . $_FILES["image"]["name"])) {
					$msg .= $_FILES["image"]["name"] . " already exits.";
				} else {
					$qu = "SELECT profile_photo FROM users WHERE user_ID=" .$_SESSION['user_ID'];
					$userImage = mysqli_query($conn, $qu);
					$userResult = mysqli_fetch_assoc($userImage);
					$profile_photo = "img/users/".$userResult['profile_photo']; 
					unlink($profile_photo);
					move_uploaded_file($_FILES["image"]["tmp_name"],
					"img/users/" . $_FILES["image"]["name"]);
					$strQuery = "UPDATE users SET profile_photo = '" . $_FILES["image"]["name"] . "' WHERE user_ID = " . $_SESSION['user_ID'];
					if(mysqli_query($conn, $strQuery)) {
						session_start();
						header("Location: login.php");
					} else {
						$msg = "Please try again";
					}
				}
			}
		} else {
			$msg = "Invalid file";
		}
	}
	
	// Here it will check the old password and change it to new password
	if(isset($_POST['passSubmit'])) {
		
		$oldPassword = md5($_POST['oldPass']); 
		$newPassword = $_POST['newPass'];
		$confPassword = $_POST['confPass'];
		
		/*$display = $oldPassword . "<br />" . md5($newPassword) . "<br />" . 
			 "UPDATE users SET password = '" . md5($newPassword) . "' WHERE user_ID = " . $_SESSION['user_ID'];*/
		
		if($oldPassword == $_SESSION['pass']) {
			if($newPassword == $confPassword) {
			$stringQuery = "UPDATE users SET password='" . md5($newPassword) . "' WHERE user_ID=" . $_SESSION['user_ID'];
				if(mysqli_query($conn, $stringQuery)) {
					session_destroy();
					header("Location: login.php");
				} else {
					$errorMsg = "Failed to update, try again! <br />";
				}
			} else {
				$errorMsg = "New password doesn't match with confirm password <br />";
			}
		}else {
				$errorMsg = "Please type correct password. <br />";
			}
			
	}
	


?>
<?php include("includes/Navigation.php"); ?>
    <div class="content">

<?php include("includes/breadLine.php"); ?>      
  
    <div class="workplace">
        
        <div class="row-fluid">                
                <div class="span6">
                    <form method="post" action="edit_profile.php" enctype="multipart/form-data">
                    <div class="ushort clearfix">
                        <a href="#"><?php echo @$_SESSION['FullName']; ?></a>
                        <a href="#"><img src="img/users/<?php echo @$_SESSION['profile_photo']; ?>" class="img-polaroid" width="100" height="120"></a>
                        <input type="file" name="image"/>
                        
                        <div class="toolbar clear clearfix">
                            <div class="left">                                
                                <button type="submit" name="changePhoto" class="btn btn-small btn-warning">
                                <span class="icon-ok icon-white"></span> Change</button>                                
                            </div>
                        </div> 
                    </div> 
                    </form>
                    <p style="font-size: 16px; color: #FF0004;"><?php echo @$msg; ?></p>
                    <p style="font-size: 16px; color: #FF0004;"><?php echo @$display; ?></p>
                    <form action="edit_profile.php" method="post">
                    <div class="block-fluid without-head">
                        <div class="toolbar nopadding-toolbar clearfix">
                            <h4>Change password</h4>
                        </div>                                                 
                        <div class="row-form clearfix">
                            <div class="span4">Old Password</div>
                            <div class="span8"><input type="password" name="oldPass" id="oldPass"/></div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="span4">New Password</div>
                            <div class="span8"><input type="password" name="newPass" id="newPass"/></div>
                        </div> 
                        <div class="row-form clearfix">
                            <div class="span4">Confirm Password</div>
                            <div class="span8"><input type="password" name="confPass" id="confPass"/></div>
                        </div>                        
                        <div class="toolbar clear clearfix">
                            <div class="right">                                
                                <button type="submit" name="passSubmit" class="btn btn-small btn-warning"><span class="icon-ok icon-white"></span> Change Password</button>                                
                            </div>
                        </div>                         
                    </div>                     
                    </form>
                </div>
           		
                <div class="span6">                                        
                    <div class="block-fluid without-head">                        
                        <div class="toolbar clearfix">
                            <div class="left">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-small btn-success tip" title="Send mail"><span class="icon-envelope icon-white"></span></button>
                                    <button type="button" class="btn btn-small btn-info tip" title="User page"><span class="icon-info-sign icon-white"></span></button>                                    
                                </div>                                
                            </div>
                            <div class="right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-small btn-warning tip" title="Quick save"><span class="icon-ok icon-white"></span></button>
                                    <button type="button" class="btn btn-small btn-danger tip" title="Delete user"><span class="icon-remove icon-white"></span></button>
                                </div>
                            </div>
                        </div>                        
                        
                        <div class="row-form clearfix">
                            <div class="span3">Name</div>
                            <div class="span9"><input type="text" name="name" value="Dmitry"/></div>
                        </div>

                        <div class="row-form clearfix">
                            <div class="span3">Surname</div>
                            <div class="span9"><input type="text" name="surname" value="Ivaniuk"/></div>
                        </div>

                        <div class="row-form clearfix">
                            <div class="span3">Email</div>
                            <div class="span9"><input type="text" name="email" value="aqvatarius@gmail.com"/></div>
                        </div>                                                
                        
                        <div class="row-form clearfix">
                            <div class="span3">Age</div>
                            <div class="span9"><input type="text" name="age" value="23" class="input-mini"/></div>
                        </div>
                        
                        <div class="row-form clearfix">
                            <div class="span3">Signature</div>
                            <div class="span9"><textarea name="signature">Phasellus ut diam quis dolor mollis tristique. Suspendisse vestibulum convallis felis vitae facilisis.</textarea></div>
                        </div>                        
                    </div>                    
                </div>
           
        </div>
        
        <div class="row-fluid">
                <div class="span12">
                    <div class="block-fluid without-head">                        
                        <div class="toolbar nopadding-toolbar clearfix">
                            <h4>User images</h4>
                        </div>                         
                        <div class="toolbar clearfix">
                            <div class="left">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-small btn-warning tip" title="Hide"><span class="icon-eye-close icon-white"></span></button>
                                    <button type="button" class="btn btn-small btn-danger tip" title="Delete"><span class="icon-remove icon-white"></span></button>
                                </div>                                
                            </div>                        
                        </div>

                        <table cellpadding="0" cellspacing="0" width="100%" class="table images">
                            <thead>
                                <tr>
                                    <th width="30"><input type="checkbox" name="checkall"/></th>
                                    <th width="60">Image</th>
                                    <th>Name</th>
                                    <th width="60">Size</th>
                                    <th width="40">Actions</th>                                
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="checkbox" name="checkbox"/></td>
                                    <td><a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_xmini.jpg" class="img-polaroid"/></a></td>
                                    <td class="info"><a class="fancybox" rel="group" href="img/example_full.jpg">Lorem ipsum dolor sit amet</a> <span>fk-hseosqassr.jpg</span> <span>10.11.2012 10:42</span></td>
                                    <td>260 Kb</td>
                                    <td><a href="#"><span class="icon-pencil"></span></a> <a href="#"><span class="icon-remove"></span></a></td>                                    
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="checkbox"/></td>
                                    <td><a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_xmini.jpg" class="img-polaroid"/></a></td>
                                    <td class="info"><a class="fancybox" rel="group" href="img/example_full.jpg">Lorem ipsum dolor sit amet</a> <span>fk-hseosqassr.jpg</span> <span>10.11.2012 10:42</span></td>
                                    <td>260 Kb</td>
                                    <td><a href="#"><span class="icon-pencil"></span></a> <a href="#"><span class="icon-remove"></span></a></td>                                    
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="checkbox"/></td>
                                    <td><a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_xmini.jpg" class="img-polaroid"/></a></td>
                                    <td class="info"><a class="fancybox" rel="group" href="img/example_full.jpg">Lorem ipsum dolor sit amet</a> <span>fk-hseosqassr.jpg</span> <span>10.11.2012 10:42</span></td>
                                    <td>260 Kb</td>
                                    <td><a href="#"><span class="icon-pencil"></span></a> <a href="#"><span class="icon-remove"></span></a></td>                                    
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="checkbox"/></td>
                                    <td><a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_xmini.jpg" class="img-polaroid"/></a></td>
                                    <td class="info"><a class="fancybox" rel="group" href="img/example_full.jpg">Lorem ipsum dolor sit amet</a> <span>fk-hseosqassr.jpg</span> <span>10.11.2012 10:42</span></td>
                                    <td>260 Kb</td>
                                    <td><a href="#"><span class="icon-pencil"></span></a> <a href="#"><span class="icon-remove"></span></a></td>                                    
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="checkbox"/></td>
                                    <td><a class="fancybox" rel="group" href="img/example_full.jpg"><img src="img/example_xmini.jpg" class="img-polaroid"/></a></td>
                                    <td class="info"><a class="fancybox" rel="group" href="img/example_full.jpg">Lorem ipsum dolor sit amet</a> <span>fk-hseosqassr.jpg</span> <span>10.11.2012 10:42</span></td>
                                    <td>260 Kb</td>
                                    <td><a href="#"><span class="icon-pencil"></span></a> <a href="#"><span class="icon-remove"></span></a></td>                                    
                                </tr>                                              
                            </tbody>
                        </table>                    

                        <div class="toolbar bottom-toolbar clearfix">
                            <div class="left">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-small btn-warning tip" title="Hide"><span class="icon-eye-close icon-white"></span></button>
                                    <button type="button" class="btn btn-small btn-danger tip" title="Delete"><span class="icon-remove icon-white"></span></button>
                                </div>                                
                            </div>                            
                            <div class="right">
                                    <div class="pagination pagination-mini">
                                        <ul>
                                            <li class="disabled"><a href="#">Prev</a></li>
                                            <li class="disabled"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">Next</a></li>
                                        </ul>
                                    </div>                             
                            </div>                        
                        </div>                    

                    </div>
                </div>
    </div>
    
<?php include("includes/chatroom.php"); ?>
<?php if(isset($errorMsg)) {echo "<script type=\"text/javascript\"> alert(" . @$errorMsg . "); </script>"; }?>
<?php include("includes/footer.php"); ?>

