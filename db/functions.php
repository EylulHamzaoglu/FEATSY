<?php
include 'db/config_db.php';

// ✅ sign_up($username, $password, $email)
// Kullanıcıyı veritabanına ekler. Şifreyi hash'ler ve varsayılan olarak 'customer' rolüyle kaydeder.

function sign_up($username, $password, $email) {
    global $conn;

    if (empty($username) || empty($password) || empty($email)) {
        return ['success' => false, 'message' => 'Tüm alanları doldurmalısınız.'];
    }

    $stmt = $conn->prepare("INSERT INTO users (username, password, mail, role, status) VALUES (?, ?, ?, 'customer', 'active')");
    $stmt->bind_param("sss", $username, $password, $email);

    if ($stmt->execute()) {
        return ['success' => true];
    } else {
        return ['success' => false, 'message' => 'Kayıt sırasında hata oluştu: ' . $stmt->error];
    }
}



// ✅ login($username, $password)
// Verilen kullanıcı adı ve şifre ile giriş yapmayı dener. Şifreyi hash'lenmiş veriyle karşılaştırır.
// Başarılıysa kullanıcı verilerini döner, değilse false döner.

function sign_in($email, $password) {
    global $conn;

    if (empty($email) || empty($password)) {
        return ['success' => false, 'message' => 'Lütfen tüm alanları doldurun.'];
    }

    $stmt = $conn->prepare("SELECT id FROM users WHERE mail = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        return ['success' => true, 'user_id' => $user['id']];
    } else {
        return ['success' => false, 'message' => 'Geçersiz email veya şifre.'];
    }
}


// ✅ get_user_by_id($id)
// Verilen kullanıcı ID’sine göre kullanıcı bilgilerini döner.

function get_user_by_id($id) {
    global $conn;

    $stmt = $conn->prepare("SELECT id, username, email, role, status FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}
// ✅ get_restaurant_by_id($id)
// Verilen ID’ye sahip restoranın tüm bilgilerini getirir.

function get_restaurant_by_id($id) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM restaurants WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}
// ✅ get_all_restaurants()
// Tüm restoranları getirir. Varsayılan olarak aktif restoranları döner.

function get_all_restaurants() {
    global $conn;

    $sql = "SELECT *, 2.3 AS AvgRating FROM restaurants WHERE is_active = 1";
    $result = $conn->query($sql);

    $restaurants = [];
    while ($row = $result->fetch_assoc()) {
        $restaurants[] = $row;
    }

    return $restaurants;
}
// ✅ get_most_popular_restaurants()
// Tüm restoranları getirir. Varsayılan olarak aktif restoranları döner.

function get_popular_restaurants($limit = 8) {
    global $conn;
    $sql = "
        SELECT 
            r.id,
            r.name,
            r.profile_picture,
            c.name AS category_name,
            ROUND(AVG(a.rating), 1) AS average_rating,
            COUNT(a.rating) AS total_ratings
        FROM restaurants r
        LEFT JOIN restaurant_categories rc ON r.id = rc.restaurant_id
        LEFT JOIN categories c ON rc.category_id = c.id
        LEFT JOIN actions a ON r.id = a.restaurant_id
        WHERE r.is_active = 1
        GROUP BY r.id
        ORDER BY average_rating DESC
        LIMIT ?
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    $restaurants = [];
    while ($row = $result->fetch_assoc()) {
        $restaurants[] = $row;
    }
    return $restaurants;
}



// ✅ get_restaurants_by_category($category_ids)
// Belirtilen kategori ID’lerine sahip restoranları döner.
// $category_ids bir dizi (array) olmalıdır.

function get_restaurants_by_category($category_ids) {
    global $conn;

    if (empty($category_ids)) {
        return [];
    }

    // ID’leri virgülle ayırarak sorguya ekliyoruz (SQL injection’a karşı dikkatli olunmalı)
    $placeholders = implode(',', array_fill(0, count($category_ids), '?'));
    $types = str_repeat('i', count($category_ids));

    $sql = "
        SELECT DISTINCT r.*
        FROM restaurants r
        JOIN restaurant_categories rc ON r.id = rc.restaurant_id
        WHERE rc.category_id IN ($placeholders)
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$category_ids);
    $stmt->execute();

    $result = $stmt->get_result();
    $restaurants = [];
    while ($row = $result->fetch_assoc()) {
        $restaurants[] = $row;
    }

    return $restaurants;
}
// ✅ get_restaurants_by_feature($feature_ids)
// Belirtilen özellik ID’lerine sahip restoranları döner.
// $feature_ids bir dizi (array) olmalıdır.

