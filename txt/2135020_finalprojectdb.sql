-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.24-MariaDB - mariadb.org binary distribution
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


-- Dumping database structure for database2135020
CREATE DATABASE IF NOT EXISTS `database2135020` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `database2135020`;

-- Dumping structure for table database2135020.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id_customer` char(36) NOT NULL DEFAULT uuid(),
  `name_first` varchar(20) NOT NULL,
  `name_last` varchar(20) NOT NULL,
  `address` varchar(25) NOT NULL,
  `city` varchar(25) NOT NULL,
  `province` varchar(25) NOT NULL,
  `postalcode` varchar(7) NOT NULL DEFAULT '',
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `picture` mediumblob NOT NULL,
  `customer_datetime_creation` datetime NOT NULL DEFAULT current_timestamp(),
  `customer_datetime_last_update` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_customer`) USING BTREE,
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database2135020.customers: ~1 rows (approximately)
INSERT INTO `customers` (`id_customer`, `name_first`, `name_last`, `address`, `city`, `province`, `postalcode`, `username`, `password`, `picture`, `customer_datetime_creation`, `customer_datetime_last_update`) VALUES
	('a19322bb-6a98-11ed-a329-005056c00001', 'Julien', 'Pontbriand', '123', 'HellStreet', 'Quebec', 'j1j j1j', 'hihia', '123', _binary '', '2022-11-22 14:05:21', '2022-11-22 14:05:21');

-- Dumping structure for table database2135020.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id_order` char(36) NOT NULL DEFAULT uuid(),
  `id_order_customer` char(36) NOT NULL,
  `id_order_product` char(36) NOT NULL,
  `quantity` smallint(3) unsigned NOT NULL DEFAULT 0,
  `price_sold` decimal(7,2) NOT NULL DEFAULT 0.00,
  `comments` varchar(200) DEFAULT NULL,
  `order_datetime_creation` datetime NOT NULL DEFAULT current_timestamp(),
  `order_datetime_last_update` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_order`) USING BTREE,
  KEY `order_datetime_last_update` (`order_datetime_last_update`),
  KEY `FK_order_customer` (`id_order_customer`),
  KEY `FK_order_product` (`id_order_product`),
  CONSTRAINT `FK_order_customer` FOREIGN KEY (`id_order_customer`) REFERENCES `customers` (`id_customer`) ON UPDATE NO ACTION,
  CONSTRAINT `FK_order_product` FOREIGN KEY (`id_order_product`) REFERENCES `products` (`id_product`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database2135020.orders: ~3 rows (approximately)
INSERT INTO `orders` (`id_order`, `id_order_customer`, `id_order_product`, `quantity`, `price_sold`, `comments`, `order_datetime_creation`, `order_datetime_last_update`) VALUES
	('44fae00a-6aa4-11ed-a329-005056c00001', 'a19322bb-6a98-11ed-a329-005056c00001', '2cddd46c-6a95-11ed-a329-005056c00001', 22, 11.11, NULL, '2022-11-22 15:28:39', '2022-11-22 15:29:13'),
	('561b3d07-6aa6-11ed-a329-005056c00001', 'a19322bb-6a98-11ed-a329-005056c00001', '2cddd46c-6a95-11ed-a329-005056c00001', 0, 0.00, NULL, '2022-11-22 15:43:27', '2022-11-22 15:43:27'),
	('a4e740f9-6aa3-11ed-a329-005056c00001', 'a19322bb-6a98-11ed-a329-005056c00001', '2cddd46c-6a95-11ed-a329-005056c00001', 10, 150.83, NULL, '2022-11-22 15:24:11', '2022-11-22 15:25:10');

-- Dumping structure for table database2135020.products
CREATE TABLE IF NOT EXISTS `products` (
  `id_product` char(36) NOT NULL DEFAULT uuid(),
  `code` varchar(12) NOT NULL DEFAULT '0',
  `description` varchar(100) NOT NULL DEFAULT '0',
  `price_sell` decimal(7,2) NOT NULL DEFAULT 0.00,
  `price_cost` decimal(7,2) DEFAULT 0.00,
  `datetime_creation` datetime NOT NULL DEFAULT current_timestamp(),
  `datetime_last_update` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_product`) USING BTREE,
  CONSTRAINT `CHK_products_price_sell_lower_or_equal_to_10k` CHECK (`price_sell` <= 10000.00)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database2135020.products: ~1 rows (approximately)
INSERT INTO `products` (`id_product`, `code`, `description`, `price_sell`, `price_cost`, `datetime_creation`, `datetime_last_update`) VALUES
	('2cddd46c-6a95-11ed-a329-005056c00001', '123', '123', 112.00, 123.00, '2022-11-22 13:40:36', '2022-11-22 15:48:33');

-- Dumping structure for view database2135020.view_orders_by_last_update
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `view_orders_by_last_update` (
	`id_order` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
	`id_order_customer` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
	`id_order_product` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
	`quantity` SMALLINT(3) UNSIGNED NOT NULL,
	`price_sold` DECIMAL(7,2) NOT NULL,
	`comments` VARCHAR(200) NULL COLLATE 'utf8mb4_general_ci',
	`order_datetime_creation` DATETIME NOT NULL,
	`order_datetime_last_update` DATETIME NOT NULL,
	`id_customer` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
	`name_first` VARCHAR(20) NOT NULL COLLATE 'utf8mb4_general_ci',
	`name_last` VARCHAR(20) NOT NULL COLLATE 'utf8mb4_general_ci',
	`address` VARCHAR(25) NOT NULL COLLATE 'utf8mb4_general_ci',
	`city` VARCHAR(25) NOT NULL COLLATE 'utf8mb4_general_ci',
	`province` VARCHAR(25) NOT NULL COLLATE 'utf8mb4_general_ci',
	`postalcode` VARCHAR(7) NOT NULL COLLATE 'utf8mb4_general_ci',
	`username` VARCHAR(15) NOT NULL COLLATE 'utf8mb4_general_ci',
	`password` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_general_ci',
	`picture` MEDIUMBLOB NOT NULL,
	`customer_datetime_creation` DATETIME NOT NULL,
	`customer_datetime_last_update` DATETIME NOT NULL,
	`id_product` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
	`code` VARCHAR(12) NOT NULL COLLATE 'utf8mb4_general_ci',
	`description` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
	`price_sell` DECIMAL(7,2) NOT NULL,
	`price_cost` DECIMAL(7,2) NULL,
	`datetime_creation` DATETIME NOT NULL,
	`datetime_last_update` DATETIME NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for view database2135020.view_orders_by_last_update
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `view_orders_by_last_update`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_orders_by_last_update` AS SELECT *
FROM orders 
JOIN customers ON id_order_customer = id_customer
JOIN products ON id_order_product = id_product
ORDER BY order_datetime_last_update DESC ;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
