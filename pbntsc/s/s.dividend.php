<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php



	$strSQL = "SELECT MAX(YM.DIV_YEAR) AS MAXDIV ,MIN(YM.DIV_YEAR) AS MINDIV FROM YRDIVMASTER YM , YRCFRATE YC WHERE YM.MEMBER_NO = '$member_no' AND YM.DIV_YEAR = YC.DIV_YEAR AND YC.WEBSHOW_FLAG = 1  ";
	$value = array('MAXDIV','MINDIV');
	list($NumDIV,$listslip) = get_value_many_oci($strSQL,$value);	
	$maxdiv	 =  $listslip[0][0]; 
        $avgdiv = $maxdiv;        
	$mindiv =  $listslip[0][1];
        
//echo $confirmdividend; exit();
        
	if($_REQUEST["divyear"] == "" && $confirmdividend == 1){
		$divyear = $maxdiv;
	}
       elseif($_REQUEST["divyear"] == "" && $confirmdividend == 0){
		$divyear = $avgdiv;
	}
        else{
		$divyear = $_REQUEST["divyear"];
	}	
	
	//echo $divyear; exit();
	
	$strSQL = "SELECT 
						TO_CHAR(DECODE(YM.DIV_AMT,0,null,YM.DIV_AMT),'99G999G999G999D00') AS DIV_BALAMT ,
						TO_CHAR(DECODE(YM.AVG_AMT,0,null,YM.AVG_AMT),'99G999G999G999D00') AS AVG_BALAMT ,
						TO_CHAR(DECODE(YM.ETC_AMT,0,null,YM.ETC_AMT),'99G999G999G999D00') AS ETC_BALAMT ,
						TO_CHAR(DECODE((YM.DIV_AMT+YM.AVG_AMT+YM.ETC_AMT),0,null,(YM.DIV_AMT+YM.AVG_AMT+YM.ETC_AMT)),'99G999G999G999D00') AS SUMDIV,
						YM.DIV_AMT+YM.AVG_AMT+YM.ETC_AMT as SUMDIV_BEGIN,
						Y.DIVPERCENT_RATE * 100 AS DIVPERCENT_RATE , Y.AVGPERCENT_RATE * 100 AS AVGPERCENT_RATE
					FROM 
						YRDIVMASTER YM , YRCFRATE Y
					WHERE YM.DIV_YEAR = Y.DIV_YEAR
						AND YM.MEMBER_NO = '$member_no'
						AND YM.DIV_YEAR = '$divyear' ";
	$value = array('DIV_BALAMT','AVG_BALAMT','ETC_BALAMT','SUMDIV','SUMDIV_BEGIN','DIVPERCENT_RATE','AVGPERCENT_RATE');
	list($Num_div,$slip_show) = get_value_many_oci($strSQL,$value);
	$div_balamt = $slip_show[0][0]; 
	$avg_balamt = $slip_show[0][1];
	$etc_balamt = $slip_show[0][2];
	$sumdiv = $slip_show[0][3];
	$sumdiv_begin = $slip_show[0][4];
	$divpercent_rate = $slip_show[0][5];
	$avgpercent_rate = $slip_show[0][6];
	
	//$sumdiv = $div_balamt + $avg_balamt ;

	if($Num_div  == 0){
		echo '<script type="text/javascript"> window.alert("ไม่พบปันผล-เฉลี่ยคืน ในปีที่ท่านเลือก") </script> ';
		echo "<script>window.location = 'info.php'</script>";
		exit;
	}
	
	/*$strSQL1 = "SELECT
							(SELECT METHPAYTYPE_DESC FROM YRUCFMETHPAY WHERE METHPAYTYPE_CODE=DIV.METHPAYTYPE_CODE) AS DIVPAYTYPE_DESC,
							TO_CHAR(DECODE(EXPENSE_AMT,0,null,EXPENSE_AMT),'99G999G999G999D00') AS ITEM_AMT ,
							(SELECT BANK_DESC FROM CMUCFBANK WHERE BANK_CODE=DIV.EXPENSE_BANK) AS BANK_DESC,							
							EXPENSE_ACCID AS BANK_ACCID
						FROM 
							YRDIVMETHPAY DIV
						WHERE 
							DIV.MEMBER_NO = '$member_no'
							AND DIV.DIV_YEAR= '$divyear'";
	$value1 = array('DIVPAYTYPE_DESC','ITEM_AMT','BANK_DESC','BANK_ACCID');
	list($Num_div1,$slip_show1) = get_value_many_oci($strSQL1,$value1);
	//echo $Num_div1;
	
	$j=0;
for($i=0;$i<$Num_div1;$i++){
	
	$typepay = $slip_show1[$i][$j]; 
	$totalpay = $slip_show1[$i][$j]; 
	$bank_desc = $slip_show1[$i][$j]; 
	$bank_acc = $slip_show1[$i][$j]; 
	
	}*/
	
	$strSQL1 = "SELECT
							(SELECT METHPAYTYPE_DESC FROM YRUCFMETHPAY WHERE METHPAYTYPE_CODE=DIV.METHPAYTYPE_CODE) AS DIVPAYTYPE_DESC,
							TO_CHAR(DECODE(EXPENSE_AMT,0,null,EXPENSE_AMT),'99G999G999G999D00') AS ITEM_AMT ,
							(SELECT BANK_DESC FROM CMUCFBANK WHERE BANK_CODE=DIV.EXPENSE_BANK) AS BANK_DESC,							
							EXPENSE_ACCID AS BANK_ACCID,
							EXPENSE_AMT
						FROM 
							YRDIVMETHPAY DIV
						WHERE 
							DIV.MEMBER_NO = '$member_no'
							AND DIV.DIV_YEAR= '$divyear'
                            AND DIV.METHPAYTYPE_CODE = 'SKS'";
							$value1 = array('DIVPAYTYPE_DESC','ITEM_AMT','BANK_DESC','BANK_ACCID','EXPENSE_AMT');
	                       list($Num_div1,$slip_show1) = get_value_many_oci($strSQL1,$value1);
						   
						   $typepay_sks = $slip_show1[0][0]; 
	                       $totalpay_sks = $slip_show1[0][1];
	                       $bank_desc_sks = $slip_show1[0][2];
	                       $bank_acc_sks = $slip_show1[0][3];
						   $expense_amt_sks = $slip_show1[0][4];
						   
						 //echo $totalpay_sks;  exit();
						 
						 $strSQL2 = "SELECT
							(SELECT METHPAYTYPE_DESC FROM YRUCFMETHPAY WHERE METHPAYTYPE_CODE=DIV.METHPAYTYPE_CODE) AS DIVPAYTYPE_DESC,
							TO_CHAR(DECODE(EXPENSE_AMT,0,null,EXPENSE_AMT),'99G999G999G999D00') AS ITEM_AMT ,
							(SELECT BANK_DESC FROM CMUCFBANK WHERE BANK_CODE=DIV.EXPENSE_BANK) AS BANK_DESC,							
							EXPENSE_ACCID AS BANK_ACCID,
							EXPENSE_AMT
						FROM 
							YRDIVMETHPAY DIV
						WHERE 
							DIV.MEMBER_NO = '$member_no'
							AND DIV.DIV_YEAR= '$divyear'
                            AND DIV.METHPAYTYPE_CODE = 'INH'";
							$value2 = array('DIVPAYTYPE_DESC','ITEM_AMT','BANK_DESC','BANK_ACCID','EXPENSE_AMT');
	                       list($Num_div2,$slip_show2) = get_value_many_oci($strSQL2,$value2);
						   
						   $typepay_inh = $slip_show2[0][0]; 
	                       $totalpay_inh= $slip_show2[0][1];
	                       $bank_desc_inh = $slip_show2[0][2];
	                       $bank_acc_inh = $slip_show2[0][3];
						  $expense_amt_inh = $slip_show2[0][4];
						   
						   $strSQL3 = "SELECT
							(SELECT METHPAYTYPE_DESC FROM YRUCFMETHPAY WHERE METHPAYTYPE_CODE=DIV.METHPAYTYPE_CODE) AS DIVPAYTYPE_DESC,
							TO_CHAR(DECODE(EXPENSE_AMT,0,null,EXPENSE_AMT),'99G999G999G999D00') AS ITEM_AMT ,
							(SELECT BANK_DESC FROM CMUCFBANK WHERE BANK_CODE=DIV.EXPENSE_BANK) AS BANK_DESC,							
							EXPENSE_ACCID AS BANK_ACCID,
							EXPENSE_AMT
						FROM 
							YRDIVMETHPAY DIV
						WHERE 
							DIV.MEMBER_NO = '$member_no'
							AND DIV.DIV_YEAR= '$divyear'
                            AND DIV.METHPAYTYPE_CODE = 'SKP'";
							$value3 = array('DIVPAYTYPE_DESC','ITEM_AMT','BANK_DESC','BANK_ACCID','EXPENSE_AMT');
	                       list($Num_div3,$slip_show3) = get_value_many_oci($strSQL3,$value3);
						   
						   $typepay_skp = $slip_show3[0][0]; 
	                       $totalpay_skp= $slip_show3[0][1];
	                       $bank_desc_skp = $slip_show3[0][2];
	                       $bank_acc_skp = $slip_show3[0][3];
						   $expense_amt_skp = $slip_show3[0][4];
						   
						   
						   $strSQL4 = "SELECT
							(SELECT METHPAYTYPE_DESC FROM YRUCFMETHPAY WHERE METHPAYTYPE_CODE=DIV.METHPAYTYPE_CODE) AS DIVPAYTYPE_DESC,
							TO_CHAR(DECODE(EXPENSE_AMT,0,null,EXPENSE_AMT),'99G999G999G999D00') AS ITEM_AMT ,
							(SELECT BANK_DESC FROM CMUCFBANK WHERE BANK_CODE=DIV.EXPENSE_BANK) AS BANK_DESC,							
							EXPENSE_ACCID AS BANK_ACCID,
							EXPENSE_AMT
						FROM 
							YRDIVMETHPAY DIV
						WHERE 
							DIV.MEMBER_NO = '$member_no'
							AND DIV.DIV_YEAR= '$divyear'
                            AND DIV.METHPAYTYPE_CODE = 'CMT'";
							$value4 = array('DIVPAYTYPE_DESC','ITEM_AMT','BANK_DESC','BANK_ACCID','EXPENSE_AMT');
	                       list($Num_div4,$slip_show4) = get_value_many_oci($strSQL4,$value4);
						   
						   $typepay_cmt = $slip_show4[0][0]; 
	                       $totalpay_cmt= $slip_show4[0][1];
	                       $bank_desc_cmt = $slip_show4[0][2];
	                       $bank_acc_cmt = $slip_show4[0][3];
						    $expense_amt_cmt = $slip_show4[0][4];
						   
						   
						   $strSQL5 = "SELECT
							(SELECT METHPAYTYPE_DESC FROM YRUCFMETHPAY WHERE METHPAYTYPE_CODE=DIV.METHPAYTYPE_CODE) AS DIVPAYTYPE_DESC,
							TO_CHAR(DECODE(EXPENSE_AMT,0,null,EXPENSE_AMT),'99G999G999G999D00') AS ITEM_AMT ,
							(SELECT BANK_DESC FROM CMUCFBANK WHERE BANK_CODE=DIV.EXPENSE_BANK) AS BANK_DESC,							
							EXPENSE_ACCID AS BANK_ACCID,
							EXPENSE_AMT
						FROM 
							YRDIVMETHPAY DIV
						WHERE 
							DIV.MEMBER_NO = '$member_no'
							AND DIV.DIV_YEAR= '$divyear'
                            AND DIV.METHPAYTYPE_CODE = 'CSO'";
							$value5 = array('DIVPAYTYPE_DESC','ITEM_AMT','BANK_DESC','BANK_ACCID','EXPENSE_AMT');
	                       list($Num_div5,$slip_show5) = get_value_many_oci($strSQL5,$value5);
						   
						   $typepay_cso = $slip_show5[0][0]; 
	                       $totalpay_cso = $slip_show5[0][1];
	                       $bank_desc_cso = $slip_show5[0][2];
	                       $bank_acc_cso = $slip_show5[0][3];
						    $expense_amt_cso = $slip_show5[0][4];
						   
						   
						   $strSQL6 = "SELECT
							(SELECT METHPAYTYPE_DESC FROM YRUCFMETHPAY WHERE METHPAYTYPE_CODE=DIV.METHPAYTYPE_CODE) AS DIVPAYTYPE_DESC,
							TO_CHAR(DECODE(EXPENSE_AMT,0,null,EXPENSE_AMT),'99G999G999G999D00') AS ITEM_AMT ,
							(SELECT BANK_DESC FROM CMUCFBANK WHERE BANK_CODE=DIV.EXPENSE_BANK) AS BANK_DESC,							
							EXPENSE_ACCID AS BANK_ACCID,
							EXPENSE_AMT
						FROM 
							YRDIVMETHPAY DIV
						WHERE 
							DIV.MEMBER_NO = '$member_no'
							AND DIV.DIV_YEAR= '$divyear'
                            AND DIV.METHPAYTYPE_CODE = 'LON'";
							$value6 = array('DIVPAYTYPE_DESC','ITEM_AMT','BANK_DESC','BANK_ACCID','EXPENSE_AMT');
	                       list($Num_div6,$slip_show6) = get_value_many_oci($strSQL6,$value6);
						   
						   $typepay_lon = $slip_show6[0][0]; 
	                       $totalpay_lon = $slip_show6[0][1];
	                       $bank_desc_lon = $slip_show6[0][2];
	                       $bank_acc_lon = $slip_show6[0][3];
						   $expense_amt_lon = $slip_show6[0][4];
						   
						   
						   $strSQL7 = "SELECT
							(SELECT METHPAYTYPE_DESC FROM YRUCFMETHPAY WHERE METHPAYTYPE_CODE=DIV.METHPAYTYPE_CODE) AS DIVPAYTYPE_DESC,
							TO_CHAR(DECODE(EXPENSE_AMT,0,null,EXPENSE_AMT),'99G999G999G999D00') AS ITEM_AMT ,
							(SELECT BANK_DESC FROM CMUCFBANK WHERE BANK_CODE=DIV.EXPENSE_BANK) AS BANK_DESC,							
							EXPENSE_ACCID AS BANK_ACCID,
							EXPENSE_AMT
						FROM 
							YRDIVMETHPAY DIV
						WHERE 
							DIV.MEMBER_NO = '$member_no'
							AND DIV.DIV_YEAR= '$divyear'
                            AND DIV.METHPAYTYPE_CODE = 'ET4'";
							$value7 = array('DIVPAYTYPE_DESC','ITEM_AMT','BANK_DESC','BANK_ACCID','EXPENSE_AMT');
	                       list($Num_div7,$slip_show7) = get_value_many_oci($strSQL7,$value7);
						   
						   $typepay_et4 = $slip_show7[0][0]; 
	                       $totalpay_et4 = $slip_show7[0][1];
	                       $bank_desc_et4 = $slip_show7[0][2];
	                       $bank_acc_et4 = $slip_show7[0][3];
			       $expense_amt_et4 = $slip_show7[0][4];
			       
			       $strSQL8 = "SELECT
							(SELECT METHPAYTYPE_DESC FROM YRUCFMETHPAY WHERE METHPAYTYPE_CODE=DIV.METHPAYTYPE_CODE) AS DIVPAYTYPE_DESC,
							TO_CHAR(DECODE(EXPENSE_AMT,0,null,EXPENSE_AMT),'99G999G999G999D00') AS ITEM_AMT ,
							(SELECT BANK_DESC FROM CMUCFBANK WHERE BANK_CODE=DIV.EXPENSE_BANK) AS BANK_DESC,							
							EXPENSE_ACCID AS BANK_ACCID,
							EXPENSE_AMT
						FROM 
							YRDIVMETHPAY DIV
						WHERE 
							DIV.MEMBER_NO = '$member_no'
							AND DIV.DIV_YEAR= '$divyear'
                            AND DIV.METHPAYTYPE_CODE = 'CSN'";
							$value8 = array('DIVPAYTYPE_DESC','ITEM_AMT','BANK_DESC','BANK_ACCID','EXPENSE_AMT');
	                       list($Num_div8,$slip_show8) = get_value_many_oci($strSQL8,$value8);
						   
						   $typepay_csn = $slip_show8[0][0]; 
	                       $totalpay_csn = $slip_show8[0][1];
	                       $bank_desc_csn = $slip_show8[0][2];
	                       $bank_acc_csn = $slip_show8[0][3];
			       $expense_amt_csn = $slip_show8[0][4];
						   
							
						   $total_sub = $expense_amt_et4 +  $expense_amt_lon + $expense_amt_cso + $expense_amt_cmt + $expense_amt_skp + $expense_amt_inh + $expense_amt_sks + $expense_amt_csn;

?>

