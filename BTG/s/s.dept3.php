<?php
@header('Content-Type: text/html; charset=tis-620');
?>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php

$strSQL = "select * from ( SELECT 					 
					TO_CHAR(SHS.OPERATE_DATE, 'DD/MM/YY','NLS_CALENDAR=''THAI BUDDHA')AS OPERATE_DATE,
					SHS.DEPTITEMTYPE_CODE AS SHRITEMTYPE_CODE,
					SUS.DEPTITEMTYPE_DESC AS SHRITEMTYPE_DESC,
					(DEPTITEM_AMT) AS SHARE_AMOUNT,
					(SHS.PRNCBAL) AS SHARESTK_AMT
				FROM 
					DPDEPTSTATEMENT SHS , DPUCFDEPTITEMTYPE SUS 
				WHERE 
					  SHS.DEPTITEMTYPE_CODE = SUS.DEPTITEMTYPE_CODE(+)
				 	AND SHS.DEPTACCOUNT_NO = '$acc_no[$n]' 
					ORDER BY SHS.SEQ_NO desc ) where  rownum <=5 ";
//echo $strSQL;
$value=array( 'OPERATE_DATE','SHRITEMTYPE_CODE','SHRITEMTYPE_DESC','SHARE_AMOUNT','SHARESTK_AMT');
list($Num_Rows22,$list_info) = get_value_many_oci($strSQL,$value);
$j=0;
 
for($i=0;$i<$Num_Rows22;$i++){
	 
	$operate_date[$i]  = $list_info[$i][$j++];
	$shritemtype_code[$i]= $list_info[$i][$j++];
	$shritemtype_desc[$i]  = $list_info[$i][$j++];
	$share_amount[$i]= $list_info[$i][$j++];
	$sharestk_amt[$i]  = $list_info[$i][$j++];
	$j=0;
}
?>

