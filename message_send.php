<?PHP session_start();
		include("includes/connection.php");
	if( isset($_POST['task']) ){
		
		
		if( $_POST['task'] == "send" ){
			$to_user_id = $_POST['to_user_id'];
			$content = $_POST['content'];
			$msgDate = time();
				
			 $strQuery = "INSERT INTO message (from_user_id, to_user_id, message_text, Status, message_date) 
						  VALUES ($_SESSION[user_ID], $to_user_id, '$content', 'Unread', $msgDate)";
						  
			if( mysqli_query($conn, $strQuery) ){
				echo "TRUE";
			}else{
				echo "FALSE";
			}
		}else if( $_POST['task'] == "get" ){
			$strMsgQuery = "SELECT * FROM message WHERE 
							from_user_id = $_POST[to_user_id] AND to_user_id = $_SESSION[user_ID] AND Status='Unread'";

			$msgs = mysqli_query($conn, $strMsgQuery) or die(mysqli_error());
			if( mysqli_num_rows( $msgs ) > 0 ){
				
				mysqli_query($conn, "UPDATE message SET Status = 'Read' WHERE from_user_id = $_POST[to_user_id] AND to_user_id = $_SESSION[user_ID]") or die(mysqli_error());
				
				while($m_result = mysqli_fetch_assoc($msgs)){
								
								$from_id = $m_result['from_user_id'];								
								$Iid = $m_result['from_user_id'];								
								$userInfo = mysqli_query($conn, "SELECT first_name, last_name, profile_photo FROM users WHERE user_ID=$Iid") or die(mysqli_error());
								$userInfo = mysqli_fetch_array($userInfo);
?>
    		<p class="<?PHP echo ( $from_id == $_SESSION['user_ID'] ) ? "from_msg" : "to_msg"; ?>"><?php echo $m_result['message_text']; ?></p>
<?PHP
				}
			}else{
				echo "0";
			}
		}
	}
	
?>
