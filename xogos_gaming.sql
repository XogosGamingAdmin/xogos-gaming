-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 11, 2023 at 01:54 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xogos`
--

-- --------------------------------------------------------

--
-- Table structure for table `affiliates`
--

CREATE TABLE `affiliates` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `affiliate_link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_registration` int DEFAULT NULL,
  `total_clicks` int DEFAULT NULL,
  `earn_per_recruit` double NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `affiliates`
--

INSERT INTO `affiliates` (`id`, `user_id`, `affiliate_link`, `total_registration`, `total_clicks`, `earn_per_recruit`, `created_at`, `updated_at`) VALUES
(2, 809, 'http://localhost/xogos/includes/register.php?by_user=809', 0, 4, 1, '2023-10-22 21:34:20', '2023-10-22 21:36:10');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chatid` int NOT NULL,
  `sender_userid` int NOT NULL,
  `reciever_userid` int NOT NULL,
  `message` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chatid`, `sender_userid`, `reciever_userid`, `message`, `timestamp`, `status`) VALUES
(1, 2, 1, 'hello', '2023-05-12 06:02:16', 1),
(2, 2, 1, 'Are you there?', '2023-05-26 10:48:49', 1),
(3, 1, 2, 'Are you there?', '2023-05-26 10:49:05', 1),
(4, 2, 1, 'Happy day!', '2023-05-26 10:49:19', 1),
(5, 216, 217, 'Hej Lukas', '2023-06-08 00:03:33', 1),
(6, 689, 679, 'Hej pappa!', '2023-06-17 14:19:59', 1),
(7, 679, 689, 'Hej Lukas', '2023-06-17 23:31:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chat_login_details`
--

