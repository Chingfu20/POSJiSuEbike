<?php
require 'config/function.php';

if (isset($_POST['loginBtn'])) {
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    if ($email != '' && $password != '') {
        $query = "SELECT * FROM admins WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $query);
        
        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $hasedPassword = $row['password'];

                if (!password_verify($password, $hasedPassword)) {
                    header('Location: login.php?alert=error&message=Invalid Password');
                    exit();
                }

                if ($row['is_ban'] == 1) {
                    header('Location: login.php?alert=error&message=Your account has been banned. Contact your Admin.');
                    exit();
                }

                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'user_id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                ];

                header('Location: login.php?alert=success');
                exit();
            } else {
                header('Location: login.php?alert=error&message=Invalid Email Address');
                exit();
            }
        } else {
            header('Location: login.php?alert=error&message=Something Went Wrong!');
            exit();
        }
    } else {
        header('Location: login.php?alert=error&message=All fields are mandatory!');
        exit();
    }
}
?>
