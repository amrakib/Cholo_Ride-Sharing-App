<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "database_schema";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// ======================
// Collecting form data
// ======================

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
if (isset($_FILES['scanned_id']) && $_FILES['scanned_id']['error'] == 0) {
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $scanned_id_path = $uploadDir . basename($_FILES["scanned_id"]["name"]);
    move_uploaded_file($_FILES["scanned_id"]["tmp_name"], $scanned_id_path);
}

// ======================
// Preparing SQL statement and binding parameters
// ======================

$sql = "INSERT INTO User (Student_ID, Name, Gsuite_Email, Semester, Department, Thana, Phone_Number, Password, Address, Gender, Scanned_ID)
VALUES (?, ?, ?, ?, ?, NULL, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param(
    "ssssssssss", // "ssssssssss" means all parameters are strings
    $student_id, 
    $name, 
    $email, 
    $semester, 
    $department, 
    $phone_number, 
    $password, 
    $address, 
    $gender, 
    $scanned_id_path
);

if ($stmt->execute()) {
    echo "✅ Registration successful!";
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
