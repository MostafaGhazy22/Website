<?php
session_start();
require 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Define paths for the user's LED, fan, and temperature sensor status files
$led_file_path = 'user_files/device_status_' . $_SESSION['user_id'] . '.txt';
$fan_file_path = 'user_files/fan_status_' . $_SESSION['user_id'] . '.txt';
$temp_file_path = 'user_files/gas_status_' . $_SESSION['user_id'] . '.txt';  // Assuming the temperature file is stored here

// Read the current LED status; default to '0' if the file doesn't exist
$current_led_status = file_exists($led_file_path) ? trim(file_get_contents($led_file_path)) : '0';
$led_status = ($current_led_status == "1") ? "ON" : "OFF";

// Read the current fan status; default to '0' if the file doesn't exist
$current_fan_status = file_exists($fan_file_path) ? trim(file_get_contents($fan_file_path)) : '0';
$fan_status = ($current_fan_status == "1") ? "ON" : "OFF";

// Read the current temperature value; default to '0' if the file doesn't exist
$temp_value = file_exists($temp_file_path) ? trim(file_get_contents($temp_file_path)) : '0';
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
            max-width: 100%;
            width: 700px;
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
            padding: 10px;
            background: #007bff;
            color: white;
            border-radius: 5px;
            transition: background 0.3s;
        }
        a:hover {
            background: #0056b3;
        }
        .gauge {
            margin: 20px auto;
            width: 300px;
            height: 150px;
        }
        @media (max-width: 600px) {
            .container {
                width: 95%;
            }
            .status {
                font-size: 20px;
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container">
    <h1>User Dashboard</h1>

    <!-- Display LED Status -->
    <p class="status">LED Status: <span><?php echo $led_status; ?></span></p>

    <!-- Display Fan Status -->
    <p class="status">Fan Status: <span><?php echo $fan_status; ?></span></p>

    <!-- Display Temperature Sensor -->
    <p class="status">Temperature: <span id="tempValue"><?php echo $temp_value; ?>°C</span></p>

    <!-- Gauge for Temperature -->
    <canvas id="tempGauge" class="gauge"></canvas>

    <!-- Links to control the devices -->
    <a href="control.php?device=led">Toggle LED</a>
    <a href="control.php?device=fan">Toggle Fan</a>
    <a href="logout.php">Logout</a>
</div>

<script>
    const canvas = document.getElementById('tempGauge');
    const ctx = canvas.getContext('2d');
    
    function drawGauge(value) {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.fillStyle = '#e0e0e0';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        const gaugeWidth = Math.min((value / 100) * canvas.width, canvas.width);  // Adjusting max value for temperature
        ctx.fillStyle = '#00BCD4';
        ctx.fillRect(0, 0, gaugeWidth, canvas.height);
        ctx.fillStyle = '#333';
        ctx.font = '20px Arial';
        ctx.fillText(`${value}°C`, canvas.width / 2 - 20, canvas.height / 2 + 7);
    }

    drawGauge(<?php echo $temp_value; ?>);

    function updateTempValue() {
        $.ajax({
            url: 'read_gas_status.php', // Replace with appropriate file if needed
            method: 'GET',
            success: function(data) {
                $('#tempValue').text(data + "°C");
                drawGauge(data);
            },
            error: function() {
                $('#tempValue').text("Error fetching data.");
            }
        });
    }

    setInterval(updateTempValue, 2000);
</script>

</body>
</html>
