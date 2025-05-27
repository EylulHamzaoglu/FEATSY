<?php
session_start();
include '../db/functions.php';
if (!isset($_SESSION['user_id']) || !is_admin($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Mesaj silme işlemi
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM contact_messages WHERE id = $id");
}

$messages = $conn->query("
    SELECT cm.*, u.username, u.mail, u.phone
    FROM contact_messages cm
    JOIN users u ON cm.user_id = u.id
    ORDER BY cm.created_at DESC
");

?>

<!DOCTYPE html>
<html>
<head>
    <title>İletişim Mesajları</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h3 class="mb-4">📬 İletişim Formu Mesajları</h3>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Kullanıcı</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Mesaj</th>
                <th>Tarih</th>
                <th>İşlem</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($msg = $messages->fetch_assoc()): ?>
            <tr>
                <td><?= $msg['id'] ?></td>
                <td><?= htmlspecialchars($msg['username']) ?></td>
                <td><?= htmlspecialchars($msg['mail']) ?></td>
                <td><?= htmlspecialchars($msg['phone']) ?></td>
                <td><?= nl2br(htmlspecialchars($msg['message'])) ?></td>
                <td><?= date('d.m.Y H:i', strtotime($msg['created_at'])) ?></td>
                <td>
                    <a href="?delete=<?= $msg['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silinsin mi?')">Sil</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
