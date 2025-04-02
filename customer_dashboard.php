<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <h2>⚡ Customer Dashboard</h2>
            <ul>
                <li><a href="view_bills.php">View Monthly Bills</a></li>
                <li><a href="#">Make Online Payment</a></li>
                <li><a href="#">Download/Print Bills</a></li>
                <li><a href="#">Track Electricity Usage</a></li>
                <li><a href="#">Raise Complaints/Support</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h1>Welcome, Customer</h1>
            <br>
            <p>Manage your electricity bills and payments easily.</p>
        </div>
    </div>
</body>
</html>
