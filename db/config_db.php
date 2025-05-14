<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "featsydb";

// Bağlantıyı oluştur
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}
?>
