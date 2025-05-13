
-- [1] En yüksek puan alan 5 restoranı getirir
SELECT r.name AS restaurant_name, ROUND(AVG(a.rating), 2) AS average_rating
FROM restaurants r
JOIN actions a ON a.restaurant_id = r.id
WHERE a.rating IS NOT NULL
GROUP BY r.id
ORDER BY average_rating DESC
LIMIT 5;

-- [2] En çok favorilenen restoranları listeler
SELECT r.name AS restaurant_name, COUNT(*) AS total_favorites
FROM actions a
JOIN restaurants r ON r.id = a.restaurant_id
WHERE a.is_favorited = 1
GROUP BY r.id
ORDER BY total_favorites DESC;

-- [3] En çok görüntülenen restoranları sıralar
SELECT r.name AS restaurant_name, COUNT(*) AS view_count
FROM restaurant_views rv
JOIN restaurants r ON r.id = rv.restaurant_id
GROUP BY r.id
ORDER BY view_count DESC;

-- [4] Belirli bir kullanıcının favori restoranlarını ve puanlarını listeler
SELECT r.name AS restaurant_name, a.rating
FROM actions a
JOIN restaurants r ON r.id = a.restaurant_id
JOIN users u ON u.id = a.user_id
WHERE u.username = 'ayse_user' AND a.is_favorited = 1;

-- [5] Her restoranın toplam yorum sayısını gösterir
SELECT r.name AS restaurant_name, COUNT(c.id) AS total_comments
FROM comments c
JOIN restaurants r ON r.id = c.restaurant_id
GROUP BY r.id
ORDER BY total_comments DESC;

-- [6] Belirli bir fiyat aralığındaki restoranları listele (örnek: 100-200 TL arası)
SELECT r.name AS restaurant_name, pr.label AS price_range
FROM restaurants r
JOIN restaurant_price_ranges rpr ON r.id = rpr.restaurant_id
JOIN price_ranges pr ON pr.id = rpr.price_range_id
WHERE 100 BETWEEN pr.min_price AND pr.max_price
   OR 200 BETWEEN pr.min_price AND pr.max_price;

-- [7] Her ilçedeki restoran sayısını listeler
SELECT c.name AS county_name, COUNT(r.id) AS restaurant_count
FROM counties c
JOIN user_details ud ON ud.county_id = c.id
JOIN users u ON u.id = ud.user_id
JOIN restaurants r ON r.user_id = u.id
GROUP BY c.id
ORDER BY restaurant_count DESC;

-- [8] Bugün en çok görüntülenen restoranları getirir (tarih filtreli)
SELECT r.name AS restaurant_name, COUNT(rv.id) AS today_views
FROM restaurant_views rv
JOIN restaurants r ON r.id = rv.restaurant_id
WHERE DATE(rv.viewed_at) = CURDATE()
GROUP BY r.id
ORDER BY today_views DESC;

-- [9] Her kullanıcının en çok puanladığı restoranları ve ortalama puanını getirir
SELECT u.username, r.name AS restaurant_name, ROUND(AVG(a.rating), 2) AS avg_rating
FROM actions a
JOIN users u ON u.id = a.user_id
JOIN restaurants r ON r.id = a.restaurant_id
WHERE a.rating IS NOT NULL
GROUP BY u.id, r.id
ORDER BY u.username, avg_rating DESC;

-- [10] Belirli bir ilçedeki en yüksek puanlı restoranları getirir
neden

-- [11] Kullanıcı adı ve şifreye göre giriş kontrolü
SELECT * FROM users
WHERE username = 'ayse_user' AND password = SHA2('parolan123', 256);

-- [12] Yeni kullanıcı kaydı ekleme
INSERT INTO users (username, mail, password, role, status, created_at)
VALUES ('yeni_kullanici', 'mail@example.com', SHA2('parola123', 256), 'customer', 'active', NOW());

-- [13] Kullanıcının profil bilgilerini detaylı getirme (user_details ile birlikte)
SELECT u.*, ud.name, ud.surname, ud.phone, ud.address, c.name AS city, co.name AS county
FROM users u
JOIN user_details ud ON u.id = ud.user_id
JOIN cities c ON c.id = ud.city_id
JOIN counties co ON co.id = ud.county_id
WHERE u.id = 1;

-- [14] Restoran listeleme (aktif ve doğrulanmış olanlar)
SELECT r.id, r.name, r.profile_picture, r.average_price_level
FROM restaurants r
WHERE r.is_active = 1 AND r.is_verified = 1
ORDER BY r.created_at DESC;

