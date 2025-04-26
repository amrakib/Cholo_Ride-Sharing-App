<?php

$host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "database_schema";

$connection = mysqli_connect(hostname: $host, username: $db_user, password: $db_password, database: $db_name);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}   

$name = $_POST['name'];
$email = $_POST['email'];
$student_id = $_POST['student_id'];
$department = $_POST['department'];
$semester = $_POST['semester'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$password = $_POST['password']; 

?>