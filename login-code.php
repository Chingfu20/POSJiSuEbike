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
                    
                <?php
                session_start(); // Ensure session is started
                require 'config/function.php';
                
                // Check if the user is logged in
                if (!isset($_SESSION['loggedIn'])) {
                    header('Location: login.php');
                    exit();
                }
                
                // Check for success message
                if (isset($_SESSION['successMessage'])) {
                    echo "
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                    <script>
                        Swal.fire({
                            title: 'Success!',
                            text: '" . $_SESSION['successMessage'] . "',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Optional: Redirect or do something after acknowledgment
                            }
                        });
                    </script>";
                    
                    // Clear the session variable after displaying
                    unset($_SESSION['successMessage']);
                }
                ?>
                
                    
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
