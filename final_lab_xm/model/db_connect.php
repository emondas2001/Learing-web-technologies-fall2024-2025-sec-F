<?php
// db_connect.php

$servername = "localhost";
$username = "root";  // Your MySQL username
$password = "";      // Your MySQL password (default is an empty string)
$dbname = "shop_management"; // Your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

