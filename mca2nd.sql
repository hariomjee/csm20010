-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2021 at 10:26 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mca2nd`
--

-- --------------------------------------------------------

--
-- Table structure for table `course_details`
--

CREATE TABLE `course_details` (
  `course_code` varchar(50) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `l` int(11) DEFAULT NULL,
  `t` int(11) DEFAULT NULL,
  `p` int(11) DEFAULT NULL,
  `cr` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_details`
--

INSERT INTO `course_details` (`course_code`, `course_name`, `l`, `t`, `p`, `cr`) VALUES
('CS101', 'C PROGRAMMING', NULL, NULL, NULL, 3),
('CS121', 'JAVA PROGRAMMING', NULL, NULL, NULL, 3),
('CS789', 'MACHINE LEARNING', NULL, NULL, NULL, 3),
('EM222', 'BASIC ENGLISH', NULL, NULL, NULL, 3),
('ET111', 'CUE UNIVERSE', NULL, NULL, NULL, 2),
('MS111', 'ALGEBRA', NULL, NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `user_id` varchar(50) NOT NULL,
  `course_code` varchar(50) NOT NULL,
  `grade` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`user_id`, `course_code`, `grade`) VALUES
('csm20010', 'CS101', 'O'),
('csm20010', 'EM222', NULL),
('csm20010', 'ET111', NULL),
('csm20010', 'MS111', NULL),
('csm20012', 'CS101', 'A+'),
('csm20012', 'ET111', 'O'),
('hari', 'CS789', 'A'),
('hari', 'EM222', NULL),
('hari', 'ET111', 'O');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_name` varchar(32) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `rollno` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_name`, `password`, `fname`, `mname`, `lname`, `rollno`) VALUES
('', '', NULL, NULL, NULL, NULL),
('abc', 'abc', NULL, NULL, NULL, NULL),
('csm20001', '1111', NULL, NULL, NULL, NULL),
('csm20002', '1111', NULL, NULL, NULL, NULL),
('csm20010', '10', 'hari', 'om', 'jee', 'csm20010'),
('csm20012', '12', 'abc', 'd', 'fgh', 'CSM20012'),
('csm20020', '1111', NULL, NULL, NULL, NULL),
('csm20036', '1111', NULL, NULL, NULL, NULL),
('hari', 'om', 'hari om', 'om', 'jee', 'csm20010');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course_details`
--
ALTER TABLE `course_details`
  ADD PRIMARY KEY (`course_code`);

--
-- Indexes for table `student_course`
--
ALTER TABLE `student_course`
  ADD PRIMARY KEY (`user_id`,`course_code`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
