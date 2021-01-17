-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2020 at 10:55 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `records`
--

-- --------------------------------------------------------

--
-- Table structure for table `groupmail`
--

CREATE TABLE `groupmail` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `enddate` date NOT NULL,
  `rent` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groupmail`
--

INSERT INTO `groupmail` (`id`, `username`, `name`, `email`, `enddate`, `rent`) VALUES
(1, 'gurleen123', 'gurleen bindra', 'gurleenbindra1999@gmail.com', '2020-07-17', 2000),
(2, 'rishita123', 'harpreet kaur', 'harpreetbindra91@gmail.com', '2020-07-18', 8000),
(3, 'shradha123', 'shradha ahuja', 'shradhaahuja18@gmail.com', '2020-07-16', 10000),
(4, 'harpreet123', 'harpreet kaur', 'harpreetbindra1972@gmail.com', '2020-07-20', 6000),
(5, 'vashist.giit@gmail.com', 'Mr. Vashist', 'vashist.giit@gmail.com', '2020-07-17', 12000);

-- --------------------------------------------------------

--
-- Table structure for table `leaserecords`
--

CREATE TABLE `leaserecords` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(70) NOT NULL,
  `phoneno` varchar(10) NOT NULL,
  `leasedate` date NOT NULL,
  `enddate` date NOT NULL,
  `equipment` varchar(30) NOT NULL,
  `period` varchar(14) NOT NULL,
  `rent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leaserecords`
--

INSERT INTO `leaserecords` (`id`, `username`, `name`, `address`, `phoneno`, `leasedate`, `enddate`, `equipment`, `period`, `rent`) VALUES
(1, 'rashi', 'Garima', 'ayodhya', '2147483647', '2020-07-07', '2020-08-15', 'Treadmill Pro 400', '4 weeks', 7000),
(2, 'rashi122', 'Mr. arora', '123,karol,agra', '7864832199', '2020-07-29', '2020-09-05', 'cross trainer', '8 weeks', 10000),
(3, 'happy1234', 'Shradha ', 'kamra no.1,UP', '9843215687', '2020-07-08', '2020-08-02', 'truck', '4 weeks', 12000),
(4, 'ria123456', 'Mr.  Shiv Kumar', 'hyderabad', '2147483647', '2020-07-25', '2020-08-21', 'bicycle', '12 weeks', 10000),
(5, 'user5', 'preetika', 'jammu', '7845732891', '2020-07-11', '2020-08-01', 'cross trainer', '21 weeks', 40000),
(6, 'manoj1234', 'manoj', '123,Dayalbagh,Gurugram', '1234567890', '2020-06-19', '2020-07-13', 'twister', '6 weeks', 9000),
(7, 'kamlesh123', 'Mr. Kamlesh', 'xyz,mallapuram,haryana', '7890654352', '2020-07-13', '2020-08-27', 'machinery', '7 weeks', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE `mail` (
  `lone` varchar(70) NOT NULL,
  `ltwo` varchar(70) NOT NULL,
  `lthree` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`lone`, `ltwo`, `lthree`) VALUES
('HELLO,My Name is', '', ''),
('you have to pay Rs.', 'to continue with the package further', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groupmail`
--
ALTER TABLE `groupmail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaserecords`
--
ALTER TABLE `leaserecords`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groupmail`
--
ALTER TABLE `groupmail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leaserecords`
--
ALTER TABLE `leaserecords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
