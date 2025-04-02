 <?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt Password
    $meter_no = $role === "customer" ? $_POST['meter_no'] : NULL;

    $stmt = $conn->prepare("INSERT INTO users (username, name, password, role, meter_no) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $name, $password, $role, $meter_no);

    if ($stmt->execute()) {
        echo "<script>alert('Signup Successful! Please login.'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Signup Failed!'); window.location='index.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>


<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $meter_no = ($role === "customer") ? $_POST['meter_no'] : NULL;

    $stmt = $conn->prepare("INSERT INTO users (username, name, password, role, meter_no) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $name, $password, $role, $meter_no);

    if ($stmt->execute()) {
        echo "<script>alert('Signup Successful!'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="signup.css">
    <script>
        function toggleMeterField() {
            let role = document.getElementById("role").value;
            let meterField = document.getElementById("meter_no_field");
            meterField.style.display = (role === "customer") ? "block" : "none";
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Signup</h2>
        <form action="signup.php" method="POST">
            <label>Create Account as:</label>
            <select name="role" id="role" onchange="toggleMeterField()" required>
                <option value="customer">Customer</option>
                <option value="admin">Admin</option>
            </select>

            <div id="meter_no_field" style="display:none;">
                <label>Meter No:</label>
                <input type="text" name="meter_no">
            </div>

            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Name:</label>
            <input type="text" name="name" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Create</button>
            <a href="index.php"><button type="button">Cancel</button></a>
        </form>
    </div>
</body>
</html> 

