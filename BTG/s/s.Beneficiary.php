<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php

$strSQLadd = "SELECT   
MUP.PRENAME_DESC || MG.GAIN_NAME || ' ' || MG.GAIN_SURNAME AS GAIN_NAME, 
MUG.GAIN_CONCERN , 
MG.GAIN_PERCENT
                    FROM MBGAINMASTER MG , MBUCFGAINCONCERN MUG , MBUCFPRENAME MUP
                    WHERE MG.MEMBER_NO = '$member_no' 
                    AND MG.GAIN_RELATION = MUG.CONCERN_CODE(+) 
                    AND MG.PRENAME_CODE = MUP.PRENAME_CODE(+)
                    ORDER BY  MG.SEQ_NO";
$valueadd = array('GAIN_NAME','GAIN_CONCERN','GAIN_PERCENT');
list($Num_Rowsadd,$list_infoadd) = get_value_many_oci($strSQLadd,$valueadd);
$j=0;
for($i=0;$i<$Num_Rowsadd;$i++){
	$mg_fullname[$i]  = $list_infoadd[$i][$j++];
	$mg_relation[$i]  = $list_infoadd[$i][$j++];
	$mg_percent[$i]  = $list_infoadd[$i][$j++];
	$j=0;
}


?>

