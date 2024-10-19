<?php
session_start();

// Connect to the database
$servername = "sql112.infinityfree.com"; // Replace with your actual database server name
$username = "if0_37492642"; // Replace with your actual database username
$password = "M1o1s1t1"; // Replace with your actual database password
$dbname = "if0_37492642_iot"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch the user from the database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch user data
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set session variables for the logged-in user
            $_SESSION['email'] = $user['email'];

            // Redirect to the index.php page (main page)
            header("Location: index.php");
            exit(); // Ensure no further code is executed after the redirect
        } else {
            // Password is incorrect
            echo "Invalid email or password.";
        }
    } else {
        // No user found with this email
        echo "Invalid email or password.";
    }
}

$conn->close();
?>
