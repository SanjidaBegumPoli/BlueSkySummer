<?php
session_start();
include("dbcon.php"); 

$name = isset($_GET['name']) ? urldecode($_GET['name']) : null;

$icecreams_query = "SELECT * FROM ice_cream";
$icecreams_result = $con->query($icecreams_query);

if ($name) {
    $stmt = $con->prepare("SELECT * FROM ice_cream WHERE ice_name=?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $ice = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $name ?? 'Ice-Creams' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .ice-img {
            max-width: 100%;
            border-radius: 10px;
        }

        .btn-pink {
            background-color: #ff99cc;
            color: #fff;
        }

        .btn-pink:hover {
            background-color: #ff3399;
            color: #fff;
        }

        .text-pink {
            color: #fd6a9bff;
        }

        .card-ice {
            transition: transform 0.3s;
            cursor: pointer;
        }

        .card-ice:hover {
            transform: scale(1.05);
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

        .logo_img {
            width: 7rem;
        }
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
                    <li class="nav-item"><a class="nav-link active" href="details.php">Ice-Creams</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link plus-jakarta-sans-semi-bold" href="cart.php">My Cart</a></li>
                </ul>
                <div class="d-flex justify-content-end">
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

    <div class="container my-5">
        <?php if ($name && $ice): ?>
            <div class="row">
                <div class="col-md-6">
                    <img src="<?= $ice['image'] ?>" alt="<?= $ice['ice_name'] ?>" class="ice-img">
                </div>
                <div class="col-md-6">
                    <h2 class="text-pink"><?= $ice['ice_name'] ?></h2>
                    <p class="text-pink"><?= $ice['description'] ?></p>
                    <h4 class="text-pink">Price: <?= $ice['price'] ?> BDT</h4>
                    <h5 class="text-pink">Available Quantity: <?= $ice['quantity'] ?></h5>

                    <form action="cart.php" method="post" class="mt-3">
                        <input type="hidden" name="ice_id" value="<?= $ice['id'] ?>">
                        <div class="mb-3">
                            <label for="quantity" class="form-label text-pink">Add Quantity</label>
                            <input type="number" id="quantity" name="quantity" class="form-control" min="1" max="<?= $ice['quantity'] ?>" required>
                        </div>
                        <button type="submit" name="add_to_cart" class="btn btn-pink">Add to Cart</button>
                    </form>
                </div>
            </div>

        <?php else: ?>
            
            <div class="row">
                <?php while ($ice = $icecreams_result->fetch_assoc()): ?>
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card h-100 card-ice" onclick="window.location.href='details.php?name=<?= urlencode($ice['ice_name']) ?>'">
                            <img src="<?= $ice['image'] ?>" class="card-img-top" alt="<?= $ice['ice_name'] ?>">
                            <div class="card-body text-center">
                                <h5 class="card-title text-pink"><?= $ice['ice_name'] ?></h5>
                                <p class="card-text text-pink"><?= $ice['description'] ?></p>
                                <span class="btn btn-pink">View Details</span>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="row mt-5">
        <div class="col-12 text-center social-icons">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-twitter"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-youtube"></i></a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>