-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2020 at 07:14 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `neemsah_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `accommodations`
--

CREATE TABLE `accommodations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_expenditure_id` bigint(20) UNSIGNED NOT NULL,
  `hotel_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hotel_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_night` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facilities` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accommodations`
--

INSERT INTO `accommodations` (`id`, `emp_expenditure_id`, `hotel_name`, `hotel_address`, `contact_name`, `contact_phone`, `contact_email`, `no_of_night`, `facilities`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 5, 'fsdfsdsdf1', 'dsfsdf1', 'sdfs1', 'sdfsd1', 'dsfds1', 'sdfsdf1', 'sdf1', 1, 1, '2020-03-07 10:05:50', '2020-03-07 10:59:27');

-- --------------------------------------------------------

--
-- Table structure for table `assign_targets`
--

CREATE TABLE `assign_targets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `target_year` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_months` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quarterly_amount` double(10,2) NOT NULL DEFAULT '0.00',
  `quarterly_achieve_amount` double(10,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1=Active, 2=Inactive',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assign_targets`
--

INSERT INTO `assign_targets` (`id`, `user_id`, `target_year`, `target_months`, `quarterly_amount`, `quarterly_achieve_amount`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 13, '2019', '10-2019, 11-2019, 12-2019', 375555.50, 71803.00, 1, 1, NULL, '2020-02-05 19:18:24', '2020-02-06 04:17:59'),
(2, 13, '2019', '07-2019, 08-2019, 09-2019', 375555.50, 0.00, 1, 1, NULL, '2020-02-05 19:18:24', '2020-02-05 19:18:24'),
(3, 13, '2019', '04-2019, 05-2019, 06-2019', 375555.50, 0.00, 1, 1, NULL, '2020-02-05 19:18:25', '2020-02-05 19:18:25'),
(4, 13, '2019', '01-2019, 02-2019, 03-2019', 375555.50, 201500.00, 1, 1, NULL, '2020-02-05 19:18:25', '2020-02-06 04:21:11'),
(5, 13, '2020', '10-2020, 11-2020, 12-2020', 2250000.00, 0.00, 1, 1, NULL, '2020-02-05 19:19:05', '2020-02-05 19:19:05'),
(6, 13, '2020', '07-2020, 08-2020, 09-2020', 2250000.00, 0.00, 1, 1, NULL, '2020-02-05 19:19:05', '2020-02-05 19:19:05'),
(7, 13, '2020', '04-2020, 05-2020, 06-2020', 2250000.00, 0.00, 1, 1, NULL, '2020-02-05 19:19:05', '2020-02-05 19:19:05'),
(8, 13, '2020', '01-2020, 02-2020, 03-2020', 2250000.00, 0.00, 1, 1, NULL, '2020-02-05 19:19:05', '2020-02-06 04:21:11');

-- --------------------------------------------------------

--
-- Table structure for table `borrow_details`
--

CREATE TABLE `borrow_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_expenditure_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `purpose` tinyint(3) UNSIGNED NOT NULL COMMENT '1=Borrow Repay, 2=Borrow Give',
  `status` tinyint(3) UNSIGNED NOT NULL COMMENT '0=Nothing, 1=Giver,2=Borrower',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `budget_allocations`
--

CREATE TABLE `budget_allocations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `allocation_date` date NOT NULL,
  `purpose` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` float NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '''1=Active, 0=Inactive''',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budget_allocations`
--

INSERT INTO `budget_allocations` (`id`, `allocation_date`, `purpose`, `amount`, `details`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, '2020-03-06', 'sdfsd5', 4563460, NULL, 1, 1, 1, '2020-03-06 04:15:53', '2020-03-06 05:02:23'),
(4, '2021-03-10', 'sdfjlk', 555555, NULL, 0, 1, 1, '2020-03-06 04:57:11', '2020-03-06 09:07:15');

-- --------------------------------------------------------

--
-- Table structure for table `business_years`
--

CREATE TABLE `business_years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1=Active, 2=Inactive',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ELPRESS_HYGIENE_EQUIPMENT_WASHING_SYSTEM', NULL, 1, '2019-11-17 03:22:37', '2020-01-30 11:55:53'),
(2, 'SESOTEC_METAL_DETECTOR_X-RAY_MAGNET', NULL, 1, '2019-11-17 03:23:49', '2020-01-30 11:55:30'),
(3, 'IMA HASSIA INDIA_VFFS_PACKAGING_MACHINE', NULL, 1, '2020-01-30 11:53:39', '2020-01-30 11:55:12'),
(4, 'LabThink_Packaging_Testing_Machine', NULL, 1, '2020-01-30 11:53:47', '2020-01-30 11:54:50'),
(5, 'PerkinElmer(Perten)_Lab_Equipment', NULL, 1, '2020-01-30 11:54:04', '2020-01-30 11:54:36'),
(6, 'Gostol_Bakery_Line', NULL, 1, '2020-01-30 11:54:25', '2020-01-30 11:54:25'),
(7, 'IMA_HASSSIA_GERMANY_FILLING_LINE', NULL, 1, '2020-01-30 11:56:30', '2020-01-30 11:56:30'),
(8, 'AMS_FERRARI_FILLING_LINE', NULL, 1, '2020-01-30 11:56:42', '2020-01-30 11:56:42'),
(9, 'OCRIM_FLOUR_MILL', NULL, 1, '2020-01-30 11:57:19', '2020-01-30 11:57:19'),
(10, 'AXOR_OCRIM_PASTA_LINE', NULL, 1, '2020-01-30 11:57:31', '2020-01-30 11:57:31'),
(11, 'BALAGUER_ROLLS', NULL, 1, '2020-01-30 11:57:46', '2020-01-30 11:57:46'),
(12, 'TECHNOGEL_ICE_CREAM_LINE', NULL, 1, '2020-01-30 11:58:16', '2020-01-30 11:58:16');

-- --------------------------------------------------------

--
-- Table structure for table `company_visits`
--

CREATE TABLE `company_visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_doc_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visited_company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visited_company_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1=Follow Up Need, 2=No Need Follow Up,3=Need Quotation,4=Quotation Submitted, 5=Fail to sale,6=Success to Sale,7=Technical Discussion,8=PI Needed,9=PI Submitted, 10=Draft LC Open 11=LC Open',
  `quotation_value` double(11,2) NOT NULL DEFAULT '0.00' COMMENT 'Quotation value will be Sale value when complete sale',
  `profit_value` double(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Profit Value==Commission',
  `profit_percent` float(4,2) NOT NULL DEFAULT '0.00',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `visited_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_visits`
--

INSERT INTO `company_visits` (`id`, `category_id`, `product_name`, `product_doc_file`, `visited_company`, `visited_company_address`, `status`, `quotation_value`, `profit_value`, `profit_percent`, `created_by`, `updated_by`, `visited_by`, `created_at`, `updated_at`) VALUES
(24, 2, 'Magnet', NULL, 'Nestle Bangladesh Ltd.', '227/A Bir Uttam Mir Showkat Ali Road, 1208 Tejgaon Farm, Dhaka, Bangladesh', 11, 201500.00, 1511.00, 7.50, 13, 1, NULL, '2020-01-30 13:22:02', '2020-02-06 04:19:51'),
(25, 2, 'Flakes sorter & Metal separator', NULL, 'Akij Food & Beverage Ltd.', 'Akij House, 198 Bir Uttam, Mir Shawkat Sarak, Gulshan Link Road, Tejgaon, Dhaka-1208', 10, 480000.00, 0.00, 0.00, 13, 13, NULL, '2020-01-30 13:40:19', '2020-01-31 10:26:32'),
(26, 2, 'Metal detector', NULL, 'Habigonj Agro Ltd.(Pran Group)', 'Olipur,Shahjibazar,Habigonj', 11, 239632.00, 11981.00, 5.00, 13, 13, NULL, '2020-01-30 14:13:16', '2020-01-31 09:31:08'),
(27, 2, 'Metal detector', 'product_file/2020/01/30/8349PI-20190917-003.pdf', 'Pran Foods Ltd.', 'Dhaka,Bangladesh', 11, 71803.00, 3590.00, 5.00, 13, 1, NULL, '2020-01-30 14:40:43', '2020-02-05 20:09:29'),
(28, 5, 'Falling Number,Dough Lab,RVA,BVM,Glutomatic,TVT', NULL, 'Akij Group', '198,Bir uttam Mir Shawkat Sarak Gulshan Link Road Tejgaon,Dhaka-1208', 7, 0.00, 0.00, 0.00, 17, 1, 17, '2020-02-02 13:55:22', '2020-03-02 17:34:22'),
(29, 5, 'DA 7250 NIR', NULL, 'PRAN Agro Ltd', 'Pran RFL Center, Pragati Sharani, Gulshan,Dhaka.', 3, 0.00, 0.00, 0.00, 17, NULL, 17, '2020-02-03 10:09:51', '2020-02-03 10:09:51'),
(30, 5, 'DA 7250 NIR', NULL, 'Kashem Food', 'ICON CENTER, BARIDHARA, DHAKA', 3, 0.00, 0.00, 0.00, 17, NULL, 17, '2020-02-03 10:18:16', '2020-02-03 10:18:16'),
(31, 5, 'Bio AuroFlow for milk,RVA,Dough Lab,TVT,DA7250', NULL, 'Newzealand Dairy', 'Dhaka-Sylhet High Way,Narayangonj', 3, 0.00, 0.00, 0.00, 17, NULL, 17, '2020-02-03 10:24:18', '2020-02-03 10:24:18'),
(32, 5, 'IM-9520,FT-NIR', NULL, 'TK Group', '19,Tarabo,Rupgonj, Narayangonj.', 2, 0.00, 0.00, 0.00, 17, NULL, 17, '2020-02-03 10:33:22', '2020-02-03 10:33:22'),
(33, 5, 'Falling Number,Glutomatic,TVT,Milk Analyzer(Bioo AuroFlow)', NULL, 'Olympic', 'Keodhala,Madanpur, Narayangonj.', 1, 0.00, 0.00, 0.00, 17, NULL, 17, '2020-02-03 10:39:56', '2020-02-03 10:39:56');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `designation` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `designation`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Senior Sales Engineer', 1, 1, NULL, '2019-11-15 15:02:08', '2020-01-27 18:16:52'),
(2, 'Sales Engineer', 1, 1, NULL, '2019-11-16 22:00:55', '2020-01-27 18:17:04'),
(3, 'General Manager', 1, 9, NULL, '2020-01-27 18:17:15', '2020-01-27 18:17:15'),
(4, 'Managing Director', 1, 9, NULL, '2020-01-27 18:17:59', '2020-01-27 18:17:59');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `district` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `serial_num` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_expenditures`
--

CREATE TABLE `emp_expenditures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `expenditure_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `purpose` tinyint(3) UNSIGNED NOT NULL,
  `amount` double(11,2) NOT NULL,
  `phone_bill_trxid` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'When purpose is phone bill this field is required',
  `miscellaneous` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'When purpose is Miscellaneous this field is required',
  `restaurant_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'When Foreigner Launch,Dinner,Breakfast',
  `docs_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Inactive',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emp_expenditures`
--

INSERT INTO `emp_expenditures` (`id`, `user_id`, `expenditure_date`, `purpose`, `amount`, `phone_bill_trxid`, `miscellaneous`, `restaurant_name`, `docs_img`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 1, '2020-03-01 18:00:00', 3, 541.00, '1542', NULL, NULL, 'images/docs-image/2020/03/07/icon-white07-03-202015-00-07.png', 1, 1, NULL, '2020-03-07 09:00:07', '2020-03-07 09:00:07'),
(5, 1, '2020-03-06 18:00:00', 4, 564.00, NULL, NULL, NULL, 'images/docs-image/2020/03/07/logo-final07-03-202016-05-50.png', 1, 1, 1, '2020-03-07 10:05:50', '2020-03-07 10:59:27'),
(6, 1, '2020-03-06 18:00:00', 8, 2132.00, NULL, NULL, 'ssd', 'images/docs-image/2020/03/07/logo-final07-03-202022-37-44.png', 1, 1, NULL, '2020-03-07 16:37:45', '2020-03-07 16:37:45');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follow_ups`
--

CREATE TABLE `follow_ups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_visit_id` bigint(20) UNSIGNED NOT NULL,
  `follow_date` date NOT NULL,
  `contact_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_mobile` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `designation` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `discussion_summery` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1=Follow Up Need, 2=No Need Follow Up,3=Need Quotation,4=Quotation Submitted, 5=Fail to sale,6=Success to Sale,7=Technical Discussion,8=PI Needed,9=PI Submitted, 10=Draft LC Open 11=LC Open',
  `status_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quotation_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quotation_summary` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `existing_system_details` text COLLATE utf8mb4_unicode_ci,
  `competitor_details` text COLLATE utf8mb4_unicode_ci,
  `quotation_value` double(11,2) NOT NULL DEFAULT '0.00' COMMENT 'Quotation value will be Sale value when complete sale',
  `technical_discuss` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `draft_lc_discuss` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `pi_value` double(9,2) DEFAULT '0.00',
  `h_s_code` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pi_company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_value` float(10,2) NOT NULL DEFAULT '0.00',
  `transport_cost` float(10,2) NOT NULL DEFAULT '0.00',
  `follow_up_by` bigint(20) UNSIGNED NOT NULL,
  `follow_up_step` tinyint(3) UNSIGNED NOT NULL DEFAULT '2' COMMENT '1=First Visit, 2=Follow Up',
  `latest` tinyint(1) NOT NULL,
  `associate_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `follow_ups`
--

INSERT INTO `follow_ups` (`id`, `company_visit_id`, `follow_date`, `contact_name`, `contact_mobile`, `contact_email`, `designation_id`, `designation`, `discussion_summery`, `status`, `status_reason`, `quotation_no`, `quotation_summary`, `existing_system_details`, `competitor_details`, `quotation_value`, `technical_discuss`, `draft_lc_discuss`, `pi_value`, `h_s_code`, `pi_company`, `product_value`, `transport_cost`, `follow_up_by`, `follow_up_step`, `latest`, `associate_by`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(49, 24, '2020-01-30', 'Md.Musfiqur Rahman', '01708132081', 'MdMushfiqur.Rahaman@bd.nestle.com', NULL, 'Elec.& Automation Engr.', 'will Finalize this project', 1, 'to finalize', NULL, NULL, 'right now they are using normal magnet', NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, 0.00, 13, 1, 0, NULL, 13, NULL, '2020-01-30 13:22:02', '2020-01-30 13:30:35'),
(51, 25, '2020-01-30', 'Md.Tarek', '01728127812', 'tareq.afbl@akij.net', NULL, 'Bottle recycling plant manager', 'will finalize', 1, 'will finalize', NULL, NULL, 'They also using sesotec', NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, 0.00, 13, 1, 0, NULL, 13, NULL, '2020-01-30 13:40:19', '2020-01-30 13:54:13'),
(52, 25, '2020-01-30', 'Md.Tarek', '01728127812', 'tareq.afbl@akij.net', NULL, 'Bottle recycling plant manager', 'Finalize this project', 10, 'They will open the LC as soon as possible', NULL, NULL, NULL, NULL, 0.00, NULL, 'All details are below;\r\n\r\nKindly find our reply as below:\r\n\r\n \r\n\r\n31D:       Date of expiry: Shipping is planned for week 13 which means we can probably start with commissioning in week 20. To be on the safe side I kindly ask to extend the L/C to End of August    \r\n\r\n               Akij: We usually give LC with 90 days validity.  You will get 21 days from shipment date to expire LC. PG payment does not required valid LC as per our bank rule. Once we submit performance certificate to Bank, Bank will automatically disburse remaining Payment\r\n\r\n202701JW:          This is contrary to the text in the L/C field 47A, Reimbursement instructions B) According to that we need to submit a Test/Acceptance Certificate signed by Akij Food and Beverage to the bank within the lifetime period of the L/C. Regarding this 10% payment we are completely dependent on the buyer\'s cooperation, so the 10% payment cannot be planned in any case.\r\n\r\n50:          Address is REGENER STRASSE 130 not STRABE\r\n\r\n               Akij : Okay, we open check PI and revised accordingly.\r\n\r\n44C:       Latest date of shipment: Please add two more weeks to be on the safe side          200403\r\n\r\n               Akij: We usually give LC with 90 days validity.  You will get 69 days from LC date for shipment. Can we open LC in 1~ 3th February-20 so that date:200403 remain within 69 days?\r\n\r\n202701JW:          For us it is important to cover unexpected issues, that’s why we request this one week buffer. If the L/C is opened on 200202, the latest day for shipment would be 200411 (200202 + 69 days = 200411) That’s o.k. from our side\r\n\r\n45A:       Only the VARISORT is mentioned it L/C but you get a FLAKE PURIFIER+ too\r\n\r\n                Akij: As we mentioned “PRICE, QUANTITY AND OTHER DETAILS AS PER PROFORMA INVOICE (AS MENTIONED IN POINT NO.1 OF FIELD 46A) ISSUED BY THE BENEFICIARY”, It is not an issue to mention all name.\r\n\r\n202701JW:          A L/C has usually no connection to the actual transaction. The banks check is only based on the documents, not according to the pro forma invoice. Due to the PURIFIER is not standard accessory it might cause difficulties because the L/C only shows a Varisort but the invoice shows a Purifier too.\r\n\r\n46A:       What is LCA Form Number: SCB-XXXXXX\r\n\r\n               Akij: You will get this number in final LC. This number is provided by our central bank.\r\n\r\nCERTIFICATE OF ORIGIN is a standard document from the Chamber of Commerce. Additional Information required by the L/C (like in Paragraph 47A) cannot be added\r\n\r\n202701JW:          Is a standard CERTIFICATE OF ORIGIN without any reference to a HSN code o.k.?\r\n\r\nPRINTED 2 (TWO) PERCENT AREA, could you please remove the 2 Percent. All our parts are clearly, indelible marked, but it could be a problem with big parts\r\n\r\n              Akij: Bank’s Mandatory clause. Can’t be modified.\r\n\r\n202701JW:          OK\r\n\r\n47A:       A) PAYMENT RELEASE FOR 90 PCT OF THE LC VALUE: ALL DOCUMENTS MUST BE PRESENTED TO STANDARD CHARTERED BANK, LEVEL-1, 67 GULSHAN AVENUE, DHAKA IN ORDER FOR US TO HONOUR THE SAME AND EFFECT REMITTANCE OF THE PAYMENT AT SIGHT BASIS FOR 80PCT (I guess this needs to be 90PCT) [Akij: Okay, we will revise] OF THE DRAWING AMOUNT AS PER REMITTING BANK\'S INSTRUCTION THROUGH OUR OFFSHORE BANKING UNIT, SAVAR.\r\n\r\nB) REMAINING 10 PCT OF THE DRAWING AMOUNT:\r\nREST 10 PCT OF THE DRAWING AMOUNT IS PAYBLE AT SIGHT AGAINST PRESENTATION OF TEST /ACCEPTANCE CERTIFICATE SIGNED BY AUTHORISED SIGNATORY OF APPLICANT WHICH IS TO BE SUBMITTED TO THE ISSUING BANK THROUGH NEGOTIATING BANK.\r\n\r\nThe first acceptance test has to be done within commissioning. Commissioning must be carried out no later than 2 weeks after delivery. If the first acceptance test failed, the ast acceptance test has to be done latest 15 days before expiry of L/C. If there is any delay not caused by the beneficiary, the final payment must be before expiry of L/C.\r\n\r\nALL PAYMENT CLAIMS MUST REACH ISSUING BANK WITHIN 120 DAYS FROM DATE OF LC ISSUANCE at least 10 days before expiry of L/C\r\n\r\n               Akij: Not possible. You will get remaining 10% payment after submission of our acceptance report to Bank. Whether LC is valid, or expired, is not a matter for PG payment.\r\n\r\n202701JW:          Same as 31D. According the L/C all payment claims must be submitted within 120 days from date of L/C issuance.', 0.00, NULL, NULL, 0.00, 0.00, 13, 2, 0, NULL, 13, NULL, '2020-01-30 13:54:13', '2020-01-31 10:26:32'),
(53, 26, '2020-01-30', 'Md.Abu Bakar Siddik', '01704133501', 'de2@prangroup.com', NULL, 'Snr.Development Engr.', 'will finalize the project', 1, 'They will finalize as soon as possible', NULL, NULL, 'No metal detector', NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, 0.00, 13, 1, 0, NULL, 13, NULL, '2020-01-30 14:13:16', '2020-01-30 14:14:24'),
(54, 26, '2020-01-30', 'Md.Abu Bakar Siddik', '01704133501', 'de2@prangroup.com', NULL, 'Snr.Development Engr.', 'Project Done', 11, 'finalize this project', NULL, NULL, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 239632.00, 11100.00, 13, 2, 1, NULL, 13, NULL, '2020-01-30 14:14:24', '2020-01-30 14:14:24'),
(55, 27, '2020-01-30', 'Md.Abu Bakar Siddik', '01704133501', 'de2@prangroup.com', NULL, 'Snr.Development Engr.', 'They will finalize', 1, 'They will finalize as soon as possible', NULL, NULL, 'Indian Metal detector', NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, 0.00, 13, 1, 0, NULL, 13, NULL, '2020-01-30 14:40:43', '2020-01-30 14:43:22'),
(57, 25, '2020-01-31', 'Md.Tarek', '01728127812', 'tareq.afbl@akij.net', NULL, 'Bottle recycling plant manager', 'Waiting for AKIJ Feedback', 10, 'They will open the LC as soon as possible', NULL, NULL, NULL, 'No Competitor', 480000.00, NULL, 'One Varisort and Metal  Detector with 3 years after sales service.', 0.00, NULL, NULL, 0.00, 0.00, 13, 2, 1, NULL, 13, NULL, '2020-01-31 10:26:32', '2020-01-31 10:26:32'),
(58, 28, '2020-02-02', 'Hossain Muhammad Alamin', '01722060543', 'alamin.corp@akij.net', NULL, 'Sr.Engineer', 'They want to take Glutomatic and TVT, other equipments take from Chopin.', 1, 'They will finalize as soon as possible', NULL, NULL, 'They don\'t have any lab equipment', NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, 0.00, 17, 1, 0, NULL, 17, NULL, '2020-02-02 13:55:22', '2020-02-02 13:58:51'),
(60, 29, '2020-02-03', 'Mr.Mahabur Rahman', '01704140030', 'pdd11@prangroup.com', NULL, 'PDD', 'He is interested to take DA 7250 NIR. Need to submit Quotation.', 3, 'Because he is interested to quotation.', NULL, NULL, 'They are using our Glutomatic and Tvt sytem', NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, 0.00, 17, 1, 1, NULL, 17, NULL, '2020-02-03 10:09:51', '2020-02-03 10:09:51'),
(61, 30, '2020-02-03', 'MAHBUB ALAM.', '01714046715', 'mahbubulalam@quasemgroup.com', NULL, 'CEO & Director', 'He is interested to take Nir.', 3, 'They will finalize as soon as possible', NULL, NULL, 'None', NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, 0.00, 17, 1, 1, NULL, 17, NULL, '2020-02-03 10:18:16', '2020-02-03 10:18:16'),
(62, 31, '2020-02-03', 'Mr. Tarik Chowdhury', '01951454566', 'tarik.chowdhury@newzealanddairybd.com', NULL, 'Head of factory operation', 'He is interested to take Bio AuroFlow for milk, RVA, Dough Lab, TVT, DA7250.', 3, 'Because he is interested to quotation.', NULL, NULL, 'They use ALAPALA laboratory equipment.', NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, 0.00, 17, 1, 1, NULL, 17, NULL, '2020-02-03 10:24:18', '2020-02-03 10:24:18'),
(63, 32, '2020-02-03', 'Md.Shahidul Islam.', '01777744150', 'svoil@tkgroupbd.com', NULL, 'AGM_QC', 'He interested to take IM 9520 and FT NIR for OIL.', 2, 'We submit quotation', NULL, NULL, 'They use Falling Number, Glutomatic System of ALAPALA Laboratory equipment.', NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, 0.00, 17, 1, 1, NULL, 17, NULL, '2020-02-03 10:33:22', '2020-02-03 10:33:22'),
(64, 33, '2020-02-03', 'Siddikur Rahman', '01712410867', 'siddikur.rahman@olympicbd.com', NULL, 'AGM QA', 'He is interested to take Falling Number, Glutomatic, TVT, Milk Analyzer(Bioo AuroFlow).', 1, 'They will future plan to build Center Lab.', NULL, NULL, 'They use NIR.', NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 0.00, 0.00, 17, 1, 1, NULL, 17, NULL, '2020-02-03 10:39:56', '2020-02-03 10:39:56'),
(77, 27, '2019-12-03', 'Md.Abu Bakar Siddik', '01704133501', 'de2@prangroup.com', NULL, 'Snr.Development Engr.', 'Project Done', 11, '71803', NULL, NULL, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 71803.00, 1500.00, 13, 2, 1, NULL, 13, 1, '2020-02-06 04:17:59', '2020-02-06 04:17:59'),
(79, 24, '2019-01-10', 'Md.Musfiqur Rahman', '01708132081', 'MdMushfiqur.Rahaman@bd.nestle.com', NULL, 'Elec.& Automation Engr.', 'Finalize this project', 11, 'clear all issue', NULL, NULL, NULL, NULL, 0.00, NULL, NULL, 0.00, NULL, NULL, 201500.00, 1500.00, 13, 2, 1, NULL, 13, 1, '2020-02-06 04:21:11', '2020-02-06 04:21:11'),
(81, 28, '2020-02-02', 'Hossain Muhammad Alamin', '017220605433', 'alamin.corp@akij.net', NULL, 'Sr.Engineer', 'They will decide in February according to Mr. Alamin.', 7, 'Already quotation submitted. Now they are comparing with Chopin.', NULL, NULL, NULL, 'They prefer Mixolab, AmyLab, Alveolab from Chopin. We need to discuss our advantages with them.', 100.00, 'We are preparing all documents for Technical Discussion', NULL, 0.00, NULL, NULL, 0.00, 0.00, 17, 2, 1, NULL, 17, 1, '2020-03-09 17:29:58', '2020-03-09 17:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `big_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `serial_num` tinyint(3) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `name_bn`, `url`, `icon_class`, `slug`, `icon`, `big_icon`, `status`, `serial_num`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Setting', NULL, '#', 'fa fa-folder', '[\"menu\"]', 'images/menu/icon/2019/11/19/setting19-11-201912-43-06.png', 'images/menu/big-icon/2019/11/19/setting19-11-201912-43-06.png', 1, 6, 1, '2019-11-08 00:43:46', '2019-11-19 06:43:06'),
(2, 'Setup', NULL, '#', 'fa fa-folder', '[\"setup\"]', 'images/menu/icon/2019/11/19/setting19-11-201912-42-10.png', 'images/menu/big-icon/2019/11/19/setting19-11-201912-42-10.png', 1, 4, 1, '2019-11-18 18:08:52', '2019-11-19 06:44:49'),
(3, 'Admin & Stuff', NULL, 'all-users', 'fa fa-folder', '[\"users\"]', 'images/menu/icon/2019/11/19/admin19-11-201912-41-44.png', 'images/menu/big-icon/2019/11/19/admin19-11-201912-41-44.png', 1, 3, 1, '2019-11-18 18:12:40', '2020-01-31 15:31:21'),
(4, 'Information', NULL, '#', 'fa fa-folder', '[\"information\"]', 'images/menu/icon/2019/11/19/information19-11-201912-41-22.png', 'images/menu/big-icon/2019/11/19/information19-11-201912-41-22.png', 1, 2, 1, '2019-11-18 18:14:56', '2019-11-19 06:43:53'),
(5, 'Dashboard', NULL, 'dashboard', 'fa fa-dashboard', '[\"dashboard\"]', 'images/menu/icon/2019/11/19/dashboard-m19-09-201912-18-4519-11-201912-40-46.png', 'images/menu/big-icon/2019/11/19/dashboard-m19-09-201912-18-4519-11-201912-40-46.png', 1, 1, 1, '2019-11-19 06:40:46', '2019-11-19 12:13:05');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2015_12_20_100001_create_permissions_table', 2),
(5, '2015_12_20_100002_create_roles_table', 2),
(6, '2015_12_20_100003_create_permission_role_table', 2),
(7, '2015_12_20_100004_create_role_user_table', 2),
(8, '2019_11_07_123603_create_primary_info_table', 3),
(9, '2019_11_07_172733_create_menu_table', 4),
(10, '2019_11_07_173956_create_sub_menu_table', 4),
(11, '2019_11_07_174703_create_sub_sub_menu_table', 5),
(12, '2019_11_08_090748_create_page_table', 6),
(13, '2019_11_08_091123_create_page_photo_table', 6),
(18, '2019_11_08_095714_add_user_type_users', 7),
(19, '2019_11_15_123151_add_address_image_users_table', 8),
(24, '2018_12_09_173537_create_districts_table', 9),
(25, '2018_12_09_180420_create_thana_upazilas_table', 9),
(26, '2019_05_19_224359_create_designations_table', 9),
(27, '2019_11_02_100237_create_categories_table', 9),
(28, '2019_11_16_064126_create_user_infos_table', 9),
(32, '2019_11_17_042427_create_company_visits_table', 10),
(33, '2019_11_18_004702_create_follow_ups_table', 10),
(34, '2018_08_08_100000_create_telescope_entries_table', 11),
(35, '2020_02_03_191638_create_business_years_table', 12),
(36, '2020_02_03_230736_create_assign_targets_table', 13),
(37, '2020_03_06_084618_create_budget_allocations_table', 14),
(38, '2020_03_06_152730_create_money_assign_to_emps_table', 15),
(39, '2020_03_07_063548_create_emp_expenditures_table', 16),
(40, '2020_03_07_071049_create_accommodations_table', 16),
(41, '2020_03_07_073450_create_borrow_details_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `money_assign_to_emps`
--

CREATE TABLE `money_assign_to_emps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `assign_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `purpose` tinyint(3) UNSIGNED NOT NULL,
  `amount` double(11,2) NOT NULL,
  `restaurant_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `car_maintenance_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gasoline_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver_over_time_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `docs_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT 'for_expenditure' COMMENT 'Salary, Borrow,Repay,For_expenditure',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Inactive',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `money_assign_to_emps`
--

INSERT INTO `money_assign_to_emps` (`id`, `user_id`, `assign_date`, `purpose`, `amount`, `restaurant_name`, `car_maintenance_details`, `gasoline_details`, `driver_over_time_details`, `docs_img`, `type`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(10, 17, '2020-03-07 18:00:00', 2, 1000.00, NULL, NULL, NULL, NULL, NULL, 'Borrow', 1, 1, NULL, '2020-03-08 01:39:11', '2020-03-08 01:39:11'),
(11, 17, '2020-03-08 18:00:00', 3, 1400.00, NULL, NULL, NULL, NULL, NULL, 'Repay', 1, 1, NULL, '2020-03-08 01:39:35', '2020-03-08 01:39:35'),
(12, 15, '2020-03-06 18:00:00', 2, 451.00, NULL, NULL, NULL, NULL, 'images/money-assign/receipt/2020/03/08/logo-final08-03-202008-23-19.png', 'Borrow', 1, 1, 1, '2020-03-08 01:40:48', '2020-03-08 02:23:32');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `description_ban` text COLLATE utf8mb4_unicode_ci,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `serial_num` tinyint(3) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page_photo`
--

CREATE TABLE `page_photo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fk_page_id` bigint(20) UNSIGNED NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resource` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT 'System',
  `system` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `resource`, `system`, `created_at`, `updated_at`) VALUES
(1, 'Primary Info', 'primary-info', NULL, 1, NULL, '2019-11-07 23:29:45'),
(2, 'Users', 'users', NULL, 1, NULL, '2019-11-08 03:19:29'),
(3, 'ACL', 'acl', NULL, 1, NULL, NULL),
(4, 'Others', 'others', NULL, 1, NULL, NULL),
(5, 'Menu', 'menu', NULL, 1, NULL, NULL),
(9, 'View Client-follow-up', 'client-follow-up.view', 'Client-follow-up', 1, '2019-11-18 17:15:24', '2019-11-18 17:15:24'),
(10, 'Create Client-follow-up', 'client-follow-up.create', 'Client-follow-up', 1, '2019-11-18 17:15:24', '2019-11-18 17:15:24'),
(11, 'Update Client-follow-up', 'client-follow-up.update', 'Client-follow-up', 1, '2019-11-18 17:15:24', '2019-11-18 17:15:24'),
(12, 'Delete Client-follow-up', 'client-follow-up.delete', 'Client-follow-up', 1, '2019-11-18 17:15:24', '2019-11-18 17:15:24'),
(13, 'View Company-visit', 'company-visit.view', 'Company-visit', 1, '2019-11-18 17:52:47', '2019-11-18 17:52:47'),
(14, 'Create Company-visit', 'company-visit.create', 'Company-visit', 1, '2019-11-18 17:52:47', '2019-11-18 17:52:47'),
(15, 'Update Company-visit', 'company-visit.update', 'Company-visit', 1, '2019-11-18 17:52:47', '2019-11-18 17:52:47'),
(16, 'Delete Company-visit', 'company-visit.delete', 'Company-visit', 1, '2019-11-18 17:52:47', '2019-11-18 17:52:47'),
(23, 'categories', 'categories', '', 1, '2019-11-18 18:04:14', '2019-11-18 18:04:14'),
(24, 'designation', 'designation', '', 1, '2019-11-18 18:07:10', '2019-11-18 18:07:10'),
(25, 'setup', 'setup', '', 1, '2019-11-18 18:07:52', '2019-11-18 18:07:52'),
(26, 'information', 'information', '', 1, '2019-11-18 18:14:15', '2019-11-18 18:14:15'),
(27, 'dashboard', 'dashboard', '', 1, '2019-11-19 12:12:10', '2019-11-19 12:12:10'),
(28, 'lc-open-list', 'lc-open-list', '', 1, '2020-02-05 19:14:21', '2020-02-05 19:14:21'),
(29, 'assign-target', 'assign-target', '', 1, '2020-02-05 19:14:38', '2020-02-05 19:14:38');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(144, 9, 2, NULL, NULL),
(145, 10, 2, NULL, NULL),
(146, 11, 2, NULL, NULL),
(147, 12, 2, NULL, NULL),
(148, 13, 2, NULL, NULL),
(149, 14, 2, NULL, NULL),
(150, 15, 2, NULL, NULL),
(151, 16, 2, NULL, NULL),
(152, 2, 2, NULL, NULL),
(153, 23, 2, NULL, NULL),
(154, 24, 2, NULL, NULL),
(155, 25, 2, NULL, NULL),
(156, 26, 2, NULL, NULL),
(157, 27, 2, NULL, NULL),
(164, 9, 3, NULL, NULL),
(165, 10, 3, NULL, NULL),
(166, 11, 3, NULL, NULL),
(167, 13, 3, NULL, NULL),
(168, 14, 3, NULL, NULL),
(169, 15, 3, NULL, NULL),
(170, 26, 3, NULL, NULL),
(171, 27, 3, NULL, NULL),
(215, 9, 4, NULL, NULL),
(216, 10, 4, NULL, NULL),
(217, 11, 4, NULL, NULL),
(218, 13, 4, NULL, NULL),
(219, 14, 4, NULL, NULL),
(220, 15, 4, NULL, NULL),
(221, 9, 1, NULL, NULL),
(222, 10, 1, NULL, NULL),
(223, 11, 1, NULL, NULL),
(224, 12, 1, NULL, NULL),
(225, 13, 1, NULL, NULL),
(226, 14, 1, NULL, NULL),
(227, 15, 1, NULL, NULL),
(228, 16, 1, NULL, NULL),
(229, 1, 1, NULL, NULL),
(230, 2, 1, NULL, NULL),
(231, 3, 1, NULL, NULL),
(232, 4, 1, NULL, NULL),
(233, 5, 1, NULL, NULL),
(234, 23, 1, NULL, NULL),
(235, 24, 1, NULL, NULL),
(236, 25, 1, NULL, NULL),
(237, 26, 1, NULL, NULL),
(238, 27, 1, NULL, NULL),
(239, 28, 1, NULL, NULL),
(240, 29, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `primary_info`
--

CREATE TABLE `primary_info` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL COMMENT '1=Group of Company, 2=Single Company',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `primary_info`
--

INSERT INTO `primary_info` (`id`, `company_name`, `logo`, `favicon`, `address1`, `address2`, `mobile`, `phone`, `email`, `type`, `created_at`, `updated_at`) VALUES
(1, 'NEEMSAH', 'images/company-logo/2020/01/31/logo-final31-01-202018-53-28.png', 'images/logo/favicon.png', 'Kha-11, Pragati Sharani, Shajadpur, Gulshan, Dhaka-1212', NULL, '+88-01760568639', NULL, 'toufik@neemsah.com', 1, NULL, '2020-01-31 12:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `system` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `system`, `created_at`, `updated_at`) VALUES
(1, 'Developer', 'developer', 'Developer Mode', 1, NULL, NULL),
(2, 'Super Admin', 'super-admin', 'Super Admins', 1, NULL, NULL),
(3, 'Admin', 'admin', 'Admin role', 1, NULL, NULL),
(4, 'Stuff', 'stuff', 'Client whom post add and visit my web site', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 1, 1, NULL, NULL),
(12, 2, 9, NULL, NULL),
(16, 4, 13, NULL, NULL),
(17, 4, 14, NULL, NULL),
(18, 4, 15, NULL, NULL),
(19, 4, 16, NULL, NULL),
(20, 4, 17, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu`
--

CREATE TABLE `sub_menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fk_menu_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `big_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `serial_num` tinyint(3) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_menu`
--

INSERT INTO `sub_menu` (`id`, `fk_menu_id`, `name`, `name_bn`, `url`, `icon_class`, `slug`, `icon`, `big_icon`, `status`, `serial_num`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 'Menu', NULL, 'menu', NULL, '[\"menu\"]', 'images/menu/sub-menu/icon/2019/11/08/chrysanthemum08-11-201909-16-14.jpg', 'images/menu/sub-menu/big-icon/2019/11/08/chrysanthemum08-11-201909-16-15.jpg', 1, 1, 1, '2019-11-08 03:16:15', '2019-11-08 03:16:15'),
(2, 1, 'User Roles', NULL, 'acl-role', NULL, '[\"acl\"]', 'images/menu/sub-menu/icon/2019/11/08/chrysanthemum08-11-201909-17-32.jpg', 'images/menu/sub-menu/big-icon/2019/11/08/chrysanthemum08-11-201909-17-32.jpg', 1, 2, 1, '2019-11-08 03:17:32', '2019-11-08 03:17:32'),
(4, 2, 'Designation', NULL, 'designation', NULL, '[\"designation\"]', 'images/menu/sub-menu/icon/2019/11/19/academyc19-11-201912-45-59.png', 'images/menu/big-icon/2019/11/19/academyc19-11-201912-45-59.png', 1, 1, 1, '2019-11-18 18:10:20', '2019-11-19 06:45:59'),
(5, 2, 'Categories', NULL, 'categories', NULL, '[\"categories\"]', 'images/menu/sub-menu/icon/2019/11/19/courses05-09-201917-14-3119-11-201912-50-20.png', 'images/menu/big-icon/2019/11/19/courses05-09-201917-14-3119-11-201912-50-20.png', 1, 2, 1, '2019-11-18 18:10:46', '2019-11-19 06:50:20'),
(6, 4, 'Daily Report', NULL, 'company-visit', NULL, '[\"company-visit.view\",\"company-visit.create\",\"company-visit.update\",\"company-visit.delete\"]', 'images/menu/sub-menu/icon/2019/11/19/hydrangeas19-11-201918-09-34.jpg', 'images/menu/big-icon/2019/11/19/hydrangeas19-11-201918-09-34.jpg', 1, 1, 1, '2019-11-18 18:16:10', '2019-12-02 06:46:17'),
(7, 4, 'Follow Up', NULL, 'client-follow-up', NULL, '[\"client-follow-up.view\",\"client-follow-up.create\",\"client-follow-up.update\",\"client-follow-up.delete\"]', 'images/menu/sub-menu/icon/2019/11/19/hydrangeas19-11-201918-09-51.jpg', 'images/menu/big-icon/2019/11/19/hydrangeas19-11-201918-09-51.jpg', 1, 2, 1, '2019-11-18 18:17:45', '2020-01-28 16:31:31'),
(8, 2, 'Assign-target', NULL, 'assign-target', NULL, '[\"assign-target\"]', 'images/menu/sub-menu/icon/2020/02/06/information25-12-201922-25-3906-02-202001-15-59.png', 'images/menu/sub-menu/big-icon/2020/02/06/information25-12-201922-25-3906-02-202001-15-59.png', 1, 3, 1, '2020-02-05 19:15:59', '2020-02-05 19:17:56'),
(9, 2, 'Lc-open-list', NULL, 'lc-open-list', NULL, '[\"lc-open-list\"]', 'images/menu/sub-menu/icon/2020/02/06/information25-12-201922-25-3906-02-202001-16-32.png', 'images/menu/sub-menu/big-icon/2020/02/06/information25-12-201922-25-3906-02-202001-16-32.png', 1, 4, 1, '2020-02-05 19:16:32', '2020-02-05 19:16:32');

-- --------------------------------------------------------

--
-- Table structure for table `sub_sub_menu`
--

CREATE TABLE `sub_sub_menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fk_menu_id` bigint(20) UNSIGNED NOT NULL,
  `fk_sub_menu_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `big_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `serial_num` tinyint(3) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thana_upazilas`
--

CREATE TABLE `thana_upazilas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `thana_upazila` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `serial_num` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_id` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '3' COMMENT '1=System/Super Admin,2= Admin, 3=General User',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `social_id`, `mobile`, `type`, `email_verified_at`, `password`, `address`, `image`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Developer', 'dev@gmail.com', NULL, '01829655974', 1, NULL, '$2y$10$bJvF3nxUIPxn.6LLSQ0puu94eRduA9JTH6I9aSYiQJcCuao7.RKYG', NULL, 'images/users/2019/11/16/77020436-430483631234777-5178523127704977408-n16-11-201918-27-16.jpg', 1, NULL, '2019-11-07 18:00:00', '2019-11-16 12:27:16'),
(9, 'Toufik Ahmed Emon', 'superadmin@gmail.com', NULL, '01760568639', 1, NULL, '$2y$10$D7aWBREK5kdT6Q2TdFBp3OHQns8xyA5TOCzD3NBTWLeoRB.7t5okK', 'Dhaka', 'images/users/2020/01/13/logo-final13-01-202015-15-26.png', 1, NULL, '2019-11-16 00:46:39', '2020-01-30 12:44:06'),
(13, 'Engr. Abu Abdullah Al Muzahid', 'abdullah@neemsah.com', NULL, '01730716948', 3, NULL, '$2y$10$zDNcIrcqwxwAqHcFNipb2OuyYTmpS7FoqUXBTpEtH/5X5L544NoVK', 'Kha-11, Shajadpur, Gulshan, Dhaka-1212', 'images/users/2020/01/28/muzahid28-01-202000-41-00.jpg', 1, NULL, '2020-01-27 18:41:00', '2020-01-31 09:29:54'),
(14, 'Engr. Chandan Das', 'chandan@neemsah.com', NULL, '01730716947', 3, NULL, '$2y$10$kLwUya.5odniFiTg11hw6OnhvD2NBCOhXoWpD0qSlX48NqrkPteqq', 'Kha-11, Shajadpur, Gulshan, Dhaka-1212', 'images/users/2020/01/28/chandan28-01-202000-48-24.jpg', 1, NULL, '2020-01-27 18:48:24', '2020-01-27 18:59:24'),
(15, 'M. M Zahidul Habib', 'zahid@neemsah.com', NULL, '01730716945', 3, NULL, '$2y$10$AxISALbydFWa3iC0y9WrHO6Y1ZNLuBX5kxMsDYIao1Uw4P95tr9Sq', 'Kha-11, Shajadpur, Gulshan, Dhaka-1212', 'images/users/2020/01/28/zahid28-01-202000-50-53.jpg', 1, NULL, '2020-01-27 18:50:54', '2020-01-27 18:50:54'),
(16, 'Engr. Abdur Rahman', 'arahman@neemsah.com', NULL, '01730716946', 3, NULL, '$2y$10$BAttIhEOawpWG5p0EyOlPOdQXB3Ir70SX/6LbE1kz3nj6DAwiv.KO', 'Kha-11, Shajadpur, Gulshan, Dhaka-1212', 'images/users/2020/01/28/arahman28-01-202000-52-57.jpg', 1, NULL, '2020-01-27 18:52:57', '2020-01-27 18:52:57'),
(17, 'Engr. Md. Mahbub Alam', 'mahbub@neemsah.com', NULL, '01730716950', 3, NULL, '$2y$10$D7GFlEw8MoCnmLx5ijQqB.ydPsGaC//j0GzZ7XIT/Q.ikDYKrCp/G', 'Kha-11, Shajadpur, Gulshan, Dhaka-1212', NULL, 1, NULL, '2020-01-27 19:00:19', '2020-01-27 19:00:19');

-- --------------------------------------------------------

--
-- Table structure for table `user_infos`
--

CREATE TABLE `user_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_date` timestamp NULL DEFAULT NULL,
  `release_date` timestamp NULL DEFAULT NULL,
  `salary` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `designation_id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `thana_upazila_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Inactive',
  `serial_num` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `subordinate` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_infos`
--

INSERT INTO `user_infos` (`id`, `user_id`, `father_name`, `mother_name`, `nid`, `joining_date`, `release_date`, `salary`, `designation_id`, `district_id`, `thana_upazila_id`, `status`, `serial_num`, `subordinate`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, 9, NULL, NULL, 's1df32', '2019-11-14 18:00:00', NULL, 35000, 1, NULL, NULL, 1, 0, NULL, 1, 1, '2019-11-16 00:46:39', '2020-01-13 09:15:27'),
(7, 13, NULL, NULL, '3214213598698', '2018-06-30 18:00:00', NULL, 30000, 1, NULL, NULL, 1, 0, 9, 9, NULL, '2020-01-27 18:41:00', '2020-01-27 18:41:00'),
(8, 14, NULL, NULL, '5554127315', '2019-07-19 18:00:00', NULL, 20000, 2, NULL, NULL, 1, 0, 9, 9, NULL, '2020-01-27 18:48:24', '2020-01-27 18:48:24'),
(9, 15, NULL, NULL, '3214213598698', '2012-12-31 18:00:00', NULL, 52000, 3, NULL, NULL, 1, 0, 9, 9, 9, '2020-01-27 18:50:54', '2020-01-27 18:51:03'),
(10, 16, NULL, NULL, '3214213598698', '2020-08-31 18:00:00', NULL, 14000, 2, NULL, NULL, 1, 0, 9, 9, NULL, '2020-01-27 18:52:57', '2020-01-27 18:52:57'),
(11, 17, NULL, NULL, '3214213598698', '2020-08-31 18:00:00', NULL, 15000, 2, NULL, NULL, 1, 0, 9, 9, NULL, '2020-01-27 19:00:19', '2020-01-27 19:00:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accommodations`
--
ALTER TABLE `accommodations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accommodations_emp_expenditure_id_foreign` (`emp_expenditure_id`),
  ADD KEY `accommodations_created_by_foreign` (`created_by`),
  ADD KEY `accommodations_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `assign_targets`
--
ALTER TABLE `assign_targets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assign_targets_user_id_foreign` (`user_id`),
  ADD KEY `assign_targets_created_by_foreign` (`created_by`),
  ADD KEY `assign_targets_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `borrow_details`
--
ALTER TABLE `borrow_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrow_details_emp_expenditure_id_foreign` (`emp_expenditure_id`),
  ADD KEY `borrow_details_user_id_foreign` (`user_id`),
  ADD KEY `borrow_details_created_by_foreign` (`created_by`),
  ADD KEY `borrow_details_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `budget_allocations`
--
ALTER TABLE `budget_allocations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `budget_allocations_created_by_foreign` (`created_by`),
  ADD KEY `budget_allocations_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `business_years`
--
ALTER TABLE `business_years`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `business_years_year_name_unique` (`year_name`),
  ADD KEY `business_years_created_by_foreign` (`created_by`),
  ADD KEY `business_years_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_visits`
--
ALTER TABLE `company_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_visits_category_id_foreign` (`category_id`),
  ADD KEY `company_visits_created_by_foreign` (`created_by`),
  ADD KEY `company_visits_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `designations_created_by_foreign` (`created_by`),
  ADD KEY `designations_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `districts_district_unique` (`district`);

--
-- Indexes for table `emp_expenditures`
--
ALTER TABLE `emp_expenditures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_expenditures_user_id_foreign` (`user_id`),
  ADD KEY `emp_expenditures_created_by_foreign` (`created_by`),
  ADD KEY `emp_expenditures_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow_ups`
--
ALTER TABLE `follow_ups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `follow_ups_company_visit_id_foreign` (`company_visit_id`),
  ADD KEY `follow_ups_follow_up_by_foreign` (`follow_up_by`),
  ADD KEY `follow_ups_associate_by_foreign` (`associate_by`),
  ADD KEY `follow_ups_created_by_foreign` (`created_by`),
  ADD KEY `follow_ups_updated_by_foreign` (`updated_by`),
  ADD KEY `follow_ups_designation_id_foreign` (`designation_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `money_assign_to_emps`
--
ALTER TABLE `money_assign_to_emps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `money_assign_to_emps_user_id_foreign` (`user_id`),
  ADD KEY `money_assign_to_emps_created_by_foreign` (`created_by`),
  ADD KEY `money_assign_to_emps_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_photo`
--
ALTER TABLE `page_photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_photo_fk_page_id_foreign` (`fk_page_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_slug_unique` (`slug`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indexes for table `primary_info`
--
ALTER TABLE `primary_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_index` (`role_id`),
  ADD KEY `role_user_user_id_index` (`user_id`);

--
-- Indexes for table `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_menu_fk_menu_id_foreign` (`fk_menu_id`);

--
-- Indexes for table `sub_sub_menu`
--
ALTER TABLE `sub_sub_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_sub_menu_fk_menu_id_foreign` (`fk_menu_id`),
  ADD KEY `sub_sub_menu_fk_sub_menu_id_foreign` (`fk_sub_menu_id`);

--
-- Indexes for table `thana_upazilas`
--
ALTER TABLE `thana_upazilas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `thana_upazilas_thana_upazila_unique` (`thana_upazila`),
  ADD KEY `thana_upazilas_district_id_foreign` (`district_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_infos`
--
ALTER TABLE `user_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_infos_user_id_foreign` (`user_id`),
  ADD KEY `user_infos_designation_id_foreign` (`designation_id`),
  ADD KEY `user_infos_district_id_foreign` (`district_id`),
  ADD KEY `user_infos_thana_upazila_id_foreign` (`thana_upazila_id`),
  ADD KEY `user_infos_subordinate_foreign` (`subordinate`),
  ADD KEY `user_infos_created_by_foreign` (`created_by`),
  ADD KEY `user_infos_updated_by_foreign` (`updated_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accommodations`
--
ALTER TABLE `accommodations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `assign_targets`
--
ALTER TABLE `assign_targets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `borrow_details`
--
ALTER TABLE `borrow_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `budget_allocations`
--
ALTER TABLE `budget_allocations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `business_years`
--
ALTER TABLE `business_years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `company_visits`
--
ALTER TABLE `company_visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_expenditures`
--
ALTER TABLE `emp_expenditures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follow_ups`
--
ALTER TABLE `follow_ups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `money_assign_to_emps`
--
ALTER TABLE `money_assign_to_emps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `page_photo`
--
ALTER TABLE `page_photo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `primary_info`
--
ALTER TABLE `primary_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sub_sub_menu`
--
ALTER TABLE `sub_sub_menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thana_upazilas`
--
ALTER TABLE `thana_upazilas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_infos`
--
ALTER TABLE `user_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accommodations`
--
ALTER TABLE `accommodations`
  ADD CONSTRAINT `accommodations_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `accommodations_emp_expenditure_id_foreign` FOREIGN KEY (`emp_expenditure_id`) REFERENCES `emp_expenditures` (`id`),
  ADD CONSTRAINT `accommodations_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `assign_targets`
--
ALTER TABLE `assign_targets`
  ADD CONSTRAINT `assign_targets_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `assign_targets_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `assign_targets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `borrow_details`
--
ALTER TABLE `borrow_details`
  ADD CONSTRAINT `borrow_details_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `borrow_details_emp_expenditure_id_foreign` FOREIGN KEY (`emp_expenditure_id`) REFERENCES `emp_expenditures` (`id`),
  ADD CONSTRAINT `borrow_details_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `borrow_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `budget_allocations`
--
ALTER TABLE `budget_allocations`
  ADD CONSTRAINT `budget_allocations_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `budget_allocations_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `business_years`
--
ALTER TABLE `business_years`
  ADD CONSTRAINT `business_years_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `business_years_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `company_visits`
--
ALTER TABLE `company_visits`
  ADD CONSTRAINT `company_visits_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `company_visits_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `company_visits_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `designations`
--
ALTER TABLE `designations`
  ADD CONSTRAINT `designations_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `designations_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `emp_expenditures`
--
ALTER TABLE `emp_expenditures`
  ADD CONSTRAINT `emp_expenditures_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `emp_expenditures_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `emp_expenditures_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `follow_ups`
--
ALTER TABLE `follow_ups`
  ADD CONSTRAINT `follow_ups_associate_by_foreign` FOREIGN KEY (`associate_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `follow_ups_company_visit_id_foreign` FOREIGN KEY (`company_visit_id`) REFERENCES `company_visits` (`id`),
  ADD CONSTRAINT `follow_ups_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `follow_ups_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`),
  ADD CONSTRAINT `follow_ups_follow_up_by_foreign` FOREIGN KEY (`follow_up_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `follow_ups_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `money_assign_to_emps`
--
ALTER TABLE `money_assign_to_emps`
  ADD CONSTRAINT `money_assign_to_emps_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `money_assign_to_emps_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `money_assign_to_emps_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `page_photo`
--
ALTER TABLE `page_photo`
  ADD CONSTRAINT `page_photo_fk_page_id_foreign` FOREIGN KEY (`fk_page_id`) REFERENCES `page` (`id`);

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD CONSTRAINT `sub_menu_fk_menu_id_foreign` FOREIGN KEY (`fk_menu_id`) REFERENCES `menu` (`id`);

--
-- Constraints for table `sub_sub_menu`
--
ALTER TABLE `sub_sub_menu`
  ADD CONSTRAINT `sub_sub_menu_fk_menu_id_foreign` FOREIGN KEY (`fk_menu_id`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `sub_sub_menu_fk_sub_menu_id_foreign` FOREIGN KEY (`fk_sub_menu_id`) REFERENCES `sub_menu` (`id`);

--
-- Constraints for table `thana_upazilas`
--
ALTER TABLE `thana_upazilas`
  ADD CONSTRAINT `thana_upazilas_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`);

--
-- Constraints for table `user_infos`
--
ALTER TABLE `user_infos`
  ADD CONSTRAINT `user_infos_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_infos_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`),
  ADD CONSTRAINT `user_infos_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`),
  ADD CONSTRAINT `user_infos_subordinate_foreign` FOREIGN KEY (`subordinate`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_infos_thana_upazila_id_foreign` FOREIGN KEY (`thana_upazila_id`) REFERENCES `thana_upazilas` (`id`),
  ADD CONSTRAINT `user_infos_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_infos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
