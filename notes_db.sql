-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 27, 2017 at 03:01 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `notes`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `last_login` varchar(20) NOT NULL,
  `msg_code` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `name`, `user_name`, `password`, `status`, `last_login`, `msg_code`) VALUES
(1, '', 'admin', 'admin@123', 'Y', '06-12-2016', '53348'),
(2, 'saba', 'test@gmail.com', '123456', 'Y', '', ''),
(3, 'test one', 'test1@gmail.com', 'test@123', 'Y', '', ''),
(4, 'Suneel', '786sunil786@gmail.com', 'apjskj@@', 'Y', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_site`
--

CREATE TABLE IF NOT EXISTS `tbl_site` (
  `site_id` int(50) NOT NULL AUTO_INCREMENT,
  `last_form_no` int(50) NOT NULL,
  `site_name` varchar(100) NOT NULL,
  `site_title` varchar(100) NOT NULL,
  `site_description` text NOT NULL,
  `site_owner_name` varchar(100) NOT NULL,
  `site_owner_mobile` varchar(100) NOT NULL,
  `site_owner_email` varchar(100) NOT NULL,
  `site_owner_address` varchar(100) NOT NULL,
  `site_logo` varchar(100) NOT NULL,
  `site_metadata` varchar(100) NOT NULL,
  `site_p_name` varchar(25) NOT NULL,
  `site_p_sign` varchar(100) NOT NULL,
  `site_accountant_name` varchar(25) NOT NULL,
  `site_accountant_sign` varchar(100) NOT NULL,
  `site_fee_received_by` varchar(25) NOT NULL,
  `site_fee_received_sign` varchar(100) NOT NULL,
  `site_profile_name` varchar(50) NOT NULL,
  `site_profile_pic` varchar(50) NOT NULL,
  `site_otp` varchar(50) NOT NULL,
  PRIMARY KEY (`site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_site`
--

INSERT INTO `tbl_site` (`site_id`, `last_form_no`, `site_name`, `site_title`, `site_description`, `site_owner_name`, `site_owner_mobile`, `site_owner_email`, `site_owner_address`, `site_logo`, `site_metadata`, `site_p_name`, `site_p_sign`, `site_accountant_name`, `site_accountant_sign`, `site_fee_received_by`, `site_fee_received_sign`, `site_profile_name`, `site_profile_pic`, `site_otp`) VALUES
(1, 0, 'Alfa Coins', 'Alfa Coins', 'Alfa Coins', 'Alfa Coins', 'Alfa Coins', 'Alfa Coins', 'Alfa Coins', '15080631331507828802alfa3.gif', 'Alfa Coins', '', '1481540171sign.jpg', '', '1481540171sign.jpg', '', '', 'Alfa Coins', '15080631331507828802alfa3.gif', '1234567890');
