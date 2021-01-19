<?php
session_start();
header('Content-Type: text/html; charset=tis-620');
?>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
	<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />	
    <script src="../js/jquery-1.6.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="../js/jquery-ui-1.8.10.offset.datepicker.min.js"></script>
	<script type="text/javascript">
		  $(function () {
		    var d = new Date();
		    var toDay = d.getDate() + '/'
        + (d.getMonth() + 1) + '/'
        + (d.getFullYear() + 543);
		    $("#datepicker-th").datepicker({ dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay, dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});			
			$("#datepicker-th1").datepicker({ dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay, dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});			  
		    $("#datepicker-th2").datepicker({ dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay, dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});
			  $("#inline").datepicker({ dateFormat: 'dd/mm/yy', inline: true });
			});
			function popup_statment(form) {
				var w = 910;
				var h = 530;
				var left = (screen.width/2)-(w/2);
				var top = (screen.height/3)-(h/3);
				var acc_no = $("#acc_no").val();
				var date1 =  $("#date1").val();
				var date2 =  $("#date2").val();
				if(acc_no != "" && date1 != "" && date2 != ""){
			 window.open ('', 'formpopup', 'toolbar=no, location=no, directories=no, status=no, menubar=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
				 form.target = 'formpopup';
				}
			} 

			jQuery(document).ready(function(){
						jQuery("#formID1").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});
			});
        </script>

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"><strong><font size="4" face="Tahoma">ตั้งค่าระบบ</font></strong><br />
      <font color="#FF6600" size="2" face="Tahoma">Configuration Systems</font></td>
  </tr>
  <tr>
    <td align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<?php require "../s/s.configuration.php"; ?>
<form id="formID1" name="formID1" method="post" action="">
<table width="90%" border="0" align="center" cellpadding="4" cellspacing="1">
    <tr>
      <td height="36" colspan="2" align="left" bgcolor="#d62e8e"><strong><font color="#FFFFFF" size="3">รายการยืนยันยอด</font></strong></td>
    </tr>
    <tr>
      <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แสดงยืนยัน ณ วันที่</td>
      <td width="81%" height="36" align="left"><font size="2" face="Tahoma">
        <input name="date1" type="text"    id="datepicker-th"  style="text-align:center" size="12" readonly="readonly" value="<?=ConvertDate($confirm_day,"num_bc")?>"/>
      </font></td>
    </tr>
    <tr>
      <td width="19%" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เริ่มวันที่</td>
      <td height="36" align="left"><font size="2" face="Tahoma">
        <input name="date2" type="text"    id="datepicker-th1"   style="text-align:center" size="12" readonly="readonly" value="<?=ConvertDate($confirm_start,"num_bc")?>"/>
      </font></td>
    </tr>
    <tr>
      <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ถึงวันที่</td>
      <td height="36" align="left"><font size="2" face="Tahoma">
        <input name="date3" type="text"   id="datepicker-th2" "  style="text-align:center" size="12" readonly="readonly" value="<?=ConvertDate($confirm_end,"num_bc")?>"/>
      </font></td>
    </tr>
    <tr>
      <td align="left">&nbsp;</td>
      <td height="36" align="left"><input type="submit" name="button" id="button" value="ปรับปรุง" /></td>
    </tr>
  </table>
</form>