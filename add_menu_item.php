<?php
session_start();
include 'db/functions.php';

if (!isset($_SESSION['user_id']) || !is_restaurant_owner($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$restaurant_id = get_restaurant_id_by_owner($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $section = $_POST['section_name'] ?? '';
    $name = $_POST['name'] ?? '';
    $price = floatval($_POST['price'] ?? 0);

    if (!empty($section) && !empty($name) && $price > 0) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO restaurant_menu_items (restaurant_id, section_name, name, price, sort_order, created_at) VALUES (?, ?, ?, ?, 0, NOW())");
        $stmt->bind_param("issd", $restaurant_id, $section, $name, $price);

        if ($stmt->execute()) {
            header("Location: restaurant_panel.php?menu_added=1");
            exit;
        } else {
            $error = "Veritabanı hatası: " . $stmt->error;
        }
    } else {
        $error = "Tüm alanları eksiksiz doldurun.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yeni Menü Ürünü Ekle</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>
<body class="container py-5">
    <h1>Yeni Menü Ürünü Ekle</h1>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="section_name" class="form-label">Bölüm (ör: Starters, Drinks)</label>
            <input type="text" name="section_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Ürün Adı</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Fiyat (₺)</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Kaydet</button>
        <a href="restaurant_panel.php" class="btn btn-secondary">Geri Dön</a>
    </form>
</body>
</html>
