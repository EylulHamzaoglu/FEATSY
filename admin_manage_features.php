<?php
session_start();
include 'db/functions.php';
if (!isset($_SESSION['user_id']) || !is_admin($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Özellik ekleme
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_feature'])) {
    $name = trim($_POST['new_feature']);
    if (!empty($name)) {
        $stmt = $conn->prepare("INSERT INTO features (name) VALUES (?)");
        $stmt->bind_param("s", $name);
        $stmt->execute();
    }
}

// Özellik silme
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM features WHERE id = $id");
}

// Aktif/Pasif değiştirme
if (isset($_GET['toggle'])) {
    $id = intval($_GET['toggle']);
    $conn->query("UPDATE features SET is_active = 1 - is_active WHERE id = $id");
}

// Liste
$features = $conn->query("SELECT * FROM features ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Özellik Etiketleri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h3 class="mb-4">🏷️ Özellik Etiketleri Yönetimi</h3>

    <form method="POST" class="mb-3 d-flex" style="gap:10px;">
        <input type="text" name="new_feature" class="form-control" placeholder="Yeni özellik adı" required>
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
            <?php while ($f = $features->fetch_assoc()): ?>
            <tr>
                <td><?= $f['id'] ?></td>
                <td><?= htmlspecialchars($f['name']) ?></td>
                <td><?= $f['is_active'] ? "Aktif" : "Pasif" ?></td>
                <td>
                    <a href="?toggle=<?= $f['id'] ?>" class="btn btn-sm btn-warning">Durum Değiştir</a>
                    <a href="?delete=<?= $f['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silinsin mi?')">Sil</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
