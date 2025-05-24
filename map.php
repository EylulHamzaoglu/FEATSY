<?php
session_start();
include 'db/functions.php';
$popular_restaurants = get_popular_restaurants(8);
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // ya da login.php
    exit();
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
    <title>Featsy</title>
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

    <!-- Devamında gelen sayfa içeriğini aynen bırakabilirsin -->


        <!-- Filters -->
         
       
       
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Featsy">
  <meta name="author" content="Featsy">
  <title>Featsy | Restoran Haritası</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    iframe {
      height: 500px;
      width: 100%;
      border: none;
    }
  </style>
</head>

<body>
 <div class="container my-4">

<div class="mb-3">
<button class="btn btn-outline-primary me-2" onclick="showRestaurant('konoha')">Konoha Etiler</button>
<button class="btn btn-outline-primary me-2" onclick="showRestaurant('brio')">Brio İstanbul</button>
<button class="btn btn-outline-primary me-2" onclick="showRestaurant('ranchero')">Ranchero Ataşehir</button>
<button class="btn btn-outline-primary me-2" onclick="showRestaurant('ppang')">Ppang Moda</button>
<button class="btn btn-outline-primary me-2" onclick="showRestaurant('cosa')">Çosa Beyoğlu</button>
<button class="btn btn-outline-primary me-2" onclick="showRestaurant('upperdeck')">Upperdeck</button>
<button class="btn btn-outline-primary me-2" onclick="showRestaurant('zmash')">Burger ZMASH</button>
</div>
<!-- ... üstteki kodlar değişmediği için atlanıyor -->

<div class="position-relative" style="height: 600px;">
  <iframe allowfullscreen="" class="position-absolute top-0 start-0 w-100 h-100 border-0" id="mapFrame" src=""></iframe>
  <div class="position-absolute top-0 end-0 m-4" id="infoPanel" style="max-width: 400px; z-index: 1000;">
    <div class="bg-white p-3 shadow rounded mb-2">
      <div class="mb-2 d-flex justify-content-between">
        <span class="fw-bold small text-secondary" id="restaurantCategory"></span>
        <a class="small text-danger" href="#"><i class="feather-help-circle"></i> HELP</a>
      </div>
    </div>
    <div class="bg-white p-3 shadow rounded mb-2">
      <div class="mb-2"><small class="text-muted">Restoran</small></div>
      <h6 class="mb-1 fw-bold text-dark" id="restaurantName"></h6>
      <p class="text-muted mb-0 small" id="restaurantAddress"></p>
      <p class="text-muted mb-0 small" id="restaurantHours"></p>
    </div>
    <div class="bg-white p-3 shadow rounded">
      <h6 class="mb-2 fw-bold">Ulaşım Bilgisi</h6>
      <div id="restaurantTransportInfo" class="mb-2 text-muted small">
        Konuma göre ulaşım bilgisi girilebilir.
      </div>
      <hr/>
      <small class="text-muted">Google Haritalar üzerinde navigasyonla kolay ulaşım sağlanabilir.</small>
    </div>
  </div>
</div>


  <script>
    
