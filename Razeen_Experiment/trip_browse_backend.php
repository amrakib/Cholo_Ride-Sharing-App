<?php
include '../frontend/connection.php';
$location_value_fetch = "SELECT * FROM Locations";

$all_locs = $conn->query($location_value_fetch);

if ($all_locs->num_rows > 0) {
    while ($row = $all_locs->fetch_assoc()) {
        $temp= "<option value=\"".$row["area_locations"]."\"".">".$row["area_locations"]."</option>";
        echo $temp;
}       
} else {
    echo "error";
}
?>