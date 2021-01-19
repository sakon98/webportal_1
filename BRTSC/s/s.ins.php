<?php
@header('Content-Type: text/html; charset=tis-620');
?>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
$strSQL = "SELECT 
			NVL(B.INSTYPE_CODE,'') || '-' || NVL(B.SHORT_DESC,'') AS INSTYPE_CODE,
			NVL(A.INSGROUPDOC_NO,'') AS INSGROUPDOC_NO,
			NVL(A.INSCOST_BLANCE,0) AS INSCOST_BLANCE,
			NVL(A.INSPEROD_PAYMENT,0) AS INSPEROD_PAYMENT,
			NVL(A.INSPAYMENT_ARREAR,0) AS INSPAYMENT_ARREAR,
			NVL(TO_CHAR(A.STARTSAFE_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA'),'') AS STARTSAFE_DATE,
			NVL(TO_CHAR(A.ENDSAFE_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA'),'') AS ENDSAFE_DATE,
			B.INSTYPE_CODE AS INSTYPE_CODE2,
			NVL(A.INSMEMB_STATUS,0) AS INSMEMB_STATUS
			FROM INSGROUPMASTER A , INSURENCETYPE B
			WHERE A.INSTYPE_CODE = B.INSTYPE_CODE
			AND A.INSMEMB_STATUS = 1
			AND A.COOP_ID = '045001'
			AND A.MEMBER_NO = '$member_no'
			ORDER BY B.INSTYPE_CODE
 ";
$value = array('INSTYPE_CODE','INSGROUPDOC_NO','INSCOST_BLANCE','INSPEROD_PAYMENT','INSPAYMENT_ARREAR','STARTSAFE_DATE','ENDSAFE_DATE','INSTYPE_CODE2','INSMEMB_STATUS');
list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
//echo $Num_Rows;
$j=0;
for($i=0;$i<$Num_Rows;$i++){
	$instype_code[$i]  = $list_info[$i][$j++];
	$insgroupdoc_no[$i]  = $list_info[$i][$j++];
	$inscost_blance[$i]  = $list_info[$i][$j++];
	$insperod_payment[$i]  = $list_info[$i][$j++];
	$inspayment_arrear[$i] =   $list_info[$i][$j++];
	$startsafe_date[$i]  = $list_info[$i][$j++];
	$endsafe_date[$i]  = $list_info[$i][$j++];
	$instype_code2[$i]  = $list_info[$i][$j++];
	$insmemb_status[$i]  = $list_info[$i][$j++];
	
	$j=0;
}

?>

