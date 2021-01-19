-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2018 at 04:25 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iscobtgdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE IF NOT EXISTS `configuration` (
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
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`id`, `coop_id`, `type_config`, `desc`, `value`, `groupconfig`, `seq_no`) VALUES
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
-- Table structure for table `confirm_balance`
--

CREATE TABLE IF NOT EXISTS `confirm_balance` (
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
-- Table structure for table `coopinfo`
--

CREATE TABLE IF NOT EXISTS `coopinfo` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `coop_id` varchar(8) NOT NULL,
  `coop_name_th` varchar(1000) NOT NULL,
  `coop_name_eng` varchar(1000) NOT NULL,
  `coop_short_name` varchar(200) NOT NULL,
  `coop_website` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=tis620 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `coopinfo`
--

INSERT INTO `coopinfo` (`id`, `coop_id`, `coop_name_th`, `coop_name_eng`, `coop_short_name`, `coop_website`) VALUES
(1, '500001', 'สหกรณ์ออมทรัพย์พนักงานเครือเบทาโกร จำกัด', 'Betagro Group Employee Savings Cooperative Ltd.', 'สหกรณ์ออมทรัพย์พนักงานเครือเบทาโกร จำกัด', 'http://th-th915031.panpages.co.th/');

-- --------------------------------------------------------

--
-- Table structure for table `log_action`
--

CREATE TABLE IF NOT EXISTS `log_action` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=tis620 AUTO_INCREMENT=4384 ;

--
-- Dumping data for table `log_action`
--

INSERT INTO `log_action` (`id`, `coop_id`, `action_do`, `action_desc`, `action_id`, `user`, `ipconnect`, `date_log`, `connectby`) VALUES
(4259, '', 'Login', NULL, NULL, '00000663', '::1', '2018-03-26 10:45:01', 'desktop'),
(4260, '', 'Login', 'bypass', NULL, 'administrator', '::1', '2018-03-26 10:45:22', 'desktop'),
(4261, '', 'Login', NULL, NULL, '00000663', '::1', '2018-03-26 10:51:56', 'desktop'),
(4262, '', 'Register', NULL, NULL, '00000096', '::1', '2018-03-26 11:00:03', 'desktop'),
(4263, '', 'Register', NULL, NULL, '00001944', '::1', '2018-03-26 11:02:38', 'desktop'),
(4264, '', 'Register', NULL, NULL, '00001400', '::1', '2018-03-26 11:05:35', 'desktop'),
(4265, '', 'Login', NULL, NULL, '00000663', '::1', '2018-03-26 11:12:37', 'desktop'),
(4266, '', 'Register', NULL, NULL, '00001277', '::1', '2018-03-26 11:25:33', 'desktop'),
(4267, '', 'Login', 'bypass', NULL, 'administrator', '::1', '2018-03-26 11:55:11', 'desktop'),
(4268, '', 'Login', NULL, NULL, '00000096', '::1', '2018-03-26 12:02:51', 'desktop'),
(4269, '', 'Register', NULL, NULL, '00008000', '::1', '2018-03-26 14:03:09', 'desktop'),
(4270, '', 'Login', NULL, NULL, '00008000', '10.254.10.245', '2018-03-26 14:11:07', 'desktop'),
(4271, '', 'Login', 'bypass', NULL, 'administrator', '10.254.10.245', '2018-03-26 14:19:36', 'desktop'),
(4272, '', 'Login', NULL, NULL, '00008000', '10.254.10.245', '2018-03-26 14:20:16', 'desktop'),
(4273, '', 'Login', NULL, NULL, '00001400', '10.254.10.245', '2018-03-26 14:29:32', 'desktop'),
(4274, '', 'Login', NULL, NULL, '00008000', '10.254.10.245', '2018-03-26 14:31:12', 'desktop'),
(4275, '', 'Login', NULL, NULL, '00001400', '10.254.10.245', '2018-03-26 14:32:18', 'desktop'),
(4276, '', 'Login', NULL, NULL, '00008000', '10.254.10.245', '2018-03-26 14:33:33', 'desktop'),
(4277, '', 'Register', NULL, NULL, '00007486', '172.30.30.112', '2018-03-26 14:37:26', 'desktop'),
(4278, '', 'Login', NULL, NULL, '00001400', '10.254.10.245', '2018-03-26 14:39:03', 'desktop'),
(4279, '', 'Login', NULL, NULL, '00008000', '10.254.10.245', '2018-03-26 14:39:49', 'desktop'),
(4280, '', 'Register', NULL, NULL, '00009725', '172.30.6.103', '2018-03-26 14:53:12', 'desktop'),
(4281, '', 'Login', NULL, NULL, '00009725', '172.30.6.103', '2018-03-26 15:13:25', 'desktop'),
(4282, '', 'Register', NULL, NULL, '00004560', '172.30.6.113', '2018-03-26 15:15:07', 'desktop'),
(4283, '', 'Login', NULL, NULL, '00009725', '172.30.6.103', '2018-03-26 15:17:01', 'desktop'),
(4284, '', 'Login', NULL, NULL, '00007486', '172.30.30.112', '2018-03-26 15:47:13', 'desktop'),
(4285, '', 'Login', 'bypass', NULL, 'administrator', '172.30.30.112', '2018-03-26 15:58:31', 'desktop'),
(4286, '', 'Login', NULL, NULL, '00001400', '10.254.10.245', '2018-03-26 16:00:07', 'desktop'),
(4287, '', 'Login', NULL, NULL, '00001400', '10.254.10.245', '2018-03-26 16:01:58', 'desktop'),
(4288, '', 'Login', NULL, NULL, '00008000', '10.254.10.245', '2018-03-26 16:02:51', 'desktop'),
(4289, '', 'Reset Password', 'Update', '', 'administrator', '', '2018-03-26 11:04:24', ''),
(4290, '', 'Login', 'bypass', NULL, 'administrator', '172.30.30.112', '2018-03-26 16:11:34', 'desktop'),
(4291, '', 'Reset Password', 'Update', '', 'administrator', '', '2018-03-26 11:11:53', ''),
(4292, '', 'Login', 'bypass', NULL, 'administrator', '172.30.30.112', '2018-03-26 16:13:20', 'desktop'),
(4293, '', 'Reset Password', 'Update', '', 'administrator', '', '2018-03-26 11:13:37', ''),
(4294, '', 'Login', 'bypass', NULL, 'administrator', '10.254.10.245', '2018-03-26 16:14:38', 'desktop'),
(4295, '', 'Reset Password', 'Update', '', 'administrator', '', '2018-03-26 11:15:06', ''),
(4296, '', 'Login', 'bypass', NULL, 'administrator', '10.254.10.245', '2018-03-26 16:15:41', 'desktop'),
(4297, '', 'Reset Password', 'Update', '', 'administrator', '', '2018-03-26 11:15:54', ''),
(4298, '', 'Login', 'bypass', NULL, 'administrator', '172.30.30.112', '2018-03-26 16:21:14', 'desktop'),
(4299, '', 'Login', NULL, NULL, '00007486', '172.30.30.112', '2018-03-26 16:22:29', 'desktop'),
(4300, '', 'Register', NULL, NULL, '00002166', '167.97.9.112', '2018-03-26 16:33:42', 'desktop'),
(4301, '', 'Login', NULL, NULL, '00008000', '10.254.10.245', '2018-03-26 16:46:15', 'desktop'),
(4302, '', 'Register', NULL, NULL, '00005449', '172.30.28.84', '2018-03-26 16:52:01', 'desktop'),
(4303, '', 'Login', NULL, NULL, '00005449', '172.30.28.84', '2018-03-26 17:08:30', 'desktop'),
(4304, '', 'Login', 'bypass', NULL, 'administrator', '10.254.10.245', '2018-03-26 17:10:18', 'desktop'),
(4305, '', 'news', 'Add', '13', 'administrator', '10.254.10.245', '2018-03-26 17:11:07', 'desktop'),
(4306, '', 'Login', NULL, NULL, '00008000', '10.254.11.62', '2018-03-27 00:20:04', 'desktop'),
(4307, '', 'Login', 'bypass', NULL, 'administrator', '10.254.11.62', '2018-03-27 00:21:47', 'desktop'),
(4308, '', 'Login', 'bypass', NULL, 'administrator', '10.254.11.121', '2018-03-27 08:54:08', 'desktop'),
(4309, '', 'Login', 'bypass', NULL, 'administrator', '10.254.11.121', '2018-03-27 09:51:24', 'desktop'),
(4310, '', 'Login', NULL, NULL, '00008000', '10.254.11.75', '2018-03-28 13:56:02', 'desktop'),
(4311, '', 'Login', NULL, NULL, '00001400', '10.254.11.75', '2018-03-28 14:04:42', 'desktop'),
(4312, '', 'Login', NULL, NULL, '00008000', '10.254.11.75', '2018-03-28 15:03:54', 'desktop'),
(4313, '', 'Login', NULL, NULL, '00001400', '10.254.11.75', '2018-03-28 15:07:11', 'desktop'),
(4314, '', 'Login', NULL, NULL, '00001400', '10.254.11.75', '2018-03-28 15:23:00', 'desktop'),
(4315, '', 'Login', NULL, NULL, '00008000', '10.254.11.75', '2018-03-28 15:28:03', 'desktop'),
(4316, '', 'Login', NULL, NULL, '00004560', '172.30.6.108', '2018-03-28 15:29:02', 'desktop'),
(4317, '', 'Login', NULL, NULL, '00007486', '172.30.29.96', '2018-03-29 13:08:15', 'desktop'),
(4318, '', 'Login', NULL, NULL, '00001400', '10.254.10.202', '2018-03-29 14:23:05', 'desktop'),
(4319, '', 'Login', NULL, NULL, '00008000', '10.254.10.202', '2018-03-29 14:28:27', 'desktop'),
(4320, '', 'Login', NULL, NULL, '00008000', '10.254.10.202', '2018-03-29 17:18:36', 'desktop'),
(4321, '', 'Login', NULL, NULL, '00004560', '172.30.6.116', '2018-03-30 08:41:32', 'desktop'),
(4322, '', 'Login', 'bypass', NULL, '00000663', '::1', '2018-04-02 08:53:00', 'desktop'),
(4323, '', 'Login', NULL, NULL, '00008000', '10.254.10.38', '2018-04-02 10:42:10', 'desktop'),
(4324, '', 'Login', NULL, NULL, '00001400', '10.254.10.38', '2018-04-02 10:42:34', 'desktop'),
(4325, '', 'Login', 'bypass', NULL, '00000663', '::1', '2018-04-02 11:20:02', 'desktop'),
(4326, '', 'Login', 'bypass', NULL, '00000663', '::1', '2018-04-02 11:22:02', 'desktop'),
(4327, '', 'Login', 'bypass', NULL, '00000096', '::1', '2018-04-02 11:22:24', 'desktop'),
(4328, '', 'Login', 'bypass', NULL, '00001944', '::1', '2018-04-02 11:22:37', 'desktop'),
(4329, '', 'Login', 'bypass', NULL, '00001400', '::1', '2018-04-02 11:22:52', 'desktop'),
(4330, '', 'Login', 'bypass', NULL, '00001277', '::1', '2018-04-02 11:23:04', 'desktop'),
(4331, '', 'Login', 'bypass', NULL, '00008000', '::1', '2018-04-02 11:23:20', 'desktop'),
(4332, '', 'Login', 'bypass', NULL, '00007486', '::1', '2018-04-02 11:24:42', 'desktop'),
(4333, '', 'Login', 'bypass', NULL, '00009725', '::1', '2018-04-02 11:25:02', 'desktop'),
(4334, '', 'Login', 'bypass', NULL, '00004560', '::1', '2018-04-02 11:25:16', 'desktop'),
(4335, '', 'Login', 'bypass', NULL, '00002166', '::1', '2018-04-02 11:25:26', 'desktop'),
(4336, '', 'Login', 'bypass', NULL, '00005449', '::1', '2018-04-02 11:25:50', 'desktop'),
(4337, '', 'Login', 'bypass', NULL, 'administrator', '::1', '2018-04-02 11:28:16', 'desktop'),
(4338, '', 'Reset Password', 'Update', '', 'administrator', '', '2018-04-02 06:28:34', ''),
(4339, '', 'Login', 'bypass', NULL, 'administrator', '::1', '2018-04-02 11:33:33', 'desktop'),
(4340, '', 'Reset Password', 'Update', '', 'administrator', '', '2018-04-02 06:33:59', ''),
(4341, '', 'Reset Password', 'Update', '', 'administrator', '', '2018-04-02 06:37:31', ''),
(4342, '', 'Reset Password', 'Update', '00008000', 'administrator', '', '2018-04-02 06:41:30', ''),
(4343, '', 'Reset Password', 'Update', '00008000', 'administrator', '', '2018-04-02 07:10:56', ''),
(4344, '', 'Login', NULL, NULL, '00008000', '::1', '2018-04-02 12:11:06', 'desktop'),
(4345, '', 'Change Password', NULL, NULL, '00008000', '::1', '2018-04-02 12:11:20', 'desktop'),
(4346, '', 'Login', NULL, NULL, '00008000', '::1', '2018-04-02 12:11:29', 'desktop'),
(4347, '', 'Login', 'bypass', NULL, 'administrator', '::1', '2018-04-02 12:11:37', 'desktop'),
(4348, '', 'Reset Password', 'Update', '00008000', 'administrator', '', '2018-04-02 07:11:47', ''),
(4349, '', 'Login', NULL, NULL, '00008000', '::1', '2018-04-02 12:11:52', 'desktop'),
(4350, '', 'Login', 'bypass', NULL, '00008000', '::1', '2018-04-02 12:39:47', 'desktop'),
(4351, '', 'Login', 'bypass', NULL, '00008000', '::1', '2018-04-02 13:08:03', 'desktop'),
(4352, '', 'Login', 'bypass', NULL, '00008351', '::1', '2018-04-02 19:44:39', 'desktop'),
(4353, '', 'Login', 'bypass', NULL, '00000064', '::1', '2018-04-02 19:51:10', 'desktop'),
(4354, '', 'Login', 'bypass', NULL, '00004678', '::1', '2018-04-02 20:05:21', 'desktop'),
(4355, '', 'Login', NULL, NULL, '00008000', '10.254.11.53', '2018-04-03 05:00:32', 'desktop'),
(4356, '', 'Login', NULL, NULL, '00001400', '10.254.11.53', '2018-04-03 05:23:40', 'desktop'),
(4357, '', 'Login', 'bypass', NULL, '00000663', '::1', '2018-04-04 12:24:53', 'desktop'),
(4358, '', 'Login', 'bypass', NULL, '00000663', '::1', '2018-04-04 12:26:16', 'desktop'),
(4359, '', 'Login', NULL, NULL, '00007486', '172.30.30.68', '2018-04-10 08:45:14', 'desktop'),
(4360, '', 'Login', NULL, NULL, '00007486', '167.97.9.112', '2018-05-02 09:39:45', 'desktop'),
(4361, '', 'Login', 'bypass', NULL, 'administrator', '172.17.30.44', '2018-05-02 09:41:17', 'desktop'),
(4362, '', 'Login', 'bypass', NULL, 'administrator', '167.97.9.112', '2018-05-02 10:19:58', 'desktop'),
(4363, '', 'news', 'Add', '14', 'administrator', '167.97.9.112', '2018-05-02 10:23:42', 'desktop'),
(4364, '', 'Login', NULL, NULL, '00007486', '167.97.9.112', '2018-05-02 10:26:14', 'desktop'),
(4365, '', 'Login', NULL, NULL, '00007486', '167.97.9.112', '2018-05-02 10:30:05', 'desktop'),
(4366, '', 'Login', 'bypass', NULL, 'administrator', '167.97.9.112', '2018-05-02 11:50:04', 'desktop'),
(4367, '', 'Login', NULL, NULL, '00007486', '167.97.9.112', '2018-05-02 12:48:30', 'desktop'),
(4368, '', 'Login', NULL, NULL, '00007486', '167.97.9.112', '2018-05-03 12:02:27', 'desktop'),
(4369, '', 'Login', NULL, NULL, '00007486', '167.97.9.112', '2018-05-04 11:08:34', 'desktop'),
(4370, '', 'Login', NULL, NULL, '00004560', '172.30.6.119', '2018-05-07 05:47:33', 'desktop'),
(4371, '', 'Login', 'bypass', NULL, '00001990', '10.254.10.101', '2018-05-08 05:43:00', 'desktop'),
(4372, '', 'Login', NULL, NULL, '00007486', '172.30.29.107', '2018-05-08 05:56:39', 'desktop'),
(4373, '', 'Login', 'bypass', NULL, '00001990', '10.254.10.101', '2018-05-08 06:04:43', 'desktop'),
(4374, '', 'Login', 'bypass', NULL, '00001990', '10.254.10.101', '2018-05-08 06:04:43', 'desktop'),
(4375, '', 'Login', 'bypass', NULL, '00001990', '10.254.11.48', '2018-05-08 11:14:43', 'desktop'),
(4376, '', 'Login', 'bypass', NULL, 'administrator', '10.254.10.52', '2018-05-08 11:16:37', 'desktop'),
(4377, '', 'Reset Password', 'Update', '00005449', 'administrator', '', '2018-05-08 11:17:37', ''),
(4378, '', 'Login', NULL, NULL, '00007486', '172.30.29.107', '2018-05-08 11:18:23', 'desktop'),
(4379, '', 'Login', NULL, NULL, '00005449', '172.30.29.199', '2018-05-08 11:18:47', 'desktop'),
(4380, '', 'Login', NULL, NULL, '00005449', '172.30.28.46', '2018-05-10 09:47:00', 'desktop'),
(4381, '', 'Login', 'bypass', NULL, '00005546', '::1', '2018-05-16 08:35:36', 'desktop'),
(4382, '', 'Login', NULL, NULL, '00004560', '172.30.6.106', '2018-05-16 09:32:40', 'desktop'),
(4383, '', 'Login', NULL, NULL, '00005449', '172.30.28.27', '2018-05-16 09:44:16', 'desktop');

-- --------------------------------------------------------

--
-- Table structure for table `mbmembmaster`
--

CREATE TABLE IF NOT EXISTS `mbmembmaster` (
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
  `date_log` datetime DEFAULT NULL,
  `passpwd` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=tis620 AUTO_INCREMENT=1292 ;

--
-- Dumping data for table `mbmembmaster`
--

INSERT INTO `mbmembmaster` (`id`, `coop_id`, `member_no`, `memb_fullname`, `idcard`, `email`, `mobile`, `password`, `date_reg`, `ipconnect`, `confirm_date`, `who_approve`, `date_log`, `passpwd`) VALUES
(1281, '', '00000663', 'นางสาวธนิดา  ด้วงนิล', '3300600035109', 'Thanidad@betagro.com', '', '25d55ad283aa400af464c76d713c07ad', '2018-03-15 15:43:37', '::1', NULL, NULL, NULL, NULL),
(1282, '', '00000096', 'นางณัฐนันท์  บุณยะวณิช', '3100800321298', 'SupaneeJ@betagro.com', '0000000000', '25d55ad283aa400af464c76d713c07ad', '2018-03-26 11:00:03', '::1', NULL, NULL, NULL, NULL),
(1283, '', '00001944', 'นางสาวปรียา  ลัคณาสถิตย์', '3102401112425', 'Preyal@betagro.com', '0000000000', '25d55ad283aa400af464c76d713c07ad', '2018-03-26 11:02:38', '::1', NULL, NULL, NULL, NULL),
(1284, '', '00001400', 'นายณรงค์ชัย  ศรีสันติแสง', '3100601279992', 'Narongchai@betagro.com', '0000000000', '25d55ad283aa400af464c76d713c07ad', '2018-03-26 11:05:35', '::1', NULL, NULL, NULL, NULL),
(1285, '', '00001277', 'นางเรณู  อินเขียน', '3420300390271', 'Renup@betagro.com', '0000000000', '25d55ad283aa400af464c76d713c07ad', '2018-03-26 11:25:33', '::1', NULL, NULL, NULL, NULL),
(1286, '', '00008000', 'นางครองขวัญ  คำเสียง', '5330700018598', 'krongkwank@betagro.com', '0000000000', '25f9e794323b453885f5181f1b624d0b', '2018-03-26 14:03:09', '::1', NULL, NULL, NULL, NULL),
(1287, '', '00007486', 'นางชุดากานต์  ตู้บุญหลง', '3570501223355', 'Chudakarnt@betagro.com', '0614104242', 'f62136bf8281ede6b4c9495efcbe8e58', '2018-03-26 14:37:26', '172.30.30.112', NULL, NULL, NULL, NULL),
(1288, '', '00009725', 'นางสาวสิริกร  โตแก้ว', '1100200856160', 'sirikornt@betagro.com', '099-4539464', '25f9e794323b453885f5181f1b624d0b', '2018-03-26 14:53:12', '172.30.6.103', NULL, NULL, NULL, NULL),
(1289, '', '00004560', 'นางสาวมุนีพร  กาวิละมูล', '1520800051797', 'muneepornk@betagro.com', '1234567891', 'a87ec9ee6ec65e2c3ba76036db4066f7', '2018-03-26 15:15:07', '172.30.6.113', NULL, NULL, NULL, NULL),
(1290, '', '00002166', 'นางสาวธัญญ์นรี  นิธิเจริญศศิกุล', '3400600564518', 'thannareen@betagro.com', '', '503cd12832cdfe99b82adcc4923eed7e', '2018-03-26 16:33:42', '167.97.9.112', NULL, NULL, NULL, NULL),
(1291, '', '00005449', 'นางสุธิดา  ฤกษ์สมผุส', '3100100149433', 'Sutida@betagro.com', '', '81dc9bdb52d04dc20036dbd8313ed055', '2018-03-26 16:52:01', '172.30.28.84', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
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
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=tis620 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `coop_id`, `n_topic`, `n_details`, `n_date`, `count_edit`, `who_post`, `who_edit`, `FilesName`, `GroupShow`) VALUES
(1, '500001', 'ประกาศ หากการใช้งานมีปัญหากรุณาติดต่อเจ้าหน้าที่', 'ขณะนี้กำลังอยู่ในช่วงทดสอบระบบใหม่ หากการใช้งานมีปัญหา หรือติดขัดประการใด กรุณาติดต่อเจ้าหน้าที่ ', '2017-11-22 10:51:00', 1, 'administrator', 'administrator', '1', ''),
(13, '', '', '', '2018-03-26 17:11:07', 0, 'administrator', NULL, '', ''),
(14, '', 'สหกรณ์ฯ เปิดบัญชีรับเงินฝากออมทรัพย์พิเศษรวงผึ้ง', '', '2018-05-02 10:23:42', 0, 'administrator', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE IF NOT EXISTS `sms` (
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
-- Table structure for table `staff_info`
--

CREATE TABLE IF NOT EXISTS `staff_info` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `coop_id` varchar(8) NOT NULL,
  `staff_name` varchar(300) NOT NULL,
  `staff_user` varchar(100) NOT NULL,
  `staff_pwd` varchar(32) NOT NULL,
  `staff_level` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=tis620 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `staff_info`
--

INSERT INTO `staff_info` (`id`, `coop_id`, `staff_name`, `staff_user`, `staff_pwd`, `staff_level`) VALUES
(1, '', 'ผู้ดูแลระบบ', 'administrator', 'd9b09d20e42f9c7e98bca651e96c398a', '8c1858d1e1e23ddb8e519f29735c496e');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
