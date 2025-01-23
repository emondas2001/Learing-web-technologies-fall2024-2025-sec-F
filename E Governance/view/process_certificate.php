<?php
header('Content-Type: application/json');


$valid_certificates = [
    ["certificate_id" => "CERT123", "full_name" => "Upanta Chowdhury", "issue_date" => "2023-01-15"],
    ["certificate_id" => "CERT456", "full_name" => "Emon Das", "issue_date" => "2022-12-01"]
];


$certificate_id = isset($_POST['certificate_id']) ? trim($_POST['certificate_id']) : '';
$full_name = isset($_POST['full_name']) ? trim($_POST['full_name']) : '';
$issue_date = isset($_POST['issue_date']) ? trim($_POST['issue_date']) : '';


if (empty($certificate_id) || empty($full_name) || empty($issue_date)) {
    echo json_encode([
        'success' => false,
        'message' => 'All fields are required.'
    ]);
    exit;
}


$isValid = false;
foreach ($valid_certificates as $certificate) {
    if ($certificate['certificate_id'] === $certificate_id && 
        $certificate['full_name'] === $full_name && 
        $certificate['issue_date'] === $issue_date) {
        $isValid = true;
        break;
    }
}

if ($isValid) {
    echo json_encode([
        'success' => true,
        'message' => 'Certificate is valid.'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Certificate not found or invalid details.'
    ]);
}
?>
