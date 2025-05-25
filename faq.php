


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
    <title>Featsy - S.S.S.</title>
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
                    <div class="osahan-cart-item-profile">
                        <div class="box bg-white mb-3 shadow-sm rounded">


                        </div>
                        <div class="box bg-white mb-3 shadow-sm rounded">


                        </div>
                        <div id="basics">
                            <!-- Title -->
                            <div class="mb-2 mt-3">
                                <h5 class="font-weight-semi-bold mb-0">Featsy Hakkında</h5>
                            </div>
                            <!-- End Title -->
                            <!-- Basics Accordion -->
                            <div id="basicsAccordion">
                                <!-- Card -->
                                <div class="box border-bottom bg-white mb-2 rounded shadow-sm overflow-hidden">
                                    <div id="basicsHeadingOne">
                                        <h5 class="mb-0">
                                            <button class="shadow-none btn w-100 d-flex justify-content-between card-btn p-3 collapsed" data-bs-toggle="collapse" data-bs-target="#basicsCollapseOne" aria-expanded="false" aria-controls="basicsCollapseOne">
                                    Featsy nedir?
                                    <span class="card-btn-arrow">
                                    <span class="feather-chevron-down"></span>
                                    </span>
                                    </button>
                                        </h5>
                                    </div>
                                    <div id="basicsCollapseOne" class="collapse show" aria-labelledby="basicsHeadingOne" data-bs-parent="#basicsAccordion">
                                        <div class="card-body border-top p-3 text-muted">
                                            Featsy, gastronomiye ilgi duyan kullanıcıların butik restoranları keşfetmesini ve yeni tatlar deneyimlemesini sağlayan bir restoran keşif platformudur.
                                        </div>
                                    </div>
                                </div>
                                <div class="box border-bottom bg-white mb-2 rounded shadow-sm overflow-hidden">
                                    <div id="basicsHeadingTwo">
                                        <h5 class="mb-0">
                                            <button class="shadow-none btn w-100 d-flex justify-content-between card-btn p-3 collapsed" data-bs-toggle="collapse" data-bs-target="#basicsCollapseTwo" aria-expanded="false" aria-controls="basicsCollapseTwo">
                                    Featsy ile ne yapabilirim?
                                    <span class="card-btn-arrow">
                                    <span class="feather-chevron-down"></span>
                                    </span>
                                    </button>
                                        </h5>
                                    </div>
                                    <div id="basicsCollapseTwo" class="collapse" aria-labelledby="basicsHeadingTwo" data-bs-parent="#basicsAccordion">
                                        <div class="card-body border-top p-3 text-muted">
                                            Platform üzerinden konumuna yakın veya ilgini çeken tematik restoranları filtreleyebilir, yapay zeka desteğii ile öneriler alabilir, kullanıcı yorumlarını okuyabilir ve ulaşım bilgilerine erişebilirsin.
                                        </div>
                                    </div>
                                </div>
                                <div class="box border-bottom bg-white mb-2 rounded shadow-sm overflow-hidden">
                                    <div id="basicsHeadingThree">
                                        <h5 class="mb-0">
                                            <button class="shadow-none btn w-100 d-flex justify-content-between card-btn p-3 collapsed" data-bs-toggle="collapse" data-bs-target="#basicsCollapseThree" aria-expanded="false" aria-controls="basicsCollapseThree">
                                    Featsy yemek siparişi hizmeti veriyor mu?
                                    <span class="card-btn-arrow">
                                    <span class="feather-chevron-down"></span>
                                    </span>
                                    </button>
                                        </h5>
                                    </div>
                                    <div id="basicsCollapseThree" class="collapse" aria-labelledby="basicsHeadingThree" data-bs-parent="#basicsAccordion">
                                        <div class="card-body border-top p-3 text-muted">
                                            Hayır. Featsy yalnızca restoran keşif ve bilgi platformudur. Sipariş verme veya ödeme alma işlemleri yapılmaz.
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- End Card -->
                            </div>
                            <!-- End Basics Accordion -->
                        </div>
                        <div id="account">
                            <!-- Title -->
                            <div class="mb-2 mt-3">
                                <h5 class="font-weight-semi-bold mb-0">Restoranlar Hakkında</h5>
                            </div>
                            <!-- End Title -->
                            <!-- Account Accordion -->
                            <div id="accountAccordion">
                                <!-- Card -->
                                <div class="box border-bottom bg-white mb-2 rounded shadow-sm overflow-hidden">
                                    <div id="accountHeadingOne">
                                        <h5 class="mb-0">
                                            <button class="shadow-none btn w-100 d-flex justify-content-between card-btn p-3" data-bs-toggle="collapse" data-bs-target="#accountCollapseOne" aria-expanded="false" aria-controls="accountCollapseOne">
                                    Restoran bilgileriniz ne kadar güncel?
                                    <span class="card-btn-arrow">
                                    <span class="feather-chevron-down"></span>
                                    </span>
                                    </button>
                                        </h5>
                                    </div>
                                    <div id="accountCollapseOne" class="collapse show" aria-labelledby="accountHeadingOne" data-bs-parent="#accountAccordion">
                                        <div class="card-body border-top p-3 text-muted">
                                            Tüm restoran verileri işletmelerle doğrudan iş birliği içinde güncellenmekte ve doğruluğu düzenli olarak kontrol edilmektedir.
                                        </div>
                                    </div>
                                </div>
                                <!-- End Card -->
                                <!-- Card -->
                                <div class="box border-bottom bg-white mb-2 rounded shadow-sm overflow-hidden">
                                    <div id="accountHeadingTwo">
                                        <h5 class="mb-0">
                                            <button class="shadow-none btn w-100 d-flex justify-content-between card-btn collapsed p-3" data-bs-toggle="collapse" data-bs-target="#accountCollapseTwo" aria-expanded="false" aria-controls="accountCollapseTwo">
                                    Restoran yorumları kullanıcılar tarafından mı yapılıyor?
                                    <span class="card-btn-arrow">
                                    <span class="feather-chevron-down"></span>
                                    </span>
                                    </button>
                                        </h5>
                                    </div>
                                    <div id="accountCollapseTwo" class="collapse" aria-labelledby="accountHeadingTwo" data-bs-parent="#accountAccordion">
                                        <div class="card-body border-top p-3 text-muted">
                                            Evet, tüm yorumlar gerçek kullanıcılar tarafından yapılır ve moderasyon ekibi tarafından onaylandıktan sonra yayınlanır.
                                        </div>
                                    </div>
                                </div>
                                <div class="box border-bottom bg-white mb-2 rounded shadow-sm overflow-hidden">
                                    <div id="accountHeadingTwo">
                                        <h5 class="mb-0">
                                            <button class="shadow-none btn w-100 d-flex justify-content-between card-btn collapsed p-3" data-bs-toggle="collapse" data-bs-target="#accountCollapseTwo" aria-expanded="false" aria-controls="accountCollapseTwo">
                                    Featsy’de listelenmek için restoranlar ne yapmalı?
                                    <span class="card-btn-arrow">
                                    <span class="feather-chevron-down"></span>
                                    </span>
                                    </button>
                                        </h5>
                                    </div>
                                    <div id="accountCollapseTwo" class="collapse" aria-labelledby="accountHeadingTwo" data-bs-parent="#accountAccordion">
                                        <div class="card-body border-top p-3 text-muted">
                                            Restoran sahipleri bizimle iletişime geçerek platformda yer almak için başvuru yapabilirler.
                                        </div>
                                    </div>
                                </div>
                                                       <div id="basics">
                            <!-- Title -->
                            <div class="mb-2 mt-3">
                                <h5 class="font-weight-semi-bold mb-0">Kullanıcı Hesabı ve Destek</h5>
                            </div>
                            <!-- End Title -->
                            <!-- Basics Accordion -->
                            <div id="basicsAccordion">
                                <!-- Card -->
                                <div class="box border-bottom bg-white mb-2 rounded shadow-sm overflow-hidden">
                                    <div id="basicsHeadingOne">
                                        <h5 class="mb-0">
                                            <button class="shadow-none btn w-100 d-flex justify-content-between card-btn p-3 collapsed" data-bs-toggle="collapse" data-bs-target="#basicsCollapseOne" aria-expanded="false" aria-controls="basicsCollapseOne">
                                    Featsy üyelik gerektiriyor mu?
                                    <span class="card-btn-arrow">
                                    <span class="feather-chevron-down"></span>
                                    </span>
                                    </button>
                                        </h5>
                                    </div>
                                    <div id="basicsCollapseOne" class="collapse show" aria-labelledby="basicsHeadingOne" data-bs-parent="#basicsAccordion">
                                        <div class="card-body border-top p-3 text-muted">
                                            Hayır, restoranları gezmek ve temel bilgileri görüntülemek için üyelik zorunlu değildir. Ancak yorum yapmak, favorilere eklemek gibi özellikler için üyelik gerekir.
                                        </div>
                                    </div>
                                </div>
                               
                                <!-- End Card -->
                            </div>
                            <!-- End Account Accordion -->
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