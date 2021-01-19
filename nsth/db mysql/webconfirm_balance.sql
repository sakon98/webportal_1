-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iscostkdata`
--

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `webconfirm_balance`
--

CREATE TABLE IF NOT EXISTS `webconfirm_balance` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `coop_id` varchar(8) NOT NULL,
  `member_no` varchar(8) NOT NULL,
  `fullname` varchar(60) NOT NULL,
  `confirmation` date NOT NULL DEFAULT '0000-00-00',
  `confirm_status` varchar(1) NOT NULL,
  `reason` varchar(250) NOT NULL,
  `membgroup_code` varchar(8) NOT NULL,
  `department_code` varchar(8) NOT NULL,
  `position_code` varchar(8) NOT NULL,
  `comfirmdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(15) NOT NULL,
  `print` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
