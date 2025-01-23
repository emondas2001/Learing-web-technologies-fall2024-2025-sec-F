<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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

        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: none;
        }

        .result p {
            margin: 0;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Certificate Verification</h1>
    <p>Enter your certificate details below to verify its authenticity.</p>
    
    <form id="certificateForm">
        <div class="form-group">
            <label for="certificate_id">Certificate ID</label>
            <input type="text" id="certificate_id" name="certificate_id" placeholder="Enter Certificate ID" required>
        </div>

        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" placeholder="Enter your full name" required>
        </div>

        <div class="form-group">
            <label for="issue_date">Issue Date</label>
            <input type="date" id="issue_date" name="issue_date" required>
        </div>

        <button type="submit">Verify Certificate</button>

        <div class="error" id="error"></div>
    </form>

    <div class="result" id="result">
        <h3>Verification Result:</h3>
        <p id="resultText"></p>
    </div>
</div>

<script>
    document.getElementById("certificateForm").addEventListener("submit", function(e) {
        e.preventDefault(); 

        const certificateId = document.getElementById("certificate_id").value;
        const fullName = document.getElementById("full_name").value;
        const issueDate = document.getElementById("issue_date").value;

     
        if (!certificateId || !fullName || !issueDate) {
            document.getElementById("error").textContent = "All fields are required.";
            return;
        }

        document.getElementById("error").textContent = "";

    
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "process_certificate.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    document.getElementById("result").style.display = "block";
                    document.getElementById("resultText").textContent = response.message;
                } else {
                    document.getElementById("error").textContent = response.message;
                }
            }
        };

        const params = `certificate_id=${encodeURIComponent(certificateId)}&full_name=${encodeURIComponent(fullName)}&issue_date=${encodeURIComponent(issueDate)}`;
        xhr.send(params);
    });
</script>

</body>
</html>
