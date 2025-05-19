<?php
session_start();
include 'db/functions.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Formdan gelen alan isimleri: first_name, last_name
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$phone = $_POST['phone'] ?? '';
$birth_date = $_POST['birth_date'] ?? '';

global $conn;

// Doğum tarihi (users tablosu)
$stmt1 = $conn->prepare("UPDATE users SET birth_date = ? WHERE id = ?");
$stmt1->bind_param("si", $birth_date, $user_id);
if (!$stmt1->execute()) {
    echo "HATA 1 (users): " . $stmt1->error;
}

// Ad, Soyad, Telefon (user_details tablosu)
$stmt2 = $conn->prepare("UPDATE user_details SET name = ?, surname = ?, phone = ? WHERE user_id = ?");
$stmt2->bind_param("sssi", $first_name, $last_name, $phone, $user_id);
if (!$stmt2->execute()) {
    echo "HATA 2 (user_details): " . $stmt2->error;
}

header("Location: profile.php?success=1");
exit;
?>
