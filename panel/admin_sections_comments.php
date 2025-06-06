<?php

include_once 'db/functions.php';
$comments = get_all_comments_with_user_and_restaurant();
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
        <?php foreach ($comments as $c): ?>
            <tr>
                <td><?= $c["id"] ?></td>
                <td><?= htmlspecialchars($c["user_email"]) ?></td>
                <td><?= htmlspecialchars($c["restaurant_name"]) ?></td>
                <td><?= nl2br(htmlspecialchars($c["description"])) ?></td>
                <td><?= $c["rating"] ?>/5</td>
                <td><?= date("d.m.Y H:i", strtotime($c["created_at"])) ?></td>
                <td>
                    <a href="panel/admin_comment_approve.php?id=<?= $c["id"] ?>" class="btn btn-sm btn-success" onclick="return confirm('Yorumu onaylamak istediğinizden emin misiniz?')">
                        Onayla
                    </a>
                    <a href="panel/admin_comment_delete.php?id=<?= $c["id"] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yorumu silmek istediğinizden emin misiniz?')">
                        Sil
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
 </table>