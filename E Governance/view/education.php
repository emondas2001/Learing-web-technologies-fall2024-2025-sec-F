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
    <title>Education Help Form</title>
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
            background: #28a745;
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

        textarea {
            resize: vertical;
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
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>Get Help With Your Education</h1>
            <p>Fill out the form below, and we'll assist you with your educational needs!</p>
        </div>
        <div class="form-container">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $user_email; ?>" readonly required>
                </div>
                <div class="form-group">
                    <label for="class">Class/Grade</label>
                    <select id="class" name="class" required>
                        <option value="">--Select Your Class/Grade--</option>
                        <option value="Primary">Primary</option>
                        <option value="Middle School">Middle School</option>
                        <option value="High School">High School</option>
                        <option value="Undergraduate">Undergraduate</option>
                        <option value="Postgraduate">Postgraduate</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" placeholder="Enter the subject you need help with" required>
                </div>
                <div class="form-group">
                    <label for="problem">Describe Your Problem</label>
                    <textarea id="problem" name="problem" rows="5" placeholder="Describe your educational problem in detail" required></textarea>
                </div>
                <button type="submit" name="submit">Submit Request</button>
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               
                include '../model/db_connect.php';

          
                $name = htmlspecialchars(trim($_POST['name']));
                $email = htmlspecialchars(trim($_POST['email']));
                $class = htmlspecialchars(trim($_POST['class']));
                $subject = htmlspecialchars(trim($_POST['subject']));
                $problem = htmlspecialchars(trim($_POST['problem']));

          
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "<p class='message' style='color: red;'>Invalid email address. Please try again.</p>";
                } elseif (empty($name) || empty($class) || empty($subject) || empty($problem)) {
                    echo "<p class='message' style='color: red;'>All fields are required. Please fill out the form completely.</p>";
                } else {
               
                    $sql = "INSERT INTO education (name, email, class, subject, problem) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sssss", $name, $email, $class, $subject, $problem);

                    if ($stmt->execute()) {
                        echo "<p class='message' style='color: green;'>Your request has been submitted successfully!</p>";
                    } else {
                        echo "<p class='message' style='color: red;'>Error: " . $conn->error . "</p>";
                    }

                    $stmt->close();
                }

              
                $conn->close();
            }
            ?>
        </div>
    </div>
</body>
</html>
