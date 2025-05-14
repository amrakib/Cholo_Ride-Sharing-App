<?php
session_start();
include 'connection.php';

if (!isset($_SESSION["User_ID"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["User_ID"];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['selected_vehicle'])) {
    $selected_vehicle = $_POST['selected_vehicle'];

    $sql = "SELECT * FROM private_vehicle WHERE vehicle_number = ? AND owner_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $selected_vehicle, $user_id);
    $stmt->execute();
    $vehicle = $stmt->get_result()->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Vehicle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
         <style>
    body {
  background-image: linear-gradient(220deg, #fbe4d6 0%, #8fd3f4);
  background-attachment: fixed;

}
.field {
  margin: auto;
  width: 60%;
}
.selection-field {
  border-radius: 30px;
  
}
  </style>
</head>
<body class="container mt-5">
<div class="bg-light shadow w-75 m-auto selection-field p-4">
    <h2 class="text-center mt-3">Edit Your Vehicle</h2>

    <!-- Step 1: Select Vehicle -->
    <form method="POST" class="mb-4">
        <div class="field">
        <select name="selected_vehicle" class="form-select  mt-3 mb-2 text-center selection-field" required>
            <option value="">Chose a Vehicle</option>
            <?php
            $sql = "SELECT Vehicle_Number FROM private_vehicle WHERE Owner_Id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $selected = (isset($selected_vehicle) && $selected_vehicle == $row['Vehicle_Number']) ? "selected" : "";
                echo "<option value='" . htmlspecialchars($row['Vehicle_Number']) . "' $selected>" . htmlspecialchars($row['Vehicle_Number']) . "</option>";
            }
            ?>
        </select>
        </div>
        <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-outline-primary mt-2 me-3">Edit</button>
        <a href="vehicle_list.php" >
        <button type="button" class="btn btn-outline-danger mt-2">Back</button>
        </a>
        </div>
    </form>

    <!-- Step 2: Show Edit Form -->
    <?php if (isset($vehicle)): ?>
        <form method="POST" action="update_vehicle.php">
            <input type="hidden" name="original_vehicle_number" value="<?= htmlspecialchars($vehicle['Vehicle_Number']) ?>">

            <div class="mb-3 field text-center">
                <label >Vehicle Number</label>
                <input type="text" name="vehicle_number" class="form-control selection-field text-center" value="<?= htmlspecialchars($vehicle['Vehicle_Number']) ?>" required>
            </div>

            <div class="mb-3 field text-center">
                <label>Model Name</label>
                <input type="text" name="model_name" class="form-control selection-field text-center" value="<?= htmlspecialchars($vehicle['Model_Name']) ?>" required>
            </div>

            <div class="mb-3 field text-center">
                <label>Capacity</label>
                <input type="number" name="capacity" class="form-control selection-field text-center" value="<?= htmlspecialchars($vehicle['Capacity']) ?>" required>
            </div>
        <div class="d-flex justify-content-center">

            <button type="submit" class="btn btn-outline-success mb-4">Save Changes</button>
            </div>
        </form>
    <?php endif; ?>
</div>
</body>
</html>