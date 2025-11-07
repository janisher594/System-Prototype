<?php
include 'db.php';

$vendors = $conn->query("SELECT * FROM vendors");
$stalls = $conn->query("SELECT * FROM stalls WHERE status='available'");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vendor = $_POST['vendor_id'];
    $stall = $_POST['stall_id'];
    $start = $_POST['start_date'];
    $end = $_POST['end_date'];
    $amt = $_POST['amount'];
    $or = $_POST['or_no'];

    $conn->query("INSERT INTO rentals (vendor_id, stall_id, start_date, end_date, amount, or_no)
        VALUES ('$vendor','$stall','$start','$end','$amt','$or')");
    $conn->query("UPDATE stalls SET status='occupied' WHERE id='$stall'");
}

$rentals = $conn->query("SELECT r.*, v.vendor_name, s.stall_no FROM rentals r
JOIN vendors v ON r.vendor_id=v.id
JOIN stalls s ON r.stall_id=s.id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rentals Management</title>

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

    <h2> New Rental</h2>

    <form method="post">
        <label><strong>Select Vendor:</strong></label><br>
        <select name="vendor_id" required>
            <option value="">Select Vendor</option>
            <?php while($v=$vendors->fetch_assoc()): ?>
            <option value="<?= $v['id'] ?>"><?= htmlspecialchars($v['vendor_name']) ?></option>
            <?php endwhile; ?>
        </select><br>

        <label><strong>Select Stall:</strong></label><br>
        <select name="stall_id" required>
            <option value="">Select Stall</option>
            <?php while($s=$stalls->fetch_assoc()): ?>
            <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['stall_no']) ?></option>
            <?php endwhile; ?>
        </select><br>

        <label><strong>Start Date:</strong></label><br>
        <input type="date" name="start_date" required><br>

        <label><strong>End Date:</strong></label><br>
        <input type="date" name="end_date" required><br>

        <label><strong>Amount (₱):</strong></label><br>
        <input type="number" name="amount" step="0.01" placeholder="Amount" required><br>

        <label><strong>OR No.:</strong></label><br>
        <input type="text" name="or_no" placeholder="Official Receipt No." required><br>

        <center><button type="submit"> Save Rental</button></center>
    </form>

    <h2> Rental Records</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Vendor</th>
            <th>Stall</th>
            <th>Start</th>
            <th>End</th>
            <th>Amount</th>
        </tr>
        <?php while($r = $rentals->fetch_assoc()): ?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td><?= htmlspecialchars($r['vendor_name']) ?></td>
            <td><?= htmlspecialchars($r['stall_no']) ?></td>
            <td><?= htmlspecialchars($r['start_date']) ?></td>
            <td><?= htmlspecialchars($r['end_date']) ?></td>
            <td>₱<?= number_format($r['amount'], 2) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <a class="back" href="dashboard.php">← Back to Dashboard</a>

</body>
</html>
