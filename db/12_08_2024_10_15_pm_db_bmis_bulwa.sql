-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 03:14 PM
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
(21, 1, 'admin', 'Delete', 'Resident ID: 37 deleted successfully', '2024-12-02 13:59:36'),
(22, 1, 'admin', 'login', 'succesfully', '2024-12-04 00:46:47'),
(23, 1, 'admin', 'login', 'succesfully', '2024-12-04 12:05:47'),
(24, 1, 'admin', 'login', 'succesfully', '2024-12-04 14:07:24'),
(25, 1, 'admin', 'login', 'succesfully', '2024-12-04 14:09:47'),
(26, 1, 'admin', 'login', 'succesfully', '2024-12-04 14:13:20'),
(27, 1, 'admin', 'login', 'succesfully', '2024-12-05 06:37:01'),
(28, 1, 'admin', 'login', 'succesfully', '2024-12-05 12:45:19'),
(29, 1, 'admin', 'Add', 'Junbee Mejorada Timon resident added successfully', '2024-12-05 13:58:33'),
(30, 1, 'admin', 'login', 'succesfully', '2024-12-05 14:03:44'),
(31, 1, 'admin', 'Delete', 'Resident ID: 3 deleted successfully', '2024-12-05 14:03:54'),
(32, 1, 'admin', 'Add', 'Junmbee Mejorada Timon resident added successfully', '2024-12-05 14:06:26'),
(33, 1, 'admin', 'Add', 'Junbee Mejorada Timon resident added successfully', '2024-12-05 14:10:46'),
(34, 1, 'admin', 'Add', 'Junbee Mejorada Timon resident data already exist', '2024-12-05 14:14:26'),
(35, 1, 'admin', 'Delete', 'Resident ID: 5 deleted successfully', '2024-12-05 14:14:51'),
(36, 1, 'admin', 'Delete', 'Resident ID: 2 deleted successfully', '2024-12-05 14:14:54'),
(37, 1, 'admin', 'Delete', 'Resident ID: 1 deleted successfully', '2024-12-05 14:14:56'),
(38, 1, 'admin', 'Add', 'Junmark Mejorada Timon resident added successfully', '2024-12-05 14:17:26'),
(39, 1, 'admin', 'Delete', 'Resident ID: 6 deleted successfully', '2024-12-05 14:19:57'),
(40, 1, 'admin', 'Add', 'Junmark Mejorada Timon resident added successfully', '2024-12-05 14:24:39'),
(41, 1, 'admin', 'Delete', 'Resident ID: 7 deleted successfully', '2024-12-05 14:33:00'),
(42, 1, 'admin', 'Add', 'Junmark Mejorada Timon resident added successfully', '2024-12-05 14:34:25'),
(43, 1, 'admin', 'Delete', 'Resident ID: 8 deleted successfully', '2024-12-05 14:38:48'),
(44, 1, 'admin', 'Add', 'Junmark Mejorada Timon resident added successfully', '2024-12-05 14:40:02'),
(45, 1, 'admin', 'Add', 'Junmbee Mejorada Timon resident added successfully', '2024-12-05 14:45:24'),
(46, 1, 'admin', 'login', 'succesfully', '2024-12-05 15:02:51'),
(47, 1, 'admin', 'login', 'succesfully', '2024-12-05 15:15:40'),
(48, 1, 'admin', 'login', 'succesfully', '2024-12-07 09:57:21'),
(49, 1, 'admin', 'login', 'succesfully', '2024-12-07 10:08:09'),
(50, 1, 'admin', 'login', 'succesfully', '2024-12-07 10:26:12'),
(51, 1, 'admin', 'Update', 'Resident ID: 9 - Junmark Mejorada Timon resident updated succesfully', '2024-12-07 10:41:36'),
(52, 1, 'admin', 'Update', 'Resident ID: 9 - Junmark Mejorada Timon resident updated succesfully', '2024-12-07 10:43:46'),
(53, 1, 'admin', 'Update', 'Resident ID: 9 - Junmark Mejorada Timon resident updated succesfully', '2024-12-07 10:47:27'),
(54, 1, 'admin', 'login', 'succesfully', '2024-12-07 10:49:38'),
(55, 1, 'admin', 'Update', 'Resident ID: 9 - Junmark Mejorada Timon resident updated succesfully', '2024-12-07 10:50:00'),
(56, 1, 'admin', 'Update', 'Resident ID: 9 - Junmark Mejorada Timon resident updated succesfully', '2024-12-07 11:56:35'),
(57, 1, 'admin', 'Update', 'Resident ID: 10 - Junmbee Mejorada Timon resident updated succesfully', '2024-12-07 12:00:47'),
(58, 1, 'admin', 'Update', 'Resident ID: 10 - Junmbee Mejorada Timon resident updated succesfully', '2024-12-07 12:01:11'),
(59, 1, 'admin', 'login', 'succesfully', '2024-12-07 12:01:39'),
(60, 1, 'admin', 'Update', 'Resident ID: 9 - Junmark Mejorada Timon resident updated succesfully', '2024-12-07 12:02:00'),
(61, 1, 'admin', 'Update', 'Resident ID: 10 - Junmbee Mejorada Timon Jrresident updated succesfully', '2024-12-07 16:17:57'),
(62, 1, 'admin', 'Update', 'Resident ID: 9 - Junmark Mejorada Timon resident updated succesfully', '2024-12-07 16:18:20'),
(63, 1, 'admin', 'Update', 'Resident ID: 10 - Junmbee Mejorada Timon Jrresident updated succesfully', '2024-12-07 16:18:45'),
(64, 1, 'admin', 'login', 'succesfully', '2024-12-08 02:01:28'),
(65, 1, 'admin', 'Delete', 'Resident ID: 9 deleted successfully', '2024-12-08 02:03:01'),
(66, 1, 'admin', 'Update', 'Resident ID: 10 - Junmbee Mejorada Timon resident updated succesfully', '2024-12-08 02:03:40'),
(67, 1, 'admin', 'Delete', 'Resident ID: 10 deleted successfully', '2024-12-08 02:03:53'),
(68, 1, 'admin', 'Add', 'Lolito Solana Timon resident added successfully', '2024-12-08 02:06:52'),
(69, 1, 'admin', 'Add', 'Lito See Lapid resident added successfully', '2024-12-08 02:10:04'),
(70, 1, 'admin', 'Add', 'Junmark Mejorada Timon resident added successfully', '2024-12-08 02:11:54'),
(71, 1, 'admin', 'login', 'succesfully', '2024-12-08 02:39:10'),
(72, 1, 'admin', 'login', 'succesfully', '2024-12-08 03:03:26'),
(73, 1, 'admin', 'login', 'succesfully', '2024-12-08 04:46:23'),
(74, 1, 'admin', 'login', 'succesfully', '2024-12-08 04:59:48'),
(75, 1, 'admin', 'login', 'succesfully', '2024-12-08 05:54:04'),
(76, 0, 'admi', 'login', 'failed', '2024-12-08 06:52:39'),
(77, 1, 'admin', 'login', 'succesfully', '2024-12-08 06:52:46'),
(78, 1, 'admin', 'login', 'succesfully', '2024-12-08 09:47:06'),
(79, 1, 'admin', 'login', 'succesfully', '2024-12-08 10:20:06'),
(80, 1, 'admin', 'login', 'succesfully', '2024-12-08 10:26:48'),
(81, 1, 'admin', 'login', 'succesfully', '2024-12-08 10:42:35'),
(82, 1, 'admin', 'login', 'succesfully', '2024-12-08 12:09:38'),
(83, 1, 'admin', 'login', 'succesfully', '2024-12-08 12:15:01'),
(84, 0, 'admin', 'login', 'failed', '2024-12-08 14:04:35'),
(85, 1, 'admin', 'login', 'succesfully', '2024-12-08 14:04:42');

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
(18, 'Junmark', 'Mejorada', 'Timon', '', 'gc', '09121232435', 'Mark', 'Lee', 'Lapid', '', '09234324335', 'Blotter', 'dsfdsfdf', 'Active', '2024-12-08 06:20:10', '2024-12-08 06:20:10'),
(19, 'Junmark', 'Mejorada', 'Timon', '', 'gc', '09876876876', 'Mark', 'Lee', 'Lapid', 'Jr', '09876876786', 'Blotter', 'vbvbbfg', 'Active', '2024-12-08 06:21:04', '2024-12-08 06:21:04'),
(20, 'Junmark', 'Mejorada', 'Timon', '', 'gingoog city', '09123445654', 'Mark', 'Lee', 'Lapid', '', '09121312321', 'Blotter', 'dsfdffd', 'Active', '2024-12-07 06:25:25', '2024-12-07 06:25:25'),
(21, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2024-12-08 10:41:47', '2024-12-08 10:41:47');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brgy_official`
--

CREATE TABLE `tbl_brgy_official` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) NOT NULL,
  `suffix` varchar(50) DEFAULT NULL,
  `position` varchar(15) NOT NULL,
  `rank` varchar(50) NOT NULL,
  `assign_area` varchar(100) NOT NULL,
  `committee` varchar(100) NOT NULL,
  `term` varchar(5) NOT NULL,
  `year_elected` varchar(100) NOT NULL,
  `status` varchar(15) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_brgy_official`
--

INSERT INTO `tbl_brgy_official` (`id`, `fname`, `mname`, `lname`, `suffix`, `position`, `rank`, `assign_area`, `committee`, `term`, `year_elected`, `status`, `date_created`) VALUES
(1, 'Junmark', 'Mejorada', 'Timon', '', 'Captain', '4', 'All', 'All', '1st', '2023', 'Active', '2024-12-08 13:51:42'),
(2, 'Junbee', 'Mejorada', 'Timon', '', 'Kagawad', '4', 'All', 'All', '1st', '2022', 'Active', '2024-12-08 14:10:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resident`
--

