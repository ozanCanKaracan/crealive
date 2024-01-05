-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 05 Oca 2024, 12:01:45
-- Sunucu sürümü: 8.0.31
-- PHP Sürümü: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `cms`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb3_turkish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(3, 'DENEME'),
(5, 'Deneme2');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contents`
--

DROP TABLE IF EXISTS `contents`;
CREATE TABLE IF NOT EXISTS `contents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content_title` varchar(255) COLLATE utf8mb3_turkish_ci NOT NULL,
  `content_category` int NOT NULL,
  `content_language` int NOT NULL,
  `content_desc` varchar(255) COLLATE utf8mb3_turkish_ci NOT NULL,
  `content_text` text COLLATE utf8mb3_turkish_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb3_turkish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`),
  UNIQUE KEY `content_title` (`content_title`),
  KEY `url_2` (`url`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `contents`
--

INSERT INTO `contents` (`id`, `content_title`, `content_category`, `content_language`, `content_desc`, `content_text`, `url`) VALUES
(22, 'Deneme', 3, 1, '', '&lt;p&gt;be23321&lt;/p&gt;', 'ben-bir-insanim-gibi-sayilabilir'),
(23, 'TEST', 5, 3, '', '&lt;p&gt;sdadsa&lt;/p&gt;', 'etiket1-etiket2-etiket3 '),
(24, 'DENEME3', 5, 4, '', '&lt;p&gt;dsadsa&lt;/p&gt;', 'deneme2-etiket1-etiket2-etiket3 '),
(25, 'ETİKET', 3, 4, '', '&lt;p&gt;541165&lt;/p&gt;', 'etiket1-etiket2'),
(26, 'İŞ', 5, 2, 'dsadsada', '&lt;p&gt;12321321&lt;/p&gt;', '231213'),
(27, 'deneme2', 5, 4, '', '&lt;p&gt;32132213&lt;/p&gt;', 'ben-bir-insanim-gibi-sayilabilirr'),
(28, 'deneme5', 3, 2, '', '&lt;p&gt;321&lt;/p&gt;', 'deneme-etiket1-etiket2'),
(29, 'deneme6', 3, 1, '', '&lt;p&gt;sdadsa&lt;/p&gt;', 'dsadsa'),
(30, 'deneme7', 5, 1, '', '&lt;p&gt;dsafsa&lt;/p&gt;', 'sdadsa'),
(31, 'deneme8', 3, 1, '', '&lt;p&gt;dsadsafad&lt;/p&gt;', 'dsadsaf'),
(32, 'deneme9', 5, 1, '', '&lt;p&gt;adsadsafgdgfd&lt;/p&gt;', 'ds'),
(33, 'deneme10', 3, 1, '', '&lt;p&gt;dsafgasdsdsafg&lt;/p&gt;', 'sdadgsagsadg'),
(34, 'LOREM IPSUM', 5, 1, '', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac commodo quam. Sed eget finibus enim. Nulla turpis lacus, semper a augue sit amet, accumsan sodales libero. Duis odio tortor, aliquet a fermentum at, suscipit at elit. In hac habitasse platea dictumst. Vivamus tristique ut lectus ut tempor. Sed eleifend lacus tristique ante pharetra aliquam. Suspendisse fringilla consectetur arcu id lobortis. Cras libero libero, imperdiet non gravida non, hendrerit eu purus. Nullam pellentesque est eu nisl pharetra, quis ullamcorper erat egestas. Pellentesque quis tellus non eros bibendum scelerisque. Morbi sit amet congue metus. Suspendisse eleifend dignissim arcu. Quisque faucibus mollis libero, et luctus tellus imperdiet sed. Duis gravida ligula ut arcu cursus efficitur.&lt;/p&gt;&lt;p&gt;Vestibulum sem mauris, dictum vitae finibus eu, gravida molestie purus. Nulla tempus luctus consequat. Phasellus fringilla lorem et mollis imperdiet. Aliquam malesuada sodales mauris, a imperdiet nisi consequat et. Morbi nec ex a eros molestie luctus. Mauris non venenatis dui. Fusce faucibus tellus est, eu viverra nisl volutpat ac. Nullam non maximus elit. Curabitur et dolor vulputate, tempor nisi et, consectetur massa. Maecenas sollicitudin est sit amet diam condimentum, iaculis placerat nisi finibus. Cras pellentesque et leo ut porttitor. Pellentesque quis rhoncus mauris. Ut vitae elit tempor, ultricies risus vitae, pretium nulla. Nullam aliquam magna eget dui pretium pellentesque.&lt;/p&gt;&lt;p&gt;In feugiat, odio et aliquam sodales, lorem massa accumsan quam, vitae aliquam leo sapien at tortor. Etiam pretium nisi a odio facilisis posuere. Proin et quam viverra, efficitur tellus quis, ornare nisi. Pellentesque vestibulum egestas efficitur. Pellentesque sit amet purus facilisis, vulputate enim vel, sagittis purus. Aenean sed vulputate turpis. Fusce ac lobortis ipsum, nec ultrices nunc. Proin viverra elit eu diam porta, non condimentum massa iaculis.&lt;/p&gt;&lt;p&gt;Aliquam condimentum lorem non eleifend condimentum. Ut volutpat et ante ut congue. Donec a suscipit purus. Nullam varius orci erat, nec auctor tellus efficitur vitae. Duis finibus blandit tempor. Nunc sit amet nunc et est molestie sodales. Duis non metus ante. Aenean ullamcorper blandit libero, ut rhoncus diam congue quis. Vestibulum imperdiet ex sed lorem aliquet, in dictum quam tempor. Praesent auctor congue erat vitae ornare. Quisque facilisis diam et sem imperdiet euismod. Vestibulum quis semper lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.&lt;/p&gt;&lt;p&gt;Ut lacinia auctor tristique. Nulla vitae metus volutpat, eleifend sem sed, consectetur odio. Nullam porttitor mattis libero, faucibus porttitor purus ornare sed. In ac justo at eros iaculis porttitor. Aliquam sit amet viverra sapien. Donec urna nibh, scelerisque at fermentum hendrerit, posuere eget libero. Donec congue sit amet tellus sit amet lacinia. Aenean quis turpis id massa tempor interdum. Vivamus tempor, ipsum quis vestibulum pretium, massa purus tempor nisl, ac ornare nisl sapien vel diam. Proin non laoreet massa.&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;figure class=\\&quot;image\\&quot;&gt;&lt;img style=\\&quot;aspect-ratio:1280/720;\\&quot; src=&quot;uploads/a3.jpg&quot; width=\\&quot;1280\\&quot; height=\\&quot;720\\&quot;&gt;&lt;/figure&gt;', 'lorem-ipsum'),
(36, 'Tes3', 3, 2, 'dsadsa', 'dsadsa', 'lorem-ipsume');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `content_likes`
--

DROP TABLE IF EXISTS `content_likes`;
CREATE TABLE IF NOT EXISTS `content_likes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `content_id` int NOT NULL,
  `content_like` enum('0','1') NOT NULL DEFAULT '0',
  `content_dislike` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `content_likes`
--

INSERT INTO `content_likes` (`id`, `user_id`, `content_id`, `content_like`, `content_dislike`) VALUES
(1, 7, 22, '1', '0'),
(2, 7, 29, '0', '1'),
(3, 8, 22, '1', '0'),
(4, 7, 33, '1', '0'),
(5, 7, 32, '1', '0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lang_name` varchar(255) COLLATE utf8mb3_turkish_ci NOT NULL,
  `lang_name_short` varchar(244) COLLATE utf8mb3_turkish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lang_name` (`lang_name`,`lang_name_short`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `languages`
--

INSERT INTO `languages` (`id`, `lang_name`, `lang_name_short`) VALUES
(3, 'Almanca', 'de'),
(4, 'Fransızca', 'fr'),
(2, 'İngilizce', 'us'),
(1, 'Türkçe', 'tr');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` varchar(255) COLLATE utf8mb3_turkish_ci NOT NULL,
  `page_name` varchar(255) COLLATE utf8mb3_turkish_ci NOT NULL,
  `page_icon` varchar(255) COLLATE utf8mb3_turkish_ci NOT NULL,
  `href` varchar(255) COLLATE utf8mb3_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `pages`
--

INSERT INTO `pages` (`id`, `parent_id`, `page_name`, `page_icon`, `href`) VALUES
(1, '0', 'Roller ve Yetkiler', 'bi bi-wrench', ''),
(2, '1', 'Roller', 'bi bi-circle-fill', 'roles'),
(4, '1', 'Rol Ekle/Kaldır', 'bi bi-circle-fill', 'editRole'),
(6, '0', 'İçerik', 'bi bi-file-earmark-font-fill', ''),
(7, '6', 'İçerik Oluştur', 'bi bi-circle-fill', 'newContent'),
(8, '0', 'Kategori', 'bi bi-tag-fill', ''),
(9, '8', 'Kategori Ekle/Kaldır', 'bi bi-circle-fill', 'editCategory'),
(10, '6', 'İçerikler', 'bi bi-circle-fill', 'contents'),
(11, '5555', 'Sayfa izinleri', '', 'permission'),
(12, '5555', 'Kullanıcı Listesi (Rol)', '', 'userlistRole'),
(13, '5555', 'İçerik Düzenle', '', 'editContent'),
(14, '16', 'Top 5', 'bi bi-circle-fill', 'top_5'),
(15, '5555', 'İçerik Görüntüleme', 'bi bi-circle-fill', 'content'),
(16, '0', 'İstatistik', 'bi bi-clipboard-data', ''),
(17, '16', 'İstatistikler', 'bi bi-circle-fill', 'conversion_rates'),
(20, '6', 'Sizin İçin Önerilenler', 'bi bi-circle-fill', 'recommended');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `permission`
--

DROP TABLE IF EXISTS `permission`;
CREATE TABLE IF NOT EXISTS `permission` (
  `permission_id` int NOT NULL AUTO_INCREMENT,
  `page_id` int NOT NULL,
  `role_id` int NOT NULL,
  `permission_add` enum('0','1') COLLATE utf8mb3_turkish_ci NOT NULL DEFAULT '0',
  `permission_edit` enum('0','1') COLLATE utf8mb3_turkish_ci NOT NULL DEFAULT '0',
  `permission_list` enum('0','1') COLLATE utf8mb3_turkish_ci NOT NULL DEFAULT '0',
  `permission_delete` enum('0','1') COLLATE utf8mb3_turkish_ci NOT NULL DEFAULT '0',
  `permission_view` enum('0','1') COLLATE utf8mb3_turkish_ci NOT NULL DEFAULT '0',
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `permission`
--

INSERT INTO `permission` (`permission_id`, `page_id`, `role_id`, `permission_add`, `permission_edit`, `permission_list`, `permission_delete`, `permission_view`, `updated_date`) VALUES
(1, 2, 1, '1', '1', '1', '1', '1', '2023-12-13 10:33:00'),
(7, 2, 26, '0', '0', '0', '0', '0', '2023-12-11 10:58:11'),
(8, 9, 1, '1', '1', '1', '1', '1', '2023-12-13 10:33:49'),
(9, 7, 1, '1', '1', '1', '1', '1', '2023-12-18 10:05:24'),
(10, 4, 1, '1', '1', '1', '1', '1', '2023-12-13 10:33:17'),
(11, 4, 26, '0', '0', '0', '0', '0', '2023-12-11 10:58:10'),
(12, 9, 26, '0', '0', '0', '0', '0', '2023-12-11 10:58:08'),
(13, 7, 26, '0', '0', '0', '0', '0', '2023-12-11 10:58:10'),
(14, 10, 1, '1', '1', '1', '1', '1', '2023-12-25 10:26:56'),
(15, 11, 1, '1', '1', '1', '1', '1', '2023-12-14 10:11:30'),
(16, 12, 1, '1', '1', '1', '1', '1', '2023-12-14 10:15:11'),
(17, 2, 2, '0', '0', '0', '0', '0', '2023-12-14 10:19:06'),
(18, 4, 2, '0', '0', '0', '0', '0', '2023-12-14 10:19:07'),
(19, 7, 2, '0', '0', '0', '0', '0', '2023-12-14 10:19:07'),
(20, 9, 2, '0', '0', '0', '0', '0', '2023-12-14 10:19:08'),
(21, 10, 2, '0', '0', '0', '0', '0', '2023-12-14 10:19:08'),
(22, 11, 2, '0', '0', '0', '0', '0', '2023-12-14 10:19:09'),
(23, 12, 2, '0', '0', '0', '0', '0', '2023-12-14 10:19:09'),
(24, 13, 1, '1', '1', '1', '1', '1', '2023-12-18 07:53:38'),
(25, 14, 1, '1', '1', '1', '1', '1', '2023-12-25 13:13:29'),
(26, 14, 27, '0', '0', '0', '0', '1', NULL),
(27, 10, 27, '0', '0', '1', '0', '1', '2023-12-26 10:26:21'),
(28, 15, 1, '1', '1', '1', '1', '1', '2023-12-26 10:49:50'),
(29, 15, 27, '0', '0', '0', '0', '1', NULL),
(30, 17, 1, '1', '1', '1', '1', '1', '2024-01-04 15:00:08'),
(31, 20, 1, '1', '1', '1', '1', '1', '2024-01-04 15:00:05');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) COLLATE utf8mb3_turkish_ci NOT NULL,
  `tr` enum('0','1') COLLATE utf8mb3_turkish_ci NOT NULL DEFAULT '0',
  `us` enum('0','1') COLLATE utf8mb3_turkish_ci NOT NULL DEFAULT '0',
  `de` enum('0','1') COLLATE utf8mb3_turkish_ci NOT NULL DEFAULT '0',
  `fr` enum('0','1') COLLATE utf8mb3_turkish_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `tr`, `us`, `de`, `fr`) VALUES
(1, 'Admin', '1', '1', '1', '1'),
(2, 'Moderator', '0', '1', '0', '0'),
(27, 'Okuyucu', '1', '0', '0', '0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stats`
--

DROP TABLE IF EXISTS `stats`;
CREATE TABLE IF NOT EXISTS `stats` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `view_count` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `content_id_2` (`content_id`),
  KEY `content_id` (`content_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `stats`
--

INSERT INTO `stats` (`id`, `content_id`, `view_count`) VALUES
(1, 26, 4),
(2, 28, 1),
(3, 23, 1),
(4, 24, 2),
(5, 22, 24),
(6, 29, 9),
(7, 30, 6),
(8, 31, 3),
(9, 32, 2),
(10, 33, 2),
(11, 34, 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(255) COLLATE utf8mb3_turkish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_name` (`tag_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `tag`
--

INSERT INTO `tag` (`id`, `tag_name`) VALUES
(1, 'etiket1'),
(2, 'etiket2'),
(3, 'etiket3 '),
(4, 'etiket4'),
(5, 'etiket5'),
(6, 'etiket6');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tag_category`
--

DROP TABLE IF EXISTS `tag_category`;
CREATE TABLE IF NOT EXISTS `tag_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tag_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `tag_category`
--

INSERT INTO `tag_category` (`id`, `tag_id`, `category_id`) VALUES
(7, 1, 3),
(8, 1, 5),
(9, 2, 3),
(10, 2, 5),
(11, 3, 5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `texts`
--

DROP TABLE IF EXISTS `texts`;
CREATE TABLE IF NOT EXISTS `texts` (
  `text_id` int NOT NULL AUTO_INCREMENT,
  `text` varchar(255) COLLATE utf8mb3_turkish_ci NOT NULL,
  `language_id` int NOT NULL,
  PRIMARY KEY (`text_id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `texts`
--

INSERT INTO `texts` (`text_id`, `text`, `language_id`) VALUES
(1, 'Roller ve Yetkiler', 1),
(2, 'Ayarlar', 1),
(3, 'Sayfalar', 1),
(4, 'İçerik', 1),
(5, 'Kategori', 1),
(6, 'Roller', 1),
(7, 'Rol Ekle/Kaldır', 1),
(8, 'İçerik Oluştur', 1),
(9, 'İçerikler', 1),
(10, 'Kategori Ekle/Kaldır', 1),
(11, 'Türkçe', 1),
(12, 'İngilizce', 1),
(13, 'Almanca', 1),
(14, 'Fransızca', 1),
(15, 'Rol Kontrol Paneli', 1),
(16, 'Rol Adı', 1),
(17, 'Kullanıcılar', 1),
(18, 'İzinler', 1),
(19, 'Kişi Listesi', 1),
(20, 'Sayfa İzinleri', 1),
(21, 'Rol Oluştur', 1),
(23, 'Rol Kaldır', 1),
(24, 'Rolleri Listele', 1),
(25, 'Rol Seçiniz', 1),
(26, 'Oluştur', 1),
(27, 'Kaldır', 1),
(28, 'Yeni İçerik', 1),
(29, 'İçerik Dili', 1),
(31, 'Kategori Seçiniz', 1),
(32, 'Başlık', 1),
(33, 'Etiket Seç', 1),
(34, 'URL Özelleştir', 1),
(35, 'Yada', 1),
(36, 'Otomatik URL', 1),
(37, 'Kategori Gözüksün', 1),
(38, 'Etiket Gözüksün ', 1),
(39, 'İçerik Yazısı', 1),
(40, 'Dil Seçiniz', 1),
(41, 'Kategoriye Göre Filtrele', 1),
(42, 'Dile Göre Filtrele', 1),
(43, 'İşlemler', 1),
(44, 'Düzenle', 1),
(45, 'Kategori Oluştur', 1),
(46, 'Kategori Adı', 1),
(47, 'Kategori Kaldır', 1),
(48, 'Kategori Listele', 1),
(49, 'Yetki Kontrol Paneli', 1),
(50, 'Ekleme', 1),
(51, 'Silme', 1),
(52, 'Düzenleme', 1),
(53, 'Listeleme', 1),
(54, 'Görüntüleme', 1),
(56, 'Ad Soyad', 1),
(57, 'Listesi', 1),
(58, 'Görüntüle', 1),
(59, 'İstatistikler', 1),
(60, 'Geri Dönüş Oranları', 1),
(61, 'Tüm Hakları Saklıdır', 1),
(62, 'Beğeni Sayısı', 1),
(63, 'Beğenilmeme Sayısı', 1),
(64, 'Filtrele', 1),
(65, 'Filtre Seçin', 1),
(66, 'En Çok Dönüşüm Alan', 1),
(67, 'En Çok Ziyaret Edilen', 1),
(68, 'İstatistik', 1),
(69, 'Görüntülenme Sayısı', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `translations`
--

DROP TABLE IF EXISTS `translations`;
CREATE TABLE IF NOT EXISTS `translations` (
  `translation_id` int NOT NULL AUTO_INCREMENT,
  `text_id` int NOT NULL,
  `translated_text` text COLLATE utf8mb3_turkish_ci NOT NULL,
  `language_id` int NOT NULL,
  PRIMARY KEY (`translation_id`),
  KEY `translation_id` (`translation_id`),
  KEY `text_id` (`text_id`),
  KEY `translation_id_2` (`translation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `translations`
--

INSERT INTO `translations` (`translation_id`, `text_id`, `translated_text`, `language_id`) VALUES
(1, 1, 'Roles and Permissions', 2),
(2, 2, 'Settings', 2),
(3, 3, 'Pages', 2),
(4, 4, 'Content', 2),
(5, 5, 'Category', 2),
(6, 6, 'Roles', 2),
(7, 7, 'Role Add/Remove', 2),
(8, 8, 'Create Content', 2),
(9, 9, 'Contents', 2),
(10, 10, 'Category Add/Remove', 2),
(11, 11, 'Turkish', 2),
(12, 12, 'English', 2),
(13, 13, 'German', 2),
(14, 14, 'French', 2),
(15, 15, 'Role Management Panel', 2),
(16, 16, 'Role Name', 2),
(17, 17, 'Users', 2),
(18, 18, 'Permissions', 2),
(19, 19, 'User List', 2),
(20, 20, 'Page Permission', 2),
(21, 21, 'Create Role', 2),
(22, 22, 'Role Name', 2),
(23, 23, 'Remove Role', 2),
(24, 24, 'List Roles', 2),
(25, 25, 'Select a Role', 2),
(26, 26, 'Create', 2),
(27, 27, 'Remove', 2),
(28, 28, 'New Content', 2),
(29, 29, 'Content Language', 2),
(30, 40, 'Select a Language', 2),
(31, 31, 'Select a Category', 2),
(32, 32, 'Title', 2),
(33, 33, 'Select Tag', 2),
(34, 35, 'OR', 2),
(35, 36, 'Automatic URL', 2),
(36, 37, 'Show Categories', 2),
(37, 38, 'Show Tag', 2),
(38, 34, 'Customize URL', 2),
(39, 39, 'Content Text', 2),
(40, 41, 'Filter by Category', 2),
(41, 42, 'Filter by Language', 2),
(42, 43, 'Process', 2),
(43, 44, 'Edit', 2),
(44, 45, 'Create Category', 2),
(45, 46, 'Category Name', 2),
(46, 47, 'Remove Category', 2),
(47, 48, 'List Category', 2),
(48, 49, 'Permission Control Panel', 2),
(49, 50, 'Add', 2),
(50, 51, 'Delete', 2),
(51, 52, 'Edit', 2),
(52, 53, 'List', 2),
(53, 54, 'View', 2),
(54, 56, 'Name and Surname', 2),
(55, 57, 'List', 2),
(56, 58, 'View', 2),
(57, 59, 'Stats', 2),
(58, 60, 'Conversion Rates', 2),
(59, 61, 'All Rights Reserved', 2),
(60, 62, 'Likes', 2),
(61, 63, 'Dislike', 2),
(62, 64, 'Filter', 2),
(63, 65, 'Select a Filter', 2),
(64, 66, 'Most Converted', 2),
(65, 67, 'Most Visited', 2),
(66, 68, 'Statistic', 2),
(67, 69, 'Views ', 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_turkish_ci NOT NULL,
  `language_id` int NOT NULL,
  `phone` varchar(255) COLLATE utf8mb3_turkish_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb3_turkish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb3_turkish_ci NOT NULL,
  `role_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`),
  UNIQUE KEY `phone` (`phone`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `language_id`, `phone`, `mail`, `password`, `role_id`) VALUES
(7, 'Ozan', 1, '5359427311', 'ozan@crealive.net', '96de4eceb9a0c2b9b52c0b618819821b', 1),
(8, 'Ozan Can', 1, '5616515616', 'd@d.com', '96de4eceb9a0c2b9b52c0b618819821b', 27);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