-- [15] Restoran detay sayfası: tüm özellikleri, kategorileri, fiyat etiketi ve menü fotoğraflarıyla birlikte
SELECT 
    r.name,
    r.description,
    r.phone,
    r.website,
    r.instagram_url,
    r.opening_hours,
    r.average_price_level,
    GROUP_CONCAT(DISTINCT f.name) AS features,
    GROUP_CONCAT(DISTINCT c.name) AS categories,
    pr.label AS price_range_label,
    GROUP_CONCAT(DISTINCT rm.image_url) AS menus
FROM restaurants r
LEFT JOIN restaurant_features rf ON rf.restaurant_id = r.id
LEFT JOIN features f ON f.id = rf.feature_id
LEFT JOIN restaurant_categories rc ON rc.restaurant_id = r.id
LEFT JOIN categories c ON c.id = rc.category_id
LEFT JOIN restaurant_price_ranges rpr ON rpr.restaurant_id = r.id
LEFT JOIN price_ranges pr ON pr.id = rpr.price_range_id
LEFT JOIN restaurant_menus rm ON rm.restaurant_id = r.id
WHERE r.id = 2
GROUP BY r.id;

-- [16] Kullanıcı restoranı favorilediyse favoriden kaldır, favorilemediyse ekle (toggle)
-- Önce kontrol:
SELECT is_favorited FROM actions WHERE user_id = 3 AND restaurant_id = 2;

-- Favori değilse INSERT:
INSERT INTO actions (user_id, restaurant_id, is_favorited, created_at)
VALUES (3, 2, 1, NOW())
ON DUPLICATE KEY UPDATE is_favorited = NOT is_favorited, updated_at = NOW();

-- [17] Kullanıcının favorilediği tüm restoranları getir
SELECT r.id, r.name
FROM actions a
JOIN restaurants r ON r.id = a.restaurant_id
WHERE a.user_id = 3 AND a.is_favorited = 1;

-- [18] Restorana yorum ekleme
INSERT INTO comments (user_id, restaurant_id, description, created_at)
VALUES (3, 2, 'Çok memnun kaldım, tavsiye ederim.', NOW());

-- [19] Kullanıcının yorum yaptığı restoranları ve yorumlarını listele
SELECT r.name AS restaurant, c.description, c.created_at
FROM comments c
JOIN restaurants r ON r.id = c.restaurant_id
WHERE c.user_id = 3
ORDER BY c.created_at DESC;

-- [20] Kullanıcının restoran puanı eklemesi ya da güncellemesi
INSERT INTO actions (user_id, restaurant_id, rating, created_at)
VALUES (3, 2, 5, NOW())
ON DUPLICATE KEY UPDATE rating = 5, updated_at = NOW();

-- [21] Kategoriye göre restoran filtreleme
SELECT r.id, r.name
FROM restaurants r
JOIN restaurant_categories rc ON rc.restaurant_id = r.id
WHERE rc.category_id = 1 AND r.is_active = 1 AND r.is_verified = 1;

-- [22] Özelliğe (feature) göre restoran filtreleme (örnek: vegan, Wi-Fi vb.)
SELECT r.id, r.name
FROM restaurants r
JOIN restaurant_features rf ON rf.restaurant_id = r.id
WHERE rf.feature_id = 2 AND r.is_active = 1 AND r.is_verified = 1;

-- [23] Fiyat aralığına göre restoran filtreleme
SELECT r.id, r.name
FROM restaurants r
JOIN restaurant_price_ranges rpr ON rpr.restaurant_id = r.id
JOIN price_ranges pr ON pr.id = rpr.price_range_id
WHERE pr.min_price >= 100 AND pr.max_price <= 250;

-- [24] İlçeye göre restoran filtreleme
SELECT r.id, r.name
FROM restaurants r
JOIN user_details ud ON ud.user_id = r.user_id
WHERE ud.county_id = 5;

-- [25] Son X gün içinde en çok görüntülenen restoranlar
SELECT r.id, r.name, COUNT(rv.id) AS total_views
FROM restaurant_views rv
JOIN restaurants r ON r.id = rv.restaurant_id
WHERE rv.viewed_at >= NOW() - INTERVAL 30 DAY
GROUP BY r.id
ORDER BY total_views DESC
LIMIT 5;

-- [26] En yüksek puanlı restoranlar (ortalama rating üzerinden)
SELECT r.id, r.name, AVG(a.rating) AS avg_rating
FROM actions a
JOIN restaurants r ON r.id = a.restaurant_id
WHERE a.rating IS NOT NULL
GROUP BY r.id
ORDER BY avg_rating DESC
LIMIT 5;

