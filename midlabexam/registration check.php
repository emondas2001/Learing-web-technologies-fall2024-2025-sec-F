<?php
session_start();

if(isset($_POST['submit'])){
    
 
    $username = trim($_REQUEST['username']);
    $password = trim($_REQUEST['password']);
    $confirm_password = trim($_REQUEST['confirm_password']);
    $email = trim($_REQUEST['email']);
    

    if($username == null || empty($password) || empty($confirm_password) || empty($email)){
        echo "All fields are required!";
    } 
   
    else if($password != $confirm_password){
        echo "Passwords do not match!";
    } 
   
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
    }

    else {
        
        $user_data = array(
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT) 
        );
        
       
        $_SESSION['user_data'] = $user_data;
        
     
        header('location: Home page.php');
        exit();
    }
} else {
 
    header('location: login page.html');
    exit();
}
?>

