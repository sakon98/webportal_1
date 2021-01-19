<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
	$strSQL = "SELECT MAX(RECV_PERIOD) AS MAXSLIP FROM KPMASTRECEIVEDET WHERE MEMBER_NO = '$member_no'";
	$value = ('MAXSLIP');
	$listslip = get_single_value_oci($strSQL,$value);
	$thisshow = Show_Slip(date('d-m-Y'));
	
	if($listslip != $thisshow){
		$listslip = $listslip-1;
	}
		
	list($slip,$slip_m,$slip_s,$slipsum) =show_list($listslip,36,$member_no);
			
	if($_REQUEST["slip_date"] == ""){

	$strSQL_C1 = "SELECT MAX(RECV_PERIOD) AS C1 FROM KPMASTRECEIVEDET WHERE MEMBER_NO = '$member_no'";
	$value_c1 = ('C1');
	$c1 = get_single_value_oci($strSQL_C1,$value_c1);
	
	$strSQL3 = "SELECT TO_CHAR(TO_NUMBER(TO_CHAR(MAX(LS.SLIP_DATE),'YYYYMM')+54300)) AS C2 FROM LNCONTMASTER L , LNCONTSTATEMENT LS WHERE L.LOANCONTRACT_NO = LS.LOANCONTRACT_NO AND LS.LOANITEMTYPE_CODE = 'LPX' AND LS.ITEM_STATUS = 1 AND L.MEMBER_NO = '$member_no' AND LS.SEQ_NO = (SELECT MAX(LS1.SEQ_NO) FROM LNCONTSTATEMENT LS1 WHERE LS1.LOANITEMTYPE_CODE = 'LPX' AND LS1.ITEM_STATUS = 1 AND LS1.LOANCONTRACT_NO = LS.LOANCONTRACT_NO)";
		$value3 = ('C2');
		$c2 = get_single_value_oci($strSQL3,$value3);
		
		$strSQL4 = "SELECT TO_CHAR(TO_NUMBER(TO_CHAR(MAX(LS.SLIP_DATE),'YYYYMM')+54300)) AS C3 FROM SHSHARESTATEMENT LS WHERE LS.SHRITEMTYPE_CODE = 'SPX' AND LS.ITEM_STATUS = 1 AND LS.MEMBER_NO = '$member_no' AND LS.SEQ_NO = (SELECT MAX(LS1.SEQ_NO) FROM SHSHARESTATEMENT LS1 WHERE LS1.SHRITEMTYPE_CODE = 'SPX' AND LS1.ITEM_STATUS = 1 AND LS1.MEMBER_NO = LS.MEMBER_NO)";
		$value4 = ('C3');
		$c3 = get_single_value_oci($strSQL4,$value4);
	
	if($c2 > $c3){
		
		$s = $c2;
		
	}else if ($c2 < $c3){
		
		$s = $c3;
	}else{
		
		$s = $c2;
	}
	
	
	
	if($s > $c1){
		
		$slip_date = $s;
		
	}else{
		
		$slip_date = $c1;
	}
	
		//$slip_date = $c1;
		$show_month = show_month($slip_date);
	}else{
		$slip_date = $_REQUEST["slip_date"];
		$show_month = show_month($slip_date);
	}


	/*$strSQL = "SELECT * FROM (     
						SELECT 
							KPD.KPSLIP_NO AS A0,
							KUK.KEEPITEMTYPE_GRP AS A1,
							KUK.KEEPITEMTYPE_DESC AS A2,
							KPD.LOANCONTRACT_NO AS A3,
							to_char(DECODE(KPD.PERIOD,0,null,KPD.PERIOD),'9G999G999') AS A8,
							KPD.DESCRIPTION AS A4,
							to_char(DECODE(KPD.PRINCIPAL_PAYMENT,0,null,KPD.PRINCIPAL_PAYMENT),'99G999G999G999D00') AS A5,
							to_char(DECODE(KPD.INTEREST_PAYMENT,0,null,KPD.INTEREST_PAYMENT),'99G999G999G999D00') AS A6,
							to_char(DECODE(KPD.ITEM_PAYMENT * KUK.SIGN_FLAG,0,null,KPD.ITEM_PAYMENT * KUK.SIGN_FLAG),'99G999G999G999D00') AS A7,
							to_char(DECODE(KPD.ITEM_BALANCE,0,null,KPD.ITEM_BALANCE),'99G999G999G999D00') AS A9,
							(TO_DATE(KPD.CALINTTO_DATE,'DD/MM/YYYY') - TO_DATE(KPD.CALINTFROM_DATE,'DD/MM/YYYY')) AS A10, 
							TO_CHAR(KPD.POSTING_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') AS A11,
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
							to_char(DECODE(KMD.PERIOD,0,null,KMD.PERIOD),'9G999G999') AS A8,
							KMD.DESCRIPTION AS A4,
							to_char(DECODE(KMD.PRINCIPAL_PAYMENT,0,null,KMD.PRINCIPAL_PAYMENT),'99G999G999G999D00') AS A5,
							to_char(DECODE(KMD.INTEREST_PAYMENT,0,null,KMD.INTEREST_PAYMENT),'99G999G999G999D00') AS A6,
							to_char(DECODE(KMD.ITEM_PAYMENT * KUK.SIGN_FLAG,0,null,KMD.ITEM_PAYMENT * KUK.SIGN_FLAG),'99G999G999G999D00') AS A7,
							to_char(DECODE(KMD.ITEM_BALANCE,0,null,KMD.ITEM_BALANCE),'99G999G999G999D00') AS A9,
							(TO_DATE(KMD.CALINTTO_DATE,'DD/MM/YYYY')-TO_DATE(KMD.CALINTFROM_DATE,'DD/MM/YYYY')) AS A10, 
							TO_CHAR(KMD.POSTING_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') AS  A11,
							KMD.SEQ_NO AS SEQ
						FROM 
							KPMASTRECEIVEDET KMD, KPUCFKEEPITEMTYPE KUK
						WHERE 
							KMD.KEEPITEMTYPE_CODE = KUK.KEEPITEMTYPE_CODE
							AND KMD.MEMBER_NO = '$member_no'
							AND KMD.RECV_PERIOD = '$slip_date'
					) ORDER BY SEQ ";*/
					
					$strSQL = " 
						
						SELECT 
							KMD.KPSLIP_NO AS A0,
							KUK.KEEPITEMTYPE_GRP AS A1,
							KUK.KEEPITEMTYPE_DESC AS A2,
							KMD.LOANCONTRACT_NO AS A3,
							to_char(DECODE(KMD.PERIOD,0,null,KMD.PERIOD),'9G999G999') AS A8,
							KMD.DESCRIPTION AS A4,
							to_char(DECODE(KMD.PRINCIPAL_PAYMENT,0,null,KMD.PRINCIPAL_PAYMENT),'99G999G999G999D00') AS A5,
							to_char(DECODE(KMD.INTEREST_PAYMENT,0,null,KMD.INTEREST_PAYMENT),'99G999G999G999D00') AS A6,
							to_char(DECODE(KMD.ITEM_PAYMENT * KUK.SIGN_FLAG,0,null,KMD.ITEM_PAYMENT * KUK.SIGN_FLAG),'99G999G999G999D00') AS A7,
							to_char(DECODE(KMD.ITEM_BALANCE,0,null,KMD.ITEM_BALANCE),'99G999G999G999D00') AS A9,
							(TO_DATE(KMD.CALINTTO_DATE,'DD/MM/YYYY')-TO_DATE(KMD.CALINTFROM_DATE,'DD/MM/YYYY')) AS A10, 
							TO_CHAR(K.RECEIPT_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') AS  A11,
							KMD.SEQ_NO AS SEQ,
                               L.PERIOD_PAYAMT AS PERIOD_PAYMENT,
						K.RECEIPT_NO
						FROM 
							KPMASTRECEIVEDET KMD, KPUCFKEEPITEMTYPE KUK , LNCONTMASTER L , KPMASTRECEIVE K
						WHERE 
							KMD.KEEPITEMTYPE_CODE = KUK.KEEPITEMTYPE_CODE(+) and KMD.KPSLIP_NO = K.KPSLIP_NO(+)
                                AND TRIM(KMD.LOANCONTRACT_NO) = TRIM(L.LOANCONTRACT_NO(+))
							AND KMD.MEMBER_NO = '$member_no'
							AND KMD.RECV_PERIOD = '$slip_date' AND KMD.KEEPITEM_STATUS = 1 ORDER BY to_number(KMD.SHRLONTYPE_CODE)
					 ";
					
	$value = array('A0','A1','A2','A3','A4','A5','A6','A7','A8','A9','A10','A11','SEQ','PERIOD_PAYMENT','RECEIPT_NO');		
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
		$seq_no[$i]		 		= $slip_show[$i][$j++];
		$period_payamt[$i]	= $slip_show[$i][$j++];
		$receipt_no[$i]	= $slip_show[$i][$j++];
	
		$j=0;
		$totalpayment 		= $totalpayment + str_replace( ',','', $slip_pay[$i] );		
	}	
	
	$strSQL2 = " 
	SELECT L.LOANTYPE_CODE,L.PREFIX || ' หมายถึง ' || L.LOANTYPE_DESC as LOANTYPE_DESC
	FROM KPMASTRECEIVEDET K , LNLOANTYPE L
	WHERE K.SHRLONTYPE_CODE = L.LOANTYPE_CODE(+)   
	AND K.MEMBER_NO = '$member_no' 
	AND K.RECV_PERIOD = '$slip_date'
	AND K.KEEPITEMTYPE_CODE LIKE '%L%' AND K.KEEPITEM_STATUS = 1 ORDER BY L.LOANTYPE_CODE
					 ";
					
	$value2 = array('LOANTYPE_DESC');		
	list($Num_Rows2,$slip_show2) = get_value_many_oci($strSQL2,$value2);	
	$a=0;
	for($b=0;$b<$Num_Rows2;$b++){ 
		 $loantype_desc[$b] = $slip_show2[$b][$a++];   					
		$a=0;
	}	
	
                  $strSQL4 = " 
	SELECT DISTINCT LC.LOANCONTRACT_NO , L.PREFIX || ' หมายถึง ' || L.LOANTYPE_DESC as LOANTYPE_DESC
								FROM LNCONTMASTER LM , LNCONTCOLL LC , LNUCFLOANCOLLTYPE CT ,  LNLOANTYPE L
								WHERE (LM.LOANCONTRACT_NO = LC.LOANCONTRACT_NO)
								AND (CT.LOANCOLLTYPE_CODE = LC.LOANCOLLTYPE_CODE) AND LM.LOANTYPE_CODE = L.LOANTYPE_CODE(+) 
								AND (LM.CONTRACT_STATUS > 0) AND LC.COLL_STATUS > 0
								AND (LM.MEMBER_NO = '$member_no')
								ORDER BY LC.LOANCONTRACT_NO
					 ";
					
	$value4 = array('LOANCONTRACT_NO','LOANTYPE_DESC');		
	list($Num_Rows4,$slip_show4) = get_value_many_oci($strSQL4,$value4);	
	$e=0;
	for($f=0;$f<$Num_Rows4;$f++){ 
		$loancontractno[$f] = $slip_show4[$f][$e++];   	
                                    $loantype_desc1[$f] = $slip_show4[$f][$e++];    				
		$e=0;
	}

	$strSQL3 = " 
	SELECT COUNT(K.KEEPITEMTYPE_CODE) as C_KEEP 
