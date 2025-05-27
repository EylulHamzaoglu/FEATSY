<?php
session_start();
include '../db/functions.php';
if (!isset($_SESSION['user_id']) || !is_admin($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
$users = get_all_users(); // Fonksiyon zaten functions.php'de tanımlı olmalı
?>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Kullanıcı Adı</th>
            <th>Email</th>
            <th>Telefon</th>
            <th>Doğum Tarihi</th>
            <th>İşlem</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <td><?= htmlspecialchars($user['mail']) ?></td>
                <td><?= htmlspecialchars($user['phone'] ?? '-') ?></td>
                <td><?= htmlspecialchars($user['birth_date'] ?? '-') ?></td>
                <td>
                    <a href="admin_user_edit.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-primary">Düzenle</a>
                    <a href="admin_user_delete.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğine emin misin?')">Sil</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
