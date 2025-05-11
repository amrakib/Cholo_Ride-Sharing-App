<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION["User_ID"])) {
    header("Location: index.php");
    exit();
}

$loggedInID = $_SESSION["User_ID"];
$dateFilter = mysqli_real_escape_string($conn, $_GET['date'] ?? '');
$statusFilter = mysqli_real_escape_string($conn, $_GET['status'] ?? '');

$filterSQL = "";
if (!empty($dateFilter)) $filterSQL .= " AND t.Date = '$dateFilter'";
if (!empty($statusFilter)) $filterSQL .= " AND t.trip_status = '$statusFilter'";

$ownTripsQuery = "
    SELECT t.*, u.Name, pv.Vehicle_Type, pv.Model_Name, pv.Vehicle_Number
    FROM Trips t
    LEFT JOIN User u ON t.Student_ID = u.Student_ID
    LEFT JOIN Private_Vehicle pv ON pv.Owner_ID = t.Student_ID
    WHERE t.Student_ID = '$loggedInID' $filterSQL
    ORDER BY t.Date DESC, t.Time DESC
";

$joinedTripsQuery = "
    SELECT t.*, u.Name, pv.Vehicle_Type, pv.Model_Name, pv.Vehicle_Number
    FROM Trips t
    JOIN Trip_Joiners tj ON t.Trip_ID = tj.Trip_ID
    LEFT JOIN User u ON t.Student_ID = u.Student_ID
    LEFT JOIN Private_Vehicle pv ON pv.Owner_ID = t.Student_ID
    WHERE tj.Student_ID = '$loggedInID' $filterSQL
    ORDER BY t.Date DESC, t.Time DESC
";

$ownTripsResult = mysqli_query($conn, $ownTripsQuery);
$joinedTripsResult = mysqli_query($conn, $joinedTripsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trip History</title>
    <link rel="stylesheet" href="css/trip_history.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
     <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7"
      crossorigin="anonymous"
    />
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
                <a class="nav-link " href="logout.php">Log Out</a>
              </li>
              <li class="nav-item pe-4 fs-5 fw-bold">
                <a class="nav-link " href="../backend/profile.php">Profile</a>
              </li>
            </ul>
          </div>
        </nav>
        </div>

<h1><i class="fas fa-route"></i> Trip History</h1>

<div class="filters">
    <form method="get">
        <input type="date" name="date" value="<?= htmlspecialchars($dateFilter) ?>">
        <select name="status">
            <option value="">All Status</option>
            <option value="Available" <?= $statusFilter === 'Available' ? 'selected' : '' ?>>Available</option>
            <option value="Completed" <?= $statusFilter === 'Completed' ? 'selected' : '' ?>>Completed</option>
            <option value="Cancelled" <?= $statusFilter === 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
        </select>
        <button type="submit"><i class="fas fa-filter"></i> Filter</button>
    </form>
</div>

<div class="button-group">
    <button onclick="window.print()" class="print-btn"><i class="fas fa-file-pdf"></i> Download / Print</button>
</div>

<h2><i class="fas fa-car-side"></i> Trips You Created</h2>
<div class="history-container">
    <?php if (mysqli_num_rows($ownTripsResult) === 0) { ?>
        <p>No trips found that you created.</p>
    <?php } else {
        while ($trip = mysqli_fetch_assoc($ownTripsResult)) { ?>
            <div class="history-card">
                <div class="badge <?= $trip['trip_status'] ?>"><?= $trip['trip_status'] ?></div>
                <strong>Trip ID:</strong> <?= $trip['Trip_ID'] ?><br>
                <strong>Rider:</strong> <?= $trip['Name'] ?><br>
                <strong>Vehicle:</strong> <?= $trip['Vehicle_Type'] ?> - <?= $trip['Model_Name'] ?> (<?= $trip['Vehicle_Number'] ?>)<br>
                <strong>From:</strong> <?= $trip['where_loc'] ?> <strong>To:</strong> <?= $trip['to_loc'] ?><br>
                <strong>Date:</strong> <?= $trip['Date'] ?> <strong>Time:</strong> <?= $trip['Time'] ?><br>
                <strong>Fare:</strong> <?= $trip['Fare'] ?> BDT<br>
                <strong>Mode:</strong> <?= $trip['Mode_of_Commute'] ?><br>
            </div>
    <?php } } ?>
</div>

<h2><i class="fas fa-users"></i> Trips You Joined</h2>
<div class="history-container">
    <?php if (mysqli_num_rows($joinedTripsResult) === 0) { ?>
        <p>No trips found that you joined.</p>
    <?php } else {
        while ($trip = mysqli_fetch_assoc($joinedTripsResult)) { ?>
            <div class="history-card">
                <div class="badge <?= $trip['trip_status'] ?>"><?= $trip['trip_status'] ?></div>
                <strong>Trip ID:</strong> <?= $trip['Trip_ID'] ?><br>
                <strong>Rider:</strong> <?= $trip['Name'] ?><br>
                <strong>Vehicle:</strong> <?= $trip['Vehicle_Type'] ?> - <?= $trip['Model_Name'] ?> (<?= $trip['Vehicle_Number'] ?>)<br>
                <strong>From:</strong> <?= $trip['where_loc'] ?> <strong>To:</strong> <?= $trip['to_loc'] ?><br>
                <strong>Date:</strong> <?= $trip['Date'] ?> <strong>Time:</strong> <?= $trip['Time'] ?><br>
                <strong>Fare:</strong> <?= $trip['Fare'] ?> BDT<br>
                <strong>Mode:</strong> <?= $trip['Mode_of_Commute'] ?><br>
            </div>
    <?php } } ?>
</div>
<script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
</body>
</html>