<?php
session_start();

$icecreams = [
    "Vanilla Delight" => [
        "image" => "Assets/image/products/product15-removebg-preview.png",
        "description" => "Creamy vanilla ice-cream made from fresh milk and vanilla beans.",
        "price" => 200,
        "quantity" => 15
    ],
    "Chocolate Heaven" => [
        "image" => "Assets/image/type5.png",
        "description" => "Rich chocolate ice-cream with chocolate chunks.",
        "price" => 250,
        "quantity" => 10
    ],
    "Strawberry Dream" => [
        "image" => "Assets/image/products/product3-removebg-preview.png",
        "description" => "Fresh strawberry ice-cream with real strawberry pieces.",
        "price" => 220,
        "quantity" => 20
    ],
    "Mint Magic" => [
        "image" => "Assets/image/products/518151488_012c012ccc_2x-removebg-preview.png",
        "description" => "Refreshing mint flavored ice-cream with chocolate chips.",
        "price" => 230,
        "quantity" => 12
    ],
    "Mango Mania" => [
        "image" => "Assets/image/products/product14-removebg-preview.png",
        "description" => "Sweet and tangy mango ice-cream made from ripe mangoes.",
        "price" => 240,
        "quantity" => 18
    ],
    "Blueberry Bliss" => [
        "image" => "Assets/image/products/547235148_012c012ccc_2x-removebg-preview.png",
        "description" => "Delicious blueberry ice-cream with fresh blueberries.",
        "price" => 260,
        "quantity" => 14
    ],
    "Cookies & Cream" => [
        "image" => "Assets/image/products/product.webp",
        "description" => "Classic cookies & cream ice-cream with chocolate cookies.",
        "price" => 270,
        "quantity" => 16
    ],
    "Malai" => [
        "image" => "Assets/image/products/514215896_012c012ccc_2x-removebg-preview.png",
        "description" => "Traditional Malai ice-cream, rich and creamy.",
        "price" => 210,
        "quantity" => 25
    ]
];

// Get ice cream name from query string
$name = isset($_GET['name']) ? urldecode($_GET['name']) : null;

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
                    <li class="nav-item"><a class="nav-link active plus-jakarta-sans-semi-bold" href="details.php">Ice-Creams</a></li>
                    <li class="nav-item"><a class="nav-link plus-jakarta-sans-semi-bold" href="about.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link plus-jakarta-sans-semi-bold" href="contact.php">Contact Us</a></li>
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
        <?php
        if ($name && isset($icecreams[$name])):
            $ice = $icecreams[$name];
        ?>
            <!-- Single Ice-Cream Details -->
            <div class="row">
                <div class="col-md-6">
                    <img src="<?= $ice['image'] ?>" alt="<?= $name ?>" class="ice-img">
                </div>
                <div class="col-md-6">
                    <h2 class="text-pink"><?= $name ?></h2>
                    <p class="text-pink"><?= $ice['description'] ?></p>
                    <h4 class="text-pink">Price: <?= $ice['price'] ?> BDT</h4>
                    <h5 class="text-pink">Available Quantity: <?= $ice['quantity'] ?></h5>

                    <form action="order.php" method="post" class="mt-3">
                        <input type="hidden" name="ice_name" value="<?= $name ?>">
                        <div class="mb-3">
                            <label for="quantity" class="form-label text-pink">Order Quantity</label>
                            <input type="number" id="quantity" name="quantity" class="form-control" min="1" max="<?= $ice['quantity'] ?>" required>
                        </div>
                        <button type="submit" class="btn btn-pink">Place Order</button>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <!-- Grid of All Ice-Creams -->
            <div class="row">
                <?php foreach ($icecreams as $name => $ice): ?>
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card h-100 card-ice" onclick="window.location.href='details.php?name=<?= urlencode($name) ?>'">
                            <img src="<?= $ice['image'] ?>" class="card-img-top" alt="<?= $name ?>">
                            <div class="card-body text-center">
                                <h5 class="card-title text-pink"><?= $name ?></h5>
                                <p class="card-text text-pink"><?= $ice['description'] ?></p>
                                <span class="btn btn-pink">View Details</span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>