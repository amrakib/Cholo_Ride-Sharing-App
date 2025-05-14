<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: manage_users.php");
    exit();
}

$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_key = $_POST['admin_key'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check_query = "SELECT * FROM Admin WHERE Gsuite_Email = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $check_result = $stmt->get_result();

    if ($check_result->num_rows > 0) {
        $error = "Admin with this email already exists!";
    } else {
        $insert_query = "INSERT INTO Admin (Admin_Key, Gsuite_Email, Password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("sss", $admin_key, $email, $password);
        if ($stmt->execute()) {
            $success = "Admin added successfully!";
        } else {
            $error = "Failed to add admin.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4 rounded-4">
        <h4 class="mb-4 text-primary">Add New Admin</h4>
        
        <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" class="row g-3">
            <div class="col-md-6">
                <label for="admin_key" class="form-label">Admin Key</label>
                <input type="text" class="form-control" name="admin_key" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Gsuite Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="col-md-12">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control" name="password" required>
            </div>
            <div class="col-12 d-flex justify-content-between">
                <a href="admin_index.php" class="btn btn-outline-secondary">Back to Dashboard</a>
                <button type="submit" class="btn btn-primary">Add Admin</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>