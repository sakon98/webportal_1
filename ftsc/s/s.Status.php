<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
//echo $member_no;
$strMySQL = "SELECT COUNT(DISTINCT member_no) AS sum_member  FROM mbmembmaster";
$valueSQL = "sum_member";
$sum_member = get_single_value_sql($strMySQL,$valueSQL);

if($confirm2use == 1){	
	$strMySQL = "SELECT COUNT( DISTINCT member_no ) AS sum_approve FROM mbmembmaster
							WHERE confirm_date IS NOT NULL AND who_approve IS NOT NULL";
	$valueSQL = "sum_approve";
	$sum_approve = get_single_value_sql($strMySQL,$valueSQL);
 }
 
 
?>
