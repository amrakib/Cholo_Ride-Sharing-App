<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "database_schema";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$student_id = $_POST['student_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$semester = $_POST['semester'];
$department = $_POST['department'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$phone_number = $_POST['phone_number'];
$password = $_POST['password'];

$scanned_id_path = null;
if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] == 0) {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["profilePicture"]["name"]);
    move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $targetFile);
    $scanned_id_path = $targetFile;
}

$sql = "INSERT INTO User (Student_ID, Name, Gsuite_Email, Semester, Department, Thana, Phone_Number, Password, Address, Gender, Scanned_ID)
VALUES (?, ?, ?, ?, ?, NULL, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssss", $student_id, $name, $email, $semester, $department, $phone_number, $password, $address, $gender, $scanned_id_path);

if ($stmt->execute()) {
  echo "Registration successful!";
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>