-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 14, 2021 at 05:25 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `npc_super`
--

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

DROP TABLE IF EXISTS `balance`;
CREATE TABLE IF NOT EXISTS `balance` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `capital` decimal(65,0) NOT NULL,
  `difference` decimal(65,0) NOT NULL,
  `balance` decimal(65,0) NOT NULL,
  `month` varchar(65) NOT NULL,
  `reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `client_name` varchar(65) NOT NULL,
  `clients_number` int NOT NULL,
  `price` decimal(15,0) NOT NULL,
  PRIMARY KEY (`client_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_name`, `clients_number`, `price`) VALUES
('BCIC', 108, '1200'),
('PPS', 140, '1200'),
('ICT', 86, '1200'),
('LAW', 140, '1200'),
('PSCSC', 36, '1500');

-- --------------------------------------------------------

--
-- Table structure for table `damages`
--

DROP TABLE IF EXISTS `damages`;
CREATE TABLE IF NOT EXISTS `damages` (
  `damagesId` int NOT NULL AUTO_INCREMENT,
  `productId` int NOT NULL,
  `quantity` int NOT NULL,
  `explanation` text NOT NULL,
  `purchasing_price` int NOT NULL,
  `damagesDate` date NOT NULL,
  `location` varchar(255) NOT NULL,
  PRIMARY KEY (`damagesId`),
  KEY `productId` (`productId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `damages`
--

INSERT INTO `damages` (`damagesId`, `productId`, `quantity`, `explanation`, `purchasing_price`, `damagesDate`, `location`) VALUES
(1, 3, 1, 'Icupa ryarifunguye', 400, '2021-11-14', 'Canteen'),
(2, 9, 1, 'Ntafuro yari ifite', 504, '2021-11-14', 'VIP');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `emp_id` bigint NOT NULL,
  `emp_name` varchar(255) NOT NULL,
  `job_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `salary` decimal(65,0) NOT NULL,
  `bonus` decimal(65,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `emp_id`, `emp_name`, `job_name`, `location`, `salary`, `bonus`) VALUES
(1, 1199080025749573, 'Mupenzi', 'Berber', 'Berbershop', '35000', '0'),
(2, 1199880016220031, 'Viateur', 'Manager', '', '0', '100000'),
(3, 1199070043725371, 'Kakwezi', 'Seller', 'Canteen', '40000', '0');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `month` date NOT NULL,
  `item` varchar(255) NOT NULL,
  `req_quantity` int NOT NULL,
  `unit_price` decimal(40,0) NOT NULL,
  `total_price` decimal(40,0) NOT NULL,
  `approved_quantity` int NOT NULL,
  `location` varchar(255) NOT NULL,
  `status` varchar(65) NOT NULL,
  `action` varchar(65) NOT NULL,
  `purchased` varchar(65) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `month`, `item`, `req_quantity`, `unit_price`, `total_price`, `approved_quantity`, `location`, `status`, `action`, `purchased`) VALUES
(1, '2021-11-14', 'Imichine yogosha', 2, '75000', '150000', 2, 'Berbershop', 'approved', 'deleted', 'yes'),
(2, '2021-11-14', 'Ibirahuri byo kunywa inzoga', 20, '2000', '40000', 20, 'VIP', 'approved', 'deleted', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` int NOT NULL AUTO_INCREMENT,
  `client_name` varchar(100) NOT NULL,
  `amount_paid` decimal(20,0) NOT NULL,
  `debit` decimal(20,0) NOT NULL,
  `recovery` decimal(20,0) NOT NULL,
  `month` varchar(255) NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `client_name`, `amount_paid`, `debit`, `recovery`, `month`) VALUES
(1, 'BCIC', '129600', '0', '0', '2021-11'),
(2, 'ICT', '100000', '0', '0', '2021-11'),
(3, 'ICT', '106400', '0', '3200', '2021-12'),
(4, 'PSCSC', '54000', '0', '0', '2021-11'),
(5, 'LAW', '168000', '0', '0', '2021-11');

