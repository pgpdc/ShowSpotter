-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2024 at 05:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `ordereditems`
--

CREATE TABLE `ordereditems` (
  `id` bigint(20) NOT NULL,
  `timeV` varchar(30) NOT NULL,
  `dateV` varchar(16) NOT NULL,
  `idForRoom` decimal(11,0) NOT NULL,
  `item` varchar(30) NOT NULL,
  `itemCost` decimal(15,0) NOT NULL,
  `finalItemCost` decimal(15,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ordereditems`
--

INSERT INTO `ordereditems` (`id`, `timeV`, `dateV`, `idForRoom`, `item`, `itemCost`, `finalItemCost`) VALUES
(999, '06:05:00', '2024-04-03', 0, 'largeDrink', 4, 32),
(999, '06:05:00', '2024-04-03', 0, 'mediumDrink', 5, 30),
(999, '06:05:00', '2024-04-03', 0, 'smallDrink', 10, 40),
(999, '06:05:00', '2024-04-03', 0, 'largeDrink', 4, 32),
(999, '06:05:00', '2024-04-03', 0, 'mediumDrink', 5, 30),
(999, '06:05:00', '2024-04-03', 0, 'smallDrink', 10, 40),
(999, '06:05:00', '2024-04-03', 0, 'largeDrink', 2, 16),
(999, '06:05:00', '2024-04-03', 0, 'mediumDrink', 4, 24),
(999, '06:05:00', '2024-04-03', 0, 'smallPopcorn', 8, 40),
(999, '06:05:00', '2024-04-03', 0, 'largeDrink', 2, 16),
(999, '06:05:00', '2024-04-03', 0, 'mediumDrink', 4, 24),
(999, '06:05:00', '2024-04-03', 0, 'smallPopcorn', 8, 40),
(999, '06:05:00', '2024-04-03', 0, 'largeDrink', 2, 16),
(999, '06:05:00', '2024-04-03', 0, 'mediumDrink', 4, 24),
(999, '06:05:00', '2024-04-03', 0, 'smallPopcorn', 8, 40),
(999, '06:05:00', '2024-04-03', 0, 'largeDrink', 1, 8),
(999, '06:05:00', '2024-04-03', 0, 'mediumDrink', 1, 6),
(999, '06:05:00', '2024-04-03', 0, 'smallDrink', 1, 4),
(999, '06:05:00', '2024-04-03', 0, 'largeDrink', 1, 8),
(999, '06:05:00', '2024-04-03', 0, 'mediumDrink', 1, 6),
(999, '06:05:00', '2024-04-03', 0, 'smallDrink', 1, 4),
(999, '06:05:00', '2024-04-03', 0, 'largeDrink', 1, 8),
(999, '06:05:00', '2024-04-03', 0, 'mediumDrink', 1, 6),
(999, '06:05:00', '2024-04-03', 0, 'smallDrink', 1, 4),
(999, '06:05:00', '2024-04-03', 0, 'largeDrink', 1, 8),
(999, '06:05:00', '2024-04-03', 0, 'mediumDrink', 1, 6),
(999, '06:05:00', '2024-04-03', 0, 'smallDrink', 1, 4),
(999, '06:05:00', '2024-04-03', 0, 'largeDrink', 1, 8),
(999, '06:05:00', '2024-04-03', 0, 'mediumDrink', 1, 6),
(999, '06:05:00', '2024-04-03', 0, 'smallDrink', 1, 4),
(999, '06:05:00', '2024-04-03', 0, 'largeDrink', 1, 8),
(999, '06:05:00', '2024-04-03', 0, 'mediumDrink', 1, 6),
(999, '06:05:00', '2024-04-03', 0, 'smallDrink', 1, 4),
(999, '06:05:00', '2024-04-03', 0, 'largeDrink', 1, 8),
(999, '06:05:00', '2024-04-03', 0, 'mediumDrink', 1, 6),
(999, '06:05:00', '2024-04-03', 0, 'smallDrink', 1, 4),
(999, '06:05:00', '2024-04-03', 0, 'largeDrink', 1, 8),
(999, '06:05:00', '2024-04-03', 0, 'mediumDrink', 1, 6),
(999, '06:05:00', '2024-04-03', 0, 'smallDrink', 1, 4),
(999, '06:05:00', '2024-04-03', 0, 'largeDrink', 1, 8),
(999, '06:05:00', '2024-04-03', 0, 'mediumDrink', 1, 6),
(999, '06:05:00', '2024-04-03', 0, 'smallDrink', 1, 4),
(999, '06:05:00', '2024-04-03', 0, 'largeDrink', 1, 8),
(999, '06:05:00', '2024-04-03', 0, 'mediumDrink', 1, 6),
(999, '06:05:00', '2024-04-03', 0, 'smallDrink', 1, 4),
(999, '06:05:00', '2024-04-03', 0, 'largeDrink', 1, 8),
(999, '06:05:00', '2024-04-03', 0, 'mediumDrink', 1, 6),
(999, '06:05:00', '2024-04-03', 0, 'smallDrink', 1, 4),
(999, '06:05:00', '2024-04-03', 0, 'largeDrink', 1, 8),
(999, '06:05:00', '2024-04-03', 0, 'mediumPopcorn', 8, 64),
(999, '06:05:00', '2024-04-03', 0, 'smallPopcorn', 8, 40),
(999, '06:05:00', '2024-04-03', 0, 'largeDrink', 4, 32),
(999, '06:05:00', '2024-04-03', 0, 'mediumDrink', 2, 12),
(999, '06:05:00', '2024-04-03', 0, 'smallPopcorn', 9, 45);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
