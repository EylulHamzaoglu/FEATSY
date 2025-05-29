<?php
include '../db/functions.php'; // Veritabanı bağlantısı

// 1. ID kontrolü
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Geçersiz ID");
}

$comment_id = (int)$_GET['id'];
$success = approve_comment(1, $comment_id);

// 3. İşlem sonucuna göre yönlendir
if ($success) {
    header("Location: admin_panel.php?comment_deleted=1");
} else {
    header("Location: admin_panel.php?comment_deleted=0");
}
exit;
