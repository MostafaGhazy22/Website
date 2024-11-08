<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "User not logged in.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the value from the POST request
    $value = isset($_POST['value']) ? $_POST['value'] : '';

    // Validate the value (you can add more validation if necessary)
    if ($value === '') {
        echo "Invalid value.";
        exit();
    }

    // Specify the file path based on the user's session ID
    $file_path = 'user_files/gas_status_' . $_SESSION['user_id'] . '.txt';

    // Write the value to the file
    if (file_put_contents($file_path, $value) !== false) {
        echo "Value written successfully.";
    } else {
        echo "Error writing to file.";
    }
} else {
    echo "Invalid request method.";
}
?>
