<?php
session_start();


if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}


include '../model/db_connect.php';


$user_email = $_SESSION['email'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = htmlspecialchars(trim($_POST['full_name']));
    $nid_number = htmlspecialchars(trim($_POST['nid_number']));
    $dob = htmlspecialchars(trim($_POST['dob']));

 
    if (empty($full_name) || empty($nid_number) || empty($dob)) {
        echo json_encode(["success" => false, "message" => "All fields are required."]);
        exit;
    }


    $stmt = $conn->prepare("INSERT INTO nid (email, full_name, nid_number, dob) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $user_email, $full_name, $nid_number, $dob);

    if ($stmt->execute()) {
        echo json_encode([
            "success" => true,
            "message" => "NID verification submitted successfully!",
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to submit NID verification."]);
    }

    $stmt->close();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NID Verification</title>
    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #007bff;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .result, .error {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
        }

        .result {
            background-color: #e9f7e9;
            border: 1px solid #c3e6c3;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>NID Verification</h1>
    <p>Welcome, <?php echo htmlspecialchars($user_email); ?>. Please fill out the form below to verify your National ID.</p>
    <form id="nidForm">
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" placeholder="Enter your full name" required>
        </div>
        <div class="form-group">
            <label for="nid_number">NID Number</label>
            <input type="text" id="nid_number" name="nid_number" placeholder="Enter your NID number" required>
        </div>
        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="date" id="dob" name="dob" required>
        </div>
        <button type="submit">Submit</button>
        <div class="error" id="error"></div>
    </form>
    <div class="result" id="result" style="display: none;">
        <h3>Verification Status</h3>
        <p id="verificationMessage"></p>
    </div>
</div>

<script>
    document.getElementById("nidForm").addEventListener("submit", function(e) {
        e.preventDefault();

        const fullName = document.getElementById("full_name").value;
        const nidNumber = document.getElementById("nid_number").value;
        const dob = document.getElementById("dob").value;

        if (!fullName || !nidNumber || !dob) {
            document.getElementById("error").textContent = "All fields are required.";
            return;
        }

        document.getElementById("error").textContent = "";

      
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "nid.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    document.getElementById("result").style.display = "block";
                    document.getElementById("verificationMessage").textContent = response.message;
                } else {
                    document.getElementById("error").textContent = response.message;
                }
            }
        };

        const params = `full_name=${encodeURIComponent(fullName)}&nid_number=${encodeURIComponent(nidNumber)}&dob=${encodeURIComponent(dob)}`;
        xhr.send(params);
    });
</script>

</body>
</html>
