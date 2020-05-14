<?php 	include("includes/connection.php");
		include("includes/CheckStatus.php");
		
		
		include("includes/header.php");
?>
<?php include("includes/Navigation.php"); ?>
    <div class="content" style="min-height: 600px;">

<?php include("includes/breadLine.php"); ?>      
  
    <div class="workplace">
    	<div class="row-fluid">
        	<div class="span12">
            	<div class="head clearfix">
                    <div class="isw-documents"></div>
                    <h1>Advance Search</h1>
                </div>
            </div>
            
            <div class="block-fluid">
                <div class="row-form clearfix">
                    <h4>Search as you like</h4>
            	</div>
                <form action="advance_search.php" method="post">
                <div class="row-form clearfix">
                    <div class="span2">First Name: </div>
                    <div class="span4">
                    <input type="text" name="firstname" id="firstname">
                	</div>
                    
                    <div class="span2">Last Name: </div>
                    <div class="span4">
                    <input type="text" name="lastname" id="lastname">
                	</div>
                    
            	</div>
                <div class="row-form clearfix">
                    <div class="span2">Gender :</div>
                    <div class="span4">
                    <input type="text" name="gender" id="gender">
                	</div>
                    
                    <div class="span2">Email : </div>
                    <div class="span4">
                    <input type="text" name="email" id="email">
                	</div>
                    
            	</div>
                <div class="row-form clearfix">
                    <div class="span2">Phone :</div>
                    <div class="span4">
                    <input type="text" name="phone" id="phone">
                	</div>
                    <div class="span6">
                    <input type="submit" name="btnSearch" id="btnSearch" class="btn btn-big" value="Search" />
                    </div>
            	</div>
                
                </form>
                
            </div>
            
        </div>
        <div class="row-fluid">
        	<?php
				 if(isset($_POST['btnSearch'])){
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$gender = $_POST['gender'];
			
			$strWhere = "";
			
			if( $firstname != "" ){
				$strWhere .= " first_name LIKE '%$firstname%' ";
			}
			
			if($lastname != ""){
				
				if( $strWhere != "" ){
					$strWhere .= " AND ";
				}				
				$strWhere .= " last_name LIKE '%$lastname%' ";
			}
			
			if( $email != ""){
				if( $strWhere != "" ){
					$strWhere .= " AND ";
				}
				
				$strWhere .= " email LIKE '%$email%' ";				
			}
			
			if( $phone != ""){
				if( $strWhere != "" ){
					$strWhere .= " AND ";
				}
				
				$strWhere .= " phone LIKE '%$phone%' ";				
			}
			
			if( $gender != ""){
				if( $strWhere != "" ){
					$strWhere .= " AND ";
				}
				
				$strWhere .= " gender LIKE '%$gender%' ";				
			}
			
			
			if( $strWhere != "" ){
			$strQuery = "SELECT * FROM users WHERE $strWhere";
			
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
		  }
		   } ?>
        </div>
    </div>

<?php include("includes/chatroom.php"); ?>

<?php include("includes/footer.php"); ?>