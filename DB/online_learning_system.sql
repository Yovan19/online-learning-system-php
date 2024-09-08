-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Sep 08, 2024 at 06:52 PM
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
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `label` enum('Top Trending','Free Courses','New Courses','Web Development','Mobile Development','Beginner','Advanced','Game Development','Analytics','Hacking','Full Stack Development','JavaScript','Python','Software testing') NOT NULL,
  `no_of_star` varchar(10) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `discount_with_amount` varchar(255) DEFAULT NULL,
  `no_of_weeks` int(11) DEFAULT NULL,
  `no_of_lessons` int(11) DEFAULT NULL,
  `no_of_students` int(11) DEFAULT NULL,
  `status` enum('published','unpublished') NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `thumbnail`, `label`, `no_of_star`, `amount`, `discount_with_amount`, `no_of_weeks`, `no_of_lessons`, `no_of_students`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Php', 'PHP is a general-purpose scripting language geared towards web development', '../public/uploads/php.png', 'Top Trending', '4.8', '200.00', 'Free', 3, 8, 10, 'published', '2024-09-08 16:28:40', '2024-09-08 16:28:40'),
(3, 'Java', 'Core concepts in Java (whilst having fun, too)', '../public/uploads/java.png', 'Top Trending', '4.7', '150.00', 'Free', 5, 12, 3, 'published', '2024-09-08 18:37:45', '2024-09-08 18:37:45'),
(4, 'python', 'Understand and implement basic Python Code.', '../public/uploads/python.png', 'New Courses', '4.9', '500.00', 'Free', 3, 8, 12, 'published', '2024-09-08 18:37:45', '2024-09-08 18:37:45'),
(5, 'Laravel Programming', 'Laravel is a free and open-source PHP-based web framework for building web applications', '../public/uploads/Laravel.png', 'Web Development', '4.2', '400.00', 'Free', 4, 2, 4, 'published', '2024-09-08 18:41:57', '2024-09-08 18:41:57'),
(6, 'CSS', 'Introduction to CSS', '../public/uploads/css.png', 'Web Development', '4.5', '100.00', 'Free', 4, 20, 1000, 'published', '2024-09-08 18:49:11', '2024-09-08 18:51:52'),
(7, 'Digital Marketing', 'Digital marketing strategies and tools', '../public/uploads/Digital_Marketing.png', 'Analytics', '4.7', '150.00', 'Free', 6, 30, 1500, 'unpublished', '2024-09-08 18:49:11', '2024-09-08 18:51:54'),
(8, 'Django', 'Learn Django for web development', '../public/uploads/django.png', 'Full Stack Development', '4.8', '200.00', 'Free', 8, 40, 2000, 'published', '2024-09-08 18:49:11', '2024-09-08 18:51:55'),
(9, 'Git', 'Version control with Git', '../public/uploads/Git.png', 'Software testing', '4.6', '50.00', 'Free', 2, 10, 500, 'unpublished', '2024-09-08 18:49:11', '2024-09-08 18:51:57'),
(10, 'HTML', 'Basics of HTML', '../public/uploads/html.png', 'Beginner', '4.4', '90.00', 'Free', 3, 15, 800, 'published', '2024-09-08 18:49:11', '2024-09-08 18:52:00'),
(11, 'JavaScript', 'JavaScript for beginners', '../public/uploads/javascript.png', 'JavaScript', '4.9', '120.00', 'Free', 5, 25, 1800, 'unpublished', '2024-09-08 18:49:11', '2024-09-08 18:52:02');

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
(1, 'superadmin', '$2y$10$5LDZRSj9SX/3foL7.PLQqOxBuvwvdQ3x8vmznP.8ViyyC.Lt93mcW', 'superadmin@yopmail.com', 'admin', NULL, 1, '18e0a15119dfc87301bd6b58fde31a53', '2024-10-08 18:43:40', 'active', '2024-09-07 13:17:08', '2024-09-08 18:43:40'),
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
