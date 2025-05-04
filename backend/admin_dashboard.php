<?php
session_start();
if (!isset($_SESSION["User_ID"]) || $_SESSION["User_Role"] !== "admin") {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f0f2f5;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }
    .dashboard-box {
      background: white;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
      width: 90%;
      max-width: 700px;
    }
  </style>
</head>
<body>

<div class="dashboard-box text-center">
  <h2>Welcome, Admin <?php echo htmlspecialchars($_SESSION["Student_Name"]); ?>!</h2>
  <p>You are in the admin dashboard.</p>
  <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
</div>

</body>
</html>