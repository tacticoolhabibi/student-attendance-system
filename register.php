<?php

include("config/db.php");

$message = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if($password != $confirm_password){

        $message = "Passwords do not match.";

    }else{

        $check = mysqli_query(
            $conn,
            "SELECT * FROM teachers WHERE username='$username'"
        );

        if(mysqli_num_rows($check) > 0){

            $message = "Username already exists.";

        }else{

            mysqli_query(
                $conn,
                "INSERT INTO teachers
                (fullname,email,username,password)
                VALUES
                (
                    '$fullname',
                    '$email',
                    '$username',
                    '$password'
                )"
            );

            $message = "Registration successful. You can now login.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container">

    <div class="row justify-content-center mt-5">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header text-center">
                    <h3>Teacher Registration</h3>
                </div>

                <div class="card-body">

                    <?php if($message != "") { ?>

                        <div class="alert alert-info">
                            <?php echo $message; ?>
                        </div>

                    <?php } ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label>Full Name</label>

                            <input
                                type="text"
                                name="fullname"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label>Email</label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label>Username</label>

                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label>Password</label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label>Confirm Password</label>

                            <input
                                type="password"
                                name="confirm_password"
                                class="form-control"
                                required>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-success w-100">

                            Register

                        </button>

                    </form>

                    <hr>

                    <div class="text-center">

                        <a href="login.php">
                            Already have an account? Login
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>