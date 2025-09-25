<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
    body {
      background-image: url('Assets/image/bn.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;

    }

    .btn-logout {
      background-color: #fd0155ff;
      color: #ff4d4dff;
      border: none;
    }

    .btn-logout:hover {
      background-color: #fc5ea0ff;
      color: #fff;
    }

    .text-pink {
      color: #fd6a9bff;
    }

    .contact-card {
      border-radius: 20px;
      padding: 2rem;
      background-color: #ffe6f0;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .social-icons a {
      font-size: 1.5rem;
      margin: 0 10px;
      color: #fd6a9bff;
      transition: 0.3s;
    }

    .social-icons a:hover {
      color: #ff4081;
      transform: scale(1.2);
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-primary-0 sticky-lg-top shadow-none">
    <div class="container-fluid">
      <a class="navbar-brand" href="dashboard.php"><img src="Assets/image/logo.png" alt="Logo" class="logo_img"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="dashboard.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="ice-creams.php">Ice-Creams</a></li>
          <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
          <li class="nav-item"><a class="nav-link active" href="contact.php">Contact Us</a></li>
          <li class="nav-item"><a class="nav-link plus-jakarta-sans-semi-bold" href="cart.php">My Cart</a></li>
                
        </ul>
        <div class="d-flex justify-content-end">
          <?php if (isset($_SESSION['auth_user'])): ?>
            <span class="me-3 text-pink">Hello, <?= $_SESSION['auth_user']['username']; ?></span>
            <a href="logout.php" class="btn btn-outline-light btn-sm" style="color: #fd6a9bff;">Logout</a>
          <?php else: ?>
            <a href="login.php" class="btn btn-outline-light btn-sm me-2">Login</a>
            <a href="register.php" class="btn btn-light btn-sm">Register</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>

  <!-- Contact Info -->
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="contact-card">
          <h3 class="text-pink mb-4">Get in Touch</h3>

          <p><i class="bi bi-telephone-fill text-pink me-2"></i> <strong>+880 1234 567 890</strong></p>
          <p><i class="bi bi-envelope-fill text-pink me-2"></i> <strong>info@icecreamshop.com</strong></p>
          <p><i class="bi bi-geo-alt-fill text-pink me-2"></i> <strong>Dhaka, Bangladesh</strong></p>

          <!-- Social Media -->
          <div class="mt-4">
            <h5 class="text-pink mb-3">Follow Us</h5>
            <div class="social-icons">
              <a href="#"><i class="bi bi-facebook"></i></a>
              <a href="#"><i class="bi bi-instagram"></i></a>
              <a href="#"><i class="bi bi-twitter"></i></a>
              <a href="#"><i class="bi bi-linkedin"></i></a>
              <a href="#"><i class="bi bi-whatsapp"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>