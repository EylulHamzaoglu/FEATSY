<?php
include_once 'db/functions.php';

$images = get_all_restaurant_images_with_names();
?>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Restoran</th>
            <th>Görsel</th>
            <th>Ana Görsel mi?</th>
            <th>Yükleme Tarihi</th>
            <th>İşlem</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($images as $img): ?>
            <tr>
                <td><?= $img['id'] ?></td>
                <td><?= htmlspecialchars($img['restaurant_name']) ?></td>
                <td>
                    <img src="img/restaurants/<?= htmlspecialchars($img['image_url']) ?>" alt="Image" style="width: 100px; height: auto;">
                </td>
                <td>
                    <?= $img['is_main'] ? '<span class="badge bg-success">Evet</span>' : '<span class="badge bg-secondary">Hayır</span>' ?>
                </td>
                <td><?= date('d.m.Y H:i', strtotime($img['created_at'])) ?></td>
                <td>
                    <a href="panel/admin_image_delete.php?id=<?= $img['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bu görseli silmek istediğinize emin misiniz?')">Sil</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
