<?php
session_start();

if(!isset($_SESSION['teacher_id'])){
    header("Location: ../login.php");
    exit();
}

include("../config/db.php");

$teacher_id = $_SESSION['teacher_id'];

$total_students = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM students
         WHERE teacher_id='$teacher_id'"
    )
)['total'];

$today = date("Y-m-d");

$present_today = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM attendance
         INNER JOIN students
         ON attendance.student_id = students.id
         WHERE attendance.attendance_date='$today'
         AND attendance.status='Present'
         AND students.teacher_id='$teacher_id'"
    )
)['total'];

$absent_today = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM attendance
         INNER JOIN students
         ON attendance.student_id = students.id
         WHERE attendance.attendance_date='$today'
         AND attendance.status='Absent'
         AND students.teacher_id='$teacher_id'"
    )
)['total'];

$total_attendance = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM attendance
         INNER JOIN students
         ON attendance.student_id = students.id
         WHERE students.teacher_id='$teacher_id'"
    )
)['total'];

include("../includes/header.php");
include("../includes/navbar.php");
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

    <h2>
        Welcome, <?php echo $_SESSION['teacher_name']; ?>
    </h2>

    <div class="text-end">
        <h5 class="mb-1">
            <?php echo date("l, d F Y"); ?>
        </h5>
        <small class="text-muted">
            <?php echo date("h:i A"); ?>
        </small>
    </div>

</div>

    <div class="row mt-4">

        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5>Total Students</h5>
                    <h1><?php echo $total_students; ?></h1>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5>Present Today</h5>
                    <h1><?php echo $present_today; ?></h1>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5>Absent Today</h5>
                    <h1><?php echo $absent_today; ?></h1>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5>Total Attendance</h5>
                    <h1><?php echo $total_attendance; ?></h1>
                </div>
            </div>
        </div>

    </div>

</div>

<?php include("../includes/footer.php"); ?>