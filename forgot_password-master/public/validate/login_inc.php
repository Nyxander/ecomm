<?php
session_start();
include 'conn.php';

if (isset($_POST['submitAdmin'])) {
    $uName = $_POST['uName'];
    $password = $_POST['password'];

    // Validate the input
    if (empty($uName) || empty($password)) {
        $_SESSION['error'] = "Please fill in both fields.";
        header("Location: ../index.php"); // Redirect back to the login page
        exit();
    }

    // Admin login query
    $sql = "SELECT * FROM staff WHERE (mail = ? OR uName = ?) AND role = 'admin'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $uName, $uName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Correct password, login successful
            $_SESSION['admin_id'] = $row['userId'];
            $_SESSION['admin_name'] = $row['username'];
            header("Location: ../dashboard/dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Incorrect password.";
            header("Location: ../index.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "No such admin found.";
        header("Location: ../index.php"); // Redirect back to the login page
        exit();
    }
}

// Check if form is submitted for User login
if (isset($_POST['submitUser'])) {
    $uName = $_POST['uName'];
    $password = $_POST['password'];

    // Validate the input
    if (empty($uName) || empty($password)) {
        $_SESSION['error'] = "Please fill in both fields.";
        header("Location: ../index.php"); // Redirect back to the login page
        exit();
    }

    // User login query
    $sql = "SELECT * FROM users WHERE (mail = ? OR uName = ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $uName, $uName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Correct password, login successful
            $_SESSION['sessionId'] = $row['userId'];
            $_SESSION['user_name'] = $row['username'];
            header("Location: ../dashboard/u_dashboard.php"); // Redirect to user dashboard
            exit();
        } else {
            $_SESSION['error'] = "Incorrect password.";
            header("Location: ../index.php"); // Redirect back to the login page
            exit();
        }
    } else {
        $_SESSION['error'] = "No such user found.";
        header("Location: ../index.php"); // Redirect back to the login page
        exit();
    }
}



?>
