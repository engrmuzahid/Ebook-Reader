-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for ebook
CREATE DATABASE IF NOT EXISTS `ebook` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `ebook`;

-- Dumping structure for table ebook.activations
CREATE TABLE IF NOT EXISTS `activations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activations_user_id_index` (`user_id`),
  CONSTRAINT `activations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.activations: ~1 rows (approximately)
/*!40000 ALTER TABLE `activations` DISABLE KEYS */;
INSERT INTO `activations` (`id`, `user_id`, `code`, `completed`, `completed_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 'T0FpguMCcM6c55q6AMV0Fzqo9cM7oaPZ', 1, '2021-08-01 14:47:16', '2021-08-01 14:47:16', '2021-08-01 14:47:16');
/*!40000 ALTER TABLE `activations` ENABLE KEYS */;

-- Dumping structure for table ebook.activity_log
CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` int(11) DEFAULT NULL,
  `causer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.activity_log: ~0 rows (approximately)
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;

-- Dumping structure for table ebook.authors
CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `authors_slug_unique` (`slug`),
  KEY `authors_user_id_foreign` (`user_id`),
  CONSTRAINT `authors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.authors: ~0 rows (approximately)
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;

-- Dumping structure for table ebook.author_translations
CREATE TABLE IF NOT EXISTS `author_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(10) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `author_translations_author_id_locale_unique` (`author_id`,`locale`),
  CONSTRAINT `author_translations_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.author_translations: ~0 rows (approximately)
/*!40000 ALTER TABLE `author_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `author_translations` ENABLE KEYS */;

-- Dumping structure for table ebook.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int(10) unsigned DEFAULT NULL,
  `is_searchable` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.categories: ~0 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table ebook.category_translations
CREATE TABLE IF NOT EXISTS `category_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_translations_category_id_locale_unique` (`category_id`,`locale`),
  CONSTRAINT `category_translations_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.category_translations: ~0 rows (approximately)
/*!40000 ALTER TABLE `category_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `category_translations` ENABLE KEYS */;

