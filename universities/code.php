<?php
session_start();
require '../db_conn/dbcon.php';

if (isset($_POST['delete_university'])) {
    // Sanitize and validate the student ID
    $university_id = $_POST['delete_university'];

    // Validate that student ID is numeric
    if (!is_numeric($university_id)) {
        $_SESSION['message'] = "Invalid university ID";
        header("Location: index.php");
        exit(0);
    }

    // Check if the student exists
    $check_query = "SELECT * FROM universities WHERE id='$university_id'";
    $check_query_run = mysqli_query($link, $check_query);
    if (mysqli_num_rows($check_query_run) <= 0) {
        $_SESSION['message'] = "University not found";
        header("Location: index.php");
        exit(0);
    }

    // Get the student data to check for the image
    $university = mysqli_fetch_assoc($check_query_run);
    $imagePath = $university['image'];
    
    // If an image exists, delete it from the server
    if ($imagePath && file_exists($imagePath)) {
        unlink($imagePath);  // Delete the image file from the server
    }

    // Delete the student record from the database
    $delete_query = "DELETE FROM universities WHERE id='$university_id'";
    $delete_query_run = mysqli_query($link, $delete_query);

    if ($delete_query_run) {
        $_SESSION['message'] = "University Deleted Successfully";
        header("Location: index.php");
        exit(0);
    } else {
        $_SESSION['message'] = "University Not Deleted. Error: " . mysqli_error($link);
        header("Location: index.php");
        exit(0);
    }
}



// Update student
if (isset($_POST['update_university'])) {
    $university_id = mysqli_real_escape_string($link, $_POST['university_id']);
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $address = mysqli_real_escape_string($link, $_POST['address']);

    // Handle image upload (update image if a new one is uploaded)
    $imagePath = ''; // Initialize image path variable

    // Check if a new image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Temporary file and file name
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = time() . '_' . $_FILES['image']['name'];
        $filePath = 'uploads/' . $fileName;

        // Allowed file types
        $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($fileTmpPath);

        // Check if file type is valid
        if (!in_array($fileType, $allowedFileTypes)) {
            $_SESSION['message'] = "Invalid file type. Only JPG, PNG, and GIF are allowed.";
            header("Location: student-edit.php?id=$student_id");
            exit(0);
        }

        // Check file size (max 5MB)
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        if ($_FILES['image']['size'] > $maxFileSize) {
            $_SESSION['message'] = "File size exceeds the maximum limit of 5MB.";
            header("Location: university-edit.php?id=$university_id");
            exit(0);
        }

        // Create the uploads directory if it doesn't exist
        if (!file_exists('uploads')) {
            mkdir('uploads', 0777, true);
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($fileTmpPath, $filePath)) {
            $imagePath = $filePath;
        } else {
            $_SESSION['message'] = "Image Upload Failed.";
            header("Location: university-edit.php?id=$university_id");
            exit(0);
        }
    } else {
        // If no new image is uploaded, retain the existing image
        // Get the existing image from the database
        $query = "SELECT image FROM universities WHERE id='$university_id'";
        $result = mysqli_query($link, $query);
        $existing_university = mysqli_fetch_array($result);
        $imagePath = $existing_university['image']; // Retain the old image if no new one is uploaded
    }

    // Update student data in the database
    $query = "UPDATE universities 
              SET name='$name',
              address='$address',
              image='$imagePath' 
              WHERE id='$university_id'";

    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        $_SESSION['message'] = "University Updated Successfully";
        header("Location: university-edit.php?id=$university_id");
        exit(0);
    } else {
        $_SESSION['message'] = "University Not Updated";
        header("Location: university-edit.php?id=$university_id");
        exit(0);
    }
}


// Save Student
if (isset($_POST['save_university'])) {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $address = mysqli_real_escape_string($link, $_POST['address']);

    // Handle image upload
    $imagePath = '';

    // Check if file is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Temporary file and file name
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = time() . '_' . $_FILES['image']['name'];
        $filePath = 'uploads/' . $fileName;
    
        // Allowed file types
        $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($fileTmpPath);
    
        // Check if file type is valid
        if (!in_array($fileType, $allowedFileTypes)) {
            $_SESSION['message'] = "Invalid file type. Only JPG, PNG, and GIF are allowed.";
            header("Location: university-create.php");
            exit(0);
        }
    
        // Check file size (max 5MB)
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        if ($_FILES['image']['size'] > $maxFileSize) {
            $_SESSION['message'] = "File size exceeds the maximum limit of 5MB.";
            header("Location: university-create.php");
            exit(0);
        }
    
        // Create the uploads directory if not exists
        if (!file_exists('uploads')) {
            mkdir('uploads', 0777, true);
        }
    
        // Move the uploaded file to the target directory
        if (move_uploaded_file($fileTmpPath, $filePath)) {
            $imagePath = $filePath;
        } else {
            $_SESSION['message'] = "Image Upload Failed.";
            header("Location: university-create.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "No file uploaded or an error occurred.";
        header("Location: university-create.php");
        exit(0);
    }

    $query = "INSERT INTO universities (name, address, image) 
              VALUES ('$name', '$address', '$imagePath')";

    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        $_SESSION['message'] = "University Created Successfully";
        header("Location: university-create.php");
        exit(0);
    } else {
        $_SESSION['message'] = "University Not Created";
        header("Location: university-create.php");
        exit(0);
    }
}

?>