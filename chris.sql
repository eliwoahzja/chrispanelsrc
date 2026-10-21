-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 15, 2024 at 05:02 AM
-- Server version: 10.3.38-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kubbshve_christdmm`
--

-- --------------------------------------------------------

--
-- Table structure for table `Feature`
--

CREATE TABLE `Feature` (
  `id` int(11) NOT NULL,
  `ESP` varchar(10) NOT NULL,
  `Item` varchar(10) NOT NULL,
  `SilentAim` varchar(10) NOT NULL,
  `AIM` varchar(10) NOT NULL,
  `BulletTrack` varchar(10) NOT NULL,
  `Memory` varchar(10) NOT NULL,
  `Floating` varchar(10) NOT NULL,
  `Setting` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Feature`
--

INSERT INTO `Feature` (`id`, `ESP`, `Item`, `SilentAim`, `AIM`, `BulletTrack`, `Memory`, `Floating`, `Setting`) VALUES
(1, 'true', 'false', 'false', 'false', 'false', 'false', 'false', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id_history` int(11) NOT NULL,
  `keys_id` varchar(33) DEFAULT NULL,
  `user_do` varchar(33) DEFAULT NULL,
  `info` mediumtext NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id_history`, `keys_id`, `user_do`, `info`, `created_at`, `updated_at`) VALUES
(1, '270', 'UnoShibai', 'MLBB|mlbb|1|1', '2023-12-24 00:33:47', '2023-12-24 00:33:47'),
(2, '271', 'UnoShibai', 'MLBB|test|30|2', '2023-12-24 11:26:18', '2023-12-24 11:26:18'),
(3, '272', 'UnoShibai', '8BP|justi|1|1', '2023-12-28 21:27:41', '2023-12-28 21:27:41'),
(4, '273', 'UnoShibai', '8BP|8BP-f|1|1', '2023-12-28 21:28:14', '2023-12-28 21:28:14'),
(5, '274', 'UnoShibai', 'FARLIGHT|FL|1|1', '2023-12-29 00:50:38', '2023-12-29 00:50:38'),
(6, '275', 'BisayaKaUno', 'FARLIGHT|UnoPr|120|1', '2023-12-29 21:21:56', '2023-12-29 21:21:56'),
(7, '276', 'BisayaKaUno', 'FARLIGHT|UnoPr|1|1', '2023-12-29 21:33:16', '2023-12-29 21:33:16'),
(8, '277', 'BisayaKaUno', 'FARLIGHT|FARLI|120|8', '2023-12-29 21:57:18', '2023-12-29 21:57:18');

-- --------------------------------------------------------

--
-- Table structure for table `keys_code`
--