-- [27] Restorana ait toplam yorum sayısı ve ortalama puanı
SELECT r.name, COUNT(c.id) AS total_comments, AVG(a.rating) AS average_rating
FROM restaurants r
LEFT JOIN comments c ON c.restaurant_id = r.id
LEFT JOIN actions a ON a.restaurant_id = r.id AND a.rating IS NOT NULL
WHERE r.id = 3
GROUP BY r.id;

-- [28] Kullanıcının sistemdeki tüm aktiviteleri (yorum, puan, favori, görüntüleme)
SELECT
    u.username,
    COUNT(DISTINCT c.id) AS total_comments,
    COUNT(DISTINCT a.id) AS total_actions,
    SUM(CASE WHEN a.is_favorited = 1 THEN 1 ELSE 0 END) AS total_favorites,
    COUNT(DISTINCT rv.id) AS total_views
FROM users u
LEFT JOIN comments c ON c.user_id = u.id
LEFT JOIN actions a ON a.user_id = u.id
LEFT JOIN restaurant_views rv ON rv.user_id = u.id
WHERE u.id = 3
GROUP BY u.id;

-- [29] Kullanıcının favorilediği restoranlardan aldığı ortalama puan
SELECT AVG(a.rating) AS avg_rating_for_favorites
FROM actions a
WHERE a.user_id = 3 AND a.is_favorited = 1 AND a.rating IS NOT NULL;

-- [30] Admin paneli: toplam kayıt sayıları (istatistik dashboard)
SELECT 
    (SELECT COUNT(*) FROM users) AS total_users,
    (SELECT COUNT(*) FROM restaurants) AS total_restaurants,
    (SELECT COUNT(*) FROM comments) AS total_comments,
    (SELECT COUNT(*) FROM restaurant_views) AS total_views,
    (SELECT COUNT(*) FROM actions WHERE rating IS NOT NULL) AS total_ratings;

-- [30] Admin paneli: toplam kayıt sayıları (istatistik dashboard)
SELECT 
    (SELECT COUNT(*) FROM users) AS total_users,
    (SELECT COUNT(*) FROM restaurants) AS total_restaurants,
    (SELECT COUNT(*) FROM comments) AS total_comments,
    (SELECT COUNT(*) FROM restaurant_views) AS total_views,
    (SELECT COUNT(*) FROM actions WHERE rating IS NOT NULL) AS total_ratings;

-- [32] Yeni kategori eklemek (admin)
INSERT INTO categories (name, description, created_at)
VALUES ('Kahvaltı Mekanı', 'Zengin kahvaltı sunan yerler', NOW());

-- [33] Yeni özellik (feature) eklemek (admin)
INSERT INTO features (name, description, created_at)
VALUES ('Çocuk Oyun Alanı', 'Çocuklar için ayrılmış güvenli oyun bölgesi', NOW());

-- [34] Restorana yeni kategori atamak
INSERT INTO restaurant_categories (restaurant_id, category_id)
VALUES (3, 4); -- Kemal’in Ocakbaşı’na 4 numaralı kategori eklendi

-- [35] Restorana yeni özellik atamak
INSERT INTO restaurant_features (restaurant_id, feature_id)
VALUES (3, 2); -- Kemal’in Ocakbaşı’na 2 numaralı özellik eklendi

-- [36] Restoran menüsüne yeni fotoğraf ekleme
INSERT INTO restaurant_menus (restaurant_id, image_url, created_at)
VALUES (3, 'kemal_yeni_menu.jpg', NOW());

-- [37] Admin onayı bekleyen restoranları listele
SELECT r.id, r.name, u.username
FROM restaurants r
JOIN users u ON u.id = r.user_id
WHERE r.is_verified = 0 AND r.is_active = 1;

-- [38] Admin restoranı onaylıyor (verified yapar)
UPDATE restaurants
SET is_verified = 1
WHERE id = 6;

-- [39] Restoran abonelik planı değiştirme
UPDATE restaurants
SET subscription_plan_id = 2
WHERE id = 3;

-- [40] Restoran sahibi kendi restoranlarını listelemek istiyor
SELECT id, name, is_verified, is_active
FROM restaurants
WHERE user_id = 5;

-- [41] Kullanıcının konumuna en yakın 5 restoranı getir (örnek konum: 41.05, 28.95)
SELECT r.id, r.name, r.latitude, r.longitude,
       ( 6371 * ACOS( COS(RADIANS(41.05)) * COS(RADIANS(r.latitude)) *
       COS(RADIANS(r.longitude) - RADIANS(28.95)) + SIN(RADIANS(41.05)) * SIN(RADIANS(r.latitude)) ) ) AS distance_km
