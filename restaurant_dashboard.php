<?php
session_start();
include 'db/functions.php';

if (!isset($_SESSION['user_id']) || !is_restaurant_owner($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$restaurant_id = get_restaurant_id_by_owner($_SESSION['user_id']);
$restaurant = get_restaurant_details($restaurant_id);
$menu_items = get_restaurant_menu_items($restaurant_id);
$gallery = get_restaurant_images($restaurant_id);
$gallery = $conn->query("SELECT id, image_url, is_main FROM restaurant_images WHERE restaurant_id = $restaurant_id");

$comments = get_restaurant_comments($restaurant_id);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Restoran Paneli</title>
  <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>
<body class="container py-5">

<h1 class="mb-4">Restoran Paneli</h1>
<p>Hoş geldiniz, <strong><?= htmlspecialchars($_SESSION['user_email']) ?></strong></p>

<h2 class="mt-5">Restoran Bilgileri</h2>
<?php if (isset($_GET['success'])): ?>
  <div class="alert alert-success">Restoran bilgileri başarıyla güncellendi.</div>
<?php endif; ?>

<?php if (isset($_GET['image_uploaded'])): ?>
  <div class="alert alert-success">Görsel başarıyla yüklendi.</div>
<?php endif; ?>
<?php if (isset($_GET['image_deleted'])): ?>
  <div class="alert alert-danger">Görsel silindi.</div>
<?php endif; ?>

<?php if (isset($_GET['menu_added'])): ?>
  <div class="alert alert-success">Yeni menü öğesi eklendi.</div>
<?php endif; ?>

<?php if (isset($_GET['updated'])): ?>
  <div class="alert alert-info">Menü öğesi güncellendi.</div>
<?php endif; ?>

<?php if (isset($_GET['deleted'])): ?>
  <div class="alert alert-danger">Menü öğesi silindi.</div>
<?php endif; ?>


<form method="POST" action="panel/update_restaurant.php" class="mb-4">
  <div class="mb-2">
    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($restaurant['name']) ?>" placeholder="Restoran adı">
  </div>
  <div class="mb-2">
    <input type="text" name="opening_hours" class="form-control" value="<?= htmlspecialchars($restaurant['opening_hours']) ?>" placeholder="Çalışma saatleri">
  </div>
  <div class="mb-2">
    <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($restaurant['description']) ?></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Güncelle</button>
</form>



<h2 class="mt-5">Menü Yönetimi</h2>
<a href="panel/add_menu_item.php" class="btn btn-success mb-3">+ Yeni ürün ekle</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Bölüm</th>
            <th>Ad</th>
            <th>Fiyat</th>
            <th style="width: 150px;">İşlem</th>
        </tr>
    </thead>
    <tbody>
        <?php $menu_items->data_seek(0); while ($item = $menu_items->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($item['section_name']) ?></td>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td><?= number_format($item['price'], 2) ?> ₺</td>
                <td>
                    <a href="panel/edit_menu_item.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-warning">Düzenle</a>
                    <a href="panel/delete_menu_item.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bu ürünü silmek istediğinize emin misiniz?');">Sil</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>



<h2 class="mt-5">Fotoğraf Galerisi</h2>
<a href="panel/upload_image.php" class="btn btn-info mb-3">+ Fotoğraf Yükle</a>
<div class="row g-2">
<?php while ($img = $gallery->fetch_assoc()): ?>
  <div class="col-md-3">
    <div class="card">
      <img src="img/restaurants/<?= htmlspecialchars($img['image_url']) ?>" class="card-img-top" alt="">
      <div class="card-body p-2 text-center">
        <?php if ($img['is_main']): ?>
          <span class="badge bg-success mb-2">Ana Görsel</span><br>
        <?php endif; ?>
        <a href="panel/delete_image.php?id=<?= $img['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bu görseli silmek istediğinizden emin misiniz?')">Sil</a>
      </div>
    </div>
  </div>
<?php endwhile; ?>
</div>


<h2 class="mt-5">Yorumlar</h2>
<?php if ($comments && $comments->num_rows > 0): ?>
  <?php while ($comment = $comments->fetch_assoc()): ?>
    <div class="border p-3 mb-2">
      <strong><?= htmlspecialchars($comment['username']) ?></strong> - ⭐ <?= intval($comment['rating']) ?>/5<br>
      <p class="mb-1"><?= htmlspecialchars($comment['comment_text']) ?></p>
      <small class="text-muted"><?= date("d.m.Y H:i", strtotime($comment['created_at'])) ?></small>
    </div>
  <?php endwhile; ?>
<?php else: ?>
  <p class="text-muted">Henüz yorum yok.</p>
<?php endif; ?>

</body>
</html>
