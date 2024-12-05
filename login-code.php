<?php
require 'config/function.php';

function setFlashMessage($type, $message) {
    $_SESSION['sweet_alert'] = [
        'type' => $type,
        'message' => $message
    ];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    $recaptcha_token = $_POST['recaptcha_token'] ?? '';

    $secretKey = "6LcxSJIqAAAAACEg_1wzRIw3Bvd0Ap9mskFoQBnd";

    // Verify the reCAPTCHA response
    $verifyUrl = "https://www.google.com/recaptcha/api/siteverify";

    // Create the request
    $data_captcha = [
        'secret' => $secretKey,
        'response' => $recaptcha_token
    ];

    // Use cURL to make the POST request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $verifyUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data_captcha));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    // Decode the JSON response
    $responseKeys = json_decode($response, true);

    if ($responseKeys["success"]) {
        // Optionally, check the score if using reCAPTCHA v3
        if (isset($responseKeys["score"]) && $responseKeys["score"] < 0.5) {
            setFlashMessage('error', 'reCAPTCHA verification faileds.');
            redirect('login.php', 'reCAPTCHA verification faileds.');
        }
    } else {
        setFlashMessage('error', 'reCAPTCHA verification faileds.');
        redirect('login.php', 'reCAPTCHA verification faileds.');
    }
    
    if($email != '' && $password != '') {
        $query = "SELECT * FROM admins WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $query);
        
        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $hasedPassword = $row['password'];
                
                if(!password_verify($password,$hasedPassword)) {
                    setFlashMessage('error', 'Invalid Password');
                    redirect('login.php', 'Invalid Password');
                }
                
                if($row['is_ban'] == 1) {
                    setFlashMessage('error', 'Your account has been banned. Contact your Admin.');
                    redirect('login.php', 'Your account has been banned. Contact your Admin.');
                }
                
                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'user_id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                ];
                
                setFlashMessage('success', 'Login Successfully, ' . $row['name'] . '!');
                redirect('admin/index.php', 'Logged In Successfully');
                
            } else {
                setFlashMessage('error', 'Invalid Email Address');
                redirect('login.php', 'Invalid Email Address');
            }
        } else {
            setFlashMessage('error', 'Something Went Wrong!');
            redirect('login.php', 'Something Went Wrong!');
        }
    } else {
        setFlashMessage('error', 'All fields are mandatory!');
        redirect('login.php', 'All fields are mandatory!');
    }
}
?>