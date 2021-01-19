<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
	$strSQL2 = "	SELECT
							coop_name , addr_no ,addr_moo ,addr_tambol,addr_amphur,addr_province,addr_postcode
						FROM
							cmcoopmaster ";
							
	$value2 = array('coop_name','addr_no' ,'addr_moo' ,'addr_tambol','addr_amphur','addr_province','addr_postcode' );
	list($Num_Rows2,$list_info2) = get_value_many_oci($strSQL2,$value2);
	$m=0;
	for($n=0;$n<$Num_Rows2;$n++){
		$coop_name[$n] = $list_info2[$n][$m++];
		$addr_no[$n] = $list_info2[$n][$m++];
		$addr_moo[$n] = $list_info2[$n][$m++];
		$addr_tambol[$n] = $list_info2[$n][$m++];
		$addr_amphur[$n] = $list_info2[$n][$m++];
		$addr_province[$n] = $list_info2[$n][$m++];
		$addr_postcode[$n] = $list_info2[$n][$m++];
		//$m=0;
		//$who_coll_name[$n] =' ที่ตั้ง สำนักงาน '.$addr_no[$n]  .'  หมู่ '.$addr_moo[$n] .'  ตำบล'.$addr_tambol[$n] .'  อำเภอ'.$addr_amphur[$n] .'  จังหวัด'.$addr_province[$n].'  รหัสไปรษณีย์ '.$addr_postcode[$n];
	}	
?>

