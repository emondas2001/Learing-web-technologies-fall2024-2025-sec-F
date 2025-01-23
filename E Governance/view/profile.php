<?php
session_start();


include '../model/db_connect.php';


if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}


$email = $_SESSION['email'];


$stmt = $conn->prepare("SELECT username, email, address, date_of_birth FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Profile</title>
   <style>
       
       * {
           margin: 0;
           padding: 0;
           box-sizing: border-box;
           font-family: Arial, sans-serif;
       }

       body {
           background-color: #f4f4f9;
           display: flex;
           justify-content: center;
           align-items: center;
           min-height: 100vh;
       }

       .wrapper-prof {
           background: #fff;
           width: 90%;
           max-width: 900px;
           border-radius: 10px;
           box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
           overflow: hidden;
       }

       .topbar {
           background: #007BFF;
           color: #fff;
           display: flex;
           justify-content: space-between;
           padding: 1rem;
           align-items: center;
       }

       .topbar a {
           color: #fff;
           text-decoration: none;
           margin: 0 1rem;
           font-weight: bold;
       }

       .row {
           display: flex;
           flex-wrap: wrap;
       }

       .sidebarprof {
           background: #f8f9fa;
           flex: 1;
           max-width: 30%;
           padding: 1.5rem;
           text-align: center;
           border-right: 1px solid #ddd;
       }

       .sidebarprof img {
           width: 120px;
           height: 120px;
           border-radius: 50%;
           margin-bottom: 1rem;
           border: 2px solid #007BFF;
       }

       .sidebarprof h3 {
           margin-bottom: 1rem;
           color: #333;
       }

       .sidebarprof .btn {
           display: inline-block;
           background: #007BFF;
           color: #fff;
           padding: 0.5rem 1rem;
           margin-top: 0.5rem;
           text-decoration: none;
           border-radius: 5px;
           font-weight: bold;
           transition: background 0.3s ease;
       }

       .sidebarprof .btn:hover {
           background: #0056b3;
       }

       .content {
           flex: 2;
           max-width: 70%;
           padding: 2rem;
       }

       .content h2 {
           margin-bottom: 1.5rem;
           color: #007BFF;
       }

       .info {
           display: flex;
           flex-direction: column;
           gap: 1rem;
       }

       .info .row {
           display: flex;
           justify-content: space-between;
           padding: 0.5rem;
           background: #f8f9fa;
           border-radius: 5px;
           border: 1px solid #ddd;
       }

       .info .label {
           font-weight: bold;
           color: #333;
       }

       .info .value {
           color: #555;
       }

       @media (max-width: 768px) {
           .row {
               flex-direction: column;
           }

           .sidebarprof {
               max-width: 100%;
               border-right: none;
               border-bottom: 1px solid #ddd;
           }

           .content {
               max-width: 100%;
           }
       }
   </style>
</head>
<body>
<div class="wrapper-prof">
    <div class="topbar">
        <a href="dashboard.php">Home</a>
        <a href="../controller/logout.php">Logout</a>
    </div>
    <div class="row">
        <div class="sidebarprof">
           
            <h3>Welcome, <?php echo htmlspecialchars($user['username']); ?></h3>
            <a href="update.php" class="btn">Update</a>
            <a href="delete.php" class="btn">Delete</a>
        </div>
        <div class="content">
            <h2>About</h2>
            <div class="info">
                <div class="row">
                    <div class="label">Username:</div>
                    <div class="value"><?php echo htmlspecialchars($user['username']); ?></div>
                </div>
                <div class="row">
                    <div class="label">Email:</div>
                    <div class="value"><?php echo htmlspecialchars($user['email']); ?></div>
                </div>
                <div class="row">
                    <div class="label">Address:</div>
                    <div class="value"><?php echo htmlspecialchars($user['address']); ?></div>
                </div>
                <div class="row">
                    <div class="label">Date of Birth:</div>
                    <div class="value"><?php echo htmlspecialchars($user['date_of_birth']); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
