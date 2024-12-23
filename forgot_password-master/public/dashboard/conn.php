<?php
// DB credentials.
// params to connect to the database
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "your_password";
$dbName = "ecom";

// connect to the database

$conn = mysqli_connect($dbHost, $dbUser, $dbPass,$dbName);
if (!$conn) {
    echo "Connection Failed";
}

?>