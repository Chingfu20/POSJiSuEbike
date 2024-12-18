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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        html, body {
            height: 100%;
            background-color: #f4f9ff;
        }
        .otp-container {
            max-width: 400px;
            width: 90%;
        }
        .btn-primary {
            background-color: #69B2FF;
            border: none;
        }
        .btn-primary:hover {
            background-color: #58A1E8;
        }
        .custom-shape-divider-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        }
        .custom-shape-divider-bottom svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 110px;
        }
        .custom-shape-divider-bottom .shape-fill {
            fill: #69B2FF;
        }
        .countdown {
            font-size: 14px;
            color: #555;
        }
        .expired {
            color: red;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center">
    <div class="custom-shape-divider-bottom">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M1200,0H0V120H281.94C572.9,116.24,602.45,3.86,602.45,3.86h0S632,116.24,923,120h277Z" class="shape-fill"></path>
        </svg>
    </div>

    <div class="otp-container bg-white p-4 rounded shadow">
        <div class="text-center mb-3">
            <img src="../assets/images/logo.fb51b8e1.png" width="80" height="80" alt="Logo">
        </div>
        <h2 class="text-center mb-3" style="color: #69B2FF;">Enter OTP</h2>
        <p class="text-center mb-4">Please enter the OTP sent to your phone number.</p>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger text-center"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="mb-3">
                <input type="text" id="otp" name="otp" class="form-control text-center" placeholder="Enter OTP" maxlength="6" pattern="[0-9]{6}" required>
            </div>
            <button type="submit" id="submit-button" class="btn btn-primary w-100">Verify OTP</button>
        </form>

        <div class="countdown text-center mt-3" id="countdown-timer"></div>

        <div class="text-center mt-3">
            <p class="mb-1">OTP expired? <a href="resend-otp.php" class="text-primary">Resend OTP</a></p>
            <a href="../login.php" class="text-primary">Back to Login</a>
        </div>
    </div>

    <script>
        // Pass OTP expiration time to JavaScript
        const otpExpirationTime = <?php echo json_encode($otpExpirationTime * 1000); ?>; // Convert to milliseconds

        const countdownTimer = document.getElementById('countdown-timer');
        const submitButton = document.getElementById('submit-button');

        function updateTimer() {
            const now = new Date().getTime();
            const timeLeft = otpExpirationTime - now;

            if (timeLeft > 0) {
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                countdownTimer.innerHTML = `Time left to enter OTP: <strong>${minutes}m ${seconds}s</strong>`;
            } else {
                countdownTimer.innerHTML = `<span class="expired">OTP has expired. Please request a new one.</span>`;
                submitButton.disabled = true;
            }
        }

        setInterval(updateTimer, 1000);

        // SweetAlert for Success
        <?php if (isset($_SESSION['verification_success'])): ?>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '<?php echo $_SESSION['verification_success']; ?>',
                confirmButtonColor: '#69B2FF'
            });
            <?php unset($_SESSION['verification_success']); ?>
        <?php endif; ?>
    </script>
</body>
</html>
