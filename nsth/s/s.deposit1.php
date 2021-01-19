<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php

 $strSQL = " SELECT
					DM.DEPTACCOUNT_NO AS DEPTACCOUNT_NO,
					DM.DEPTACCOUNT_NAME AS DEPTACCOUNT_NAME,
					DM.PRNCBAL AS PRNCBAL,
					(SELECT convert(varchar,DAY(MAX(OPERATE_DATE))) + '/' +
						convert(varchar,month(MAX(OPERATE_DATE))) + '/' +
						convert(varchar,year(MAX(OPERATE_DATE))+ 543) FROM DPDEPTSTATEMENT WHERE DEPTACCOUNT_NO=DM.DEPTACCOUNT_NO) AS OPERATE_DATE
				FROM 
					DPDEPTMASTER DM 
			WHERE 
					DM.MEMBER_NO = '$member_no'
					AND DM.DEPTCLOSE_STATUS!= '1'
          			AND DM.DEPTTYPE_CODE = '$dep_code'
					ORDER BY DM.DEPTACCOUNT_NO ASC" ;

		
		$resultData = sqlsrv_query($objConnect,$strSQL); 
		
		

?>

