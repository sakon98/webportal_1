<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
	$strSQL = "SELECT MAX(DIV_YEAR) AS MAXDIV ,MIN(DIV_YEAR) AS MINDIV FROM YRDIVMASTER WHERE MEMBER_NO = '$member_no' and DIV_year < '2563'";
	$value = array('MAXDIV','MINDIV');
	list($NumDIV,$listslip) = get_value_many_oci($strSQL,$value);	
	$maxdiv	 =  $listslip[0][0];   				
	$mindiv =  $listslip[0][1];		

	if($_REQUEST["divyear"] == ""){
		$divyear = $maxdiv;
	}else{
		$divyear = $_REQUEST["divyear"];
	}	
	
	$strSQL = "SELECT 
						TO_CHAR(DECODE(DIV_AMT,0,null,DIV_AMT),'99G999G999G999D00') AS DIV_BALAMT ,
						TO_CHAR(DECODE(AVG_AMT,0,null,AVG_AMT),'99G999G999G999D00') AS AVG_BALAMT ,
						TO_CHAR(DECODE(ETC_AMT,0,null,ETC_AMT),'99G999G999G999D00') AS ETC_BALAMT ,
						nvl((SELECT  sum(yd.PAY_AMT) AS EXPENSE_AMT
						FROM yrreqmethpay  Y , YRUCFMETHPAY YM , yrreqmethpaydet yd
						WHERE Y.methreq_docno = yd.methreq_docno
						and yd.METHPAYTYPE_CODE = YM.METHPAYTYPE_CODE(+)
						AND Y.DIV_YEAR = '$divyear' 
						AND yd.PAYTYPE_CODE <> 'ALL'
						AND Y.MEMBER_NO = '$member_no'),nvl((SELECT SUM(EXPENSE_AMT) AS EXPENSE_AMT FROM YRDIVMETHPAY WHERE PAYTYPE_CODE <> 'ALL' AND DIV_YEAR = '$divyear' AND MEMBER_NO = '$member_no'),0)) as SUB_BALAMT,
						DIV_AMT+AVG_AMT+ETC_AMT AS SUMDIV
					FROM 
						YRDIVMASTER 
					WHERE 
						MEMBER_NO = '$member_no'
						AND DIV_YEAR = '$divyear' ";
	$value = array('DIV_BALAMT','AVG_BALAMT','ETC_BALAMT','SUB_BALAMT','SUMDIV');
	list($Num_div,$slip_show) = get_value_many_oci($strSQL,$value);
	$div_balamt = $slip_show[0][0]; 
	$avg_balamt = $slip_show[0][1];
	$etc_balamt = $slip_show[0][2];
	$sub_balamt = $slip_show[0][3];
	$sumdiv = $slip_show[0][4];
	
	$total = $sumdiv - $sub_balamt;

	if($Num_div  == 0){
		echo '<script type="text/javascript"> window.alert("ไม่พบปันผล-เฉลี่ยคืน ในปีที่ท่านเลือก") </script> ';
		echo "<script>window.location = 'info.php'</script>";
		exit;
	}
	
	$strSQL1 = "SELECT
				(SELECT METHPAYTYPE_DESC FROM YRUCFMETHPAY WHERE METHPAYTYPE_CODE=DIV.METHPAYTYPE_CODE) AS DIVPAYTYPE_DESC,
				'' AS ITEM_AMT ,
				(SELECT BANK_DESC FROM CMUCFBANK WHERE BANK_CODE=DIV.EXPENSE_BANK) AS BANK_DESC,							
				DIV.EXPENSE_ACCID AS BANK_ACCID
				FROM 
				yrreqmethpay  Y , yrreqmethpaydet DIV
				WHERE Y.methreq_docno = DIV.methreq_docno and
				Y.MEMBER_NO = '$member_no'
				AND Y.DIV_YEAR= '$divyear' AND DIV.PAYTYPE_CODE = 'ALL'
				UNION
				SELECT
				(SELECT METHPAYTYPE_DESC FROM YRUCFMETHPAY WHERE METHPAYTYPE_CODE=DIV.METHPAYTYPE_CODE) AS DIVPAYTYPE_DESC,
				'' AS ITEM_AMT ,
				(SELECT BANK_DESC FROM CMUCFBANK WHERE BANK_CODE=DIV.EXPENSE_BANK) AS BANK_DESC,							
				EXPENSE_ACCID AS BANK_ACCID
				FROM 
				YRDIVMETHPAY DIV
				WHERE 
				DIV.MEMBER_NO = '$member_no'
				AND DIV.DIV_YEAR= '$divyear' AND DIV.PAYTYPE_CODE = 'ALL'";
	$value1 = array('DIVPAYTYPE_DESC','ITEM_AMT','BANK_DESC','BANK_ACCID');
	list($Num_div1,$slip_show1) = get_value_many_oci($strSQL1,$value1);
	//echo $Num_div1;
	$typepay = $slip_show1[0][0]; 
	//$totalpay = $slip_show1[0][1]; 
	$totalpay = number_format($total,2);
	$totalpay = $totalpay;
	$bank_desc = $slip_show1[0][2]; 
	$bank_acc = $slip_show1[0][3]; 
	
	
	$strSQL2 = "SELECT M.METHPAYTYPE_CODE,M.METHPAYTYPE_DESC,M.EXPENSE_AMT FROM (
				SELECT YM.METHPAYTYPE_CODE,YM.METHPAYTYPE_DESC , yd.PAY_AMT AS EXPENSE_AMT
				FROM yrreqmethpay  Y , YRUCFMETHPAY YM , yrreqmethpaydet yd
				WHERE Y.methreq_docno = yd.methreq_docno
				and yd.METHPAYTYPE_CODE = YM.METHPAYTYPE_CODE(+)
				AND Y.DIV_YEAR = '$divyear' 
                AND yd.PAYTYPE_CODE <> 'ALL'
				AND Y.MEMBER_NO = '$member_no' 
				union
				SELECT YM.METHPAYTYPE_CODE,YM.METHPAYTYPE_DESC , Y.EXPENSE_AMT
				FROM YRDIVMETHPAY Y , YRUCFMETHPAY YM 
				WHERE Y.METHPAYTYPE_CODE = YM.METHPAYTYPE_CODE
				AND Y.PAYTYPE_CODE <> 'ALL' 
				AND Y.DIV_YEAR = '$divyear' 
				AND Y.MEMBER_NO = '$member_no'
				) M ORDER BY M.METHPAYTYPE_CODE ";
	$value2 = array('METHPAYTYPE_DESC','EXPENSE_AMT');
	list($Num_Rows2,$list_info2) = get_value_many_oci($strSQL2,$value2);
	$j=0;
	for($i=0;$i<$Num_Rows2;$i++){
		$methpaytype_desc[$i]  = $list_info2[$i][$j++];
		$expense_amt[$i]       = $list_info2[$i][$j++];
		$j=0;
	}


?>
