<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $full_name = htmlspecialchars(trim($_POST['full_name']));
    $age = intval($_POST['age']);
    $issue = htmlspecialchars(trim($_POST['issue']));
    $priority = htmlspecialchars(trim($_POST['priority']));

    
    $suggestions = [
        "fever" => "Stay hydrated, rest well, and take over-the-counter fever reducers. If the fever persists, consult a doctor.",
        "cough" => "Drink warm fluids, use a humidifier, and avoid irritants. Persistent cough? See a doctor.",
        "headache" => "Relax in a quiet, dark room, stay hydrated, and take a mild pain reliever.",
        "other" => "Consult with a specialist for your specific concern."
    ];

    
    $lowercase_issue = strtolower($issue);
    $suggestion = $suggestions["other"]; 
    foreach ($suggestions as $key => $value) {
        if (strpos($lowercase_issue, $key) !== false) {
            $suggestion = $value;
            break;
        }
    }

    
    echo json_encode([
        "success" => true,
        "suggestion" => $suggestion
    ]);
    exit;
} else {
    echo json_encode([
        "success" => false,
        "message" => "Invalid request."
    ]);
    exit;
}
?>
