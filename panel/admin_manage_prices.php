<?php
session_start();
include '../db/functions.php';
if (!isset($_SESSION['user_id']) || !is_admin($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Fiyat aralığı ekleme
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['min_price'], $_POST['max_price'], $_POST['label'])) {
    $min = intval($_POST['min_price']);
    $max = intval($_POST['max_price']);
    $label = trim($_POST['label']);

    if ($min >= 0 && $max > $min && !empty($label)) {
        $stmt = $conn->prepare("INSERT INTO price_ranges (min_price, max_price, label) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $min, $max, $label);
        $stmt->execute();
    }
}

// Silme işlemi
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM price_ranges WHERE id = $id");
}

// Listeleme
$prices = $conn->query("SELECT * FROM price_ranges ORDER BY min_price ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fiyat Aralıkları</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h3 class="mb-4">💰 Fiyat Aralığı Yönetimi</h3>

    <form method="POST" class="row g-2 align-items-end mb-4">
        <div class="col-md-3">
            <label class="form-label">Min Fiyat</label>
            <input type="number" name="min_price" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Max Fiyat</label>
            <input type="number" name="max_price" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Etiket (₺, ₺₺₺ vs.)</label>
            <input type="text" name="label" class="form-control" required>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-success w-100">Ekle</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Min</th>
                <th>Max</th>
                <th>Etiket</th>
                <th>İşlem</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($p = $prices->fetch_assoc()): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= $p['min_price'] ?></td>
                <td><?= $p['max_price'] ?></td>
                <td><?= htmlspecialchars($p['label']) ?></td>
                <td>
                    <a href="?delete=<?= $p['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silinsin mi?')">Sil</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
