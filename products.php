<?php
// Start session to check login state for navbar display
session_start();

// Get display name for navbar dropdown, default to "User"
$displayName = !empty($_SESSION['username']) ? $_SESSION['username'] : 'User';

// Check if user is logged in
$isLoggedIn = isset($_SESSION['email']);

// ==================== PRODUCTS DATA (Associative Array) ====================
// Each product has: price, image URL, and description
$products = [
    'Wireless Headphones Pro' => [
        'price' => '620',
        'img'   => 'https://kimi-web-img.moonshot.cn/img/img.magnific.com/e34a9f3aa676e8ac52c7daa4950ccc2ce4feffae.jpg',
        'desc'  => 'Premium over-ear wireless headphones with active noise cancellation and 30-hour battery life.'
    ],
    'Classic White Sneakers' => [
        'price' => '6500',
        'img'   => 'https://kimi-web-img.moonshot.cn/img/rwproductimages.s3.ap-south-1.amazonaws.com/2839a35acd686ecc7f3180084090eb9120d0038f.jpeg',
        'desc'  => 'Stylish white leather sneakers with cushioned sole for all-day comfort and modern street style.'
    ],
    'Rugged Smartwatch X' => [
        'price' => '1200',
        'img'   => 'https://kimi-web-img.moonshot.cn/img/shopkronox.com/355c7f0a9ce1fbd20c1713b3ab49af753d704d80.webp',
        'desc'  => 'Military-grade smartwatch with GPS, heart rate monitor, and 14-day battery life.'
    ],
    'Sky Blue Headphones' => [
        'price' => '3500',
        'img'   => 'https://kimi-web-img.moonshot.cn/img/www.wonderprice.co.uk/326b918536a7c710ebdecee93484d013721b50e2.webp',
        'desc'  => 'Lightweight on-ear headphones in stunning sky blue with crystal clear sound quality.'
    ],
    'Urban Backpack' => [
        'price' => '899',
        'img'   => 'https://kimi-web-img.moonshot.cn/img/mykite.ca/e6d6e11bad151759d056baf49bcd56c003962d9a.webp',
        'desc'  => 'Water-resistant urban backpack with laptop compartment and multiple organizer pockets.'
    ],
    'Smartwatch Series 5' => [
        'price' => '4500',
        'img'   => 'https://kimi-web-img.moonshot.cn/img/m.media-amazon.com/eb21952d5d4b0fec1cf4e6866d71f3162adde6a3.jpg',
        'desc'  => 'Advanced fitness smartwatch with AMOLED display, blood oxygen sensor, and ECG app.'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxeStore — All Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="bg-white">

    <!-- ==================== NAVBAR ==================== -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top navbar-custom">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <div class="d-flex align-items-center justify-content-center rounded-lg mr-2 brand-icon">
                    <i class="fas fa-shopping-bag text-white" style="font-size: 1.1rem;"></i>
                </div>
                <div>
                    <span class="font-weight-bold d-block ls-1" style="font-size: 1.3rem; color: var(--navy); line-height: 1;">LUXE</span>
                    <span class="text-coral font-weight-medium ls-3" style="font-size: 0.7rem;">STORE</span>
                </div>
            </a>
            <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-1">
                        <a class="nav-link font-weight-bold px-3 py-2 rounded-pill text-muted" href="index.php" style="font-size: 0.9rem;">
                            <i class="fas fa-home mr-1" style="font-size: 0.8rem;"></i> Home
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link font-weight-bold px-3 py-2 rounded-pill nav-link-active" href="products.php" style="font-size: 0.9rem;">
                            <i class="fas fa-th-large mr-1" style="font-size: 0.8rem;"></i> All Products
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav align-items-center">
                    <?php if (!$isLoggedIn): ?>
                        <li class="nav-item">
                            <a class="btn btn-coral font-weight-bold px-4 py-2 rounded-pill text-white" href="account.php" style="font-size: 0.85rem;">
                                <i class="fas fa-sign-in-alt mr-1"></i> Account
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center font-weight-bold pl-3 pr-2 py-2 rounded-pill dropdown-user text-navy" href="#" id="userDropdown" role="button" data-toggle="dropdown" style="font-size: 0.9rem;">
                                <div class="d-flex align-items-center justify-content-center rounded-circle mr-2 avatar-circle">
                                    <span class="text-white font-weight-bold" style="font-size: 0.8rem;"><?php echo strtoupper(substr($displayName, 0, 1)); ?></span>
                                </div>
                                <span><?php echo htmlspecialchars($displayName); ?></span>
                                <i class="fas fa-chevron-down ml-2 text-muted" style="font-size: 0.65rem;"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right border-0 shadow mt-2 rounded-16" style="min-width: 200px;">
                                <div class="px-3 py-3 border-bottom">
                                    <p class="mb-0 font-weight-bold text-dark" style="font-size: 0.95rem;"><?php echo htmlspecialchars($displayName); ?></p>
                                    <p class="mb-0 text-muted" style="font-size: 0.8rem;"><?php echo $_SESSION['email'] ?? ''; ?></p>
                                </div>
                                <a class="dropdown-item py-2 px-3" href="account.php" style="font-size: 0.9rem;">
                                    <i class="fas fa-edit mr-2 text-muted" style="width: 18px; font-size: 0.9rem;"></i> Continue Data
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item py-2 px-3 text-danger" href="logout.php" style="font-size: 0.9rem;">
                                    <i class="fas fa-sign-out-alt mr-2" style="width: 18px; font-size: 0.9rem;"></i> Logout
                                </a>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ==================== PAGE HEADER ==================== -->
    <div class="page-header text-white text-center py-5 mb-5">
        <div class="container">
            <h2 class="font-weight-bold display-4">All Products</h2>
            <p class="lead text-white-50">Handpicked premium items just for you</p>
        </div>
    </div>

    <!-- ==================== PRODUCTS GRID ==================== -->
    <div class="container pb-5">
        <div class="row">
            <?php foreach ($products as $product => $values): ?>
                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="card border-0 shadow h-100 product-card">
                        <div class="product-img-container d-flex align-items-center justify-content-center position-relative overflow-hidden">
                            <span class="badge badge-danger position-absolute font-weight-bold text-uppercase px-3 py-2 badge-new">New</span>
                            <img src="<?php echo $values['img']; ?>" class="product-img" alt="<?php echo $product; ?>">
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="card-title font-weight-bold mb-2 text-navy" style="font-size: 1.15rem;"><?php echo $product; ?></h5>
                            <p class="card-text text-muted flex-grow-1 mb-3" style="font-size: 0.9rem; line-height: 1.6;"><?php echo $values['desc']; ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="h4 font-weight-bold text-coral">$<?php echo $values['price']; ?></span>
                                    <small class="text-muted text-decoration-line-through ml-2" style="font-size: 0.85rem;">$<?php echo round($values['price'] * 1.2); ?></small>
                                </div>
                                <a href="#" class="btn bg-coral text-white font-weight-bold rounded-pill px-4 py-2" style="font-size: 0.9rem;">
                                    <i class="fas fa-shopping-cart mr-1"></i> Add
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ==================== FOOTER ==================== -->
    <footer class="footer-gradient text-white">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-items-center justify-content-center rounded-lg mr-2 footer-brand-icon">
                            <i class="fas fa-shopping-bag text-white" style="font-size: 1.1rem;"></i>
                        </div>
                        <span class="font-weight-bold ls-1" style="font-size: 1.3rem;">LUXE<span class="text-coral">STORE</span></span>
                    </div>
                    <p class="text-white-50" style="font-size: 0.9rem; line-height: 1.8;">
                        Your premium destination for quality products. We curate the best items just for you with fast shipping and secure payment.
                    </p>
                    <div class="mt-3">
                        <a href="#" class="text-white mr-3" style="font-size: 1.2rem;"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white mr-3" style="font-size: 1.2rem;"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white mr-3" style="font-size: 1.2rem;"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white" style="font-size: 1.2rem;"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="font-weight-bold mb-3 text-coral">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="index.php" class="text-white-50 text-decoration-none" style="font-size: 0.9rem;">Home</a></li>
                        <li class="mb-2"><a href="products.php" class="text-white-50 text-decoration-none" style="font-size: 0.9rem;">All Products</a></li>
                        <li class="mb-2"><a href="account.php" class="text-white-50 text-decoration-none" style="font-size: 0.9rem;">Account</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="font-weight-bold mb-3 text-coral">Customer Service</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none" style="font-size: 0.9rem;">Shipping Policy</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none" style="font-size: 0.9rem;">Return Policy</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none" style="font-size: 0.9rem;">FAQ</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none" style="font-size: 0.9rem;">Privacy Policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="font-weight-bold mb-3 text-coral">Contact Us</h5>
                    <ul class="list-unstyled text-white-50" style="font-size: 0.9rem;">
                        <li class="mb-2"><i class="fas fa-map-marker-alt mr-2 text-coral"></i> 123 Store Street, Cairo, Egypt</li>
                        <li class="mb-2"><i class="fas fa-phone mr-2 text-coral"></i> 01012345678</li>
                        <li class="mb-2"><i class="fas fa-envelope mr-2 text-coral"></i> support@luxestore.com</li>
                    </ul>
                </div>
            </div>

            <div class="border-top pt-4 mt-3" style="border-color: rgba(255,255,255,0.1) !important;">
                <div class="row">
                    <div class="col-md-6 text-center text-md-left">
                        <p class="mb-0 text-white-50" style="font-size: 0.85rem;">&copy; 2026 Noha Elsayed. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-right">
                        <p class="mb-0 text-white-50" style="font-size: 0.85rem;">Made with <i class="fas fa-heart text-coral"></i> by Noha Elsayed</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>