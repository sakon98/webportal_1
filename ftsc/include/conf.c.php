<?php
session_start();
header('Content-Type: text/html; charset=tis-620');
?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php

$FormatNumber = 6;   // จำนวนหลักของสมาชิก

//Connection
$connection = 0 ; 	// 0 = sql , 1 = oracle 
$confirm2use = 0 ; 	// 0 = disable , 1 = enable
$printslip = 1 ; // 0 = disable , 1 = enable
$logstatus = 1; // 0 = disable , 1 = enable 
$repassword = 1 ; // 0 = disable , 1 = enable 
$confirmmenu = 0 ; // 0 = disable , 1 = enable 

//ข้อมูลเบื้องต้นที่แสดงหน้าแรก
$title = 'สสอค. ';
$title1 = 'สมาคมฌาปนกิจสงเคราะห์สมาชิกชุมนุมสหกรณ์ออมทรัพย์ครูไทย';
$sub_title = 'ระบบบริการข้อมูลสมาชิก';
$sub_title1 = "สมาคมฌาปนกิจสงเคราะห์สมาชิกชุมนุมสหกรณ์ออมทรัพย์ครูไทย";
$address = '<font size="2">-</font></font> ';
$credite = ' Website : <a href="http://www.cwftc.or.th/" target="_blank">www.cwftc.or.th</a> <br/> &copy; 2014  All Rights Reserved Design By <a href="http://www.isocare.co.th" target="_blank">Isocare System Co.,Ltd&#8482; </a>';
$show_lineid_flag=false;
$show_logo_flag=false;
// login
$bg_login_color  = '#0066FF';
$bg_bar_login_color = '#3300FF';
$font_bar_login_color  = '#ffffff';

// register
$email_register = 1 ;			// 0 ไม่ , 1 บังคับ อีเมล์	
$mobile_register = 1 ;		// 0 ไม่ , 1.บังคับ เบอร์โทร

// menu
$menu_color = '#3300FF';
//$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน','ปันผล-เฉลี่ยคืน');
//$user_link = array('','Share','Deposit','Loan','Ref_collno','Dividend');

//$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน');
//$user_link = array('','Share','Deposit','Loan','Ref_collno');

$user_memu = array('ข่าวสารสมาชิก','รายละเอียดสมาชิก','รายการผู้รับเงินสงเคราะห์','รายการเรียกเก็บเงิน','รายการโอนย้าย');
$user_link = array('','Member_info','Codept','Statement','TrnDetail');

if($connection == 0){
//$admin_menu  = array('ข้อมูลสรุปรวม','เพิ่มข่าวประกาศ','อนุมัติ-ลบ สมาชิก','รายงานยืนยันยอด','เปลี่ยนรหัสผ่าน','ตั้งค่า','คู่มือระบบ');
//$admin_link  = array('','News_editer','Management_Member','ConfirmReport','Change_Pwd','Configuration','Information');

$admin_menu  = array('ข้อมูลสรุปรวม','จัดการข่าวประกาศ');
$admin_link  = array('','News_editer');

}else{
$admin_menu  = array('เพิ่มข่าวประกาศ','เปลี่ยนรหัสผ่าน');
$admin_link  = array('News_editer','Change_Pwd');
}

?>




