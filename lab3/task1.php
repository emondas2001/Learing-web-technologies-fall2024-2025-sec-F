<!DOCTYPE html>
<html>
    <body>
<?php

function calculateArea($length, $width) 
{
    return $length * $width;
}


function calculatePerimeter($length, $width)
 {
    return 2 * ($length + $width);
}
 

$length = 10;  
$width = 5;   


$area = calculateArea($length, $width);
$perimeter = calculatePerimeter($length, $width);


echo "Length: " . $length . " units<br>";
echo "Width: " . $width . " units<br>";
echo "Area of Rectangle: " . $area . " square units<br>";
echo "Perimeter of Rectangle: " . $perimeter . " units<br>";
?>
</body>
</html>