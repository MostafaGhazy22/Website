<?php
// Database credentials
$servername = "fdb1030.awardspace.net"; 
$username = "4547693_data"; 
$password = "123456789#m"; 
$dbname = "4547693_data"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set character set to support UTF-8 encoding (if needed)
$conn->set_charset("utf8");

// Error reporting for development (you can disable it in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
