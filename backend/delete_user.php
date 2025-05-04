<?php
session_start();
if (!isset($_SESSION['admin'])) header("Location: admin_login.php");
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM User WHERE Student_ID = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
}

header("Location: manage_users.php");
exit();