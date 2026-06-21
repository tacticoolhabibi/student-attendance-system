<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header">
            Dashboard
        </div>

        <div class="card-body">

            <h3>
                Welcome,
                <?php echo $_SESSION['fullname']; ?>
            </h3>

            <p>
                Role:
                <?php echo $_SESSION['role']; ?>
            </p>

        </div>

    </div>

</div>

</body>
</html>