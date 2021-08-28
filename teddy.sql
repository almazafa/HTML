-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2019 at 03:04 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teddy`
--

-- --------------------------------------------------------

--
-- Table structure for table `dog`
--

CREATE TABLE `dog` (
  `d_id` int(11) UNSIGNED NOT NULL,
  `d_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `d_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `d_image` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dog`
--

INSERT INTO `dog` (`d_id`, `d_name`, `d_address`, `d_image`) VALUES
(1, 'Teddy', 'Israel', ''),
(2, 'Mushmush', 'Tel Aviv', '');

-- --------------------------------------------------------

--
-- Table structure for table `e_event`
--

CREATE TABLE `e_event` (
  `e_id` int(11) UNSIGNED NOT NULL,
  `e_dog_id` int(11) UNSIGNED NOT NULL,
  `e_dtime` int(2) NOT NULL,
  `e_desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `e_event`
--

INSERT INTO `e_event` (`e_id`, `e_dog_id`, `e_dtime`, `e_desc`) VALUES
(1, 1, 10, 'Morning walk'),
(2, 1, 12, 'Food (a cup)'),
(3, 1, 15, 'Short walk after eating'),
(4, 1, 19, 'Evening walk'),
(5, 2, 14, 'Noon walk');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `l_id` int(11) UNSIGNED NOT NULL,
  `l_dog_id` int(11) UNSIGNED NOT NULL,
  `l_user_id` int(11) UNSIGNED NOT NULL,
  `l_event` int(11) UNSIGNED NOT NULL,
  `l_datetime` datetime NOT NULL,
  `l_desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`l_id`, `l_dog_id`, `l_user_id`, `l_event`, `l_datetime`, `l_desc`) VALUES
(1, 1, 1, 1, '2019-06-21 10:01:00', 'He vomited'),
(3, 1, 1, 2, '2019-06-21 14:10:00', 'LATE !!!');

-- --------------------------------------------------------

--
-- Table structure for table `s_event`
--

CREATE TABLE `s_event` (
  `s_id` int(11) UNSIGNED NOT NULL,
  `s_dog_id` int(11) UNSIGNED NOT NULL,
  `s_datetime` datetime NOT NULL,
  `s_desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `s_status` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `s_event`
--

INSERT INTO `s_event` (`s_id`, `s_dog_id`, `s_datetime`, `s_desc`, `s_status`) VALUES
(1, 1, '2019-06-21 18:30:00', 'Get pills against fleas', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(11) UNSIGNED NOT NULL,
  `u_login` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `u_pname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `u_fname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `u_password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `u_phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `u_mail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `u_owner` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_login`, `u_pname`, `u_fname`, `u_password`, `u_phone`, `u_mail`, `u_owner`) VALUES
(1, 'gk', 'gideon', 'kcoh', '1234', '037688704', 'gideonk@afeka.ac.il', 0),
(7, 'johnd', 'John', 'Dow', 'abcd', '037687766', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `u_d`
--

CREATE TABLE `u_d` (
  `u_id` int(11) UNSIGNED NOT NULL,
  `d_id` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `u_d`
--

INSERT INTO `u_d` (`u_id`, `d_id`) VALUES
(1, 1),
(7, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dog`
--
ALTER TABLE `dog`
  ADD PRIMARY KEY (`d_id`),
  ADD KEY `d_name` (`d_name`),
  ADD KEY `d_name_2` (`d_name`);

--
-- Indexes for table `e_event`
--
ALTER TABLE `e_event`
  ADD PRIMARY KEY (`e_id`),
  ADD KEY `e_dog_id` (`e_dog_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`l_id`),
  ADD KEY `l_dog_id` (`l_dog_id`),
  ADD KEY `l_user_id` (`l_user_id`);

--
-- Indexes for table `s_event`
--
ALTER TABLE `s_event`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `s_dog_id` (`s_dog_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `u_fname` (`u_fname`),
  ADD KEY `u_fname_2` (`u_fname`),
  ADD KEY `u_phone` (`u_phone`);

--
-- Indexes for table `u_d`
--
ALTER TABLE `u_d`
  ADD KEY `u_id` (`u_id`),
  ADD KEY `d_id` (`d_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dog`
--
ALTER TABLE `dog`
  MODIFY `d_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `e_event`
--
ALTER TABLE `e_event`
  MODIFY `e_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `l_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `s_event`
--
ALTER TABLE `s_event`
  MODIFY `s_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
