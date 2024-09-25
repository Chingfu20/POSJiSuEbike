<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JiSu Ebike POS System</title>
    <link rel="stylesheet" href="login.css">
    <!-- SweetAlert Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php 
    include('includes/header.php'); 
    
    // Check if the user has already been banned or reached 10 failed attempts
    if (isset($_SESSION['failed_attempts']) && $_SESSION['failed_attempts'] >= 10) {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Account Locked',
                text: 'Too many failed login attempts. Your account has been locked.'
            }).then((result) => {
                // Hide the login form after alert is closed
                document.querySelector('.login-form').style.display = 'none';
            });
        </script>
        <?php
        exit(); // Prevent further access to the form
    }

    // If logged in, redirect to index page
    if (isset($_SESSION['loggedIn'])) {
        ?>
        <script>window.location.href = 'index.php';</script>
        <?php
    }
    ?>

    <div class="py-5 bg-light">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow rounded-4 custom-card">
                        <div class="p-5">
                            <center><h4 class="text-dark mb-3">Login Admin</h4></center>
                            <form action="login-code.php" method="POST" class="login-form" onsubmit="return validateForm()">
                                <div class="mb-3">
                                    <label class="form-label">Enter Email</label>
                                    <input type="text" name="email" id="email" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Enter Password</label>
                                    <input type="password" name="password" id="password" class="form-control" />
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

    <script>
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

            return true; // If all validations pass, submit the form
        }

        // Check if the user has been banned on the client side too (this value would be set from the server)
        let failedAttempts = <?php echo isset($_SESSION['failed_attempts']) ? $_SESSION['failed_attempts'] : 0; ?>;
        if (failedAttempts >= 10) {
            Swal.fire({
                icon: 'error',
                title: 'Account Locked',
                text: 'Too many failed login attempts. Your account has been locked.'
            }).then((result) => {
                document.querySelector('.login-form').style.display = 'none'; // Hide the form
            });
        }
    </script>
</body>
</html>
