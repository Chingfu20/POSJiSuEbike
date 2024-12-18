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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-gray-700 text-center mb-4">Enter Your Phone Number</h2>
        <?php if ($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="mb-4">
                <label for="phone" class="block text-gray-700 font-medium mb-2">Phone Number</label>
                <input type="tel" id="phone" name="phone" pattern="[0-9]*" required placeholder="Enter your phone number (e.g., 09123456789)" maxlength="11" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                Send OTP
            </button>
        </form>
        
        <div class="mt-4 text-gray-600 text-center">
            <p>Please enter your 11-digit phone number. An OTP will be sent to this number.</p>
        </div>
        
        <div class="mt-4 text-center">
            <a href="../login.php" class="text-blue-500 hover:text-blue-600 font-medium">Back to Login</a>
        </div>
    </div>
    
    <script>
        // OTP expiration time in minutes
        const otpExpirationMinutes = 5;
        
        document.addEventListener('DOMContentLoaded', function() {
            // Get the OTP timestamp from the session
            const otpTimestamp = <?php echo isset($_SESSION['OTP_TIMESTAMP']) ? $_SESSION['OTP_TIMESTAMP'] : 'null'; ?>;
            
            if (otpTimestamp) {
                // Calculate the remaining time in seconds
                const currentTime = Math.floor(Date.now() / 1000);
                const expirationTime = otpTimestamp + (otpExpirationMinutes * 60);
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
            const counterElement = document.createElement('div');
            counterElement.classList.add('mt-4', 'text-center', 'text-gray-600');
            counterElement.innerHTML = `OTP expires in ${remainingTime} seconds`;
            
            const formElement = document.querySelector('form');
            formElement.parentNode.insertBefore(counterElement, formElement.nextSibling);
            
            const countdown = setInterval(function() {
                remainingTime--;
                counterElement.innerHTML = `OTP expires in ${remainingTime} seconds`;
                
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
            Swal.fire({
                icon: 'error',
                title: 'OTP Expired',
                text: 'The OTP has expired. Please request a new one.',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../login.php';
                }
            });
        }
        
        document.getElementById('phone').addEventListener('input', function (e) {
            this.value = this.value.replace(/[^0-9]/g, ''); // Remove any non-numeric characters
        });
    </script>
</body>
</html>