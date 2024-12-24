<?php
session_start();
require '../db_conn/dbcon.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Student Edit</title>

    <style>
        .card-header .btn-back  {
            color: white;
            background-color: #0c5797;
            border-color: #0c5797;
            font-weight: 500;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .card-header .btn-back:hover {
            background-color: #2484c4;
            border-color: #2484c4;
            color: white;
        }

        .mb-3 .btn-update {
            color: white;
            background-color: #0c5797;
            border-color: #0c5797;
            font-weight: 500;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .mb-3 .btn-update:hover {
            background-color: #2484c4;
            border-color: #2484c4;
            color: white;
        }
    </style>
</head>
<body>
<?php include '../header.php'; ?>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-5">
                    <div class="card-header">
                        <h4>Student Edit 
                            <a href="index.php" class="btn btn-back float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['id']))
                        {
                            $student_id = mysqli_real_escape_string($link, $_GET['id']);
                            // Prepared statement to prevent SQL injection
                            $query = "SELECT * FROM students WHERE id = ?";
                            $stmt = mysqli_prepare($link, $query);
                            mysqli_stmt_bind_param($stmt, 'i', $student_id);
                            mysqli_stmt_execute($stmt);
                            $query_run = mysqli_stmt_get_result($stmt);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $student = mysqli_fetch_array($query_run);
                                ?>
                                <form action="code.php" method="POST" enctype="multipart/form-data"> <!-- enctype added -->
                                    <input type="hidden" name="student_id" value="<?= $student['id']; ?>">

                                    <div class="mb-3">
                                        <label>Student Name</label>
                                        <input type="text" name="name" value="<?= $student['name']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Student Email</label>
                                        <input type="email" name="email" value="<?= $student['email']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Student Phone</label>
                                        <input type="text" name="phone" value="<?= $student['phone']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Student Course</label>
                                        <input type="text" name="course" value="<?= $student['course']; ?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label>Address</label>
                                        <input type="text" name="address" value="<?= $student['address']; ?>" class="form-control">
                                    </div> 

                                    <div class="mb-3">
                                        <label>Date of Birth</label>
                                        <input type="date" name="birth" value="<?= $student['birth']; ?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label>Student Image</label>
                                        <br>
                                        <?php if ($student['image']) { ?>
                                            <img src="../uploads/<?= $student['image']; ?>" alt="Student Image" width="100">
                                        <?php } ?>
                                        <br>
                                        <input type="file" name="image">
                                    </div>

                                    <div class="mb-3">
                                        <label>Gender</label>
                                        <select name="gender" class="form-control">
                                            <option value="Male" <?= $student['gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
                                            <option value="Female" <?= $student['gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label>Status</label>
                                        <select name="stat" class="form-control">
                                            <option value="Active" <?= $student['stat'] === 'Active' ? 'selected' : '' ?>>Active</option>
                                            <option value="Graduated" <?= $student['stat'] === 'Graduated' ? 'selected' : '' ?>>Graduated</option>
                                            <option value="Inactive" <?= $student['stat'] === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" name="update_student" class="btn btn-update">
                                            Update Student
                                        </button>
                                    </div>

                                </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such Id Found</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php include '../footer.php'; ?>
</body>
</html>
