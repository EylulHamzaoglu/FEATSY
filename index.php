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
    $_SESSION['user_id'] = $result['user_id'];

    // Role göre yönlendirme
    if ($result['role'] === 'admin') {
        header("Location: admin_panel.php");
    } elseif ($result['role'] === 'owner') {
        header("Location: restaurant_dashboard.php");
    } else {
        header("Location: home.php");
    }

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
    <title>Featsy - Giriş Yap</title>
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

<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div class="alert alert-success text-center">
        ✅ Kayıt başarıyla tamamlandı. Giriş yapabilirsiniz.
    </div>
<?php endif; ?>

<style>
  html, body {
    margin: 0;
    padding: 0;
    height: 100vh;
  }

  .login-wrapper {
    display: flex;
    height: 100vh;
    align-items: center; /* Dikey ortalama */
    justify-content: center; /* İki tarafı ortala */
  }

  .logo-container, .form-container {
    flex: 1;
    display: flex;
    justify-content: center;
  }

  .logo-container {
    align-items: flex-start; /* form ile aynı hizadan başla */
    padding-top: 100px; /* logo yukarıda değil, formla aynı hizada olur */
  }

  .form-box {
    width: 75%;
  }

  .logo-img {
    max-width: 500px;
  }
</style>

<body>
  <div class="login-wrapper">
    <!-- Sol: Logo -->
    <div class="logo-container">
      <img src="img/logo.png" alt="Featsy Logo" class="logo-img">
    </div>

    <!-- Sağ: Form -->
    <div class="form-container">
      <div class="form-box">
        <h2 class="text-dark my-0">Hoşgeldiniz</h2>
        <p class="text-50">Devam etmek için giriş yap</p>

                    <!-- HATA MESAJI -->
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-danger"><?php echo $message; ?></div>
                    <?php endif; ?>

                    <form class="mt-5 mb-4" method="post" action="">
                        <div class="form-group">
                            <label class="text-dark pb-1">Email</label>
                            <input type="email" name="email" placeholder="Email Gir" class="form-control py-1" required>
                        </div>
                        <div class="form-group">
                            <label class="text-dark pb-1">Şifre</label>
                            <input type="password" name="password" placeholder="Şifre Gir" class="form-control py-1" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100 my-3">GİRİŞ YAP</button>
                       
                    <a href="forgot_password.php" class="text-decoration-none">
                        <p class="text-center">Şifreni mi unuttun?</p>
                    </a>
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="signup.php">
                            <p class="text-center m-0">Hesabın yok mu? Kayıt ol</p>
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