FROM KPMASTRECEIVEDET K 
where  K.MEMBER_NO = '$member_no' 
and K.RECV_PERIOD = '$slip_date'
and K.KEEPITEMTYPE_CODE like '%D%'
					 ";
					
	$value3 = array('C_KEEP');		
	list($Num_Rows3,$slip_show3) = get_value_many_oci($strSQL3,$value3);	
	$c=0;
	for($d=0;$d<$Num_Rows3;$d++){ 
		$c_keep[$d] = $slip_show3[$d][$c++];   					
		$c=0;
	}

	 $slip_date_lpx = $slip_date - 54300;
	
	   $strSQL4 = " 
				SELECT * FROM (
		SELECT distinct 
			LM.REF_DOCNO,TO_CHAR(LM.SLIP_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') AS A88
			FROM 
			LNCONTMASTER L, LNCONTSTATEMENT LM
			WHERE 
			L.LOANCONTRACT_NO = LM.LOANCONTRACT_NO
			AND L.MEMBER_NO = '$member_no' 
			AND TO_CHAR(LM.SLIP_DATE,'YYYYMM') BETWEEN '$slip_date_lpx' AND '$slip_date_lpx' 
			AND LM.LOANITEMTYPE_CODE = 'LPX' AND LM.ITEM_STATUS = 1
		UNION
		SELECT distinct
			SH.REF_DOCNO,TO_CHAR(SH.SLIP_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') AS A88
			FROM 
			SHSHARESTATEMENT SH
			WHERE 
			SH.MEMBER_NO = '$member_no' 
			AND TO_CHAR(SH.SLIP_DATE,'YYYYMM') BETWEEN '$slip_date_lpx' AND '$slip_date_lpx' 
			AND SH.SHRITEMTYPE_CODE = 'SPX' AND SH.ITEM_STATUS = 1
		) ORDER BY REF_DOCNO";
					
	$value4 = array('REF_DOCNO','A88');		
	list($Num_Rows4,$slip_show4) = get_value_many_oci($strSQL4,$value4);	
	$w=0;
	for($u=0;$u<$Num_Rows4;$u++){ 
		
		$ref_docno[$u] = $slip_show4[$u][$w++];		
		$show_date[$u] = $slip_show4[$u][$w++];	
		$w=0;
	}		
	
	
	
	
	
			
	
	
	$strSQL_SH = "SELECT 
							
							to_char(DECODE(KMD.ITEM_BALANCE,0,null,KMD.ITEM_BALANCE),'99G999G999G999D00') AS SHARE_NOW
							
						FROM 
							KPMASTRECEIVEDET KMD, KPUCFKEEPITEMTYPE KUK
						WHERE 
							KMD.KEEPITEMTYPE_CODE = KUK.KEEPITEMTYPE_CODE
							AND KMD.MEMBER_NO = '$member_no'
							AND KMD.RECV_PERIOD = '$slip_date' AND KUK.KEEPITEMTYPE_GRP = 'SHR'";
$value_SH = 'SHARE_NOW';
$share_now = get_single_value_oci($strSQL_SH,$value_SH);
	
	
	$strSQL1 = "SELECT 
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
	}
	
?>

