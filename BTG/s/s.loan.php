<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php

$strSQL = "SELECT 
					LT.LOANGROUP_CODE AS LOAN_CODE,
					CASE
						WHEN LT.LOANGROUP_CODE = '01' THEN 'เงินกู้ฉุกเฉิน'
						WHEN LT.LOANGROUP_CODE = '02' THEN 'เงินกู้สามัญ'
						WHEN LT.LOANGROUP_CODE = '03' THEN 'เงินกู้พิเศษ'
					END AS LOAN_DESC,
					COUNT(LNM.LOANCONTRACT_NO) AS COUNT_LOAN
				FROM 
					LNCONTMASTER LNM , LNLOANTYPE LT
				WHERE 
					LNM.LOANTYPE_CODE = LT.LOANTYPE_CODE 
					AND LNM.MEMBER_NO = '$member_no'
					AND LNM.CONTRACT_STATUS = '1'
					AND LNM.STARTCONT_DATE IS NOT NULL
					GROUP BY LT.LOANGROUP_CODE
					ORDER BY LT.LOANGROUP_CODE ";
					
$value = array('LOAN_CODE','LOAN_DESC','COUNT_LOAN');
list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
if($Num_Rows == 0){
	echo '<script type="text/javascript"> window.alert("ไม่พบบัญชีเงินกู้ของท่าน") </script> ';
	if($connectby != "desktop")
	 echo "<script>window.location = 'index.php'</script>";	
	exit;
}
$j=0;
for($i=0;$i<$Num_Rows;$i++){
	$loan_code[$i] = $list_info[$i][$j++];
	$loan_desc[$i] = $list_info[$i][$j++];
	$count_loan[$i] = $list_info[$i][$j++];
	$j=0;
}

?>

