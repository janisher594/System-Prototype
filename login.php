<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Market Billing Login</title>

    <style>

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #74b9ff, #55efc4);
            height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }


        .login-box {
            background: white;
            width: 350px;
            padding: 40px 35px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .login-box:hover {
            transform: scale(1.02);
        }

        h2 {
            color: #2d3436;
            font-size: 26px;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }


        input {
            margin: 10px 0;
            padding: 12px;
            width: 90%;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: #0984e3;
            box-shadow: 0 0 5px rgba(52,152,219,0.5);
            outline: none;
        }


        button {
            background: #0984e3;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            width: 95%;
            font-size: 16px;
            font-weight: bold;
            margin-top: 15px;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background: #0652DD;
            transform: scale(1.05);
        }


        p {
            color: #e74c3c;
            font-weight: bold;
            margin-top: 15px;
        }


        .footer {
            margin-top: 20px;
            font-size: 13px;
            color: #636e72;
        }

        .footer a {
            color: #0984e3;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <h2>Login</h2>

        <form method="post">
            <input type="text" name="username" placeholder="Enter Username" required><br>
            <input type="password" name="password" placeholder="Enter Password" required><br>
            <button type="submit">Login</button>

            <?php if (isset($error)) echo "<p>$error</p>"; ?>
        </form>

        </div>
    </div>

</body>
</html>
