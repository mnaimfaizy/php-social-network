<?php
	include("includes/connection.php");
	include("includes/CheckStatus.php");
	$albumTitle=$coverPhoto=""; $status = "public";
	
			if( isset($_POST['btnAddPhoto'])){
				$photoName = $_FILES['photo']['name'];
				$photoadd  = $_FILES['photo']['tmp_name'];
				$status = $_POST['photoPrivacy'];
				
				$NewPhotoName = "";
				
				$ext = explode(".", $photoName);
				$ext = $ext[ count($ext) - 1 ];
				
				if( move_uploaded_file($photoadd, "photo_albums/" . $_SESSION['user_ID'] . "_" . time() . ".$ext") ){
					$NewPhotoName = $_SESSION['user_ID'] . "_" . time() . ".$ext";
				}
				
				$strQuery = "INSERT INTO photos (album_id, status, photo_name) VALUES ($_GET[albums_id], '$status', '$NewPhotoName')";
				
				if(mysqli_query($conn, $strQuery)){
					header("location: photos.php?albums_id=$_GET[albums_id]");
				} else {
					echo mysqli_error();
				}
		}
		
		if( isset($_POST['btnAddAlbum']) ){
			
			$albumTitle = $_POST['albumTitle'];
			$status	 = $_POST['albumPrivacy'];
			
			$cName = $_FILES['coverPhoto']['name'];
			$cTmp  = $_FILES['coverPhoto']['tmp_name'];
			
			if( !empty($cName) ){
				
				$ext = explode(".", $cName);
				$ext = $ext[ count($ext) -1 ];
				
				$coverPhoto = $_SESSION['user_ID'] . "_" . time() . ".$ext";
				if($_GET['coverPhoto'] != $coverPhoto) {
					$path = "photo_albums/$coverPhoto";				
					move_uploaded_file($cTmp, $path);
					
					if( file_exists( "photo_albums/$_GET[coverPhoto]" ) ){
						unlink( "photo_albums/$_GET[coverPhoto]" );
					}
				} else {
				$coverPhoto = $_GET['coverPhoto'];	
			}
			} 
			
			if( isset($_GET['album_id']) ){
				$strQuery = "UPDATE photo_album SET album_title='$albumTitle', status='$status', cover_photo='$coverPhoto' WHERE photo_album_id=$_GET[album_id]";
			}else{
				$strQuery = "INSERT INTO photo_album (`album_title`, user_id, cover_photo, status) VALUES ('$albumTitle', $_SESSION[user_ID], '$coverPhoto', '$status')";
			}	
			
			if( mysqli_query($conn, $strQuery ) ){
				$msg = "<div class=\"alert alert-success\">                
						<h4>Success!</h4>
						You have successfully added a new album to your photos collection.
						</div>";
			}else{
				$msg = "<div class=\"alert alert-error\">                
						<h4>Error!</h4>
						Please fill all the required fields and try once again... 
						</div>";
			}
		}
		
	if(isset($_GET['task'])) {
		if(isset($_GET['photo_id']) && (isset($_GET['task']) == 'delete')) {
				$string = "DELETE FROM photos WHERE photo_id = " . $_GET['photo_id'];
				if( file_exists( "photo_albums/$_GET[photo_name]" ) ){
					unlink( "photo_albums/$_GET[photo_name]" );
				}
				if(mysqli_query($conn, $string)) {
					header("Location: photos.php?albums_id=$_GET[albums_id]");
				} else {
					$msg = 	"<div class=\"alert alert-error\">                
						<h4>Error!</h4>
						Sorry the photo can't be deleted please try again. 
						</div>";
				}
		}
		
		if( isset($_GET['album_id']) && ($_GET['task'] == "deleteAlbum") && (isset($_GET['coverPhoto'])) ){
			
			$photos = mysql_query("SELECT * FROM photos WHERE album_id=$_GET[album_id]");
			while($result = mysql_fetch_assoc($photos)){
				$photo = "photo_albums/$result[photo_name]";
				
				if( file_exists( $photo ) ){
					unlink($photo);
				}
			}
			
			if( file_exists( "photo_albums/$_GET[coverPhoto]" ) ){
				unlink( "photo_albums/$_GET[coverPhoto]" );
			}
			
			if(
				mysqli_query($conn, "DELETE FROM photos WHERE album_id=$_GET[album_id]") &&
				mysqli_query($conn, "DELETE FROM photo_album WHERE photo_album_id=$_GET[album_id]")
				) {
					header("Location: photos.php");
				} else {
					$msg = 	"<div class=\"alert alert-error\">                
						<h4>Error!</h4>
						Sorry the album can't be deleted please try again. 
						</div>";
				}
			
		}
	}
	include("includes/header.php"); 
	
