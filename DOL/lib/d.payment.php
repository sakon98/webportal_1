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

<?php require "../s/s.payment.php"; ?>
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
		if($slip[$i] < 255810){
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

<?php if($Num_Rows > 0) { ?>

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="30%" height="25" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">รายการ/เลขสัญญา</font></strong></td>
        <!--<td width="5%" align="center" bgcolor="#6699FF"><font color="#FFFFFF">ด/บ<br />(วัน)</font></td>-->
        <td width="10%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">งวดที่</font></strong></td>
        <td width="13%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">เงินต้น</font></strong></td>
        <td width="13%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">ดอกเบี้ย</font></strong></td>
        <td width="13%" align="center" bgcolor="#FFCC33"><strong>จำนวนเงิน</strong></td>
        <td width="15%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">คงเหลือ</font></strong></td>
      </tr>
	  
	  
	  
      <?php for($i=0;$i<$Num_Rows;$i++){?>  
      <tr>
        <td height="28" bgcolor="#FFFFFF"><?=($i+1).'. '?><?=$slip_itemdesc[$i]	.' '.$slip_loanno[$i]?></td>
        <!-- <td align="center" bgcolor="#FFFFFF"><?//=$rate_day[$i]?></td> -->
		
		<?php if($slip_itemtype[$i] == "LON"){ ?>
        <td align="center" bgcolor="#FFFFFF"><?=$period[$i]."/".$period_payamt[$i]?></td>
		<?php }else{ ?>
		<td align="center" bgcolor="#FFFFFF"><?=$period[$i]?></td>
		<?php } ?>
        <td align="right" bgcolor="#FFFFFF"><?=$slip_principal[$i]?></td>
        <td align="right" bgcolor="#FFFFFF"><?=$slip_interest[$i]?></td>
        <td align="right" bgcolor="#FFFF99"><?=$slip_pay[$i]?></td>
        <td align="right" bgcolor="#FFFFFF"><?=$itembalance[$i]?></td>
      </tr>
	  
	  <?php } ?>
	  
      <?php if($Num_Rows1 > 0){ ?>  
      <tr>
        <td height="28" bgcolor="#FFFFFF"><?=($Num_Rows+1).'. '?><?=$moneytype_code	.' '.$expense_accid?></td>
        <!--<td align="center" bgcolor="#FFFFFF">&nbsp;</td>-->
        <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
        <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
        <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
        <td align="right" bgcolor="#FFFF99">-<?=$item_payment?></td>
        <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <?php } ?>        
      <tr>
        <td colspan="4" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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

<br>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>
    <td align="center">
	
	<?php if($share_now > 0){
	
	$printslip = 1;
	
	}else{
	
	$printslip = 0;
	
	}
	
	?>
	
    <?php if($printslip == 1){ ?>
    <form id="form1" name="form1" method="post" action="slip.php" onsubmit="popup_statment(this);">
      <input type="submit" name="button" id="button" value="พิมพ์" />
      <input type="hidden" name="slip_date" value="<?=$_REQUEST["slip_date"]?>" id="slip_date" />
    </form>
    <?php } ?>
    </td>
  </tr>
</table>

<?php }else{ ?>

  <center><font size="4" color="red"> -ไม่มีรายการเรียกเก็บ- </font></center>

<?php } ?>

<br>

<!-- ข้อมูลใบเสร็จ LPX -->

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="82%" align="left"><strong><font size="4" face="Tahoma">ใบเสร็จ รับชำระพิเศษ</font></strong><br />
  </tr>
  <tr>
    <td colspan="2" align="left"><hr color="#999999" size="1"/></td>
  </tr>
</table>

<?php if($Num_Rows4 > 0) { ?>

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="10%" height="25" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">ลำดับที่</font></strong></td>
        <td width="20%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">เลขที่ใบเสร็จ</font></strong></td>
        <td width="40%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">รายการใบเสร็จ</font></strong></td>
        <td width="20%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">พิมพ์ใบเสร็จ</font></strong></td>
        
      </tr>
	  
	  
	  
	  
	  <?php for($u=0;$u<$Num_Rows4;$u++){ ?>
      <tr>
        <td height="25" bgcolor="#FFFFFF" align="center"><?=($u+1)?></td>

		<td align="center" bgcolor="#FFFFFF"><?=$ref_docno[$u]?></td>

         <?php 
        
         $strSQL13 = " 
                        SELECT 
                (SELECT COUNT(REF_DOCNO) FROM LNCONTSTATEMENT WHERE LOANITEMTYPE_CODE = 'LPX' AND REF_DOCNO = '$ref_docno[$u]' AND ITEM_STATUS = 1 ) +
                (SELECT COUNT(REF_DOCNO) FROM SHSHARESTATEMENT WHERE SHRITEMTYPE_CODE = 'SPX'  AND REF_DOCNO = '$ref_docno[$u]' AND ITEM_STATUS = 1) AS C_REF
                FROM DUAL";		
	$value13 = array('C_REF');		
	list($Num_Rows13,$slip_show13) = get_value_many_oci($strSQL13,$value13);	
	$v=0;
	for($t=0;$t<$Num_Rows13;$t++){ 
		$c_ref[$t] = $slip_show13[$t][$v++];   	
		$v=0;
        ?>
        
        <td align="center" bgcolor="#FFFFFF"><?//=$loancontract_no[$u]?>ชำระพิเศษ (<?php echo $c_ref[$t]; ?>)</td>
        <?php } ?>
		
        <td align="center" bgcolor="#FFFFFF"><form id="form1" name="form1" method="post" action="slip_lpx.php" onsubmit="popup_statment(this);">
        <input type="submit" name="button" id="button" value="พิมพ์" />
       <input type="hidden" name="receipt_no" value="<?=$ref_docno[$u]?>" id="receipt_no" />
	   <input type="hidden" name="slip_date_lpx" value="<?=$slip_date_l[$u]?>" id="slip_date_lpx" />
	   <input type="hidden" name="show_date" value="<?=$show_date[$u]?>" id="show_date" />
    </form></td>
      </tr>
    <?php } ?>
    </table></td>
  </tr>
</table>

<?php }else { ?>
<br><br>
 <center><font size="4" color="red"> -ไม่มีรายการชำระพิเศษ- </font></center>

<?php } ?>

<!-- ข้อมูลหลักประกัน -->

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="82%" align="left"><br />
  </tr>

</table>

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="82%" align="left"><strong><font size="4" face="Tahoma">หลักประกัน</font></strong><br />
  </tr>
  <tr>
    <td colspan="2" align="left"><hr color="#999999" size="1"/></td>
  </tr>
</table>


<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="10%" height="25" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">ลำดับที่</font></strong></td>
        <td width="20%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">เลขสัญญา</font></strong></td>
        <td width="40%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">ผู้ค้ำประกัน</font></strong></td>
        <td width="20%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">เลขทะเบียนสมาชิก</font></strong></td>
        
      </tr>
	  
	   <?php if($Num_Rows > 0 || $Num_Rows4 > 0){ ?> 
	  
	  <?php 
	  
	  
	    $strSQL2 = "SELECT LM.LOANCONTRACT_NO,
								CT.LOANCOLLTYPE_DESC,
								LC.REF_COLLNO,
								LC.DESCRIPTION,
								NVL(LM.PRINCIPAL_BALANCE,0)+NVL(LM.WITHDRAWABLE_AMT,0) AS PRNBAL_AMT,
								LC.COLLACTIVE_PERCENT,
								(NVL(LM.PRINCIPAL_BALANCE,0) + NVL(LM.WITHDRAWABLE_AMT,0)) * (LC.COLLACTIVE_PERCENT/100) AS COLLACTIVE_AMT
								FROM LNCONTMASTER LM , LNCONTCOLL LC , LNUCFLOANCOLLTYPE CT
								WHERE (LM.LOANCONTRACT_NO = LC.LOANCONTRACT_NO)
								AND (CT.LOANCOLLTYPE_CODE = LC.LOANCOLLTYPE_CODE)
								AND (LM.CONTRACT_STATUS > 0) AND LC.COLL_STATUS > 0
								AND (LM.MEMBER_NO = '$member_no')
								ORDER BY LM.LOANTYPE_CODE
                        ";
	$value2 = array('LOANCONTRACT_NO','DESCRIPTION','REF_COLLNO');		
	list($Num_Rows2,$slip_show2) = get_value_many_oci($strSQL2,$value2);	

	$b=0;
	for($a=0;$a<$Num_Rows2;$a++){ 
		$loancontract_no 	= $slip_show2[$a][$b++];   				
		$fullname 	= $slip_show2[$a][$b++];			
		$member_no	= $slip_show2[$a][$b++];
		$b=0;
	  
	 
	  
	  ?>
	  
      <tr>
        <td height="25" bgcolor="#FFFFFF" align="center"><?=($a+1)?></td>

		<td align="center" bgcolor="#FFFFFF"><?=$loancontract_no?></td>

        <td align="center" bgcolor="#FFFFFF"><?=$fullname?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$member_no?></td>
      </tr>
      <?php } ?>   

<?php } ?>      
    </table></td>
  </tr>
</table>

<br>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"><font color="#FF0000">*ระบบจะแสดงข้อมูลเดือนล่าสุด กรุณาตรวจสอบอีกครั้งกับทางสหกรณ์</font></td>
  </tr>
  
</table>
<p>&nbsp;</p>
