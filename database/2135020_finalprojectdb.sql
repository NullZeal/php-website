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
  `id` char(36) NOT NULL DEFAULT uuid(),
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `address` varchar(25) NOT NULL,
  `city` varchar(25) NOT NULL,
  `province` varchar(25) NOT NULL,
  `postalcode` varchar(7) NOT NULL,
  `username` varchar(15) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `picture` mediumblob DEFAULT NULL,
  `datetime_created` datetime NOT NULL DEFAULT current_timestamp(),
  `datetime_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database2135020.customers: ~2 rows (approximately)
INSERT INTO `customers` (`id`, `firstname`, `lastname`, `address`, `city`, `province`, `postalcode`, `username`, `user_password`, `picture`, `datetime_created`, `datetime_updated`) VALUES
	('a19322bb-6a98-11ed-a329-005056c00001', 'Justin', 'Melrose', '4321', 'St-Lin', 'Quebec', 'k9kk9k', 'shifty', '4321', _binary 0x617364, '2022-11-22 14:05:21', '2022-11-23 09:06:58'),
	('b9a793ce-6b49-11ed-a329-005056c00001', 'Maximus', 'Lebeau', '1323 rue st-jean', 'Montrial', 'Quebec', 'j2jj8j', 'joliecroquette', 'delanoche', _binary 0x706466, '2022-11-23 11:13:00', '2022-11-23 11:18:55');

-- Dumping structure for table database2135020.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` char(36) NOT NULL DEFAULT uuid(),
  `id_customer` char(36) NOT NULL,
  `id_product` char(36) NOT NULL,
  `quantity` smallint(3) unsigned NOT NULL DEFAULT 0,
  `product_price` decimal(7,2) NOT NULL DEFAULT 0.00,
  `comments` varchar(200) DEFAULT NULL,
  `datetime_created` datetime NOT NULL DEFAULT current_timestamp(),
  `datetime_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  KEY `order_datetime_last_update` (`datetime_updated`) USING BTREE,
  KEY `FK_orders_customers` (`id_customer`),
  KEY `FK2_orders_products` (`id_product`),
  CONSTRAINT `FK2_orders_products` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_orders_customers` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database2135020.orders: ~3 rows (approximately)
INSERT INTO `orders` (`id`, `id_customer`, `id_product`, `quantity`, `product_price`, `comments`, `datetime_created`, `datetime_updated`) VALUES
	('44fae00a-6aa4-11ed-a329-005056c00001', 'a19322bb-6a98-11ed-a329-005056c00001', '2cddd46c-6a95-11ed-a329-005056c00001', 22, 11.11, NULL, '2022-11-22 15:28:39', '2022-11-22 15:29:13'),
	('561b3d07-6aa6-11ed-a329-005056c00001', 'a19322bb-6a98-11ed-a329-005056c00001', '2cddd46c-6a95-11ed-a329-005056c00001', 77, 100.11, 'thats it! well played', '2022-11-22 15:43:27', '2022-11-23 12:40:01'),
	('a4e740f9-6aa3-11ed-a329-005056c00001', 'a19322bb-6a98-11ed-a329-005056c00001', '2cddd46c-6a95-11ed-a329-005056c00001', 10, 150.83, NULL, '2022-11-22 15:24:11', '2022-11-22 15:25:10');

-- Dumping structure for procedure database2135020.procedure_customers_delete_one
DELIMITER //
CREATE PROCEDURE `procedure_customers_delete_one`(
	IN `p_customers_id` CHAR(36)
)
BEGIN
	#####################################################################################################################
	#REVISION HISTORY:
	#####################################################################################################################
	
	#DEVELOPER 												DATE 							COMMENTS
	
	#Julien Pontbriand (2135020) 						2022-11-23 					Created the procedure
	
	#####################################################################################################################
	
	DELETE
	FROM customers
	WHERE id = p_customers_id;
	
END//
DELIMITER ;