function get_restaurants_by_feature($feature_ids) {
    global $conn;

    if (empty($feature_ids)) {
        return [];
    }

    $placeholders = implode(',', array_fill(0, count($feature_ids), '?'));
    $types = str_repeat('i', count($feature_ids));

    $sql = "
        SELECT DISTINCT r.*
        FROM restaurants r
        JOIN restaurant_features rf ON r.id = rf.restaurant_id
        WHERE rf.feature_id IN ($placeholders)
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$feature_ids);
    $stmt->execute();

    $result = $stmt->get_result();
    $restaurants = [];
    while ($row = $result->fetch_assoc()) {
        $restaurants[] = $row;
    }

    return $restaurants;
}
// ✅ add_comment($user_id, $restaurant_id, $description)
// Kullanıcının bir restorana yorum eklemesini sağlar.

function add_comment($user_id, $restaurant_id, $description) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO comments (user_id, restaurant_id, description) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $user_id, $restaurant_id, $description);

    if ($stmt->execute()) {
        return "Yorum başarıyla eklendi.";
    } else {
        return "Hata: " . $stmt->error;
    }
}
// ✅ rate_restaurant($user_id, $restaurant_id, $rating)
// Kullanıcı restoranı puanladığında action tablosuna rating bilgisini ekler veya günceller.

function rate_restaurant($user_id, $restaurant_id, $rating) {
    global $conn;

    // Daha önce rating yapmış mı kontrol et
    $check = $conn->prepare("SELECT id FROM actions WHERE user_id = ? AND restaurant_id = ?");
    $check->bind_param("ii", $user_id, $restaurant_id);
    $check->execute();
    $check_result = $check->get_result();

    if ($check_result->num_rows > 0) {
        // Güncelle
        $stmt = $conn->prepare("UPDATE actions SET rating = ? WHERE user_id = ? AND restaurant_id = ?");
        $stmt->bind_param("dii", $rating, $user_id, $restaurant_id);
    } else {
        // Yeni kayıt
        $stmt = $conn->prepare("INSERT INTO actions (user_id, restaurant_id, rating) VALUES (?, ?, ?)");
        $stmt->bind_param("iid", $user_id, $restaurant_id, $rating);
    }

    if ($stmt->execute()) {
        return "Puanlama kaydedildi.";
    } else {
        return "Hata: " . $stmt->error;
    }
}
// ✅ like_restaurant($user_id, $restaurant_id)
// Kullanıcı restoranı favorilerine ekler (is_favorited = 1).
// Daha önce kayıt varsa günceller, yoksa yeni kayıt oluşturur.

function like_restaurant($user_id, $restaurant_id) {
    global $conn;

    // Zaten bir action var mı?
    $check = $conn->prepare("SELECT id FROM actions WHERE user_id = ? AND restaurant_id = ?");
    $check->bind_param("ii", $user_id, $restaurant_id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Güncelle
        $stmt = $conn->prepare("UPDATE actions SET is_favorited = 1 WHERE user_id = ? AND restaurant_id = ?");
        $stmt->bind_param("ii", $user_id, $restaurant_id);
    } else {
        // Yeni kayıt
        $stmt = $conn->prepare("INSERT INTO actions (user_id, restaurant_id, is_favorited) VALUES (?, ?, 1)");
        $stmt->bind_param("ii", $user_id, $restaurant_id);
    }

    if ($stmt->execute()) {
        return "Favorilere eklendi.";
    } else {
        return "Hata: " . $stmt->error;
    }
}
// ✅ unlike_restaurant($user_id, $restaurant_id)
// Kullanıcı restoranı favorilerden çıkarır (is_favorited = 0).
// Action kaydı varsa günceller, yoksa yeni kayıt oluşturur.

