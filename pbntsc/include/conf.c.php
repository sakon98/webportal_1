<?php
session_start();
//header('Content-Type: text/html; charset=tis-620');
?>

<!--<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
-->

<?php

//Connection
$connection = 0 ; 	// 0 = sql , 1 = oracle 
$confirm2use = 0 ; 	// 0 = disble , 1 = enable
$printslip = 1 ; // 0 = disble , 1 = enable
$repassword = 1 ; // 0 = disble , 1 = enable 

//ข้อมูลเบื้องต้นที่แสดงหน้าแรก
$title = 'สหกรณ์ออมทรัพย์ครูเพชรบูรณ์ จำกัด';
$title1 = 'Phetchabun Teacher Savings and Credit Cooperrative LTD';
$sub_title = 'ระบบบริการสมาชิก';
$address = '<b>สหกรณ์ออมทรัพย์ครูเพชรบูรณ์ จำกัด 116 หมู่ที่ 2 ตำบลสะเดียง อำเภอเมือง  จังหวัดเพชรบูรณ์ 67000<b> <br>สำนักงานใหญ่ โทรศัพท์ 0-5671-1101,0-5674-4090  โทรสาร 0-5672-1931 <br>สาขา 2 อำเภอหล่มสัก โทรศัพท์ 0-5671-3574 โทรสาร 0-5671-3575 <br>สาขา 3 อำเภอบึงสามพัน โทรศัพท์ 0-5673-2643  โทรสาร 0-5673-2642';
$credite = '&copy; 2015  All Rights Reserved  <a href="http://www.pbntsc.org/" target="new">สหกรณ์ออมทรัพย์ครูเพชรบูรณ์</a> | Design By <a href="http://www.isocare.co.th" target="new">Isocare System Co.,Ltd&#8482; </a>';
// login
$bg_login_color  = 'blue';
$bg_bar_login_color = '#ffffff';
$font_bar_login_color  = 'blue';

// register
$email_register = 0 ;			// 0 ไม่ , 1 บังคับ อีเมล์	
$mobile_register = 0 ;		// 0 ไม่ , 1.บังคับ เบอร์โทร

// menu
$menu_color = '#1CB5E8';
//$menu_color = '#555555';
$undertop = '#8b8c8c';
$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','สิทธิ์กู้','ข้อมูลค้ำประกัน','รายการหักประจำเดือน','ปันผล-เฉลี่ยคืน','สวัสดิการ','ข้อมูลกองทุน');
$user_link = array('','Share','Deposit','Loan','LoanPermission','Ref_collno','Payment','Dividend','Benefits','Fund');

//$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','สิทธิ์กู้','ข้อมูลค้ำประกัน','รายการหักประจำเดือน','ปันผล-เฉลี่ยคืน','ข้อมูลกองทุน');
//$user_link = array('','Share','Deposit','Loan','LoanPermission','Ref_collno','Payment','Dividend','Fund');


if($connection == 0){
$admin_menu  = array('ข้อมูลสรุปรวม','เพิ่มข่าวประกาศ','อนุมัติ-ลบ สมาชิก','รายชื่อสมาชิกทั้งหมด','เปลี่ยนรหัสผ่าน');
$admin_link  = array('','News_editer','Management_Member','Member_Detail','Change_Pwd');
}else{
$admin_menu  = array('เพิ่มข่าวประกาศ','เปลี่ยนรหัสผ่าน');
$admin_link  = array('News_editer','Change_Pwd');
}

?>




