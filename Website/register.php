<?php
<<<<<<< HEAD
// Database connection
$conn = new mysqli('ftpupload.net', 'if0_37492642', 'M1o1s1t1', 'if0_37492642_iot');
=======
$servername = "sql112.infinityfree.com"; // Use your InfinityFree database details
$username = "if0_37492642";
$password = "M1o1s1t1";
$dbname = "IOT";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
>>>>>>> 1fbd542c0d0ce3c2b2f1a4059fe72bf85c2dd022

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

<<<<<<< HEAD
// Registration logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if user already exists
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "User already exists!";
    } else {
        // Insert new user
        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            header("Location: login.html");
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
=======
// Process registration form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // Insert data into database
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        header("Location: login.html"); // Redirect to login page after registration
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

>>>>>>> 1fbd542c0d0ce3c2b2f1a4059fe72bf85c2dd022
$conn->close();
?>
