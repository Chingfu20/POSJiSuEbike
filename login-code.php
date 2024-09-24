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
                    redirect('login.php','Invalid Password');
                }

                if($row['is_ban'] == 1){
                    redirect('login.php','Your account has been banned. Contact your Admin.');
                }

                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'user_id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],

                ];
                    
                if ($login_success) {
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
                    </script>
                    ";
                } else {
                    // If login failed, you can show a different SweetAlert
                    echo "
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                    <script>
                        Swal.fire({
                            title: 'Error!',
                            text: 'Login Failed. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'Retry'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'login.php';
                            }
                        });
                    </script>
                    ";
                }
                    
            }else{
                    redirect('login.php', 'Invalid Email Address');
            }

        }else{
                redirect('login.php', 'Something Went Wrong!');
        }
    }
    else 
    {
          redirect('login.php', 'All fields are mandetory!');
    }
    
}
?>
