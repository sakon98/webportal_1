<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
	$strSQL = "SELECT MAX(RECV_PERIOD) AS MAXSLIP FROM KPTEMPRECEIVEDET WHERE MEMBER_NO = '$member_no'";
	$value = ('MAXSLIP');
	$listslip = get_single_value_oci($strSQL,$value);
	$thisshow = Show_Slip(date('d-m-Y'));
	
             /* if($listslip != $thisshow){

		$listslip = $listslip-1;
	}*/
		
	list($slip,$slip_m,$slip_s,$slipsum) =show_list($listslip,18,$member_no);
			
	if($_REQUEST["slip_date"] == ""){
		$slip_date = Show_Slip(date('d-m-Y'));
		$day = date("d");
		
		//if($day ){
		
		$show_month = show_month($slip_date);
		
		//}else{
		
		//$show_month = show_month($slip_date);
		
		//}
		$slip_date = $listslip;
	}else{
		$slip_date = $_REQUEST["slip_date"];
		$show_month = show_month($slip_date);
	}


	$strSQL = "SELECT * FROM (     
						SELECT 
							KPD.KPSLIP_NO AS A0,
							KUK.KEEPITEMTYPE_GRP AS A1,
							KUK.KEEPITEMTYPE_DESC AS A2,
							KPD.LOANCONTRACT_NO AS A3,
							KPD.DESCRIPTION AS A4,
							to_char(DECODE(KPD.PRINCIPAL_PAYMENT,0,null,KPD.PRINCIPAL_PAYMENT),'99G999G999G999D00') AS A5,
							to_char(DECODE(KPD.INTEREST_PAYMENT,0,null,KPD.INTEREST_PAYMENT),'99G999G999G999D00') AS A6,
							to_char(DECODE(KPD.ITEM_PAYMENT * KUK.SIGN_FLAG,0,null,KPD.ITEM_PAYMENT * KUK.SIGN_FLAG),'99G999G999G999D00') AS A7,
							to_char(DECODE(KPD.PERIOD,0,null,KPD.PERIOD),'9G999G999') AS A8,
							to_char(DECODE(KPD.ITEM_BALANCE,0,null,KPD.ITEM_BALANCE),'99G999G999G999D00') AS A9,
							(TO_DATE(KPD.CALINTTO_DATE,'DD/MM/YYYY') - TO_DATE(KPD.CALINTFROM_DATE,'DD/MM/YYYY')) AS A10, 
							TO_CHAR(KPT.RECEIPT_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') AS A11,
							to_char((KPT.INTEREST_ACCUM + (SELECT SUM(KPTEMPRECEIVEDET.INTEREST_PAYMENT) FROM KPTEMPRECEIVEDET WHERE KPTEMPRECEIVEDET.MEMBER_NO = '$member_no' AND KPTEMPRECEIVEDET.RECV_PERIOD = '$slip_date' AND KPTEMPRECEIVEDET.KEEPITEMTYPE_CODE LIKE 'L%')),'99G999G999G999D00') AS A12,
							to_char((KPT.SHARESTK_VALUE + (SELECT SUM(KPTEMPRECEIVEDET.ITEM_PAYMENT) FROM KPTEMPRECEIVEDET WHERE KPTEMPRECEIVEDET.MEMBER_NO = '$member_no' AND KPTEMPRECEIVEDET.RECV_PERIOD = '$slip_date' AND KPTEMPRECEIVEDET.KEEPITEMTYPE_CODE LIKE 'S%')),'99G999G999G999D00') AS A13,
							(SELECT LNT.LOANTYPE_DESC FROM LNLOANTYPE LNT WHERE LNT.LOANTYPE_CODE =  KPD.SHRLONTYPE_CODE) AS A14,
							KPD.KEEPITEMTYPE_CODE AS SEQ,
							KPD.SHRLONTYPE_CODE as SHRLONTYPE_CODE
						FROM 
							KPTEMPRECEIVE KPT,KPTEMPRECEIVEDET KPD, KPUCFKEEPITEMTYPE KUK
						WHERE KPT.KPSLIP_NO = KPD.KPSLIP_NO
							AND KPD.KEEPITEMTYPE_CODE = KUK.KEEPITEMTYPE_CODE
							AND KPD.MEMBER_NO = '$member_no'
							AND KPD.RECV_PERIOD = '$slip_date'
							AND KPD.POSTING_STATUS = 0 AND KPD.KEEPITEM_STATUS = 1
					UNION
						SELECT 
							KMD.KPSLIP_NO AS A0,
							KUK.KEEPITEMTYPE_GRP AS A1,
							KUK.KEEPITEMTYPE_DESC AS A2,
							KMD.LOANCONTRACT_NO AS A3,
							KMD.DESCRIPTION AS A4,
							to_char(DECODE(KMD.PRINCIPAL_PAYMENT,0,null,KMD.PRINCIPAL_PAYMENT),'99G999G999G999D00') AS A5,
							to_char(DECODE(KMD.INTEREST_PAYMENT,0,null,KMD.INTEREST_PAYMENT),'99G999G999G999D00') AS A6,
							to_char(DECODE(KMD.ITEM_PAYMENT * KUK.SIGN_FLAG,0,null,KMD.ITEM_PAYMENT * KUK.SIGN_FLAG),'99G999G999G999D00') AS A7,
							to_char(DECODE(KMD.PERIOD,0,null,KMD.PERIOD),'9G999G999') AS A8,
							to_char(DECODE(KMD.ITEM_BALANCE,0,null,KMD.ITEM_BALANCE),'99G999G999G999D00') AS A9,
							(TO_DATE(KMD.CALINTTO_DATE,'DD/MM/YYYY')-TO_DATE(KMD.CALINTFROM_DATE,'DD/MM/YYYY')) AS A10, 
							TO_CHAR(KPM.RECEIPT_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') AS A11,
							to_char((KPM.INTEREST_ACCUM + (SELECT SUM(KPMASTRECEIVEDET.INTEREST_PAYMENT) FROM KPMASTRECEIVEDET WHERE KPMASTRECEIVEDET.MEMBER_NO = '$member_no' AND KPMASTRECEIVEDET.RECV_PERIOD = '$slip_date' AND KPMASTRECEIVEDET.KEEPITEMTYPE_CODE LIKE 'L%')),'99G999G999G999D00') AS A12,
							to_char((KPM.SHARESTK_VALUE + (SELECT SUM(KPMASTRECEIVEDET.ITEM_PAYMENT) FROM KPMASTRECEIVEDET WHERE KPMASTRECEIVEDET.MEMBER_NO = '$member_no' AND KPMASTRECEIVEDET.RECV_PERIOD = '$slip_date' AND KPMASTRECEIVEDET.KEEPITEMTYPE_CODE LIKE 'S%')),'99G999G999G999D00') AS A13,
							(SELECT LNT.LOANTYPE_DESC FROM LNLOANTYPE LNT WHERE LNT.LOANTYPE_CODE =  KMD.SHRLONTYPE_CODE) AS A14,
							KMD.KEEPITEMTYPE_CODE AS SEQ,
							KMD.SHRLONTYPE_CODE as SHRLONTYPE_CODE
						FROM 
							KPMASTRECEIVE KPM,KPMASTRECEIVEDET KMD, KPUCFKEEPITEMTYPE KUK
						WHERE KPM.KPSLIP_NO = KMD.KPSLIP_NO
							AND KMD.KEEPITEMTYPE_CODE = KUK.KEEPITEMTYPE_CODE
							AND KMD.MEMBER_NO = '$member_no'
							AND KMD.RECV_PERIOD = '$slip_date' AND KMD.KEEPITEM_STATUS = 1
					) ORDER BY CASE WHEN SEQ = 'S01' THEN 'L00' ELSE SEQ END,SHRLONTYPE_CODE ASC ";
	$value = array('A0','A1','A2','A3','A4','A5','A6','A7','A8','A9','A10','A11','A12','A13','A14');		
	list($Num_Rows,$slip_show) = get_value_many_oci($strSQL,$value);	
	$totalpayment = 0;
	$j=0;
	for($i=0;$i<$Num_Rows;$i++){ 
		$slip_no 				= $slip_show[$i][$j++];   				
		$slip_itemtype[$i] 		= $slip_show[$i][$j++];			
		$slip_itemdesc[$i]		= $slip_show[$i][$j++];
		$slip_loanno[$i] 		= $slip_show[$i][$j++];
		$slip_desc[$i] 			= $slip_show[$i][$j++];
		$slip_principal[$i]		= $slip_show[$i][$j++];
		$slip_interest[$i] 		= $slip_show[$i][$j++];
		$slip_pay[$i] 			= $slip_show[$i][$j++];
		$period[$i]				= $slip_show[$i][$j++];
		$itembalance[$i] 		= $slip_show[$i][$j++];
		$rate_day[$i] 			= $slip_show[$i][$j++];
		$slipdate		 		= $slip_show[$i][$j++];
		$slip_accum_interest	= $slip_show[$i][$j++];
		$slip_accum_share[$i]	= $slip_show[$i][$j++];
		$slip_loan_desc[$i]		= $slip_show[$i][$j++];
		$j=0;
		$totalpayment 		= $totalpayment + str_replace( ',','', $slip_pay[$i] );		
	}	
	
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
		$moneytype_code		= $slip_show1[$n][$m++];   
		$expense_accid		= $slip_show1[$n][$m++];   
		$item_payment		= $slip_show1[$n][$m++];   
		$m=0;
		$payment_a = str_replace( ',','',$item_payment);
	}
	$strSQL2 = "select * from (
					select 'ค้ำเงินกู้ ส_ ให้ : ' as A1, 
					listagg(lncontmaster.member_no , ',' ) within group (order by lncontmaster.member_no) as A2,
					lncontmaster.loantype_code as A3
					from lncontcoll 
					left join lncontmaster on lncontcoll.loancontract_no = lncontmaster.loancontract_no
					where lncontmaster.contract_status = 1 and lncontmaster.loantype_code = '11'  and lncontcoll.ref_collno = '$member_no' 
					group by lncontmaster.loantype_code 
				union
					select 'ค้ำเงินกู้ กพ ให้ : ' as A1, 
					listagg(lncontmaster.member_no , ',' ) within group (order by lncontmaster.member_no) as A2,
					lncontmaster.loantype_code as A3
					from lncontcoll 
					left join lncontmaster on lncontcoll.loancontract_no = lncontmaster.loancontract_no
					where lncontmaster.contract_status = 1 and lncontmaster.loantype_code = '13'  and lncontcoll.ref_collno = '$member_no' 
					group by lncontmaster.loantype_code 
				)order by A3 asc";
	$value2 = array('A1','A2','A3');		
	list($Num_Rows2,$slip_show2) = get_value_many_oci($strSQL2,$value2);
	for($i=0;$i<$Num_Rows2;$i++){ 
		$coll_desc[$i] 				= $slip_show2[$i][$j++];   				
		$coll_member_no[$i] 		= $slip_show2[$i][$j++];			
		$j=0;	
	}
?>

