<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JiSu Ebike POS System</title>
    <link rel="stylesheet" href="login.css">
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

    <div class="bg-image">
        <div class="overlay">
            <div class="py-5">
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-4 col-lg-3">
                            <div class="card shadow rounded-4 custom-card">
                                <div class="p-4">
                                    <h4 class="text-dark text-center mb-4">Admin Login</h4>
                                    <form action="login-code.php" method="POST" class="login-form">
                                        <div class="mb-3">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" name="email" class="form-control" required />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" required />
                                        </div>
                                        <div class="my-3">
                                            <button type="submit" name="loginBtn" class="btn btn-primary w-100">
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
        </div>
    </div>
</body>
</html>
