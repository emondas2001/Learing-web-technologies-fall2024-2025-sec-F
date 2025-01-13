
<?php
session_start();
require_once '../model/db_connect.php';  // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $name = $_POST['name']
    $username = $_POST['username'];
    $password = $_POST['password'];
    $contact_no = $_POST['contact_no']

    // Validate for empty fields
    if (empty($username) || empty($password)) {
        echo "Username and password are required!";
        exit;
    }

    // SQL query to check if the username already exists
    $query = "SELECT * FROM employee WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        // Insert new user into the database with the plain text password
        $query = "INSERT INTO employee (name, username, password, contact_no) VALUES ('$name','$username', '$password', '$contact_no')";
        if (mysqli_query($conn, $query)) {
            echo "User registered successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Username already exists!";
    }
}
?>
