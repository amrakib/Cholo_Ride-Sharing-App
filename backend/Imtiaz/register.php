<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "database_schema";

$conn = new mysqli(hostname: $servername, username: $username, password: $password, database: $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$student_id = $_POST['student_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$semester = $_POST['semester'];
$department = $_POST['department'];
$thana = $_POST['thana'];
$phone = $_POST['phone'];
$password = password_hash(password: $_POST['password'], algo: PASSWORD_BCRYPT);

$sql_user = "INSERT INTO User (Student_ID, Name, `G-suit Email`, Semester, Department, Thana)
VALUES ('$student_id', '$name', '$email', '$semester', '$department', '$thana')";

if ($conn->query(query: $sql_user) === TRUE) {
  $sql_phone = "INSERT INTO User_Phone_Numbers (Student_ID, Phone_number)
  VALUES ('$student_id', '$phone')";

  if ($conn->query(query: $sql_phone) === TRUE) {
    echo "Registration successful!";
  } 
  
  else {
    echo "Error saving phone number: " . $conn->error;
  }
} 

else {
  echo "Error: " . $conn->error;
}

$conn->close();
?>