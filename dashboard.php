<?php
session_start();
if (!isset($_SESSION['username'])) header("Location: login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Market Billing Dashboard</title>

    <style>

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #3498db, #2ecc71);
            height: 100vh;
            color: #333;
        }


        .welcome-box {
            background: white;
            max-width: 600px;
            margin: 100px auto 20px;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .welcome-box:hover {
            transform: scale(1.02);
        }

        .welcome-box h2 {
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .welcome-box p {
            color: #666;
            margin-top: 0;
            font-size: 16px;
        }

        nav {
            background: #2980b9;
            padding: 15px 0;
            display: flex;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 20px;
            font-weight: bold;
            font-size: 16px;
            position: relative;
            transition: all 0.3s ease;
        }

        
        nav a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            left: 50%;
            bottom: -5px;
            background: white;
            transition: all 0.3s ease;
        }

        nav a:hover::after {
            width: 100%;
            left: 0;
        }

        nav a:hover {
            color: #f1f1f1;
        }

        
        .cards {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 30px;
            gap: 20px;
        }

        .card {
            background: white;
            width: 200px;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            color: #3498db;
            margin-bottom: 5px;
        }

        .card p {
            color: #555;
            font-size: 14px;
        }

      
        .logout {
            display: inline-block;
            background: #e74c3c;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 25px;
            transition: background 0.3s ease;
        }

        .logout:hover {
            background: #c0392b;
        }

 
        @media (max-width: 600px) {
            .cards {
                flex-direction: column;
                align-items: center;
            }

            nav a {
                margin: 0 10px;
                font-size: 14px;
            }

            .welcome-box {
                margin: 60px 20px;
                padding: 30px;
            }
        }
    </style>
</head>
<body>

    <nav>
        <a href="vendors.php">Vendors</a>
        <a href="stalls.php">Stalls</a>
        <a href="rentals.php">Rentals</a>
        <a href="payments.php">Payments</a>
        <a href="logout.php">Logout</a>
    </nav>

    <div class="welcome-box">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p>Manage your public market stall system with ease.</p>

        <div class="cards">
            <div class="card">
                <h3> Vendors</h3>
                <p>View and add vendors.</p>
            </div>
            <div class="card">
                <h3> Stalls</h3>
                <p>Track stall information.</p>
            </div>
            <div class="card">
                <h3> Rentals</h3>
                <p>Manage stall rentals.</p>
            </div>
            <div class="card">
                <h3> Payments</h3>
                <p>Record and review payments.</p>
            </div>
        </div>

        <a href="logout.php" class="logout">Logout</a>
    </div>

</body>
</html>