-- Dumping structure for procedure database2135020.procedure_customers_insert_one
DELIMITER //
CREATE PROCEDURE `procedure_customers_insert_one`(
	IN `p_customers_name_first` VARCHAR(20),
	IN `p_customers_name_last` VARCHAR(20),
	IN `p_customers_address` VARCHAR(25),
	IN `p_customers_city` VARCHAR(25),
	IN `p_customers_province` VARCHAR(25),
	IN `p_customers_postalcode` VARCHAR(7),
	IN `p_customers_username` VARCHAR(15),
	IN `p_customers_user_password` VARCHAR(255),
	IN `p_customers_picture` MEDIUMBLOB
)
BEGIN

	#####################################################################################################################
	#REVISION HISTORY:
	#####################################################################################################################
	
	#DEVELOPER 												DATE 							COMMENTS
	
	#Julien Pontbriand (2135020) 						2022-11-22 					Created the procedure
	
	#####################################################################################################################
		
	INSERT INTO `database2135020`.`customers` (
	
		`firstname`, 
		`lastname`, 
		`address`, 
		`city`, 
		`province`, 
		`postalcode`, 
		`username`, 
		`user_password`,
		`picture`) 
		
	VALUES (
	
		`p_customers_name_first`,
		`p_customers_name_last`,
		`p_customers_address`, 
		`p_customers_city`, 
		`p_customers_province`, 
		`p_customers_postalcode`, 
		`p_customers_username`, 
		`p_customers_user_password`,
		`p_customers_picture`);
				
END//
DELIMITER ;

-- Dumping structure for procedure database2135020.procedure_customers_select_all
DELIMITER //
CREATE PROCEDURE `procedure_customers_select_all`()
BEGIN

	#####################################################################################################################
	#REVISION HISTORY:
	#####################################################################################################################
	
	#DEVELOPER 												DATE 							COMMENTS
	
	#Julien Pontbriand (2135020) 						2022-11-22 					Created the procedure
	
	#####################################################################################################################
	
	SELECT *
	FROM customers
	ORDER BY lastname;
	
#																								         _nnnn_                      
#																								        dGGGGMMb     ,""""""""""""""""""""""".
#																								       @p~qp~~qMb    | Merry Christmas J-F! |
#																								       M|@||@) M|   _;......................'
#																								       @,----.JM| -'
#																								      JS^\__/  qKL
#																								     dZP        qKRb
#																								    dZP          qKKb
#																								   fZP            SMMb
#																								   HZM            MMMM
#																								   FqM            MMMM
#																								 __| ".        |\dS"qML
#																							    |    `.       | `' \Zq
#																								_)      \.___.,|     .'
#																								\____   )MMMMMM|   .'
#																								     `-'       `--' hjm
	
END//
DELIMITER ;

-- Dumping structure for procedure database2135020.procedure_customers_select_one
DELIMITER //
CREATE PROCEDURE `procedure_customers_select_one`(
	IN `p_customers_id` CHAR(36)
)
    COMMENT 'Selects one specific row from the customers table'
BEGIN
	#####################################################################################################################
	#REVISION HISTORY:
	#####################################################################################################################
	
	#DEVELOPER 												DATE 							COMMENTS
	
	#Julien Pontbriand (2135020) 						2022-11-22 					Created the procedure
	
	#####################################################################################################################
	
	SELECT *
	FROM customers
	WHERE id = p_customers_id;
	
END//
DELIMITER ;

-- Dumping structure for procedure database2135020.procedure_customers_update_one
DELIMITER //
CREATE PROCEDURE `procedure_customers_update_one`(
	IN `p_customers_id` CHAR(36),
	IN `p_customers_firstname` VARCHAR(20),
	IN `p_customers_lastname` VARCHAR(20),
	IN `p_customers_address` VARCHAR(25),
	IN `p_customers_city` VARCHAR(25),
	IN `p_customers_province` VARCHAR(25),
	IN `p_customers_postalcode` VARCHAR(7),
	IN `p_customers_username` VARCHAR(15),
	IN `p_customers_user_password` VARCHAR(255),
	IN `p_customers_picture` MEDIUMBLOB
)
    MODIFIES SQL DATA
    SQL SECURITY INVOKER
BEGIN


	#####################################################################################################################
	#REVISION HISTORY:
	#####################################################################################################################
	
	#DEVELOPER 												DATE 							COMMENTS
	
	#Julien Pontbriand (2135020) 						2022-11-22 					Created the procedure
	
	#####################################################################################################################

	UPDATE `database2135020`.`customers` 
	
	SET 
		`firstname`= `p_customers_firstname`, 
		`lastname`= `p_customers_lastname`, 
		`address`= `p_customers_address`, 
		`city`= `p_customers_city`, 
		`province`= `p_customers_province`, 
		`postalcode`= `p_customers_postalcode`,
		`username`= `p_customers_username`, 
		`user_password`= `p_customers_user_password`, 
		`picture`=  `p_customers_picture`
		
	WHERE	`id`= `p_customers_id`;
	
