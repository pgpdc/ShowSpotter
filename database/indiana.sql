-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2024 at 08:30 PM
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
-- Database: `indiana`
--

-- --------------------------------------------------------

--
-- Table structure for table `foodprices`
--

CREATE TABLE `foodprices` (
  `foodItem` varchar(30) NOT NULL,
  `foodPrice` decimal(5,2) NOT NULL,
  `inventory` int(16) NOT NULL,
  `barcode` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `foodprices`
--

INSERT INTO `foodprices` (`foodItem`, `foodPrice`, `inventory`, `barcode`) VALUES
('Large Drink', 8.00, 100, 0),
('Large Popcorn', 10.00, 100, 0),
('Medium Drink', 6.00, 50, 0),
('Medium Popcorn', 8.00, 100, 0),
('Small Drink', 4.00, 0, 0),
('Small Popcorn', 5.00, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `imdbid` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `imageUrl` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`imdbid`, `title`, `imageUrl`) VALUES
('tt0034583', 'Casablanca', 'https://m.media-amazon.com/images/M/MV5BY2IzZGY2YmEtYzljNS00NTM5LTgwMzUtMzM1NjQ4NGI0OTk0XkEyXkFqcGdeQXVyNDYyMDk5MTU@._V1_.jpg'),
('tt0052357', 'Vertigo', 'https://m.media-amazon.com/images/M/MV5BYTE4ODEwZDUtNDFjOC00NjAxLWEzYTQtYTI1NGVmZmFlNjdiL2ltYWdlL2ltYWdlXkEyXkFqcGdeQXVyNjc1NTYyMjg@._V1_.jpg'),
('tt0054215', 'Psycho', 'https://m.media-amazon.com/images/M/MV5BNTQwNDM1YzItNDAxZC00NWY2LTk0M2UtNDIwNWI5OGUyNWUxXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_.jpg'),
('tt0068646', 'The Godfather', 'https://m.media-amazon.com/images/M/MV5BM2MyNjYxNmUtYTAwNi00MTYxLWJmNWYtYzZlODY3ZTk3OTFlXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_.jpg'),
('tt0077952', 'Movie Movie', 'https://m.media-amazon.com/images/M/MV5BOTJlMDIxN2YtYmU0NS00ZjIxLWFiMjgtNjlkZTQ2Y2I1NDQyL2ltYWdlL2ltYWdlXkEyXkFqcGdeQXVyMjI4MjA5MzA@._V1_.jpg'),
('tt0080339', 'Airplane!', 'https://m.media-amazon.com/images/M/MV5BZjA3YjdhMWEtYjc2Ni00YzVlLWI0MTUtMGZmNTJjNmU0Yzk2XkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_.jpg'),
('tt0099785', 'Home Alone', 'https://m.media-amazon.com/images/M/MV5BMzFkM2YwOTQtYzk2Mi00N2VlLWE3NTItN2YwNDg1YmY0ZDNmXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_.jpg'),
('tt0112641', 'Casino', 'https://m.media-amazon.com/images/M/MV5BMTcxOWYzNDYtYmM4YS00N2NkLTk0NTAtNjg1ODgwZjAxYzI3XkEyXkFqcGdeQXVyNTA4NzY1MzY@._V1_.jpg'),
('tt0119282', 'Hercules', 'https://m.media-amazon.com/images/M/MV5BZDcwYjEyNWItMGI1Mi00MjI1LWIyMDEtMTQ4YjhkNjM4NDU3XkEyXkFqcGdeQXVyNDUyOTg3Njg@._V1_.jpg'),
('tt0876563', 'Ponyo', 'https://m.media-amazon.com/images/M/MV5BOTc3YmM3N2QtODZkMC00ZDE5LThjMTQtYTljN2Y1YTYwYWJkXkEyXkFqcGdeQXVyODEzNjM5OTQ@._V1_.jpg'),
('tt1375666', 'Inception', 'https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ordereditems`
--

CREATE TABLE `ordereditems` (
  `userid` varchar(50) NOT NULL,
  `timeV` varchar(30) NOT NULL,
  `dateV` varchar(16) NOT NULL,
  `id` int(8) NOT NULL,
  `itemQuantity` varchar(50) NOT NULL,
  `item` varchar(30) NOT NULL,
  `itemCost` decimal(15,0) NOT NULL,
  `finalItemCost` decimal(15,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ordereditems`
--

INSERT INTO `ordereditems` (`userid`, `timeV`, `dateV`, `id`, `itemQuantity`, `item`, `itemCost`, `finalItemCost`) VALUES
('test8', '00:00:00', '2024-04-29', 1, '1', 'Small Drink', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `orderedtickets`
--

CREATE TABLE `orderedtickets` (
  `user_id` varchar(50) NOT NULL,
  `timeV` varchar(32) NOT NULL,
  `dateV` varchar(16) NOT NULL,
  `id` int(8) NOT NULL,
  `ticketNumber` varchar(15) NOT NULL,
  `ticketName` varchar(30) NOT NULL,
  `ticketCost` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orderedtickets`
--

INSERT INTO `orderedtickets` (`user_id`, `timeV`, `dateV`, `id`, `ticketNumber`, `ticketName`, `ticketCost`) VALUES
('test8', '00:00:00', '2024-04-29', 1, 'A2', 'Adult', '9');

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
('test8', '', 'Graham Smith', '1345555513133333', '12/5', 555, 'Graham Smith', '3333 Street', 'CA', 'NY', 111111, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `ticket` varchar(30) NOT NULL,
  `cost` decimal(30,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`ticket`, `cost`) VALUES
('Adult', 9),
('Child', 6),
('Senior', 4);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `session_id` bigint(20) NOT NULL,
  `seat_id` varchar(16) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `time` varchar(32) NOT NULL,
  `date` varchar(16) NOT NULL,
  `id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`session_id`, `seat_id`, `user_id`, `time`, `date`, `id`) VALUES
(1, 'A1', 'test1', '00:00:00', '2024-04-29', 1),
(1, 'A1', '999', '04:18:00', '2024-04-26', 1),
(1, 'A1', '', '09:07:00', '2024-04-28', 1),
(1, 'A1', '999', '10:25:00', '2024-04-24', 1),
(1, 'A2', 'test8', '00:00:00', '2024-04-29', 1),
(1, 'A2', '999', '04:18:00', '2024-04-26', 1),
(1, 'A2', '', '09:07:00', '2024-04-28', 1),
(1, 'A3', '999', '04:18:00', '2024-04-26', 1),
(1, 'A3', '', '09:07:00', '2024-04-28', 1),
(1, 'A3', '999', '10:25:00', '2024-04-24', 1),
(1, 'A3', '999', '20:00:00', '2024-04-03', 2),
(1, 'A4', '999', '04:18:00', '2024-04-26', 1),
(1, 'A4', '', '09:07:00', '2024-04-28', 1),
(1, 'A4', '999', '10:25:00', '2024-04-24', 1),
(1, 'A4', '999', '10:39:00', '2024-04-17', 1),
(1, 'A5', 'test8', '00:00:00', '2024-04-29', 1),
(1, 'A5', '0', '04:18:00', '2024-04-26', 1),
(1, 'A5', 'test4', '09:07:00', '2024-04-28', 1),
(1, 'A5', '999', '10:25:00', '2024-04-24', 1),
(1, 'A6', '999', '04:18:00', '2024-04-26', 1),
(1, 'A6', 'test4', '09:07:00', '2024-04-28', 1),
(1, 'A7', '0', '04:18:00', '2024-04-26', 1),
(1, 'A7', 'test4', '09:07:00', '2024-04-28', 1),
(1, 'A8', '999', '04:18:00', '2024-04-26', 1),
(1, 'A9', '0', '04:18:00', '2024-04-26', 1),
(1, 'A9', 'test4', '09:07:00', '2024-04-28', 1),
(1, 'B1', '0', '04:18:00', '2024-04-26', 1),
(1, 'B1', 'test4', '09:07:00', '2024-04-28', 1),
(1, 'B2', '0', '04:18:00', '2024-04-26', 1),
(1, 'B2', '999', '10:25:00', '2024-04-24', 1),
(1, 'B3', '0', '04:18:00', '2024-04-26', 1),
(1, 'B3', '999', '10:25:00', '2024-04-24', 1),
(1, 'B4', '', '04:18:00', '2024-04-26', 1),
(1, 'B5', '', '04:18:00', '2024-04-26', 1),
(1, 'B5', '999', '10:25:00', '2024-04-24', 1),
(1, 'B6', '', '04:18:00', '2024-04-26', 1),
(1, 'B6', '999', '10:25:00', '2024-04-24', 1),
(1, 'B7', '', '04:18:00', '2024-04-26', 1),
(1, 'B7', '999', '10:25:00', '2024-04-24', 1),
(1, 'C1', '', '09:07:00', '2024-04-28', 1),
(1, 'C2', '999', '20:00:00', '2024-04-10', 1),
(1, 'C2', '999', '21:00:00', '2024-04-01', 0),
(1, 'C3', '999', '10:00:00', '2024-04-15', 1),
(1, 'C3', '999', '10:25:00', '2024-04-24', 1),
(1, 'C3', '999', '21:00:00', '2024-04-01', 0),
(1, 'C3', '999', '21:00:00', '2024-04-03', 2),
(1, 'C4', 'test1', '00:00:00', '2024-04-29', 1),
(1, 'C4', '', '09:07:00', '2024-04-28', 1),
(1, 'C4', '999', '20:00:00', '2024-04-03', 2),
(1, 'C4', '999', '21:00:00', '2024-04-03', 2),
(1, 'C5', 'test1', '00:00:00', '2024-04-29', 1),
(1, 'C5', '999', '21:00:00', '2024-04-02', 0),
(1, 'C6', 'test1', '00:00:00', '2024-04-29', 1),
(1, 'C6', '999', '20:00:00', '2024-04-03', 2),
(1, 'C7', 'test1', '00:00:00', '2024-04-29', 1),
(1, 'D2', 'test1', '00:00:00', '2024-04-29', 1),
(1, 'D2', '999', '10:25:00', '2024-04-24', 1),
(1, 'D2', '999', '21:00:00', '2024-04-01', 1),
(1, 'D3', 'test8', '00:00:00', '2024-04-29', 1),
(1, 'D3', '999', '21:00:00', '2024-04-01', 0),
(1, 'D4', '', '09:07:00', '2024-04-28', 1),
(1, 'D4', '999', '10:25:00', '2024-04-24', 1),
(1, 'D5', '', '09:07:00', '2024-04-28', 1),
(1, 'D5', '999', '20:00:00', '2024-04-10', 1),
(1, 'D6', '999', '20:00:00', '2024-04-03', 2),
(1, 'D7', '999', '10:25:00', '2024-04-24', 1),
(1, 'E2', '999', '21:00:00', '2024-04-01', 0),
(1, 'E3', '999', '10:25:00', '2024-04-24', 1),
(1, 'E3', '999', '20:00:00', '2024-04-10', 1),
(1, 'E4', 'test1', '00:00:00', '2024-04-29', 1),
(1, 'E6', '999', '10:25:00', '2024-04-24', 1),
(1, 'F1', 'test1', '00:00:00', '2024-04-29', 1),
(1, 'F3', 'test4', '09:07:00', '2024-04-28', 1),
(1, 'F4', '999', '10:25:00', '2024-04-24', 1),
(1, 'F6', '999', '10:00:00', '2024-04-15', 1),
(1, 'F7', 'test1', '00:00:00', '2024-04-29', 1),
(1, 'F8', '999', '20:00:00', '2024-04-10', 1),
(1, 'G2', 'test8', '00:00:00', '2024-04-29', 1),
(1, 'G3', '999', '20:00:00', '2024-04-03', 2),
(1, 'G4', '999', '10:25:00', '2024-04-24', 1),
(1, 'G5', 'test1', '00:00:00', '2024-04-29', 1),
(1, 'G6', '', '09:07:00', '2024-04-28', 1),
(1, 'G7', 'test4', '09:07:00', '2024-04-28', 1),
(1, 'G7', '999', '10:25:00', '2024-04-24', 1),
(1, 'G8', 'test4', '09:07:00', '2024-04-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reservedtimes`
--

CREATE TABLE `reservedtimes` (
  `type` varchar(20) NOT NULL,
  `ticket` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `reservedtimes`
--

INSERT INTO `reservedtimes` (`type`, `ticket`) VALUES
('A1', 'Adult'),
('A2', 'Senior'),
('A3', 'Child'),
('A6', 'Adult'),
('B2', 'Adult'),
('C2', 'Adult'),
('C4', 'Adult'),
('C5', 'Adult'),
('C6', 'Adult'),
('C7', 'Adult'),
('C8', 'Child'),
('D1', 'Adult'),
('D2', 'Adult'),
('D3', 'Adult'),
('D8', 'Senior'),
('E1', 'Adult'),
('E2', 'Adult'),
('E5', 'Adult'),
('E6', 'Senior'),
('F3', 'Adult'),
('F6', 'Adult'),
('F7', 'Child'),
('F8', 'Senior'),
('G7', 'Adult'),
('G8', 'Senior');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `seat_id` varchar(16) NOT NULL,
  `room_id` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`seat_id`, `room_id`) VALUES
('A1', '01'),
('A2', '01'),
('A3', '01'),
('A4', '01'),
('A5', '01'),
('A6', '01'),
('A7', '01'),
('A8', '01'),
('A9', '01'),
('B1', '01'),
('B2', '01'),
('B3', '01'),
('B4', '01'),
('B5', '01'),
('B6', '01'),
('B7', '01'),
('B8', '01'),
('B9', '01'),
('C1', '01'),
('C2', '01'),
('C3', '01'),
('C4', '01'),
('C5', '01'),
('C6', '01'),
('C7', '01'),
('C8', '01'),
('C9', '01'),
('D1', '01'),
('D2', '01'),
('D3', '01'),
('D4', '01'),
('D5', '01'),
('D6', '01'),
('D7', '01'),
('D8', '01'),
('D9', '01'),
('E1', '01'),
('E2', '01'),
('E3', '01'),
('E4', '01'),
('E5', '01'),
('E6', '01'),
('E7', '01'),
('E8', '01'),
('E9', '01'),
('F1', '01'),
('F2', '01'),
('F3', '01'),
('F4', '01'),
('F5', '01'),
('F6', '01'),
('F7', '01'),
('F8', '01'),
('F9', '01'),
('G1', '01'),
('G2', '01'),
('G3', '01'),
('G4', '01'),
('G5', '01'),
('G6', '01'),
('G7', '01'),
('G8', '01'),
('G9', '01');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` bigint(20) NOT NULL,
  `room_id` varchar(16) NOT NULL,
  `session_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `room_id`, `session_date`) VALUES
(1, '01', '2077-06-05 08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `showtimes`
--

CREATE TABLE `showtimes` (
  `id` int(11) NOT NULL,
  `imdbid` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `timestart` time NOT NULL,
  `timeend` time NOT NULL,
  `room_id` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `showtimes`
--

INSERT INTO `showtimes` (`id`, `imdbid`, `date`, `timestart`, `timeend`, `room_id`) VALUES
(9, 'tt0119282', '2024-02-19', '52:33:45', '99:33:45', 'ROOM_A'),
(12, 'tt0080339', '2024-02-19', '19:16:00', '21:16:00', ''),
(13, 'tt0077952', '2024-02-19', '01:36:00', '21:36:00', 'ROOM_A'),
(15, 'tt1375666', '2024-02-21', '16:00:00', '19:00:00', 'ROOMA'),
(17, 'tt0099785', '2024-02-21', '01:00:00', '03:00:00', 'ROOMA'),
(21, 'tt0112641', '2024-02-28', '19:00:00', '10:00:00', '1'),
(24, 'tt0068646', '2024-03-20', '20:00:00', '12:00:00', '01'),
(25, 'tt0068646', '2024-03-25', '21:00:00', '23:59:00', '01'),
(26, 'tt0034583', '2024-03-27', '21:00:00', '23:59:00', '01'),
(27, 'tt0052357', '2024-03-27', '20:00:00', '23:00:00', '01'),
(28, 'tt0052357', '2024-04-01', '21:00:00', '23:59:00', '01'),
(29, 'tt0054215', '2024-04-03', '20:00:00', '23:00:00', '02'),
(30, 'tt0054215', '2024-04-10', '20:00:00', '22:00:00', '1'),
(31, 'tt0054215', '2024-04-15', '10:00:00', '12:00:00', '1'),
(32, 'tt0876563', '2024-04-17', '10:39:00', '00:39:00', '1'),
(33, 'tt0876563', '2024-04-24', '10:25:00', '00:25:00', '1'),
(34, 'tt0876563', '2024-04-25', '20:31:00', '23:45:00', '1'),
(35, 'tt0876563', '2024-05-03', '04:17:00', '07:17:00', '1'),
(36, 'tt0876563', '2024-04-26', '04:18:00', '07:18:00', '1'),
(37, 'tt0876563', '2024-04-28', '09:07:00', '11:07:00', '1'),
(38, 'tt0876563', '2024-04-29', '00:00:00', '03:00:00', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `foodprices`
--
ALTER TABLE `foodprices`
  ADD PRIMARY KEY (`foodItem`),
  ADD UNIQUE KEY `foodPrimary` (`foodItem`,`foodPrice`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD UNIQUE KEY `imdbid` (`imdbid`);

--
-- Indexes for table `paymentinfo`
--
ALTER TABLE `paymentinfo`
  ADD UNIQUE KEY `username` (`username`,`creditNum`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD KEY `ticket` (`ticket`,`cost`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`seat_id`,`time`,`date`,`id`);

--
-- Indexes for table `reservedtimes`
--
ALTER TABLE `reservedtimes`
  ADD PRIMARY KEY (`type`),
  ADD KEY `type` (`type`,`ticket`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`seat_id`,`room_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `session_date` (`session_date`);

--
-- Indexes for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `showtimes`
--
ALTER TABLE `showtimes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
