-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 24 Oca 2024, 11:53:06
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
  `content_title` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `content_category` int NOT NULL,
  `content_language` int NOT NULL,
  `content_desc` varchar(255) COLLATE utf8mb3_turkish_ci NOT NULL,
  `content_text` text COLLATE utf8mb3_turkish_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb3_turkish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`),
  UNIQUE KEY `content_title` (`content_title`),
  KEY `url_2` (`url`),
  KEY `fk_contents_languageID` (`content_language`),
  KEY `fk_contents_categoryID` (`content_category`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

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
(36, 'Tes3', 3, 2, 'dsadsa', 'dsadsa', 'lorem-ipsume'),
(37, 'banana of fruit', 5, 2, '', '&lt;p&gt;banana of fruit banana of fruit banana of fruit&lt;/p&gt;', 'banana-of-fruit'),
(38, 'banana of fruit translateLanguage translateLanguag', 3, 2, '', '&lt;p&gt;banana of fruit banana of fruit banana of fruit banana of fruit&lt;/p&gt;', 'banana-of-fruittranslatelanguage'),
(39, 'this is translated title', 3, 2, '', '&lt;p&gt;this is translated text this is translated text this is translated text this is translated text&amp;nbsp;&lt;/p&gt;', 'api-test-url'),
(40, 'Deneme Başlığıdır', 3, 1, '', '&lt;p&gt;güzel çay ve simit&amp;nbsp;&lt;/p&gt;', 'deneme-'),
(41, 'denemesad', 5, 1, '', '&lt;p&gt;güzel çay ve simit&lt;/p&gt;', 'deneme2-etiket1-etiket2-etiket3 -1704875872-1'),
(42, 'Fransızca', 3, 1, '', '&lt;p&gt;bu dil almancadır&lt;/p&gt;', 'apideneme'),
(43, 'Almanca içeriktir', 3, 1, '', '&lt;p&gt;Bu almanca bir içeriktir.&lt;/p&gt;', 'deneme-etiket1-etiket2-1704884577-1'),
(44, 'BU fransızca başlık', 5, 1, '', '&lt;p&gt;BU fransızca içerik&lt;/p&gt;', 'bu-fransizca-url'),
(45, 'fransızca başlık kullanımı', 5, 1, '', '&lt;p&gt;fransızca içeriktir&lt;/p&gt;', 'fransizca-baslik-kullanimi'),
(46, 'Translated test for turkish title', 3, 2, '', '&lt;p&gt;Translated test for turkish text&amp;nbsp;&lt;/p&gt;', 'deneme--1705325881-1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lang_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `lang_name_short` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `status` tinyint NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lang_name` (`lang_name`,`lang_name_short`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `languages`
--

INSERT INTO `languages` (`id`, `lang_name`, `lang_name_short`, `status`) VALUES
(1, 'Türkçe', 'tr', 1),
(2, 'İngilizce', 'en', 1),
(3, 'Almanca', 'de', 1),
(4, 'Fransızca', 'fr', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `language_permission`
--

DROP TABLE IF EXISTS `language_permission`;
CREATE TABLE IF NOT EXISTS `language_permission` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `language_id` int NOT NULL,
  `status` tinyint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user` (`user_id`),
  KEY `fk_languageid_langPermission` (`language_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `language_permission`
--

INSERT INTO `language_permission` (`id`, `user_id`, `language_id`, `status`) VALUES
(6, 8, 1, 1),
(7, 8, 2, 0),
(8, 7, 1, 1),
(9, 7, 2, 1),
(10, 8, 4, 0),
(11, 8, 3, 0),
(12, 7, 3, 1),
(13, 7, 4, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int NOT NULL,
  `page_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `page_icon` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `property` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci DEFAULT NULL,
  `href` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `pages`
--

INSERT INTO `pages` (`id`, `parent_id`, `page_name`, `page_icon`, `property`, `href`) VALUES
(1, 0, 'Roller ve Yetkiler', 'bi bi-wrench', NULL, ''),
(2, 1, 'Roller', 'bi bi-circle-fill', 'list', 'roles'),
(4, 1, 'Rol Ekle/Kaldır', 'bi bi-circle-fill', 'list', 'editRole'),
(6, 0, 'İçerik', 'bi bi-file-earmark-font-fill', NULL, ''),
(7, 6, 'İçerik Oluştur', 'bi bi-circle-fill', 'add', 'newContent'),
(8, 0, 'Kategori', 'bi bi-tag-fill', NULL, ''),
(9, 8, 'Kategori Ekle/Kaldır', 'bi bi-circle-fill', 'list', 'editCategory'),
(10, 6, 'İçerikler', 'bi bi-circle-fill', 'list', 'contents'),
(11, 1, 'Sayfa izinleri', '', '0', 'permission'),
(12, 1, 'Kullanıcı Listesi (Rol)', '', '0', 'userlistRole'),
(13, 6, 'İçerik Düzenle', '', '0', 'editContent'),
(14, 16, 'Top 5', 'bi bi-circle-fill', 'list', 'top_5'),
(15, 6, 'İçerik Görüntüleme', 'bi bi-circle-fill', '0', 'content'),
(16, 0, 'İstatistik', 'bi bi-clipboard-data', NULL, ''),
(17, 16, 'İstatistikler', 'bi bi-circle-fill', 'list', 'conversion_rates'),
(20, 6, 'Sizin İçin Önerilenler', 'bi bi-circle-fill', 'list', 'recommended'),
(22, 0, 'Dil Seçenekleri', 'bi bi-bookmarks-fill', NULL, ''),
(23, 22, 'Dil Yönetimi', 'bi bi-circle-fill', 'list', 'language');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `permission`
--

DROP TABLE IF EXISTS `permission`;
CREATE TABLE IF NOT EXISTS `permission` (
  `permission_id` int NOT NULL AUTO_INCREMENT,
  `page_id` int NOT NULL,
  `role_id` int NOT NULL,
  `language_id` int NOT NULL,
  `permission_add` tinyint NOT NULL DEFAULT '0',
  `permission_edit` tinyint NOT NULL DEFAULT '0',
  `permission_list` tinyint NOT NULL DEFAULT '0',
  `permission_delete` tinyint NOT NULL DEFAULT '0',
  `permission_view` tinyint NOT NULL DEFAULT '0',
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`permission_id`),
  KEY `fk_permission_roleID` (`role_id`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `permission`
--

INSERT INTO `permission` (`permission_id`, `page_id`, `role_id`, `language_id`, `permission_add`, `permission_edit`, `permission_list`, `permission_delete`, `permission_view`, `updated_date`) VALUES
(68, 6, 1, 1, 1, 1, 1, 1, 1, '2024-01-23 08:42:18'),
(69, 6, 1, 2, 1, 1, 1, 1, 1, '2024-01-23 08:41:22'),
(70, 6, 1, 3, 1, 1, 1, 1, 1, '2024-01-18 14:42:30'),
(71, 6, 1, 4, 1, 1, 1, 1, 1, '2024-01-18 14:42:32'),
(72, 1, 1, 0, 1, 1, 1, 1, 1, '2024-01-23 10:50:47'),
(73, 3, 1, 0, 1, 1, 1, 1, 1, '2024-01-18 11:17:46'),
(74, 8, 1, 0, 1, 1, 1, 1, 1, '2024-01-18 11:57:13'),
(75, 16, 1, 0, 1, 1, 1, 1, 1, '2024-01-18 12:16:08'),
(76, 22, 1, 0, 1, 1, 1, 1, 1, '2024-01-18 11:31:40');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Moderator'),
(27, 'Okuyucu');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stats`
--

DROP TABLE IF EXISTS `stats`;
CREATE TABLE IF NOT EXISTS `stats` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `view_count` int NOT NULL,
  `content_likes` int NOT NULL,
  `content_dislikes` int NOT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `content_id_2` (`content_id`),
  KEY `content_id` (`content_id`),
  KEY `content_likes` (`content_likes`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `stats`
--

INSERT INTO `stats` (`id`, `content_id`, `view_count`, `content_likes`, `content_dislikes`, `updated_date`) VALUES
(1, 26, 5, 0, 0, '2023-01-23 11:46:11'),
(2, 28, 2, 0, 0, '2023-01-23 11:46:11'),
(3, 23, 1, 0, 0, '2023-01-23 11:46:11'),
(4, 24, 2, 0, 0, '2023-01-23 11:46:11'),
(5, 22, 27, 1, 0, '2024-01-23 11:46:11'),
(6, 29, 10, 0, 0, '2023-01-23 11:46:11'),
(7, 30, 7, 0, 0, '2024-01-23 11:26:01'),
(8, 31, 3, 0, 0, '2023-01-23 11:46:11'),
(9, 32, 3, 0, 0, '2024-01-23 11:52:28'),
(10, 33, 2, 0, 0, '2023-01-23 11:46:11'),
(11, 34, 2, 0, 0, '2023-01-23 11:46:11'),
(12, 41, 1, 0, 0, '2023-01-23 11:46:11'),
(13, 40, 1, 1, 0, '2024-01-23 11:46:11'),
(14, 45, 1, 1, 0, '2023-01-23 11:46:11'),
(15, 44, 1, 1, 0, '2023-01-23 11:46:11'),
(16, 43, 1, 1, 1, '2023-01-23 11:46:11'),
(17, 42, 1, 0, 1, '2024-01-23 11:46:11');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
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
  PRIMARY KEY (`id`),
  KEY `fk_tag_category_tagID` (`tag_id`),
  KEY `fk_tag_category_categoryID` (`category_id`)
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
  PRIMARY KEY (`text_id`),
  KEY `fk_texts_languageID` (`language_id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

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
(69, 'Görüntülenme Sayısı', 1),
(70, 'Sizin İçin Önerilenler', 1),
(71, 'Dil Yönetimi', 1),
(72, 'Dil Seçenekleri', 1),
(73, 'Yeni Dil Paketi Ekle', 1),
(74, 'Kaydet', 1),
(75, 'Dil Seç', 1),
(76, 'Dil Adı', 1),
(77, 'Kısa Adı', 1),
(78, 'Eklemek İstediğiniz Dili Seçiniz', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `translated_contents`
--

DROP TABLE IF EXISTS `translated_contents`;
CREATE TABLE IF NOT EXISTS `translated_contents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `content_id` int NOT NULL,
  `language_id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_translated` (`user_id`),
  KEY `fk_translated_contents_contentID` (`content_id`),
  KEY `fk_translated_contents_languageID` (`language_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `translated_contents`
--

INSERT INTO `translated_contents` (`id`, `user_id`, `content_id`, `language_id`, `title`, `text`) VALUES
(1, 7, 39, 1, 'bu çevrilmiş başlık', '<p>bu çevrilmiş metin bu çevrilmiş metin bu çevrilmiş metin bu çevrilmiş metin</p>'),
(2, 7, 42, 3, 'Französisch', '<p>Diese Sprache ist Deutsch</p>'),
(3, 7, 43, 3, 'Der Inhalt ist auf Deutsch', '<p>Dies ist deutscher Inhalt.</p>'),
(4, 7, 44, 4, 'C&#39;est le titre français', '<p>CECI est du contenu français</p>'),
(5, 7, 45, 4, 'Utilisation de titres français', '<p>le contenu est en français</p>'),
(6, 7, 46, 1, 'Türkçe başlık için çeviri testi', '<p>Türkçe metin için çeviri testi</p>');

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
  KEY `translation_id_2` (`translation_id`),
  KEY `fk_translations_languageID` (`language_id`)
) ENGINE=InnoDB AUTO_INCREMENT=376 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `translations`
--

INSERT INTO `translations` (`translation_id`, `text_id`, `translated_text`, `language_id`) VALUES
(1, 1, 'Roles and Powers', 2),
(2, 2, 'Settings', 2),
(3, 3, 'Pages', 2),
(4, 4, 'Contents', 2),
(5, 5, 'Category', 2),
(6, 6, 'Roller', 2),
(7, 7, 'Add/Remove Roles', 2),
(8, 8, 'Create Content', 2),
(9, 9, 'Contents', 2),
(10, 10, 'Add/Remove Categories', 2),
(11, 11, 'Turkish', 2),
(12, 12, 'English', 2),
(13, 13, 'German', 2),
(14, 14, 'French', 2),
(15, 15, 'Role Control Panels', 2),
(16, 16, 'Role Name', 2),
(17, 17, 'Users', 2),
(18, 18, 'Permissions', 2),
(19, 19, 'Contact List', 2),
(20, 20, 'Page Permissions', 2),
(21, 21, 'Create Role', 2),
(22, 23, 'Remove Role', 2),
(23, 24, 'Rollers Lists', 2),
(24, 25, 'Select Role', 2),
(25, 26, 'Create', 2),
(26, 27, 'Remove', 2),
(27, 28, 'New Content', 2),
(28, 29, 'Content Language', 2),
(29, 31, 'Select Category', 2),
(30, 32, 'Title', 2),
(31, 33, 'Select Tag', 2),
(32, 34, 'Customize URL', 2),
(33, 35, 'Throw away', 2),
(34, 36, 'Automatic URL', 2),
(35, 37, 'Show Category', 2),
(36, 38, 'Let the Label Appear', 2),
(37, 39, 'Content Article', 2),
(38, 40, 'Select Language', 2),
(39, 41, 'Filter by Category', 2),
(40, 42, 'Filter by Language', 2),
(41, 43, 'Transactions', 2),
(42, 44, 'Edit', 2),
(43, 45, 'Create Category', 2),
(44, 46, 'Category Name', 2),
(45, 47, 'Remove Category', 2),
(46, 48, 'Kategori Lists', 2),
(47, 49, 'Authorization Control Panel', 2),
(48, 50, 'Adding', 2),
(49, 51, 'Eyes', 2),
(50, 52, 'Arrangement', 2),
(51, 53, 'Listing', 2),
(52, 54, 'Views', 2),
(53, 56, 'Ad Soyad', 2),
(54, 57, 'List', 2),
(55, 58, 'View', 2),
(56, 59, 'Statistics', 2),
(57, 60, 'Return Rates', 2),
(58, 61, 'All rights reserved', 2),
(59, 62, 'Number of Likes', 2),
(60, 63, 'Number of Dislikes', 2),
(61, 64, 'The filters', 2),
(62, 65, 'Select Filter', 2),
(63, 66, 'Most Converted', 2),
(64, 67, 'Most Visited', 2),
(65, 68, 'Statistics', 2),
(66, 69, 'Number of Views', 2),
(67, 70, 'Recommended for You', 2),
(68, 71, 'Language Management', 2),
(69, 72, 'Language options', 2),
(70, 73, 'Add New Language Pack', 2),
(71, 74, 'Save', 2),
(72, 75, 'Select Language', 2),
(73, 76, 'Language Name', 2),
(74, 77, 'Short Name', 2),
(75, 78, 'Select the Language You Want to Add', 2),
(76, 1, 'Rollen und Befugnisse', 3),
(77, 2, 'Einstellungen', 3),
(78, 3, 'Seiten', 3),
(79, 4, 'Inhalt', 3),
(80, 5, 'Kategorie', 3),
(81, 6, 'Rolle', 3),
(82, 7, 'Rollen hinzufügen/entfernen', 3),
(83, 8, 'Inhalte erstellen', 3),
(84, 9, 'Inhalt', 3),
(85, 10, 'Kategorien hinzufügen/entfernen', 3),
(86, 11, 'Türkisch', 3),
(87, 12, 'Englisch', 3),
(88, 13, 'Deutsch', 3),
(89, 14, 'Französisch', 3),
(90, 15, 'Rollenkontrollfelder', 3),
(91, 16, 'Rollenname', 3),
(92, 17, 'Benutzer', 3),
(93, 18, 'Berechtigungen', 3),
(94, 19, 'Kontaktliste', 3),
(95, 20, 'Seitenberechtigungen', 3),
(96, 21, 'Rolle erstellen', 3),
(97, 23, 'Rolle entfernen', 3),
(98, 24, 'Rollenlisten', 3),
(99, 25, 'Wählen Sie Rolle aus', 3),
(100, 26, 'Erstellen', 3),
(101, 27, 'Entfernen', 3),
(102, 28, 'Neuer Inhalt', 3),
(103, 29, 'Inhaltssprache', 3),
(104, 31, 'Kategorie wählen', 3),
(105, 32, 'Titel', 3),
(106, 33, 'Wählen Sie Tag aus', 3),
(107, 34, 'URL anpassen', 3),
(108, 35, 'Wegwerfen', 3),
(109, 36, 'Automatische URL', 3),
(110, 37, 'Kategorie anzeigen', 3),
(111, 38, 'Lassen Sie das Etikett erscheinen', 3),
(112, 39, 'Inhaltsartikel', 3),
(113, 40, 'Sprache auswählen', 3),
(114, 41, 'Nach Kategorie filtern', 3),
(115, 42, 'Nach Sprache filtern', 3),
(116, 43, 'Transaktionen', 3),
(117, 44, 'Bearbeiten', 3),
(118, 45, 'Kategorie erstellen', 3),
(119, 46, 'Kategoriename', 3),
(120, 47, 'Kategorie entfernen', 3),
(121, 48, 'Kategori-Listen', 3),
(122, 49, 'Autorisierungskontrollfeld', 3),
(123, 50, 'Hinzufügen', 3),
(124, 51, 'Augen', 3),
(125, 52, 'Anordnung', 3),
(126, 53, 'Auflistung', 3),
(127, 54, 'Ansichten', 3),
(128, 56, 'Ad Soyad', 3),
(129, 57, 'Aufführen', 3),
(130, 58, 'Sicht', 3),
(131, 59, 'Statistiken', 3),
(132, 60, 'Rücklaufquoten', 3),
(133, 61, 'Alle Rechte vorbehalten', 3),
(134, 62, 'Anzahl der Likes', 3),
(135, 63, 'Anzahl der Abneigungen', 3),
(136, 64, 'Die Filter', 3),
(137, 65, 'Wählen Sie Filter', 3),
(138, 66, 'Am meisten konvertiert', 3),
(139, 67, 'Meist besuchte', 3),
(140, 68, 'Statistiken', 3),
(141, 69, 'Anzahl der Ansichten', 3),
(142, 70, 'Für dich empfohlen', 3),
(143, 71, 'Sprachmanagement', 3),
(144, 72, 'Sprachoptionen', 3),
(145, 73, 'Neues Sprachpaket hinzufügen', 3),
(146, 74, 'Speichern', 3),
(147, 75, 'Sprache auswählen', 3),
(148, 76, 'Sprache Name', 3),
(149, 77, 'Kurzer Name', 3),
(150, 78, 'Wählen Sie die Sprache aus, die Sie hinzufügen möchten', 3),
(301, 1, 'Rôles et pouvoirs', 4),
(302, 2, 'Paramètres', 4),
(303, 3, 'Pages', 4),
(304, 4, 'Contenu', 4),
(305, 5, 'Catégorie', 4),
(306, 6, 'Rouleau', 4),
(307, 7, 'Ajouter/Supprimer des rôles', 4),
(308, 8, 'Créer du contenu', 4),
(309, 9, 'Contenu', 4),
(310, 10, 'Ajouter/Supprimer des catégories', 4),
(311, 11, 'turc', 4),
(312, 12, 'Anglais', 4),
(313, 13, 'Allemand', 4),
(314, 14, 'Français', 4),
(315, 15, 'Panneaux de contrôle de rôle', 4),
(316, 16, 'Nom de rôle', 4),
(317, 17, 'Utilisateurs', 4),
(318, 18, 'Autorisations', 4),
(319, 19, 'Liste de contacts', 4),
(320, 20, 'Autorisations des pages', 4),
(321, 21, 'Créer un rôle', 4),
(322, 23, 'Supprimer le rôle', 4),
(323, 24, 'Listes de rouleaux', 4),
(324, 25, 'Sélectionnez un rôle', 4),
(325, 26, 'Créer', 4),
(326, 27, 'Retirer', 4),
(327, 28, 'Nouveau contenu', 4),
(328, 29, 'Langue du contenu', 4),
(329, 31, 'Choisir une catégorie', 4),
(330, 32, 'Titre', 4),
(331, 33, 'Sélectionnez la balise', 4),
(332, 34, 'Personnaliser l&#39;URL', 4),
(333, 35, 'Jeter', 4),
(334, 36, 'URL automatique', 4),
(335, 37, 'Afficher la catégorie', 4),
(336, 38, 'Laissez l&#39;étiquette apparaître', 4),
(337, 39, 'Contenu de l&#39;article', 4),
(338, 40, 'Choisir la langue', 4),
(339, 41, 'Filtrer par catégorie', 4),
(340, 42, 'Filtrer par langue', 4),
(341, 43, 'Transactions', 4),
(342, 44, 'Modifier', 4),
(343, 45, 'Créer une catégorie', 4),
(344, 46, 'Nom de catégorie', 4),
(345, 47, 'Supprimer la catégorie', 4),
(346, 48, 'Listes de catégories', 4),
(347, 49, 'Panneau de contrôle d&#39;autorisation', 4),
(348, 50, 'Ajouter', 4),
(349, 51, 'Yeux', 4),
(350, 52, 'Arrangement', 4),
(351, 53, 'Référencement', 4),
(352, 54, 'Vues', 4),
(353, 56, 'Annonce Soyad', 4),
(354, 57, 'Liste', 4),
(355, 58, 'Voir', 4),
(356, 59, 'Statistiques', 4),
(357, 60, 'Taux de retour', 4),
(358, 61, 'Tous droits réservés', 4),
(359, 62, 'Nombre de J&#39;aime', 4),
(360, 63, 'Nombre de Je n&#39;aime pas', 4),
(361, 64, 'Les filtres', 4),
(362, 65, 'Sélectionnez un filtre', 4),
(363, 66, 'Les plus convertis', 4),
(364, 67, 'Le plus visité', 4),
(365, 68, 'Statistiques', 4),
(366, 69, 'Nombre de vues', 4),
(367, 70, 'Recommandé pour vous', 4),
(368, 71, 'Gestion des langues', 4),
(369, 72, 'Options de langue', 4),
(370, 73, 'Ajouter un nouveau pack de langue', 4),
(371, 74, 'Sauvegarder', 4),
(372, 75, 'Choisir la langue', 4),
(373, 76, 'Nom de la langue', 4),
(374, 77, 'Nom court', 4),
(375, 78, 'Sélectionnez la langue que vous souhaitez ajouter', 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_turkish_ci NOT NULL,
  `language_id` int NOT NULL,
  `phone` varchar(12) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `mail` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `role_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`),
  UNIQUE KEY `phone` (`phone`),
  KEY `fk_users_roleID` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `language_id`, `phone`, `mail`, `password`, `role_id`) VALUES
(7, 'Ozan', 1, '5359427311', 'ozan@crealive.net', '96de4eceb9a0c2b9b52c0b618819821b', 1),
(8, 'Ozan Can', 1, '5616515616', 'd@d.com', '96de4eceb9a0c2b9b52c0b618819821b', 27),
(9, 'Ozan Can', 1, '5394271561', 'a@a.com', '96de4eceb9a0c2b9b52c0b618819821b', 27);

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `fk_contents_categoryID` FOREIGN KEY (`content_category`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `fk_contents_languageID` FOREIGN KEY (`content_language`) REFERENCES `languages` (`id`);

--
-- Tablo kısıtlamaları `language_permission`
--
ALTER TABLE `language_permission`
  ADD CONSTRAINT `fk_languageid_langPermission` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `fk_permission_roleID` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Tablo kısıtlamaları `stats`
--
ALTER TABLE `stats`
  ADD CONSTRAINT `fk_stats_contentID` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`);

--
-- Tablo kısıtlamaları `tag_category`
--
ALTER TABLE `tag_category`
  ADD CONSTRAINT `fk_tag_category_categoryID` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `fk_tag_category_tagID` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`);

--
-- Tablo kısıtlamaları `texts`
--
ALTER TABLE `texts`
  ADD CONSTRAINT `fk_texts_languageID` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`);

--
-- Tablo kısıtlamaları `translated_contents`
--
ALTER TABLE `translated_contents`
  ADD CONSTRAINT `fk_translated_contents_contentID` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`),
  ADD CONSTRAINT `fk_translated_contents_languageID` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `fk_user_translated` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Tablo kısıtlamaları `translations`
--
ALTER TABLE `translations`
  ADD CONSTRAINT `fk_translations_languageID` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `fk_translations_textID` FOREIGN KEY (`text_id`) REFERENCES `texts` (`text_id`);

--
-- Tablo kısıtlamaları `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_roleID` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
