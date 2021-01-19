<?php
@header('Content-Type: text/html; charset=tis-620');
?>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
$strSQL = "SELECT 
                           convert(varchar,DAY(SHS.SLIP_DATE)) + '/' +
						convert(varchar,month(SHS.SLIP_DATE)) + '/' +
						convert(varchar,year(SHS.SLIP_DATE)+ 543) AS SLIP_DATE,
                           convert(varchar,DAY(SHS.OPERATE_DATE)) + '/' +
						convert(varchar,month(SHS.OPERATE_DATE)) + '/' +
						convert(varchar,year(SHS.OPERATE_DATE)+ 543) AS OPERATE_DATE,
					SHS.SHRITEMTYPE_CODE AS SHRITEMTYPE_CODE,
					SUS.SHRITEMTYPE_DESC AS SHRITEMTYPE_DESC,
					((SHS.SHARE_AMOUNT*10) * SUS.SIGN_FLAG) AS SHARE_AMOUNT,
					(SHS.SHARESTK_AMT*10) AS SHARESTK_AMT
				FROM 
					SHSHARESTATEMENT SHS LEFT JOIN SHUCFSHRITEMTYPE SUS ON SHS.SHRITEMTYPE_CODE = SUS.SHRITEMTYPE_CODE,
                      CMACCOUNTYEAR CMA  
				WHERE 
					SHS.OPERATE_DATE BETWEEN CMA.ACCSTART_DATE AND CMA.ACCEND_DATE
					AND  CMA.ACCOUNT_YEAR = '$show_share' 
					AND SHS.MEMBER_NO = '$member_no'
					ORDER BY SHS.SEQ_NO ";
//$value=array('SLIP_DATE','OPERATE_DATE','SHRITEMTYPE_CODE','SHRITEMTYPE_DESC','SHARE_AMOUNT','SHARESTK_AMT');
//list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);


$resultData = sqlsrv_query($objConnect,$strSQL);

$j=0;


/*while( $row = sqlsrv_fetch_array( $resultData, SQLSRV_FETCH_ASSOC) ) {
       $slip_date = $row['SLIP_DATE'];
	   $operate_date = $row['OPERATE_DATE'];
	   $shritemtype_code = $row['SHRITEMTYPE_CODE'];
	   $shritemtype_desc = $row['SHRITEMTYPE_DESC'];
	   $share_amount = $row['SHARE_AMOUNT'];
	   $sharestk_amt = $row['SHARESTK_AMT'];
}*/

/*for($i=0;$i<$Num_Rows;$i++){
	$slip_date[$i]= $list_info[$i][$j++];
	$operate_date[$i]  = $list_info[$i][$j++];
	$shritemtype_code[$i]= $list_info[$i][$j++];
	$shritemtype_desc[$i]  = $list_info[$i][$j++];
	$share_amount[$i]= $list_info[$i][$j++];
	$sharestk_amt[$i]  = $list_info[$i][$j++];
	$j=0;
}*/
?>

