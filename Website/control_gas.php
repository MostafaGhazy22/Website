<?php
session_start();
require 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Error: User not logged in.";
    exit();
}

// Define the file path based on the session user ID
$user_id = $_SESSION['user_id'];
$file_path = "user_files/gas_status_{$user_id}.txt";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle POST request to update the gas status
    if (isset($_POST['value'])) {
        $new_value = htmlspecialchars($_POST['value'], ENT_QUOTES, 'UTF-8');
        if (file_put_contents($file_path, $new_value) !== false) {
            echo "File updated successfully.";
        } else {
            echo "Failed to update the file. Please check file permissions.";
        }
    } else {
        echo "Error: 'value' parameter is missing.";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Handle GET request to read the gas status
    echo file_exists($file_path) ? trim(file_get_contents($file_path)) : "0";
} else {
    echo "Invalid request method.";
}
?>
