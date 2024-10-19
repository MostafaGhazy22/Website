<?php
session_start();  // Start the session to check if the user is logged in
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IoT Project - Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding-top: 50px;
        }
        h1 {
            color: #333;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        a {
            display: block;
            margin: 10px 0;
            padding: 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Welcome to the IoT Control System</h1>

    <?php
    // Check if the user is logged in by checking session variable 'user_id'
    if (isset($_SESSION['user_id'])) {
        // If logged in, display links to the dashboard and logout
        echo "<p>You are logged in as User ID: " . $_SESSION['user_id'] . "</p>";
        echo "<a href='dashboard.php'>Go to Dashboard</a>";
        echo "<a href='logout.php'>Logout</a>";
    } else {
        // If not logged in, display links to login and register
        echo "<a href='login.php'>Login</a>";
        echo "<a href='register.php'>Register</a>";
    }
    ?>
</div>

</body>
</html>
