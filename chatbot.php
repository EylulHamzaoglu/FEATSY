<?php
session_start();
include 'db/functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Featsy Chatbot Page">
  <meta name="author" content="Featsy Team">
  <link rel="icon" type="image/png" href="img/fav.png">
  <title>Featsy - Chatbot</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS -->
  <link href="vendor/slick/slick/slick.css" rel="stylesheet">
  <link href="vendor/slick/slick/slick-theme.css" rel="stylesheet">
  <link href="vendor/icons/feather.css" rel="stylesheet">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/sidebar/demo.css" rel="stylesheet">

  <!-- Custom Styles -->
  <link href="css/style.css" rel="stylesheet">

  <style>
    body {
        margin: 0;
        padding: 0;
        background: linear-gradient(to bottom right, #fefefe, #eceff1);
        font-family: 'Rubik', sans-serif;
        position: relative;
        overflow-x: hidden;
    }

    .chat-section {
        position: relative;
        min-height: 100vh;
        background: linear-gradient(145deg, #f5f7fa, #e4ebf0);
        z-index: 1;
    }

    .bg-blur-circle,
    .chat-section::before,
    .chat-section::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        z-index: 0;
    }

    .bg-blur-circle {
        width: 400px;
        height: 400px;
        opacity: 0.5;
    }

    .chat-section::before {
        width: 300px;
        height: 300px;
        top: 100px;
        left: -50px;
        background: rgba(255, 111, 0, 0.1);
    }

    .chat-section::after {
        width: 300px;
        height: 300px;
        bottom: 100px;
        right: -50px;
        background: rgba(33, 150, 243, 0.1);
    }

    .card {
        background: #ffffff;
        border-radius: 1.5rem;
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    }

    .card-header {
        font-size: 1.25rem;
        font-weight: 600;
        background: #ff6f00 !important;
        color: white;
        border-bottom: none;
        border-top-left-radius: 1.5rem;
        border-top-right-radius: 1.5rem;
    }

    .footer-note {
        margin-top: 20px;
        font-size: 0.9rem;
        color: #888;
        text-align: center;
    }

    /* SVG Divider */
    .custom-shape-divider-top {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        overflow: hidden;
        line-height: 0;
        z-index: 0;
    }

    .custom-shape-divider-top svg {
        position: relative;
        display: block;
        width: calc(160% + 1.3px);
        height: 120px;
    }

    .custom-shape-divider-top .shape-fill {
        fill: #ff6f00;
    }
  </style>
</head>

<body class="fixed-bottom-bar">

<!-- SVG Wavy Divider -->
<div class="custom-shape-divider-top">
  <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
    <path d="M0,0V46.29c47.71,22,106.79,29,158,14C274.47,35.05,327.51,1,385,1S495.47,35.05,552,50s124.51-7,185-16c62.7-9.48,126.13-10,183,0V0Z" opacity=".25" class="shape-fill"></path>
    <path d="M0,0V15.81C47.71,29.8,106.79,37.55,158,27c116.47-25.88,169.51-60.92,227-60.92S495.47,1,552,16s124.51-7,185-16c62.7-9.48,126.13-10,183,0V0Z" opacity=".5" class="shape-fill"></path>
    <path d="M0,0V5.81C47.71,19.8,106.79,27.55,158,17c116.47-25.88,169.51-60.92,227-60.92S495.47,1,552,16s124.51-7,185-16c62.7-9.48,126.13-10,183,0V0Z" class="shape-fill"></path>
  </svg>
</div>

<!-- HEADER -->
<header class="section-header">
  <section class="header-main shadow-sm bg-white">
    <div class="container">
      <div class="row align-items-center justify-content-between py-2">

        <div class="col-auto">
          <a href="home.php" class="brand-wrap mb-0">
            <img alt="logo" src="img/logo.png" style="height: 140px; width: auto;">
          </a>
        </div>

        <div class="col-md-6 text-center">
          <p class="mb-0 fw-bold text-dark fs-5">Ne Yiyeceğini Bilmiyorsan Featsy'e Sor!</p>
        </div>

        <div class="col-auto d-flex align-items-center gap-4">
          <a href="chatbot.php" class="d-flex align-items-center text-dark text-decoration-none">
            <i class="feather-message-circle h5 mb-0 me-1"></i>
            <span class="fw-semibold">Chatbot</span>
          </a>
          <a href="search.php" class="d-flex align-items-center text-dark text-decoration-none">
            <i class="feather-search h5 mb-0 me-1"></i>
            <span class="fw-semibold">Arama</span>
          </a>
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

<!-- Banner -->
<div class="bg-warning bg-gradient py-3 text-center text-dark">
  <h5 class="fw-bold mb-0">
    🍽️ Featsy Asistanı ile En İyi Restoranı Anında Bul!
  </h5>
</div>

<!-- Chatbot Section -->
<div class="chat-section py-5">
  <div class="bg-blur-circle" style="top: -100px; left: -100px; background: #e0f7fa;"></div>
  <div class="bg-blur-circle" style="bottom: -100px; right: -100px; background: #ffe0b2;"></div>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10 col-xl-8">
        <div class="card shadow-lg border-0 rounded-4">
          <div class="card-header">
            <h5 class="mb-0 d-flex align-items-center">
              <i class="feather-message-circle me-2"></i>
              Featsy Chatbot Asistanı
            </h5>
          </div>
          <div class="card-body p-0">
            <iframe 
              src="https://featsychat.cereinsight.com"
              width="100%" height="600" frameborder="0"
              style="border-radius: 0 0 20px 20px;">
            </iframe>
            <div class="footer-note">
              Featsy © 2025 – Tüm hakları saklıdır | Powered by 🍜
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
