-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 09, 2019 at 05:46 PM
-- Server version: 5.7.22-0ubuntu0.17.10.1
-- PHP Version: 7.1.17-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reports`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Super Admin', 'sadmin', '$2y$10$wo57hisK3ci.MbWOdvVTieibrAfFx9Xs9HFHQp1/YPKPjsxWfh29e', 'uDeUtMZBR5dqZMjTgctkvqkS6tKqVFwSXBUDdSZ2RiadoNubzFi0CtVBtf5K', '2019-03-31 10:46:55', '2019-03-31 10:46:55'),
(4, 'Admin', 'admin', '$2y$10$zEcXVG.qSEz2Gh1I6lHyMuRjahzRMc6raoD0Z0CjuQehYdrWcbx.S', 'OcUYCGk2ceOThfigv6PN0IFIvIRhC1h7rI59XYZqa76kynfdRGGkKtmiprO2', '2019-03-31 10:46:55', '2019-03-31 10:46:55'),
(5, NULL, 'admin_test', '$2y$10$.1Yxkp1M0sh7InYQ63nLb.bo4fSF/kjc/mvWELqSVaRoJ5cVgccg6', NULL, '2019-03-31 20:38:34', '2019-03-31 20:39:13'),
(6, NULL, 'sadmin_test', '$2y$10$Noy4uEfU1lAZ0cOkIbiWNOG/D9MDRN9JUDXfH4xvrUAPrS854ZB3i', NULL, '2019-03-31 20:38:50', '2019-03-31 20:38:50');

-- --------------------------------------------------------

--
-- Table structure for table `admin_role`
--

CREATE TABLE `admin_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_role`
--

INSERT INTO `admin_role` (`id`, `admin_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 3, 3, NULL, NULL),
(2, 4, 4, NULL, NULL),
(3, 5, 4, NULL, NULL),
(4, 6, 3, NULL, NULL),
(5, 7, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `parent`, `created_at`, `updated_at`) VALUES
(1, 'Quỹ đầu tư phát triển và bảo lãnh tín dụng cho DNNVV', 0, '2019-03-29 10:27:48', '2019-03-29 10:27:48'),
(2, 'Quỹ đầu tư phát triển', 1, '2019-03-29 10:27:51', '2019-03-29 10:28:26'),
(3, 'Quỹ BLTD cho DNNVV', 1, '2019-03-29 10:27:56', '2019-03-29 10:27:56'),
(4, 'Quỹ bảo vệ và phát triển rừng', 0, '2019-03-29 10:28:14', '2019-04-01 02:20:03'),
(8, 'Quỹ phát triển đất', 0, '2019-03-29 10:57:51', '2019-03-31 09:05:11');

-- --------------------------------------------------------

--
-- Table structure for table `department_report`
--

