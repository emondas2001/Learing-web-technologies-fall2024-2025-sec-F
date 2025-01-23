<?php
include '../model/db_connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    
    if (empty($email) || empty($password)) {
        echo "Both email and password are required.";
        exit;
    }

    
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        
        $_SESSION['email'] = $email; 
        echo "Login successful!";
        header("Location: dashboard.php");
        exit;
    } else {
        
        echo "<p style='color: red;'>Invalid email or password.</p>";
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
   <title>Login</title>
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
           color: #333;
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

       
       .wrapper h1 {
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

       
       .remember-forgot {
           display: flex;
           justify-content: space-between;
           align-items: center;
           font-size: 0.9rem;
           margin-bottom: 1rem;
       }

       .remember-forgot a {
           color: #007BFF;
           text-decoration: none;
           transition: color 0.3s ease;
       }

       .remember-forgot a:hover {
           color: #0056b3;
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

       
       .register-link {
           font-size: 0.9rem;
           margin-top: 1rem;
       }

       .register-link a {
           color: #007BFF;
           text-decoration: none;
           font-weight: bold;
           transition: color 0.3s ease;
       }

       .register-link a:hover {
           color: #0056b3;
       }
   </style>
</head>
<body>
    <div class="wrapper">
        <form method="POST" action="">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" name="email" placeholder="Email" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox"> Remember me</label><br>
                <a href="register.php">Forgot password?</a>
            </div>
            <button type="submit" class='btn'>Login</button>
            <div class="register-link">
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>
        </form>
    </div>
</body>
</html>

