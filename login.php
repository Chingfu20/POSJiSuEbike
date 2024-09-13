<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JiSu Ebike POS System</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
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

    <div class="login-container">
        <div class="login-card">
            <div class="card-content">
                <center><h4 class="login-title">Admin Login</h4></center>

                <?php alertMessage(); ?>

                <form action="login-code.php" method="POST" class="login-form">
                    <div class="input-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-input" placeholder="Enter your email" required />
                    </div>
                    <div class="input-group">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-input" placeholder="Enter your password" required />
                    </div>
                    <button type="submit" name="loginBtn" class="btn-login">Sign In</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