END//
DELIMITER ;

-- Dumping structure for procedure database2135020.procedure_get_password_from_username
DELIMITER //
CREATE PROCEDURE `procedure_get_password_from_username`(
	IN `p_customers_username` VARCHAR(15)
)
BEGIN
	SELECT user_password
	FROM customers
	WHERE username = p_customers_username;
END//
DELIMITER ;

-- Dumping structure for procedure database2135020.procedure_orders_delete_one
DELIMITER //
CREATE PROCEDURE `procedure_orders_delete_one`(
	IN `p_orders_id` CHAR(36)
)
BEGIN
	#####################################################################################################################
	#REVISION HISTORY:
	#####################################################################################################################
	
	#DEVELOPER 												DATE 							COMMENTS
	
	#Julien Pontbriand (2135020) 						2022-11-23 					Created the procedure
	
	#####################################################################################################################
	
	DELETE
	FROM orders
	WHERE id = p_orders_id;
	
END//
DELIMITER ;

-- Dumping structure for procedure database2135020.procedure_orders_insert_one
DELIMITER //
CREATE PROCEDURE `procedure_orders_insert_one`(
	IN `p_orders_id_customer` CHAR(36),
	IN `p_orders_id_product` CHAR(36),
	IN `p_orders_quantity` SMALLINT,
	IN `p_orders_product_price` DECIMAL(7,2),
	IN `p_orders_comments` VARCHAR(200)
)
BEGIN

	#####################################################################################################################
	#REVISION HISTORY:
	#####################################################################################################################
	
	#DEVELOPER 												DATE 							COMMENTS
	
	#Julien Pontbriand (2135020) 						2022-11-23 					Created the procedure
	
	#####################################################################################################################
		
	INSERT INTO `database2135020`.`orders` (
	
		`id_customer`,
		`id_product`,
		`quantity`,
		`product_price`,
		`comments`)
		
	VALUES (
	
		`p_orders_id_customer`, 
		`p_orders_id_product`, 
		`p_orders_quantity`, 
		`p_orders_product_price`, 
		`p_orders_comments`);
				
END//
DELIMITER ;

-- Dumping structure for procedure database2135020.procedure_orders_select_all
DELIMITER //
CREATE PROCEDURE `procedure_orders_select_all`()
BEGIN

	#####################################################################################################################
	#REVISION HISTORY:
	#####################################################################################################################
	
	#DEVELOPER 												DATE 							COMMENTS
	
	#Julien Pontbriand (2135020) 						2022-11-23 					Created the procedure
	
	#####################################################################################################################
	
	SELECT *
	FROM orders
	ORDER BY datetime_created DESC;
	
END//
DELIMITER ;

-- Dumping structure for procedure database2135020.procedure_orders_select_one
DELIMITER //
CREATE PROCEDURE `procedure_orders_select_one`(
	IN `p_orders_id` CHAR(36)
)
BEGIN
	#####################################################################################################################
	#REVISION HISTORY:
	#####################################################################################################################
	
	#DEVELOPER 												DATE 							COMMENTS
	
	#Julien Pontbriand (2135020) 						2022-11-23 					Created the procedure
	
	#####################################################################################################################
	
	SELECT *
	FROM orders
	WHERE id_order = p_orders_id;
	
END//
DELIMITER ;

-- Dumping structure for procedure database2135020.procedure_orders_update_one
DELIMITER //
CREATE PROCEDURE `procedure_orders_update_one`(
	IN `p_orders_id` CHAR(36),
	IN `p_orders_quantity` SMALLINT,
	IN `p_orders_product_price` DECIMAL(7,2),
	IN `p_orders_comments` VARCHAR(200)
)
BEGIN

	#####################################################################################################################
	#REVISION HISTORY:
	#####################################################################################################################
	
	#DEVELOPER 												DATE 							COMMENTS
	
	#Julien Pontbriand (2135020) 						2022-11-23 					Created the procedure
	
	#####################################################################################################################

	UPDATE `database2135020`.`orders`
	
	SET
		`quantity`= `p_orders_quantity`, 
		`product_price`= `p_orders_product_price`, 
		`comments`= `p_orders_comments`
		
	WHERE	`id`= `p_orders_id`;
	
