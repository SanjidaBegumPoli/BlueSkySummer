<?php

session_start();
include("dbcon.php");

if (!isset($_SESSION['auth_user'])) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['auth_user']['email'];


$con->begin_transaction();

try {
    
    $deleteOrders = $con->prepare("DELETE FROM orders WHERE user_email=?");
    $deleteOrders->bind_param("s", $user_email);
    $deleteOrders->execute();
    $deleteOrders->close();

    
    $deleteUser = $con->prepare("DELETE FROM user WHERE email=?");
    $deleteUser->bind_param("s", $user_email);
    $deleteUser->execute();
    $deleteUser->close();

    $con->commit();


    session_destroy();
    header("Location: login.php?status=Account deleted successfully");
    exit();

} catch (Exception $e) {
    
    $con->rollback();
    echo "Error deleting profile: " . $e->getMessage();
}


?>