CREATE TABLE `keys_code` (
  `id_keys` int(11) NOT NULL,
  `game` varchar(32) NOT NULL,
  `user_key` varchar(32) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `expired_date` datetime DEFAULT NULL,
  `max_devices` int(11) DEFAULT NULL,
  `devices` mediumtext DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `registrator` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `keys_code`
--

INSERT INTO `keys_code` (`id_keys`, `game`, `user_key`, `duration`, `expired_date`, `max_devices`, `devices`, `status`, `registrator`, `created_at`, `updated_at`) VALUES
(273, '8BP', '8BP-fnrWOko2JD', 10, NULL, 1, NULL, 1, 'UnoShibai', '2023-12-28 21:28:14', '2023-12-28 21:28:14'),
(274, 'FARLIGHT', 'FL', 50, '1970-02-09 08:00:00', 1, 'f63a4170-2620-382c-9459-e54a408ca197', 1, 'UnoShibai', '2023-12-29 00:50:38', '2023-12-29 00:51:14'),
(275, 'FARLIGHT', 'UnoProjectBTrial', 120, '2024-04-27 21:30:35', 1, 'acd9fb4d-09d8-38e0-88db-9cc9591f6d3a', 1, 'BisayaKaUno', '2023-12-29 21:21:56', '2023-12-29 21:30:35'),
(276, 'FARLIGHT', 'UnoProjectBFixed', 1, NULL, 1, NULL, 1, 'BisayaKaUno', '2023-12-29 21:33:16', '2023-12-29 21:33:16'),
(277, 'FARLIGHT', 'FARLIGHT-wMK0DEtR9o', 120, '2024-04-27 22:33:16', 8, 'f2e6b257-acb9-37ba-b79c-f6768c79c893', 1, 'BisayaKaUno', '2023-12-29 21:57:18', '2023-12-29 22:33:16');

-- --------------------------------------------------------

--
-- Table structure for table `lib`
--

CREATE TABLE `lib` (
  `id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `file_size` varchar(32) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modname`
--

CREATE TABLE `modname` (
  `id` int(11) NOT NULL,
  `modname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `modname`
--

INSERT INTO `modname` (`id`, `modname`) VALUES
(1, 'UnoShibai Hacks');

-- --------------------------------------------------------

--
-- Table structure for table `onoff`
--

CREATE TABLE `onoff` (
  `id` int(11) NOT NULL,
  `status` varchar(5) NOT NULL,
  `myinput` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `onoff`
--

INSERT INTO `onoff` (`id`, `status`, `myinput`) VALUES
(1, 'off', '');

-- --------------------------------------------------------

--
-- Table structure for table `referral_code`
--

CREATE TABLE `referral_code` (
  `id_reff` int(11) NOT NULL,
  `code` varchar(128) NOT NULL,
  `Referral` varchar(25) NOT NULL,
  `level` int(11) NOT NULL,
  `set_saldo` int(11) NOT NULL DEFAULT 0,
  `used_by` varchar(66) NOT NULL,
  `created_by` varchar(66) NOT NULL DEFAULT 'Owner',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `acc_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `referral_code`
--

INSERT INTO `referral_code` (`id_reff`, `code`, `Referral`, `level`, `set_saldo`, `used_by`, `created_by`, `created_at`, `updated_at`, `acc_expiration`) VALUES
(11, 'bc4c60c0945831f68c31b423c64ff7f1', 'd6gRye', 1, 10000000, '1', 'Destroyer', '2023-12-17 10:41:01', '2023-12-17 10:49:00', '2024-01-16 10:41:01'),
(12, 'ce64f2352aa36fd12f3411adeb906775', 'Zh6Cf5', 1, 2147483647, '', 'Blatz', '2023-12-18 13:47:32', '2024-07-15 16:59:07', '2028-12-16 13:47:32'),
(13, '3da1f26051a3e4016c596ef30270d1a2', '15y7jr', 1, 5, '1', 'UnoShibai', '2023-12-29 01:24:52', '2023-12-29 01:26:26', '2024-01-05 01:24:52'),
(14, 'cc4d0c802eb90b7e0f41f776630f611f', 'K3kGTL', 3, 2147483647, '1', 'Blatz', '2023-12-29 14:29:30', '2023-12-29 16:40:04', '2024-01-05 14:29:30'),
(15, '7fda0fbbd29bcc9a39529216d427ff16', 'wDY5Ou', 3, 2147483647, '1', 'Blatz', '2023-12-29 21:05:36', '2023-12-29 21:07:12', '2024-01-28 21:05:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `fullname` varchar(155) DEFAULT NULL,
  `username` varchar(66) NOT NULL,
  `email` varchar(40) NOT NULL,
  `reset_link_token` varchar(255) NOT NULL,
  `exp_date` varchar(250) NOT NULL,
  `level` int(11) NOT NULL,
  `saldo` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `uplink` varchar(66) DEFAULT NULL,
  `password` varchar(155) NOT NULL,
  `user_ip` varchar(155) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `expiration_date` datetime DEFAULT NULL,
  `logged_in` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `fullname`, `username`, `email`, `reset_link_token`, `exp_date`, `level`, `saldo`, `status`, `uplink`, `password`, `user_ip`, `created_at`, `updated_at`, `expiration_date`, `logged_in`) VALUES
(8, 'UnoShibai', 'admin', '', 'd41d8cd98f00b204e9800998ecf8427e9779', '2023-11-22 08:16:46', 1, 9999772, 1, 'admin', '$2y$08$RM54Cv11ltGv9niTn7NS0.149d8rgeFFF5UvNo0Fh7aoNek9/RSoi', '175.176.35.**', '2023-11-22 20:05:28', '2023-12-29 00:50:38', '2028-11-20 20:03:42', 0),
(10, 'BlatzVIP', 'Blatz', '', '', '', 1, 9999995, 1, 'Blatz', '$2y$08$SM.8tQlRwtmvzu7uWvZ.sukAlrwFQiXfF.b52wbj3OgfNX0oFLkiS', '210.1.107.18', '2023-12-17 10:49:00', '2023-12-20 22:38:06', '2030-01-16 10:41:01', 0),
(12, 'UnoProject', 'ProjectedUno', '', '', '', 3, 2147483647, 1, 'Blatz', '$2y$08$mJ/8TVPayZrpqoGytQo8u.VJNB59AI4k09GlNc3VD7bmI/VWoCIzy', '136.158.103.150', '2023-12-29 16:40:04', '2023-12-29 16:43:20', '0000-00-00 00:00:00', 0),
(13, 'BisayaSiUno', 'BisayaKaUno', '', '', '', 3, 2147483406, 1, 'Blatz', '$2y$08$Of0mqN1ZbGLtxUW55Zhu6e7VsS1uj9VkWWAVxzsY/WA0jrwYjroYW', '136.158.103.150', '2023-12-29 21:07:12', '2023-12-29 21:57:18', '2024-01-28 21:05:36', 0),
(14, 'Icycubes', 'Icycubes', '', '', '', 1, 2147483647, 1, 'Blatz', '$2y$08$ufRDLwbx.px/YyIqoQvjrO9ldp610//YT9LZML.v8Liw4.oLeYyD6', '223.25.27.233', '2024-07-15 16:59:07', '2024-07-15 16:59:07', '2028-12-16 13:47:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `visitor_logs`
--

CREATE TABLE `visitor_logs` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `ip_location` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL,
  `visited_page` varchar(255) NOT NULL,
  `access_status` enum('Success','Failed','Unknown') DEFAULT NULL,
  `vpn_used` varchar(15) NOT NULL,
  `duration` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `_ftext`
--

CREATE TABLE `_ftext` (
  `id` int(11) NOT NULL,
  `_status` varchar(100) NOT NULL,
  `_ftext` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `_ftext`
--

INSERT INTO `_ftext` (`id`, `_status`, `_ftext`) VALUES
(1, 'Safe', 'Give Feedback else Keys off');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Feature`
--
ALTER TABLE `Feature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id_history`);

--
-- Indexes for table `keys_code`
--
ALTER TABLE `keys_code`
  ADD PRIMARY KEY (`id_keys`),
  ADD UNIQUE KEY `user_key` (`user_key`);

--
-- Indexes for table `lib`
--
ALTER TABLE `lib`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modname`
--
ALTER TABLE `modname`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onoff`
--
ALTER TABLE `onoff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral_code`
--
ALTER TABLE `referral_code`
  ADD PRIMARY KEY (`id_reff`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indexes for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_ftext`
--
ALTER TABLE `_ftext`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Feature`
--
ALTER TABLE `Feature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `keys_code`
--
ALTER TABLE `keys_code`
  MODIFY `id_keys` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=278;

--
-- AUTO_INCREMENT for table `lib`
--
ALTER TABLE `lib`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `modname`
--
ALTER TABLE `modname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `onoff`
--
ALTER TABLE `onoff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `referral_code`
--
ALTER TABLE `referral_code`
  MODIFY `id_reff` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `_ftext`
--
ALTER TABLE `_ftext`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
