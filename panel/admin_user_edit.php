<?php
session_start();
include '../db/functions.php';
if (!isset($_SESSION['user_id']) || !is_admin($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
$user_id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "Kullanıcı bulunamadı.";
    exit;
}

// Güncelleme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['is_active'])) {
    $new_status = intval($_POST['is_active']);
    $update = $conn->prepare("UPDATE users SET is_active = ? WHERE id = ?");
    $update->bind_param("ii", $new_status, $user_id);
    $update->execute();
    header("Location: admin_panel.php"); // veya users listesine yönlendir
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kullanıcı Durum Güncelle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h3 class="mb-4">👤 Kullanıcı Aktif/Pasif Güncelle</h3>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Ad Soyad</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($user['mail']) ?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Telefon</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Durum</label>
            <select name="is_active" class="form-select">
                <option value="1" <?= $user['is_active'] ? 'selected' : '' ?>>Aktif</option>
                <option value="0" <?= !$user['is_active'] ? 'selected' : '' ?>>Pasif</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Kaydet</button>
        <a href="admin_panel.php" class="btn btn-secondary">İptal</a>
    </form>
</body>
</html>