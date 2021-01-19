<?php
@header('Content-Type: text/html; charset=tis-620');
?>

	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />

<?php


$strSQLcf = "SELECT 
		MAX(BALANCE_DATE)  AS  BALDATE
		FROM 
		YRCONFIRMMASTER
		WHERE
		 MEMBER_NO='$member_no' ";
										
$value_cf = "BALDATE";
$cfdate = get_single_value_oci($strSQLcf,$value_cf);



?>

