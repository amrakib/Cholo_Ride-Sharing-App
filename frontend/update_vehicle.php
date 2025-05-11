<?php
session_start();
include 'connection.php';

if (!isset($_SESSION["User_ID"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["User_ID"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $original_vehicle_number = $_POST['original_vehicle_number'];
    $new_vehicle_number = $_POST['vehicle_number'];
    $model_name = $_POST['model_name'];
    $capacity = $_POST['capacity'];

    $sql = "UPDATE private_vehicle 
            SET vehicle_number = ?, model_name = ?, capacity = ?
            WHERE vehicle_number = ? AND owner_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiss", $new_vehicle_number, $model_name, $capacity, $original_vehicle_number, $user_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Vehicle updated successfully.";
        header("Location: vehicle_list.php");
        exit();
    } else {
        $_SESSION['error'] = "Error updating vehicle: " . $stmt->error;
    }

    header("Location: edit_vehicle.php");
    exit();
}
?>