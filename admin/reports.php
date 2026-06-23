<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

include("../config/db.php");

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
         ORDER BY students.name ASC"
    );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Reports</title>

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

            <a href="attendance.php" class="btn btn-warning">
                Attendance
            </a>

            <a href="reports.php" class="btn btn-info">
                Reports
            </a>

            <a href="../logout.php" class="btn btn-danger">
                Logout
            </a>

        </div>

    </div>
</nav>

<div class="container mt-4">

    <div class="card shadow mb-4">

        <div class="card-header">
            Attendance Report
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

        <div class="card shadow">

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

                            <td>
                                <?php echo $row['student_id']; ?>
                            </td>

                            <td>
                                <?php echo $row['name']; ?>
                            </td>

                            <td>
                                <?php echo $row['status']; ?>
                            </td>

                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    <?php } ?>

</div>

</body>
</html>