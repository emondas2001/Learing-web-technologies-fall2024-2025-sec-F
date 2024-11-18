
<?php
session_start();

if (isset($_POST['submit'])) {

    $name = $_REQUEST['name'];

   
    if (empty($username)) {
        echo "name cannot be empty!";
    }
    
    else if (str_word_count($username) < 2) {
        echo "name must contain at least two words!";
    }
   
    else if (strlen($name) > 0 && !ctype_alpha($name[0])) {
        echo "name must start with a letter!";
    }
   
    else {
        $valid = true;
        for ($i = 0; $i < strlen($name); $i++) {
            $char = $name[$i];
            if (!(
                (ctype_alpha($char)) ||   
                ($char == '.') ||         
                ($char == '-')           
            )) {
                $valid = false;
                break;
            }
        }

        if (!$valid) {
            echo "name can only contain letters, periods, and dashes!";
        } else {
          
            $_SESSION['flag'] = true;
            header('location: name.php');
        }
    }

} else {
   
    header('location: name.html');
}
?>
