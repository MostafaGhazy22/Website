<?php
// Database connection
$conn = new mysqli('ftpupload.net', 'if0_37492642', 'M1o1s1t1', 'if0_37492642_iot');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
$conn->close();
?>
