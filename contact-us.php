
<?php
session_start();
include 'db/functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // ya da login.php
    exit();
}
$user_id = $_SESSION['user_id'];
$profile = get_user_profile($user_id); // Bu fonksiyon veritabanından kullanıcı bilgilerini çekmeli
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

<body class="fixed-bottom-bar">
    <style>
.cat-item a {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-height: 100px; /* kutular eşit yükseklikte olsun */
  height: 100%;
  text-align: center;
}

.cat-item img {
  height: 40px;
  width: 40px;
  object-fit: contain;
  margin-bottom: 5px;
}

.cat-item p {
  margin: 0;
  font-size: 14px;
  line-height: 1.2;
}
</style>

    <!-- Hoş geldin mesajı -->


    <header class="section-header">
        <section class="header-main shadow-sm bg-white">
  <div class="container">
    <div class="row align-items-center justify-content-between py-2">
      <!-- ✅ Sol: Logo -->
      <div class="col-auto">
  <a href="home.php" class="brand-wrap mb-0">
    <img alt="logo" src="img/logo.png" class="img-fluid" style="height: 110px;">
  </a>
</div>

      <!-- ✅ Sağ: Search ve Guest -->
      <div class="col-auto d-flex align-items-center gap-4">

        <!-- Search -->
        <a href="search.php" class="d-flex align-items-center text-dark text-decoration-none">
          <i class="feather-search h5 mb-0 me-1"></i>
          <span class="fw-semibold">Search</span>
        </a>

        <!-- Guest dropdown -->
        <div class="dropdown">
          <a href="#" class="dropdown-toggle d-flex align-items-center text-dark text-decoration-none"
             id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="img/homelogo/guestlogo.png" alt="User" class="rounded-circle me-2"
                 style="width: 32px; height: 32px;">
            <span class="fw-semibold"><?php echo $_SESSION['user_email'] ?? 'Guest'; ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="profile.php">Hesabım</a>
                                 <a class="dropdown-item" href="faq.php">FAQ</a>
            <a class="dropdown-item" href="contact-us.php">Bize Ulaşın</a>
            <a class="dropdown-item" href="terms.php">Kullanım Şartları</a>
            <a class="dropdown-item" href="privacy.php">Gizlilik Politikası</a>
            <a class="dropdown-item" href="logout.php">Çıkış</a>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
    </header>

    <!-- Devamında gelen sayfa içeriğini aynen bırakabilirsin -->


        <!-- Filters -->
         

        <!-- profile -->
        <div class="container position-relative">
    <div class="py-5 osahan-profile row">
        <div class="col-md-4 mb-3">
            <div class="bg-white rounded shadow-sm sticky_sidebar overflow-hidden">
                <a href="profile.php" class="">
                    <div class="d-flex align-items-center p-3">
                        <div class="left me-3">
                            <img alt="Profil Fotoğrafı" src="<?php echo $profile['profile_picture'] ?? 'img/homelogo/guestlogo.png'; ?>" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                        </div>
                        <div class="right">
                            <h6 class="mb-1 fw-bold">
                                <?php echo htmlspecialchars($profile['username'] ?? ''); ?>
                                <i class="feather-check-circle text-success"></i>
                            </h6>
                            <p class="text-muted m-0 small">
                                <?php echo htmlspecialchars($profile['mail'] ?? ''); ?>
                            </p>
                        </div>
                    </div>
                </a>

                        <!-- profile-details -->
                        <div class="bg-white profile-details">
                            
                                <div class="right ms-auto">
                                    <span class="fw-bold m-0"><i class="feather-chevron-right h6 m-0"></i></span>
                                </div>
                            </a>

                            <a href="contact-us.php" class="d-flex w-100 align-items-center border-bottom px-3 py-4">
                                <div class="left me-3">
                                    <h6 class="fw-bold m-0 text-dark"><i class="feather-phone bg-primary text-white p-2 rounded-circle me-2"></i> İletişim</h6>
                                </div>
                                <div class="right ms-auto">
                                    <span class="fw-bold m-0"><i class="feather-chevron-right h6 m-0"></i></span>
                                </div>
                            </a>
                            <a href="terms.php" class="d-flex w-100 align-items-center border-bottom px-3 py-4">
                                <div class="left me-3">
                                    <h6 class="fw-bold m-0 text-dark"><i class="feather-info bg-success text-white p-2 rounded-circle me-2"></i> Kullanım Şartları</h6>
                                </div>
                                <div class="right ms-auto">
                                    <span class="fw-bold m-0"><i class="feather-chevron-right h6 m-0"></i></span>
                                </div>
                            </a>
                            <a href="privacy.php" class="d-flex w-100 align-items-center px-3 py-4">
                                <div class="left me-3">
                                    <h6 class="fw-bold m-0 text-dark"><i class="feather-lock bg-warning text-white p-2 rounded-circle me-2"></i> Gizlilik Politikası</h6>
                                </div>
                                <div class="right ms-auto">
                                    <span class="fw-bold m-0"><i class="feather-chevron-right h6 m-0"></i></span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mb-3">
                    <div class="rounded shadow-sm">
                        <div class="osahan-cart-item-profile bg-white rounded shadow-sm p-4">
                            <div class="flex-column">
                                <h6 class="fw-bold">Kendinizden bahsedin</h6>
                                <p class="text-muted">Sorularınız varsa ya da sadece merhaba demek isterseniz, bizimle iletişime geçin.</p>
                                <form>
                              <div class="form-group mb-3">
    <label for="name" class="small fw-bold pb-1">Adınız</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Adınız Soyadınız"
        value="<?php echo htmlspecialchars($profile['username'] ?? ''); ?>">
