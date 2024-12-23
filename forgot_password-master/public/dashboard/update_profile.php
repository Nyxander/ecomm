<?php
session_start();
require '../validate/conn.php';

$userId = $_SESSION['admin_id'];

// Set the maximum allowed file size (8MB in bytes)
$maxFileSize = 8388608;  // 8MB

// Check if the form was submitted
if (isset($_POST['submit'])) {
    // Check if the user has uploaded a file
    if (isset($_FILES['profilePhoto']) && $_FILES['profilePhoto']['error'] == 0) {
        $fileSize = $_FILES['profilePhoto']['size'];

        // Check if the file size exceeds the limit
        if ($fileSize > $maxFileSize) {
            $_SESSION['error'] = "File size exceeds the maximum limit of 8MB.";
        } else {
            // Handle the file upload
            $fileTmpPath = $_FILES['profilePhoto']['tmp_name'];
            $fileName = $_FILES['profilePhoto']['name'];
            $fileType = $_FILES['profilePhoto']['type'];

            $uploadDir = 'images/';  // Correct the folder name here
            $destPath = $uploadDir . basename($fileName);

            // Try to move the uploaded file to the destination folder
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                // Update the profile photo path in the database
                $sql = "UPDATE staff SET profile_picture = ? WHERE staff.userId = ?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    $_SESSION['error'] = "Error: Could not update profile photo.";
                } else {
                    mysqli_stmt_bind_param($stmt, "si", $destPath, $userId);
                    mysqli_stmt_execute($stmt);

                    // On success, display a success message
                    $_SESSION['success'] = "Profile photo updated successfully!";
                }
            } else {
                $_SESSION['error'] = "Error uploading file. Please try again.";
            }
        }
    } else {
        // If no file is chosen, set an error message
        $_SESSION['error'] = "Please select a file to upload.";
    }
}

// Redirect back to dashboard.php without actually sending any header
header("Location: dashboard.php");
exit();
?>
