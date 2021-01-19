<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
	$strSQL = "SELECT MAX(RECV_PERIOD) AS MAXSLIP FROM KPTEMPRECEIVEDET WHERE MEMBER_NO = '$member_no'";
	$value = ('MAXSLIP');
	$listslip = get_single_value_oci($strSQL,$value);
	$thisshow = Show_Slip(date('d-m-Y'));
	
	if($listslip != $thisshow){
		$listslip = $listslip-1;
	}
		
	list($slip,$slip_m,$slip_s,$slipsum) =show_list($listslip,6,$member_no);
			
	if($_REQUEST["slip_date"] == ""){
		$strSQL_C1 = "SELECT MAX(RECV_PERIOD) AS C1 FROM KPTEMPRECEIVEDET WHERE MEMBER_NO = '$member_no'";
		$value_c1 = ('C1');
		$c1 = get_single_value_oci($strSQL_C1,$value_c1);
	
		//$slip_date = Show_Slip(date('d-m-Y'));
		$slip_date = $c1;
		$show_month = show_month($slip_date);
	}else{
		$slip_date = $_REQUEST["slip_date"];
		$show_month = show_month($slip_date);
	}
	// get_slip
	$strSQL_get_slip = "SELECT RECEIPT_NO AS RECEIPT_NO FROM KPTEMPRECEIVE   WHERE  MEMBER_NO = '$member_no' AND RECV_PERIOD = '$slip_date'";
	$value_get_slip = ('RECEIPT_NO');
	$RECEIPT_NO = get_single_value_oci($strSQL_get_slip,$value_get_slip);
	// echo $member_no." ".$slip_date." ".$RECEIPT_NO;


	$strSQL = "select
					kptempreceive.kpslip_no,
					kptempreceive.receipt_no as A0,
					kpucfkeepitemtype.keepitemtype_grp as A1,
					kpucfkeepitemtype.keepitemtype_desc as A2,
					kptempreceivedet.loancontract_no as A3, 
					kptempreceivedet.description as A4,   
					decode(kpucfkeepitemtype.keepitemtype_grp,'LON', kptempreceivedet.principal_payment - kptempreceivedet.adjust_prnamt, kptempreceivedet.principal_payment) as A5,
					decode(kpucfkeepitemtype.keepitemtype_grp,'LON', kptempreceivedet.interest_payment - kptempreceivedet.adjust_intamt,kptempreceivedet.interest_payment) as A6,
					kptempreceivedet.shrlontype_code,   
  
					decode(kpucfkeepitemtype.keepitemtype_grp,'SHR', kptempreceivedet.item_balance - kptempreceivedet.adjust_prnamt,kptempreceivedet.item_balance + kptempreceivedet.adjust_prnamt) as A9,   
					kptempreceivedet.seq_no,   
					kpucfkeepitemtype.sort_in_receive,
					kptempreceivedet.period as A8,   
					kptempreceivedet.bflastcalint_date,   

					kptempreceivedet.calintfrom_date,   
					kptempreceivedet.calintto_date,
					kpucfkeepitemtype.sign_flag,
					decode(kpucfkeepitemtype.keepitemtype_grp,'LON', 
					( kptempreceivedet.principal_payment - kptempreceivedet.adjust_prnamt) + (kptempreceivedet.interest_payment - kptempreceivedet.adjust_intamt),
					decode(kpucfkeepitemtype.keepitemtype_grp,'SHR', ( kptempreceivedet.item_payment - kptempreceivedet.adjust_prnamt),decode(kpucfkeepitemtype.keepitemtype_grp,'dep',( kptempreceivedet.item_payment - kptempreceivedet.adjust_prnamt) ,kptempreceivedet.item_payment))) as A7,


					kptempreceivedet.keepitemtype_code,   
					kptempreceivedet.member_no,
					kptempreceivedet.adjust_prnamt,
					kptempreceivedet.adjust_intamt,
					kptempreceivedet.adjust_itemamt,
					case when kptempreceivedet.keepitemtype_code in ('W01','W02','W03')    then
						nvl((select b.item_adjamt from slslipadjust a,slslipadjustdet b where  a.adjslip_no = b.adjslip_no and a.ref_slipno = kptempreceivedet.kpslip_no and b.slipitemtype_code = kptempreceivedet.keepitemtype_code),0)
					else
						0
					end as adjust_wf,
					TO_CHAR(kptempreceive.receipt_date, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') as a10
				from    kptempreceive,
				kptempreceivedet,
				kpucfkeepitemtype,
				kpmastreceivedet
				where   
					( kptempreceive.kpslip_no = kptempreceivedet.kpslip_no ) and  
					( kptempreceivedet.coop_id = kpucfkeepitemtype.coop_id(+) ) and  
					( kptempreceivedet.keepitemtype_code = kpucfkeepitemtype.keepitemtype_code(+) ) and  
					( kptempreceivedet.kpslip_no =  kpmastreceivedet.kpslip_no(+) ) and 
					( kptempreceivedet.seq_no =  kpmastreceivedet.seq_no(+) ) and 
					( kptempreceivedet.keepitemtype_code =  kpmastreceivedet.keepitemtype_code(+) ) and
					( kptempreceive.receipt_no = '$RECEIPT_NO' ) and  
					( kptempreceivedet.coop_id = '041001' ) and
					( kptempreceive.member_no = '$member_no') and 
					( kptempreceivedet.keepitem_status = 1 ) 
				group by 
					kptempreceive.kpslip_no,
					kptempreceivedet.shrlontype_code,   
					kptempreceivedet.loancontract_no,   
					kptempreceivedet.item_balance,   
					kptempreceivedet.seq_no,   
					kpucfkeepitemtype.sort_in_receive,
					kptempreceivedet.period,   
					kptempreceivedet.bflastcalint_date,   
					kptempreceivedet.principal_payment,   
					kptempreceivedet.calintfrom_date,   
					kptempreceivedet.calintto_date,   
					kptempreceivedet.item_payment,   
					kptempreceivedet.interest_payment,   
					kptempreceivedet.keepitemtype_code,   
					kptempreceivedet.description,   
					kpucfkeepitemtype.keepitemtype_grp,
					kpucfkeepitemtype.keepitemtype_desc,
					kptempreceivedet.member_no,
					kpmastreceivedet.adjust_prnamt,
					kpmastreceivedet.adjust_intamt,
					kpmastreceivedet.adjust_itemamt,
					kptempreceivedet.kpslip_no,
					kpucfkeepitemtype.sign_flag,
					kptempreceive.receipt_date,
					kptempreceive.receipt_no
				order by kptempreceivedet.seq_no";
	$value = array('A0','A1','A2','A3','A4','A5','A6','A7','A8','A9','A10');
	list($Num_Rows,$slip_show) = get_value_many_oci($strSQL,$value);
	if($Num_Rows == 0){
		$strSQL = "select  
					kptempreceive.receipt_no as A0,
					kpucfkeepitemtype.keepitemtype_grp as A1,
					kpucfkeepitemtype.keepitemtype_desc as A2,
					kptempreceivedet.loancontract_no as A3,
					kptempreceivedet.member_no ,
					kptempreceivedet.recv_period , 
					kptempreceivedet.keepitemtype_code ,
					kptempreceivedet.description as A4,
					kptempreceivedet.period as A8,
					kptempreceivedet.principal_payment as A5,
					kptempreceivedet.interest_payment as A6,
					kptempreceivedet.item_payment as A7,
					kptempreceive.keeping_status ,
					kptempreceivedet.keepitem_status ,
					kptempreceivedet.ref_membno ,
					kptempreceive.member_no ,
					kpucfkeepitemtype.sort_in_receive ,
					kptempreceivedet.item_balance as A9,
					kptempreceivedet.shrlontype_code ,
					kpucfkeepitemtype.sign_flag ,
					TO_CHAR(kptempreceive.receipt_date, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') as a10			
				from 
					kptempreceive ,
					kptempreceivedet ,
					kpucfkeepitemtype
				where  
					( KPTEMPRECEIVE.coop_id = KPTEMPRECEIVEDET.coop_id ) and
					( KPTEMPRECEIVE.kpslip_no = KPTEMPRECEIVEDET.kpslip_no ) and
					( KPTEMPRECEIVEDET.KEEPITEMTYPE_CODE = KPUCFKEEPITEMTYPE.KEEPITEMTYPE_CODE ) and
					( kptempreceive.member_no = '$member_no' ) and
					( kptempreceive.recv_period = '$slip_date') and
					( kptempreceivedet.keepitemtype_code <> 'ETN' )
				order by 
					kptempreceivedet.member_no,
					kptempreceivedet.recv_period,
					kptempreceivedet.ref_membno,
					kpucfkeepitemtype.sort_in_receive,
					kptempreceivedet.keepitemtype_code";
			$value = array('A0','A1','A2','A3','A4','A5','A6','A7','A8','A9','A10');
			list($Num_Rows,$slip_show) = get_value_many_oci($strSQL,$value);
		
	}
	$totalpayment = 0;
	$j=0;
	for($i=0;$i<$Num_Rows;$i++){ 
		$slip_no[$i] 			= $slip_show[$i][$j++];   	//0				
		$slip_itemtype[$i] 		= $slip_show[$i][$j++];		//1			
		$slip_itemdesc[$i]		= $slip_show[$i][$j++];		//2
		$slip_loanno[$i] 		= $slip_show[$i][$j++];		//3
		$slip_desc[$i] 			= $slip_show[$i][$j++];		//4
		$slip_principal[$i]		= $slip_show[$i][$j++];		//5
		$slip_interest[$i] 		= $slip_show[$i][$j++];		//6
		$slip_pay[$i] 			= $slip_show[$i][$j++];		//7
		$period[$i]				= $slip_show[$i][$j++];		//8
		$itembalance[$i] 		= $slip_show[$i][$j++];		//9
		$receipt_date		 	= $slip_show[$i][$j++];		//10
		$j=0;
		$totalpayment 		= $totalpayment + str_replace( ',','', $slip_pay[$i] );		
	}	
		
?>

