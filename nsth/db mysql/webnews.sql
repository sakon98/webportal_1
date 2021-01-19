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
-- โครงสร้างตาราง `webnews`
--

CREATE TABLE IF NOT EXISTS `webnews` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `coop_id` varchar(8) NOT NULL,
  `n_topic` varchar(1000) NOT NULL,
  `n_details` varchar(5000) NOT NULL,
  `n_date` datetime NOT NULL,
  `count_edit` int(5) NOT NULL DEFAULT '0',
  `who_post` varchar(15) NOT NULL,
  `who_edit` varchar(15) DEFAULT NULL,
  `FilesName` varchar(500) NOT NULL,
  `GroupShow` varchar(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `n_id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=tis620 AUTO_INCREMENT=19 ;

--
-- dump ตาราง `webnews`
--

INSERT INTO `webnews` (`id`, `coop_id`, `n_topic`, `n_details`, `n_date`, `count_edit`, `who_post`, `who_edit`, `FilesName`, `GroupShow`) VALUES
(1, '500001', 'ประกาศ หากการใช้งานมีปัญหากรุณาติดต่อเจ้าหน้าที่', 'ขณะนี้กำลังอยู่ในช่วงทดสอบระบบใหม่ หากการใช้งานมีปัญหา หรือติดขัดประการใด กรุณาติดต่อเจ้าหน้าที่ ', '2017-11-22 10:51:00', 1, 'administrator', 'administrator', '1', ''),
(18, '', 'test', 'รายละเอียด', '2018-06-01 05:04:15', 0, 'administrator', NULL, '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
