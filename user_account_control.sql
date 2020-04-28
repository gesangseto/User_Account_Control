-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2020 at 04:07 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_account_control`
--

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `access` varchar(10) NOT NULL,
  `method` varchar(5) NOT NULL,
  `body` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `url`, `access`, `method`, `body`, `time`) VALUES
(491, 1586752419, 'http://localhost/User_Account_Control/UAC_Group', 'read', 'GET', '{\"id\":\"1\"}', '2020-04-28 02:04:49'),
(492, 1586752419, 'http://localhost/User_Account_Control/UAC_User', 'update', 'GET', '{\"id\":\"1586752419\"}', '2020-04-28 02:05:00'),
(493, 1586752419, 'http://localhost/User_Account_Control/UAC_User', 'update', 'POST', '{\"id\":\"1586752419\",\"username\":\"gesang\",\"email\":\"gesangseto@gmail.com\",\"fullname\":\"Gesang Aji Seto\",\"address\":\"    Jl.Bambu Gg.Resimin No.53 RT.01\\/08 Kreo - Larangan,\",\"phone_number\":\"082122222657\",\"password\":\"kolorijo123\",\"re_password\":\"kolorijo123\"}', '2020-04-28 02:05:14'),
(494, 1586752419, 'http://localhost/User_Account_Control/UAC_User', 'delete', 'GET', '{\"id\":\"1587153524\"}', '2020-04-28 02:05:45'),
(495, 1586752419, 'http://localhost/User_Account_Control/UAC_Permission', 'read', 'GET', '{\"id\":\"1\"}', '2020-04-28 02:05:59'),
(496, 1586752419, 'http://localhost/User_Account_Control/UAC_Permission', 'update', 'POST', '{\"permission_id\":\"71\",\"group_id\":\"1\",\"id\":\"71\",\"create\":\"on\",\"read\":\"on\",\"update\":\"on\",\"delete\":\"on\",\"change_permission\":\"TRUE\"}', '2020-04-28 02:06:05'),
(497, 1586752419, 'http://localhost/User_Account_Control/UAC_Permission', 'update', 'POST', '{\"permission_id\":\"1\",\"group_id\":\"1\",\"id\":\"1\",\"create\":\"on\",\"read\":\"on\",\"update\":\"on\",\"change_permission\":\"TRUE\"}', '2020-04-28 02:06:10'),
(498, 1586752419, 'http://localhost/User_Account_Control/UAC_User', 'update', 'GET', '{\"id\":\"1587153524\"}', '2020-04-28 02:06:18'),
(499, 1586752419, 'http://localhost/User_Account_Control/UAC_User', 'delete', 'GET', '{\"id\":\"1587153524\"}', '2020-04-28 02:06:25'),
(500, 1586752419, 'http://localhost/User_Account_Control/UAC_User', 'delete', 'GET', '{\"id\":\"1587844536\"}', '2020-04-28 02:06:32'),
(501, 1586752419, 'http://localhost/User_Account_Control/UAC_User', 'read', 'GET', '{\"id\":\"1586752419\"}', '2020-04-28 02:06:35');

-- --------------------------------------------------------

--
-- Table structure for table `uac_group`
--

CREATE TABLE `uac_group` (
  `id` int(11) NOT NULL,
  `group_name` varchar(50) NOT NULL,
  `group_info` text NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uac_group`
--

