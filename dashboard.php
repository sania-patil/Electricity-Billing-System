<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

echo "<h2>Welcome to the Dashboard!</h2>";
echo "<a href='logout.php'><button>Logout</button></a>";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome to your Dashboard!</h2>
</body>
</html>
