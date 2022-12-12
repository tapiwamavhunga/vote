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


-- Dumping database structure for evoting
CREATE DATABASE IF NOT EXISTS `evoting` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `evoting`;

-- Dumping structure for table evoting.login_records
CREATE TABLE IF NOT EXISTS `login_records` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_at` datetime DEFAULT NULL,
  `login_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table evoting.login_records: ~21 rows (approximately)
/*!40000 ALTER TABLE `login_records` DISABLE KEYS */;
INSERT INTO `login_records` (`id`, `user_id`, `login_at`, `login_ip`, `created_at`, `updated_at`) VALUES
	(1, '1', '2021-12-06 20:22:32', '127.0.0.1', '2021-12-06 20:22:32', '2021-12-06 20:22:32'),
	(2, '1', '2021-12-06 21:43:51', '127.0.0.1', '2021-12-06 21:43:51', '2021-12-06 21:43:51'),
	(3, '1', '2021-12-06 21:57:33', '127.0.0.1', '2021-12-06 21:57:33', '2021-12-06 21:57:33'),
	(4, '1', '2021-12-07 10:37:02', '127.0.0.1', '2021-12-07 10:37:02', '2021-12-07 10:37:02'),
	(5, '1', '2021-12-07 10:43:01', '127.0.0.1', '2021-12-07 10:43:01', '2021-12-07 10:43:01'),
	(6, '1', '2021-12-07 14:35:31', '127.0.0.1', '2021-12-07 14:35:31', '2021-12-07 14:35:31'),
	(7, '1', '2021-12-07 18:04:51', '127.0.0.1', '2021-12-07 18:04:51', '2021-12-07 18:04:51'),
	(8, '2', '2021-12-07 18:18:41', '127.0.0.1', '2021-12-07 18:18:41', '2021-12-07 18:18:41'),
	(9, '2', '2021-12-07 18:47:35', '127.0.0.1', '2021-12-07 18:47:35', '2021-12-07 18:47:35'),
	(10, '1', '2021-12-08 00:16:20', '127.0.0.1', '2021-12-08 00:16:20', '2021-12-08 00:16:20'),
	(11, '2', '2021-12-08 18:38:41', '127.0.0.1', '2021-12-08 18:38:41', '2021-12-08 18:38:41'),
	(12, '1', '2022-01-01 20:28:05', '127.0.0.1', '2022-01-01 20:28:05', '2022-01-01 20:28:05'),
	(13, '2', '2022-01-01 20:29:45', '127.0.0.1', '2022-01-01 20:29:45', '2022-01-01 20:29:45'),
	(14, '1', '2022-01-01 20:30:24', '127.0.0.1', '2022-01-01 20:30:24', '2022-01-01 20:30:24'),
	(15, '1', '2022-01-02 15:14:25', '127.0.0.1', '2022-01-02 15:14:25', '2022-01-02 15:14:25'),
	(16, '2', '2022-01-02 15:29:07', '127.0.0.1', '2022-01-02 15:29:07', '2022-01-02 15:29:07'),
	(17, '2', '2022-01-02 15:32:08', '127.0.0.1', '2022-01-02 15:32:08', '2022-01-02 15:32:08'),
	(18, '2', '2022-01-02 15:39:07', '127.0.0.1', '2022-01-02 15:39:07', '2022-01-02 15:39:07'),
	(19, '2', '2022-01-02 15:40:30', '127.0.0.1', '2022-01-02 15:40:30', '2022-01-02 15:40:30'),
	(20, '2', '2022-01-02 15:41:34', '127.0.0.1', '2022-01-02 15:41:34', '2022-01-02 15:41:34'),
	(21, '2', '2022-01-02 15:45:48', '127.0.0.1', '2022-01-02 15:45:48', '2022-01-02 15:45:48'),
	(22, '2', '2022-01-02 17:31:17', '127.0.0.1', '2022-01-02 17:31:17', '2022-01-02 17:31:17'),
	(23, '1', '2022-01-02 17:34:29', '127.0.0.1', '2022-01-02 17:34:29', '2022-01-02 17:34:29');
/*!40000 ALTER TABLE `login_records` ENABLE KEYS */;

