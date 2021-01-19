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
-- โครงสร้างตาราง `webstaff_info`
--

CREATE TABLE IF NOT EXISTS `webstaff_info` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `coop_id` varchar(8) NOT NULL,
  `staff_name` varchar(300) NOT NULL,
  `staff_user` varchar(100) NOT NULL,
  `staff_pwd` varchar(32) NOT NULL,
  `staff_level` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=tis620 AUTO_INCREMENT=3 ;

--
-- dump ตาราง `webstaff_info`
--

INSERT INTO `webstaff_info` (`id`, `coop_id`, `staff_name`, `staff_user`, `staff_pwd`, `staff_level`) VALUES
(1, '', 'ผู้ดูแลระบบ', 'administrator', '21232f297a57a5a743894a0e4a801fc3', '8c1858d1e1e23ddb8e519f29735c496e');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
