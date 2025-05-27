<?php
session_start();
include '../db/functions.php';
if (!isset($_SESSION['user_id']) || !is_admin($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}


// Yeni kategori ekleme
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_category'])) {
    $name = trim($_POST['new_category']);
    if (!empty($name)) {
        $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->bind_param("s", $name);
        $stmt->execute();
    }
}

// Kategori silme
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM categories WHERE id = $id");
}

// Aktif/pasif değiştirme
if (isset($_GET['toggle'])) {
    $id = intval($_GET['toggle']);
    $conn->query("UPDATE categories SET is_active = 1 - is_active WHERE id = $id");
}

// Tüm kategorileri çek
$categories = $conn->query("SELECT * FROM categories ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kategorileri Yönet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h3 class="mb-4">📂 Kategori Yönetimi</h3>

    <form method="POST" class="mb-3 d-flex" style="gap:10px;">
        <input type="text" name="new_category" class="form-control" placeholder="Yeni kategori adı" required>
        <button type="submit" class="btn btn-primary">Ekle</button>
    </form>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Ad</th>
                <th>Durum</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($cat = $categories->fetch_assoc()): ?>
            <tr>
                <td><?= $cat['id'] ?></td>
                <td><?= htmlspecialchars($cat['name']) ?></td>
                <td><?= $cat['is_active'] ? "Aktif" : "Pasif" ?></td>
                <td>
                    <a href="?toggle=<?= $cat['id'] ?>" class="btn btn-sm btn-warning">Durum Değiştir</a>
                    <a href="?delete=<?= $cat['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silinsin mi?')">Sil</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
