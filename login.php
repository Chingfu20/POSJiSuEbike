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

    <div class="login-container">
        <div class="login-card">
            <center><h4 class="login-title">Login</h4></center>
            <form action="login-code.php" method="POST" class="login-form">
                <div class="login-input-group">
                    <input type="email" name="email" class="login-input" placeholder="Username" required />
                </div>
                <div class="login-input-group">
                    <input type="password" name="password" class="login-input" placeholder="Password" required />
                </div>
                <div class="my-3">
                    <button type="submit" name="loginBtn" class="login-button w-100 mt-2">
                        Login
                    </button>
                </div>
                <div class="login-options">
                    <label><input type="checkbox" name="remember" /> Remember Me</label>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
