<?php
	include("includes/connection.php");
	include("includes/CheckStatus.php");
	
	// Here we will check for the posts which are uploaded and get the last ID and add 1 with it
	// To add another post to it
	$query = "SELECT COUNT(`post_id`) AS total FROM `posts` ";
	$count = mysqli_query($conn, $query);
	$reslult = mysqli_fetch_assoc($count);
	$PostID = $reslult['total'] + 1;
	
	if(isset($_POST['sendPost'])) {
		
		$imageUpload = "";
		
		if($_FILES['imageUpload'] != null) {
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["imageUpload"]["name"]);
		$extension = end($temp);
		
		if((($_FILES["imageUpload"]["type"] == "image/gif")
		|| ($_FILES["imageUpload"]["type"] == "image/jpeg")
		|| ($_FILES["imageUpload"]["type"] == "image/jpg")
		|| ($_FILES["imageUpload"]["type"] == "image/pjpeg")
		|| ($_FILES["imageUpload"]["type"] == "image/x-png")
		|| ($_FILES["imageUpload"]["type"] == "image/png"))
		&& ($_FILES["imageUpload"]["size"] < 2000000)
		&& in_array($extension, $allowedExts)) {
			if($_FILES["imageUpload"]["error"] > 0) {
				$msg = "Error: " . $_FILES["imageUpload"]["error"] . "<br />";
			} else {
				$file_name = $_FILES["imageUpload"]["name"];
				$file_type = $_FILES["imageUpload"]["type"];
				$file_size = ($_FILES["imageUpload"]["size"] / 1024);
				$file_temp_name = $_FILES["imageUpload"]["tmp_name"];
				
				if(file_exists("img/" . $_FILES["imageUpload"]["name"])) {
					@$msg .= $_FILES["imageUpload"]["name"] . " already exits.";
				} 
				else {
					move_uploaded_file($_FILES["imageUpload"]["tmp_name"],
					"img/" . $_FILES["imageUpload"]["name"]);
					$imageUpload = $_FILES['imageUpload']['name'];
					$strQuery = "INSERT INTO `files`(`file_id`, `file_name`, `file_type`, `file_size`, `member_id`, post_id) VALUES (null,'$file_name','$file_type',$file_size,'" . $_SESSION['user_ID'] . "', $PostID)";
					mysqli_query($conn, $strQuery);
				}
			} 
		} else {
				@$msg .= "Invalid File! please try Again!";
			}
		}
		
		$postToSent = $_POST['postToSend'];
		$date = time();
		$postToSent = mysql_escape_string($postToSent);
		$strInsertQuery = "INSERT INTO `posts`(`post_id`, `member_id`, `post_time`, `post_content`) VALUES (null,'" . $_SESSION['user_ID'] . "',$date,'$postToSent')";
		if(mysqli_query($conn,$strInsertQuery)) {
			header("Location: index.php");	
		} else {
			@$msg .= "Please Try again. and refresh the page";	
		}
		
	}
	  
	include("includes/header.php"); ?>
<?php include("includes/Navigation.php"); ?>
    <div class="content">

