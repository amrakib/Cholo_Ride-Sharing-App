<?php
session_start();

if (!isset($_SESSION['admin'])) header("Location: admin_index.php");
include 'db_connection.php';

$users = $conn->query("SELECT * FROM User");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .user-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
        }
        .scanned-id-img {
            width: 80px;
            height: auto;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h3 class="mb-4">User Management</h3>
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th>Profile Pic</th>
                <th>Student ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Scanned ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php while ($row = $users->fetch_assoc()): ?>
                <tr>
                    <td>
                        <?php
                        $profilePicPath = 'profile_pic/' . basename($row['Profile_Pic']);
                        if (!empty($row['Profile_Pic']) && file_exists($profilePicPath)):
                        ?>
                            <img src="<?= $profilePicPath ?>" alt="Profile" class="user-img">
                        <?php else: ?>
                            <img src="assets/default_profile.png" alt="Default" class="user-img">
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($row['Student_ID']) ?></td>
                    <td><?= htmlspecialchars($row['Name']) ?></td>
                    <td><?= htmlspecialchars($row['Gsuite_Email']) ?></td>
                    <td><?= htmlspecialchars($row['Phone_Number']) ?></td>
                    <td><?= htmlspecialchars($row['Gender']) ?></td>
                    <td>
                        <?php
                        $scannedIDPath = 'uploads/' . basename($row['Scanned_ID']);
                        if (!empty($row['Scanned_ID']) && file_exists($scannedIDPath)):
                        ?>
                            <a href="<?= $scannedIDPath ?>" target="_blank">
                                <img src="<?= $scannedIDPath ?>" alt="Scanned ID" class="scanned-id-img">
                            </a>
                        <?php else: ?>
                            <span class="text-muted">N/A</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="edit_user.php?id=<?= urlencode($row['Student_ID']) ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="delete_user.php?id=<?= urlencode($row['Student_ID']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div><a href="admin_index.php" class="btn btn-secondary">Back to Dashboard</a></div>
    <br>
    <div><a href="edit_admin.php" class="btn btn-warning w-100 mb-3">Edit Admin Info</a></div>
</div>
</body>
</html>