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
$title = 'สหกรณ์ออมทรัพย์ครูพะเยา จำกัด';
$title1 = 'สหกรณ์ออมทรัพย์ครูพะเยา จำกัด';
$sub_title = 'ระบบบริการสมาชิก';
$sub_title1 = "Phayao Teacher Saving Cooperative Limited";
$address = '<font size="2">
เลขที่ 672 ถนนเชียงราย - นครสวรรค์ หมู่ที่ 3 ตำบลท่าวังทอง อำเภอเมือง จังหวัดพะเยา 56000 <br>
โทรศัพท์ 054-431994 , 054-410185   โทรสาร 054-481501 <br>
Web site : www.phayaotcl.com    E-mail : phayaotcl@hotmail.co.th , phayaotcl@gmail.com<br></font></font> ';
$credite = '&copy; 2014  All Rights Reserved  <a href="http://www.phayaotcl.com" target="new">www.phayaotcl.com</a> | Design By <a href="http://www.isocare.co.th" target="new">Isocare System Co.,Ltd&#8482; </a>';
// login
$bg_login_color  = '#3399CC';
$bg_bar_login_color = '#ffffff';
$font_bar_login_color  = '#3399CC';

// register
$email_register = 1 ;			// 0 ไม่ , 1 บังคับ อีเมล์	
$mobile_register = 1 ;		// 0 ไม่ , 1.บังคับ เบอร์โทร

// menu
$menu_color = '#3399CC';

//$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน','ใบเสร็จประจำเดือน','ปันผล-เฉลี่ยคืน');
//$user_link = array('','Share','Deposit','Loan','Ref_collno','Payment','Dividend');

$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน','รายการหักประจำเดือน','ใบเสร็จประจำเดือน','ปันผล-เฉลี่ยคืน');
$user_link = array('','Share','Deposit','Loan','Ref_collno','Payment2','Payment','Dividend');

if($connection == 0){
    
$admin_menu  = array('ข้อมูลสรุปรวม','เพิ่มข่าวประกาศ','อนุมัติ-ลบ สมาชิก','เปลี่ยนรหัสผ่าน');
$admin_link  = array('','News_editer','Management_Member','Change_Pwd');

}else{
$admin_menu  = array('เพิ่มข่าวประกาศ','เปลี่ยนรหัสผ่าน');
$admin_link  = array('News_editer','Change_Pwd');
}

?>




