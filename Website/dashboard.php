<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Home Dashboard</title>
</head>
<body>
    <h2>Welcome to the Smart Home Dashboard</h2>
    <a href="index.html">Go to LED Control</a>
    <a href="logout.php">Logout</a>
</body>
</html>
