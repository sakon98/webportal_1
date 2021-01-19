<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
	$strSQL2 = "	SELECT
							MUP.PRENAME_DESC AS PRENAME,
							MMB.MEMB_NAME AS MBNAME,
							MMB.MEMB_SURNAME AS MBSURNAME,
							LCC.REF_COLLNO AS COLLMEMBER_NP,
                            TO_CHAR(DECODE(LCM.PRINCIPAL_BALANCE,0,null,LCM.PRINCIPAL_BALANCE),'99G999G999G999D00') as PRINCIPAL_BALANCE							
						FROM
							LNCONTCOLL LCC, MBMEMBMASTER MMB, MBUCFPRENAME MUP,LNCONTMASTER LCM
						WHERE
							MMB.MEMBER_NO = LCC.REF_COLLNO
							AND MMB.PRENAME_CODE = MUP.PRENAME_CODE AND LCM.LOANCONTRACT_NO =                                                                                                      LCC.LOANCONTRACT_NO
							AND LCC.LOANCOLLTYPE_CODE = '01' AND LCC.COLL_STATUS = 1
							AND LCC.LOANCONTRACT_NO = '$coll_loan_r[$b]' ";
							
	$value2 = array('PRENAME','MBNAME','MBSURNAME','COLLMEMBER_NP','PRINCIPAL_BALANCE');
	list($Num_Rows2,$list_info2) = get_value_many_oci($strSQL2,$value2);
	$m=0;
	for($n=0;$n<$Num_Rows2;$n++){
		$who_coll_name[$n] = $list_info2[$n][$m++].''.$list_info2[$n][$m++].'  '.$list_info2[$n][$m++];
		$who_coll_no[$n] = $list_info2[$n][$m++];
        $principal_balance[$n] = $list_info2[$n][$m++];
		$m=0;
		$who_coll_name[$n] = $who_coll_name[$n].' ('.$who_coll_no[$n].') ';
	}	
?>

