<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />


<?php 
$month = $_POST["month"]; 
$year = $_POST["year"];
$year_th = $year + 543;

if($month == "01" || $month == "03" || $month == "05" || $month == "07" || $month == "08" || $month == "10" || $month == "12"){
    
    $day = "31";
    
}else if ($month == "04" || $month == "06" || $month == "09" || $month == "11"){
    
    $day = "30";
    
}else if ($month == "02"){
    
    $day = "28";
    
}

 $date_th = $day."/".$month."/".$year;



?>


<?php

	      $strSQL = "SELECT MB.MEMBER_NO AS MEMBER_NO,
                            MUP.PRENAME_DESC || MB.MEMB_NAME || ' ' || MB.MEMB_SURNAME AS FULL_NAME,
                            MB.MEMBGROUP_CODE AS MEMBGROUP_CODE,
                            MUG.MEMBGROUP_DESC AS MEMBGROUP_DESC,
                            MB.MEMBER_DATE AS MEMBER_DATE,
                            (CASE WHEN MB.MEMBER_STATUS = '1' AND MB.RESIGN_STATUS <> '1' THEN 'ปกติ' WHEN MB.MEMBER_STATUS = '0' AND MB.RESIGN_STATUS = '1' THEN 'สมาชิกลาออก' ELSE '' END) 
                            AS MEMBER_STATUS,
                            SH.PERIODSHARE_AMT * SHU.UNITSHARE_VALUE AS PERIODSHARE_AMT,
                            SHT.SHARESTK_AMT AS SHARESTK_AMT,
                            SHT.SHARESTK_AMT * SHU.UNITSHARE_VALUE AS SHARESTK_AMT_TH
                            FROM MBMEMBMASTER MB , 
                            MBUCFPRENAME MUP , 
                            MBUCFMEMBGROUP MUG , 
                            SHSHAREMASTER SH , 
                            SHSHARETYPE SHU,
			    SHSHARESTATEMENT SHT
                            WHERE MB.MEMBER_NO = '$member_no' AND
                            MB.MEMBGROUP_CODE = MUG.MEMBGROUP_CODE AND
                            MB.PRENAME_CODE = MUP.PRENAME_CODE AND
                            MB.MEMBER_NO = SH.MEMBER_NO AND
                            SH.SHARETYPE_CODE = SHU.SHARETYPE_CODE AND
                            SH.MEMBER_NO = SHT.MEMBER_NO AND
                            SHT.SEQ_NO = ( SELECT MAX(SHTM.SEQ_NO) from SHSHARESTATEMENT SHTM WHERE SHTM.MEMBER_NO = SHT.MEMBER_NO and SHTM.OPERATE_DATE <= TO_DATE('$date_th','dd/mm/yyyy')) AND
                            MB.MEMBER_STATUS = '1' AND
                            MB.RESIGN_STATUS <> '1' ";

