<?php

if (isset($_POST['submit'])) {

    require "conn.php";

    $uName = $_POST['uName'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Error handling
    if (empty($uName) || empty($mail) || empty($password) || empty($confirm_password)) {
        header("Location:../pages/create-account.php?error=emptyfields&username=".$uName);
        exit();
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $uName)) {
        header("Location:../pages/create-account.php?error=invalidfields&username=".$uName);
        exit();
    } elseif ($password !== $confirm_password) {
        header("Location:../create-account.php?error=passworddonotmatch&username=".$uName);
        exit();
    } else {
        // Check if username already exists
        $sql = "SELECT uName FROM users WHERE uName = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location:../create-account.php?error=sqlerror1");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $uName); // Fix: Only bind $uName
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $rowCount = mysqli_stmt_num_rows($stmt);
            if ($rowCount > 0) {
                header("Location:../create-account.php?error=usernametaken&username=".$uName);
                exit();
            } else {
                // Insert data into the database
                $sql = "INSERT INTO users (uName, mail, password) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location:../create-account.php?error=sqlerror2");
                    exit();
                } else {
                    // Hash password and insert into the database
                    $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sss", $uName, $mail, $hashedPass);
                    mysqli_stmt_execute($stmt);
                    header("Location:../dashboard/u_dashboard.php?success=registered"); // Fix: Correct spelling of 'success'
                }
            }
        }
    }
}

?>
