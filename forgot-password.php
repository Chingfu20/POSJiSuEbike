<?php require_once "server.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        html, body {
            height: 100%;
            background-color: #f4f9ff;
        }
        .forgot-password-container {
            max-width: 400px;
            width: 90%;
        }
        .btn-primary {
            background-color: #69B2FF;
            border: none;
        }
        .btn-primary:hover {
            background-color: #58A1E8;
        }
        .custom-shape-divider-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        }
        .custom-shape-divider-bottom svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 110px;
        }
        .custom-shape-divider-bottom .shape-fill {
            fill: #69B2FF;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center">
    <div class="custom-shape-divider-bottom">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M1200,0H0V120H281.94C572.9,116.24,602.45,3.86,602.45,3.86h0S632,116.24,923,120h277Z" class="shape-fill"></path>
        </svg>
    </div>

    <div class="forgot-password-container bg-white p-4 rounded shadow">
        <div class="text-center mb-3">
            <img src="../assets/images/logo.fb51b8e1.png" width="80" height="80" alt="Logo">
        </div>
        <h2 class="text-center mb-3" style="color: #69B2FF;">Forgot Password?</h2>
        <p class="text-center mb-4">Enter your email address, and we'll send you instructions to reset your password.</p>
        
        <?php if (count($errors) > 0): ?>
            <div class="alert alert-danger text-center">
                <?php foreach ($errors as $error): ?>
                    <?php echo $error; ?><br>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="forgot-password.php" method="POST" autocomplete="">
            <div class="mb-3">
                <input type="email" name="email" class="form-control text-center" value="<?php echo $email ?>" placeholder="Enter your email" required>
            </div>
            <button type="submit" name="check-email" value="Continue" class="btn btn-primary w-100 mb-3">Send Reset Link</button>
            <p class="text-center mb-0">Remember your password? <a href="login.php" class="text-primary">Sign In</a></p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        <?php if ($emailSent): ?>
            Swal.fire({
                icon: 'success',
                title: 'Email Sent',
                text: 'Please check your email for the password reset link.',
                confirmButtonColor: '#69B2FF'
            });
        <?php endif; ?>
    </script>
</body>
</html>
