<?php
session_start();
include 'db/functions.php';

if (!isset($_SESSION['user_id']) || !is_restaurant_owner($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$restaurant_id = get_restaurant_id_by_owner($_SESSION['user_id']);
$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    die("Geçersiz ürün ID");
}

global $conn;

// Ürünü getir
$stmt = $conn->prepare("SELECT * FROM restaurant_menu_items WHERE id = ? AND restaurant_id = ?");
$stmt->bind_param("ii", $id, $restaurant_id);
$stmt->execute();
$item = $stmt->get_result()->fetch_assoc();

if (!$item) die("Ürün bulunamadı.");

// Form gönderildiğinde güncelle
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $section = $_POST['section_name'] ?? '';
    $name = $_POST['name'] ?? '';
    $price = floatval($_POST['price'] ?? 0);

    $stmt = $conn->prepare("UPDATE restaurant_menu_items SET section_name = ?, name = ?, price = ? WHERE id = ? AND restaurant_id = ?");
    $stmt->bind_param("ssdii", $section, $name, $price, $id, $restaurant_id);
    $stmt->execute();

    header("Location: restaurant_panel.php?updated=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Menü Ürünü Düzenle</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>
<body class="container py-5">
    <h1>Menü Ürünü Düzenle</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="section_name" class="form-label">Bölüm</label>
            <input type="text" name="section_name" value="<?= htmlspecialchars($item['section_name']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Ürün Adı</label>
            <input type="text" name="name" value="<?= htmlspecialchars($item['name']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Fiyat</label>
            <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($item['price']) ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Güncelle</button>
        <a href="restaurant_panel.php" class="btn btn-secondary">Geri Dön</a>
    </form>
</body>
</html>
