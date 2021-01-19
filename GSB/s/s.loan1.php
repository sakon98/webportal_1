<?php
header('Content-Type: text/html; charset=tis-620');


?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php
//$showslip = '255703';
$showslip = Show_Slip(date('d-m-Y'));

$strSQL = "SELECT 
					LT.LOANTYPE_DESC AS LOANTYPE_DESC,
					LNM.LOANCONTRACT_NO AS LOANCONTRACT_NO,
					LNM.LOANAPPROVE_AMT AS LOANAPPROVE_AMT,
					TO_CHAR(LNM.STARTCONT_DATE, 'DD/MM/YY','NLS_CALENDAR=''THAI BUDDHA')AS STARTCONT_DATE,
					LNM.PERIOD_PAYAMT AS PERIOD_PAYAMT,
					(SELECT SUM(PRINCIPAL_PAYMENT) FROM KPTEMPRECEIVEDET WHERE LOANCONTRACT_NO=LNM.LOANCONTRACT_NO AND RECV_PERIOD='$showslip') AS PRINCIPAL_PAYMENT, 
					(SELECT SUM(INTEREST_PAYMENT) FROM KPTEMPRECEIVEDET WHERE LOANCONTRACT_NO=LNM.LOANCONTRACT_NO AND RECV_PERIOD='$showslip') AS INTEREST_PAYMENT,
					((SELECT SUM(PRINCIPAL_PAYMENT) FROM KPTEMPRECEIVEDET WHERE LOANCONTRACT_NO=LNM.LOANCONTRACT_NO AND RECV_PERIOD='$showslip')+
					(SELECT SUM(INTEREST_PAYMENT) FROM KPTEMPRECEIVEDET WHERE LOANCONTRACT_NO=LNM.LOANCONTRACT_NO AND RECV_PERIOD='$showslip')) AS TOTALPAY,
					LNM.PRINCIPAL_BALANCE AS PRINCIPAL_BALANCE,
					(((LNM.LOANAPPROVE_AMT-LNM.PRINCIPAL_BALANCE)*100)/LNM.LOANAPPROVE_AMT) AS PAY_PERSENT
				FROM 
					LNCONTMASTER LNM , LNLOANTYPE LT
				WHERE 
					LNM.LOANTYPE_CODE = LT.LOANTYPE_CODE 
					AND LNM.MEMBER_NO = '$member_no'
					AND LT.LOANGROUP_CODE = '$loan_code[$i]'
					AND LNM.CONTRACT_STATUS = '1'
					AND LNM.STARTCONT_DATE IS NOT NULL " ;
$value=array('LOANTYPE_DESC','LOANCONTRACT_NO','LOANAPPROVE_AMT','STARTCONT_DATE','PERIOD_PAYAMT','PRINCIPAL_PAYMENT','INTEREST_PAYMENT','TOTALPAY','PRINCIPAL_BALANCE','PAY_PERSENT');
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
			$m=0;
		}

?>