</div>

<div class="form-group mb-3">
    <label for="mail" class="small fw-bold pb-1">E-posta Adresiniz</label>
    <input type="email" class="form-control" id="mail" name="mail" placeholder="zeynepkaraca@gmail.com"
        value="<?php echo htmlspecialchars($profile['mail'] ?? ''); ?>" readonly>
</div>

<div class="form-group mb-3">
    <label for="phone" class="small fw-bold pb-1">Telefon Numaranız</label>
    <input type="text" class="form-control" id="phone" name="phone" placeholder="506 899 78 45"
        value="<?php echo htmlspecialchars($profile['phone'] ?? ''); ?>">
</div>
                                    <div class="form-group mb-3">
                                        <label for="exampleFormControlTextarea1" class="small fw-bold pb-1">SİZE NASIL YARDIMCI OLABİLİRİZ?</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Merhaba..." rows="3"></textarea>
                                    </div>
                                    <a class="btn btn-primary w-100" href="#">GÖNDER</a>
                                </form>
                                <!-- Map -->
                                <div class="mapouter pt-3">
                                    <div class="gmap_canvas"><iframe class="w-100 h-100 border-0" id="gmap_canvas" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12030.68901114405!2d28.97835945!3d41.0082376!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cab9b8882fd391%3A0x5bb0ed8b36d1f8b6!2sİstanbul!5e0!3m2!1str!2str!4v1715790000000!5m2!1str!2str"></iframe></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
<footer class="section-footer border-top bg-dark text-white">
  <div class="container py-5">
    <div class="row gy-4">
      <!-- About Us -->
      <div class="col-lg-4 col-md-6">
        <div class="d-flex">
          <img src="img/logo.png" alt="Featsy Logo" style="height: 60px;" class="me-3">
          <div>
            <h6 class="fw-bold text-white">About Us</h6>
            <p class="text-muted mb-2 small">Featsy, yerel lezzetleri keşfetmenizi kolaylaştıran modern bir restoran rehberidir. Benzersiz deneyimler için doğru adres.</p>
            <div class="d-flex gap-2">
              <a class="btn btn-sm btn-outline-light" href="#"><i class="feather-facebook"></i></a>
              <a class="btn btn-sm btn-outline-light" href="#"><i class="feather-instagram"></i></a>
              <a class="btn btn-sm btn-outline-light" href="#"><i class="feather-twitter"></i></a>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer Columns -->
      <div class="col-lg-2 col-md-3 col-sm-6">
        <h6 class="fw-bold">Error Pages</h6>
        <ul class="list-unstyled small">
          <li><a href="not-found.php" class="text-muted">Not found</a></li>
          <li><a href="maintence.php" class="text-muted">Maintenance</a></li>
          <li><a href="coming-soon.php" class="text-muted">Coming Soon</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-3 col-sm-6">
        <h6 class="fw-bold">Services</h6>
        <ul class="list-unstyled small">
          <li><a href="faq.php" class="text-muted">Delivery Support</a></li>
          <li><a href="contact-us.php" class="text-muted">Contact Us</a></li>
          <li><a href="terms.php" class="text-muted">Terms of use</a></li>
          <li><a href="privacy.php" class="text-muted">Privacy policy</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-3 col-sm-6">
        <h6 class="fw-bold">For Users</h6>
        <ul class="list-unstyled small">
          <li><a href="login.php" class="text-muted">User Login</a></li>
          <li><a href="signup.php" class="text-muted">User Register</a></li>
          <li><a href="forgot_password.php" class="text-muted">Forgot Password</a></li>
          <li><a href="profile.php" class="text-muted">Account Settings</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-3 col-sm-6">
        <h6 class="fw-bold">More Pages</h6>
        <ul class="list-unstyled small">
          <li><a href="trending.php" class="text-muted">Trending</a></li>
          <li><a href="most_popular.php" class="text-muted">Most Popular</a></li>
          <li><a href="restaurant.php" class="text-muted">Restaurant Detail</a></li>
          <li><a href="favorites.php" class="text-muted">Favorites</a></li>
        </ul>
      </div>
    </div>

    <hr class="border-secondary mt-5">

    <div class="d-flex justify-content-between align-items-center flex-column flex-md-row text-muted small">
      <p class="mb-2 mb-md-0">© 2025 Featsy. All rights reserved.</p>
      <div>
        <a href="#"><img src="img/appstore.png" height="40" class="me-2" alt="App Store"></a>
        <a href="#"><img src="img/playmarket.png" height="40" alt="Google Play"></a>
      </div>
    </div>
  </div>
</footer>

            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- slick Slider JS-->
    <script type="text/javascript" src="vendor/slick/slick/slick.min.js"></script>
    <!-- Sidebar JS-->
    <script type="text/javascript" src="vendor/sidebar/hc-offcanvas-nav.js"></script>
    <!-- Custom scripts for all pages-->
    <script type="text/javascript" src="js/osahan.js"></script>
</body>

</html>