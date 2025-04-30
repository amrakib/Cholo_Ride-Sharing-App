<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION["User_ID"])) {
  header("Location: index.php");
  exit();
}

$student_id = $_SESSION["User_ID"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $gender = $_POST['gender'];
  $department = $_POST['department'];
  $semester = $_POST['semester'];
  $address = $_POST['address'];
  $thana = $_POST['thana'];

  $sql = "UPDATE User SET Name = ?, Gsuite_Email = ?, Phone_Number = ?, Gender = ?, Department = ?, Semester = ?, Address = ?, Thana = ? WHERE Student_ID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssssssss", $name, $email, $phone, $gender, $department, $semester, $address, $thana, $student_id);
  $stmt->execute();

  if ($stmt->affected_rows > 0) {
    $success_msg = "Profile updated successfully.";
  } else {
    $error_msg = "Error updating profile. Please try again.";
  }
}

// Here I am Fetching  the user's current information

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
  <title>Edit Profile - Cholo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/profile_style.css">
</head>
<body>

  <div class="profile-card">
    <h3 class="profile-title">Edit Profile</h3>

    <?php if (isset($success_msg)): ?>
      <div class="alert alert-success">
        <?php echo $success_msg; ?>
      </div>
    <?php elseif (isset($error_msg)): ?>
      <div class="alert alert-danger">
        <?php echo $error_msg; ?>
      </div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($user['Name']); ?>" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['Gsuite_Email']); ?>" required>
      </div>

      <div class="mb-3">
        <label for="phone" class="form-label">Phone Number</label>
        <input type="text" id="phone" name="phone" class="form-control" value="<?php echo htmlspecialchars($user['Phone_Number']); ?>" required>
      </div>

      <div class="mb-3">
        <label for="gender" class="form-label">Gender</label>
        <select id="gender" name="gender" class="form-control" required>
          <option value="Male" <?php echo $user['Gender'] === 'Male' ? 'selected' : ''; ?>>Male</option>
          <option value="Female" <?php echo $user['Gender'] === 'Female' ? 'selected' : ''; ?>>Female</option>
          <option value="Other" <?php echo $user['Gender'] === 'Other' ? 'selected' : ''; ?>>Other</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="department" class="form-label">Department</label>
        <input type="text" id="department" name="department" class="form-control" value="<?php echo htmlspecialchars($user['Department']); ?>" required>
      </div>

      <div class="mb-3">
        <label for="semester" class="form-label">Semester</label>
        <input type="text" id="semester" name="semester" class="form-control" value="<?php echo htmlspecialchars($user['Semester']); ?>" required>
      </div>

      <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="text" id="address" name="address" class="form-control" value="<?php echo htmlspecialchars($user['Address']); ?>" required>
      </div>

      <div class="mb-3">
        <label for="thana" class="form-label">Thana</label>
        <input type="text" id="thana" name="thana" class="form-control" value="<?php echo htmlspecialchars($user['Thana']); ?>" required>
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary">Update Profile</button>
        <a href="profile.php" class="btn btn-secondary">Back to Profile</a>
      </div>
    </form>
  </div>

</body>
</html>