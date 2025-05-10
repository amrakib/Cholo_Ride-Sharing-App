<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_index.php");
    exit();
}

$query = "SELECT t.Trip_ID, t.Student_ID, u.Name AS Student_Name, t.where_loc, t.to_loc, t.Date, t.Time, t.Fare, t.trip_status, t.Capacity, t.Used_capacity 
          FROM Trips t
          JOIN User u ON t.Student_ID = u.Student_ID";
$result = mysqli_query($conn, $query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_trip'])) {
        $trip_id = mysqli_real_escape_string($conn, $_POST['trip_id']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        $capacity = mysqli_real_escape_string($conn, $_POST['capacity']);
        
        $update_query = "UPDATE Trips 
                         SET trip_status = '$status', Capacity = $capacity 
                         WHERE Trip_ID = $trip_id";
                         
        if (mysqli_query($conn, $update_query)) {
            echo "<div class='alert alert-success'>Trip updated successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error updating trip: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Trips - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3 class="mb-4">Manage Trips</h3>
    
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Trip ID</th>
                    <th>Student Name</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Capacity</th>
                    <th>Used Capacity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $row['Trip_ID'] ?></td>
                        <td><?= htmlspecialchars($row['Student_Name']) ?></td>
                        <td><?= htmlspecialchars($row['where_loc']) ?></td>
                        <td><?= htmlspecialchars($row['to_loc']) ?></td>
                        <td><?= $row['Date'] ?></td>
                        <td><?= $row['Time'] ?></td>
                        <td><?= $row['trip_status'] ?></td>
                        <td><?= $row['Capacity'] ?></td>
                        <td><?= $row['Used_capacity'] ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['Trip_ID'] ?>">Edit</button>
                        </td>
                    </tr>

                    <!-- Modal for editing trip -->
                    <div class="modal fade" id="editModal<?= $row['Trip_ID'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $row['Trip_ID'] ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel<?= $row['Trip_ID'] ?>">Edit Trip - <?= $row['Trip_ID'] ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="">
                                    <div class="modal-body">
                                        <input type="hidden" name="trip_id" value="<?= $row['Trip_ID'] ?>">

                                        <div class="mb-3">
                                            <label for="status" class="form-label">Trip Status</label>
                                            <select name="status" id="status" class="form-select">
                                                <option value="Available" <?= $row['trip_status'] == 'Available' ? 'selected' : '' ?>>Available</option>
                                                <option value="Completed" <?= $row['trip_status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
                                                <option value="Cancelled" <?= $row['trip_status'] == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="capacity" class="form-label">Capacity</label>
                                            <input type="number" name="capacity" id="capacity" class="form-control" value="<?= $row['Capacity'] ?>" min="1" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="update_trip" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>