<?php
// Veritabanı bağlantısını dahil et
include 'db/functions.php';

// Form gönderildiyse işle
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image']) && isset($_POST['restaurant_id'])) {
    $restaurant_id = intval($_POST['restaurant_id']);
    $is_main = isset($_POST['is_main']) ? 1 : 0;

    $target_dir = "img/restaurants/";
    $file_name = basename($_FILES["image"]["name"]);
    $unique_file_name = time() . "_" . $file_name; // Benzersiz isim
    $target_file = $target_dir . $unique_file_name;

    // Dosya sunucuya taşınıyor
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Veritabanına kaydediliyor
        $stmt = $conn->prepare("INSERT INTO restaurant_images (restaurant_id, image_url, is_main) VALUES (?, ?, ?)");
        $stmt->bind_param("isi", $restaurant_id, $target_file, $is_main);
        if ($stmt->execute()) {
            $success = "Görsel başarıyla yüklendi.";
        } else {
            $error = "Veritabanı hatası: " . $stmt->error;
        }
    } else {
        $error = "Görsel yüklenirken bir hata oluştu.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Restoran Görsel Yükle</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light py-5">
    <div class="container">
        <div class="card shadow p-4">
            <h2 class="mb-4">Restoran Görsel Yükle</h2>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php elseif (!empty($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <form action="upload_image.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="restaurant_id" class="form-label">Restoran ID</label>
                    <input type="number" class="form-control" id="restaurant_id" name="restaurant_id" required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Görsel Seç</label>
                    <input class="form-control" type="file" id="image" name="image" accept="image/*" required>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="is_main" name="is_main" value="1">
                    <label class="form-check-label" for="is_main">
                        Ana görsel olarak ayarla
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">Yükle</button>
            </form>
        </div>
    </div>
</body>
</html>
