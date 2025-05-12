<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: manage_users.php");
    exit();
}

if (!isset($_GET['trip_id'])) {
    echo "No Trip ID provided.";
    exit();
}

$trip_id = intval($_GET['trip_id']);

$query = "
    SELECT rt.Report_ID, rt.Trip_ID, rt.Reporter_ID, 
           t.Student_ID AS Trip_Owner_ID, 
           rt.Reason
    FROM Reported_Trips rt
    JOIN Trips t ON rt.Trip_ID = t.Trip_ID
    WHERE rt.Trip_ID = ?  -- Match the trip_id from URL
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $trip_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "No reports found for this Trip ID.";
    exit();
}

// Fetching report details
$report = $result->fetch_assoc();
$report_id = $report['Report_ID'];
$reporter_id = $report['Reporter_ID'];
$owner_id = $report['Trip_Owner_ID'];
$reason = $report['Reason'];

// Fetching reporter's name
$reporter_query = "SELECT Name FROM User WHERE Student_ID = ?";
$stmt = $conn->prepare($reporter_query);
$stmt->bind_param("s", $reporter_id);
$stmt->execute();
$reporter_result = $stmt->get_result();
$reporter_name = $reporter_result->fetch_assoc()['Name'];

// Fetch owner's name
$owner_query = "SELECT Name FROM User WHERE Student_ID = ?";
$stmt = $conn->prepare($owner_query);
$stmt->bind_param("s", $owner_id);
$stmt->execute();
$owner_result = $stmt->get_result();
$owner_name = $owner_result->fetch_assoc()['Name'];


$owner_message = "A report has been issued regarding your Trip ID: $trip_id. Reason: \"$reason\".";
$reporter_message = "Your report regarding Trip ID: $trip_id has been reviewed. Thank you for your feedback.";

$insert_query = "
    INSERT INTO Notifications (User_ID, Message)
    VALUES 
        (?, ?),
        (?, ?)
";
$stmt = $conn->prepare($insert_query);
$stmt->bind_param("ssss", $owner_id, $owner_message, $reporter_id, $reporter_message);
$stmt->execute();

$update_query = "UPDATE Reported_Trips SET Status = 'Resolved' WHERE Report_ID = ?";
$stmt = $conn->prepare($update_query);
$stmt->bind_param("i", $report_id);
$stmt->execute();

header("Location: view_all_reports.php");
exit();
?>