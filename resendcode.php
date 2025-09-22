<?php
session_start();
include('dbcon.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require 'vendor/autoload.php';

function resend_email_verify($name,$email,$verify_token)
{
     $mail = new PHPMailer(true);

    try {
        $mail = new PHPmailer();
        $mail->isSMTP();
        //$mail->Host       = 'smtp.livemail.co.uk';
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'sanjidachy2022@gmail.com';//your email username
        $mail->Password   = 'jxud acav idsd igjx';      // Gmail App Password
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;
        $mail->setFrom('sanjidachy2022@gmail.com', 'Your Name');
        $mail->addAddress($email, $name);

        $mail->isHTML(true);
        $mail->Subject = 'Resend Email Verification';
        $mail->Body = "
            <h2>Hi $name,</h2>
            <p>Thank you for registering. Please click the link below to verify your email:</p>
            <a href='http://localhost/finalproject/verify_email.php?token=$verify_token'>Verify Email</a>
        ";

        $mail->send();
        echo "Verification email sent to $email";

    } catch (Exception $e) {
        echo "Email could not be sent. Error: {$mail->ErrorInfo}";
    }

}

if(isset($_POST['resend_btn']))
{
    if(!empty(trim($_POST['email'])))
    {
        $email = mysqli_real_escape_string($con,$_POST['email'] );
        $checkemail_query ="SELECT * FROM user WHERE email = '$email' LIMIT 1";
        $checkemail_query_run = mysqli_query($con ,$checkemail_query);

        if(mysqli_num_rows($checkemail_query_run)>0)
        {
            $row = mysqli_fetch_array($checkemail_query_run);
            if($row['verify_status']=="0")
            {
                $name = $row['name'];
                $email = $row['email'];
                $verify_token = $row['verify_token'];

                resend_email_verify($name,$email,$verify_token);
                $_SESSION['status']="verification email link is send";
                header("Location: register.php");
                exit(0);

            }else{
                $_SESSION['status']="Email already verified, login";
                header("Location: resend_email_verification.php");
                exit(0);

            }

        }else{
            $_SESSION['status']="Email is not register , Register first";
            header("Location: register.php");
            exit(0);

        }

    }else
    {
        $_SESSION['status']="please enter your email field";
        header("Location: resend_email_verification.php");
        exit(0);
    }
}


?>