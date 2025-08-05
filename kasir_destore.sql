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

-- Dumping structure for table kasir_destore.detail_transaksi
CREATE TABLE IF NOT EXISTS `detail_transaksi` (
  `id_detail` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `id_transaksi` int unsigned NOT NULL,
  `id_produk` int unsigned NOT NULL,
  `jumlah_beli` int NOT NULL,
  `sub_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id_detail`),
  KEY `FK_id_transaksi` (`id_transaksi`),
  CONSTRAINT `FK_detail_transaksi_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table kasir_destore.detail_transaksi: ~25 rows (approximately)
DELETE FROM `detail_transaksi`;
INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_produk`, `jumlah_beli`, `sub_total`) VALUES
	(0000000001, 2, 202343000, 1, 750000.00),
	(0000000002, 3, 202343000, 1, 750000.00),
	(0000000003, 3, 202343000, 2, 1500000.00),
	(0000000004, 4, 202343000, 1, 750000.00),
	(0000000005, 5, 202323000, 1, 234000.00),
	(0000000006, 6, 202589000, 1, 109000.00),
	(0000000007, 7, 202589000, 1, 109000.00),
	(0000000008, 8, 202343000, 1, 750000.00),
	(0000000009, 9, 202589000, 4, 436000.00),
	(0000000010, 10, 202589000, 4, 436000.00),
	(0000000011, 11, 202589000, 1, 109000.00),
	(0000000012, 11, 202323000, 1, 234000.00),
	(0000000013, 12, 202323000, 2, 468000.00),
	(0000000014, 13, 202323000, 1, 234000.00),
	(0000000015, 14, 202343000, 1, 750000.00),
	(0000000016, 17, 202323000, 35, 8190000.00),
	(0000000019, 20, 202343000, 12, 9000000.00),
	(0000000020, 21, 202343000, 60, 45000000.00),
	(0000000021, 21, 202489000, 90, 13500000.00),
	(0000000028, 28, 202589000, 2, 218000.00),
	(0000000029, 28, 202323000, 3, 702000.00),
	(0000000030, 29, 202589000, 1, 109000.00),
	(0000000031, 29, 202323000, 2, 468000.00),
	(0000000032, 30, 202323000, 1, 234000.00),
	(0000000033, 30, 202489000, 1, 150000.00),
	(0000000034, 32, 202343000, 11, 8250000.00),
	(0000000035, 32, 202589000, 1, 109000.00);

-- Dumping structure for table kasir_destore.laporan
CREATE TABLE IF NOT EXISTS `laporan` (
  `id_laporan` int unsigned NOT NULL AUTO_INCREMENT,
  `periode` varchar(20) NOT NULL DEFAULT '',
  `tanggal_dibuat` datetime NOT NULL,
  `total_transaksi` int NOT NULL DEFAULT '0',
  `total_pendapatan` decimal(10,2) NOT NULL DEFAULT '0.00',
  `dibuat_oleh` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_laporan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table kasir_destore.laporan: ~0 rows (approximately)
DELETE FROM `laporan`;

-- Dumping structure for table kasir_destore.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` int unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_transaksi` datetime NOT NULL,
  `total_harga` decimal(10,2) NOT NULL DEFAULT '0.00',
  `nominal_uang` decimal(10,2) NOT NULL DEFAULT '0.00',
  `kembalian` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table kasir_destore.transaksi: ~21 rows (approximately)
DELETE FROM `transaksi`;
INSERT INTO `transaksi` (`id_transaksi`, `tanggal_transaksi`, `total_harga`, `nominal_uang`, `kembalian`) VALUES
	(2, '2025-07-12 14:22:54', 750000.00, 800000.00, 50000.00),
	(3, '2025-07-12 14:27:38', 2250000.00, 2500000.00, 250000.00),
	(4, '2025-07-12 14:38:08', 750000.00, 800000.00, 50000.00),
	(5, '2025-07-12 14:43:47', 234000.00, 250000.00, 16000.00),
	(6, '2025-07-12 15:03:55', 109000.00, 110000.00, 1000.00),
	(7, '2025-07-12 15:04:37', 109000.00, 110000.00, 1000.00),
	(8, '2025-07-12 15:16:51', 750000.00, 800000.00, 50000.00),
	(9, '2025-07-12 15:18:36', 436000.00, 500000.00, 64000.00),
	(10, '2025-07-12 15:18:58', 436000.00, 500000.00, 64000.00),
	(11, '2025-07-12 15:27:21', 343000.00, 400000.00, 57000.00),
	(12, '2025-07-13 05:53:23', 468000.00, 500000.00, 32000.00),
	(13, '2025-07-13 06:05:25', 234000.00, 250000.00, 16000.00),
	(14, '2025-07-13 06:07:17', 750000.00, 800000.00, 50000.00),
	(17, '2025-07-13 12:02:02', 8190000.00, 8200000.00, 10000.00),
	(20, '2025-07-13 12:13:26', 9000000.00, 9000000.00, 0.00),
	(21, '2025-07-14 04:06:18', 58500000.00, 58500000.00, 0.00),
	(28, '2025-07-14 04:07:11', 920000.00, 1000000.00, 80000.00),
	(29, '2025-07-14 04:39:41', 577000.00, 600000.00, 23000.00),
	(30, '2025-07-14 04:41:05', 384000.00, 400000.00, 16000.00),
	(32, '2025-07-22 01:27:23', 8359000.00, 8500000.00, 141000.00);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
