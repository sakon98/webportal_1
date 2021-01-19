<?php
@header('Content-Type: text/html; charset=tis-620');
?>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
$strSQL = "SELECT
					MIN(ACCOUNT_YEAR) AS MINYEAR,
                    MAX(ACCOUNT_YEAR) AS MAXYEAR
				FROM
					CMACCOUNTYEAR";
//$value = array('MINYEAR','MAXYEAR');
//list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
//echo $Num_Rows;

$resultData = sqlsrv_query($objConnect,$strSQL);

$j=0;

while($list_info = sqlsrv_fetch_array($resultData)){

$minyear = $list_info['MINYEAR'];
$maxyear = $list_info['MAXYEAR'];

}

/*for($i=0;$i<$Num_Rows;$i++){
	$minyear= $list_info[$i][$j++];
	$maxyear  = $list_info[$i][$j++];
	$j=0;
}*/

?>

