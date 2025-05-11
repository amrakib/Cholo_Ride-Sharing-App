<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehicle_number = $_POST['vehicle_number'] ?? '';

    if ($vehicle_number) {
        $stmt = $conn->prepare("DELETE FROM private_vehicle WHERE Vehicle_Number = ?");
        $stmt->bind_param("s", $vehicle_number);
        $stmt->execute();
    }
}

header("Location: vehicle_list.php");
exit();
?>