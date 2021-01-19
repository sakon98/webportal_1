<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
require "../include/lib.Etc.php";
$loan_type = $_REQUEST["loan_type"];
$type_pay = $_REQUEST["type_pay"];
$loan_amt = str_replace(',', '', $_POST["loan_amt"]);
$rate = $_REQUEST["rate"];
$period = $_REQUEST["period"];
$share = $_REQUEST["share"];
$date1 = $_REQUEST["date1"];

if($type_pay == 1){
?>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;
      <table width="550" border="0" align="center" cellpadding="3" cellspacing="3">
        <tr>
          <td colspan="3" align="center"><strong><font size="3">คำนวณการผ่อนชำระเงินกู้
                <?php 
		   	if($loan_type == 1){ 
				echo 'สามัญ';
			}else if($loan_type == 2){
				echo 'พิเศษ';
			}
		  ?>
(
<?php 
		   	if($type_pay == 1){ 
				echo 'คงต้น';
			}else if($type_pay == 2){
				echo 'คงยอด';
			}
		  ?> )</font></strong></td>
        </tr>
        <tr>
          <td colspan="3" align="right"><hr / size="1" /></td>
        </tr>
        <tr>
          <td colspan="3" align="center"></td>
        </tr>
        <tr>
          <td width="207" align="right">จำนวนเงินกู้ :</td>
          <td width="152" align="center">
            <?=number_format($loan_amt,2)?></td>
          <td width="173" align="left">บาท</td>
        </tr>
        <?php if($share < 0){ ?>
        <?php } ?>
        <tr>
          <td align="right">อัตราดอกเบี้ย :</td>
          <td align="center">
            <?=number_format($rate,2).' %'?></td>
          <td align="left">ต่อปี</td>
        </tr>
        <tr>
          <td align="right">จำนวนงวด :</td>
          <td align="center">
            <?=number_format($period,0)?></td>
          <td align="left">งวด</td>
        </tr>
        <tr>
          <td align="right">วันที่รับเงิน :</td>
          <td align="center"><?=ConvertDate_cu($date1,'ad','th') ?></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
    </table></td>
  </tr>

  <tr>
    <td bgcolor="#FFFFFF"><table width="800" border="1" align="center" cellpadding="2" cellspacing="2">
      <tr>
        <td width="56" height="33" align="center"><strong>งวดที่</strong></td>
        <td width="198" align="center"><strong>เงินกู้/เงินกู้คงเหลือ</strong></td>
        <td width="167" align="center"><strong>เดือนที่หักเงิน</strong></td>
        <td width="71" align="center"><strong>จำนวนวัน</strong></td>
        <td width="124" align="center"><strong>ดอกเบี้ย</strong></td>
        <td width="124" align="center"><strong>เงินต้น</strong></td>
        <td width="140" align="center"><strong>รวมหัก</strong></td>
      </tr>
      <?php 

	  $row = 1;
	  $arrDate = explode("/",$date1);
	  $d = $arrDate[0];
	  $m = $arrDate[1];
	  $y = $arrDate[2]-543;
	  
	$date_s = $d.'-'.$m.'-'.$y ;
	  
	 if(intval($d) > 6){
		$arrDate1 = explode("-",$date_s);
		$date_e  = gmdate ("t-m-Y", mktime(0,0,0,$arrDate1[1]+1,date('d'),$arrDate1[2]));			
	 }else{
		$arrDate1 = explode("-",$date_s);
		$date_e  = gmdate ("t-m-Y", mktime(0,0,0,$arrDate1[1],date('d'),$arrDate1[2]));		
	 }
	 
	$loan_per_month = floor($loan_amt / $period);

	  for($i=0;$i<$period;$i++){  
	 	$before_date_s = $date_s;
		$before_date_e = $date_e;

		$arrDate2 = explode("-",$date_e);
		$date_s = gmdate ("t-m-Y", mktime(0,0,0,$arrDate2[1],date('d'),$arrDate2[2]));	
		$arrDate3 = explode("-",$date_e);
		$date_e = gmdate ("t-m-Y", mktime(0,0,0,$arrDate3[1]+1,date('d'),$arrDate3[2]));		
		$diffdate = round(DateDiff_cu($before_date_s,$before_date_e),0);

		if($i == ($period-1)){
			$loan_amt = $loan_amt;
			$loan_per_month = $loan_amt;
		}
		
		if($i ==0){
			$diffdate = $diffdate+1;
		}
		$z = date("z", mktime(0,0,0,12,31,(substr($date_s,-4)))) + 1;
		$rate_per_day = round((($loan_amt*$rate/100)/$z )*$diffdate,2);

	  ?>
      <tr>
        <td height="0" align="center"><?=$row++?></td>
        <td height="0" align="center"><?=number_format(round($loan_amt,2),2)?></td>
        <td height="0" align="center"><?=ConvertDate_cu($before_date_e,'bc','num2')?></td>
        <td height="0" align="center"><?=$diffdate//.'/'.$z 	?></td>
        <td height="0" align="right"><?=number_format($rate_per_day,2)?></td>
        <td height="0" align="right"><?=number_format($loan_per_month,2)?></td>
        <td height="0" align="right"><?=number_format(round($rate_per_day,2)+$loan_per_month,2)?></td>
      </tr>
      <?php  
	  $loan_amt = $loan_amt - $loan_per_month;
	  
	  $sum_rate = $sum_rate + number_format($rate_per_day,2,'.','');
	  $total_rate = $total_rate + number_format($rate_per_day,2,'.','');
	  
	  $sum_loan = $sum_loan + number_format($loan_per_month,2,'.','');
	  $total_loan = $total_loan + number_format($loan_per_month,2,'.','');
	  
	  
	  
	  if(substr($before_date_e,-4) != substr($date_e,-4) ){
		?>
			<tr>
				<td height="25" colspan="4" align="right" bgcolor="#FFFF66"><strong>รวมยอดปี 
<?=substr($before_date_e,-4)+543?>
			  </strong></td>
				<td height="0" align="right" bgcolor="#FFFF66"><strong>
			    <?=number_format($sum_rate,2)?>
				</strong></td>
				<td height="0" align="right" bgcolor="#FFFF66"><strong>
			    <?=number_format($sum_loan,2)?>
				</strong></td>
				<td height="0" align="right" bgcolor="#FFFF66"><strong>
			    <?=number_format($sum_loan+$sum_rate,2)?>
				</strong></td>
			  </tr>
		<?php
		$sum_rate = 0;
		$sum_loan = 0;
		
	  }
	  
	  if($row == $period+1){
		?>
			<tr>
				<td height="25" colspan="4" align="right" bgcolor="#FFFF66"><strong>รวมยอดปี  
			    <?=substr($before_date_e,-4)+543?>
				</strong></td>
				<td height="0" align="right" bgcolor="#FFFF66"><strong>
			    <?=number_format($sum_rate,2)?>
				</strong></td>
				<td height="0" align="right" bgcolor="#FFFF66"><strong>
			    <?=number_format($sum_loan,2)?>
				</strong></td>
				<td height="0" align="right" bgcolor="#FFFF66"><strong>
			    <?=number_format($sum_loan+$sum_rate,2)?>
				</strong></td>
			  </tr>
              <tr>
				<td height="28" colspan="4" align="right" bgcolor="#0099FF"><strong>รวมทั้งสิ้นตลอดสัญญา</strong></td>
				<td height="0" align="right" bgcolor="#0099FF"><strong>
			    <?=number_format($total_rate,2)?>
				</strong></td>
				<td height="0" align="right" bgcolor="#0099FF"><strong>
			    <?=number_format($total_loan,2)?>
				</strong></td>
				<td height="0" align="right" bgcolor="#0099FF"><strong>
			    <?=number_format($total_loan+$total_rate,2)?>
				</strong></td>
			  </tr>
		<?php
		$sum_rate = 0;
		$sum_loan = 0;
		
	  }
	  
	   } ?>
   
    </table><br/></td>
  </tr>
</table>
<?php }else{ ?>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;
      <table width="550" border="0" align="center" cellpadding="3" cellspacing="3">
        <tr>
          <td colspan="3" align="center"><strong><font size="3">คำนวณการผ่อนชำระเงินกู้
                <?php 
		   	if($loan_type == 1){ 
				echo 'สามัญ';
			}else if($loan_type == 2){
				echo 'พิเศษ';
			}
		  ?> 
            ( 
        <?php 
		   	if($type_pay == 1){ 
				echo 'คงต้น';
			}else if($type_pay == 2){
				echo 'คงยอด';
			}
		  ?> 
          )</font></strong></td>
        </tr>
        <tr>
          <td colspan="3" align="right"><hr / size="1" /></td>
        </tr>
        <tr>
          <td colspan="3" align="center"></td>
        </tr>
        <tr>
          <td width="207" align="right">จำนวนเงินกู้ :</td>
          <td width="152" align="center">
            <?=number_format($loan_amt,2)?></td>
          <td width="173" align="left">บาท</td>
        </tr>
        <tr>
          <td align="right">อัตราดอกเบี้ย :</td>
          <td align="center">
            <?=number_format($rate,2).' %'?></td>
          <td align="left">ต่อปี</td>
        </tr>
        <tr>
          <td align="right">จำนวนงวด :</td>
          <td align="center">
            <?=number_format($period,0)?></td>
          <td align="left">งวด</td>
        </tr>
        <tr>
          <td align="right">วันที่รับเงิน :</td>
          <td align="center"><?=ConvertDate_cu($date1,'ad','th') ?></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
    </table></td>
  </tr>

  <tr>
    <td bgcolor="#FFFFFF"><table width="800" border="1" align="center" cellpadding="2" cellspacing="2">
      <tr>
        <td width="56" height="33" align="center"><strong>งวดที่</strong></td>
        <td width="198" align="center"><strong>เงินกู้/เงินกู้คงเหลือ</strong></td>
        <td width="167" align="center"><strong>เดือนที่หักเงิน</strong></td>
        <td width="71" align="center"><strong>จำนวนวัน</strong></td>
        <td width="124" align="center"><strong>ดอกเบี้ย</strong></td>
        <td width="124" align="center"><strong>เงินต้น</strong></td>
        <td width="140" align="center"><strong>รวมหัก</strong></td>
      </tr>
      <?php 
		
		$arrDate = explode("/",$date1);
		$d = $arrDate[0];
		$m =  $arrDate[1];
		$y = $arrDate[2]-543;
	  
		$date_s = $d.'-'.$m.'-'.$y ;
	  
		$ldc_fr = exp(-$period *log((1+($rate/100)/12)));		
		$pay = $loan_amt*(($rate/100)/12)/(1-$ldc_fr); // ผ่อนต่อเดือน
		
		$pay = $pay*100;
		$pay = floor($pay);
		$pay = $pay/100;
		
		$arrDate1 = explode("-",$date_s);
		$date_e  = gmdate ("t-m-Y", mktime(0,0,0,$arrDate1[1],date('d'),$arrDate1[2]));		
		
		$before_loan = $loan_amt;
		
	 if(intval($d) > 6){
		$arrDate1 = explode("-",$date_s);
		$date_e  = gmdate ("t-m-Y", mktime(0,0,0,$arrDate1[1]+1,date('d'),$arrDate1[2]));			
	 }else{
		$arrDate1 = explode("-",$date_s);
		$date_e  = gmdate ("t-m-Y", mktime(0,0,0,$arrDate1[1],date('d'),$arrDate1[2]));		
	 }
		
		
		
	  

		$row = 1;

		for($i=0;$i<$period;$i++){  
			
			$before_date_s = $date_s;
			$before_date_e = $date_e;
	
			$arrDate2 = explode("-",$date_e);
			$date_s = gmdate ("t-m-Y", mktime(0,0,0,$arrDate2[1],date('d'),$arrDate2[2]));	
			$arrDate3 = explode("-",$date_e);
			$date_e = gmdate ("t-m-Y", mktime(0,0,0,$arrDate3[1]+1,date('d'),$arrDate3[2]));		
			$diffdate = round(DateDiff_cu($before_date_s,$before_date_e),0);
	
			if($i ==0){
				$diffdate = $diffdate+1;
			}
			$z = date("z", mktime(0,0,0,12,31,(substr($date_s,-4)))) + 1;
			$rate_per_day = round((($loan_amt*($rate/100))/$z )*$diffdate,2);
			
			if($i == ($period-1)){
				$loan_amt = $loan_amt;
				$loan_per_month = $loan_amt;
			}else{
				$loan_per_month = $pay -$rate_per_day;
			}?>
            
		  <tr>
			<td height="0" align="center"><?=$row++?></td>
			<td height="0" align="center"><?=number_format(round($loan_amt,2),2)?></td>
			<td height="0" align="center"><?=ConvertDate_cu($before_date_e,'bc','num2')?></td>
			<td height="0" align="center"><?=$diffdate//.'/'.$z 	?></td>
			<td height="0" align="right"><?=number_format($rate_per_day,2)?></td>
			<td height="0" align="right"><?=number_format($loan_per_month,2)?></td>
			<td height="0" align="right"><?=number_format(round($rate_per_day,2)+$loan_per_month,2)?></td>
		  </tr><?php  
		  
		  $loan_amt = $loan_amt - $loan_per_month;
		  
		  $sum_rate = $sum_rate + number_format($rate_per_day,2,'.','');
		  $total_rate = $total_rate + number_format($rate_per_day,2,'.','');
		  
		  $sum_loan = $sum_loan + number_format($loan_per_month,2,'.','');
		  $total_loan = $total_loan + number_format($loan_per_month,2,'.','');

		  if(substr($before_date_e,-4) != substr($date_e,-4) ){?>
				<tr>
					<td height="25" colspan="4" align="right" bgcolor="#FFFF66"><strong>รวมยอดปี <?=substr($before_date_e,-4)+543?></strong></td>
					<td height="0" align="right" bgcolor="#FFFF66"><strong><?=number_format($sum_rate,2)?></strong></td>
					<td height="0" align="right" bgcolor="#FFFF66"><strong><?=number_format($sum_loan,2)?></strong></td>
					<td height="0" align="right" bgcolor="#FFFF66"><strong><?=number_format($sum_loan+$sum_rate,2)?></strong></td>
	    </tr><?php
				  
			$sum_rate = 0;
			$sum_loan = 0;
		  }
		  if($row == $period+1){?>		
				  <tr>
					<td height="28" colspan="4" align="right" bgcolor="#0099FF"><strong>รวมทั้งสิ้นตลอดสัญญา</strong></td>
					<td height="0" align="right" bgcolor="#0099FF"><strong><?=number_format($total_rate,2)?></strong></td>
					<td height="0" align="right" bgcolor="#0099FF"><strong><?=number_format($total_loan,2)?></strong></td>
					<td height="0" align="right" bgcolor="#0099FF"><strong><?=number_format($total_loan+$total_rate,2)?></strong></td>
				  </tr>
		<?php

			$sum_rate = 0;
			$sum_loan = 0;
		  }
	   }

 ?>
   
    </table><br/></td>
  </tr>
</table>


<?php } ?>
