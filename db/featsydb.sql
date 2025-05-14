-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 13 May 2025, 23:42:25
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `featsydb`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `actions`
--

CREATE TABLE `actions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `rating` tinyint(4) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `is_favorited` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `actions`
--

INSERT INTO `actions` (`id`, `user_id`, `restaurant_id`, `rating`, `is_favorited`, `created_at`, `updated_at`) VALUES
(1, 11, 1, 5, 1, '2025-05-13 23:06:59', '2025-05-13 23:06:59'),
(2, 12, 2, 4, 1, '2025-05-13 23:06:59', '2025-05-13 23:06:59'),
(3, 13, 3, 5, 0, '2025-05-13 23:06:59', '2025-05-13 23:06:59'),
(4, 14, 4, 3, 1, '2025-05-13 23:06:59', '2025-05-13 23:06:59'),
(5, 15, 5, 2, 0, '2025-05-13 23:06:59', '2025-05-13 23:06:59'),
(6, 16, 6, 4, 1, '2025-05-13 23:06:59', '2025-05-13 23:06:59'),
(7, 17, 7, 5, 1, '2025-05-13 23:06:59', '2025-05-13 23:06:59'),
(8, 18, 3, 4, 0, '2025-05-13 23:06:59', '2025-05-13 23:06:59'),
(9, 19, 1, 3, 1, '2025-05-13 23:06:59', '2025-05-13 23:06:59'),
(10, 20, 5, 5, 1, '2025-05-13 23:06:59', '2025-05-13 23:06:59');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(14, 'Açık Büfe'),
(4, 'Amerikan Mutfağı'),
(12, 'Deniz Ürünleri'),
(11, 'Et Restoranı'),
(13, 'Fast Food'),
(16, 'Fine Dining'),
(6, 'Fransız Mutfağı'),
(7, 'Hint Mutfağı'),
(3, 'İtalyan Mutfağı'),
(15, 'Kafe'),
(18, 'Kokteyl Mekanı'),
(5, 'Meksika Mutfağı'),
(8, 'Orta Doğu Mutfağı'),
(17, 'Romantik Akşam Yemeği'),
(9, 'Sokak Lezzetleri'),
(10, 'Tatlıcı'),
(1, 'Türk Mutfağı'),
(2, 'Uzak Doğu Mutfağı');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `cities`
--

INSERT INTO `cities` (`id`, `name`) VALUES
(1, 'İstanbul');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `restaurant_id`, `description`, `created_at`) VALUES
(1, 11, 1, 'Harika Meksika yemekleri ve servis çok hızlıydı.', '2025-05-13 23:03:38'),
(2, 12, 2, 'Tatlılar gerçekten taze ve lezzetliydi. Mekan çok tatlı.', '2025-05-13 23:03:38'),
(3, 13, 3, 'Romantik bir akşam yemeği için mükemmel bir tercih.', '2025-05-13 23:03:38'),
(4, 14, 4, 'Burgerleri çok iyi ama biraz kalabalıktı.', '2025-05-13 23:03:38'),
(5, 15, 5, 'Lokasyon güzel, yemekler ortalama.', '2025-05-13 23:03:38'),
(6, 16, 6, 'Tatlılar enfes! Özellikle çilekli cheesecake favorim.', '2025-05-13 23:03:38'),
(7, 17, 7, 'Sushi lezzetliydi, personel çok nazikti.', '2025-05-13 23:03:38'),
(8, 18, 1, 'Ranchero’da ikinci kez yiyorum, yine memnun kaldım.', '2025-05-13 23:03:38'),
(9, 19, 3, 'Makarna porsiyonları doyurucu ve İtalyan usulüydü.', '2025-05-13 23:03:38'),
(10, 20, 6, 'Sokak lezzetleri menüsü tam benlikti, tekrar geleceğim.', '2025-05-13 23:03:38');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `counties`
--

CREATE TABLE `counties` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `counties`
--

INSERT INTO `counties` (`id`, `city_id`, `name`) VALUES
(94, 1, 'Adalar'),
(95, 1, 'Arnavutköy'),
(96, 1, 'Ataşehir'),
(97, 1, 'Avcılar'),
(98, 1, 'Bağcılar'),
(99, 1, 'Bahçelievler'),
(100, 1, 'Bakırköy'),
(101, 1, 'Başakşehir'),
(102, 1, 'Bayrampaşa'),
(103, 1, 'Beşiktaş'),
(104, 1, 'Beykoz'),
(105, 1, 'Beylikdüzü'),
(106, 1, 'Beyoğlu'),
(107, 1, 'Büyükçekmece'),
(108, 1, 'Çatalca'),
(109, 1, 'Çekmeköy'),
(110, 1, 'Esenler'),
(111, 1, 'Esenyurt'),
(112, 1, 'Eyüpsultan'),
(113, 1, 'Fatih'),
(114, 1, 'Gaziosmanpaşa'),
(115, 1, 'Güngören'),
(116, 1, 'Kadıköy'),
(117, 1, 'Kağıthane'),
(118, 1, 'Kartal'),
(119, 1, 'Küçükçekmece'),
(120, 1, 'Maltepe'),
(121, 1, 'Pendik'),
(122, 1, 'Sancaktepe'),
(123, 1, 'Sarıyer'),
(124, 1, 'Silivri'),
(125, 1, 'Sultanbeyli'),
(126, 1, 'Sultangazi'),
(127, 1, 'Şile'),
(128, 1, 'Şişli'),
(129, 1, 'Tuzla'),
(130, 1, 'Ümraniye'),
(131, 1, 'Üsküdar'),
(132, 1, 'Zeytinburnu');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(13, 'Açık Büfe'),
(7, 'Açık Hava'),
(4, 'Aile İçin Uygun'),
(6, 'Alkol'),
(14, 'Çocuk Oyun Alanı'),
(10, 'Engelli Erişimi'),
(3, 'Evcil Hayvan Dostu'),
(8, 'Müzik'),
(11, 'Park Yeri'),
(5, 'Sigara İçilebilen Alan'),
(12, 'Take Away'),
(15, 'Teras'),
(2, 'Vegan'),
(1, 'Vejetaryen'),
(9, 'Wi-Fi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `price_ranges`
--

CREATE TABLE `price_ranges` (
  `id` int(11) NOT NULL,
  `min_price` int(11) NOT NULL,
  `max_price` int(11) NOT NULL,
  `label` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `price_ranges`
--

INSERT INTO `price_ranges` (`id`, `min_price`, `max_price`, `label`) VALUES
(1, 0, 250, 'Ucuz'),
(2, 251, 500, 'Orta'),
(3, 501, 1000, 'Pahalı'),
(4, 1001, 9999, 'Lüks');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `opening_hours` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `price_range_id` int(11) DEFAULT NULL,
  `county_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `restaurants`
