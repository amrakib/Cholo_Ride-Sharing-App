<?php
session_start();
include 'connection.php';

if (!isset($_SESSION["Student_ID"])) {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION["Student_ID"];

$sql = "SELECT * FROM User WHERE Student_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Profile - Cholo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f8f9fa;
    }
    .profile-card {
      max-width: 600px;
      margin: 50px auto;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      background-color: white;
    }
    .profile-title {
      font-weight: bold;
      margin-bottom: 20px;
    }
    .profile-info p {
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="profile-card">
      <h3 class="profile-title text-center">User Profile</h3>
      <div class="profile-info">
        <p><strong>Name:</strong> <?php echo htmlspecialchars($user['Name']); ?></p>
        <p><strong>Student ID:</strong> <?php echo htmlspecialchars($user['Student_ID']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['Gsuite_Email']); ?></p>
        <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($user['Phone_Number']); ?></p>
        <p><strong>Gender:</strong> <?php echo htmlspecialchars($user['Gender']); ?></p>
        <p><strong>Department:</strong> <?php echo htmlspecialchars($user['Department']); ?></p>
        <p><strong>Semester:</strong> <?php echo htmlspecialchars($user['Semester']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($user['Address']); ?></p>
        <p><strong>Thana:</strong> <?php echo htmlspecialchars($user['Thana']); ?></p>
      </div>
      <div class="text-center mt-4">
        <a href="landing_page.php" class="btn btn-secondary">Back to Home</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </div>

</body>
</html>
