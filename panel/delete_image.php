<?php
session_start();
include '../db/functions.php';

if (!isset($_SESSION['user_id']) || !is_restaurant_owner($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$restaurant_id = get_restaurant_id_by_owner($_SESSION['user_id']);
$image_id = $_GET['id'] ?? null;

if (!$image_id || !is_numeric($image_id)) {
    die("Geçersiz ID.");
}

global $conn;
$stmt = $conn->prepare("SELECT image_url FROM restaurant_images WHERE id = ? AND restaurant_id = ?");
$stmt->bind_param("ii", $image_id, $restaurant_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $file = "img/restaurants/" . $row['image_url'];
    if (file_exists($file)) {
        unlink($file);
    }

    $delete = $conn->prepare("DELETE FROM restaurant_images WHERE id = ?");
    $delete->bind_param("i", $image_id);
    $delete->execute();
}

header("Location: ../restaurant_dashboard.php?image_deleted=1");
exit;
?>
