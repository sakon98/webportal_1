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
-- โครงสร้างตาราง `webmbmembmaster`
--

CREATE TABLE IF NOT EXISTS `webmbmembmaster` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `coop_id` varchar(8) NOT NULL,
  `member_no` varchar(8) NOT NULL,
  `memb_fullname` varchar(250) NOT NULL,
  `idcard` varchar(13) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `mobile` varchar(250) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `date_reg` datetime DEFAULT NULL,
  `ipconnect` varchar(25) DEFAULT NULL,
  `confirm_date` datetime DEFAULT NULL,
  `who_approve` varchar(100) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=tis620 AUTO_INCREMENT=1308 ;

--
-- dump ตาราง `webmbmembmaster`
--

INSERT INTO `webmbmembmaster` (`id`, `coop_id`, `member_no`, `memb_fullname`, `idcard`, `email`, `mobile`, `password`, `date_reg`, `ipconnect`, `confirm_date`, `who_approve`, `pwd`) VALUES
(1305, '', '00000151', 'นางนิภาพร  ทองโพธิ์ศรี', '5630190017991', '', '089-1486714', '1bbd886460827015e5d605ed44252251', '2018-05-30 17:37:47', '::1', NULL, NULL, NULL),
(1306, '', '00000523', 'นางอุบลวรรณ  เคลือบแก้ว', '3630100568164', '', '', '81dc9bdb52d04dc20036dbd8313ed055', '2018-06-01 05:00:42', '180.183.182.28', NULL, NULL, NULL),
(1307, '', '00000523', 'นางอุบลวรรณ  เคลือบแก้ว', '3630100568164', 'bolwan15@gmail.com', '0917120658', '5802b8ca7d9a639614f51a457ba11c87', '2018-06-12 03:59:39', '180.183.180.167', NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
