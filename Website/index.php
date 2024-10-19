<?php
session_start();

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Home Control</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    /* Header */
    header {
        background-color: #333;
        color: #fff;
        padding: 20px;
        text-align: center;
    }

    header h1 {
        margin: 0;
        font-size: 2.5em;
    }

    /* Banner */
    .banner {
        background-image: url('images/smart-home-banner.jpg');
        background-size: cover;
        background-position: center;
        height: 400px;
        position: relative;
        text-align: center;
        color: #fff;
    }

    .banner h2 {
        position: absolute;
        bottom: 50px;
        left: 0;
        right: 0;
        font-size: 3em;
        text-shadow: 2px 2px 4px #000;
    }

    /* Main Content */
    .content {
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
        padding-bottom: 100px; /* Add padding to prevent overlap with footer */
    }

    .content h2 {
        font-size: 2em;
        margin-bottom: 10px;
    }

    .content p {
        font-size: 1.2em;
        line-height: 1.6;
    }

    /* LED Control Section */
    .led-control {
        text-align: center;
        margin-top: 30px;
    }

    .led-control button {
        padding: 10px 20px;
        margin: 10px;
        font-size: 1.2em;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .led-control button:hover {
        background-color: #45a049;
    }

    .led-status {
        margin-top: 20px;
        font-size: 1.5em;
    }

    .led-image img {
        width: 100px;
        height: auto;
        margin-top: 20px;
    }

    /* Footer */
    footer {
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 10px;
        position: fixed;
        width: 100%;
        bottom: 0;
        left: 0;
    }

    /* Logout button */
    .logout-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        padding: 10px 20px;
        background-color: #f44336;
        color: #fff;
        border: none;
        cursor: pointer;
        font-size: 1em;
    }

    .logout-btn:hover {
        background-color: #e53935;
    }
</style>
</head>
<body>
    <!-- Header Section -->
    <header>
        <h1>Smart Home Automation</h1>
        <!-- Logout Button -->
        <form action="logout.php" method="post">
            <button class="logout-btn" type="submit">Logout</button>
        </form>
    </header>

    <!-- Banner Section -->
    <div class="banner">
        <h2>Control Your Home from Anywhere</h2>
    </div>

    <!-- Main Content Section -->
    <div class="content">
        <h2>About the Project</h2>
        <p>
            Welcome to the Smart Home Automation Project! This IoT project is designed to give you full control over your home's lighting, security, and environment. 
            Our system allows you to manage your smart devices effortlessly using voice commands, Bluetooth, and automated triggers.
        </p>

        <!-- LED Control Section -->
        <div class="led-control">
            <h2>LED Control</h2>
            <button id="led-on" onclick="changeLedStatus('ON')">Turn LED ON</button>
            <button id="led-off" onclick="changeLedStatus('OFF')">Turn LED OFF</button>

            <div class="led-status">
                Current LED Status: <span id="led-status">Unknown</span>
            </div>

            <div class="led-image">
                <img id="bulb-image" src="images/bulb-off.png" alt="Bulb Image">
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 Smart Home Automation. All rights reserved.</p>
    </footer>

    <!-- JavaScript -->
    <script>
        function changeLedStatus(status) {
            const formData = new FormData();
            formData.append('status', status);

            fetch('update_led.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                fetchLedStatus(); // Refresh the LED status
            })
            .catch(error => console.error('Error:', error));
        }

        function fetchLedStatus() {
            fetch('update_led.php')
                .then(response => response.text())
                .then(data => {
                    const status = data.trim() === '1' ? 'ON' : 'OFF'; // Assuming '1' means ON, '0' means OFF
                    document.getElementById('led-status').innerText = status;
                    updateBulbImage(status); // Update bulb image based on the status
                })
                .catch(error => console.error('Error:', error));
        }

        function updateBulbImage(status) {
            const bulbImage = document.getElementById('bulb-image');
            bulbImage.src = status === 'ON' ? 'images/bulb-on.png' : 'images/bulb-off.png'; // Update image based on status
        }

        // Fetch LED status on page load
        window.onload = function() {
            fetchLedStatus();
        };
    </script>
</body>
</html>
