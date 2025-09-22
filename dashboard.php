<?php
$page_title = "Dashboard";
include("authentication.php");
//include("includes/header.php");
//include("includes/navbar.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blue Sky Summer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- plus jakarta sans fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
    rel="stylesheet">
  <!-- Flatpickr CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <!-- Bootstrap Icons  -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <!-- font awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
  <!-- custom css -->
  <link rel="stylesheet" href="css/colors.css">
  <link rel="stylesheet" href="css/fonts.css">
  <link rel="stylesheet" href="css/responsive.css">
  <link rel="stylesheet" href="css/style.css">

  <style>
    body {
      background-image: url('Assets/image/ice-bg.webp');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }

    .card {
      background-color: rgba(255, 255, 255, 0.85) !important;
    }
  </style>

</head>

<body>
  <nav class="navbar navbar-expand-lg bg-primary-0 sticky-lg-top shadow-none">
    <div class="container-fluid">
      <!-- logo -->
      <a class="navbar-brand" href="#header">
        <img src="Assets/image/logo.png" alt="Logo" class="logo_img">
      </a>
      <!-- Navbar toggler for mobile view -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Center menu -->
        <ul class="navbar-nav m-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link plus-jakarta-sans-semi-bold" href="ice-creams.php">Ice-Creams</a></li>
          <li class="nav-item"><a class="nav-link plus-jakarta-sans-semi-bold" href="details.php">Details</a></li>
          <li class="nav-item"><a class="nav-link plus-jakarta-sans-semi-bold" href="about.php">About Us</a></li>
          <li class="nav-item"><a class="nav-link plus-jakarta-sans-semi-bold" href="contact.php">Contact Us</a></li>
        </ul>

        <!-- Right side-->
        <div class="d-flex align-items-center gap-3">
          <?php if (isset($_SESSION['auth_user'])): ?>
            <span class="fw-bold " style="color: #fd6a9bff;">
              Hello, <?= htmlspecialchars($_SESSION['auth_user']['username']); ?>
            </span>
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
          <?php else: ?>
            <button class="button" onclick="window.location.href='register.php'">
              <div class="regtxt plus-jakarta-sans-semi-bold">Register</div>
            </button>

            <button class="Btn" onclick="window.location.href='login.php'">
              <div class="text plus-jakarta-sans-semi-bold">Login</div>
            </button>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>

  <div class="container py-5">

    <!-- Welcome Section -->
    <div class="row mb-4">
      <div class="col-12 text-center">
        <h2 class="fw-bold" style="color: #ff226cff;">Hello, <span style="color: #ff2e74ff;"><?= htmlspecialchars($_SESSION['auth_user']['username']); ?></span>!</h2>
        <p style="color: #ff0c5dff;">Welcome to your dashboard. Access the sections below.</p>
      </div>
    </div>
    <!-- Dashboard Cards (Full-width stacked) -->
    <div class="row g-4 mb-4">
      <!-- Ice Creams  -->
      <div class="col-12">
        <a href="ice-creams.php" class="text-decoration-none">
          <div class="card h-100 shadow-sm hover-scale bg-pink-light text-dark p-4">
            <div class="card-body text-center">
              <i class="bi bi-cup-straw display-4 mb-3"></i>
              <h3 class="card-title">Ice Creams</h3>
              <p class="card-text">Explore flavors and menus</p>
            </div>
          </div>
        </a>
      </div>

      <!-- Details  -->
      <div class="col-12">
        <a href="details.php" class="text-decoration-none">
          <div class="card h-100 shadow-sm hover-scale bg-pink-dark text-white p-4">
            <div class="card-body text-center">
              <i class="bi bi-info-circle-fill display-4 mb-3"></i>
              <h3 class="card-title">Details</h3>
              <p class="card-text">Check your orders and info</p>
            </div>
          </div>
        </a>
      </div>

      <!-- About Us  -->
      <div class="col-12">
        <a href="about.php" class="text-decoration-none">
          <div class="card h-100 shadow-sm hover-scale bg-pink-light text-dark p-4">
            <div class="card-body text-center">
              <i class="bi bi-people-fill display-4 mb-3"></i>
              <h3 class="card-title">About Us</h3>
              <p class="card-text">Learn about our story</p>
            </div>
          </div>
        </a>
      </div>

      <!-- Contact Us -->
      <div class="col-12 ">
        <a href="contact-us.php" class="text-decoration-none">
          <div class="card h-100 shadow-sm hover-scale bg-pink-dark text-white p-4">
            <div class="card-body text-center">
              <i class="bi bi-telephone-fill display-4 mb-3"></i>
              <h3 class="card-title">Contact Us</h3>
              <p class="card-text">Reach out to us anytime</p>
            </div>
          </div>
        </a>
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

    <style>
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


    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <?php
    //include("includes/footer.php"); 
    ?>
</body>

</html>