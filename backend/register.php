<?php
// // For debugging 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "database_schema";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request method.");
}

// =======================
// Input Validation and Sanitization
// =======================
function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$required_fields = ['student_id', 'name', 'email', 'semester', 'department', 'thana', 'phone', 'password', 'address', 'gender'];

foreach ($required_fields as $field) {
    if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
        die("Error: Missing required field '$field'.");
    }
}

$student_id = clean_input($_POST['student_id']);
$name       = clean_input($_POST['name']);
$email      = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$semester   = clean_input($_POST['semester']);
$department = clean_input($_POST['department']);
$thana      = clean_input($_POST['thana']);
$phone      = clean_input($_POST['phone']);
$password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
$address    = clean_input($_POST['address']);
$gender     = clean_input($_POST['gender']);
$userStatus = "Available";

if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    die("Invalid email format.");
}

// =======================
// Handle File Uploads
// =======================
$profile_pic_path = null;
$scanned_id_path = null;

if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0){
    $uploadDir = "profile_pic/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $extension = pathinfo($_FILES["profile_pic"]["name"], PATHINFO_EXTENSION);
    $profile_pic_path = $uploadDir . $student_id . "_profile." . $extension;
    move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $profile_pic_path);
}

if (isset($_FILES['scanned_id']) && $_FILES['scanned_id']['error'] === 0){
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $extension = pathinfo($_FILES["scanned_id"]["name"], PATHINFO_EXTENSION);
    $scanned_id_path = $uploadDir . $student_id . "_id." . $extension;
    move_uploaded_file($_FILES["scanned_id"]["tmp_name"], $scanned_id_path);
}


// =======================
// SQL Insert with Prepared Statement
// =======================

$sql = "INSERT INTO User (Student_ID, Name, Gsuite_Email, Semester, Department, Thana, Phone_Number, Password, Address, Gender, profile_pic, Scanned_ID,UserStatus, Joined, Created)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,'Available', 'False','False')";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param(
    "ssssssssssss",
    $student_id,
    $name,
    $email,
    $semester,
    $department,
    $thana,
    $phone,
    $password,
    $address,
    $gender,
    $profile_pic_path,
    $scanned_id_path
);

if ($stmt->execute()){
    $_SESSION['registration_success'] = "";
    header("Location: index.php");
    exit();
}

else{
    echo "❌ Error: " . $stmt->error;
}

// =======================
// Cleanup
// =======================

$stmt->close();
$conn->close();
?>