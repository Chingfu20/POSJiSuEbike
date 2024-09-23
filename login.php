<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JiSu Ebike POS System - Login</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <style>
        /* General body style to add background */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #00aaff, #00ffaa); /* Gradient background */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Style for the form container */
        .form-box {
            width: 380px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.1); /* Transparent background */
            border-radius: 20px;
            backdrop-filter: blur(10px); /* Glassmorphism effect */
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1); /* Soft shadow */
            position: relative;
        }

        /* User profile image above the form */
        .form-box img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 20px;
            border: 3px solid #fff;
        }

        /* Title of the form */
        h2 {
            font-size: 1.8em;
            color: #fff;
            margin-bottom: 20px;
        }

        /* Input box styling */
        .inputbox {
            position: relative;
            margin: 20px 0;
        }

        .inputbox input {
            width: 100%;
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.8); /* Slightly transparent input field */
            border: none;
            border-radius: 25px; /* Rounded input boxes */
            outline: none;
            font-size: 1em;
            color: #333;
            text-align: center;
        }

        .inputbox ion-icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 15px;
            color: #333;
        }

        /* Button styling */
        button {
            width: 100%;
            padding: 12px;
            border-radius: 25px; /* Rounded button */
            background-color: #333; /* Dark background for button */
            color: #fff;
            font-size: 1em;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }

        button:hover {
            background-color: #555; /* Slight hover effect */
        }

        /* Forgot password and remember me links */
        .forget {
            display: flex;
            justify-content: space-between;
            margin: 15px 0;
            font-size: 0.9em;
            color: #fff;
        }

        .forget a {
            color: #fff;
            text-decoration: none;
        }

        .forget a:hover {
            text-decoration: underline;
        }

        /* Register link below the login form */
        .register {
            margin-top: 20px;
            color: #fff;
        }

        .register a {
            color: #fff;
            text-decoration: none;
        }

        .register a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="login-code.php" method="POST">
                    <img src="profile-placeholder.png" alt="Profile Image"> <!-- Add your profile image here -->
                    <h2>Login Admin</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" name="email" required>
                        <label>Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" required>
                        <label>Password</label>
                    </div>
                    <div class="forget">
                        <label><input type="checkbox" name="remember"> Remember Me</label>
                        <a href="#">Forgot Password</a>
                    </div>
                    <button type="submit" name="loginBtn">Log In</button>
                    <div class="register">
                        <p>Don't have an account? <a href="#">Sign Up</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>
