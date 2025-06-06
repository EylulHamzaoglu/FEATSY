<?php
include(__DIR__ . "/config_db.php");

function sign_up($username, $password, $email) {
    global $conn;

    if (empty($username) || empty($password) || empty($email)) {
        return ['success' => false, 'message' => 'Tüm alanları doldurmalısınız.'];
    }

    // Aynı mail var mı?
    $check = $conn->prepare("SELECT id FROM users WHERE mail = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        return ['success' => false, 'message' => 'Bu e-posta adresi zaten kayıtlı.'];
    }

    // Veri ekle
    $stmt = $conn->prepare("INSERT INTO users (username, password, mail) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $email);

    if ($stmt->execute()) {
        return ['success' => true, 'user_id' => $conn->insert_id];
    } else {
        return ['success' => false, 'message' => 'Kayıt sırasında hata oluştu: ' . $stmt->error];
    }
}






// ✅ login($username, $password)
// Verilen kullanıcı adı ve şifre ile giriş yapmayı dener. Şifreyi hash'lenmiş veriyle karşılaştırır.
// Başarılıysa kullanıcı verilerini döner, değilse false döner.

function sign_in($email, $password) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM users WHERE mail = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $user_id = $user['id'];

        // Admin mi?
        $admin_check = $conn->prepare("SELECT id FROM admins WHERE user_id = ?");
        $admin_check->bind_param("i", $user_id);
        $admin_check->execute();
        $admin_result = $admin_check->get_result();
        if ($admin_result && $admin_result->num_rows === 1) {
            return ['success' => true, 'user_id' => $user_id, 'role' => 'admin'];
        }

        // Restaurant sahibi mi?
        $owner_check = $conn->prepare("SELECT id FROM restaurant_owners WHERE user_id = ?");
        $owner_check->bind_param("i", $user_id);
        $owner_check->execute();
        $owner_result = $owner_check->get_result();
        if ($owner_result && $owner_result->num_rows === 1) {
            return ['success' => true, 'user_id' => $user_id, 'role' => 'owner'];
        }

        return ['success' => true, 'user_id' => $user_id, 'role' => 'user'];
    }

    return ['success' => false, 'message' => 'E-posta veya şifre hatalı.'];
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

