<?php
session_start();


if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}


$user_email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency Services</title>
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
            color: #dc3545;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #c82333;
        }

        .suggestions {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            display: none;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Emergency Services</h1>
    <p>Welcome, <?php echo htmlspecialchars($user_email); ?>. Describe your emergency situation below and get instant suggestions.</p>
    <form id="emergencyForm">
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" placeholder="Enter your full name" required>
        </div>
        <div class="form-group">
            <label for="contact_number">Contact Number</label>
            <input type="text" id="contact_number" name="contact_number" placeholder="Enter your contact number" required>
        </div>
        <div class="form-group">
            <label for="emergency_type">Type of Emergency</label>
            <select id="emergency_type" name="emergency_type" required>
                <option value="">-- Select Emergency Type --</option>
                <option value="Medical">Medical</option>
                <option value="Fire">Fire</option>
                <option value="Police">Police</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="5" placeholder="Describe the emergency situation" required></textarea>
        </div>
        <button type="submit">Submit</button>
        <div class="error" id="error"></div>
    </form>
    <div class="suggestions" id="suggestions">
        <h3>Suggestions:</h3>
        <p id="suggestionText"></p>
    </div>
</div>

<script>
    document.getElementById("emergencyForm").addEventListener("submit", function (e) {
        e.preventDefault();

        const fullName = document.getElementById("full_name").value;
        const contactNumber = document.getElementById("contact_number").value;
        const emergencyType = document.getElementById("emergency_type").value;
        const description = document.getElementById("description").value;

        if (!fullName || !contactNumber || !emergencyType || !description) {
            document.getElementById("error").textContent = "All fields are required.";
            return;
        }

        document.getElementById("error").textContent = "";

     
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "process_emergency.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function () {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    document.getElementById("suggestions").style.display = "block";
                    document.getElementById("suggestionText").textContent = response.suggestion;
                } else {
                    document.getElementById("error").textContent = response.message;
                }
            }
        };

        const params = `full_name=${encodeURIComponent(fullName)}&contact_number=${encodeURIComponent(contactNumber)}&emergency_type=${encodeURIComponent(emergencyType)}&description=${encodeURIComponent(description)}`;
        xhr.send(params);
    });
</script>

</body>
</html>
