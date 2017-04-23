-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 20, 2017 at 11:30 PM
-- Server version: 5.7.17-0ubuntu0.16.04.2
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs499`
--

-- --------------------------------------------------------

--
-- Table structure for table `assigned_features`
--

CREATE TABLE `assigned_features` (
  `id` int(11) NOT NULL,
  `feature_number` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `feature_file` varchar(50) DEFAULT NULL,
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `version_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assigned_features`
--

INSERT INTO `assigned_features` (`id`, `feature_number`, `user_id`, `feature_file`, `time_added`, `version_number`) VALUES
(1, 1, 8, 'navigation_1_menu_d.php', '2017-03-12 22:30:12', 1),
(2, 2, 8, 'credit_1_footer_d.php', '2017-03-14 19:35:24', 3),
(3, 3, 8, 'test_1_profile_d.php', '2017-03-14 20:12:31', 1),
(4, 4, 8, 'phonesub_1_index_d.php', '2017-04-05 17:30:23', 1),
(5, 4, 8, 'phonesub_0_index_d.php', '2017-04-05 17:30:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `email_list`
--

CREATE TABLE `email_list` (
  `id` int(11) NOT NULL DEFAULT '0',
  `email` varchar(40) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `features_available`
--

CREATE TABLE `features_available` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `default_file` varchar(50) NOT NULL,
  `on_desktop` bit(1) NOT NULL DEFAULT b'1',
  `owner_file` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `features_available`
--

INSERT INTO `features_available` (`id`, `name`, `description`, `default_file`, `on_desktop`, `owner_file`) VALUES
(1, 'navigation', 'Provides the links in the menu bar used to navigate the site.', 'navigation_0_menu_d.php', b'1', 'header'),
(2, 'credit', 'Writes at the bottom of the page the authors of the website.', 'credit_0_footer_d.php', b'1', 'footer'),
(3, 'test', 'Test error to appear on the profile page', 'test_0_profile_d.php', b'1', 'profile'),
(4, 'phonesub', 'Messages shown when a phone subscription error occurs.', 'phonesub_0_index_d.php', b'1', 'index'),
(5, 'phonedisplay', 'Displays a list of the user\'s phone numbers', 'phonedisplay_0_profile_d.php', b'1', 'profile'),
(6, 'addressdisplay', 'Displays the user\'s address', 'addressdisplay_0_profile_d.php', b'1', 'profile'),
(7, 'groupdisplay', 'Displays the groups the user belongs to', 'groupdisplay_0_profile_d.php', b'1', 'profile'),
(8, 'namedisplay', 'Displays the user\'s name on the profile page', 'namedisplay_0_profile_d.php', b'1', 'profile');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `date_established` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `date_established`) VALUES
(1, 'Group A', '2017-03-23 21:40:57'),
(2, 'Group B', '2017-03-23 21:43:25');

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `leader` tinyint(1) DEFAULT '0',
  `date_joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `uid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_members`
--

INSERT INTO `group_members` (`id`, `group_id`, `leader`, `date_joined`, `uid`) VALUES
(1, 1, 1, '2017-03-25 13:10:22', 8),
(14, 2, 1, '2017-04-07 17:48:19', 8);

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` int(11) NOT NULL,
  `title` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `title`) VALUES
(1, 'Not logged in'),
(2, 'Read only'),
(3, 'User'),
(4, 'Super user'),
(5, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `level_privileges`
--

CREATE TABLE `level_privileges` (
  `id` int(11) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `privilege_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mail_address`
--

CREATE TABLE `mail_address` (
  `id` int(11) NOT NULL,
  `state` char(2) DEFAULT NULL,
  `city` varchar(25) DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  `street` varchar(30) DEFAULT NULL,
  `street_num` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail_address`
--

INSERT INTO `mail_address` (`id`, `state`, `city`, `zip`, `street`, `street_num`, `user_id`) VALUES
(1, 'KY', 'Springfield', 12345, 'Evergreen Terrace', 123, 8);

-- --------------------------------------------------------

--
-- Table structure for table `phone_list`
--

CREATE TABLE `phone_list` (
  `id` int(11) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `carrier` varchar(10) DEFAULT NULL,
  `international_code` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phone_list`
--

INSERT INTO `phone_list` (`id`, `phone_number`, `user_id`, `date_added`, `carrier`, `international_code`) VALUES
(2, '8598661142', 8, '2017-04-06 13:55:52', 'VERIZON', '+1'),
(3, '8598661234', 8, '2017-04-06 20:59:51', 'VERIZON', '+1'),
(6, '9876543210', 8, '2017-04-06 21:22:05', 'VERIZON', '+1'),
(7, '3456781234', 8, '2017-04-06 21:32:05', 'VERIZON', '+1'),
(8, '6781234567', 8, '2017-04-06 21:32:53', 'VERIZON', '+1');

-- --------------------------------------------------------

--
-- Table structure for table `privilege_list`
--

CREATE TABLE `privilege_list` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE `subscriber` (
  `phone_number` varchar(20) NOT NULL,
  `carrier` varchar(10) NOT NULL,
  `international_code` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriber`
--

INSERT INTO `subscriber` (`phone_number`, `carrier`, `international_code`) VALUES
('1234567890', 'VERIZON', '1'),
('3456781234', 'VERIZON', '1'),
('6781234567', 'VERIZON', '1'),
('85912345687', 'VERIZON', '1'),
('8593141592', 'VERIZON', '1'),
('98765432', 'VERIZON', '1'),
('9876543210', 'VERIZON', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Email` text NOT NULL,
  `Password` varchar(64) NOT NULL,
  `level` int(11) DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UID`, `Name`, `Email`, `Password`, `level`) VALUES
(1, 'test', '', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 3),
(6, 'test', 'test@test.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 3),
(8, 'John Doe', 'johndoe@example.com', 'f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assigned_features`
--
ALTER TABLE `assigned_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_list`
--
ALTER TABLE `email_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features_available`
--
ALTER TABLE `features_available`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_name` (`name`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `membership` (`group_id`,`uid`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level_privileges`
--
ALTER TABLE `level_privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_address`
--
ALTER TABLE `mail_address`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `phone_list`
--
ALTER TABLE `phone_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_phone_number` (`phone_number`);

--
-- Indexes for table `privilege_list`
--
ALTER TABLE `privilege_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriber`
--
ALTER TABLE `subscriber`
  ADD PRIMARY KEY (`phone_number`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UID`),
  ADD UNIQUE KEY `UID` (`UID`),
  ADD UNIQUE KEY `Email` (`Email`(54));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assigned_features`
--
ALTER TABLE `assigned_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `features_available`
--
ALTER TABLE `features_available`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `level_privileges`
--
ALTER TABLE `level_privileges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mail_address`
--
ALTER TABLE `mail_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `phone_list`
--
ALTER TABLE `phone_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `privilege_list`
--
ALTER TABLE `privilege_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
