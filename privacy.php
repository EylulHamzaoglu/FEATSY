

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
    <title>Featsy - Gizlilik Politikası</title>
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

<body class="d-flex flex-column min-vh-100">
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
    <img alt="logo" src="img/logo.png" class="img-fluid" style="height: 80px;">
  </a>
</div>
 <div class="col-auto d-flex align-items-center gap-4">
          <a href="chatbot.php" class="d-flex align-items-center text-dark text-decoration-none">
            <i class="feather-message-circle h5 mb-0 me-1"></i>
            <span class="fw-semibold">Chatbot</span>
          </a>
      <!-- ✅ Sağ: Search ve Guest -->
      <div class="col-auto d-flex align-items-center gap-4">

        <!-- Search -->
        <a href="search.php" class="d-flex align-items-center text-dark text-decoration-none">
          <i class="feather-search h5 mb-0 me-1"></i>
          <span class="fw-semibold">Arama</span>
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
          <a class="dropdown-item" href="favorites.php">Favoriler</a>
                                 <a class="dropdown-item" href="faq.php">S.S.S.</a>
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
         <main>
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
                <div class="col-md-8">
                    <div class="rounded shadow-sm">
                        <div class="osahan-privacy bg-white rounded shadow-sm p-4">
                            <div id="intro" class="mb-4">
                                <!-- Title -->
                                <div class="mb-3">
                                    <h2 class="h5">Gizlilik Politikası</h2>
                                </div>
                                <!-- End Title -->
                                
                                </p>
                                <p>Featsy olarak kullanıcı gizliliğini en öncelikli değerlerimizden biri olarak kabul ediyoruz. Platformumuzu kullandığınızda, e-posta adresiniz, konum bilgileriniz ve restoran tercihleriniz gibi bazı kişisel verileriniz tarafımızca toplanabilir. Bu veriler yalnızca size daha iyi ve kişiselleştirilmiş bir kullanıcı deneyimi sunmak, restoran önerilerini iyileştirmek ve hizmet kalitemizi artırmak amacıyla kullanılmaktadır. Verileriniz, açık rızanız olmadan hiçbir şekilde üçüncü kişilerle paylaşılmaz ya da ticari amaçlarla kullanılmaz. Tüm bilgileriniz, yürürlükteki Kişisel Verilerin Korunması Kanunu (KVKK) ve diğer ilgili mevzuatlara uygun şekilde güvenli biçimde saklanmakta ve korunmaktadır. Featsy'yi kullanmaya devam etmeniz, bu politikayı kabul ettiğiniz anlamına gelir. Verilerinizi şeffaf, güvenli ve sorumlu bir şekilde işlemeye devam edeceğimizi taahhüt ederiz.</p>
                            </div>
                            
                    </div>
                </div>
            </div>
        </div>
</main>
        <!-- Footer -->
  
    <footer class="section-footer border-top bg-dark text-white mt-auto">
  <div class="container py-5">
    <div class="row gy-4">
      <!-- About Us -->
      <div class="col-lg-4 col-md-6">
        <div class="d-flex">
          <img src="img/logo.png" alt="Featsy Logo" style="height: 60px;" class="me-3">
          <div>
            <h6 class="fw-bold text-white">Hakkımızda</h6>
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
        <h6 class="fw-bold">Servisler</h6>
        <ul class="list-unstyled small">
          <li><a href="faq.php" class="text-muted">S.S.S</a></li>
          <li><a href="contact-us.php" class="text-muted">Bize Ulaşın</a></li>
          <li><a href="terms.php" class="text-muted">Kullanım Şarltları</a></li>
          <li><a href="privacy.php" class="text-muted">Gizlilik Politikası</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-3 col-sm-6">
        <h6 class="fw-bold">Kullanıcı İçin</h6>
        <ul class="list-unstyled small">
          <li><a href="index.php" class="text-muted">Kullanıcı Girişi</a></li>
          <li><a href="signup.php" class="text-muted">Kayıt Ol</a></li>
          
          <li><a href="profile.php" class="text-muted">Hesap Ayarları</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-3 col-sm-6">
        <h6 class="fw-bold">Daha Fazla</h6>
        <ul class="list-unstyled small">
          <li><a href="search.php" class="text-muted">Arama</a></li>
          <li><a href="favorites.php" class="text-muted">Favoriler</a></li>
          <li><a href="map.php" class="text-muted">Harita</a></li>
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