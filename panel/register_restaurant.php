<?php
include '../db/functions.php';

$success = "";
$error = "";

// Fiyat ve ilçe seçeneklerini çek
$price_ranges = $conn->query("SELECT id, label FROM price_ranges");
$counties = $conn->query("SELECT id, name FROM counties");
$categories = $conn->query("SELECT id, name FROM categories");
$features = $conn->query("SELECT id, name FROM features");


// Form gönderildiyse işle
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $phone = $_POST['phone'];
    $website = $_POST['website'];
    $instagram_url = $_POST['instagram_url'];
    $opening_from = $_POST['opening_from'];
    $opening_to = $_POST['opening_to'];
    $opening_hours = $opening_from . " - " . $opening_to;
    $price_range_id = $_POST['price_range_id'];
    $county_id = $_POST['county_id'];
    $user_id = 1; // Login sistemi bağlanınca dinamik yapılabilir

    // Restoranı kaydet
    $stmt = $conn->prepare("INSERT INTO restaurants (user_id, name, description, phone, website, instagram_url, opening_hours, price_range_id, county_id, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1)");
    $stmt->bind_param("issssssii", $user_id, $name, $description, $phone, $website, $instagram_url, $opening_hours, $price_range_id, $county_id);

    if ($stmt->execute()) {
        $restaurant_id = $stmt->insert_id;

        // Görselleri yükle
        $total_files = count($_FILES['images']['name']);
        for ($i = 0; $i < $total_files; $i++) {
            $file_tmp = $_FILES['images']['tmp_name'][$i];
            $file_name = basename($_FILES['images']['name'][$i]);
            $target_dir = "img/restaurants/";
            $unique_name = time() . "_" . $file_name;
            $target_file = $target_dir . $unique_name;

            if (move_uploaded_file($file_tmp, $target_file)) {
                $is_main = ($i == 0) ? 1 : 0;
                $img_stmt = $conn->prepare("INSERT INTO restaurant_images (restaurant_id, image_url, is_main) VALUES (?, ?, ?)");
                $img_stmt->bind_param("isi", $restaurant_id, $target_file, $is_main);
                $img_stmt->execute();
            }
        }

        $success = "Restoran başarıyla kaydedildi!";
    } else {
        $error = "Hata: " . $stmt->error;
    }
}
if (isset($_POST['category_id'])) {
    $category_id = intval($_POST['category_id']);
    $stmt = $conn->prepare("INSERT INTO restaurant_categories (restaurant_id, category_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $restaurant_id, $category_id);
    $stmt->execute();
}
if (!empty($_POST['feature_ids'])) {
    foreach ($_POST['feature_ids'] as $feature_id) {
        $feature_id = intval($feature_id);
        $stmt = $conn->prepare("INSERT INTO restaurant_features (restaurant_id, feature_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $restaurant_id, $feature_id);
        $stmt->execute();
    }
}


?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Restoran Kaydı</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<a href="../admin_panel.php" class="btn btn-outline-secondary">← Admin Panele Dön</a>
<body class="bg-light py-5">
<div class="container">
    <div class="card p-4 shadow">
        <h2 class="mb-4">Restoran Kaydı</h2>

        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php elseif ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="register_restaurant.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Restoran Adı</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Açıklama</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Telefon</label>
                <input type="text" name="phone" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Web Sitesi</label>
                <input type="text" name="website" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Instagram Linki</label>
                <input type="url" name="instagram_url" class="form-control">
            </div>

            <div class="row">
                
                <div class="mb-3">
                 <label class="form-label">Kategori</label>
                     <select name="category_id" class="form-select" required>
                      <?php while ($cat = $categories->fetch_assoc()): ?>
                       <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                             <?php endwhile; ?>
                             </select>
                </div>
                <div class="mb-3">
    <label class="form-label">Özellikler</label><br>
    <?php while ($f = $features->fetch_assoc()): ?>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="feature_ids[]" value="<?php echo $f['id']; ?>" id="feature_<?php echo $f['id']; ?>">
            <label class="form-check-label" for="feature_<?php echo $f['id']; ?>">
                <?php echo htmlspecialchars($f['name']); ?>
            </label>
        </div>
    <?php endwhile; ?>
</div>
<div class="col-md-6 mb-3">
                    <label class="form-label">Açılış Saati</label>
                    <select name="opening_from" class="form-select" required>
                        <?php for ($i = 0; $i <= 23; $i++): ?>
                            <option value="<?php printf('%02d:00', $i); ?>"><?php printf('%02d:00', $i); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kapanış Saati</label>
                    <select name="opening_to" class="form-select" required>
                        <?php for ($i = 0; $i <= 23; $i++): ?>
                            <option value="<?php printf('%02d:00', $i); ?>"><?php printf('%02d:00', $i); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Fiyat Aralığı</label>
                <select name="price_range_id" class="form-select" required>
                    <?php while ($row = $price_ranges->fetch_assoc()): ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['label']); ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">İlçe Seçin</label>
                <select name="county_id" class="form-select" required>
                    <?php while ($row = $counties->fetch_assoc()): ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['name']); ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Görseller</label>
                <input type="file" name="images[]" multiple accept="image/*" class="form-control" required>
                <small class="text-muted">İlk görsel ana görsel olarak ayarlanır</small>
            </div>

            <button type="submit" class="btn btn-primary">Kaydı Tamamla</button>
        </form>
    </div>
</div>
</body>
</html>
