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

    <title>University Edit</title>

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
                        <h4>University Edit 
                            <a href="index.php" class="btn btn-back float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['id']))
                        {
                            $university_id = mysqli_real_escape_string($link, $_GET['id']);
                            // Prepared statement to prevent SQL injection
                            $query = "SELECT * FROM universities WHERE id = ?";
                            $stmt = mysqli_prepare($link, $query);
                            mysqli_stmt_bind_param($stmt, 'i', $university_id);
                            mysqli_stmt_execute($stmt);
                            $query_run = mysqli_stmt_get_result($stmt);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $university = mysqli_fetch_array($query_run);
                                ?>
                                <form action="code.php" method="POST" enctype="multipart/form-data"> <!-- enctype added -->
                                    <input type="hidden" name="university_id" value="<?= $university['id']; ?>">

                                    <div class="mb-3">
                                        <label>University Name</label>
                                        <input type="text" name="name" value="<?= $university['name']; ?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label>Address</label>
                                        <input type="text" name="address" value="<?= $university['address']; ?>" class="form-control">
                                    </div> 

                                    <div class="mb-3">
                                        <label>University Image</label>
                                        <br>
                                        <?php if ($university['image']) { ?>
                                            <img src="../uploads/<?= $university['image']; ?>" alt="University Image" width="100">
                                        <?php } ?>
                                        <br>
                                        <input type="file" name="image">
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" name="update_university" class="btn btn-update">
                                            Update University
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
