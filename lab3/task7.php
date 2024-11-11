<?php

echo "Shape 1:\n";
for ($i = 1; $i <= 3; $i++) {  
    for ($j = 1; $j <= $i; $j++) { 
        echo "* ";
    }
    echo "\n"; 
}

echo "\nShape 2:\n";
for ($i = 3; $i >= 1; $i--) { 
    for ($j = 1; $j <= $i; $j++) { 
        echo $j;
    }
    echo "\n";  
}


echo "\nShape 3:\n";
$char = 'A'; 
for ($i = 1; $i <= 3; $i++) {  
    for ($j = 1; $j <= $i; $j++) {  
        echo $char . " ";
        $char++; 
    }
    echo "\n";  
}
?>
