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
                $hashedPassword = $row['password'];

                // Check if password is correct
                if (!password_verify($password, $hashedPassword)) {
                    header('Location: login.php?message=Invalid+email+or+password');
                    exit();
                }

                // Check if the user is banned
                if ($row['is_ban'] == 1) {
                    header('Location: login.php?message=Your+account+has+been+banned.+Contact+your+Admin.');
                    exit();
                }

                // Successful login, set session variables
                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'user_id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                ];

                header('Location: admin/index.php?message=Logged+In+Successfully');
                exit();
            } else {
                // Invalid email address
                header('Location: login.php?message=Invalid+email+or+password');
                exit();
            }
        } else {
            // Database error
            header('Location: login.php?message=Something+went+wrong');
            exit();
        }
    } else {
        // Missing email or password
        header('Location: login.php?message=All+fields+are+mandatory');
        exit();
    }
}
?>
