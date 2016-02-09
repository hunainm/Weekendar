-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2015 at 11:44 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


use week;--
-- Database: `week`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(50) NOT NULL,
  `taught_by` int(11) NOT NULL,
  `bg_color` varchar(20) DEFAULT NULL,
  `fore_color` varchar(20) DEFAULT NULL,
  `css_top` varchar(10) NOT NULL,
  `css_left` varchar(10) NOT NULL,
  `on_day` int(11) DEFAULT NULL,
  `width` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`class_id`),
  KEY `taught_by` (`taught_by`),
  KEY `for_key` (`on_day`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=151 ;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_name`, `taught_by`, `bg_color`, `fore_color`, `css_top`, `css_left`, `on_day`, `width`) VALUES
(149, 'Swim Level 1', 1, 'rgb(252, 248, 227)', 'rgb(192, 152, 83)', 'auto', 'auto', 7, '120px'),
(150, 'Swim Level 3', 1, 'rgb(252, 248, 227)', 'rgb(192, 152, 83)', '2px', '175px', 7, '120px');

-- --------------------------------------------------------

--
-- Table structure for table `classes_lst`
--

CREATE TABLE IF NOT EXISTS `classes_lst` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(30) NOT NULL,
  `class_bgcolor` varchar(20) DEFAULT NULL,
  `class_forecolor` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `classes_lst`
--

INSERT INTO `classes_lst` (`class_id`, `class_name`, `class_bgcolor`, `class_forecolor`) VALUES
(1, 'Sad Class', '#fcf8e3', 'black'),
(2, 'Happy Class', '#fcf8e3', 'black');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE IF NOT EXISTS `days` (
  `day_id` int(11) NOT NULL,
  `day_name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`day_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`day_id`, `day_name`) VALUES
(1, 'monday'),
(2, 'tuesday'),
(3, 'wednesday'),
(4, 'thursday'),
(5, 'friday'),
(6, 'saturday'),
(7, 'sunday');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_name` varchar(25) DEFAULT NULL,
  `bg_color` varchar(20) DEFAULT NULL,
  `fore_color` varchar(20) DEFAULT NULL,
  `on_day` int(11) DEFAULT NULL,
  `css_top` varchar(10) NOT NULL,
  `css_left` varchar(10) NOT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=118 ;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `teacher_name`, `bg_color`, `fore_color`, `on_day`, `css_top`, `css_left`) VALUES
(116, 'Teacher A', 'rgb(252, 248, 227)', 'rgb(192, 152, 83)', 7, 'auto', 'auto'),
(117, 'Teacher A', 'rgb(252, 248, 227)', 'rgb(192, 152, 83)', 7, 'auto', 'auto');

-- --------------------------------------------------------

--
-- Table structure for table `teachers_lst`
--

CREATE TABLE IF NOT EXISTS `teachers_lst` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_name` varchar(30) NOT NULL,
  `teacher_bgcolor` varchar(20) NOT NULL,
  `teacher_forecolor` varchar(20) NOT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `teachers_lst`
--

INSERT INTO `teachers_lst` (`teacher_id`, `teacher_name`, `teacher_bgcolor`, `teacher_forecolor`) VALUES
(1, 'Sami', '#fcf8e3', 'black'),
(2, 'Hunain', '#fcf8e3', 'black');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `for_key` FOREIGN KEY (`on_day`) REFERENCES `days` (`day_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
