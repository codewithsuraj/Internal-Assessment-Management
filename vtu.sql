-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2019 at 05:38 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vtu`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `staffID` varchar(10) NOT NULL,
  `grade` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`staffID`, `grade`) VALUES
('cs001', 4),
('cs001', 5),
('cs002', 2),
('cs001', 1),
('cs001', 1),
('cs002', 5),
('cs004', 5),
('cs004', 4),
('cs005', 5),
('cs005', 4);

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `usn` varchar(11) NOT NULL,
  `ia` int(2) NOT NULL,
  `s1` int(2) NOT NULL,
  `s2` int(2) NOT NULL,
  `s3` int(2) NOT NULL,
  `s4` int(2) NOT NULL,
  `s5` int(2) NOT NULL,
  `s6` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`usn`, `ia`, `s1`, `s2`, `s3`, `s4`, `s5`, `s6`) VALUES
('2ka17cs003', 1, 22, 21, 12, 1, 21, 11),
('2ka17cs003', 2, 22, 13, 28, 87, 81, 12),
('2ka17cs003', 3, 10, 12, 12, 12, 12, 12),
('2ka17cs026', 1, 12, 2, 15, 3, 4, 8),
('2ka17cs026', 2, 20, 3, 2, 2, 6, 7),
('2ka17cs026', 3, 30, 1, 1, 1, 1, 1),
('2ka17cs001', 1, 12, 23, 30, 23, 11, 11),
('2ka17cs001', 2, 2, 2, 2, 2, 2, 12);

-- --------------------------------------------------------

--
-- Table structure for table `scheme`
--

CREATE TABLE `scheme` (
  `id` int(5) NOT NULL,
  `name` varchar(20) NOT NULL,
  `size` int(10) NOT NULL,
  `sscheme` int(5) NOT NULL,
  `sem` int(2) NOT NULL,
  `subject` varchar(5) NOT NULL,
  `ia` int(2) NOT NULL,
  `staffID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scheme`
--

INSERT INTO `scheme` (`id`, `name`, `size`, `sscheme`, `sem`, `subject`, `ia`, `staffID`) VALUES
(1, '12 Marks Card (3).pd', 282114, 2017, 5, 'sub1', 1, 'cs004'),
(2, '10 Marks Card.pdf', 435718, 2017, 5, 'sub1', 1, 'cs005');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `username` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phno` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`username`, `password`, `name`, `email`, `phno`) VALUES
('cs001', 'MTIz', 'Priyank Mathapati', 'priyank@gmail.com', 1234567899),
('cs002', 'MTIz', 'Nagraj Telkar', 'nagraj@gamil.com', 9966322558),
('cs003', 'MTIz', 'Null', 'Null', 0),
('cs004', 'MTIz', 'Pavan Sir', 'pavan@gamil.com', 2556987745);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `username` varchar(11) NOT NULL,
  `password` varchar(20) NOT NULL,
  `scheme` int(5) NOT NULL,
  `sem` int(2) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `pemail` varchar(40) NOT NULL,
  `phno` bigint(10) NOT NULL,
  `branch` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`username`, `password`, `scheme`, `sem`, `name`, `email`, `pemail`, `phno`, `branch`) VALUES
('2ka17cs001', 'MTIzNDU2', 2017, 5, 'Akash', 'mail2surajmahendrakar@gmail.com', 'mail2pradeepg1@gmail.com', 9665589562, 'CSE'),
('2ka17cs002', 'MTIz', 2017, 5, 'Null', 'Null', 'Null', 0, 'CSE'),
('2ka17cs003', 'MTIz', 2017, 5, 'Null', 'Null', 'Null', 0, 'CSE'),
('2ka17cs004', 'MTIz', 2017, 5, 'Null', 'Null', 'Null', 0, 'CSE'),
('2ka17cs005', 'MTIz', 2017, 5, 'Null', 'Null', 'Null', 0, 'CSE'),
('2ka17cs026', 'MTIz', 2016, 7, 'Pradeep Ganger', 'pg995212@gmail.com', 'mail2surajmahendrakar@gmail.com', 2147483641, 'CSE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scheme`
--
ALTER TABLE `scheme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `scheme`
--
ALTER TABLE `scheme`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