END//
DELIMITER ;

-- Dumping structure for procedure database2135020.procedure_products_delete_one
DELIMITER //
CREATE PROCEDURE `procedure_products_delete_one`(
	IN `p_products_id` CHAR(36)
)
BEGIN
	#####################################################################################################################
	#REVISION HISTORY:
	#####################################################################################################################
	
	#DEVELOPER 												DATE 							COMMENTS
	
	#Julien Pontbriand (2135020) 						2022-11-23 					Created the procedure
	
	#####################################################################################################################
	
	DELETE
	FROM products
	WHERE id = p_products_id;
	
END//
DELIMITER ;

-- Dumping structure for procedure database2135020.procedure_products_insert_one
DELIMITER //
CREATE PROCEDURE `procedure_products_insert_one`(
	IN `p_products_pcode` VARCHAR(12),
	IN `p_products_pdescription` VARCHAR(100),
	IN `p_products_price` DECIMAL(7,2),
	IN `p_products_cost` DECIMAL(7,2)
)
BEGIN

	#####################################################################################################################
	#REVISION HISTORY:
	#####################################################################################################################
	
	#DEVELOPER 												DATE 							COMMENTS
	
	#Julien Pontbriand (2135020) 						2022-11-23 					Created the procedure
	
	#####################################################################################################################
		
	INSERT INTO `database2135020`.`products` (
	
		`pcode`, 
		`pdescription`, 
		`price`, 
		`cost`)
		
	VALUES (
	
		`p_products_pcode`,
		`p_products_pdescription`,
		`p_products_price`, 
		`p_products_cost`);
				
END//
DELIMITER ;

-- Dumping structure for procedure database2135020.procedure_products_select_all
DELIMITER //
CREATE PROCEDURE `procedure_products_select_all`()
BEGIN

	#####################################################################################################################
	#REVISION HISTORY:
	#####################################################################################################################
	
	#DEVELOPER 												DATE 							COMMENTS
	
	#Julien Pontbriand (2135020) 						2022-11-23 					Created the procedure
	
	#####################################################################################################################
	
	SELECT *
	FROM products
	ORDER BY pcode;
	
END//
DELIMITER ;

-- Dumping structure for procedure database2135020.procedure_products_select_one
DELIMITER //
CREATE PROCEDURE `procedure_products_select_one`(
	IN `p_products_id` CHAR(36)
)
BEGIN
	#####################################################################################################################
	#REVISION HISTORY:
	#####################################################################################################################
	
	#DEVELOPER 												DATE 							COMMENTS
	
	#Julien Pontbriand (2135020) 						2022-11-23 					Created the procedure
	
	#####################################################################################################################
	
	SELECT *
	FROM products
	WHERE id = p_products_id;
	
END//
DELIMITER ;

-- Dumping structure for procedure database2135020.procedure_products_update_one
DELIMITER //
CREATE PROCEDURE `procedure_products_update_one`(
	IN `p_products_id` CHAR(36),
	IN `p_products_pcode` VARCHAR(12),
	IN `p_product_pdescription` VARCHAR(100),
	IN `p_products_price` DECIMAL(7,2),
	IN `p_products_cost` DECIMAL(7,2)
)
BEGIN

	#####################################################################################################################
	#REVISION HISTORY:
	#####################################################################################################################
	
	#DEVELOPER 												DATE 							COMMENTS
	
	#Julien Pontbriand (2135020) 						2022-11-23 					Created the procedure
	
	#####################################################################################################################

	UPDATE `database2135020`.`products` 
	
	SET 
		`pcode`= `p_products_pcode`, 
		`pdescription`= `p_product_pdescription`, 
		`price`= `p_products_price`, 
		`cost`= `p_products_cost`
		
	WHERE	`id`= `p_products_id`;
	
END//
DELIMITER ;

-- Dumping structure for procedure database2135020.procedure_select_customer_orders
DELIMITER //
CREATE PROCEDURE `procedure_select_customer_orders`(
	IN `p_customers_id` CHAR(36),
	IN `p_customers_datetime_created` DATETIME
)
BEGIN

	IF p_customers_id = '' AND p_customers_datetime_created = '' THEN
	
		SELECT * 
		FROM orders
		ORDER BY datetime_created;
	
	END IF;
		

		
