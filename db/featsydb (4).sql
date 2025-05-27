-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 26 May 2025, 01:26:28
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

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
(2, 12, 2, 4, 1, '2025-05-13 23:06:59', '2025-05-13 23:06:59'),
(4, 14, 4, 3, 1, '2025-05-13 23:06:59', '2025-05-13 23:06:59'),
(5, 15, 5, 2, 0, '2025-05-13 23:06:59', '2025-05-13 23:06:59'),
(6, 16, 6, 4, 1, '2025-05-13 23:06:59', '2025-05-13 23:06:59'),
(7, 17, 7, 5, 1, '2025-05-13 23:06:59', '2025-05-13 23:06:59'),
(8, 18, 3, 4, 0, '2025-05-13 23:06:59', '2025-05-13 23:06:59'),
(9, 19, 1, 3, 1, '2025-05-13 23:06:59', '2025-05-13 23:06:59'),
(10, 20, 5, 5, 1, '2025-05-13 23:06:59', '2025-05-13 23:06:59'),
(11, 21, 2, 5, 0, '2025-05-22 00:37:23', '2025-05-22 00:37:33'),
(12, 24, 2, 5, 1, '2025-05-22 01:55:19', '2025-05-26 01:38:12'),
(13, 24, 7, 5, 0, '2025-05-22 04:03:06', '2025-05-26 01:37:20'),
(14, 24, 6, 4, 1, '2025-05-22 04:10:40', '2025-05-25 03:05:19'),
(15, 24, 1, 5, 1, '2025-05-22 04:30:41', '2025-05-26 01:22:38'),
(16, 24, 4, 5, 0, '2025-05-22 05:01:40', '2025-05-22 05:01:40'),
(17, 25, 2, 1, 0, '2025-05-23 01:27:16', '2025-05-23 01:27:16'),
(18, 21, 3, 3, 0, '2025-05-23 11:03:17', '2025-05-23 11:03:17'),
(19, 24, 3, NULL, 0, '2025-05-25 02:10:58', '2025-05-25 02:11:07'),
(20, 24, 5, 2, 1, '2025-05-25 03:27:14', '2025-05-26 01:38:58'),
(21, 35, 7, NULL, 0, '2025-05-26 01:41:14', '2025-05-26 01:42:03'),
(22, 35, 6, NULL, 0, '2025-05-26 01:47:25', '2025-05-26 01:47:29'),
(23, 35, 4, 1, 0, '2025-05-26 01:57:13', '2025-05-26 02:12:41');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `admins`
--

