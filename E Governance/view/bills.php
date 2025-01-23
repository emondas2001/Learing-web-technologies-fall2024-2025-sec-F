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
    <title>Bill Submission Form</title>
    <style>
        body {
            background-color: #f4f4f9;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 20px;
        }

        .header {
            background: #007BFF;
            color: white;
            text-align: center;
            padding: 20px;
            border-radius: 10px 10px 0 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background: #007BFF;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .message {
            text-align: center;
            font-size: 16px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>Bill Submission Form</h1>
        </div>
        <form method="POST" action="">
            <div class="form-group">
                <label for="bill_type">Bill Type</label>
                <select id="bill_type" name="bill_type" required>
                    <option value="">--Select Bill Type--</option>
                    <option value="Electricity">Electricity</option>
                    <option value="Water">Water</option>
                    <option value="Internet">Internet</option>
                    <option value="Gas">Gas</option>
                </select>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" id="amount" name="amount" min="1" placeholder="Enter bill amount" required>
            </div>
            <div class="form-group">
                <label for="due_date">Due Date</label>
                <input type="date" id="due_date" name="due_date" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" placeholder="Enter any additional details"></textarea>
            </div>
            <button type="submit" name="submit">Submit Bill</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           
            include '../model/db_connect.php';

            //validate inputs
            $bill_type = htmlspecialchars(trim($_POST['bill_type']));
            $amount = filter_var(trim($_POST['amount']), FILTER_VALIDATE_FLOAT);
            $due_date = trim($_POST['due_date']);
            $description = htmlspecialchars(trim($_POST['description']));

            if (!$amount || $amount <= 0) {
                echo "<p class='message' style='color: red;'>Invalid amount entered. Please try again.</p>";
            } elseif (empty($bill_type) || empty($due_date)) {
                echo "<p class='message' style='color: red;'>All fields except description are required.</p>";
            } else {
               
                $sql = "INSERT INTO bills (email, bill_type, amount, due_date, description) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssdss", $user_email, $bill_type, $amount, $due_date, $description);

                if ($stmt->execute()) {
                    echo "<p class='message' style='color: green;'>Bill submitted successfully!</p>";
                } else {
                    echo "<p class='message' style='color: red;'>Error: " . $conn->error . "</p>";
                }

                $stmt->close();
            }

            
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