const restaurants = {
  konoha: {
    name: "Konoha Etiler",
    category: "Uzak Doğu Mutfağı",
    address: "Nisbetiye, Başa Sk. 4a, 34340 Beşiktaş/İstanbull",
    hours: "Açılış Saatleri: 11:00 - 23:00",
    embed: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3007.7133087611005!2d29.017168075861985!3d41.07525897134113!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cab73ebc0f8d51%3A0x34cc38dd0c5a1eb6!2sKonoha%20Etiler!5e0!3m2!1str!2str!4v1747596213035!5m2!1str!2str",
    transport: `
      <p class="mb-2"><i class="feather-navigation text-primary"></i> Etiler Metro İstasyonu'na 350m</p>
      <p class="mb-2"><i class="feather-navigation text-primary"></i> Akmerkez AVM otobüs durağına 200m</p>
      <p class="mb-2"><i class="feather-navigation text-primary"></i> Otopark: Akmerkez kapalı otoparkı kullanılabilir</p>
    `
  },
  brio: {
    name: "Brio İstanbul",
    category: "İtalyan Mutfağı",
    address: "Bağdat Cd. No:321, Kadıköy/İstanbul",
    hours: "Açılış Saatleri: 10:00 - 23:00",
    embed: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3000.8852450247364!2d29.033144575869954!3d41.224271171321085!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x409fe13b8ec2f9b9%3A0xf9dab05ac78721da!2sBrio%20%C4%B0talian%20Restaurant!5e0!3m2!1str!2str!4v1747596261860!5m2!1str!2str",
    transport: `
      <p class="mb-2"><i class="feather-navigation text-primary"></i> Kadıköy Metro İstasyonu’na 600m</p>
      <p class="mb-2"><i class="feather-navigation text-primary"></i> Minibüs duraklarına 300m</p>
      <p class="mb-2"><i class="feather-navigation text-primary"></i> Otopark: Restoranın arkasında özel otopark mevcut</p>
    `
  },
  ranchero: {
    name: "Ranchero Ataşehir Watergarden",
    category: "Meksika Mutfağı",
    address: "Barbaros mahallesi. Şebboy sokak. 2D dükkan no 29, 34746 Ataşehir/İstanbul",
    hours: "Açılış Saatleri: 11:00 - 23:30",
    embed: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3011.2416737293584!2d29.0971767758579!3d40.99808327135198!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cac7258ea9b427%3A0xa93772f596bfe106!2sRanchero%20Ata%C5%9Fehir%20Watergarden!5e0!3m2!1str!2str!4v1747596347645!5m2!1str!2str",
    transport: `
      <p class="mb-2"><i class="feather-navigation text-primary"></i> Watergarden AVM içindedir</p>
      <p class="mb-2"><i class="feather-navigation text-primary"></i> Otobüs duraklarına 150m</p>
      <p class="mb-2"><i class="feather-navigation text-primary"></i> Otopark: AVM kapalı otoparkı kullanılabilir</p>
    `
  },
  ppang: {
    name: "Ppang Moda",
    category: "Uzak Doğu Mutfağı",
    address: "Caferağa, Keresteci Aziz Sk. No:36B, 34710 Kadıköy/İstanbul",
    hours: "Açılış Saatleri: 09:00 - 22:00",
    embed: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3011.9090338511205!2d29.024949084814473!3d40.98347269749247!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cab9884e9057d7%3A0xc46eb7130883b96e!2sPpang%20Moda!5e0!3m2!1str!2str!4v1747596416691!5m2!1str!2str",
    transport: `
      <p class="mb-2"><i class="feather-navigation text-primary"></i> Moda Tramvay Hattı'na yaklaşık 250m</p>
      <p class="mb-2"><i class="feather-navigation text-primary"></i> Moda Çay Bahçesi’ne yaklaşık 200m</p>
      <p class="mb-2"><i class="feather-navigation text-primary"></i> Yakın çevrede halka açık otopark alanları mevcut</p>
    `
  },
  cosa: {
    name: "Çosa Beyoğlu",
    category: "Sokak Lezzetleri",
    address: "Hüseyinağa, Yeşilçam Sk. No:3, 34435 Beyoğlu/İstanbul",
    hours: "Açılış Saatleri: 12:00 - 23:45",
    embed: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3009.5568381260887!2d28.977140175859923!3d41.03495047134687!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14caca4aa1e10001%3A0xf032c91d5874882c!2zw4dvc2E!5e0!3m2!1str!2str!4v1747596640575!5m2!1str!2str",
    transport: `
      <p class="mb-2"><i class="feather-navigation text-primary"></i> İstiklal Caddesi’ne 100m</p>
      <p class="mb-2"><i class="feather-navigation text-primary"></i> Taksim Metro’ya 450m</p>
      <p class="mb-2"><i class="feather-navigation text-primary"></i> Otopark: Galatasaray Lisesi arkasında açık otopark</p>
    `
  },
  upperdeck: {
    name: "Upperdeck American Diner",
    category: "Amerikan Mutfağı",
    address: "Sinanpaşa, Hasfırın Cd. No:298 kat 2, 34022 Beşiktaş/İstanbul",
    hours: "Açılış Saatleri: 10:30 - 22:00",
    embed: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3009.1808336800814!2d29.001337484835737!3d41.043174397462444!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cab7ee7c772355%3A0xedc322e05306e618!2sUpperdeck%20American%20Diner!5e0!3m2!1str!2str!4v1747596817965!5m2!1str!2str",
    transport: `
      <p class="mb-2"><i class="feather-navigation text-primary"></i> Beşiktaş İskele’ye 300m</p>
      <p class="mb-2"><i class="feather-navigation text-primary"></i> Otobüs ve dolmuş duraklarına 200m</p>
      <p class="mb-2"><i class="feather-navigation text-primary"></i> Çevrede birçok ücretli otopark mevcut</p>
    `
  },
  zmash: {
    name: "Burger ZMASH",
    category: "Fast Food",
    address: "Emirgan, Fırın Sk. No:13/1, 34467 Sarıyer/İstanbul",
    hours: "Açılış Saatleri: 11:00 - 22:30",
    embed: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3006.554694009285!2d29.049510075863395!3d41.10057527133771!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cacb07b581b4cb%3A0x4d3128cef3c5e171!2sBURGER%20ZMASH%20(Rezervasyonlu)!5e0!3m2!1str!2str!4v1747596871724!5m2!1str!2str",
    transport: `
      <p class="mb-2"><i class="feather-navigation text-primary"></i> Emirgan Sahili’ne 100m</p>
      <p class="mb-2"><i class="feather-navigation text-primary"></i> Emirgan otobüs durağına 200m</p>
      <p class="mb-2"><i class="feather-navigation text-primary"></i> Sahil boyunca ücretsiz park yerleri</p>
    `
  }
};

   
    function showRestaurant(key) {
        const r = restaurants[key];
        document.getElementById('mapFrame').src = r.embed;
        document.getElementById('restaurantName').innerText = r.name;
        document.getElementById('restaurantCategory').innerText = r.category;
        document.getElementById('restaurantAddress').innerText = r.address;
        document.getElementById('restaurantHours').innerText = r.hours;

  // Dinamik ulaşım bilgisi yerleştir
        document.getElementById('restaurantTransportInfo').innerHTML = r.transport || `<p class="mb-1 text-muted small">Konuma göre ulaşım bilgisi girilebilir.</p>`;
    }


    // Varsayılan restoranı yükle
    window.onload = function () {
      showRestaurant('ppang');
    };

    

    
  </script>

 
 
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- slider -->


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