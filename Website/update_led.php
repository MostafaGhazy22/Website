<?php
// File to manage LED control
$status_file = "led-status.txt";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update the status file
    $status = $_POST['status'] === 'ON' ? '1' : '0';
    file_put_contents($status_file, $status);
    echo $status;
} else {
    // Read the current status
    echo file_get_contents($status_file);
}
?>
