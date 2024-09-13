<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JiSu Ebike POS System</title>
    <style>
        body {
            background: linear-gradient(135deg, #89fffd, #ef32d9);
            font-family: 'Poppins', sans-serif;
            color: #333;
        }
        .custom-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        .custom-card .p-5 {
            padding: 4rem;
        }
        h4 {
            font-weight: bold;
            color: #555;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            font-weight: 600;
            color: #333;
        }
        .form-control {
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            font-size: 16px;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #ff67a0;
            box-shadow: 0 0 8px rgba(255, 103, 160, 0.5);
        }
        .btn-primary {
            background: linear-gradient(135deg, #ff6ec4, #7873f5);
            border: none;
            padding: 12px 20px;
            font-size: 18px;
            font-weight: bold;
            color: white;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #7873f5, #ff6ec4);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3);
        }
        .bg-light {
            padding: 30px 0;
        }
        .card {
            background-color: #f9f9f9;
            border-radius: 20px;
        }
        .login-form input::placeholder {
            color: #aaa;
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

                        <?php alertMessage(); ?>

                        <div class="p-5">
                            <center><h4 class="text-dark mb-3">Login Admin</h4></center>
                            <form action="login-code.php" method="POST" class="login-form">
                                
                                <div class="mb-3">
                                    <label class="form-label">Enter Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Enter Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required />
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
