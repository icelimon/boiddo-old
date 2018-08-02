-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Aug 11, 2016 at 12:58 PM
-- Server version: 5.6.30
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+06:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `boiddoco_boiddo`
--

-- --------------------------------------------------------

--
-- Table structure for table `ambulances`
--

CREATE TABLE IF NOT EXISTS `ambulances` (
  `ambulance_id` int(16) NOT NULL AUTO_INCREMENT,
  `ambulance_username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `ambulance_email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `ambulance_password` text COLLATE utf8_unicode_ci NOT NULL,
  `ambulance_esmonth` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `ambulance_esday` int(4) NOT NULL,
  `ambulance_esyear` int(6) NOT NULL,
  `ambulance_postcode` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `ambulance_country` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `joindate` datetime NOT NULL,
  `activated` int(1) NOT NULL,
  `ip` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `lastlogin` datetime NOT NULL,
  `com_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ambulance_id`),
  UNIQUE KEY `ambulance_id` (`ambulance_id`),
  UNIQUE KEY `ambulance_username` (`ambulance_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ambulances_options`
--

CREATE TABLE IF NOT EXISTS `ambulances_options` (
  `ambulance_id` int(16) NOT NULL AUTO_INCREMENT,
  `ambulance_username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `image` blob NOT NULL,
  `img_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `ambulance_question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ambulance_answer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `temp_pass` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ambulance_id`),
  UNIQUE KEY `ambulance_username` (`ambulance_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `company_id` int(16) NOT NULL AUTO_INCREMENT,
  `company_username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `company_email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `company_password` text COLLATE utf8_unicode_ci NOT NULL,
  `company_esmonth` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `company_esday` int(4) NOT NULL,
  `company_esyear` int(6) NOT NULL,
  `company_postcode` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `company_country` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `joindate` datetime NOT NULL,
  `activated` int(1) NOT NULL,
  `ip` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `lastlogin` datetime NOT NULL,
  `com_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`company_id`),
  UNIQUE KEY `company_id` (`company_id`),
  UNIQUE KEY `company_username` (`company_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `companies_options`
--

CREATE TABLE IF NOT EXISTS `companies_options` (
  `company_id` int(16) NOT NULL AUTO_INCREMENT,
  `company_username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `image` blob NOT NULL,
  `img_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `company_question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_answer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `temp_pass` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`company_id`),
  UNIQUE KEY `company_username` (`company_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `diagnostics`
--

CREATE TABLE IF NOT EXISTS `diagnostics` (
  `diagnostic_id` int(16) NOT NULL AUTO_INCREMENT,
  `diagnostic_username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `diagnostic_email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `diagnostic_password` text COLLATE utf8_unicode_ci NOT NULL,
  `diagnostic_esmonth` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `diagnostic_esday` int(4) NOT NULL,
  `diagnostic_esyear` int(6) NOT NULL,
  `diagnostic_postcode` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `diagnostic_country` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `joindate` datetime NOT NULL,
  `activated` int(1) NOT NULL,
  `ip` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `lastlogin` datetime NOT NULL,
  `com_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`diagnostic_id`),
  UNIQUE KEY `diagnostic_id` (`diagnostic_id`),
  UNIQUE KEY `diagnostic_username` (`diagnostic_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `diagnostics_options`
--

CREATE TABLE IF NOT EXISTS `diagnostics_options` (
  `diagnostic_id` int(16) NOT NULL AUTO_INCREMENT,
  `diagnostic_username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `image` blob NOT NULL,
  `img_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `diagnostic_question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diagnostic_answer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `temp_pass` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`diagnostic_id`),
  UNIQUE KEY `diagnostic_username` (`diagnostic_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE IF NOT EXISTS `doctors` (
  `doctor_id` int(16) NOT NULL AUTO_INCREMENT,
  `doctor_username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `profile` bigint(32) NOT NULL,
  `doctor_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_password` text COLLATE utf8_unicode_ci NOT NULL,
  `doctor_birthday` date NOT NULL,
  `doctor_sex` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_postcode` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_country` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `joindate` date NOT NULL,
  `activated` int(1) NOT NULL DEFAULT '0',
  `ip` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `lastlogin` datetime NOT NULL,
  `com_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated` int(1) NOT NULL DEFAULT '0',
  `tz` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`doctor_id`),
  UNIQUE KEY `doctor_id` (`doctor_id`),
  UNIQUE KEY `doctor_username` (`doctor_username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `doctor_username`, `profile`, `doctor_email`, `doctor_password`, `doctor_birthday`, `doctor_sex`, `doctor_postcode`, `doctor_country`, `joindate`, `activated`, `ip`, `lastlogin`, `com_code`, `updated`, `tz`) VALUES
(5, 'doctor', 1000000005, 'doctor@boiddo.com', 'd0970714757783e6cf17b26fb8e2298f', '0000-00-00', 'Female', '6600', 'Bangladesh', '2015-12-15', 1, '3.229.12.5', '2016-06-09 15:03:22', '', 1, 'Asia/Dhaka'),
(6, 'adoc', 1000000006, 'adoc@boiddo.com', 'd0970714757783e6cf17b26fb8e2298f', '0000-00-00', 'Male', '4565', 'Bangladesh', '2015-12-15', 1, '::1', '2016-01-08 09:30:58', '', 1, 'Asia/Dhaka'),
(7, 'newdoc', 1000000007, 'newdoc@boiddo.com', 'd0970714757783e6cf17b26fb8e2298f', '0000-00-00', 'Male', '6574', 'Afghanistan', '2015-12-15', 1, '::1', '2009-01-10 01:59:34', '', 1, 'Asia/Kabul'),
(8, 'docfour', 1000000008, 'docfour@boiddo.com', 'd0970714757783e6cf17b26fb8e2298f', '0000-00-00', 'Male', '456546', 'Costa Rica', '2015-12-21', 1, '::1', '2016-01-21 21:06:05', '', 1, 'America/Costa_Rica'),
(9, 'another', 1000000009, 'another@boiddo.com', 'd0970714757783e6cf17b26fb8e2298f', '0000-00-00', 'Male', '54511', 'Bangladesh', '2015-12-29', 1, '::1', '2016-01-24 22:11:08', '', 1, 'Asia/Dhaka'),
(10, 'docfive', 1000000010, 'docfive@boiddo.com', 'd0970714757783e6cf17b26fb8e2298f', '1985-05-12', 'Male', '23433', 'Angola', '2016-01-17', 1, '::1', '2016-02-11 22:40:50', '', 1, 'Europe/Andorra'),
(11, 'sixth', 1000000011, 'sixth@boiddo.com', 'd0970714757783e6cf17b26fb8e2298f', '0000-00-00', 'Male', '567567', 'China', '2016-01-19', 1, '::1', '2009-01-10 00:10:43', '', 1, 'Asia/Ho_Chi_Minh'),
(12, 'seventh', 1000000012, 'seventh@boiddo.com', 'd0970714757783e6cf17b26fb8e2298f', '1983-11-02', 'Male', '3445', 'Bangladesh', '2016-01-20', 1, '::1', '2016-03-05 18:14:43', '', 1, 'Asia/Dhaka'),
(13, 'nine', 1000000013, 'nine@boiddo.com', 'd0970714757783e6cf17b26fb8e2298f', '1984-03-12', 'Male', '4545', 'Bangladesh', '2016-01-21', 1, '::1', '2009-01-10 02:31:31', '', 1, 'Asia/Dhaka'),
(14, 'ckeckdoctor', 0, 'checkdoctor@boiddo.com', 'd0970714757783e6cf17b26fb8e2298f', '1978-03-02', 'Male', '1200', 'Bangladesh', '2016-03-04', 1, '::1', '2016-03-04 11:45:05', NULL, 0, 'Asia/Dhaka'),
(15, 'zafor', 1000000015, 'zafor@boiddo.com', 'd0970714757783e6cf17b26fb8e2298f', '1983-03-04', 'Male', '1100', 'Bangladesh', '2016-03-05', 1, '19.30.35.167', '2016-03-05 21:28:27', NULL, 1, 'Asia/Dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `doctors_chambers`
--

CREATE TABLE IF NOT EXISTS `doctors_chambers` (
  `chamber_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `doctor_id` bigint(20) NOT NULL,
  `speciality` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `main_hospital` int(1) NOT NULL DEFAULT '0',
  `working_days` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `holidays` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `isweek_circle` int(1) NOT NULL DEFAULT '0',
  `ismonth_circle` int(1) NOT NULL DEFAULT '0',
  `chamber_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `house_no` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `house_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `street_no` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `street_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `town` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `postcode` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `sat_start` datetime NOT NULL,
  `sat_end` datetime NOT NULL,
  `sun_start` datetime NOT NULL,
  `sun_end` datetime NOT NULL,
  `mon_start` datetime NOT NULL,
  `mon_end` datetime NOT NULL,
  `tue_start` datetime NOT NULL,
  `tue_end` datetime NOT NULL,
  `wed_start` datetime NOT NULL,
  `wed_end` datetime NOT NULL,
  `thu_start` datetime NOT NULL,
  `thu_end` datetime NOT NULL,
  `fri_start` datetime NOT NULL,
  `fri_end` datetime NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`chamber_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `doctors_chambers`
--

INSERT INTO `doctors_chambers` (`chamber_id`, `doctor_id`, `speciality`, `main_hospital`, `working_days`, `holidays`, `isweek_circle`, `ismonth_circle`, `chamber_name`, `house_no`, `house_name`, `street_no`, `street_name`, `town`, `city`, `lat`, `lng`, `postcode`, `country`, `contact`, `sat_start`, `sat_end`, `sun_start`, `sun_end`, `mon_start`, `mon_end`, `tue_start`, `tue_end`, `wed_start`, `wed_end`, `thu_start`, `thu_end`, `fri_start`, `fri_end`, `active`) VALUES
(1, 7, 'Endocrinologist', 1, '', '', 0, 0, '', '', '', '', '', '', '', 0, 0, '', '', '', '2016-01-09 10:00:00', '2016-01-09 23:00:00', '2016-01-03 12:30:00', '2016-01-03 00:30:00', '2016-01-04 06:00:00', '2016-01-04 11:30:00', '2015-12-29 08:20:18', '2015-12-29 12:37:32', '2016-01-06 16:00:00', '2016-01-06 22:00:00', '2015-12-31 08:00:00', '2015-12-31 16:00:00', '2016-01-01 10:00:00', '2016-01-01 16:00:00', 0),
(2, 9, 'Gastroenterologist', 1, '', '', 0, 0, 'Hospital Name Two', '', '', '', 'Street Name', 'Town', 'Pabna', 0, 0, '6600', 'Bangladesh', '56756756', '2016-01-02 05:00:00', '2016-01-02 10:00:00', '2016-01-10 09:30:00', '2016-01-10 15:00:00', '2016-01-04 09:30:00', '2016-01-04 15:00:00', '2016-01-05 09:30:00', '2016-01-05 15:00:00', '2015-12-30 10:30:00', '2015-12-30 15:30:00', '2015-12-31 09:00:00', '2015-12-31 14:00:00', '2016-01-01 10:30:00', '2016-01-01 16:30:00', 0),
(3, 5, 'Cardiologist', 1, '', '', 0, 0, 'Hospital Name Two', '', '', '34', 'Street Name', 'Town', 'Pabna', 0, 0, '6600', 'Bangladesh', '45645654', '2016-01-09 06:00:00', '2016-01-09 11:00:00', '2016-01-10 07:00:00', '2016-01-10 13:00:00', '2016-01-04 01:00:00', '2016-01-04 05:00:00', '2016-01-05 09:00:00', '2016-01-05 14:00:00', '2016-01-06 10:00:00', '2016-01-06 14:00:00', '2016-01-07 09:00:00', '2016-01-07 13:30:00', '2016-01-08 10:00:00', '2016-01-08 16:00:00', 0),
(4, 6, 'Gynecologic oncologist', 1, '', '', 0, 0, '', '', '', '', '', '', '', 23.7, 90.3667, '', '', '', '2016-01-02 09:00:00', '2016-01-02 15:00:00', '2016-01-10 08:00:00', '2016-01-10 14:00:00', '2016-01-04 11:00:00', '2016-01-04 15:00:00', '2016-01-05 10:00:00', '2016-01-05 12:00:00', '2016-01-06 09:00:00', '2016-01-06 14:00:00', '2015-12-31 09:30:00', '2015-12-31 12:00:00', '2016-01-01 09:30:00', '2016-01-01 12:00:00', 0),
(5, 8, 'Surgeon', 1, '', '', 0, 0, 'New Hospital And Chamber', '', '', '56', 'Street Name', 'Town', 'City', 0, 0, '3433', 'Costa Rica', '5676575', '2016-01-02 09:00:00', '2016-01-02 14:45:00', '2016-01-03 09:00:00', '2016-01-03 14:45:00', '2016-01-04 08:30:00', '2016-01-04 14:30:00', '2016-01-05 09:00:00', '2016-01-05 15:30:00', '2016-01-06 09:00:00', '2016-01-06 15:30:00', '2015-12-31 09:00:00', '2015-12-31 14:45:00', '2016-01-01 09:00:00', '2016-01-01 14:45:00', 0),
(6, 7, 'Endocrinologist', 0, '', '', 0, 0, 'Sample Chamber', '2', 'House', '2', 'Street Name', 'Town', 'City', 0, 0, '2343', 'Bangladesh', '34534543543', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(12, 6, 'Gynecologic oncologist', 0, '', '', 0, 1, 'new chamber', '34', 'house name', '3', 'street name', 'town', 'city', 0, 0, '34545', 'Bangladesh', '00675756655', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(13, 10, 'Hand surgeon', 1, '', '', 0, 0, 'Fifth General Hospital', '', '', '56', 'Street Name', 'Town', 'City', 0, 0, '5880', 'Costa Rica', '546546456546546', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(14, 11, 'Geriatric medicine specialist', 1, '', '', 0, 0, 'Kabul General Hospital', '', '', '', 'Street Name', 'Town', 'Kabul', 0, 0, '3433', 'Afghanistan', '23423423423', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(15, 11, 'Geriatric medicine specialist', 0, '', '', 1, 0, 'Kabul chamber', '23', 'jamal villa', '3', 'jasimuddin street', 'jahanabad', 'Panda', 0, 0, '34554', 'Afghanistan', '344456787', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(16, 13, 'Cardiologist', 1, '', '', 0, 0, 'Medicare General Hospital', '', '', '', 'Street Name', 'Town', 'Pabna', 0, 0, '6600', 'Bangladesh', '01723456545', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(17, 12, 'Cardiologist', 1, '', '', 0, 0, 'Hospital Name Two', '', '', '', 'Main Road', 'Ganggohati', 'Pabna', 0, 0, '6600', 'Bangladesh', '56778878', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(18, 12, 'Cardiologist', 0, '', '', 1, 0, 'Sheikh Medical Hall', '', '', '', 'main road', 'bonogram', 'Pabna', 0, 0, '6600', 'Bangladesh', '01721221438', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(19, 12, 'Cardiologist', 0, '', '', 0, 1, 'Mirza Medical Hall', '', '', '', 'Bazar Road', 'Kashinathpur', 'Pabna', 0, 0, '6600', 'Bangladesh', '017345456543', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(20, 5, 'Cardiologist', 0, '', '', 0, 0, 'Jeson Pharmecy', '3', 'Khan Market', '3', 'Bypass Road', 'Jamgora', 'Dhaka', 0, 0, '1248', 'Bangladesh', '0163485943', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(21, 5, 'Cardiologist', 0, '', '', 0, 1, 'Alif Pharmecy', '65', 'Jahid Market', '', 'College Road', 'Miapur', 'Pabna', 0, 0, '1248', 'Bangladesh', '0163484543', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(22, 12, 'Cardiologist', 0, '', '', 0, 1, 'Shanto Pharmecy', '', '', '', 'Main Road', 'Tarminal', 'Pabna', 0, 0, '6600', 'Bangladesh', '9045645546565', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(23, 12, 'Cardiologist', 0, '', '', 1, 0, 'Bangladesh Medical Hall', '', '', '', 'College Road', 'Shibrampur', 'Pabna', 0, 0, '6600', 'Bangladesh', '7868678678', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(24, 12, 'Cardiologist', 0, '', '', 1, 0, 'Morol Pharmecy', '', '', '', 'Main Road', 'Tarminal', 'Pabna', 0, 0, '6600', 'Bangladesh', '567567567657', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(25, 12, 'Cardiologist', 0, '', '', 1, 0, 'First Medical Hall', '', '', '', 'Main Road', 'Tarminal', 'Pabna', 0, 0, '6600', 'Bangladesh', '0163485943', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(26, 9, 'Gastroenterologist', 0, '', '', 1, 0, 'Chamber For Another Doctor', '', '', '', 'Main Road', 'Shajadnogor', 'Dhaka', 0, 0, '6554', 'Bangladesh', '46576454455', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(27, 11, 'Geriatric medicine specialist', 0, '', '', 0, 1, 'Ho Chi Min Medical Center', '23', 'Jagamufa ', '4', 'Sitofa Bypass', 'Haskafina', 'Sunghigh', 0, 0, '4565 CH', 'China', '0243683363665', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(28, 10, 'Hand surgeon', 0, '', '', 1, 0, 'Zeson Phermecy', '2', 'Zeson Villa', '', 'Jas Street', 'adabar market', 'Costa Rica City', 0, 0, '45634', 'Costa Rica', '34345435345', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(29, 14, '', 1, '', '', 0, 0, '', '', '', '', '', '', '', 0, 0, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(30, 15, 'Dermatologist', 1, '', '', 0, 0, 'Dhaka Metro Hospital', '', '', '', 'Bypass Road', 'Laskarpur', 'Dhaka', 0, 0, '1100', 'Bangladesh', '675765756765', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `doctors_comments`
--

CREATE TABLE IF NOT EXISTS `doctors_comments` (
  `comments_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `status_id` bigint(20) NOT NULL,
  `doctor_id` bigint(20) NOT NULL,
  `comments` longtext COLLATE utf8_unicode_ci NOT NULL,
  `comments_time` time NOT NULL,
  `comments_date` date NOT NULL,
  `fullname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `img_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comments_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `doctors_comments`
--

INSERT INTO `doctors_comments` (`comments_id`, `status_id`, `doctor_id`, `comments`, `comments_time`, `comments_date`, `fullname`, `img_name`, `active`) VALUES
(2, 13, 6, 'what a status!!', '23:35:47', '2015-02-24', 'Dr. Ahad  Sarkar', 'adoc885808731.jpg', 1),
(3, 4, 8, 'hahaha....', '02:02:17', '2000-12-25', 'Dr. Profile  Four', 'docfour538905559.jpg', 1),
(4, 4, 8, 'what happend???', '02:03:09', '2015-12-25', 'Dr. Profile  Four', 'docfour538905559.jpg', 1),
(5, 17, 8, 's...', '11:22:30', '2015-12-25', 'Dr. Profile  Four', 'docfour538905559.jpg', 1),
(6, 15, 8, 'mjhg jh hjv', '11:25:02', '2015-12-25', 'Dr. Profile  Four', 'docfour538905559.jpg', 1),
(7, 15, 8, 'jghj  jkj', '11:40:23', '2015-12-25', 'Dr. Profile  Four', 'docfour538905559.jpg', 1),
(8, 15, 8, 'jghj  jkj', '11:40:25', '2015-12-25', 'Dr. Profile  Four', 'docfour538905559.jpg', 1),
(9, 15, 8, 'j j kbkj', '11:40:48', '2015-12-25', 'Dr. Profile  Four', 'docfour538905559.jpg', 1),
(10, 16, 8, 'khk', '11:43:01', '2015-12-25', 'Dr. Profile  Four', 'docfour538905559.jpg', 1),
(11, 16, 8, 'knfggbn   fknglkgn knlk lrkgnlkg nlk nglk tnglkrn rtk gntklgntk gnrtkntk gnkgn tk en kn elk gnekl gnlkgn/kg nek n geklgn elkgnlkgnlgkn lkglkgnetlkgngnekjgeklg', '14:58:22', '2015-12-25', 'Dr. Profile  Four', 'docfour538905559.jpg', 1),
(12, 17, 5, 'djfgf b bweijijg ijk gjgb rkj', '16:52:37', '2015-12-25', 'Dr. Nafisa Sultana Test profile', 'doctor-310977562.jpg', 1),
(13, 16, 5, 'this is another types of comments....', '17:11:52', '2015-12-25', 'Dr. Nafisa Sultana Test profile', 'doctor-310977562.jpg', 1),
(14, 19, 5, 'so what??', '17:59:18', '2015-12-25', 'Dr. Nafisa Sultana Test profile', 'doctor-310977562.jpg', 1),
(15, 19, 5, 'W3Schools is optimized for learning, testing, and training. Examples might be simplified to improve reading and basic understanding. Tutorials, references, and examples are constantly reviewed to avoid errors, but we cannot warrant full correctness of all content. While using this site, you agree to have read and accepted our terms of use, cookie and privacy policy. Copyright 1999-2015 by Refsnes Data. All Rights Reserved.', '17:59:41', '2015-12-25', 'Dr. Nafisa Sultana Test profile', 'doctor-310977562.jpg', 1),
(16, 19, 5, 'comments............', '18:56:08', '2015-12-25', 'Dr. Nafisa Sultana Test profile', 'doctor-310977562.jpg', 1),
(17, 19, 7, 'very good...', '20:23:39', '2015-12-25', 'Dr. Junayed  Kabir', 'newdoc-387592758.jpg', 1),
(18, 3, 7, 'kono comnt nai kan???', '20:33:15', '2015-12-25', 'Dr. Junayed  Kabir', 'newdoc-387592758.jpg', 1),
(19, 3, 7, 'comn kore valoi lagche... tai na??', '20:33:40', '2015-12-25', 'Dr. Junayed  Kabir', 'newdoc-387592758.jpg', 1),
(20, 3, 7, 'valo to lagar e kotha... valo na lagle hbe??', '20:34:11', '2015-12-25', 'Dr. Junayed  Kabir', 'newdoc-387592758.jpg', 1),
(22, 24, 7, 'hjgj bgiuh', '11:50:09', '2015-12-27', 'Dr. Junayed  Kabir', 'newdoc-387592758.jpg', 1),
(23, 22, 7, 'how is it possible??', '12:16:04', '2015-12-27', 'Dr. Junayed  Kabir', 'newdoc-387592758.jpg', 1),
(24, 22, 7, 'status id', '12:20:29', '2015-12-27', 'Dr. Junayed  Kabir', 'newdoc-387592758.jpg', 1),
(25, 27, 7, 'comments time 8.45 AM 28 Dec 2015', '03:45:08', '2015-12-28', 'Dr. Junayed  Kabir', 'newdoc-387592758.jpg', 1),
(26, 29, 6, '30/12/2015 time 5:47', '17:47:54', '2015-12-30', 'Dr. Ahad  Sarkar', 'adoc885808731.jpg', 1),
(27, 30, 5, 'happy new year...', '16:11:53', '2016-01-05', 'Dr. Another  Profile', 'doctor-310977562.jpg', 1),
(28, 34, 8, 'date 13/1/2016 and time 11:43 pm', '11:43:16', '2016-01-13', 'Dr. Profile  Four', 'docfour538905559.jpg', 1),
(29, 36, 10, 'its 11/2/2016 at 10.33pm', '17:33:29', '2016-02-11', 'Dr. Abul  Kalam', 'docfive-215860863.png', 1),
(30, 3, 5, 'abar 1ta magi lagbo sathe amar limon mama er o..2ta pathia de..', '09:42:19', '2016-04-12', 'Dr. Samiha  Jaman', 'doctor-310977562.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctors_likes`
--

CREATE TABLE IF NOT EXISTS `doctors_likes` (
  `like_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `status_id` int(128) NOT NULL,
  `doctor_id` int(64) NOT NULL,
  `like_time` time NOT NULL,
  `like_date` date NOT NULL,
  `dislike` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`like_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

--
-- Dumping data for table `doctors_likes`
--

INSERT INTO `doctors_likes` (`like_id`, `status_id`, `doctor_id`, `like_time`, `like_date`, `dislike`) VALUES
(5, 3, 7, '10:49:43', '2015-12-21', 0),
(6, 4, 8, '09:44:27', '2015-12-22', 0),
(7, 4, 5, '11:09:15', '2015-12-23', 1),
(8, 10, 6, '23:34:31', '2015-12-24', 0),
(9, 4, 6, '23:34:34', '2015-12-24', 0),
(10, 3, 6, '23:34:35', '2015-12-24', 0),
(11, 13, 6, '23:35:39', '2015-12-24', 0),
(12, 14, 8, '10:17:08', '2015-12-25', 0),
(13, 16, 8, '10:17:10', '2015-12-25', 0),
(14, 15, 8, '11:22:17', '2015-12-25', 0),
(15, 17, 8, '11:22:23', '2015-12-25', 0),
(16, 13, 5, '16:53:33', '2015-12-25', 0),
(18, 17, 5, '17:48:58', '2015-12-25', 0),
(19, 15, 5, '17:54:22', '2015-12-25', 0),
(20, 19, 5, '17:59:07', '2015-12-25', 0),
(21, 19, 7, '20:23:32', '2015-12-25', 0),
(22, 17, 7, '20:29:11', '2015-12-25', 0),
(24, 22, 7, '12:16:43', '2015-12-27', 0),
(25, 27, 7, '03:45:42', '2015-12-28', 0),
(26, 22, 8, '16:21:15', '2016-01-01', 0),
(27, 30, 5, '16:07:12', '2016-01-05', 0),
(28, 30, 7, '14:26:23', '2016-01-06', 0),
(29, 24, 7, '21:32:08', '2016-01-06', 0),
(30, 34, 8, '11:43:00', '2016-01-13', 0),
(31, 34, 11, '23:50:13', '2016-01-20', 0),
(32, 22, 11, '08:56:00', '2016-01-21', 0),
(33, 36, 10, '09:55:15', '2016-01-21', 0),
(34, 34, 10, '09:55:20', '2016-01-21', 1),
(35, 35, 10, '17:31:11', '2016-02-11', 0),
(36, 22, 10, '17:35:08', '2016-02-11', 0),
(37, 35, 5, '09:47:14', '2016-04-12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `doctors_options`
--

CREATE TABLE IF NOT EXISTS `doctors_options` (
  `doctor_id` int(16) NOT NULL AUTO_INCREMENT,
  `doctor_username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `image` blob NOT NULL,
  `img_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_answer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `temp_pass` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated` int(1) NOT NULL DEFAULT '0',
  `published` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`doctor_id`),
  UNIQUE KEY `doctor_username` (`doctor_username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `doctors_options`
--

INSERT INTO `doctors_options` (`doctor_id`, `doctor_username`, `image`, `img_name`, `doctor_question`, `doctor_answer`, `temp_pass`, `updated`, `published`) VALUES
(5, 'doctor', 0x2e2e2f757365725f646f632f646f63746f722d3331303937373536322e6a7067, 'doctor-310977562.jpg', '', '', NULL, 1, 1),
(6, 'adoc', 0x2e2e2f757365725f646f632f61646f633838353830383733312e6a7067, 'adoc885808731.jpg', '', '', NULL, 1, 1),
(7, 'newdoc', 0x2e2e2f757365725f646f632f6e6577646f632d3338373539323735382e6a7067, 'newdoc-387592758.jpg', '', '', NULL, 1, 1),
(8, 'docfour', 0x2e2e2f757365725f646f632f646f63666f75723533383930353535392e6a7067, 'docfour538905559.jpg', '', '', NULL, 1, 1),
(9, 'another', 0x2e2e2f757365725f646f632f616e6f74686572313030303535333632372e6a7067, 'another1000553627.jpg', '', '', NULL, 1, 1),
(10, 'docfive', 0x2e2e2f757365725f646f632f646f63666976652d3231353836303836332e706e67, 'docfive-215860863.png', '', '', NULL, 1, 1),
(11, 'sixth', 0x2e2e2f757365725f646f632f73697874683535323738313638362e6a7067, 'sixth552781686.jpg', '', '', NULL, 1, 1),
(12, 'seventh', 0x2e2e2f757365725f646f632f736576656e74682d3339353839343731342e6a7067, 'seventh-395894714.jpg', '', '', NULL, 1, 1),
(13, 'nine', 0x2e2e2f757365725f646f632f6e696e653735323937373433312e6a7067, 'nine752977431.jpg', '', '', NULL, 1, 1),
(14, 'ckeckdoctor', '', '', '', '', NULL, 0, 0),
(15, 'zafor', 0x2e2e2f757365725f646f632f7a61666f723231393538323434303337382e6a7067, 'zafor219582440378.jpg', '', '', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctors_personal`
--

CREATE TABLE IF NOT EXISTS `doctors_personal` (
  `doctor_id` int(16) NOT NULL AUTO_INCREMENT,
  `category` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'doctor',
  `types` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'doctor_personal',
  `full_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `speciality` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `degrees` text COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `birth_year` int(6) NOT NULL,
  `pass_year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apt_no` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `apt_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `street_no` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `street_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `town` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `postcode` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `updated` int(1) NOT NULL DEFAULT '0',
  `published` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`doctor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `doctors_personal`
--

INSERT INTO `doctors_personal` (`doctor_id`, `category`, `types`, `full_name`, `email`, `speciality`, `degrees`, `sex`, `birth_year`, `pass_year`, `apt_no`, `apt_name`, `street_no`, `street_name`, `town`, `city`, `postcode`, `country`, `phone`, `updated`, `published`) VALUES
(5, 'doctor', 'doctor_personal', 'Dr. Samiha  Jaman', 'nafisa@boiddo.com', 'Cardiologist', 'MBBS', 'Female', 1985, '2000', '12', 'House Name', '3', 'Street Name', 'Town', 'Pabna', '6600', 'Bangladesh', '34563456456', 1, 1),
(6, 'doctor', 'doctor_personal', 'Dr. Ahad  Sarkar', 'ahad@boiddo.com', 'Gynecologic oncologist', 'MBBS', 'Male', 1995, '2011', '23', 'House Name', '3', 'Street Name', 'Town', 'City', '4565', 'Bangladesh', '456456546', 1, 1),
(7, 'doctor', 'doctor_personal', 'Dr. Junayed  Kabir', 'junayed@boiddo.com', 'Endocrinologist', 'MBBS', 'Male', 1988, '1999', '12', 'House Name', '3', 'Street Name', 'Town', 'City', '6574', 'Afghanistan', '34563456456', 1, 1),
(8, 'doctor', 'doctor_personal', 'Dr. Profile  Four', 'four@boiddo.com', 'Surgeon', 'MBBS', 'Male', 1986, '2000', '34', 'House Name', '3', 'Street Name', 'Town', 'City', '456546', 'Costa Rica', '54654645645', 1, 1),
(9, 'doctor', 'doctor_personal', 'Dr. Another  Profile', 'another@another.com', 'Gastroenterologist', 'MBBS', 'Male', 1984, '2004', '2', 'House Name', '3', 'Street Name', 'Town', 'Pabna', '6600', 'Bangladesh', '3456345645634', 1, 1),
(10, 'doctor', 'doctor_personal', 'Dr. Abul  Kalam', 'fifth@doctor.com', 'Hand surgeon', 'MBBS', 'Male', 1985, '2002', '34', 'House Name', '3', 'Street Name', 'Town', 'City', '23433', 'Angola', '34563456456', 1, 1),
(11, 'doctor', 'doctor_personal', 'Dr. Siman  Hotasifa', 'siman@boiddo.com', 'Geriatric medicine specialist', 'MBBS', 'Male', 1986, '1998', '23', 'House Name', '3', 'Street Name', 'Town', 'City', '567567', 'China', '54654645645', 1, 1),
(12, 'doctor', 'doctor_personal', 'Dr. Azad  Karim', 'seventh@boiddo.com', 'Cardiologist', 'MBBS', 'Male', 1984, '2002', '3', 'House Name', '3', 'Hatkhola Road', 'Ganggohati', 'Pabna', '6600', 'Bangladesh', '', 1, 1),
(13, 'doctor', 'doctor_personal', 'Dr. Sayed  Azam', 'nine@boiddo.com', 'Cardiologist', 'MBBS', 'Male', 1984, '2000', '4', 'House Name', '3', 'Street Name', 'Bogra', 'Bogra', '4545', 'Bangladesh', '01512678756', 1, 1),
(14, 'doctor', 'doctor_personal', '', '', 'Oncologist', '', 'Male', 1978, '', '0', '', '0', '', '', '', '1200', 'Bangladesh', '', 0, 0),
(15, 'doctor', 'doctor_personal', 'Dr. Zafor  Khan', 'zaforkhan@boiddo.com', 'Dermatologist', 'MBBS', 'Male', 1983, '2007', '', 'Zafor Villa', '', 'Bypass Road', 'Laskarpur', 'Dhaka', '1100', 'Bangladesh', '54654645645', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctors_professional`
--

CREATE TABLE IF NOT EXISTS `doctors_professional` (
  `doctor_id` int(16) NOT NULL AUTO_INCREMENT,
  `doctor_username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'doctor',
  `types` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'doctor_professional',
  `hospital_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `room_no` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `street_no` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `street_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `town` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `postcode` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `hos_country` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `lat` double NOT NULL DEFAULT '0',
  `lng` double NOT NULL DEFAULT '0',
  `temp_services` text COLLATE utf8_unicode_ci NOT NULL,
  `hospital_services` text COLLATE utf8_unicode_ci NOT NULL,
  `hospital_capacity` int(6) NOT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `web` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `updated` int(1) NOT NULL DEFAULT '0',
  `published` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`doctor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `doctors_professional`
--

INSERT INTO `doctors_professional` (`doctor_id`, `doctor_username`, `category`, `types`, `hospital_name`, `room_no`, `street_no`, `street_name`, `town`, `city`, `postcode`, `country`, `hos_country`, `lat`, `lng`, `temp_services`, `hospital_services`, `hospital_capacity`, `phone`, `email`, `web`, `updated`, `published`) VALUES
(5, 'doctor', 'doctor', 'doctor_professional', 'Hospital Name Two', '', '34', 'Street Name', 'Town', 'Pabna', '6600', 'Bangladesh', 'Bangladesh', 90.00001, 90.00002, 'a-one/Anaesthetics,a-four/Chaplaincy,a-ten/Emergency,a-three/Cardiology', ' Anaesthetics, Chaplaincy, Emergency, Cardiology', 500, '45645654', 'email@boiddo.com', '', 1, 1),
(6, 'adoc', 'doctor', 'doctor_professional', 'Updated Hospital', '', '3', 'Street Name', 'Town', 'City', '5880', 'Bangladesh', '', 90.00001, 90.00002, 'b-one/Gastroenterology,a-six/Diagnostic imaging,b-two/General surgery,b-three/Gynaecology,a-eight/Ear nose and throat (ENT),a-ten/Emergency,b-eight/Nephrology,c-four/Ophthalmology', ' Gastroenterology, Diagnostic imaging, General surgery, Gynaecology, Ear nose and throat (ENT), Emergency, Nephrology, Ophthalmology', 250, '454546545645', '', '', 1, 1),
(7, 'newdoc', 'doctor', 'doctor_professional', 'Civil Defense Hospital', '', '45', 'Street Name', 'Town', 'City', '5880', 'Afghanistan', '', 90.00001, 90.00002, 'b-one/Gastroenterology,a-five/Critical care,b-two/General surgery', ' Gastroenterology, Critical care, General surgery', 250, '5676575', '', '', 1, 1),
(8, 'docfour', 'doctor', 'doctor_professional', 'New Hospital And Chamber', '', '56', 'Street Name', 'Town', 'City', '3433', 'Costa Rica', 'Costa Rica', 90.00001, 90.00002, 'a-five/Critical care,a-six/Diagnostic imaging,a-nine/Elderly services department,a-eight/Ear nose and throat (ENT)', ' Critical care, Diagnostic imaging, Elderly services department, Ear nose and throat (ENT)', 600, '5676575', '', '', 1, 1),
(9, 'another', 'doctor', 'doctor_professional', 'Hospital Name Two', '', '', 'Street Name', 'Town', 'Pabna', '6600', 'Bangladesh', 'Bangladesh', 90.00001, 90.00002, 'a-ten/Emergency,a-three/Cardiology,a-eight/Ear nose and throat (ENT),b-one/Gastroenterology', ' Emergency, Cardiology, Ear nose and throat (ENT), Gastroenterology', 250, '56756756', '', '', 1, 1),
(10, 'docfive', 'doctor', 'doctor_professional', 'Fifth General Hospital', '', '56', 'Street Name', 'Town', 'City', '5880', 'Angola', 'Costa Rica', 90.00001, 90.00002, 'a-two/Breast screening,a-four/Chaplaincy,a-three/Cardiology', ' Breast screening, Chaplaincy, Cardiology', 500, '546546456546546', '', '', 1, 1),
(11, 'sixth', 'doctor', 'doctor_professional', 'Kabul General Hospital', '', '', 'Street Name', 'Town', 'Kabul', '3433', 'China', 'Afghanistan', 90.00001, 90.00002, 'a-two/Breast screening,a-one/Anaesthetics,a-five/Critical care,a-seven/Discharge lounge', ' Breast screening, Anaesthetics, Critical care, Discharge lounge', 500, '23423423423', '', '', 1, 1),
(12, 'seventh', 'doctor', 'doctor_professional', 'Hospital Name Two', '', '', 'Main Road', 'Ganggohati', 'Pabna', '6600', 'Bangladesh', 'Bangladesh', 90.00001, 90.00002, 'b-one/Gastroenterology,a-five/Critical care', ' Gastroenterology, Critical care', 50, '56778878', '', '', 1, 1),
(13, 'nine', 'doctor', 'doctor_professional', 'Medicare General Hospital', '', '', 'Street Name', 'Town', 'Pabna', '6600', 'Bangladesh', 'Bangladesh', 90.00001, 90.00002, 'a-seven/Discharge lounge,a-two/Breast screening,a-eight/Ear nose and throat (ENT),a-ten/Emergency,b-three/Gynaecology,b-five/Maternity departments,a-nine/Elderly services department', ' Discharge lounge, Breast screening, Ear nose and throat (ENT), Emergency, Gynaecology, Maternity departments, Elderly services department', 200, '01723456545', 'hospital@boiddo.com', 'www.hospital.com', 1, 1),
(14, 'ckeckdoctor', 'doctor', 'doctor_professional', '', '', '', '', '', '', '', 'Bangladesh', '', 0, 0, '', '', 0, '', '', '', 0, 0),
(15, 'zafor', 'doctor', 'doctor_professional', 'Dhaka Metro Hospital', '', '', 'Bypass Road', 'Laskarpur', 'Dhaka', '1100', 'Bangladesh', 'Bangladesh', 0, 0, 'a-one/Anaesthetics,a-two/Breast screening,a-three/Cardiology,a-four/Chaplaincy,a-five/Critical care', ' Anaesthetics, Breast screening, Cardiology, Chaplaincy, Critical care', 400, '675765756765', 'email@boiddo.com', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctors_status`
--

CREATE TABLE IF NOT EXISTS `doctors_status` (
  `status_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `privecy` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_id` int(32) NOT NULL,
  `fullname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext CHARACTER SET utf16 COLLATE utf16_spanish_ci NOT NULL,
  `speciality` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `status_time` time NOT NULL,
  `status_date` date NOT NULL,
  `hospital_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `hospital_city` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `hospital_country` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `img_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `likes` int(8) NOT NULL DEFAULT '0',
  `comments` int(8) NOT NULL DEFAULT '0',
  `seens` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

--
-- Dumping data for table `doctors_status`
--

INSERT INTO `doctors_status` (`status_id`, `privecy`, `doctor_id`, `fullname`, `status`, `speciality`, `status_time`, `status_date`, `hospital_name`, `hospital_city`, `hospital_country`, `img_name`, `likes`, `comments`, `seens`, `active`) VALUES
(3, 'Planet', 7, 'Dr. Junayed  Kabir', 'dr. junayed kabirs status....!!', 'Endocrinologist', '10:30:19', '2015-12-21', 'Civil Defense Hospital', 'City', 'Afghanistan', 'newdoc-387592758.jpg', 2, 4, '286', 1),
(4, 'Planet', 8, 'Dr. Profile  Four', 'my status... Hahahaha', 'Surgeon', '16:28:35', '2000-12-21', 'Hospital Four Doctor', 'City', 'Costa Rica', 'docfour538905559.jpg', 2, 2, '248', 1),
(10, 'Planet', 6, 'Dr. Ahad  Sarkar', 'my status...', 'Gynecologic oncologist', '23:31:08', '2015-12-24', 'Hospital For Doctor', 'City', 'Bangladesh', 'adoc885808731.jpg', 1, 0, '246', 1),
(13, 'Planet', 6, 'Dr. Ahad  Sarkar', 'my new status', 'Gynecologic oncologist', '23:34:47', '2015-12-24', 'Hospital For Doctor', 'City', 'Bangladesh', 'adoc885808731.jpg', 2, 1, '246', 1),
(14, 'Planet', 8, 'Dr. Profile  Four', 'time and date checking status...!!!', 'Surgeon', '02:03:36', '2015-12-24', 'Hospital Four Doctor', 'City', 'Costa Rica', 'docfour538905559.jpg', 1, 0, '248', 1),
(15, 'Planet', 8, 'Dr. Profile  Four', 'today status..', 'Surgeon', '09:42:33', '2015-12-25', 'Hospital Four Doctor', 'City', 'Costa Rica', 'docfour538905559.jpg', 2, 4, '248', 1),
(16, 'Planet', 8, 'Dr. Profile  Four', 'new status and more ...', 'Surgeon', '10:00:52', '2015-12-25', 'Hospital Four Doctor', 'City', 'Costa Rica', 'docfour538905559.jpg', 1, 3, '248', 1),
(17, 'Planet', 8, 'Dr. Profile  Four', 'status..............', 'Surgeon', '11:04:04', '2015-12-25', 'Hospital Four Doctor', 'City', 'Costa Rica', 'docfour538905559.jpg', 3, 2, '248', 1),
(19, 'Planet', 5, 'Dr. Nafisa Sultana Test profile', 'its my status... hu!!!', 'Cardiologist', '17:59:02', '2015-12-25', 'Hospital Name', 'City', 'Bangladesh', 'doctor-310977562.jpg', 2, 4, '248', 1),
(22, 'Planet', 7, 'Dr. Junayed  Kabir', 'how many views of my profile???', 'Endocrinologist', '03:10:41', '2015-12-27', 'Civil Defense Hospital', 'City', 'Afghanistan', 'newdoc-387592758.jpg', 750004, 90002, '9.22337203685E+32', 1),
(23, 'Planet', 7, 'Dr. Junayed  Kabir', '787 m757tu5uyrurt ', 'Endocrinologist', '03:11:26', '2015-12-27', 'Civil Defense Hospital', 'City', 'Afghanistan', 'newdoc-387592758.jpg', 0, 0, '286', 1),
(24, 'Planet', 7, 'Dr. Junayed  Kabir', 'mysql_query("DELETE FROM doctors_status WHERE status_id=18");', 'Endocrinologist', '03:44:15', '2015-12-27', 'Civil Defense Hospital', 'City', 'Afghanistan', 'newdoc-387592758.jpg', 1, 1, '286', 1),
(25, 'Planet', 7, 'Dr. Junayed  Kabir', 'W3Schools is optimized for learning, testing, and training. Examples might be simplified to improve reading and basic understanding. Tutorials, references, and examples are constantly reviewed to avoid errors, but we cannot warrant full correctness of all content. While using this site, you agree to have read and accepted our terms of use, cookie and privacy policy. Copyright 1999-2015 by Refsnes Data. All Rights Reserved.', 'Endocrinologist', '11:29:45', '2015-12-27', 'Civil Defense Hospital', 'City', 'Afghanistan', 'newdoc-387592758.jpg', 0, 0, '286', 1),
(27, 'Planet', 7, 'Dr. Junayed  Kabir', 'this is status for planet and any privacy at 8.44 AM and date 28 Dec 2015 ', 'Endocrinologist', '03:44:39', '2015-12-28', 'Civil Defense Hospital', 'City', 'Afghanistan', 'newdoc-387592758.jpg', 1, 1, '248', 1),
(28, 'Planet', 7, 'Dr. Junayed  Kabir', 'this is status for planet and any privacy at 8.53 AM and date 28 Dec 2015', 'Endocrinologist', '08:53:29', '2015-12-28', 'Civil Defense Hospital', 'City', 'Afghanistan', 'newdoc-387592758.jpg', 0, 0, '242', 1),
(29, 'Planet', 6, 'Dr. Ahad  Sarkar', 'my new status after a week ....\nhow are you everybody??', 'Gynecologic oncologist', '17:47:09', '2015-12-30', 'Hospital For Doctor', 'City', 'Bangladesh', 'adoc885808731.jpg', 0, 1, '199', 1),
(30, 'Planet', 9, 'Dr. Another  Profile', 'happy new year...', 'Gastroenterologist', '16:21:39', '2016-01-02', 'Hospital Name Another', 'City', 'Fiji', 'another1000553627.jpg', 2, 1, '190', 1),
(31, 'Planet', 7, 'Dr. Junayed  Kabir', '<?php mysql_query("DELETE FROM doctors_status WHERE status_id=18");?>', 'Endocrinologist', '19:01:13', '2016-01-07', 'Civil Defense Hospital', 'City', 'Afghanistan', 'newdoc-387592758.jpg', 0, 0, '133', 1),
(32, 'Planet', 7, 'Dr. Junayed  Kabir', '9:30 AM 08/01/2016', 'Endocrinologist', '09:30:24', '2016-01-08', 'Civil Defense Hospital', 'City', 'Afghanistan', 'newdoc-387592758.jpg', 0, 0, '131', 1),
(34, 'Planet', 8, 'Dr. Profile  Four', 'date 13/1/2016 and time 11:42 pm', 'Surgeon', '11:42:08', '2016-01-13', 'Hospital Four Doctor', 'City', 'Costa Rica', 'docfour538905559.jpg', 2, 1, '110', 1),
(35, 'Planet', 11, 'Dr. Siman  Hotasifa', 'from china, date 21 jan and time 7.56AM', 'Geriatric medicine specialist', '08:56:54', '2016-01-21', 'Kabul General Hospital', 'Kabul', 'China', 'sixth552781686.jpg', 2, 0, '90', 1),
(36, 'Planet', 11, 'Dr. Siman  Hotasifa', 'from china, date 21 jan and time 7.56AM', 'Geriatric medicine specialist', '08:56:54', '2016-01-21', 'Kabul General Hospital', 'Kabul', 'China', 'sixth552781686.jpg', 1, 1, '90', 1),
(37, 'Planet', 15, '', 'Disabled students, doctors in training and practitioners talk about their experiences throughout their medical education and training', 'Dermatologist', '09:03:01', '2016-03-06', '', '', 'Bangladesh', 'zafor219582440378.jpg', 0, 0, '19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctors_visit`
--

CREATE TABLE IF NOT EXISTS `doctors_visit` (
  `request_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `request_profile` bigint(20) NOT NULL,
  `doctor_id` bigint(20) NOT NULL,
  `chamber_id` bigint(20) NOT NULL,
  `type` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `requestor` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'doctor',
  `rq_relation` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `rq_age` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `rq_sex` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `rq_phone` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `rq_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `rq_housename` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `rq_houseno` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `rq_town` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `rq_city` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `rq_policestation` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `rq_country` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `patient` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `age` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `occupation` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `suffering` date NOT NULL,
  `blood_group` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `weight` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `height` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `expt_date` datetime NOT NULL,
  `tz` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `fees` int(6) NOT NULL,
  `currency` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `seen` int(1) NOT NULL DEFAULT '0',
  `approve` int(1) NOT NULL DEFAULT '0',
  `approve_date` datetime NOT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Dumping data for table `doctors_visit`
--

INSERT INTO `doctors_visit` (`request_id`, `request_profile`, `doctor_id`, `chamber_id`, `type`, `requestor`, `rq_relation`, `rq_age`, `rq_sex`, `rq_phone`, `rq_email`, `rq_housename`, `rq_houseno`, `rq_town`, `rq_city`, `rq_policestation`, `rq_country`, `patient`, `sex`, `age`, `occupation`, `suffering`, `blood_group`, `weight`, `height`, `date`, `expt_date`, `tz`, `fees`, `currency`, `seen`, `approve`, `approve_date`) VALUES
(1, 10001, 7, 6, 'chamber', 'name ', 'Neighbour', '34', 'Male', '345345', 'email@boiddo.com', 'house name', '2', 'town', 'city', '34534', 'country', 'patient name', 'Male', '546', '', '0000-00-00', 'B-', '345', '123', '0000-00-00 00:00:00', '2016-01-14 00:00:00', '', 0, '', 1, 0, '2016-06-22 00:00:00'),
(5, 10005, 11, 14, 'chamber', 'ahsan molla', 'Son', '34', 'Male', '4566767676', 'ahsanmolla@gmail.com', 'kundu villa', '42', 'jahanabad', 'kerapona', '4533', 'Afghanisthan', 'sifisuyan molla', 'Male', '6', '', '0000-00-00', 'B+', '32', '78', '2016-01-14 00:00:00', '2016-01-25 00:00:00', '', 0, '', 1, 1, '2016-01-24 11:42:36'),
(6, 10006, 11, 14, 'chamber', 'ahsan molla', 'Son', '6', 'Male', '4566767676', 'ahsanmolla@gmail.com', 'kundu villa', '42', 'jahanabad', 'kerapona', '4533', 'Afghanisthan', 'sifisuyan molla', 'Male', '6', '', '0000-00-00', 'B+', '31', '89', '2016-01-15 00:00:00', '2016-01-28 00:00:00', '', 0, '', 1, 1, '2016-01-28 07:15:29'),
(7, 10007, 11, 14, 'chamber', 'ahsan molla', 'Sister', '56', 'Male', '4566767676', 'ahsanmolla@gmail.com', 'kundu villa', '42', 'jahanabad', 'kerapona', '4533', 'Afghanisthan', 'sifisuyan molla', 'Female', '62', '', '0000-00-00', 'B+', '56', '156', '2016-01-16 00:00:00', '2016-01-29 00:00:00', '', 0, '', 1, 1, '2016-06-22 00:00:00'),
(8, 10008, 13, 0, 'dochos', 'mr abul khauer', 'Friend', '45', 'Male', '01523234343', '', 'ulka villa', '', 'masurabad', 'pabna', '6600', 'Bangladesh', 'Ulka begom', 'Female', '40', '', '0000-00-00', 'A+', '65', '156', '2016-01-14 00:00:00', '2016-06-22 00:00:00', '', 0, '', 0, 0, '0000-00-00 00:00:00'),
(9, 10009, 11, 14, 'chamber', 'ahsan molla', 'Sister', '56', 'Male', '4566767676', 'ahsanmolla@gmail.com', 'kundu villa', '42', 'jahanabad', 'kerapona', '4533', 'Afghanisthan', 'sifisuyan molla', 'Female', '62', '', '2016-01-14', 'B+', '56', '156', '2016-01-25 00:00:00', '2016-01-29 00:00:00', '', 0, '', 1, 1, '2016-06-22 00:00:00'),
(10, 10010, 13, 0, 'dochos', 'Mr Abul Khauer', 'Friend', '45', 'Male', '01523234343', '', 'ulka villa', '', 'masurabad', 'Pabna', '6600', 'Bangladesh', 'Ulka Begom', 'Female', '40', '', '0000-00-00', 'A+', '65', '156', '2016-01-14 00:00:00', '2016-06-22 00:00:00', '', 0, '', 1, 1, '2016-06-22 00:00:00'),
(11, 10011, 13, 0, 'dochos', 'Mr Abul Khauer', 'Friend', '45', 'Male', '01523234343', '', 'ulka villa', '', 'masurabad', 'Pabna', '6600', 'Bangladesh', 'Ulka Begom', 'Female', '40', '', '0000-00-00', 'A+', '65', '156', '2016-01-14 00:00:00', '2016-06-22 00:00:00', '', 0, '', 1, 1, '2016-06-22 00:00:00'),
(12, 10012, 11, 14, 'chamber', 'Kumalu Chifafa', 'Brother', '34', 'Male', '4545654565', '', 'jamulatusa', '35', 'kajafusa', 'Sunghigh', '23434 CH', 'China', 'Samuda Ugfasula', 'Male', '16', '', '0000-00-00', 'B+', '48', '145', '2016-01-25 00:00:00', '2016-01-24 00:00:00', '', 0, '', 1, 1, '2016-06-22 00:00:00'),
(13, 10013, 11, 27, 'chamber', 'Kumalu Chifafa', 'Brother', '45', 'Male', '4545654565', '', 'jamulatusa', '67', 'kajafusa', 'Sunghigh', '23434 CH', 'China', 'Samuda Ugfasula', 'Male', '16', '', '0000-00-00', 'B+', '49', '145', '2016-01-26 00:00:00', '2016-01-17 00:00:00', '', 0, '', 1, 1, '2016-06-22 00:00:00'),
(14, 10014, 12, 17, 'chamber', 'Mr Kalam Khan', 'Sister', '34', 'Male', '4545654565', '', '', '', 'santhia', 'Pabna', '6600', 'Bangladesh', 'Samiha Akter', 'Female', '20', '', '0000-00-00', 'O-', '45', '156', '2016-01-27 00:00:00', '2016-01-29 00:00:00', '', 0, '', 1, 1, '2016-03-14 16:40:00'),
(15, 10015, 11, 27, 'chamber', 'Mr Kalam Khan', 'Son', '34', 'Male', '4566767676', '', 'jamulatusa', '42', 'jahanabad', 'Sunghigh', '4533', 'China', 'Samuda Bagofa', 'Male', '4', '', '0000-00-00', 'B+', '65', '198', '2016-01-27 00:00:00', '2016-01-29 00:00:00', '', 0, '', 1, 1, '2016-06-22 00:00:00'),
(16, 10016, 10, 13, 'chamber', 'Name Of The Requestor', 'Myself', '40', 'Male', '43455345435', '', '', '', 'Jaflong', 'Sylhet', '4566', 'Bangladesh', 'Patient Name', 'Male', '80', '', '0000-00-00', 'B+', '65', '156', '2016-02-11 00:00:00', '2016-02-17 00:00:00', '', 0, '', 1, 1, '2016-02-28 12:50:00'),
(17, 10017, 10, 28, 'chamber', 'Jalal', 'Myself', '45', 'Male', '4564565454', '', '', '', 'costa vanilla', 'Vanli Jakin', '45646', 'Costa Rica', 'Jalal', 'Male', '45', '', '0000-00-00', 'B+', '65', '167', '2016-02-13 00:00:00', '2016-02-15 00:00:00', '', 0, '', 1, 1, '2016-03-04 17:30:00'),
(18, 10018, 10, 13, 'chamber', 'Mr Salam Miah', 'Father', '37', 'Male', '017364636363', '', '', '', 'Santhia', 'Pabna', '6600', 'Bangladesh', 'Kalam Miah', 'Male', '67', 'retired police officer', '0000-00-00', 'O+', '52', '146', '2016-02-16 00:00:00', '2016-02-20 00:00:00', '', 0, '', 1, 1, '2016-06-22 00:00:00'),
(21, 10021, 12, 17, 'chamber', 'Mr Samsu', 'Mother', '34', 'Male', '012343535353', 'samsu@kopa.com', 'samsu villa', '', 'ataikula', 'Pabna', '6600', 'Bangladesh', 'Samsunnahar Begom', 'Female', '78', 'house wife', '0000-00-00', 'B+', '46', '148', '2016-02-25 00:00:00', '2016-03-11 00:00:00', '', 0, '', 1, 1, '2016-06-22 00:00:00'),
(23, 10023, 12, 17, 'chamber', 'Mr Samsu', 'Mother', '34', 'Male', '012343535353', 'samsu@kopa.com', 'samsu villa', '', 'ataikula', 'Pabna', '6600', 'Bangladesh', 'Samsunnahar Begom', 'Female', '78', 'house wife', '0000-00-00', 'B+', '46', '148', '2016-02-25 00:00:00', '2016-03-11 00:00:00', '', 0, '', 1, 1, '2016-06-22 00:00:00'),
(24, 10024, 5, 3, 'chamber', 'Shahin Khan', 'Father', '23', 'Male', '0163542424424', '', '', '', 'miapur', 'Pabna', '6600', 'Bangladesh', 'Kader Khan', 'Male', '56', 'business', '0000-00-00', 'O+', '65', '156', '2016-02-26 00:00:00', '2016-03-22 09:30:00', '', 0, '', 1, 0, '0000-00-00 00:00:00'),
(25, 10025, 13, 16, 'chamber', 'Kodom Ali', 'Father', '56', 'Male', '012343535353', 'kodom@boidoo.com', 'kodom villa', '2', 'rasulpur', 'Pabna', 'santhia', 'Bangladesh', 'Badam Ali', 'Male', '120', 'retired police officer', '2016-01-04', '', '67', '145', '2016-02-28 00:00:00', '2016-03-08 11:30:00', '', 0, '', 0, 0, '0000-00-00 00:00:00'),
(26, 10026, 12, 17, 'chamber', 'Mr Selim Khan', 'Sister', '45', 'Male', '012343535353', 'seliom@boiddo.com', 'selim villa', '45', 'rasulpur', 'Pabna', 'santhia', 'Bangladesh', 'Reshma Khatun', 'Female', '34', 'service holder', '2016-02-05', '', '57', '147', '2016-02-28 00:00:00', '2016-03-04 16:20:00', '', 0, '', 1, 1, '2016-03-06 15:30:00'),
(29, 10029, 12, 17, 'chamber', 'Kodom Ali', 'Sister', '34', 'Male', '012343535353', '', '', '', 'rasulpur', 'Pabna', 'santhia', 'Bangladesh', 'Daliya Khatun', 'Female', '78', 'student', '2016-03-04', 'B+', '56', '145', '2016-03-05 00:00:00', '2016-03-12 10:00:00', '', 0, '', 1, 1, '2016-03-08 17:30:00'),
(30, 10030, 12, 18, 'chamber', 'Zafor Ali', 'Father', '45', 'Male', '012343535353', '', '', '', 'rasulpur', 'Pabna', 'santhia', 'Country', 'Kader Khan', 'Male', '76', 'business', '2016-02-28', 'B+', '67', '138', '2016-03-05 21:56:59', '2016-03-10 10:00:00', '', 0, '', 0, 0, '0000-00-00 00:00:00'),
(31, 10031, 5, 3, 'chamber', 'Name Of The Requestor', 'Son', '38', 'Male', '017534252556', '', 'house name', '1', 'town', 'City', 'police station', 'Country', 'Patient Name', 'Male', '8', 'baby', '2016-02-25', 'O+', '28', '94', '2016-03-05 23:52:14', '2016-03-18 10:00:00', '', 0, '', 1, 0, '0000-00-00 00:00:00'),
(32, 10032, 5, 3, 'chamber', 'Mr Selim Khan', 'Doughter', '34', 'Male', '012343535353', 'seliom@boiddo.com', 'selim villa', '45/B', 'Jaflong', 'Sylhet', 'santhia', 'Bangladesh', 'Daliya Khatun', 'Female', '6', 'student', '2016-04-06', 'B+', '34', '134', '2016-04-11 23:50:17', '2016-04-13 10:30:00', '', 0, '', 1, 1, '2016-06-16 08:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE IF NOT EXISTS `hospitals` (
  `hospital_id` int(16) NOT NULL AUTO_INCREMENT,
  `hospital_username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `hospital_email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `hospital_password` text COLLATE utf8_unicode_ci NOT NULL,
  `hospital_esmonth` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `hospital_esday` int(4) NOT NULL,
  `hospital_esyear` int(6) NOT NULL,
  `hospital_postcode` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `hospital_country` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `joindate` datetime NOT NULL,
  `activated` int(1) NOT NULL,
  `ip` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `lastlogin` datetime NOT NULL,
  `com_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated` int(1) NOT NULL DEFAULT '0',
  `published` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`hospital_id`),
  UNIQUE KEY `hospital_id` (`hospital_id`),
  UNIQUE KEY `hospital_username` (`hospital_username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`hospital_id`, `hospital_username`, `hospital_email`, `hospital_password`, `hospital_esmonth`, `hospital_esday`, `hospital_esyear`, `hospital_postcode`, `hospital_country`, `joindate`, `activated`, `ip`, `lastlogin`, `com_code`, `updated`, `published`) VALUES
(5, 'hospital', 'hospital@boiddo.com', 'd0970714757783e6cf17b26fb8e2298f', 'Oct', 16, 1984, '5675', 'Bangladesh', '2015-12-15 13:17:38', 1, '::1', '2015-12-15 17:47:42', '', 1, 1),
(6, 'ahos', 'ahos@boiddo.com', 'd0970714757783e6cf17b26fb8e2298f', 'Sep', 3, 1998, '54654', 'Bahrain', '2015-12-16 15:47:26', 1, '::1', '2015-12-16 15:48:29', '', 1, 1),
(7, 'newhos', 'newhos@boiddo.com', 'd0970714757783e6cf17b26fb8e2298f', 'Jun', 2, 1986, '4564', 'Bangladesh', '2015-12-16 16:45:14', 1, '::1', '2015-12-16 16:46:01', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hospitals_info`
--

CREATE TABLE IF NOT EXISTS `hospitals_info` (
  `hospital_id` int(16) NOT NULL AUTO_INCREMENT,
  `hospital_username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'hospital',
  `estd` int(6) NOT NULL,
  `temp_services` text COLLATE utf8_unicode_ci NOT NULL,
  `services` text COLLATE utf8_unicode_ci NOT NULL,
  `street_no` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `street_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `town` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `postcode` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `lat` double NOT NULL DEFAULT '0',
  `lng` double NOT NULL DEFAULT '0',
  `capacity` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `web` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `updated` int(1) NOT NULL DEFAULT '0',
  `published` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`hospital_id`),
  UNIQUE KEY `hospital_id` (`hospital_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `hospitals_info`
--

INSERT INTO `hospitals_info` (`hospital_id`, `hospital_username`, `fullname`, `category`, `estd`, `temp_services`, `services`, `street_no`, `street_name`, `town`, `city`, `postcode`, `country`, `lat`, `lng`, `capacity`, `phone`, `email`, `web`, `updated`, `published`) VALUES
(5, 'hospital', 'Hospital Name Two', 'hospital', 2010, 'a-ten/Emergency,a-six/Diagnostic imaging,a-eight/Ear nose and throat (ENT),a-seven/Discharge lounge', ' Emergency, Diagnostic imaging, Ear nose and throat (ENT), Discharge lounge', '34', 'Street Name', 'Town', 'Pabna', '6600', 'Bangladesh', 0, 0, '500', '454546545645', 'twohos@boiddo.com', 'www.twohos.com', 1, 0),
(6, 'ahos', 'Hospital Name Three', 'hospital', 1998, 'b-two/General surgery,a-six/Diagnostic imaging,a-three/Cardiology,a-eight/Ear nose and throat (ENT),b-one/Gastroenterology', ' General surgery, Diagnostic imaging, Cardiology, Ear nose and throat (ENT), Gastroenterology', '34', 'Street Name', 'Town', 'City', '45654', 'Bahrain', 0, 0, '450', '675765756765', 'another@boiddo.com', 'www.another.com', 1, 0),
(7, 'newhos', 'Hospital Name Somthing', 'hospital', 1994, 'a-two/Breast screening,a-ten/Emergency,a-seven/Discharge lounge,a-eight/Ear nose and throat (ENT),b-one/Gastroenterology,c-seven/Pharmacy', ' Breast screening, Emergency, Discharge lounge, Ear nose and throat (ENT), Gastroenterology, Pharmacy', '56', 'Street Name', 'Town', 'City', '3433', 'Bangladesh', 0, 0, '700', '56456456', 'example@host.com', 'www.hospital.com', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hospitals_options`
--

CREATE TABLE IF NOT EXISTS `hospitals_options` (
  `hospital_id` int(16) NOT NULL AUTO_INCREMENT,
  `hospital_username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `image` blob NOT NULL,
  `img_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `hospital_question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hospital_answer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `temp_pass` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `updated` int(1) NOT NULL DEFAULT '0',
  `published` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`hospital_id`),
  UNIQUE KEY `hospital_username` (`hospital_username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `hospitals_options`
--

INSERT INTO `hospitals_options` (`hospital_id`, `hospital_username`, `image`, `img_name`, `hospital_question`, `hospital_answer`, `temp_pass`, `updated`, `published`) VALUES
(5, 'hospital', 0x2e2e2f757365725f686f732f686f73706974616c2d3134343238363134302e706e67, 'hospital-144286140.png', '', '', '', 1, 0),
(6, 'ahos', 0x2e2e2f757365725f686f732f61686f73313130353339353437342e706e67, 'ahos1105395474.png', '', '', '', 1, 0),
(7, 'newhos', 0x2e2e2f757365725f686f732f6e6577686f732d3535393739393035312e706e67, 'newhos-559799051.png', '', '', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE IF NOT EXISTS `regions` (
  `region_id` int(16) NOT NULL AUTO_INCREMENT,
  `id` int(16) NOT NULL,
  `category` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `speciality` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `repeated` int(1) NOT NULL DEFAULT '0',
  `apt_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `apt_no` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `street_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `street_no` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `police_station` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `town` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `postcode` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `activated` int(1) NOT NULL,
  PRIMARY KEY (`region_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`region_id`, `id`, `category`, `speciality`, `name`, `sex`, `repeated`, `apt_name`, `apt_no`, `street_name`, `street_no`, `police_station`, `town`, `postcode`, `city`, `country`, `contact`, `activated`) VALUES
(9, 5, 'doctor', 'Cardiologist', 'Dr. Samiha  Jaman', '', 1, '', '', 'Street Name', '3', '', 'Town', '6600', 'Pabna', 'Bangladesh', '45645654', 1),
(10, 6, 'doctor', 'Gynecologic oncologist', 'Dr. Ahad  Sarkar', '', 1, '', '', 'Street Name', '3', '', 'Town', '4565', 'City', 'Bangladesh', '', 1),
(11, 7, 'doctor', 'Endocrinologist', 'Dr. Junayed  Kabir', '', 0, '', '', 'Street Name', '3', '', 'Town', '6574', 'City', 'Afghanistan', '', 1),
(12, 5, 'hospital', '', 'Hosptal Name Two', '', 0, '', '', 'Street Name', '34', '', 'Town', '6600', 'Pabna', 'Bangladesh', '', 1),
(13, 6, 'hospital', '', 'Hospital Name Three', '', 0, '', '', 'Street Name', '34', '', 'Town', '45654', 'City', 'Bahrain', '', 1),
(14, 7, 'hospital', '', 'Hospital Name Somthing', '', 0, '', '', 'Street Name', '56', '', 'Town', '3433', 'City', 'Bangladesh', '', 1),
(15, 8, 'doctor', 'Surgeon', 'Dr. Profile  Four', '', 1, '', '', 'Street Name', '56', '', 'Town', '3433', 'City', 'Costa Rica', '5676575', 1),
(16, 9, 'doctor', 'Gastroenterologist', 'Dr. Another  Profile', '', 1, '', '', 'Street Name', '', '', 'Town', '6600', 'Pabna', 'Bangladesh', '56756756', 1),
(17, 10, 'doctor', 'Hand surgeon', 'Dr. Abul  Kalam', '', 0, '', '', 'Street Name', '56', '', 'Town', '5880', 'City', 'Costa Rica', '546546456546546', 1),
(18, 11, 'doctor', 'Geriatric medicine specialist', 'Dr. Siman  Hotasifa', '', 0, '', '', 'Street Name', '3', '', 'Town', '567567', 'City', 'China', '', 1),
(19, 12, 'doctor', 'Cardiologist', 'Dr. Azad  Karim', '', 0, '', '', 'Main Road', '', '', 'Ganggohati', '6600', 'Santhia', 'Bangladesh', '56778878', 1),
(20, 0, 'chamber', 'Geriatric medicine specialist', 'Kabul chamber', '', 0, 'jamal villa', '23', 'jasimuddin street', '3', '', 'jahanabad', '34554', 'Panda', 'Afghanistan', '344456787', 0),
(21, 13, 'doctor', 'Cardiologist', 'Dr. Sayed  Azam', 'Male', 1, '', '', 'Zia Road', '2', '', 'Jamtola', '4545', 'Bogra', 'Bangladesh', '01723456545', 1),
(22, 0, 'chamber', 'Cardiologist', 'Sheikh medical hall', '', 0, '', '', 'main road', '', '', 'bonogram', '6600', 'Pabna', 'Bangladesh', '01721221438', 0),
(23, 0, 'chamber', 'Cardiologist', 'Mirza Medical Hall', '', 0, '', '', 'Bazar Road', '', '', 'Kashinathpur', '6600', 'Pabna', 'Bangladesh', '017345456543', 0),
(24, 0, 'chamber', 'Cardiologist', 'Jeson Pharmecy', '', 0, 'Khan Market', '3', 'Bypass Road', '3', '', 'Jamgora', '1248', 'Dhaka', 'Bangladesh', '0163485943', 0),
(25, 0, 'chamber', 'Cardiologist', 'Alif Pharmecy', '', 0, 'Jahid Market', '65', 'College Road', '', '', 'Miapur', '1248', 'Pabna', 'Bangladesh', '0163484543', 0),
(26, 22, 'chamber', 'Cardiologist', 'Shanto Pharmecy', '', 0, '', '', 'Main Road', '', '', 'Tarminal', '6600', 'Pabna', 'Bangladesh', '9045645546565', 0),
(27, 23, 'chamber', 'Cardiologist', 'Bangladesh Medical Hall', '', 0, '', '', 'College Road', '', '', 'Shibrampur', '6600', 'Pabna', 'Bangladesh', '7868678678', 0),
(28, 24, 'chamber', 'Cardiologist', 'Morol Pharmecy', '', 0, '', '', 'Main Road', '', '', 'Tarminal', '6600', 'Pabna', 'Bangladesh', '567567567657', 0),
(29, 25, 'chamber', 'Cardiologist', 'First Medical Hall', '', 0, '', '', 'Main Road', '', '', 'Tarminal', '6600', 'Pabna', 'Bangladesh', '0163485943', 0),
(30, 26, 'chamber', 'Gastroenterologist', 'Chamber For Another Doctor', '', 0, '', '', 'Main Road', '', '', 'Shajadnogor', '6554', 'Dhaka', 'Bangladesh', '46576454455', 0),
(31, 27, 'chamber', 'Geriatric medicine specialist', 'Ho Chi Min Medical Center', '', 0, 'Jagamufa ', '23', 'Sitofa Bypass', '4', '', 'Haskafina', '4565 CH', 'Sunghigh', 'China', '0243683363665', 0),
(32, 28, 'chamber', 'Hand surgeon', 'Zeson Phermecy', '', 0, 'Zeson Villa', '2', 'Jas Street', '', '', '', '45634', 'Costa Rica City', 'Costa Rica', '34345435345', 0),
(33, 14, 'doctor', '', '', 'Male', 0, '', '', '', '', '', '', '1200', '', 'Bangladesh', '', 0),
(34, 15, 'doctor', '', 'Dr. Zafor  Khan', 'Male', 1, 'Zafor Villa', '', 'Bypass Road', '', '', 'Laskarpur', '1100', 'Dhaka', 'Bangladesh', '54654645645', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