INSERT INTO `uac_group` (`id`, `group_name`, `group_info`, `create_time`, `update_time`) VALUES
(1, 'Developers', 'All Grant', '2020-04-17 17:12:47', '2020-04-26 05:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `uac_menu_mapping`
--

CREATE TABLE `uac_menu_mapping` (
  `id` int(11) NOT NULL,
  `parent_map_id` int(11) NOT NULL,
  `access_map` varchar(32) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_time` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uac_menu_mapping`
--

INSERT INTO `uac_menu_mapping` (`id`, `parent_map_id`, `access_map`, `create_time`, `update_time`) VALUES
(1, 1, 'UAC_Menu_Mapping', '2019-11-05 15:18:49', '2020-04-15 03:42:42'),
(2, 1, 'UAC_User', '2019-11-05 15:18:49', '2020-04-15 09:08:05'),
(3, 1, 'UAC_Permission', '2019-11-05 15:18:49', '2020-04-15 03:49:40'),
(34, 1, 'UAC_Group', '2020-04-13 04:16:46', '2020-04-15 03:42:27');

-- --------------------------------------------------------

--
-- Table structure for table `uac_parent_menu`
--

CREATE TABLE `uac_parent_menu` (
  `id` int(11) NOT NULL,
  `parent_map` varchar(32) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uac_parent_menu`
--

INSERT INTO `uac_parent_menu` (`id`, `parent_map`, `icon`, `create_time`, `update_time`) VALUES
(1, 'Administrator', 'fa fa-certificate', '2019-11-05 14:24:41', '2020-04-15 11:02:14');

-- --------------------------------------------------------

--
-- Table structure for table `uac_permission`
--

CREATE TABLE `uac_permission` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `access_map_id` int(11) NOT NULL,
  `create` int(11) NOT NULL,
  `read` int(11) NOT NULL,
  `update` int(11) NOT NULL,
  `delete` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uac_permission`
--

INSERT INTO `uac_permission` (`id`, `group_id`, `access_map_id`, `create`, `read`, `update`, `delete`, `create_time`, `update_time`) VALUES
(1, 1, 1, 1, 1, 1, 0, '2020-04-15 11:03:21', '2020-04-28 02:06:11'),
(2, 1, 3, 1, 1, 1, 1, '2020-04-15 11:03:21', '2020-04-28 01:44:05'),
(3, 1, 34, 1, 1, 1, 1, '2020-04-15 11:03:21', '2020-04-28 01:43:36'),
(71, 1, 2, 1, 1, 1, 1, '2020-04-15 11:18:18', '2020-04-28 02:06:05');

-- --------------------------------------------------------

--
-- Table structure for table `uac_user`
--

CREATE TABLE `uac_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(14) NOT NULL,
  `group_id` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uac_user`
--

INSERT INTO `uac_user` (`id`, `username`, `email`, `password`, `fullname`, `address`, `phone_number`, `group_id`, `create_time`, `update_time`) VALUES
(1586752419, 'gesang', 'gesangseto@gmail.com', '945bcdececc5edef87ece32479317df347e16be56425ac2f9d7f2a5b', 'Gesang Aji Seto', '    Jl.Bambu Gg.Resimin No.53 RT.01/08 Kreo - Larangan,', '082122222657', 1, '2020-04-13 04:33:39', '2020-04-28 02:05:14');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_group`
-- (See below for the actual view)
--
CREATE TABLE `view_group` (
`id` int(11)
,`group_id` int(11)
,`group_name` varchar(50)
,`group_info` text
,`total_user` bigint(21)
,`total_permission` bigint(21)
,`update_time` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_mapping`
-- (See below for the actual view)
--
CREATE TABLE `view_mapping` (
`id` int(11)
,`permission_id` int(11)
,`access_map_id` int(11)
,`create` int(11)
,`read` int(11)
,`update` int(11)
,`delete` int(11)
,`group_id` int(11)
,`group_name` varchar(50)
,`access_map` varchar(32)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_permission`
-- (See below for the actual view)
--
CREATE TABLE `view_permission` (
`id` int(11)
,`access_map_id` int(11)
,`parent_map` varchar(32)
,`access_map` varchar(32)
,`total_group` bigint(21)
,`create` decimal(32,0)
,`read` decimal(32,0)
,`update` decimal(32,0)
,`delete` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_user`
-- (See below for the actual view)
--
CREATE TABLE `view_user` (
`id` int(11)
,`username` varchar(50)
,`email` varchar(50)
,`fullname` varchar(50)
,`address` text
,`phone_number` varchar(14)
,`group_name` varchar(50)
,`group_id` int(11)
,`update_time` timestamp
);

-- --------------------------------------------------------

--
-- Structure for view `view_group`
--
DROP TABLE IF EXISTS `view_group`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_group`  AS  (select `a`.`id` AS `id`,`a`.`id` AS `group_id`,`a`.`group_name` AS `group_name`,`a`.`group_info` AS `group_info`,(select count(`b`.`id`) from `uac_user` `b` where `b`.`group_id` = `a`.`id`) AS `total_user`,(select count(`c`.`id`) from `uac_permission` `c` where `c`.`group_id` = `a`.`id`) AS `total_permission`,`a`.`update_time` AS `update_time` from `uac_group` `a`) ;

-- --------------------------------------------------------

--
-- Structure for view `view_mapping`
--
DROP TABLE IF EXISTS `view_mapping`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_mapping`  AS  (select `a`.`access_map_id` AS `id`,`a`.`id` AS `permission_id`,`a`.`access_map_id` AS `access_map_id`,`a`.`create` AS `create`,`a`.`read` AS `read`,`a`.`update` AS `update`,`a`.`delete` AS `delete`,`b`.`id` AS `group_id`,`b`.`group_name` AS `group_name`,`c`.`access_map` AS `access_map` from ((`uac_permission` `a` join `uac_group` `b` on(`b`.`id` = `a`.`group_id`)) join `uac_menu_mapping` `c` on(`a`.`access_map_id` = `c`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_permission`
--
DROP TABLE IF EXISTS `view_permission`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_permission`  AS  (select `a`.`access_map_id` AS `id`,`a`.`access_map_id` AS `access_map_id`,`c`.`parent_map` AS `parent_map`,`b`.`access_map` AS `access_map`,count(distinct `a`.`group_id`) AS `total_group`,sum(`a`.`create`) AS `create`,sum(`a`.`read`) AS `read`,sum(`a`.`update`) AS `update`,sum(`a`.`delete`) AS `delete` from ((`uac_permission` `a` join `uac_menu_mapping` `b` on(`a`.`access_map_id` = `b`.`id`)) join `uac_parent_menu` `c` on(`b`.`parent_map_id` = `c`.`id`)) group by `a`.`access_map_id`) ;

-- --------------------------------------------------------

--
-- Structure for view `view_user`
--
DROP TABLE IF EXISTS `view_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_user`  AS  (select `a`.`id` AS `id`,`a`.`username` AS `username`,`a`.`email` AS `email`,`a`.`fullname` AS `fullname`,`a`.`address` AS `address`,`a`.`phone_number` AS `phone_number`,(select `b`.`group_name` from `uac_group` `b` where `a`.`group_id` = `b`.`id`) AS `group_name`,(select `c`.`id` from `uac_group` `c` where `a`.`group_id` = `c`.`id`) AS `group_id`,`a`.`update_time` AS `update_time` from `uac_user` `a`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uac_group`
--
ALTER TABLE `uac_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uac_menu_mapping`
--
ALTER TABLE `uac_menu_mapping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_map_id` (`parent_map_id`);

--
-- Indexes for table `uac_parent_menu`
--
ALTER TABLE `uac_parent_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uac_permission`
--
ALTER TABLE `uac_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `access_map_id` (`access_map_id`),
  ADD KEY `admin_id` (`group_id`);

--
-- Indexes for table `uac_user`
--
ALTER TABLE `uac_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=502;

--
-- AUTO_INCREMENT for table `uac_group`
--
ALTER TABLE `uac_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1586748184;

--
-- AUTO_INCREMENT for table `uac_menu_mapping`
--
ALTER TABLE `uac_menu_mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `uac_parent_menu`
--
ALTER TABLE `uac_parent_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `uac_permission`
--
ALTER TABLE `uac_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
