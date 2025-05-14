<?php
session_start();
include 'connection.php';

$user_id = $_SESSION['User_ID'];
$query = "SELECT vehicle_number, model_name, capacity FROM private_vehicle WHERE owner_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    
    echo '<select id="vehicleSelect" class="form-control selection-field text-center mb-3" onchange="setCapacity()" name="vehicle_info">';
    echo '<option value="">-- Select a Vehicle --</option>';
    while ($row = $result->fetch_assoc()) {
        
        echo '<option value="' . $row['model_name'] . '(' . $row['vehicle_number'] . ')' . '" data-capacity="' . $row['capacity'] . '">' . $row['model_name'] . '(' . $row['vehicle_number'] . ')</option>';
    }
    echo '</select>';
    
    echo '<input type="number" id="capacity" name="capacity" class="form-control selection-field text-center mb-3" placeholder="Capacity" readonly>';
} else {
    echo '<a href="add_vehicle.php" class="btn btn-primary mb-3">Add Vehicle</a>';
}
?>