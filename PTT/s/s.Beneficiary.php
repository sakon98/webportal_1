<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php

$strSQLadd = "SELECT 
							MP.PRENAME_DESC || MG.GAIN_NAME || ' ' || MG.GAIN_SURNAME AS A1,
							MG.GAIN_ADDR AS A2,
							CC.GAIN_CONCERN AS A3,
							MG.GAIN_PERCENT AS A4
						FROM 
							MBGAINMASTER MG, MBUCFGAINCONCERN CC , MBUCFPRENAME MP
						WHERE 
							MG.GAIN_RELATION = CC.CONCERN_CODE(+) AND
							MG.MEMBER_NO = '$member_no' AND GAIN_NAME IS NOT NULL 
						    AND MP.PRENAME_CODE(+) = MG.PRENAME_CODE
							AND MG.GAIN_STATUS = '1'
							ORDER BY MG.SEQ_NO";
$valueadd = array('A1','A2','A3','A4');
list($Num_Rowsadd,$list_infoadd) = get_value_many_oci($strSQLadd,$valueadd);
$j=0;
for($i=0;$i<$Num_Rowsadd;$i++){
	$mg_fullname[$i]  = $list_infoadd[$i][$j++];
	$mg_address[$i]  = $list_infoadd[$i][$j++];
	$mg_relation[$i]  = $list_infoadd[$i][$j++];
	$mg_remark[$i]  = $list_infoadd[$i][$j++];
	$j=0;
}


$strSQLRemark = "SELECT MQ.REMARK FROM MBREQGAIN MQ WHERE MQ.MEMBER_NO = '$member_no'";
$valueremark = array('REMARK');
list($Num_Rowsremark,$list_inforemark) = get_value_many_oci($strSQLRemark,$valueremark);
$k=0;
for($r=0;$r<$Num_Rowsremark;$r++){
 	$remark[$r]  = $list_inforemark[$r][$k++];
	$k=0;
}


?>

