-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2024 at 02:51 PM
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
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `session_id` bigint(20) NOT NULL,
  `seat_id` varchar(16) NOT NULL,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`session_id`, `seat_id`, `user_id`) VALUES
(1, 'A4', 888),
(1, 'B2', 555);

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`session_id`,`seat_id`,`user_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
