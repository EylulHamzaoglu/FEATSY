<?php
session_start();
include '../db/functions.php';

if (!isset($_SESSION['user_id']) || !is_restaurant_owner($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$restaurant_id = get_restaurant_id_by_owner($_SESSION['user_id']);
$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    die("Geçersiz ürün ID");
}

global $conn;
$stmt = $conn->prepare("DELETE FROM restaurant_menu_items WHERE id = ? AND restaurant_id = ?");
$stmt->bind_param("ii", $id, $restaurant_id);
$stmt->execute();

header("Location: ../restaurant_dashboard.php?deleted=1");
exit;
?>
