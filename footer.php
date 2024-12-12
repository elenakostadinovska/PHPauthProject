<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cosmic Development</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles (SCSS is already applied here) -->
    <link rel="stylesheet" href="custom-bootstrap.css">
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Google Font links -->
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap" rel="stylesheet">

    <style>
        .footer {
            background-color: #ADD8E6;
            padding: 30px 0;
            font-size: 18px;
            color: #0c5797;
            text-align: center;
            margin-bottom: 0; /* Remove bottom margin to eliminate extra space */
        }

        .footer h5 {
            color: #0c5797;
            font-size: 20px;
            font-weight: bold; /* Semi-Bold */
            margin-bottom: 15px;
        }

        .footer p {
            color: #0c5797;
            font-size: 18px;
        }

        .footer .list-unstyled {
            padding: 0;
            text-align: left;
            margin-bottom: 20px;
            font-size: 18px;
            margin: 5px 0;
            gap: 10px;
        }

        .footer .list-unstyled li {
            margin: 10px 0;
        }

        .footer .list-unstyled a {
            color: #0c5797;
            text-decoration: none;
            font-weight: 400; /* Normal weight for links */
            transition: color 0.3s ease;
        }

        .footer .list-unstyled a:hover {
            color: #2484c4;
        }

        .footer-bottom .social-icons {
            margin-top: 10px;
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        .footer-bottom .social-icon {
            color: white;
            font-size: 20px;
            transition: color 0.3s ease;
        }

        .footer-bottom .social-icon:hover {
            color: #ADD8E6;
        }

        .footer .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 40px;
            text-align: left;
        }

        .footer .col-md-4 {
            text-align: left;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
        }

        .footer .col-md-4 h5 {
            margin-top: 0;
        }

        .footer .col-md-4 p {
            text-align: justify;
        }

        .footer .contact-info {
            display: flex;
            flex-direction: column;
            gap: 15px;
            text-align: left;
        }

        .footer .contact-info p {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 18px;
            margin: 5px 0;
        }

        .footer .contact-info i {
            font-size: 20px;
            color: #0c5797;
        }

        /* New Section for Cosmic Development and Social Media */
        .footer-bottom {
            background-color: #0c5797; /* Different background color */
            padding: 20px 0;
            color: white;
            text-align: center;
        }

        .footer-bottom .footer-paragraph {
            margin-top: 0;
            color: white;
            font-size: 18px;
        }

        .footer-bottom .social-icons {
            gap: 15px;
            justify-content: center;
        }
        
    </style>
</head>

<body>
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <!-- About Us Section -->
            <div class="col-md-4">
                <h5>About Us</h5>
                <p>
                    Cosmic Development specializes in innovative web solutions and digital transformation to help businesses succeed in the digital age. Our team is committed to delivering excellence and driving results.
                </p>
            </div>

            <!-- Quick Links Section -->
            <div class="col-md-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#!">Services</a></li>
                    <li><a href="#!">Portfolio</a></li>
                    <li><a href="#!">Team</a></li>
                    <li><a href="#!">Contact</a></li>
                </ul>
            </div>

            <!-- Contact Section -->
            <div class="col-md-4 contact-info">
                <h5>Contact</h5>
                <p><i class="fas fa-home"></i> Todor Skalovski 8 7000, Bitola 7000</p>
                <p><i class="fas fa-phone"></i> +389 47 610 111</p>
                <p><i class="fas fa-envelope"></i> info@cosmicdevelopment.com</p>
                <p><i class="fas fa-fax"></i> +389 47 610 111</p>
            </div>
        </div>
    </footer>

    <!-- Bottom Section for Cosmic Development and Social Media Icons -->
    <div class="footer-bottom">
        <p class="footer-paragraph">© 2024 Cosmic Development. Crafted with care.</p>

        <!-- Social Media Icons -->
        <div class="social-icons">
            <a href="https://www.facebook.com/" class="social-icon"><i class="fab fa-facebook"></i></a>
            <a href="https://x.com/" class="social-icon"><i class="fab fa-twitter"></i></a>
            <a href="https://linkedin.com/" class="social-icon"><i class="fab fa-linkedin"></i></a>
        </div>
    </div>

    <!-- Bootstrap JS and FontAwesome -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>
