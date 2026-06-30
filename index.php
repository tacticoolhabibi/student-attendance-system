<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Teacher Attendance Portal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<button
    id="darkModeBtn"
    class="btn btn-dark position-absolute top-0 end-0 m-4">
    🌙 Dark Mode
</button>

<div class="container">

    <div class="row align-items-center min-vh-100">

        <div class="col-lg-6">

            <span class="badge bg-primary mb-3">
                Teacher Attendance Portal
            </span>

            <h1 class="display-3 fw-bold mb-4">
                Manage Attendance
                <br>
                Smarter.
            </h1>

            <p class="fs-5 mb-4 landing-description">

                A modern attendance management system that helps teachers
                manage students, record attendance, and generate reports
                quickly and efficiently.

            </p>

            <div class="d-flex gap-3">

                <a
                    href="login.php"
                    class="btn btn-primary btn-lg">

                    <i class="bi bi-box-arrow-in-right"></i>

                    Teacher Login

                </a>

                <a
                    href="register.php"
                    class="btn btn-success btn-lg">

                    <i class="bi bi-person-plus-fill"></i>

                    Register

                </a>

            </div>

        </div>

        <div class="col-lg-6 text-center">

            <img
                src="assets/images/hero-banner.png"
                class="img-fluid rounded-4 shadow-lg"
                style="max-height:520px;">

        </div>

    </div>

</div>

<script src="assets/js/theme.js"></script>

</body>

</html>