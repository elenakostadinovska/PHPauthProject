<?php
define('BASE_URL', '/php/'); // Replace with your actual app root path
$isLoggedIn = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;
$username = $isLoggedIn ? $_SESSION["username"] : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Innovative Solutions</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!--Google Font links-->
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap" rel="stylesheet">

    <!-- Inline Styles -->
    <style>
        body {
            font-family: 'IBM Plex Sans', sans-serif;
        }

        .custom-navbar {
            background-color: #ADD8E6;
            padding: 20px 10px;
        }

        .navbar-brand img {
            height: 50px;
        }

        .nav-item {
            font-size: 20px;
            font-weight: bold;
            margin-right: 15px;
            margin-top: 5px;
        }

        .nav-link {
            color: #0c5797 !important;  
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #2484c4 !important;
        }

        .navbar .btn-primary {
            color: white;
            background-color: #0c5797;
            border-color: #0c5797;
            font-size: 20px;
            font-weight: 500;
            padding: 10px 15px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .navbar .btn-primary:hover {
            background-color: #2484c4;
            border-color: #2484c4;
        }

        .nav-item h5 {
            color: #0c5797;
            font-size: 20px;
            margin: 0;
            margin-top: 5px;
        }

        .header {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg custom-navbar header">
    <div class="container-fluid">
    <a class="navbar-brand brand-title" href="<?php echo BASE_URL; ?>welcome.php">
    <img src="<?php echo BASE_URL; ?>images/logo.png" alt="Logo" class="d-inline-block align-text-top">
</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="/php/welcome.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/php/students/index.php">Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/php/universities/index.php">Universities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Team</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item" style="margin-top: 11px; margin-right: 15px;">
                    <h5>
                        <?php if ($username): ?>
                            Hi, <b><?php echo htmlspecialchars($username); ?></b>.
                        <?php else: ?>
                            Welcome, Guest.
                        <?php endif; ?>
                    </h5>
                </li>
                <button type="button" class="btn btn-primary" onclick="window.location.href='/php/logout.php'">Sign Out</button>
            </ul>
        </div>
    </div>
</nav>

    <!-- Bootstrap JS and FontAwesome -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    
</body>

</html>
