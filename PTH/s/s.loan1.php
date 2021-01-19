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

$strSQL = "SELECT LNM.LOANTYPE_CODE AS LOANTYPE_CODE,
					LNM.LOANCONTRACT_NO AS LOANCONTRACT_NO,
					LNM.LOANAPPROVE_AMT AS LOANAPPROVE_AMT,
					TO_CHAR(LNM.STARTCONT_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA')AS STARTCONT_DATE,
					LNM.PERIOD_PAYMENT AS PERIOD_PAYMENT,
                       LNM.LAST_PERIODPAY || '/' || LNM.PERIOD_PAYAMT  AS LAST_PERIODPAY,
                       TO_CHAR(LNM.LASTPAYMENT_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA')AS LASTPAYMENT_DATE,
					LNM.PRINCIPAL_BALANCE AS PRINCIPAL_BALANCE
				FROM 
					LNCONTMASTER LNM , LNLOANTYPE LT
				WHERE 
					LNM.LOANTYPE_CODE = LT.LOANTYPE_CODE 
					AND LNM.MEMBER_NO = '$member_no'
					AND LT.LOANGROUP_CODE = '$loan_code[$i]'
					AND LNM.CONTRACT_STATUS = '1'
					AND LNM.STARTCONT_DATE IS NOT NULL " ;
$value=array('LOANTYPE_CODE','LOANCONTRACT_NO','LOANAPPROVE_AMT','STARTCONT_DATE','PERIOD_PAYMENT','LAST_PERIODPAY','LASTPAYMENT_DATE','PRINCIPAL_BALANCE');
list($Num_Rows1,$list_info1) = get_value_many_oci($strSQL,$value);
		$m=0;
		for($n=0;$n<$Num_Rows1;$n++){
			$loantype_code[$n] = $list_info1[$n][$m++];
			$loancontract_no[$n] = $list_info1[$n][$m++];	
			$loanapprove_amt[$n] = $list_info1[$n][$m++];						 
			$startcont_date[$n] = $list_info1[$n][$m++];	
			$period_payment[$n] = $list_info1[$n][$m++];	
			$last_periodpay[$n] = $list_info1[$n][$m++];	
			$lastpayment_date[$n] = $list_info1[$n][$m++];	
			$principal_balance[$n] = $list_info1[$n][$m++];	
			$m=0;
		}
		
		$strSQL1 = "SELECT 
					SUM(LNM.PRINCIPAL_BALANCE) AS PRINCIPAL_BALANCE_SUM

				FROM 
					LNCONTMASTER LNM , LNLOANTYPE LT
				WHERE 
					LNM.LOANTYPE_CODE = LT.LOANTYPE_CODE 
					AND LNM.MEMBER_NO = '$member_no'
					AND LNM.CONTRACT_STATUS = '1'
					AND LNM.STARTCONT_DATE IS NOT NULL " ;
$value1=array('PRINCIPAL_BALANCE_SUM');
list($Num_Rows2,$list_info2) = get_value_many_oci($strSQL1,$value1);
		$a=0;
		for($b=0;$b<$Num_Rows2;$b++){
			$principal_balance_sum[$b] = $list_info2[$b][$a++];
			
			$a=0;
		}

?>