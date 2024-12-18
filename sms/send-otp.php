<?php
require_once '../conn.php';

session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Function to standardize phone number format for comparison
function standardizePhoneNumber($phone) {
    // Remove any non-numeric characters
    $phone = preg_replace('/[^0-9]/', '', $phone);
    
    // If it starts with 63, remove it
    if (substr($phone, 0, 2) === '63') {
        $phone = '0' . substr($phone, 2);
    }
    
    return $phone;
}

// Function to format phone for SMS sending
function formatPhoneForSMS($phone) {
    // Remove any non-numeric characters
    $phone = preg_replace('/[^0-9]/', '', $phone);
    
    // If it starts with 0, replace with +63
    if (substr($phone, 0, 1) === '0') {
        return '+63' . substr($phone, 1);
    }
    
    // If it starts with 63, add +
    if (substr($phone, 0, 2) === '63') {
        return '+' . $phone;
    }
    
    // If no prefix, assume it needs 63
    return '+63' . $phone;
}

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $phone = $_POST['phone'];
        
        // Standardize phone number for database lookup
        $standardizedPhone = standardizePhoneNumber($phone);
        
        // Debug log
        error_log("Looking up standardized phone: " . $standardizedPhone);
        
        // Check if phone exists in database
        $stmt = $conn->prepare("SELECT id FROM admins WHERE phone = ?");
        if (!$stmt) {
            throw new Exception("Database prepare error: " . $conn->error);
        }
        
        $stmt->bind_param("s", $standardizedPhone);
        if (!$stmt->execute()) {
            throw new Exception("Database execute error: " . $stmt->error);
        }
        
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Generate OTP
            $otp = sprintf("%06d", mt_rand(0, 999999));
            $_SESSION['reset_phone'] = $standardizedPhone;
            $_SESSION['OTP_TIMESTAMP'] = time();
            
            // Update OTP in database
            $update_stmt = $conn->prepare("UPDATE admins SET OTP = ?, OTP_TIMESTAMP = CURRENT_TIMESTAMP WHERE phone = ?");
            if (!$update_stmt) {
                throw new Exception("Database prepare error: " . $conn->error);
            }
            
            $update_stmt->bind_param("ss", $otp, $standardizedPhone);
            
            if (!$update_stmt->execute()) {
                throw new Exception("Failed to update OTP: " . $update_stmt->error);
            }
            
            // Format phone number for SMS sending
            $smsPhone = formatPhoneForSMS($standardizedPhone);
            
            // Send OTP via SMS
            $message = "Your OTP for password reset is: " . $otp;
            
            // Log before sending SMS
            error_log("Attempting to send SMS to: " . $smsPhone);
            error_log("Message content: " . $message);
            
            if (!sendSMS($smsPhone, $message)) {
                throw new Exception("Failed to send SMS. Please try again later.");
            }
            
            // If we got here, everything worked
            $_SESSION['success_message'] = "OTP sent successfully! Please check your phone.";
            header("Location: verify-otp.php");
            exit();
            
        } else {
            throw new Exception("Phone number not found in our records");
        }
        
    } catch (Exception $e) {
        $error = $e->getMessage();
        error_log("Forgot Password Error: " . $error);
    } finally {
        if (isset($stmt)) $stmt->close();
        if (isset($update_stmt)) $update_stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
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
        <h2 class="text-center mb-3" style="color: #69B2FF;">Enter Your Phone Number</h2>
        <p class="text-center mb-4">Please enter your phone number to receive an OTP.</p>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger text-center"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if (isset($success)): ?>
            <div class="alert alert-success text-center"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="mb-3">
                <input type="tel" id="phone" name="phone" class="form-control text-center" placeholder="Enter your phone number (e.g., 09123456789)" maxlength="11" pattern="[0-9]*" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Send OTP</button>
        </form>

        <div class="text-center mt-3">
            <p class="mb-1">Already have an OTP? <a href="verify-otp.php" class="text-primary">Enter OTP</a></p>
            <a href="../login.php" class="text-primary">Back to Login</a>
        </div>
    </div>

    <script>
        // SweetAlert for Success
        <?php if (isset($_SESSION['success_message'])): ?>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '<?php echo $_SESSION['success_message']; ?>',
                confirmButtonColor: '#69B2FF'
            });
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        document.getElementById('phone').addEventListener('input', function (e) {
            this.value = this.value.replace(/[^0-9]/g, ''); // Remove any non-numeric characters
        });
    </script>
</body>
</html>
