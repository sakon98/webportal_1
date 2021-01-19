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
$confirmmenu = 0 ; // 0 = disable , 1 = enable 

//ข้อมูลเบื้องต้นที่แสดงหน้าแรก
$title = 'สหกรณ์ออมทรัพย์สามัญศึกษาจังหวัดชัยภูมิ  จำกัด';
$title1 = 'สหกรณ์ออมทรัพย์สามัญศึกษาจังหวัดชัยภูมิ  จำกัด';
$sub_title = 'ระบบบริการสมาชิก';
$sub_title1 = "";
$address = '<font size="2">
เลขที่ 72/27-28ก  ถนนชัยประสิทธิ์  ตำบลในเมือง  อำเภอเมืองชัยภูมิ  จังหวัดชัยภูมิ 36000
<br></font></font> ';
$credite = '&copy; 2014  All Rights Reserved  <a href="http://cpmscsc.com/" target="new">www.coopthai.com/cypg</a> | Design By <a href="www.cpmscsc.com" target="new">Isocare System Co.,Ltd&#8482; </a>';
// login
$bg_login_color  = '#3366FF';
$bg_bar_login_color = '#ffffff';
$font_bar_login_color  = 'blue';

// register
$email_register = 1 ;			// 0 ไม่ , 1 บังคับ อีเมล์	
$mobile_register = 1 ;		// 0 ไม่ , 1.บังคับ เบอร์โทร

// menu
$menu_color = '#0066FF';
//$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน','ปันผล-เฉลี่ยคืน');
//$user_link = array('','Share','Deposit','Loan','Ref_collno','Dividend');

//$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน');
//$user_link = array('','Share','Deposit','Loan','Ref_collno');

$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน','รายการหักประจำเดือน','ปันผล-เฉลี่ยคืน');
$user_link = array('','Share','Deposit','Loan','Ref_collno','Payment','Dividend');

if($connection == 0){
//$admin_menu  = array('ข้อมูลสรุปรวม','เพิ่มข่าวประกาศ','อนุมัติ-ลบ สมาชิก','รายงานยืนยันยอด','เปลี่ยนรหัสผ่าน','ตั้งค่า','คู่มือระบบ');
//$admin_link  = array('','News_editer','Management_Member','ConfirmReport','Change_Pwd','Configuration','Information');

//$admin_menu  = array('ข้อมูลสรุปรวม','เพิ่มข่าวประกาศ','อนุมัติ-ลบ สมาชิก','รายงานยืนยันยอด','เปลี่ยนรหัสผ่าน','คู่มือระบบ');
//$admin_link  = array('','News_editer','Management_Member','ConfirmReport','Change_Pwd','Information');
    
$admin_menu  = array('ข้อมูลสรุปรวม','เพิ่มข่าวประกาศ','อนุมัติ-ลบ สมาชิก','เปลี่ยนรหัสผ่าน');
$admin_link  = array('','News_editer','Management_Member','Change_Pwd');

}else{
$admin_menu  = array('เพิ่มข่าวประกาศ','เปลี่ยนรหัสผ่าน');
$admin_link  = array('News_editer','Change_Pwd');
}

?>




