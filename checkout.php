<?php
session_start();
include("dbcon.php");

if (!isset($_SESSION['auth_user'])) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['auth_user']['email'];


$cart_items = $con->prepare("
    SELECT c.cart_id, c.quantity, i.ice_name, i.price 
    FROM cart c
    JOIN ice_cream i ON c.product_id = i.id
    WHERE c.user_email=?
");
$cart_items->bind_param("s", $user_email);
$cart_items->execute();
$result = $cart_items->get_result();

$total = 0;
$items = [];
while ($row = $result->fetch_assoc()) {
    $items[] = $row;
    $total += $row['price'] * $row['quantity'];
}

if (isset($_POST['confirm_payment'])) {
    $payment_method = $_POST['payment_method'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];

    $order = $con->prepare("INSERT INTO orders (user_email, address, mobile, email, payment_method, total_amount, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $order->bind_param("sssssi", $user_email, $address, $mobile, $email, $payment_method, $total);
    $order->execute();

    $delete = $con->prepare("DELETE FROM cart WHERE user_email=?");
    $delete->bind_param("s", $user_email);
    $delete->execute();

    $_SESSION['message'] = "Order placed successfully with $payment_method 🎉";
    header("Location: thankyou.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Checkout</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .text-pink { color: #fd6a9bff; }
    .btn-pink { background-color: #ff99cc; color: #fff; border: none; }
    .btn-pink:hover { background-color: #ff3399; color: #fff; }
    .form-control:focus { border-color: #ff99cc; box-shadow: 0 0 0 0.2rem rgba(255,153,204,.25); }
    .logo_img { width: 7rem; }
</style>
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-primary-0 sticky-lg-top shadow-none">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php"><img src="Assets/image/logo.png" class="logo_img"></a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav m-auto">
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="details.php">Ice-Creams</a></li>
                <li class="nav-item"><a class="nav-link active" href="cart.php">My Cart</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container my-5">
    <h2 class="text-pink">Checkout</h2>

    <h5 class="mb-3">Order Summary</h5>
    <ul class="list-group mb-4">
        <?php foreach ($items as $item): ?>
        <li class="list-group-item d-flex justify-content-between">
            <?= htmlspecialchars($item['ice_name']); ?> (x<?= $item['quantity']; ?>)
            <span><?= $item['price'] * $item['quantity']; ?> BDT</span>
        </li>
        <?php endforeach; ?>
        <li class="list-group-item d-flex justify-content-between fw-bold">
            Total
            <span><?= $total; ?> BDT</span>
        </li>
    </ul>

    <form method="post">
        <div class="mb-3">
            <label class="form-label text-pink">Payment Method</label>
            <select name="payment_method" class="form-control" required>
                <option value="">-- Select Payment Method --</option>
                <option value="Bank Transfer">Bank Transfer</option>
                <option value="Credit/Debit Card">Credit/Debit Card</option>
                <option value="PayPal">PayPal</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label text-pink">Bank/Card/PayPal ID</label>
            <input type="text" name="account" class="form-control" placeholder="Enter account/card/PayPal ID" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-pink">Address</label>
            <input type="text" name="address" class="form-control" placeholder="Enter delivery address" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-pink">Mobile</label>
            <input type="text" name="mobile" class="form-control" placeholder="Enter mobile number" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-pink">Email</label>
            <input type="email" name="email" class="form-control" value="<?= $user_email; ?>" readonly>
        </div>

        <button type="submit" name="confirm_payment" class="btn btn-pink">Confirm & Pay <?= $total; ?> BDT</button>
    </form>
</div>

</body>
</html>
