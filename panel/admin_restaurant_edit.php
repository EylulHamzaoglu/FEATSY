<?php
include 'db/functions.php';

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    die("Geçersiz ID");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $opening_hours = $_POST['opening_hours'];

    $stmt = $conn->prepare("UPDATE restaurants SET name = ?, description = ?, opening_hours = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $description, $opening_hours, $id);
    $stmt->execute();

    header("Location: admin_panel.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM restaurants WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$restaurant = $stmt->get_result()->fetch_assoc();
?>

<form method="POST">
    <input type="text" name="name" value="<?= htmlspecialchars($restaurant['name']) ?>" required><br>
    <textarea name="description"><?= htmlspecialchars($restaurant['description']) ?></textarea><br>
    <input type="text" name="opening_hours" value="<?= htmlspecialchars($restaurant['opening_hours']) ?>"><br>
    <button type="submit">Kaydet</button>
</form>
