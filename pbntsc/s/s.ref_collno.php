<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
	$strSQL = "SELECT
						LCC.LOANCONTRACT_NO AS LOANCONTRACT_NO,
						PRE.PRENAME_DESC AS PRENAME_DESC,
						MEMB.MEMB_NAME AS MEMB_NAME,
						MEMB.MEMB_SURNAME AS MEMB_SURNAME,
						LCM.MEMBER_NO AS MEMBER_NO,
						TO_CHAR(DECODE(LCM.PRINCIPAL_BALANCE,0,null,LCM.PRINCIPAL_BALANCE),'99G999G999G999D00') as PRINCIPAL_BALANCE 		
					FROM
						LNCONTCOLL LCC, LNCONTMASTER LCM, MBMEMBMASTER MEMB, MBUCFPRENAME PRE
					WHERE
						LCC.LOANCONTRACT_NO = LCM.LOANCONTRACT_NO
						AND LCM.MEMBER_NO = MEMB.MEMBER_NO
						AND MEMB.PRENAME_CODE = PRE.PRENAME_CODE
						AND LCM.CONTRACT_STATUS = '1'
						AND LCC.COLL_STATUS = 1
						AND LCC.REF_COLLNO = '$member_no' 
						ORDER BY PRINCIPAL_BALANCE ASC
						";
	$value = array('LOANCONTRACT_NO','PRENAME_DESC','MEMB_NAME','MEMB_SURNAME','MEMBER_NO','PRINCIPAL_BALANCE');
	list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
	$j=0;
	for($i=0;$i<$Num_Rows;$i++){
		$coll_loan[$i] = $list_info[$i][$j++];
		$coll_name[$i] = $list_info[$i][$j++].''.$list_info[$i][$j++].'  '.$list_info[$i][$j++];
		$ref_no[$i] = $list_info[$i][$j++];
		$coll_balance[$i] = $list_info[$i][$j++];
		$j=0;
		$coll_name_m[$i] = $coll_name[$i];
		$coll_name[$i] = $coll_name[$i].' ('.$ref_no[$i].')';
	
	}	
	
	$strSQL1 = "	SELECT 
							DISTINCT(LCM.LOANCONTRACT_NO) AS LOAN_NO,
							LT.LOANGROUP_CODE
					 	FROM
							LNCONTMASTER LCM , LNCONTCOLL LCC, LNLOANTYPE LT
						WHERE 
							LCM.LOANCONTRACT_NO = LCC.LOANCONTRACT_NO
							AND CONTRACT_STATUS = '1' 
							AND	LT.LOANGROUP_CODE='01'
							AND MEMBER_NO = '$member_no'
							ORDER BY LT.LOANGROUP_CODE ";
							
	$value1 = array('LOAN_NO');
	
	list($Num_Rows1,$list_info1) = get_value_many_oci($strSQL1,$value1);
	$j=0;
	for($i=0;$i<$Num_Rows1;$i++){
		$coll_loan_r[$i] = $list_info1[$i][$j++];
		$j=0;
	}	
	
	














?>

