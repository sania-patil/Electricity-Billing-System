<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <h2>⚡ Admin Dashboard</h2>
            <ul>
                <li><a href="#">Manage Customers</a></li>
                <li><a href="generate_bill.php">Generate & Manage Bills</a></li>
                <li><a href="#">Track Payments</a></li>
                <li><a href="#">Consumption Analytics</a></li>
                <li><a href="#">Generate Reports</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h1>Welcome, Admin</h1>
            <p>Manage the electricity billing system efficiently.</p>
        </div>
    </div>
</body>
</html>