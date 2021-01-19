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
$title = 'สหกรณ์ออมทรัพย์สถาบันบัณฑิตพัฒนบริหารศาสตร์ จำกัด';
$title1 = 'สหกรณ์ออมทรัพย์สถาบันบัณฑิตพัฒนบริหารศาสตร์ จำกัด';
$sub_title = 'http://coop.nida.ac.th';
$sub_title1 = "National Institute of Development Administration Savings Co-Operative Ltd.";
$address = '<font size="2">
    
 118 ถนน เสรีไทย แขวง คลองจั่น เขตบางกะปิ กรุงเทพมหานคร 10240
<br>
โทร. 0-2375-7568, 0-2727-3508-13
 <br>
</font></font> ';
$credite = '&copy; 2014  All Rights Reserved  <a href="http://coop.nida.ac.th/" target="new"><u><font color = "blue">coop.nida.ac.th</font></u> </a>| Design By <a href="http://www.isocare.co.th/" target="new"><u><font color = "blue">Isocare System Co.,Ltd&#8482; </font></u></a>';
// login
$bg_login_color  = '#4abdd8';
$bg_bar_login_color = '#0776bd';
$font_bar_login_color  = '#fbfdfd';

// register
$email_register = 1 ;			// 0 ไม่ , 1 บังคับ อีเมล์	
$mobile_register = 1 ;		// 0 ไม่ , 1.บังคับ เบอร์โทร

// menu
$menu_color = '#4abdd8';
//$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน','ปันผล-เฉลี่ยคืน');
//$user_link = array('','Share','Deposit','Loan','Ref_collno','Dividend');

//$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน');
//$user_link = array('','Share','Deposit','Loan','Ref_collno');

$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน','รายการหักประจำเดือน');
$user_link = array('','Share','Deposit','Loan','Ref_collno','Payment');

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




