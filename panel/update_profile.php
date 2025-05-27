<?php
session_start();
include 'db/functions.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Formdan gelen alanlar
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$phone = $_POST['phone'] ?? '';
$birth_date = $_POST['birth_date'] ?? '';
$username = $_POST['username'] ?? ''; // varsa formdan alınabilir

global $conn;

// users tablosundaki tüm alanları tek seferde güncelle
$stmt = $conn->prepare("UPDATE users SET username = ?, name = ?, surname = ?, phone = ?, birth_date = ?, updated_at = NOW() WHERE id = ?");
$stmt->bind_param("sssssi", $username, $first_name, $last_name, $phone, $birth_date, $user_id);

if ($stmt->execute()) {
    header("Location: profile.php?success=1");
    exit;
} else {
    header("Location: profile.php?error=1");
    exit;
}
?>
