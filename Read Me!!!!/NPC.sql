-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 30, 2021 at 08:44 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `npc`
--

-- --------------------------------------------------------
CREATE DATABASE NPC;
USE NPC;
--
-- Table structure for table `damages`
--

DROP TABLE IF EXISTS `damages`;
CREATE TABLE IF NOT EXISTS `damages` (
  `damagesId` int(11) NOT NULL AUTO_INCREMENT,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `selling_price` decimal(10,0) NOT NULL,
  `damagesDate` date NOT NULL,
  PRIMARY KEY (`damagesId`),
  KEY `productId` (`productId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `damages`
--

INSERT INTO `damages` (`damagesId`, `productId`, `quantity`, `selling_price`, `damagesDate`) VALUES
(1, 3, 1, '700', '2021-07-26'),
(2, 6, 2, '100', '2021-07-29'),
(3, 4, 3, '100', '2021-07-29');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `productId` int(25) NOT NULL AUTO_INCREMENT,
  `productName` varchar(25) NOT NULL,
  `purchasingPrice` decimal(65,0) NOT NULL,
  `sellingPrice` decimal(65,0) NOT NULL,
  `balance` int(25) NOT NULL,
  PRIMARY KEY (`productId`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productId`, `productName`, `purchasingPrice`, `sellingPrice`, `balance`) VALUES
(1, 'Big White Soap', '1300', '1500', 40),
(3, 'Small White Soap', '500', '700', 89),
(4, 'Egg', '80', '100', 97),
(5, 'Movit Jelly', '1300', '1500', 8),
(6, 'Indimu', '70', '100', 28),
(7, 'Fanta 30cl', '370', '400', 50);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE IF NOT EXISTS `purchases` (
  `purchasesId` int(11) NOT NULL AUTO_INCREMENT,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(65,0) NOT NULL,
  `purchaseDate` date NOT NULL,
  PRIMARY KEY (`purchasesId`),
  KEY `productId` (`productId`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchasesId`, `productId`, `quantity`, `price`, `purchaseDate`) VALUES
(1, 1, 50, '1300', '2021-07-26'),
(2, 3, 100, '500', '2021-07-26'),
(3, 5, 10, '1300', '2021-07-26'),
(4, 6, 100, '70', '2021-07-27'),
(5, 7, 100, '370', '2021-07-29'),
(6, 4, 100, '80', '2021-07-28');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `salesId` int(11) NOT NULL AUTO_INCREMENT,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `selling_price` decimal(65,0) NOT NULL,
  `salesDate` date NOT NULL,
  PRIMARY KEY (`salesId`),
  KEY `productId` (`productId`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`salesId`, `productId`, `quantity`, `selling_price`, `salesDate`) VALUES
(1, 1, 10, '1500', '2021-07-26'),
(2, 5, 2, '1500', '2021-07-26'),
(3, 6, 50, '100', '2021-07-27'),
(4, 3, 10, '700', '2021-07-29'),
(5, 6, 20, '100', '2021-07-29'),
(6, 7, 50, '400', '2021-07-29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` int(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `firstName`, `lastName`, `email`, `mobile`, `password`) VALUES
(1, 'Viateur', 'Viateur', 'NSHIMIYIMANA', 'nvipolite@gmail.com', 782014638, '69739f614a29defd44644128719cf882');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
