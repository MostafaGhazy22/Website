<?php
// Include config file for database connection
require 'config.php';
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

// Define the path for the user's device status file
$user_id = $_SESSION['user_id'];
$status_file = "user_files/device_status_" . $user_id . ".txt";

// Initialize the device status variable
$device_status = "OFF"; // Default to OFF

// Check if the status file exists and read the current status
if (file_exists($status_file)) {
    $current_status = trim(file_get_contents($status_file));
    $device_status = ($current_status == "1") ? "ON" : "OFF"; // Convert 1/0 to ON/OFF for display
} else {
    // If no file exists, create it and set the default status
    file_put_contents($status_file, "0"); // Default to OFF (0)
}

// Handle device control (e.g., toggling LED or fan status)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['toggle'])) {
        // Toggle the device status
        if ($current_status == "0") {
            $device_status = "ON"; // Display ON
            file_put_contents($status_file, "1"); // Write 1 for ON
        } else {
            $device_status = "OFF"; // Display OFF
            file_put_contents($status_file, "0"); // Write 0 for OFF
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Device Control</title>
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
        h2 {
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
        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
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
    <h2>Control Your Device, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>

    <div class="status">
        <p>Current Device Status: <span><?php echo $device_status; ?></span></p>
    </div>

    <form method="post">
        <input type="submit" name="toggle" class="btn" value="Toggle Device Status">
    </form>

    <a href="dashboard.php">Back to Dashboard</a>
    <a href="logout.php">Logout</a>
</div>

</body>
</html>
