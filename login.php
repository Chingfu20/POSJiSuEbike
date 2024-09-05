<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JiSu Ebike POS System</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php 
    include('includes/header.php'); 

    if(isset($_SESSION['loggedIn'])){
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

                        <?php alertMessage(); ?>

                        <div class="p-5">
                            <center><h4 class="text-dark mb-3">Login Admin</h4></center>
                            <form action="login-code.php" method="POST" class="login-form">
                                
                                <div class="mb-3">
                                    <label class="form-label">Enter Email</label>
                                    <input type="email" name="email" class="form-control" required />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Enter Password</label>
                                    <input type="password" name="password" class="form-control" required />
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
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const alertMessage = urlParams.get('alert');
        
        if (alertMessage) {
            Swal.fire({
                icon: alertMessage === 'success' ? 'success' : 'error',
                title: alertMessage === 'success' ? 'Logged In Successfully' : 'Error',
                text: alertMessage === 'success' ? 'You will be redirected shortly.' : 'There was an issue with your login.',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                if (alertMessage === 'success') {
                    window.location.href = 'admin/index.php';
                }
            });
        }
    });
    </script>
</body>
</html>