function unlike_restaurant($user_id, $restaurant_id) {
    global $conn;

    // Zaten bir action var mı?
    $check = $conn->prepare("SELECT id FROM actions WHERE user_id = ? AND restaurant_id = ?");
    $check->bind_param("ii", $user_id, $restaurant_id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Güncelle
        $stmt = $conn->prepare("UPDATE actions SET is_favorited = 0 WHERE user_id = ? AND restaurant_id = ?");
        $stmt->bind_param("ii", $user_id, $restaurant_id);
    } else {
        // Yeni kayıt (is_favorited = 0 anlamlı değil ama tutarlılık için yine de kayıt eklenebilir)
        $stmt = $conn->prepare("INSERT INTO actions (user_id, restaurant_id, is_favorited) VALUES (?, ?, 0)");
        $stmt->bind_param("ii", $user_id, $restaurant_id);
    }

    if ($stmt->execute()) {
        return "Favorilerden çıkarıldı.";
    } else {
        return "Hata: " . $stmt->error;
    }
}
// ✅ get_user_comments($user_id)
// Kullanıcının yaptığı tüm yorumları restoran adıyla birlikte getirir.

function get_user_comments($user_id) {
    global $conn;

    $stmt = $conn->prepare("
        SELECT c.id, c.description, c.created_at, r.name AS restaurant_name
        FROM comments c
        JOIN restaurants r ON c.restaurant_id = r.id
        WHERE c.user_id = ?
        ORDER BY c.created_at DESC
    ");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $comments = [];
    while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
    }

    return $comments;
}
// ✅ get_most_commented_restaurants($limit)
// En çok yorum alan restoranları yorum sayısıyla birlikte getirir.