INSERT INTO `admins` (`id`, `user_id`, `created_at`) VALUES
(1, 21, '2025-05-24 22:04:09');

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
(2, 12, 2, 'Tatlılar gerçekten taze ve lezzetliydi. Mekan çok tatlı.', '2025-05-13 23:03:38'),
(4, 14, 4, 'Burgerleri çok iyi ama biraz kalabalıktı.', '2025-05-13 23:03:38'),
(5, 15, 5, 'Lokasyon güzel, yemekler ortalama.', '2025-05-13 23:03:38'),
(6, 16, 6, 'Tatlılar enfes! Özellikle çilekli cheesecake favorim.', '2025-05-13 23:03:38'),
(7, 17, 7, 'Sushi lezzetliydi, personel çok nazikti.', '2025-05-13 23:03:38'),
(8, 18, 1, 'Ranchero’da ikinci kez yiyorum, yine memnun kaldım.', '2025-05-13 23:03:38'),
(9, 19, 3, 'Makarna porsiyonları doyurucu ve İtalyan usulüydü.', '2025-05-13 23:03:38'),
(10, 20, 6, 'Sokak lezzetleri menüsü tam benlikti, tekrar geleceğim.', '2025-05-13 23:03:38'),
(11, 21, 2, 'süperrr', '2025-05-22 00:37:23'),
(12, 21, 2, 'harika', '2025-05-22 00:37:33'),
(13, 24, 2, 'SÜPEEEEERRRRRRRR BAYILZIMMMM', '2025-05-22 01:55:19'),
(14, 24, 7, 'Kalitesiz ürünler kullanılıyor ancak atmosfer iyi.', '2025-05-22 04:03:06'),
(15, 24, 6, 'Ortalama bir mekandı.', '2025-05-22 04:10:40'),
(16, 24, 6, 'tekrar gitmem.', '2025-05-22 04:11:20'),
(17, 24, 1, 'Bayıldım. Tekrar Gelicem', '2025-05-22 04:30:41'),
(18, 24, 6, 'Umarım en kısa zamanda tekrar uğrarım', '2025-05-22 04:59:16'),
(19, 24, 4, 'Çok özel bir deneyim', '2025-05-22 05:01:40'),
(20, 25, 2, 'kötü bi deneyim', '2025-05-23 01:27:16'),
(22, 24, 5, 'berbattı', '2025-05-25 03:27:14'),
(23, 24, 7, 'atmosfer büyüleyiciydi', '2025-05-26 01:37:20'),
(24, 35, 4, 'hhhh', '2025-05-26 01:58:15');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `user_id`, `message`, `created_at`) VALUES
(1, 24, 'iiiii', '2025-05-25 02:38:41'),
(2, 24, 'hesabımda favori kısmı çalışmıyror yardımcı olur musunuz?', '2025-05-25 02:47:25'),
(3, 24, 'selamlar. hesabımda bir hata var_ ', '2025-05-26 01:11:44'),
(4, 24, 'sffsfsfsf', '2025-05-26 01:14:19'),
(5, 24, 'hahahahahahahahahah süper uygulama ', '2025-05-26 01:20:53');

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
(132, 1, 'Zeytinburnu'),
(133, 1, 'Etiler');

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
  `price_range_id` int(11) DEFAULT NULL,
  `county_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `description`, `phone`, `profile_picture`, `website`, `instagram_url`, `is_verified`, `is_active`, `opening_hours`, `created_at`, `updated_at`, `price_range_id`, `county_id`) VALUES
(1, 'Ranchero Ataşehir Watergarden', 'Renkli dekorasyonu, canlı müzikleri ve özgün tarifleriyle gerçek bir Meksika deneyimi sunan Ranchero, acı severler için eşsiz bir kaçış noktasıdır.', '02163806510', 'ranchero_ataşehir.jpg', 'https://www.ranchero.com.tr', 'https://instagram.com/rancherorestaurant', 1, 1, '11:00-23:00', '2025-05-13 13:49:09', '2025-05-13 23:14:08', 2, 96),
(2, 'Ppang Moda', 'Minimalist Japon estetiğini yansıtan Ppang Moda, geleneksel tatlılardan modern füzyon lezzetlere uzanan seçkisiyle tatlı tutkunlarının buluşma noktasıdır.', '05310090489', 'ppang_moda.jpg', 'https://www.ppang.com.tr', 'https://www.instagram.com/ppangbakery', 1, 1, '08:00-22:00', '2025-05-13 14:55:35', '2025-05-13 23:12:39', 1, 116),
(3, 'Brio İstanbul', 'Brio İstanbul, şık iç mekân tasarımı ve özenle hazırlanan İtalyan yemekleriyle romantik akşam yemeklerinin vazgeçilmezi olmaya aday bir fine dining restoranıdır.', '+902122026969', 'brio_istanbul.jpg', 'https://www.brioistanbul.com', 'https://www.instagram.com/brioistanbul', 1, 1, '12:00-22:30', '2025-05-13 14:57:31', '2025-05-23 02:11:27', 3, 104),
(4, 'Burger ZMASH', 'Zincir mantığından uzak, tamamen el yapımı smash burger konseptiyle fark yaratan Burger ZMASH, burger tutkunlarını müdavime çeviriyor.', '+905442293247', 'burger_zmash.jpg', 'https://burgerzmash.com', 'https://www.instagram.com/zmash', 1, 1, '12:00-22:00', '2025-05-13 14:59:41', '2025-05-13 23:14:18', 2, 104),
(5, 'Upperdeck American Diner', 'Upperdeck, klasik Amerikan diner ruhunu modern bir çizgide yeniden yorumlarken, sunduğu geniş menüsü ve rahat ambiyansıyla kalabalıklardan kaçmak isteyenler için birebir.', '02122275068', 'upperdeck.jpg', 'https://www.upperdeckistanbul.com', 'https://instagram.com/upperdeckistanbul', 1, 1, '10:00-22:00', '2025-05-13 15:08:41', '2025-05-13 23:12:39', 3, 103),
(6, 'Çosa Beyoğlu', 'Çoşa Beyoğlu; modern sokak lezzetleri, günlük tatlılar ve özgün içecekleriyle Beyoğlu’nun enerjisini tabaklara taşıyan yaratıcı bir şehir restoranıdır.', '02122222222', 'cosa_beyoglu.jpg', 'https://www.cosa.com.tr', 'https://instagram.com/cosaistanbul', 1, 1, '11:00-22:00', '2025-05-13 15:14:31', '2025-05-13 23:12:39', 2, 106),
(7, 'Konoha Etiler', 'Konoha Etiler, ramen ve donburi gibi otantik Uzakdoğu tatlarını samimi bir ortamda sunarken, anime atmosferini andıran dekorasyonuyla farklı bir deneyim yaşatıyor.', '02123521313', 'konoha_etiler.jpg', 'https://www.konoha.com.tr', 'https://instagram.com/konohaetiler', 1, 1, '13:00-22:30', '2025-05-13 15:21:18', '2025-05-26 02:20:48', 3, 133);

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
-- Tablo için tablo yapısı `restaurant_images`
--

CREATE TABLE `restaurant_images` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `uploaded_at` datetime DEFAULT current_timestamp(),
  `is_main` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `restaurant_images`
--

INSERT INTO `restaurant_images` (`id`, `restaurant_id`, `image_url`, `uploaded_at`, `is_main`, `created_at`) VALUES
(10, 6, 'cosa1.jpeg', '2025-05-22 03:07:48', 1, '2025-05-23 02:25:14'),
(11, 6, 'cosa2.jpeg', '2025-05-22 03:07:48', 0, '2025-05-23 02:25:14'),
(12, 6, 'cosa3.jpeg', '2025-05-22 03:07:48', 0, '2025-05-23 02:25:14'),
(13, 2, 'ppang1.jpeg', '2025-05-22 03:16:02', 1, '2025-05-23 02:25:14'),
(14, 2, 'ppang2.jpeg', '2025-05-22 03:16:02', 0, '2025-05-23 02:25:14'),
(15, 2, 'ppang3.jpeg', '2025-05-22 03:16:02', 0, '2025-05-23 02:25:14'),
(17, 3, 'brio2.jpeg', '2025-05-22 03:17:30', 0, '2025-05-23 02:25:14'),
(18, 3, 'brio3.jpeg', '2025-05-22 03:17:30', 0, '2025-05-23 02:25:14'),
(19, 4, 'burgerzmash1.jpg', '2025-05-22 03:19:51', 1, '2025-05-23 02:25:14'),
(20, 4, 'burgerzmash2.jpeg', '2025-05-22 03:19:51', 0, '2025-05-23 02:25:14'),
(21, 4, 'burgerzmash4.jpeg', '2025-05-22 03:19:51', 0, '2025-05-23 02:25:14'),
(22, 5, 'upperdeck1.jpg', '2025-05-22 03:24:55', 1, '2025-05-23 02:25:14'),
(23, 5, 'upperdeck2.jpeg', '2025-05-22 03:24:55', 0, '2025-05-23 02:25:14'),
(24, 5, 'upperdeck3.jpeg', '2025-05-22 03:24:55', 0, '2025-05-23 02:25:14'),
(25, 5, 'upperdeck4.jpeg', '2025-05-22 03:24:55', 0, '2025-05-23 02:25:14'),
(26, 1, 'ranchero1.jpg', '2025-05-22 03:28:35', 1, '2025-05-23 02:25:14'),
(27, 1, 'ranchero2.jpeg', '2025-05-22 03:28:35', 0, '2025-05-23 02:25:14'),
(28, 1, 'ranchero3.jpeg', '2025-05-22 03:28:35', 0, '2025-05-23 02:25:14'),
(29, 1, 'ranchero4.jpeg', '2025-05-22 03:28:35', 0, '2025-05-23 02:25:14'),
(30, 7, 'konoha1.jpg', '2025-05-22 03:44:04', 1, '2025-05-23 02:25:14'),
(31, 7, 'konoha2.jpeg', '2025-05-22 03:44:04', 0, '2025-05-23 02:25:14'),
(32, 7, 'konoha3.jpeg', '2025-05-22 03:44:04', 0, '2025-05-23 02:25:14'),
(33, 3, '682fb25ec2f37_2.jpg', '2025-05-23 02:25:18', 1, '2025-05-23 02:25:18');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `restaurant_menu_items`
--

CREATE TABLE `restaurant_menu_items` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `section_name` varchar(100) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `restaurant_menu_items`
--

INSERT INTO `restaurant_menu_items` (`id`, `restaurant_id`, `section_name`, `name`, `price`, `sort_order`, `created_at`) VALUES
(7, 3, 'Başlangıçlar', 'SARIMSAKLI EKMEK', 410.00, 1, '2025-05-22 02:26:40'),
(8, 3, 'Başlangıçlar', 'KARAMELİZE SOĞAN, MOZARELLA & SARIMSAKLI EKMEK', 485.00, 2, '2025-05-22 02:26:40'),
(9, 3, 'Başlangıçlar', 'DOUGH BALLS', 485.00, 3, '2025-05-22 02:26:40'),
(10, 3, 'Başlangıçlar', 'BRUSCHETTA POMODORO', 485.00, 4, '2025-05-22 02:26:40'),
(11, 3, 'Başlangıçlar', 'BRUSCHETTA GENOVESE', 485.00, 5, '2025-05-22 02:26:40'),
(12, 3, 'Başlangıçlar', 'CROSTINI AL TONNO', 410.00, 6, '2025-05-22 02:26:40'),
(13, 3, 'Salatalar', 'ÜÇ RENK SALATA', 685.00, 1, '2025-05-22 02:26:40'),
(14, 3, 'Salatalar', 'IZGARA TAVUK SALATASI', 825.00, 2, '2025-05-22 02:26:40'),
(15, 3, 'Salatalar', 'TON BALIK SALATA', 825.00, 3, '2025-05-22 02:26:40'),
(16, 3, 'Salatalar', 'BONFİLE SALATASI', 985.00, 4, '2025-05-22 02:26:40'),
(17, 3, 'Salatalar', 'CAPRESE', 710.00, 5, '2025-05-22 02:26:40'),
(18, 3, 'Garnitürler', 'Roka ve parmesan salata', 650.00, 1, '2025-05-22 02:26:40'),
(19, 3, 'Garnitürler', 'Karışık salata', 650.00, 2, '2025-05-22 02:26:40'),
(20, 3, 'Garnitürler', 'Tuscan Patates', 410.00, 3, '2025-05-22 02:26:40'),
(21, 2, 'PPANG TOAST', 'PPANG 101', 235.00, 1, '2025-05-22 02:29:03'),
(22, 2, 'PPANG TOAST', 'PPANG Bulgogi', 315.00, 2, '2025-05-22 02:29:03'),
(23, 2, 'PPANG TOAST', 'PPANG Chicken', 250.00, 3, '2025-05-22 02:29:03'),
(24, 2, 'PPANG TOAST', 'PPANG Crispy Chicken', 260.00, 4, '2025-05-22 02:29:03'),
(25, 2, 'PPANG TOAST', 'PPANG Dana Bacon', 295.00, 5, '2025-05-22 02:29:03'),
(26, 2, 'PPANG TOAST', 'PPANG Domuz Bacon', 305.00, 6, '2025-05-22 02:29:03'),
(27, 2, 'PPANG TOAST', 'PPANG Furter', 325.00, 7, '2025-05-22 02:29:03'),
(28, 2, 'PPANG TOAST', 'PPANG Salmon', 290.00, 8, '2025-05-22 02:29:03'),
(29, 2, 'PPANG TOAST', 'PPANG Shrimp', 280.00, 9, '2025-05-22 02:29:03'),
(30, 2, 'PPANG TOAST', 'PPANG Smashed', 310.00, 10, '2025-05-22 02:29:03'),
(31, 2, 'PPANG TOAST', 'PPANG Turco', 305.00, 11, '2025-05-22 02:29:03'),
(32, 2, 'PPANG TOAST', 'PPANG Turkey', 255.00, 12, '2025-05-22 02:29:03'),
(33, 2, 'PPANG TOAST', 'PPANG Vegan', 285.00, 13, '2025-05-22 02:29:03'),
(34, 2, 'Tatlılar', 'PPANG Bal-Kaymak', 190.00, 1, '2025-05-22 02:29:03'),
(35, 2, 'Tatlılar', 'PPANG Berries', 175.00, 2, '2025-05-22 02:29:03'),
(36, 2, 'Tatlılar', 'PPANG Bomb', 190.00, 3, '2025-05-22 02:29:03'),
(37, 2, 'Tatlılar', 'PPANG Choco', 175.00, 4, '2025-05-22 02:29:03'),
(38, 2, 'Tatlılar', 'PPANG Peanut', 175.00, 5, '2025-05-22 02:29:03'),
(39, 4, 'Burgerler', 'TRIPLE', 1238.00, 1, '2025-05-22 02:31:09'),
(40, 4, 'Burgerler', 'CLASSICO', 1488.00, 2, '2025-05-22 02:31:09'),
(41, 4, 'Burgerler', 'PENTAGON', 1738.00, 3, '2025-05-22 02:31:09'),
(42, 4, 'Çocuk Burgerleri', 'SIMPLE', 1138.00, 1, '2025-05-22 02:31:09'),
(43, 4, 'Çocuk Burgerleri', 'KID', 1038.00, 2, '2025-05-22 02:31:09'),
(44, 4, 'Sosis & Tavuk', 'ZMASH SOSIS', 1038.00, 1, '2025-05-22 02:31:09'),
(45, 4, 'Sosis & Tavuk', 'ZMASH WINGS', 1038.00, 2, '2025-05-22 02:31:09'),
(46, 4, 'Sosis & Tavuk', 'ZMASH G-TENDERS', 1038.00, 3, '2025-05-22 02:31:09'),
(47, 4, 'Fries', 'NORMAL', 688.00, 1, '2025-05-22 02:31:09'),
(48, 5, 'Breakfast', 'Deck Plate', 295.00, 1, '2025-05-22 02:37:35'),
(49, 5, 'Breakfast', 'Sweety Deck Plate', 285.00, 2, '2025-05-22 02:37:35'),
(50, 5, 'Breakfast', 'Fresh Deck Plate', 285.00, 3, '2025-05-22 02:37:35'),
(51, 5, 'Breakfast', 'Egg & Sausage & Smoke', 280.00, 4, '2025-05-22 02:37:35'),
(52, 5, 'Breakfast', 'Egg & Sausage', 270.00, 5, '2025-05-22 02:37:35'),
(53, 5, 'Burger', 'Simple Burger', 240.00, 1, '2025-05-22 02:37:35'),
(54, 5, 'Burger', 'Deck MAC Burger', 245.00, 2, '2025-05-22 02:37:35'),
(55, 5, 'Burger', 'Relish Burger', 240.00, 3, '2025-05-22 02:37:35'),
(56, 5, 'Burger', 'Truffle Burger', 255.00, 4, '2025-05-22 02:37:35'),
(57, 5, 'Burger', 'BBQ Burger', 250.00, 5, '2025-05-22 02:37:35'),
(58, 5, 'Burger', 'Upperdeck Burger', 260.00, 6, '2025-05-22 02:37:35'),
(59, 5, 'Burger', 'Berries Burger', 255.00, 7, '2025-05-22 02:37:35'),
(60, 5, 'Waffle', 'Chicky Caramel Waffle', 260.00, 1, '2025-05-22 02:37:35'),
(61, 5, 'Waffle', 'Apple & Cinnamon - Caramel Waffle', 240.00, 2, '2025-05-22 02:37:35'),
(62, 5, 'Waffle', 'Berries & Ice Cream Waffle', 245.00, 3, '2025-05-22 02:37:35'),
(63, 5, 'Waffle', 'Nutella Waffle', 255.00, 4, '2025-05-22 02:37:35'),
(64, 6, 'Çorba', 'Mercimek', 88.00, 1, '2025-05-21 23:44:55'),
(65, 6, 'Çorba', 'Domates', 88.00, 2, '2025-05-21 23:44:55'),
(66, 6, 'Çorba', 'Bal Kabağı', 88.00, 3, '2025-05-21 23:44:55'),
(67, 6, 'Çorba', 'Brokoli', 88.00, 4, '2025-05-21 23:44:55'),
(68, 6, 'Çorba', 'Minestrone', 88.00, 5, '2025-05-21 23:44:55'),
(69, 6, 'Çorba', 'Ezogelin', 88.00, 6, '2025-05-21 23:44:55'),
(70, 6, 'Çorba', 'Ayran Aşı', 88.00, 7, '2025-05-21 23:44:55'),
(71, 6, 'Bowl Menü', 'Veggy Schnitzel (içecek dahil)', 358.00, 1, '2025-05-21 23:44:55'),
(72, 6, 'Bowl Menü', 'Marrakesh Falafel (içecek dahil)', 338.00, 2, '2025-05-21 23:44:55'),
(73, 6, 'Bowl Menü', 'Classico Tavuk (içecek dahil)', 348.00, 3, '2025-05-21 23:44:55'),
(74, 6, 'Bowl Menü', 'Turco Köfte (içecek dahil)', 388.00, 4, '2025-05-21 23:44:55'),
(75, 6, 'Bowl Menü', 'Crispy Tavuk', 348.00, 5, '2025-05-21 23:44:55'),
(76, 6, 'Tatlılar', 'Çikolatalı Cookie', 68.00, 1, '2025-05-21 23:44:55'),
(77, 6, 'Tatlılar', 'Churros', 98.00, 2, '2025-05-21 23:44:55'),
(78, 6, 'Tatlılar', 'Brownie', 98.00, 3, '2025-05-21 23:44:55'),
(79, 6, 'Tatlılar', 'Banana Bread', 98.00, 4, '2025-05-21 23:44:55'),
(80, 6, 'Tatlılar', 'Granolalı Chia Puding', 98.00, 5, '2025-05-21 23:44:55'),
(81, 6, 'Tatlılar', 'Yer Fıstıklı Mug', 98.00, 6, '2025-05-21 23:44:55'),
(82, 1, 'Çorbalar', 'Caldo De Pollo', 210.00, 1, '2025-05-22 02:56:35'),
(83, 1, 'Çorbalar', 'Sopa De Tortilla', 195.00, 2, '2025-05-22 02:56:35'),
(84, 1, 'Salatalar', 'Mexican Ceasar Salad (Sade)', 445.00, 3, '2025-05-22 02:56:35'),
(85, 1, 'Salatalar', 'Mexican Ceasar Salad (Tavuk)', 495.00, 4, '2025-05-22 02:56:35'),
(86, 1, 'Kokteyller', 'Chilada', 320.00, 5, '2025-05-22 02:56:35'),
(87, 1, 'Kokteyller', 'Michelada', 340.00, 6, '2025-05-22 02:56:35'),
(88, 1, 'Kokteyller', 'Whiskey Smash', 600.00, 7, '2025-05-22 02:56:35'),
(89, 1, 'Kokteyller', 'Paloma', 550.00, 8, '2025-05-22 02:56:35'),
(90, 1, 'Tatlılar', 'Vulcano', 300.00, 9, '2025-05-22 02:56:35'),
(91, 1, 'Tatlılar', 'Ranchero’s Apple Pie', 300.00, 10, '2025-05-22 02:56:35'),
(92, 1, 'Tatlılar', 'Tiramisu Dulce de Leche', 325.00, 11, '2025-05-22 02:56:35'),
(93, 1, 'Tatlılar', 'Brownie Fuego', 325.00, 12, '2025-05-22 02:56:35'),
(94, 1, 'Aperatifler', 'Totopos Con Salsa', 350.00, 13, '2025-05-22 02:56:35'),
(95, 1, 'Aperatifler', 'Cheddar Dip', 390.00, 14, '2025-05-22 02:56:35'),
(96, 1, 'Aperatifler', 'Guacamole Dip', 390.00, 15, '2025-05-22 02:56:35'),
(97, 1, 'Aperatifler', 'Macho Nachos', 490.00, 16, '2025-05-22 02:56:35'),
(98, 1, 'Tacos', 'Street Taco', 650.00, 17, '2025-05-22 02:56:35'),
(99, 1, 'Tacos', 'Taco Rico (Tavuk)', 550.00, 18, '2025-05-22 02:56:35'),
(100, 1, 'Tacos', 'Taco Rico (Et)', 625.00, 19, '2025-05-22 02:56:35'),
(101, 1, 'Tacos', 'Tacos Con Rajas (Tavuk)', 550.00, 20, '2025-05-22 02:56:35'),
(102, 1, 'Tacos', 'Tacos Con Rajas (Et)', 625.00, 21, '2025-05-22 02:56:35'),
(103, 7, NULL, 'Wonton Çorba', 206.00, 0, '2025-05-22 03:55:37'),
(104, 7, NULL, 'Acılı Ekşili Çorba', 189.00, 0, '2025-05-22 03:55:37'),
(105, 7, NULL, 'Deniz Mahsulleri Çorbası', 268.00, 0, '2025-05-22 03:55:37'),
(106, 7, NULL, 'Miso Soup', 254.00, 0, '2025-05-22 03:55:37'),
(107, 7, NULL, 'Sebze Çorbası', 186.00, 0, '2025-05-22 03:55:37'),
(108, 7, NULL, 'Karides Cipsi', 182.00, 0, '2025-05-22 03:55:37'),
(109, 7, NULL, 'Moğol İşi Tavuk', 308.00, 0, '2025-05-22 03:55:37'),
(110, 7, NULL, 'Edamame / Organik Soya Fasulyesi', 190.00, 0, '2025-05-22 03:55:37'),
(111, 7, NULL, 'Acılı Edamame', 205.00, 0, '2025-05-22 03:55:37'),
(112, 7, NULL, 'Atom Karides', 477.00, 0, '2025-05-22 03:55:37'),
(113, 7, NULL, 'Çıtır Karides', 460.00, 0, '2025-05-22 03:55:37'),
(114, 7, NULL, 'Konoha Set (24 pcs)', 1248.00, 0, '2025-05-22 03:55:37'),
(115, 7, NULL, 'Hinata Salmon Lovers (26 pcs)', 1480.00, 0, '2025-05-22 03:55:37'),
(116, 7, NULL, 'Mini Assorted (20 pcs)', 989.00, 0, '2025-05-22 03:55:37'),
(117, 7, NULL, 'Vegetarian Set (18 pcs)', 612.00, 0, '2025-05-22 03:55:37'),
(118, 7, NULL, 'Acıbadem Menü (24 pcs)', 1166.00, 0, '2025-05-22 03:55:37'),
(119, 7, NULL, 'Assorted Set (46 pcs)', 2099.00, 0, '2025-05-22 03:55:37'),
(120, 7, NULL, 'Sushi Deluxe (32 pcs)', 1469.00, 0, '2025-05-22 03:55:37'),
(121, 7, NULL, 'Naruto Menü (26 pcs)', 1136.00, 0, '2025-05-22 03:55:37'),
(122, 7, NULL, 'Tatlı Ekşi Soslu Tavuk', 440.00, 0, '2025-05-22 03:55:37'),
(123, 7, NULL, 'Mançuryan Usulü Tavuk', 406.00, 0, '2025-05-22 03:55:37'),
(124, 7, NULL, 'Zencefilli Soslu Çıtır Tavuk', 452.00, 0, '2025-05-22 03:55:37'),
(125, 7, NULL, 'General Tso Tavuk', 468.00, 0, '2025-05-22 03:55:37'),
(126, 7, NULL, 'Teriyaki Soslu Tavuk', 452.00, 0, '2025-05-22 03:55:37'),
(127, 7, NULL, 'Bademli Tavuk / Almond Chicken', 430.00, 0, '2025-05-22 03:55:37'),
(128, 3, 'starter', 'zeytinyağı', 500.00, 0, '2025-05-23 02:15:32'),
(129, 3, 'starter', 'zeytinyağı', 500.00, 0, '2025-05-23 02:15:38');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `restaurant_owners`
--

CREATE TABLE `restaurant_owners` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `restaurant_owners`
--

INSERT INTO `restaurant_owners` (`id`, `user_id`, `restaurant_id`, `created_at`) VALUES
(1, 25, 3, '2025-05-23 02:01:38');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `mail` varchar(150) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `surname`, `mail`, `phone`, `password`, `birth_date`, `profile_picture`, `created_at`, `updated_at`) VALUES
(1, 'mehmet_yilmaz', NULL, NULL, 'mehmet@example.com', NULL, 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(2, 'ayse_kara', NULL, NULL, 'ayse@example.com', NULL, 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(3, 'veli_dogan', NULL, NULL, 'veli@example.com', NULL, 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(4, 'selin_ozdemir', NULL, NULL, 'selin@example.com', NULL, 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(5, 'cem_aksoy', NULL, NULL, 'cem@example.com', NULL, 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(6, 'nur_can', NULL, NULL, 'nur@example.com', NULL, 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(7, 'hasan_kurt', NULL, NULL, 'hasan@example.com', NULL, 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(8, 'dilan_tas', NULL, NULL, 'dilan@example.com', NULL, 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(9, 'mustafa_aydin', NULL, NULL, 'mustafa@example.com', NULL, 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(10, 'seda_karaca', NULL, NULL, 'seda@example.com', NULL, 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(12, 'zeynep_arslan', NULL, NULL, 'zeynep@example.com', NULL, 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(14, 'burak_demir', NULL, NULL, 'burak@example.com', NULL, 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(15, 'elif_can', NULL, NULL, 'elif@example.com', NULL, 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(16, 'omer_yavuz', NULL, NULL, 'omer@example.com', NULL, 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(17, 'sevim_ozkan', NULL, NULL, 'sevim@example.com', NULL, 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(18, 'deniz_akbas', NULL, NULL, 'deniz@example.com', NULL, 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(19, 'furkan_kaya', NULL, NULL, 'furkan@example.com', NULL, 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(20, 'asli_ay', NULL, NULL, 'asli@example.com', NULL, 'a3a2754f94b4f8c1ca8d29290bc37ba90cedf0e13a9e702a829740835e5ed564', NULL, NULL, '2025-05-13 11:53:57', '2025-05-13 11:53:57'),
(21, 'eylulrag', 'eylül irem', 'hamzaoğlu', 'eylulhmz@outlook.com', '5324961311', 'asddsa', '2001-07-19', NULL, '2025-05-21 21:40:31', '2025-05-22 00:59:58'),
(23, 'Ferit Korhan', NULL, NULL, 'feritk@outlook.com', NULL, 'asddsa', NULL, NULL, '2025-05-22 00:45:05', '2025-05-22 00:45:05'),
(24, 'eşref tek ', 'Arda', 'Kayalar', 'arda@gmail.com', '05332880893', 'arda', '2025-05-24', NULL, '2025-05-22 01:54:43', '2025-05-25 03:13:58'),
(25, 'mehmet istemi', '', '', 'mistemi@gmail.com', '', 'asddsa', NULL, NULL, '2025-05-23 01:26:27', '2025-05-23 01:26:27'),
(26, 'tugra', '', '', 'eylulhmz@stu.khas.edu.tr', '', 'qwerty', NULL, NULL, '2025-05-23 01:42:39', '2025-05-23 01:42:39'),
(27, 'elanur kesdi', '', '', 'elanur@hotmail.com', '', 'asddsa', NULL, NULL, '2025-05-23 01:50:46', '2025-05-23 01:50:46'),
(28, 'ipek gelinçek', '', '', 'ipekmina@gmail.com', '', 'asddsa', NULL, NULL, '2025-05-23 01:51:19', '2025-05-23 01:51:19'),
(29, 'yusuf kazdal', '', '', 'yusuf53@gmail.com', '', 'asddsa', NULL, NULL, '2025-05-23 03:16:04', '2025-05-23 03:16:04'),
(31, 'eylulrag54', '', '', 'eylulhmz6@outlook.com', '', 'asddsa', NULL, NULL, '2025-05-23 03:19:22', '2025-05-23 03:19:22'),
(32, 'aslan', NULL, NULL, 'aslankral@gmail.com', NULL, 'asdasd', NULL, NULL, '2025-05-23 03:20:48', '2025-05-23 03:20:48'),
(33, 'ayaz', NULL, NULL, 'ayaz67@gmail.com', NULL, 'asddsa', NULL, NULL, '2025-05-23 03:22:01', '2025-05-23 03:22:01'),
(34, 'eylül irem', NULL, NULL, 'irem@gmail.com', NULL, 'asddsa', NULL, NULL, '2025-05-23 11:02:29', '2025-05-23 11:02:29'),
(35, 'azra dillitas', NULL, NULL, 'azra1@gmail.com', NULL, 'azra', NULL, NULL, '2025-05-26 01:40:44', '2025-05-26 01:40:44');

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
-- Tablo için indeksler `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- Tablo için indeksler `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_contact_user` (`user_id`);

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
-- Tablo için indeksler `restaurant_images`
--
ALTER TABLE `restaurant_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Tablo için indeksler `restaurant_menu_items`
--
ALTER TABLE `restaurant_menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Tablo için indeksler `restaurant_owners`
--
ALTER TABLE `restaurant_owners`
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
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Tablo için AUTO_INCREMENT değeri `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Tablo için AUTO_INCREMENT değeri `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `counties`
--
ALTER TABLE `counties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

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
-- Tablo için AUTO_INCREMENT değeri `restaurant_images`
--
ALTER TABLE `restaurant_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Tablo için AUTO_INCREMENT değeri `restaurant_menu_items`
--
ALTER TABLE `restaurant_menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- Tablo için AUTO_INCREMENT değeri `restaurant_owners`
--
ALTER TABLE `restaurant_owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
-- Tablo kısıtlamaları `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD CONSTRAINT `fk_contact_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Tablo kısıtlamaları `restaurant_images`
--
ALTER TABLE `restaurant_images`
  ADD CONSTRAINT `restaurant_images_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `restaurant_menu_items`
--
ALTER TABLE `restaurant_menu_items`
  ADD CONSTRAINT `restaurant_menu_items_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `restaurant_owners`
--
ALTER TABLE `restaurant_owners`
  ADD CONSTRAINT `restaurant_owners_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `restaurant_owners_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
