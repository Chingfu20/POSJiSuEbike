<?php
require 'config/function.php'; // Assuming function.php contains the redirect and session logic

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

                if (!password_verify($password, $hashedPassword)) {
                    redirect('login.php', 'Invalid Password');
                }

                if ($row['is_ban'] == 1) {
                    redirect('login.php', 'Your account has been banned. Contact your Admin.');
                }

                // Set session variables
                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'user_id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                ];

                // Show SweetAlert and redirect to admin dashboard after login success
                echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Logged In Successfully',
                        text: 'You will be redirected shortly...',
                        timer: 3000,
                        showConfirmButton: false
                    }).then(function() {
                        window.location.href = 'admin/index.php';
                    });
                </script>
                ";

            } else {
                redirect('login.php', 'Invalid Email Address');
            }

        } else {
            redirect('login.php', 'Something Went Wrong!');
        }
    } else {
        redirect('login.php', 'All fields are mandatory!');
    }
}
?>
