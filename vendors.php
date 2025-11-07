<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['vendor_name'];
    $contact = $_POST['contact_no'];
    $addr = $_POST['address'];

    $conn->query("INSERT INTO vendors (vendor_name, contact_no, address) VALUES ('$name','$contact','$addr')");
}

$vendors = $conn->query("SELECT * FROM vendors");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vendors Management</title>

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
            margin: 10px;
            padding: 10px;
            width: 230px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: #0984e3;
            outline: none;
            box-shadow: 0 0 5px rgba(52,152,219,0.5);
        }

        button {
            background: #0984e3;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: bold;
            margin-left: 10px;
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

    <h2> Vendors Management</h2>

    <form method="post">
        <label><strong>Vendor Name:</strong></label><br>
        <input type="text" name="vendor_name" placeholder="Enter Vendor Name" required><br>

        <label><strong>Contact No:</strong></label><br>
        <input type="text" name="contact_no" placeholder="Enter Contact Number" required><br>

        <label><strong>Address:</strong></label><br>
        <input type="text" name="address" placeholder="Enter Address" required><br>

        <center><button type="submit">➕ Add Vendor</button></center>
    </form>

    <h2> Vendors List</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Vendor Name</th>
            <th>Contact</th>
            <th>Address</th>
        </tr>
        <?php while($v = $vendors->fetch_assoc()): ?>
        <tr>
            <td><?= $v['id'] ?></td>
            <td><?= htmlspecialchars($v['vendor_name']) ?></td>
            <td><?= htmlspecialchars($v['contact_no']) ?></td>
            <td><?= htmlspecialchars($v['address']) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <a class="back" href="dashboard.php">← Back to Dashboard</a>

</body>
</html>
