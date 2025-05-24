<?php
include_once 'db/functions.php';

$owners = get_all_restaurant_owners();
?>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Kullanıcı (E-posta)</th>
            <th>Restoran Adı</th>
            <th>İşlem</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($owners as $o): ?>
            <tr>
                <td><?= $o['id'] ?></td>
                <td><?= htmlspecialchars($o['user_email']) ?></td>
                <td><?= htmlspecialchars($o['restaurant_name']) ?></td>
                <td>
                    <a href="admin_owner_delete.php?id=<?= $o['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bu ilişkiyi silmek istediğinize emin misiniz?')">Sil</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
