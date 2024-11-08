<?php
session_start();
require 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Error: User not logged in.";
    exit();
}

// Define the file path based on the user ID in session
$user_id = $_SESSION['user_id'];
$file_path = "user_files/gas_status_{$user_id}.txt";

// Read and output the current gas status
if (file_exists($file_path)) {
    echo trim(file_get_contents($file_path));
} else {
    echo "0"; // Default to 0 if the file doesn't exist
}
?>
