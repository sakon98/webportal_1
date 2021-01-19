<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<form id="formID_" name="formID_" method="post" action="" onsubmit="return confirm('กรุณายืนยันทำรายการ ?')" >
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left"><strong><font size="4" face="Tahoma">ตารางรับชำระ </font></strong><br />       
    <font color="#0000FF" size="2" face="Tahoma">Estimated Payment</font></td>
  </tr>
  <tr>
    <td align="left"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<table width="95%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td  height="35" align="center" bgcolor="#CCCCFF">ประเภทการกู้ : </td>
	<td  bgcolor="#FFFFFF">
			<select name="loantype_code" id="loantype_code" style="display:;width:150px;">
	<?php 
	
	$strSQL="select * from lnloantype";

	$value = array('LOANTYPE_CODE','LOANTYPE_DESC');		
	list($Num_Rows,$data) = get_value_many_oci($strSQL,$value);	
	
	if(isset($_REQUEST["loantype_code"])==false)
     $_REQUEST["loantype_code"]=$data[0][0];
	     
		    for($i=0;$i<$Num_Rows;$i++){
	?>
			<option value="<?=$data[$i][0]?>" <?php if($_REQUEST["loantype_code"]==$data[$i][0]){?>selected="selected"<?php } ?> ><?=$data[$i][0]?>:<?=$data[$i][1]?></option>
			<?php } ?>
		</select>
	</td>
	<?php
	
	
	$strSQL="select lnloantype.loantype_code,lnloantype.loantype_desc,interest_rate
			from lnloantype,lncfloanintratedet
			where lnloantype.coop_id = lncfloanintratedet.coop_id
			and lnloantype.inttabrate_code = lncfloanintratedet.loanintrate_code
			and lnloantype.loantype_code = '".$_REQUEST["loantype_code"]."'
			and trunc(sysdate) between lncfloanintratedet.effective_date and lncfloanintratedet.expire_date ";

	$value = array('INTEREST_RATE');		
	list($Num_Rows,$data) = get_value_many_oci($strSQL,$value);	
    if($Num_Rows>0)	
    $_REQUEST["contint_rate"]=$data[0][0];	
			
	if(isset($_REQUEST["period_payment_btn"])){
		
	
		if($_REQUEST["payment_type"]=="0"){
			
			$_REQUEST["period_payment"] = ceil(($_REQUEST["principal_balance"] / $_REQUEST["period_installment"])/10)*10;
			
		}else{
			
			$int_rate = ($_REQUEST["contint_rate"] / 100); 
			$d = ((1 + ($int_rate / 12)));
			$fr = exp(($_REQUEST["period_installment"] * (-1)) * log($d));
			$a = $_REQUEST["principal_balance"] * ($int_rate / 12) / (1 - ($fr));
			$_REQUEST["period_payment"]= round($a/10)*10;
			//$_REQUEST["period_payment"]= floor($a);	
			
		}
	}
	
	if(isset($_REQUEST["start_date"])==false) 
		  $_REQUEST["start_date"]=date("Y-m-d");
	
	if(isset($_REQUEST["startpay_period"])==false) 
		  $_REQUEST["startpay_period"]=date("Y-m-d");
	
	?>
    <td  height="35" align="center" bgcolor="#CCCCFF">อัตรา ด/บ : </td>
	<td  bgcolor="#FFFFFF"><input type="text" id="contint_rate" name="contint_rate" value="<?=$_REQUEST["contint_rate"]?>" style="display:;width:100px;"/></td>
    <td  height="35" align="center" bgcolor="#CCCCFF">จำนวนวันในรอบปี : </td>
	<td  bgcolor="#FFFFFF"><input type="text" id="an_year" name="an_year" value="365" style="display:;width:100px;"/></td>
  </tr>  
  <tr>
    <td  height="35" align="center" bgcolor="#CCCCFF">จำนวนเงินที่กู้ : </td>
	<td  bgcolor="#FFFFFF"><input type="text" id="principal_balance" name="principal_balance" value="200000" style="display:;width:100px;"/></td>
    <td  height="35" align="center" bgcolor="#CCCCFF">จำนวนงวด : </td>
	<td  bgcolor="#FFFFFF"><input type="text" id="period_installment" name="period_installment" value="10" style="display:;width:100px;"/></td>
    <td  height="35" align="center" bgcolor="#CCCCFF"> <input type="submit" id="period_payment_btn" name="period_payment_btn" value="คำนวณ :ชำระ/งวด" style="display:;width:120px;"/></td>
	<td  bgcolor="#FFFFFF"><input type="text" id="period_payment" name="period_payment" value="<?=$_REQUEST["period_payment"]?>" style="display:;width:100px;"/></td>
  </tr>
  <tr>
    <td  height="35" align="center" bgcolor="#CCCCFF">แบบการชำระ : </td>
	<td  bgcolor="#FFFFFF">
			<select name="payment_type" id="payment_type" style="display:;width:150px;">
					<option <?php if($_REQUEST["payment_type"]=="0"){?>selected="selected"<?php } ?> value="0">ต้นเท่ากันทุกงวด+ดอก</option>
					<option <?php if($_REQUEST["payment_type"]=="1"){?>selected="selected"<?php } ?> value="1">ต้น+ดอกเท่ากันทุกงวด</option>
				</select></td>
    <td  height="35" align="center" bgcolor="#CCCCFF">วันที่เริ่มสัญญา : </td>
	<td  bgcolor="#FFFFFF"><input type="text" id="start_date" name="start_date" value="<?=$_REQUEST["start_date"]?>" style="display:;width:100px;"/></td>
    <td  height="35" align="center" bgcolor="#CCCCFF">วันที่เรียกเก็บ: </td>
	<td  bgcolor="#FFFFFF"><input type="text" id="startpay_period" name="startpay_period" value="<?=$_REQUEST["startpay_period"]?>" style="display:;width:100px;"/></td>
  </tr>
  <tr>
    <td  height="35" align="center"  colspan="6" ><input type="submit" id="gentable_btn" name="gentable_btn" value="คำนวณ : ตารางรับชำระ " style="display:;width:200px;"/> </td>
  </tr>
