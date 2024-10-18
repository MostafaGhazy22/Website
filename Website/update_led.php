<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status'] === 'ON' ? '1' : '0';
    file_put_contents('led-status.txt', $status);
    echo "LED status updated";
} else {
    $status = file_get_contents('led-status.txt');
    echo $status;
}
?>
