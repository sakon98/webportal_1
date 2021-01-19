-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3307
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
-- Database: `scodoa`
--

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `confirmbal`
--

CREATE TABLE IF NOT EXISTS `confirmbal` (
  `member_no` varchar(8) NOT NULL,
  `confirm_period` date NOT NULL,
  `entry_date` date NOT NULL,
  `confirm_status` varchar(2) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `member_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `confirm_balance`
--

CREATE TABLE IF NOT EXISTS `confirm_balance` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
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
-- โครงสร้างตาราง `log_action`
--

CREATE TABLE IF NOT EXISTS `log_action` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `action_do` varchar(100) NOT NULL,
  `action_desc` varchar(250) DEFAULT NULL,
  `action_id` varchar(100) DEFAULT NULL,
  `user` varchar(100) NOT NULL,
  `ipconnect` varchar(25) NOT NULL,
  `date_log` datetime NOT NULL,
  `connectby` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `mbmembmaster`
--

CREATE TABLE IF NOT EXISTS `mbmembmaster` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`member_no`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `n_topic` varchar(1000) NOT NULL,
  `n_details` varchar(5000) NOT NULL,
  `n_date` datetime NOT NULL,
  `count_edit` int(5) NOT NULL DEFAULT '0',
  `who_post` varchar(15) NOT NULL,
  `who_edit` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `n_id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=tis620 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `pbcatcol`
--

CREATE TABLE IF NOT EXISTS `pbcatcol` (
  `pbc_tnam` char(193) NOT NULL,
  `pbc_tid` int(11) DEFAULT NULL,
  `pbc_ownr` char(193) NOT NULL,
  `pbc_cnam` char(193) NOT NULL,
  `pbc_cid` smallint(6) DEFAULT NULL,
  `pbc_labl` varchar(254) DEFAULT NULL,
  `pbc_lpos` smallint(6) DEFAULT NULL,
  `pbc_hdr` varchar(254) DEFAULT NULL,
  `pbc_hpos` smallint(6) DEFAULT NULL,
  `pbc_jtfy` smallint(6) DEFAULT NULL,
  `pbc_mask` varchar(31) DEFAULT NULL,
  `pbc_case` smallint(6) DEFAULT NULL,
  `pbc_hght` smallint(6) DEFAULT NULL,
  `pbc_wdth` smallint(6) DEFAULT NULL,
  `pbc_ptrn` varchar(31) DEFAULT NULL,
  `pbc_bmap` char(1) DEFAULT NULL,
  `pbc_init` varchar(254) DEFAULT NULL,
  `pbc_cmnt` varchar(254) DEFAULT NULL,
  `pbc_edit` varchar(31) DEFAULT NULL,
  `pbc_tag` varchar(254) DEFAULT NULL,
  UNIQUE KEY `pbcatc_x` (`pbc_tnam`,`pbc_ownr`,`pbc_cnam`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `pbcatedt`
--

CREATE TABLE IF NOT EXISTS `pbcatedt` (
  `pbe_name` varchar(30) NOT NULL,
  `pbe_edit` varchar(254) DEFAULT NULL,
  `pbe_type` smallint(6) DEFAULT NULL,
  `pbe_cntr` int(11) DEFAULT NULL,
  `pbe_seqn` smallint(6) NOT NULL,
  `pbe_flag` int(11) DEFAULT NULL,
  `pbe_work` char(32) DEFAULT NULL,
  UNIQUE KEY `pbcate_x` (`pbe_name`,`pbe_seqn`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

--
-- dump ตาราง `pbcatedt`
--

INSERT INTO `pbcatedt` (`pbe_name`, `pbe_edit`, `pbe_type`, `pbe_cntr`, `pbe_seqn`, `pbe_flag`, `pbe_work`) VALUES
('#####', '#####', 90, 1, 1, 32, '10'),
('###,###.00', '###,###.00', 90, 1, 1, 32, '10'),
('###-##-####', '###-##-####', 90, 1, 1, 32, '00'),
('DD/MM/YY', 'DD/MM/YY', 90, 1, 1, 32, '20'),
('DD/MM/YY HH:MM:SS', 'DD/MM/YY HH:MM:SS', 90, 1, 1, 32, '40'),
('DD/MM/YY HH:MM:SS:FFFFFF', 'DD/MM/YY HH:MM:SS:FFFFFF', 90, 1, 1, 32, '40'),
('DD/MM/YYYY', 'DD/MM/YYYY', 90, 1, 1, 32, '20'),
('DD/MM/YYYY HH:MM:SS', 'DD/MM/YYYY HH:MM:SS', 90, 1, 1, 32, '40'),
('DD/MMM/YY', 'DD/MMM/YY', 90, 1, 1, 32, '20'),
('DD/MMM/YY HH:MM:SS', 'DD/MMM/YY HH:MM:SS', 90, 1, 1, 32, '40'),
('HH:MM:SS', 'HH:MM:SS', 90, 1, 1, 32, '30'),
('HH:MM:SS:FFF', 'HH:MM:SS:FFF', 90, 1, 1, 32, '30'),
('HH:MM:SS:FFFFFF', 'HH:MM:SS:FFFFFF', 90, 1, 1, 32, '30'),
('JJJ/YY', 'JJJ/YY', 90, 1, 1, 32, '20'),
('JJJ/YY HH:MM:SS', 'JJJ/YY HH:MM:SS', 90, 1, 1, 32, '40'),
('JJJ/YYYY', 'JJJ/YYYY', 90, 1, 1, 32, '20'),
('JJJ/YYYY HH:MM:SS', 'JJJ/YYYY HH:MM:SS', 90, 1, 1, 32, '40'),
('MM/DD/YY', 'MM/DD/YY', 90, 1, 1, 32, '20'),
('MM/DD/YY HH:MM:SS', 'MM/DD/YY HH:MM:SS', 90, 1, 1, 32, '40'),
('MM/DD/YYYY', 'MM/DD/YYYY', 90, 1, 1, 32, '20'),
('MM/DD/YYYY HH:MM:SS', 'MM/DD/YYYY HH:MM:SS', 90, 1, 1, 32, '40');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `pbcatfmt`
--

CREATE TABLE IF NOT EXISTS `pbcatfmt` (
  `pbf_name` varchar(30) NOT NULL,
  `pbf_frmt` varchar(254) DEFAULT NULL,
  `pbf_type` smallint(6) DEFAULT NULL,
  `pbf_cntr` int(11) DEFAULT NULL,
  UNIQUE KEY `pbcatf_x` (`pbf_name`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

--
-- dump ตาราง `pbcatfmt`
--

INSERT INTO `pbcatfmt` (`pbf_name`, `pbf_frmt`, `pbf_type`, `pbf_cntr`) VALUES
('#,##0', '#,##0', 81, 0),
('#,##0.00', '#,##0.00', 81, 0),
('$#,##0.00;($#,##0.00)', '$#,##0.00;($#,##0.00)', 81, 0),
('$#,##0.00;[RED]($#,##0.00)', '$#,##0.00;[RED]($#,##0.00)', 81, 0),
('$#,##0;($#,##0)', '$#,##0;($#,##0)', 81, 0),
('$#,##0;[RED]($#,##0)', '$#,##0;[RED]($#,##0)', 81, 0),
('0', '0', 81, 0),
('0%', '0%', 81, 0),
('0.00', '0.00', 81, 0),
('0.00%', '0.00%', 81, 0),
('0.00E+00', '0.00E+00', 81, 0),
('[General]', '[General]', 81, 0),
('d-mmm', 'd-mmm', 84, 0),
('d-mmm-yy', 'd-mmm-yy', 84, 0),
('h:mm AM/PM', 'h:mm AM/PM', 84, 0),
('h:mm:ss', 'h:mm:ss', 84, 0),
('h:mm:ss AM/PM', 'h:mm:ss AM/PM', 84, 0),
('m/d/yy', 'm/d/yy', 84, 0),
('m/d/yy h:mm', 'm/d/yy h:mm', 84, 0),
('mmm-yy', 'mmm-yy', 84, 0);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `pbcattbl`
--

CREATE TABLE IF NOT EXISTS `pbcattbl` (
  `pbt_tnam` char(193) NOT NULL,
  `pbt_tid` int(11) DEFAULT NULL,
  `pbt_ownr` char(193) NOT NULL,
  `pbd_fhgt` smallint(6) DEFAULT NULL,
  `pbd_fwgt` smallint(6) DEFAULT NULL,
  `pbd_fitl` char(1) DEFAULT NULL,
  `pbd_funl` char(1) DEFAULT NULL,
  `pbd_fchr` smallint(6) DEFAULT NULL,
  `pbd_fptc` smallint(6) DEFAULT NULL,
  `pbd_ffce` char(18) DEFAULT NULL,
  `pbh_fhgt` smallint(6) DEFAULT NULL,
  `pbh_fwgt` smallint(6) DEFAULT NULL,
  `pbh_fitl` char(1) DEFAULT NULL,
  `pbh_funl` char(1) DEFAULT NULL,
  `pbh_fchr` smallint(6) DEFAULT NULL,
  `pbh_fptc` smallint(6) DEFAULT NULL,
  `pbh_ffce` char(18) DEFAULT NULL,
  `pbl_fhgt` smallint(6) DEFAULT NULL,
  `pbl_fwgt` smallint(6) DEFAULT NULL,
  `pbl_fitl` char(1) DEFAULT NULL,
  `pbl_funl` char(1) DEFAULT NULL,
  `pbl_fchr` smallint(6) DEFAULT NULL,
  `pbl_fptc` smallint(6) DEFAULT NULL,
  `pbl_ffce` char(18) DEFAULT NULL,
  `pbt_cmnt` varchar(254) DEFAULT NULL,
  UNIQUE KEY `pbcatt_x` (`pbt_tnam`,`pbt_ownr`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `pbcatvld`
--

CREATE TABLE IF NOT EXISTS `pbcatvld` (
  `pbv_name` varchar(30) NOT NULL,
  `pbv_vald` varchar(254) DEFAULT NULL,
  `pbv_type` smallint(6) DEFAULT NULL,
  `pbv_cntr` int(11) DEFAULT NULL,
  `pbv_msg` varchar(254) DEFAULT NULL,
  UNIQUE KEY `pbcatv_x` (`pbv_name`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `staff_info`
--

CREATE TABLE IF NOT EXISTS `staff_info` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `staff_name` varchar(300) NOT NULL,
  `staff_user` varchar(100) NOT NULL,
  `staff_pwd` varchar(32) NOT NULL,
  `staff_level` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=tis620 AUTO_INCREMENT=2 ;

--
-- dump ตาราง `staff_info`
--

INSERT INTO `staff_info` (`id`, `staff_name`, `staff_user`, `staff_pwd`, `staff_level`) VALUES
(1, 'ผู้ดูแลระบบ', 'administrator', '5089208fd9255de4e684b16d6a6a7a37', '8c1858d1e1e23ddb8e519f29735c496e');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
