<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">

        <span class="navbar-brand">
            Teacher Attendance Portal
        </span>

        <div class="d-flex align-items-center">

            <span class="text-white me-3">
                Welcome, <?php echo $_SESSION['teacher_name']; ?>
            </span>

            <a href="/attendance_system/admin/dashboard.php" class="btn btn-primary me-1">
                Dashboard
            </a>

            <a href="/attendance_system/admin/students.php" class="btn btn-success me-1">
                Students
            </a>

            <a href="/attendance_system/admin/attendance.php" class="btn btn-warning me-1">
                Attendance
            </a>

            <a href="/attendance_system/admin/reports.php" class="btn btn-info me-1">
                Reports
            </a>

            <a href="/attendance_system/logout.php" class="btn btn-danger">
                Logout
            </a>

        </div>

    </div>
</nav>