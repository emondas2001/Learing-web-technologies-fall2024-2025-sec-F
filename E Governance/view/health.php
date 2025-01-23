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
    <title>Health Services</title>
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
            color: #28a745;
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
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #218838;
        }

        .suggestions {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
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
    <h1>Health Services</h1>
    <p>Welcome, <?php echo htmlspecialchars($user_email); ?>. Describe your health concern below and get instant suggestions.</p>
    <form id="healthForm">
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" placeholder="Enter your full name" required>
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" id="age" name="age" placeholder="Enter your age" required>
        </div>
        <div class="form-group">
            <label for="issue">Health Concern</label>
            <textarea id="issue" name="issue" rows="5" placeholder="Describe your health issue or inquiry" required></textarea>
        </div>
        <div class="form-group">
            <label for="priority">Priority Level</label>
            <select id="priority" name="priority" required>
                <option value="">-- Select Priority Level --</option>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
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
    document.getElementById("healthForm").addEventListener("submit", function(e) {
        e.preventDefault();

        const fullName = document.getElementById("full_name").value;
        const age = document.getElementById("age").value;
        const issue = document.getElementById("issue").value;
        const priority = document.getElementById("priority").value;

     
        if (!fullName || !age || !issue || !priority) {
            document.getElementById("error").textContent = "All fields are required.";
            return;
        }

        document.getElementById("error").textContent = "";

      
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "process_health.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
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

        const params = `full_name=${encodeURIComponent(fullName)}&age=${encodeURIComponent(age)}&issue=${encodeURIComponent(issue)}&priority=${encodeURIComponent(priority)}`;
        xhr.send(params);
    });
</script>

</body>
</html>
