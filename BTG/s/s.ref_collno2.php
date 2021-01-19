<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
	$strSQL2 = "	SELECT
							REF_COLLNO , substr(DESCRIPTION	,0,50) as	DESCRIPTION	
						FROM
							LNCONTCOLL LCC 
						WHERE
							  LCC.LOANCONTRACT_NO = '$loancontract_no[$n]' ";
							
	$value2 = array('REF_COLLNO','DESCRIPTION' );
	list($Num_Rows22,$list_info2) = get_value_many_oci($strSQL2,$value2);
	$m=0;
	for($n=0;$n<$Num_Rows22;$n++){
		$ref_collname[$n] = $list_info2[$n][$m++];
		$description[$n] = $list_info2[$n][$m++];
		$m=0;
		$who_coll_name[$n] =   $ref_collname[$n].' ('.$description[$n].') ';
	}	
?>

