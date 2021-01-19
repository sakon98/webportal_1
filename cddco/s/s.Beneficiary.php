<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php

$strSQLadd = "SELECT  MD.GAIN_NAME , MUG.GAIN_CONCERN
                    FROM MBGAINMASTER MG, MBGAINDETAIL MD , MBUCFGAINCONCERN MUG
                    WHERE MG.MEMBER_NO = '$member_no'
                    AND MG.MEMBER_NO = MD.MEMBER_NO(+) 
                    AND MD.CONCERN_CODE = MUG.CONCERN_CODE(+)
                    ORDER BY MD.SEQ_NO";
$valueadd = array('GAIN_NAME','GAIN_CONCERN');
list($Num_Rowsadd,$list_infoadd) = get_value_many_oci($strSQLadd,$valueadd);
$j=0;
for($i=0;$i<$Num_Rowsadd;$i++){
	$mg_fullname[$i]  = $list_infoadd[$i][$j++];
	$mg_relation[$i]  = $list_infoadd[$i][$j++];
	$j=0;
}


?>