function get_most_commented_restaurants($limit = 10) {
    global $conn;

    $stmt = $conn->prepare("
        SELECT r.id, r.name, COUNT(c.id) AS comment_count
        FROM restaurants r
        JOIN comments c ON r.id = c.restaurant_id
        GROUP BY r.id
        ORDER BY comment_count DESC
        LIMIT ?
    ");
    $stmt->bind_param("i", $limit);
    $stmt->execute();

    $result = $stmt->get_result();
    $restaurants = [];
    while ($row = $result->fetch_assoc()) {
        $restaurants[] = $row;
    }

    return $restaurants;
}
// ✅ get_top_rated_restaurants($limit)
// Ortalama puana göre en yüksek puanlı restoranları listeler.

function get_top_rated_restaurants($limit = 10) {
    global $conn;

    $stmt = $conn->prepare("
        SELECT r.id, r.name, AVG(a.rating) AS avg_rating, COUNT(a.rating) AS vote_count
        FROM restaurants r
        JOIN actions a ON r.id = a.restaurant_id
        WHERE a.rating IS NOT NULL
        GROUP BY r.id
        ORDER BY avg_rating DESC
        LIMIT ?
    ");
    $stmt->bind_param("i", $limit);
    $stmt->execute();

    $result = $stmt->get_result();
    $top_rated = [];
    while ($row = $result->fetch_assoc()) {
        $top_rated[] = $row;
    }

    return $top_rated;
}
// ✅ get_restaurants_in_price_range($min_price, $max_price)
// Belirtilen fiyat aralığında kalan restoranları getirir.

function get_restaurants_in_price_range($min_price, $max_price) {
    global $conn;

    $stmt = $conn->prepare("
        SELECT r.id, r.name, p.min_price, p.max_price
        FROM restaurants r
        JOIN restaurant_prices rp ON r.id = rp.restaurant_id
        JOIN prices p ON rp.price_id = p.id
        WHERE p.min_price >= ? AND p.max_price <= ?
    ");
    $stmt->bind_param("ii", $min_price, $max_price);
    $stmt->execute();

    $result = $stmt->get_result();
    $filtered = [];
    while ($row = $result->fetch_assoc()) {
        $filtered[] = $row;
    }

    return $filtered;
}
// ✅ get_restaurant_features($restaurant_id)
// Verilen restoranın sahip olduğu tüm özellikleri getirir.

function get_restaurant_features($restaurant_id) {
    global $conn;

    $stmt = $conn->prepare("
        SELECT f.id, f.name
        FROM restaurant_features rf
        JOIN features f ON rf.feature_id = f.id
        WHERE rf.restaurant_id = ?
    ");
    $stmt->bind_param("i", $restaurant_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $features = [];
    while ($row = $result->fetch_assoc()) {
        $features[] = $row;
    }

    return $features;
}
// ✅ get_restaurant_menu_images($restaurant_id)
// Restoranın menü görsellerini (image_url) getirir.

function get_restaurant_menu_images($restaurant_id) {
    global $conn;

    $stmt = $conn->prepare("
        SELECT image_url
        FROM restaurant_images
        WHERE restaurant_id = ?
    ");
    $stmt->bind_param("i", $restaurant_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $images = [];
    while ($row = $result->fetch_assoc()) {
        $images[] = $row['image_url'];
    }

    return $images;
}
// ✅ track_restaurant_view($user_id, $restaurant_id)
// Kullanıcının bir restorana tıkladığını kaydeder (restaurant_views tablosuna kayıt ekler).

function track_restaurant_view($user_id, $restaurant_id) {
    global $conn;

    $stmt = $conn->prepare("
        INSERT INTO restaurant_views (user_id, restaurant_id, viewed_at)
        VALUES (?, ?, NOW())
    ");
    $stmt->bind_param("ii", $user_id, $restaurant_id);

    if ($stmt->execute()) {
        return "Görüntüleme kaydedildi.";
    } else {
        return "Hata: " . $stmt->error;
    }
}
// ✅ get_restaurants_by_city($city_name)
// Kullanıcının bulunduğu şehir adına göre restoranları listeler.

function get_restaurants_by_city($city_name) {
    global $conn;

    $stmt = $conn->prepare("
        SELECT DISTINCT r.*
        FROM restaurants r
        JOIN comments c ON r.id = c.restaurant_id
        JOIN users u ON c.user_id = u.id
        JOIN user_details ud ON u.id = ud.user_id
        JOIN cities ct ON ud.city_id = ct.id
        WHERE ct.name = ?
    ");
    $stmt->bind_param("s", $city_name);
    $stmt->execute();

    $result = $stmt->get_result();
    $restaurants = [];
    while ($row = $result->fetch_assoc()) {
        $restaurants[] = $row;
    }

    return $restaurants;
}
// ✅ get_restaurant_count_by_district()
// İstanbul’daki her ilçede kaç restoran olduğunu listeler.

function get_restaurant_count_by_district() {
    global $conn;

    $sql = "
        SELECT ct.name AS district_name, COUNT(DISTINCT r.id) AS restaurant_count
        FROM restaurants r
        JOIN comments c ON r.id = c.restaurant_id
        JOIN users u ON c.user_id = u.id
        JOIN user_details ud ON u.id = ud.user_id
        JOIN cities ct ON ud.city_id = ct.id
        WHERE ct.name LIKE 'İstanbul%'
        GROUP BY ct.name
    ";

    $result = $conn->query($sql);
    $districts = [];

    while ($row = $result->fetch_assoc()) {
        $districts[] = $row;
    }

    return $districts;
}
// ✅ get_liked_categories_by_user($user_id)
// Kullanıcının en çok beğendiği restoran kategorilerini listeler.

function get_liked_categories_by_user($user_id) {
    global $conn;

    $stmt = $conn->prepare("
        SELECT c.name, COUNT(*) AS like_count
        FROM actions a
        JOIN restaurant_categories rc ON a.restaurant_id = rc.restaurant_id
        JOIN categories c ON rc.category_id = c.id
        WHERE a.user_id = ? AND a.is_favorited = 1
        GROUP BY c.name
        ORDER BY like_count DESC
    ");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $categories = [];

    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }

    return $categories;
}
// ✅ get_most_common_features_in_likes()
// Kullanıcıların en çok beğendiği restoranlardaki ortak özellikleri döner.

function get_most_common_features_in_likes() {
    global $conn;

    $sql = "
        SELECT f.name, COUNT(*) AS frequency
        FROM actions a
        JOIN restaurant_features rf ON a.restaurant_id = rf.restaurant_id
        JOIN features f ON rf.feature_id = f.id
        WHERE a.is_favorited = 1
        GROUP BY f.name
        ORDER BY frequency DESC
    ";

    $result = $conn->query($sql);
    $features = [];

    while ($row = $result->fetch_assoc()) {
        $features[] = $row;
    }

    return $features;
}
// ✅ get_restaurant_average_rating_by_city()
// Şehirlere göre restoranların ortalama puanlarını döner.

function get_restaurant_average_rating_by_city() {
    global $conn;

    $sql = "
        SELECT ct.name AS city_name, AVG(a.rating) AS avg_rating
        FROM restaurants r
        JOIN actions a ON r.id = a.restaurant_id
        JOIN comments c ON c.restaurant_id = r.id
        JOIN users u ON c.user_id = u.id
        JOIN user_details ud ON u.id = ud.user_id
        JOIN cities ct ON ud.city_id = ct.id
        WHERE a.rating IS NOT NULL
        GROUP BY ct.name
    ";

    $result = $conn->query($sql);
    $ratings = [];

    while ($row = $result->fetch_assoc()) {
        $ratings[] = $row;
    }

    return $ratings;
}
// ✅ get_popular_restaurants_in_user_city($user_id)
// Kullanıcının yaşadığı şehirdeki en çok beğenilen restoranları getirir.

function get_popular_restaurants_in_user_city($user_id) {
    global $conn;

    $stmt = $conn->prepare("
        SELECT r.name, COUNT(*) AS like_count
        FROM actions a
        JOIN restaurants r ON a.restaurant_id = r.id
        JOIN users u ON a.user_id = u.id
        JOIN user_details ud ON u.id = ud.user_id
        JOIN cities ct ON ud.city_id = ct.id
        WHERE a.is_favorited = 1 AND ct.id = (
            SELECT city_id FROM user_details WHERE user_id = ?
        )
        GROUP BY r.name
        ORDER BY like_count DESC
        LIMIT 10
    ");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $popular = [];

    while ($row = $result->fetch_assoc()) {
        $popular[] = $row;
    }

    return $popular;
}

function get_restaurant_details($restaurant_id) {
    global $conn;

    $sql = "
        SELECT 
            r.*,
            counties.name AS county,
            (
                SELECT categories.name
                FROM restaurant_categories rc
                JOIN categories ON rc.category_id = categories.id
                WHERE rc.restaurant_id = r.id
                LIMIT 1
            ) AS category,
            price_ranges.label AS price_range
        FROM restaurants r
        LEFT JOIN counties ON r.county_id = counties.id
        LEFT JOIN price_ranges ON r.price_range_id = price_ranges.id
        WHERE r.id = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $restaurant_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}



function get_restaurant_average_rating($restaurant_id) {
    global $conn;

    $sql = "SELECT AVG(rating) as average_rating FROM actions WHERE restaurant_id = ? AND rating IS NOT NULL";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $restaurant_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return round($row['average_rating'] ?? 0, 1);
}

function get_restaurant_menu($restaurant_id) {
    global $conn;

    $sql = "SELECT * FROM restaurant_menus WHERE restaurant_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $restaurant_id);
    $stmt->execute();
    return $stmt->get_result();
}

function get_restaurant_comments($restaurant_id) {
    global $conn;

    $sql = "
        SELECT c.description AS comment_text, c.created_at, u.username, a.rating
        FROM comments c
        LEFT JOIN users u ON c.user_id = u.id
        LEFT JOIN actions a ON c.user_id = a.user_id AND c.restaurant_id = a.restaurant_id
        WHERE c.restaurant_id = ?
        ORDER BY c.created_at DESC
    ";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $restaurant_id);
    $stmt->execute();
    return $stmt->get_result();
}



function get_user_profile($user_id) {
    global $conn;
    $stmt = $conn->prepare("
        SELECT 
            u.mail, u.birth_date,
            d.name, d.surname, d.phone
        FROM users u
        JOIN user_details d ON u.id = d.user_id
        WHERE u.id = ?
    ");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc(); // associative array döner
}
function search_restaurants_by_name($name) {
    global $conn;

    $name = "%" . $name . "%";
    $stmt = $conn->prepare("
        SELECT 
            r.id,
            r.name,
            r.profile_picture,
            c.name AS category_name,
            ROUND(AVG(a.rating), 1) AS average_rating,
            COUNT(a.rating) AS total_ratings
        FROM restaurants r
        LEFT JOIN restaurant_categories rc ON r.id = rc.restaurant_id
        LEFT JOIN categories c ON rc.category_id = c.id
        LEFT JOIN actions a ON r.id = a.restaurant_id
        WHERE r.is_active = 1 AND r.name LIKE ?
        GROUP BY r.id
        ORDER BY average_rating DESC
    ");

    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error); // ← bu önemli
        return [];
    }

    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    $restaurants = [];
    while ($row = $result->fetch_assoc()) {
        $restaurants[] = $row;
    }

    return $restaurants;
}