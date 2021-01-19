<?php
@header('Content-Type: text/html; charset=tis-620');
?>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
/*$strSQL = "SELECT
					MIN(TO_CHAR(OPERATE_DATE, 'YYYY', 'NLS_CALENDAR=''THAI BUDDHA''NLS_DATE_LANGUAGE=THAI')) AS MINYEAR,
					MAX(TO_CHAR(OPERATE_DATE, 'YYYY', 'NLS_CALENDAR=''THAI BUDDHA''NLS_DATE_LANGUAGE=THAI')) AS MAXYEAR
				FROM
					SHSHARESTATEMENT
				WHERE 
					MEMBER_NO='$member_no' ";*/
					
					$strSQL = "SELECT TO_CHAR(TO_NUMBER(MAX(ACCOUNT_YEAR)) + 543) AS MAXYEAR , TO_CHAR(TO_NUMBER(MAX(ACCOUNT_YEAR)) - 4 + 543) AS MINYEAR FROM ACCACCOUNTYEAR ";
					
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