-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 19, 2024 at 12:30 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pastebin`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

DROP TABLE IF EXISTS `ads`;
CREATE TABLE IF NOT EXISTS `ads` (
  `id` int NOT NULL AUTO_INCREMENT,
  `img` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `url` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `expiry_at` timestamp NOT NULL,
  `owner` varchar(2000) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `img`, `url`, `expiry_at`, `owner`, `created_at`) VALUES
(6, 'https://i.imgur.com/cTIjzBK.gif', 'https://i.imgur.com/cTIjzBK.gif', '2025-03-11 20:32:00', 'https://i.imgur.com/cTIjzBK.gif', '2024-03-18 23:33:32'),
(5, 'https://i.imgur.com/cTIjzBK.gif', 'https://i.imgur.com/cTIjzBK.gif', '0000-00-00 00:00:00', 'https://i.imgur.com/cTIjzBK.gif', '2024-03-18 23:33:05'),
(7, 'https://i.imgur.com/cTIjzBK.gif', 'https://i.imgur.com/cTIjzBK.gif', '2025-03-11 20:32:00', 'https://i.imgur.com/cTIjzBK.gif', '2024-03-18 23:37:34');

-- --------------------------------------------------------

--
-- Table structure for table `paste`
--

DROP TABLE IF EXISTS `paste`;
CREATE TABLE IF NOT EXISTS `paste` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `unique_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `paste_by` int NOT NULL DEFAULT '0',
  `paste_user_id` varchar(10000) NOT NULL,
  `paste_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `paste_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT '1',
  `paste_expiry` datetime DEFAULT NULL,
  `likes` int NOT NULL DEFAULT '0',
  `dislikes` int NOT NULL DEFAULT '0',
  `views` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `paste`
--

INSERT INTO `paste` (`id`, `unique_id`, `paste_by`, `paste_user_id`, `paste_title`, `message`, `paste_password`, `visibility`, `paste_expiry`, `likes`, `dislikes`, `views`, `created_at`) VALUES
(8, 'QZ4Qo', 0, '', 'testing', 'Nkp0RkFPb0NsbDFkV21VajgwZk1QUT09', '$2y$10$n3EbvBKRqE517Rsty9ofE.DqOrg6o6EItx77KWkWoUGwOE3eExw8S', 1, NULL, 0, 0, 1, '2024-02-22 21:27:35'),
(9, 'sseN2', 0, '', 'test', 'UTQyb2dSUFYxa2VYeTlFd0c5M09SRXIwZ0dlQy9zcVI5Z1MyaVE3RVJ0dz0=', '$2y$10$HEK4edbqOz6i2IlA4.nmuuKV0M5rLauAUlwGzrOOR0DkAZ5IVjS9y', 1, NULL, 0, 0, 0, '2024-02-23 22:09:33'),
(10, 'ZSpaI', 0, '', 'test', 'ZnAyTUFHT1JxRFcweFlKVXAvUENldz09', NULL, 1, NULL, 0, 0, 0, '2024-02-23 23:17:18'),
(11, '17HZO', 0, '', 'sad', 'VUJFUGVkMFE2VEc0VFVhNHpNNEYzQT09', NULL, 1, NULL, 0, 0, 0, '2024-02-23 23:18:16'),
(12, 'Tt7pL', 0, '', 'sad', 'VUJFUGVkMFE2VEc0VFVhNHpNNEYzQT09', NULL, 1, NULL, 0, 0, 0, '2024-02-23 23:18:21'),
(13, 'Sla38', 0, '', 'sad', 'VUJFUGVkMFE2VEc0VFVhNHpNNEYzQT09', NULL, 1, NULL, 0, 0, 0, '2024-02-23 23:18:24'),
(14, 'ObJ3F', 0, '', 'sadadasd', 'dlhXQTFRMW9wWVM3YVpHOTFxUGdMQT09', NULL, 1, NULL, 0, 0, 0, '2024-02-23 23:18:27'),
(15, 'bw6Un', 0, '', 'd', 'NzBkL2dHZk5OSGt6WkpjdzVjYS9FQT09', NULL, 1, NULL, 0, 0, 0, '2024-02-24 19:26:42'),
(16, 'IWD2x', 0, '', 'd', 'OE9wYzg3YUdoL0R1RERIbDg0amt3Zz09', NULL, 1, NULL, 0, 0, 0, '2024-02-24 19:33:54'),
(17, 'aiM37', 0, '', 'testing', 'Z3RyM3F6VHExQ0k5YnVIU3dITU1hU29pWkJ6QzkydXIySXVET055ZmUyMENIU01IdHQxazVJaklwMTRiRVFkQQ==', NULL, 1, NULL, 0, 0, 0, '2024-02-24 20:00:02'),
(18, 'AsUjU', 0, '', '123', 'Smg2SkVjNU5WMDQvWmczQW5KQy80QT09', '$2y$10$SBQcdqi8IzUZkDob7jCytOr2RXFMGDWkykSkB8GarDq0ALMyhZ9C2', 1, NULL, 2, 0, 51, '2024-02-27 16:21:45'),
(19, '3yFUB', 0, '', 'hey!', 'eXdMRFZUWVp0Z2NOL2YwNjcvQkVkZz09', NULL, 1, NULL, 0, 0, 8, '2024-02-27 19:23:43'),
(20, 'n6FGf', 0, '', '123', 'Smg2SkVjNU5WMDQvWmczQW5KQy80QT09', NULL, 1, NULL, 0, 0, 1, '2024-03-06 01:13:10');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `paste_id` text COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` text COLLATE utf8mb4_general_ci NOT NULL,
  `report_reason` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `reported_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `paste_id`, `user_id`, `report_reason`, `status`, `reported_at`) VALUES
(1, 'dg8qQ', '5', 'spam', 0, '2024-03-18 23:15:09'),
(4, 'dg8qQ', '5', 'Contains my info', 1, '2024-03-18 23:30:10');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `site_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `site_logo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `site_banner` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `hcaptcha_secret_key` varchar(5000) COLLATE utf8mb4_general_ci NOT NULL,
  `hcaptcha_site_key` varchar(5000) COLLATE utf8mb4_general_ci NOT NULL,
  `theme` int NOT NULL DEFAULT '0',
  `background_url` varchar(5000) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_name`, `site_logo`, `site_banner`, `hcaptcha_secret_key`, `hcaptcha_site_key`, `theme`, `background_url`) VALUES
(1, 'Pastyy', '', '', '0x582b22252F6fF3592AED3f1215f9a72ebF49B895', '467e3b94-988f-4946-8af1-bd4b4e164ef3', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usergroup` int NOT NULL DEFAULT '0',
  `cracked` varchar(2000) NOT NULL,
  `patched` varchar(2000) NOT NULL,
  `nulled` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `telegram` varchar(1000) NOT NULL,
  `discord` varchar(1000) NOT NULL,
  `website` varchar(1000) NOT NULL,
  `total_views` int NOT NULL,
  `is_banned` int NOT NULL DEFAULT '0',
  `is_admin` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `usergroup`, `cracked`, `patched`, `nulled`, `telegram`, `discord`, `website`, `total_views`, `is_banned`, `is_admin`, `created_at`, `updated_at`) VALUES
(5, 'admin', '$2y$10$Ef11nJewOkK7JHAPIo.xl.mzEOyk1WAriPksye/4YtgsvMtiGCF/y', 0, 'fddd', 'j', 'd', 'dddd', 'dlss', '', 0, 0, 1, '2024-02-27 17:50:55', '2024-02-27 17:50:55');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
