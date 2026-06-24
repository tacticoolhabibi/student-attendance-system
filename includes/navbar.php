<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">

        <span class="navbar-brand">
            Teacher Attendance Portal
        </span>

        <div class="d-flex align-items-center">

            <span class="text-white me-3">
                Welcome, <?php echo $_SESSION['teacher_name']; ?>
            </span>

            <button
                id="darkModeBtn"
                class="btn btn-secondary me-2">
                🌙 Dark Mode
            </button>

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

<script>

document.addEventListener("DOMContentLoaded", function(){

    const darkModeBtn = document.getElementById("darkModeBtn");

    if(localStorage.getItem("theme") === "dark"){
        document.body.classList.add("dark-mode");
    }

    darkModeBtn.addEventListener("click", function(){

        document.body.classList.toggle("dark-mode");

        if(document.body.classList.contains("dark-mode")){
            localStorage.setItem("theme","dark");
        }else{
            localStorage.setItem("theme","light");
        }

    });

});

</script>