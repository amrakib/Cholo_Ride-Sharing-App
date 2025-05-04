<?php
session_start();
if (!isset($_SESSION['admin'])) header("Location: admin_login.php");
include 'db_connection.php';

if (!isset($_GET['id'])) {
    header("Location: manage_users.php");
    exit();
}

$student_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("UPDATE User SET Name=?, Gsuite_Email=?, Phone_Number=?, Gender=?, Address=? WHERE Student_ID=?");
    $stmt->bind_param("ssssss", $name, $email, $phone, $gender, $address, $student_id);
    $stmt->execute();

    header("Location: manage_users.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM User WHERE Student_ID = ?");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Edit User - <?= htmlspecialchars($user['Name']) ?></h3>
    <form method="POST">
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" value="<?= $user['Name'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="<?= $user['Gsuite_Email'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Phone:</label>
            <input type="text" name="phone" class="form-control" value="<?= $user['Phone_Number'] ?>">
        </div>
        <div class="mb-3">
            <label>Gender:</label>
            <select name="gender" class="form-control">
                <option value="Male" <?= $user['Gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
                <option value="Female" <?= $user['Gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
                <option value="Other" <?= $user['Gender'] === 'Other' ? 'selected' : '' ?>>Other</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Address:</label>
            <textarea name="address" class="form-control"><?= $user['Address'] ?></textarea>
        </div>
        <button class="btn btn-primary">Save Changes</button>
        <a href="manage_users.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>