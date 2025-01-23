
<?php
include '../model/db_connect.php';
session_start();


if (!isset($_SESSION['email'])) {
    echo "You must be logged in to update your details.";
    header("Location: login.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newEmail = trim($_POST['email']);
    $newPassword = trim($_POST['password']);
    $currentEmail = $_SESSION['email']; 

    
    if (empty($newEmail) || empty($newPassword)) {
        echo "Both email and password are required.";
        exit;
    }

    
    $stmt = $conn->prepare("UPDATE user SET email = ?, password = ? WHERE email = ?");
    $stmt->bind_param("sss", $newEmail, $newPassword, $currentEmail);

    if ($stmt->execute()) {
    
        $_SESSION['email'] = $newEmail;
        echo "Your email and password have been successfully updated.";
        header("Location: dashboard.php"); 
        exit;
    } else {
        echo "Error updating details: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Email and Password</title>
   <style>
       body, html {
           margin: 0;
           padding: 0;
           font-family: 'Arial', sans-serif;
           background-color: #f4f4f9;
           display: flex;
           justify-content: center;
           align-items: center;
           height: 100vh;
       }

       .wrapper {
           background: #ffffff;
           padding: 2rem;
           border-radius: 8px;
           box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
           width: 100%;
           max-width: 400px;
           text-align: center;
       }

       h1 {
           margin-bottom: 1.5rem;
           font-size: 1.8rem;
           color: #222;
       }

       .input-box {
           margin-bottom: 1rem;
           position: relative;
       }

       .input-box input {
           width: 100%;
           padding: 0.75rem 1rem;
           font-size: 1rem;
           border: 1px solid #ddd;
           border-radius: 4px;
           outline: none;
           transition: border-color 0.3s ease;
       }

       .input-box input:focus {
           border-color: #007BFF;
       }

       .btn {
           width: 100%;
           padding: 0.75rem;
           font-size: 1rem;
           color: #fff;
           background: #007BFF;
           border: none;
           border-radius: 4px;
           cursor: pointer;
           transition: background 0.3s ease;
       }

       .btn:hover {
           background: #0056b3;
       }
   </style>
</head>
<body>
    <div class="wrapper">
        <form method="POST" action="">
            <h1>Update Email and Password</h1>
            <div class="input-box">
                <input type="email" name="email" placeholder="New Email" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="New Password" required>
            </div>
            <button type="submit" class="btn">Update</button>
        </form>
    </div>
</body>
</html>
