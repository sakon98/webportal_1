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

<?php 
//require "../s/s.payment_1.php";
require "../s/s.payment.php";
?>
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
                                echo '<option value="'.$slip[$i].'">'.$slip_m[$i].'</option>';
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
<?php $case = "" ?>

<?php 
for($z=0;$z<$Num_Rows;$z++) {
    
    //echo $test1[$z];
    if($keepitem_status[$z] == 1) {
        
        $case = "1";
}
}
?>
<?php if($case == "1") { ?>
<!--<h3 style="margin-left: 22px;"><font color="#222222" size="2" face="Tahoma">รายการหักประจำเดือนที่ถูกเรียกเก็บปกติ</font></h3>-->
 <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="30%" height="25" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">รายการ / สัญญา</font></strong></td>
        <td width="5%" align="center" bgcolor="#6699FF"><font color="#FFFFFF">ด/บ<br />(วัน)</font></td>
        <td width="5%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">งวดที่</font></strong></td>
        <td width="13%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">เงินต้น</font></strong></td>
        <td width="13%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">ดอกเบี้ย</font></strong></td>
        <td width="13%" align="center" bgcolor="#FFCC33"><strong>จำนวนเงิน</strong></td>
        <td width="15%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">คงเหลือ</font></strong></td>
      </tr>
      <?php for($i=0;$i<$Num_Rows;$i++){
          if($keepitem_status[$i] == 1){?>  
      <tr>
        <td height="28" bgcolor="#FFFFFF"><?=($i+1).'. '?><?=$slip_itemdesc[$i]	.' '.$slip_loanno[$i]?></td>
		
		<?php if($period[$i] == "1"){ ?>
			
			 <td align="center" bgcolor="#FFFFFF"><?=$rate_day[$i] + 1?></td>
		<?php }else{ ?>
			
			
			<td align="center" bgcolor="#FFFFFF"><?=$rate_day[$i]?></td>
			
		<?php } ?>
		
        
        <td align="center" bgcolor="#FFFFFF"><?=$period[$i]?></td>
        <td align="right" bgcolor="#FFFFFF"><?=$slip_principal[$i]?></td>
        <td align="right" bgcolor="#FFFFFF"><?=$slip_interest[$i]?></td>
        <td align="right" bgcolor="#FFFF99"><?=$slip_pay[$i]?></td>
        <td align="right" bgcolor="#FFFFFF"><?=$itembalance[$i]?></td>
      </tr>
      <?php } ?>
      <?php } ?>  
      <?php if($Num_Rows1 > 0){ 
          ?>  
      <tr>
        <td height="28" bgcolor="#FFFFFF"><?=($Num_Rows+1).'. '?><?=$moneytype_code	.' '.$expense_accid?></td>
        <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
        <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
        <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
        <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
        <td align="right" bgcolor="#FFFF99">-<?=$item_payment?></td>
        <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
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
        <td bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table> 
<?php }?>

<!--  -->

<?php 
for($x=0;$x<$Num_Rows2;$x++) {
    
    //echo $test[$x]; exit();
    if($keepitem_status_cancel[$x] == -9) {
        
        $case_c = "0";
}
}
?>

<?php if($case_c == "0") { ?>
 <h3 style="margin-left: 22px;"><font color="#EE0000" size="2" face="Tahoma">รายการหักประจำเดือนที่ถูกยกเลิก</font></h3> 
 <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="30%" height="25" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">รายการ / สัญญา</font></strong></td>
        <td width="5%" align="center" bgcolor="#6699FF"><font color="#FFFFFF">ด/บ<br />(วัน)</font></td>
        <td width="5%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">งวดที่</font></strong></td>
        <td width="13%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">เงินต้น</font></strong></td>
        <td width="13%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">ดอกเบี้ย</font></strong></td>
        <td width="13%" align="center" bgcolor="#FFCC33"><strong>จำนวนเงิน</strong></td>
        <td width="15%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">คงเหลือ</font></strong></td>
      </tr>
      <?php for($k=0;$k<$Num_Rows2;$k++){
          if($keepitem_status_cancel[$k] == -9) {?>  
      <tr>
        <td height="28" bgcolor="#FFFFFF"><font color="red"><?=($k+1).'. '?><?=$slip_itemdesc_cancel[$k]	.' '.$slip_loanno_cancel[$k]?></td></font>
        <td align="center" bgcolor="#FFFFFF"><font color="red"><?=$rate_day_cancel[$k]?></td></font>
        <td align="center" bgcolor="#FFFFFF"><font color="red"><?=$period_cancel[$k]?></td></font>
        <td align="right" bgcolor="#FFFFFF"><font color="red"><?=$slip_principal_cancel[$k]?></td></font>
        <td align="right" bgcolor="#FFFFFF"><font color="red"><?=$slip_interest_cancel[$k]?></td></font>
        <td align="right" bgcolor="#FFFF99"><font color="red"><?=$slip_pay_cancel[$k]?></td></font>
        <td align="right" bgcolor="#FFFFFF"><font color="red"><?=$itembalance_cancel[$k]?></td></font>
      </tr>
      <?php } ?> 
      <?php } ?>
      <?php //if($Num_Rows2 > 0){ ?>  
      <!--<tr>
        <td height="28" bgcolor="#FFFFFF"><?//=($Num_Rows+1).'. '?><?//=$moneytype_code	.' '.$expense_accid?></td>
        <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
        <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
        <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
        <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
        <td align="right" bgcolor="#FFFF99">-<?//=$item_payment?></td>
        <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>-->
      <?php //} ?> 
      <tr>
        <td colspan="5" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="81%" align="center"><font color="red"><strong>( -<?=convertthai($totalpayment_cancel-$payment_a)?>- )</strong></font></td>
            <td width="19%" align="right"><font color="red"><strong>รวมชำระ</strong></font></td>
          </tr>
        </table></td>
        <td height="28" align="right" bgcolor="#FFFF99"><font color="red"><strong><?=number_format($totalpayment_cancel-$payment_a,2)?></strong></font></td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
 <?php } ?>
 
 <?php if($case != "1" && $case_c != "0") { ?>
 <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="30%" height="25" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">รายการ / สัญญา</font></strong></td>
        <td width="5%" align="center" bgcolor="#6699FF"><font color="#FFFFFF">ด/บ<br />(วัน)</font></td>
        <td width="5%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">งวดที่</font></strong></td>
        <td width="13%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">เงินต้น</font></strong></td>
        <td width="13%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">ดอกเบี้ย</font></strong></td>
        <td width="13%" align="center" bgcolor="#FFCC33"><strong>จำนวนเงิน</strong></td>
        <td width="15%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">คงเหลือ</font></strong></td>
      </tr>
      <?php for($i=0;$i<$Num_Rows;$i++){ ?>
          
      <tr>
        <td height="28" bgcolor="#FFFFFF"><?=($i+1).'. '?><?=$slip_itemdesc[$i]	.' '.$slip_loanno[$i]?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$rate_day[$i]?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$period[$i]?></td>
        <td align="right" bgcolor="#FFFFFF"><?=$slip_principal[$i]?></td>
        <td align="right" bgcolor="#FFFFFF"><?=$slip_interest[$i]?></td>
        <td align="right" bgcolor="#FFFF99"><?=$slip_pay[$i]?></td>
        <td align="right" bgcolor="#FFFFFF"><?=$itembalance[$i]?></td>
      </tr>
      
      <?php } ?>  
      <?php if($Num_Rows1 > 0){ 
          ?>  
      <tr>
        <td height="28" bgcolor="#FFFFFF"><?=($Num_Rows+1).'. '?><?=$moneytype_code	.' '.$expense_accid?></td>
        <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
        <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
        <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
        <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
        <td align="right" bgcolor="#FFFF99">-<?=$item_payment?></td>
        <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
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
        <td bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table> 
 <?php } ?>
 
<br>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"><font color="#FF0000">*ระบบจะแสดงข้อมูลเดือนล่าสุด กรุณาตรวจสอบอีกครั้งกับทางสหกรณ์</font></td>
  <td></td>
  </tr>
  <tr>

      <?php  require "../s/s.payment_slip_1.php"; ?>
      
      <?php for($i=0;$i<$Num_Rows;$i++){?> 
                       <?php  
                if($slip_loantype_code[$i] == 30 || $slip_loantype_code[$i] == 32 || $slip_loantype_code[$i] == 39 || $slip_loantype_code[$i] == 52){
                    
                    //echo $slip_loantype_code[$i];
                    
                    $loantype = "1";
                }
                }
                ?>
      
                    

    <td align="center">  
        
        <?php $date = date("Y-m-d");
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        //$day = 30;

        
        if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12){
            
           $maxday = 31;
        }
        elseif ($month == 4 || $month == 6 || $month == 9 || $month == 11) {
            $maxday = 30;  
           }
        elseif ($month == 2) {
           $maxday = 28;  
           }?>
        
    <?php 
  // echo $max_chack; // วันที่สูงสุดที่ดึงออกมา
  // echo $listslip+2; // เดือนปัจจุบัน
   
    if($closemonth_id == "" && $max_chack == $listslip+2){  
    
    //   echo 'ไม่เเสดง';
        
    }
 
    else {
    if($printslip == 1 && $case == "1"){ ?>
        
        
        
    <form id="form1" name="form1" method="post" action="slip.php" onsubmit="popup_statment(this);">
        <br>
      <input type="submit" name="button" id="button" value="พิมพ์ใบเสร็จประจำเดือนทั่วไป" />
      <input type="hidden" name="slip_date" value="<?=$_REQUEST["slip_date"]?>" id="slip_date" />
    </form>
    <?php } }?>
        
         <?php 
         if($closemonth_id == "" && $max_chack == $listslip+2){  
    
       // echo 'ไม่เเสดง';   
    }
    else {
         if($printslip == 1 && $case == "1" && $loantype == "1"){ ?>
    <form id="form1" name="form1" method="post" action="slip1.php" onsubmit="popup_statment(this);">
        
      <input type="submit" name="button" id="button" value="พิมพ์ใบเสร็จประจำเดือนเคหะสงเคราะห์" />
      <input type="hidden" name="slip_date" value="<?=$_REQUEST["slip_date"]?>" id="slip_date" />
    </form>
         <?php } }?>
    </td>
  </tr>
</table>
<p>&nbsp;</p>
