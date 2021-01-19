<?php
header('Content-Type: text/html; charset=tis-620');
?>

	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />

<?php

$strSQL00 = "SELECT 
		BIZZACCOUNT_NO AS BIZZACC,
		BALANCE_AMT AS BALAMT
		FROM 
		YRCONFIRMSTATEMENT
		WHERE
		 MEMBER_NO='$member_no'
		AND FROM_SYSTEM ='$syscode'
		AND BALANCE_DATE = '$cfdate'
		ORDER BY BIZZACCOUNT_NO";
										
//$value_deptacc = "DPACC";
//$myacc = get_single_value_oci($strSQL00,$value_deptacc);

$value00 = array('BIZZACC','BALAMT');
list($Num_Rows,$list_info) = get_value_many_oci($strSQL00,$value00);
	
	$j=0; 
	for($i=0;$i<$Num_Rows;$i++){
		$myacc[$i] = $list_info[$i][$j++];
		$mybal[$i]  = $list_info[$i][$j++];
		$j=0;
	}
	

?>

