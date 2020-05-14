<?PHP session_start();

//$_SESSION['user_ID'] = null;
unset($_SESSION['user_ID']);
//session_destroy();

header("location: login.php");


?>