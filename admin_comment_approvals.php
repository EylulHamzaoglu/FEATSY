<?php
session_start();
include 'db/functions.php';
if (!isset($_SESSION['user_id']) || !is_admin($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

if (isset($_GET['approve'])) {
    $id = intval($_GET['approve']);
    $conn->query("UPDATE comments SET is_approved = 1 WHERE id = $id");
    header("Location: admin_comment_approvals.php?onay=ok");
    exit();
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM comments WHERE id = $id");
    header("Location: admin_comment_approvals.php?sil=ok");
    exit();
}

$pending = $conn->query("
    SELECT c.*, u.mail AS user_email, r.name AS restaurant_name
    FROM comments c
    JOIN users u ON c.user_id = u.id
    JOIN restaurants r ON c.restaurant_id = r.id
    WHERE c.is_approved = 0
    ORDER BY c.created_at DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Yorum Onayları</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h3 class="mb-4">🕓 Onay Bekleyen Yorumlar</h3>

    <?php if ($pending->num_rows === 0): ?>
        <div class="alert alert-success">Onay bekleyen yorum yok.</div>
    <?php else: ?>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Kullanıcı</th>
                <th>Restoran</th>
                <th>Yorum</th>
                <th>Puan</th>
                <th>Tarih</th>
                <th>İşlem</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($c = $pending->fetch_assoc()): ?>
            <tr>
                <td><?= $c['id'] ?></td>
                <td><?= htmlspecialchars($c['user_email']) ?></td>
                <td><?= htmlspecialchars($c['restaurant_name']) ?></td>
                <td><?= htmlspecialchars($c['comment_text']) ?></td>
                <td><?= $c['rating'] ?>/5</td>
                <td><?= date('d.m.Y H:i', strtotime($c['created_at'])) ?></td>
                <td>
                    <a href="?approve=<?= $c['id'] ?>" class="btn btn-sm btn-success">Onayla</a>
                    <a href="?delete=<?= $c['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silinsin mi?')">Sil</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php endif; ?>
</body>
</html>
