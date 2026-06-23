<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

include("../config/db.php");

$message = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $today = date("Y-m-d");

    mysqli_query(
        $conn,
        "DELETE FROM attendance WHERE attendance_date='$today'"
    );

    foreach($_POST['attendance'] as $student_id => $status){

        mysqli_query(
            $conn,
            "INSERT INTO attendance
            (student_id, attendance_date, status)
            VALUES
            ('$student_id','$today','$status')"
        );
    }

    $message = "Attendance saved successfully!";
}

$students = mysqli_query(
    $conn,
    "SELECT * FROM students ORDER BY name ASC"
);

include("../includes/header.php");
include("../includes/navbar.php");
?>

<div class="container mt-4">

    <?php if($message != "") { ?>
        <div class="alert alert-success">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <div class="card shadow">

        <div class="card-header">
            Mark Attendance
        </div>

        <div class="card-body">

            <form method="POST">

                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php while($row = mysqli_fetch_assoc($students)) { ?>

                        <tr>

                            <td><?php echo $row['student_id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['department']; ?></td>

                            <td>

                                <input
                                    type="radio"
                                    name="attendance[<?php echo $row['id']; ?>]"
                                    value="Present"
                                    required> Present

                                &nbsp;&nbsp;

                                <input
                                    type="radio"
                                    name="attendance[<?php echo $row['id']; ?>]"
                                    value="Absent"> Absent

                            </td>

                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

                <button class="btn btn-success">
                    Save Attendance
                </button>

            </form>

        </div>

    </div>

</div>

<?php include("../includes/footer.php"); ?>