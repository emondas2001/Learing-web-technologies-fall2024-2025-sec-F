<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
 {
    
    if (isset($_POST['gender']) && !empty($_POST['gender'])) 
    {
        $gender = $_POST['gender'];

 
        if ($gender == 'male') {
            echo "You have selected Male.";
        } elseif ($gender == 'female') {
            echo "You have selected Female.";
        } elseif ($gender == 'other') {
            echo "You have selected Other.";
        }
        else
        {
     
            echo "Error: You must select at least one gender option.";
        }
       
    
    } 
     
    else {
        $_SESSION['flag'] = true;
        header('location: gender.php'); 
    }

} else {
    header('location: gender.html'); 
    
    


  
   
}
?>

