-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2021 at 08:20 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ncip_ftms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `list_of_sub_allotments`
--

CREATE TABLE `list_of_sub_allotments` (
  `sub_allot_id` int(11) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `sub_program_id` int(11) NOT NULL,
  `project` varchar(255) NOT NULL,
  `uacs_id` int(11) NOT NULL,
  `responsibility_center` varchar(155) NOT NULL,
  `class_category` varchar(155) NOT NULL,
  `budget` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `list_of_sub_allotments`
--
ALTER TABLE `list_of_sub_allotments`
  ADD PRIMARY KEY (`sub_allot_id`),
  ADD KEY `agency_id` (`agency_id`),
  ADD KEY `program_id` (`program_id`),
  ADD KEY `sub_program_id` (`sub_program_id`),
  ADD KEY `uacs_id` (`uacs_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `list_of_sub_allotments`
--
ALTER TABLE `list_of_sub_allotments`
  MODIFY `sub_allot_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `list_of_sub_allotments`
--
ALTER TABLE `list_of_sub_allotments`
  ADD CONSTRAINT `list_of_sub_allotments_ibfk_1` FOREIGN KEY (`agency_id`) REFERENCES `agency` (`agency_id`),
  ADD CONSTRAINT `list_of_sub_allotments_ibfk_2` FOREIGN KEY (`program_id`) REFERENCES `program` (`program_id`),
  ADD CONSTRAINT `list_of_sub_allotments_ibfk_3` FOREIGN KEY (`sub_program_id`) REFERENCES `sub_program` (`sub_program_id`),
  ADD CONSTRAINT `list_of_sub_allotments_ibfk_4` FOREIGN KEY (`uacs_id`) REFERENCES `chart_of_accounts` (`chart_account_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
