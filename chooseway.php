<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
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
        </div>
    </div>
</body>
</html>
