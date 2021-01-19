<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
	$strSQL2 = "	SELECT
							MUP.PRENAME_DESC AS PRENAME,
							MMB.MEMB_NAME AS MBNAME,
							MMB.MEMB_SURNAME AS MBSURNAME,
							LCC.REF_COLLNO AS COLLMEMBER_NP			
						FROM
							LNCONTCOLL LCC, MBMEMBMASTER MMB, MBUCFPRENAME MUP
						WHERE
							MMB.MEMBER_NO = LCC.REF_COLLNO
							AND MMB.PRENAME_CODE = MUP.PRENAME_CODE
							AND LCC.LOANCOLLTYPE_CODE = '01' 
							AND LCC.LOANCONTRACT_NO = '$coll_loan_r[$b]' ";
							
	$value2 = array('PRENAME','MBNAME','MBSURNAME','COLLMEMBER_NP');
	list($Num_Rows2,$list_info2) = get_value_many_oci($strSQL2,$value2);
	$m=0;
	for($n=0;$n<$Num_Rows2;$n++){
		$who_coll_name[$n] = $list_info2[$n][$m++].''.$list_info2[$n][$m++].'  '.$list_info2[$n][$m++];
		$who_coll_no[$n] = $list_info2[$n][$m++];
		$m=0;
		$who_coll_name[$n] = $who_coll_name[$n].' ('.$who_coll_no[$n].') ';
	}	
?>

