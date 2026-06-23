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

include("../includes/header.php");
include("../includes/navbar.php");
?>

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

</div>

<?php include("../includes/footer.php"); ?>