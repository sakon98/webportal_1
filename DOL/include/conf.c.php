<?php
session_start();
header('Content-Type: text/html; charset=tis-620');
?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php

                       $servername = "localhost";
                        $username = "root";
                        $password = "WebServer";
                        $dbname = "dol";

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        $sql = "select time_out from config_mode";
                        $result = $conn->query($sql);

                        while($row = $result->fetch_assoc()) {
							
                           $time_out = $row["time_out"];
						}


 $time_out = intval($time_out);

$webtimeout=$time_out; //หน่วยเป็น นาที 
$webtimeout_showflag=0; // 1 แสดง 0 ซ่อน 

//Connection
$connection = 0 ; 	// 0 = sql , 1 = oracle 
$confirm2use = 0 ; 	// 0 = disable , 1 = enable
$printslip = 1 ; // 0 = disable , 1 = enable
$logstatus = 1; // 0 = disable , 1 = enable 
$repassword = 1 ; // 0 = disable , 1 = enable 
$confirmmenu = 0 ; // 0 = disable , 1 = enable 

//ข้อมูลเบื้องต้นที่แสดงหน้าแรก
$title = 'สหกรณ์ออมทรัพย์กรมที่ดิน จำกัด';
$title1 = 'สหกรณ์ออมทรัพย์กรมที่ดิน จำกัด';
$sub_title = 'ระบบบริการสมาชิก';
$sub_title1 = "The Co-operative of the Department of Land's Officers Limited";
$address = '<font size="2">
117 หมู่ 9 ถนนติวานนท์ ตำบลบางพูด
 อำเภอปากเกร็ด จังหวัดนนทบุรี 11120<br>   โทรศัพท์ 0-2194-2377-79 โทรสาร 0-2194-2380
<br>www.Landcoop.com ID LINE:landcoop <br>
เลขประจำตัวผู้เสียภาษี 0994000167920
<br>
</font></font> ';
$credite = '&copy; 2014  All Rights Reserved  <a href="http://www.landcoop.com/" target="new">www.Landcoop.com</a> | Design By <a href="http://www.isocare.co.th" target="new">Isocare System Co.,Ltd&#8482; </a> &nbsp;|&nbsp; Webportal Version 1.3';
// login
$bg_login_color  = '#6A5ACD';
$bg_bar_login_color = '#ffffff';
$font_bar_login_color  = 'blue';

// register
$email_register = 1 ;			// 0 ไม่ , 1 บังคับ อีเมล์	
$mobile_register = 1 ;		// 0 ไม่ , 1.บังคับ เบอร์โทร

// menu
$menu_color = '#6A5ACD';


$user_memu = array('ข้อมูลสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','รายการหักประจำเดือน','รายการใบคำขอกู้','ปันผล-เฉลี่ยคืน');
$user_link = array('','Share','Deposit','Loan','Payment','LoanRequest','Dividend');

//$user_memu = array('รายการหักประจำเดือน','รายการใบคำขอกู้');
//$user_link = array('','LoanRequest');

if($connection == 0){
//$admin_menu  = array('ข้อมูลสรุปรวม','เพิ่มข่าวประกาศ','อนุมัติ-ลบ สมาชิก','รายงานยืนยันยอด','เปลี่ยนรหัสผ่าน','ตั้งค่า','คู่มือระบบ');
//$admin_link  = array('','News_editer','Management_Member','ConfirmReport','Change_Pwd','Configuration','Information');

//$admin_menu  = array('ข้อมูลสรุปรวม','เพิ่มข่าวประกาศ','อนุมัติ-ลบ สมาชิก','รายงานยืนยันยอด','เปลี่ยนรหัสผ่าน','คู่มือระบบ');
//$admin_link  = array('','News_editer','Management_Member','ConfirmReport','Change_Pwd','Information');
    
$admin_menu  = array('ข้อมูลสรุปรวม','อนุมัติ-ลบ สมาชิก','รายการคำขอกู้','รายงานรายละเอียดขอกู้','Log Acess','ค่าคงที่','เปลี่ยนรหัสผ่าน');
$admin_link  = array('','Management_Member','LoanRequest','LoanRequest_Report','Acess','Config','Change_Pwd');

}else{
$admin_menu  = array('รายการคำขอกู้','เปลี่ยนรหัสผ่าน');
$admin_link  = array('LoanRequest','Change_Pwd');
}

?>




