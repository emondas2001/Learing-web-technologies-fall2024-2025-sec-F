<?php

function calculateVAT($amount) 
{
    $vatRate = 0.15; 
    $vatAmount = $amount * $vatRate; 
    return $vatAmount;
}


$amount = 2000; 


$vat = calculateVAT($amount);


echo "Amount: $" . number_format($amount, 2) . "<br>";
echo "VAT (15%): $" . number_format($vat, 2) . "<br>";
echo "Total (Amount + VAT): $" . number_format($amount + $vat, 2) . "<br>";
?>
    