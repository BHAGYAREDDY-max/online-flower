<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial;
            text-align: center;
            padding: 40px;
        }
        .panel {
            margin: auto;
            max-width: 500px;
            padding: 30px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px #aaa;
        }
        a.button {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            background: #28a745;
            color: white;
            text-decoration: none;
        }
        a.logout {
            background: crimson;
        }
    </style>
</head>
<body>

<div class="panel">
    <h2>Welcome, Admin!</h2>

    <a class="button" href="admin_orders.php">View Orders</a>
    <!-- <a class="button" href="view_payments">View Payments </a> -->
    <a class="button logout" href="admin_logout.php">Logout</a>
</div>

</body>
</html>
