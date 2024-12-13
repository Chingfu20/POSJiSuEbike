<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image" href="assets/images/logo.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JiSu Ebike POS System - Login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://www.google.com/recaptcha/api.js?render=6LdeBZMqAAAAAKAMeLNRPYEX1PsYJRtDRBsEAQVl"></script>
    <style>
        .lockout-container {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 15px;
            text-align: center;
        }
        .lockout-timer {
            font-size: 24px;
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
    <?php include('assets/script.php'); ?>
    <div class="py-5 bg-light">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow rounded-4 custom-card">
                        <div class="p-5">
                            <center><h4 class="text-dark mb-3">Login Admin</h4></center>
                            
                            <!-- Enhanced Lockout Display -->
                            <div id="lockoutContainer" class="lockout-container" style="display:none;">
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

                            <form action="login-code.php" method="POST" class="login-form" onsubmit="return validateForm()">
                                <div class="mb-3">
                                    <label class="form-label">Enter Email</label>
                                    <input type="text" name="email" id="email" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Enter Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control" />
                                        <span class="input-group-text" style="cursor: pointer;">
    <svg id="togglePassword" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
        <circle cx="12" cy="12" r="3"></circle>
    </svg>
</span>
                                    </div>
                                </div>
                                <div class="my-3">
    <input type="checkbox" id="termsCheckbox" name="terms" value="agree" required>
    <label for="termsCheckbox" class="text-secondary">
        I agree to the <a href="terms.php" class="text-secondary">Terms & Conditions</a>
    </label>
</div>

    <a href="chooseway">Forgot Password?</a>
    <br>
                                <input type="hidden" name="recaptcha_token" id="recaptcha_token">
                                <div class="my-3">
                                    <button type="submit" name="loginBtn" class="btn btn-primary w-100 mt-2">
                                        Sign In
                                    </button>
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
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;

        var emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

        if (email == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Email is required!'
            });
            return false;
        }

        if (!email.match(emailPattern)) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please enter a valid email address!'
            });
            return false;
        }

        if (password == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Password is required!'
            });
            return false;
        }

        return true;
    }

    // Check for the message in the URL
    const urlParams = new URLSearchParams(window.location.search);
    const message = urlParams.get('message');

    // If a message exists (e.g., invalid login or lockout), display SweetAlert
    if (message) {
        // Check if the message contains lockout information
        if (message.includes('Too many login attempts')) {
            // Extract remaining time if possible
            const timeMatch = message.match(/(\d+)/);
            if (timeMatch) {
                const remainingTime = parseInt(timeMatch[1]);
                Swal.fire({
                    icon: 'error',
                    title: 'Login Error',
                    text: decodeURIComponent(message.replace(/\+/g, ' ')),
                    didClose: () => {
                        startLockoutCountdown(remainingTime);
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Login Error',
                    text: decodeURIComponent(message.replace(/\+/g, ' '))
                });
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Login Error',
                text: decodeURIComponent(message.replace(/\+/g, ' '))
            });
        }
    }

    // Lockout countdown function
    function startLockoutCountdown(totalSeconds) {
        const lockoutContainer = document.getElementById('lockoutContainer');
        const lockoutMessage = document.getElementById('lockoutMessage');
        const lockoutTimer = document.getElementById('lockoutTimer');
        const progressBar = document.querySelector('#lockoutProgress .progress-bar');
        
        lockoutContainer.style.display = 'block';
        lockoutMessage.textContent = 'Too many login attempts. Please wait.';

        const totalTime = 180; // 3 minutes in seconds
        let remainingTime = totalSeconds;

        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const remainingSeconds = seconds % 60;
            return `${minutes}:${remainingSeconds < 10 ? '0' : ''}${remainingSeconds}`;
        }

        function updateCountdown() {
            if (remainingTime > 0) {
                // Update timer display
                lockoutTimer.textContent = formatTime(remainingTime);
                
                // Update progress bar
                const progressPercentage = ((totalTime - remainingTime) / totalTime) * 100;
                progressBar.style.width = `${progressPercentage}%`;

                remainingTime--;
                setTimeout(updateCountdown, 1000);
            } else {
                // Reset display when countdown ends
                lockoutContainer.style.display = 'none';
                progressBar.style.width = '0%';
            }
        }

        updateCountdown();
    }

    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.querySelector('input[type="password"]');

    togglePassword.addEventListener('click', function () {
        const isPassword = passwordField.getAttribute('type') === 'password';
        passwordField.setAttribute('type', isPassword ? 'text' : 'password');

        // Change the SVG design for better toggle effect (optional).
        this.innerHTML = isPassword 
            ? `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                   <path d="M17.94 17.94A10.72 10.72 0 0 1 12 20c-7 0-11-8-11-8a18.74 18.74 0 0 1 3-4.6"/>
                   <path d="M1 1l22 22"/>
               </svg>`
            : `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                   <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                   <circle cx="12" cy="12" r="3"/>
               </svg>`;
    });
    </script>
  <script>
    grecaptcha.ready(function() {
    grecaptcha.execute('6LdeBZMqAAAAAKAMeLNRPYEX1PsYJRtDRBsEAQVl', {action: 'login'}).then(function(token) {
        document.getElementById('recaptcha_token').value = token;
    });
});
  </script>
</body>
</html>