-- Dumping structure for table evoting.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table evoting.migrations: ~12 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
	(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
	(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
	(6, '2016_06_01_000004_create_oauth_clients_table', 1),
	(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
	(8, '2020_05_05_152744_create_login_records_table', 1),
	(9, '2020_06_10_194322_create_sessions_table', 1),
	(13, '2021_12_06_201657_create_voters_table', 2),
	(14, '2021_12_06_201721_create_protocols_table', 3),
	(18, '2021_12_06_201708_create_ministers_table', 5),
	(19, '2014_10_12_000000_create_users_table', 6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table evoting.ministers
CREATE TABLE IF NOT EXISTS `ministers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `counter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ministers_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table evoting.ministers: ~3 rows (approximately)
/*!40000 ALTER TABLE `ministers` DISABLE KEYS */;
INSERT INTO `ministers` (`id`, `name`, `user_id`, `email`, `image`, `counter`, `created_at`, `updated_at`) VALUES
	(2, 'All National Congress', '1', 'Congress@gmail.com', '11641127498.jpeg', NULL, '2022-01-02 15:45:16', '2022-01-02 18:14:59'),
	(3, 'Communist Party', '1', 'Communist@gmail.com', '11641127464.jpeg', NULL, '2022-01-02 15:45:27', '2022-01-02 18:14:24'),
	(4, 'India Janata Party', '1', 'bjp@gmail.com', '11641127478.jpeg', NULL, '2022-01-02 17:21:22', '2022-01-02 18:14:38'),
	(5, 'All India Bloc', '1', 'all@gmail.com', '11641127449.jpeg', NULL, '2022-01-02 18:06:50', '2022-01-02 18:14:09'),
	(6, 'Desh Seva Party', '1', 'dravida@gmail.com', '11641127440.jpeg', NULL, '2022-01-02 18:07:15', '2022-01-02 18:16:03'),
	(7, 'Jan Congress Garh', '1', 'janta@gmail.com', '11641127433.jpeg', NULL, '2022-01-02 18:07:43', '2022-01-02 18:13:53');
/*!40000 ALTER TABLE `ministers` ENABLE KEYS */;

-- Dumping structure for table evoting.oauth_access_tokens
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table evoting.oauth_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;

-- Dumping structure for table evoting.oauth_auth_codes
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table evoting.oauth_auth_codes: ~0 rows (approximately)
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;

-- Dumping structure for table evoting.oauth_clients
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table evoting.oauth_clients: ~0 rows (approximately)
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;

-- Dumping structure for table evoting.oauth_personal_access_clients
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table evoting.oauth_personal_access_clients: ~0 rows (approximately)
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;

-- Dumping structure for table evoting.oauth_refresh_tokens
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table evoting.oauth_refresh_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;

-- Dumping structure for table evoting.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table evoting.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table evoting.protocols
CREATE TABLE IF NOT EXISTS `protocols` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table evoting.protocols: ~0 rows (approximately)
/*!40000 ALTER TABLE `protocols` DISABLE KEYS */;
INSERT INTO `protocols` (`id`, `date`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
	(1, '07-12-2021', '05', '18', NULL, NULL);
/*!40000 ALTER TABLE `protocols` ENABLE KEYS */;

-- Dumping structure for table evoting.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table evoting.sessions: ~0 rows (approximately)
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

-- Dumping structure for table evoting.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `candidate_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'User',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `voted_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `voted_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `availability` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Offline',
  `login_at` datetime DEFAULT NULL,
  `logout_at` datetime DEFAULT NULL,
  `login_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table evoting.users: ~5 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `user_id`, `email`, `candidate_email`, `email_verified_at`, `password`, `type`, `status`, `reason`, `phone`, `voted_to`, `voted_time`, `image`, `device`, `availability`, `login_at`, `logout_at`, `login_ip`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Praveen', NULL, 'praveen82524@gmail.com', NULL, NULL, '$2y$10$.egVc3r7Cd/x535PRbiX4OhCcu4WoVGnewQYE.0Yb91/BG0t.e7zq', 'Admin', 'Active', NULL, '08789529215', NULL, NULL, NULL, NULL, 'Online', '2022-01-02 17:34:29', '2022-01-01 20:29:37', '127.0.0.1', 'FnGCoMcTlebbcKdaGgo5FIuhHonyms6aGs2SNGyrUFwgIiZsCiikSrt6z443', '2021-12-07 18:04:36', '2022-01-02 17:34:29'),
	(2, 'Praveen', NULL, 'praveen@trickuweb.com', 'mahesh@gmail.com', NULL, '$2y$10$AZE/uoy7OtXVGxCRhALiQu0FyU.gfPIizv.IGrumqzNEHGvdJANC2', 'User', 'Active', NULL, '8877889988', 'mahesh@gmail.com', '2022-01-02 15:41:39', NULL, NULL, 'Online', '2022-01-02 17:31:17', '2022-01-02 15:41:39', '127.0.0.1', 'FE3nl9pG4Uou47vGVoH0kyIfYMzVlfx1bBniKT7UaI22i17Oua9MLGanzgek', '2021-12-07 18:06:01', '2022-01-02 17:31:17'),
	(5, 'Rajesh Kumar', NULL, 'rajeshsingh7406@gmail.com', NULL, NULL, '$2y$10$6ANK1MLWFVOn00SRE/jnduNmMC/q20mHtVOO7oba8n8Q6US/kf.VO', 'User', 'Active', NULL, '8899778899', NULL, NULL, '11641122893.jpeg', NULL, 'Offline', NULL, NULL, NULL, NULL, '2022-01-02 16:40:12', '2022-01-02 17:40:52'),
	(6, 'Nitin', NULL, 'nitinwax@gmail.com', NULL, NULL, '$2y$10$VTZ1kEoaEBynyHm1FeZ0oOJ2ItlP1VzFlyC8AkPQCyDHm.JpOYtVO', 'User', 'Active', NULL, '9988998877', NULL, NULL, '11641122882.jpeg', NULL, 'Offline', NULL, NULL, NULL, NULL, '2022-01-02 16:53:32', '2022-01-02 17:40:32'),
	(10, 'Mukesh', NULL, 'praveen.marsplanet@gmail.com', NULL, NULL, '$2y$10$kEU7BK0tQU3ZHDIPm.PqWudtbG5oWQxQaqu47GHuUrtkjVk9/x/pC', 'User', 'Active', NULL, '8877669988', NULL, NULL, '11641123698.jpeg', NULL, 'Offline', NULL, NULL, NULL, NULL, '2022-01-02 17:11:38', '2022-01-02 17:41:08');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table evoting.voters
CREATE TABLE IF NOT EXISTS `voters` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `voted_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `voting_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `closing_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `voters_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table evoting.voters: ~0 rows (approximately)
/*!40000 ALTER TABLE `voters` DISABLE KEYS */;
/*!40000 ALTER TABLE `voters` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
