<?php
session_start();
header('Content-Type: text/html; charset=tis-620');
?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php
$encrypt_mode=2; //1=MD5, 2=SHA3

$webtimeout=30; //หน่วยเป็น นาที 
$webtimeout_showflag=0; // 1 แสดง 0 ซ่อน 

$WEB_LINK="https://betagrocoop.betagro.com/webportal/d/index.php"; // http://172.17.30.46:90/webportal/d/index.php
$MAIL_HOST="smtp.betagro.com";//"smtp.gmail.com";
$MAIL_PORT=25;//587;
$MAIL_USR="isocare.iscobtg@gmail.com";
$MAIL_PWD="@Icoop2018";
$MAIL_FROM="coop@betagro.com";
$MAIL_FROM_NM='สหกรณ์ออมทรัพย์พนักงานเครือเบทาโกร จำกัด';
$MAIL_DEBUG=1;// 0 =disable , 1=enable
$MAIL_AUTH_FLAG=false;
$MAIL_SECURE='tls';
$MAIL_SENT_NUM=10;
$MAIL_TEST_MODE=false;
$MAIL_TEST_CONFIRM=false;
$MAIL_TEST_EMAIL="isocare.nine@gmail.com";
$COOP_ADDR="323 หมู่ 6 ถนนวิภาวดีรังสิต แขวงทุ่งสองห้อง เขตหลักสี่ กรุงเทพมหานคร 10210";

$connectionmode=1; //0=mysql,1=oracle
//Connection
$connection = 0 ; 	// 0 = sql , 1 = oracle 
$confirm2use = 0 ; 	// 0 = disable , 1 = enable
$printslip = 1 ; // 0 = disable , 1 = enable
$logstatus = 1; // 0 = disable , 1 = enable 
$repassword = 1 ; // 0 = disable , 1 = enable 
$confirmmenu = 1 ; // 0 = disable , 1 = enable 

//ข้อมูลเบื้องต้นที่แสดงหน้าแรก
$title = 'สหกรณ์ออมทรัพย์พนักงานเครือเบทาโกร จำกัด';
$title1 = 'สหกรณ์ออมทรัพย์พนักงานเครือเบทาโกร จำกัด'; 
$sub_title = 'ระบบบริการสมาชิก';
$sub_title1 = " Betagro Group Employee Savings Cooperative Ltd.";

$address ='<font size="3">
323 หมู่ 6 ถนนวิภาวดีรังสิต แขวงทุ่งสองห้อง เขตหลักสี่ กรุงเทพมหานคร 10210
<br>
E-mail : coop@betagro.com </font> ';
$credite = '<font size="2" color = "#000000">&copy; '.date('Y').'  All Rights Reserved </font> <a href="http://th-th915031.panpages.co.th/" target="new"><font size="2" color = "#FFFFFF">panpages.co.th</font></a><font size="2" color = "#000000">| Design By </font><a href="http://www.isocare.co.th" target="new"><font size="2" color = "#FFFFFF">Isocare System Co.,Ltd&#8482;</font> </a> ';
// login
$bg_login_color  = '#A07235';
$bg_bar_login_color = '#A07235';
$font_bar_login_color  = '#ffffff';
// register
$email_register = 1 ;			// 0 ไม่ , 1 บังคับ อีเมล์	
$mobile_register = 1 ;		// 0 ไม่ , 1.บังคับ เบอร์โทร

// menu
$menu_color = '#A07235';
//$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน','ปันผล-เฉลี่ยคืน');
//$user_link = array('','Share','Deposit','Loan','Ref_collno','Dividend');

//$user_memu = array('ข่าวสารสมาชิก','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน');
//$user_link = array('','Share','Deposit','Loan','Ref_collno');


$servername = "localhost";
$username = "root";
$password = "WebServer";
$dbname = "iscobtgdata";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT temporary_password FROM mbmembmaster where member_no = '$_SESSION[ses_member_no]'";
$result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
       $temporary_password = $row["temporary_password"];
   
 

if($temporary_password != 1){

$user_memu = array('ข่าวประชาสัมพันธ์','ข้อมูลผู้รับผลประโยชน์','ข้อมูลหุ้น','ข้อมูลเงินฝาก','ข้อมูลเงินกู้','ข้อมูลค้ำประกัน','ยืนยันยอด','รายการหักประจำเดือน','ปันผล-เฉลี่ยคืน','ระเบียบและข้อบังคับ','ผลการดำเนินงาน','รายงานการประชุมใหญ่สามัญประจำปี','ผลการจัดมาตรฐาน','บริการของสหกรณ์','รายการใบคำขอกู้','ดาวน์โหลดเอกสาร');
$user_link = array('','Beneficiary','Share','Deposit','Loan','Ref_collno','Confirm','Payment','Dividend','Order','Overall_Result','Report_Consult','Standard_Result','ServiceCoop','LoanRequest','Download');

}else{
     
$user_memu = array();
$user_link = array('Change_Pwd'); 
    
 }
 
    }


if($connection == 0){
//$admin_menu  = array('ข้อมูลสรุปรวม','เพิ่มข่าวประกาศ','อนุมัติ-ลบ สมาชิก','รายงานยืนยันยอด','เปลี่ยนรหัสผ่าน','ตั้งค่า','คู่มือระบบ');
//$admin_link  = array('','News_editer','Management_Member','ConfirmReport','Change_Pwd','Configuration','Information');

$admin_menu  = array('ข้อมูลสรุปรวม','เพิ่มข่าวประกาศ','อนุมัติ-ลบ สมาชิก','Email ข่าวสาร','Email เลขสมาชิก','Email ยืนยันยอด','Email วันครบกำหนดเงินฝาก','Email ข้อมูลการจ่ายเงินกู้','Email ข้อมูลการค้ำประกัน ','Email ข้อมูลการค้ำประกัน (ยกเลิก)','รายการคำขอกู้','Upload File แบบฟอร์ม','ลบไฟล์ Upload','ดู Log Password','เปลี่ยนรหัสผ่าน');
$admin_link  = array('','News_editer','Management_Member','EmailNews','EmailMemberNo','EmailConfirm','EmailDeptDue','EmailLoanPay','EmailLoanColl','EmailLoanCollResign','LoanRequest','Upload_File','Delete_File','Management_Member_Log_Reset_Password','Change_Pwd');

}else{
$admin_menu  = array('เพิ่มข่าวประกาศ','เปลี่ยนรหัสผ่าน');
$admin_link  = array('News_editer','Change_Pwd');
}

?>




