<?php
session_start();
require 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get the device from the query parameter (either 'led', 'fan', or 'gas')
$device = isset($_GET['device']) ? $_GET['device'] : 'led';

// Define the appropriate file path based on the device
if ($device == 'fan') {
    $file_path = 'user_files/fan_status_' . $_SESSION['user_id'] . '.txt';
} else {
    $file_path = 'user_files/device_status_' . $_SESSION['user_id'] . '.txt'; // Default to LED
}

// Read the current status; default to '0' if the file doesn't exist
$current_status = file_exists($file_path) ? trim(file_get_contents($file_path)) : '0';

// Toggle the status (if it's 1, make it 0; if it's 0, make it 1)
$new_status = ($current_status == "1") ? '0' : '1';

// Write the new status back to the file
file_put_contents($file_path, $new_status);

// Redirect back to the dashboard after updating
header('Location: dashboard.php');
exit();
?>
