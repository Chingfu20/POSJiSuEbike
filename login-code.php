<?php
require 'config/function.php';

if (isset($_POST['loginBtn']))
{
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    if ($email != '' && $password != '') {
        $query = "SELECT * FROM admins WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $hashedPassword = $row['password'];

                // Password check
                if (!password_verify($password, $hashedPassword)) {
                    redirect('login.php', 'Invalid Password', 'error');
                }

                // Account ban check
                if ($row['is_ban'] == 1) {
                    redirect('login.php', 'Your account has been banned. Contact your Admin.', 'error');
                }

                // Successful login
                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'user_id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                ];

                redirect('admin/index.php', 'Logged In Successfully', 'success');

            } else {
                redirect('login.php', 'Invalid Email Address', 'error');
            }
        } else {
            redirect('login.php', 'Something Went Wrong!', 'error');
        }
    } else {
        redirect('login.php', 'All fields are mandatory!', 'error');
    }
}
?>
