<?php
session_start();

if(!isset($_SESSION['teacher_id'])){
    header("Location: ../login.php");
    exit();
}

include("../config/db.php");

$teacher_id = $_SESSION['teacher_id'];

$selected_date = "";

if(isset($_GET['attendance_date'])){

    $selected_date = $_GET['attendance_date'];

    $report = mysqli_query(
        $conn,
        "SELECT attendance.*, students.student_id, students.name
         FROM attendance
         JOIN students
         ON attendance.student_id = students.id
         WHERE attendance.attendance_date='$selected_date'
         AND students.teacher_id='$teacher_id'
         ORDER BY students.name ASC"
    );
}

$percentage_report = mysqli_query(
    $conn,
    "SELECT
        students.student_id,
        students.name,

        SUM(
            CASE
                WHEN attendance.status='Present'
                THEN 1
                ELSE 0
            END
        ) AS present_count,

        COUNT(attendance.id) AS total_count

     FROM students

     LEFT JOIN attendance
     ON students.id = attendance.student_id

     WHERE students.teacher_id='$teacher_id'

     GROUP BY students.id

     ORDER BY students.name ASC"
);

include("../includes/header.php");
include("../includes/navbar.php");
?>

<div class="container mt-4">

    <div class="card shadow mb-4">

        <div class="card-header">
            Attendance Report By Date
        </div>

        <div class="card-body">

            <form method="GET">

                <div class="row">

                    <div class="col-md-4">

                        <input
                            type="date"
                            name="attendance_date"
                            class="form-control"
                            required>

                    </div>

                    <div class="col-md-2">

                        <button class="btn btn-primary">
                            Search
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <?php if($selected_date != "") { ?>

        <div class="card shadow mb-4">

            <div class="card-header">
                Report for <?php echo $selected_date; ?>
            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php while($row = mysqli_fetch_assoc($report)) { ?>

                        <tr>

                            <td><?php echo $row['student_id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['status']; ?></td>

                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    <?php } ?>

    <div class="card shadow">

        <div class="card-header">
            Attendance Percentage Report
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead>

                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Present</th>
                        <th>Total Classes</th>
                        <th>Attendance %</th>
                    </tr>

                </thead>

                <tbody>

                <?php while($row = mysqli_fetch_assoc($percentage_report)) { ?>

                    <?php

                    $percentage = 0;

                    if($row['total_count'] > 0){

                        $percentage =
                            round(
                                ($row['present_count'] / $row['total_count']) * 100,
                                2
                            );
                    }

                    ?>

                    <tr>

                        <td><?php echo $row['student_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['present_count']; ?></td>
                        <td><?php echo $row['total_count']; ?></td>
                        <td><?php echo $percentage; ?>%</td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include("../includes/footer.php"); ?>