function get_popular_restaurants($limit = 20) {
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


function approve_comment($user_id, $comment_id) {
    global $conn;
    $stmt = $conn->prepare("UPDATE comments SET is_approved = 1 WHERE id = ?");
    $stmt->bind_param("i", $comment_id);
    $stmt->execute();

    if ($stmt->execute()) {
        return "Yorum onaylandı.";
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
        WHERE c.user_id = ? AND c.is_approved = 1
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
        WHERE c.restaurant_id = ? AND C.is_approved = 1
        ORDER BY c.created_at DESC
    ";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $restaurant_id);
    $stmt->execute();
    return $stmt->get_result();
}



function get_user_profile($user_id) {
    global $conn;

    $stmt = $conn->prepare("SELECT username, name, surname, phone, mail, birth_date FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc();
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
function get_restaurant_menu_items($restaurant_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM restaurant_menu_items WHERE restaurant_id = ?");
    $stmt->bind_param("i", $restaurant_id);
    $stmt->execute();
    return $stmt->get_result();
}

function get_restaurant_images($restaurant_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT image_url FROM restaurant_images WHERE restaurant_id = ?");
    $stmt->bind_param("i", $restaurant_id);
    $stmt->execute();
    return $stmt->get_result();
}

function get_grouped_menu_items($restaurant_id) {
    global $conn;
    $stmt = $conn->prepare("
        SELECT section_name, name, price, image_url 
        FROM restaurant_menu_items 
        WHERE restaurant_id = ?
        ORDER BY section_name ASC, sort_order ASC
    ");
    $stmt->bind_param("i", $restaurant_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $grouped = [];

    while ($row = $result->fetch_assoc()) {
        $grouped[$row['section_name']][] = $row;
    }

    return $grouped;
}

function get_restaurants_by_category_name($category_name) {
    global $conn;

    $stmt = $conn->prepare("
        SELECT r.*, c.name AS category_name, ROUND(AVG(a.rating), 1) AS average_rating, COUNT(a.rating) AS total_ratings
        FROM restaurants r
        JOIN restaurant_categories rc ON r.id = rc.restaurant_id
        JOIN categories c ON rc.category_id = c.id
        LEFT JOIN actions a ON a.restaurant_id = r.id
        WHERE c.name = ?
        GROUP BY r.id
    ");
    $stmt->bind_param("s", $category_name);
    $stmt->execute();

    $result = $stmt->get_result();
    $restaurants = [];
    while ($row = $result->fetch_assoc()) {
        $restaurants[] = $row;
    }

    return $restaurants;
     }

     function get_menu_grouped_by_section($restaurant_id) {
    global $conn;

    $stmt = $conn->prepare("
        SELECT section_name, name, price, sort_order
        FROM restaurant_menu_items
        WHERE restaurant_id = ?
        ORDER BY section_name ASC, sort_order ASC
    ");
    $stmt->bind_param("i", $restaurant_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $menu = [];

    while ($row = $result->fetch_assoc()) {
        $menu[$row['section_name']][] = $row;
    }

    return $menu;
}

function get_main_image_url($restaurant_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT image_url FROM restaurant_images WHERE restaurant_id = ? AND is_main = 1 LIMIT 1");
    $stmt->bind_param("i", $restaurant_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        return "img/restaurants/" . $row['image_url'];
    } else {
        return "img/restaurants/default.jpg"; // yedek resim
    }
}


function get_main_image_by_restaurant_id($restaurant_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT image_url FROM restaurant_images WHERE restaurant_id = ? AND is_main = 1 LIMIT 1");
    $stmt->bind_param("i", $restaurant_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        return 'img/restaurants/' . $row['image_url'];
    } else {
        return 'img/placeholder.jpg'; // Ana resim yoksa varsayılan göster
    }
}

function is_restaurant_owner($user_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT id FROM restaurant_owners WHERE user_id = ? LIMIT 1");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    return $stmt->get_result()->num_rows > 0;
}

function get_restaurant_id_by_owner($user_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT restaurant_id FROM restaurant_owners WHERE user_id = ? LIMIT 1");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc()['restaurant_id'] ?? null;
}


function toggle_favorite($user_id, $restaurant_id) {
    global $conn;

    $stmt = $conn->prepare("SELECT is_favorited FROM actions WHERE user_id = ? AND restaurant_id = ?");
    $stmt->bind_param("ii", $user_id, $restaurant_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $new_status = $row['is_favorited'] == 1 ? 0 : 1;
        $update = $conn->prepare("UPDATE actions SET is_favorited = ?, updated_at = NOW() WHERE user_id = ? AND restaurant_id = ?");
        $update->bind_param("iii", $new_status, $user_id, $restaurant_id);
        $update->execute();
        return $new_status;
    } else {
        $insert = $conn->prepare("INSERT INTO actions (user_id, restaurant_id, is_favorited) VALUES (?, ?, 1)");
        $insert->bind_param("ii", $user_id, $restaurant_id);
        $insert->execute();
        return 1;
    }
}


function get_user_favorite_restaurants($user_id) {
    global $conn;

    $sql = "
        SELECT r.*, 
               c.name AS category_name,
               (SELECT AVG(a.rating) FROM actions a WHERE a.restaurant_id = r.id) AS average_rating,
               (SELECT COUNT(*) FROM actions a2 WHERE a2.restaurant_id = r.id AND a2.rating IS NOT NULL) AS total_ratings
        FROM restaurants r
        INNER JOIN actions act ON act.restaurant_id = r.id
        LEFT JOIN restaurant_categories rc ON r.id = rc.restaurant_id
        LEFT JOIN categories c ON rc.category_id = c.id
        WHERE act.user_id = ? AND act.is_favorited = 1
        GROUP BY r.id
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $restaurants = [];
    while ($row = $result->fetch_assoc()) {
        $restaurants[] = $row;
    }

    return $restaurants;
}
function is_favorite($user_id, $restaurant_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT is_favorited FROM actions WHERE user_id = ? AND restaurant_id = ?");
    $stmt->bind_param("ii", $user_id, $restaurant_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        return $row['is_favorited'] == 1;
    }
    return false;
}
function is_restaurant_favorited($user_id, $restaurant_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT is_favorited FROM actions WHERE user_id = ? AND restaurant_id = ?");
    $stmt->bind_param("ii", $user_id, $restaurant_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        return $row['is_favorited'] == 1;
    }
    return false;
}



function is_admin($user_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT id FROM admins WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result && $result->num_rows > 0;
}

function get_all_users() {
    global $conn;
    $result = $conn->query("SELECT * FROM users ORDER BY id DESC");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function get_all_restaurants_with_owners() {
    global $conn;
    $sql = "SELECT r.*, u.mail AS owner_email , CONCAT(pr.label, '(', pr.min_price, '-', pr.max_price, ')') as price_description
            FROM restaurants r
            LEFT JOIN restaurant_owners o ON r.id = o.restaurant_id
            LEFT JOIN users u ON o.user_id = u.id
            LEFT JOIN price_ranges pr ON r.price_range_id = pr.id
            ORDER BY r.id DESC";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function get_all_comments_with_user_and_restaurant() {
    global $conn;
    $sql = "
        SELECT 
            comments.id,
            comments.description,
            comments.created_at,
            users.mail AS user_email,
            restaurants.name AS restaurant_name,
            actions.rating
        FROM comments
        JOIN users ON comments.user_id = users.id
        JOIN restaurants ON comments.restaurant_id = restaurants.id
        LEFT JOIN actions 
            ON comments.user_id = actions.user_id 
            AND comments.restaurant_id = actions.restaurant_id
        WHERE
            comments.is_approved = 0
        ORDER BY comments.created_at DESC
    ";

    return $conn->query($sql);
}


function get_all_restaurant_images_with_names() {
    global $conn;
    $sql = "SELECT i.*, r.name AS restaurant_name
            FROM restaurant_images i
            JOIN restaurants r ON i.restaurant_id = r.id
            ORDER BY i.created_at DESC";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function get_all_restaurant_owners() {
    global $conn;
    $sql = "SELECT ro.id, u.mail AS user_email, r.name AS restaurant_name
            FROM restaurant_owners ro
            JOIN users u ON ro.user_id = u.id
            JOIN restaurants r ON ro.restaurant_id = r.id
            ORDER BY ro.id DESC";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}
