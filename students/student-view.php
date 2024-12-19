<?php
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

    <title>Student View</title>

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
    </style>

</head>
<body>
<?php include '../header.php'; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Student View Details 
                        <a href="index.php" class="btn btn-back float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
                        $student_id = $_GET['id'];

                        // Prepare statement to fetch student data
                        $stmt = $link->prepare("SELECT * FROM students WHERE id = ?");
                        $stmt->bind_param("i", $student_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            $student = $result->fetch_assoc();
                            ?>
                            <div class="mb-3">
                                <label>Student Name</label>
                                <p class="form-control"><?= htmlspecialchars($student['name']); ?></p>
                            </div>
                            <div class="mb-3">
                                <label>Student Email</label>
                                <p class="form-control"><?= htmlspecialchars($student['email']); ?></p>
                            </div>
                            <div class="mb-3">
                                <label>Student Phone</label>
                                <p class="form-control"><?= htmlspecialchars($student['phone']); ?></p>
                            </div>
                            <div class="mb-3">
                                <label>Student Course</label>
                                <p class="form-control"><?= htmlspecialchars($student['course']); ?></p>
                            </div>
                            <div class="mb-3">
                                <label>Address</label>
                                <p class="form-control"><?= htmlspecialchars($student['address']); ?></p>
                            </div>
                            <div class="mb-3">
                                <label>Date of Birth</label>
                                <p class="form-control"><?= htmlspecialchars($student['birth']); ?></p>
                            </div>
                            <div class="mb-3">
                                <label>Student Image</label><br>
                                <?php if (!empty($student['image']) && file_exists($student['image'])): ?>
                                    <img src="<?= htmlspecialchars($student['image']); ?>" alt="Student Image" style="max-width: 200px;" class="img-thumbnail">
                                <?php else: ?>
                                    <p class="text-muted">No image available</p>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label>Gender</label>
                                <p class="form-control"><?= htmlspecialchars($student['gender']); ?></p>
                            </div>
                            <div class="mb-3">
                                <label>Status</label>
                                <p class="form-control"><?= htmlspecialchars($student['stat']); ?></p>
                            </div>
                            <?php
                        } else {
                            echo "<h4 class='text-danger'>No student found with this ID</h4>";
                        }

                        $stmt->close();
                    } else {
                        echo "<h4 class='text-danger'>Invalid student ID</h4>";
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
