-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2024 at 02:51 PM
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
-- Table structure for table `paymentinfo`
--

CREATE TABLE `paymentinfo` (
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `cardName` varchar(50) NOT NULL,
  `creditNum` varchar(20) NOT NULL,
  `expDate` varchar(10) NOT NULL,
  `cvv` int(5) NOT NULL,
  `name` text NOT NULL,
  `address` varchar(40) NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `zipCode` int(10) NOT NULL,
  `billSame` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `paymentinfo`
--

INSERT INTO `paymentinfo` (`username`, `password`, `cardName`, `creditNum`, `expDate`, `cvv`, `name`, `address`, `city`, `state`, `zipCode`, `billSame`) VALUES
('', '', '', '', '', 0, '', '', '', '', 0, ''),
('', '', '', '', '', 0, '', '', '', '', 0, ''),
('', '', '', '', '', 0, '', '', '', '', 0, ''),
('test3', 'f54', 'fsdfsdf', '4324324', '324324', 432, 'sfsfsd', '', 'were', 'rewr', 4334, 'yes'),
('', '', '', '', '', 0, '', '', '', '', 0, ''),
('AGar', 'djkwd', 'Graham Smith', '1656-3747-4843-3333', '12/23', 432, 'Graham Smith', '3333 Street', 'City', 'PA', 27463, 'yes'),
('', '', '', '', '', 0, '', '', '', '', 0, '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
