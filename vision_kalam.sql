-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 31, 2017 at 09:13 AM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vision_kalam`
--

-- --------------------------------------------------------

--
-- Table structure for table `Contributer_DB`
--

CREATE TABLE `Contributer_DB` (
  `contributer_id` int(11) NOT NULL,
  `contributer_name` varchar(100) NOT NULL,
  `contributer_email` varchar(100) NOT NULL,
  `contributer_password` varchar(100) NOT NULL,
  `contributer_job` varchar(100) NOT NULL,
  `contributer_organization` varchar(100) NOT NULL,
  `contributer_join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contributer_unique_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Post_DB`
--

CREATE TABLE `Post_DB` (
  `post_id` int(11) NOT NULL,
  `post_link` varchar(300) NOT NULL,
  `post_subject` varchar(300) NOT NULL,
  `post_views` int(11) NOT NULL DEFAULT '0',
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_status` int(1) NOT NULL DEFAULT '0',
  `student_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Student_DB`
--

CREATE TABLE `Student_DB` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_email` varchar(100) NOT NULL,
  `student_password` varchar(100) NOT NULL,
  `student_birth_year` int(11) NOT NULL DEFAULT '2003',
  `student_state` int(3) NOT NULL DEFAULT '1',
  `student_pin` int(6) NOT NULL DEFAULT '123456',
  `student_school_address` varchar(300) NOT NULL DEFAULT 'qwerty',
  `student_join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `student_unique_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Contributer_DB`
--
ALTER TABLE `Contributer_DB`
  ADD PRIMARY KEY (`contributer_id`,`contributer_email`),
  ADD UNIQUE KEY `contributor_unique_id` (`contributer_unique_id`);

--
-- Indexes for table `Post_DB`
--
ALTER TABLE `Post_DB`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `Student_DB`
--
ALTER TABLE `Student_DB`
  ADD PRIMARY KEY (`student_id`,`student_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Contributer_DB`
--
ALTER TABLE `Contributer_DB`
  MODIFY `contributer_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Post_DB`
--
ALTER TABLE `Post_DB`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Student_DB`
--
ALTER TABLE `Student_DB`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
