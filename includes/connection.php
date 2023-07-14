<?php

define("DB_HOST", "192.168.0.104");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "Kabul@123");
define("DB_DATABASE_NAME", "php_social_network");
define("DB_PORT", 33066);


// Create connection
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME, DB_PORT);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
