<?php
session_start();
include 'db/functions.php';
header('Content-Type: application/json');

$user_id = $_SESSION['user_id'] ?? null;
$restaurant_id = $_POST['restaurant_id'] ?? null;

if (!$user_id || !$restaurant_id) {
    echo json_encode(['success' => false, 'message' => 'Geçersiz istek.']);
    exit;
}

$result = toggle_favorite($user_id, $restaurant_id);
echo json_encode(['success' => true, 'is_favorited' => $result]);