CREATE TABLE `department_report` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `value_data` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department_report`
--

INSERT INTO `department_report` (`id`, `department_id`, `report_id`, `value`, `created_at`, `updated_at`, `value_data`) VALUES
(1, 1, 1, '[\"Cho vay\",\"Doanh thu\",\"Ch\\u00eanh l\\u1ec7ch thu chi tr\\u01b0\\u1edbc thu\\u1ebf\"]', NULL, NULL, '{\"1\":{\"detail\":[null,null,null],\"year_2011\":{\"kh\":[null,null,null],\"th\":[null,null,null]},\"year_2012\":{\"kh\":[null,null,null],\"th\":[null,null,null]},\"year_2013\":{\"kh\":[null,null,null],\"th\":[null,null,null]},\"year_2014\":{\"kh\":[null,null,null],\"th\":[null,null,null]},\"year_2015\":{\"kh\":[null,null,null],\"th\":[null,\"5.284\",\"4.275\"]},\"year_2016\":{\"kh\":[null,\"9.915\",\"6.845\"],\"th\":[\"8.800\",\"10.687\",\"8.201\"]},\"year_2017\":{\"kh\":[null,\"10.726\",\"7.529\"],\"th\":[\"3.577\",\"12.948\",\"10.030\"]},\"year_2018\":{\"kh\":[null,\"14.375\",\"10.696\"],\"th\":[\"12.747\",\"6.623\",\"13.024\"]},\"year_2019\":{\"kh\":[null,null,null]},\"year_2020\":{\"kh\":[null,null,null]}},\"2\":{\"detail\":[null,null,null],\"year_2011\":{\"kh\":[null,null,null],\"th\":[null,null,null]},\"year_2012\":{\"kh\":[null,null,null],\"th\":[null,null,null]},\"year_2013\":{\"kh\":[null,null,null],\"th\":[null,null,null]},\"year_2014\":{\"kh\":[null,null,null],\"th\":[null,null,null]},\"year_2015\":{\"kh\":[null,null,null],\"th\":[null,null,null]},\"year_2016\":{\"kh\":[null,null,null],\"th\":[null,null,null]},\"year_2017\":{\"kh\":[null,null,null],\"th\":[null,null,null]},\"year_2018\":{\"kh\":[null,null,null],\"th\":[null,null,null]},\"year_2019\":{\"kh\":[\"30.000\",\"12.834\",\"8.670\"]},\"year_2020\":{\"kh\":[\"40.000\",\"14.000\",\"9.500\"]}},\"3\":{\"detail\":[null,null,null],\"year_2011\":{\"kh\":[null,null,null],\"th\":[null,null,null]},\"year_2012\":{\"kh\":[null,null,null],\"th\":[null,null,null]},\"year_2013\":{\"kh\":[null,null,null],\"th\":[null,null,null]},\"year_2014\":{\"kh\":[null,null,null],\"th\":[null,null,null]},\"year_2015\":{\"kh\":[null,null,null],\"th\":[null,null,null]},\"year_2016\":{\"kh\":[null,null,null],\"th\":[null,null,null]},\"year_2017\":{\"kh\":[null,null,null],\"th\":[null,null,null]},\"year_2018\":{\"kh\":[null,null,null],\"th\":[null,null,null]},\"year_2019\":{\"kh\":[\"1.000\",\"5.141\",\"4.991\"]},\"year_2020\":{\"kh\":[\"1.500\",\"5.500\",\"5.100\"]}}}'),
(2, 4, 1, '[\"Thu t\\u1eeb th\\u1ee7y \\u0111i\\u1ec7n\",\"Thu t\\u1eeb Cty CP c\\u1ea5p n\\u01b0\\u1edbc\",\"L\\u00e3i ti\\u1ec1n g\\u1eedi ng\\u00e2n h\\u00e0ng\"]', NULL, NULL, '{\"4\":{\"detail\":[null,null,null],\"year_2011\":{\"kh\":[null,null,null],\"th\":[null,null,null]},\"year_2012\":{\"kh\":[null,null,null],\"th\":[null,null,null]},\"year_2013\":{\"kh\":[\"39.630\",\"3.869\",null],\"th\":[\"7.096\",\"3.511\",\"93\"]},\"year_2014\":{\"kh\":[\"16.197\",\"1.683\",null],\"th\":[\"22.932\",\"1.620\",\"124\"]},\"year_2015\":{\"kh\":[\"22.223\",\"1.751\",null],\"th\":[\"34.054\",\"1.727\",\"374\"]},\"year_2016\":{\"kh\":[\"21.381\",\"1.830\",null],\"th\":[\"17.891\",\"1.821\",\"397\"]},\"year_2017\":{\"kh\":[\"36.612\",\"2.419\",null],\"th\":[\"36.156\",\"2.276\",\"183\"]},\"year_2018\":{\"kh\":[\"18.814\",\"1.896\",null],\"th\":[\"28.763\",\"2.494\",\"101\"]},\"year_2019\":{\"kh\":[\"47.392\",\"2.548\",\"120\"]},\"year_2020\":{\"kh\":[\"49.270\",\"2.600\",\"130\"]}}}'),
(3, 8, 1, '[\"H\\u1ed7 tr\\u1ee3 t\\u1eeb NS t\\u1ec9nh\",\"Thu s\\u1ef1 nghi\\u1ec7p Qu\\u1ef9\",\"Thu h\\u1ed3i t\\u1ea1m \\u1ee9ng v\\u1ed1n\"]', NULL, NULL, '{\"8\":{\"detail\":[null,null,null],\"year_2011\":{\"kh\":[\"90.000\",\"277\",null],\"th\":[\"90.000\",\"277\",null]},\"year_2012\":{\"kh\":[\"70.000\",\"694\",null],\"th\":[\"70.000\",\"694\",null]},\"year_2013\":{\"kh\":[\"10.000\",\"888\",\"34.000\"],\"th\":[\"10.000\",\"888\",\"2.000\"]},\"year_2014\":{\"kh\":[\"14.375\",\"659\",\"18.140\"],\"th\":[\"14.375\",\"659\",\"50.140\"]},\"year_2015\":{\"kh\":[null,\"577\",\"23.046\"],\"th\":[null,\"577\",\"22.988\"]},\"year_2016\":{\"kh\":[null,\"353\",\"61.617\"],\"th\":[\"10.600\",\"353\",\"33.292\"]},\"year_2017\":{\"kh\":[null,\"305\",\"18.744\"],\"th\":[\"10.125\",\"305\",\"6.500\"]},\"year_2018\":{\"kh\":[null,\"250\",\"37.198\"],\"th\":[null,\"250\",\"29.586\"]},\"year_2019\":{\"kh\":[\"102.715\",\"300\",\"48.125\"]},\"year_2020\":{\"kh\":[\"30.000\",\"300\",\"20.000\"]}}}');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2019_03_29_084954_create_departments_table', 2),
(6, '2014_10_12_000000_create_users_table', 3),
(11, '2019_03_29_054306_create_admins_table', 4),
(12, '2019_03_31_170636_create_roles_table', 4),
(13, '2019_03_31_174341_create_admin_role_table', 4),
(15, '2019_04_01_043106_create_reports_table', 5),
(16, '2019_04_01_042929_create_report_types_table', 6),
(17, '2019_04_02_044127_add_department_id_to_users', 7),
(18, '2019_04_05_031657_create_report_metas_table', 8),
(19, '2019_04_06_171528_create_department_report_table', 9),
(20, '2019_04_08_101125_add_value_data_to_department_report', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `type_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `name`, `status`, `type_id`, `created_at`, `updated_at`) VALUES
(1, 'Tổng hợp các khoản thu các quỹ tài chính ngoài ngân sách do địa phương quản lý', 1, 1, '2019-04-01 03:26:13', '2019-04-04 21:43:17'),
(2, 'Report 01', 0, 4, '2019-04-01 03:52:18', '2019-04-01 03:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `report_metas`
--

CREATE TABLE `report_metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `report_id` int(11) NOT NULL,
  `meta_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `report_metas`
--

INSERT INTO `report_metas` (`id`, `report_id`, `meta_name`, `meta_value`, `created_at`, `updated_at`) VALUES
(1, 1, 'period', '{\"period_from\":\"2011\",\"period_to\":\"2020\"}', '2019-04-04 20:55:05', '2019-04-04 21:29:22'),
(2, 1, 'last_year', '2018', '2019-04-04 21:29:22', '2019-04-04 21:29:22'),
(3, 1, 'dispatch_date', '03/2019', '2019-04-04 21:29:22', '2019-04-04 21:29:22'),
(4, 1, 'departments', '{\"1\":[\"Cho vay\",\"Doanh thu\",\"Ch\\u00eanh l\\u1ec7ch thu chi tr\\u01b0\\u1edbc thu\\u1ebf\"],\"4\":[\"Thu t\\u1eeb th\\u1ee7y \\u0111i\\u1ec7n\",\"Thu t\\u1eeb Cty CP c\\u1ea5p n\\u01b0\\u1edbc\",\"L\\u00e3i ti\\u1ec1n g\\u1eedi ng\\u00e2n h\\u00e0ng\"],\"8\":[\"H\\u1ed7 tr\\u1ee3 t\\u1eeb NS t\\u1ec9nh\",\"Thu s\\u1ef1 nghi\\u1ec7p Qu\\u1ef9\",\"Thu h\\u1ed3i t\\u1ea1m \\u1ee9ng v\\u1ed1n\"]}', '2019-04-05 00:19:21', '2019-04-05 01:36:16');

-- --------------------------------------------------------

--
-- Table structure for table `report_types`
--

CREATE TABLE `report_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `report_types`
--

INSERT INTO `report_types` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Biểu số 03', 'Tổng hợp các khoản thu các quỹ tài chính ngoài ngân sách do địa phương quản lý', '2019-04-01 01:51:09', '2019-04-01 01:51:09'),
(4, 'Biểu số 01', 'Biểu số 01', '2019-04-01 02:20:43', '2019-04-01 02:20:43'),
(5, 'Biểu số 02', 'Biểu số 02', '2019-04-01 02:20:49', '2019-04-01 02:20:49');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(3, 'sadmin', 'Super Admin', '2019-03-31 10:46:55', '2019-03-31 10:46:55'),
(4, 'admin', 'Admin', '2019-03-31 10:46:55', '2019-03-31 10:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `department_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `remember_token`, `created_at`, `updated_at`, `department_id`) VALUES
(2, NULL, 'user1', '$2y$10$7sICmQGsdv2qqzMQN1Yfxu0bHm/uuyRENgyXrY3Tf34wvuZu6bizi', 'rviVTk0XiMOWfssB0b4bdMV4MG9FEs8xNHGDKSs1oYeWdFOtz2g34XyXeNob', '2019-03-31 08:32:23', '2019-04-05 11:17:49', 1),
(5, NULL, 'user2', '$2y$10$2RJzb7V3sKnBIeSefI0bOe269zCvfbl4xHZulmWfeu1y5/88h5kMy', NULL, '2019-04-01 21:51:44', '2019-04-08 20:36:56', 4),
(6, NULL, 'user3', '$2y$10$0oOh4wZ9d8.eG6T1nlKZB.VTiaxCVosj15PSEjSaONTDvbXla0bHy', NULL, '2019-04-01 21:58:05', '2019-04-08 20:37:02', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `admin_role`
--
ALTER TABLE `admin_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_name_unique` (`name`);

--
-- Indexes for table `department_report`
--
ALTER TABLE `department_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_username_index` (`username`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_metas`
--
ALTER TABLE `report_metas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_types`
--
ALTER TABLE `report_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `admin_role`
--
ALTER TABLE `admin_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `department_report`
--
ALTER TABLE `department_report`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `report_metas`
--
ALTER TABLE `report_metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `report_types`
--
ALTER TABLE `report_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