--

INSERT INTO `restaurants` (`id`, `user_id`, `name`, `description`, `phone`, `profile_picture`, `website`, `instagram_url`, `is_verified`, `is_active`, `opening_hours`, `created_at`, `updated_at`, `latitude`, `longitude`, `price_range_id`, `county_id`) VALUES
(1, 1, 'Ranchero Ataşehir Watergarden', 'Renkli dekorasyonu, canlı müzikleri ve özgün tarifleriyle gerçek bir Meksika deneyimi sunan Ranchero, acı severler için eşsiz bir kaçış noktasıdır.', '02163806510', 'ranchero_ataşehir.jpg', 'https://www.ranchero.com.tr', 'https://instagram.com/rancherorestaurant', 1, 1, '11:00-23:00', '2025-05-13 13:49:09', '2025-05-13 23:14:08', 40.9912100, 29.1304300, 2, 96),
(2, 2, 'Ppang Moda', 'Minimalist Japon estetiğini yansıtan Ppang Moda, geleneksel tatlılardan modern füzyon lezzetlere uzanan seçkisiyle tatlı tutkunlarının buluşma noktasıdır.', '05310090489', 'ppang_moda.jpg', 'https://www.ppang.com.tr', 'https://www.instagram.com/ppangbakery', 1, 1, '08:00-22:00', '2025-05-13 14:55:35', '2025-05-13 23:12:39', 40.9879500, 29.0243100, 1, 116),
(3, 3, 'Brio İstanbul', 'Brio İstanbul, şık iç mekân tasarımı ve özenle hazırlanan İtalyan yemekleriyle romantik akşam yemeklerinin vazgeçilmezi olmaya aday bir fine dining restoranıdır.', '+902122026969', 'brio_istanbul.jpg', 'https://www.brioistanbul.com', 'https://www.instagram.com/brioistanbul', 1, 1, '12:00-22:30', '2025-05-13 14:57:31', '2025-05-13 23:12:39', 41.1776700, 29.0535000, 3, 104),
(4, 4, 'Burger ZMASH', 'Zincir mantığından uzak, tamamen el yapımı smash burger konseptiyle fark yaratan Burger ZMASH, burger tutkunlarını müdavime çeviriyor.', '+905442293247', 'burger_zmash.jpg', 'https://burgerzmash.com', 'https://www.instagram.com/zmash', 1, 1, '12:00-22:00', '2025-05-13 14:59:41', '2025-05-13 23:14:18', 41.1084000, 29.0574000, 2, 104),
(5, 5, 'Upperdeck American Diner', 'Upperdeck, klasik Amerikan diner ruhunu modern bir çizgide yeniden yorumlarken, sunduğu geniş menüsü ve rahat ambiyansıyla kalabalıklardan kaçmak isteyenler için birebir.', '02122275068', 'upperdeck.jpg', 'https://www.upperdeckistanbul.com', 'https://instagram.com/upperdeckistanbul', 1, 1, '10:00-22:00', '2025-05-13 15:08:41', '2025-05-13 23:12:39', 41.0433000, 29.0055000, 3, 103),
(6, 6, 'Çosa Beyoğlu', 'Çoşa Beyoğlu; modern sokak lezzetleri, günlük tatlılar ve özgün içecekleriyle Beyoğlu’nun enerjisini tabaklara taşıyan yaratıcı bir şehir restoranıdır.', '02122222222', 'cosa_beyoglu.jpg', 'https://www.cosa.com.tr', 'https://instagram.com/cosaistanbul', 1, 1, '11:00-22:00', '2025-05-13 15:14:31', '2025-05-13 23:12:39', 41.0350400, 28.9769600, 2, 106),
(7, 7, 'Konoha Etiler', 'Konoha Etiler, ramen ve donburi gibi otantik Uzakdoğu tatlarını samimi bir ortamda sunarken, anime atmosferini andıran dekorasyonuyla farklı bir deneyim yaşatıyor.', '02123521313', 'konoha_etiler.jpg', 'https://www.konoha.com.tr', 'https://instagram.com/konohaetiler', 1, 1, '12:00-22:30', '2025-05-13 15:21:18', '2025-05-13 23:12:39', 41.0786250, 29.0247210, 3, 102);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `restaurant_categories`
--

