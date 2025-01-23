<?php
include '../model/db_connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $date_of_birth = trim($_POST['date_of_birth']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    $errors = [];


    if (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please provide a valid email.";
    }
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        
        $stmt = $conn->prepare("INSERT INTO user (username, email, address, date_of_birth, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $email, $address, $date_of_birth, $password);

        
        if ($stmt->execute()) {
            header('Location: login.php');
        } else {
            echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
        }
        $stmt->close();
    } else {
        
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h1 {
            text-align: center;
            margin-bottom: 1rem;
        }
        .input-box {
            margin-bottom: 1rem;
        }
        .input-box input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            background: #007bff;
            color: white;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background: #0056b3;
        }
        .switch-link {
            text-align: center;
            margin-top: 1rem;
        }
        .switch-link a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h1>Register</h1>
    <form method="POST" action="">
        <div class="input-box">
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="input-box">
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="input-box">
            <input type="text" name="address" placeholder="address" required>
        </div>
        <div class="input-box">
            <input type="date" name="date_of_birth" placeholder="date_of_birth" required>
        </div>
        <div class="input-box">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="input-box">
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        </div>
        <button type="submit" name="register" class="btn">Register</button>
    </form>
    <div class="switch-link">
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>
</div>
</body>
</html>
