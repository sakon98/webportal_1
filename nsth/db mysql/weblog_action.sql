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
-- โครงสร้างตาราง `weblog_action`
--

CREATE TABLE IF NOT EXISTS `weblog_action` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `coop_id` varchar(8) NOT NULL,
  `action_do` varchar(100) NOT NULL,
  `action_desc` varchar(250) DEFAULT NULL,
  `action_id` varchar(100) DEFAULT NULL,
  `user` varchar(100) NOT NULL,
  `ipconnect` varchar(25) NOT NULL,
  `date_log` datetime NOT NULL,
  `connectby` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=tis620 AUTO_INCREMENT=4456 ;

--
-- dump ตาราง `weblog_action`
--

INSERT INTO `weblog_action` (`id`, `coop_id`, `action_do`, `action_desc`, `action_id`, `user`, `ipconnect`, `date_log`, `connectby`) VALUES
(4432, '', 'Login', 'bypass', NULL, 'administrator', '::1', '2018-05-30 17:34:19', 'desktop'),
(4433, '', 'Register', NULL, NULL, '00000151', '::1', '2018-05-30 17:37:47', 'desktop'),
(4434, '', 'Login', NULL, NULL, '00000151', '::1', '2018-05-30 17:38:47', 'desktop'),
(4435, '', 'Login', NULL, NULL, '00000151', '::1', '2018-05-30 17:38:56', 'desktop'),
(4436, '', 'Change Password', NULL, NULL, '00000151', '::1', '2018-05-30 17:39:10', 'desktop'),
(4437, '', 'Login', NULL, NULL, '00000151', '::1', '2018-05-30 17:39:19', 'desktop'),
(4438, '', 'Login', 'bypass', NULL, '00000151', '::1', '2018-05-31 13:30:03', 'desktop'),
(4439, '', 'Login', 'bypass', NULL, '00000151', '180.183.182.28', '2018-05-31 13:36:25', 'desktop'),
(4440, '', 'Login', 'bypass', NULL, 'administrator', '180.183.182.28', '2018-05-31 13:39:41', 'desktop'),
(4441, '', 'Register', NULL, NULL, '00000523', '180.183.182.28', '2018-06-01 05:00:42', 'desktop'),
(4442, '', 'Login', NULL, NULL, '00000523', '180.183.182.28', '2018-06-01 05:01:10', 'desktop'),
(4443, '', 'Login', 'bypass', NULL, 'administrator', '180.183.182.28', '2018-06-01 05:03:31', 'desktop'),
(4444, '', 'webnews', 'Add', '18', 'administrator', '180.183.182.28', '2018-06-01 05:04:15', 'desktop'),
(4445, '', 'Login', 'bypass', NULL, '00000523', '180.183.182.28', '2018-06-01 05:11:12', 'desktop'),
(4446, '', 'Login', 'bypass', NULL, '00000523', '180.183.182.28', '2018-06-01 05:52:25', 'desktop'),
(4447, '', 'Login', 'bypass', NULL, 'administrator', '180.183.182.28', '2018-06-01 06:04:18', 'desktop'),
(4448, '', 'Reset Password', 'Update', '00000523', 'administrator', '', '2018-06-01 06:04:25', ''),
(4449, '', 'Login', NULL, NULL, '00000523', '180.183.182.28', '2018-06-01 06:04:41', 'desktop'),
(4450, '', 'Login', 'bypass', NULL, '00000523', '180.183.182.28', '2018-06-01 06:11:23', 'desktop'),
(4451, '', 'Login', 'bypass', NULL, '00000523', '180.183.182.28', '2018-06-01 08:51:03', 'desktop'),
(4452, '', 'Login', 'bypass', NULL, '00000151', '180.183.206.48', '2018-06-04 07:13:05', 'desktop'),
(4453, '', 'Login', 'bypass', NULL, '00000151', '180.183.206.48', '2018-06-04 07:16:13', 'desktop'),
(4454, '', 'Login', 'bypass', NULL, '00000151', '180.183.206.48', '2018-06-04 07:17:09', 'desktop'),
(4455, '', 'Register', NULL, NULL, '00000523', '180.183.180.167', '2018-06-12 03:59:39', 'desktop');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
