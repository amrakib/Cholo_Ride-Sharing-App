<?php
include 'db_connection.php';
session_start();

$user_id = $_SESSION['User_ID'];

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action === 'unread') {
        mysqli_query($conn, "UPDATE Notifications SET Status = 'Unread' WHERE User_ID = $user_id");
    } elseif ($action === 'clear') {
        mysqli_query($conn, "DELETE FROM Notifications WHERE User_ID = $user_id");
    }
    header("Location: notifications.php");
    exit();
}

$query = "SELECT * FROM Notifications WHERE User_ID = $user_id ORDER BY Created_At DESC";
$result = mysqli_query($conn, $query);

mysqli_query($conn, "UPDATE Notifications SET Status = 'Read' WHERE User_ID = $user_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Notifications</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
         body {
  background-image: linear-gradient(220deg, #fbe4d6 0%, #8fd3f4);
  background-attachment: fixed;

}
    </style>
</head>
<body class="bg-light">
    <!-- navbar -->
     <div class=" ps-3 pe-3 mb-5">
     <nav class="navbar navbar-expand-lg">
          <a class="navbar-brand fw-bolder fs-3" href="../backend/landing_page.php" style="color:white; margin-left: 4rem;">CHOLO</a>
          <button
            class="navbar-toggler bg-light"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon rounded"></span>
          </button>
          <div class="collapse navbar-collapse me-3" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0 ms-auto  ">
              <li class="nav-item pe-4 fs-5 fw-bold ">
                <a class="nav-link " aria-current="page" href="../backend/landing_page.php">Home</a>
              </li>
              <li class="nav-item pe-4 fs-5 fw-bold">
                <a class="nav-link " href="../backend/logout.php">Log Out</a>
              </li>
              <li class="nav-item pe-4 fs-5 fw-bold">
                <a class="nav-link " href="../backend/profile.php">Profile</a>
              </li>
            </ul>
          </div>
        </nav>
        </div>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0"><i class="bi bi-bell-fill text-primary"></i> Notifications</h3>
        <div>
            <a href="?action=unread" class="btn btn-outline-warning btn-sm me-2">
                <i class="bi bi-eye-slash"></i> Mark All as Unread
            </a>
            <a href="?action=clear" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to clear all notifications?');">
                <i class="bi bi-trash3"></i> Clear All
            </a>
        </div>
    </div>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="list-group shadow-sm">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <p class="mb-1"><?= htmlspecialchars($row['Message']) ?></p>
                        <small class="text-muted"><?= date('M d, Y h:i A', strtotime($row['Created_At'])) ?></small>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">
            <i class="bi bi-inbox"></i> You have no notifications at the moment.
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>