</table>
<br />
<?php
if(isset($_REQUEST["gentable_btn"])){
 ?>
<br/>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#999999"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td height="33" align="center" bgcolor="#CCCCFF"><strong>งวด</strong></td>
        <td align="center" bgcolor="#CCCCFF"><strong>วันที่ทำชำระ</strong></td>
        <td align="center" bgcolor="#CCCCFF"><strong>จำนวนวัน</strong></td>
        <td align="center" bgcolor="#CCCCFF"><strong>ชำระต้น</strong></td>
        <td align="center" bgcolor="#CCCCFF"><strong>ชำระ ด/บ</strong></td>
        <td align="center" bgcolor="#CCCCFF"><strong>รวมชำระ</strong></td>
        <td align="center" bgcolor="#CCCCFF"><strong>คงเหลือ</strong></td>
      </tr>
<?php

/*
			string STARTPAY_PERIOD = dsMain.DATA[0].STARTPAY_PERIOD;
            decimal PERIOD_INSTALLMENT = dsMain.DATA[0].PERIOD_INSTALLMENT;
            decimal PRINCIPAL_BALANCE = dsMain.DATA[0].PRINCIPAL_BALANCE;
            decimal PERIOD_PAYMENT = dsMain.DATA[0].PERIOD_PAYMENT;
            decimal CONTINT_RATE = dsMain.DATA[0].CONTINT_RATE;
            decimal INT_RATE = (CONTINT_RATE / 100);
            decimal prnpay_amt = 0;
            decimal intpay_amt = 0;
            int intday = 0;
            string loantype = dsMain.DATA[0].loantype_code;
            DateTime dateT = DateTime.ParseExact(STARTPAY_PERIOD, "yyyyMM", WebUtil.TH);
            dateT = new DateTime(dateT.Year, dateT.Month, DateTime.DaysInMonth(dateT.Year, dateT.Month));
            decimal an_year = dsMain.DATA[0].an_year;

            for (int i = 1; i <= PERIOD_INSTALLMENT; i++)
            {
                decimal year = 0;
                if (an_year == 0)
                {
                    if ((dateT.Year) % 4 != 0)
                    {
                        year = 365;
                    }
                    else
                    {
                        year = 366;
                    }
                }
                else
                {
                    year = an_year;
                }

                if (dsMain.DATA[0].PAYMENT_TYPE == 0)
                {
                    intday = DateTime.DaysInMonth(dateT.Year, dateT.Month);
                    intpay_amt = (PRINCIPAL_BALANCE * CONTINT_RATE / 100 * intday / year);
                    intpay_amt = Math.Ceiling(intpay_amt / 10) * 10;
                    if (PRINCIPAL_BALANCE >= PERIOD_PAYMENT)
                    {
                        prnpay_amt = PERIOD_PAYMENT;
                    }
                    else
                    {
                        prnpay_amt = PRINCIPAL_BALANCE;
                    }

                    PRINCIPAL_BALANCE = PRINCIPAL_BALANCE - prnpay_amt;
                }
                else if (dsMain.DATA[0].PAYMENT_TYPE == 1)
                {
                    intday = DateTime.DaysInMonth(dateT.Year, dateT.Month);
                    intpay_amt = (PRINCIPAL_BALANCE * INT_RATE * intday / year);
                    //intpay_amt = Math.Truncate(intpay_amt);
                    intpay_amt = Math.Ceiling(intpay_amt);

                    prnpay_amt = PERIOD_PAYMENT - intpay_amt;

                    if (prnpay_amt < 0)
                    {
                        prnpay_amt = 0;
                    }

                    if (i == PERIOD_INSTALLMENT)
                    {
                        if (PRINCIPAL_BALANCE - prnpay_amt < (intpay_amt + prnpay_amt))
                        {
                            prnpay_amt = PRINCIPAL_BALANCE;
                        }
                    }

                    PRINCIPAL_BALANCE = PRINCIPAL_BALANCE - prnpay_amt;
                }

                dsDetail.InsertLastRow();
                dsDetail.DATA[dsDetail.RowCount - 1].SEQ_NO = i;
                dsDetail.DATA[dsDetail.RowCount - 1].PERIOD = i;
                dsDetail.DATA[dsDetail.RowCount - 1].COOP_ID = state.SsCoopControl;
                dsDetail.DATA[dsDetail.RowCount - 1].RECV_DATE = dateT;
                dsDetail.DATA[dsDetail.RowCount - 1].INTPAY_DAY = intday;
                dsDetail.DATA[dsDetail.RowCount - 1].PRNPAY_AMT = prnpay_amt;
                dsDetail.DATA[dsDetail.RowCount - 1].INTPAY_AMT = intpay_amt;
                dsDetail.DATA[dsDetail.RowCount - 1].TOTAL_PERIOD = prnpay_amt + intpay_amt;
                dsDetail.DATA[dsDetail.RowCount - 1].PRNBAL_AMT = PRINCIPAL_BALANCE;
                dsDetail.DATA[dsDetail.RowCount - 1].ENTRY_ID = state.SsUsername;
                dsDetail.DATA[dsDetail.RowCount - 1].LOANTYPE = loantype;
                dsDetail.DATA[dsDetail.RowCount - 1].CONTINT_RATE = INT_RATE;
                dsDetail.DATA[dsDetail.RowCount - 1].TOTAL_PAY = PERIOD_INSTALLMENT;
                dateT = NextM(dateT);
            }
*/

			$PAYMENT_TYPE=$_REQUEST["payment_type"];
			$START_DATE = $_REQUEST["start_date"];
			$STARTPAY_PERIOD = $_REQUEST["startpay_period"];
            $PERIOD_INSTALLMENT = $_REQUEST["period_installment"];
            $PRINCIPAL_BALANCE = $_REQUEST["principal_balance"];
            $PERIOD_PAYMENT = $_REQUEST["period_payment"];
            $CONTINT_RATE = $_REQUEST["contint_rate"];
            $INT_RATE = ($CONTINT_RATE / 100);
            $prnpay_amt = 0;
            $intpay_amt = 0;
            $intday = 0;
            $loantype = $_REQUEST["loantype_code"];
			$dateY=date("Y",strtotime($STARTPAY_PERIOD));
			$dateM=date("m",strtotime($STARTPAY_PERIOD));
			$dateD=cal_days_in_month(CAL_GREGORIAN, $dateM,$dateY);
            $dateT =strtotime($dateY."-".$dateM."-".$dateD);
            $an_year =$_REQUEST["an_year"];

            for ($i = 1; $i <= $PERIOD_INSTALLMENT; $i++)
            {
                $year = 0;
                if ($an_year == 0)
                {
                    if ($dateY% 4 != 0)
                    {
                        $year = 365;
                    }
                    else
                    {
                        $year = 366;
                    }
                }
                else
                {
                    $year = $an_year;
                }

				if($i==1){
					$dateD=date("d",strtotime($STARTPAY_PERIOD))-date("d",strtotime($START_DATE));
				}
				
                if ($PAYMENT_TYPE == 0)
                {
                    $intday = $dateD;
                    $intpay_amt = ($PRINCIPAL_BALANCE * $CONTINT_RATE / 100 * $intday / $year);
                    $intpay_amt = ceil($intpay_amt / 10) * 10;
                    if ($PRINCIPAL_BALANCE >= $PERIOD_PAYMENT)
                    {
                        $prnpay_amt = $PERIOD_PAYMENT;
                    }
                    else
                    {
                        $prnpay_amt = $PRINCIPAL_BALANCE;
                    }

                    $PRINCIPAL_BALANCE = $PRINCIPAL_BALANCE - $prnpay_amt;
                }
                else if ($PAYMENT_TYPE == 1)
                {
                    $intday = $dateD;
                    $intpay_amt = ($PRINCIPAL_BALANCE * $INT_RATE * $intday / $year);
                    //intpay_amt = Math.Truncate(intpay_amt);
                    $intpay_amt = ceil($intpay_amt);

                    $prnpay_amt = $PERIOD_PAYMENT - $intpay_amt;

                    if ($prnpay_amt < 0)
                    {
                        $prnpay_amt = 0;
                    }

                    if ($i == $PERIOD_INSTALLMENT)
                    {
                        if ($PRINCIPAL_BALANCE - $prnpay_amt < ($intpay_amt + $prnpay_amt))
                        {
                            $prnpay_amt = $PRINCIPAL_BALANCE;
                        }
                    }

                    $PRINCIPAL_BALANCE = $PRINCIPAL_BALANCE - $prnpay_amt;
                }
				
				$SEQ_NO = $i;
                $PERIOD = $i;
                $RECV_DATE = $dateT;
                $INTPAY_DAY = $intday;
                $PRNPAY_AMT = $prnpay_amt;
                $INTPAY_AMT = $intpay_amt;
                $TOTAL_PERIOD = $prnpay_amt + $intpay_amt;
                $PRNBAL_AMT = $PRINCIPAL_BALANCE;
                $TOTAL_PAY = $PERIOD_INSTALLMENT;
				
				
				$dateM++;
				if($dateM>12){
					$dateM=1;
					$dateY++;
				}
				$dateD=cal_days_in_month(CAL_GREGORIAN, $dateM,$dateY);
				$dateT =strtotime($dateY."-".$dateM."-".$dateD);
			
			?>			
			  <tr>
				<td height="27" align="center" bgcolor="#FFFFFF"><?=$PERIOD?></td>
				<td align="center" bgcolor="#FFFFFF"><?=date("d/m/Y",$RECV_DATE)?></td>
				<td align="center" bgcolor="#FFFFFF"><?=$INTPAY_DAY?></td>
				<td align="right" bgcolor="#FFFFFF"><?=number_format($PRNPAY_AMT,2)?></td>
				<td align="right" bgcolor="#FFFFFF"><?=number_format($INTPAY_AMT,2)?></td>
				<td align="right" bgcolor="#FFFFFF"><?=number_format($TOTAL_PERIOD,2)?></td>
				<td align="right" bgcolor="#FFFFFF"><?=number_format($PRNBAL_AMT,2)?></td>
			  </tr>
			<?php
            }
?>	  
    </table>
	</td>
  </tr>
</table>
<br/>
<?php } ?>
</form>
