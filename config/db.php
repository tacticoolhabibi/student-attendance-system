<?php
date_default_timezone_set('Asia/Dhaka');

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "attendance_db"
);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>