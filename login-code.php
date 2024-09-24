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

                // Check if the password is correct
                if (!password_verify($password, $hashedPassword)) {
                    redirect('login.php', 'Invalid Password');
                }

                // Check if the user is banned
                if ($row['is_ban'] == 1) {
                    redirect('login.php', 'Your account has been banned. Contact your Admin.');
                }

                // Successful login
                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'user_id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                ];

                // Show SweetAlert for successful login and then redirect to admin/index.php
                echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script>
                    Swal.fire({
                        title: 'Success!',
                        text: 'Logged In Successfully',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'admin/index.php';
                        }
                    });
                </script>";
                exit();

            } else {
                // Invalid email
                redirect('login.php', 'Invalid Email Address');
            }
        } else {
            // Query failure
            redirect('login.php', 'Something went wrong!');
        }
    } else {
        // Missing fields
        redirect('login.php', 'All fields are mandatory!');
    }
}
?>
