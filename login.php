<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JiSu Ebike POS System</title>
    <link rel="stylesheet" href="">
    <!-- SweetAlert Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    <div class="py-5 bg-light">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow rounded-4 custom-card">
                        <div class="p-5">
                            <center><h4 class="text-dark mb-3">Login Admin</h4></center>
                            <form action="login-code.php" method="POST" class="login-form" id="loginForm">
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
                              </div>
                             </div>
                             <div class="my-3">
                                <button type="submit" name="loginBtn" class="btn btn-primary w-100 mt-2" id="signInBtn">
                                    Sign In
                                </button>
                            </div>
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

        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        document.querySelector('#loginForm').addEventListener('submit', function(e) {
            e.preventDefault(); 

            if (validateForm()) {
                var formData = new FormData(this);

                fetch('login-code.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            title: 'Sign In Successful',
                            text: 'You have successfully signed in!',
                            icon: 'success',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'admin/index.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Failed',
                            text: data.message 
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    });
                });
            }
        });
    </script>
</body>
</html>
