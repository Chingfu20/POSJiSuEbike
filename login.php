<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JiSu Ebike POS System</title>
    <link rel="stylesheet" href="login.css">
    <!-- SweetAlert Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Basic page styles */
        body {
            background-color: #1b1b1b;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        /* Custom card with animated border */
        .custom-card {
            border-radius: 8px;
            background-color: #2a2a2a;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            padding: 20px;
            z-index: 1;
        }

        /* Running border effect */
        .custom-card::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            border-radius: 8px;
            background: linear-gradient(90deg, #ff004f, #00ccff, #00ff96, #ffcc00);
            background-size: 300% 300%;
            z-index: -1;
            animation: runBorder 5s linear infinite;
            border: 2px solid transparent;
        }

        /* Keyframes for the smooth running color */
        @keyframes runBorder {
            0% {
                background-position: 0% 50%;
            }
            100% {
                background-position: 100% 50%;
            }
        }

        /* Login form styles */
        .login-form {
            position: relative;
            z-index: 2;
        }

        /* Form label styles */
        .form-label {
            color: #fff;
            font-weight: bold;
        }

        /* Input fields */
        .form-control {
            background-color: transparent;
            border: none;
            border-bottom: 1px solid #fff;
            color: #fff;
            padding: 10px;
            width: 100%;
        }

        .form-control:focus {
            outline: none;
            border-bottom: 1px solid #00ccff;
        }

        /* Submit button */
        .btn {
            background-color: #00ccff;
            border: none;
            padding: 10px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #ff004f;
        }

        /* Container for the login card */
        .bg-light {
            background-color: #1b1b1b;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        h4 {
            color: #fff;
        }
    </style>
</head>
<body>
    <?php 
    include('includes/header.php'); 

    if (isset($_SESSION['loggedIn'])) {
        ?>
        <script>window.location.href = 'index.php';</script>
        <?php
    }
    ?>

    <div class="bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow rounded-4 custom-card">
                        <div class="p-5">
                            <center><h4 class="mb-3">Login Admin</h4></center>
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
        // Function to validate form inputs
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
    </script>
</body>
</html>
