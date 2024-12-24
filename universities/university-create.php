<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Student Create</title>

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

        .mb-3 .btn-save {
            color: white;
            background-color: #0c5797;
            border-color: #0c5797;
            font-weight: 500;
            transition: background-color 0.3s ease, border-color 0.3s ease;
            font-size: 16px;
        }

        .mb-3 .btn-save:hover {
            background-color: #2484c4;
            border-color: #2484c4;
            color: white;
            font-size: 16px;
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
                    <h4>Add University
                        <a href="index.php" class="btn btn-back float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="name">University Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="image">University Image</label>
                            <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
                        </div>

                        <div class="mb-3">
                            <button type="submit" name="save_university" class="btn btn-save">Save University</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<?php include '../footer.php'; ?>
</body>
</html>
