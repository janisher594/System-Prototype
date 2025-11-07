<?php
include 'db.php';

$rentals = $conn->query("SELECT r.id, v.vendor_name, s.stall_no FROM rentals r
JOIN vendors v ON r.vendor_id=v.id
JOIN stalls s ON r.stall_id=s.id");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rental = $_POST['rental_id'];
    $date = $_POST['payment_date'];
    $amount = $_POST['amount'];

    $conn->query("INSERT INTO payments (rental_id, payment_date, amount)
        VALUES ('$rental','$date','$amount')");
}

$payments = $conn->query("SELECT p.*, v.vendor_name, s.stall_no FROM payments p
JOIN rentals r ON p.rental_id=r.id
JOIN vendors v ON r.vendor_id=v.id
JOIN stalls s ON r.stall_id=s.id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payments Management</title>

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

        select, input {
            margin: 10px;
            padding: 10px;
            width: 240px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        select:focus, input:focus {
            border-color: #0984e3;
            box-shadow: 0 0 5px rgba(52,152,219,0.5);
            outline: none;
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
            transition: background 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background: #0652DD;
            transform: scale(1.05);
        }

        table {
            margin: 30px auto 60px;
            border-collapse: collapse;
            width: 90%;
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

    <h2> Record Payment</h2>

    <form method="post">
        <label><strong>Select Rental:</strong></label><br>
        <select name="rental_id" required>
            <option value="">Select Rental</option>
            <?php while($r = $rentals->fetch_assoc()): ?>
            <option value="<?= $r['id'] ?>">
                <?= htmlspecialchars($r['vendor_name']) ?> - <?= htmlspecialchars($r['stall_no']) ?>
            </option>
            <?php endwhile; ?>
        </select><br>

        <label><strong>Payment Date:</strong></label><br>
        <input type="date" name="payment_date" required><br>

        <label><strong>Amount (₱):</strong></label><br>
        <input type="number" name="amount" step="0.01" placeholder="Enter Amount" required><br>

        <center><button type="submit"> Add Payment</button></center>
    </form>

    <h2> Payment History</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Vendor</th>
            <th>Stall</th>
            <th>Date</th>
            <th>Amount</th>
        </tr>
        <?php while($p = $payments->fetch_assoc()): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['vendor_name']) ?></td>
            <td><?= htmlspecialchars($p['stall_no']) ?></td>
            <td><?= htmlspecialchars($p['payment_date']) ?></td>
            <td>₱<?= number_format($p['amount'], 2) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <a class="back" href="dashboard.php">← Back to Dashboard</a>

</body>
</html>
