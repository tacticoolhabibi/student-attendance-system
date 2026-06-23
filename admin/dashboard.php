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

include("../includes/header.php");
include("../includes/navbar.php");
?>

<div class="container mt-4">

    <h2>Welcome, <?php echo $_SESSION['fullname']; ?></h2>

    <div class="row mt-4">

        <div class="col-md-4">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5>Total Students</h5>
                    <h1><?php echo $total_students; ?></h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5>Present Today</h5>
                    <h1><?php echo $present_today; ?></h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5>Absent Today</h5>
                    <h1><?php echo $absent_today; ?></h1>
                </div>
            </div>
        </div>

    </div>

</div>

<?php include("../includes/footer.php"); ?>