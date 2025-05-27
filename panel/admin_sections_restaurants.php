<?php
include_once 'db/functions.php';

$restaurants = get_all_restaurants_with_owners();
?>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Restoran Adı</th>
            <th>Sahip (Email)</th>
            <th>Fiyat Aralığı</th>
            <th>Çalışma Saatleri</th>
            <th>Durum</th>
            <th>İşlem</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($restaurants as $rest): ?>
            <tr>
                <td><?= $rest['id'] ?></td>
                <td><?= htmlspecialchars($rest['name']) ?></td>
                <td><?= htmlspecialchars($rest['owner_email'] ?? '-') ?></td>
                <td><?= htmlspecialchars($rest['price_range_id']) ?></td>
                <td><?= htmlspecialchars($rest['opening_hours']) ?></td>
                <td>
                    <?= $rest['is_active'] ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-secondary">Pasif</span>' ?>
                </td>
                <td>
                    <a href="panel/admin_restaurant_edit.php?id=<?= $rest['id'] ?>" class="btn btn-sm btn-primary">Düzenle</a>
                    <a href="panel/admin_restaurant_delete.php?id=<?= $rest['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bu restoranı silmek istediğine emin misin?')">Sil</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
