<?php

session_start();
include_once 'db/functions.php';

// Giriş kontrolü
if (!isset($_SESSION['user_id']) || !is_admin($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Featsy Admin Panel</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4 text-center">🛠️ Featsy Admin Panel</h2>

        <div class="accordion" id="adminAccordion">

            <!-- 👥 Kullanıcılar -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUsers">
                        👥 Kullanıcılar
                    </button>
                </h2>
                <div id="collapseUsers" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <?php include 'panel/admin_sections_users.php'; ?>
                    </div>
                </div>
            </div>

            <!-- 🍽️ Restoranlar -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRestaurants">
                        🍽️ Restoranlar
                    </button>
                </h2>
                <div id="collapseRestaurants" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <?php include 'panel/admin_sections_restaurants.php'; ?>
                    </div>
                </div>
            </div>


            

            <!-- 📸 Görseller -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseImages">
                        📸 Fotoğraflar
                    </button>
                </h2>
                <div id="collapseImages" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <?php include 'panel/admin_sections_images.php'; ?>
                    </div>
                </div>
            </div>

            <!-- 💬 Yorumlar -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseComments">
                        💬 Yorumlar
                    </button>
                </h2>
                <div id="collapseComments" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <?php include 'admin_sections_comments.php'; ?>
                    </div>
                </div>
            </div>

            <!-- 🧑‍🍳 Restoran Sahipleri -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOwners">
                        🧑‍🍳 Restoran Sahipleri
                    </button>
                </h2>
                <div id="collapseOwners" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <?php include 'panel/admin_sections_owners.php'; ?>
                    </div>
                </div>
            </div>
            <!-- Kategoriler, Özellikler ve Fiyat Aralığı -->
<div class="accordion-item">
  <h2 class="accordion-header">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSettings">
      🛠️ Kategoriler, Özellikler ve Fiyat Aralıkları
    </button>
  </h2>
  <div id="collapseSettings" class="accordion-collapse collapse">
    <div class="accordion-body">
      <ul>
        <li><a href="panel/admin_manage_categories.php">📂 Kategorileri Yönet</a></li>
        <li><a href="panel/admin_manage_features.php">🏷️ Özellikleri Yönet</a></li>
        <li><a href="panel/admin_manage_prices.php">💰 Fiyat Aralıklarını Yönet</a></li>
      </ul>
    </div>
  </div>
</div>

<!-- İletişim Formu Mesajları -->
<div class="accordion-item">
  <h2 class="accordion-header">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseContact">
      📬 İletişim Formu Mesajları
    </button>
  </h2>
  <div id="collapseContact" class="accordion-collapse collapse">
    <div class="accordion-body">
      <a href="panel/admin_contact_messages.php">Mesajları Görüntüle</a>
    </div>
  </div>
</div>

<!-- Hareket Onayları -->
<div class="accordion-item">
  <h2 class="accordion-header">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseApprovals">
      ✅ Restoran & Kullanıcı Onayları
    </button>
  </h2>
  <div id="collapseApprovals" class="accordion-collapse collapse">
    <div class="accordion-body">
      <ul>
        <li><a href="panel/admin_user_approvals.php">👤 Kullanıcı Onayları</a></li>
        <li><a href="panel/admin_restaurant_approvals.php">🍽️ Restoran Onayları</a></li>
      </ul>
    </div>
  </div>
</div>

<div class="accordion-item">
  <h2 class="accordion-header">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseApproval">
      💬 Admin Yorum Onayları
    </button>
  </h2>
  <div id="collapseApproval" class="accordion-collapse collapse">
    <div class="accordion-body">
      <a href="panel/admin_comment_approvals.php">Yorumları Görüntüle</a>
    </div>
  </div>
</div>







        <div class="text-center mt-5">
            <a href="logout.php" class="btn btn-outline-danger">🚪 Çıkış Yap</a>
        </div>
    </div>



    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
