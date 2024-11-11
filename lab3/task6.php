
<?php

$array = [10, 20, 30, 40, 50];


$searchElement = 30;


$found = false;


foreach ($array as $value) 
{

    if ($value == $searchElement) {
        $found = true;
        break; 
    }
}


if ($found) {
    echo "Element $searchElement found in the array.";
} else {
    echo "Element $searchElement not found in the array.";
}
?>

