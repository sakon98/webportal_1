<?php
@header('Content-Type: text/html; charset=tis-620');

$strSQL = "select moneytype_code,moneytype_desc from cmucfmoneytype";
$value = array('MONEYTYPE_CODE','MONEYTYPE_DESC');
list($Num_Rows2,$list_info2) = get_value_many_oci($strSQL,$value);
$j=0;
for($i=0;$i<$Num_Rows2;$i++) { 
		$moneytype_code = $list_info2[$i][0];
		$moneytype_desc = $list_info2[$i][1];		
}

?>