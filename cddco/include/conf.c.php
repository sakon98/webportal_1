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

//ข้อมูลเบื้องต้นที่แสดงหน้าแรก
$title = 'สหกรณ์ออมทรัพย์กรมการพัฒนาชุมชน จำกัด';
$title1 = 'สอ.พช';
$sub_title = 'ระบบบริการสมาชิก';
$sub_title1 = "COMMUNITY DEVELOPMENT DEPARTMENT SAVINGS AND CREDIT CO-OPERATIVE LD.,";
$address = '120 หมู่ที่ 3, อาคารบี ชั้น 1 ศูนย์ราชการเฉลิมพระเกียรติ 80 พรรษา 5 ธันวาคม 2550, ถนนแจ้งวัฒนะ, แขวงทุ่งสองห้อง เขตหลักสี่ กรุงเทพมหานคร, 10210 โทร :
02-1438144';
$credite = '&copy; 2014  All Rights Reserved  <a href="http://www.cddco-op.com//" target="new">www.cddco-op.com</a> | Desige By <a href="http://www.isocare.co.th" target="new">Isocare System Co.,Ltd&#8482; </a>';
// login
$bg_login_color  = '6699FF';
$bg_bar_login_color = '#ffffff';
$font_bar_login_color  = '#2d2e90';

// register
$email_register = 0 ;		// 0 ไม่ , 1 บังคับ อีเมล์	
$mobile_register = 0 ;		// 0 ไม่ , 1.บังคับ เบอร์โทร

// menu
$menu_color = '3399FF';

//$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน','รายการหักประจำเดือน','ปันผล-เฉลี่ยคืน');
//$user_link = array('','Share','Deposit','Loan','Ref_collno','Payment','Dividend');

$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน','รายการหักประจำเดือน','ปันผล-เฉลี่ยคืน','ข้อมูลผู้รับโอนประโยชน์','ข้อมูลประกัน');
$user_link = array('','Share','Deposit','Loan','Ref_collno','Payment','Dividend','Beneficiary','Insurance');

if($connection == 0){
$admin_menu  = array('ข้อมูลสรุปรวม','เพิ่มข่าวประกาศ','อนุมัติ-ลบ สมาชิก','เปลี่ยนรหัสผ่าน','คู่มือระบบ');
$admin_link  = array('','News_editer','Management_Member','Change_Pwd','Information');
}else{
$admin_menu  = array('เพิ่มข่าวประกาศ','เปลี่ยนรหัสผ่าน');
$admin_link  = array('News_editer','Change_Pwd');
}

?>




