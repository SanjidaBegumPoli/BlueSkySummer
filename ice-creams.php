<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ice Creams</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    .ice-card {
      cursor: pointer;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .ice-card:hover {
      transform: scale(1.05);
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }

    .ice-card img {
      height: 200px;
      object-fit: cover;
    }

    .social-icons a {
      font-size: 2rem;
      color: #fc3c5cff;
      margin: 0 10px;
      transition: color 0.3s ease;
    }

    .social-icons a:hover {
      color: #fb2d94ff;
    }

    .hover-scale:hover {
      transform: scale(1.03);
      transition: transform 0.3s ease-in-out;
    }

    .bg-pink-light {
      background-color: #ffc0cbff !important;

    }

    .bg-pink-dark {
      background-color: #FF69B4 !important;

    }
  </style>
</head>

<body>

  <!-- Navbar (same as dashboard) -->
  <nav class="navbar navbar-expand-lg bg-primary-0 sticky-lg-top shadow-none">
    <div class="container-fluid">
      <a class="navbar-brand" href="#header"><img src="Assets/image/logo.png" alt="Logo" class="logo_img"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link plus-jakarta-sans-semi-bold" href="dashboard.php">Home</a></li>
          <li class="nav-item"><a class="nav-link active plus-jakarta-sans-semi-bold" href="ice-creams.php">Ice-Creams</a></li>
          <li class="nav-item"><a class="nav-link plus-jakarta-sans-semi-bold" href="details.php">Details</a></li>
          <li class="nav-item"><a class="nav-link plus-jakarta-sans-semi-bold" href="about.php">About Us</a></li>
          <li class="nav-item"><a class="nav-link plus-jakarta-sans-semi-bold" href="contact.php">Contact Us</a></li>
          <li class="nav-item"><a class="nav-link plus-jakarta-sans-semi-bold" href="cart.php">My Cart</a></li>

        </ul>
        <div class="d-flex justify-content-end">
          <?php if (isset($_SESSION['auth_user'])): ?>
            <span class="me-3 text-pink" style="color: #fd6a9bff;">Hello, <?= $_SESSION['auth_user']['username']; ?></span>
            <a href="logout.php" class="btn btn-outline-light btn-sm" style="color: #fd6a9bff;">Logout</a>
          <?php else: ?>
            <a href="login.php" class="btn btn-outline-light btn-sm me-2">Login</a>
            <a href="register.php" class="btn btn-light btn-sm">Register</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>

  <!-- Page Title -->
  <div class="container my-5">
    <h2 class="text-center mb-4" style="color: #fd6a9bff;">Our Ice-Cream Collection</h2>

    <!-- Ice-Cream Grid -->
    <div class="row g-4">
      <?php

      $icecreams = [
        ["name" => "Vanilla Delight", "image" => "Assets/image/products/product15-removebg-preview.png"],
        ["name" => "Chocolate Heaven", "image" => "Assets/image/type5.png"],
        ["name" => "Strawberry Dream", "image" => "Assets/image/products/product3-removebg-preview.png"],
        ["name" => "Mint Magic", "image" => "Assets/image/products/518151488_012c012ccc_2x-removebg-preview.png"],
        ["name" => "Mango Mania", "image" => "Assets/image/products/product14-removebg-preview.png"],
        ["name" => "Blueberry Bliss", "image" => "Assets/image/products/547235148_012c012ccc_2x-removebg-preview.png"],
        ["name" => "Cookies & Cream", "image" => "Assets/image/products/product.webp"],
        ["name" => "Malai", "image" => "Assets/image/products/514215896_012c012ccc_2x-removebg-preview.png"]
      ];

      foreach ($icecreams as $ice): ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="card ice-card" onclick="window.location.href='details.php?name=<?= urlencode($ice['name']); ?>'">
            <img src="<?= $ice['image']; ?>" class="card-img-top" alt="<?= $ice['name']; ?>">
            <div class="card-body text-center">
              <h5 class="card-title"><?= $ice['name']; ?></h5>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Social Media Icons -->
  <div class="row mt-5 ">
    <div class="col-12 text-center social-icons">
      <a href="#"><i class="bi bi-facebook"></i></a>
      <a href="#"><i class="bi bi-twitter"></i></a>
      <a href="#"><i class="bi bi-instagram"></i></a>
      <a href="#"><i class="bi bi-youtube"></i></a>
    </div>
  </div>



  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>