?>
<?php include("includes/Navigation.php"); ?>
    <div class="content">

<?php include("includes/breadLine.php"); ?>      
      <?PHP

if(isset($_GET['task'])) {
if( isset($_GET['album_id']) && ($_GET['task'] == 'editAlbum') ){
		$query = mysqli_query($conn, "SELECT * FROM photo_album WHERE photo_album_id=$_GET[album_id]");
		$result = mysqli_fetch_array($query);
		$title = $result['album_title'];
		$status = $result['status'];
		$coverPhotoName = $result['cover_photo'];
}
}
?>
    <div class="workplace">
    	<?php echo @$msg; ?>
        <?php if(!isset($_GET['albums_id'])) {?>
    	<div class="row-fluid">
    		<div class="span12">
            	<form method="post" enctype="multipart/form-data">
                <div class="head clearfix">
                        <div class="isw-brush"></div>
                        <h1>Albums Information</h1>                       
                </div> <!-- head clearfix -->
                    <div class="block gallery clearfix">
                	<div class="row-form clearfix">
                            <div class="span2">Album Title</div>
                            <div class="span5">        
                                <input value="<?php echo @$title; ?>" class="validate[required,maxSize[50]]" type="text" name="albumTitle" id="albumTitle"/>
                                <span>Maximum 50 characters</span>
                            </div> <!-- span5 -->
                            
                            <div class="span2">Album Cover Photo:</div>
                            <div class="span3">                                                                
                                <input type="file" name="coverPhoto" id="coverPhoto"/>
                                <?php if(isset($_GET['album_id'])) { ?>
                                	<img src="photo_albums/<?php echo @$coverPhotoName; ?>" width="100" height="100">
                                <?php } ?>
                            </div> <!-- span3 -->
                    </div> <!-- row-form clearfix --> 
                    <div class="row-form clearfix">
                            <div class="span2">Privacy:</div>
                            <div class="span4">
                            	<select name="albumPrivacy" id="albumPrivacy">
                                		<option value="" disabled="disabled" selected="selected"> -- Select Privacy -- </option>
                                        <option value="Public" <?PHP echo ($status == "Public") ? 'selected="selected"' : "" ?> >Public</option>
                                        <option value="Private" <?PHP echo ($status == "Private") ? 'selected="selected"' : "" ?> >Private</option>  
                                </select>
                            </div>
                    	
                    	<div class="span6">
                        	<span style="float:right;">
                        	<input type="submit" name="btnAddAlbum" id="btnAddAlbum" class="btn" value="SAVE"/>
                            </span>
                        </div> <!-- span4 -->
                    </div> <!-- row-form clearfix -->
                    <?php if(isset($_GET['album_id'])) { ?>
                    	<a href="photos.php">Back To Albums</a>
                    <?php } ?>
                    </div>  <!-- block gallery clearfix -->   
                </form>
            </div> <!-- span10 -->
    	</div> <!-- row-fluid -->
        
        <div class="row-fluid">
           <div class="span12">
                    <div class="head clearfix">
                        <div class="isw-picture"></div>
                        <h1>Photo Albums</h1>                       
                    </div>
                    <div class="block gallery clearfix">
                    <?php 
						$strSelectAlbums = "SELECT * FROM photo_album WHERE user_id = " . $_SESSION['user_ID'];
						$strSelectAlbumsResult = mysqli_query($conn, $strSelectAlbums);
						while($strAlbum = mysqli_fetch_assoc($strSelectAlbumsResult)) {
					?>
                        <span class="span2">
                        <img class="img-polaroid" src="photo_albums/<?php echo $strAlbum['cover_photo']; ?>" alt="<?php echo $strAlbum['album_title']; ?>" title="<?php echo $strAlbum['album_title']; ?>" width="110" height="100"/>
                        <div class="name" style="font-size:11px; color:#4E89E4; padding:2px;">
						<a href="photos.php?albums_id=<?php echo $strAlbum['photo_album_id']; ?>"><?php echo $strAlbum['album_title']; ?></a></div>
                        
                        <div class="name" style="text-align:center;">
                        <a href="photos.php?album_id=<?php echo $strAlbum['photo_album_id']; ?>&task=editAlbum&coverPhoto=<?php echo $strAlbum['cover_photo']; ?>" title="Edit <?php echo $strAlbum['album_title']; ?> Album">
                        <span class="isb-edit"></span>
                        </a>
                        <a onclick="if(confirm('Are you sure???')){return true;}else{return false;}" href="photos.php?album_id=<?php echo $strAlbum['photo_album_id']; ?>&task=deleteAlbum&coverPhoto=<?php echo $strAlbum['cover_photo']; ?>" title="Delete <?php echo $strAlbum['album_title']; ?> Album">
                        <span class="isb-cancel"></span>
                        </a>
                        
                        </div>
                        </span>
                        <?php } ?>
                           
                    </div>
           </div> <!-- span9 -->
        </div> <!-- row-fluid -->
        <?php } ?>
