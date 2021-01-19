<?php
session_start();
header('Content-Type: text/html; charset=tis-620');
?>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <link rel="stylesheet" href="../css/validationEngine.jquery.css" type="text/css">
	<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />	
    <script src="../js/jquery-1.6.min.js" type="text/javascript"></script>
	<script src="../js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="tis-620"></script>
	<script src="../js/jquery.validationEngine.js" type="text/javascript" charset="tis-620"></script>
	<script type="text/javascript">
		jQuery(document).ready(function(){
						jQuery("#formID1").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});
		});
		function popup_statment(form) {
			var w = 910;
			var h = 530;
			var left = (screen.width/2)-(w/2);
			var top = (screen.height/3)-(h/3);
			 window.open ('', 'formpopup', 'toolbar=no, location=no, directories=no, status=no, menubar=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
				 form.target = 'formpopup';
			} 
	</script>

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"><strong><font size="4" face="Tahoma">คู่มือระบบ</font></strong><br />
      <font color="#FF6600" size="2" face="Tahoma">M<span id="result_box" lang="en" xml:lang="en">anual</span> Systems</font></td>
  </tr>
  <tr>
    <td align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<table width="90%" border="0" align="center" cellpadding="4" cellspacing="1">
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="36" colspan="3" align="left" bgcolor="#d62e8e"><strong> <font size="3" color="#FFFFFF">รายละเอียดส่วนติดต่อกับสมาชิก</font></strong></td>
  </tr>
  <tr>
    <td width="35%" align="left">&nbsp;&nbsp;ระบบแสดงใบเสร็จ</td>
    <td width="8%" align="center"><strong>: </strong></td>
    <td width="57%">ระบบแสดงใบเสร็จทุกวันที่ 10 ของทุกเดือน</td>
  </tr>
  <tr>
    <td align="left">&nbsp;&nbsp;จำนวนการแสดงเรียกเก็บย้อนหลัง</td>
    <td align="center"><strong>: </strong></td>
    <td>6 เดือน</td>
  </tr>
  <tr>
    <td align="left">&nbsp;&nbsp;ระบบ E-Slip ใบเสร็จออนไลน์</td>
    <td align="center"><strong>: </strong></td>
    <td><font color="#FF0000">ไม่</font></td>
  </tr>
  <tr>
    <td align="left">&nbsp;&nbsp;รายการเดินบัญชีหุ้นย้อนหลังได้</td>
    <td align="center"><strong>: </strong></td>
    <td>ใช่</td>
  </tr>
  <tr>
    <td align="left">&nbsp;&nbsp;รายการเดินบัญชีเงินฝากย้อนหลัง</td>
    <td align="center"><strong>: </strong></td>
    <td>ไม่เกิน 365 วัน ( 1 ปี ) </td>
  </tr>
  <tr>
    <td align="left">&nbsp;&nbsp;พิมพ์รายการเดินบัญชีเงินฝากย้อนหลัง</td>
    <td align="center"><strong>: </strong></td>
    <td>ใช่</td>
  </tr>
  <tr>
    <td align="left">&nbsp;&nbsp;รายการเดินบัญชีเงินกู้ย้อนหลัง</td>
    <td align="center"><strong>: </strong></td>
    <td>ไม่เกิน 365 วัน ( 1 ปี ) </td>
  </tr>
  <tr>
    <td align="left">&nbsp;&nbsp;พิมพ์รายการเดินบัญชีเงินกู้ย้อนหลัง</td>
    <td align="center"><strong>: </strong></td>
    <td>ใช่</td>
  </tr>
  <tr>
    <td align="left">&nbsp;&nbsp;สมาชิกเป็นคนกำหนดรหัสผ่านเอง</td>
    <td align="center"><strong>: </strong></td>
    <td>ใช่</td>
  </tr>
  <tr>
    <td align="left">&nbsp;&nbsp;สมาชิกสามารถแก้ไขข้อมูลส่วนตัวได้</td>
    <td align="center"><strong>: </strong></td>
    <td><font color="#FF0000">ไม่</font></td>
  </tr>
  <tr>
    <td align="left">&nbsp;&nbsp;สมาชิกสามารถแก้ไขรหัสผ่านได้</td>
    <td align="center"><strong>: </strong></td>
    <td>ใช่</td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="90%" border="0" align="center" cellpadding="4" cellspacing="1">
  <tr>
    <td height="36" colspan="3" align="left" bgcolor="#d62e8e"><strong><font size="3" color="#FFFFFF">รายละเอียดผู้ดูแลระบบ</font></strong></td>
  </tr>
  <tr>
    <td align="left">&nbsp;&nbsp;ผู้ดูแลสามารถเพิ่ม,ปรับปรุง,ลบ ข่าวสาร</td>
    <td align="center"><strong>: </strong></td>
    <td>ใช่</td>
  </tr>
  <tr>
    <td width="35%" align="left">&nbsp;&nbsp;ผู้ดูแลสามารถตรวจสอบสถานะการใช้งาน</td>
    <td width="8%" align="center"><strong>: </strong></td>
    <td width="57%">ใช่</td>
  </tr>
  <tr>
    <td align="left">&nbsp;&nbsp;การสมัครใช้บริการต้องอนุมัติ</td>
    <td align="center"><strong>: </strong></td>
    <td><strong><font color="#FF0000">ไม่</font></strong></td>
  </tr>
  <tr>
    <td width="35%" align="left">&nbsp;&nbsp;ผู้ดูแลสามารถแก้ไขรหัสผ่าน</td>
    <td align="center"><strong>: </strong></td>
    <td>ใช่</td>
  </tr>
  <tr>
    <td align="left">&nbsp;&nbsp;ผู้ดูแลสามารถแก้ไขรหัสผ่านสมาชิก</td>
    <td align="center"><strong>: </strong></td>
    <td>ได้ ( ตั้งรหัสผ่านเป็น &quot;1234&quot; เพื่อให้สมาชิกเข้าไปแก้ไขด้วยตนเอง)</td>
  </tr>
  <tr>
    <td align="left">&nbsp;&nbsp;ผู้ดูแลสามารถลบสมาชิกที่สมัคร</td>
    <td align="center"><strong>: </strong></td>
    <td>ใช่</td>
  </tr>
  <tr>
    <td align="left">&nbsp;&nbsp;ผู้ดูแลสามารถตรวจสอบการ Log in</td>
    <td align="center"><strong>: </strong></td>
    <td>ใช่ (สามารถดูย้อนหลัง 15 ครั้งสุดท้าย)</td>
  </tr>
  <tr>
    <td align="left">&nbsp;&nbsp;ระบบมีการบันทึก IP ADDRESS</td>
    <td align="center"><strong>: </strong></td>
    <td>ใช่</td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
