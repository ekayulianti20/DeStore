-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table gudang_destore.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table gudang_destore.cache: ~0 rows (approximately)
DELETE FROM `cache`;

-- Dumping structure for table gudang_destore.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table gudang_destore.cache_locks: ~0 rows (approximately)
DELETE FROM `cache_locks`;

-- Dumping structure for table gudang_destore.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table gudang_destore.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table gudang_destore.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table gudang_destore.jobs: ~0 rows (approximately)
DELETE FROM `jobs`;

-- Dumping structure for table gudang_destore.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table gudang_destore.job_batches: ~0 rows (approximately)
DELETE FROM `job_batches`;

-- Dumping structure for table gudang_destore.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table gudang_destore.migrations: ~0 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1);

-- Dumping structure for table gudang_destore.mutasi
CREATE TABLE IF NOT EXISTS `mutasi` (
  `id_mutasi` int unsigned NOT NULL AUTO_INCREMENT,
  `id_produk` int unsigned NOT NULL,
  `tanggal_mutasi` datetime NOT NULL,
  `tipe_mutasi` enum('in','out') NOT NULL,
  `jumlah` int NOT NULL DEFAULT '0',
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id_mutasi`),
  KEY `FK_id_produk` (`id_produk`),
  CONSTRAINT `FK_id_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table gudang_destore.mutasi: ~20 rows (approximately)
DELETE FROM `mutasi`;
INSERT INTO `mutasi` (`id_mutasi`, `id_produk`, `tanggal_mutasi`, `tipe_mutasi`, `jumlah`, `keterangan`) VALUES
	(1, 202589000, '2025-07-12 08:24:55', 'in', 890, '-'),
	(2, 202343000, '2025-07-12 10:05:07', 'in', 600, '-'),
	(3, 202343000, '2025-07-12 10:20:25', 'in', 1, 'Perubahan stok dari edit produk'),
	(4, 202589000, '2025-07-12 10:21:20', 'out', 190, 'Perubahan stok dari edit produk'),
	(6, 202323000, '2025-07-12 12:36:13', 'in', 50, 'Mutasi awal saat menambahkan produk'),
	(8, 202343000, '2025-07-13 12:13:26', 'out', 12, 'Perubahan stok dari pembelian'),
	(9, 202489000, '2025-07-13 13:07:44', 'in', 99, 'Mutasi awal saat menambahkan produk'),
	(10, 202343000, '2025-07-14 04:06:18', 'out', 60, 'Perubahan stok dari pembelian'),
	(11, 202489000, '2025-07-14 04:06:18', 'out', 90, 'Perubahan stok dari pembelian'),
	(12, 202343000, '2025-07-14 04:06:20', 'out', 60, 'Perubahan stok dari pembelian'),
	(13, 202343000, '2025-07-14 04:06:21', 'out', 60, 'Perubahan stok dari pembelian'),
	(14, 202343000, '2025-07-14 04:06:22', 'out', 60, 'Perubahan stok dari pembelian'),
	(15, 202343000, '2025-07-14 04:06:22', 'out', 60, 'Perubahan stok dari pembelian'),
	(16, 202343000, '2025-07-14 04:06:23', 'out', 60, 'Perubahan stok dari pembelian'),
	(17, 202343000, '2025-07-14 04:06:23', 'out', 60, 'Perubahan stok dari pembelian'),
	(18, 202589000, '2025-07-14 04:07:11', 'out', 2, 'Perubahan stok dari pembelian'),
	(19, 202323000, '2025-07-14 04:07:11', 'out', 3, 'Perubahan stok dari pembelian'),
	(20, 202589000, '2025-07-14 04:39:41', 'out', 1, 'Perubahan stok dari pembelian'),
	(21, 202323000, '2025-07-14 04:39:41', 'out', 2, 'Perubahan stok dari pembelian'),
	(22, 202323000, '2025-07-14 04:41:05', 'out', 1, 'Perubahan stok dari pembelian'),
	(23, 202489000, '2025-07-14 04:41:05', 'out', 1, 'Perubahan stok dari pembelian'),
	(24, 202343000, '2025-07-22 01:27:23', 'out', 11, 'Perubahan stok dari pembelian'),
	(25, 202589000, '2025-07-22 01:27:23', 'out', 1, 'Perubahan stok dari pembelian');

-- Dumping structure for table gudang_destore.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table gudang_destore.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping structure for table gudang_destore.produk
CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(100) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `harga_satuan` decimal(10,2) NOT NULL DEFAULT '0.00',
  `harga_modal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `stok` int DEFAULT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=202589001 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table gudang_destore.produk: ~3 rows (approximately)
DELETE FROM `produk`;
INSERT INTO `produk` (`id_produk`, `nama_produk`, `kategori`, `harga_satuan`, `harga_modal`, `stok`) VALUES
	(202323000, 'Highwaist', 'Celana', 234000.00, 150000.00, 9),
	(202343000, 'Baju Koko', 'Pakaian', 750000.00, 500000.00, 247),
	(202489000, 'Kulot Jumbo XXL', 'Celana', 150000.00, 100000.00, 8),
	(202589000, 'Baju Tidur', 'Pakaian', 109000.00, 50000.00, 696);

-- Dumping structure for table gudang_destore.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table gudang_destore.sessions: ~1 rows (approximately)
DELETE FROM `sessions`;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('TofeRlHV9wFcE0iN6PXLXGA9SMsAniBySBXiV0cX', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiazNFVHdJQ1lQWGpxQ1FkaUZDcG9hb01kazJPZTlDN1JqOGVVWmFJSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1752314246);

-- Dumping structure for table gudang_destore.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table gudang_destore.users: ~0 rows (approximately)
DELETE FROM `users`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
