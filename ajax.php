<?PHP session_start();
	include("includes/connection.php");
	$strQuery = "UPDATE users SET LastOnline = " . time() . " WHERE user_ID = $_SESSION[user_ID]";
	mysqli_query($conn, $strQuery);
?>