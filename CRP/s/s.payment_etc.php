<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
	$strSQL = "SELECT MAX(RECV_PERIOD) AS MAXSLIP FROM KPRCVKEEPOTHER WHERE MEMBER_NO = '$member_no'";  
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


	$strSQL = " select 

		('ชำระศพที่ ' ||wcrecievemonthdetail.die_no || ' '|| mbucfprename.prename_desc ||wcdeptmaster.deptaccount_name ||'  ' ||wcdeptmaster.deptaccount_sname ) as KEEPOTHITEMTYPE_DESC ,  
		sum(wcrecievemonthdetail.carcass_amt)  as ITEM_PAYMENT
		, kptempreceive.kpslip_no as KPSLIP_NO
		, TO_CHAR(kptempreceive.receipt_date, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') as RECEIPT_DATE  
		from  wcrecievemonthdetail left join  wcrecievemonth on wcrecievemonthdetail.recv_period = wcrecievemonth.recv_period
		and wcrecievemonthdetail.member_no = wcrecievemonth.member_no and  wcrecievemonthdetail.wfmember_no = wcrecievemonth.wfmember_no
		left join wcdeptmaster on wcrecievemonthdetail.die_accno = wcdeptmaster.deptaccount_no 
		left join mbucfprename on mbucfprename.prename_code  = wcdeptmaster.prename_code  
		left join kptempreceive on  kptempreceive.recv_period = wcrecievemonth.recv_period and kptempreceive.member_no = wcrecievemonthdetail.member_no
		where wcrecievemonthdetail.recv_period = '$slip_date' and
		wcrecievemonthdetail.member_no =  '$member_no' and 
		wcrecievemonthdetail.cash_type = 'WFA'
		and wcrecievemonthdetail.status_post <> -9
		group by wcrecievemonthdetail.die_no , mbucfprename.prename_desc
		, wcdeptmaster.deptaccount_name , wcdeptmaster.deptaccount_sname ,  kptempreceive.kpslip_no ,  kptempreceive.receipt_date
		UNION  
		select 
		'ค่าบำรุงรายปี' as  KEEPOTHITEMTYPE_DESC , 
		sum(ins_amt)   as ITEM_PAYMENT 
		,kptempreceive.KPSLIP_NO as KPSLIP_NO
		, TO_CHAR(kptempreceive.receipt_date, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') as RECEIPT_DATE 
		from 
		wcrecievemonth left join  kptempreceive on    kptempreceive.recv_period = wcrecievemonth.recv_period and kptempreceive.member_no = wcrecievemonth.member_no
		where 
		wcrecievemonth.recv_period =  '$slip_date' 
		and wcrecievemonth.cash_type = 'WFA'
		and wcrecievemonth.status_post <> -9
		and wcrecievemonth.member_no =  '$member_no'
		group by kptempreceive.kpslip_no ,  kptempreceive.receipt_date
		having sum( wcrecievemonth.ins_amt) > 0 ";
	$value = array('KEEPOTHITEMTYPE_DESC','ITEM_PAYMENT','KPSLIP_NO','RECEIPT_DATE');		
	list($Num_Rows,$slip_show) = get_value_many_oci($strSQL,$value);	
	$totalpayment_etc = 0;
	$j=0;
	for($i=0;$i<$Num_Rows;$i++){ 
		$keepothitemtype_desc[$i] 				= $slip_show[$i][$j++];   				
		$item_payment[$i] 		= $slip_show[$i][$j++];	
	    $kpslip_no 		= $slip_show[$i][$j++];
        $receipt_date 		= $slip_show[$i][$j++];		
		$j=0;
		$totalpayment 		= $totalpayment + str_replace( ',','', $item_payment[$i] );		
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
	
	$strSQL4 = "SELECT wc.seq_no AS A1,
					ws.deptaccount_no AS A2,
					trim(wc.transferee_name) AS A3,
					gn.gain_concern AS A4
				FROM wccodeposit wc
				INNER JOIN wcdeptmaster ws ON wc.deptaccount_no = ws.deptaccount_no
				LEFT JOIN mbucfgainconcern gn ON gn.concern_code = wc.transferee_relation
				WHERE wftype_code = '01'
				AND ws.member_no = '$member_no' AND ws.deptclose_status = 0";
	$value4 = array('A1','A2','A3','A4');		
	list($Num_Rows4,$slip_show2) = get_value_many_oci($strSQL4,$value4);
	for($i=0;$i<$Num_Rows4;$i++){ 
		$seq_no[$i] 				= $slip_show2[$i][$j++];   				
		$deptaccount_no[$i] 		= $slip_show2[$i][$j++];
		$transferee_name[$i] 		= $slip_show2[$i][$j++];
		$gain_concern[$i] 			= $slip_show2[$i][$j++];
		$j=0;
		$coll[$i]					= $i+1 .'. '.$transferee_name[$i];
	}
?>

