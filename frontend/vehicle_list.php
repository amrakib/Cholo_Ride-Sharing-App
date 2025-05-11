<?php
session_start();
include 'connection.php';

if (!isset($_SESSION["User_ID"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["User_ID"];

$sql = "SELECT * FROM private_vehicle WHERE owner_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$vehicles = [];
while ($row = $result->fetch_assoc()) {
    $vehicles[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Vehicles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <style>
    body {
  background-image: linear-gradient(220deg, #fbe4d6 0%, #8fd3f4);
  background-attachment: fixed;
}
  </style>
</head>
<body>
     <!-- navbar -->
     <div class=" ps-3 pe-3">
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
<div class="container mt-5">
    <h2 class="text-center">My Registered Vehicles</h2>
    <hr>

    <?php if (count($vehicles) > 0): ?>
        <table class="table table-bordered text-center table-hover table-striped ">
            <thead class="table-dark">
                <tr>
                    <th>Vehicle Number</th>
                    <th>Model Name</th>
                    <th>License Number</th>
                    <th>Type</th>
                    <th>Capacity</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vehicles as $v): ?>
                    <tr>
                        <td><?= htmlspecialchars($v['Vehicle_Number']) ?></td>
                        <td><?= htmlspecialchars($v['Model_Name']) ?></td>
                        <td><?= htmlspecialchars($v['License_Number']) ?></td>
                        <td><?= htmlspecialchars($v['Vehicle_Type']) ?></td>
                        <td><?= htmlspecialchars($v['Capacity']) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
<div class="d-flex flex-row justify-content-center mt-3 ">
    <a href="edit_vehicle.php" class="btn btn-outline-danger me-3">Edit Vehicle</a>

        <a href="add_vehicle.php" class="btn btn-outline-success ">Add Vehicle</a>
        
        </div>

    <?php else: ?>
        <div class="alert alert-warning d">No registered vehicle found.</div>
        <div class="d-flex flex-row justify-content-center mt-3 ">
            
        <a href="add_vehicle.php" class="btn btn-outline-success ">Add Vehicle</a>
        </div>
    <?php endif ?>
</div>
</body>
</html>