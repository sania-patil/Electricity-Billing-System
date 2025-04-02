<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $meter_no = $_POST['meter_no'];
    $units_consumed = $_POST['units_consumed'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    // Get the customer ID from meter number
    $stmt = $conn->prepare("SELECT id FROM users WHERE meter_no = ?");
    $stmt->bind_param("s", $meter_no);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id);
        $stmt->fetch();

        // Define a tariff rate (Example: ₹5 per unit)
        $rate_per_unit = 5;
        $amount = $units_consumed * $rate_per_unit;

        // Insert the bill into the database
        $stmt = $conn->prepare("INSERT INTO bills (user_id, month, year, units_consumed, amount, status) 
                        VALUES (?, ?, ?, ?, ?, 'Unpaid')");
        $stmt->bind_param("issid", $user_id, $month, $year, $units_consumed, $amount);


        if ($stmt->execute()) {
            echo "<script>alert('Bill Generated Successfully'); window.location.href='admin_dashboard.php';</script>";
        } else {
            echo "<script>alert('Error generating bill!');</script>";
        }
    } else {
        echo "<script>alert('Meter Number Not Found!');</script>";
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
    <title>Generate Bill</title>
    <link rel="stylesheet" href="admin.css">
    <style>
        /* General styling */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

/* Dashboard Container */
.dashboard {
    width: 50%;
    margin: 50px auto;
    padding: 20px;
    background-color: white;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    text-align: center;
}

/* Heading */
h2 {
    color: #333;
    margin-bottom: 20px;
}

/* Form Styling */
form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* Labels */
label {
    font-weight: bold;
    margin-top: 10px;
    display: block;
    text-align: left;
    width: 80%;
}

/* Input Fields */
input, select {
    width: 80%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Button Styling */
button {
    width: 85%;
    padding: 12px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 15px;
}

button:hover {
    background-color: #218838;
}

    </style>
</head>
<body>
    <div class="dashboard">
        <h2>Generate Electricity Bill</h2>
        <form action="generate_bill.php" method="POST">
            <label>Meter Number:</label>
            <input type="text" name="meter_no" required>

            <label>Month:</label>
            <select name="month" required>
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
            </select>

            <label>Year:</label>
            <input type="number" name="year" value="<?php echo date('Y'); ?>" required>

            <label>Units Consumed:</label>
            <input type="number" name="units_consumed" required>

            <button type="submit">Generate Bill</button>
        </form>
    </div>
</body>
</html>
