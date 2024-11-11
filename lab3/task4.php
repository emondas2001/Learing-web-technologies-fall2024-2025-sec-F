
<?php

$num1 = 20;
$num2 = 35;
$num3 = 15;


if ($num1 >= $num2 && $num1 >= $num3) 
{
    echo "The largest number is: " . $num1;
} 
elseif ($num2 >= $num1 && $num2 >= $num3)
 {
    echo "The largest number is: " . $num2;
} 
else 
{
    echo "The largest number is: " . $num3;
}
?>

