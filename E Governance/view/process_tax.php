<?php
header("Content-Type: application/json");


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}


$full_name = isset($_POST['full_name']) ? trim($_POST['full_name']) : '';
$income = isset($_POST['income']) ? (float) $_POST['income'] : 0;
$tax_query = isset($_POST['tax_query']) ? trim($_POST['tax_query']) : '';
$priority = isset($_POST['priority']) ? trim($_POST['priority']) : '';


if (empty($full_name) || $income <= 0 || empty($tax_query) || empty($priority)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required, and income must be a positive number.']);
    exit;
}


$tax_rate = 0;
if ($income <= 25000) {
    $tax_rate = 10; 
} elseif ($income <= 100000) {
    $tax_rate = 20; 
} else {
    $tax_rate = 30; 
}


$tax_amount = $income * ($tax_rate / 100);
$suggestion = "Based on your income of $$income, your estimated tax rate is $tax_rate%. You may need to pay approximately $$tax_amount in taxes. Please consult with a tax professional for accurate calculations and additional deductions.";


echo json_encode(['success' => true, 'suggestion' => $suggestion]);
?>
