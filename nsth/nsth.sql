-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2019 at 10:51 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stk`
--

-- --------------------------------------------------------

--
-- Table structure for table `upload_consult`
--

CREATE TABLE IF NOT EXISTS `upload_consult` (
  `id_consult` decimal(15,0) NOT NULL DEFAULT '0',
  `file_topic_consult` varchar(100) DEFAULT NULL,
  `filesname_consult` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_consult`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- --------------------------------------------------------

--
-- Table structure for table `upload_overall`
--

CREATE TABLE IF NOT EXISTS `upload_overall` (
  `id_overall` decimal(15,0) NOT NULL DEFAULT '0',
  `file_topic_overall` varchar(100) DEFAULT NULL,
  `filesname_overall` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_overall`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- --------------------------------------------------------

--
-- Table structure for table `upload_standard`
--

CREATE TABLE IF NOT EXISTS `upload_standard` (
  `id_standard` decimal(15,0) NOT NULL DEFAULT '0',
  `file_topic_standard` varchar(100) DEFAULT NULL,
  `filesname_standard` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_standard`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- --------------------------------------------------------

--
-- Table structure for table `webconfiguration`
--

CREATE TABLE IF NOT EXISTS `webconfiguration` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `coop_id` varchar(8) NOT NULL,
  `type_config` varchar(200) NOT NULL,
  `desc` varchar(2000) NOT NULL,
  `value` varchar(2000) NOT NULL,
  `groupconfig` varchar(100) NOT NULL,
  `seq_no` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=tis620 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `webconfiguration`
--

INSERT INTO `webconfiguration` (`id`, `coop_id`, `type_config`, `desc`, `value`, `groupconfig`, `seq_no`) VALUES
(1, '', 'confirm_date', 'วันในระบบการยืนยันยอดสิ้นสุดถึงวันใหน', '30/06/2557', '', 0),
(2, '', 'confirm_date_start', 'วันเริ่มให้ทำการยืนยันยอด', '30/06/2557', '', 0),
(3, '', 'confirm_date_end', 'วันสิ้นสุดการยืนยันยอด', '30/06/2557', '', 0),
(4, '', 'connection', 'วิธีการเชื่อมต่อใช้อะไรเป็นการบันทึก 0 คือ MySql สมาชิกสามารถสมัครและเปลี่ยน password ได้ 1 คือ Oracle สมาชิกต้องใช้รหัสที่สหกรณ์กำหนด จาก Column Web_Code', '0', '', 0),
(5, '', 'confirm2use', 'เชื่อมต่อแบบ MySql สมาชิกจะต้องมีการยืนยันตนหรือไม่', '0', '', 0),
(6, '', 'email_register', 'เชื่อมต่อแบบ MySql บังคับสมาชิกใส่ email ในการสมัครหรือไม่', '0', '', 0),
(7, '', 'printslip', 'เปิดให้ระบบสามารถพิมพ์ใบเสร็จออนไลท์ ได้หรือไม่', '1', '', 0),
(8, '', 'confirmbalance', 'เปิดระบบยืนยันยอดหรือไม่', '1', '', 0),
(9, '', 'repassword', 'เปิดระบบการตั้งค่า password กลางในกรณีที่สมาชิกลืม password ให้ Admin กำหนดเป็น 1234 หรือไม่', '1', '', 0),
(10, '', 'webmobile', 'เปิดให้บริการระบบบริการสมาชิกแบบ มือถือ หรือไม่', '1', '', 0),
(11, '', 'title', 'ชื่อสหกรณ์', '', '', 0),
(12, '', 'title1', 'ชื่อย่อสหกรณ์', '', '', 0),
(13, '', 'address', 'ที่อยู่ของสหกรณ์', '', '', 0),
(14, '', 'credite', 'ข้อมูลด้านล่างสุดของ WebSite', '&copy; 2014  All Rights Reserved  <a href="http://www.cddco-op.com//" target="new">www.cddco-op.com</a> | Desige By <a href="http://www.isocare.co.th" target="new">Isocare System Co.,Ltd&#8482; </a>', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `webconfirm_balance`
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

-- --------------------------------------------------------

--
-- Table structure for table `webcoopinfo`
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
-- Dumping data for table `webcoopinfo`
--

INSERT INTO `webcoopinfo` (`id`, `coop_id`, `coop_name_th`, `coop_name_eng`, `coop_short_name`, `coop_website`) VALUES
(1, '500001', 'สหกรณ์ออมทรัพย์ครูตาก จำกัด', '', 'สอ.ครูตาก จำกัด', 'http://www.taktcoop1.com/');

-- --------------------------------------------------------

--
-- Table structure for table `weblog_action`
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
) ENGINE=MyISAM  DEFAULT CHARSET=tis620 AUTO_INCREMENT=4432 ;

-- --------------------------------------------------------

--
-- Table structure for table `webmbmembmaster`
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
) ENGINE=MyISAM  DEFAULT CHARSET=tis620 AUTO_INCREMENT=1305 ;

-- --------------------------------------------------------

--
-- Table structure for table `webmenu`
--

CREATE TABLE IF NOT EXISTS `webmenu` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `coop_id` varchar(8) NOT NULL,
  `class_menu` varchar(15) NOT NULL,
  `menu` varchar(100) NOT NULL,
  `menu_desc` varchar(100) NOT NULL,
  `details` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `webnews`
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
) ENGINE=MyISAM  DEFAULT CHARSET=tis620 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `webnews`
--

INSERT INTO `webnews` (`id`, `coop_id`, `n_topic`, `n_details`, `n_date`, `count_edit`, `who_post`, `who_edit`, `FilesName`, `GroupShow`) VALUES
(1, '500001', 'ประกาศ หากการใช้งานมีปัญหากรุณาติดต่อเจ้าหน้าที่', 'ขณะนี้กำลังอยู่ในช่วงทดสอบระบบใหม่ หากการใช้งานมีปัญหา หรือติดขัดประการใด กรุณาติดต่อเจ้าหน้าที่ ', '2017-11-22 10:51:00', 1, 'administrator', 'administrator', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `websms`
--

CREATE TABLE IF NOT EXISTS `websms` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `seq_no` int(8) NOT NULL,
  `sms_msg` varchar(160) NOT NULL,
  `sms_response` varchar(1000) NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `webstaff_info`
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
-- Dumping data for table `webstaff_info`
--

INSERT INTO `webstaff_info` (`id`, `coop_id`, `staff_name`, `staff_user`, `staff_pwd`, `staff_level`) VALUES
(1, '', 'ผู้ดูแลระบบ', 'administrator', '21232f297a57a5a743894a0e4a801fc3', '8c1858d1e1e23ddb8e519f29735c496e');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