CREATE TABLE `restaurant_categories` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `restaurant_categories`
--

INSERT INTO `restaurant_categories` (`id`, `restaurant_id`, `category_id`) VALUES
(1, 1, 5),
(14, 2, 2),
(3, 2, 10),
(6, 3, 3),
(4, 3, 17),
(5, 3, 18),
(7, 4, 13),
(8, 5, 4),
(10, 5, 9),
(9, 5, 13),
(11, 6, 9),
(12, 6, 10),
(13, 7, 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `restaurant_features`
--

CREATE TABLE `restaurant_features` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `restaurant_features`
--

INSERT INTO `restaurant_features` (`id`, `restaurant_id`, `feature_id`) VALUES
(16, 1, 1),
(12, 1, 3),
(17, 1, 5),
(11, 1, 6),
(10, 1, 7),
(13, 1, 8),
(15, 1, 9),
(14, 1, 11),
(22, 2, 2),
(19, 2, 4),
(18, 2, 7),
(20, 2, 8),
(21, 2, 9),
(30, 3, 1),
(29, 3, 2),
(27, 3, 5),
(24, 3, 6),
(23, 3, 7),
(25, 3, 8),
(31, 3, 9),
(26, 3, 11),
(28, 3, 15),
(35, 4, 2),
(32, 4, 8),
(34, 4, 9),
(33, 4, 11),
(41, 5, 1),
(42, 5, 2),
(37, 5, 4),
(36, 5, 7),
(43, 5, 9),
(38, 5, 10),
(39, 5, 11),
(40, 5, 15),
(51, 6, 1),
(52, 6, 2),
(48, 6, 3),
(45, 6, 4),
(49, 6, 5),
(44, 6, 7),
(53, 6, 9),
(47, 6, 10),
(50, 6, 12),
(46, 6, 14),
(64, 7, 1),
(63, 7, 2),
(57, 7, 3),
(55, 7, 4),
(60, 7, 5),
(54, 7, 7),
(58, 7, 8),
(65, 7, 9),
(56, 7, 10),
(59, 7, 11),
(61, 7, 12),
(62, 7, 15);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `restaurant_menus`
--

CREATE TABLE `restaurant_menus` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `restaurant_views`
--

CREATE TABLE `restaurant_views` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `restaurant_id` int(11) NOT NULL,
  `viewed_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `mail` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','restaurant_owner','admin') DEFAULT 'customer',
  `status` enum('active','suspended','deleted') DEFAULT 'active',
  `email_verified` tinyint(1) DEFAULT 0,
  `birth_date` date DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `mail`, `password`, `role`, `status`, `email_verified`, `birth_date`, `profile_picture`, `created_at`, `updated_at`) VALUES
(1, 'mehmet_yilmaz', 'mehmet@example.com', 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', 'restaurant_owner', 'active', 1, NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(2, 'ayse_kara', 'ayse@example.com', 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', 'restaurant_owner', 'active', 1, NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(3, 'veli_dogan', 'veli@example.com', 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', 'restaurant_owner', 'active', 1, NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(4, 'selin_ozdemir', 'selin@example.com', 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', 'restaurant_owner', 'active', 1, NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(5, 'cem_aksoy', 'cem@example.com', 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', 'restaurant_owner', 'active', 1, NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(6, 'nur_can', 'nur@example.com', 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', 'restaurant_owner', 'active', 1, NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(7, 'hasan_kurt', 'hasan@example.com', 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', 'restaurant_owner', 'active', 1, NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(8, 'dilan_tas', 'dilan@example.com', 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', 'restaurant_owner', 'active', 1, NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(9, 'mustafa_aydin', 'mustafa@example.com', 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', 'restaurant_owner', 'active', 1, NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(10, 'seda_karaca', 'seda@example.com', 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', 'restaurant_owner', 'active', 1, NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(11, 'emre_kilic', 'emre@example.com', 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', 'customer', 'active', 1, NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(12, 'zeynep_arslan', 'zeynep@example.com', 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', 'customer', 'active', 1, NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(13, 'fatma_yildiz', 'fatma@example.com', 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', 'customer', 'active', 1, NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(14, 'burak_demir', 'burak@example.com', 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', 'customer', 'active', 1, NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(15, 'elif_can', 'elif@example.com', 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', 'customer', 'active', 1, NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(16, 'omer_yavuz', 'omer@example.com', 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', 'customer', 'active', 1, NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(17, 'sevim_ozkan', 'sevim@example.com', 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', 'customer', 'active', 1, NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(18, 'deniz_akbas', 'deniz@example.com', 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', 'customer', 'active', 1, NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(19, 'furkan_kaya', 'furkan@example.com', 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', 'customer', 'active', 1, NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(20, 'asli_ay', 'asli@example.com', 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', 'customer', 'active', 1, NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `county_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `name`, `surname`, `phone`, `address`, `county_id`, `created_at`, `updated_at`) VALUES
(21, 1, 'Mehmet', 'Yılmaz', '05551110001', 'Ataköy Mah. No:1 Bakırköy', 100, '2025-05-13 11:59:29', '2025-05-13 11:59:29'),
(22, 2, 'Ayşe', 'Kara', '05551110002', 'Bahçelievler Cad. No:25', 99, '2025-05-13 11:59:29', '2025-05-13 11:59:29'),
(23, 3, 'Veli', 'Doğan', '05551110003', 'Cevizlik Mah. No:3', 100, '2025-05-13 11:59:29', '2025-05-13 11:59:29'),
(24, 4, 'Selin', 'Özdemir', '05551110004', 'Etiler Mah. No:14 Beşiktaş', 103, '2025-05-13 11:59:29', '2025-05-13 11:59:29'),
(25, 5, 'Cem', 'Aksoy', '05551110005', 'Ortaköy Mah. No:30', 103, '2025-05-13 11:59:29', '2025-05-13 11:59:29'),
(26, 6, 'Nur', 'Can', '05551110006', 'Bostancı Mah. No:18', 116, '2025-05-13 11:59:29', '2025-05-13 11:59:29'),
(27, 7, 'Hasan', 'Kurt', '05551110007', 'Kozyatağı Mah. No:7', 116, '2025-05-13 11:59:29', '2025-05-13 11:59:29'),
(28, 8, 'Dilan', 'Taş', '05551110008', 'Kadıköy Rıhtım Cad. No:5', 116, '2025-05-13 11:59:29', '2025-05-13 11:59:29'),
(29, 9, 'Mustafa', 'Aydın', '05551110009', 'Bahariye Cad. No:90', 116, '2025-05-13 11:59:29', '2025-05-13 11:59:29'),
(30, 10, 'Seda', 'Karaca', '05551110010', 'Feneryolu Mah. No:12', 116, '2025-05-13 11:59:29', '2025-05-13 11:59:29'),
(31, 11, 'Emre', 'Kılıç', '05551110011', 'Kozvatağı Mah. No:55', 116, '2025-05-13 11:59:29', '2025-05-13 11:59:29'),
(32, 12, 'Zeynep', 'Arslan', '05551110012', 'Tuzla Sahil Yolu No:7', 129, '2025-05-13 11:59:29', '2025-05-13 11:59:29'),
(33, 13, 'Fatma', 'Yıldız', '05551110013', 'Maltepe Sahil Mah. No:13', 120, '2025-05-13 11:59:29', '2025-05-13 11:59:29'),
(34, 14, 'Burak', 'Demir', '05551110014', 'Beşyüzevler Mah. No:8', 127, '2025-05-13 11:59:29', '2025-05-13 11:59:29'),
(35, 15, 'Elif', 'Can', '05551110015', 'Beşiktaş Nispetiye Cad. No:22', 103, '2025-05-13 11:59:29', '2025-05-13 11:59:29'),
(36, 16, 'Ömer', 'Yavuz', '05551110016', 'Kağıthane Merkez Mah. No:33', 117, '2025-05-13 11:59:29', '2025-05-13 11:59:29'),
(37, 17, 'Sevim', 'Özkan', '05551110017', 'Zeytinburnu Sümer Mah. No:6', 132, '2025-05-13 11:59:29', '2025-05-13 11:59:29'),
(38, 18, 'Derya', 'Acar', '05551110018', 'Pendik Yenişehir Mah. No:40', 121, '2025-05-13 11:59:29', '2025-05-13 11:59:29'),
(39, 19, 'Furkan', 'Kaya', '05551110019', 'Bayrampaşa Yenidoğan Mah. No:15', 102, '2025-05-13 11:59:29', '2025-05-13 11:59:29'),
(40, 20, 'Aslı', 'Ar', '05551110020', 'Ümraniye Atatürk Mah. No:4', 130, '2025-05-13 11:59:29', '2025-05-13 11:59:29');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`restaurant_id`),
  ADD KEY `idx_actions_user_id` (`user_id`),
  ADD KEY `idx_actions_restaurant_id` (`restaurant_id`);

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Tablo için indeksler `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Tablo için indeksler `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_comments_user_id` (`user_id`),
  ADD KEY `idx_comments_restaurant_id` (`restaurant_id`);

--
-- Tablo için indeksler `counties`
--
ALTER TABLE `counties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Tablo için indeksler `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Tablo için indeksler `price_ranges`
--
ALTER TABLE `price_ranges`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_restaurants_user_id` (`user_id`),
  ADD KEY `fk_price_range` (`price_range_id`),
  ADD KEY `fk_restaurant_county` (`county_id`);

