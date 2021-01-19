<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
	$strSQL23 = "	select collmast_desc as COLL_DESC, lnucfcollmasttype.collmasttype_desc as COLLMASTTYPE_DESC,mortgage_price,mortgage_date,mrtg_name1
	from lncollmaster inner join lnucfcollmasttype on lncollmaster.collmasttype_code = lnucfcollmasttype.collmasttype_code 
 where collmast_no='$coll_r1[$b]' ";
							
	$value23 = array('COLL_DESC', 'COLLMASTTYPE_DESC','MORTGAGE_PRICE','MORTGAGE_DATE','MRTG_NAME1' );
	list($Num_Rows23,$list_info23) = get_value_many_oci($strSQL23,$value23);
	$m3=0;
	
	for($n3=0;$n3<$Num_Rows23;$n3++){
		$collmast_desc[$n3] = $list_info23[$n3][$m3++];
		$collmasttype_desc[$n3] = $list_info23[$n3][$m3++];
		$mortgage_price[$n3] = $list_info23[$n3][$m3++];
		$mortgage_date[$n3] = $list_info23[$n3][$m3++];
		$mrtg_name[$n3] = $list_info23[$n3][$m3++];
		 
		$m3=0;
		 
	}	
?>

