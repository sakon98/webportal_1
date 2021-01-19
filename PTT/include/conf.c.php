<?php
session_start();
header('Content-Type: text/html; charset=tis-620');
?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php

//Connection
$connection = 0 ; 	// 0 = sql , 1 = oracle 
$confirm2use = 0 ; 	// 0 = disable , 1 = enable
$printslip = 1 ; // 0 = disable , 1 = enable
$logstatus = 1; // 0 = disable , 1 = enable 
$repassword = 1 ; // 0 = disable , 1 = enable 
$confirmmenu = 1 ; // 0 = disable , 1 = enable 

//ข้อมูลเบื้องต้นที่แสดงหน้าแรก
$title = 'สหกรณ์ออมทรัพย์ ปตท จำกัด';
$title1 = 'สอ.ปตท';
$sub_title = 'ระบบบริการสมาชิก';
$sub_title1 = "";
$address = '<font size="2">
555 วิภาวดี-รังสิต แขวง จตุจักร เขต จตุจักร กรุงเทพมหานคร 10900 <br>
Web site:http://www.pttsc.com/ Tel: 02-5371494-9 &nbsp;&nbsp; 02-5372114-5 <br>
Fax: 02-5372112<br></font></font> ';
$credite = '&copy; 2014  All Rights Reserved  <a href="http://www.pttsc.com/" target="new">www.pttsc.com</a> | Design By <a href="http://www.isocare.co.th" target="new">Isocare System Co.,Ltd&#8482; </a>';
// login
$bg_login_color  = '#3366CC';
$bg_bar_login_color = '#ffffff';
$font_bar_login_color  = 'blue';

// register
$email_register = 1 ;			// 0 ไม่ , 1 บังคับ อีเมล์	
$mobile_register = 1 ;		// 0 ไม่ , 1.บังคับ เบอร์โทร

// menu
$menu_color = '#3366CC';
//$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน','ปันผล-เฉลี่ยคืน');
//$user_link = array('','Share','Deposit','Loan','Ref_collno','Dividend');

//$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน');
//$user_link = array('','Share','Deposit','Loan','Ref_collno');

//$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน','รายการหักประจำเดือน','ปันผล-เฉลี่ยคืน');
//$user_link = array('','Share','Deposit','Loan','Ref_collno','Payment','Dividend');

//$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน','รายการหักประจำเดือน');
//$user_link = array('','Share','Deposit','Loan','Ref_collno','Payment');

$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน','รายการหักประจำเดือน','แจ้งสถานะภาพ','ปันผล-เฉลี่ยคืน','ข้อมูลผู้รับผลประโยชน์');
$user_link = array('New','Share','Deposit','Loan','Ref_collno','Payment','Year_month','Dividend','Beneficiary');

if($connection == 0){
//$admin_menu  = array('ข้อมูลสรุปรวม','เพิ่มข่าวประกาศ','อนุมัติ-ลบ สมาชิก','รายงานยืนยันยอด','เปลี่ยนรหัสผ่าน','ตั้งค่า','คู่มือระบบ');
//$admin_link  = array('','News_editer','Management_Member','ConfirmReport','Change_Pwd','Configuration','Information');

//$admin_menu  = array('ข้อมูลสรุปรวม','เพิ่มข่าวประกาศ','อนุมัติ-ลบ สมาชิก','รายงานยืนยันยอด','เปลี่ยนรหัสผ่าน','คู่มือระบบ');
//$admin_link  = array('','News_editer','Management_Member','ConfirmReport','Change_Pwd','Information');

$admin_menu  = array('ข้อมูลสรุปรวม','เพิ่มข่าวประกาศ','อนุมัติ-ลบ สมาชิก','ค้นหาสมาชิกจากชื่อ','เปลี่ยนรหัสผ่าน');
$admin_link  = array('','News_editer','Management_Member','Management_Member_name','Change_Pwd');

}else{
$admin_menu  = array('เพิ่มข่าวประกาศ','เปลี่ยนรหัสผ่าน');
$admin_link  = array('News_editer','Change_Pwd');
}

?>




