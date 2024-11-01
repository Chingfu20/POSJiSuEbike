<?php
require 'config/function.php';

function setFlashMessage($type, $message) {
    $_SESSION['sweet_alert'] = [
        'type' => $type,
        'message' => $message
    ];
}

if (isset($_POST['loginBtn'])) {
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    
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
