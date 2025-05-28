<?php
session_start();
include '../db/functions.php';

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

$sql = "
    SELECT 
        c.id,
        c.description,
        c.created_at,
        u.mail AS user_email,
        r.name AS restaurant_name,
        a.rating
    FROM comments c
    JOIN users u ON c.user_id = u.id
    JOIN restaurants r ON c.restaurant_id = r.id
    LEFT JOIN actions a 
        ON a.user_id = c.user_id AND a.restaurant_id = c.restaurant_id
    WHERE c.is_approved = 0
    ORDER BY c.created_at DESC
";

$pending = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Yorum Onayları</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h3 class="mb-4">🕓 Onay Bekleyen Yorumlar</h3>

    <?php if ($pending && $pending->num_rows === 0): ?>
        <div class="alert alert-success">Onay bekleyen yorum yok.</div>
    <?php elseif ($pending): ?>
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
                        <td><?= nl2br(htmlspecialchars($c['description'])) ?></td>
                        <td><?= $c['rating'] !== null ? $c['rating'] . '/5' : '-' ?></td>
                        <td><?= date('d.m.Y H:i', strtotime($c['created_at'])) ?></td>
                        <td>
                            <a href="?approve=<?= $c['id'] ?>" class="btn btn-sm btn-success">Onayla</a>
                            <a href="?delete=<?= $c['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silinsin mi?')">Sil</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-danger">❌ Veritabanı hatası: <?= $conn->error ?></div>
    <?php endif; ?>
</body>
</html>
