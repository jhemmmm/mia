-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping data for table mia.books: ~9 rows (approximately)
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` (`id`, `user_id`, `table_id`, `total_person`, `time`, `status`, `created_at`, `updated_at`) VALUES
	(7, 1, 2, 5, '2019-10-18 02:45:00', 0, '2019-10-16 18:48:49', '2019-10-16 18:48:49'),
	(8, 1, 4, 1, '2019-10-17 04:00:00', 0, '2019-10-16 19:53:37', '2019-10-16 19:53:37'),
	(9, 1, 5, 1, '2019-01-18 02:22:22', 0, '2019-10-16 20:02:09', '2019-10-16 20:02:09'),
	(10, 1, 6, 1, '2019-10-17 05:00:00', 0, '2019-10-16 20:03:02', '2019-10-16 20:03:02'),
	(11, 1, 1, 1, '2019-11-18 06:05:00', 5, '2019-10-16 20:14:31', '2019-10-22 18:00:01'),
	(12, 1, 7, 1, '2019-10-10 10:10:00', 0, '2019-10-19 22:55:42', '2019-10-19 22:55:42'),
	(13, 1, 8, 1, '2010-12-31 14:31:00', 0, '2019-10-21 20:10:44', '2019-10-21 20:10:44'),
	(14, 1, 9, 3, '2019-10-22 21:50:00', 0, '2019-10-22 18:42:19', '2019-10-22 18:52:58'),
	(15, 1, 3, 7, '2019-10-23 10:26:00', 0, '2019-10-22 19:08:26', '2019-10-22 19:08:26');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;

-- Dumping data for table mia.book_categories: ~13 rows (approximately)
/*!40000 ALTER TABLE `book_categories` DISABLE KEYS */;
INSERT INTO `book_categories` (`id`, `book_id`, `category_id`, `category_quantity`, `updated_at`, `created_at`) VALUES
	(1, 7, 2, 2, '2019-10-16 18:48:50', '2019-10-16 18:48:50'),
	(2, 8, 3, 1, '2019-10-16 19:53:37', '2019-10-16 19:53:37'),
	(3, 9, 2, 1, '2019-10-16 20:02:09', '2019-10-16 20:02:09'),
	(4, 10, 1, 2, '2019-10-16 20:03:02', '2019-10-16 20:03:02'),
	(5, 10, 2, 2, '2019-10-16 20:03:02', '2019-10-16 20:03:02'),
	(6, 10, 3, 1, '2019-10-16 20:03:02', '2019-10-16 20:03:02'),
	(7, 11, 1, 1, '2019-10-16 20:14:31', '2019-10-16 20:14:31'),
	(8, 11, 2, 1, '2019-10-16 20:14:31', '2019-10-16 20:14:31'),
	(9, 12, 1, 1, '2019-10-19 22:55:43', '2019-10-19 22:55:43'),
	(10, 13, 2, 2, '2019-10-21 20:10:44', '2019-10-21 20:10:44'),
	(11, 14, 2, 2, '2019-10-22 18:42:19', '2019-10-22 18:42:19'),
	(12, 15, 2, 1, '2019-10-22 19:08:26', '2019-10-22 19:08:26'),
	(13, 15, 9, 1, '2019-10-22 19:08:26', '2019-10-22 19:08:26');
/*!40000 ALTER TABLE `book_categories` ENABLE KEYS */;

-- Dumping data for table mia.categories: ~2 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `image`, `description`, `price`, `created_at`, `updated_at`) VALUES
	(2, 'Combo Pacakge B', 'images/b.png', 'none', 1400, NULL, '2019-10-20 21:10:30'),
	(9, 'Combo Pacakge A', 'images/1571691552.png', 'Combo Pacakge C', 1299, '2019-10-21 20:59:12', '2019-10-21 20:59:26');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping data for table mia.category_items: ~12 rows (approximately)
/*!40000 ALTER TABLE `category_items` DISABLE KEYS */;
INSERT INTO `category_items` (`id`, `category_id`, `item_id`, `created_at`, `item_value`, `updated_at`) VALUES
	(1, 5, 1, '2019-10-21 20:08:32', 2, '2019-10-21 20:08:32'),
	(2, 6, 1, '2019-10-21 20:08:51', 3, '2019-10-21 20:08:51'),
	(3, 7, 1, '2019-10-21 20:09:52', 3, '2019-10-21 20:09:52'),
	(10, 2, 1, '2019-10-21 20:23:30', 3, '2019-10-21 20:23:30'),
	(11, 2, 2, '2019-10-21 20:23:30', 3, '2019-10-21 20:23:30'),
	(27, 8, 1, '2019-10-21 20:57:01', 242424, '2019-10-21 20:57:01'),
	(28, 8, 2, '2019-10-21 20:57:01', 242424, '2019-10-21 20:57:01'),
	(29, 8, 3, '2019-10-21 20:57:01', 3, '2019-10-21 20:57:01'),
	(30, 8, 4, '2019-10-21 20:57:01', NULL, '2019-10-21 20:57:01'),
	(37, 9, 1, '2019-10-21 21:59:08', 750, '2019-10-21 21:59:08'),
	(38, 9, 2, '2019-10-21 21:59:08', 300, '2019-10-21 21:59:08'),
	(39, 9, 3, '2019-10-21 21:59:08', 300, '2019-10-21 21:59:08');
/*!40000 ALTER TABLE `category_items` ENABLE KEYS */;

-- Dumping data for table mia.items: ~4 rows (approximately)
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` (`id`, `name`, `total`, `type`, `created_at`, `updated_at`) VALUES
	(1, 'Pork Belly', 750, 0, NULL, NULL),
	(2, 'Marinated Chicked', 300, 0, NULL, NULL),
	(3, 'Mariniated Pork', 5555, 0, NULL, '2019-10-21 21:35:37'),
	(8, 'Rice', 1000, 0, '2019-10-21 22:54:13', '2019-10-21 22:54:13');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;

-- Dumping data for table mia.migrations: ~7 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_10_14_095633_create_categories_table', 1),
	(4, '2019_10_14_095648_create_items_table', 1),
	(5, '2019_10_14_101056_create_category_items_table', 1),
	(6, '2019_10_14_101206_create_books_table', 1),
	(7, '2019_10_14_102056_create_tables_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping data for table mia.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping data for table mia.tables: ~9 rows (approximately)
/*!40000 ALTER TABLE `tables` DISABLE KEYS */;
INSERT INTO `tables` (`id`, `min`, `max`, `created_at`, `updated_at`) VALUES
	(1, 5, 6, NULL, '2019-10-22 17:53:33'),
	(2, 3, 6, NULL, NULL),
	(3, 6, 8, NULL, NULL),
	(4, 1, 2, NULL, NULL),
	(5, 1, 2, NULL, NULL),
	(6, 1, 2, NULL, NULL),
	(7, 1, 2, NULL, NULL),
	(8, 1, 2, NULL, NULL),
	(9, 2, 5, '2019-10-22 17:48:40', '2019-10-22 17:48:40');
/*!40000 ALTER TABLE `tables` ENABLE KEYS */;

-- Dumping data for table mia.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `address`, `optional_address`, `mobile`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Jheamuel Panuelos', 'warrockph24@gmail.com', NULL, '$2y$10$F2VyKaBY69cNDG2B9pEsSulBGZcv69AHmAu11tXWGgwozi1bg42J.', '111, Zone 1, San Miguel, Calabanga, Camarines Sur', NULL, '09194784474', NULL, '2019-10-16 18:18:26', '2019-10-24 18:38:58');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
