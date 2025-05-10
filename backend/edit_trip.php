<?php
include('db_connection.php');

if (isset($_GET['trip_id'])) {
    $trip_id = $_GET['trip_id'];

    $sql = "SELECT * FROM trips WHERE trip_id = '$trip_id'";
    $result = mysqli_query($conn, $sql);
    $trip = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'];
    $vehicle = $_POST['vehicle'];
    
    $update_sql = "UPDATE trips SET status = '$status', vehicle = '$vehicle' WHERE trip_id = '$trip_id'";
    if (mysqli_query($conn, $update_sql)) {
        header('Location: manage_trips.php');
        exit;
    } else {
        echo "Error updating trip: " . mysqli_error($conn);
    }
}
?>

<div class="container">
    <h1>Edit Trip</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <input type="text" class="form-control" id="status" name="status" value="<?php echo $trip['status']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="vehicle" class="form-label">Vehicle</label>
            <input type="text" class="form-control" id="vehicle" name="vehicle" value="<?php echo $trip['vehicle']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

<?php

mysqli_close($conn);
?>