FROM restaurants r
WHERE r.is_active = 1 AND r.is_verified = 1
ORDER BY distance_km ASC
LIMIT 5;

-- [42] Kullanıcı şifresini değiştirme (örnek kullanıcı id: 3)
UPDATE users
SET password = SHA2('yeniGüçlüParola123', 256)
WHERE id = 3;

-- [43] Kullanıcı hesabını silme (hesap + detaylar silinir)
DELETE FROM user_details WHERE user_id = 4;
DELETE FROM users WHERE id = 4;

-- [44] Abonelik planı detaylarını listele (admin veya restoran için)
SELECT id, name, description, monthly_price, created_at
FROM subscription_plans
ORDER BY monthly_price DESC;

-- [45] Belirli bir restoranın abonelik planının süresi dolmuş mu?
SELECT r.name, sp.name AS plan, sp.duration_days, r.created_at,
       DATE_ADD(r.created_at, INTERVAL sp.duration_days DAY) AS expiry_date,
       CURRENT_DATE() > DATE_ADD(r.created_at, INTERVAL sp.duration_days DAY) AS is_expired
FROM restaurants r
JOIN subscription_plans sp ON sp.id = r.subscription_plan_id
WHERE r.id = 3;

-- [46] Kullanıcının sistemde yaptığı tüm işlemler log formatında (özellikle admin için rapor)
SELECT 'Yorum' AS action_type, r.name AS target, c.description AS detail, c.created_at AS date
FROM comments c
JOIN restaurants r ON r.id = c.restaurant_id
WHERE c.user_id = 1
UNION
SELECT 'Puanlama', r.name, CONCAT('Rating: ', a.rating), a.created_at
FROM actions a
JOIN restaurants r ON r.id = a.restaurant_id
WHERE a.user_id = 1 AND a.rating IS NOT NULL
UNION
SELECT 'Favori', r.name, 'Favorilendi', a.created_at
FROM actions a
JOIN restaurants r ON r.id = a.restaurant_id
WHERE a.user_id = 1 AND a.is_favorited = 1
UNION
SELECT 'Görüntüleme', r.name, 'Restoran görüntülendi', rv.viewed_at
FROM restaurant_views rv
JOIN restaurants r ON r.id = rv.restaurant_id
WHERE rv.user_id = 1
ORDER BY date DESC;

-- [47] En fazla yoruma sahip kullanıcılar (top 5)
SELECT u.username, COUNT(c.id) AS total_comments
FROM comments c
JOIN users u ON u.id = c.user_id
GROUP BY c.user_id
ORDER BY total_comments DESC
LIMIT 5;

-- [48] Ortalama puanı 4’ten düşük olan restoranları listele (potansiyel iyileştirme alanı)
SELECT r.name, ROUND(AVG(a.rating), 2) AS average_rating
FROM actions a
JOIN restaurants r ON r.id = a.restaurant_id
WHERE a.rating IS NOT NULL
GROUP BY r.id
HAVING AVG(a.rating) < 4
ORDER BY average_rating ASC;

-- [49] Kullanıcının en çok favorilediği restoran kategorileri
SELECT c.name, COUNT(*) AS favorite_count
FROM actions a
JOIN restaurant_categories rc ON a.restaurant_id = rc.restaurant_id
JOIN categories c ON rc.category_id = c.id
WHERE a.user_id = ? AND a.is_favorited = 1
GROUP BY c.name
ORDER BY favorite_count DESC;

-- [50] Favorilenen restoranlardaki en sık görülen özellikler
SELECT f.name AS feature_name, COUNT(*) AS usage_count
FROM actions a
JOIN restaurant_features rf ON a.restaurant_id = rf.restaurant_id
JOIN features f ON rf.feature_id = f.id
WHERE a.is_favorited = 1
GROUP BY f.name
ORDER BY usage_count DESC;

-- [51] Seçilen kategorilere ve özelliklere sahip restoranları öner
SELECT DISTINCT r.id, r.name
FROM restaurants r
WHERE r.id IN (
    SELECT rc.restaurant_id FROM restaurant_categories rc WHERE rc.category_id IN (?, ?, ...)
)
AND r.id IN (
    SELECT rf.restaurant_id FROM restaurant_features rf WHERE rf.feature_id IN (?, ?, ...)
);

-- [52] Kullanıcının en yüksek ortalama puanı verdiği restoran kategorileri
SELECT c.name AS category, AVG(a.rating) AS avg_rating
FROM actions a
JOIN restaurant_categories rc ON a.restaurant_id = rc.restaurant_id
JOIN categories c ON rc.category_id = c.id
WHERE a.user_id = ? AND a.rating IS NOT NULL
GROUP BY c.id
ORDER BY avg_rating DESC;

