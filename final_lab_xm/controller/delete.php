<?php
require_once '../model/db_connect.php';

if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $query = "DELETE FROM employee WHERE username = '$username'";
    mysqli_query($conn, $query);
    header('Location: dashboard.php');  // Redirect to dashboard after deletion
}
?>
