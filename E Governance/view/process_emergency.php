<?php
session_start();


if (!isset($_SESSION['email'])) {
    echo json_encode([
        "success" => false,
        "message" => "You are not logged in. Please log in to continue."
    ]);
    exit;
}


include '../model/db_connect.php';


$user_email = $_SESSION['email'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = htmlspecialchars(trim($_POST['full_name']));
    $contact_number = htmlspecialchars(trim($_POST['contact_number']));
    $emergency_type = htmlspecialchars(trim($_POST['emergency_type']));
    $description = htmlspecialchars(trim($_POST['description']));

    if (empty($full_name) || empty($contact_number) || empty($emergency_type) || empty($description)) {
        echo json_encode([
            "success" => false,
            "message" => "All fields are required."
        ]);
        exit;
    }


    $stmt = $conn->prepare("INSERT INTO emergency_records (email, full_name, contact_number, emergency_type, description) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $user_email, $full_name, $contact_number, $emergency_type, $description);

    if ($stmt->execute()) {
  
        $suggestion = "Please stay calm. Contact emergency services or dial 911 immediately for assistance.";
        if ($emergency_type === "Medical") {
            $suggestion = "Call an ambulance or visit the nearest hospital. Dial 999";
        } elseif ($emergency_type === "Fire") {
            $suggestion = "Evacuate immediately and call the fire department. Dial 999";
        } elseif ($emergency_type === "Police") {
            $suggestion = "Call the police hotline or visit the nearest station. Dail 999";
        }

        echo json_encode([
            "success" => true,
            "suggestion" => $suggestion
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Failed to submit the emergency request. Please try again."
        ]);
    }

    $stmt->close();
} else {
    echo json_encode([
        "success" => false,
        "message" => "Invalid request method."
    ]);
    exit;
}
?>
