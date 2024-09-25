<?php
require 'config/function.php';

if (isset($_POST['loginBtn']))
{
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    if($email != '' && $password != '')
    {
        $query = "SELECT * FROM admins WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if ($result){

            if (mysqli_num_rows($result) == 1){

                $row = mysqli_fetch_assoc($result);
                $hasedPassword = $row['password'];

                if(!password_verify($password,$hasedPassword)){
                    echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Invalid Password!',
                            allowOutsideClick: false
                        }).then(function() {
                            window.location.href = 'login.php';
                        });
                    </script>";
                    exit;
                }

                if($row['is_ban'] == 1){
                    echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Account Banned',
                            text: 'Your account has been banned. Contact your Admin.',
                            allowOutsideClick: false
                        }).then(function() {
                            window.location.href = 'login.php';
                        });
                    </script>";
                    exit;
                }

                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'user_id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                ];

                echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Logged In Successfully!',
                        allowOutsideClick: false
                    }).then(function() {
                        window.location.href = 'admin/index.php';
                    });
                </script>";
                exit;

            } else {
                echo "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Invalid Email Address!',
                        allowOutsideClick: false
                    }).then(function() {
                        window.location.href = 'login.php';
                    });
                </script>";
                exit;
            }

        } else {
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something Went Wrong!',
                    allowOutsideClick: false
                }).then(function() {
                    window.location.href = 'login.php';
                });
            </script>";
            exit;
        }
    }
    else 
    {
        echo "
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'All fields are mandatory!',
                allowOutsideClick: false
            }).then(function() {
                window.location.href = 'login.php';
            });
        </script>";
        exit;
    }
}
?>
