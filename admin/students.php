<?php
session_start();

if(!isset($_SESSION['teacher_id'])){
    header("Location: ../login.php");
    exit();
}

include("../config/db.php");

$message = "";

$teacher_id = $_SESSION['teacher_id'];

if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    mysqli_query(
        $conn,
        "DELETE FROM attendance WHERE student_id='$id'"
    );

    mysqli_query(
        $conn,
        "DELETE FROM students
         WHERE id='$id'
         AND teacher_id='$teacher_id'"
    );

    header("Location: students.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $semester = $_POST['semester'];

    mysqli_query(
        $conn,
        "INSERT INTO students
        (student_id,name,department,semester,teacher_id)
        VALUES
        (
            '$student_id',
            '$name',
            '$department',
            '$semester',
            '$teacher_id'
        )"
    );

    $message = "Student added successfully!";
}

$search = "";

if(isset($_GET['search'])){
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

if($search != ""){

    $students = mysqli_query(
        $conn,
        "SELECT * FROM students
         WHERE teacher_id='$teacher_id'
         AND (
            name LIKE '%$search%'
            OR student_id LIKE '%$search%'
            OR department LIKE '%$search%'
         )
         ORDER BY id DESC"
    );

}else{

    $students = mysqli_query(
        $conn,
        "SELECT * FROM students
         WHERE teacher_id='$teacher_id'
         ORDER BY id DESC"
    );
}

include("../includes/header.php");
include("../includes/navbar.php");
?>

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
                    <input type="text" name="student_id" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Student Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Department</label>
                    <input type="text" name="department" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Semester</label>
                    <input type="text" name="semester" class="form-control" required>
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

            <form method="GET" class="mb-3">

                <div class="row">

                    <div class="col-md-4">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search by ID, Name or Department"
                            value="<?php echo htmlspecialchars($search); ?>">

                    </div>

                    <div class="col-md-2">

                        <button class="btn btn-primary">
                            Search
                        </button>

                    </div>

                </div>

            </form>

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Semester</th>
                        <th>Action</th>
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

                        <td>
                            <a
                                href="?delete=<?php echo $row['id']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete this student?')">
                                Delete
                            </a>
                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include("../includes/footer.php"); ?>