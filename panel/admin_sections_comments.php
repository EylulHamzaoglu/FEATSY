<?php
session_start();
include 'db/functions.php';

$comments = $conn->query("
    SELECT c.*, u.mail AS user_email, r.name AS restaurant_name
    FROM comments c
    JOIN users u ON c.user_id = u.id
    JOIN restaurants r ON c.restaurant_id = r.id
    WHERE c.is_approved = 1
    ORDER BY c.created_at DESC
");
?>

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
        <?php while ($c = $comments->fetch_assoc()): ?>
            <tr>
                <td><?= $c["id"] ?></td>
                <td><?= htmlspecialchars($c["user_email"]) ?></td>
                <td><?= htmlspecialchars($c["restaurant_name"]) ?></td>
                <td><?= htmlspecialchars($c["comment_text"]) ?></td>
                <td><?= $c["rating"] ?>/5</td>
                <td><?= date("d.m.Y H:i", strtotime($c["created_at"])) ?></td>
                <td>
                    <a href="admin_comment_delete.php?id=<?= $c["id"] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silinsin mi?')">Sil</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
