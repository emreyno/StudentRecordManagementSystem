-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2022 at 08:08 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dsms`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `course_num` int(11) NOT NULL,
  `course_description` varchar(100) DEFAULT NULL,
  `course_title` varchar(20) NOT NULL,
  `course_year` varchar(255) DEFAULT NULL,
  `course_sem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `course_num`, `course_description`, `course_title`, `course_year`, `course_sem`) VALUES
(10, 389211, 'Numerical Analysis I', 'MATH 174', '2013-2014', '1st'),
(12, 40804, 'Analytic Geometry and Calculus II', 'MATH 27', '2013-2014', '1st'),
(13, 41760, 'Algebra and \r\nTrigonometry', 'MATH 17', '2013-2014', '1st'),
(19, 31345, 'Mathematics, Culture and Society', 'MATH 10', '2014-2015', '2nd'),
(20, 23124, 'Finite Mathematics', 'AMAT 19', '2014-2015', '2nd'),
(21, 42132, 'College Geometry', 'MATH 18', '2015-2016', '2nd'),
(22, 13212, 'Fundamental Calculus', 'MATH 25', '2015-2016', '2nd'),
(23, 12312, 'Linear Programming', 'AMAT 160', '2013-2014', '2nd'),
(24, 31931, 'Integer and Dynamic Programming', 'AMAT 162', '2013-2014', '2nd'),
(26, 23123, 'College Algebra', 'MATH 11', '2015-2016', '1st'),
(27, 31231, 'Plane Trigonometry', 'MATH 14', '2016-2017', '2nd');

-- --------------------------------------------------------

--
-- Table structure for table `enrolled`
--

CREATE TABLE `enrolled` (
  `enrolled_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `stud_num` varchar(15) NOT NULL,
  `final_grade` decimal(10,2) DEFAULT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Pending',
  `course_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrolled`
--

INSERT INTO `enrolled` (`enrolled_id`, `class_id`, `stud_num`, `final_grade`, `status`, `course_number`) VALUES
(44, 12, '2012-02458', '4.00', 'Pending', 40804),
(73, 13, '200964452', '3.00', 'Complete', 41760),
(75, 12, '200919882', '0.00', 'Pending', 40804),
(76, 12, '200929173', '0.00', 'Pending', 40804),
(127, 13, '200949067', '3.00', 'Complete', 41760),
(135, 13, '200917160', '2.25', 'Complete', 41760),
(140, 13, '200919292', '2.75', 'Complete', 41760),
(141, 13, '200900624\r\n', '2.25', 'Complete', 41760),
(142, 13, '200930348', '2.25', 'Complete', 41760),
(143, 13, '200929173', '2.50', 'Complete', 41760),
(144, 13, '200919882', '0.00', 'Pending', 41760),
(145, 13, '200947765', '0.00', 'Pending', 41760),
(146, 13, '200946618', '0.00', 'Pending', 41760),
(155, 12, '200919292', '0.00', 'Pending', 40804),
(156, 19, '200919292', '0.00', 'Pending', 31345),
(168, 21, '200900624\r\n', '0.00', 'Pending', 42132),
(169, 12, '201255150', '0.00', 'Pending', 40804),
(171, 10, '201051777', '0.00', 'Pending', 389211),
(172, 12, '201100816', '0.00', 'Pending', 40804),
(173, 22, '201239585', '0.00', 'Pending', 13212),
(175, 10, '201255150', '0.00', 'Pending', 389211);

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `log_name` varchar(255) NOT NULL,
  `log_status` varchar(255) NOT NULL,
  `log_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `action` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`log_name`, `log_status`, `log_time`, `action`) VALUES
