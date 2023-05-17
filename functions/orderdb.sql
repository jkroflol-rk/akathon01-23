-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: ictstu-db1.cc.swin.edu.au
-- Generation Time: Apr 09, 2023 at 10:30 AM
-- Server version: 5.5.68-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `s104169523_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `orderdb`
--

CREATE TABLE IF NOT EXISTS `orderdb` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `state` varchar(50) NOT NULL,
  `post` varchar(50) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `prefercont` enum('email','post','phone') NOT NULL,
  `pc` int(11) NOT NULL,
  `mouse` int(11) NOT NULL,
  `kb` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_cost` int(11) NOT NULL,
  `card` varchar(20) NOT NULL,
  `cardname` varchar(50) NOT NULL,
  `expmonth` varchar(2) NOT NULL,
  `expyear` varchar(2) NOT NULL,
  `cvv` varchar(3) NOT NULL,
  `order_status` enum('PENDING','FULLFILLED','PAID','ARCHIVED') NOT NULL DEFAULT 'PENDING',
  `order_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`),
  KEY `pc` (`pc`),
  KEY `mouse` (`mouse`),
  KEY `kb` (`kb`),
  CONSTRAINT `orderdb_ibfk_1` FOREIGN KEY (`pc`) REFERENCES `pcdb` (`pc`),
  CONSTRAINT `orderdb_ibfk_2` FOREIGN KEY (`mouse`) REFERENCES `mousedb` (`mouse`),
  CONSTRAINT `orderdb_ibfk_3` FOREIGN KEY (`kb`) REFERENCES `kbdb` (`kb`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
