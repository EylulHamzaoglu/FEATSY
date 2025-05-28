<?php
session_start();
include '../db/functions.php';

if (!isset($_SESSION['user_id']) || !is_restaurant_owner($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$restaurant_id = get_restaurant_id_by_owner($_SESSION['user_id']);

$name = $_POST['name'] ?? '';
$opening_hours = $_POST['opening_hours'] ?? '';
$description = $_POST['description'] ?? '';

if (!empty($name) && !empty($opening_hours)) {
    global $conn;
    $stmt = $conn->prepare("UPDATE restaurants SET name = ?, opening_hours = ?, description = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $opening_hours, $description, $restaurant_id);

if ($stmt->execute()) {
    header("Location: ../restaurant_dashboard.php?success=1");
    exit;
    } else {
        echo "Hata: " . $stmt->error;
    }
} else {
    echo "Lütfen gerekli alanları doldurun.";
}
?>
