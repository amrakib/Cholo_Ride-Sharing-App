<?php
session_start();
include '../frontend/connection.php';

// Redirect if not logged in
if (!isset($_SESSION["Student_ID"])) {
    header("Location: login.php");
    exit();
}

$loggedInID = $_SESSION["Student_ID"];

// Query for trips created by the user
$ownTripsQuery = "
    SELECT t.*, u.Name, pv.Vehicle_Type, pv.Model_Name, pv.Vehicle_Number
    FROM Trips t
    LEFT JOIN User u ON t.Student_ID = u.Student_ID
    LEFT JOIN Private_Vehicle pv ON pv.Owner_ID = t.Student_ID
    WHERE t.Student_ID = '$loggedInID'
";

// Query for trips joined by the user
$joinedTripsQuery = "
    SELECT t.*, u.Name, pv.Vehicle_Type, pv.Model_Name, pv.Vehicle_Number
    FROM Trips t
    JOIN Trip_Joiners tj ON t.Trip_ID = tj.Trip_ID
    LEFT JOIN User u ON t.Student_ID = u.Student_ID
    LEFT JOIN Private_Vehicle pv ON pv.Owner_ID = t.Student_ID
    WHERE tj.Student_ID = '$loggedInID'
";

// Execute both queries
$ownTripsResult = mysqli_query($conn, $ownTripsQuery);
$joinedTripsResult = mysqli_query($conn, $joinedTripsQuery);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Trip History</title>
    <link rel="stylesheet" href="trip_history.css">
</head>
<body>
    <h1>Trip History</h1>

    <h2>Trips You Created</h2>
    <div class="history-container">
        <?php while ($trip = mysqli_fetch_assoc($ownTripsResult)) { ?>
            <div class="history-card">
                <strong>Trip ID:</strong> <?= $trip['Trip_ID'] ?><br>
                <strong>Rider:</strong> <?= $trip['Name'] ?><br>
                <strong>Vehicle:</strong> <?= $trip['Vehicle_Type'] ?> - <?= $trip['Model_Name'] ?> (<?= $trip['Vehicle_Number'] ?>)<br>
                <strong>From:</strong> <?= $trip['where_loc'] ?> <strong>To:</strong> <?= $trip['to_loc'] ?><br>
                <strong>Date:</strong> <?= $trip['Date'] ?> <strong>Time:</strong> <?= $trip['Time'] ?><br>
                <strong>Fare:</strong> <?= $trip['Fare'] ?> BDT<br>
                <strong>Mode:</strong> <?= $trip['Mode_of_Commute'] ?><br>
            </div>
        <?php } ?>
    </div>

    <h2>Trips You Joined</h2>
    <div class="history-container">
        <?php while ($trip = mysqli_fetch_assoc($joinedTripsResult)) { ?>
            <div class="history-card">
                <strong>Trip ID:</strong> <?= $trip['Trip_ID'] ?><br>
                <strong>Rider:</strong> <?= $trip['Name'] ?><br>
                <strong>Vehicle:</strong> <?= $trip['Vehicle_Type'] ?> - <?= $trip['Model_Name'] ?> (<?= $trip['Vehicle_Number'] ?>)<br>
                <strong>From:</strong> <?= $trip['where_loc'] ?> <strong>To:</strong> <?= $trip['to_loc'] ?><br>
                <strong>Date:</strong> <?= $trip['Date'] ?> <strong>Time:</strong> <?= $trip['Time'] ?><br>
                <strong>Fare:</strong> <?= $trip['Fare'] ?> BDT<br>
                <strong>Mode:</strong> <?= $trip['Mode_of_Commute'] ?><br>
            </div>
        <?php } ?>
    </div>
</body>
</html>