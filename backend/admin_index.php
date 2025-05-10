<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: manage_users.php");
    exit();
}

$user_count = 0;
$male_count = 0;
$female_count = 0;
$trip_result = mysqli_query($conn, "SELECT COUNT(*) AS total_trips FROM Trips");
$trip_count = mysqli_fetch_assoc($trip_result)['total_trips'];

$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM User");
$row = mysqli_fetch_assoc($result);
$user_count = $row['total'];


$male_result = mysqli_query($conn, "SELECT COUNT(*) AS males FROM User WHERE Gender='Male'");
$female_result = mysqli_query($conn, "SELECT COUNT(*) AS females FROM User WHERE Gender='Female'");
$male_count = mysqli_fetch_assoc($male_result)['males'];
$female_count = mysqli_fetch_assoc($female_result)['females'];
$report_result = mysqli_query($conn, "SELECT COUNT(*) AS reports FROM Reported_Trips WHERE Status='Pending'");
$report_count_row = mysqli_fetch_assoc($report_result);
$report_count = $report_count_row['reports'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }

        .dashboard-header {
            background: linear-gradient(to right, #0d6efd, #6610f2);
            color: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .card-stats {
            border: none;
            border-radius: 12px;
            transition: transform 0.2s;
        }

        .card-stats:hover {
            transform: translateY(-4px);
        }

        .card-icon {
            font-size: 2rem;
            opacity: 0.7;
        }

        .action-btn {
            font-size: 1.1rem;
            padding: 15px;
            border-radius: 10px;
        }

        .footer-note {
            margin-top: 30px;
            color: #888;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="dashboard-header d-flex justify-content-between align-items-center">
        <div>
            <h3 class="mb-0">Admin Dashboard</h3>
            <div class="mt-2">
                <span class="fw-regular">Logged in as:</span>
                <span class="badge bg-light text-dark shadow-sm px-3 py-2 ms-2">
                    <i class="bi bi-person-circle me-1"></i> <?= htmlspecialchars($_SESSION['admin']) ?>
                </span>
            </div>

        </div>
        <a href="logout.php" class="btn btn-light btn-sm">
            Logout <i class="bi bi-box-arrow-right"></i>
        </a>
    </div>
    
    <div class="row g-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card card-stats bg-primary text-white h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Total Users</h6>
                        <h3><?= $user_count ?></h3>
                    </div>
                    <i class="bi bi-people-fill card-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card card-stats bg-success text-white h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Male Users</h6>
                        <h3><?= $male_count ?></h3>
                    </div>
                    <i class="bi bi-gender-male card-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card card-stats bg-info text-white h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Female Users</h6>
                        <h3><?= $female_count ?></h3>
                    </div>
                    <i class="bi bi-gender-female card-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <a href="view_all_trips.php" class="text-decoration-none">
                <div class="card card-stats bg-secondary text-white h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Total Trips</h6>
                            <h3><?= $trip_count ?></h3>
                        </div>
                        <i class="bi bi-car-front-fill card-icon"></i>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-sm-6 col-lg-3">
            <a href="view_all_reports.php" class="text-decoration-none">
                <div class="card card-stats bg-danger text-white h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Reports</h6>
                            <h3><?= $report_count ?></h3>
                        </div>
                        <i class="bi bi-flag-fill card-icon"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>


    <div class="row mt-5 g-4">
        <div class="col-md-6">
            <a href="manage_users.php" class="btn btn-outline-primary w-100 action-btn">
                <i class="bi bi-person-lines-fill me-2"></i> Manage Users
            </a>
        </div>
        <div class="col-md-6">
            <a href="manage_trips.php" class="btn btn-outline-secondary w-100 action-btn">
                <i class="bi bi-map-fill me-2"></i> Manage Trips
            </a>
        </div>
    </div>

    <div class="footer-note text-center mt-5">
        &copy; <?= date('Y') ?> Cholo Ride-Sharing Admin Panel
    </div>

</div>

</body>
</html>