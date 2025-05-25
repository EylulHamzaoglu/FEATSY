<?php
session_start();
include 'db/functions.php';



?>






<!DOCTYPE html>
<html lang="en">
<head>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Askbootstrap">
    <meta name="author" content="Askbootstrap">
    <link rel="icon" type="image/png" href="img/fav.png">
    <title>Featsy - Chatbot</title>
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
        body {
            margin: 0;
            padding: 0;
        }
        .chat-container {
            width: 100%;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="chat-container">
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

        <!-- ✍️ Orta: Slogan -->
        <div class="col-md-6 text-center">
          <p class="mb-0 fw-bold text-dark fs-5">Ne Yiyeceğini Bilmiyorsan Featsy'e Sor!</p>
        </div>

        <!-- ✅ Sağ: Chatbot, Search, Guest -->
        <div class="col-auto d-flex align-items-center gap-4">

          <!-- 🤖 Chatbot -->
          <a href="chatbot.php" class="d-flex align-items-center text-dark text-decoration-none">
            <i class="feather-message-circle h5 mb-0 me-1"></i>
            <span class="fw-semibold">Chatbot</span>
          </a>

          <!-- 🔍 Search -->
          <a href="search.php" class="d-flex align-items-center text-dark text-decoration-none">
            <i class="feather-search h5 mb-0 me-1"></i>
            <span class="fw-semibold">Arama</span>
          </a>

          <!-- 👤 Kullanıcı -->
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
        <iframe 
            src="https://featsychat.cereinsight.com" 
            width="100%" 
            style="height: 100%; min-height: 700px" 
            frameborder="0">
        </iframe>
    </div>
</body>
</html>
