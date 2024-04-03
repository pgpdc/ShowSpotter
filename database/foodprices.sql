-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2024 at 05:15 PM
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
-- Table structure for table `foodprices`
--

CREATE TABLE `foodprices` (
  `foodItem` varchar(30) NOT NULL,
  `foodPrice` decimal(5,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `foodprices`
--

INSERT INTO `foodprices` (`foodItem`, `foodPrice`) VALUES
('largeDrink', 8),
('largePopcorn', 10),
('mediumDrink', 6),
('mediumPopcorn', 8),
('smallDrink', 4),
('smallPopcorn', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `foodprices`
--
ALTER TABLE `foodprices`
  ADD PRIMARY KEY (`foodItem`),
  ADD UNIQUE KEY `foodPrimary` (`foodItem`,`foodPrice`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
