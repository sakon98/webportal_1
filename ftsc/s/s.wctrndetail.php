<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php

$strSQL = "select 
						w.TRN_DOCNO as TRN_DOCNO,
						w.CONFIRM_DATE as CONFIRM_DATE ,
						w.OLD_BRANCH_DESC as OLD_BRANCH_DESC,
						w.NEW_BRANCH_DESC as NEW_BRANCH_DESC
					from (
							SELECT s.*,
								(select c.coopbranch_desc from cmucfcoopbranch c where c.coop_id=s.old_coop_id and c.cs_type='8' ) as OLD_BRANCH_DESC,
								(select c.coopbranch_desc from cmucfcoopbranch c where c.coop_id=s.new_coop_id and c.cs_type='8' ) as NEW_BRANCH_DESC
							 FROM  wctransfermember s 
							WHERE  trim(s.deptaccount_no)=  '$member_no' 							
							order by confirm_date desc 
							) w 
						";
	//echo $strSQL;		
$value = array('TRN_DOCNO','CONFIRM_DATE','OLD_BRANCH_DESC','NEW_BRANCH_DESC');
list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
if($Num_Rows == 0){
	echo '<script type="text/javascript"> window.alert("ไม่พบข้อมูลการโอนย้าย") </script> ';
	if($connectby != "desktop")
	 echo "<script>window.location = 'index.php'</script>";	
	exit;
}
$j=0;
for($i=0;$i<$Num_Rows;$i++){
	$trn_docno[$i] = $list_info[$i][$j++];
	$confirm_date[$i] = $list_info[$i][$j++];
	$old_branch_desc[$i] = $list_info[$i][$j++];
	$new_branch_desc[$i] = $list_info[$i][$j++];
	$j=0;
}

?>

