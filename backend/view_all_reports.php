<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: manage_users.php");
    exit();
}

$query = "
    SELECT rt.Report_ID, rt.Report_Date, rt.Status, rt.Reason,
           t.Trip_ID, t.Date AS Trip_Date, t.Mode_of_Commute, t.Meet_up_location,
           reporter.Name AS Reporter_Name,
           owner.Name AS Trip_Owner_Name
    FROM Reported_Trips rt
    JOIN Trips t ON rt.Trip_ID = t.Trip_ID
    JOIN User reporter ON rt.Reporter_ID = reporter.Student_ID
    JOIN User owner ON t.Student_ID = owner.Student_ID
    ORDER BY rt.Report_Date DESC
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Reports - Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f1f3f5;
            font-family: 'Segoe UI', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .table thead {
            background: linear-gradient(to right, #0d6efd, #6610f2);
            color: white;
        }

        .report-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h3>Reported Trips</h3>
        <a href="admin_index.php" class="btn btn-secondary btn-sm">← Back to Dashboard</a>
    </div>
    
    <div class="report-card">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Report Date</th>
                        <th>Reporter</th>
                        <th>Trip Owner</th>
                        <th>Trip ID</th>
                        <th>Commute</th>
                        <th>Meet-Up</th>
                        <th>Reason</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row['Report_ID'] ?></td>
                            <td><?= date('Y-m-d H:i', strtotime($row['Report_Date'])) ?></td>
                            <td><?= htmlspecialchars($row['Reporter_Name']) ?></td>
                            <td><?= htmlspecialchars($row['Trip_Owner_Name']) ?></td>
                            <td><?= $row['Trip_ID'] ?></td>
                            <td><?= $row['Mode_of_Commute'] ?></td>
                            <td><?= htmlspecialchars($row['Meet_up_location']) ?></td>
                            <td><?= htmlspecialchars($row['Reason']) ?></td>
                            <td>
                                <span class="badge bg-<?= $row['Status'] === 'Pending' ? 'warning' : 'success' ?>">
                                    <?= $row['Status'] ?>
                                </span>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>