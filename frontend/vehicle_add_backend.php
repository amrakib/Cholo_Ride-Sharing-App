<?php
session_start();
 // Start the session to store temporary success message
 if (!isset($_SESSION["User_ID"])) {
    header("Location: ../backend/index.php");
    exit();
  }
$student_id = $_SESSION["User_ID"];
// Step 1: Connect to Database
$servername = "localhost";
$username = "root";
$password = ""; // XAMPP default password
$dbname = "database_schema"; // Change this to your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Enable Exception Mode
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Step 2: Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vehicle_type = $_POST['vehicle_type'];
    $model_name = $_POST['model_name'];
    $vehicle_number = $_POST['vehicle_number'];
    $license_number = $_POST['license_number'];
    $capacity = $_POST['capacity'];
    $owner_id = $student_id ;

    $sql = "INSERT INTO private_vehicle (vehicle_type, model_name, vehicle_number, license_number, capacity, owner_id) 
            VALUES (?, ?, ?, ?, ?, ? )";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssis", $vehicle_type, $model_name, $vehicle_number, $license_number, $capacity, $owner_id);



    try {
        if ($stmt->execute()) {
            $_SESSION['success'] = "Vehicle added successfully!";
            header("Location: add_vehicle_success.php"); // Redirect to success page
            exit();

        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            // 1062 = Duplicate entry error
            $_SESSION['error'] = "🚫 Vehicle number already exists. Please enter a unique vehicle number!";
        
        } else {
            $_SESSION['error'] = "Error: " . $e->getMessage();
        }
        header("Location: add_vehicle_success.php"); // Redirect back to the add vehicle form
        exit();
    }
}

?>
<?php
$stmt->close();
$conn->close();
?>