<?php
// Database credentials
$servername = "sql112.infinityfree.com"; // Replace with your actual database server name
$username = "if0_37492642"; // Replace with your actual database username
$password = "M1o1s1t1"; // Replace with your actual database password
$dbname = "if0_37492642_iot"; // Replace with your actual database name

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
