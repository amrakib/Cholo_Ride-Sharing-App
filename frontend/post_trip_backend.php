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
    $where_loc = $_POST['from_location'];
    $datetime = $_POST['time'];
    $date = date('Y-m-d', strtotime($datetime));
    $time = date('H:i:s', strtotime($datetime));
    $vehicle_info=$_POST['vehicle_info'];
    $fare = $_POST['fare'];
    $meet_up = $_POST['Meet_up_location'];
    $mode_of_commute = $_POST['mode_commute'];
    $capacity = $_POST['capacity'];
    $trip_status = "Available";
    $to_loc = $_POST['towhere'];
    $Used_capacity = 0; // Initialize Used_capacity to 0
    

    $sql = "INSERT INTO Trips (Student_ID, where_loc, Capacity, Time, Date,
    Vehicle_Info,Fare, Meet_up_location, Mode_of_Commute,
    trip_status, to_loc, Used_capacity) 
            VALUES (?, ?, ?, ?, ?, ?,?, ?, ?, ?,?, ?)";

    $update="UPDATE User SET UserStatus='Rider'  WHERE Student_ID=\"".$_SESSION["User_ID"]."\"";
    $result=mysqli_query($conn, $update);
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisssdssssi", $student_id, $where_loc, $capacity, $time, $date, $vehicle_info ,$fare, $meet_up, $mode_of_commute, $trip_status, $to_loc, $Used_capacity);
     
    try {
        if ($stmt->execute()) {
            $_SESSION['success'] = "Trip Created Successfully!";
            header("Location: post_trip_success.php"); // Redirect to success page
            exit();

        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            // 1062 = Duplicate entry error
            $_SESSION['error'] = "🚫 Something Went Wrong";
        
        } else {
            $_SESSION['error'] = "Error: " . $e->getMessage();
        }
        header("Location: post_trip_success.php"); // Redirect back to the add vehicle form
        exit();
    }
}

?>
<?php
$stmt->close();
$conn->close();
?>