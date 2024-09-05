<?php
require 'config/function.php';

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

                if(!password_verify($password, $hasedPassword)) {
                    $_SESSION['alert'] = 'Invalid Password';
                    header('Location: login.php');
                    exit();
                }

                if($row['is_ban'] == 1) {
                    $_SESSION['alert'] = 'Your account has been banned. Contact your Admin.';
                    header('Location: login.php');
                    exit();
                }

                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'user_id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                ];

                $_SESSION['alert'] = 'Logged In Successfully';
                header('Location: login.php');
                exit();
                
            } else {
                $_SESSION['alert'] = 'Invalid Email Address';
                header('Location: login.php');
                exit();
            }

        } else {
            $_SESSION['alert'] = 'Something Went Wrong!';
            header('Location: login.php');
            exit();
        }
    } else {
        $_SESSION['alert'] = 'All fields are mandatory!';
        header('Location: login.php');
        exit();
    }
}
?>
