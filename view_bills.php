<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch bills for the logged-in user
$stmt = $conn->prepare("SELECT bill_id, month, year, units_consumed, amount, status FROM bills WHERE user_id = ? ORDER BY year DESC, month DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bills</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your CSS file -->
</head>
<body>

<h2>Your Bills</h2>

<table border="1">
    <tr>
        <th>Month</th>
        <th>Year</th>
        <th>Units Consumed</th>
        <th>Total Amount</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['month']; ?></td>
            <td><?php echo $row['year']; ?></td>
            <td><?php echo $row['units_consumed']; ?></td>
            <td>₹<?php echo number_format($row['amount'], 2); ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <?php if ($row['status'] == 'Unpaid') { ?>
                    <form method="POST" action="pay_bill.php">
    <input type="hidden" name="bill_id" value="<?php echo $row['bill_id']; ?>">
    <input type="hidden" name="amount" value="<?php echo $row['total_amount']; ?>">
    <button type="submit">Pay Now</button>
</form>


                <?php } else { ?>
                    <span>Paid</span>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>

</table>

<a href="dashboard.php">Back to Dashboard</a>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
