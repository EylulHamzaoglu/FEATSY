<?php
include 'db/functions.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';

    $result = sign_up($username, $password, $email);

    if ($result['success']) {
        header("Location: index.php"); // 🔁 index.php'ye yönlendir
        exit();
    } else {
        $message = $result['message']; // ❗ hata varsa mesaj göster
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
    <title>Swiggiweb - Sign Up</title>
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
         <div class="form-container align-items-start" style="padding-top: 100px;">
      <div class="form-box">
        <h2 class="text-dark my-0">Hello There.</h2>
        <p class="text-muted mb-4">Sign up to continue</p>

                    <!-- HATA MESAJI -->
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-danger"><?php echo $message; ?></div>
                    <?php endif; ?>
                    

                    <form class="mt-4 mb-4" method="post" action="">
                        <div class="form-group">
                            <label class="text-dark pb-1">Name</label>
                            <input type="text" placeholder="Enter Name" class="form-control py-1" name="username" id="username">
                        </div>
                        <div class="form-group">
                            <label class="text-dark pb-1">Email</label>
                            <input type="text" placeholder="Enter Mail" class="form-control py-1" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label class="text-dark pb-1">Password</label>
                            <input type="password" placeholder="Enter Password" class="form-control py-1" name="password" id="password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100 my-3">
                            SIGN UP
                        </button>
                    </form>

                    <div class="new-acc d-flex align-items-center justify-content-center">
                        <a href="login.php">
                            <p class="text-center m-0">Already have an account? Sign in</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script type="text/javascript" src="vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="vendor/slick/slick/slick.min.js"></script>
    <script type="text/javascript" src="vendor/sidebar/hc-offcanvas-nav.js"></script>
    <script type="text/javascript" src="js/osahan.js"></script>
</body>
</html>
