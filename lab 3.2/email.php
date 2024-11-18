<?php
session_start();

if (isset($_POST['submit'])) {


    $email = $_REQUEST['email'];

  
    if (empty($email)) {
        echo "Email cannot be empty!";
    }
    
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email must be a valid email address (e.g., anything@example.com)!";
    }
   
    else {
        $_SESSION['flag'] = true;
        header('location: email.php'); 
    }

} else {
    header('location: email.html'); 
}
?>