CREATE TABLE `tbl_resident` (
  `id` int(11) NOT NULL,
  `household_number` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `suffix` varchar(15) DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `civil_status` varchar(10) NOT NULL,
  `nationality` varchar(10) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `purok` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `voter_status` varchar(50) NOT NULL,
  `precinct_number` varchar(50) DEFAULT NULL,
  `philhealth_number` varchar(100) DEFAULT NULL,
  `sss_gsis_number` varchar(100) DEFAULT NULL,
  `tin_number` varchar(100) DEFAULT NULL,
  `educational_attainment` varchar(200) NOT NULL,
  `employment_status` varchar(100) NOT NULL,
  `occupation` varchar(200) DEFAULT NULL,
  `monthly_annual_income` varchar(50) DEFAULT NULL,
  `pwd_status` varchar(50) NOT NULL,
  `solo_parent_status` varchar(5) DEFAULT NULL,
  `relationship_household_head` varchar(100) DEFAULT NULL,
  `head_of_the_family` varchar(100) DEFAULT NULL,
  `type_of_dwelling` varchar(100) NOT NULL,
  `health_condition` varchar(200) NOT NULL,
  `vaccination_status` varchar(50) NOT NULL,
  `blood_type` varchar(5) NOT NULL,
  `beneficiary_program` varchar(100) DEFAULT NULL,
  `emergency_contact_person` varchar(150) NOT NULL,
  `emergency_contact_relationship` varchar(50) NOT NULL,
  `emergency_contact_number` varchar(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_resident`
--

INSERT INTO `tbl_resident` (`id`, `household_number`, `fname`, `mname`, `lname`, `suffix`, `gender`, `dob`, `civil_status`, `nationality`, `religion`, `purok`, `address`, `mobile`, `email`, `voter_status`, `precinct_number`, `philhealth_number`, `sss_gsis_number`, `tin_number`, `educational_attainment`, `employment_status`, `occupation`, `monthly_annual_income`, `pwd_status`, `solo_parent_status`, `relationship_household_head`, `head_of_the_family`, `type_of_dwelling`, `health_condition`, `vaccination_status`, `blood_type`, `beneficiary_program`, `emergency_contact_person`, `emergency_contact_relationship`, `emergency_contact_number`, `updated_at`, `date_created`) VALUES
(11, '100', 'Lolito', 'Solana', 'Timon', '', 'Male', '01/01/1990', 'Married', 'Filipino', 'Roman Catholic', '1', 'Brgy. Agay-ayan, Gingoog City', '09123456789', 'sample@gmail.com', 'Registered', '100-100', '12345', '12345', '12345', 'Vocational', 'Unemployed', '', '1000', 'No', 'No', 'Head', '', 'Owned', 'None', 'Not Vaccinated', 'O+', 'Senior Citizen Pension', 'Ernita mejorada timon', 'Spouse', '09126310910', '2024-12-08 02:06:52', '2024-12-08 02:06:52'),
(12, '100-100', 'Lito', 'See', 'Lapid', '', 'Male', '01/01/1950', 'Married', 'Filipino', 'Roman Catholic', '2', 'Gingoog City', '12345678907', 'sample@gmail.com', 'Registered', '12345', '12345', '12345', '12345', 'College Level', 'Employed', 'Actor', '1000', 'No', 'No', 'Head', '', 'Owned', 'None', 'Fully Vaccinated', 'A+', 'Other', 'Lita sue lapid', 'Spouse', '09126310910', '2024-12-08 02:10:04', '2024-12-08 02:10:04'),
(13, '100', 'Junmark', 'Mejorada', 'Timon', '', 'Male', '09/02/1996', 'Single', 'Filipino', 'Roman Catholic', '1', 'Brgy. Agay-ayan, Gingoog City', '09123456789', 'sample@gmail.com', 'Registered', '12345', '12345', '12345', '12345', 'Vocational', 'Employed', 'JO', '1000', 'No', 'No', 'Child', 'Lolito Solana Timon ', 'Owned', 'None', 'Fully Vaccinated', 'O+', 'Other', 'Lolito S. Timon', 'Head', '12345678907', '2024-12-08 02:11:54', '2024-12-08 02:11:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sk_official`
--

CREATE TABLE `tbl_sk_official` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) NOT NULL,
  `suffix` varchar(50) DEFAULT NULL,
  `position` varchar(15) NOT NULL,
  `rank` varchar(50) NOT NULL,
  `assign_area` varchar(100) NOT NULL,
  `committee` varchar(100) NOT NULL,
  `term` varchar(5) NOT NULL,
  `year_elected` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_sk_official`
--

INSERT INTO `tbl_sk_official` (`id`, `fname`, `mname`, `lname`, `suffix`, `position`, `rank`, `assign_area`, `committee`, `term`, `year_elected`, `status`, `date_created`) VALUES
(6, 'John', 'Lee', 'Doe', '', 'SK', '1', 'All', 'All', '3rd', '2023', 'Active', '2024-12-08 11:34:01'),
(7, 'Junbee', 'Mejorada', 'Timon', '', 'Kagawad', '1', 'All', 'All', '2nd', '2019', 'Not active', '2024-12-08 11:34:31');

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
-- Indexes for table `tbl_brgy_official`
--
ALTER TABLE `tbl_brgy_official`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_resident`
--
ALTER TABLE `tbl_resident`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sk_official`
--
ALTER TABLE `tbl_sk_official`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `tbl_blotter`
--
ALTER TABLE `tbl_blotter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_brgy_official`
--
ALTER TABLE `tbl_brgy_official`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_resident`
--
ALTER TABLE `tbl_resident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_sk_official`
--
ALTER TABLE `tbl_sk_official`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
