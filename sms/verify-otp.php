<?php
include '../conn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp = $_POST['otp'];
    $phone = $_SESSION['reset_phone']; // Assuming this is set when the OTP is sent

    // Verify OTP from the database and check if it's still valid (within 15 minutes)
    $stmt = $conn->prepare("SELECT id FROM admins WHERE phone = ? AND OTP = ? AND OTP_TIMESTAMP > NOW() - INTERVAL 15 MINUTE");
    $stmt->bind_param("ss", $phone, $otp);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $_SESSION['otp_verified'] = true;
        // Clear the OTP in the database to prevent reuse
        $clear_stmt = $conn->prepare("UPDATE admins SET OTP = NULL, OTP_TIMESTAMP = NULL WHERE phone = ?");
        $clear_stmt->bind_param("s", $phone);
        $clear_stmt->execute();
        $clear_stmt->close();
        
        $_SESSION['verification_success'] = "OTP Verified Successfully! You can now change your password.";
        header("Location: newpassword.php");
        exit();
    } else {
        $error = "Invalid OTP or OTP has expired.";
    }
    $stmt->close();
}

// Calculate OTP expiration time (15 minutes from OTP generation)
$otpExpirationTime = strtotime('+15 minutes', strtotime($_SESSION['otp_generated_time'] ?? date("Y-m-d H:i:s"))); // Replace with actual OTP timestamp if available
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter OTP</title>
    <style>
       body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #f2f7ff, #e0f2f1);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    text-align: center;
    width: 100%;
    max-width: 400px;
}

h2 {
    margin-bottom: 20px;
    font-size: 26px;
    color: #333333;
}

label {
    font-size: 16px;
    color: #555555;
    display: block;
    margin-bottom: 8px;
}

input[type="text"] {
    padding: 12px;
    width: 100%;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 8px;
    margin-bottom: 20px;
    text-align: center;
    outline: none;
    transition: box-shadow 0.3s, border-color 0.3s;
}

input[type="text"]:focus {
    box-shadow: 0 0 8px rgba(0, 150, 136, 0.3);
    border-color: #009688;
}

button {
    padding: 12px 20px;
    font-size: 16px;
    color: white;
    background: #ff5252;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s;
}

button:hover {
    background: #e53935;
    transform: translateY(-2px);
}

button:disabled {
    background: #bdbdbd;
    cursor: not-allowed;
}

.success {
    color: #2e7d32;
    background: #e8f5e9;
    border: 1px solid #c8e6c9;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.error {
    color: #d32f2f;
    background: #ffebee;
    border: 1px solid #ffcdd2;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.countdown {
    font-size: 14px;
    color: #555555;
    margin-top: 10px;
}

.expired {
    color: #d32f2f;
}

    </style>
</head>
<body>

    <div class="container">
        <h2>Enter OTP</h2>
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="success">
                <?php 
                    echo htmlspecialchars($_SESSION['success_message']); 
                    unset($_SESSION['success_message']); 
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="otp">One-Time Password (OTP):</label>
            <input type="text" id="otp" name="otp" required placeholder="Enter OTP" maxlength="6" pattern="[0-9]{6}">
            <button type="submit" id="submit-button">Verify OTP</button>
        </form>
        <div class="instructions">
            <p>The OTP was sent to your phone/email. Please enter it above to proceed.</p>
        </div>
        <div class="countdown" id="countdown-timer"></div>
    </div>

    <script>
        // Pass OTP expiration time to JavaScript
        const otpExpirationTime = <?php echo json_encode($otpExpirationTime * 1000); ?>; // Convert to milliseconds

        // Countdown Timer
        const countdownTimer = document.getElementById('countdown-timer');
        const submitButton = document.getElementById('submit-button');

        function updateTimer() {
            const now = new Date().getTime();
            const timeLeft = otpExpirationTime - now;

            if (timeLeft > 0) {
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                countdownTimer.innerHTML = `Time left to enter OTP: ${minutes}m ${seconds}s`;
            } else {
                countdownTimer.innerHTML = `<span class="expired">OTP has expired. Please request a new one.</span>`;
                submitButton.disabled = true;
            }
        }

        // Update timer every second
        setInterval(updateTimer, 1000);
    </script>

</body>
</html>
