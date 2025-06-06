<?php
session_start();
include 'db/functions.php';
$search_query = $_GET['q'] ?? null;

if ($search_query) {
    $restaurants = search_restaurants_by_name($search_query);
} else {
    $restaurants = get_popular_restaurants(8); // ya da boş array: []
}
$popular_restaurants = get_popular_restaurants(8);
if (!isset($_SESSION['user_id'])) {
  // Giriş yapılmamışsa, guest session tanımla (sadece home.php için)
  $_SESSION['user_email'] = 'Guest';
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
    <title>Featsy - Arama</title>
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
.search-form-custom {
  margin-top: 60px;
  margin-bottom: 40px;
}

.search-bar {
  border-radius: 50px;
  overflow: hidden;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
  background: #fff;
  transition: box-shadow 0.3s ease;
}

.search-bar:hover {
  box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
}

.search-bar input {
  border: none;
  border-radius: 50px 0 0 50px;
  padding-left: 20px;
  font-size: 16px;
  height: 50px;
}

.search-bar button {
  border: none;
  background: linear-gradient(to right, #ff5722, #ff9800);
  color: white;
  border-radius: 0 50px 50px 0;
  padding: 0 25px;
  transition: background 0.3s ease;
}

.search-bar button:hover {
  background: linear-gradient(to right, #e64a19, #f57c00);
}

.search-bar input:focus {
  box-shadow: none;
  outline: none;
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
    <img alt="logo" src="img/logo.png" style="height: 140px; width: auto;">
  </a>
</div>
<!-- ✍️ Yeni Yazı Alanı -->
<div class="col-md-6 text-center">
    <p class="mb-0 fw-bold text-dark fs-5">Ne Yiyeceğini Bilmiyorsan Featsy'e Sor!</p>
  </div>

      <!-- ✅ Sağ: Search ve Guest -->
      <div class="col-auto d-flex align-items-center gap-4">
          <a href="chatbot.php" class="d-flex align-items-center text-dark text-decoration-none">
            <i class="feather-message-circle h5 mb-0 me-1"></i>
            <span class="fw-semibold">Chatbot</span>
          </a>

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

                <!-- row.// -->
            </div>
            <!-- container.// -->
        </section>
        <!-- header-main .// -->
    </header>
    <div class="d-none">
        <div class="bg-primary p-3 d-flex align-items-center">
            <a class="toggle togglew toggle-2" href="#"><span></span></a>
            <h4 class="fw-bold m-0 text-white">Search</h4>
        </div>
    </div>

   <form method="GET" action="search.php" class="d-flex justify-content-center search-form-custom">
  <div class="input-group search-bar w-50">
    <input type="text" name="q" class="form-control" placeholder="İstediğiniz Restoranı Aratın" required>
    <button class="btn" type="submit">
      <i class="feather-search"></i>
    </button>
  </div>
</form>

    <div class="container my-4">
    <div class="row g-3">
<?php foreach ($restaurants as $restaurant): ?>
    <?php $imagePath = get_main_image_url($restaurant['id']); ?>
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
            <div class="list-card-image">
                <div class="star position-absolute">
                    <span class="badge text-bg-success">
                        <i class="feather-star"></i>
                        <?= $restaurant['average_rating'] ?? '0.0' ?>
                        (<?= $restaurant['total_ratings'] ?>)
                    </span>
                </div>
                <div class="favourite-heart text-danger position-absolute rounded-circle">
                    <a href="#"><i class="feather-heart"></i></a>
                </div>
                <a href="restaurant.php?id=<?= $restaurant['id'] ?>">
                    <img alt="Restaurant Image" src="<?= $imagePath ?>" class="img-fluid item-img w-100" style="height: 200px; object-fit: cover;">
                </a>
            </div>
            <div class="p-3 position-relative">
                <div class="list-card-body">
                    <h6 class="mb-1">
                        <a href="restaurant.php?id=<?= $restaurant['id'] ?>" class="text-black">
                            <?= htmlspecialchars($restaurant['name']) ?>
                        </a>
                    </h6>
                    <p class="text-gray mb-1 small">• <?= $restaurant['category_name'] ?? 'Unknown' ?></p>
                    <ul class="rating-stars list-unstyled">
                        <li>
                            <?php
                            $rating = round($restaurant['average_rating']);
                            for ($i = 1; $i <= 5; $i++) {
                                echo '<i class="feather-star' . ($i <= $rating ? ' star_active' : '') . '"></i>';
                            }
                            ?>
                        </li>
                    </ul>
                </div>
                <div class="list-card-badge">
                    <span class="badge text-bg-danger">POPULAR</span>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

   </div>
  </div>

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