<?php
	include("includes/connection.php");
	include("includes/CheckStatus.php");

	if(isset($_POST['btnComment'])) {
			$commentText = $_POST['commentText'];
			$commentDate = time();
			$member_id = $_SESSION['user_ID'];
			$post_id =  $_GET['post_id'];
			
			$stringComment = "INSERT INTO comments (post_id, member_id, comment_date, comment) VALUES ($post_id, $member_id, $commentDate, '$commentText')";
			if(mysqli_query($conn, $stringComment)) {
				header("Location: posts.php?post_id=$_GET[post_id]");	
			}
			
			
	}
	  
	include("includes/header.php"); ?>
<?php include("includes/Navigation.php"); ?>
    <div class="content">

<?php include("includes/breadLine.php"); ?>      
  
    <div class="workplace">
            <div class="row-fluid">
            <div class="span9">
                
                <div class="head clearfix">
                	<div class="isw-archive"></div>
                        <h1>Post Detail</h1>
                </div>
                
                <div class="block stream">
   
   				<?php
                	$selectPost = "SELECT `post_id`, `member_id`, `post_time`, `post_content`, users.first_name, users.last_name, users.profile_photo FROM `posts` INNER JOIN users ON posts.member_id = users.user_ID WHERE posts.post_id = " . $_GET['post_id'] . " AND posts.member_id = " . $_SESSION['user_ID'] . " LIMIT 1";
					$res = mysqli_query($conn, $selectPost);
					while($rows = mysqli_fetch_assoc($res)) {
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
                            <?php echo $rows['post_content']; ?>
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
                            
                            
                            </div>
                               <?php }  ?>
                            <p class="actions">
                            <a href="like_post.php?post_id=<?php echo $_GET['post_id']; ?>&member_id=<?php echo $_SESSION['user_ID']; ?>"><span class="icon-heart"></span> Like </a>
                            <a href="#"><span class=" icon-share-alt"></span> Share </a>
                            </p>
                            
                    <p class="actions" style="text-align: left;">
                         <span class="label label-inverse">
                         <?php $str = "SELECT * FROM comments WHERE post_id = $_GET[post_id] AND member_id = $_SESSION[user_ID]";
						 $strQresult = mysqli_query($conn, $str);
						 $count = mysqli_num_rows($strQresult);
						 if($count == 0) {
							 echo "No ";
						 } else {
							 echo $count;
						 }
                         ?></span> <?php if($count == 1) { echo " Comment"; } else { echo " Comments"; } ?> 
                         <span class="icon-comment"></span>
                         <span class="label label-inverse">
                         <?php $str = "SELECT * FROM like_post WHERE post_id = $_GET[post_id] AND member_id = $_SESSION[user_ID]";
						 $strQresult = mysqli_query($conn, $str);
						 $count = mysqli_num_rows($strQresult);
						 if($count == 0) {
							 echo "No ";
						 } else {
							 echo $count;
						 }
                         ?></span> <?php if($count == 1) { echo " Like"; } else { echo " Likes"; } ?> 
                         <span class=" icon-thumbs-up"></span>
                    </p>
                    </div>
                    </div>
                    
                    <div class="block messages">
                    <?php
						$strUserComment = "SELECT comment_id, post_id, user_ID, comment_date, comment, users.first_name, users.last_name, users.profile_photo FROM comments LEFT JOIN users on users.user_ID = comments.member_id WHERE post_id=" . $_GET['post_id'] . " ORDER BY comment_date DESC  ";
						$strUserResult = mysqli_query($conn, $strUserComment);
						while($strUserRows = mysqli_fetch_assoc($strUserResult)) {
					?>    
                        <div class="item clearfix">
                            <div class="image">
                                <a href="img/users/<?php echo $strUserRows['profile_photo']; ?>">
                                	<img class="img-polaroid" src="img/users/<?php echo $strUserRows['profile_photo']; ?>" width="30" height="35" />
                                </a>
                            </div>
                            <div class="info" style="margin: 0px 0px 0px 5px;">
                            	<a class="name" href="#"><?php echo "$strUserRows[first_name] $strUserRows[last_name]"; ?></a>
                                <p><?php echo $strUserRows['comment']; ?></p>
                                <span><?php $comment_date = $strUserRows['comment_date'];
											echo (date("d-M-Y",$comment_date)); 
								?></span>
                            </div>
                        </div>
                       <?php } ?>
                       
                    </div>
                    <div style="margin: 10px 0px;"></div>
                    <div class="answer">
                    <div class="span12">
                        <div class="span3">
                        <div class="image">
                                <img class="img-polaroid" src="img/users/<?php echo $_SESSION['profile_photo']; ?>" width="30" height="35">
                        </div>
                        <div class="info" style="margin-left: 45px;"><a class="name" href="#"><?php echo $_SESSION['FullName']; ?></a></div>
                        </div>
                    <div class="span9">
                    	<form action="posts.php?post_id=<?php echo $_GET['post_id']; ?>" method="post">
                        <div class="arrow"></div>
                        <div class="textarea">
                        <textarea name="commentText" id="commentText"></textarea>
                        </div>
                    <div class="actions">
                        <button type="submit" class="btn btn-small" name="btnComment" id="btnComment">
                        <span class="isw-chat"></span> Comment
                        </button>
                    </div>
                    </div>
                    </form>
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
        
    </div>
<?php include("includes/chatroom.php"); ?>

<?php include("includes/footer.php"); ?>

