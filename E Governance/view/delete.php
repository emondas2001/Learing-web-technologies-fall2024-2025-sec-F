<?php
session_start();


include '../model/db_connect.php';


if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}


$email = $_SESSION['email'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $conn->prepare("DELETE FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
     
        session_destroy(); 
        header("Location: login.php?message=Account deleted successfully.");
        exit;
    } else {
       
        $error = "Error deleting account. Please try again later.";
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
   <title>Delete Account</title>
   <style>
       body {
           display: flex;
           justify-content: center;
           align-items: center;
           min-height: 100vh;
           font-family: Arial, sans-serif;
           background-color: #f4f4f9;
           margin: 0;
       }

       .container {
           background: #fff;
           padding: 2rem;
           border-radius: 10px;
           box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
           text-align: center;
           max-width: 400px;
           width: 90%;
       }

       h1 {
           color: #d9534f;
           margin-bottom: 1rem;
       }

       p {
           margin-bottom: 1.5rem;
           color: #555;
       }

       .btn {
           display: inline-block;
           padding: 0.5rem 1rem;
           margin: 0.5rem;
           text-decoration: none;
           color: #fff;
           border-radius: 5px;
           font-weight: bold;
           transition: background 0.3s ease;
       }

       .btn-danger {
           background: #d9534f;
       }

       .btn-danger:hover {
           background: #c9302c;
       }

       .btn-secondary {
           background: #6c757d;
       }

       .btn-secondary:hover {
           background: #5a6268;
       }
   </style>
</head>
<body>
<div class="container">
    <h1>Delete Account</h1>
    <p>Are you sure you want to delete your account? This action cannot be undone.</p>
    <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
    <form method="POST">
        <button type="submit" class="btn btn-danger">Yes, Delete</button>
        <a href="profile.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
