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
  </style>
</head>
<body class="container mt-5">
    <h2 >Edit Your Vehicle</h2>

    <!-- Step 1: Select Vehicle -->
    <form method="POST" class="mb-4">
        
        <select name="selected_vehicle" class="form-select w-50 mt-3 mb-2" required>
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
        <button type="submit" class="btn btn-outline-primary mt-2">Edit</button>
        <a href="vehicle_list.php" >
        <button type="button" class="btn btn-outline-danger mt-2">Back</button>
        </a>
    </form>

    <!-- Step 2: Show Edit Form -->
    <?php if (isset($vehicle)): ?>
        <form method="POST" action="update_vehicle.php">
            <input type="hidden" name="original_vehicle_number" value="<?= htmlspecialchars($vehicle['Vehicle_Number']) ?>">

            <div class="mb-3">
                <label>Vehicle Number</label>
                <input type="text" name="vehicle_number" class="form-control w-50" value="<?= htmlspecialchars($vehicle['Vehicle_Number']) ?>" required>
            </div>

            <div class="mb-3">
                <label>Model Name</label>
                <input type="text" name="model_name" class="form-control w-50" value="<?= htmlspecialchars($vehicle['Model_Name']) ?>" required>
            </div>

            <div class="mb-3">
                <label>Capacity</label>
                <input type="number" name="capacity" class="form-control w-50" value="<?= htmlspecialchars($vehicle['Capacity']) ?>" required>
            </div>

            <button type="submit" class="btn btn-outline-success">Save Changes</button>
        </form>
    <?php endif; ?>
</body>
</html>