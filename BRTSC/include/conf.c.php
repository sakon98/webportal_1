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
$title = 'สหกรณ์ออมทรัพย์ครูบุรีรัมย์ จำกัด';
$title1 = 'สหกรณ์ออมทรัพย์ครูบุรีรัมย์ จำกัด';
$sub_title = 'ระบบบริการข้อมูลสมาชิก';
$sub_title1 = "The Buriram Teachers Savings Cooperative Limited";
$address = '<font size="2">
36/100 ถ.อินจันทร์ณรงค์ ต.ในเมือง อ.เมือง จ.บุรีรัมย์ 31000 
<br>
โทรศัพท์ 044611581 และ 044612264 ::: Fax ต่อ 121(การเงิน),123(ธุรการ) <br>
E-mail : brr-tsc@hotmail.co.th <br>
</font></font> ';
$credite = '&copy; 2014  All Rights Reserved  <a href="http://br-tsc.com/" target="new">www.br-tsc.com/cypg</a> | Design By <a href="http://www.isocare.co.th/" target="new">Isocare System Co.,Ltd&#8482; </a>';
// login
$bg_login_color  = '#3399ff';
$bg_bar_login_color = '#ffffff';
$font_bar_login_color  = '#3366ff';

// register
$email_register = 1 ;			// 0 ไม่ , 1 บังคับ อีเมล์
$mobile_register = 1 ;		// 0 ไม่ , 1.บังคับ เบอร์โทร

// menu
$menu_color = '#3399ff';
//$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน','ปันผล-เฉลี่ยคืน');
//$user_link = array('','Share','Deposit','Loan','Ref_collno','Dividend');

//$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน');
//$user_link = array('','Share','Deposit','Loan','Ref_collno');

$user_memu = array('ข่าวสารสมาชิก','ข้อมูลทั่วไป','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน','ข้อมูลประกันชีวิตกลุ่ม','รายการหักประจำเดือน','ปันผล-เฉลี่ยคืน');
$user_link = array('','Img','Share','Deposit','Loan','Ref_collno','ins','Payment','Dividend');

//$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน','ปันผล-เฉลี่ยคืน');
//$user_link = array('','Share','Deposit','Loan','Ref_collno','Dividend');

if($connection == 0){
//$admin_menu  = array('ข้อมูลสรุปรวม','เพิ่มข่าวประกาศ','อนุมัติ-ลบ สมาชิก','รายงานยืนยันยอด','เปลี่ยนรหัสผ่าน','ตั้งค่า','คู่มือระบบ');
//$admin_link  = array('','News_editer','Management_Member','ConfirmReport','Change_Pwd','Configuration','Information');

//$admin_menu  = array('ข้อมูลสรุปรวม','เพิ่มข่าวประกาศ','อนุมัติ-ลบ สมาชิก','รายงานยืนยันยอด','เปลี่ยนรหัสผ่าน','คู่มือระบบ');
//$admin_link  = array('','News_editer','Management_Member','ConfirmReport','Change_Pwd','Information');
    
$admin_menu  = array('ข้อมูลสรุปรวม','เพิ่มข่าวประกาศ','อนุมัติ-ลบ สมาชิก','เปลี่ยนรหัสผ่าน','กระดานสนทนา');
$admin_link  = array('','News_editer','Management_Member','Change_Pwd','Webboard');

}else{
$admin_menu  = array('เพิ่มข่าวประกาศ','เปลี่ยนรหัสผ่าน');
$admin_link  = array('News_editer','Change_Pwd');
}

?>




