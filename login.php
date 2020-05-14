<?php
	include("includes/connection.php");
	
	session_start();
	
	if(isset($_POST['signIn'])) {
			$username = $_POST['username'];
			$password = $_POST['loginPassword'];
			
			$password = md5($password);
			
			$strQuery = "SELECT * FROM users WHERE email='$username' AND password = '$password' AND user_status ='Active'";
			$mysqlResult = mysqli_query($conn, $strQuery);
			
			if(mysqli_num_rows($mysqlResult) > 0) {
				
				while($fetch = mysqli_fetch_assoc($mysqlResult)){
				$un = $fetch['email'];
				$ps = $fetch['password'];
				$st = $fetch['user_status'];
				$photo = $fetch['profile_photo'];
				
				if( $un == $username ){
					
					$_SESSION['FullName'] = $fetch['first_name'] . " " . $fetch['last_name'];
					$_SESSION['email'] = $un;
					$_SESSION['profile_photo'] = $photo;
					$_SESSION['user_ID'] = $fetch['user_ID'];
					$_SESSION['pass'] = $ps;
					
					$db_time = $fetch['LastOnline'];
					$date = date("d.m.Y",$db_time);
					$time = date("h:i", $db_time);
					$lastOnline = $date . " in " . $time;
					
					$_SESSION['lastOnline'] = $lastOnline;
					
					header('Location: index.php');				
				}
			}	
			}else {
					$msg = "<div class=\"alert alert-error\">
						<h4>Oops!</h4>
						Username OR Password is incorrect, Please Try Again!
						</div>";	
				}
	}
	
	if(isset($_POST['signUp'])) {
			
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$email = $_POST['email'];
			$conf_email = $_POST['confirm_email'];
			$password = $_POST['password'];
			$confirmPassword = $_POST['conf-password'];
			$dob = $_POST['dateOfBirth'];
			$gender = $_POST['gender'];
			$profile_photo = '';
			
			if($password == $confirmPassword) {
				$password = md5($password);
			}
			
			if($gender === 'Male') {
				$profile_photo = 'male_user_profile_photo.jpg';	
			}else {
				$profile_photo = 'female_user_profile_photo.png';
			}
			
			$strQuery = "INSERT INTO `users`(`first_name`, `last_name`, `email`,`password`, `gender`, `dob`, `profile_photo`, `user_status`) VALUES ('$firstname','$lastname','$email','$password','$gender','$dob', '$profile_photo','Active')";
			
			if(mysqli_query($conn, $strQuery)) {
				
				$msg = "<div class=\"alert alert-success\">
						<h4>Gongratulations!</h4>
						You have successfully registered in Facebook+.<br />
						Now just use your username and password to login.
						</div>";
			}else {
				
				$msg = "<div class=\"alert alert-error\">
						<h4>Oops!</h4>
						Something is wrong with your entery, please recheck it and submit.
						</div>";
			}
	}

?>
<?php include("includes/header.php"); ?>
    <style type="text/css">
	.span2 {
		position: relative;
	}
	.or_logo {
		vertical-align: middle;
		position: absolute;
		top: 120px;
		left: 30px;
		right: 0px;
		bottom: 0px;
	}
	.or_logo span {
		background: #1A81D5;
		padding: 20px;
		color: #FFFFFF;
		border-radius: 100px;	
		text-align: center;
		border: 1px solid #0F68B0;
		font-weight: bold;
		font-size: 20px;
		font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
	}
	</style>
    <div class="content">
    <div class="workplace">
    
    <?php echo @$msg; ?>
    
    <div class="row-fluid">
        <div class="span5">
        <div class="loginBox">        
            <div class="loginHead">
                <p class="logo">Sign In</p>
            </div>
            <form id="validation" class="form-horizontal" action="login.php" method="POST">            
                <div class="control-group">
                    <label for="username">Email</label>                
                    <input type="text" id="username" name="username" class="validate[required]"/>
                </div>
                <div class="control-group">
                    <label for="loginPassword">Password</label>                
                    <input type="password" id="loginPassword" name="loginPassword" class="validate[required]"/>                
                </div>
                <div class="control-group" style="margin-bottom: 5px;">                
                    <label class="checkbox"><input type="checkbox"> Remember me</label>                                                
                </div>
                <div class="form-actions">
                    <button type="submit" name="signIn" class="btn btn-block"><span style="font-weight:bold; font-size:18px;">Sign in</span></button>
                </div>
            </form>        
            
        </div> </div>   
        
        <div class="span2">
        	<div class="or_logo">
            	<span>OR</span>
            </div>
        </div>
        <div class="span5">
        <div class="loginBox">        
            <div class="loginHead">
                <p class="logo">Sign Up</p>
            </div>
            <form id="validation" class="form-horizontal" action="login.php" method="POST">            
                <div class="control-group">
                    <label for="firstname">First name</label>                
                    <input type="text" id="firstname" name="firstname" class="validate[required]"/>
                </div>
                <div class="control-group">
                    <label for="lastname">Last name</label>                
                    <input type="text" id="lastname" name="lastname" class="validate[required]"/>
                </div>
                <div class="control-group">
                    <label for="email">Email</label>                
                    <input type="text" id="email" name="email" class="validate[required,custom[email]]"/>
                </div>
                <div class="control-group">
                    <label for="confirm_email">Re-type Email</label>                
                    <input type="text" id="confirm_email" name="confirm_email" class="validate[required,custom[email]]"/>
                </div>
                <div class="control-group">
                    <label for="password">Password</label>                
                    <input type="password" id="password" name="password" class="validate[required]"/>                
                </div>
                <div class="control-group">
                    <label for="conf-password">Confirm Password</label>                
                    <input type="password" id="conf-password" name="conf-password" class="validate[required]"/>                
                </div>
                <div class="control-group">
                	<label for="dateOfBirth">Date of Birth</label>
                    <input type="text" id="dateOfBirth" name="dateOfBirth"  class="validate[required]" />
                </div>
                <div class="row-form clearfix">
                    <div class="span5">Gender</div>
                    <div class="span7">
                    <select name="gender">
                    	<option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" name="signUp" class="btn btn-block"><i style="font-weight: bold; font-size:20px;">Sign Up</i></button>
                </div>
            </form>        
            
        </div> </div>   
    </div>
    </div></div>
</body>
</html>