-- --------------------------------------------------------

--
-- Table structure for table `photocopy`
--

DROP TABLE IF EXISTS `photocopy`;
CREATE TABLE IF NOT EXISTS `photocopy` (
  `id` int NOT NULL AUTO_INCREMENT,
  `datee` date NOT NULL,
  `indxe` int NOT NULL,
  `copies_nber` int NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photocopy_pricing`
--

DROP TABLE IF EXISTS `photocopy_pricing`;
CREATE TABLE IF NOT EXISTS `photocopy_pricing` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `page_price` decimal(20,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `productId` int NOT NULL AUTO_INCREMENT,
  `productName` varchar(25) NOT NULL,
  `purchasingPrice` decimal(65,0) NOT NULL,
  `sellingPrice` decimal(65,0) NOT NULL,
  `balance` int NOT NULL,
  `location` varchar(255) NOT NULL,
  PRIMARY KEY (`productId`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productId`, `productName`, `purchasingPrice`, `sellingPrice`, `balance`, `location`) VALUES
(1, 'Fanta 30cl', '420', '500', 20, 'Canteen'),
(2, 'Primus 50cl', '420', '500', 0, 'Canteen'),
(3, 'Juice inyange 250ml', '400', '500', 9, 'Canteen'),
(4, 'Miitzig big', '866', '1000', 30, 'Canteen'),
(5, 'KISS', '1083', '1500', 20, 'VIP'),
(6, 'Skol Canete', '1200', '1500', 10, 'VIP'),
(7, 'Fanta 30cl', '420', '500', 30, 'VIP'),
(8, 'Heineken', '700', '1000', 0, 'VIP'),
(9, 'Amstel', '504', '600', 29, 'VIP');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE IF NOT EXISTS `purchases` (
  `purchasesId` int NOT NULL AUTO_INCREMENT,
  `productId` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(65,0) NOT NULL,
  `purchaseDate` date NOT NULL,
  `location` varchar(255) NOT NULL,
  PRIMARY KEY (`purchasesId`),
  KEY `productId` (`productId`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchasesId`, `productId`, `quantity`, `price`, `purchaseDate`, `location`) VALUES
(1, 3, 100, '400', '2021-11-14', 'Canteen'),
(2, 4, 80, '866', '2021-11-14', 'Canteen'),
(3, 1, 120, '420', '2021-11-14', 'Canteen'),
(4, 5, 50, '1083', '2021-11-14', 'VIP'),
(5, 7, 150, '420', '2021-11-14', 'VIP'),
(6, 9, 180, '504', '2021-11-14', 'VIP'),
(7, 6, 80, '1200', '2021-11-14', 'VIP');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE IF NOT EXISTS `requests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `productName` varchar(255) NOT NULL,
  `quantity_in_stock` varchar(255) NOT NULL,
  `purchasing_price` decimal(25,0) NOT NULL,
  `requested_quantity` int NOT NULL,
  `approved_quantity` int NOT NULL,
  `selling_price` decimal(25,0) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(65) NOT NULL,
  `action` varchar(250) NOT NULL,
  `purchased` varchar(65) NOT NULL,
  `location` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `productName`, `quantity_in_stock`, `purchasing_price`, `requested_quantity`, `approved_quantity`, `selling_price`, `date`, `status`, `action`, `purchased`, `location`) VALUES
(1, 'Fanta 30cl', '0', '420', 150, 0, '500', '2021-11-14', 'rejected', 'deleted', '', 'Canteen'),
(2, 'Juice inyange 250ml', '0', '400', 100, 100, '500', '2021-11-14', 'approved', 'deleted', 'yes', 'Canteen'),
(3, 'Miitzig big', '0', '866', 80, 80, '1000', '2021-11-14', 'approved', 'deleted', 'yes', 'Canteen'),
(4, 'Fanta 30cl', '0', '420', 120, 120, '500', '2021-11-14', 'approved', 'deleted', 'yes', 'Canteen'),
(5, 'KISS', '0', '1083', 50, 50, '1500', '2021-11-14', 'approved', 'deleted', 'yes', 'VIP'),
(6, 'Fanta 30cl', '0', '420', 150, 150, '500', '2021-11-14', 'approved', 'deleted', 'yes', 'VIP'),
(7, 'Amstel', '0', '504', 180, 180, '600', '2021-11-14', 'approved', 'deleted', 'yes', 'VIP'),
(8, 'Skol Canete', '0', '1200', 80, 80, '1500', '2021-11-14', 'approved', 'deleted', 'yes', 'VIP');

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

DROP TABLE IF EXISTS `salaries`;
CREATE TABLE IF NOT EXISTS `salaries` (
  `salary_id` int NOT NULL AUTO_INCREMENT,
  `month` varchar(65) NOT NULL,
  `emp_id` int NOT NULL,
  `salary_amount` decimal(65,0) NOT NULL,
  `bonuses` decimal(65,0) NOT NULL,
  `amount_paid` decimal(65,0) NOT NULL,
  `left_amount` decimal(65,0) NOT NULL,
  PRIMARY KEY (`salary_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`salary_id`, `month`, `emp_id`, `salary_amount`, `bonuses`, `amount_paid`, `left_amount`) VALUES
(1, '2021-11', 2, '0', '100000', '0', '0'),
(2, '2021-11', 1, '35000', '0', '0', '0'),
(3, '2021-11', 3, '40000', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `salesId` int NOT NULL AUTO_INCREMENT,
  `productId` int NOT NULL,
  `purchasing_price` int NOT NULL,
  `quantity` int NOT NULL,
  `selling_price` decimal(65,0) NOT NULL,
  `salesDate` date NOT NULL,
  `location` varchar(255) NOT NULL,
  PRIMARY KEY (`salesId`),
  KEY `productId` (`productId`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`salesId`, `productId`, `purchasing_price`, `quantity`, `selling_price`, `salesDate`, `location`) VALUES
(1, 1, 420, 70, '500', '2021-11-14', 'Canteen'),
(2, 4, 866, 30, '1000', '2021-11-14', 'Canteen'),
(3, 1, 420, 30, '500', '2021-11-14', 'Canteen'),
(4, 3, 400, 90, '500', '2021-11-14', 'Canteen'),
(5, 4, 866, 20, '1000', '2021-11-14', 'Canteen'),
(6, 9, 504, 100, '600', '2021-11-14', 'VIP'),
(7, 9, 504, 50, '600', '2021-11-14', 'VIP'),
(8, 6, 1200, 70, '1500', '2021-11-14', 'VIP'),
(9, 7, 420, 120, '500', '2021-11-14', 'VIP'),
(10, 5, 1083, 20, '1500', '2021-11-14', 'VIP'),
(11, 5, 1083, 10, '1500', '2021-11-14', 'VIP');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int NOT NULL AUTO_INCREMENT,
  `userName` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` int NOT NULL,
  `password` varchar(255) NOT NULL,
  `userType` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `status` varchar(65) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `firstName`, `lastName`, `email`, `mobile`, `password`, `userType`, `location`, `status`) VALUES
(5, 'Admin', 'SP Liliane', 'Tuyizere', 'lilituyizere@gmail.com', 788882211, 'e3afed0047b08059d0fada10f400c1e5', 'Admin', '', ''),
(20, 'Pacy', 'CPL Pacifique', 'Dusengimana', 'dusengepac@gmail.com', 783562394, 'ed8a3ab682107bf42cdc494247a7fe5e', 'Seller', 'Canteen', ''),
(21, 'Media', '', '', '', 0, '5a11e0bd65af42743f1db2f10bcbba8e', 'Seller', 'VIP', ''),
(19, 'Viateur', 'OC Viateur', 'Nshimiyimana', 'nvipolite@gmail.com', 788835739, '756d97bb256b8580d4d71ee0c547804e', 'Manager', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
