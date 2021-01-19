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
$title = 'สหกรณ์ออมทรัพย์พนักงานธนาคารออมสิน จำกัด';
$title1 = 'สอ.ออมสิน';
$sub_title = 'ระบบบริการสมาชิก';
$sub_title1 = "THRIFT AND CREDIT COOPERATIVE OF GSB EMPLOYEES LTD";
$address = '<font size="2">
470 ถนนพหลโยธิน สามเสนใน พญาไท กรุงเทพมหานคร 10400 &nbsp;&nbsp;&nbsp;&nbsp;ตู้ ป.ณ. 205 สามเสนใน<br>
Web site:http//gsb-coop.com E-mail address: gsb-coop@hotmail.com โทรศัพท์ 0-2299 8265-8&nbsp;&nbsp; 0-2299 8000 ต่อ 050105-6 <br>
08 1350 5463&nbsp;&nbsp;&nbsp; 08 9896 5028&nbsp;&nbsp;&nbsp; 09 3329 3955 โทรสาร 0-2278 0090&nbsp;&nbsp; 0-2298 8267<br></font></font> ';
$credite = '&copy; 2014  All Rights Reserved  <a href="http://www.gsb-coop.com/" target="new">www.gsb-coop.com</a> | Design By <a href="http://www.isocare.co.th" target="new">Isocare System Co.,Ltd&#8482; </a>';
// login
$bg_login_color  = '#d62e8e';
$bg_bar_login_color = '#ffffff';
$font_bar_login_color  = 'blue';

// register
$email_register = 1 ;			// 0 ไม่ , 1 บังคับ อีเมล์	
$mobile_register = 1 ;		// 0 ไม่ , 1.บังคับ เบอร์โทร

// menu
$menu_color = '#d62e8e';
//$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน','ปันผล-เฉลี่ยคืน');
//$user_link = array('','Share','Deposit','Loan','Ref_collno','Dividend');

//$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน','รายการหักรายเดือน และใบเสร็จรับเงิน');  //***ใช้กรณี Close เมนูปันผลเฉลี่ยคืน
//$user_link = array('','Share','Deposit','Loan','Ref_collno','Payment');

$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน','รายการหักรายเดือน และใบเสร็จรับเงิน','ปันผล-เฉลี่ยคืน');		//**ใช้กรณี Open เมนูปันผลเฉลี่ยคืน
$user_link = array('','Share','Deposit','Loan','Ref_collno','Payment','Dividend');

if($connection == 0){
//$admin_menu  = array('ข้อมูลสรุปรวม','เพิ่มข่าวประกาศ','อนุมัติ-ลบ สมาชิก','รายงานยืนยันยอด','เปลี่ยนรหัสผ่าน','ตั้งค่า','คู่มือระบบ');
//$admin_link  = array('','News_editer','Management_Member','ConfirmReport','Change_Pwd','Configuration','Information');

$admin_menu  = array('ข้อมูลสรุปรวม','เพิ่มข่าวประกาศ','อนุมัติ-ลบ สมาชิก','รายงานยืนยันยอด','เปลี่ยนรหัสผ่าน','คู่มือระบบ');
$admin_link  = array('','News_editer','Management_Member','ConfirmReport','Change_Pwd','Information');

}else{
$admin_menu  = array('เพิ่มข่าวประกาศ','เปลี่ยนรหัสผ่าน');
$admin_link  = array('News_editer','Change_Pwd');
}

?>




