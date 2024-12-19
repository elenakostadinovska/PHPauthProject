<?php
session_start();
require '../db_conn/dbcon.php';

if (isset($_POST['delete_student'])) {
    // Sanitize and validate the student ID
    $student_id = $_POST['delete_student'];

    // Validate that student ID is numeric
    if (!is_numeric($student_id)) {
        $_SESSION['message'] = "Invalid student ID";
        header("Location: index.php");
        exit(0);
    }

    // Check if the student exists
    $check_query = "SELECT * FROM students WHERE id='$student_id'";
    $check_query_run = mysqli_query($link, $check_query);
    if (mysqli_num_rows($check_query_run) <= 0) {
        $_SESSION['message'] = "Student not found";
        header("Location: index.php");
        exit(0);
    }

    // Get the student data to check for the image
    $student = mysqli_fetch_assoc($check_query_run);
    $imagePath = $student['image'];
    
    // If an image exists, delete it from the server
    if ($imagePath && file_exists($imagePath)) {
        unlink($imagePath);  // Delete the image file from the server
    }

    // Delete the student record from the database
    $delete_query = "DELETE FROM students WHERE id='$student_id'";
    $delete_query_run = mysqli_query($link, $delete_query);

    if ($delete_query_run) {
        $_SESSION['message'] = "Student Deleted Successfully";
        header("Location: index.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Student Not Deleted. Error: " . mysqli_error($link);
        header("Location: index.php");
        exit(0);
    }
}



// Update student
if (isset($_POST['update_student'])) {
    $student_id = mysqli_real_escape_string($link, $_POST['student_id']);
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $phone = mysqli_real_escape_string($link, $_POST['phone']);
    $course = mysqli_real_escape_string($link, $_POST['course']);
    $address = mysqli_real_escape_string($link, $_POST['address']);
    $birth = mysqli_real_escape_string($link, $_POST['birth']);

    // Validate gender and stat against allowed ENUM values
    $allowed_genders = ['Male', 'Female', 'Other'];
    $allowed_stats = ['Active', 'Inactive', 'Graduated'];
    $gender = in_array($_POST['gender'], $allowed_genders) ? $_POST['gender'] : 'Other';
    $stat = in_array($_POST['stat'], $allowed_stats) ? $_POST['stat'] : 'Active';

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
            header("Location: student-edit.php?id=$student_id");
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
            header("Location: student-edit.php?id=$student_id");
            exit(0);
        }
    } else {
        // If no new image is uploaded, retain the existing image
        // Get the existing image from the database
        $query = "SELECT image FROM students WHERE id='$student_id'";
        $result = mysqli_query($link, $query);
        $existing_student = mysqli_fetch_array($result);
        $imagePath = $existing_student['image']; // Retain the old image if no new one is uploaded
    }

    // Update student data in the database
    $query = "UPDATE students 
              SET name='$name', email='$email', phone='$phone', course='$course', 
                  address='$address', birth='$birth', gender='$gender', stat='$stat', image='$imagePath' 
              WHERE id='$student_id'";

    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        $_SESSION['message'] = "Student Updated Successfully";
        header("Location: student-edit.php?id=$student_id");
        exit(0);
    } else {
        $_SESSION['message'] = "Student Not Updated";
        header("Location: student-edit.php?id=$student_id");
        exit(0);
    }
}


// Save Student
if (isset($_POST['save_student'])) {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $phone = mysqli_real_escape_string($link, $_POST['phone']);
    $course = mysqli_real_escape_string($link, $_POST['course']);
    $address = mysqli_real_escape_string($link, $_POST['address']);
    $birth = mysqli_real_escape_string($link, $_POST['birth']);

    // Validate gender and stat against allowed ENUM values
    $allowed_genders = ['Male', 'Female', 'Other'];
    $allowed_stats = ['Active', 'Inactive', 'Graduated'];
    $gender = in_array($_POST['gender'], $allowed_genders) ? $_POST['gender'] : 'Other';
    $stat = in_array($_POST['stat'], $allowed_stats) ? $_POST['stat'] : 'Active';

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
            header("Location: student-create.php");
            exit(0);
        }
    
        // Check file size (max 5MB)
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        if ($_FILES['image']['size'] > $maxFileSize) {
            $_SESSION['message'] = "File size exceeds the maximum limit of 5MB.";
            header("Location: student-create.php");
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
            header("Location: student-create.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "No file uploaded or an error occurred.";
        header("Location: student-create.php");
        exit(0);
    }

    $query = "INSERT INTO students (name, email, phone, course, address, birth, gender, stat, image) 
              VALUES ('$name', '$email', '$phone', '$course', '$address', '$birth', '$gender', '$stat', '$imagePath')";

    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        $_SESSION['message'] = "Student Created Successfully";
        header("Location: student-create.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Student Not Created";
        header("Location: student-create.php");
        exit(0);
    }
}

?>