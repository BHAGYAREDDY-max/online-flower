<?php
session_start();
require 'config.php';

// Redirect if not admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

// Fetch all orders
$sql = "SELECT * FROM orders ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin - Orders</title>
    <style>
        body {
            font-family: Arial;
            padding: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid #aaa;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        select {
            padding: 5px;
        }

        form {
            display: inline-block;
        }
    </style>
</head>

<body>
    <h2><a href="admin_dashboard.php">Back To Dashboard</a></h2>
    <h2>📦 Admin - All Orders</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Image</th>
            <th>Payment</th>
            <th>Status</th>
            <th>Update</th>
        </tr>

        <?php while ($order = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $order['id'] ?></td>
                <td><?= $order['user_id'] ?></td>
                <td><?= htmlspecialchars($order['product_name']) ?></td>
                <td>₹<?= $order['price'] ?></td>
                <td><?= $order['quantity'] ?></td>
                <td><img src="<?= $order['image'] ?>" width="50"></td>
                <td><?= $order['payment_method'] ?></td>
                <td><?= $order['status'] ?? 'Pending' ?></td>
                <td>
                    <form method="post" action="update_status.php">
                        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                        <select name="status">
                            <option value="Pending" <?= $order['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="Shipped" <?= $order['status'] == 'Shipped' ? 'selected' : '' ?>>Shipped</option>
                            <option value="Delivered" <?= $order['status'] == 'Delivered' ? 'selected' : '' ?>>Delivered
                            </option>
                            <option value="Cancelled" <?= $order['status'] == 'Cancelled' ? 'selected' : '' ?>>Cancelled
                            </option>
                        </select>
                        <button type="submit">Save</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>