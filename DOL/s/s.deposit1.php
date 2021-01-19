<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php

$strSQL = "SELECT
					DM.DEPTACCOUNT_NO AS DEPTACCOUNT_NO,
					DM.DEPTACCOUNT_NAME AS DEPTACCOUNT_NAME,
					DM.PRNCBAL AS PRNCBAL,
					(SELECT TO_CHAR(MAX(OPERATE_DATE), 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') FROM DPDEPTSTATEMENT WHERE DEPTACCOUNT_NO=DM.DEPTACCOUNT_NO) AS OPERATE_DATE
				FROM 
					DPDEPTMASTER DM 
			WHERE 
					DM.MEMBER_NO = '$member_no'
					AND DM.DEPTCLOSE_STATUS!= '1'
          			AND DM.DEPTTYPE_CODE = '$dep_code[$i]'
					ORDER BY DM.DEPTACCOUNT_NO ASC" ;
$value = array('DEPTACCOUNT_NO','DEPTACCOUNT_NAME','PRNCBAL','OPERATE_DATE');
list($Num_Rows1,$list_info1) = get_value_many_oci($strSQL,$value);
		$m=0;
		for($n=0;$n<$Num_Rows1;$n++){
			$acc_no[$n] = $list_info1[$n][$m++];
			$acc_name[$n] = $list_info1[$n][$m++];	
			$acc_balance[$n] = $list_info1[$n][$m++];						 
			$operate_date[$n] = $list_info1[$n][$m++];	
			$m=0;
		}
?>

