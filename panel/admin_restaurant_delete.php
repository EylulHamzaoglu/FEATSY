<?php
include 'db/functions.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Geçersiz ID");
}

$id = (int)$_GET['id'];

$stmt = $conn->prepare("DELETE FROM restaurants WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: admin_panel.php"); // liste sayfasına dön
exit;
