-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2024 at 01:09 PM
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
-- Table structure for table `tbl_resident`
--

CREATE TABLE `tbl_resident` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `suffix` varchar(15) DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `civil_status` varchar(10) NOT NULL,
  `nationality` varchar(10) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `house_number` varchar(100) NOT NULL,
  `purok` varchar(100) NOT NULL,
  `brgy` varchar(100) NOT NULL,
  `head_of_family` varchar(50) NOT NULL,
  `household_composition` varchar(50) NOT NULL,
  `educational_attainment` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `type_of_residency` varchar(50) NOT NULL,
  `blood_type` varchar(10) NOT NULL,
  `disabilities` varchar(100) NOT NULL,
  `beneficiary_status` varchar(100) NOT NULL,
  `emergency_contact_person` varchar(150) NOT NULL,
  `emergency_contact_relationship` varchar(50) NOT NULL,
  `emergency_contact_number` varchar(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_resident`
--

INSERT INTO `tbl_resident` (`id`, `fname`, `mname`, `lname`, `suffix`, `gender`, `dob`, `civil_status`, `nationality`, `religion`, `mobile`, `email`, `house_number`, `purok`, `brgy`, `head_of_family`, `household_composition`, `educational_attainment`, `occupation`, `type_of_residency`, `blood_type`, `disabilities`, `beneficiary_status`, `emergency_contact_person`, `emergency_contact_relationship`, `emergency_contact_number`, `updated_at`, `date_created`) VALUES
(19, 'Junmark', 'Mejorda', 'Timon', '', 'Male', '09/02/1996', 'Single', 'Filipino', 'Roman catholic', '09559387210', 'junmark.timon@asiapro.coop', '123', '1', 'Agay-ayan', 'No', '5', 'College graduate', 'It tech support', 'Home Owner', 'N/A', 'No', 'No', 'Lolito s. timon', 'Father', '09126310910', '2024-11-27 11:18:51', '2024-11-27 11:18:25');

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
-- Indexes for table `tbl_resident`
--
ALTER TABLE `tbl_resident`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `tbl_resident`
--
ALTER TABLE `tbl_resident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
