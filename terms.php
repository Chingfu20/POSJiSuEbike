<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.12/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.12/sweetalert2.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5; /* Light background for contrast */
        }
        h1, h2, h3 {
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 50px auto; /* Center the box with margin */
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fff; /* White background for the box */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        ul {
            margin-left: 20px; /* Indent list items */
        }
        p {
            margin: 10px 0; /* Space between paragraphs */
        }
    </style>
</head>
<body>
<div class="container">
        <h1>Terms and Conditions</h1>
        <p>Welcome to the JiSu Ebike POS System. By accessing or using this system, you agree to the following terms and conditions:</p>

        <h2>1. General Use</h2>
        <p>This system is provided for authorized personnel only. Unauthorized access or misuse of this system is strictly prohibited.</p>

        <h2>2. Account Security</h2>
        <p>You are responsible for maintaining the confidentiality of your login credentials. Do not share your account details with anyone.</p>

        <h2>3. Data Privacy</h2>
        <p>We value your privacy. Any data collected during your use of the system will be handled according to our <a href="privacy-policy.php">Privacy Policy</a>.</p>

        <h2>4. Prohibited Activities</h2>
        <p>You may not use this system to:</p>
        <ul>
            <li>Perform any activity that violates applicable laws or regulations.</li>
            <li>Access or attempt to access other users' accounts without authorization.</li>
            <li>Distribute malicious software or disrupt the system's functionality.</li>
        </ul>

        <h2>5. Updates to Terms</h2>
        <p>We may update these terms from time to time. Continued use of the system indicates acceptance of the updated terms.</p>

        <h2>6. Contact</h2>
        <p>If you have any questions about these terms, please contact us at <a href="mailto:support@jisu-ebike.com">support@jisu-ebike.com</a>.</p>

        <button
        ><a href="javascript:history.back()">Go Back</a></button>

    </div>

    <script>
        document.getElementById('submitBtn').addEventListener('click', function() {
            const termsCheckbox = document.getElementById('termsCheckbox');
            
            if (!termsCheckbox.checked) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Please agree to the Terms & Conditions before submitting.',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Terms Accepted!',
                    text: 'Thank you for agreeing to our Terms & Conditions.',
                    confirmButtonText: 'Continue'
                });
            }
        });
    </script>
</body>
</html>
