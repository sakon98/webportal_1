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
-- โครงสร้างตาราง `webcoopinfo`
--

CREATE TABLE IF NOT EXISTS `webcoopinfo` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `coop_id` varchar(8) NOT NULL,
  `coop_name_th` varchar(1000) NOT NULL,
  `coop_name_eng` varchar(1000) NOT NULL,
  `coop_short_name` varchar(200) NOT NULL,
  `coop_website` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=tis620 AUTO_INCREMENT=2 ;

--
-- dump ตาราง `webcoopinfo`
--

INSERT INTO `webcoopinfo` (`id`, `coop_id`, `coop_name_th`, `coop_name_eng`, `coop_short_name`, `coop_website`) VALUES
(1, '500001', 'สหกรณ์ออมทรัพย์ครูตาก จำกัด', 'Tak Saving and Credit Co-operative for Officeials in Ministry of Education Limited', 'สอ.ครูตาก จำกัด', 'http://www.taktcoop1.com/');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
