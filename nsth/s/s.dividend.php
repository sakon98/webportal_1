<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
	$strSQL = "SELECT MAX(DIV_YEAR) AS MAXDIV ,MIN(DIV_YEAR) AS MINDIV FROM YRDIVMASTER WHERE MEMBER_NO = '$member_no' ";
	/*$value = array('MAXDIV','MINDIV');
	list($NumDIV,$listslip) = get_value_many_oci($strSQL,$value);	
	$maxdiv	 =  $listslip[0][0];   				
	$mindiv =  $listslip[0][1];	*/

$resultData = sqlsrv_query($objConnect,$strSQL);

while($list_info = sqlsrv_fetch_array($resultData)){

$maxdiv = $list_info['MAXDIV'];
$mindiv = $list_info['MINDIV'];

}
	

	if(@$_REQUEST["divyear"] == ""){
		$divyear = $maxdiv;
	}else{
		$divyear = $_REQUEST["divyear"];
	}	
	
	$strSQL2 = "SELECT 
						FORMAT((CASE WHEN DIV_AMT = 0 THEN NULL ELSE DIV_AMT END), '#,#.##') AS DIV_AMT,
						FORMAT((CASE WHEN AVG_AMT = 0 THEN NULL ELSE AVG_AMT END), '#,#.##') AS AVG_AMT,
						FORMAT((CASE WHEN ETC_AMT = 0 THEN NULL ELSE ETC_AMT END), '#,#.##') AS ETC_AMT,
                           FORMAT((CASE WHEN DIV_AMT+AVG_AMT+ETC_AMT = 0 THEN NULL ELSE DIV_AMT+AVG_AMT+ETC_AMT END), '#,#.##') AS SUMDIV
					FROM 
						YRDIVMASTER 
					WHERE 
						MEMBER_NO = '$member_no'
						AND DIV_YEAR = '$divyear' ";
	/*$value = array('DIV_BALAMT','AVG_BALAMT','ETC_BALAMT','SUMDIV');
	list($Num_div,$slip_show) = get_value_many_oci($strSQL,$value);
	$div_balamt = $slip_show[0][0]; 
	$avg_balamt = $slip_show[0][1];
	$etc_balamt = $slip_show[0][2];
	$sumdiv = $slip_show[0][3];*/
	
	$resultData2 = sqlsrv_query($objConnect,$strSQL2);
	
	if($resultData2  == 0){
		echo '<script type="text/javascript"> window.alert("ไม่พบปันผล-เฉลี่ยคืน ในปีที่ท่านเลือก") </script> ';
		echo "<script>window.location = 'info.php'</script>";
		exit;
	}
	
	while($list_info1 = sqlsrv_fetch_array($resultData2)){

	$div_balamt = $list_info1['DIV_BALAMT'];
	$avg_balamt = $list_info1['AVG_BALAMT'];
	$etc_balamt = $list_info1['ETC_BALAMT'];
	$sumdiv = $list_info1['SUMDIV'];

	}
	
	
	
	$strSQL1 = "SELECT
							(SELECT METHPAYTYPE_DESC FROM YRUCFMETHPAY WHERE METHPAYTYPE_CODE=DIV.METHPAYTYPE_CODE) AS DIVPAYTYPE_DESC,
							FORMAT((CASE WHEN EXPENSE_AMT = 0 THEN NULL ELSE EXPENSE_AMT END), '#,#.##') AS ITEM_AMT,
							(SELECT BANK_DESC FROM CMUCFBANK WHERE BANK_CODE=DIV.EXPENSE_BANK) AS BANK_DESC,							
							EXPENSE_ACCID AS BANK_ACCID
						FROM 
							YRDIVMETHPAY DIV
						WHERE 
							DIV.MEMBER_NO = '$member_no'
							AND DIV.DIV_YEAR= '$divyear'";
	/*$value1 = array('DIVPAYTYPE_DESC','ITEM_AMT','BANK_DESC','BANK_ACCID');
	list($Num_div1,$slip_show1) = get_value_many_oci($strSQL1,$value1);
	//echo $Num_div1;
	$typepay = $slip_show1[0][0]; 
	$totalpay = $slip_show1[0][1]; 
	$bank_desc = $slip_show1[0][2]; 
	$bank_acc = $slip_show1[0][3]; */
	
	$resultData1 = sqlsrv_query($objConnect,$strSQL1);
	
	while($list_info2 = sqlsrv_fetch_array($resultData1)){

	$typepay = $list_info2['DIVPAYTYPE_DESC'];
	$totalpay = $list_info2['ITEM_AMT'];
	$bank_desc = $list_info2['BANK_DESC'];
	$bank_acc = $list_info2['BANK_ACCID'];

	}


?>

