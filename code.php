<?php
session_start();
include('dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Function to send verification email
function sendemail_verify($name, $email, $verify_token)
{
    $mail = new PHPMailer(true);
    try {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'sanjidachy2022@gmail.com';
        $mail->Password   = 'jxud acav idsd igjx';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;
        $mail->setFrom('sanjidachy2022@gmail.com', 'Your Name');
        $mail->addAddress($email, $name);

        $mail->isHTML(true);
        $mail->Subject = 'Email Verification';
        $mail->Body = "
            <h2>Hi $name,</h2>
            <p>Thank you for registering. Please click the link below to verify your email:</p>
            <a href='http://localhost/finalproject/verify_email.php?token=$verify_token'>Verify Email</a>
        ";

        $mail->send();
    } catch (Exception $e) {
        error_log("Email could not be sent. Error: {$mail->ErrorInfo}");
    }
}

// Registration handling
if(isset($_POST['register_btn']))
{
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']); // plain text password
    $verify_token = md5(rand());

    $errors = [];

    // Validate Name
    if(empty($name)) {
        $errors[] = "Name is required.";
    } elseif(!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $errors[] = "Name can only contain letters and spaces.";
    }

    // Validate Phone
    if(empty($phone)) {
        $errors[] = "Phone number is required.";
    } elseif(!preg_match("/^[0-9]{10,15}$/", $phone)) {
        $errors[] = "Phone number must contain 10-15 digits.";
    }

    // Validate Email
    if(empty($email)) {
        $errors[] = "Email is required.";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate Password
    if(empty($password)) {
        $errors[] = "Password is required.";
    } elseif(!preg_match("/^(?=.*[A-Za-z])(?=.*\d).{6,}$/", $password)) {
        $errors[] = "Password must be at least 6 characters long and include at least one letter and one number.";
    }

    if(!empty($errors)) {
        $_SESSION['status'] = implode("<br>", $errors);
        header("Location: register.php");
        exit();
    }

    // Check if email already exists
    $check_email_query = "SELECT email FROM user WHERE email='$email' LIMIT 1";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if(mysqli_num_rows($check_email_query_run) > 0)
    {
        $_SESSION['status'] = "Email id already exists";
        header("Location: register.php");
        exit();
    }

    // Insert user data with plain text password
    $query = "INSERT INTO user(name, phone, email, password, verify_token, verify_status) 
              VALUES ('$name', '$phone', '$email', '$password', '$verify_token', 0)";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        sendemail_verify($name, $email, $verify_token);
        $_SESSION['status'] = "Registration successful! Please verify your email address.";
        header("Location: register.php");
        exit();
    }
    else
    {
        $_SESSION['status'] = "Registration failed. Please try again.";
        header("Location: register.php");
        exit();
    }
}

// Email verification handling (verify_email.php)
if(isset($_GET['token']))
{
    $token = $_GET['token'];

    $query = "SELECT * FROM user WHERE verify_token='$token' LIMIT 1";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) > 0)
    {
        $user = mysqli_fetch_assoc($query_run);
        if($user['verify_status'] == 0)
        {
            $update_query = "UPDATE user SET verify_status=1, verify_token='' WHERE id='".$user['id']."'";
            $update_run = mysqli_query($con, $update_query);

            if($update_run)
            {
                $_SESSION['status'] = "Your email has been verified successfully!";
            }
        }
        else
        {
            $_SESSION['status'] = "Email already verified. Please login.";
        }
    }
    else
    {
        $_SESSION['status'] = "Invalid verification token.";
    }

    header("Location: login.php");
    exit();
}
?>
