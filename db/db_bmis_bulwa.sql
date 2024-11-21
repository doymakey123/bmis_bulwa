-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2024 at 01:09 PM
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
-- Database: `db_bmis_bulwa`
--

-- --------------------------------------------------------

--
-- Table structure for table `resident`
--

CREATE TABLE `resident` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resident`
--

INSERT INTO `resident` (`id`, `name`, `email`, `age`) VALUES
(22, 'sample22', 'sample4@gmailcom', 22),
(24, 'sample24', 'sample24@gmail.com', 24),
(25, 'sample25', 'sample25@gmaill.com', 25),
(26, 'sample7', 'sample7@gmail.com', 26),
(29, 'sample8', 'sample8@gmail.com', 9),
(30, 'sample9', 'sample9@gmil.com', 12),
(31, 'sample10', 'sample10@gmail.com', 12),
(32, 'sample11', 'sample11@gmail.com', 13),
(34, 'sample12', 'sample12@gmail.com', 15),
(35, 'sample13', 'sample13@gmail.com', 123),
(36, 'sample35', 'sample35@gmail.com', 35),
(37, 'sample37', 'sample37@gmail.com', 330),
(38, 'sample38', 'sample38@gmail.com', 38),
(39, 'sample39', 'sample39@gmail.com', 39),
(40, 'sample40', 'sample40@gmail.com', 40),
(41, 'sample41', 'sample41@gmail.com', 41),
(42, 'sample42', 'sample42@gmail.com', 42),
(43, 'sample43', 'sample43@gmail.com', 43),
(44, 'sample44', 'sample44@gmail.com', 44),
(45, 'sample45', 'sample45@gmail.com', 45),
(46, 'sample46', 'sample46@gmail.com', 46),
(47, 'sample47', 'sample47@gmail.com', 47),
(48, 'sample48', 'sample48@gmail.com', 48),
(49, 'sample49', 'sample49@gmail.com', 49),
(50, 'sample50', 'sample50@gmail.com', 50),
(51, 'sample51', 'sample51@gmail.com', 51),
(52, 'sample52', 'sample52@gmail.com', 52),
(53, 'sample53', 'sample53@gmail.com', 53),
(54, 'sample54', 'sample54@gmail.com', 54);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$PyhU97.jeL4KNvX0xTWhI.nGGFhrzKAOfdUVm9zK9Q7FNbeMv4OGO', 'admin'),
(2, 'user', '$2y$10$3ECP7HFW/sh8VqeD4y3Z2uuBM74TD85rC.m16M.H1QC9WQjGzcMom', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `resident`
--
ALTER TABLE `resident`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `resident`
--
ALTER TABLE `resident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
