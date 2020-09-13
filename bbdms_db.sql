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


-- Dumping database structure for bbdms_db
CREATE DATABASE IF NOT EXISTS `bbdms_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `bbdms_db`;

-- Dumping structure for table bbdms_db.blood_groups
CREATE TABLE IF NOT EXISTS `blood_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bloodGroup` varchar(10) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table bbdms_db.blood_groups: ~8 rows (approximately)
DELETE FROM `blood_groups`;
/*!40000 ALTER TABLE `blood_groups` DISABLE KEYS */;
INSERT INTO `blood_groups` (`id`, `bloodGroup`, `deleted`, `created_at`, `updated_at`) VALUES
	(1, 'O+', 0, '2020-09-04 12:13:53', '2020-09-04 12:13:53'),
	(2, 'A+', 0, '2020-09-04 12:14:10', '2020-09-04 12:14:10'),
	(3, 'A-', 0, '2020-09-04 12:14:38', '2020-09-04 12:14:38'),
	(4, 'O-', 0, '2020-09-04 12:14:44', '2020-09-04 12:14:44'),
	(5, 'AB+', 0, '2020-09-04 12:14:49', '2020-09-04 12:14:49'),
	(6, 'AB-', 0, '2020-09-04 12:14:56', '2020-09-04 12:14:56'),
	(7, 'B+', 0, '2020-09-04 12:15:00', '2020-09-04 12:15:00'),
	(8, 'B-', 0, NULL, '2020-09-04 12:57:43');
/*!40000 ALTER TABLE `blood_groups` ENABLE KEYS */;

-- Dumping structure for table bbdms_db.blood_requests
CREATE TABLE IF NOT EXISTS `blood_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullName` varchar(100) DEFAULT NULL,
  `address` text,
  `purpose` text,
  `dated` date DEFAULT NULL,
  `timing` time DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `bloodGroupId` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deleted` (`deleted`),
  KEY `FK_bg_request` (`bloodGroupId`),
  CONSTRAINT `FK_bg_request` FOREIGN KEY (`bloodGroupId`) REFERENCES `blood_groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table bbdms_db.blood_requests: ~0 rows (approximately)
DELETE FROM `blood_requests`;
/*!40000 ALTER TABLE `blood_requests` DISABLE KEYS */;
INSERT INTO `blood_requests` (`id`, `fullName`, `address`, `purpose`, `dated`, `timing`, `mobile`, `bloodGroupId`, `points`, `deleted`, `created_at`, `updated_at`) VALUES
	(1, 'New Requester', 'Address Mine, 192101', 'This is test', '2020-10-12', '13:36:00', '9876543210', 1, 2, 0, '2020-09-12 19:31:34', '2020-09-12 19:31:34');
/*!40000 ALTER TABLE `blood_requests` ENABLE KEYS */;

-- Dumping structure for table bbdms_db.contact_us
CREATE TABLE IF NOT EXISTS `contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullName` varchar(100) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` text,
  `status` tinyint(4) DEFAULT '0',
  `deleted` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table bbdms_db.contact_us: ~0 rows (approximately)
DELETE FROM `contact_us`;
/*!40000 ALTER TABLE `contact_us` DISABLE KEYS */;
INSERT INTO `contact_us` (`id`, `fullName`, `mobile`, `email`, `subject`, `message`, `status`, `deleted`, `created_at`, `updated_at`) VALUES
	(1, 'Contacter', '9876543220', 'contact@gmail.com', 'This is try', 'This is the message', 0, 0, '2020-09-13 08:57:26', '2020-09-13 08:57:26'),
	(2, 'Contacter New', '9876543210', 'contact123@gmail.com', 'This is try', 'This is the text', 1, 0, '2020-09-13 08:59:04', '2020-09-13 08:59:04');
/*!40000 ALTER TABLE `contact_us` ENABLE KEYS */;

-- Dumping structure for table bbdms_db.donors
CREATE TABLE IF NOT EXISTS `donors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullName` varchar(100) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('male','female','transgender') DEFAULT NULL,
  `bloodGroupId` int(11) DEFAULT NULL,
  `address` longtext,
  `pincode` int(11) DEFAULT NULL,
  `message` longtext,
  `deleted` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_blood_group` (`bloodGroupId`),
  KEY `deleted` (`deleted`),
  CONSTRAINT `FK_blood_group` FOREIGN KEY (`bloodGroupId`) REFERENCES `blood_groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table bbdms_db.donors: ~3 rows (approximately)
DELETE FROM `donors`;
/*!40000 ALTER TABLE `donors` DISABLE KEYS */;
INSERT INTO `donors` (`id`, `fullName`, `mobile`, `email`, `age`, `gender`, `bloodGroupId`, `address`, `pincode`, `message`, `deleted`, `created_at`, `updated_at`) VALUES
	(1, 'Shabnam Nazir', '1234567890', 'bhat.shabnam627@gmail.com', 22, 'male', 7, 'Kreeri Baramulla', 193198, '', 0, '2020-09-07 11:41:18', '2020-09-07 11:41:18'),
	(2, 'Bhat Shabnam', '1234567891', 'bhat.shabnam629@gmail.com', 22, 'male', 7, 'Kreeri Baramulla', 193198, '', 0, NULL, '2020-09-07 13:40:15'),
	(3, 'Aamir Bashir', '1234567892', 'aamir.bashir@gmail.com', 20, 'male', 2, 'Duderhama Ganderbal', 193199, '', 0, NULL, '2020-09-07 13:31:43'),
	(4, 'New Donor', '9876543210', 'newdonor@gmail.com', 25, 'female', 1, 'Anantnag Kashmir', 192101, '', 0, '2020-09-11 10:42:23', '2020-09-11 10:42:23');
/*!40000 ALTER TABLE `donors` ENABLE KEYS */;

-- Dumping structure for table bbdms_db.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `migration` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table bbdms_db.migrations: ~6 rows (approximately)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`) VALUES
	(1, 'Migration_Fuce_1598946526'),
	(2, 'Migration_Fuce_1598948312'),
	(3, 'Migration_Fuce_1599198400'),
	(4, 'Migration_Fuce_1599204614'),
	(5, 'Migration_Fuce_1599918710'),
	(6, 'Migration_Fuce_1599965498');
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table bbdms_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deleted` (`deleted`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table bbdms_db.users: ~1 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `email`, `mobile`, `created_at`, `updated_at`, `deleted`) VALUES
	(1, 'admin', '$2y$10$eE9MJgYYKFea8Zfejr8Av.Objua64Pfghk6glWkrPu1hycXlCDdtu', 'admin@bbdms.com', '8825011191', '2020-09-04 10:42:59', '2020-09-04 10:43:00', 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
