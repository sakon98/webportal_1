<?php
header('Content-Type: text/html; charset=tis-620');
?>

	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />

<?php


$strSQL00 = "SELECT 
		DEPTACCOUNT_NO AS DPACC,
		PRNCBAL AS PRNCBAL
		FROM 
		DPDEPTMASTER
		WHERE
		DEPTCLOSE_STATUS = '0'
		AND MEMBER_NO='$member_no'
		ORDER BY DEPTACCOUNT_NO";
										
//$value_deptacc = "DPACC";
//$myacc = get_single_value_oci($strSQL00,$value_deptacc);

$value00 = array('DPACC','PRNCBAL');	
list($Num_Rows,$list_info) = get_value_many_oci($strSQL00,$value00);
	
	$j=0; 
	for($i=0;$i<$Num_Rows;$i++){
		$myacc[$i] = $list_info[$i][$j++];
		$mybal[$i]  = $list_info[$i][$j++];
		$j=0;
	}
	

?>

