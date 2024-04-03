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
-- Table structure for table `orderedtickets`
--

CREATE TABLE `orderedtickets` (
  `id` bigint(20) NOT NULL,
  `timeV` varchar(30) NOT NULL,
  `dateV` varchar(16) NOT NULL,
  `idForRoom` int(8) NOT NULL,
  `ticket` varchar(30) NOT NULL,
  `sum` varchar(10) NOT NULL,
  `finalPrice` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orderedtickets`
--

INSERT INTO `orderedtickets` (`id`, `timeV`, `dateV`, `idForRoom`, `ticket`, `sum`, `finalPrice`) VALUES
(999, '06:05:00', '2024-04-03', 0, 'A3', 'Adult', 15),
(999, '06:05:00', '2024-04-03', 0, 'A4', 'Child', 15),
(999, '06:05:00', '2024-04-03', 0, 'A3', 'Adult', 15),
(999, '06:05:00', '2024-04-03', 0, 'A4', 'Child', 15),
(999, '06:05:00', '2024-04-03', 0, 'B2', 'Adult', 9),
(999, '06:05:00', '2024-04-03', 0, 'B2', 'Adult', 9),
(999, '06:05:00', '2024-04-03', 0, 'B2', 'Adult', 9),
(999, '06:05:00', '2024-04-03', 0, 'B3', 'Senior', 4),
(999, '06:05:00', '2024-04-03', 0, 'B3', 'Senior', 4),
(999, '06:05:00', '2024-04-03', 0, 'B3', 'Senior', 4),
(999, '06:05:00', '2024-04-03', 0, 'B3', 'Senior', 4),
(999, '06:05:00', '2024-04-03', 0, 'B3', 'Senior', 4),
(999, '06:05:00', '2024-04-03', 0, 'B3', 'Senior', 4),
(999, '06:05:00', '2024-04-03', 0, 'B3', 'Senior', 4),
(999, '06:05:00', '2024-04-03', 0, 'B3', 'Senior', 4),
(999, '06:05:00', '2024-04-03', 0, 'B3', 'Senior', 4),
(999, '06:05:00', '2024-04-03', 0, 'B3', 'Senior', 4),
(999, '06:05:00', '2024-04-03', 0, 'B3', 'Senior', 4),
(999, '06:05:00', '2024-04-03', 0, 'B4', 'Adult', 9),
(999, '06:05:00', '2024-04-03', 0, 'C1', 'Adult', 9);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
