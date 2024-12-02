-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 03:00 PM
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
-- Table structure for table `tbl_activity_log`
--

CREATE TABLE `tbl_activity_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(15) NOT NULL,
  `activity_type` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_activity_log`
--

INSERT INTO `tbl_activity_log` (`id`, `user_id`, `user_type`, `activity_type`, `description`, `date_created`) VALUES
(1, 1, 'admin', 'Add', 'adding new resident - Jhon Doe', '2024-12-02 06:54:49'),
(2, 1, 'admin', 'login', 'login succesfully!', '2024-12-02 08:48:35'),
(3, 0, 'admin', 'login', 'failed', '2024-12-02 08:51:50'),
(4, 0, 'user', 'login', 'failed', '2024-12-02 08:52:04'),
(5, 2, 'user', 'login', 'succesfully', '2024-12-02 08:52:16'),
(6, 1, 'admin', 'login', 'succesfully', '2024-12-02 08:52:36'),
(7, 1, 'admin', 'Add', 'Junmark Mejorada Timon added successfully', '2024-12-02 09:37:19'),
(8, 1, 'admin', 'Add', 'Junmark Mejorada Timon resident added successfully', '2024-12-02 10:19:03'),
(9, 1, 'admin', 'Add', 'Junmark Mejorada Timon resident data already exist', '2024-12-02 10:28:11'),
(10, 1, 'admin', 'login', 'succesfully', '2024-12-02 12:50:14'),
(11, 1, 'admin', 'Update', 'Resident ID:33 - Junmark Mejorada Timon resident updated succesfully', '2024-12-02 13:20:15'),
(12, 1, 'admin', 'login', 'succesfully', '2024-12-02 13:25:40'),
(13, 1, 'admin', 'Update', 'Resident ID: 33 -    failed to updateresident updated', '2024-12-02 13:29:48'),
(14, 1, 'admin', 'Add', 'Junmark Mejorada Timon resident added successfully', '2024-12-02 13:31:30'),
(15, 1, 'admin', 'Update', 'Resident ID: 34 - Junmark Mejorada Timon Jrresident updated succesfully', '2024-12-02 13:32:04'),
(16, 1, 'admin', 'Update', 'Resident ID: 34 -    failed to updateresident updated', '2024-12-02 13:33:41'),
(17, 1, 'admin', 'login', 'succesfully', '2024-12-02 13:34:58'),
(18, 1, 'admin', 'Add', 'Mark Jess Lapid resident added successfully', '2024-12-02 13:36:34'),
(19, 1, 'admin', 'Add', 'Mark Jess Lapid resident added successfully', '2024-12-02 13:56:49'),
(20, 1, 'admin', 'Add', '0 0 0 resident added successfully', '2024-12-02 13:59:22'),
(21, 1, 'admin', 'Delete', 'Resident ID: 37 deleted successfully', '2024-12-02 13:59:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blotter`
--

CREATE TABLE `tbl_blotter` (
  `id` int(11) NOT NULL,
  `complainant_fname` varchar(100) NOT NULL,
  `complainant_mname` varchar(100) DEFAULT NULL,
  `complainant_lname` varchar(100) NOT NULL,
  `complainant_suffix` varchar(10) DEFAULT NULL,
  `complainant_address` varchar(200) NOT NULL,
  `complainant_contact` varchar(11) NOT NULL,
  `respondent_fname` varchar(100) NOT NULL,
  `respondent_mname` varchar(100) DEFAULT NULL,
  `respondent_lname` varchar(100) NOT NULL,
  `respondent_suffix` varchar(10) DEFAULT NULL,
  `respondent_contact` varchar(11) DEFAULT NULL,
  `blotter_type` varchar(50) NOT NULL,
  `details` text NOT NULL,
  `status` varchar(15) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_blotter`
--

INSERT INTO `tbl_blotter` (`id`, `complainant_fname`, `complainant_mname`, `complainant_lname`, `complainant_suffix`, `complainant_address`, `complainant_contact`, `respondent_fname`, `respondent_mname`, `respondent_lname`, `respondent_suffix`, `respondent_contact`, `blotter_type`, `details`, `status`, `updated_at`, `date_created`) VALUES
(1, 'John', 'Lee', 'Doe', 'Jr', 'Lunao, Gingoog City', '09559387243', 'Juan', 'Dela', 'Cruz', NULL, '09126310854', 'Blotter', 'Nangaway', 'Active', '2024-11-28 12:53:18', '2024-11-28 12:23:27');

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
  `precinct_number` varchar(25) DEFAULT NULL,
  `voter_status` varchar(25) NOT NULL,
  `emergency_contact_person` varchar(150) NOT NULL,
  `emergency_contact_relationship` varchar(50) NOT NULL,
  `emergency_contact_number` varchar(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `tbl_activity_log`
--
ALTER TABLE `tbl_activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_blotter`
--
ALTER TABLE `tbl_blotter`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `tbl_activity_log`
--
ALTER TABLE `tbl_activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_blotter`
--
ALTER TABLE `tbl_blotter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_resident`
--
ALTER TABLE `tbl_resident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
