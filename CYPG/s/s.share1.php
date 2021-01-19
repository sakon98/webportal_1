<?php
@header('Content-Type: text/html; charset=tis-620');
?>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
$strSQL = "SELECT
					MIN(ACCOUNT_YEAR) AS MINYEAR,
					MAX(ACCOUNT_YEAR) AS MAXYEAR
				FROM
					CMACCOUNTYEAR
				 ";
$value = array('MINYEAR','MAXYEAR');
list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
//echo $Num_Rows;
$j=0;
for($i=0;$i<$Num_Rows;$i++){
	$minyear= $list_info[$i][$j++];
	$maxyear  = $list_info[$i][$j++];
	$j=0;
}

?>