<?php if(isset($_GET['albums_id'])) {?>
		<div class="row-fluid">
    		<div class="span12">
            	<form method="post" enctype="multipart/form-data">
                <div class="head clearfix">
                        <div class="isw-brush"></div>
                        <h1>Photo Information</h1>                       
                </div> <!-- head clearfix -->
                    <div class="block gallery clearfix">
                	<div class="row-form clearfix">
                    		<div class="span1">Photo:</div>
                            <div class="span4">                                                                
                                <input type="file" name="photo" id="photo"/>
                            </div> <!-- span3 -->
                            <div class="span3">
                            	<select name="photoPrivacy" id="photoPrivacy">
                                		<option value="" disabled="disabled" selected="selected"> -- Select Privacy -- </option>
                                        <option value="Public">Public</option>
                                        <option value="Private">Private</option>  
                                </select>
                            </div> <!-- span2 -->
                           <div class="span2">
                        	<span style="float:right;">
                        	<input type="submit" name="btnAddPhoto" id="btnAddPhoto" class="btn" value="ADD PHOTO"/>
                            </span>
                        	</div> <!-- span3 -->
                            <div class="span2">
                            	<a href="photos.php">Back to Albums</a>
                            </div>
                    </div> <!-- row-form clearfix -->
                    
                    </div>  <!-- block gallery clearfix -->   
                </form>
            </div> <!-- span10 -->
    	</div> <!-- row-fluid -->
        <!-- These will show the images of selected album, from a to z -->
        <div class="row-fluid">
           <div class="span12">
                    <div class="head clearfix">
                        <div class="isw-picture"></div>
                        <?php $albumName = mysqli_query($conn, "SELECT album_title FROM photo_album WHERE photo_album_id = " . $_GET['albums_id'] . " LIMIT 1");
						while($rows = mysqli_fetch_assoc($albumName)) {
							$albumtitle = $rows['album_title'];	
						}
						?>
                        <h1><?php if(@$albumtitle != null) {
						echo $albumtitle . " Album"; }else { echo " No Album Selected"; } ?></h1>                       
                    </div>
                    <div class="block gallery clearfix">
                        
                        <?php 
						$strSelectPhotos = "SELECT * FROM photos WHERE album_id = " . $_GET['albums_id'];
						$strSelectPhotosResult = mysqli_query($conn, $strSelectPhotos);
						while($strphoto = mysqli_fetch_assoc($strSelectPhotosResult)) {
						?>
                        <div class="span2">
                        <a href="photo_albums/<?php echo $strphoto['photo_name']; ?>" rel="group" class="fancybox" style="margin: 6px;"><img class="img-polaroid" src="photo_albums/<?php echo $strphoto['photo_name']; ?>" width="100" height="75"></a>
                        <div class="name" style="text-align: center;">
                        <a onclick="if(confirm('Are you sure???')){return true;}else{return false;}" href="photos.php?albums_id=<?PHP echo $_GET['albums_id']; ?>&photo_id=<?php echo $strphoto['photo_id']; ?>&task=delete&photo_name=<?php echo $strphoto['photo_name']; ?>"><span class="isb-cancel"></span> </a>
                        </div>
                        </div>
                        <?php } ?>
                    </div>
           </div> <!-- span9 -->
        </div> <!-- row-fluid -->
        <?php } ?>
    </div> <!-- workplace -->
    </div> <!-- content -->
<?php include("includes/chatroom.php"); ?>

<?php include("includes/footer.php"); ?>

