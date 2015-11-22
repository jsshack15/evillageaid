-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 22, 2015 at 12:34 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `healthcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `patient_file`
--

CREATE TABLE IF NOT EXISTS `patient_file` (
  `p_id` varchar(10) NOT NULL,
  `p_name` varchar(30) NOT NULL,
  `gender` text NOT NULL,
  `dob` text NOT NULL,
  `disease` varchar(40) NOT NULL,
  `p_file` longblob NOT NULL,
  `ph_name` varchar(40) NOT NULL,
  `sreport` longblob NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `status` mediumtext NOT NULL,
  `d_name` varchar(25) NOT NULL,
  `ddept` varchar(30) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_file`
--