CREATE TABLE `chat_login_details` (
  `id` int NOT NULL,
  `userid` int NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_typing` enum('no','yes') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_users`
--

CREATE TABLE `chat_users` (
  `userid` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `current_session` int NOT NULL,
  `online` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int NOT NULL,
  `class_teacher_id` varchar(255) DEFAULT NULL,
  `class_subject` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_teacher_id`, `class_subject`) VALUES
(1, '909', 'Science');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `student_id` int NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `class_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`student_id`, `firstname`, `lastname`, `class_id`) VALUES
(810, 'Ethan', 'Edwards', 1),
(813, 'Lydon', 'Mendoza', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gamedata`
--

CREATE TABLE `gamedata` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `game_id` varchar(255) NOT NULL,
  `game_coins` int DEFAULT NULL,
  `game_time` int DEFAULT NULL,
  `update_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gamedata`
--

INSERT INTO `gamedata` (`id`, `username`, `game_id`, `game_coins`, `game_time`, `update_at`) VALUES
(1, 'akbarkid', 'lr', 0, 0, '2023-08-27'),
(2, 'larryvooodooo', 'lr', 0, 0, '2023-08-27'),
(3, 'thernloven', 'lr', 0, 0, '2023-08-27'),
(4, 'stedwards', 'lr', 1, 1193, '2023-08-27'),
(5, 'etedwards', 'lr', 0, 0, '2023-08-27'),
(6, 'stedwards', 'lr', 1, 1193, '2023-08-28'),
(7, 'etedwards', 'lr', 0, 0, '2023-08-28'),
(8, 'akbarkid', 'lr', 0, 0, '2023-08-28'),
(9, 'thernloven', 'lr', 0, 0, '2023-08-28'),
(10, 'larryvooodooo', 'lr', 0, 0, '2023-08-28'),
(11, 'thernloven', 'lr', 0, 0, '2023-08-29'),
(12, 'larryvooodooo', 'lr', 0, 0, '2023-08-29'),
(13, 'stedwards', 'lr', 1, 1193, '2023-08-29'),
(14, 'akbarkid', 'lr', 0, 0, '2023-08-29'),
(15, 'etedwards', 'lr', 0, 0, '2023-08-29'),
(16, 'stedwards', 'lr', 1, 1193, '2023-08-30'),
(17, 'akbarkid', 'lr', 0, 0, '2023-08-30'),
(18, 'etedwards', 'lr', 0, 0, '2023-08-30'),
(19, 'stedwards', 'lr', 1, NULL, '2023-08-30'),
(20, 'akbarkid', 'lr', 0, NULL, '2023-08-30'),
(21, 'etedwards', 'lr', 0, NULL, '2023-08-30'),
(22, 'larryvooodooo', 'lr', 0, 0, '2023-08-30'),
(23, 'thernloven', 'lr', 0, 0, '2023-08-30'),
(24, 'thernloven', 'lr', 0, NULL, '2023-08-30'),
(25, 'larryvooodooo', 'lr', 0, NULL, '2023-08-30');

-- --------------------------------------------------------

--
-- Table structure for table `lightninground`
--

CREATE TABLE `lightninground` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `total_coins_lr` varchar(255) NOT NULL,
  `timestamp_lr` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `lightninground`
--

INSERT INTO `lightninground` (`id`, `user_id`, `total_coins_lr`, `timestamp_lr`) VALUES
(1, 123, '1000', '2023-06-15 17:04:50'),
(2, 123, '1500', '2023-04-15 17:05:24');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int NOT NULL,
  `code` char(2) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `code`, `name`) VALUES
(1, 'AL', 'Alabama'),
(2, 'AK', 'Alaska'),
(3, 'AS', 'American Samoa'),
(4, 'AZ', 'Arizona'),
(5, 'AR', 'Arkansas'),
(6, 'CA', 'California'),
(7, 'CO', 'Colorado'),
(8, 'CT', 'Connecticut'),
(9, 'DE', 'Delaware'),
(10, 'DC', 'District of Columbia'),
(11, 'FM', 'Federated States of Micronesia'),
(12, 'FL', 'Florida'),
(13, 'GA', 'Georgia'),
(14, 'GU', 'Guam'),
(15, 'HI', 'Hawaii'),
(16, 'ID', 'Idaho'),
(17, 'IL', 'Illinois'),
(18, 'IN', 'Indiana'),
(19, 'IA', 'Iowa'),
(20, 'KS', 'Kansas'),
(21, 'KY', 'Kentucky'),
(22, 'LA', 'Louisiana'),
(23, 'ME', 'Maine'),
(24, 'MH', 'Marshall Islands'),
(25, 'MD', 'Maryland'),
(26, 'MA', 'Massachusetts'),
(27, 'MI', 'Michigan'),
(28, 'MN', 'Minnesota'),
(29, 'MS', 'Mississippi'),
(30, 'MO', 'Missouri'),
(31, 'MT', 'Montana'),
(32, 'NE', 'Nebraska'),
(33, 'NV', 'Nevada'),
(34, 'NH', 'New Hampshire'),
(35, 'NJ', 'New Jersey'),
(36, 'NM', 'New Mexico'),
(37, 'NY', 'New York'),
(38, 'NC', 'North Carolina'),
(39, 'ND', 'North Dakota'),
(40, 'MP', 'Northern Mariana Islands'),
(41, 'OH', 'Ohio'),
(42, 'OK', 'Oklahoma'),
(43, 'OR', 'Oregon'),
(44, 'PW', 'Palau'),
(45, 'PA', 'Pennsylvania'),
(46, 'PR', 'Puerto Rico'),
(47, 'RI', 'Rhode Island'),
(48, 'SC', 'South Carolina'),
(49, 'SD', 'South Dakota'),
(50, 'TN', 'Tennessee'),
(51, 'TX', 'Texas'),
(52, 'UT', 'Utah'),
(53, 'VT', 'Vermont'),
(54, 'VI', 'Virgin Islands'),
(55, 'VA', 'Virginia'),
(56, 'WA', 'Washington'),
(57, 'WV', 'West Virginia'),
(58, 'WI', 'Wisconsin'),
(59, 'WY', 'Wyoming');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `admin_id` int DEFAULT '0',
  `contractor_id` int DEFAULT '0',
  `parent_id` int DEFAULT '0',
  `student_id` int DEFAULT '0',
  `t_student_id` int DEFAULT '0',
  `teacher_id` int DEFAULT '0',
  `class_id` int DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `img` text,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `unhashed_pass` varchar(200) DEFAULT NULL,
  `confirm_p` varchar(255) DEFAULT NULL,
  `user_role` varchar(255) DEFAULT NULL,
  `kids_count` int DEFAULT '0',
  `token_lr` text,
  `token_tq` text,
  `token` text,
  `verified` varchar(5) DEFAULT 'no',
  `active` varchar(5) DEFAULT 'no',
  `is_affiliate` tinyint NOT NULL DEFAULT '0',
  `affiliated_by` int DEFAULT NULL,
  `total_coins_lr` varchar(255) DEFAULT NULL,
  `total_time_lr` varchar(255) DEFAULT NULL,
  `timestamp_lr` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `admin_id`, `contractor_id`, `parent_id`, `student_id`, `t_student_id`, `teacher_id`, `class_id`, `company`, `firstname`, `lastname`, `img`, `address`, `phone`, `city`, `state`, `zip`, `email`, `username`, `password`, `unhashed_pass`, `confirm_p`, `user_role`, `kids_count`, `token_lr`, `token_tq`, `token`, `verified`, `active`, `is_affiliate`, `affiliated_by`, `total_coins_lr`, `total_time_lr`, `timestamp_lr`) VALUES
(123, 653, 0, 94, 76, NULL, 188, NULL, NULL, 'admin', 'admin', 'default-avatar.png', 'Midgardsvagen 8', '0703454296', 'Hollviken', '', '23651', 'admin@dashboard.com', 'admin', '$2y$12$252HNluACYbgLtOCAGQwYeijY7UxwDQn.A77dF4M.ttdV/HhYlW22', NULL, NULL, 'admin', 0, '', NULL, NULL, 'yes', 'yes', 0, NULL, '1500', '', '2023-06-15 16:42:53'),
(124, NULL, 0, NULL, NULL, NULL, 909, NULL, NULL, 'Teacher', 'Teacherson', 'birgitte-modified.png', 'Midgardsvagen 8', '0703454296', 'Hollviken', '4', '23651', 'teacher@school.com', 'teacher', '$2y$12$cI1rzEOStZZSCoLNVBEw4uzpRU3aA5LxLERfOpiAJxiMNSe1dQKVm', NULL, NULL, 'teacher', 0, '', NULL, NULL, 'yes', '', 0, NULL, '', '', '2023-06-15 16:42:53'),
(696, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'bobo', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(697, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ppppp', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(698, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'qoqoqo', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(699, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'manafKH', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(700, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'testkid', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(701, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'nader', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(702, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '888', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(703, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tests', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(704, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Elvie_Schulist63', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(705, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Betty_Blick', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(706, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0123456', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(707, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'xmx', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(708, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'wqqqaa', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(709, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Olin_Mann', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(710, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Rosalind.DuBuque18', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(711, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Marlin10', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(712, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'teacherkid', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(713, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'aqzxxx', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(714, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'semooo', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(715, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Tatum_Heller', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(716, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mome95', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(717, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'manaf9500', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(718, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'camilaguemes', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(719, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'eedwards', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:01:46', '2023-06-20 17:37:37'),
(720, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test123', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(721, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'oliver', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(722, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Student 1', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(723, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Student 2', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(724, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tstudent 1', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(725, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tstudent2', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(726, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'saikat22', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(727, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sasdf', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(728, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kygalyv', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(729, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'john.doe', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(730, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'lys', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(731, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'zuzz', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(732, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'abc', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(733, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(734, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'jackmugi', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(735, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'studentstudent', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(736, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'melona', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(737, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user3', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(738, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'abcdef', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(739, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kopopi', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(740, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'joymortin123', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(741, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ritana9052', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(742, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'thuc', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(743, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'johnpeter', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(744, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kuvulavab', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(745, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(746, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin2', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(747, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'teststudent', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(748, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'abcd', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(749, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fapycew', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(750, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pili', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(751, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Laim', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(752, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Jackkelas', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(753, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'uzair123', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(754, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sardarumar', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(755, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'asadali', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(756, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'asadumar', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(757, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'thernloven33', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(758, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rainbow', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(759, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'paul', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(760, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'testQPI', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(761, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Bariq', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(762, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'anedwards', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'no', 'no', 0, NULL, '0', '00:00:00', '2023-06-20 17:37:37'),
(809, 639, 0, 28, 0, 0, 909, NULL, NULL, 'Zack', 'Edwards', 'historicalconquest_portrait_of_Sir_Admiral_Francis_Drake_with_a_62b8687d-ee71-4899-a84f-5fd137bac031.png', '601 NORTHPOINT AVE', '18163598932', 'LIBERTY', '5', '64068', 'zack@historicalconquest.com', 'saikat', '$2y$12$pFxdfUi0taSowrgfYflVzucVBfbSxekDCYMmxQ0QBX7jzDw1Jbyd6', NULL, NULL, 'parent', 2, '', NULL, NULL, 'yes', 'yes', 1, NULL, NULL, NULL, '2023-08-05 11:53:47'),
(810, 0, 0, 0, 28, 0, 0, NULL, NULL, 'Ethan', 'Edwards', '', NULL, NULL, 'Liberty', '13', NULL, 'edwards_crew@hotmail.com', 'etedwards', '$2y$12$pmq0cOszrGE6lt6VTxd17.SbXu6eNbT/N1Ddb5zRR.pyjLD4RLYJW', NULL, NULL, 'student', 0, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI1IiwianRpIjoiODVjNjQ5Njc5ZGJlMjk0ODc3MjlhNWE1ZmY0MmNkNzhlY2EzM2JjM2FiMzdhYTMwMGNhNmYyZTIwNWVkMzE2NzYyNTBkNTEwNDNiODc1MDAiLCJpYXQiOjE2OTEyMzY1NzUuMDU4MDQ0LCJuYmYiOjE2OTEyMzY1NzUuMDU4MDQ5LCJleHAiOjE3MjI4NTg5NzUuMDQ5MzA0LCJzdWIiOiIxMjQiLCJzY29wZXMiOltdfQ.Gvipfn4PlRZuc6JCWiyE38Qm2zfsZZJKuSP5ymjEllItdeYMYcGxhBJ7ThcwMjtGwA4fgqCiHWRb6_6_4MF4rlvycZ7jcGcpsly3QHPuPEjf9Q93CoXn8zUQZkiNJv8uMg_TF9B94oepAubmvnOErfAiC-TGQxj7MnkCzHpORWgHn8r2lL1PptQwaPdt-0_NOTObeI-cQ8G66Hh45reII3eyP3_mD74d2L8VYQW0jra_vpVy1N5Lkkd7B3pVCkfGZ04JNTtoj3XLTF6zm4UZqObp1T_v8Iw9S2EG4ukVuKHWSg1EU2Zdv7rqihyx7EwFembX0yd7v0uP7ORrm7zFBYaLRo9sKbOpsIuBP985Td8fpAkuaWaiqRxDWRzjb2F9fq79V6mhEb7DXDpvaqh9gxVwxC4weuskXYFaIs8nwCI2cwWZM1CmpsbvZ-JM3B0UPhQG--QfPBERsXfyum8Vd3PKsPp30UEs_5f2TJT8X4Tk4WCZlC6Mmwz7ntJkwUYUSoQiv9MKdwB65yTpClhcqCIcuZe6gB1mvJT-RKrjYYRq7nJHi2NrDQdGPv2EGfRIgo5gxCFSg0qmGvHKIxDLbRLKVF7iojt1TqWqvpxu46SZPMDPU4b2QUOSracpB5Gq7ooYUB-8CcD-zThx_3wPGSitfrx_XIyaWYBfQYPrXR8', NULL, 'f405f81ddecd846fd754d1eff2486edcbbc4ae0ccb33fd4a7b390dc7bc03d7173501219e15cc97e118ff8a2f907f99ca7633', 'yes', 'yes', 0, NULL, '0', '00:00:00', '2023-08-05 11:56:14'),
(811, 0, 0, 0, 28, 0, 0, NULL, NULL, 'Stratton', 'Edwards', 'historicalconquest_an_illustration_of_a_red_coat_British_Army_s_c8719450-d007-454a-86a5-e6acd0932a11.png', '', '', 'LIBERTY', 'Missouri', '', 'zcedwards8@gmail.com', 'stedwards', '$2y$12$moGQJecg8IxneNdGpqNgEeYI9WV46eDMAKAtrSHfro3pD0U82sZRC', NULL, NULL, 'student', 0, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI1IiwianRpIjoiMTRiNjhmZjljNmI4NGVhMDU5NzA4NDY4MjVmNWI3MzRkOWE2MzU3MmEzNzE1MjQwZTc0NDI0MDgzNTEwMDU5M2UxODgyYWUyMWQ2ZWYwNWEiLCJpYXQiOjE2OTMzMDY5MzIuOTc4OTk5LCJuYmYiOjE2OTMzMDY5MzIuOTc5MDA0LCJleHAiOjE3MjQ5MjkzMzIuOTY3MjA1LCJzdWIiOiIxMjUiLCJzY29wZXMiOltdfQ.dC00HhdJJz7uBOXGat0-G5UOjr4E9T-F3bh2DtipGX-BGLCGwvYrLCRwj1hv8ptZ8ZaWzkmgWeDnsQUi9rDAEULnqVJFaNdMy9fnWGWD_IV4qevO-wOkR-gFoXLXy1DuDHelFe_Y0_O0Ittx40EKPg9h46gCgbZ4-ZhNkwzEcKANPMTbDOFs-FoICYXjtAXzJGr-XzTmudWDJarGaFB3eZxWgBFDdmwhCSzBnlOKO7M8je6Kw7sDzIftxdRg4Q3P4zq6Y41dZHBwe1OxvP77snBfmIOtiZ-FmIovNLAUAjPN7H-QpchDz6w-VzOMf7q_fpdbR1VC0x38DqEscHcMckyLrpawnAThVIffIu1cSPi0B7hoSPQ8KP4Ax8qc9M7WoMzc9V4MM-QoKLmoJp2zB0O44xJsqHaYCl_aHjeBGRR4OfddWQ5PtUUnVkW2j8BRI8WKFd_ypbYViVd9Zz7yIWmIrLu2dUTq5v9NtbqbOD9Lanf6P7TviYyCbJ396CLoEiIntDnlTGR3U3C-AovLObNlqwPYmUBCsuNJZxSGV3XQm2Zfj-D2xGyB_v-5sm_KVUSVnGWO65gDNY3byh39YLxih_KaKgJlcOQ12m6M1tr247wEkF_j6XNz7GUVUDjJaIQ8T0liEAkay4ZK34MORCJBUy1IBak-QDJqBv2lL7M', NULL, NULL, 'yes', 'yes', 0, NULL, '1', '00:19:53', '2023-08-05 11:58:25'),
(812, 323, 0, 810, 0, 0, 491, NULL, NULL, 'Lydon', 'Mendoza', '', '11201 w roanoke ave', '6232135574', 'Avondale', '2', '85392', 'lydon.mendoza@gmail.com', 'larryvoodoo', '$2y$12$6PDGxZ9ORgIXyD3R26mcuOy//rEQ4Z4PCjAKMS13UiEvGGwVzuGq6', NULL, NULL, 'parent', 1, '', NULL, NULL, 'yes', 'yes', 0, NULL, NULL, NULL, '2023-08-08 00:39:10'),
(813, 0, 0, 0, 810, 0, 0, NULL, NULL, 'Lydon', 'Mendoza', '', NULL, NULL, 'Avondale', 'Arizona', NULL, 'eileencwells1@gmail.com', 'larryvooodooo', '$2y$12$bU6Zmb6KGkv7gQW1FJn5Nesv1yjSxUUkehsdQD3IOSy31QYkxMZbi', NULL, NULL, 'student', 0, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI1IiwianRpIjoiN2I0NjZmZGM3ZDlmNTgwNmMxNDQwMTMxZjZiODVkZGI3YWZkNzJjMTIyZmQ1YTJiZjJkYzczZjQxNDEzMjFmZTcxZTdmNWIyMTMwNTViNmUiLCJpYXQiOjE2OTE0NTU0NjcuNzY3MTY0LCJuYmYiOjE2OTE0NTU0NjcuNzY3MTcyLCJleHAiOjE3MjMwNzc4NjUuNDc4ODIxLCJzdWIiOiIxMjYiLCJzY29wZXMiOltdfQ.FGLjy--ShwH6A0Wc6xrJK7f9Pvem0TOOpMdJW-fcSaBkX6MTQ7Jg5Q5hKsBxW0ZKYFf-J-NLfuwXNwqdGI67cpZpYV0fmPEpaS0BHC_WtdyqslUB2R9Gh7sc8_T75h4NZE0oRChpqJxTbXux7STZqG6siIkiYn7LkI6HdiEGJQPN_z6Ub8C4m6F7Qditr5HtIy1Oo4eDcQJceeTDkUpZPmcEcQ3j1h5xKCh1wM3OTPDzw_lCzJLOqySfOR8lZKGc3CqDqcPWa2TLy2PSfhqj61Qe6PCjkGMYIPsd6TPe1Kjd6W2WbhW_zkz_EMYltdCOtmEe2cJ9MVhMbCm25NGnJwWEKSL4MWn--vvlrfm66hBIjwvhoPvaGH2RSDkF_x-tanXosN7GDM3Jhy9Xtbo45IDhy6_-vFVluAYDIcMHnIt8dttzQgWQxiL05a6IuoV6-RlIL0ZrdA_aciH38-M7BV7kv38xOqCbdmM4br-Tc5Y__2xfESVQJY2y8MXT9_Bxu7CFLzCSe5dOCZr8rpefs7liy0Q49Jl-0mppCnSW3gSQp-QaGNcdUzEUXPa4CtPvdt1mmxKUlzP0AxXKR7nRZbAwegbThWeG0yYBHVRYMoPE9JCUCD7Cf-dGe-6zAmc21XrhU0oKrOYvt-SpMMiuv2BUo5VBJFmHYjRLuheJLkM', NULL, '01e6d5bacfdbd94bbbfea0c0094f3348185ad2676543773756e99c6bb5f7ffcb8bd66a8d989a80ab0543747d0ccceed990f7', 'no', 'no', 0, NULL, '0', '00:00:00', '2023-08-08 00:44:23'),
(817, 0, 857, 0, 0, 0, 0, NULL, 'ThernLoven', 'Lukas', 'Thern Lovén', '', 'Midgardsvagen 8', '0703454296', 'Hollviken', '6', '23651', 'lukas@thernloven.com', 'thernloven', '$2y$12$QX7HOlfY4PoOEJ6CApjMFew4mnTEDz0lUZlwdjkLr4bUvJUCswBaa', NULL, NULL, 'contractor', 0, '', NULL, 'ee2925d0239b523ff95af266c99dfed8964e3ee977c827a26f4513fd6b7c540493c03db343ebd8995dd069c393d029ccf6d3', 'yes', 'yes', 0, NULL, NULL, NULL, '2023-08-30 14:07:49'),
(831, 0, 0, 659, 0, 0, 0, NULL, NULL, 'nijyr', 'Flores', '', 'maxonyc', 'Griffith', 'Quas reiciendis hic ', 'Minnesota', '95446', 'tesumo@mailinator.com', 'saikat2', '$2y$12$uhMOU..y1jUqx9czNfBoju4/JPBB1jJ8CHJEdTQQN5v.mVjAwFdL6', NULL, NULL, 'parent', 0, NULL, NULL, '54b076bbadd5b90cfc4c0e10d0c48346fba778e6ffb38eb63757ef0076ff837e9ef6bc3ea1e18951426dbdaac28f7a36d5a0', 'no', 'no', 0, 809, NULL, NULL, '2023-10-22 21:35:10'),
(832, 0, 0, 46, 0, 0, 0, NULL, NULL, 'Human', 'Clark', '', 'mosavujo', 'Witt', 'Autem occaecat sapie', 'Arkansas', '18721', 'hahefazydi@mailinator.com', 'saikat3', '$2y$12$DzF7q5s1TksvkZFW10QHJu/OrQ81ujMAr3n8vxJR4SL3OnN7YaucG', NULL, NULL, 'parent', 0, NULL, NULL, 'c79d3d92771f7733e9f7a3c59348e196a76b904abbab9f5ec504d44b4f83c443312ffa57a4f4dc758dae5732c51cfa79ae55', 'no', 'no', 0, 809, NULL, NULL, '2023-09-10 21:36:26'),
(866, 0, 0, 980, 0, 0, 0, NULL, NULL, 'Test', 'test2', NULL, NULL, NULL, 'Rangpur', '1', NULL, 'test22@gmail.com', 'test22', '$2y$12$3OUNL2vNDSoGFsECqvaKZulQPHOK8l7H7tYgyjF/.L5ibq0wV6LCC', 'P02F9nru', NULL, 'student', 0, NULL, NULL, 'f73b75d7771856a5e0e698e5094bbd7e0acf45fd5986046ff27aa746a09e1bc4592ea2df4e40c2ee2a4eec3a927ecb0c7a2f', 'no', 'no', 0, NULL, NULL, NULL, '2023-11-10 19:04:47'),
(870, 0, 0, 524, 0, 0, 0, NULL, NULL, 'Hadassah', 'Lindsay', NULL, NULL, NULL, 'Reiciendis fugiat mi', '5', NULL, 'mehiwi@mailinator.com', 'firezag', '$2y$12$VT9f2r.RpJVuYi3/Nbi0fuh2DGrsO6rgtiaojp9sq6cK0xLc2ku4O', 'urVEQaIU', NULL, 'student', 0, NULL, NULL, '2a908d83e7591992a5b0435ab69da79c9949b47571a345ff12a8f938fca282a5ffb7f8553a5d8603cd2050a7f79b001a301c', 'no', 'no', 0, NULL, NULL, NULL, '2023-11-10 19:13:12'),
(872, 0, 0, 741, 0, 0, 0, NULL, NULL, 'Kitra', 'Herring', NULL, NULL, NULL, 'Nihil nesciunt opti', '58', NULL, 'parofyxy@mailinator.com', 'lexop', '$2y$12$yTV6DMqkVR/BE791Fv2gNODkJf3V1q7UvOkPchCLk9T7TJElGOGGS', 'ziLgiLm0', NULL, 'student', 0, NULL, NULL, '81bf8ac3148e6c2952efb0e1f73b3b704e9e453b8687704ada95ac62f18a73fd60e3007ab32bb00483019708d4b5a761e319', 'no', 'no', 0, NULL, NULL, NULL, '2023-11-10 19:18:08'),
(873, 0, 0, 167, 0, 0, 0, NULL, NULL, 'Tanya', 'Acosta', NULL, NULL, NULL, 'Nesciunt et occaeca', '57', NULL, 'zyby@mailinator.com', 'modytoqo', '$2y$12$Z01iHBOdSWdGixE7U42ujuhAUhDzGL5iUcn6te9LAGU/tArPyTEOC', '6jmVLkCY', NULL, 'student', 0, NULL, NULL, 'ffad068ae05d8fe06bfe067fc026b576e5edbaeb2de85f246ec49f23074da1ecf8ec417b6e537185dd91a656b32666bc87df', 'no', 'no', 0, NULL, NULL, NULL, '2023-11-10 19:19:00'),
(875, 0, 0, 872, 0, 0, 0, NULL, NULL, 'Marjana ', 'Mimi', NULL, NULL, NULL, 'Rangpur', '1', NULL, 'mimi@gmail.com', 'mimi', '$2y$12$Jp7/t6SQ6Jct1bu0KULAHODezsuzISTZWD86Vrb076fPUYfdZLliS', 'd3iVL8D6', NULL, 'student', 0, '', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MTQ2LCJpYXQiOjE2OTk2NDQyNTgsImV4cCI6MTY5OTczMDY1OH0.GTPqXCtcOPt4-swRVFD3v5MSeMyVuND69L3vOdJaja4', '6c69aa4d0ce4a50e31d04567a13a49acb89c56bea77a0e5476978d7b2f8d31e49eed93a01a1398af538b7a366e0ae7f1f677', 'yes', 'yes', 0, NULL, NULL, NULL, '2023-11-10 19:24:22'),
(876, 0, 0, 712, 0, 0, 0, NULL, NULL, 'Ninid', 'Raihan', NULL, NULL, NULL, 'Rangpur', '1', NULL, 'ninid@gmail.com', 'ninid', '$2y$12$EwlaMk1WCUFBaL2YDn6A1.w9JZ55c2a/FW/jsXVDXA27363V8z5be', 'LQXNK3jY', NULL, 'student', 0, '', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MTQ3LCJpYXQiOjE2OTk3MDg0NTYsImV4cCI6MTY5OTc5NDg1Nn0.n-g0_yCuxe3PVBSh0VG5spNYylCe_OuRAYqJxenXpL0', '290124aa21c0060641e83f6bf279af1d423075ff2af7be16116cf4d60d8f87ac33840c4cd9f38881f8bc8cab4b472ba43ade', 'yes', 'yes', 0, NULL, NULL, NULL, '2023-11-11 13:14:21');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `update_lightninground` AFTER UPDATE ON `users` FOR EACH ROW BEGIN
  IF NEW.total_coins_lr <> OLD.total_coins_lr THEN
    INSERT INTO `lightninground` (`user_id`, `total_coins_lr`)
    VALUES (NEW.user_id, NEW.total_coins_lr);
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `online_id` int NOT NULL,
  `online_parent_id` int DEFAULT NULL,
  `online_student_id` int DEFAULT NULL,
  `online_teacher_id` int DEFAULT NULL,
  `online_t_student_id` int DEFAULT NULL,
  `online_firstname` varchar(255) NOT NULL,
  `online_img` text NOT NULL,
  `online_user_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`, `online_id`, `online_parent_id`, `online_student_id`, `online_teacher_id`, `online_t_student_id`, `online_firstname`, `online_img`, `online_user_role`) VALUES
(288, 'c61v0ds0ervrganja1d59vie16', 1693306983, 811, 0, 28, 0, 0, 'Stratton', 'historicalconquest_an_illustration_of_a_red_coat_British_Army_s_c8719450-d007-454a-86a5-e6acd0932a11.png', 'student'),
(550, '2uh1venio11vhasqjf3n4icnhd', 1698009761, 828, 620, 0, 0, 0, 'Farhan', '', 'parent'),
(558, '70muk2u5mbbkeiqrfmq1sh34f7', 1698010460, 809, 28, 0, 909, 0, 'Zack', 'historicalconquest_portrait_of_Sir_Admiral_Francis_Drake_with_a_62b8687d-ee71-4899-a84f-5fd137bac031.png', 'parent'),
(611, 'r17sbai8dtsh7pni231f5o09sl', 1699645176, 875, 872, 0, 0, 0, 'Marjana ', '', 'student'),
(647, 'rjqhbu2ffa0rbu3k5oa31h0crd', 1699710180, 876, 712, 0, 0, 0, 'Ninid', '', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affiliates`
--
ALTER TABLE `affiliates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `affiliate_link` (`affiliate_link`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chatid`);

--
-- Indexes for table `chat_login_details`
--
ALTER TABLE `chat_login_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_users`
--
ALTER TABLE `chat_users`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`student_id`,`class_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `gamedata`
--
ALTER TABLE `gamedata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lightninground`
--
ALTER TABLE `lightninground`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `affiliates`
--
ALTER TABLE `affiliates`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chatid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chat_login_details`
--
ALTER TABLE `chat_login_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_users`
--
ALTER TABLE `chat_users`
  MODIFY `userid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gamedata`
--
ALTER TABLE `gamedata`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `lightninground`
--
ALTER TABLE `lightninground`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=877;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=648;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `affiliates`
--
ALTER TABLE `affiliates`
  ADD CONSTRAINT `affiliates_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`);

--
-- Constraints for table `lightninground`
--
ALTER TABLE `lightninground`
  ADD CONSTRAINT `lightninground_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
