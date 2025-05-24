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

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Profili Düzenle</title>

  <!-- CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/icons/feather.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

  <style>
    .cat-item a {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100px;
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
</head>

<body class="fixed-bottom-bar">

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8 mb-3">
        <div class="card shadow-sm p-4">
          <h4 class="mb-4">My Account</h4>

          <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div class="alert alert-success">✅ Profil başarıyla güncellendi.</div>
<?php elseif (isset($_GET['error']) && $_GET['error'] == 1): ?>
    <div class="alert alert-danger">❌ Profil güncellenirken bir hata oluştu.</div>
<?php endif; ?>

  <form method="POST" action="update_profile.php">
  <!-- Username -->
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" name="username" id="username" class="form-control"
      value="<?php echo htmlspecialchars($profile['username'] ?? ''); ?>" required>
  </div>

  <!-- First Name -->
  <div class="mb-3">
    <label for="first_name" class="form-label">First Name</label>
    <input type="text" name="first_name" id="first_name" class="form-control"
      value="<?php echo htmlspecialchars($profile['name'] ?? ''); ?>">
  </div>

  <!-- Last Name -->
  <div class="mb-3">
    <label for="last_name" class="form-label">Last Name</label>
    <input type="text" name="last_name" id="last_name" class="form-control"
      value="<?php echo htmlspecialchars($profile['surname'] ?? ''); ?>">
  </div>

  <!-- Phone -->
  <div class="mb-3">
    <label for="phone" class="form-label">Mobile Number</label>
    <input type="text" name="phone" id="phone" class="form-control"
      value="<?php echo htmlspecialchars($profile['phone'] ?? ''); ?>">
  </div>

  <!-- Email -->
  <div class="mb-3">
    <label for="mail" class="form-label">Email</label>
    <input type="email" name="mail" id="mail" class="form-control"
      value="<?php echo htmlspecialchars($profile['mail'] ?? ''); ?>" readonly>
  </div>

  <!-- Birth Date -->
  <div class="mb-3">
    <label for="birth_date" class="form-label">Date of Birth</label>
    <input type="date" name="birth_date" id="birth_date" class="form-control"
      value="<?php echo htmlspecialchars($profile['birth_date'] ?? ''); ?>">
  </div>

  <button type="submit" class="btn btn-danger w-100">Save Changes</button>
</form>



          <div class="additional mt-4">
            <div class="change_password my-3">
              <a href="forgot_password.php"
                class="p-3 border rounded bg-white btn d-flex align-items-center">Change Password
                <i class="feather-arrow-right ms-auto"></i></a>
            </div>
            <div class="deactivate_account">
              <a href="forgot_password.php"
                class="p-3 border rounded bg-white btn d-flex align-items-center">Deactivate Account
                <i class="feather-arrow-right ms-auto"></i></a>
            </div>
          </div>

        </div>
      </div>
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

        
    
  <!-- Bootstrap JS -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>


</html>
