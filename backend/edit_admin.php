<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db_connection.php';

$admin_email = $_SESSION['admin'];

$stmt = $conn->prepare("SELECT * FROM Admin WHERE Gsuite_Email = ?");
$stmt->bind_param("s", $admin_email);
$stmt->execute();
$admin = $stmt->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];

    $update_stmt = $conn->prepare("UPDATE Admin SET Gsuite_Email = ?, Password = ? WHERE Admin_Key = ?");
    $update_stmt->bind_param("sss", $new_email, $new_password, $admin['Admin_Key']);
    $update_stmt->execute();

    $_SESSION['admin'] = $new_email;
    header("Location: admin_index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Admin Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .card {
            max-width: 500px;
            margin: 80px auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            background-color: #ffffff;
        }
        .form-label {
            font-weight: 600;
        }
        .btn-custom {
            width: 100%;
            padding: 10px;
            font-weight: 500;
            border-radius: 10px;
        }
        h3 {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<div class="card">
    <h3>Edit Admin Information</h3>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($admin['Gsuite_Email']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="text" name="password" class="form-control" value="<?= htmlspecialchars($admin['Password']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary btn-custom">Save Changes</button>
        <a href="admin_index.php" class="btn btn-outline-secondary btn-custom mt-2">Cancel</a>
    </form>
</div>

</body>
</html>