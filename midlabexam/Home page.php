<?php
    session_start();
    if (isset($_SESSION['user_data'])) {
        $user_data = $_SESSION['user_data'];
        echo "Welcome, " . $user_data['username'];
        echo "Your email is: " . $user_data['email'];
    
    
?>
<html lang="en">
<head>
    <title>Home</title>
</head>
<body>
        <h1>Welcome Home! <?php echo $_SESSION['username']?></h1>
        <a href="logout.php">logout</a>
</body>
</html>

<?php
    }else{
        header('location: login.html'); 
    }
?>

