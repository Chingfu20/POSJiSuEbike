<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="assets/images/logo.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JiSu Ebike POS System - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://www.google.com/recaptcha/api.js?render=6LdeBZMqAAAAAKAMeLNRPYEX1PsYJRtDRBsEAQVl"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .custom-card {
            background-color: #ffffff;
            border: none;
        }
        .lockout-container {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 15px;
            text-align: center;
            display: none;
        }
        .lockout-timer {
            font-size: 18px;
            font-weight: bold;
            color: #721c24;
        }
        .progress {
            height: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="py-5 bg-light">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow rounded-4 custom-card">
                        <div class="p-5">
                            <center><h4 class="text-dark mb-3">Admin Login</h4></center>
                            
                            <!-- Lockout Timer -->
                            <div id="lockoutContainer" class="lockout-container">
                                <div class="text-danger">
                                    <i class="fas fa-lock"></i>
                                    <span id="lockoutMessage">Too many login attempts. Please wait.</span>
                                </div>
                                <div class="lockout-timer mt-2">
                                    Time Remaining: <span id="lockoutTimer">3:00</span>
                                </div>
                                <div id="lockoutProgress" class="progress mt-3">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 0%"></div>
                                </div>
                            </div>

                            <!-- Login Form -->
                            <form action="login-code.php" method="POST" class="login-form" onsubmit="return validateForm()">
                                <div class="mb-3">
                                    <label class="form-label">Enter Email</label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Enter Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control" required>
                                        <span class="input-group-text">
                                            <i class="fa fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="my-3">
                                    <input type="checkbox" id="termsCheckbox" name="terms" required>
                                    <label for="termsCheckbox" class="text-secondary">
                                        I agree to the <a href="terms.php" class="text-secondary">Terms & Conditions</a>
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <a href="chooseway.php" class="text-secondary">Forgot Password?</a>
                                </div>
                                <input type="hidden" name="recaptcha_token" id="recaptcha_token">
                                <div class="my-3">
                                    <button type="submit" name="loginBtn" class="btn btn-primary w-100 mt-2">Sign In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if(isset($_SESSION['sweet_alert'])) : ?>
            Swal.fire({
                icon: '<?= $_SESSION['sweet_alert']['type'] ?>',
                title: '<?= $_SESSION['sweet_alert']['message'] ?>',
            });
            <?php unset($_SESSION['sweet_alert']); ?>
        <?php endif; ?>

        function validateForm() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

            if (!email.match(emailPattern)) {
                Swal.fire({ icon: 'error', title: 'Oops...', text: 'Please enter a valid email address!' });
                return false;
            }

            if (password === '') {
                Swal.fire({ icon: 'error', title: 'Oops...', text: 'Password is required!' });
                return false;
            }

            return true;
        }

        // Password Toggle
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');
        togglePassword.addEventListener('click', function () {
            const isPasswordVisible = passwordField.type === 'password';
            passwordField.type = isPasswordVisible ? 'text' : 'password';
            this.classList.toggle('fa-eye-slash');
        });

        // reCAPTCHA
        grecaptcha.ready(function() {
            grecaptcha.execute('6LdeBZMqAAAAAKAMeLNRPYEX1PsYJRtDRBsEAQVl', { action: 'login' }).then(function(token) {
                document.getElementById('recaptcha_token').value = token;
            });
        });
    </script>
</body>
</html>
