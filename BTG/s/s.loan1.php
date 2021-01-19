<?php
@header('Content-Type: text/html; charset=tis-620');


?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php
//$showslip = '255703';
$showslip = Show_Slip(date('d-m-Y'));

  $strSQL = "SELECT LT.LOANTYPE_DESC AS LOANTYPE_DESC, 
                        LNM.LOANCONTRACT_NO AS LOANCONTRACT_NO, 
                        LNM.LOANAPPROVE_AMT AS LOANAPPROVE_AMT, 
                        TO_CHAR(LNM.STARTCONT_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA')AS STARTCONT_DATE, 
                        LNM.LAST_PERIODPAY || '/' || LNM.PERIOD_PAYAMT AS PERIOD_PAYAMT, 
                        (SELECT SUM(PRINCIPAL_PAYMENT) FROM KPTEMPRECEIVEDET WHERE LOANCONTRACT_NO=LNM.LOANCONTRACT_NO AND RECV_PERIOD='$showslip') AS PRINCIPAL_PAYMENT, 
                        (SELECT SUM(INTEREST_PAYMENT) FROM KPTEMPRECEIVEDET WHERE LOANCONTRACT_NO=LNM.LOANCONTRACT_NO AND RECV_PERIOD='$showslip') AS INTEREST_PAYMENT, 
                        ((SELECT SUM(PRINCIPAL_PAYMENT) FROM KPTEMPRECEIVEDET WHERE LOANCONTRACT_NO=LNM.LOANCONTRACT_NO AND RECV_PERIOD='$showslip')+ (SELECT SUM(INTEREST_PAYMENT) FROM KPTEMPRECEIVEDET WHERE LOANCONTRACT_NO=LNM.LOANCONTRACT_NO AND RECV_PERIOD='$showslip')) AS TOTALPAY, 
                        LNM.PRINCIPAL_BALANCE AS PRINCIPAL_BALANCE, 
                        (((LNM.LOANAPPROVE_AMT-LNM.PRINCIPAL_BALANCE)*100)/LNM.LOANAPPROVE_AMT) AS PAY_PERSENT, 
                        LNM.PERIOD_LASTPAYMENT, 
                        LNM.PERIOD_PAYMENT, 
                        TO_CHAR(LNM.LASTPAYMENT_DATE,'dd') AS LASTPAYMENT_DATE_DAY, 
                        (case when TO_CHAR(LNM.LASTPAYMENT_DATE,'mm') = '01' then 'มกราคม' 
                        when TO_CHAR(LNM.LASTPAYMENT_DATE,'mm') = '02' then 'กุมภาพันธ์' 
                        when TO_CHAR(LNM.LASTPAYMENT_DATE,'mm') = '03' then 'มีนาคม' 
                        when TO_CHAR(LNM.LASTPAYMENT_DATE,'mm') = '04' then 'เมษายน' 
                        when TO_CHAR(LNM.LASTPAYMENT_DATE,'mm') = '05' then 'พฤษภาคม'
                        when TO_CHAR(LNM.LASTPAYMENT_DATE,'mm') = '06' then 'มิถุนายน' 
                        when TO_CHAR(LNM.LASTPAYMENT_DATE,'mm') = '07' then 'กรกฎาคม' 
                        when TO_CHAR(LNM.LASTPAYMENT_DATE,'mm') = '08' then 'สิงหาคม' 
                        when TO_CHAR(LNM.LASTPAYMENT_DATE,'mm') = '09' then 'กันยายน' 
                        when TO_CHAR(LNM.LASTPAYMENT_DATE,'mm') = '10' then 'ตุลาคม' 
                        when TO_CHAR(LNM.LASTPAYMENT_DATE,'mm') = '11' then 'พฤศจิกายน' 
                        when TO_CHAR(LNM.LASTPAYMENT_DATE,'mm') = '12' then 'ธันวาคม' else '' end) AS LASTPAYMENT_DATE_MONTH,
                         TO_CHAR(TO_NUMBER(TO_CHAR(LNM.LASTPAYMENT_DATE,'yyyy')) + 543) AS LASTPAYMENT_DATE_YEAR,LNM.INTEREST_ACCUM,
						 TO_CHAR(LNM.LASTPAYMENT_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA')AS LASTPAYMENT_DATE
                        FROM LNCONTMASTER LNM ,
                         LNLOANTYPE LT 
                        WHERE LNM.LOANTYPE_CODE = LT.LOANTYPE_CODE AND 
                        LNM.MEMBER_NO = '$member_no' AND 
                        LT.LOANGROUP_CODE = '$loan_code[$i]' AND 
                        LNM.CONTRACT_STATUS = '1' AND 
                        LNM.STARTCONT_DATE IS NOT NULL ORDER BY LNM.STARTCONT_DATE,LT.LOANTYPE_DESC,LNM.LOANCONTRACT_NO " ;
$value=array('LOANTYPE_DESC','LOANCONTRACT_NO','LOANAPPROVE_AMT','STARTCONT_DATE','PERIOD_PAYAMT','PRINCIPAL_PAYMENT','INTEREST_PAYMENT','TOTALPAY','PRINCIPAL_BALANCE','PAY_PERSENT','PERIOD_LASTPAYMENT','PERIOD_PAYMENT','LASTPAYMENT_DATE_DAY','LASTPAYMENT_DATE_MONTH','LASTPAYMENT_DATE_YEAR','INTEREST_ACCUM','LASTPAYMENT_DATE');
list($Num_Rows1,$list_info1) = get_value_many_oci($strSQL,$value);
		$m=0;
		for($n=0;$n<$Num_Rows1;$n++){
			$loantype_desc[$n] = $list_info1[$n][$m++];
			$loancontract_no[$n] = $list_info1[$n][$m++];	
			$loanapprove_amt[$n] = $list_info1[$n][$m++];						 
			$startcont_date[$n] = $list_info1[$n][$m++];	
			$period_payamt[$n] = $list_info1[$n][$m++];	
			$principal_payment[$n] = $list_info1[$n][$m++];	
			$interest_payment[$n] = $list_info1[$n][$m++];	
			$totalpay[$n]  = $list_info1[$n][$m++];
			$principal_balance[$n] = $list_info1[$n][$m++];	
			$pay_persent[$n] = $list_info1[$n][$m++];
			$period_lastpayment[$n] = $list_info1[$n][$m++];
                        $period_payment[$n] = $list_info1[$n][$m++];
                        $lastpayment_date_day[$n] = $list_info1[$n][$m++];
                        $lastpayment_date_month[$n] = $list_info1[$n][$m++];
                        $lastpayment_date_year[$n] = $list_info1[$n][$m++];
                        $interest_accum[$n] = $list_info1[$n][$m++];
						$lastpayment_date[$n] = $list_info1[$n][$m++];
                        $show_date_teb = $lastpayment_date_day[$n]." ".$lastpayment_date_month[$n]." ".$lastpayment_date_year[$n];
                        
			$m=0;
		}

?>