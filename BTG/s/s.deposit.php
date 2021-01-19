<?php
@header('Content-Type: text/html; charset=tis-620');
?>

	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />

<?php


$strSQL = "SELECT 
					DT.DEPTTYPE_DESC AS DEP_DESC,
					DT.DEPTTYPE_CODE AS DEP_CODE,
					COUNT(DM.DEPTACCOUNT_NO)AS ACC_COUNT,
                       (SELECT SUM(PRNCBAL) FROM DPDEPTMASTER WHERE DEPTCLOSE_STATUS!= '1' AND MEMBER_NO='$member_no')AS SUM_PRNCBAL
				FROM 
					DPDEPTMASTER DM , DPDEPTTYPE DT ,DPUCFDEPTGROUP DUG
				WHERE
					 DM.DEPTCLOSE_STATUS!= '1'
					AND DM.DEPTTYPE_CODE = DT.DEPTTYPE_CODE(+)
					AND DT.DEPTGROUP_CODE = DUG.DEPTGROUP_CODE(+)
					AND DM.MEMBER_NO='$member_no'
					GROUP BY DT.DEPTTYPE_CODE,DT.DEPTTYPE_DESC";
										
$value = array('DEP_DESC','DEP_CODE','ACC_COUNT','SUM_PRNCBAL');
list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
if($Num_Rows == 0){
	echo '<script type="text/javascript"> window.alert("��辺�ѭ���Թ�ҡ�ͧ��ҹ") </script> ';
	if($connectby != "desktop")
	 echo "<script>window.location = 'index.php'</script>";	
	exit;
}
$j=0;
for($i=0;$i<$Num_Rows;$i++){
	$dep_desc[$i] = $list_info[$i][$j++];
	$dep_code[$i] = $list_info[$i][$j++];
	$acc_count[$i] = $list_info[$i][$j++];
        $sum_prncbal[$i] = $list_info[$i][$j++];
	$j=0;
}

?>

