<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
if($_POST["agree"] == "agree" ){
	$member_no = GetFormatMember($_POST["member_no"]); 
	$idchk = $_POST["idchk"];
	$countmemb = get_single_value_sql("select count(member_no) as countmemb from mbmembmaster where member_no ='$member_no' ","countmemb");
	$countidcard = get_single_value_sql("select count(idcard) as countidcard from mbmembmaster where idcard ='$idchk' ","countidcard");
}

$ten = '10';
$strSQL = "SELECT TO_CHAR(MB.MEMBER_DATE,'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA'' NLS_DATE_LANGUAGE=THAI') AS MEMBER_DATE,
           MB.SALARY_AMOUNT AS SALARY_AMOUNT,
           SH.SHARESTK_AMT AS SHARESTK_AMT,
           SH.LAST_PERIOD AS LAST_PERIOD,
		   MB.INCOMEETC_AMT AS INCOMEETC_AMT,
		   (select sum(principal_balance) as principal_balance from lncontmaster where contract_status = 1 and loantype_code in ('19','1B','23','28','30') and member_no = '$member_no') as PB
           FROM MBMEMBMASTER MB, SHSHAREMASTER SH
           WHERE SH.MEMBER_NO = '$member_no'
           AND MB.MEMBER_NO = SH.MEMBER_NO ";
$value = array('MEMBER_DATE','SALARY_AMOUNT','SHARESTK_AMT','LAST_PERIOD','INCOMEETC_AMT','PB');
list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
//echo $Num_Rows;
$j=0;
for($i=0;$i<$Num_Rows;$i++){
	
	$member_date = $list_info[$i][$j++];
	$salary_amount = $list_info[$i][$j++];
        $salary_amount_full = number_format($salary_amount, 2);
	$sharestk_amt = $list_info[$i][$j++];
        $sharestk_amt = $sharestk_amt * $ten;
        $sharestk_amt_full = number_format($sharestk_amt, 2);
	$last_period = $list_info[$i][$j++];
	$incomeetc_amt=$list_info[$i][$j++];
	$pb=$list_info[$i][$j++];
	$j=0;
}

$strSQL1 = "SELECT LOANCONTRACT_NO,LOANAPPROVE_AMT,PRINCIPAL_BALANCE,PERIOD_PAYAMT,LOANTYPE_CODE FROM LNCONTMASTER WHERE MEMBER_NO = '$member_no' AND PRINCIPAL_BALANCE > '0'";
$value1 = array('LOANCONTRACT_NO','LOANAPPROVE_AMT','PRINCIPAL_BALANCE','PERIOD_PAYAMT','LOANTYPE_CODE');
list($Num_Rows1,$list_info1) = get_value_many_oci($strSQL1,$value1);
//echo $Num_Rows;
$j=0;
for($i=0;$i<$Num_Rows1;$i++){
	
	$loancontract_no[$i] = $list_info1[$i][$j++];
	$loanapprove_amt[$i] = $list_info1[$i][$j++];
        $loanapprove_amt_full[$i] = number_format($loanapprove_amt[$i], 2);
	$principal_balance[$i] = $list_info1[$i][$j++];
        //$sharestk_amt = $sharestk_amt . $zero;
        $principal_balance_full[$i] = number_format($principal_balance[$i], 2);
	$period_payamt[$i] = $list_info1[$i][$j++];
	$loantype_code[$i] = $list_info1[$i][$j++];
	
//	echo $loantype_code[1];
	
	if($loantype_code[0] == "22") {
	
	 $check = "1";
	}else if ($loantype_code[1] == "22"){
	
	 $check = "1";
	}else if ($loantype_code[2] == "22"){
	
	 $check = "1";
	}
	else if ($loantype_code[3] == "22"){
	
	 $check = "1";
	}else if ($loantype_code[4] == "22"){
	
	 $check = "1";
	}else if ($loantype_code[5] == "22"){
	
	 $check = "1";
	}else if ($loantype_code[6] == "22"){
	
	 $check = "1";
	}else if ($loantype_code[7] == "22"){
	
	 $check = "1";
	}else if ($loantype_code[8] == "22"){
	
	 $check = "1";
	}else if ($loantype_code[9] == "22"){
	
	 $check = "1";
	 
	}else{
	
	$check = "2";
	
	}
	
	$j=0;
}

$strSQL2 = "SELECT LNP.PERCENTSHARE AS PERCENTSHARE,LNP.PERCENTSALARY AS PERCENTSALARY,LNP.MAXLOAN_AMT AS MAXLOAN_AMT,LNP.STARTMEMBER_TIME AS STARTMEMBER_TIME,LNP.ENDMEMBER_TIME AS ENDMEMBER_TIME,FLOOR(MONTHS_BETWEEN(SYSDATE,MM.MEMBER_DATE )) AS MAX_MONTH FROM LNLOANTYPECUSTOM LNP, MBMEMBMASTER MM WHERE LNP.LOANTYPE_CODE = '21' AND MM.MEMBER_NO = '$member_no' ";
$value2 = array('PERCENTSHARE','PERCENTSALARY','MAXLOAN_AMT','STARTMEMBER_TIME','ENDMEMBER_TIME','MAX_MONTH');
list($Num_Rows2,$list_info2) = get_value_many_oci($strSQL2,$value2);
//echo $Num_Rows;
$j=0;
for($i=0;$i<$Num_Rows2;$i++){
	
	$percentshare = $list_info2[$i][$j++];
	$percentsalary = $list_info2[$i][$j++];
	$maxloan_amt = $list_info2[$i][$j++];
        $maxloan_amt_full = number_format($maxloan_amt, 2);
	$startmember_time = $list_info2[$i][$j++];
        $endmember_time = $list_info2[$i][$j++];
        $max_month = $list_info2[$i][$j++];
	$j=0;
}

?>

