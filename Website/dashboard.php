<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to the Smart Home Dashboard</h1>
    <p>You are logged in!</p>
    <a href="index.html">Control Your Home</a>
    <a href="logout.php">Logout</a>
</body>
</html>