END//
DELIMITER ;

-- Dumping structure for table database2135020.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` char(36) NOT NULL DEFAULT uuid(),
  `pcode` varchar(12) NOT NULL DEFAULT '0',
  `pdescription` varchar(100) NOT NULL DEFAULT '0',
  `price` decimal(7,2) NOT NULL DEFAULT 0.00,
  `cost` decimal(7,2) DEFAULT 0.00,
  `datetime_created` datetime NOT NULL DEFAULT current_timestamp(),
  `datetime_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  CONSTRAINT `CHK_products_price_sell_lower_or_equal_to_10k` CHECK (`price` <= 10000.00)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database2135020.products: ~3 rows (approximately)
INSERT INTO `products` (`id`, `pcode`, `pdescription`, `price`, `cost`, `datetime_created`, `datetime_updated`) VALUES
	('18926602-6b4d-11ed-a329-005056c00001', 'testcode', 'testdescription', 1234.23, 32.22, '2022-11-23 11:37:08', '2022-11-23 11:37:08'),
	('2cddd46c-6a95-11ed-a329-005056c00001', '123', '123', 112.00, 123.00, '2022-11-22 13:40:36', '2022-11-22 15:48:33'),
	('410c2276-6b4f-11ed-a329-005056c00001', 'asd', 'asdasddd', 22.00, 33.00, '2022-11-23 11:52:35', '2022-11-23 11:52:35');

-- Dumping structure for view database2135020.view_orders_detailed
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `view_orders_detailed` (
	`orderId` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
	`quantity` SMALLINT(3) UNSIGNED NOT NULL,
	`product_price` DECIMAL(7,2) NOT NULL,
	`comments` VARCHAR(200) NULL COLLATE 'utf8mb4_general_ci',
	`orderCreated` DATETIME NOT NULL,
	`orderUpdated` DATETIME NOT NULL,
	`customerId` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
	`firstname` VARCHAR(20) NOT NULL COLLATE 'utf8mb4_general_ci',
	`lastname` VARCHAR(20) NOT NULL COLLATE 'utf8mb4_general_ci',
	`address` VARCHAR(25) NOT NULL COLLATE 'utf8mb4_general_ci',
	`city` VARCHAR(25) NOT NULL COLLATE 'utf8mb4_general_ci',
	`province` VARCHAR(25) NOT NULL COLLATE 'utf8mb4_general_ci',
	`postalcode` VARCHAR(7) NOT NULL COLLATE 'utf8mb4_general_ci',
	`username` VARCHAR(15) NOT NULL COLLATE 'utf8mb4_general_ci',
	`user_password` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_general_ci',
	`picture` MEDIUMBLOB NULL,
	`customerCreated` DATETIME NOT NULL,
	`customerUpdated` DATETIME NOT NULL,
	`productId` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
	`productCode` VARCHAR(12) NOT NULL COLLATE 'utf8mb4_general_ci',
	`productDescription` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
	`price` DECIMAL(7,2) NOT NULL,
	`cost` DECIMAL(7,2) NULL,
	`productCreated` DATETIME NOT NULL,
	`productUpdated` DATETIME NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for view database2135020.view_orders_detailed
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `view_orders_detailed`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_orders_detailed` AS SELECT 
	o.id AS orderId, 
	o.quantity, 
	o.product_price,
	o.comments,
	o.datetime_created AS orderCreated,
	o.datetime_updated AS orderUpdated,
	
	c.id AS customerId,
	c.firstname,
	c.lastname,
	c.address,
	c.city,
	c.province,
	c.postalcode,
	c.username,
	c.user_password,
	c.picture,
	c.datetime_created AS customerCreated,
	c.datetime_updated AS customerUpdated,
	
	p.id AS productId,
	p.pcode AS productCode,
	p.pdescription AS productDescription,
	p.price,
	p.cost,
	p.datetime_created AS productCreated,
	p.datetime_updated AS productUpdated
	
FROM orders o

JOIN customers c
ON o.id_customer = c.id 

JOIN products p
ON o.id_product = p.id

ORDER BY o.datetime_updated ;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
