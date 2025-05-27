<?php
session_start();
include '../db/functions.php';
if (!isset($_SESSION['user_id']) || !is_admin($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Kullanıcıyı onayla
if (isset($_GET['approve'])) {
    $id = intval($_GET['approve']);
    $conn->query("UPDATE users SET is_active = 1 WHERE id = $id");
}

// Kullanıcıyı sil
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM users WHERE id = $id");
}

// Onay bekleyen kullanıcılar
$result = $conn->query("SELECT * FROM users WHERE is_active = 0");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kullanıcı Onayları</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h3 class="mb-4">👤 Onay Bekleyen Kullanıcılar</h3>

    <?php if ($result->num_rows === 0): ?>
        <div class="alert alert-success">Onay bekleyen kullanıcı bulunmamaktadır.</div>
    <?php else: ?>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Kullanıcı Adı</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Kayıt Tarihi</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($u = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['username']) ?></td>
                <td><?= htmlspecialchars($u['mail']) ?></td>
                <td><?= htmlspecialchars($u['phone']) ?></td>
                <td><?= date('d.m.Y H:i', strtotime($u['created_at'])) ?></td>
                <td>
                    <a href="?approve=<?= $u['id'] ?>" class="btn btn-sm btn-success">Onayla</a>
                    <a href="?delete=<?= $u['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silinsin mi?')">Sil</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php endif; ?>
</body>
</html>
