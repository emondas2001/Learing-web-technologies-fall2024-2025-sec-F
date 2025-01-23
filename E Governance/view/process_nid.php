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
    $nid_number = htmlspecialchars(trim($_POST['nid_number']));
    $dob = htmlspecialchars(trim($_POST['dob']));


    if (empty($full_name) || empty($nid_number) || empty($dob)) {
        echo json_encode([
            "success" => false,
            "message" => "All fields are required."
        ]);
        exit;
    }


    $check_stmt = $conn->prepare("SELECT * FROM nid WHERE nid_number = ?");
    $check_stmt->bind_param("s", $nid_number);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo json_encode([
            "success" => false,
            "message" => "This NID number is already verified."
        ]);
        $check_stmt->close();
        exit;
    }

    $check_stmt->close();

  
    $stmt = $conn->prepare("INSERT INTO nid (email, full_name, nid_number, dob) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $user_email, $full_name, $nid_number, $dob);

    if ($stmt->execute()) {
        echo json_encode([
            "success" => true,
            "message" => "NID verification submitted successfully!"
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Failed to submit NID verification. Please try again."
        ]);
    }

    $stmt->close();
    exit;
} else {
    echo json_encode([
        "success" => false,
        "message" => "Invalid request method."
    ]);
    exit;
}
?>
