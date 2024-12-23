<?php 

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "your_password";
$dbName = "ecom";


    $conn = mysqli_connect($dbHost, $dbUser, $dbPass,$dbName);
    if (!$conn) {
        die ("Connection Failed");
    }

?>