<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

include("../config/db.php");
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

    <div class="card shadow">

        <div class="card-header">
            Add Student
        </div>

        <div class="card-body">

            <form>

                <div class="mb-3">
                    <label>Student ID</label>
                    <input type="text" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Student Name</label>
                    <input type="text" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Department</label>
                    <input type="text" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Semester</label>
                    <input type="text" class="form-control">
                </div>

                <button class="btn btn-success">
                    Add Student
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>