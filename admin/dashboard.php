<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

include("../config/db.php");

$total_students = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM students")
)['total'];

$today = date("Y-m-d");

$present_today = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM attendance
         WHERE attendance_date='$today'
         AND status='Present'"
    )
)['total'];

$absent_today = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM attendance
         WHERE attendance_date='$today'
         AND status='Absent'"
    )
)['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">

        <span class="navbar-brand">
            Student Attendance System
        </span>

        <div>

            <a href="dashboard.php" class="btn btn-primary">
                Dashboard
            </a>

            <a href="students.php" class="btn btn-success">
                Students
            </a>

            <a href="../logout.php" class="btn btn-danger">
                Logout
            </a>

        </div>

    </div>
</nav>

<div class="container mt-4">

    <div class="mb-4">
        <h2>Welcome, <?php echo $_SESSION['fullname']; ?></h2>
        <p>Role: <?php echo $_SESSION['role']; ?></p>
    </div>

    <div class="row">

        <div class="col-md-4 mb-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5>Total Students</h5>
                    <h1><?php echo $total_students; ?></h1>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5>Present Today</h5>
                    <h1><?php echo $present_today; ?></h1>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5>Absent Today</h5>
                    <h1><?php echo $absent_today; ?></h1>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>