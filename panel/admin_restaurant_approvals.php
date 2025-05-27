<?php
session_start();
include '../db/functions.php';
if (!isset($_SESSION['user_id']) || !is_admin($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Onaylama
if (isset($_GET['approve'])) {
    $id = intval($_GET['approve']);
    $conn->query("UPDATE restaurants SET is_approved = 1 WHERE id = $id");
}

// Silme
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM restaurants WHERE id = $id");
}

// Onay bekleyen restoranlar
$result = $conn->query("SELECT r.*, u.username, u.mail FROM restaurants r
                        JOIN restaurant_owners ro ON r.id = ro.restaurant_id
                        JOIN users u ON ro.user_id = u.id
                        WHERE r.is_approved = 0");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Restoran Onayları</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h3 class="mb-4">🍽️ Onay Bekleyen Restoranlar</h3>

    <?php if ($result->num_rows === 0): ?>
        <div class="alert alert-success">Onay bekleyen restoran bulunmamaktadır.</div>
    <?php else: ?>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Restoran Adı</th>
                <th>Sahibi</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Açıklama</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= htmlspecialchars($row['mail']) ?></td>
                <td><?= htmlspecialchars($row['phone']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td>
                    <a href="?approve=<?= $row['id'] ?>" class="btn btn-sm btn-success">Onayla</a>
                    <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silinsin mi?')">Sil</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php endif; ?>
</body>
</html>
