<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <link rel="stylesheet" href="../css/validationEngine.jquery.css" type="text/css">
	<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />	
    <script src="../js/jquery-1.6.min.js" type="text/javascript"></script>
	<script src="../js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="tis-620"></script>
	<script src="../js/jquery.validationEngine.js" type="text/javascript" charset="tis-620"></script>
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
			  $("#inline").datepicker({ dateFormat: 'dd/mm/yy', inline: true });
			});
			function popup_statment(form) {
				var w = 910;
				var h = 530;
				var left = (screen.width/2)-(w/2);
				var top = (screen.height/3)-(h/3);
				var slip = $("#slip").val();
				if(slip != ""){
			 window.open ('', 'formpopup', 'toolbar=no, location=no, directories=no, status=no, menubar=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
				 form.target = 'formpopup';
				}
			} 

			jQuery(document).ready(function(){
						jQuery("#formID1").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});
			});
        </script>
		<style type="text/css">
			body{ font: 80% "Tamaho"; margin: 0px;}
			.demoHeaders { margin-top: 2em; }
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
			ul.test {list-style:none; line-height:30px;}
		</style>	

<?php require "../s/s.payment_etc.php"; ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="82%" align="left"><strong><font size="4" face="Tahoma">รายการหักประจำเดือน <?=$show_month?></font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Monthly Payment</font></td>
    <td width="18%" align="right" valign="top">
    <form id="formID1" name="formID1" method="post" action="" >
        <select name="slip_date" id="slip_date"  onchange="this.form.submit()" >
            <option value=""> --- กรุณาเลือก ---</option>
                 <?php  	
                    for($i=0;$i<count($slip);$i++){
		if($slip[$i] < 256111){
			continue;
                                }else{
			echo '<option value="'.$slip[$i].'">'.$slip_m[$i].'</option>';
		}
                    }
                    ?>
    	</select>
    </form>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="left"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<br />
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="30%" height="25" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">รายการ </font></strong></td>
        <td width="5%" align="center" bgcolor="#6699FF"><font color="#FFFFFF">ด/บ<br />(วัน)</font></td>
        <td width="5%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">งวดที่</font></strong></td>
        <td width="13%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">เงินต้น</font></strong></td>
        <td width="13%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">ดอกเบี้ย</font></strong></td>
        <td width="13%" align="center" bgcolor="#FFCC33"><strong>จำนวนเงิน</strong></td>
       
      </tr>
      <?php for($i=0;$i<$Num_Rows;$i++){?>  
      <tr>
        <td height="28" bgcolor="#FFFFFF"><?=($i+1).'. '?><?=$keepothitemtype_desc[$i]?></td>
        <td align="center" bgcolor="#FFFFFF"></td>
        <td align="center" bgcolor="#FFFFFF"></td>
        <td align="right" bgcolor="#FFFFFF"></td>
        <td align="right" bgcolor="#FFFFFF"></td>
        <td align="right" bgcolor="#FFFF99"><?=number_format($item_payment[$i],2)?></td>
        
      </tr>
      <?php } ?>      
      <tr>
        <td colspan="5" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="81%" align="center"><strong>( -<?=convertthai($totalpayment-$payment_a)?>- )</strong></td>
            <td width="19%" align="right"><strong>รวมชำระ</strong></td>
          </tr>
        </table></td>
        <td height="28" align="right" bgcolor="#FFFF99"><strong><?=number_format($totalpayment-$payment_a,2)?></strong></td>
       
      </tr>
    </table></td>
  </tr>
</table>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"><font color="#FF0000">*ระบบจะแสดงข้อมูลเดือนล่าสุด กรุณาตรวจสอบอีกครั้งกับทางสหกรณ์</font></td>
  </tr>
  <tr>
    <td align="center">
    <?php if($printslip == 0){ ?>
    <form id="form1" name="form1" method="post" action="slip_etc.php" onsubmit="popup_statment(this);">
      <input type="submit" name="button" id="button" value="พิมพ์" />
      <input type="hidden" name="slip_date" value="<?=$_REQUEST["slip_date"]?>" id="slip_date" />
    </form>
    <?php } ?>
    </td>
  </tr>
</table>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><font color="#FF0000">สมาชิกสามารถพิมพ์ใบเสร็จประจำเดือนได้ตั้งเเต่วันที่ 6 ของเดือนเป็นต้นไป </font></td>
  </tr>
  
</table>
<p>&nbsp;</p>
