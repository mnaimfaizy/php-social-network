<?php
	// Start the connection to database
	$conn = mysqli_connect("localhost","root","","php_social_network");
	if(!$conn) {
		echo "The connection was unsuccessful, please try again! " + mysqli_error($conn);	
	}
?>