<?php
@header('Content-Type: text/html; charset=tis-620');

$strSQL = "select bank_code,bank_desc from cmucfbank";
$value = array('BANK_CODE','BANK_DESC');
list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
$j=0;
for($i=0;$i<$Num_Rows;$i++) { 
		$bank_code = $list_info[$i][0];
		$bank_desc = $list_info[$i][1];		
}
?>