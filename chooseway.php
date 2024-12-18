<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(45deg, #1a73e8, #4285f4, #34a853, #fbbc05);
            background-size: 200% 200%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-md rounded-lg p-8 max-w-sm w-full">
        <h2 class="text-2xl font-bold text-gray-700 text-center mb-4">Reset Your Password</h2>
        <p class="text-gray-600 text-center mb-6">Choose a method to reset your password:</p>
        <div class="space-y-4">
            <a href="forgot-password" class="block w-full text-center bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg shadow-md">
                Reset via Email
            </a>
            <a href="sms/send-otp" class="block w-full text-center bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg shadow-md">
                Reset via SMS
            </a>
            <a href="login.php" class="block w-full text-center bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg shadow-md">
                Back to Login
            </a>
        </div>
    </div>
</body>
</html>