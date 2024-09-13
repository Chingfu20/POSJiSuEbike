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

    <div class="neon-bg">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="neon-card">

                        <?php alertMessage(); ?>

                        <div class="p-5">
                            <center><h4 class="neon-title">Login Admin</h4></center>
                            <form action="login-code.php" method="POST" class="login-form">
                                
                                <div class="mb-3 neon-input-wrapper">
                                    <input type="email" name="email" class="neon-input" placeholder="Username" required />
                                </div>
                                <div class="mb-3 neon-input-wrapper">
                                    <input type="password" name="password" class="neon-input" placeholder="Password" required />
                                </div>
                                <div class="my-3">
                                    <button type="submit" name="loginBtn" class="neon-button w-100 mt-2">Login</button>
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
