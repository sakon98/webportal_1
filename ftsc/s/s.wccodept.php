<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php

$strSQL = "SELECT 
					W.NAME AS CODEPT_NAME,
					W.CODEPT_ADDRE AS CODEPT_ADDRE,
					W.CODEPT_TEL AS CODEPT_TEL,
					GAIN.GAIN_CONCERN AS CODEPT_RELATION,
					W.CODEPT_ID AS CODEPT_ID
				FROM  wccodeposit  W 
				LEFT JOIN WCUCFGAINCONCERN GAIN ON (GAIN.CONCERN_CODE = W.CODEPT_RELATION)
				WHERE 
					 W.DEPTACCOUNT_NO = '$member_no' ORDER BY W.SEQ_NO";
					
$value = array('CODEPT_NAME','CODEPT_ADDRE','CODEPT_TEL','CODEPT_RELATION','CODEPT_ID');
list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
if($Num_Rows == 0){
	echo '<script type="text/javascript"> window.alert("ไม่พบผู้รับเงินสงเคราะห์์") </script> ';
	if($connectby != "desktop")
	 echo "<script>window.location = 'index.php'</script>";	
	exit;
}
$j=0;
for($i=0;$i<$Num_Rows;$i++){
	$codept_name[$i] = $list_info[$i][$j++];
	$codept_addr[$i] = $list_info[$i][$j++];
	$codept_tel[$i] = $list_info[$i][$j++];
	$codept_relation[$i] = $list_info[$i][$j++];
	$codept_id[$i] = $list_info[$i][$j++];
	$j=0;
}

?>

