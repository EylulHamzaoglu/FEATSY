<?php
include 'db/functions.php'; // Veritabanı bağlantısı

// 1. ID kontrolü
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Geçersiz ID");
}

$comment_id = (int)$_GET['id'];

// 2. Yorumu sil
$stmt = $conn->prepare("DELETE FROM comments WHERE id = ?");
$stmt->bind_param("i", $comment_id);
$success = $stmt->execute();

// 3. İşlem sonucuna göre yönlendir
if ($success) {
    header("Location: admin_panel.php?comment_deleted=1");
} else {
    header("Location: admin_panel.php?comment_deleted=0");
}
exit;
