<?php
session_start();
include '../db/functions.php';

if (!isset($_SESSION['user_id']) || !is_restaurant_owner($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$restaurant_id = get_restaurant_id_by_owner($_SESSION['user_id']);
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];

    if ($file['error'] === 0) {
        $filename = uniqid() . "_" . basename($file['name']);
        $target_dir = "img/restaurants/";
        $target_file = $target_dir . $filename;

        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            global $conn;

            $is_main = isset($_POST['is_main']) ? 1 : 0;

            // Eğer is_main seçildiyse, diğerlerini 0 yap
            if ($is_main === 1) {
                $conn->query("UPDATE restaurant_images SET is_main = 0 WHERE restaurant_id = $restaurant_id");
            }

            $stmt = $conn->prepare("INSERT INTO restaurant_images (restaurant_id, image_url, is_main, created_at) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("isi", $restaurant_id, $filename, $is_main);
            $stmt->execute();

            header("Location: restaurant_panel.php?image_uploaded=1");
            exit;
        } else {
            $message = "Dosya yüklenemedi.";
        }
    } else {
        $message = "Dosya seçimi hatalı.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Görsel Yükle</title>
      <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
</head>
<body class="container py-5">
  <h1>Restoran Görseli Yükle</h1>

  <?php if (!empty($message)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="image" class="form-label">Görsel Seç</label>
      <input type="file" name="image" class="form-control" required accept="image/*">
    </div>
    <div class="form-check mb-3">
      <input type="checkbox" name="is_main" class="form-check-input" id="is_main">
      <label for="is_main" class="form-check-label">Ana Görsel Olsun</label>
    </div>
    <button type="submit" class="btn btn-primary">Yükle</button>
    <a href="restaurant_panel.php" class="btn btn-secondary">Geri Dön</a>
  </form>
</body>
</html>
