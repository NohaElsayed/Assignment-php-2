<?php
// Start PHP session to track user login state across pages
session_start();

// Get display name for logged-in user, default to "User" if username not set
$displayName = !empty($_SESSION['username']) ? $_SESSION['username'] : 'User';

// Check if user is logged in by checking if email exists in session
$isLoggedIn = isset($_SESSION['email']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxeStore — Home</title>

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="bg-white">

    <!-- ==================== NAVBAR ==================== -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top py-2" style="min-height: 70px;">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <div class="d-flex align-items-center justify-content-center rounded-lg mr-2 bg-gradient-coral brand-icon">
                    <i class="fas fa-shopping-bag text-white"></i>
                </div>
                <div>
                    <span class="font-weight-bold d-block ls-1 text-navy" style="font-size: 1.3rem; line-height: 1;">LUXE</span>
                    <span class="text-coral font-weight-medium ls-3" style="font-size: 0.7rem;">STORE</span>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-1">
                        <a class="nav-link font-weight-bold px-3 py-2 rounded-pill nav-active" href="index.php" style="font-size: 0.9rem;">
                            <i class="fas fa-home mr-1" style="font-size: 0.8rem;"></i> Home
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link font-weight-bold px-3 py-2 rounded-pill text-muted" href="products.php" style="font-size: 0.9rem;">
                            <i class="fas fa-th-large mr-1" style="font-size: 0.8rem;"></i> All Products
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav align-items-center">
                    <?php if (!$isLoggedIn): ?>
                        <li class="nav-item">
                            <a class="btn bg-gradient-coral font-weight-bold px-4 py-2 rounded-pill text-white" href="account.php" style="font-size: 0.85rem;">
                                <i class="fas fa-sign-in-alt mr-1"></i> Account
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center font-weight-bold pl-3 pr-2 py-2 rounded-pill bg-gradient-light border text-navy" href="#" id="userDropdown" role="button" data-toggle="dropdown" style="font-size: 0.9rem; border-color: #dee2e6;">
                                <div class="d-flex align-items-center justify-content-center rounded-circle mr-2 bg-gradient-coral avatar-circle">
                                    <span class="text-white font-weight-bold" style="font-size: 0.8rem;">
                                        <?php echo strtoupper(substr($displayName, 0, 1)); ?>
                                    </span>
                                </div>
                                <span><?php echo htmlspecialchars($displayName); ?></span>
                                <i class="fas fa-chevron-down ml-2 text-muted" style="font-size: 0.65rem;"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right border-0 shadow mt-2 rounded-lg" style="border-radius: 16px; min-width: 200px;">
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

    <!-- ==================== HERO SECTION ==================== -->
    <div class="d-flex align-items-center justify-content-center text-center text-white position-relative overflow-hidden hero-section">
        <div class="container">
            <h1 class="display-3 font-weight-bold mb-3">Welcome to Our Store</h1>
            <p class="lead mb-4">Discover premium products curated just for you</p>
            <a href="products.php" class="btn btn-lg text-white font-weight-bold px-5 py-3 rounded-pill shadow-lg bg-gradient-coral">Shop Now →</a>
        </div>
    </div>

    <!-- ==================== FEATURES SECTION ==================== -->
    <div class="container py-5 my-5">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="p-4 rounded-lg shadow-sm bg-light h-100">
                    <div class="d-flex align-items-center justify-content-center rounded-circle mx-auto mb-3 shadow bg-gradient-coral feature-icon">
                        <span class="text-white h3 mb-0">🚚</span>
                    </div>
                    <h4 class="font-weight-bold">Fast Shipping</h4>
                    <p class="text-muted">Free delivery on orders over $50</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4 rounded-lg shadow-sm bg-light h-100">
                    <div class="d-flex align-items-center justify-content-center rounded-circle mx-auto mb-3 shadow bg-gradient-coral feature-icon">
                        <span class="text-white h3 mb-0">⭐</span>
                    </div>
                    <h4 class="font-weight-bold">Premium Quality</h4>
                    <p class="text-muted">Handpicked products from top brands</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4 rounded-lg shadow-sm bg-light h-100">
                    <div class="d-flex align-items-center justify-content-center rounded-circle mx-auto mb-3 shadow bg-gradient-coral feature-icon">
                        <span class="text-white h3 mb-0">🔒</span>
                    </div>
                    <h4 class="font-weight-bold">Secure Payment</h4>
                    <p class="text-muted">100% secure checkout process</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== FOOTER ==================== -->
    <footer class="bg-gradient-navy text-white">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-items-center justify-content-center rounded-lg mr-2 bg-gradient-coral brand-icon">
                            <i class="fas fa-shopping-bag text-white"></i>
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

            <div class="border-top pt-4 mt-3 footer-border">
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