--
-- Tablo için indeksler `restaurant_categories`
--
ALTER TABLE `restaurant_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `restaurant_id` (`restaurant_id`,`category_id`),
  ADD KEY `idx_restaurant_categories_restaurant_id` (`restaurant_id`),
  ADD KEY `idx_restaurant_categories_category_id` (`category_id`);

--
-- Tablo için indeksler `restaurant_features`
--
ALTER TABLE `restaurant_features`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `restaurant_id` (`restaurant_id`,`feature_id`),
  ADD KEY `feature_id` (`feature_id`);

--
-- Tablo için indeksler `restaurant_menus`
--
ALTER TABLE `restaurant_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Tablo için indeksler `restaurant_views`
--
ALTER TABLE `restaurant_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Tablo için indeksler `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `county_id` (`county_id`),
  ADD KEY `idx_user_details_user_id` (`user_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Tablo için AUTO_INCREMENT değeri `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `counties`
--
ALTER TABLE `counties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- Tablo için AUTO_INCREMENT değeri `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `price_ranges`
--
ALTER TABLE `price_ranges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `restaurant_categories`
--
ALTER TABLE `restaurant_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tablo için AUTO_INCREMENT değeri `restaurant_features`
--
ALTER TABLE `restaurant_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Tablo için AUTO_INCREMENT değeri `restaurant_menus`
--
ALTER TABLE `restaurant_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `restaurant_views`
--
ALTER TABLE `restaurant_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Tablo için AUTO_INCREMENT değeri `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `actions`
--
ALTER TABLE `actions`
  ADD CONSTRAINT `actions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `actions_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `counties`
--
ALTER TABLE `counties`
  ADD CONSTRAINT `counties_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `restaurants`
--
ALTER TABLE `restaurants`
  ADD CONSTRAINT `fk_price_range` FOREIGN KEY (`price_range_id`) REFERENCES `price_ranges` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_restaurant_county` FOREIGN KEY (`county_id`) REFERENCES `counties` (`id`) ON DELETE SET NULL;

--
-- Tablo kısıtlamaları `restaurant_categories`
--
ALTER TABLE `restaurant_categories`
  ADD CONSTRAINT `restaurant_categories_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `restaurant_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `restaurant_features`
--
ALTER TABLE `restaurant_features`
  ADD CONSTRAINT `restaurant_features_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `restaurant_features_ibfk_2` FOREIGN KEY (`feature_id`) REFERENCES `features` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `restaurant_menus`
--
ALTER TABLE `restaurant_menus`
  ADD CONSTRAINT `restaurant_menus_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `restaurant_views`
--
ALTER TABLE `restaurant_views`
  ADD CONSTRAINT `restaurant_views_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `restaurant_views_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_details_ibfk_3` FOREIGN KEY (`county_id`) REFERENCES `counties` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
