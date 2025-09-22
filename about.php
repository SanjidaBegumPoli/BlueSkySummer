<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body {
      background-image: url('Assets/image/ice-creem-banner-bg.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }

    .text-pink {
      color: #fd6a9bff;
    }

    .card-white,
    .card-pink {
      border-radius: 15px;
      padding: 2rem;
      margin-bottom: 2rem;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .card-white {
      background-color: #ffffff;
    }

    .card-pink {
      background-color: #ffe6f0;
    }

    .testimonial-img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 1rem;
    }

    .lead-pink {
      color: #fd6a9bff;
      font-size: 1.1rem;
    }
    @media (min-width: 768px) {
      .mt-n5 {
        margin-top: -3rem !important;
      }
    }

    @media (max-width: 767px) {
      .mt-n5 {
        margin-top: 0 !important;
      }
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
          <li class="nav-item"><a class="nav-link plus-jakarta-sans-semi-bold" href="dashboard.php">Home</a></li>
          <li class="nav-item"><a class="nav-link plus-jakarta-sans-semi-bold" href="ice-creams.php">Ice-Creams</a></li>
          <li class="nav-item"><a class="nav-link active plus-jakarta-sans-semi-bold" href="about.php">About Us</a></li>
          <li class="nav-item"><a class="nav-link plus-jakarta-sans-semi-bold" href="contact.php">Contact Us</a></li>
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

  <!-- Hero Section with Background Image -->
  <section class="hero-section d-flex align-items-center text-center text-white">
    <div class="container">
      <h1 class="fw-bold"></h1>
      <p class="lead"></p>
    </div>
  </section>

  <!-- About Us Section -->
  <div class="container my-4 mt-n5">
    <div class="row justify-content-center align-items-center">

      <!-- About Pink Card -->
      <div class="col-md-7 mb-3 d-flex">
        <div class="card shadow-sm flex-fill" style="border-radius: 20px; background-color: #ffe6f0; border: none;">
          <div class="card-body d-flex flex-column justify-content-center p-4">
            <h2 class="fw-bold mb-3" style="color: #ff4081;">About Us</h2>
            <p class="mb-3" style="color: #555; font-size: 1.1rem; line-height: 1.6;">
              We are passionate about creating the best ice-cream experience for our customers.
              From classic flavors to unique creations, every scoop is made with love and the freshest ingredients.
            </p>
            <!-- Icons after description -->
            <div class="d-flex gap-3 mt-2">
              <i class="bi bi-ice-cream fs-3 text-pink"></i>
              <i class="bi bi-heart-fill fs-3 text-danger"></i>
              <i class="bi bi-emoji-smile-fill fs-3 text-warning"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Image with Shape Background -->
      <div class="col-md-5 mb-3 d-flex align-items-center justify-content-center position-relative">
        <!-- Shape PNG -->
        <img src="Assets/image/shap.png" alt="Shape Background"
          class="img-fluid position-absolute"
          style="max-width: 100%; z-index: 1;">

        <!-- Main Ice-Cream Image -->
        <img src="Assets/image/sub-banner.png" alt="About Image"
          class="img-fluid"
          style="max-width: 70%; border-radius: 20px; position: relative; z-index: 2;">
      </div>

    </div>
  </div>

  <!-- Team Section -->
  <div class="container my-5">
    <div class="row my-5">
      <div class="col-12 text-center mb-4">
        <h3 class="text-pink">Meet Our Team</h3>
      </div>

      <!-- Chef Cards -->
      <div class="col-md-3 mb-4">
        <div class="card shadow-sm h-100 text-center" style="border-radius: 20px; background-color: #ffe6f0;">
          <div class="card-body">
            <img src="Assets/image/ceaf.png" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover; box-shadow: 0 4px 10px rgba(0,0,0,0.2);" alt="Chef">
            <h5 class="card-title">Robin Scott</h5>
            <p class="card-subtitle text-muted mb-2">Head Chef</p>
            <p class="card-text" style="color: #fd6a9bff;">
              10+ years of culinary experience, specialized in artisan ice-creams.
              Winner of "Best Dessert Chef 2023".
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-4">
        <div class="card shadow-sm h-100 text-center" style="border-radius: 20px; background-color: #ffe6f0;">
          <div class="card-body">
            <img src="Assets/image/team-1.jpg" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover; box-shadow: 0 4px 10px rgba(0,0,0,0.2);" alt="Chef">
            <h5 class="card-title">Eris Watson</h5>
            <p class="card-subtitle text-muted mb-2">Pastry Chef</p>
            <p class="card-text" style="color: #fd6a9bff;">
              Expert in chocolate and fruit-based ice-creams. Featured in "Top 10 Desserts 2024".
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-4">
        <div class="card shadow-sm h-100 text-center" style="border-radius: 20px; background-color: #ffe6f0;">
          <div class="card-body">
            <img src="Assets/image/team-2.jpg" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover; box-shadow: 0 4px 10px rgba(0,0,0,0.2);" alt="Chef">
            <h5 class="card-title">Emma Watson</h5>
            <p class="card-subtitle text-muted mb-2">Pastry Chef</p>
            <p class="card-text" style="color: #fd6a9bff;">
              Expert in pastries and fruit-based ice-creams. Featured in "Top 10 Desserts 2024".
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-4">
        <div class="card shadow-sm h-100 text-center" style="border-radius: 20px; background-color: #ffe6f0;">
          <div class="card-body">
            <img src="Assets/image/team-3.jpg" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover; box-shadow: 0 4px 10px rgba(0,0,0,0.2);" alt="Chef">
            <h5 class="card-title">Eris War</h5>
            <p class="card-subtitle text-muted mb-2">Pastry Chef</p>
            <p class="card-text" style="color: #fd6a9bff;">
              Expert in chocolate and fruit-based ice-creams. Featured in "Top 10 Desserts 2024".
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Client Testimonials -->
    <div class="row">
      <div class="col text-center mb-4">
        <h3 class="text-pink mb-4">What Our Clients Say</h3>
      </div>

      <div class="col-12">
        <div class="card card-white text-center">
          <img src="Assets/image/testimonial (1).jpg" class="testimonial-img mx-auto" alt="Client 1">
          <h5>Shariar Khan</h5>
          <p class="lead-pink">"Absolutely love the Vanilla Delight! The texture is perfect and the flavor is heavenly. Highly recommend!"</p>
        </div>
      </div>

      <div class="col-12">
        <div class="card card-pink text-center">
          <img src="Assets/image/testimonial (2).jpg" class="testimonial-img mx-auto" alt="Client 2">
          <h5>Rafi Ahmed</h5>
          <p class="lead-pink">"The Chocolate Heaven is my favorite! Every bite is rich and creamy. Excellent service too."</p>
        </div>
      </div>

      <div class="col-12">
        <div class="card card-white text-center">
          <img src="Assets/image/testimonial (3).jpg" class="testimonial-img mx-auto" alt="Client 3">
          <h5>Mina Rahman</h5>
          <p class="lead-pink">"Mint Magic blew me away! So refreshing and perfect for hot summer days. Will order again!"</p>
        </div>
      </div>

      <div class="col-12">
        <div class="card card-white text-center">
          <img src="Assets/image/testimonial (4).jpg" class="testimonial-img mx-auto" alt="Client 4">
          <h5>Mina Chowdhury</h5>
          <p class="lead-pink">"Choco cup blew me away! So refreshing and perfect for hot summer days. Will order again!"</p>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>