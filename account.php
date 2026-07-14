<?php
// Include validation logic from separate file (handles form submission & validation)
require_once 'validation.php';

// Get display name for navbar, default to "User"
$displayName = !empty($_SESSION['username']) ? $_SESSION['username'] : 'User';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxeStore — Account</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="bg-white">

    <!-- ==================== NAVBAR ==================== -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top py-2" style="min-height: 70px;">
        <div class="container">
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
                        <a class="nav-link font-weight-bold px-3 py-2 rounded-pill text-muted" href="index.php" style="font-size: 0.9rem;">
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
                                    <span class="text-white font-weight-bold" style="font-size: 0.8rem;"><?php echo strtoupper(substr($displayName, 0, 1)); ?></span>
                                </div>
                                <span><?php echo htmlspecialchars($displayName); ?></span>
                                <i class="fas fa-chevron-down ml-2 text-muted" style="font-size: 0.65rem;"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right border-0 shadow mt-2 rounded-lg" style="min-width: 200px; border-radius: 16px;">
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

    <!-- ==================== ACCOUNT CARD ==================== -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="card border-0 shadow-lg" style="border-radius: 25px;">

                    <!-- Card Header -->
                    <div class="text-center text-white p-4 bg-gradient-coral card-header-custom">
                        <i class="fas <?php echo $isLoggedIn ? 'fa-user-circle' : 'fa-sign-in-alt'; ?> fa-3x mb-2"></i>
                        <h3 class="font-weight-bold mb-1">
                            <?php echo $isLoggedIn ? 'Continue Your Data' : 'Welcome Back'; ?>
                        </h3>
                        <p class="mb-0 small">
                            <?php echo $isLoggedIn ? 'Complete your profile information below' : 'Sign in to continue shopping'; ?>
                        </p>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-4 bg-white card-body-custom">

                        <!-- Error Messages -->
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger border-0 rounded-lg">
                                <ul class="mb-0 pl-3 small">
                                    <?php foreach ($errors as $e): ?>
                                        <li><?php echo $e; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Login Form -->
                        <?php if (!$isLoggedIn): ?>
                            <form method="POST" novalidate>
                                <div class="form-group">
                                    <label class="font-weight-bold small text-dark">Email Address</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0"><i class="fas fa-envelope text-muted"></i></span>
                                        </div>
                                        <input type="email" name="email" class="form-control border-left-0" placeholder="you@example.com" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold small text-dark">Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0"><i class="fas fa-lock text-muted"></i></span>
                                        </div>
                                        <input type="password" name="password" class="form-control border-left-0" placeholder="••••••••" minlength="6" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-block text-white font-weight-bold py-2 rounded-lg shadow bg-gradient-coral">Sign In</button>
                            </form>

                            <!-- Profile Form -->
                        <?php else: ?>
                            <form method="POST" novalidate>
                                <div class="form-group">
                                    <label class="font-weight-bold small text-dark">Username</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0"><i class="fas fa-user text-muted"></i></span>
                                        </div>
                                        <input type="text" name="username" class="form-control border-left-0" value="<?php echo $_SESSION['username'] ?? ''; ?>" placeholder="Enter username" minlength="3" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold small text-dark">Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0"><i class="fas fa-lock text-muted"></i></span>
                                        </div>
                                        <input type="password" name="password" class="form-control border-left-0" value="<?php echo $_SESSION['password'] ?? ''; ?>" placeholder="Enter password" minlength="6" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold small text-dark">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0"><i class="fas fa-envelope text-muted"></i></span>
                                        </div>
                                        <input type="email" name="email" class="form-control border-left-0" value="<?php echo $_SESSION['email'] ?? ''; ?>" placeholder="Enter email" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold small text-dark">Phone Number</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0"><i class="fas fa-phone text-muted"></i></span>
                                        </div>
                                        <input type="text" name="phone" class="form-control border-left-0" value="<?php echo $_SESSION['phone'] ?? ''; ?>" placeholder="01012345678" pattern="^01[012][0-9]{8}$" maxlength="11" required>
                                    </div>
                                    <small class="form-text text-muted">Must start with 010, 011, or 012 and be 11 digits.</small>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold small text-dark">Facebook URL</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0"><i class="fab fa-facebook text-primary"></i></span>
                                        </div>
                                        <input type="url" name="facebook" class="form-control border-left-0" value="<?php echo $_SESSION['facebook'] ?? ''; ?>" placeholder="https://facebook.com/...">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold small text-dark">Twitter URL</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0"><i class="fab fa-twitter text-info"></i></span>
                                        </div>
                                        <input type="url" name="twitter" class="form-control border-left-0" value="<?php echo $_SESSION['twitter'] ?? ''; ?>" placeholder="https://twitter.com/...">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold small text-dark">Instagram URL</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0"><i class="fab fa-instagram text-danger"></i></span>
                                        </div>
                                        <input type="url" name="instagram" class="form-control border-left-0" value="<?php echo $_SESSION['instagram'] ?? ''; ?>" placeholder="https://instagram.com/...">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-block text-white font-weight-bold py-2 rounded-lg shadow bg-gradient-coral">Save Data</button>
                            </form>
                        <?php endif; ?>

                        <div class="text-center mt-3">
                            <a href="index.php" class="text-muted small"><i class="fas fa-arrow-left mr-1"></i> Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>