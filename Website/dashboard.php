<?php
session_start();
require 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Define the path for the user's device status file
$file_path = 'user_files/device_status_' . $_SESSION['user_id'] . '.txt';

// Read the current device status; default to '0' if the file doesn't exist
$current_status = file_exists($file_path) ? trim(file_get_contents($file_path)) : '0'; 
$device_status = ($current_status == "1") ? "ON" : "OFF"; // Convert 1/0 to ON/OFF for display
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding-top: 50px;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        .status {
            font-size: 24px;
            margin: 20px 0;
        }
        .status span {
            font-weight: bold;
            color: #007bff;
        }
        a {
            display: block;
            margin-top: 20px;
            color: #333;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>User Dashboard</h1>
    <p class="status">Device Status: <span><?php echo $device_status; ?></span></p>
    <a href="control.php">Control Device</a>
    <a href="logout.php">Logout</a>
</div>

</body>
</html>
