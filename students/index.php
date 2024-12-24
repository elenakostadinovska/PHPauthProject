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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <title>Student CRUD</title>

    <style>
        .student-card {
            transition: transform 0.3s ease;
            overflow: hidden; /* Ensures content inside the card doesn't overflow the rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        }

        .student-card:hover {
            transform: translateY(-5px);
        }
        .student-card img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto; /* Centers the image horizontally */
            display: block;
            margin-top: 10px;
        }
        .student-card .card-body {
            text-align: center;
            color: #0c5797;
        }
        .card-header .btn-add {
            color: white;
            background-color: #0c5797;
            border-color: #0c5797;
            font-weight: 500;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .card-header .btn-add:hover {
            background-color: #2484c4;
            border-color: #2484c4;
            color: white;
        }

        .card-header h4 {
            color: #0c5797;
        }

        .card-actions {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
        }

        .btn-icon {
            color: white;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-icon.view {
            background-color: #5CAFE8;
        }

        .btn-icon.edit {
            background-color: #2484c4;
        }

        .btn-icon.delete {
            background-color: #0c5797;
        }

        .btn-icon:hover {
            opacity: 0.9;
            background-color: #2484c4;
        }
    </style>
</head>
<body>
<?php include '../header.php'; ?>

<div class="container mt-4">

    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Student Details
                        <a href="student-create.php" class="btn btn-add float-end">Add Students</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php
                        $query = "SELECT students.*, universities.name AS university_name FROM students
                                  LEFT JOIN universities ON students.university_id = universities.id";
                        $query_run = mysqli_query($link, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $student) {
                                ?>
                                <div class="col-md-4 mb-4">
                                    <div class="card student-card">
                                        <img src="<?= !empty($student['image']) ? htmlspecialchars($student['image']) : 'default-image.jpg'; ?>" alt="Student Image">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= htmlspecialchars($student['name']); ?></h5> <!-- Name first -->
                                            <p class="card-text">
                                                <strong>Student ID:</strong> <?= htmlspecialchars($student['id']); ?><br> <!-- ID second -->
                                                <strong>University:</strong> <?= !empty($student['university_name']) ? htmlspecialchars($student['university_name']) : 'Not Provided'; ?><br>
                                                <strong>Course:</strong> <?= htmlspecialchars($student['course']); ?>
                                            </p>
                                            <div class="card-actions">
                                                <!-- View Button -->
                                                <form action="student-view.php" method="GET">
                                                    <input type="hidden" name="id" value="<?= $student['id']; ?>">
                                                    <button type="submit" class="btn-icon view" title="View">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                </form>

                                                <!-- Edit Button -->
                                                <form action="student-edit.php" method="GET">
                                                    <input type="hidden" name="id" value="<?= $student['id']; ?>">
                                                    <button type="submit" class="btn-icon edit" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                </form>

                                                <!-- Delete Button -->
                                                <form action="code.php" method="POST">
                                                    <input type="hidden" name="delete_student" value="<?= $student['id']; ?>">
                                                    <button type="submit" class="btn-icon delete" title="Delete">
                                                        <i class="bi bi-trash3"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo "<h5>No Record Found</h5>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<?php include '../footer.php'; ?>

</body>
</html>
