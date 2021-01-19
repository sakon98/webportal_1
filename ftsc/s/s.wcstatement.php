<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php

$strSQL = "select 
						w.DEPTITEMTYPE_DESC as DEPTITEMTYPE_DESC,
						w.OPERATE_DATE as OPERATE_DATE,
						TO_CHAR(w.deptitem_amt,'9,990.99') as DEPTITEM_AMT,
						TO_CHAR(w.PRNCBAL,'9,990.99') as PRNCBAL,
						w.ITEM_STATUS as ITEM_STATUS
					from (
							SELECT concat(concat(s.deptitemtype_code,':'),t.deptitemtype_desc) as deptitemtype_desc ,s.operate_date,s.deptitem_amt,s.prncbal,s.item_status 
							 FROM  WCDEPTSTATEMENT s  
							 , wcucfdeptitemtype t
							WHERE  deptaccount_no= '$member_no'
							and t.deptitemtype_code=s.deptitemtype_code 
							order by seq_no desc 
							) w
							
						";
	//echo $strSQL;		
$value = array('DEPTITEMTYPE_DESC','OPERATE_DATE','DEPTITEM_AMT','PRNCBAL','ITEM_STATUS');
list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
if($Num_Rows == 0){
	echo '<script type="text/javascript"> window.alert("ไม่พบข้อมูลการเรียกเก็บเงิน") </script> ';
	if($connectby != "desktop")
	 echo "<script>window.location = 'index.php'</script>";	
	exit;
}
$j=0;
for($i=0;$i<$Num_Rows;$i++){
	$deptitemtype_desc[$i] = $list_info[$i][$j++];
	$operate_date[$i] = $list_info[$i][$j++];
	$deptitem_amt[$i] = $list_info[$i][$j++];
	$prncbal[$i] = $list_info[$i][$j];
	$prncbal_[$i] = $list_info[$i][$j++];
	$item_status[$i] = $list_info[$i][$j++];
	$j=0;
}

?>

