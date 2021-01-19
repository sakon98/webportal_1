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
$printslip = 0 ; // 0 = disable , 1 = enable  ใบเสร็จประจำเดือน
$printcollno = 1; //คนค่ำในใบเสร็จ
$logstatus = 1; // 0 = disable , 1 = enable 
$repassword = 1 ; // 0 = disable , 1 = enable 
$confirmmenu = 0 ; // 0 = disable , 1 = enable 

//ข้อมูลเบื้องต้นที่แสดงหน้าแรก
$title = 'สหกรณ์ออมทรัพย์สาธารณสุขเชียงราย จำกัด';
$title1 = 'สหกรณ์ออมทรัพย์สาธารณสุขเชียงราย จำกัด';
$sub_title = 'ระบบบริการสมาชิก';
$sub_title1 = "Chiangrai Public Health Saving And Credit Co-operative Limited";
$address = '<font size="3">
1039/74 ถนนร่วมจิตถวาย ตำบลเวียง อำเภอเมือง จังหวัดเชียงราย57000<br>
โทร : 053-712585  ,053-756203&nbsp;&nbsp; แฟ็ก : 053-756251 ต่อ 23 <br>
E-Mail : cr.health.coop@gmail.com;<br></font></font> ';
$credite = '&copy; 2014  All Rights Reserved <a href="http://cricoop.com" target="new">cricoop.com</a>| Design By <a href="http://www.isocare.co.th" target="new">Isocare System Co.,Ltd&#8482; </a>';
// login
$bg_login_color  = '#44bb58';
$bg_bar_login_color = '#094a1f';
$font_bar_login_color  = '#ffffff';

// register
$email_register = 1 ;			// 0 ไม่ , 1 บังคับ อีเมล์	
$mobile_register = 1 ;		// 0 ไม่ , 1.บังคับ เบอร์โทร

// menu
$menu_color = '#378839';
//$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน','ปันผล-เฉลี่ยคืน');
//$user_link = array('','Share','Deposit','Loan','Ref_collno','Dividend');

//$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน');
//$user_link = array('','Share','Deposit','Loan','Ref_collno');

//$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน','รายการหักประจำเดือน','รายการหักประจำเดือน(ฌาปนกิจ)','ปันผล-เฉลี่ยคืน');
//$user_link = array('','Share','Deposit','Loan','Ref_collno','Payment','Payment_Etc','Dividend');

$user_memu = array('ข่าวสารสมาชิก','ข้อมูลผู้รับผลประโยชน์','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน','รายการหักประจำเดือน','รายการหักประจำเดือน(ฌาปนกิจ)','ปันผล-เฉลี่ยคืน');
$user_link = array('','Beneficiary','Share','Deposit','Loan','Ref_collno','Payment','Payment_Etc','Dividend');

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




