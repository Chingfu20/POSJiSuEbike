<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JiSu Ebike POS System</title>
    <link rel="stylesheet" href="login.css">
    <style>
        .admin-img {
            display: block;
            margin: 0 auto;
            width: 100px; /* Adjust width as needed */
            height: auto;
        }
        .text-center {
            text-align: center;
        }
    </style>
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

                        <div class="p-5 text-center">
                            <!-- Admin picture -->
                            <img src="path/to/admin-picture.jpg" alt="Admin Picture" class="admin-img">
                            <h4 class="text-dark mb-3">Login Admin</h4>
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
</body>
</html>
