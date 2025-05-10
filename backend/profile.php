<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION["User_ID"])) {
  header("Location: index.php");
  exit();
}

$student_id = $_SESSION["User_ID"];

$sql = "SELECT * FROM User WHERE Student_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}
$sql_rating = "SELECT AVG(Rating_Score) AS Average_Rating 
               FROM Trip_Member_Ratings 
               WHERE Rated_ID = ?";

$stmt_rating = $conn->prepare($sql_rating);
$stmt_rating->bind_param("s", $student_id);
$stmt_rating->execute();
$result_rating = $stmt_rating->get_result();
$average_rating = $result_rating->fetch_assoc()['Average_Rating'] ?? 0;

function displayStars($rating) {
    $stars = '';
    $fullStars = floor($rating);
    $halfStar = ($rating - $fullStars >= 0.5) ? 1 : 0;
    $emptyStars = 5 - $fullStars - $halfStar;

    for ($i = 0; $i < $fullStars; $i++) {
        $stars .= '<i class="fa-solid fa-star text-warning"></i>';
    }

    if ($halfStar) {
        $stars .= '<i class="fa-solid fa-star-half-stroke text-warning"></i>';
    }

    for ($i = 0; $i < $emptyStars; $i++) {
        $stars .= '<i class="fa-regular fa-star text-muted"></i>';
    }

    return $stars;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Profile - Cholo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/profile_style.css">
</head>
<body>

    <div class="profile-card">
      <h3 class="profile-title">User Profile</h3>
      <div class="profile-info">
        <p><strong>Name:</strong> <?php echo htmlspecialchars($user['Name']); ?></p>
        <p><strong>Student ID:</strong> <?php echo htmlspecialchars($user['Student_ID']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['Gsuite_Email']); ?></p>
        <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($user['Phone_Number']); ?></p>
        <p><strong>Gender:</strong> <?php echo htmlspecialchars($user['Gender']); ?></p>
        <p><strong>Department:</strong> <?php echo htmlspecialchars($user['Department']); ?></p>
        <p><strong>Semester:</strong> <?php echo htmlspecialchars($user['Semester']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($user['Address']); ?></p>
        <p><strong>Thana:</strong> <?php echo htmlspecialchars($user['Thana']); ?></p>
        <p><strong>Average Rating:</strong> <?php echo displayStars($average_rating); ?> (<?php echo round($average_rating, 1); ?>)</p>
      </div>
      <div class="text-center mt-4">
        <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>
        <a href="landing_page.php" class="btn btn-secondary me-2">Back to Home</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
      </div>
    </div>

</body>
</html>