<?php
session_start();
if (!isset($_SESSION['message'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thank You</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-center p-5">
    <h1 class="text-success"><?= $_SESSION['message']; unset($_SESSION['message']); ?></h1>
    <a href="dashboard.php" class="btn btn-primary mt-3">Back to Home</a>
</body>
</html>
