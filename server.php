<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require("../config.php");
require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';
?>
<?php 
session_start();

$email = "";
$name = "";
$errors = array();


//connect to database
$con = mysqli_connect('localhost', 'u510162695_db_jisu_pos', '1Db_jisu_pos', 'u510162695_db_jisu_pos');

    //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_email = "SELECT * FROM admins WHERE email='$email'";
        $run_sql = mysqli_query($con, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(100000, 999999);
            $insert_code = "UPDATE admins SET Code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($con, $insert_code);
            if($run_query){
                // Email content
                $subject = "Reset Password Notification";
                $message = "
                <html>
                <head>
                    <title>Reset Password Notification</title>
                    <style>
                        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
                        .container { background-color: #ffffff; border-radius: 8px; padding: 30px; max-width: 600px; margin: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
                        h2 { color: #2C3E50; text-align: center; }
                        p { font-size: 16px; color: #34495E; line-height: 1.6; }
                        .otp-code { background-color: #2980B9; color: #ffffff; font-size: 20px; font-weight: bold; padding: 10px; border-radius: 5px; text-align: center; margin: 20px 0; }
                        .footer { text-align: center; font-size: 14px; color: #7F8C8D; margin-top: 20px; }
                        .footer a { color: #2980B9; text-decoration: none; }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <h2>JiSu E-Bike POS</h2>
                        <p>Dear user,</p>
                        <p>We received a request to reset your password. To complete the process, please use the following OTP (One-Time Password) code:</p>
                        <div class='otp-code'>$code</div>
                        <p>This OTP is valid for a short time, so please use it immediately to set your new password.</p>
                        <p>If you did not request this code, you can disregard this message.</p>
                        <div class='footer'>
                            <p>Thank you for using JiSu E-Bike POS.</p>
                            <p><a href='https://your-website.com'>Visit our website</a> for more details.</p>
                        </div>
                    </div>
                </body>
                </html>
                ";
                $sender = "sheykies20@gmail.com";
                //Load composer's autoloader

// $insert_data = "INSERT INTO `messagein` (`Id`, `SendTime`, `MessageFrom`, `MessageTo`, `MessageText`) VALUES ('', '', 'MPLA', '$email', 'OTP code is $code')";
//         $data_check = mysqli_query($con, $insert_data);

    $mail = new PHPMailer(true);                            
    try {
        //Server settings
        $mail->isSMTP();                                     
        $mail->Host = 'smtp.gmail.com';                      
        $mail->SMTPAuth = true;                             
        $mail->Username = $sender;     
        $mail->Password = 'avapoquvismbkmml';             
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );                         
        $mail->SMTPSecure = 'ssl';                           
        $mail->Port = 465;                                   

        //Send Email
        $mail->setFrom('sheykies20@gmail.com', 'JiSu E-Bike POS');
        
        //Recipients
        $mail->addAddress($email);              
        $mail->addReplyTo('sheykies20@gmail.com');
        
        //Content
        $mail->isHTML(true);                     

        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
		
       $_SESSION['result'] = 'Message has been sent';
	   
    } catch (Exception $e) {
	   $_SESSION['result'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
	   
    }
	
	
                if(isset($email, $subject, $message, $sender)){
                    $info = "We've sent a password reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;

                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "This email address does not exist!";
            
        }
        
    }

    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM admins WHERE Code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password.";
            $_SESSION['info'] = $info;
            header('location: createnewpassword.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered an incorrect code!";
        }
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE admins SET Code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "Your password has been reset. You can now login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: backtologin.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
   //if login now button click
   // if(isset($_POST['login-now'])){
     //   header('Location: login.php');
    //}
?>