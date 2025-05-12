<?php
include 'db_connection.php';
session_start();

$user_id = $_SESSION['User_ID'];

$query = "SELECT * FROM Notifications WHERE User_ID = $user_id ORDER BY Created_At DESC";
$result = mysqli_query($conn, $query);

// Mark as read
mysqli_query($conn, "UPDATE Notifications SET Status = 'Read' WHERE User_ID = $user_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h3>Your Notifications</h3>
    <ul class="list-group">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <li class="list-group-item"><?= htmlspecialchars($row['Message']) ?> <br><small class="text-muted"><?= $row['Created_At'] ?></small></li>
        <?php endwhile; ?>
    </ul>
</body>
</html>