<?php include("includes/breadLine.php"); ?>      
  
    <div class="workplace">
            
            <div class="row-fluid">
            <div class="span9">
            	
                <div class="block streem">
                <div class="item clearfix">
                        <div class="span3">
                        <div class="image" style="width: 50px; float: left;">
                                <img class="img-polaroid" src="img/users/<?php echo $_SESSION['profile_photo']; ?>" width="30" height="35">
                        </div>
                        <div class="info" style="margin-left: 45px; font-weight: bold;"><a class="name" href="#">
                        <?php echo $_SESSION['FullName']; ?></a></div>
                        </div>
                        
                    <div class="span9">
                    	<form action="index.php" method="post" enctype="multipart/form-data">
                        <div class="textarea">
                        <textarea name="postToSend" id="postToSend" style="width:400px; height:100px;"></textarea>
                        </div>
                        <div class="actions">
                        	<span style="margin: 0px 100px 0px 0px;">
                            <input type="file" name="imageUpload" id="imageUpload"/>
                            </span>
                            <button type="submit" name="sendPost" id="sendPost" class="btn btn-small">
                            <span class="isw-chat"></span> Post
                            </button>
                        </div>
                        </form>
                        <p style="color: #FF0004; font-size: 16px;"><?php echo @$msg; ?></p>
                	</div>
                </div>
                </div>
                
                <div style="margin: 10px 0px;"></div>
                
                <div class="head clearfix">
                	<div class="isw-archive"></div>
                        <h1>Latest Posts</h1>
                </div>
                
                <div class="block stream">
   
   				<?php
                	$selectPost = "SELECT `post_id`, `member_id`, `post_time`, `post_content`, users.first_name, users.last_name, users.profile_photo FROM `posts` INNER JOIN users ON posts.member_id = users.user_ID WHERE posts.member_id = " . $_SESSION['user_ID'] . " ORDER BY post_id DESC";
					$res = mysqli_query($conn, $selectPost);
					while($rows = mysqli_fetch_assoc($res)) {
						$_SESSION['post_ID'] = $rows['post_id'];
                ?>
                 <div class="item clearfix">
                 <div style="background: #FFFFFF; padding: 5px;">
                    <div class="image" style="margin:10px;">
                        <a href="#">
                        	<img class="img-polaroid" src="img/users/<?php echo $rows['profile_photo']; ?>" width="35" height="35">
                        </a>
                    </div>
                    <div class="info">
                        <a class="name" href="#"><?php echo $rows['first_name'] . " " . $rows["last_name"]; ?></a>
                            <p class="title">
                            <span class="icon-th-list"></span>
                            Post uploaded on
                            <strong><?php 
								$date = $rows['post_time']; 
								echo (date("d-m-Y h:i:s",$date));
								?></strong>
                            </p>
                            <?php $content = $rows['post_content']; 
									$content_1 = explode(' ', $content);
									if( count($content_1) > 49 ) {
										for($i = 0; $i < 50; $i++) {
											echo $content_1[$i] . ' ';	
										}
									} else {
										echo $content;
									}
							?>
							<?php
								$query = "SELECT * FROM files WHERE member_id =" . $_SESSION['user_ID'] 
								. " AND post_id = " . $rows['post_id'];
								$image = mysqli_query($conn, $query);
								//$results = mysqli_fetch_assoc($image);								
							?>
                            <div class="text gallery">
                            <?php
                            //if($results['post_id'] == $rows['post_id']) {
								while($row = mysqli_fetch_assoc($image)) {
							?>
                            
                                <a class="fancybox" href="img/<?php echo $row['file_name']; ?>" rel="group">
                                	<img class="img-polaroid" src="img/<?php echo $row['file_name']; ?>" width="250" height="250">
                                </a>
                            
                            <?php }  ?>
                            </div>
                        <div class="footer">
                        <a href="posts.php?post_id=<?php echo $rows['post_id']; ?>&member_id=<?php echo $_SESSION['user_ID'] ?>" class="btn btn-info"> Read more...</a>
                        </div>
                            
                    </div>
                    </div>
                </div>
                <div class="dr"><span></span></div>
                <?php } ?>
                
		</div>
                </div>
                
<!--  This section is for Showing those friends which you may know.  -->    
           <div class="span3">
            	<div class="head clearfix">
                        <div class="isw-list"></div>
                        <h1>People You May Know</h1>    
                </div>
                
                <div class="block messages">
                        
                        <?php
							$queryFriends = "SELECT * FROM users WHERE user_ID <> " . $_SESSION['user_ID'] . " ORDER BY user_ID DESC LIMIT 4";
							$queryResult = mysqli_query($conn, $queryFriends);
							while($queryRows = mysqli_fetch_assoc($queryResult)) {
						?>
                        
                        <div class="item clearfix">
                            <div class="image"><a href="user_profile.php?member_id=<?php echo $queryRows['user_ID']; ?>"><img src="img/users/<?php echo $queryRows['profile_photo'] ?>" width="45" height="50"/></a></div>
                            <div class="info" style="margin-left: 10px; margin-top: -10px;">
                                <a href="user_profile.php?member_id=<?php echo $queryRows['user_ID']; ?>" class="name"><?php echo $queryRows['first_name'] . " " . $queryRows['last_name']; ?></a>
                                <div style="margin-top: 20px;"></div>
                                <a href="user_profile.php?member_id=<?php echo $queryRows['user_ID']; ?>" class="btn btn-mini"> View Profile </a>
                                
                            </div>
                        </div>
                        <hr style="margin: 5px 0px;" />
                        <?php } ?>
                        
            </div>     
                
            </div>
            
        </div>
        
    </div>
<?php include("includes/chatroom.php"); ?>

<?php include("includes/footer.php"); ?>

