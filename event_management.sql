-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 19, 2023 at 02:55 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `timestamp`, `username`, `password`) VALUES
(1, '2023-10-18 00:11:29', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `cover` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `timestamp`, `title`, `description`, `cover`) VALUES
(15, '2023-10-19 16:05:30', 'Footsaal 2023', 'asdfjsdafkjsdkfljlkadf', '4ddcad7052c03b35a519b3a6fe0d55c81d4808b892c5dc1647307661b15cb6f3.jpeg'),
(16, '2023-10-19 17:14:34', 'second event', 'ajsdkfjsadlf', '022907cb3a8945b29a993cbe5011ab87b2de69651fae360dd6a2dc9074eb63b2.png');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `content` text NOT NULL,
  `cover` varchar(100) NOT NULL,
  `event_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `timestamp`, `title`, `description`, `content`, `cover`, `event_id`) VALUES
(6, '2023-10-19 16:10:08', 'Footsaal 2023 Schedule is availbe', 'asdfjdskfjaksdf ajsdfja sdfjadflsdjlaf', '<p>jkajsdfklsdafkjsdf</p><p>asdjkfksajdfkljasdkfl</p><p>asdjfkajsdfkl</p><p>asdjfkadsjflsadf</p><p>kjakdsjfkasjdfkl</p><p>aksdjfkjsadfkklasdf</p><p>aksdjfksdjafklasdklf</p><p>aksdjfksdafkldsklfksdf</p>', '9e83bda2fbe3d30894bb08d31a10f011f43951add699c4a21f976408617094a2.png', NULL),
(7, '2023-10-19 16:50:29', 'Fire in Jungle', 'asdjfksjdfkjasdlf', '<p>asdfjsdkfjskajflsjdfl</p><p>askdfjksdajfkljsadlf</p><p>asdf</p>', '4601c1615dae0b4e1fd52a0fc82aab1f95eea08f474143644aef9303c7404f7c.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` bigint(20) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `event_id` bigint(20) NOT NULL,
  `team_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `timestamp`, `name`, `email`, `phone_number`, `event_id`, `team_id`) VALUES
(1, '2023-10-15 14:13:06', 'Adnan', '', '', 9, NULL),
(2, '2023-10-15 16:34:37', 'asdfas', 'asdf', 'asdfsdf', 9, NULL),
(6, '2023-10-15 16:44:04', 'asdfasdf', 'asdfsf', 'asdfasdfdsf', 10, NULL),
(7, '2023-10-17 21:29:08', 'asdfasdf', 'asdfasdfsdf', 'aasdfsafsdf', 14, 19),
(8, '2023-10-19 16:04:31', 'adnan athmar', 'asdfkjsdkjf@gmail.com', 'asdfsdfasf', 14, NULL),
(9, '2023-10-19 16:05:49', 'asdjfsjkdfal', 'aksdjfkjsdlfk', 'aksdjflkjsadlfsdf', 15, 23),
(10, '2023-10-19 16:05:55', 'asdfjskjfkasdjflksdf', 'aksdjfkljsadfklsjd', 'asdjfklasjklfjasldf', 15, 23),
(11, '2023-10-19 16:06:01', 'asdkfjksdjfkasdjflk', 'ajsdfkjsakldfs', 'asdfjsdaklfkldsf', 15, 22),
(12, '2023-10-19 16:06:55', 'asdfsajdf', 'asjdfjsadf', 'ajdsflsadf', 15, 22),
(13, '2023-10-19 16:27:50', 'samreen', 'asdfsdaf@gmail.com', 'asdjfkjsdfklsdaf', 15, 23);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `team_a` int(11) NOT NULL,
  `team_b` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `venue` varchar(100) DEFAULT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `timestamp`, `team_a`, `team_b`, `date`, `venue`, `event_id`) VALUES
(3, '2023-10-17 19:24:38', 19, 19, '2023-10-18 00:27:00', 'Peshawar', 14),
(4, '2023-10-19 11:08:02', 23, 22, '2023-10-05 06:09:00', 'Peshawar', 15),
(5, '2023-10-19 12:26:16', 24, 25, '2023-10-21 05:28:00', 'Peshawar', 16);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `name` varchar(100) NOT NULL,
  `event_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `timestamp`, `name`, `event_id`) VALUES
(1, '2023-10-15 12:22:20', 'Peshawar Zalmi', 1),
(8, '2023-10-15 14:01:32', 'asdfasdf', 9),
(9, '2023-10-15 14:01:35', 'asdfsdf', 9),
(10, '2023-10-15 14:01:37', 'asdfsdf', 9),
(11, '2023-10-15 14:01:40', 'asdfsdf', 9),
(12, '2023-10-15 14:01:43', 'asdfsadf', 9),
(13, '2023-10-15 14:01:45', 'adsfsdf', 9),
(14, '2023-10-15 14:01:48', 'asdfsdf', 9),
(15, '2023-10-15 14:38:42', 'UET Team', 10),
(16, '2023-10-15 14:38:53', 'IM sciences', 10),
(17, '2023-10-17 21:29:31', 'team 1', 14),
(18, '2023-10-17 21:29:34', 'team 2', 14),
(19, '2023-10-17 21:29:39', 'team 3', 14),
(20, '2023-10-17 21:29:42', 'team 4', 14),
(21, '2023-10-17 21:29:48', 'team 5', 14),
(22, '2023-10-19 16:06:36', 'team a', 15),
(23, '2023-10-19 16:06:41', 'team b', 15),
(24, '2023-10-19 17:22:32', 'asdfsdaf', 16),
(25, '2023-10-19 17:22:35', 'asdfdsaf', 16),
(26, '2023-10-19 17:22:38', 'asdf', 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
