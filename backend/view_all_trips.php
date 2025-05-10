<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: manage_users.php");
    exit();
}

// Fetching trips(Completed, Cancelled, Available)

$query = "SELECT t.Trip_ID, t.Student_ID, t.where_loc, t.to_loc, t.Date, t.Time, t.trip_status, u.Name 
          FROM Trips t
          JOIN User u ON t.Student_ID = u.Student_ID
          WHERE t.trip_status IN ('Completed', 'Cancelled', 'Available')
          ORDER BY t.Date DESC, t.Time DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View All Trips</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3 class="mb-4">All Trips (Completed, Cancelled, Available)</h3>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Trip ID</th>
                <th>Student Name</th>
                <th>From</th>
                <th>To</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['Trip_ID']}</td>
                            <td>{$row['Name']}</td>
                            <td>{$row['where_loc']}</td>
                            <td>{$row['to_loc']}</td>
                            <td>{$row['Date']}</td>
                            <td>{$row['Time']}</td>
                            <td>{$row['trip_status']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>No trips found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="admin_index.php" class="btn btn-primary mt-3">Back to Dashboard</a>
</div>
</body>
</html>