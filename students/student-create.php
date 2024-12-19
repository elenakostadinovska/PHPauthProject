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

        #genderDropdownButton,
        #statusDropdownButton {
            background-color: #0c5797; /* Blue background */
            color: white; /* White text */
            font-size: 16px; /* Slightly larger text */
            font-weight: 500; /* Bold text */
            border-color: #0c5797; /* Remove border */
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        /* Hover and Focus Effects for Buttons */
        #genderDropdownButton:hover,
        #statusDropdownButton:hover,
        #genderDropdownButton:focus,
        #statusDropdownButton:focus {
            background-color: #2484c4; /* Darker blue on hover/focus */
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); /* Subtle shadow */
        }

        /* Dropdown Menu Styling */
        #genderDropdownMenu,
        #statusDropdownMenu {
            background-color: #f8f9fa; /* Light background */
            border: 1px solid #2484c4; /* Blue border */
            border-radius: 5px; /* Rounded corners */
        }

        /* Dropdown Items */
        #genderDropdownMenu .dropdown-item,
        #statusDropdownMenu .dropdown-item {
            color: #333; /* Dark text */
            padding: 10px 15px; /* Comfortable padding */
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Hover Effect for Dropdown Items */
        #genderDropdownMenu .dropdown-item:hover,
        #statusDropdownMenu .dropdown-item:hover {
            background-color: #2484c4; /* Blue background on hover */
            color: white; /* White text on hover */
        }

    </style>

</head>
<body>
<?php include '../header.php'; ?>

<div class="container mt-5">

    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Student
                        <a href="index.php" class="btn btn-back float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="name">Student Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="email">Student Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone">Student Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="course">Student Course</label>
                            <input type="text" name="course" id="course" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="birth">Date of Birth</label>
                            <input type="date" name="birth" id="birth" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="image">Student Image</label>
                            <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
                        </div>

                        <!-- Gender Dropdown -->
                        <input type="hidden" name="gender" id="genderInput">
                        <div class="mb-3">
                            <label>Gender</label>
                            <div class="dropdown">
                                <button
                                    class="btn btn-secondary dropdown-toggle"
                                    type="button"
                                    id="genderDropdownButton"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Select Gender
                                </button>
                                <ul class="dropdown-menu" id="genderDropdownMenu">
                                    <li><a class="dropdown-item" href="#" data-value="Male">Male</a></li>
                                    <li><a class="dropdown-item" href="#" data-value="Female">Female</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Status Dropdown -->
                        <input type="hidden" name="stat" id="statusInput">
                        <div class="mb-3">
                            <label>Status</label>
                            <div class="dropdown">
                                <button
                                    class="btn btn-secondary dropdown-toggle"
                                    type="button"
                                    id="statusDropdownButton"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Select Status
                                </button>
                                <ul class="dropdown-menu" id="statusDropdownMenu">
                                    <li><a class="dropdown-item" href="#" data-value="Active">Active</a></li>
                                    <li><a class="dropdown-item" href="#" data-value="Graduated">Graduated</a></li>
                                    <li><a class="dropdown-item" href="#" data-value="Inactive">Inactive</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" name="save_student" class="btn btn-save">Save Student</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Dropdown initialization
    function setupDropdown(dropdownMenuId, dropdownButtonId, hiddenInputId) {
        const dropdownMenu = document.getElementById(dropdownMenuId);
        const dropdownButton = document.getElementById(dropdownButtonId);
        const hiddenInput = document.getElementById(hiddenInputId);

        dropdownMenu.addEventListener("click", function (event) {
            if (event.target.classList.contains("dropdown-item")) {
                event.preventDefault();
                const selectedValue = event.target.getAttribute("data-value");
                dropdownButton.textContent = `Selected: ${selectedValue}`;
                hiddenInput.value = selectedValue;
            }
        });
    }

    // Initialize dropdowns
    setupDropdown("genderDropdownMenu", "genderDropdownButton", "genderInput");
    setupDropdown("statusDropdownMenu", "statusDropdownButton", "statusInput");
</script>

<?php include '../footer.php'; ?>
</body>
</html>
