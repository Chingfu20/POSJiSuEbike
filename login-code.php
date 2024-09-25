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

        if ($result)
        {
            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $hashedPassword = $row['password'];

                if (!password_verify($password, $hashedPassword))
                {
                    echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Invalid Password!'
                            }).then((result) => {
                                window.location.href = 'login.php';
                            });
                          </script>";
                    exit();
                }

                if ($row['is_ban'] == 1)
                {
                    echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Your account has been banned. Contact your Admin.'
                            }).then((result) => {
                                window.location.href = 'login.php';
                            });
                          </script>";
                    exit();
                }

                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'user_id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                ];

                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Logged In Successfully'
                        }).then((result) => {
                            window.location.href = 'admin/index.php';
                        });
                      </script>";
                exit();
            }
            else
            {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Invalid Email Address!'
                        }).then((result) => {
                            window.location.href = 'login.php';
                        });
                      </script>";
                exit();
            }
        }
        else
        {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something Went Wrong!'
                    }).then((result) => {
                        window.location.href = 'login.php';
                    });
                  </script>";
            exit();
        }
    }
    else
    {
        echo "<script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'All fields are mandatory!'
                }).then((result) => {
                    window.location.href = 'login.php';
                });
              </script>";
        exit();
    }
}
?>