('neil@gmail.com', 'admin', '2022-06-13 17:44:11', 'Cleared History Log'),
('neil@gmail.com', 'admin', '2022-06-13 17:48:16', 'Edited Grade For Wendy Guerrero Baos in Course MATH 174'),
('neil@gmail.com', 'admin', '2022-06-13 17:48:26', 'Edited Grade For Ariana  Simon Talavera in Course MATH 174'),
('neil@gmail.com', 'admin', '2022-06-13 17:48:32', 'Edited Grade For Ariana  Simon Talavera in Course MATH 174'),
('neil@gmail.com', 'admin', '2022-06-13 17:48:35', 'Edited Grade For Ariana  Simon Talavera in Course MATH 174'),
('neil@gmail.com', 'admin', '2022-06-13 17:48:44', 'Edited Grade For Ariana  Simon Talavera in Course MATH 174'),
('neil@gmail.com', 'admin', '2022-06-13 17:48:50', 'Edited Grade For Ariana  Simon Talavera in Course MATH 174'),
('neil@gmail.com', 'admin', '2022-06-13 17:48:59', 'Edited Grade For Ariana  Simon Talavera in Course MATH 174'),
('neil@gmail.com', 'admin', '2022-06-13 17:49:03', 'Edited Grade For Ariana  Simon Talavera in Course MATH 174'),
('neil@gmail.com', 'admin', '2022-06-13 17:49:09', 'Edited Grade For Ariana  Simon Talavera in Course MATH 174'),
('neil@gmail.com', 'admin', '2022-06-13 17:51:32', 'Edited Grade For Wendy Guerrero Baos in Course MATH 174'),
('neil@gmail.com', 'admin', '2022-06-13 17:51:38', 'Edited Grade For Wendy Guerrero Baos in Course MATH 174'),
('neil@gmail.com', 'admin', '2022-06-13 17:52:05', 'Edited Grade For Ariana  Simon Talavera in Course MATH 174'),
('neil@gmail.com', 'admin', '2022-06-13 17:54:25', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:25', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:25', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:25', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:25', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:25', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:25', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:25', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:25', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:25', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:25', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:25', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:25', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:25', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:25', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:25', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:25', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:26', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:26', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:26', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:27', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:27', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:27', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:27', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:27', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:27', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:27', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:27', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:27', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:27', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:27', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:28', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:28', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:28', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:28', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:28', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:28', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:28', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:28', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:28', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:33', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:33', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:33', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:33', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:33', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:33', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:33', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:33', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:33', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:34', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:34', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:34', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:34', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:34', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:34', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:34', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:34', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:34', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:34', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:54:34', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:44', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:44', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:44', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:45', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:45', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:45', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:45', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:45', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:45', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:45', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:45', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:45', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:45', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:45', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:45', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:45', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:45', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:45', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:45', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:45', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:46', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:47', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:47', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:47', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:47', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:47', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:47', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:47', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:47', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:47', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:47', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:47', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:47', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:47', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:47', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:47', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:47', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:47', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:47', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:47', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:52', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:52', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:53', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:53', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:53', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:53', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:53', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:53', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:53', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:53', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:53', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:53', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:53', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:53', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:53', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:53', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:53', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:53', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:53', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 17:55:53', 'Added New Student - [] '),
('neil@gmail.com', 'admin', '2022-06-13 18:01:02', 'Edited Grade For Wendy Guerrero Baos in Course MATH 174');

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE `reminder` (
  `reminder_id` int(10) NOT NULL,
  `reminder_title` varchar(50) DEFAULT NULL,
  `reminder_content` text DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`reminder_id`, `reminder_title`, `reminder_content`, `ts`) VALUES
(3, 'First Note', 'first note . . .', '2022-06-13 01:20:36');

-- --------------------------------------------------------

--
-- Table structure for table `removal_grade`
--

CREATE TABLE `removal_grade` (
  `removal_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `stud_num` varchar(15) NOT NULL,
  `initial_grade` decimal(10,2) DEFAULT NULL,
  `removal_grade` decimal(10,2) DEFAULT NULL,
  `removal_status` varchar(15) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE `school_year` (
  `sy_id` int(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Ongoing'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stud_num` varchar(15) NOT NULL,
  `degreeProg` varchar(100) NOT NULL,
  `college` varchar(100) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `m_name` varchar(30) NOT NULL,
  `l_name` varchar(20) NOT NULL,
  `sex` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stud_num`, `degreeProg`, `college`, `f_name`, `m_name`, `l_name`, `sex`) VALUES
('200900491', 'BS Applied Mathematics', 'CAS', 'Delia ', 'Salcido', 'Espindola', 'female'),
('200900624\r\n', 'BS Computer Science', 'CAS', 'Bradley', 'Johnson', 'Sengun', 'male'),
('200917160', 'BS Mathematics', 'CAS', 'Juliane', 'Faraco', 'Maranda', 'female'),
('200919292', 'BS Chemical Engineering', 'CEAT', 'Mauricio', 'Wasko', 'Manuel', 'male'),
('200919882', 'BS Chemical Engineering', 'CEAT', 'Omar ', 'Cinthya ', 'Bernal', 'male'),
('200929173', 'BS Applied Mathematics', 'CAS', 'Carter', 'Jerrod', 'Laurita', 'male'),
('200930348', 'BS Computer Science', 'CAS', 'Terri', 'Loris', 'Gulling', 'female'),
('200946618', 'BS Electrical Engineering', 'CEAT', 'Sandy ', 'Velazquez', 'Dolores', 'female'),
('200947765', 'BS Chemical Engineering', 'CEAT', 'Teresa ', 'Castañon', 'Sanabria', 'female'),
('200949067', 'BS Electrical Engineering', 'CEAT', 'Phillip ', 'Gerardo', 'Valgren', 'male'),
('200964452', 'BS Agricultural and Biosystems Engineering', 'CEAT', 'Gabriela ', 'Maya', 'Ugalde', 'female'),
('201004916', 'BS Food Technology', 'CAFS', 'Zenon ', 'Cruz', 'Trujillo', 'male'),
('201051246', 'BS Food Technology', 'CAFS', 'Aurea ', 'Dorantes', 'de Leon', 'female'),
('201051777', 'BS Mathematics', 'CAS', 'Ariana ', 'Simon', 'Talavera', 'female'),
('201100816', 'BS Mathematics', 'CAS', 'Yuridia ', 'Fonseca', 'Espinoza', 'female'),
('201118408', 'BS Agricultural Biotechnology', 'CAS', 'Michel', 'Angeles', 'Nolasco', 'female'),
('201122464', 'BS Mathematics and Science Teaching', 'CAS', 'Rebeca', 'Solorio', 'Catalan', 'female'),
('201122682', 'BS Mathematics', 'CAS', 'Erica ', 'Estrella', 'Leon', 'female'),
('201133633', 'BS Mathematics', 'CAS', 'Rey ', 'Noriega', 'Nieves', 'male'),
('201154401', 'BS Mathematics', 'CAS', 'Justo ', 'Avila', 'Mancilla', 'male'),
('201162167', 'BS Mathematics', 'CAS', 'Luciano ', 'Orta', 'Gordillo', 'male'),
('201162244', 'BS Applied Mathematics', 'CAS', 'Nestor ', 'Pion', 'Rubio', 'male'),
('201162335', 'BS Applied Mathematics', 'CAS', 'Marcelo ', 'Cazarez', 'Jose', 'male'),
('201163556', 'BS Mathematics', 'CAS', 'Adriana ', 'Manrique', 'Laguna', 'female'),
('201197505', 'BS Food Technology', 'CAFS', 'Cinthya ', 'Calvo', 'Morelos', 'female'),
('2012-02458', 'BS Computer Science', 'CAS', 'Damaris ', 'Padilla', 'Zarco', 'female'),
('201213487', 'BS Agricultural and Biosystems Engineering', 'CEAT', 'Javier ', 'Cervantes', 'Chavez', 'male'),
('201229808', 'BS Computer Science', 'CAS', 'Alonso ', 'Uicab', 'Ventura', 'male'),
('201239585', 'BS Computer Science', 'CAS', 'Dalia ', 'Cobos', 'Ordaz', 'female'),
('201255150', 'BS Agricultural and Biosystems Engineering', 'CEAT', 'Wendy', 'Guerrero', 'Baos', 'female');

-- --------------------------------------------------------

--
-- Table structure for table `taken`
--

CREATE TABLE `taken` (
  `sy_id` int(10) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` text NOT NULL DEFAULT 'assistant'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'alo', 'alo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'assistant'),
(5, 'neil', 'neil@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin'),
(6, 'alo1', 'alo1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'assistant'),
(7, 'alo2', 'alo2@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'assistant'),
(8, 'alo0', 'alo0@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'assistant');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `enrolled`
--
ALTER TABLE `enrolled`
  ADD PRIMARY KEY (`enrolled_id`),
  ADD UNIQUE KEY `stud_num_2` (`stud_num`,`class_id`),
  ADD KEY `stud_num` (`stud_num`),
  ADD KEY `enrolled_ibfk_2` (`class_id`);

--
-- Indexes for table `reminder`
--
ALTER TABLE `reminder`
  ADD PRIMARY KEY (`reminder_id`);

--
-- Indexes for table `removal_grade`
--
ALTER TABLE `removal_grade`
  ADD PRIMARY KEY (`removal_id`),
  ADD UNIQUE KEY `stud_num` (`stud_num`,`class_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `school_year`
--
ALTER TABLE `school_year`
  ADD PRIMARY KEY (`sy_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stud_num`);

--
-- Indexes for table `taken`
--
ALTER TABLE `taken`
  ADD PRIMARY KEY (`sy_id`,`class_id`),
  ADD KEY `class_id` (`class_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `enrolled`
--
ALTER TABLE `enrolled`
  MODIFY `enrolled_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `reminder`
--
ALTER TABLE `reminder`
  MODIFY `reminder_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `removal_grade`
--
ALTER TABLE `removal_grade`
  MODIFY `removal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `sy_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrolled`
--
ALTER TABLE `enrolled`
  ADD CONSTRAINT `enrolled_ibfk_1` FOREIGN KEY (`stud_num`) REFERENCES `student` (`stud_num`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enrolled_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `removal_grade`
--
ALTER TABLE `removal_grade`
  ADD CONSTRAINT `removal_grade_ibfk_1` FOREIGN KEY (`stud_num`) REFERENCES `enrolled` (`stud_num`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `removal_grade_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `enrolled` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `taken`
--
ALTER TABLE `taken`
  ADD CONSTRAINT `taken_ibfk_1` FOREIGN KEY (`sy_id`) REFERENCES `school_year` (`sy_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `taken_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