-- Dumping structure for table ebook.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `commenter_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commenter_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guest_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guest_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commentable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `child_id` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_commenter_id_commenter_type_index` (`commenter_id`,`commenter_type`),
  KEY `comments_commentable_type_commentable_id_index` (`commentable_type`,`commentable_id`),
  KEY `comments_child_id_foreign` (`child_id`),
  CONSTRAINT `comments_child_id_foreign` FOREIGN KEY (`child_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.comments: ~0 rows (approximately)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Dumping structure for table ebook.ebooks
CREATE TABLE IF NOT EXISTS `ebooks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` text COLLATE utf8mb4_unicode_ci,
  `file_url` text COLLATE utf8mb4_unicode_ci,
  `embed_code` text COLLATE utf8mb4_unicode_ci,
  `isbn` text COLLATE utf8mb4_unicode_ci,
  `price` text COLLATE utf8mb4_unicode_ci,
  `buy_url` text COLLATE utf8mb4_unicode_ci,
  `publication_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `viewed` int(10) unsigned NOT NULL DEFAULT '0',
  `download` int(11) NOT NULL DEFAULT '0',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL,
  `is_private` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ebooks_slug_unique` (`slug`),
  KEY `ebooks_user_id_foreign` (`user_id`),
  CONSTRAINT `ebooks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.ebooks: ~0 rows (approximately)
/*!40000 ALTER TABLE `ebooks` DISABLE KEYS */;
/*!40000 ALTER TABLE `ebooks` ENABLE KEYS */;

-- Dumping structure for table ebook.ebook_authors
CREATE TABLE IF NOT EXISTS `ebook_authors` (
  `ebook_id` int(10) unsigned NOT NULL,
  `author_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ebook_id`,`author_id`),
  KEY `ebook_authors_author_id_foreign` (`author_id`),
  CONSTRAINT `ebook_authors_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ebook_authors_ebook_id_foreign` FOREIGN KEY (`ebook_id`) REFERENCES `ebooks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.ebook_authors: ~0 rows (approximately)
/*!40000 ALTER TABLE `ebook_authors` DISABLE KEYS */;
/*!40000 ALTER TABLE `ebook_authors` ENABLE KEYS */;

-- Dumping structure for table ebook.ebook_categories
CREATE TABLE IF NOT EXISTS `ebook_categories` (
  `ebook_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ebook_id`,`category_id`),
  KEY `ebook_categories_category_id_foreign` (`category_id`),
  CONSTRAINT `ebook_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ebook_categories_ebook_id_foreign` FOREIGN KEY (`ebook_id`) REFERENCES `ebooks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.ebook_categories: ~0 rows (approximately)
/*!40000 ALTER TABLE `ebook_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `ebook_categories` ENABLE KEYS */;

-- Dumping structure for table ebook.ebook_translations
CREATE TABLE IF NOT EXISTS `ebook_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ebook_id` int(10) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `publisher` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ebook_translations_ebook_id_locale_unique` (`ebook_id`,`locale`),
  FULLTEXT KEY `title` (`title`),
  CONSTRAINT `ebook_translations_ebook_id_foreign` FOREIGN KEY (`ebook_id`) REFERENCES `ebooks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.ebook_translations: ~0 rows (approximately)
/*!40000 ALTER TABLE `ebook_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `ebook_translations` ENABLE KEYS */;

-- Dumping structure for table ebook.entity_files
CREATE TABLE IF NOT EXISTS `entity_files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `files_id` int(10) unsigned NOT NULL,
  `entity_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entity_id` bigint(20) unsigned NOT NULL,
  `zone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entity_files_entity_type_entity_id_index` (`entity_type`,`entity_id`),
  KEY `entity_files_files_id_index` (`files_id`),
  KEY `entity_files_zone_index` (`zone`),
  CONSTRAINT `entity_files_files_id_foreign` FOREIGN KEY (`files_id`) REFERENCES `files` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.entity_files: ~0 rows (approximately)
/*!40000 ALTER TABLE `entity_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `entity_files` ENABLE KEYS */;

-- Dumping structure for table ebook.favorite_lists
CREATE TABLE IF NOT EXISTS `favorite_lists` (
  `user_id` int(10) unsigned NOT NULL,
  `ebook_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`ebook_id`),
  KEY `favorite_lists_ebook_id_foreign` (`ebook_id`),
  CONSTRAINT `favorite_lists_ebook_id_foreign` FOREIGN KEY (`ebook_id`) REFERENCES `ebooks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `favorite_lists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.favorite_lists: ~0 rows (approximately)
/*!40000 ALTER TABLE `favorite_lists` DISABLE KEYS */;
/*!40000 ALTER TABLE `favorite_lists` ENABLE KEYS */;

-- Dumping structure for table ebook.files
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `download` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `files_user_id_index` (`user_id`),
  KEY `files_filename_index` (`filename`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.files: ~0 rows (approximately)
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;

-- Dumping structure for table ebook.menus
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.menus: ~0 rows (approximately)
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;

-- Dumping structure for table ebook.menu_items
CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `page_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int(10) unsigned DEFAULT NULL,
  `is_root` tinyint(1) NOT NULL DEFAULT '0',
  `is_fluid` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_items_parent_id_foreign` (`parent_id`),
  KEY `menu_items_page_id_foreign` (`page_id`),
  KEY `menu_items_menu_id_index` (`menu_id`),
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `menu_items_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `menu_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.menu_items: ~0 rows (approximately)
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;

-- Dumping structure for table ebook.menu_item_translations
CREATE TABLE IF NOT EXISTS `menu_item_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_item_id` int(10) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menu_item_translations_menu_item_id_locale_unique` (`menu_item_id`,`locale`),
  CONSTRAINT `menu_item_translations_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.menu_item_translations: ~0 rows (approximately)
/*!40000 ALTER TABLE `menu_item_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_item_translations` ENABLE KEYS */;

-- Dumping structure for table ebook.menu_translations
CREATE TABLE IF NOT EXISTS `menu_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menu_translations_menu_id_locale_unique` (`menu_id`,`locale`),
  CONSTRAINT `menu_translations_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.menu_translations: ~0 rows (approximately)
/*!40000 ALTER TABLE `menu_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_translations` ENABLE KEYS */;

-- Dumping structure for table ebook.meta_data
CREATE TABLE IF NOT EXISTS `meta_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entity_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entity_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `meta_data_entity_type_entity_id_index` (`entity_type`,`entity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.meta_data: ~0 rows (approximately)
/*!40000 ALTER TABLE `meta_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `meta_data` ENABLE KEYS */;

-- Dumping structure for table ebook.meta_data_translations
CREATE TABLE IF NOT EXISTS `meta_data_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `meta_data_id` int(10) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `meta_data_translations_meta_data_id_locale_unique` (`meta_data_id`,`locale`),
  CONSTRAINT `meta_data_translations_meta_data_id_foreign` FOREIGN KEY (`meta_data_id`) REFERENCES `meta_data` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.meta_data_translations: ~0 rows (approximately)
/*!40000 ALTER TABLE `meta_data_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `meta_data_translations` ENABLE KEYS */;

-- Dumping structure for table ebook.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.migrations: ~36 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2018_06_30_113500_create_comments_table', 1),
	(2, '2019_08_24_104134_create_sliders_table', 1),
	(3, '2019_08_24_105134_create_slider_translations_table', 1),
	(4, '2019_08_24_105234_create_slider_slides_table', 1),
	(5, '2019_08_24_105534_create_slider_slide_translations_table', 1),
	(6, '2019_08_30_061505_create_pages_table', 1),
	(7, '2019_08_30_061505_create_settings_table', 1),
	(8, '2019_08_30_061605_create_page_translations_table', 1),
	(9, '2019_08_30_061712_create_setting_translations_table', 1),
	(10, '2019_08_30_102225_create_translations_table', 1),
	(11, '2019_08_30_102429_create_translation_translations_table', 1),
	(12, '2019_09_01_061505_create_meta_data_table', 1),
	(13, '2019_09_01_061605_create_meta_data_translations_table', 1),
	(14, '2019_09_01_160015_create_menus_table', 1),
	(15, '2019_09_01_160138_create_menu_translations_table', 1),
	(16, '2019_09_01_160753_create_menu_items_table', 1),
	(17, '2019_09_01_160804_create_menu_item_translation_table', 1),
	(18, '2019_09_17_083103_migration_cartalyst_sentinel', 1),
	(19, '2019_09_24_054528_create_activity_log_table', 1),
	(20, '2019_09_24_104134_create_files_table', 1),
	(21, '2019_09_25_083103_create_authors_table', 1),
	(22, '2019_09_25_083103_create_categories_table', 1),
	(23, '2019_09_25_092538_add_fields_to_users_table', 1),
	(24, '2019_09_25_092538_create_author_translations_table', 1),
	(25, '2019_09_25_092538_create_category_translations_table', 1),
	(26, '2019_09_25_104134_create_entity_files_table', 1),
	(27, '2019_10_24_163159_create_ebooks_table', 1),
	(28, '2019_10_24_163222_create_ebook_translations_table', 1),
	(29, '2019_10_24_163319_create_ebook_authors_table', 1),
	(30, '2019_10_24_163319_create_ebook_categories_table', 1),
	(31, '2019_10_25_163159_create_favorite_lists_table', 1),
	(32, '2019_10_25_163159_create_reviews_table', 1),
	(33, '2019_10_27_182852_create_reported_ebooks_table', 1),
	(34, '2020_04_07_102818_add_more_fields_to_ebooks_table', 1),
	(35, '2020_05_11_085648_add_file_type_embed_code_fields_to_ebooks_table', 1),
	(36, '2020_06_14_120806_add_download_field_to_ebooks_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table ebook.pages
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.pages: ~0 rows (approximately)
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;

-- Dumping structure for table ebook.page_translations
CREATE TABLE IF NOT EXISTS `page_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(10) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_translations_page_id_locale_unique` (`page_id`,`locale`),
  CONSTRAINT `page_translations_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.page_translations: ~0 rows (approximately)
/*!40000 ALTER TABLE `page_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `page_translations` ENABLE KEYS */;

-- Dumping structure for table ebook.persistences
CREATE TABLE IF NOT EXISTS `persistences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `persistences_code_unique` (`code`),
  KEY `persistences_user_id_foreign` (`user_id`),
  CONSTRAINT `persistences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.persistences: ~0 rows (approximately)
/*!40000 ALTER TABLE `persistences` DISABLE KEYS */;
/*!40000 ALTER TABLE `persistences` ENABLE KEYS */;

-- Dumping structure for table ebook.reminders
CREATE TABLE IF NOT EXISTS `reminders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reminders_user_id_foreign` (`user_id`),
  CONSTRAINT `reminders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.reminders: ~0 rows (approximately)
/*!40000 ALTER TABLE `reminders` DISABLE KEYS */;
/*!40000 ALTER TABLE `reminders` ENABLE KEYS */;

-- Dumping structure for table ebook.reported_ebooks
CREATE TABLE IF NOT EXISTS `reported_ebooks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ebook_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reported_ebooks_ebook_id_foreign` (`ebook_id`),
  KEY `reported_ebooks_user_id_foreign` (`user_id`),
  CONSTRAINT `reported_ebooks_ebook_id_foreign` FOREIGN KEY (`ebook_id`) REFERENCES `ebooks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reported_ebooks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.reported_ebooks: ~0 rows (approximately)
/*!40000 ALTER TABLE `reported_ebooks` DISABLE KEYS */;
/*!40000 ALTER TABLE `reported_ebooks` ENABLE KEYS */;

-- Dumping structure for table ebook.reviews
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reviewer_id` int(10) unsigned DEFAULT NULL,
  `ebook_id` int(10) unsigned NOT NULL,
  `rating` int(11) NOT NULL,
  `reviewer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_approved` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_reviewer_id_index` (`reviewer_id`),
  KEY `reviews_ebook_id_index` (`ebook_id`),
  CONSTRAINT `reviews_ebook_id_foreign` FOREIGN KEY (`ebook_id`) REFERENCES `ebooks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.reviews: ~0 rows (approximately)
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;

-- Dumping structure for table ebook.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `slug`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'Admin', '{"admin.users.index":true,"admin.users.create":true,"admin.users.edit":true,"admin.users.destroy":true,"admin.roles.index":true,"admin.roles.create":true,"admin.roles.edit":true,"admin.roles.destroy":true,"admin.menus.index":true,"admin.menus.create":true,"admin.menus.edit":true,"admin.menus.destroy":true,"admin.menu_items.index":true,"admin.menu_items.create":true,"admin.menu_items.edit":true,"admin.menu_items.destroy":true,"admin.files.index":true,"admin.files.create":true,"admin.files.destroy":true,"admin.pages.index":true,"admin.pages.create":true,"admin.pages.edit":true,"admin.pages.destroy":true,"admin.translations.index":true,"admin.translations.edit":true,"admin.settings.edit":true,"admin.ebooks.index":true,"admin.ebooks.create":true,"admin.ebooks.edit":true,"admin.ebooks.destroy":true,"admin.reportedebooks.index":true,"admin.reportedebooks.destroy":true,"admin.reviews.index":true,"admin.reviews.create":true,"admin.reviews.edit":true,"admin.reviews.destroy":true,"admin.importer.index":true,"admin.importer.create":true,"admin.sliders.index":true,"admin.sliders.create":true,"admin.sliders.edit":true,"admin.sliders.destroy":true,"admin.categories.index":true,"admin.categories.create":true,"admin.categories.edit":true,"admin.categories.destroy":true,"admin.authors.index":true,"admin.authors.create":true,"admin.authors.edit":true,"admin.authors.destroy":true,"admin.activity.index":true,"admin.cynoebook.edit":true}', '2021-08-01 14:47:15', '2021-08-01 14:47:15'),
	(2, 'user', 'User', '[]', '2021-08-01 14:47:17', '2021-08-01 14:47:17');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table ebook.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plainValue` text COLLATE utf8mb4_unicode_ci,
  `isTranslatable` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.settings: ~24 rows (approximately)
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `name`, `plainValue`, `isTranslatable`, `created_at`, `updated_at`) VALUES
	(1, 'site_name', NULL, 1, '2021-08-01 14:47:17', '2021-08-01 14:47:17'),
	(2, 'site_email', 's:15:"admin@ebook.com";', 0, '2021-08-01 14:47:17', '2021-08-01 14:47:17'),
	(3, 'active_theme', 's:9:"Cynoebook";', 0, '2021-08-01 14:47:17', '2021-08-01 14:47:17'),
	(4, 'supported_locales', 'a:1:{i:0;s:2:"en";}', 0, '2021-08-01 14:47:17', '2021-08-01 14:47:17'),
	(5, 'default_locale', 's:2:"en";', 0, '2021-08-01 14:47:17', '2021-08-01 14:47:17'),
	(6, 'default_timezone', 's:3:"UTC";', 0, '2021-08-01 14:47:17', '2021-08-01 14:47:17'),
	(7, 'user_role', 's:1:"2";', 0, '2021-08-01 14:47:17', '2021-08-01 14:47:17'),
	(8, 'auto_approve_user', 's:1:"1";', 0, '2021-08-01 14:47:17', '2021-08-01 14:47:17'),
	(9, 'cookie_bar_enabled', 's:1:"1";', 0, '2021-08-01 14:47:17', '2021-08-01 14:47:17'),
	(10, 'enable_comment', 's:1:"1";', 0, '2021-08-01 14:47:17', '2021-08-01 14:47:17'),
	(11, 'member_only_reading_books', 's:1:"0";', 0, '2021-08-01 14:47:17', '2021-08-01 14:47:17'),
	(12, 'enable_ebook_report', 'b:1;', 0, '2021-08-01 14:47:17', '2021-08-01 14:47:17'),
	(13, 'enable_ebook_print', 'b:1;', 0, '2021-08-01 14:47:18', '2021-08-01 14:47:18'),
	(14, 'enable_ebook_download', 'b:1;', 0, '2021-08-01 14:47:18', '2021-08-01 14:47:18'),
	(15, 'enable_ebook_upload', 'b:1;', 0, '2021-08-01 14:47:18', '2021-08-01 14:47:18'),
	(16, 'enable_registrations', 'b:1;', 0, '2021-08-01 14:47:18', '2021-08-01 14:47:18'),
	(17, 'reviews_enabled', 'b:1;', 0, '2021-08-01 14:47:18', '2021-08-01 14:47:18'),
	(18, 'auto_approve_reviews', 'b:1;', 0, '2021-08-01 14:47:18', '2021-08-01 14:47:18'),
	(19, 'cynoebook_copyright_text', 's:61:"Copyright © {{ site_name }} {{ year }}. All rights reserved.";', 0, '2021-08-01 14:47:18', '2021-08-01 14:47:18'),
	(20, 'allowed_file_types', 'a:7:{i:0;s:3:"pdf";i:1;s:4:"epub";i:2;s:4:"docx";i:3;s:3:"doc";i:4;s:3:"txt";i:5;s:3:"mp3";i:6;s:3:"wav";}', 0, '2021-08-01 14:47:18', '2021-08-01 14:47:18'),
	(21, 'theme_logo_header_color', 's:4:"blue";', 0, '2021-08-01 14:47:18', '2021-08-01 14:47:18'),
	(22, 'theme_navbar_header_color', 's:5:"blue2";', 0, '2021-08-01 14:47:18', '2021-08-01 14:47:18'),
	(23, 'theme_sidebar_color', 's:5:"white";', 0, '2021-08-01 14:47:18', '2021-08-01 14:47:18'),
	(24, 'theme_background_color', 's:3:"bg1";', 0, '2021-08-01 14:47:18', '2021-08-01 14:47:18');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Dumping structure for table ebook.setting_translations
CREATE TABLE IF NOT EXISTS `setting_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `setting_id` int(10) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_translations_setting_id_locale_unique` (`setting_id`,`locale`),
  CONSTRAINT `setting_translations_setting_id_foreign` FOREIGN KEY (`setting_id`) REFERENCES `settings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.setting_translations: ~1 rows (approximately)
/*!40000 ALTER TABLE `setting_translations` DISABLE KEYS */;
INSERT INTO `setting_translations` (`id`, `setting_id`, `locale`, `value`) VALUES
	(1, 1, 'en', 's:5:"Ebook";');
/*!40000 ALTER TABLE `setting_translations` ENABLE KEYS */;

-- Dumping structure for table ebook.sliders
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `autoplay` tinyint(1) DEFAULT NULL,
  `autoplay_speed` int(11) DEFAULT NULL,
  `arrows` tinyint(1) DEFAULT NULL,
  `dots` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.sliders: ~0 rows (approximately)
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;

-- Dumping structure for table ebook.slider_slides
CREATE TABLE IF NOT EXISTS `slider_slides` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slider_id` int(10) unsigned NOT NULL,
  `options` text COLLATE utf8mb4_unicode_ci,
  `call_to_action_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `open_in_new_window` tinyint(1) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slider_slides_slider_id_foreign` (`slider_id`),
  CONSTRAINT `slider_slides_slider_id_foreign` FOREIGN KEY (`slider_id`) REFERENCES `sliders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.slider_slides: ~0 rows (approximately)
/*!40000 ALTER TABLE `slider_slides` DISABLE KEYS */;
/*!40000 ALTER TABLE `slider_slides` ENABLE KEYS */;

-- Dumping structure for table ebook.slider_slide_translations
CREATE TABLE IF NOT EXISTS `slider_slide_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slider_slide_id` int(10) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `files_id` int(10) unsigned DEFAULT NULL,
  `caption_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption_3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `call_to_action_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slider_slide_translations_slider_slide_id_locale_unique` (`slider_slide_id`,`locale`),
  CONSTRAINT `slider_slide_translations_slider_slide_id_foreign` FOREIGN KEY (`slider_slide_id`) REFERENCES `slider_slides` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.slider_slide_translations: ~0 rows (approximately)
/*!40000 ALTER TABLE `slider_slide_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `slider_slide_translations` ENABLE KEYS */;

-- Dumping structure for table ebook.slider_translations
CREATE TABLE IF NOT EXISTS `slider_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slider_id` int(10) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slider_translations_slider_id_locale_unique` (`slider_id`,`locale`),
  CONSTRAINT `slider_translations_slider_id_foreign` FOREIGN KEY (`slider_id`) REFERENCES `sliders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.slider_translations: ~0 rows (approximately)
/*!40000 ALTER TABLE `slider_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `slider_translations` ENABLE KEYS */;

-- Dumping structure for table ebook.throttle
CREATE TABLE IF NOT EXISTS `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_foreign` (`user_id`),
  CONSTRAINT `throttle_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.throttle: ~0 rows (approximately)
/*!40000 ALTER TABLE `throttle` DISABLE KEYS */;
/*!40000 ALTER TABLE `throttle` ENABLE KEYS */;

-- Dumping structure for table ebook.translations
CREATE TABLE IF NOT EXISTS `translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `translations_key_index` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.translations: ~0 rows (approximately)
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `translations` ENABLE KEYS */;

-- Dumping structure for table ebook.translation_translations
CREATE TABLE IF NOT EXISTS `translation_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `translation_id` int(10) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `translation_translations_translation_id_locale_unique` (`translation_id`,`locale`),
  CONSTRAINT `translation_translations_translation_id_foreign` FOREIGN KEY (`translation_id`) REFERENCES `translations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.translation_translations: ~0 rows (approximately)
/*!40000 ALTER TABLE `translation_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `translation_translations` ENABLE KEYS */;

-- Dumping structure for table ebook.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `last_login` datetime DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `permissions`, `last_login`, `about`, `facebook`, `twitter`, `google`, `instagram`, `linkedin`, `youtube`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'test', 'admin', 'admin@ginilab.com', '$2y$10$RHG244zBDgovyIrJ6o.u9.t5ZkLceyGjVpNa5rx3tspA0kjTz5hiS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-01 14:47:16', '2021-08-01 14:47:16');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table ebook.user_roles
CREATE TABLE IF NOT EXISTS `user_roles` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `user_roles_role_id_foreign` (`role_id`),
  CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ebook.user_roles: ~1 rows (approximately)
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
	(1, 1, '2021-08-01 14:47:16', '2021-08-01 14:47:16');
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
