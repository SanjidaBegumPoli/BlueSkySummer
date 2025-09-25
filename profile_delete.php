<?php
session_start();
include("dbcon.php");

if (!isset($_SESSION['auth_user'])) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['auth_user']['email'];

$delete = $con->prepare("DELETE FROM user WHERE email=?");
$delete->bind_param("s", $user_email);

if ($delete->execute()) {
    session_destroy();
    header("Location: register.php"); 
    exit();
} else {
    $_SESSION['status'] = "Failed to delete account!";
    header("Location: profile.php");
    exit();
}
?>
