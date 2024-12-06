<?php
require 'config/function.php';

function setFlashMessage($type, $message) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['sweet_alert'] = [
        'type' => $type,
        'message' => $message
    ];
}

// Centralized login attempt tracking
class LoginAttemptTracker {
    private static function initializeAttempts() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['login_attempts']) || !is_array($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts'] = [];
        }
    }

    public static function trackAttempt($email) {
        self::initializeAttempts();
        
        $current_time = time();
        
        // Clean up old attempts (older than 3 minutes)
        $_SESSION['login_attempts'] = array_filter($_SESSION['login_attempts'], function($attempt) {
            return is_array($attempt) && 
                   isset($attempt['time']) && 
                   ($current_time - $attempt['time']) < 180;
        });
        
        // Add new attempt
        $_SESSION['login_attempts'][] = [
            'email' => $email,
            'time' => $current_time
        ];
        
        // Count recent attempts for this email
        $attempts = array_filter($_SESSION['login_attempts'], function($attempt) use ($email) {
            return is_array($attempt) && 
                   isset($attempt['email']) && 
                   $attempt['email'] === $email;
        });
        
        return count($attempts);
    }

    public static function isLockedOut($email) {
        self::initializeAttempts();
        
        $current_time = time();
        
        $attempts = array_filter($_SESSION['login_attempts'], function($attempt) use ($email, $current_time) {
            return is_array($attempt) && 
                   isset($attempt['email'], $attempt['time']) && 
                   $attempt['email'] === $email && 
                   ($current_time - $attempt['time']) < 180;
        });
        
        return count($attempts) >= 3;
    }

    public static function getRemainingLockoutTime($email) {
        self::initializeAttempts();
        
        $current_time = time();
        
        $attempts = array_filter($_SESSION['login_attempts'], function($attempt) use ($email) {
            return is_array($attempt) && 
                   isset($attempt['email'], $attempt['time']) && 
                   $attempt['email'] === $email;
        });
        
        if (empty($attempts)) {
            return 0;
        }
        
        $oldest_attempt = min(array_column($attempts, 'time'));
        $lockout_end = $oldest_attempt + 180;
        
        return max(0, $lockout_end - $current_time);
    }

    public static function clearAttempts($email) {
        self::initializeAttempts();
        
        $_SESSION['login_attempts'] = array_filter($_SESSION['login_attempts'], function($attempt) use ($email) {
            return !is_array($attempt) || $attempt['email'] !== $email;
        });
    }
}

if (isset($_POST['recaptcha_token'])) {
    $recaptchaToken = $_POST['recaptcha_token'];
    $recaptchaSecret = '6LdeBZMqAAAAAIQ_WS82shdqz-ZfuVHUEcg2peCH';

    // Validate token with Google
    $recaptchaVerifyURL = 'https://www.google.com/recaptcha/api/siteverify';
    $response = file_get_contents($recaptchaVerifyURL . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaToken);
    $responseData = json_decode($response);

    if (!$responseData->success || $responseData->score < 0.5) {
        setFlashMessage('error', 'Failed reCAPTCHA verification.');
        redirect('login.php', 'Failed reCAPTCHA verification.');
        exit();
    }
}

if (isset($_POST['loginBtn'])) {
    // Ensure session is started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    // Check if user is locked out
    if (LoginAttemptTracker::isLockedOut($email)) {
        $remainingTime = LoginAttemptTracker::getRemainingLockoutTime($email);
        setFlashMessage('error', "Too many login attempts. Please try again in {$remainingTime} seconds.");
        redirect('login.php', "Too many login attempts. Please try again in {$remainingTime} seconds.");
        exit();
    }

    if ($email && $password) {
        $stmt = mysqli_prepare($conn, "SELECT * FROM admins WHERE email = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['password'];

            if (password_verify($password, $hashedPassword)) {
                // Clear login attempts on successful login
                LoginAttemptTracker::clearAttempts($email);

                if ($row['is_ban'] == 1) {
                    setFlashMessage('error', 'Your account has been banned. Contact your Admin.');
                    redirect('login.php', 'Your account has been banned. Contact your Admin.');
                }

                // Set session
                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'user_id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email']
                ];

                setFlashMessage('success', 'Login Successful, ' . $row['name'] . '!');
                redirect('admin/index', 'Logged In Successfully');
            } else {
                // Track login attempts
                $attempts = LoginAttemptTracker::trackAttempt($email);
                
                if ($attempts >= 3) {
                    setFlashMessage('error', 'Too many login attempts. Please try again in 3 minutes.');
                    redirect('login.php', 'Too many login attempts. Please try again in 3 minutes.');
                } else {
                    setFlashMessage('error', 'Invalid Password');
                    redirect('login.php', 'Invalid Password');
                }
            }
        } else {
            // Track login attempts for non-existent email
            $attempts = LoginAttemptTracker::trackAttempt($email);
            
            if ($attempts >= 3) {
                setFlashMessage('error', 'Too many login attempts. Please try again in 3 minutes.');
                redirect('login.php', 'Too many login attempts. Please try again in 3 minutes.');
            } else {
                setFlashMessage('error', 'Invalid Email Address');
                redirect('login.php', 'Invalid Email Address');
            }
        }
    } else {
        setFlashMessage('error', 'All fields are mandatory!');
        redirect('login.php', 'All fields are mandatory!');
    }
}
?>