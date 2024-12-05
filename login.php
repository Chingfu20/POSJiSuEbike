<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js?render=6LcxSJIqAAAAABwEaDzDQ85Z8bClNZY7nhY2-jDD"></script>
    <title>JiSu Ebike POS System</title>
    <link rel="stylesheet" href="login.css">
    <!-- SweetAlert Library -->
</head>
<link rel="icon" type="image/x-icon" href="assets/img/logo.jpg">

<body>
    <?php 
    include('includes/header.php'); 

    ?>

    <div class="py-5 bg-light">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow rounded-4 custom-card">
                        <div class="p-5">
                            <center><h4 class="text-dark mb-3">Login Admin</h4></center>
                            <form id="myForm" action="login-code.php" method="POST" class="login-form" onsubmit="return validateForm()">
                                <div class="mb-3">
                                    <label class="form-label">Enter Email</label>
                                    <input type="text" name="email" id="email" class="form-control" />
                                </div>
                                <div class="mb-3">
                                <label class="form-label">Enter Password</label>
                                 <div class="input-group">
                                  <input type="password" name="password" id="password" class="form-control" />
                                  <span class="input-group-text">
                                  <i class="fa fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                              </span>
                              <input type="hidden" name="recaptcha_token" id="recaptcha_token">
                         </div>
                      </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

            // Simple email validation pattern
            var emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

            if (email == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Email is required!'
                });
                return false; // Prevent form submission
            }

            if (!email.match(emailPattern)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please enter a valid email address!'
                });
                return false; // Prevent form submission
            }

            if (password == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password is required!'
                });
                return false; // Prevent form submission
            }

            return true; // If all validations pass, allow form submission
        }

        // Check for the message in the URL
        const urlParams = new URLSearchParams(window.location.search);
        const message = urlParams.get('message');

        // If a message exists (e.g., invalid login), display SweetAlert
        if (message) {
            Swal.fire({
                icon: 'error',
                title: 'Login Error',
                text: decodeURIComponent(message.replace(/\+/g, ' ')) // Replaces + with space
            });
        }
        const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {

        const isPasswordVisible = password.getAttribute('type') === 'password';
        password.setAttribute('type', isPasswordVisible ? 'text' : 'password');

        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash'); 
    });
</script>
<script>
    $(document).ready(function () {
        $('#myForm').submit(async function (event) {
            event.preventDefault(); // Prevent default form submission for custom logic
            
            // Wait for grecaptcha to be ready and execute it
            const token = await grecaptcha.execute('6LcxSJIqAAAAABwEaDzDQ85Z8bClNZY7nhY2-jDD', {action: 'submit'});
            $('input[name=recaptcha_token]').val(token);
            
            // Call the form validation and wait for its result
            const validate = validateForm();
            
            if (validate) {
                // Proceed with form submission if validation passes
                this.submit();
            }
        });
    });
</script>
</body>
</html>