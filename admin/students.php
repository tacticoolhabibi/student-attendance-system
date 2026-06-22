<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

include("../config/db.php");

$message = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $semester = $_POST['semester'];

    $query = "INSERT INTO students
    (student_id, name, department, semester)
    VALUES
    ('$student_id', '$name', '$department', '$semester')";

    if(mysqli_query($conn, $query)){
        $message = "Student added successfully!";
    }else{
        $message = "Error adding student.";
    }
}

$students = mysqli_query(
    $conn,
    "SELECT * FROM students ORDER BY id DESC"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>

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

            <a href="../logout.php" class="btn btn-danger">
                Logout
            </a>
        </div>

    </div>
</nav>

<div class="container mt-4">

    <?php if($message != "") { ?>
        <div class="alert alert-success">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <div class="card shadow mb-4">

        <div class="card-header">
            Add Student
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label>Student ID</label>
                    <input
                        type="text"
                        name="student_id"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label>Student Name</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label>Department</label>
                    <input
                        type="text"
                        name="department"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label>Semester</label>
                    <input
                        type="text"
                        name="semester"
                        class="form-control"
                        required>
                </div>

                <button class="btn btn-success">
                    Add Student
                </button>

            </form>

        </div>

    </div>

    <div class="card shadow">

        <div class="card-header">
            Student List
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Semester</th>
                    </tr>
                </thead>

                <tbody>

                <?php while($row = mysqli_fetch_assoc($students)) { ?>

                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['student_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['department']; ?></td>
                        <td><?php echo $row['semester']; ?></td>
                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>