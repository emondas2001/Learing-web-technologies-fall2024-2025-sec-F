<?php
session_start();
require_once '../model/db_connect.php';  // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate for empty fields
    if (empty($username) || empty($password)) {
        echo "Username and password are required!";
        exit;
    }

    // SQL query to fetch user details
    $query = "SELECT * FROM employee WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Fetch the user record
        $user = mysqli_fetch_assoc($result);

        // Compare the plain text password with the stored one
        if ($password === $user['password']) {
            $_SESSION['username'] = $user['username'];  // Store the session data
            header('Location: dashboard.php');  // Redirect to dashboard
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "User not found.";
    }
}
?>
