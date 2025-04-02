<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ensure `bill_id` and `amount` are received from POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bill_id'], $_POST['amount'])) {
    $bill_id = $_POST['bill_id'];
    $amount = $_POST['amount']; // Fix: Ensure amount is received correctly

    // Generate QR Code using Google Chart API
    $qrData = "Bill ID: $bill_id | Amount: ₹$amount";
    $qrCodeUrl = "https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=" . urlencode($qrData);
} else {
    echo "<script>alert('Invalid request!'); window.location.href='view_bills.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay Bill</title>
    <style>
        body { text-align: center; font-family: Arial, sans-serif; margin: 50px; }
        .qr-container { margin: 20px; }
        .amount-box { font-size: 20px; font-weight: bold; margin-top: 20px; }
        .confirm-btn { padding: 10px 20px; font-size: 16px; background-color: green; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

<h2>Scan QR Code to Pay</h2>

<div class="qr-container">
    <img src="<?php echo $qrCodeUrl; ?>" alt="QR Code">
</div>

<div class="amount-box">
    <p>Amount: ₹<?php echo number_format($amount, 2); ?></p>
</div>

<form method="POST" action="process_payment.php">
    <input type="hidden" name="bill_id" value="<?php echo $bill_id; ?>">
    <button type="submit" class="confirm-btn">I Have Paid</button>
</form>

</body>
</html>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR to Pay</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/7.7.1/adapter.min.js"></script>
    <script src="https://rawgit.com/cozmo/jsQR/master/dist/jsQR.js"></script>
    <style>
        #video { width: 100%; max-width: 400px; }
        #qr-box { text-align: center; padding: 20px; }
        #amount-box { display: none; text-align: center; margin-top: 20px; }
        #pay-btn { display: none; }
    </style>
</head>
<body>

<h2>Scan QR Code to Pay</h2>

<div id="qr-box">
    <video id="video" autoplay></video>
    <canvas id="canvas" hidden></canvas>
    <p>Scan the QR code to proceed with payment.</p>
</div>

<div id="amount-box">
    <h3>Amount: ₹<?php echo number_format($amount, 2); ?></h3>
    <form method="POST" action="process_payment.php">
        <input type="hidden" name="bill_id" value="<?php echo $bill_id; ?>">
        <button type="submit" id="pay-btn">Confirm Payment</button>
    </form>
</div>

<script>
    const video = document.getElementById("video");
    const canvas = document.getElementById("canvas");
    const ctx = canvas.getContext("2d");
    const amountBox = document.getElementById("amount-box");
    const payBtn = document.getElementById("pay-btn");

    async function startScanner() {
        try {
            const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } });
            video.srcObject = stream;
            scanQR();
        } catch (error) {
            console.error("Camera access denied!", error);
        }
    }

    function scanQR() {
        const scanInterval = setInterval(() => {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

            const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
            const code = jsQR(imageData.data, imageData.width, imageData.height);

            if (code) {
                clearInterval(scanInterval);
                video.srcObject.getTracks().forEach(track => track.stop());
                document.getElementById("qr-box").style.display = "none";
                amountBox.style.display = "block";
                payBtn.style.display = "block";
            }
        }, 1000);
    }

    startScanner();
</script>

</body>
</html> -->