$value = array('MEMBER_NO','FULL_NAME','MEMBGROUP_CODE','MEMBGROUP_DESC','MEMBER_DATE','MEMBER_STATUS','PERIODSHARE_AMT','SHARESTK_AMT','SHARESTK_AMT_TH');
list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
//echo $Num_Rows;
$j=0;
for($i=0;$i<$Num_Rows;$i++){

	$member_no = $list_info[$i][$j++];
	$full_name = $list_info[$i][$j++];
	$membgroup_code = $list_info[$i][$j++];
	$membgroup_desc = $list_info[$i][$j++];
	$member_date = $list_info[$i][$j++];
	$member_status = $list_info[$i][$j++];
	$periodshare_amt = $list_info[$i][$j++];
        $periodshare_amt = number_format($periodshare_amt, 2);
	$sharestk_amt = $list_info[$i][$j++];
        $sharestk_amt = number_format($sharestk_amt);
	$sharestk_amt_th = $list_info[$i][$j++];
        $sharestk_amt_th = number_format($sharestk_amt_th, 2);
	$j=0;
}


     $strSQL1 = "SELECT LN.LOANTYPE_DESC AS LOANTYPE_DESC, 
                LM.LOANCONTRACT_NO AS LOANCONTRACT_NO,
                LM.STARTCONT_DATE AS STARTCONT_DATE, 
                LM.LOANAPPROVE_AMT AS LOANAPPROVE_AMT, 
                LS.PRINCIPAL_BALANCE AS PRINCIPAL_BALANCE
                FROM LNCONTMASTER LM, LNCONTSTATEMENT LS, LNLOANTYPE LN
                WHERE LM.LOANCONTRACT_NO = LS.LOANCONTRACT_NO
                AND LM.LOANTYPE_CODE = LN.LOANTYPE_CODE
                AND LM.MEMBER_NO = '$member_no'
                AND LS.PRINCIPAL_BALANCE > 0
                AND LS.SEQ_NO = ( SELECT MAX(LSM.SEQ_NO) FROM LNCONTSTATEMENT LSM
                WHERE LM.LOANCONTRACT_NO = LSM.LOANCONTRACT_NO AND LSM.OPERATE_DATE <= TO_DATE('$date_th','dd/mm/yyyy') )
                ORDER BY LM.LOANCONTRACT_NO

             ";

$value1 = array('LOANTYPE_DESC','LOANCONTRACT_NO','STARTCONT_DATE','LOANAPPROVE_AMT','PRINCIPAL_BALANCE');
list($Num_Rows1,$list_info1) = get_value_many_oci($strSQL1,$value1);
//echo $Num_Rows;
$a=0;
for($b=0;$b<$Num_Rows1;$b++){

	$loantype[$b] = $list_info1[$b][$a++];
	$loancontract_no[$b] = $list_info1[$b][$a++];
	$statcont_date[$b] = $list_info1[$b][$a++];
	$loanapprove_amt[$b] = $list_info1[$b][$a++];
        $loanapprove_amt[$b] = number_format($loanapprove_amt[$b], 2);
	$principal_balance[$b] = $list_info1[$b][$a++];
        $principal_balance[$b] = number_format($principal_balance[$b], 2);
	$a=0;
}

     $strSQL2 = "SELECT DT.DEPTTYPE_DESC AS DEPTTYPE_DESC,
            DP.DEPTACCOUNT_NO AS DEPTACCOUNT_NO,
            ST.PRNCBAL AS PRNCBAL
            FROM DPDEPTMASTER DP, DPDEPTSTATEMENT ST , DPDEPTTYPE DT
            WHERE DP.DEPTACCOUNT_NO =  ST.DEPTACCOUNT_NO
            AND DP.DEPTTYPE_CODE = DT.DEPTTYPE_CODE
            AND DP.MEMBER_NO = '$member_no'
            AND DP.DEPTCLOSE_STATUS <> 1
            AND DP.PRNCBAL > 0
            AND ST.SEQ_NO = ( SELECT MAX(STM.SEQ_NO) FROM DPDEPTSTATEMENT STM
            WHERE DP.DEPTACCOUNT_NO = STM.DEPTACCOUNT_NO AND STM.OPERATE_DATE <= TO_DATE('$date_th','dd/mm/yyyy') )
            ORDER BY DP.DEPTACCOUNT_NO";

$value2 = array('DEPTTYPE_DESC','DEPTACCOUNT_NO','PRNCBAL');
list($Num_Rows2,$list_info2) = get_value_many_oci($strSQL2,$value2);
//echo $Num_Rows;
$c=0;
for($d=0;$d<$Num_Rows2;$d++){

	$depttype_desc[$d] = $list_info2[$d][$c++];
	$deptaccount_no[$d] = $list_info2[$d][$c++];
	$prncbal[$d] = $list_info2[$d][$c++];
        $prncbal[$d] = number_format($prncbal[$d], 2);
	$c=0;
}

?>

