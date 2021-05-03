-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 03, 2021 at 12:12 PM
-- Server version: 5.7.33-0ubuntu0.18.04.1
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u_190021247_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `adoption_requests`
--

CREATE TABLE `adoption_requests` (
  `animal_ID` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `adoption_status` varchar(8) NOT NULL DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adoption_requests`
--

INSERT INTO `adoption_requests` (`animal_ID`, `username`, `adoption_status`) VALUES
(19, 'littleangel5', 'ACCEPTED'),
(19, 'test1', 'DENIED'),
(19, 'test2', 'DENIED'),
(20, 'test1', 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `animal_ID` int(11) NOT NULL,
  `animal_name` varchar(16) NOT NULL,
  `date_of_birth` date NOT NULL,
  `description` text NOT NULL,
  `picture` varchar(64) NOT NULL,
  `adopted_username` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`animal_ID`, `animal_name`, `date_of_birth`, `description`, `picture`, `adopted_username`) VALUES
(19, 'example', '2021-04-29', 'This is an example animal he\'s really cute', '1', 'littleangel5'),
(20, 'Chelsie', '2001-03-19', 'Loving black kitten', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(16) NOT NULL,
  `password` varchar(64) NOT NULL,
  `staff` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `staff`) VALUES
('littleangel5', '0692472251aa0ae25defcd6025d9c84c6a8bcb8d02a7517a3a2bc054dba1345b', NULL),
('SenseiJu', 'abf407d5e9347755f8f297010fdbcd64a69e0fb083396275fdf9052c1c313a51', NULL),
('staff', '1562206543da764123c21bd524674f0a8aaf49c8a89744c97352fe677f7e4006', 1),
('test1', '1b4f0e9851971998e732078544c96b36c3d01cedf7caa332359d6f1d83567014', NULL),
('test2', '60303ae22b998861bce3b28f33eec1be758a213c86c93c076dbe9f558c11c752', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adoption_requests`
--
ALTER TABLE `adoption_requests`
  ADD PRIMARY KEY (`animal_ID`,`username`) USING BTREE,
  ADD KEY `username` (`username`);

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`animal_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `animal_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adoption_requests`
--
ALTER TABLE `adoption_requests`
  ADD CONSTRAINT `adoption_requests_ibfk_1` FOREIGN KEY (`animal_ID`) REFERENCES `animals` (`animal_ID`),
  ADD CONSTRAINT `adoption_requests_ibfk_2` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
