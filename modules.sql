-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2020 at 07:57 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `construction_erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `module_slug` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module_name`, `module_slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Head Of Accounts', 'head_of_accounts', 1, '2019-10-28 11:30:51', '2019-10-28 11:30:51', NULL),
(2, 'Financial', 'financial', 1, '2019-10-28 13:57:46', '2019-10-28 13:57:46', NULL),
(3, 'Reports', 'reports', 1, '2020-04-25 05:33:25', '2020-04-25 05:33:25', NULL),
(4, 'Materials', 'materials', 1, '2020-04-25 05:33:33', '2020-04-25 05:33:33', NULL),
(5, 'Materials Details', 'materials_details', 1, '2020-04-25 05:40:56', '2020-04-25 05:40:56', NULL),
(6, 'Projects', 'projects', 1, '2020-04-25 05:43:14', '2020-04-25 05:43:14', NULL),
(7, 'Property Sale Purchase', 'property_sale_purchase', 1, '2020-04-25 05:44:39', '2020-04-25 05:44:39', NULL),
(8, 'Construction', 'construction', 1, '2020-04-25 05:45:17', '2020-04-25 05:45:17', NULL),
(9, 'Settings', 'settings', 1, '2020-04-25 05:45:50', '2020-04-25 05:45:50', NULL),
(10, 'Approvals', 'approvals', 1, '2020-05-30 11:19:40', '2020-05-30 11:19:40', NULL),
(11, 'Database', 'database', 1, '2020-07-11 08:08:00', '2020-07-11 08:08:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