-- [54] Her ilçedeki restoran sayısı
SELECT co.name AS county_name, COUNT(r.id) AS restaurant_count
FROM restaurants r
JOIN users u ON r.user_id = u.id
JOIN user_details ud ON u.id = ud.user_id
JOIN counties co ON co.id = ud.county_id
GROUP BY co.id
ORDER BY restaurant_count DESC;

-- [55] Kullanıcının favori restoranlarındaki ortalama fiyat düzeyi
SELECT AVG(pr.min_price + pr.max_price) / 2 AS avg_price
FROM actions a
JOIN restaurant_price_ranges rp ON rp.restaurant_id = a.restaurant_id
JOIN price_ranges pr ON pr.id = rp.price_range_id
WHERE a.user_id = ? AND a.is_favorited = 1;

-- [56] Belirli bir kullanıcıya ait tüm yorumlar ve puanlar
SELECT r.name AS restaurant_name, c.description AS comment, a.rating, c.created_at
FROM comments c
LEFT JOIN actions a ON c.user_id = a.user_id AND c.restaurant_id = a.restaurant_id
JOIN restaurants r ON r.id = c.restaurant_id
WHERE c.user_id = ?;

-- [57] Belirli bir restorana ait tüm yorumlar ve yorum yapan kullanıcılar
SELECT u.username, c.description, c.created_at
FROM comments c
JOIN users u ON u.id = c.user_id
WHERE c.restaurant_id = ?;

-- [58] Restoranların ortalama puanı ve toplam oy sayısı
SELECT r.name, ROUND(AVG(a.rating), 2) AS avg_rating, COUNT(a.rating) AS vote_count
FROM restaurants r
JOIN actions a ON a.restaurant_id = r.id
WHERE a.rating IS NOT NULL
GROUP BY r.id
ORDER BY avg_rating DESC;

-- [59] En çok favorilenen restoranlar
SELECT r.name, COUNT(*) AS total_favorites
FROM actions a
JOIN restaurants r ON r.id = a.restaurant_id
WHERE a.is_favorited = 1
GROUP BY r.id
ORDER BY total_favorites DESC
LIMIT 10;

-- [60] Her kullanıcının toplam favori restoran sayısı
SELECT u.username, COUNT(*) AS favorite_count
FROM actions a
JOIN users u ON u.id = a.user_id
WHERE a.is_favorited = 1
GROUP BY u.id
ORDER BY favorite_count DESC;

-- [61] Belirli bir ilçedeki restoranları ve puan ortalamalarını getir
SELECT r.name, ROUND(AVG(a.rating), 2) AS avg_rating
FROM restaurants r
JOIN actions a ON r.id = a.restaurant_id
JOIN users u ON r.user_id = u.id
JOIN user_details ud ON u.id = ud.user_id
WHERE ud.county_id = ?
GROUP BY r.id;

-- [62] Kullanıcının favorilediği restoranlara benzer restoranları getir (aynı kategoriden)
SELECT DISTINCT r2.id, r2.name
FROM actions a
JOIN restaurant_categories rc1 ON rc1.restaurant_id = a.restaurant_id
JOIN restaurant_categories rc2 ON rc1.category_id = rc2.category_id
JOIN restaurants r2 ON r2.id = rc2.restaurant_id
WHERE a.user_id = ? AND a.is_favorited = 1
  AND r2.id NOT IN (
    SELECT restaurant_id FROM actions WHERE user_id = ? AND is_favorited = 1
  );

-- [63] En çok yorum yapılan restoranlar
SELECT r.name, COUNT(c.id) AS total_comments
FROM comments c
JOIN restaurants r ON r.id = c.restaurant_id
GROUP BY r.id
ORDER BY total_comments DESC
LIMIT 10;

-- [64] En az puan verilen restoranlar (iyileştirme önerisi)
SELECT r.name, ROUND(AVG(a.rating), 2) AS avg_rating
FROM actions a
JOIN restaurants r ON r.id = a.restaurant_id
WHERE a.rating IS NOT NULL
GROUP BY r.id
HAVING avg_rating < 3
ORDER BY avg_rating ASC;

-- [65] Kullanıcının favori kategorileri (puan ortalamasına göre)
SELECT c.name, ROUND(AVG(a.rating), 2) AS avg_rating
FROM actions a
JOIN restaurant_categories rc ON a.restaurant_id = rc.restaurant_id
JOIN categories c ON rc.category_id = c.id
WHERE a.user_id = ? AND a.rating IS NOT NULL
GROUP BY c.id
ORDER BY avg_rating DESC;

