-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2025 at 09:03 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diamond`
--

-- --------------------------------------------------------

--
-- Table structure for table `diamond_clarity_master`
--

CREATE TABLE `diamond_clarity_master` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ALIAS` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `display_in_front` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diamond_clarity_master`
--

INSERT INTO `diamond_clarity_master` (`id`, `name`, `ALIAS`, `remark`, `display_in_front`, `sort_order`, `date_added`, `date_modify`) VALUES
(1, 'I3', NULL, NULL, 0, 12, '2015-07-13 00:14:29', NULL),
(2, 'VVS1', 'VVS1', 'Very Very Slighly Included-1', 1, 3, '2012-07-23 00:00:00', '2015-12-17 16:14:06'),
(3, 'VVS2', 'Very Very Slightly Included- 2', '', 1, 4, '2012-07-23 00:00:00', '2015-11-09 14:22:54'),
(4, 'VS1', NULL, NULL, 1, 5, '2012-07-23 00:00:00', '0000-00-00 00:00:00'),
(5, 'VS2', NULL, NULL, 1, 6, '2012-07-23 00:00:00', '2014-07-03 17:31:37'),
(6, 'SI1', NULL, NULL, 1, 7, '2012-07-23 00:00:00', '0000-00-00 00:00:00'),
(7, 'SI2', NULL, NULL, 1, 8, '2012-07-23 00:00:00', '0000-00-00 00:00:00'),
(8, 'SI3', NULL, NULL, 1, 9, '2012-09-24 00:00:00', '0000-00-00 00:00:00'),
(9, 'I1', '', '', 1, 10, '2012-09-24 00:00:00', '2015-11-04 09:43:09'),
(10, 'I2', NULL, NULL, 0, 11, '2012-09-24 00:00:00', '0000-00-00 00:00:00'),
(11, 'IF', '', '', 1, 2, '2015-10-13 14:01:04', '2015-11-04 09:42:05'),
(12, 'N', '', '', 0, 0, '2015-12-05 03:29:09', NULL),
(13, 'FL', '', '', 1, 1, '2015-06-13 16:00:01', '2015-11-04 09:43:23'),
(14, 'NA', 'N/A', '', 0, 0, '2015-07-13 03:00:13', '2016-02-22 10:09:40'),
(15, 'I4', NULL, NULL, 0, 0, '2015-07-13 03:00:14', NULL),
(16, 'VS', NULL, NULL, 0, 0, '2015-07-13 03:00:14', NULL),
(17, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'tester', 'test', 'test', 1, 12, '2025-04-16 17:13:00', '2025-04-17 17:13:00'),
(21, 'tester', 'tests', 'test', 12, 12, '2025-04-16 18:24:00', '2025-04-17 18:24:00'),
(22, 'Clartitys', 'Clartity', 'Clartity', 1, 1, '2025-04-17 18:37:00', '2025-04-18 18:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `diamond_color_master`
--

CREATE TABLE `diamond_color_master` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `short_name` varchar(250) DEFAULT NULL,
  `ALIAS` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `display_in_front` int(11) DEFAULT NULL,
  `dc_is_fancy_color` tinyint(4) DEFAULT NULL,
  `sort_order` tinyint(4) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diamond_color_master`
--

INSERT INTO `diamond_color_master` (`id`, `name`, `short_name`, `ALIAS`, `remark`, `display_in_front`, `dc_is_fancy_color`, `sort_order`, `date_added`, `date_modify`) VALUES
(1, 'D', 'D', '', '', 1, 0, 1, '2015-12-31 02:52:42', '2025-04-18 10:09:51'),
(2, 'E', 'E', '', '', 1, 0, 2, '2015-12-31 03:08:06', NULL),
(3, 'F', 'F', '', '', 1, 0, 3, '2015-12-31 03:08:19', NULL),
(4, 'G', 'G', '', '', 1, 0, 4, '2015-12-31 03:08:29', NULL),
(5, 'H', 'H', '', '', 1, 0, 5, '2015-12-31 03:08:43', NULL),
(6, 'I', 'I', '', '', 1, 0, 6, '2015-12-31 03:08:58', NULL),
(7, 'J', 'J', '', '', 1, 0, 7, '2015-12-31 03:09:16', NULL),
(8, 'K', 'K', '', '', 1, 0, 8, '2015-12-31 03:09:26', NULL),
(9, 'L', 'L', '', '', 1, 0, 9, '2015-12-31 03:09:36', NULL),
(10, 'M', 'M', '', '', 0, 0, 10, '2015-12-31 03:09:50', NULL),
(11, 'N', 'N', '', '', 0, 0, 11, '2015-12-31 03:10:00', NULL),
(12, 'O', 'O', '', '', 0, 0, 12, '2015-12-31 03:10:10', NULL),
(13, 'P', 'P', '', '', 0, 0, 13, '2015-12-31 03:10:18', NULL),
(14, 'Q', 'Q', '', '', 0, 0, 14, '2015-12-31 03:10:28', '2017-10-24 12:36:35'),
(15, 'R', 'R', '', '', 0, 0, 15, '2015-12-31 03:10:42', NULL),
(16, 'S', 'S', '', '', 0, 0, 16, '2015-12-31 03:10:51', NULL),
(17, 'T', 'T', '', '', 0, 0, 17, '2015-12-31 03:11:01', NULL),
(18, 'U', 'U', '', '', 0, 0, 18, '2015-12-31 03:11:10', NULL),
(19, 'V', 'V', '', '', 0, 0, 19, '2015-12-31 03:11:20', NULL),
(20, 'W-X', 'W-X', '', '', 0, 0, 20, '2015-12-31 03:11:40', '2015-12-31 03:13:05'),
(21, 'X', 'X', '', '', 0, 0, 21, '2015-12-31 03:12:23', NULL),
(22, 'Y', 'Yellow', 'Yellow', '', 0, 0, 22, '2015-12-31 03:12:34', '2024-02-13 11:47:32'),
(23, 'Z', 'Z', '', '', 0, 0, 23, '2015-12-31 03:12:43', NULL),
(24, 'GREEN', 'GN', '', '', 0, 1, 27, '2015-12-31 03:22:59', '2020-05-22 17:51:17'),
(25, 'PINK', 'Pink', 'Pink', '', 1, 1, 29, '2015-12-31 03:23:19', '2024-02-13 11:23:20'),
(26, 'YELLOW', 'Y', 'YELLOW', '', 1, 1, 40, '2015-12-31 03:23:36', '2016-02-17 18:24:33'),
(27, 'GREY', 'GREY', '', '', 0, 1, 27, '2015-12-31 03:23:49', '2015-12-31 04:28:27'),
(28, 'BROWN', 'BN', '', 'BROWN\r\n', 0, 1, 28, '2015-12-31 03:24:00', '2015-12-31 04:29:11'),
(29, 'ORANGE-YELLOW', 'OY', '', 'ORANGE-YELLOW\r\n', 0, 1, 25, '2015-12-31 03:24:42', '2015-12-31 04:32:14'),
(30, 'GREEN-YELLOW', 'GY', '', 'GREEN-YELLOW\r\n', 0, 1, 26, '2015-12-31 03:25:24', '2015-12-31 04:32:30'),
(31, 'Y to Z Range', 'Y-Z', '', 'Y to Z Range\r\n', 0, 0, 31, '2015-12-31 03:25:43', '2015-12-31 04:32:42'),
(32, 'Purple', 'PL', '', 'Purple\r\n', 0, 1, 32, '2015-12-31 03:26:00', '2015-12-31 04:32:58'),
(33, 'S-T', 'S-T', 'S-T', '', 0, 0, 33, '2016-01-26 15:54:38', NULL),
(34, 'FBG', 'FBG', '', '', 0, 1, 34, '2019-02-05 15:04:57', NULL),
(35, 'FB', 'FB', '', '', 0, 1, 35, '2019-02-05 15:05:09', NULL),
(36, 'Green-Blue', 'Green-Blue', 'Green-Blue', '', 1, 1, 21, '2019-02-05 15:05:22', '2024-02-13 11:23:45'),
(37, 'Blue', 'Blue', 'Blue', '', 1, 1, 10, '2020-01-09 10:17:20', '2024-02-13 11:22:51'),
(38, 'Orange', 'OR', 'Orange', '', 0, 1, 38, '2020-01-09 10:31:06', NULL),
(39, 'Orange-Pink', 'ORP,OR-P,OR-PK,ORPK', 'Orange-Pink', '', 0, 1, 39, '2020-01-09 10:32:13', NULL),
(40, 'ORANGE-BROWN', 'ORBR,OR-BR', 'ORANGE-BROWN', '', 0, 1, 41, '2020-01-09 10:33:59', NULL),
(41, 'Brown-Pink', 'B-P', 'Brown-Pink', '', 0, 1, 42, '2021-12-23 11:40:53', '2021-12-23 11:41:45'),
(42, 'BROWN YELLOW', 'BROWN YELLOW', 'BROWN YELLOW', '', 0, 1, 43, '2021-12-23 11:51:02', NULL),
(43, 'Pink-Purple', 'Pink-Purple', 'Pink-Purple', '', 0, 1, 44, '2021-12-23 11:56:09', NULL),
(44, 'BLUE-GREEN', 'B-G', 'Blue-Green', 'Blue-Green', 0, 1, 20, '2024-02-07 14:46:34', NULL),
(45, 'Other', 'Other', 'Other', '', 1, 1, 99, '2024-02-13 11:44:14', NULL),
(46, 'FANCY', 'FANCY', 'FANCY', 'FANCY added for v59', 0, 0, 100, '2024-12-03 09:30:52', '2025-04-18 10:13:26');

-- --------------------------------------------------------

--
-- Table structure for table `diamond_culet_master`
--

