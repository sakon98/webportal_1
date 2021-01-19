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
-- โครงสร้างตาราง `webconfiguration`
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
-- dump ตาราง `webconfiguration`
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
