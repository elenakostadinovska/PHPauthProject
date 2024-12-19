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

    

    <title>Student CRUD</title>

    <style>
         .card-body .btn-view {
            color: white;
            background-color: #5CAFE8;
            border-color: #5CAFE8;
            font-weight: 500;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .card-body .btn-view:hover {
            background-color: #2484c4;
            border-color: #2484c4;
            color: white;
        }

        .card-body .btn-edit {
            color: white;
            background-color: #2484c4;
            border-color: #2484c4;
            font-weight: 500;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .card-body .btn-edit:hover {
            background-color: #24A1C4;
            border-color: #24A1C4;
            color: white;
        }

        .card-body .btn-delete {
            color: white;
            background-color: #0c5797;
            border-color: #0c5797;
            font-weight: 500;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .card-body .btn-delete:hover {
            background-color: #2484c4;
            border-color: #2484c4;
            color: white;
        }

        .card-header .btn-add  {
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
    </style>

</head>
<body>
<?php include '../header.php'; ?>
  
    <div class="container mt-4">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student Details
                            <a href="student-create.php" class="btn btn-add float-end">Add Students</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Course</th>
                                    <th>Address</th>
                                    <th>Date of Birth</th>
                                    <th>Student Image</th>
                                    <th>Gender</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM students";
                                    $query_run = mysqli_query($link, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $student)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $student['id']; ?></td>
                                                <td><?= htmlspecialchars($student['name']); ?></td>
                                                <td><?= htmlspecialchars($student['email']); ?></td>
                                                <td><?= htmlspecialchars($student['phone']); ?></td>
                                                <td><?= htmlspecialchars($student['course']); ?></td>
                                                <td><?= htmlspecialchars($student['address']); ?></td>
                                                
                                                <!-- Date of Birth: If empty, show "Not Provided" -->
                                                <td><?= ($student['birth'] != '0000-00-00' && !empty($student['birth'])) ? htmlspecialchars($student['birth']) : 'Not Provided'; ?></td>
                                                
                                                <!-- Image: If empty, show "No Image" -->
                                                <td>
                                                    <?php if (!empty($student['image'])): ?>
                                                        <img src="<?= htmlspecialchars($student['image']); ?>" alt="Student Image" style="max-width: 100px;">
                                                    <?php else: ?>
                                                        No Image
                                                    <?php endif; ?>
                                                </td>
                                                
                                                <!-- Gender: If empty, show "Not Provided" -->
                                                <td><?= !empty($student['gender']) ? htmlspecialchars($student['gender']) : 'Not Provided'; ?></td>
                                                
                                                <!-- Status: If empty, show "Not Provided" -->
                                                <td><?= !empty($student['stat']) ? htmlspecialchars($student['stat']) : 'Not Provided'; ?></td>
                                                
                                                <td>
                                                    <a href="student-view.php?id=<?= $student['id']; ?>" class="btn btn-view btn-sm">View</a>
                                                    <a href="student-edit.php?id=<?= $student['id']; ?>" class="btn btn-edit btn-sm">Edit</a>
                                                    <form action="code.php" method="POST" class="d-inline">
                                                        <button type="submit" name="delete_student" value="<?=$student['id'];?>" class="btn btn-delete btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> No Record Found </h5>";
                                    }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php include '../footer.php'; ?>

</body>
</html>
