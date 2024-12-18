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

// Get the OTP timestamp from the session
$otpTimestamp = isset($_SESSION['OTP_TIMESTAMP']) ? $_SESSION['OTP_TIMESTAMP'] : null;
$otpExpirationMinutes = 15; // OTP expiration time in minutes
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter OTP</title>
    <style>
        /* Your existing CSS styles */
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
            <button type="submit">Verify OTP</button>
        </form>
        
        <div class="instructions">
            <p>The OTP was sent to your phone/email. Please enter it above to proceed.</p>
        </div>
        
        <!-- OTP Counter -->
        <div class="mt-4 text-center" id="otp-counter" style="display: none;">
            OTP expires in <span id="remaining-time"></span>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (<?php echo json_encode($otpTimestamp); ?>) {
                // Calculate the remaining time in seconds
                const currentTime = Math.floor(Date.now() / 1000);
                const expirationTime = <?php echo $otpTimestamp; ?> + (<?php echo $otpExpirationMinutes; ?> * 60);
                const remainingTime = expirationTime - currentTime;
                
                if (remainingTime > 0) {
                    // Display the OTP counter
                    displayOTPCounter(remainingTime);
                } else {
                    // OTP has expired, clear the session
                    clearSession();
                }
            }
        });
        
        function displayOTPCounter(remainingTime) {
            const counterElement = document.getElementById('remaining-time');
            const counterContainerElement = document.getElementById('otp-counter');
            counterContainerElement.style.display = 'block';
            
            const countdown = setInterval(function() {
                remainingTime--;
                counterElement.textContent = `${remainingTime} seconds`;
                
                if (remainingTime <= 0) {
                    clearInterval(countdown);
                    clearSession();
                }
            }, 1000);
        }
        
        function clearSession() {
            // Clear the OTP timestamp from the session
            <?php unset($_SESSION['OTP_TIMESTAMP']); ?>
            
            // Display a message or redirect to the login page
            alert("OTP has expired. Please request a new one.");
            window.location.href = '../login.php';
        }
    </script>
</body>
</html>