CREATE TABLE `diamond_culet_master` (
  `dc_id` bigint(20) UNSIGNED NOT NULL,
  `dc_name` varchar(250) DEFAULT NULL,
  `dc_short_name` varchar(250) DEFAULT NULL,
  `dc_alise` text DEFAULT NULL,
  `dc_remark` text DEFAULT NULL,
  `dc_display_in_front` tinyint(4) DEFAULT NULL,
  `dc_sort_order` int(11) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diamond_culet_master`
--

INSERT INTO `diamond_culet_master` (`dc_id`, `dc_name`, `dc_short_name`, `dc_alise`, `dc_remark`, `dc_display_in_front`, `dc_sort_order`, `date_added`, `date_modify`) VALUES
(1, 'None', 'N', 'N', 'None\r\n', 1, 1, '2015-12-31 03:55:20', '2015-12-31 05:08:04'),
(2, 'Very Small', 'VS', 'VS', 'Very Small', 1, 2, '2015-12-31 03:55:36', '2015-12-31 05:08:35'),
(3, 'Small', 'S', 'S', 'Small', 1, 3, '2015-12-31 03:55:51', '2015-12-31 05:08:42'),
(4, 'Medium', 'M', 'M', 'Medium', 1, 4, '2015-12-31 03:56:04', '2015-12-31 05:08:47'),
(5, 'Slightly Large', 'SL', 'SLG', 'Slightly Large', 1, 5, '2015-12-31 03:56:34', '2015-12-31 05:08:52'),
(6, 'Large', 'L', 'L', 'Large', 1, 6, '2015-12-31 03:56:48', '2015-12-31 05:08:57'),
(7, 'Very Large', 'vL', 'VL', 'Very Large', 1, 7, '2015-12-31 03:57:03', '2015-12-31 05:09:02');

-- --------------------------------------------------------

--
-- Table structure for table `diamond_cut_master`
--

CREATE TABLE `diamond_cut_master` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ALIAS` varchar(255) DEFAULT NULL,
  `shortname` varchar(10) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `display_in_front` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diamond_cut_master`
--

INSERT INTO `diamond_cut_master` (`id`, `name`, `ALIAS`, `shortname`, `full_name`, `remark`, `display_in_front`, `sort_order`, `date_added`, `date_modify`) VALUES
(1, 'EX', 'X, EX', 'EX', 'Excellent', '', 0, 2, '2013-08-06 00:00:00', '2016-03-17 09:50:02'),
(2, 'VG', 'V, VG', 'VG', 'Very Good', '', 1, 3, '2012-07-23 00:00:00', '2016-03-17 09:50:15'),
(3, 'G', 'G, Gd', 'G', 'Good', '', 1, 4, '2012-07-23 00:00:00', '2016-03-17 09:50:23'),
(4, 'ID', 'I', 'I', 'Ideal', '', 1, 1, '2012-07-23 00:00:00', '2016-03-22 15:28:07'),
(5, 'F', 'FR, F', 'F', 'Fair', '', 1, 5, '2013-08-06 00:00:00', '2016-03-17 09:50:54'),
(6, 'P', 'P', 'P', 'Poor', '', 0, 6, '2015-06-18 00:13:41', '2018-02-06 11:48:12'),
(7, 'NA', '', 'N/A', 'Not Available', '', 0, 0, '2015-10-24 05:47:28', '2016-01-19 17:54:20');

-- --------------------------------------------------------

--
-- Table structure for table `diamond_fancycolor_intensity_master`
--

CREATE TABLE `diamond_fancycolor_intensity_master` (
  `fci_id` bigint(20) UNSIGNED NOT NULL,
  `fci_name` varchar(250) DEFAULT NULL,
  `fci_short_name` varchar(250) DEFAULT NULL,
  `fci_alias` text DEFAULT NULL,
  `fci_remark` text DEFAULT NULL,
  `fci_display_in_front` tinyint(4) DEFAULT NULL,
  `fci_sort_order` int(11) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diamond_fancycolor_intensity_master`
--

INSERT INTO `diamond_fancycolor_intensity_master` (`fci_id`, `fci_name`, `fci_short_name`, `fci_alias`, `fci_remark`, `fci_display_in_front`, `fci_sort_order`, `date_added`, `date_modify`) VALUES
(1, 'Fancy', 'Fancy', 'FC', 'Fancy', 1, 1, '2015-12-31 03:37:03', '2024-02-13 11:19:26'),
(2, 'Fancy Intense', 'Intense', 'Intense', 'Fancy Intense', 1, 2, '2015-12-31 03:37:19', '2024-02-13 11:18:35'),
(3, 'Fancy Vivid', 'Vivid', 'FV', 'Fancy Vivid', 1, 3, '2015-12-31 03:37:34', '2024-02-13 11:18:50'),
(4, 'Fancy Deep', 'Deep', 'D', 'Fancy Deep', 1, 4, '2015-12-31 03:37:51', '2024-02-13 11:19:04'),
(5, 'Fancy Dark', 'Dark', 'FCD', 'Fancy Dark', 1, 5, '2015-12-31 03:38:10', '2024-02-13 11:19:36'),
(6, 'Faint', 'F', 'F', 'Faint', 0, 6, '2015-12-31 03:38:30', '2015-12-31 05:10:56'),
(7, 'Very Light', 'VL', 'VL', 'Very Light', 0, 7, '2015-12-31 03:41:59', '2015-12-31 05:11:01'),
(8, 'Light', 'L', 'L', 'Light', 0, 8, '2015-12-31 03:42:14', '2015-12-31 05:11:06'),
(9, 'Fancy Light', 'FCL', 'FCL', 'Fancy Light', 0, 9, '2015-12-31 03:42:28', '2015-12-31 05:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `diamond_fancycolor_overtones_master`
--

CREATE TABLE `diamond_fancycolor_overtones_master` (
  `fco_id` int(10) UNSIGNED NOT NULL,
  `fco_name` varchar(250) DEFAULT NULL,
  `fco_short_name` varchar(250) DEFAULT NULL,
  `fco_alise` text DEFAULT NULL,
  `fco_remark` text DEFAULT NULL,
  `fco_display_in_front` tinyint(4) DEFAULT NULL,
  `fco_sort_order` int(11) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diamond_fancycolor_overtones_master`
--

INSERT INTO `diamond_fancycolor_overtones_master` (`fco_id`, `fco_name`, `fco_short_name`, `fco_alise`, `fco_remark`, `fco_display_in_front`, `fco_sort_order`, `date_added`, `date_modify`) VALUES
(1, 'NOT APLICABALE', 'NA', 'NA', 'NOT APLICABALE', 0, 0, '2015-12-31 03:43:03', '2015-12-31 05:12:35'),
(2, 'BLACK', 'BK', 'BK', 'BLACK', 0, 1, '2015-12-31 03:43:55', '2015-12-31 05:12:39'),
(3, 'Bluish', 'BLUISH', 'B', 'BLUISH', 1, 2, '2015-12-31 03:45:14', '2024-02-16 11:49:20'),
(4, 'BROWNISH', 'BN', 'BN', 'BROWNISH', 0, 3, '2015-12-31 03:45:47', '2024-02-13 10:50:22'),
(5, 'CHAMELEON', 'CH', 'CH', 'CHAMELEON', 0, 4, '2015-12-31 03:46:03', '2015-12-31 05:12:53'),
(6, 'CHAMPAGNE', 'CM', 'CM', 'CHAMPAGNE', 0, 5, '2015-12-31 03:46:32', '2015-12-31 05:12:58'),
(7, 'COGNAC', 'CG', 'CG', 'COGNAC', 0, 6, '2015-12-31 03:46:45', '2015-12-31 05:13:03'),
(8, 'Greyish', 'Greyish', 'GY', 'GREYISH', 1, 7, '2015-12-31 03:46:59', '2024-02-16 11:49:42'),
(9, 'Greenish', 'Greenish', 'G', 'GREENISH', 1, 8, '2015-12-31 03:47:18', '2024-02-16 11:48:43'),
(10, 'Pinkish', 'Pinkish', 'P', 'PINKISH', 1, 9, '2015-12-31 03:47:29', '2024-02-16 11:48:56'),
(11, 'Orangy', 'O', 'O', 'ORANGY', 0, 11, '2015-12-31 03:47:49', '2024-02-16 11:50:48'),
(12, 'Yellowish', 'Y', 'Yellowish', 'YELLOWISH', 0, 12, '2015-12-31 03:48:02', '2024-02-16 11:50:34'),
(13, 'ORANGY YELLOW', 'OY', 'OY', 'ORANGY YELLOW', 0, 12, '2015-12-31 03:48:28', '2015-12-31 05:13:31'),
(14, 'two', 'two', 'two', 'two', 1, 1, '2025-04-26 22:16:00', '2025-04-18 16:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `diamond_flourescence_master`
--

CREATE TABLE `diamond_flourescence_master` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `short_name` varchar(150) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `fluo_status` tinyint(4) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diamond_flourescence_master`
--

INSERT INTO `diamond_flourescence_master` (`id`, `name`, `alias`, `short_name`, `full_name`, `fluo_status`, `sort_order`, `date_added`, `date_modify`) VALUES
(1, 'N', 'N,NON,NONE', 'N', 'None', 1, 1, NULL, '2024-07-05 11:50:09'),
(2, 'F', 'F,FNT,FAINT,VERY SLIGHT,SLIGHT', 'F', 'Faint', 1, 2, NULL, '2024-07-05 11:50:43'),
(3, 'M', 'M,MED,MEDIUM', 'M', 'Medium', 1, 3, NULL, '2024-07-05 11:50:54'),
(4, 'S', 'S,STG,STRONG', 'S', 'Strong', 1, 4, NULL, '2024-07-05 11:51:04'),
(5, 'VS', 'V Stg, VST,VERY STRONG', 'V', 'very Strong', 1, 5, '2015-11-06 04:23:58', '2024-07-05 11:51:16');

-- --------------------------------------------------------

--
-- Table structure for table `diamond_girdle_master`
--

CREATE TABLE `diamond_girdle_master` (
  `dg_id` bigint(20) UNSIGNED NOT NULL,
  `dg_name` varchar(250) DEFAULT NULL,
  `dg_short_name` varchar(250) DEFAULT NULL,
  `dg_alise` text DEFAULT NULL,
  `dg_remark` text DEFAULT NULL,
  `dg_display_in_front` tinyint(4) DEFAULT NULL,
  `dg_sort_order` int(11) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diamond_girdle_master`
--

INSERT INTO `diamond_girdle_master` (`dg_id`, `dg_name`, `dg_short_name`, `dg_alise`, `dg_remark`, `dg_display_in_front`, `dg_sort_order`, `date_added`, `date_modify`) VALUES
(1, 'Extremely Thin', 'XTN', 'XTN', 'Extremely Thin', 1, 1, '2015-12-31 03:49:47', '2015-12-31 05:06:39'),
(2, 'Very Thin', 'VTN', 'VTN', 'Very Thin', 1, 2, '2015-12-31 03:50:01', '2015-12-31 05:06:45'),
(3, 'Thin', 'TN', 'TN', 'Thin', 1, 3, '2015-12-31 03:50:20', '2015-12-31 05:06:50'),
(4, 'Slightly Thin', 'STN', 'STN', 'Slightly Thin', 1, 4, '2015-12-31 03:50:34', '2015-12-31 05:06:56'),
(5, 'Medium', 'M', 'M', 'Medium', 1, 5, '2015-12-31 03:51:22', '2015-12-31 05:07:03'),
(6, 'Slightly Thick', 'STK', 'STK', 'Slightly Thick', 1, 6, '2015-12-31 03:51:38', '2015-12-31 05:07:08'),
(7, 'Thick', 'TK', 'TK', 'Thick', 1, 7, '2015-12-31 03:52:08', '2015-12-31 05:07:14'),
(8, 'Very Thick', 'VTK', 'VTK', 'Very Thick', 1, 8, '2015-12-31 03:52:23', '2015-12-31 05:07:19'),
(9, 'Extremely Thick', 'XTK', 'XTK,ETK', 'Extremely Thick', 1, 9, '2015-12-31 03:52:37', '2023-09-04 11:52:27'),
(11, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-18 16:53:00', '2025-04-11 16:53:00');

-- --------------------------------------------------------

--
-- Table structure for table `diamond_key_to_symbols_master`
--

CREATE TABLE `diamond_key_to_symbols_master` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `short_name` varchar(150) DEFAULT NULL,
  `sym_status` tinyint(4) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diamond_key_to_symbols_master`
--

INSERT INTO `diamond_key_to_symbols_master` (`id`, `name`, `alias`, `short_name`, `sym_status`, `sort_order`, `date_added`, `date_modify`) VALUES
(3, 'Crystal', '', '', 0, 0, '2021-06-16 10:40:50', '2021-06-18 12:20:02'),
(4, 'Feather', '', '', 0, 0, '2021-06-16 10:41:25', '2021-06-18 12:20:18'),
(5, 'Indented Natural', '', '', 0, 0, '2021-06-16 10:42:07', '2021-06-18 12:20:37'),
(6, 'Cavity', '', '', 0, 0, '2021-06-16 10:42:38', '2021-06-18 12:23:13'),
(7, 'Needle', '', '', 0, 0, '2021-06-16 10:43:14', '2021-06-18 12:20:52'),
(8, 'Natural', '', '', 0, 0, '2021-06-16 10:43:49', '2021-06-18 12:21:12'),
(9, 'Knot', '', '', 0, 0, '2021-06-16 10:44:26', '2021-06-18 12:21:24'),
(10, 'Pinpoint', '', '', 0, 0, '2021-06-16 11:34:56', '2021-06-18 12:22:42'),
(11, 'Chip', '', '', 0, 0, '2021-06-18 19:59:39', '2021-06-18 12:23:46'),
(12, 'Cloud', NULL, NULL, 0, 0, '2021-06-18 19:59:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `diamond_lab_master`
--

CREATE TABLE `diamond_lab_master` (
  `dl_id` int(10) UNSIGNED NOT NULL,
  `dl_name` varchar(250) DEFAULT NULL,
  `dl_display_in_front` tinyint(4) NOT NULL DEFAULT 0,
  `dl_sort_order` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `cert_url` varchar(255) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diamond_lab_master`
--

INSERT INTO `diamond_lab_master` (`dl_id`, `dl_name`, `dl_display_in_front`, `dl_sort_order`, `image`, `cert_url`, `date_added`, `date_modify`) VALUES
(1, 'GIA', 1, 1, '20181012125505gia.png', 'https://www.gia.edu/report-check?reportno=', '2016-05-25 05:24:00', '2021-09-20 09:26:00'),
(2, 'EGLUSA', 1, 7, '20181012125528egl.png', 'https://www.eglusa.com/verify-a-report-results/?st_num=', '2016-05-25 05:39:40', '2021-10-18 09:54:15'),
(3, 'AGS', 1, 5, '20181012125536ags.png', 'https://agslab.com/ym-vdgr/en-us/login?id=', '2016-05-25 05:39:48', NULL),
(5, 'HRD', 1, 5, '20181012125548hrd.png', 'https://my.hrdantwerp.com/?id=34&record_number=', '2016-05-25 05:40:36', NULL),
(7, 'IGI', 1, 2, '20181012132540igi.png', 'https://www.api.igi.org/viewpdf.php?r=', '2016-05-25 06:43:06', '2024-04-12 15:48:35'),
(8, 'GSI', 0, 6, '', 'https://gsiworldwide.com/diamond-grading-report', '2016-06-03 00:00:00', '2020-09-10 14:36:04'),
(9, 'NCR', 0, 99, '20181012125628ncr.png', NULL, '2016-06-03 00:00:00', '2016-06-03 00:00:00'),
(11, 'INTERNAL GRADING', 1, 999, '2019042609332520181012125944None_280x280.png', '', '2018-08-15 12:12:34', '2022-10-26 11:08:18'),
(12, 'GCAL', 1, 3, '', 'https://www.gcalusa.com/certificate-search.html?certificate_id=', '2020-11-10 18:31:45', '2020-11-10 18:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `diamond_polish_master`
--

CREATE TABLE `diamond_polish_master` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `short_name` varchar(150) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `pol_status` tinyint(4) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diamond_polish_master`
--

INSERT INTO `diamond_polish_master` (`id`, `name`, `alias`, `short_name`, `full_name`, `pol_status`, `sort_order`, `date_added`, `date_modify`) VALUES
(1, 'Ex', 'EX,X', 'EX', 'Excellent', 1, 1, NULL, '2016-06-08 17:32:41'),
(2, 'VG', 'VG', 'VG', 'Very Good', 1, 2, NULL, '2016-06-08 17:32:50'),
(3, 'G', 'G,GD', 'G', 'Good', 1, 3, NULL, '2025-01-14 07:26:08'),
(4, 'I', 'I,ID', 'I', 'Ideal ', 1, 0, '2015-11-20 15:42:37', '2016-06-08 17:33:04'),
(5, 'F', 'F', 'F', 'Fair', 1, 4, '2015-11-09 14:34:30', '2016-06-08 17:33:10'),
(6, 'P', 'P', 'P', 'Poor', 1, 5, '2015-11-09 14:34:50', '2016-06-08 17:33:17');

-- --------------------------------------------------------

--
-- Table structure for table `diamond_shade_master`
--

CREATE TABLE `diamond_shade_master` (
  `ds_id` bigint(20) UNSIGNED NOT NULL,
  `ds_name` varchar(250) DEFAULT NULL,
  `ds_short_name` varchar(250) DEFAULT NULL,
  `ds_alise` text DEFAULT NULL,
  `ds_remark` text DEFAULT NULL,
  `ds_display_in_front` tinyint(4) DEFAULT NULL,
  `ds_sort_order` int(11) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diamond_shade_master`
--

INSERT INTO `diamond_shade_master` (`ds_id`, `ds_name`, `ds_short_name`, `ds_alise`, `ds_remark`, `ds_display_in_front`, `ds_sort_order`, `date_added`, `date_modify`) VALUES
(1, 'WHITE', 'NONE', 'W', 'WHITE\r\n', 1, 1, '2015-12-31 03:53:17', '2022-06-28 10:49:51'),
(2, 'YELLOWISH', 'Y', 'Y', 'YELLOWISH\r\n', 1, 2, '2015-12-31 03:53:43', '2016-08-25 10:09:17'),
(3, 'MIXED TINGE', 'MT', 'MIXED', 'MIXED TINGE', 1, 6, '2015-12-31 03:53:58', '2022-06-28 13:07:59'),
(4, 'BROWNISH', 'BRN', 'BRN', 'BROWNISH', 1, 4, '2015-12-31 03:54:09', '2022-06-28 10:50:14'),
(5, 'GREENISH', 'GRN', 'GRN', 'GREENISH\r\n', 1, 5, '2015-12-31 03:54:55', '2022-06-28 10:49:35'),
(7, 'GREY', 'GRY', 'GREY', '', 1, 55, '2016-08-19 10:06:54', '2022-06-28 10:49:19'),
(8, 'Other', 'Other', 'Other,Oth', '', 0, 90, '2024-07-05 12:01:06', NULL),
(14, 'Other', 'Other', 'Other,Oth', NULL, 0, 9, '2024-07-05 12:01:00', NULL),
(15, 'Other', 'Other', 'Other,Oth', NULL, 0, 19, '2024-07-05 12:01:00', NULL),
(16, 'Other', 'Other', 'Other,Oth', NULL, 0, 1, '2024-07-05 12:01:00', NULL),
(17, 'Other', 'Others', 'Other,Oth', NULL, 0, 1, '2024-07-05 12:01:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `diamond_shape_master`
--

CREATE TABLE `diamond_shape_master` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ALIAS` varchar(255) DEFAULT NULL,
  `shortname` varchar(15) DEFAULT NULL,
  `rap_shape` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `image4` varchar(255) DEFAULT NULL,
  `svg_image` longtext DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `display_in_front` int(11) DEFAULT NULL,
  `display_in_stud` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diamond_shape_master`
--

INSERT INTO `diamond_shape_master` (`id`, `name`, `ALIAS`, `shortname`, `rap_shape`, `image`, `image2`, `image3`, `image4`, `svg_image`, `remark`, `display_in_front`, `display_in_stud`, `sort_order`, `date_added`, `date_modify`) VALUES
(1, 'Round', 'BR,RD,RBC', 'RD', 'BR', '2020022110121020151006024838dia_1.png', '20150418022910round_roll.png', '20150418022910round_disable.png', 'round_big.jpg', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"https://www.w3.org/2000/svg\" xmlns:xlink=\"https://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\n	 width=\"500px\" height=\"500px\" viewBox=\"0 0 500 500\" enable-background=\"new 0 0 500 500\" xml:space=\"preserve\">\n<g>\n	<defs>\n		<rect id=\"SVGID_1_\" width=\"500\" height=\"500\"/>\n	</defs>\n	<clipPath id=\"SVGID_2_\">\n		<use xlink:href=\"#SVGID_1_\"  overflow=\"visible\"/>\n	</clipPath>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3C5B\" d=\"M477,250.14c0,125.374-101.637,227.01-227.011,227.01\n		c-125.375,0-227.011-101.636-227.011-227.01c0-125.375,101.636-227.011,227.011-227.011C375.363,23.128,477,124.764,477,250.14\n		 M270.533,371.098l32.716,14.377l18.021-41.664l-57.775,24.221 M405.633,391.695l-16.303-76.339l-53.191,22.215l-21.368,49.342\n		L405.633,391.695z M418.186,402.273l-105.726-4.245l22.491,50.908c23.786-9.885,51.423-28.065,75.775-54.306\n		c24.353-26.239,37.398-58.011,37.398-58.011l-47.368-19.541L418.186,402.273z M194.162,398.532c0,0-17.872,41.411-23.019,52.919\n		c12.845,4.912,40.264,14.931,80.703,14.828c40.439-0.102,72.702-13.207,72.702-13.207l-20.836-47.35l-49.772,70.755\n		L194.162,398.532z M98.195,418.839l7.736-103.335c0,0-38.637,15.849-53.599,22.241c5.323,13.145,19.937,40.7,47.675,68.036\n		c27.737,27.336,61.023,41.405,61.023,41.405l20.978-48.551L98.195,418.839z M109.314,405.779l77.355-19.175l-21.795-49.929\n		l-47.812-21.049L109.314,405.779z M197.512,383.664l37.908-15.899l-55.528-24.462L197.512,383.664z M253.509,459.402l44.367-64.132\n		l-48.435-21.326l-45.349,19.006L253.509,459.402z M118.813,304.265l39.502,17.388l-23.699-54.247L118.813,304.265z\n		 M106.166,202.211l-65.832,47.727l69.045,48.087l19.153-44.572L106.166,202.211z M140.637,253.406l32.683,74.858l76.225,33.58\n		l78.15-32.775l34.931-80.679l-31.188-73.583l-84.773-34.635l-71.016,31.703L140.637,253.406z M342.495,322.865l43.9-18.417\n		l-17.782-41.921L342.495,322.865z M374.718,248.434l21.144,49.885l63.986-46.419l-65.402-49.014L374.718,248.434z M134.549,239.44\n		l26.404-61.508l-45.345,18.119L134.549,239.44z M101.085,102.377l12.719,82.435l53.354-21.332l19.653-45.789L101.085,102.377z\n		 M197.819,120.212l-15.702,36.594l50.307-22.448L197.819,120.212z M368.728,234.307l16.276-37.603l-38.962-15.919L368.728,234.307z\n		 M325.283,160.293l-19.681-46.415l-44.9,20.037L325.283,160.293z M339.783,166.239l47.669,19.455l15.223-80.221l-85.846,6.414\n		L339.783,166.239z M246.476,128.1l52.943-23.635L251.31,40.906l-47.225,69.875L246.476,128.1z M89.144,90.061l95.832,16.3\n		c0,0-19.458-43.361-24.005-53.24c-16.117,8.171-33.934,15.617-64.079,44.442c-30.145,28.825-45.409,66.91-45.409,66.91\n		l51.257,21.465L89.144,90.061z M250.754,23.797l56.176,72.412c0,0,15.111-38.657,18.823-48.554\n		c-1.771-0.672-29.321-13.399-75.296-13.655c-45.974-0.256-79.244,14.801-79.244,14.801l24.6,54.535L250.754,23.797z\n		 M414.799,94.409l-16.19,91.146l50.775-18.956c0,0-11.135-31.832-43.202-65.85c-32.067-34.018-70.129-48.932-70.129-48.932\n		l-18.974,48.96L414.799,94.409z M403.131,195.716l73.5,56.293l-72.963,54.244l48.648,20.055c0,0,14.271-36.277,13.823-72.725\n		c-0.448-36.448-5.224-55.991-12.729-76.708C439.771,182.077,403.131,195.716,403.131,195.716 M48.061,327.406l52.846-21.914\n		l-77.338-55.271l73.323-54.671c0,0-40.974-17.19-49.545-20.787c0,0-14.156,31.815-13.505,77.671\n		C34.493,298.29,48.061,327.406,48.061,327.406\"/>\n</g>\n</svg>', '', 1, 1, 1, '2012-07-23 00:00:00', '2022-04-12 11:10:50'),
(2, 'Princess', 'SMB', 'PR', 'PS', '20151006024900dia_2.png', '20150418023457princess_roll.png', '20150418023457princess_disable.png', 'princess_big.jpg', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"https://www.w3.org/2000/svg\" xmlns:xlink=\"https://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\n	 width=\"500px\" height=\"500px\" viewBox=\"0 0 500 500\" enable-background=\"new 0 0 500 500\" xml:space=\"preserve\">\n<path fill=\"#2C3C5B\" d=\"M477.708,477.03H26.301V26.63h451.407V477.03z M101.526,62.095l298.783-0.015l53.414-23.499H50.288\n	L101.526,62.095z M391.302,82.096l-24.886,53.343l51.508-24.799l26.791-52.043L391.302,82.096z M363.414,151.455l19.86,97.019\n	l31.647-121.821L363.414,151.455z M426.932,126.652l-31.647,121.82l31.413,126.438L426.932,126.652z M438.94,102.632l-0.233,296.298\n	l27.025,54.14V50.589L438.94,102.632z M351.406,139.442L376.29,86.1l-124.952,33.481L351.406,139.442z M251.489,107.57\n	L376.29,74.089l-250.745,0.014L251.489,107.57z M125.545,86.113l24.884,53.343l100.909-19.876L125.545,86.113z M251.338,131.589\n	l-100.904,19.862l-19.481,100.979l19.785,99.229l100.494,19.609l99.944-19.838l20.089-102.958l-19.861-97.022L251.338,131.589z\n	 M363.18,351.474l51.509,23.438l-31.414-126.438L363.18,351.474z M367.184,366.443l24.899,53.017l53.633,24.604l-27.024-54.141\n	L367.184,366.443z M376.07,416.457l-24.895-53.016l-99.944,19.838L376.07,416.457z M376.02,428.467l-124.878-33.178l-124.757,33.596\n	L376.02,428.467z M50.288,465.08h403.435l-53.633-24.604l-297.724,0.418L50.288,465.08z M150.738,363.67l-24.353,53.206\n	l124.757-33.597L150.738,363.67z M135.726,366.672l-52.202,24.362l-24.229,53.029l52.078-24.186L135.726,366.672z M82.949,111.161\n	l51.467,24.293l-24.884-53.344L58.294,58.597L82.949,111.161z M38.278,453.07l24.229-53.029l0.426-296.887L38.278,50.589V453.07z\n	 M118.944,252.431l19.475-100.964L86.703,127.12L118.944,252.431z M74.943,127.173l-0.426,248.848l32.417-123.515L74.943,127.173z\n	 M86.526,376.021l52.202-24.351l-19.784-99.24L86.526,376.021z\"/>\n</svg>', '', 1, 1, 2, '2012-07-23 00:00:00', '2020-04-23 10:12:01'),
(3, 'Emerald', 'EC', 'EM', 'PS', '20151006025324dia_10.png', '20150418023511emerald_roll.png', '20150418023511emerald_disable.png', 'emerald_big.jpg', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"https://www.w3.org/2000/svg\" xmlns:xlink=\"https://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\n	 width=\"500px\" height=\"500px\" viewBox=\"0 0 500 500\" enable-background=\"new 0 0 500 500\" xml:space=\"preserve\">\n<path fill=\"#2C3C5B\" d=\"M310.084,98.199l24.318,24.318v254.967l-24.318,24.318H182.12l-24.318-24.318V122.517l24.318-24.318H310.084\n	z M315.055,86.199H177.15l-31.348,31.347v264.908l31.348,31.348h137.905l31.348-31.348V117.546L315.055,86.199z\"/>\n<path fill=\"#2C3C5B\" d=\"M327.044,74.79l31.607,29.091v292.237l-31.607,29.092H165.161l-31.608-29.092V103.881l31.608-29.091H327.044\n	z M331.726,62.79H160.479l-38.926,35.827v302.766l38.926,35.827h171.247l38.926-35.827V98.617L331.726,62.79z\"/>\n<path fill=\"#2C3C5B\" d=\"M327.044,74.79l31.607,29.091v292.237l-31.607,29.092H165.161l-31.608-29.092V103.881l31.608-29.091H327.044\n	z M331.726,62.79H160.479l-38.926,35.827v302.766l38.926,35.827h171.247l38.926-35.827V98.617L331.726,62.79z\"/>\n<path fill=\"#2C3C5B\" d=\"M342.368,51.381l38.577,33.753v329.732l-38.577,33.753H148.721l-38.577-33.753V85.134l38.577-33.753H342.368\n	z M346.877,39.381H144.212L98.144,79.688v340.624l46.068,40.308h202.665l46.068-40.308V79.688L346.877,39.381z\"/>\n<path fill=\"#2C3C5B\" d=\"M359.362,28.25l45.829,38.34v366.82l-45.829,38.34h-226.52l-45.83-38.34V66.59l45.83-38.34H359.362z\n	 M363.72,16.25H128.485L75.013,60.984v378.033l53.472,44.733H363.72l53.472-44.733V60.984L363.72,16.25z\"/>\n<rect x=\"110.996\" y=\"45.81\" transform=\"matrix(0.6494 -0.7604 0.7604 0.6494 -28.9851 121.239)\" fill=\"#2C3C5B\" width=\"12\" height=\"92.489\"/>\n<rect x=\"150.166\" y=\"15.422\" transform=\"matrix(0.8225 -0.5688 0.5688 0.8225 -6.1796 99.4122)\" fill=\"#2C3C5B\" width=\"12.001\" height=\"88.367\"/>\n<rect x=\"330.346\" y=\"12.951\" transform=\"matrix(0.8047 0.5937 -0.5937 0.8047 100.3935 -188.2856)\" fill=\"#2C3C5B\" width=\"12\" height=\"90.96\"/>\n<rect x=\"368.997\" y=\"46.329\" transform=\"matrix(0.6258 0.78 -0.78 0.6258 212.5891 -257.8191)\" fill=\"#2C3C5B\" width=\"12\" height=\"92.648\"/>\n<rect x=\"111.314\" y=\"359.165\" transform=\"matrix(0.6494 0.7605 -0.7605 0.6494 350.4867 53.4169)\" fill=\"#2C3C5B\" width=\"12.001\" height=\"95.265\"/>\n<rect x=\"148.899\" y=\"395.706\" transform=\"matrix(0.8225 0.5688 -0.5688 0.8225 278.5187 -9.7615)\" fill=\"#2C3C5B\" width=\"12\" height=\"91.293\"/>\n<rect x=\"331.426\" y=\"397.216\" transform=\"matrix(0.8047 -0.5937 0.5937 0.8047 -196.6108 286.71)\" fill=\"#2C3C5B\" width=\"12\" height=\"89.88\"/>\n<rect x=\"368.126\" y=\"358.576\" transform=\"matrix(0.6258 -0.78 0.78 0.6258 -176.6252 444.1776)\" fill=\"#2C3C5B\" width=\"13\" height=\"95.196\"/>\n</svg>', '', 1, 1, 5, '2012-07-23 00:00:00', '2022-04-12 12:25:06'),
(4, 'Asscher', 'AS', 'AC', 'PS', '20151006025110dia_4.png', '20150418023539asscher_roll.png', '20150418023539asscher_disable.png', 'asscher_big.jpg', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"https://www.w3.org/2000/svg\" xmlns:xlink=\"https://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\n	 width=\"500px\" height=\"500px\" viewBox=\"0 0 500 500\" enable-background=\"new 0 0 500 500\" xml:space=\"preserve\">\n<g>\n	<defs>\n		<rect id=\"SVGID_1_\" width=\"500\" height=\"500\"/>\n	</defs>\n	<clipPath id=\"SVGID_2_\">\n		<use xlink:href=\"#SVGID_1_\"  overflow=\"visible\"/>\n	</clipPath>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3C5B\" d=\"M483.596,84.908c-0.052-0.355-0.091-0.691-0.193-1.034\n		c-0.143-0.457-0.349-0.852-0.595-1.27c-0.104-0.194-0.141-0.426-0.283-0.613c-0.077-0.11-0.194-0.149-0.259-0.245\n		c-0.103-0.11-0.142-0.259-0.245-0.375l-59.957-63.114c-0.194-0.194-0.452-0.283-0.658-0.451c-0.207-0.162-0.337-0.388-0.543-0.536\n		c-0.154-0.085-0.31-0.085-0.438-0.143c-0.374-0.199-0.749-0.335-1.175-0.444c-0.413-0.123-0.813-0.233-1.238-0.259\n		c-0.143-0.013-0.284-0.103-0.452-0.103H101.442c-0.155,0-0.297,0.09-0.452,0.103c-0.439,0.026-0.839,0.136-1.264,0.259\n		c-0.388,0.122-0.75,0.231-1.111,0.432c-0.155,0.058-0.322,0.07-0.465,0.155c-0.245,0.148-0.386,0.387-0.593,0.555\n		c-0.193,0.174-0.426,0.252-0.607,0.432L36.986,81.371c-0.097,0.103-0.129,0.239-0.225,0.348c-0.091,0.11-0.214,0.162-0.298,0.272\n		c-0.141,0.206-0.18,0.458-0.303,0.677c-0.213,0.381-0.413,0.749-0.549,1.168c-0.115,0.381-0.168,0.755-0.219,1.149\n		c-0.026,0.245-0.142,0.478-0.142,0.736v332.799c0,1.789,0.748,3.479,2.065,4.673c0,0,64.019,57.711,66.889,60.17\n		c0.839,0.406,1.731,0.69,2.686,0.69h305.234c0.942,0,1.833-0.284,2.672-0.69c2.87-2.459,5.74-4.917,8.61-7.376l58.279-52.794\n		c1.316-1.194,2.064-2.884,2.064-4.673V85.721C483.75,85.437,483.634,85.179,483.596,84.908 M47.706,98.151l27.171,20.233v131.796\n		v131.816l-27.171,20.229V98.151z M100.41,32.76l19.891,32.114L80.389,106.89l-29.52-21.982L100.41,32.76z M468.131,84.894\n		l-29.52,21.996L398.7,64.874l19.904-32.114L468.131,84.894z M431.68,250.181v122.536l-23.002-17.123V250.181V144.774l23.002-17.128\n		V250.181z M259.5,428.401H139.378l12.25-19.769H259.5h107.872l12.25,19.769H259.5z M87.32,250.181V127.646l22.99,17.116v105.418\n		v105.413l-22.99,17.136V250.181z M259.5,71.974h120.122l-12.25,19.762H259.5H151.628l-12.25-19.762H259.5z M396.234,250.181v96.146\n		l-14.005-10.43v-85.716v-85.695l14.005-10.436V250.181z M259.5,396.073H159.399l13.089-21.097H259.5h87.013l13.076,21.097H259.5z\n		 M122.766,250.181v-96.144l14.018,10.448v85.695v85.716l-14.018,10.43V250.181z M259.5,104.289h100.089l-13.076,21.118H259.5\n		h-87.012l-13.089-21.118H259.5z M347.171,362.416H259.5h-87.67l-22.59-25.731v-86.504v-86.496l22.59-25.726h87.67h87.671\n		l22.615,25.726v86.496v86.504L347.171,362.416z M376.872,152.842l-19.168-21.808l13.515-21.827l22.55,31.057L376.872,152.842z\n		 M161.296,131.034l-19.168,21.808l-16.896-12.578l22.536-31.057L161.296,131.034z M142.128,347.526l19.168,21.814l-13.528,21.82\n		l-22.536-31.063L142.128,347.526z M357.704,369.341l19.168-21.814l16.896,12.572l-22.55,31.063L357.704,369.341z M403.785,132.809\n		l-25.454-35.078l13.553-21.879l36.62,38.55L403.785,132.809z M140.669,97.731l-25.454,35.078l-24.732-18.42l36.62-38.537\n		L140.669,97.731z M115.215,367.566l25.454,35.064l-13.566,21.879l-36.62-38.55L115.215,367.566z M378.331,402.631l25.441-35.077\n		l24.731,18.406l-36.62,38.55L378.331,402.631z M387.405,59.42H259.5H131.595l-18.923-30.539h293.656L387.405,59.42z\n		 M80.389,393.479l39.912,42.01l-18.252,29.456l-53.065-48.069L80.389,393.479z M131.595,440.961H259.5h127.905l18.923,30.541\n		H112.659L131.595,440.961z M398.7,435.488l39.911-42.01l31.406,23.409l-53.065,48.069L398.7,435.488z M444.122,381.997V250.181\n		V118.384l27.186-20.246v304.087L444.122,381.997z\"/>\n	<line clip-path=\"url(#SVGID_2_)\" fill=\"#2C3C5B\" x1=\"104.204\" y1=\"483.363\" x2=\"108.291\" y2=\"485.958\"/>\n</g>\n</svg>', '', 1, 0, 7, '2012-07-23 00:00:00', '2020-04-23 10:13:01'),
(5, 'Marquise', 'MB', 'MQ', 'PS', '20151006025120dia_7.png', '20150418023552marquise_roll.png', '20150418023552marquise_disable.png', 'marquise_big.jpg', '<svg version=\"1.1\" id=\"marquise\" xmlns=\"https://www.w3.org/2000/svg\" xmlns:xlink=\"https://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\n	 width=\"500px\" height=\"500px\" viewBox=\"0 0 500 500\" enable-background=\"new 0 0 500 500\" xml:space=\"preserve\">\n<g>\n	<defs>\n		<rect id=\"SVGID_1_\" width=\"500\" height=\"500\"/>\n	</defs>\n	<clipPath id=\"SVGID_2_\">\n		<use xlink:href=\"#SVGID_1_\"  overflow=\"visible\"/>\n	</clipPath>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"none\" stroke=\"#2C3C5B\" stroke-width=\"12\" stroke-miterlimit=\"10\" d=\"M243.609,25.173\n		c0,0,96.527,84.31,103.036,209.042c0,0,19.062,119.729-103.036,240.612c-8.375-7.24-100.436-89.396-103.718-224.503\n		C139.891,250.324,133.984,127.192,243.609,25.173z\"/>\n	<polyline clip-path=\"url(#SVGID_2_)\" fill=\"none\" stroke=\"#2C3C5B\" stroke-width=\"12\" stroke-miterlimit=\"10\" points=\"\n		241.64,27.024 222.632,84.46 214.068,141.437 192.734,249.556 179.934,306.472 174.868,381.665 214.238,405.79 243.61,467.686 \n		273.364,406.084 	\"/>\n	<polyline clip-path=\"url(#SVGID_2_)\" fill=\"none\" stroke=\"#2C3C5B\" stroke-width=\"12\" stroke-miterlimit=\"10\" points=\"\n		283.635,70.207 243.609,104.203 214.069,141.437 179.934,191.188 140.841,248.18 178.253,306.472 217.761,355.676 243.609,390.132 \n		273.315,413.978 283.635,426.953 	\"/>\n	<polyline clip-path=\"url(#SVGID_2_)\" fill=\"none\" stroke=\"#2C3C5B\" stroke-width=\"12\" stroke-miterlimit=\"10\" points=\"\n		263.593,82.773 308.62,109.579 308.62,191.188 294.101,250.682 269.576,356.254 270.344,410.016 312.864,379.354 308.046,306.472 \n		294.549,253.08 273.477,140.281 263.593,82.773 243.78,27.99 	\"/>\n	<polyline clip-path=\"url(#SVGID_2_)\" fill=\"none\" stroke=\"#2C3C5B\" stroke-width=\"12\" stroke-miterlimit=\"10\" points=\"\n		203.018,70.207 218.383,82.772 243.609,104.203 273.477,140.282 307.119,191.188 346.645,250.682 306.955,309.134 269.576,356.254 \n		243.609,390.132 211.844,414.386 203.149,429.865 	\"/>\n	<polyline clip-path=\"url(#SVGID_2_)\" fill=\"none\" stroke=\"#2C3C5B\" stroke-width=\"12\" stroke-miterlimit=\"10\" points=\"\n		220.205,86.075 177.953,110.83 179.605,194.683 193.392,251.333 218.225,357.697 213.247,411.732 	\"/>\n</g>\n</svg>', '', 1, 0, 6, '2012-07-23 00:00:00', '2020-04-23 10:14:24'),
(6, 'Oval', 'OB', 'OV', 'PS', '20151006025129dia_3.png', '20150418023614oval_roll.png', '20150418023614oval_disable.png', 'oval_big.jpg', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"https://www.w3.org/2000/svg\" xmlns:xlink=\"https://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\n	 width=\"500px\" height=\"500px\" viewBox=\"0 0 500 500\" enable-background=\"new 0 0 500 500\" xml:space=\"preserve\">\n<g>\n	<defs>\n		<rect id=\"SVGID_1_\" width=\"500\" height=\"500\"/>\n	</defs>\n	<clipPath id=\"SVGID_2_\">\n		<use xlink:href=\"#SVGID_1_\"  overflow=\"visible\"/>\n	</clipPath>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3C5B\" d=\"M251.053,483.826c0.09,0,0.17,0.011,0.261,0.011\n		c0.096,0,0.191-0.011,0.282-0.011h0.054c22.945-0.08,44.698-8.054,64.203-22.227c0.182-0.08,0.384-0.102,0.549-0.214\n		c0.208-0.133,0.33-0.346,0.511-0.506c18.329-13.588,34.606-32.688,47.965-55.873c0.058-0.059,0.128-0.08,0.182-0.139\n		c0.367-0.479,0.617-1.018,0.798-1.598c11.095-19.622,20.092-42.126,26.479-66.66c0-0.031,0.016-0.048,0.016-0.069\n		c6.961-26.78,10.823-55.952,10.823-86.515c0-30.542-3.862-59.726-10.823-86.497c0-0.031-0.021-0.064-0.021-0.09\n		c-6.381-24.533-15.378-47.016-26.467-66.649c-0.182-0.558-0.437-1.107-0.804-1.587c-0.054-0.069-0.124-0.091-0.188-0.165\n		c-13.348-23.17-29.625-42.265-47.953-55.836c-0.181-0.165-0.304-0.379-0.517-0.523c-0.17-0.111-0.373-0.127-0.554-0.223\n		c-19.506-14.163-41.258-22.131-64.198-22.216h-0.054c-0.091,0-0.187-0.006-0.282-0.006c-0.091,0-0.171,0.006-0.261,0.006h-0.043\n		c-22.962,0.074-44.725,8.053-64.236,22.237c-0.17,0.086-0.346,0.102-0.511,0.202c-0.186,0.134-0.299,0.331-0.464,0.48\n		c-18.349,13.577-34.642,32.688-48.012,55.889c-0.052,0.064-0.127,0.097-0.181,0.155c-0.372,0.49-0.639,1.05-0.814,1.619\n		c-10.877,19.255-19.745,41.258-26.095,65.243c-0.164,0.426-0.276,0.852-0.329,1.289c-6.978,26.823-10.861,56.055-10.861,86.671\n		v0.01c0,30.621,3.883,59.857,10.861,86.676c0.053,0.447,0.165,0.863,0.329,1.283c6.35,23.996,15.218,45.978,26.095,65.243\n		c0.175,0.591,0.442,1.14,0.814,1.63c0.054,0.059,0.129,0.08,0.181,0.139c13.375,23.201,29.669,42.328,48.018,55.911\n		c0.165,0.154,0.277,0.346,0.458,0.468c0.159,0.102,0.336,0.123,0.501,0.192c19.521,14.194,41.284,22.179,64.246,22.248H251.053z\n		 M195.574,455.782l22.343-35.686l25.407,53.29C226.46,471.901,210.375,465.77,195.574,455.782 M120.902,338.646l23.963-13.231\n		l-6.573,59.96C131.358,371.051,125.504,355.37,120.902,338.646 M138.292,114.704l6.573,59.948l-23.963-13.225\n		C125.504,144.702,131.358,129.021,138.292,114.704 M243.324,26.696l-25.407,53.269l-22.343-35.692\n		C210.375,34.292,226.46,28.172,243.324,26.696 M307.086,44.284l-22.345,35.681l-25.406-53.269\n		C276.198,28.182,292.284,34.303,307.086,44.284 M381.777,161.427l-23.969,13.225l6.566-59.948\n		C371.306,129.021,377.17,144.691,381.777,161.427 M364.375,385.362l-6.566-59.948l23.969,13.242\n		C377.17,355.37,371.306,371.051,364.375,385.362 M259.335,473.376l25.406-53.279l22.345,35.676\n		C292.284,465.748,276.198,471.901,259.335,473.376 M168.681,268.471l18.855,66.979l-31.139-21.188L168.681,268.471z\n		 M156.396,185.817l31.139-21.199l-18.855,66.984L156.396,185.817z M333.989,231.602l-18.861-66.995l31.154,21.21L333.989,231.602z\n		 M346.282,314.262l-31.154,21.188l18.861-66.989L346.282,314.262z M200.165,344.228l-26.531-94.201l26.531-94.204l51.165-42.014\n		l51.17,42.014l26.521,94.204l-26.521,94.201l-51.17,42.02L200.165,344.228z M260.32,391.76l35.75-29.364l-14.567,40.47\n		L260.32,391.76z M339.156,250.026l14.753-54.947l38.377,54.947l-38.377,54.972L339.156,250.026z M260.32,108.312l21.183-11.116\n		l14.567,40.47L260.32,108.312z M277.658,87.912l-26.329,13.811l-26.333-13.811l26.327-55.207L277.658,87.912z M242.344,108.312\n		l-35.756,29.364l14.574-40.48L242.344,108.312z M163.502,250.026l-14.738,54.962l-38.37-54.962l38.37-54.947L163.502,250.026z\n		 M242.344,391.76l-21.182,11.105l-14.574-40.47L242.344,391.76z M224.997,412.154l26.333-13.806l26.329,13.806l-26.335,55.224\n		L224.997,412.154z M310.755,350.491l37.227-25.315l7.883,72.033l-64.391,6.866L310.755,350.491z M359.146,314.72l33.865-48.508\n		c-0.996,21.816-3.963,42.776-8.666,62.431L359.146,314.72z M359.146,185.347l25.199-13.917c4.703,19.643,7.67,40.597,8.666,62.419\n		L359.146,185.347z M347.981,174.897l-37.227-25.327l-19.281-53.562l64.391,6.85L347.981,174.897z M191.903,149.57l-37.211,25.316\n		l-7.888-72.028l64.385-6.85L191.903,149.57z M143.529,185.347l-33.86,48.502c0.996-21.822,3.963-42.776,8.661-62.409\n		L143.529,185.347z M143.529,314.72l-25.199,13.923c-4.698-19.654-7.665-40.624-8.661-62.431L143.529,314.72z M154.692,325.176\n		l37.211,25.315l19.286,53.584l-64.385-6.866L154.692,325.176z M315.033,449.908l-22.446-35.82l59.405-6.333\n		C341.248,424.751,328.77,439.021,315.033,449.908 M351.992,92.317l-59.405-6.322l22.44-35.831\n		C328.77,61.052,341.244,75.315,351.992,92.317 M187.631,50.153l22.44,35.842l-59.405,6.322\n		C161.416,75.305,173.899,61.041,187.631,50.153 M150.667,407.755l59.405,6.333l-22.44,35.831\n		C173.895,439.021,161.416,424.762,150.667,407.755\"/>\n</g>\n</svg>', '', 1, 0, 4, '2012-07-23 00:00:00', '2020-04-23 10:15:02'),
(7, 'Radiant', 'RAD,CSMB,SQ', 'RA', 'PS', '20151006025137dia_5.png', '20150418023636radiant_roll.png', '20150418023636radiant_disable.png', 'radiant_big.jpg', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"https://www.w3.org/2000/svg\" xmlns:xlink=\"https://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\n	 width=\"500px\" height=\"500px\" viewBox=\"0 0 500 500\" enable-background=\"new 0 0 500 500\" xml:space=\"preserve\">\n<g>\n	<defs>\n		<rect id=\"SVGID_1_\" width=\"500\" height=\"500\"/>\n	</defs>\n	<clipPath id=\"SVGID_2_\">\n		<use xlink:href=\"#SVGID_1_\"  overflow=\"visible\"/>\n	</clipPath>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3C5B\" d=\"M163.526,483.887c0.016,0,0.023,0.007,0.03,0.007H336.14\n		c0.014,0,0.014-0.007,0.021-0.007c0.911,0,1.792-0.199,2.629-0.479c0.177-0.057,0.355-0.112,0.525-0.187\n		c0.726-0.299,1.413-0.666,1.983-1.17l110.173-97.399c1.184-1.051,1.857-2.42,1.857-3.851v-2.258V121.462v-4.534\n		c0-1.449-0.688-2.842-1.91-3.893L341.24,17.899c-0.556-0.479-1.236-0.839-1.939-1.139c-0.171-0.068-0.341-0.111-0.511-0.173\n		c-0.814-0.274-1.673-0.448-2.555-0.454c-0.037,0-0.066-0.019-0.096-0.019H163.556c-0.03,0-0.052,0.019-0.089,0.019\n		c-0.88,0.006-1.732,0.18-2.554,0.447c-0.177,0.069-0.341,0.112-0.511,0.187c-0.71,0.293-1.384,0.653-1.955,1.132l-110.17,95.136\n		c-1.223,1.051-1.904,2.444-1.904,3.893v4.534v257.082v2.258c0,1.431,0.659,2.8,1.844,3.851l110.179,97.399\n		c0.57,0.504,1.259,0.871,1.984,1.17c0.177,0.074,0.356,0.13,0.54,0.187C161.75,483.688,162.623,483.887,163.526,483.887\n		 M171.959,27.491h155.785l-5.82,25.988H177.771l-2.997-13.417L171.959,27.491z M148.92,85.106l12.6-9.871l-0.963,4.703\n		l-4.56,22.224l-39.475,8.335L148.92,85.106z M369.462,203.673l-10.72-41.935l-12.061-47.186l51.772,10.935l-11.535,31.126\n		L369.462,203.673z M130.233,203.673l-28.992-78.186l51.773-10.935L130.233,203.673z M328.551,97.579l-44.888-15.009l38.728-15.003\n		l0.911,4.435L328.551,97.579z M177.304,67.566l38.721,15.003l-44.88,15.009l5.257-25.577L177.304,67.566z M343.698,102.163\n		l-5.524-26.927l45,35.262L343.698,102.163z M296.813,64.868l-31.999,12.403h-29.939l-31.998-12.403H296.813z M138.495,227.367\n		l16.88-66.076l12.889-50.438l66.41-22.206h30.339l66.409,22.212l11.031,43.148l18.753,73.36v45.269l-18.975,74.248l-10.81,42.26\n		l-66.409,22.211h-30.339l-66.41-22.211l-12.718-49.773l-17.051-66.734V227.367z M126.939,379.938l-25.698-5.418l28.992-78.186\n		l22.781,89.114L126.939,379.938z M322.391,432.429l-38.728-14.997l44.888-15.016l-5.249,25.577L322.391,432.429z M171.146,402.416\n		l40.378,13.505l4.502,1.511l-38.721,14.997l-0.902-4.436L171.146,402.416z M338.174,424.765l5.524-26.926l39.476-8.328\n		L338.174,424.765z M398.454,374.52l-26.585,5.61l-25.188,5.318l22.78-89.114l16.836,45.381L398.454,374.52z M155.997,397.839\n		l5.523,26.926l-44.998-35.254L155.997,397.839z M202.883,435.135l31.991-12.397h29.939l31.999,12.397H202.883z M375.223,272.374\n		v-44.752l25.03-67.513v179.79L375.223,272.374z M124.48,227.622v44.752l-25.038,67.524V160.103L124.48,227.622z M177.771,446.517\n		h144.153l5.82,25.988H171.959l2.858-12.783L177.771,446.517z M340.507,465.924l-3.234-14.499l-1.933-8.621l74.76-58.574h22.826\n		L340.507,465.924z M414.268,127.155h25.039v245.698h-25.039V127.155z M435.346,115.771H410.1l-74.76-58.573l0.666-2.98\n		l4.546-20.302L435.346,115.771z M159.151,33.917l3.42,15.32l1.785,7.962l-74.753,58.573H64.342L159.151,33.917z M85.42,372.854\n		H60.389V127.155H85.42V372.854z M66.778,384.229h22.825l19.278,15.102l55.475,43.473l-0.63,2.805l-4.538,20.315L66.778,384.229z\"/>\n</g>\n</svg>', '', 1, 0, 7, '2012-07-23 00:00:00', '2022-12-08 14:02:09'),
(8, 'Pear', 'PMB,PB', 'PS', 'PS', '20151006025200dia_9.png', '20150418023657pear_roll.png', '20150418023657pear_disable.png', 'pear_big.jpg', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"https://www.w3.org/2000/svg\" xmlns:xlink=\"https://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\n	 width=\"500px\" height=\"500px\" viewBox=\"0 0 500 500\" enable-background=\"new 0 0 500 500\" xml:space=\"preserve\">\n<g>\n	<defs>\n		<rect id=\"SVGID_1_\" width=\"500\" height=\"500\"/>\n	</defs>\n	<clipPath id=\"SVGID_2_\">\n		<use xlink:href=\"#SVGID_1_\"  overflow=\"visible\"/>\n	</clipPath>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3C5B\" d=\"M395.709,333.868c0.219-1.569,0.322-2.564,0.336-2.713\n		c0.18-17.896-1.177-35.307-3.657-52.207c-0.039-0.226-0.039-0.459-0.104-0.679c-5.814-38.891-17.844-74.889-32.599-106.964\n		c-0.207-1.137-0.634-2.23-1.409-3.095c-16.073-34.247-35.08-63.861-52.652-87.552c-0.206-0.446-0.336-0.911-0.659-1.311\n		c-0.219-0.303-0.555-0.485-0.84-0.731c-28.49-38.071-52.704-60.268-53.298-60.805c-0.026-0.025-0.065-0.032-0.104-0.058\n		c-0.206-0.187-0.466-0.29-0.712-0.446c-0.167-0.122-0.297-0.297-0.491-0.393c-0.089-0.058-0.219-0.052-0.336-0.097\n		c-0.141-0.078-0.309-0.175-0.477-0.24c-0.297-0.097-0.594-0.103-0.904-0.161c-0.298-0.058-0.595-0.149-0.905-0.161\n		c-0.155-0.007-0.298-0.007-0.452,0c-0.323,0.012-0.607,0.103-0.918,0.161c-0.297,0.058-0.607,0.064-0.904,0.168\n		c-0.168,0.058-0.311,0.155-0.479,0.233c-0.103,0.045-0.219,0.039-0.335,0.097c-0.194,0.096-0.298,0.271-0.478,0.393\n		c-0.246,0.156-0.504,0.259-0.724,0.446c-0.026,0.026-0.065,0.033-0.091,0.058c-0.594,0.537-24.769,22.696-53.221,60.741\n		c-0.309,0.265-0.671,0.459-0.917,0.795c-0.349,0.439-0.504,0.936-0.711,1.421c-17.481,23.619-36.423,53.118-52.419,87.229\n		l-0.142,0.148c-0.866,0.969-1.357,2.197-1.512,3.489c-14.64,31.901-26.579,67.699-32.393,106.377\n		c-0.233,0.639-0.323,1.318-0.335,2.021c-2.404,16.727-3.722,33.963-3.54,51.658c0.012,0.104,0.103,0.911,0.283,2.248\n		c-0.543,1.783-0.232,3.676,0.801,5.239c1.68,10.059,5.751,29.137,14.459,50.243c0.038,0.226-0.013,0.445,0.052,0.671\n		c0.219,0.86,0.646,1.577,1.162,2.224c6.732,15.634,16.061,32.127,28.879,46.773c0.465,1.008,1.24,1.776,2.119,2.409\n		c11.15,12.19,24.898,22.87,41.683,30.461c0.206,0.123,0.361,0.311,0.567,0.413c0.22,0.091,0.428,0.072,0.647,0.143\n		c15.892,6.978,34.473,11.234,56.308,11.234l2.288-0.02l2.481,0.02h0.013c21.849,0,40.415-4.257,56.309-11.24\n		c0.22-0.071,0.426-0.046,0.633-0.137c0.22-0.096,0.362-0.284,0.556-0.405c16.797-7.593,30.52-18.265,41.683-30.456\n		c0.893-0.633,1.667-1.42,2.132-2.435c12.792-14.62,22.121-31.081,28.827-46.71c0.529-0.665,0.981-1.396,1.228-2.268\n		c0.051-0.257,0.012-0.497,0.038-0.756c8.618-20.887,12.688-39.803,14.406-50.087C395.98,337.667,396.29,335.709,395.709,333.868\n		 M370.577,380.875l-11.228-3.088l18.916-20.39C376.379,364.452,373.872,372.449,370.577,380.875 M306.438,458.038l-6.409-14.349\n		l28.528-0.607C321.969,448.729,314.644,453.813,306.438,458.038 M164.051,443.069l29.265,0.62l-6.538,14.606\n		C178.315,454.013,170.782,448.832,164.051,443.069 M114.654,356.932l19.356,20.855l-11.694,3.217\n		C118.982,372.327,116.489,364.122,114.654,356.932 M324.256,130.694l-30.958-34.123l5.439-4.31\n		C307.136,103.793,315.806,116.624,324.256,130.694 M237.325,124.479l-42.174,45.54l17.611-63.758L237.325,124.479z\n		 M246.679,416.109l-61.245-22.302l-19.988-57.723l22.714-140.114l58.519-63.171l58.518,63.171l22.702,140.114l-19.988,57.723\n		L246.679,416.109z M159.451,356.88l10.129,29.279l-16.474-8.302L159.451,356.88z M333.895,356.88l6.345,20.978l-16.475,8.309\n		L333.895,356.88z M336.687,312.361l-13.697-84.463l26.863,49.047L336.687,312.361z M316.84,190.68l-19.679-71.24l50.327,55.469\n		l2.222,75.782L316.84,190.68z M280.583,106.261l17.611,63.758l-42.187-45.54L280.583,106.261z M246.679,115.803l-29.511-21.875\n		l29.511-57.724l29.499,57.724L246.679,115.803z M156.66,312.355l-13.166-35.41l26.861-49.041L156.66,312.355z M152.46,336.859\n		l-9.665,32.012l-31.604-34.079l24.317-43.518L152.46,336.859z M176.08,403.486l15.828,27.599l-37.381-0.795l-2.106-38.724\n		L176.08,403.486z M205.707,430.013l-11.228-19.55l33.246,12.107L205.707,430.013z M246.679,429.418l31.721,10.725l-31.721,28.839\n		l-31.733-28.839L246.679,429.418z M265.621,422.57l33.245-12.107l-11.228,19.557L265.621,422.57z M317.266,403.479l23.671-11.913\n		l-2.118,38.724l-37.394,0.795L317.266,403.479z M350.55,368.871l-9.664-32.012l16.951-45.591l24.317,43.523L350.55,368.871z\n		 M360.874,206.256c7.765,20.931,14.084,43.213,18.063,66.613l-16.177-2.009L360.874,206.256z M286.242,86.182L272.134,58.59\n		c5.879,6.854,12.352,14.775,19.11,23.631L286.242,86.182z M207.103,86.182l-4.988-3.947c6.745-8.851,13.205-16.766,19.071-23.62\n		L207.103,86.182z M176.506,190.68l-32.858,60.011l2.21-75.782l50.326-55.469L176.506,190.68z M130.585,270.86l-16.086,1.995\n		c3.979-23.302,10.259-45.487,17.973-66.335L130.585,270.86z M112.574,285.764l12.585-1.563l-14.885,26.616\n		C110.739,302.354,111.488,293.988,112.574,285.764 M139.824,389.215l1.55,28.458c-5.646-8.179-10.311-16.654-14.148-24.995\n		L139.824,389.215z M205.036,448.043l24.549,22.335c-11.5-1.151-21.927-3.612-31.333-7.127L205.036,448.043z M288.309,448.043\n		l6.721,15.027c-9.406,3.592-19.796,6.106-31.242,7.281L288.309,448.043z M353.521,389.215l12.068,3.314\n		c-3.734,7.991-8.205,16.106-13.528,23.962L353.521,389.215z M368.187,284.201l12.689,1.576c1.058,8.256,1.807,16.649,2.261,25.15\n		L368.187,284.201z M194.621,92.28l5.44,4.291L169.27,130.5C177.682,116.514,186.287,103.747,194.621,92.28\"/>\n</g>\n</svg>', '', 1, 0, 9, '2012-07-23 00:00:00', '2020-04-23 10:16:15'),
(9, 'Heart', 'HT,H', 'HS', 'PS', '20151006025205dia_8.png', '20150418023714heart_roll.png', '20150418023714heart_disable.png', 'heart_big.jpg', '', '', 0, 0, 10, '2012-07-23 00:00:00', '2020-04-23 10:16:37'),
(10, 'Cushion', 'CB,CUSHION BRILLIANT,CS,CR,CH,CUS,CMB', 'CU', 'PS', '20151006025229dia_6.png', '201407090414171_Cushion_roll.png', '201407090414171_Cushion_disable.png', 'cushion_big.jpg', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"https://www.w3.org/2000/svg\" xmlns:xlink=\"https://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\n	 width=\"500px\" height=\"500px\" viewBox=\"0 0 500 500\" enable-background=\"new 0 0 500 500\" xml:space=\"preserve\">\n<g>\n	<defs>\n		<rect id=\"SVGID_1_\" width=\"500\" height=\"500\"/>\n	</defs>\n	<clipPath id=\"SVGID_2_\">\n		<use xlink:href=\"#SVGID_1_\"  overflow=\"visible\"/>\n	</clipPath>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3C5B\" d=\"M314.25,483H183.698c-47.453,0-88.852-24.273-116.869-58.776\n		c-21.79-26.835-35.881-59.067-35.881-95.976V168.75c0-33.917,14.056-67.254,32.759-92.601C91.523,38.45,133.253,16,183.698,16\n		H314.25c45.11,0,84.653,21.556,112.615,52.651C451.194,95.707,467,129.499,467,168.75v161.5c0,36.908-15.092,69.758-36.882,96.162\n		C402.102,460.36,361.703,483,314.25,483 M177.908,144.336l57.23-22.553l-49.06-31.015L177.908,144.336z M399.05,178.505\n		l-59.185-14.577l29.593,70.939l11.108-21.166L399.05,178.505z M263.828,121.783l57.222,22.553l-8.177-53.568L263.828,121.783z\n		 M378.348,281.805l-8.89-16.929l-29.593,70.947l59.185-14.571L378.348,281.805z M274.952,34.989c0.688,0.652,1.38,1.304,2.06,1.956\n		c1.374,1.296,2.746,2.594,4.12,3.863c0.728,0.673,1.456,1.339,2.177,1.997c1.395,1.284,2.781,2.538,4.162,3.773\n		c0.596,0.534,1.206,1.081,1.803,1.608c1.921,1.707,3.827,3.386,5.666,4.973c0.222,0.195,0.443,0.375,0.658,0.562\n		c1.65,1.429,3.253,2.795,4.807,4.099c0.596,0.499,1.157,0.978,1.741,1.463c1.144,0.965,2.274,1.907,3.355,2.795\n		c0.569,0.472,1.131,0.93,1.672,1.38c1.047,0.86,2.046,1.672,3.01,2.449c0.444,0.354,0.901,0.728,1.324,1.067\n		c1.151,0.923,2.22,1.783,3.197,2.559c0.125,0.098,0.277,0.216,0.389,0.313c0.014-0.035,0.027-0.063,0.042-0.097\n		c0.443-1.061,0.915-2.227,1.428-3.468c0.069-0.173,0.152-0.389,0.229-0.576c0.423-1.033,0.858-2.129,1.317-3.273\n		c0.173-0.444,0.36-0.916,0.534-1.367c0.388-0.97,0.77-1.962,1.165-2.989c0.208-0.533,0.416-1.074,0.631-1.622\n		c0.396-1.047,0.805-2.123,1.213-3.218c0.202-0.534,0.403-1.075,0.611-1.623c0.472-1.283,0.95-2.614,1.436-3.946\n		c0.139-0.402,0.277-0.777,0.423-1.172c0.624-1.775,1.256-3.578,1.88-5.416c0.063-0.188,0.125-0.396,0.193-0.589\n		c0.542-1.603,1.075-3.219,1.596-4.849c0.181-0.555,0.354-1.116,0.534-1.678c0.407-1.297,0.812-2.6,1.206-3.911\n		c0.098-0.305,0.181-0.611,0.278-0.923h-60.843c0.271,0.278,0.548,0.541,0.825,0.811C271.505,31.64,273.225,33.332,274.952,34.989\n		 M170.565,33.762c0.214,0.659,0.415,1.317,0.63,1.976c0.458,1.437,0.93,2.865,1.401,4.279c0.132,0.375,0.257,0.77,0.389,1.145\n		c0.61,1.789,1.22,3.551,1.838,5.284c0.173,0.499,0.346,0.965,0.527,1.45c0.436,1.235,0.873,2.448,1.317,3.634\n		c0.235,0.624,0.458,1.228,0.687,1.831c0.381,1.033,0.756,2.032,1.13,3.009c0.229,0.603,0.465,1.2,0.687,1.784\n		c0.381,0.97,0.742,1.899,1.103,2.821c0.194,0.499,0.395,1.013,0.589,1.492c0.423,1.068,0.832,2.087,1.227,3.058\n		c0.098,0.257,0.222,0.548,0.32,0.798c0.506,1.241,0.984,2.413,1.428,3.474c0.007,0.021,0.014,0.034,0.02,0.049\n		c0.112-0.091,0.243-0.209,0.354-0.285c1.013-0.798,2.109-1.671,3.295-2.628c0.354-0.292,0.756-0.617,1.13-0.916\n		c1.027-0.832,2.115-1.72,3.253-2.649c0.471-0.395,0.964-0.798,1.463-1.207c1.158-0.957,2.372-1.976,3.621-3.016\n		c0.498-0.424,0.991-0.833,1.511-1.262c1.7-1.436,3.454-2.927,5.264-4.501c0.076-0.063,0.139-0.111,0.222-0.173\n		c1.865-1.617,3.793-3.323,5.749-5.056c0.555-0.494,1.123-1.006,1.685-1.506c1.415-1.262,2.837-2.545,4.272-3.863\n		c0.707-0.644,1.415-1.303,2.122-1.962c1.388-1.277,2.761-2.581,4.148-3.884c0.686-0.651,1.366-1.297,2.053-1.949\n		c1.726-1.657,3.453-3.349,5.159-5.049c0.278-0.27,0.549-0.533,0.825-0.811h-60.835c0.112,0.361,0.215,0.714,0.32,1.068\n		C169.822,31.39,170.197,32.576,170.565,33.762 M224.104,52.633c-2.254,2.06-4.474,4.064-6.644,5.998\n		c-0.333,0.285-0.639,0.548-0.964,0.832c-1.901,1.672-3.732,3.274-5.541,4.827c-0.611,0.535-1.214,1.055-1.825,1.568\n		c-1.705,1.456-3.37,2.857-4.951,4.182c-0.305,0.249-0.632,0.527-0.929,0.777c-1.81,1.505-3.488,2.884-5.105,4.195\n		c-0.555,0.444-1.04,0.846-1.567,1.269c-1.179,0.943-2.267,1.824-3.294,2.649c-0.215,0.167-0.499,0.396-0.707,0.561l56.903,35.974\n		l33.573-21.228l23.323-14.746c-0.224-0.172-0.514-0.408-0.735-0.589c-1.02-0.817-2.109-1.685-3.273-2.621\n		c-0.514-0.423-1.014-0.825-1.562-1.262c-1.608-1.318-3.3-2.705-5.125-4.224c-0.276-0.221-0.568-0.471-0.846-0.707\n		c-1.608-1.338-3.28-2.759-5.015-4.238c-0.603-0.512-1.206-1.025-1.823-1.56c-1.803-1.553-3.648-3.155-5.542-4.827\n		c-0.318-0.284-0.631-0.547-0.957-0.832c-2.17-1.934-4.396-3.938-6.644-5.998c-0.576-0.527-1.158-1.069-1.74-1.602\n		c-1.88-1.742-3.766-3.517-5.666-5.333c-0.499-0.479-0.991-0.937-1.498-1.416c-2.303-2.225-4.604-4.5-6.9-6.803\n		c-0.451-0.471-0.901-0.936-1.359-1.407c-1.874-1.908-3.724-3.842-5.548-5.798c-0.361-0.389-0.742-0.757-1.096-1.145h-3.134\n		c-0.355,0.388-0.736,0.756-1.097,1.145c-1.831,1.956-3.675,3.89-5.555,5.798c-0.457,0.471-0.908,0.936-1.366,1.407\n		c-2.281,2.303-4.577,4.571-6.887,6.79c-0.513,0.485-1.005,0.956-1.512,1.442c-1.899,1.818-3.786,3.578-5.665,5.32\n		C225.248,51.572,224.68,52.106,224.104,52.633 M361.891,249.875l-37.63-90.219l-74.781-29.475l-74.782,29.475l-37.63,90.219\n		l37.63,90.213l74.782,29.481l74.781-29.481L361.891,249.875z M159.086,163.928l-59.17,14.577l24.078,45.877l5.507,10.485\n		L159.086,163.928z M159.086,335.823l-29.585-70.947l-29.585,56.376L159.086,335.823z M321.05,355.415l-57.222,22.553l49.045,31.008\n		L321.05,355.415z M235.138,377.968l-57.23-22.56l8.17,53.567L235.138,377.968z M224.013,464.775\n		c-0.7-0.667-1.386-1.318-2.087-1.971c-1.374-1.31-2.739-2.593-4.106-3.855c-0.728-0.673-1.456-1.346-2.177-2.011\n		c-1.38-1.27-2.761-2.504-4.12-3.725c-0.624-0.555-1.248-1.13-1.866-1.664c-1.914-1.713-3.821-3.377-5.665-4.973\n		c-0.181-0.152-0.354-0.306-0.534-0.465c-1.679-1.442-3.308-2.837-4.883-4.168c-0.624-0.527-1.228-1.02-1.83-1.525\n		c-1.103-0.923-2.185-1.825-3.225-2.684c-0.617-0.514-1.242-1.027-1.831-1.52c-0.957-0.776-1.873-1.526-2.753-2.239\n		c-0.528-0.424-1.075-0.867-1.568-1.263c-0.839-0.68-1.588-1.276-2.337-1.872c-0.382-0.306-0.819-0.652-1.173-0.93\n		c-0.006,0.007-0.006,0.007-0.006,0.014c-0.888,2.129-1.928,4.667-3.037,7.483c-0.174,0.409-0.347,0.86-0.52,1.297\n		c-0.375,0.964-0.764,1.948-1.159,2.975c-0.228,0.59-0.458,1.2-0.694,1.811c-0.353,0.929-0.72,1.894-1.081,2.871\n		c-0.257,0.673-0.506,1.339-0.756,2.024c-0.382,1.013-0.749,2.053-1.124,3.094c-0.249,0.693-0.499,1.366-0.742,2.053\n		c-0.437,1.248-0.881,2.511-1.318,3.786c-0.291,0.846-0.575,1.692-0.867,2.553c-0.471,1.4-0.936,2.802-1.393,4.216\n		c-0.242,0.756-0.472,1.52-0.714,2.274c-0.334,1.09-0.673,2.164-1.006,3.254c-0.097,0.332-0.194,0.672-0.292,1.005h60.835\n		c-0.263-0.256-0.52-0.506-0.776-0.77C227.481,468.139,225.754,466.446,224.013,464.775 M453.775,249.875l-44.427-63.477\n		l-14.37,27.366l-18.953,36.111l33.323,63.478l8.508-12.157L453.775,249.875z M328.498,466.328c-0.235-0.748-0.457-1.491-0.7-2.231\n		c-0.458-1.431-0.93-2.845-1.408-4.253c-0.298-0.901-0.603-1.789-0.908-2.677c-0.409-1.2-0.825-2.399-1.234-3.564\n		c-0.291-0.806-0.576-1.588-0.853-2.372c-0.34-0.922-0.674-1.845-0.999-2.739c-0.284-0.777-0.568-1.539-0.854-2.295\n		c-0.333-0.874-0.659-1.734-0.978-2.573c-0.271-0.708-0.541-1.408-0.798-2.088c-0.326-0.84-0.645-1.658-0.963-2.455\n		c-0.243-0.617-0.487-1.255-0.729-1.852c-0.354-0.909-0.707-1.762-1.047-2.607c-0.159-0.402-0.333-0.832-0.492-1.214\n		c-0.485-1.193-0.937-2.289-1.359-3.302c-0.028-0.068-0.049-0.131-0.076-0.2c-1.082,0.853-2.324,1.845-3.627,2.891\n		c-0.396,0.326-0.839,0.688-1.263,1.027c-0.957,0.776-1.956,1.588-3.002,2.448c-0.563,0.458-1.151,0.942-1.742,1.429\n		c-1.054,0.873-2.156,1.796-3.28,2.732c-0.596,0.5-1.179,0.991-1.803,1.512c-1.588,1.346-3.238,2.753-4.93,4.217\n		c-0.174,0.139-0.319,0.271-0.492,0.409c-1.846,1.603-3.759,3.28-5.694,5c-0.576,0.514-1.172,1.048-1.755,1.574\n		c-1.408,1.256-2.822,2.531-4.244,3.835c-0.687,0.632-1.395,1.282-2.096,1.929c-1.393,1.296-2.794,2.607-4.209,3.946\n		c-0.658,0.63-1.331,1.262-1.997,1.906c-1.748,1.679-3.496,3.378-5.229,5.111c-0.257,0.25-0.514,0.493-0.771,0.749h60.843\n		c-0.098-0.333-0.195-0.665-0.291-0.999C329.185,468.52,328.838,467.424,328.498,466.328 M274.854,447.117\n		c2.262-2.066,4.494-4.091,6.679-6.02c0.257-0.235,0.507-0.45,0.77-0.679c1.977-1.741,3.905-3.42,5.777-5.021\n		c0.562-0.493,1.104-0.958,1.657-1.43c1.838-1.56,3.614-3.065,5.307-4.48c0.193-0.159,0.395-0.333,0.589-0.484\n		c1.865-1.561,3.599-2.982,5.25-4.328c0.479-0.389,0.915-0.742,1.38-1.116c1.2-0.965,2.31-1.859,3.356-2.685\n		c0.229-0.193,0.527-0.43,0.757-0.609l-56.896-35.973l-56.903,35.973c0.229,0.18,0.519,0.408,0.756,0.604\n		c1.012,0.804,2.087,1.671,3.252,2.606c0.52,0.424,1.013,0.826,1.574,1.263c1.603,1.311,3.288,2.691,5.091,4.195\n		c0.297,0.25,0.617,0.521,0.922,0.771c1.588,1.339,3.253,2.732,4.966,4.195c0.603,0.514,1.199,1.026,1.817,1.554\n		c1.789,1.546,3.627,3.148,5.52,4.813c0.333,0.299,0.652,0.569,0.991,0.868c2.158,1.913,4.37,3.917,6.603,5.964\n		c0.603,0.548,1.213,1.109,1.817,1.678c1.83,1.692,3.669,3.419,5.528,5.18c0.54,0.521,1.074,1.034,1.629,1.562\n		c2.289,2.205,4.571,4.452,6.831,6.734c0.479,0.485,0.943,0.971,1.422,1.456c1.865,1.906,3.704,3.828,5.527,5.777\n		c0.354,0.381,0.735,0.756,1.09,1.137h3.134c0.354-0.381,0.734-0.756,1.089-1.137c1.823-1.949,3.661-3.871,5.526-5.777\n		c0.479-0.485,0.937-0.971,1.408-1.456c2.275-2.282,4.563-4.536,6.853-6.749c0.541-0.513,1.068-1.012,1.601-1.525\n		c1.859-1.782,3.725-3.522,5.576-5.235C273.689,448.2,274.272,447.659,274.854,447.117 M449.226,165.037\n		c-1.131,0.597-2.185,1.138-3.26,1.692c-0.896,0.459-1.817,0.95-2.663,1.381c-1.096,0.555-2.08,1.04-3.107,1.54\n		c-0.728,0.366-1.512,0.762-2.204,1.095c-1.354,0.652-2.608,1.235-3.829,1.81c-1.109,0.513-2.143,0.978-3.148,1.422\n		c-0.631,0.285-1.311,0.589-1.907,0.846c-0.735,0.312-1.387,0.575-2.066,0.86c-0.555,0.236-1.138,0.472-1.65,0.686\n		c-0.639,0.25-1.2,0.458-1.783,0.68c-0.5,0.194-1.019,0.395-1.49,0.562c-0.541,0.201-1.027,0.367-1.533,0.541\n		c-0.36,0.118-0.742,0.263-1.082,0.375l35.758,51.091v-67.826c-1.103,0.61-2.108,1.137-3.162,1.705\n		C451.146,164.011,450.148,164.552,449.226,165.037 M419.501,321.231c0.34,0.11,0.743,0.264,1.11,0.381\n		c0.423,0.153,0.832,0.292,1.283,0.451c0.562,0.208,1.179,0.443,1.782,0.673c0.472,0.18,0.929,0.354,1.428,0.547\n		c0.645,0.257,1.346,0.549,2.039,0.84c0.548,0.222,1.068,0.432,1.645,0.687c0.734,0.313,1.539,0.673,2.329,1.026\n		c0.61,0.271,1.187,0.514,1.839,0.812c0.817,0.374,1.72,0.797,2.6,1.221c0.694,0.332,1.374,0.631,2.102,0.991\n		c0.916,0.445,1.908,0.943,2.886,1.422c0.783,0.389,1.539,0.749,2.357,1.172c1.013,0.514,2.129,1.09,3.19,1.651\n		c0.895,0.45,1.74,0.881,2.663,1.373c1.138,0.604,2.386,1.275,3.578,1.92c0.972,0.521,1.88,0.999,2.886,1.555\n		c0.014,0.007,0.021,0.013,0.041,0.021V270.14l-9.612,13.731L419.501,321.231z M51.612,333.756c1.554-0.825,3.1-1.63,4.543-2.351\n		c0.534-0.271,1.006-0.5,1.519-0.756c1.269-0.632,2.531-1.256,3.697-1.824c0.582-0.284,1.109-0.521,1.671-0.798\n		c1.033-0.479,2.066-0.971,3.024-1.407c0.547-0.25,1.04-0.458,1.567-0.701c0.881-0.388,1.761-0.776,2.572-1.13\n		c0.527-0.229,1.013-0.416,1.512-0.624c0.736-0.306,1.471-0.617,2.157-0.888c0.479-0.194,0.923-0.354,1.38-0.534\n		c0.624-0.236,1.242-0.472,1.81-0.68c0.451-0.159,0.868-0.298,1.291-0.451c0.353-0.117,0.762-0.271,1.095-0.381l-33.594-48.006\n		l-2.171-3.093v67.84c0.063-0.021,0.105-0.049,0.16-0.083c0.188-0.098,0.354-0.181,0.541-0.285c2.059-1.123,4.043-2.19,5.923-3.183\n		C50.766,334.18,51.162,333.978,51.612,333.756 M78.292,178.116c-0.472-0.151-0.922-0.311-1.436-0.498\n		c-0.499-0.181-1.068-0.402-1.615-0.604c-0.542-0.214-1.061-0.409-1.651-0.638c-0.561-0.221-1.192-0.492-1.797-0.742\n		c-0.637-0.264-1.241-0.512-1.941-0.811c-0.687-0.29-1.457-0.638-2.184-0.964c-0.673-0.305-1.305-0.568-2.019-0.901\n		c-1.477-0.68-3.037-1.415-4.687-2.22c-0.68-0.326-1.437-0.707-2.15-1.054c-1.035-0.513-2.047-1.012-3.156-1.574\n		c-0.84-0.431-1.776-0.915-2.656-1.381c-1.083-0.554-2.137-1.095-3.28-1.692c-0.902-0.485-1.88-1.019-2.823-1.525\n		c-1.068-0.576-2.088-1.104-3.212-1.72v67.826l35.765-51.091C79.09,178.409,78.673,178.256,78.292,178.116 M122.933,249.875\n		l-16.817-32.054l-16.507-31.423l-18.932,27.053l-25.5,36.424l22.892,32.699l21.54,30.778l17.332-33.004L122.933,249.875z\n		 M155.843,29.129c-8.166,2.383-17.592,5.83-27.621,10.906c-16.636,8.419-29.136,18.386-37.877,26.616\n		c26.689,1.961,53.461,3.278,80.318,3.941c0.022,0,0.249,0.005,0.271,0.006C165.904,56.775,160.874,42.952,155.843,29.129\n		 M45.577,145.579c0,0,26.712,14.678,37.67,17.819c-0.279-9.792-2.39-85.922-2.39-85.922S54.947,105.484,45.577,145.579\n		 M95.938,163.085l67.825-16.713l9.556-62.59c-26.591-1.855-53.182-2.764-79.774-4.619C93.545,93.261,95.938,163.085,95.938,163.085\n		 M325.606,74.569c0.023-0.001,54.838-4.112,81.518-6.188c-8.775-8.192-22.265-19.05-38.937-27.397\n		c-10.051-5.032-19.492-8.439-27.669-10.786C335.549,44.988,330.578,59.778,325.606,74.569 M405.479,80.612\n		c-26.268,1.972-53.481,4.891-79.749,6.863l10.773,62.549l67.896,17.364C404.4,167.388,405.54,94.709,405.479,80.612\n		 M417.605,77.932c0,0-1.781,76.138-2.018,85.932c10.943-3.189,37.593-17.983,37.593-17.983\n		C443.637,105.827,417.605,77.932,417.605,77.932 M343.092,466.66c8.223-2.4,17.715-5.872,27.813-10.982\n		c16.752-8.478,29.339-18.515,38.141-26.801c-26.874-1.975-53.833-3.301-80.877-3.969c-0.022,0-0.251-0.006-0.272-0.007\n		C332.962,438.821,338.026,452.74,343.092,466.66 M454.126,349.399c0,0-26.898-14.78-37.932-17.943\n		c0.28,9.86,2.406,86.52,2.406,86.52S444.69,389.773,454.126,349.399 M403.414,331.771l-68.297,16.83l-9.623,63.026\n		c26.776,1.867,53.553,2.782,80.329,4.65C405.823,402.081,403.414,331.771,403.414,331.771 M174.037,422.795\n		c-0.022,0.001-55.219,4.14-82.084,6.231c8.838,8.248,22.42,19.183,39.209,27.588c10.12,5.066,19.628,8.497,27.861,10.861\n		L174.037,422.795z M93.61,416.71c26.451-1.986,53.853-4.925,80.304-6.911l-10.848-62.984l-68.37-17.485\n		C94.696,329.329,93.548,402.515,93.61,416.71 M81.399,419.408c0,0,1.793-76.668,2.032-86.529\n		c-11.02,3.211-37.854,18.107-37.854,18.107C55.187,391.319,81.399,419.408,81.399,419.408\"/>\n</g>\n</svg>', '', 1, 0, 3, '2012-07-23 00:00:00', '2020-04-23 10:17:19'),
(11, 'ALL OTHERS', 'Other shapes', 'OTH', 'PS', '20171020140748Others Diamond Shape Small.png', '', '', '', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"https://www.w3.org/2000/svg\" xmlns:xlink=\"https://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\n	 width=\"500px\" height=\"500px\" viewBox=\"0 0 500 500\" enable-background=\"new 0 0 500 500\" xml:space=\"preserve\">\n<g>\n	<defs>\n		<rect id=\"SVGID_1_\" width=\"500\" height=\"500\"/>\n	</defs>\n	<clipPath id=\"SVGID_2_\">\n		<use xlink:href=\"#SVGID_1_\"  overflow=\"visible\"/>\n	</clipPath>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3B5B\" d=\"M262.604,284.223c0-8.18-6.631-14.811-14.811-14.811\n		s-14.811,6.631-14.811,14.811c0,8.181,6.631,14.813,14.811,14.813S262.604,292.403,262.604,284.223\"/>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3B5B\" d=\"M289.962,189.375c-2.846-10.687-15.624-19.69-26.718-22.129\n		c-11.094-2.44-21.897-3.137-33.629,0.871c-11.733,4.008-21.723,13.301-24.801,23.117c-3.079,9.816-0.261,17.308,9.932,18.412\n		c10.192,1.104,13.591-10.02,14.462-12.197c0,0,0.407-1.569,2.672-4.705c2.265-3.137,7.899-9.468,21.084-6.389\n		c13.185,3.078,11.5,16.321,11.5,16.321c-1.104,8.886-9.235,13.94-12.895,17.076c-3.658,3.137-14.984,10.048-17.89,19.457\n		c-2.904,9.41,1.452,17.89,10.92,18.587c9.467,0.696,11.384-8.596,13.359-13.301c1.975-4.704,8.771-8.77,10.57-10.048\n		c8.48-5.983,13.127-9.99,17.077-15.218C293.563,208.078,292.809,200.062,289.962,189.375\"/>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3B5B\" d=\"M247.774,313.925c-0.014,0-0.027-0.001-0.041-0.001\n		c0.02,0,0.04,0.001,0.06,0.001c0.03,0,0.06-0.002,0.089-0.002C247.846,313.923,247.81,313.925,247.774,313.925\"/>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3B5B\" d=\"M245.032,313.873c-0.215-0.007-0.43-0.016-0.645-0.024\n		C244.602,313.857,244.817,313.866,245.032,313.873\"/>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3B5B\" d=\"M238.773,313.425c-0.086-0.01-0.172-0.021-0.257-0.029\n		C238.602,313.405,238.688,313.415,238.773,313.425\"/>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3B5B\" d=\"M258.744,313.183c-0.146,0.02-0.291,0.042-0.438,0.062\n		C258.453,313.225,258.598,313.202,258.744,313.183\"/>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3B5B\" d=\"M251.606,313.832c-0.201,0.01-0.403,0.015-0.605,0.023\n		C251.203,313.847,251.405,313.842,251.606,313.832\"/>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3B5B\" d=\"M308.07,287.023c0.031-0.034,0.062-0.069,0.093-0.104\n		C308.132,286.954,308.102,286.989,308.07,287.023\"/>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3B5B\" d=\"M275.748,308.965c-4.521,1.663-9.229,2.931-14.087,3.77\n		c0.08-0.014,0.162-0.022,0.243-0.037L248.71,343.92l-13.033-30.895c-4.662-0.698-9.193-1.794-13.559-3.25l26.592,66.436\n		l26.828-67.165C275.608,309.021,275.678,308.991,275.748,308.965\"/>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3B5B\" d=\"M311.983,282.322c0.008-0.009,0.015-0.019,0.021-0.028\n		C311.998,282.304,311.991,282.313,311.983,282.322\"/>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3B5B\" d=\"M255.283,313.575c-0.221,0.021-0.44,0.04-0.661,0.059\n		C254.843,313.615,255.063,313.597,255.283,313.575\"/>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3B5B\" d=\"M291.748,300.963c0.2-0.13,0.398-0.263,0.6-0.395\n		C292.146,300.7,291.948,300.833,291.748,300.963\"/>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3B5B\" d=\"M283.578,305.6c0.254-0.125,0.508-0.25,0.761-0.378\n		C284.086,305.35,283.832,305.475,283.578,305.6\"/>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3B5B\" d=\"M281.129,306.764c0.184-0.083,0.365-0.172,0.548-0.256\n		C281.494,306.592,281.313,306.681,281.129,306.764\"/>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3B5B\" d=\"M286.547,304.062c0.211-0.114,0.418-0.233,0.627-0.35\n		C286.965,303.828,286.758,303.947,286.547,304.062\"/>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3B5B\" d=\"M305.908,289.337c0.064-0.066,0.13-0.133,0.194-0.199\n		C306.038,289.204,305.973,289.271,305.908,289.337\"/>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3B5B\" d=\"M288.98,302.674c0.205-0.121,0.412-0.241,0.616-0.364\n		C289.393,302.433,289.186,302.553,288.98,302.674\"/>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3B5B\" d=\"M381.305,91.369H116.797l-85.739,95.538l216.436,201.96l217.033-201.881\n		L381.305,91.369z M439.699,178.677H335.614l43.479-68.945L439.699,178.677z M365.564,105.136l-44.184,68.5l-56.936-68.5H365.564z\n		 M233.903,105.136l-58.123,68.5l-44.555-68.5H233.903z M118.743,110.148l43.285,68.528H55.886L118.743,110.148z M248.71,369.647\n		L55.904,191.428h113.649l3.976,8.952c5.405-12.325,13.784-23.051,24.235-31.259l50.946-60.501l57.091,67.712\n		c7.223,7.408,13.036,16.192,17.014,25.925l4.793-10.829h112.092L248.71,369.647z\"/>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3B5B\" d=\"M303.851,291.386c0.036-0.035,0.072-0.071,0.108-0.106\n		C303.923,291.314,303.887,291.351,303.851,291.386\"/>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3B5B\" d=\"M278,308.095c0.278-0.112,0.555-0.225,0.831-0.34\n		C278.555,307.869,278.277,307.982,278,308.095\"/>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3B5B\" d=\"M294.227,299.292c0.123-0.087,0.249-0.171,0.371-0.258\n		C294.476,299.121,294.35,299.205,294.227,299.292\"/>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3B5B\" d=\"M301.436,293.605c0.127-0.112,0.254-0.225,0.38-0.338\n		C301.689,293.381,301.563,293.493,301.436,293.605\"/>\n	<path clip-path=\"url(#SVGID_2_)\" fill=\"#2C3B5B\" d=\"M296.713,297.478c0.173-0.131,0.345-0.263,0.517-0.396\n		C297.058,297.215,296.886,297.347,296.713,297.478\"/>\n	<polyline clip-path=\"url(#SVGID_2_)\" fill=\"#2C3B5B\" points=\"299.341,295.402 299.348,295.396 299.341,295.402 	\"/>\n	\n		<circle clip-path=\"url(#SVGID_2_)\" fill=\"none\" stroke=\"#2C3B5B\" stroke-width=\"13.101\" stroke-miterlimit=\"10\" cx=\"247.792\" cy=\"232.185\" r=\"87.481\"/>\n</g>\n</svg>', '', 1, 0, 98, '2015-10-06 02:45:23', '2020-03-03 10:56:47'),
(12, 'EUROPEAN', 'European', 'EU', 'BR', '', '', '', '', NULL, 'Old Miner, European', 0, 0, 12, '2018-01-16 16:29:07', '2018-01-16 16:36:08');
INSERT INTO `diamond_shape_master` (`id`, `name`, `ALIAS`, `shortname`, `rap_shape`, `image`, `image2`, `image3`, `image4`, `svg_image`, `remark`, `display_in_front`, `display_in_stud`, `sort_order`, `date_added`, `date_modify`) VALUES
(13, 'BAGUETTE', 'BAG', 'BG', 'PS', '20180905173412Baguette 50px.png', '', '', '', NULL, '', 0, 0, 11, '2018-01-16 16:38:58', '2018-09-05 17:34:12'),
(14, 'ROSE', '', 'RS', 'PS', '20190917084744rose.png', '', '', '', NULL, '', 0, 0, 16, '2018-01-16 16:39:28', '2019-09-17 08:47:44'),
(15, 'TRILLIANT', '', 'TR', 'PS', NULL, NULL, NULL, '20230228031140trilliant.png', '<svg id=\"Layer_1\" data-name=\"Layer 1\" xmlns=\"https://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><defs><style>.cls-1{fill:#030303;}</style></defs><path class=\"cls-1\" d=\"M295.3,419.6l-38.7,66.1L.2,47.9H511.7c1,2.1-.8,3.3-1.5,4.6Q423.4,200.9,336.6,349.1ZM324,331.2l17.8-30.7c-1.7-.3-4.3.9-5.7,1.9l-65.6,46.2c-2.3,1.6-4,3-4,6.2q.2,34.8.1,69.7a16.5,16.5,0,0,0,.9,3c5.4-9.3,10.6-17.5,15.3-26.1ZM464.8,87.3c-15.1,8.4-30.2,16.6-45,25.3-6.8,3.9-16.2,5.7-19.5,12.6s-2.1,15.6-3,23.5c-2.4,19.7-3.1,39.6-6.5,59.2-.3,1.4-.9,3.5.7,4.3s2.9-1.3,3.7-2.8L466,88.2V86.6ZM48.4,87.2c-.6-1.1-1.5-1.1-2.5-.6l1.3,1.8c24.3,41.7,48.6,83.4,73.6,126.1.5-7.6-5.9-82.3-7.2-88.3a5.2,5.2,0,0,0-3-4Zm130.4,146s-28.8-49.4-36.9-63.1c-.9-1.5-1.2-3.8-3.5-4.3-1.1,1.3-.4,2.6-.3,3.8,2.6,27.3,5.4,54.5,7.9,81.8a10,10,0,0,0,4.7,8c22.7,15.8,45.2,31.7,67.8,47.6,1,.8,2.2,1.4,3.5,2.3.3-3.3-1.5-4.9-2.5-6.7L186.4,246M199,228c13.8,23.9,27.8,47.6,41.7,71.4l15.9,27L372.7,128h-232c1.3,2.5,2.2,4.4,3.3,6.3L177.9,192Zm91.8,79.4c2.3,1.4,3.5,0,4.7-.8l68.2-48.1a7.4,7.4,0,0,0,3.3-5.9c2.8-29.4,5.8-58.8,8.7-88.2l-.9-.5Q332.8,235.6,290.8,307.4Zm-120-200.2H342.5c-28.8-12.9-56-25-83-37.3-2.7-1.2-4.6-.4-6.8.5-10.5,4.8-20.9,9.5-31.4,14.1Zm286.3-39H304.3l82.3,36.9c2.3,1,4,1.1,6.1-.2ZM57.5,67.9l-.2,1C77.8,80.6,98.4,92.1,118.8,104c3.5,2,6.1,2,9.7.4,24.6-11.2,49.4-22.2,74.1-33.4,1.7-.7,3.9-.8,4.9-3.1ZM171.3,300.6l73.8,126.1c1.5-24.6,1.4-48.7,1.5-72.7,0-3.1-2.1-4.2-4-5.5l-65.1-45.8C175.9,301.6,174.5,299.2,171.3,300.6Z\"/></svg>', NULL, 0, 0, 18, '2018-01-16 16:39:00', '2023-02-28 03:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `diamond_size_master`
--

CREATE TABLE `diamond_size_master` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `size1` double DEFAULT NULL,
  `size2` double DEFAULT NULL,
  `retailer_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diamond_size_master`
--

INSERT INTO `diamond_size_master` (`id`, `title`, `size1`, `size2`, `retailer_id`, `status`, `sort_order`, `date_added`, `date_updated`, `added_by`, `updated_by`) VALUES
(1, '0.23-0.29', 0.23, 0.29, 0, 1, 10, '2015-12-26 07:09:27', '2019-12-30 12:02:29', 1, 1),
(2, '0.30-0.39', 0.3, 0.39, 0, 1, 20, '2015-12-26 07:09:47', '2019-12-30 12:02:29', 1, 1),
(3, '0.40-0.45', 0.4, 0.45, 0, 1, 30, '2015-12-26 07:10:53', '2019-12-30 12:02:29', 1, 1),
(4, '0.46-0.49', 0.46, 0.49, 0, 1, 40, '2015-12-26 07:11:04', '2019-12-30 12:02:29', 1, 1),
(5, '0.50-0.59', 0.5, 0.59, 0, 1, 50, '2015-12-26 07:11:15', '2019-12-30 12:02:29', 1, 1),
(6, '0.60-0.69', 0.6, 0.69, 0, 1, 60, '2015-12-26 07:11:26', '2019-12-30 12:02:29', 1, 1),
(7, '0.70-0.79', 0.7, 0.79, 0, 1, 70, '2015-12-26 07:11:38', '2019-12-30 12:02:29', 1, 1),
(8, '-', 0, 0, 0, 0, 80, '2015-12-26 07:11:49', '2019-12-30 12:02:29', 1, 1),
(9, '0.80-0.89', 0.8, 0.89, 0, 1, 90, '2015-12-26 07:12:01', '2019-12-30 12:02:29', 1, 1),
(10, '0.90-0.99', 0.9, 0.99, 0, 1, 100, '2015-12-26 07:12:12', '2019-12-30 12:02:29', 1, 1),
(11, '0', 0, 0, 0, 0, 110, '2015-12-26 07:12:24', '2019-12-30 12:02:29', 1, 1),
(12, '1.00-1.09', 1, 1.09, 0, 1, 120, '2015-12-26 07:12:35', '2019-12-30 12:02:29', 1, 1),
(13, '1.10-1.19', 1.1, 1.19, 0, 1, 120, '2015-12-26 07:12:49', '2019-12-30 12:02:29', 1, 1),
(14, '1.20-1.29', 1.2, 1.29, 0, 1, 130, '2015-12-26 07:13:01', '2019-12-30 12:02:29', 1, 1),
(15, '1.30-1.39', 1.3, 1.39, 0, 1, 140, '2015-12-26 07:13:12', '2019-12-30 12:02:29', 1, 1),
(16, '1.40-1.49', 1.4, 1.49, 0, 1, 150, '2015-12-26 07:13:24', '2019-12-30 12:02:29', 1, 1),
(17, '1.50-1.69', 1.5, 1.69, 0, 1, 160, '2015-12-26 07:13:35', '2019-12-30 12:02:29', 1, 1),
(19, '1.70-1.99', 1.7, 1.99, 0, 1, 180, '2015-12-26 07:14:00', '2019-12-30 12:02:29', 1, 1),
(22, '2.00-2.49', 2, 2.49, 0, 1, 210, '2015-12-26 07:14:44', '2019-12-30 12:02:29', 1, 1),
(23, '2.50-2.99', 2.5, 2.99, 0, 1, 220, '2015-12-26 07:14:57', '2019-12-30 12:02:29', 1, 1),
(24, '3.00-3.49', 3, 3.49, 0, 1, 230, '2015-12-26 07:15:28', '2019-12-30 12:02:29', 1, 1),
(25, '3.50-3.99', 3.5, 3.99, 0, 1, 240, '2015-12-26 07:15:41', '2019-12-30 12:02:29', 1, 1),
(26, '4.00-4.49', 4, 4.49, 0, 1, 250, '2015-12-26 07:15:54', '2019-12-30 12:02:29', 1, 1),
(27, '4.50-4.99', 4.5, 4.99, 0, 1, 260, '2015-12-26 07:16:05', '2019-12-30 12:02:29', 1, 1),
(28, '5.00-5.49', 5, 5.49, 0, 1, 270, '2015-12-26 07:16:16', '2019-12-30 12:02:29', 1, 1),
(29, '5.50+', 5.5, 999, 0, 1, 280, '2015-12-26 07:16:27', '2019-12-30 12:02:29', 1, 1),
(34, '0.20+', 0.18, 0.22, 2, 1, 10, '2016-08-10 23:37:13', '2020-01-02 10:26:00', NULL, NULL),
(35, '10', 10, 10, 164, 1, 0, '2016-10-28 08:08:38', NULL, NULL, NULL),
(36, '0.20-0.29', 0.2, 0.29, 529, 1, 1, '2018-02-06 12:04:56', '2018-02-06 12:11:03', NULL, NULL),
(37, '0.30-0.39', 0.3, 0.39, 529, 1, 2, '2018-02-06 12:05:17', '2018-02-06 12:11:03', NULL, NULL),
(38, '0.40-0.49', 0.4, 0.49, 529, 1, 3, '2018-02-06 12:06:08', '2018-02-06 12:11:03', NULL, NULL),
(39, '0.50-0.59', 0.5, 0.59, 529, 1, 4, '2018-02-06 12:06:25', '2018-02-06 12:11:03', NULL, NULL),
(40, '0.60-0.69', 0.6, 0.69, 529, 1, 5, '2018-02-06 12:06:57', '2018-02-06 12:11:03', NULL, NULL),
(41, '0.70-0.79', 0.7, 0.79, 529, 1, 6, '2018-02-06 12:07:08', '2018-02-06 12:11:03', NULL, NULL),
(42, '0.80-0.89', 0.8, 0.89, 529, 1, 7, '2018-02-06 12:07:19', '2018-02-06 12:11:03', NULL, NULL),
(43, '0.90-0.99', 0.9, 0.99, 529, 1, 8, '2018-02-06 12:07:42', '2018-02-06 12:11:03', NULL, NULL),
(44, '1.00-1.19', 1, 1.19, 529, 1, 9, '2018-02-06 12:08:06', '2018-02-06 12:11:03', NULL, NULL),
(45, '1.20-1.49', 1.2, 1.49, 529, 1, 10, '2018-02-06 12:08:44', '2018-02-06 12:11:03', NULL, NULL),
(46, '1.50-1.69', 1.5, 1.69, 529, 1, 11, '2018-02-06 12:08:56', '2018-02-06 12:11:03', NULL, NULL),
(47, '1.70-1.99', 1.7, 1.99, 529, 1, 12, '2018-02-06 12:09:11', '2018-02-06 12:11:03', NULL, NULL),
(48, '2.00-2.49', 2, 2.49, 529, 1, 13, '2018-02-06 12:09:25', '2018-02-06 12:11:03', NULL, NULL),
(49, '2.50-2.99', 2.5, 2.99, 529, 1, 14, '2018-02-06 12:09:35', '2018-02-06 12:11:03', NULL, NULL),
(50, '3.00-3.99', 3, 3.99, 529, 1, 15, '2018-02-06 12:09:57', '2018-02-06 12:11:03', NULL, NULL),
(51, '4.00-4.99', 4, 4.99, 529, 1, 16, '2018-02-06 12:10:21', '2018-02-06 12:11:03', NULL, NULL),
(52, '5cts & up', 5, 999, 529, 1, 17, '2018-02-06 12:10:42', '2018-02-06 12:11:03', NULL, NULL),
(53, '0.23+', 0.23, 0.29, 2, 1, 20, '2020-01-02 10:26:40', NULL, NULL, NULL),
(54, '0.30+', 0.3, 0.39, 2, 1, 30, '2020-01-02 00:00:00', NULL, 2, NULL),
(55, '0.40+', 0.4, 0.45, 2, 1, 40, '2020-01-02 00:00:00', NULL, NULL, NULL),
(56, '0.46+', 0.46, 0.49, 2, 1, 50, '2020-01-02 00:00:00', NULL, 2, NULL),
(57, '0.50+', 0.5, 0.55, 2, 1, 60, '2020-01-02 00:00:00', NULL, 2, NULL),
(58, '0.56+', 0.56, 0.59, 2, 1, 70, '2020-01-02 00:00:00', NULL, 2, NULL),
(59, '0.60+', 0.6, 0.69, 2, 1, 80, '2020-01-02 00:00:00', NULL, 2, NULL),
(60, '0.70+', 0.7, 0.72, 2, 1, 90, '2020-01-02 00:00:00', NULL, NULL, NULL),
(61, '0.73+', 0.73, 0.79, 2, 1, 100, '2020-01-02 00:00:00', NULL, 2, NULL),
(62, '0.80+', 0.8, 0.89, 2, 1, 110, '2020-01-02 00:00:00', NULL, 2, NULL),
(63, '0.90+', 0.9, 0.93, 2, 1, 120, '2020-01-02 00:00:00', NULL, 1, NULL),
(64, '0.94+', 0.94, 0.99, 2, 1, 130, '2020-01-02 00:00:00', NULL, 2, NULL),
(65, '1.00+', 1, 1.09, 2, 1, 140, '2020-01-02 00:00:00', NULL, 2, NULL),
(66, '1.10+', 1.1, 1.19, 2, 1, 150, '2020-01-02 00:00:00', NULL, 2, NULL),
(67, '1.20+', 1.2, 1.29, 2, 1, 160, '2020-01-02 00:00:00', NULL, 2, NULL),
(68, '1.30+', 1.3, 1.39, 2, 1, 170, '2020-01-02 00:00:00', NULL, 2, NULL),
(69, '1.40+', 1.4, 1.49, 2, 1, 180, '2020-01-02 00:00:00', NULL, 2, NULL),
(70, '1.50+', 1.5, 1.59, 2, 1, 190, '2020-01-02 00:00:00', NULL, 2, NULL),
(71, '1.60+', 1.6, 1.69, 2, 1, 200, '2020-01-02 00:00:00', NULL, 2, NULL),
(72, '1.70+\r\n', 1.7, 1.79, 2, 1, 210, '2020-01-02 00:00:00', NULL, 2, NULL),
(73, '1.80+\r\n', 1.8, 1.89, 2, 1, 220, '2020-01-02 00:00:00', NULL, 2, NULL),
(74, '1.90+\r\n', 1.9, 1.99, 2, 1, 230, '2020-01-02 00:00:00', NULL, 2, NULL),
(75, '2.00+\r\n', 2, 2.49, 2, 1, 240, '2020-01-02 00:00:00', NULL, 2, NULL),
(76, '2.50+\r\n\r\n', 2.5, 2.99, 2, 1, 250, '2020-01-02 00:00:00', NULL, 2, NULL),
(77, '3.00+\r\n', 3, 3.49, 2, 1, 260, '2020-01-02 00:00:00', NULL, 2, NULL),
(78, '3.50+\r\n', 3.5, 3.99, 2, 1, 270, '2020-01-02 00:00:00', NULL, 2, NULL),
(79, '4.00+\r\n', 4, 4.99, 2, 1, 280, '2020-01-02 00:00:00', NULL, 2, NULL),
(80, '5.00+\r\n', 5, 5.99, 2, 1, 290, '2020-01-02 00:00:00', NULL, 2, NULL),
(81, '6.00+\r\n', 6, 6.99, 2, 1, 300, '2020-01-02 00:00:00', NULL, 2, NULL),
(82, '7.00+', 1, NULL, NULL, 1, 310, '2020-01-02 00:00:00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `diamond_symmetry_master`
--

CREATE TABLE `diamond_symmetry_master` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `short_name` varchar(150) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `sym_ststus` tinyint(4) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diamond_symmetry_master`
--

INSERT INTO `diamond_symmetry_master` (`id`, `name`, `alias`, `short_name`, `full_name`, `sym_ststus`, `sort_order`, `date_added`, `date_modify`) VALUES
(1, 'Ex', 'EX,X', 'EX', 'Excellent', 1, 1, NULL, '2016-06-08 17:33:34'),
(2, 'VG', 'VG', 'VG', 'Very Good', 1, 2, NULL, '2016-06-08 17:33:42'),
(3, 'G', 'GD,G', 'G', 'Good', 1, 3, NULL, '2016-06-08 17:33:48'),
(4, 'F', 'FR,F', 'F', 'Fair', 1, 4, NULL, '2016-06-08 17:33:53'),
(5, 'P', 'P', 'P', 'Poor', 1, 5, NULL, '2016-06-08 17:34:22'),
(6, 'I', 'I,ID', 'I', 'Ideal', 1, 0, '2015-11-20 15:43:18', '2016-06-08 17:34:29');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_04_15_000000_create_diamond_shade_master_table', 2),
(6, '2025_04_15_000000_create_diamond_shape_master_table', 3),
(7, '2025_04_15_000000_create_diamond_size_master_table', 4),
(8, '2025_04_15_000000_create_diamond_symmetry_master_table', 5),
(9, '2025_04_15_000000_create_diamond_fancycolor_overtones_master_table', 6),
(10, '2025_04_15_000000_create_diamond_flourescence_master_table', 7),
(11, '2025_04_15_000000_create_diamond_girdle_master_table', 8),
(12, '2025_04_15_000000_create_diamond_key_to_symbols_master_table', 9),
(13, '2025_04_15_000000_create_diamond_clarity_master_table', 10),
(14, '2025_04_15_000000_create_diamond_color_master_table', 10),
(15, '2025_04_15_000000_create_diamond_culet_master_table', 10),
(16, '2025_04_15_000000_create_diamond_cut_master_table', 10),
(17, '2025_04_15_000000_create_diamond_fancycolor_intensity_master_table', 10),
(18, '2025_04_15_000000_create_diamond_lab_master_table', 10),
(19, '2025_04_15_000000_create_diamond_polish_master_table', 10),
(20, '2025_04_16_000000_create_vendor_master_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `user_type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@example.com', NULL, '$2y$10$4qesCqHFQQ1rHV8A6cZEWujc0ZcXucYp02UBFLIMnY8VHH7amonvy', 'admin', NULL, '2025-04-16 01:05:36', '2025-04-16 01:05:36'),
(2, 'Admin', 'admin@gmail.com', NULL, '$2y$10$KkJ25CodiuUHDKlf8qWCXOB9ndX1md9o5GsuCNA1Kjviv5cKFiwl6', 'user', NULL, '2025-04-16 01:29:54', '2025-04-16 01:29:54');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_master`
--

CREATE TABLE `vendor_master` (
  `vendorid` bigint(20) UNSIGNED NOT NULL,
  `vendor_company_name` varchar(150) DEFAULT NULL,
  `vendor_name` varchar(255) DEFAULT NULL,
  `diamond_prefix` varchar(150) DEFAULT NULL,
  `vendor_email` varchar(100) DEFAULT NULL,
  `vendor_phone` varchar(20) DEFAULT NULL,
  `vendor_cell` varchar(25) DEFAULT NULL,
  `how_hear_about_us` varchar(150) DEFAULT NULL,
  `other_manufacturer_value` varchar(250) DEFAULT NULL,
  `vendor_status` tinyint(4) DEFAULT NULL,
  `auto_status` tinyint(4) NOT NULL DEFAULT 1,
  `price_markup_type` tinyint(4) DEFAULT NULL,
  `price_markup_value` double DEFAULT NULL,
  `fancy_price_markup_value` double DEFAULT NULL,
  `extra_markup` tinyint(4) DEFAULT NULL,
  `extra_markup_value` double DEFAULT NULL,
  `fancy_extra_markup` tinyint(4) DEFAULT NULL,
  `fancy_extra_markup_value` double DEFAULT NULL,
  `delivery_days` varchar(20) DEFAULT NULL,
  `additional_shipping_day` varchar(20) NOT NULL DEFAULT '0',
  `additional_rap_discount` varchar(50) DEFAULT NULL,
  `notification_email` varchar(255) DEFAULT NULL,
  `data_path` varchar(255) DEFAULT NULL,
  `media_path` varchar(50) DEFAULT NULL,
  `external_image` tinyint(4) DEFAULT NULL,
  `external_image_path` varchar(255) DEFAULT NULL,
  `external_image_formula` text DEFAULT NULL,
  `external_video` tinyint(4) DEFAULT NULL,
  `external_video_path` varchar(255) DEFAULT NULL,
  `external_video_formula` text DEFAULT NULL,
  `external_certificate` tinyint(4) DEFAULT NULL,
  `external_certificate_path` varchar(255) DEFAULT NULL,
  `if_display_vendor_stock_no` tinyint(4) NOT NULL DEFAULT 0,
  `vm_diamond_type` varchar(150) DEFAULT NULL,
  `show_price` tinyint(4) NOT NULL DEFAULT 1,
  `duplicate_feed` tinyint(4) NOT NULL DEFAULT 0,
  `display_invtry_before_login` tinyint(4) NOT NULL DEFAULT 1,
  `vendor_product_group` text DEFAULT NULL,
  `vendor_customer_group` text DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `rank` tinyint(4) NOT NULL DEFAULT 0,
  `buying` tinyint(4) NOT NULL DEFAULT 0,
  `buy_email` tinyint(4) NOT NULL DEFAULT 0,
  `price_grid` tinyint(4) NOT NULL DEFAULT 0,
  `display_certificate` tinyint(4) NOT NULL DEFAULT 1,
  `change_status_days` varchar(20) NOT NULL DEFAULT '0',
  `diamond_size_from` double NOT NULL DEFAULT 0,
  `diamond_size_to` double NOT NULL DEFAULT 0,
  `allow_color` varchar(255) DEFAULT NULL,
  `location` text DEFAULT NULL,
  `offer_days` varchar(20) DEFAULT NULL,
  `keep_price_same_ab` tinyint(4) NOT NULL DEFAULT 0,
  `cc_fee` tinyint(4) NOT NULL DEFAULT 0,
  `date_addded` datetime DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_master`
--

INSERT INTO `vendor_master` (`vendorid`, `vendor_company_name`, `vendor_name`, `diamond_prefix`, `vendor_email`, `vendor_phone`, `vendor_cell`, `how_hear_about_us`, `other_manufacturer_value`, `vendor_status`, `auto_status`, `price_markup_type`, `price_markup_value`, `fancy_price_markup_value`, `extra_markup`, `extra_markup_value`, `fancy_extra_markup`, `fancy_extra_markup_value`, `delivery_days`, `additional_shipping_day`, `additional_rap_discount`, `notification_email`, `data_path`, `media_path`, `external_image`, `external_image_path`, `external_image_formula`, `external_video`, `external_video_path`, `external_video_formula`, `external_certificate`, `external_certificate_path`, `if_display_vendor_stock_no`, `vm_diamond_type`, `show_price`, `duplicate_feed`, `display_invtry_before_login`, `vendor_product_group`, `vendor_customer_group`, `deleted`, `rank`, `buying`, `buy_email`, `price_grid`, `display_certificate`, `change_status_days`, `diamond_size_from`, `diamond_size_to`, `allow_color`, `location`, `offer_days`, `keep_price_same_ab`, `cc_fee`, `date_addded`, `added_by`, `date_updated`, `update_by`) VALUES
(1, 'test12', 'test12', 'vandor.index', 'est@gmail.com', '78899900', 'test', NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 1, NULL, NULL, 0, 0, 0, 0, 0, 1, '0', 0, 0, NULL, NULL, NULL, 0, 0, '2025-04-19 11:56:00', NULL, '2025-04-21 08:33:25', NULL),
(2, 'test', 'test', NULL, 'est@gmail.com', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 0, 1, NULL, NULL, 0, 0, 0, 0, 0, 1, '0', 0, 0, NULL, NULL, NULL, 0, 0, '2025-04-19 12:00:06', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diamond_clarity_master`
--
ALTER TABLE `diamond_clarity_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diamond_color_master`
--
ALTER TABLE `diamond_color_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diamond_culet_master`
--
ALTER TABLE `diamond_culet_master`
  ADD PRIMARY KEY (`dc_id`);

--
-- Indexes for table `diamond_cut_master`
--
ALTER TABLE `diamond_cut_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diamond_fancycolor_intensity_master`
--
ALTER TABLE `diamond_fancycolor_intensity_master`
  ADD PRIMARY KEY (`fci_id`);

--
-- Indexes for table `diamond_fancycolor_overtones_master`
--
ALTER TABLE `diamond_fancycolor_overtones_master`
  ADD PRIMARY KEY (`fco_id`);

--
-- Indexes for table `diamond_flourescence_master`
--
ALTER TABLE `diamond_flourescence_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diamond_girdle_master`
--
ALTER TABLE `diamond_girdle_master`
  ADD PRIMARY KEY (`dg_id`);

--
-- Indexes for table `diamond_key_to_symbols_master`
--
ALTER TABLE `diamond_key_to_symbols_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diamond_lab_master`
--
ALTER TABLE `diamond_lab_master`
  ADD PRIMARY KEY (`dl_id`);

--
-- Indexes for table `diamond_polish_master`
--
ALTER TABLE `diamond_polish_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diamond_shade_master`
--
ALTER TABLE `diamond_shade_master`
  ADD PRIMARY KEY (`ds_id`);

--
-- Indexes for table `diamond_shape_master`
--
ALTER TABLE `diamond_shape_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diamond_size_master`
--
ALTER TABLE `diamond_size_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diamond_symmetry_master`
--
ALTER TABLE `diamond_symmetry_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendor_master`
--
ALTER TABLE `vendor_master`
  ADD PRIMARY KEY (`vendorid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diamond_clarity_master`
--
ALTER TABLE `diamond_clarity_master`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `diamond_color_master`
--
ALTER TABLE `diamond_color_master`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `diamond_culet_master`
--
ALTER TABLE `diamond_culet_master`
  MODIFY `dc_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `diamond_cut_master`
--
ALTER TABLE `diamond_cut_master`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `diamond_fancycolor_intensity_master`
--
ALTER TABLE `diamond_fancycolor_intensity_master`
  MODIFY `fci_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `diamond_fancycolor_overtones_master`
--
ALTER TABLE `diamond_fancycolor_overtones_master`
  MODIFY `fco_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `diamond_flourescence_master`
--
ALTER TABLE `diamond_flourescence_master`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `diamond_girdle_master`
--
ALTER TABLE `diamond_girdle_master`
  MODIFY `dg_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `diamond_key_to_symbols_master`
--
ALTER TABLE `diamond_key_to_symbols_master`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `diamond_lab_master`
--
ALTER TABLE `diamond_lab_master`
  MODIFY `dl_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `diamond_polish_master`
--
ALTER TABLE `diamond_polish_master`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `diamond_shade_master`
--
ALTER TABLE `diamond_shade_master`
  MODIFY `ds_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `diamond_shape_master`
--
ALTER TABLE `diamond_shape_master`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `diamond_size_master`
--
ALTER TABLE `diamond_size_master`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `diamond_symmetry_master`
--
ALTER TABLE `diamond_symmetry_master`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendor_master`
--
ALTER TABLE `vendor_master`
  MODIFY `vendorid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
