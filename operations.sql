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
-- Table structure for table `operations`
--

CREATE TABLE `operations` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `operation_name` varchar(255) NOT NULL,
  `operation_slug` varchar(255) NOT NULL,
  `is_view_visible` int(1) NOT NULL,
  `is_add_visible` int(1) NOT NULL,
  `is_edit_visible` int(1) NOT NULL,
  `is_delete_visible` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `operations`
--

INSERT INTO `operations` (`id`, `module_id`, `operation_name`, `operation_slug`, `is_view_visible`, `is_add_visible`, `is_edit_visible`, `is_delete_visible`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Chart Of Accounts', 'chart_of_accounts', 1, 0, 0, 0, 1, '2019-10-28 11:55:25', '2019-10-28 11:55:25', NULL),
(2, 1, 'Category (Level 2)', 'category', 1, 1, 1, 1, 1, '2019-10-28 11:55:25', '2019-10-28 11:55:25', NULL),
(3, 1, 'Sub Category (Level 3)', 'sub_category', 1, 1, 1, 1, 1, '2019-10-28 14:18:01', '2019-10-28 14:18:01', NULL),
(4, 1, 'Transaction (Level 4)', 'transaction', 1, 1, 1, 1, 1, '2020-04-25 05:55:36', '2020-04-25 05:55:36', NULL),
(5, 2, 'Receipt', 'receipt', 1, 1, 1, 1, 1, '2020-04-25 05:56:43', '2020-04-25 05:56:43', NULL),
(6, 2, 'Payment', 'payment', 1, 1, 1, 1, 1, '2020-04-25 05:57:03', '2020-04-25 05:57:03', NULL),
(7, 2, 'Petty Cash', 'petty_cash', 1, 1, 1, 1, 1, '2020-04-25 05:57:34', '2020-04-25 05:57:34', NULL),
(8, 2, 'General Journal', 'general_journal', 1, 1, 1, 1, 1, '2020-04-25 05:58:03', '2020-04-25 05:58:03', NULL),
(9, 2, 'Check Book Records', 'check_book_records', 1, 1, 1, 1, 1, '2020-04-25 05:58:40', '2020-04-25 05:58:40', NULL),
(10, 3, 'Ledger', 'ledger', 1, 1, 1, 1, 1, '2020-04-25 06:02:07', '2020-04-25 06:02:07', NULL),
(11, 3, 'Trial', 'trial', 1, 1, 1, 1, 1, '2020-04-25 06:02:40', '2020-04-25 06:02:40', NULL),
(12, 3, 'Daily Transaction Report', 'daily_transaction_report', 1, 1, 1, 1, 1, '2020-04-25 06:03:33', '2020-04-25 06:03:33', NULL),
(13, 3, 'Stock Report (Property)', 'stock_report_property', 1, 1, 1, 1, 1, '2020-04-25 06:05:17', '2020-04-25 06:05:17', NULL),
(14, 3, 'Stock Report (Items)', 'stock_report_items', 1, 1, 1, 1, 1, '2020-04-25 06:05:49', '2020-04-25 06:05:49', NULL),
(15, 3, 'Plot Wise Profit Loss', 'plot_wise_profit_loss', 1, 1, 1, 1, 1, '2020-04-25 06:09:45', '2020-04-25 06:09:45', NULL),
(16, 4, 'Purchase', 'purchase', 1, 1, 1, 1, 1, '2020-04-25 06:11:18', '2020-04-25 06:11:18', NULL),
(17, 4, 'Sale', 'sale', 1, 1, 1, 1, 1, '2020-04-25 06:11:46', '2020-04-25 06:11:46', NULL),
(18, 5, 'Item', 'item', 1, 1, 1, 1, 1, '2020-04-25 06:12:19', '2020-04-25 06:12:19', NULL),
(19, 6, 'Project Type', 'project_type', 1, 1, 1, 1, 1, '2020-04-25 06:13:40', '2020-04-25 06:13:40', NULL),
(20, 6, 'Property Area', 'property_area', 1, 1, 1, 1, 1, '2020-04-25 06:14:31', '2020-04-25 06:14:31', NULL),
(21, 6, 'Project', 'project', 1, 1, 1, 1, 1, '2020-04-25 06:15:49', '2020-04-25 06:15:49', NULL),
(22, 7, 'Property Sale', 'property_sale', 1, 1, 1, 1, 1, '2020-04-25 06:17:02', '2020-04-25 06:17:02', NULL),
(23, 7, 'Property Purchase', 'property_purchase', 1, 1, 1, 1, 1, '2020-04-25 06:18:04', '2020-04-25 06:18:04', NULL),
(24, 8, 'Project Property Purchase', 'project_property_purchase', 1, 1, 1, 1, 1, '2020-04-25 06:19:21', '2020-04-25 06:19:21', NULL),
(25, 8, 'Create File', 'create_file', 1, 1, 1, 1, 1, '2020-04-25 06:20:27', '2020-04-25 06:20:27', NULL),
(26, 9, 'Profile', 'profile', 1, 1, 1, 1, 1, '2020-04-25 06:21:10', '2020-04-25 06:21:10', NULL),
(27, 9, 'Business Setting', 'business_setting', 1, 0, 1, 0, 1, '2020-04-25 06:22:08', '2020-04-25 06:22:08', NULL),
(28, 9, 'Users Management', 'users_management', 1, 1, 1, 1, 1, '2020-04-25 06:22:58', '2020-04-25 06:22:58', NULL),
(29, 8, 'Project Sale', 'project_sale', 1, 1, 1, 1, 1, '2020-05-28 10:48:15', '2020-05-28 10:48:15', NULL),
(30, 8, 'Booking Terms', 'booking_terms', 1, 1, 1, 1, 1, '2020-05-28 10:49:08', '2020-05-28 10:49:08', NULL),
(31, 8, 'Construction Contractor', 'construction_contractor', 1, 1, 1, 1, 1, '2020-05-28 10:50:16', '2020-05-28 10:50:16', NULL),
(32, 10, 'Approve Receipt', 'approve_receipt', 1, 1, 1, 1, 1, '2020-05-30 11:21:28', '2020-05-30 11:21:28', NULL),
(33, 10, 'Approve Payment', 'approve_payment', 1, 1, 1, 1, 1, '2020-05-30 11:21:28', '2020-05-30 11:21:28', NULL),
(34, 10, 'Approve Pettycash', 'approve_pettycash', 1, 1, 1, 1, 1, '2020-05-30 11:24:18', '2020-05-30 11:24:18', NULL),
(35, 10, 'Approve General Joural', 'approve_jv', 1, 1, 1, 1, 1, '2020-05-30 11:24:18', '2020-05-30 11:24:18', NULL),
(36, 3, 'Installment Report', 'installment_report', 1, 1, 1, 1, 1, '2020-06-09 08:52:53', '2020-06-09 08:52:53', NULL),
(37, 3, 'Voucher Print', 'voucher_print', 1, 1, 1, 1, 1, '2020-06-09 08:53:12', '2020-06-09 08:53:12', NULL),
(38, 11, 'Import / Export', 'import_export', 1, 1, 1, 1, 1, '2020-07-11 08:08:56', '2020-07-11 08:08:56', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `operations`
--
ALTER TABLE `operations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
