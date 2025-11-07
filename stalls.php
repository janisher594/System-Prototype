<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stall = $_POST['stall_no'];
    $loc = $_POST['location'];
    $price = $_POST['rent_price'];
    $conn->query("INSERT INTO stalls (stall_no, location, rent_price) VALUES ('$stall','$loc','$price')");
}

$stalls = $conn->query("SELECT * FROM stalls");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stalls Management</title>

    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #74b9ff, #55efc4);
            margin: 0;
            padding: 0;
            text-align: center;
            color: #2c3e50;
        }

        h2 {
            margin-top: 40px;
            font-size: 32px;
            color: #2d3436;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
        }

        form {
            background: white;
            display: inline-block;
            padding: 25px 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            margin: 30px auto;
            text-align: left;
            transition: transform 0.3s ease;
        }

        form:hover {
            transform: translateY(-5px);
        }

        input {
            margin: 8px;
            padding: 10px;
            width: 230px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 5px rgba(52,152,219,0.5);
        }

        button {
            background: #0984e3;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: bold;
            margin-left: 8px;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background: #0652DD;
            transform: scale(1.05);
        }

        table {
            margin: 30px auto 60px;
            border-collapse: collapse;
            width: 85%;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background: #0984e3;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        tr:hover {
            background: #dfe6e9;
            transition: background 0.3s;
        }

        a.back {
            display: inline-block;
            margin-bottom: 30px;
            color: #2d3436;
            background: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        a.back:hover {
            background: #0984e3;
            color: white;
            transform: translateY(-3px);
        }
    </style>
</head>
<body>

    <h2> Stalls Management</h2>

    <form method="post">
        <label><strong>Stall No:</strong></label><br>
        <input type="text" name="stall_no" placeholder="Enter Stall No" required><br>

        <label><strong>Location:</strong></label><br>
        <input type="text" name="location" placeholder="Enter Location" required><br>

        <label><strong>Rent Price:</strong></label><br>
        <input type="number" name="rent_price" step="0.01" placeholder="Enter Rent Price" required><br>

        <center><button type="submit">➕ Add Stall</button></center>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Stall No</th>
            <th>Location</th>
            <th>Rent Price</th>
            <th>Status</th>
        </tr>
        <?php while($s = $stalls->fetch_assoc()): ?>
        <tr>
            <td><?= $s['id'] ?></td>
            <td><?= htmlspecialchars($s['stall_no']) ?></td>
            <td><?= htmlspecialchars($s['location']) ?></td>
            <td>₱<?= number_format($s['rent_price'], 2) ?></td>
            <td><?= htmlspecialchars($s['status']) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <a class="back" href="dashboard.php">← Back to Dashboard</a>

</body>
</html>
