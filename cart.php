<?php
session_start();
include("dbcon.php"); // your DB connection file

if (!isset($_SESSION['auth_user'])) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['auth_user']['email'];

// ✅ ADD TO CART
if (isset($_POST['add_to_cart'])) {
    $ice_id = $_POST['ice_id'];
    $quantity = (int)$_POST['quantity'];

    // check if product exists
    $stmt = $con->prepare("SELECT * FROM ice_cream WHERE id=?");
    $stmt->bind_param("i", $ice_id);
    $stmt->execute();
    $ice = $stmt->get_result()->fetch_assoc();
    if (!$ice) {
        $_SESSION['message'] = "Invalid product!";
        header("Location: details.php");
        exit();
    }

    // check if product already in cart
    $check = $con->prepare("SELECT * FROM cart WHERE user_email=? AND product_id=?");
    $check->bind_param("si", $user_email, $ice_id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $update = $con->prepare("UPDATE cart SET quantity = quantity + ? WHERE user_email=? AND product_id=?");
        $update->bind_param("isi", $quantity, $user_email, $ice_id);
        $update->execute();
    } else {
        $insert = $con->prepare("INSERT INTO cart (user_email, product_id, quantity) VALUES (?, ?, ?)");
        $insert->bind_param("sii", $user_email, $ice_id, $quantity);
        $insert->execute();
    }

    $_SESSION['message'] = "Product added to cart!";
    header("Location: cart.php");
    exit();
}

// ✅ UPDATE CART
if (isset($_POST['update_cart'])) {
    $cart_id = $_POST['cart_id'];
    $quantity = (int)$_POST['quantity'];

    $update = $con->prepare("UPDATE cart SET quantity=? WHERE cart_id=? AND user_email=?");
    $update->bind_param("iis", $quantity, $cart_id, $user_email);
    $update->execute();

    $_SESSION['message'] = "Cart updated!";
    header("Location: cart.php");
    exit();
}

// ✅ DELETE ITEM
if (isset($_POST['delete_cart'])) {
    $cart_id = $_POST['cart_id'];

    $delete = $con->prepare("DELETE FROM cart WHERE cart_id=? AND user_email=?");
    $delete->bind_param("is", $cart_id, $user_email);
    $delete->execute();

    $_SESSION['message'] = "Item removed from cart!";
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Cart</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
    body { background-color: #fff0f5; }
    .text-pink { color: #fd6a9bff; }
    .btn-pink { background-color: #ff99cc; color: #fff; border: none; }
    .btn-pink:hover { background-color: #ff3399; color: #fff; }
    .form-control { border: 2px solid #ff99cc; border-radius: 10px; }
    .form-control:focus { border-color: #ff3399; box-shadow: 0 0 5px rgba(255, 51, 153, 0.5); }
    .table thead { background-color: #ff99cc; color: white; }
    .btn-update { background-color: #ffa6c9; color: white; }
    .btn-update:hover { background-color: #ff6699; color: white; }
    .btn-delete { background-color: #ff4d6d; color: white; }
    .btn-delete:hover { background-color: #cc0033; color: white; }
    .logo_img { width: 7rem; }
    .product-img { width: 70px; border-radius: 8px; }
</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-primary-0 sticky-lg-top shadow-none">
<div class="container-fluid">
<a class="navbar-brand" href="dashboard.php"><img src="Assets/image/logo.png" alt="Logo" class="logo_img"></a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav m-auto mb-2 mb-lg-0">
    <li class="nav-item"><a class="nav-link" href="dashboard.php">Home</a></li>
    <li class="nav-item"><a class="nav-link" href="details.php">Ice-Creams</a></li>
    <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
    <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
    <li class="nav-item"><a class="nav-link active" href="cart.php">My Cart</a></li>
</ul>
<div class="d-flex justify-content-end">
<?php if (isset($_SESSION['auth_user'])): ?>
    <span class="me-3 text-pink">Hello, <?= $_SESSION['auth_user']['username']; ?></span>
    <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
<?php else: ?>
    <a href="login.php" class="btn btn-outline-light btn-sm me-2">Login</a>
    <a href="register.php" class="btn btn-light btn-sm">Register</a>
<?php endif; ?>
</div>
</div>
</div>
</nav>

<!-- Cart Section -->
<div class="container my-5">
<h2 class="mb-4 text-pink">My Cart</h2>
<?php if (isset($_SESSION['message'])): ?>
<div class="alert alert-success"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div>
<?php endif; ?>

<?php
$cart_items = $con->prepare("
    SELECT c.cart_id, c.quantity, i.ice_name, i.price, i.id, i.image
    FROM cart c
    JOIN ice_cream i ON c.product_id = i.id
    WHERE c.user_email=?
");
$cart_items->bind_param("s", $user_email);
$cart_items->execute();
$result = $cart_items->get_result();
?>

<?php if ($result->num_rows > 0): ?>
<table class="table table-bordered text-center align-middle">
<thead>
<tr>
<th>Product</th>
<th>Image</th>
<th>Price</th>
<th>Quantity</th>
<th>Update</th>
<th>Delete</th>
</tr>
</thead>
<tbody>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td class="align-middle"><?= htmlspecialchars($row['ice_name']); ?></td>
    <td class="align-middle"><img src="<?= $row['image']; ?>" class="product-img"></td>
    <td class="align-middle"><?= $row['price']; ?> BDT</td>
    <td class="align-middle">
        <form method="post" class="d-flex justify-content-center">
            <input type="hidden" name="cart_id" value="<?= $row['cart_id']; ?>">
            <input type="number" name="quantity" value="<?= $row['quantity']; ?>" min="1" class="form-control w-50">
            <button type="submit" name="update_cart" class="btn btn-update btn-sm ms-2">Update</button>
        </form>
    </td>
    <td class="align-middle">
        <form method="post">
            <input type="hidden" name="cart_id" value="<?= $row['cart_id']; ?>">
            <button type="submit" name="delete_cart" class="btn btn-delete btn-sm">Delete</button>
        </form>
    </td>
</tr>
<?php endwhile; ?>
</tbody>
</table>

<form method="post" action="checkout.php" class="text-center mt-3">
    <button type="submit" class="btn btn-pink btn-lg">Proceed to Checkout</button>
</form>

<?php else: ?>
<p class="text-pink">Your cart is empty.</p>
<?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
