-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2022 at 12:36 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grading`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `courseid` int(11) NOT NULL,
  `department` varchar(225) NOT NULL,
  `coursecode` varchar(10) NOT NULL,
  `coursetitle` varchar(225) NOT NULL,
  `courseunits` int(1) NOT NULL,
  `meritattendance` varchar(3) NOT NULL,
  `studytime` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseid`, `department`, `coursecode`, `coursetitle`, `courseunits`, `meritattendance`, `studytime`) VALUES
(1, 'Computer Science', 'COSC101', 'Introduction to C Programming', 3, '70', '60'),
(2, 'Computer Science', 'COSC201', 'Programming in JAVA', 3, '70', '50'),
(3, 'Computer Science', 'INSY412', 'Internet Technologies', 3, '60', '40');

-- --------------------------------------------------------

--
-- Table structure for table `coursestaken`
--

CREATE TABLE `coursestaken` (
  `id` int(11) NOT NULL,
  `courseid` int(11) NOT NULL,
  `matricno` varchar(10) NOT NULL,
  `attendance` varchar(10) NOT NULL,
  `studytime` varchar(4) NOT NULL,
  `score` varchar(4) NOT NULL,
  `grade` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coursestaken`
--

INSERT INTO `coursestaken` (`id`, `courseid`, `matricno`, `attendance`, `studytime`, `score`, `grade`) VALUES
(1, 1, '19/1111', '68.5', '58', '64', ''),
(2, 2, '19/1111', '69', '53.5', '62', ''),
(3, 3, '19/1111', '64.5', '48.5', '57', '');

-- --------------------------------------------------------

--
-- Table structure for table `predictions`
--

CREATE TABLE `predictions` (
  `id` int(11) NOT NULL,
  `courseid` int(11) NOT NULL,
  `matricno` varchar(10) NOT NULL,
  `attendance` varchar(5) NOT NULL,
  `studytime` varchar(5) NOT NULL,
  `score` varchar(5) NOT NULL,
  `grade` varchar(2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `date_added` varchar(45) NOT NULL,
  `staff` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `predictions`
--

INSERT INTO `predictions` (`id`, `courseid`, `matricno`, `attendance`, `studytime`, `score`, `grade`, `status`, `date_added`, `staff`) VALUES
(1, 2, '19/1111', '69', '53.5', '62', '', 'complete', '2022-02-11 12:25:08', 'jenyo'),
(2, 3, '19/1111', '64.5', '48.5', '57', '', 'complete', '2022-02-11 12:31:18', 'jenyo');

-- --------------------------------------------------------

--
-- Table structure for table `studentdata`
--

CREATE TABLE `studentdata` (
  `stud_id` int(11) NOT NULL,
  `matricno` varchar(10) NOT NULL,
  `department` varchar(200) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `studytime` varchar(50) NOT NULL,
  `attendance` varchar(10) NOT NULL,
  `yearadmitted` varchar(4) NOT NULL,
  `dateadded` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentdata`
--

INSERT INTO `studentdata` (`stud_id`, `matricno`, `department`, `age`, `gender`, `studytime`, `attendance`, `yearadmitted`, `dateadded`) VALUES
(1, '19/1111', 'Computer Science', 23, 'Female', '55', '68', '2017', '2022-01-09 10:45:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(15) NOT NULL,
  `status` varchar(20) NOT NULL,
  `fullname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `role`, `status`, `fullname`) VALUES
(1, 'admin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'admin', 'active', 'Damilola'),
(2, 'staff', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'staff', 'active', 'Damilola'),
(3, 'jenyo', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'staff', 'active', 'Jenyo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseid`);

--
-- Indexes for table `coursestaken`
--
ALTER TABLE `coursestaken`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `predictions`
--
ALTER TABLE `predictions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentdata`
--
ALTER TABLE `studentdata`
  ADD PRIMARY KEY (`stud_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `courseid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coursestaken`
--
ALTER TABLE `coursestaken`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `predictions`
--
ALTER TABLE `predictions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `studentdata`
--
ALTER TABLE `studentdata`
  MODIFY `stud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
