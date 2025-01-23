<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f4f5f7;
        }

        
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background: #4a4e69;
            color: #fff;
            padding: 1rem 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 1rem;
        }

        .menu {
            list-style: none;
            padding: 0;
        }

        .menu li {
            margin: 1rem 0;
        }

        .menu a {
            color: #fff;
            text-decoration: none;
            font-size: 1rem;
            display: block;
            padding: 0.8rem;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .menu a:hover,
        .menu .active a {
            background: #9a8c98;
        }

        .logout a {
            text-align: center;
            padding: 0.8rem;
            border-radius: 5px;
            background: #c9ada7;
        }

        .logout a:hover {
            background: #d8a5a5;
        }

        
        .main-content {
            margin-left: 250px;
            padding: 2rem;
            width: 100%;
            background-color: #f4f5f7;
        }

        .main-content h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #4a4e69;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .feature-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .feature-card h3 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: #4a4e69;
        }

        .feature-card p {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .feature-card a {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            color: #fff;
            background: #4a4e69;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .feature-card a:hover {
            background: #9a8c98;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Dashboard</h2>
        <ul class="menu">
            <li class="active"><a href="dashboard.php">Dashboard</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li class="logout"><a href="login.php">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h1>Welcome to the Public Service Portal</h1>
        <div class="feature-grid">
            
            <div class="feature-card">
                <h3>Bills</h3>
                <p>Manage and pay your bills easily.</p>
                <a href="bills.php">View Bills</a>
            </div>

            
            <div class="feature-card">
                <h3>Education</h3>
                <p>Access educational resources and tools.</p>
                <a href="education.php">Explore Education</a>
            </div>

            
            <div class="feature-card">
                <h3>Invoices</h3>
                <p>Generate and manage your invoices.</p>
                <a href="invoices.php">View Invoices</a>
            </div>

            
            <div class="feature-card">
                <h3>Certificate Verification</h3>
                <p>Verify certificates quickly and securely.</p>
                <a href="certificate_verification.php">Verify Now</a>
            </div>

            
            <div class="feature-card">
                <h3>Health</h3>
                <p>Track your health and medical records.</p>
                <a href="health.php">Manage Health</a>
            </div>

            
            <div class="feature-card">
                <h3>Tax</h3>
                <p>File and track your taxes with ease.</p>
                <a href="tax.php">File Tax</a>
            </div>

            <div class="feature-card">
                <h3>NID</h3>
                <p>Solve your NID issues.</p>
                <a href="nid.php">View File</a>
            </div>

            <div class="feature-card">
                <h3>Emergency Protocol</h3>
                <p>Stay Calm, Stay Safe -- Help is Just a Step Away.</p>
                <a href="emergency.php">View Protocol</a>
            </div>

        </div>
    </div>
</body>
</html>
