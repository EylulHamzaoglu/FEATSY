<?php
session_start(); 

include 'db/functions.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $result = sign_in($email, $password);

    if ($result['success']) {
        $_SESSION['user_email'] = $email; 
        header("Location: home.php");
        exit();
    } else {
        $message = $result['message'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Askbootstrap">
    <meta name="author" content="Askbootstrap">
    <link rel="icon" type="image/png" href="img/fav.png">
    <title>Swiggiweb - Online Food Ordering Website Template</title>
    <!-- Slick Slider -->
    <link href="vendor/slick/slick/slick.css" rel="stylesheet" type="text/css">
    <link href="vendor/slick/slick/slick-theme.css" rel="stylesheet" type="text/css">
    <!-- Feather Icon-->
    <link href="vendor/icons/feather.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Sidebar CSS -->
    <link href="vendor/sidebar/demo.css" rel="stylesheet">
</head>

<body>
    <div class="login-page vh-100">
        <video loop autoplay muted id="vid">
            <source src="img/bg.mp4" type="video/mp4">
            <source src="img/bg.mp4" type="video/ogg">
            Your browser does not support the video tag.
        </video>
        <div class="d-flex align-items-center justify-content-center vh-100">
            <div class="px-5 col-md-6 ms-auto">
                <div class="px-5 col-10 mx-auto">
                    <h2 class="text-dark my-0">Welcome Back</h2>
                    <p class="text-50">Sign in to continue</p>

                    <!-- HATA MESAJI -->
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-danger"><?php echo $message; ?></div>
                    <?php endif; ?>

                    <form class="mt-5 mb-4" method="post" action="">
                        <div class="form-group">
                            <label class="text-dark pb-1">Email</label>
                            <input type="email" name="email" placeholder="Enter Email" class="form-control py-1" required>
                        </div>
                        <div class="form-group">
                            <label class="text-dark pb-1">Password</label>
                            <input type="password" name="password" placeholder="Enter Password" class="form-control py-1" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100">SIGN IN</button>
                        <div class="py-2">
                            <button type="button" class="btn btn-lg btn-facebook w-100"><i class="feather-facebook"></i> Connect with Facebook</button>
                        </div>
                    </form>

                    <a href="forgot_password.html" class="text-decoration-none">
                        <p class="text-center">Forgot your password?</p>
                    </a>
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="signup.php">
                            <p class="text-center m-0">Don't have an account? Sign up</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav id="main-nav">
        <!-- Nav içeriği senin gönderdiğinle aynı şekilde korunmuştur -->
        <!-- İstersen burada da güncelleme yaparız -->
    </nav>

    <!-- JavaScript -->
    <script type="text/javascript" src="vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="vendor/slick/slick/slick.min.js"></script>
    <script type="text/javascript" src="vendor/sidebar/hc-offcanvas-nav.js"></script>
    <script type="text/javascript" src="js/osahan.js"></script>
</body>
</html>
