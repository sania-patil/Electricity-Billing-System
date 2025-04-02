<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bill_id'])) {
    $bill_id = $_POST['bill_id'];

    // Update bill status to "Paid"
    $stmt = $conn->prepare("UPDATE bills SET status = 'Paid' WHERE bill_id = ?");
    $stmt->bind_param("i", $bill_id);

    if ($stmt->execute()) {
        echo "<script>alert('Payment Successful! Bill marked as Paid.'); window.location.href='view_bills.php';</script>";
    } else {
        echo "<script>alert('Error processing payment. Try again!'); window.location.href='view_bills.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
