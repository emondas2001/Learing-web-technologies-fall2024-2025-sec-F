<?php
session_start();


include '../model/db_connect.php';


if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}


$user_email = $_SESSION['email'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $item_name = htmlspecialchars(trim($_POST['item_name']));
    $quantity = htmlspecialchars(trim($_POST['quantity']));
    $price = htmlspecialchars(trim($_POST['price']));
    $payment_method = htmlspecialchars(trim($_POST['payment_method']));


    if (empty($item_name) || empty($quantity) || empty($price) || empty($payment_method)) {
        $error_message = "All fields are required.";
    } else {

        $total_cost = $quantity * $price;

        
        $stmt = $conn->prepare("INSERT INTO invoices (item_name, quantity, price, payment_method, total_cost, email) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("siisss", $item_name, $quantity, $price, $payment_method, $total_cost, $user_email);

      
        if ($stmt->execute()) {
            $success_message = "Invoice Created Successfully!";
            $memo_message = "Item: $item_name<br>Quantity: $quantity<br>Price: $$price<br>Total Cost: $$total_cost<br>Payment Method: $payment_method";
        } else {
            $error_message = "Failed to create invoice. Please try again.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .wrapper {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: #007bff;
            color: #fff;
            text-align: center;
            padding: 20px;
            border-radius: 10px 10px 0 0;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .form-container {
            padding: 20px;
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
            font-size: 14px;
        }

        button {
            background: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #218838;
        }

        .message {
            text-align: center;
            font-size: 16px;
            margin-top: 20px;
        }

        .memo {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-top: 30px;
        }

        .memo h3 {
            margin: 0 0 10px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>Invoice Creation</h1>
            <p>Fill out the form below to create your invoice.</p>
        </div>
        <div class="form-container">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="item_name">Item Name</label>
                    <input type="text" id="item_name" name="item_name" placeholder="Enter item name" required>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" name="quantity" placeholder="Enter quantity" required>
                </div>
                <div class="form-group">
                    <label for="price">Price per Item</label>
                    <input type="number" step="0.01" id="price" name="price" placeholder="Enter price per item" required>
                </div>
                <div class="form-group">
                    <label for="payment_method">Payment Method</label>
                    <select id="payment_method" name="payment_method" required>
                        <option value="">--Select Payment Method--</option>
                        <option value="Credit Card">Credit Card</option>
                        <option value="Debit Card">Debit Card</option>
                        <option value="PayPal">PayPal</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                    </select>
                </div>
                <button type="submit">Create Invoice</button>
            </form>

            <?php if (isset($error_message)): ?>
                <p class="message" style="color: red;"><?php echo $error_message; ?></p>
            <?php endif; ?>

            <?php if (isset($success_message)): ?>
                <p class="message" style="color: green;"><?php echo $success_message; ?></p>
                <div class="memo">
                    <h3>Invoice Memo</h3>
                    <p><?php echo $memo_message; ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
