-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 02:23 AM
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
(22, 'Junmark', 'Mejorada', 'Timon', '', 'Male', '09/02/1996', 'Single', 'Filipino', 'Roman catholic', '09559387210', 'junmark.timon@asiapro.coop', '1', '1', 'Agay-ayan', 'No', '5', 'College level', 'Farmer', 'Renter', 'N/A', 'N/a', 'N/a', 'Lolito s. timon', 'Father', '09126310910', '2024-11-27 23:44:49', '2024-11-27 23:44:49'),
(23, 'Jhon', 'De', 'Doe', '', 'Male', '01/01/1990', 'Married', 'American', 'Roman catholic', '09126310917', 'jhondoe@gmail.com', '1', '5', 'San luis', 'Yes', '12', 'Masters degree', 'Hacker', 'Renter', 'A+', 'N/a', 'N/a', 'Jean doe', 'Wife', '09126310923', '2024-11-27 23:56:05', '2024-11-27 23:56:05'),
(24, 'Junmark', 'Mejorda', 'Timon', 'Jr', 'Female', '01/01/2000', 'Separated ', 'Filipno', 'Roman catholic', '09559387212', 'sample@gmail.com', '123', '1', 'Lunao', 'No', '5', 'College graduate', 'Labor', 'Home Owner', 'B-', 'N/a', 'N/a', 'Jean the virgin', 'Wife', '09559387320', '2024-11-27 23:58:26', '2024-11-27 23:58:26');

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
-- AUTO_INCREMENT for table `tbl_blotter`
--
ALTER TABLE `tbl_blotter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_resident`
--
ALTER TABLE `tbl_resident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
