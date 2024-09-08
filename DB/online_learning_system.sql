-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Sep 08, 2024 at 03:30 PM
-- Server version: 10.10.2-MariaDB
-- PHP Version: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_learning_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

DROP TABLE IF EXISTS `enrollments`;
CREATE TABLE IF NOT EXISTS `enrollments` (
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `enrollment_date` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`,`course_id`),
  KEY `course_id` (`course_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `remember` tinyint(1) DEFAULT 0,
  `remember_token` varchar(255) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `status` enum('active','deactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `profile_picture`, `remember`, `remember_token`, `expires`, `status`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', '$2y$10$5LDZRSj9SX/3foL7.PLQqOxBuvwvdQ3x8vmznP.8ViyyC.Lt93mcW', 'superadmin@yopmail.com', 'admin', NULL, 1, 'cb668b477f71793c034198afddbeb41c', '2024-10-08 14:41:52', 'active', '2024-09-07 13:17:08', '2024-09-08 14:41:52'),
(2, 'yovanpatel', '$2y$10$5LDZRSj9SX/3foL7.PLQqOxBuvwvdQ3x8vmznP.8ViyyC.Lt93mcW', 'yovan@yopmail.com', 'user', NULL, NULL, NULL, NULL, 'active', '2024-09-07 13:17:08', '2024-09-08 15:20:46'),
(3, 'hirenpatel', '$2y$10$5LDZRSj9SX/3foL7.PLQqOxBuvwvdQ3x8vmznP.8ViyyC.Lt93mcW', 'hiren@yopmail.com', 'user', NULL, NULL, NULL, NULL, 'deactive', '2024-09-07 13:17:08', '2024-09-08 15:20:54'),
(4, 'zannyshah', '$2y$10$5LDZRSj9SX/3foL7.PLQqOxBuvwvdQ3x8vmznP.8ViyyC.Lt93mcW', 'zanny@yopmail.com', 'user', NULL, NULL, NULL, NULL, 'active', '2024-09-07 13:17:08', '2024-09-08 15:20:54'),
(5, 'ketanpatel', '$2y$10$5LDZRSj9SX/3foL7.PLQqOxBuvwvdQ3x8vmznP.8ViyyC.Lt93mcW', 'ketan@yopmail.com', 'user', NULL, NULL, NULL, NULL, 'active', '2024-09-07 13:17:08', '2024-09-08 15:20:54'),
(6, 'bharatbalar', '$2y$10$5LDZRSj9SX/3foL7.PLQqOxBuvwvdQ3x8vmznP.8ViyyC.Lt93mcW', 'bharat@yopmail.com', 'user', NULL, NULL, NULL, NULL, 'deactive', '2024-09-07 13:17:08', '2024-09-08 15:23:54'),
(7, 'navinjain', '$2y$10$5LDZRSj9SX/3foL7.PLQqOxBuvwvdQ3x8vmznP.8ViyyC.Lt93mcW', 'navin@yopmail.com', 'user', NULL, NULL, NULL, NULL, 'active', '2024-09-07 13:17:08', '2024-09-08 15:20:54');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
