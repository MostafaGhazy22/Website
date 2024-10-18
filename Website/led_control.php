<?php
$statusFile = 'led-status.txt';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'];
    $value = ($status === 'ON') ? '1' : '0';
    file_put_contents($statusFile, $value);
    echo 'LED status updated to ' . $value;
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (file_exists($statusFile)) {
        $status = trim(file_get_contents($statusFile));
        echo $status;
    } else {
        echo '0'; // Default status if the file does not exist
    }
    exit;
}
?>
