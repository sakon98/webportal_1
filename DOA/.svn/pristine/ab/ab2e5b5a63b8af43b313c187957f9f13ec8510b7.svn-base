<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php

$strSQLadd = "SELECT 
							MG.GAIN_NAME || ' ' || MG.GAIN_SURNAME AS A1,
							MG.GAIN_ADDR AS A2,
							CC.GAIN_CONCERN AS A3,
							MG.REMARK AS A4
						FROM 
							MBGAINMASTER MG, MBUCFGAINCONCERN CC
						WHERE 
							MG.GAIN_RELATION = CC.CONCERN_CODE(+) AND
							MG.MEMBER_NO = '$member_no'
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


?>

