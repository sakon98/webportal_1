<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
	$strSQL = "SELECT MAX(RECV_PERIOD) AS MAXSLIP FROM KPTEMPRECEIVEDET WHERE MEMBER_NO = '$member_no'";
	
	
	$resultData = sqlsrv_query($objConnect,$strSQL); 
	
	while( $row = sqlsrv_fetch_array( $resultData, SQLSRV_FETCH_ASSOC) ) {
					 
					  $listslip = $row['MAXSLIP']; 
					 
					 }
					 
					 
	
	$thisshow = Show_Slip(date('d-m-Y'));
	
	if($listslip != $thisshow){
		$listslip = $listslip-1;
	}
	
		
	list($slip,$slip_m,$slip_s,$slipsum) =show_list($listslip,6,$member_no);
			
			$a = "0";
			
	if(@$_REQUEST["slip_date"] == ""){
	
	if($a == "1"){
	
		$slip_date = Show_Slip(date('d-m-Y'));
		$slip_date = $slip_date-1;
		$show_month = show_month($slip_date);
		}else{
		$slip_date = Show_Slip(date('d-m-Y'));
		$show_month = show_month($slip_date);
		
		}
		
	}else{
		$slip_date = $_REQUEST["slip_date"];
		$show_month = show_month($slip_date);
	}
	



	 $strSQL3 = "SELECT * FROM (     
						SELECT 
							KPD.KPSLIP_NO AS A0,
							KUK.KEEPITEMTYPE_GRP AS A1,
							KUK.KEEPITEMTYPE_DESC AS A2,
							KPD.LOANCONTRACT_NO AS A3,
                               (CASE WHEN KPD.PERIOD = 0 THEN NULL ELSE KPD.PERIOD END) AS A8,
							KPD.DESCRIPTION AS A4,
                               FORMAT((CASE WHEN KPD.PRINCIPAL_PAYMENT = 0 THEN NULL ELSE KPD.PRINCIPAL_PAYMENT END), '#,#.##') AS A5,
                               FORMAT((CASE WHEN KPD.INTEREST_PAYMENT = 0 THEN NULL ELSE KPD.INTEREST_PAYMENT END), '#,#.##') AS A6,
                               FORMAT((CASE WHEN KPD.ITEM_PAYMENT * KUK.SIGN_FLAG = 0 THEN NULL ELSE KPD.ITEM_PAYMENT * KUK.SIGN_FLAG END), '#,#.##') AS A7,
                               FORMAT((CASE WHEN KPD.ITEM_BALANCE = 0 THEN NULL ELSE KPD.ITEM_BALANCE END), '#,#.##') AS A9,
                               DATEDIFF(day, KPD.CALINTFROM_DATE,KPD.CALINTTO_DATE) AS  A10,
							convert(varchar,DAY(KPD.POSTING_DATE)) + '/' +
							convert(varchar,month(KPD.POSTING_DATE)) + '/' +
							convert(varchar,year(KPD.POSTING_DATE)+ 543) AS A11,
							KPD.SEQ_NO AS SEQ					
						FROM 
							KPTEMPRECEIVEDET KPD, KPUCFKEEPITEMTYPE KUK
						WHERE 
							KPD.KEEPITEMTYPE_CODE = KUK.KEEPITEMTYPE_CODE
							AND KPD.MEMBER_NO = '$member_no'
							AND KPD.RECV_PERIOD = '$slip_date'
							AND KPD.POSTING_STATUS = 0
					UNION
						SELECT 
							KMD.KPSLIP_NO AS A0,
							KUK.KEEPITEMTYPE_GRP AS A1,
							KUK.KEEPITEMTYPE_DESC AS A2,
							KMD.LOANCONTRACT_NO AS A3,
							(CASE WHEN KMD.PERIOD = 0 THEN NULL ELSE KMD.PERIOD END) AS A8,
							KMD.DESCRIPTION AS A4,
							FORMAT((CASE WHEN KMD.PRINCIPAL_PAYMENT = 0 THEN NULL ELSE KMD.PRINCIPAL_PAYMENT END), '#,#.##') AS A5,
                               FORMAT((CASE WHEN KMD.INTEREST_PAYMENT = 0 THEN NULL ELSE KMD.INTEREST_PAYMENT END), '#,#.##') AS A6,
                               FORMAT((CASE WHEN KMD.ITEM_PAYMENT * KUK.SIGN_FLAG = 0 THEN NULL ELSE KMD.ITEM_PAYMENT * KUK.SIGN_FLAG END), '#,#.##') AS A7,
                               FORMAT((CASE WHEN KMD.ITEM_BALANCE = 0 THEN NULL ELSE KMD.ITEM_BALANCE END), '#,#.##') AS A9,
                               DATEDIFF(day, KMD.CALINTFROM_DATE,KMD.CALINTTO_DATE) AS  A10,
							convert(varchar,DAY(KMD.POSTING_DATE)) + '/' +
							convert(varchar,month(KMD.POSTING_DATE)) + '/' +
							convert(varchar,year(KMD.POSTING_DATE)+ 543) AS A11,
							KMD.SEQ_NO AS SEQ
						FROM 
							KPMASTRECEIVEDET KMD, KPUCFKEEPITEMTYPE KUK
						WHERE 
							KMD.KEEPITEMTYPE_CODE = KUK.KEEPITEMTYPE_CODE
							AND KMD.MEMBER_NO = '$member_no'
							AND KMD.RECV_PERIOD = '$slip_date'
					) M ORDER BY M.SEQ ";
	/*$value = array('A0','A1','A2','A3','A4','A5','A6','A7','A8','A9','A10','A11');		
	list($Num_Rows,$slip_show) = get_value_many_oci($strSQL,$value);	
	$totalpayment = 0;
	$j=0;
	for($i=0;$i<$Num_Rows;$i++){ 
		$slip_no[$i] 			= $slip_show[$i][$j++];   				
		$slip_itemtype[$i] 	= $slip_show[$i][$j++];			
		$slip_itemdesc[$i]	= $slip_show[$i][$j++];
		$slip_loanno[$i] 		= $slip_show[$i][$j++];
		$slip_desc[$i] 		= $slip_show[$i][$j++];
		$slip_principal[$i]	= $slip_show[$i][$j++];
		$slip_interest[$i] 	= $slip_show[$i][$j++];
		$slip_pay[$i] 			= $slip_show[$i][$j++];
		$period[$i]				= $slip_show[$i][$j++];
		$itembalance[$i] 	= $slip_show[$i][$j++];
		$rate_day[$i] 		= $slip_show[$i][$j++];
		$slipdate		 		= $slip_show[$i][$j++];
		$j=0;
		$totalpayment 		= $totalpayment + str_replace( ',','', $slip_pay[$i] );		
	}	*/
	
	$resultData3 = sqlsrv_query($objConnect,$strSQL3); 
	$resultData4 = sqlsrv_query($objConnect,$strSQL3); 
	
	
	// ไม่ใช้ ส่วนนี้
	/*$strSQL1 = "SELECT 
						'หักชำระผ่านบัญชีเงินฝาก : ' AS MONEYTYPE_CODE,
						KPE.EXPENSE_ACCID AS EXPENSE_ACCID,
						TO_CHAR(DECODE(KPE.ITEM_PAYMENT,0,NULL,KPE.ITEM_PAYMENT),'99G999G999G999D00')  AS ITEM_PAYMENT
					FROM 
						KPRECEIVEEXPENSE KPE
					WHERE 
						KPE.MONEYTYPE_CODE IN 'TDP'
						AND KPE.MEMBER_NO = '$member_no'
						AND KPE.RECV_PERIOD = '$showslip' ";
	$value1 = array('MONEYTYPE_CODE','EXPENSE_ACCID','ITEM_PAYMENT');
	list($Num_Rows1,$slip_show1) = get_value_many_oci($strSQL1,$value1);
	$m=0;
	for($n=0;$n<$Num_Rows1;$n++){ 
		$moneytype_code	= $slip_show1[$n][$m++];   
		$expense_accid		= $slip_show1[$n][$m++];   
		$item_payment		= $slip_show1[$n][$m++];   
		$m=0;
		$payment_a = str_replace( ',','',$item_payment);
	}*/
	
?>

