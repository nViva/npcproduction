-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 12, 2021 at 09:39 AM
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `firstName`, `lastName`, `email`, `mobile`, `password`, `userType`, `location`, `status`) VALUES
(5, 'Admin', 'SP Liliane', 'Tuyizere', 'lilituyizere@gmail.com', 788882211, 'e3afed0047b08059d0fada10f400c1e5', 'Admin', '', ''),
(16, 'Viateur', '', '', '', 0, '0c5f83758239530dc5cfbefd2c624d2d', 'Manager', '', ''),
(17, 'Pacy', '', '', '', 0, 'a783925345ac6f54e2a807e483edf6c8', 'Seller', 'Canteen', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
