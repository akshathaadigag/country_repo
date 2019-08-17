-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2019 at 05:46 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `country`
--

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Code1` varchar(100) NOT NULL,
  `Code2` varchar(100) NOT NULL,
  `Capital` varchar(100) NOT NULL,
  `Currency` varchar(100) NOT NULL,
  `Language` varchar(100) NOT NULL,
  `Calling_Code` varchar(100) NOT NULL,
  `Region` varchar(100) NOT NULL,
  `Timezone` varchar(100) NOT NULL,
  `Flag` varchar(100) NOT NULL,
  `Status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0-Not updated by api,1-Updated by api'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`Id`, `Name`, `Code1`, `Code2`, `Capital`, `Currency`, `Language`, `Calling_Code`, `Region`, `Timezone`, `Flag`, `Status`) VALUES
(1, 'India', '', '', 'New Delhi', 'INR', '', '91', 'Asia', 'UTC+05:30', 'https://restcountries.eu/data/ind.svg', '1'),
(2, 'Armenia', 'am', 'amm', 'Bangalore', 'rr', 'Kannada', '374', 'Asia', 'UTC+04:00', 'https://restcountries.eu/data/arm.svg', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
