<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">

        <a class="navbar-brand fw-bold" href="/attendance_system/admin/dashboard.php">
            <i class="bi bi-mortarboard-fill"></i>
            Teacher Attendance Portal
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarMenu">

            <ul class="navbar-nav align-items-center">

                <li class="nav-item me-3">

                    <span class="text-white">
                        <i class="bi bi-person-circle"></i>
                        Welcome,
                        <strong><?php echo $_SESSION['teacher_name']; ?></strong>
                    </span>

                </li>

                <li class="nav-item me-2">

                    <button
                        id="darkModeBtn"
                        class="btn btn-outline-light">
                        🌙 Dark Mode
                    </button>

                </li>

                <li class="nav-item me-2">

                    <a href="/attendance_system/admin/dashboard.php" class="btn btn-primary">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>

                </li>

                <li class="nav-item me-2">

                    <a href="/attendance_system/admin/students.php" class="btn btn-success">
                        <i class="bi bi-people-fill"></i>
                        Students
                    </a>

                </li>

                <li class="nav-item me-2">

                    <a href="/attendance_system/admin/attendance.php" class="btn btn-warning">
                        <i class="bi bi-calendar-check"></i>
                        Attendance
                    </a>

                </li>

                <li class="nav-item me-2">

                    <a href="/attendance_system/admin/reports.php" class="btn btn-info text-white">
                        <i class="bi bi-bar-chart-fill"></i>
                        Reports
                    </a>

                </li>

                <li class="nav-item">

                    <a href="/attendance_system/logout.php" class="btn btn-danger">
                        <i class="bi bi-box-arrow-right"></i>
                        Logout
                    </a>

                </li>

            </ul>

        </div>

    </div>
</nav>