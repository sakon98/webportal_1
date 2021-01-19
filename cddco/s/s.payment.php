<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
        $date = date("Y-m-d");
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        //$day = 15;
        //$month = 02;
          
        if($day >= 15){
           
            $strSQL = "SELECT MAX(RECV_PERIOD) AS MAXSLIP FROM KPTEMPRECEIVEDET WHERE MEMBER_NO = '$member_no' ";
	$value = ('MAXSLIP');
        $listslip = get_single_value_oci($strSQL,$value);
        $listslip = $listslip ; //////
        $thisshow = Show_Slip(date('d-m-Y'));
		
	
	if($listslip != $thisshow){
		$listslip = $listslip-1;
	}
		
     list($slip,$slip_m,$slip_s,$slipsum) =show_list($listslip,33,$member_no);
			
	if($_REQUEST["slip_date"] == ""){
                $slip_date = Show_Slip(date('d-m-Y')); 
                $slip_date = $slip_date ;/////
                $show_month = show_month($slip_date);
                $max_chack = $listslip+1;
                
	}else{
		$slip_date = $_REQUEST["slip_date"]; 
                $max_chack = $slip_date;
                $slip_date = $slip_date ;
		$show_month = show_month($slip_date);
                
                
	} 
       } else {
           
        $strSQL = "SELECT MAX(RECV_PERIOD) AS MAXSLIP FROM KPTEMPRECEIVEDET WHERE MEMBER_NO = '$member_no' ";
	$value = ('MAXSLIP');
        $listslip = get_single_value_oci($strSQL,$value);
        $listslip = $listslip - 1 ; //////
        $thisshow = Show_Slip(date('d-m-Y'));
	
	if($listslip != $thisshow){
		$listslip = $listslip-1;
	}
		
     list($slip,$slip_m,$slip_s,$slipsum) =show_list($listslip,33,$member_no);
     
     //echo $slip[0];
			
	if($_REQUEST["slip_date"] == ""){
                $slip_date = Show_Slip(date('d-m-Y'));
                $slip_date = $slip_date - 1 ;/////
                if(substr($slip_date,4,2) == 00){
                   $slip_date = substr($slip_date,0,4) - 1 . 12;
				   //echo '1';
                }else{
                   $slip_date = $slip_date;
				  // echo '2';
				   //echo $slip_date;
                }
                $show_month = show_month($slip_date);
				//echo $show_month;
                $max_chack = $listslip+1;
                
	}else{
		$slip_date = $_REQUEST["slip_date"]; 
                $max_chack = $slip_date;
                $slip_date = $slip_date ;
		$show_month = show_month($slip_date);
                //echo $show_month ;
                
	}            
}
        
        
//}
        
       /* $strSQL5 = "SELECT KP.KEEPITEM_STATUS AS C0 FROM KPTEMPRECEIVEDET KP WHERE KP.RECV_PERIOD = '$showslip' AND KP.MEMBER_NO = '$member_no'";
	$value5 = array('C0');		
	list($Num_Rows5,$slip_show5) = get_value_many_oci($strSQL5,$value5);	
	
	$p=0;
	for($q=0;$q<$Num_Rows5;$q++){ 
		$test[$q] 		= $slip_show5[$q][$p++];   				
		
                
                echo $test[$q]; exit();
	}*/


        
	$strSQL = "SELECT * FROM (     
						SELECT 
							KPD.REF_MEMBNO AS A0,
							KUK.KEEPITEMTYPE_GRP AS A1,
							KUK.KEEPITEMTYPE_DESC AS A2,
                                                        KPD.KEEPITEM_STATUS AS A12,
							KPD.LOANCONTRACT_NO AS A3,
							to_char(DECODE(KPD.PERIOD,0,null,KPD.PERIOD),'9G999G999') AS A8,
							KPD.DESCRIPTION AS A4,
							to_char(DECODE(KPD.PRINCIPAL_PAYMENT,0,null,KPD.PRINCIPAL_PAYMENT),'99G999G999G999D00') AS A5,
							to_char(DECODE(KPD.INTEREST_PAYMENT,0,null,KPD.INTEREST_PAYMENT),'99G999G999G999D00') AS A6,
							to_char(DECODE(KPD.ITEM_PAYMENT * KUK.SIGN_FLAG,0,null,KPD.ITEM_PAYMENT * KUK.SIGN_FLAG),'99G999G999G999D00') AS A7,
							to_char(DECODE(KPD.PRINCIPAL_BALANCE,0,null,KPD.PRINCIPAL_BALANCE),'99G999G999G999D00') AS A9,
							(KPD.CALINTTO_DATE - KPD.CALINTFROM_DATE) AS A10, 
							TO_CHAR(KPD.POSTING_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') AS A11,
							KPD.SEQ_NO AS SEQ
                                                        
						FROM 
							KPTEMPRECEIVEDET KPD, KPUCFKEEPITEMTYPE KUK 
						WHERE 
							KPD.KEEPITEMTYPE_CODE = KUK.KEEPITEMTYPE_CODE
							AND KPD.MEMBER_NO = '$member_no'
							AND KPD.RECV_PERIOD = '$slip_date'
							AND KPD.POSTING_STATUS = 0
                                                        AND KPD.KEEPITEM_STATUS = '1'
                                                        
					UNION
						SELECT 
							KMD.REF_MEMBNO AS A0,
							KUK.KEEPITEMTYPE_GRP AS A1,
							KUK.KEEPITEMTYPE_DESC AS A2,
                                                        KMD.KEEPITEM_STATUS AS A12,
							KMD.LOANCONTRACT_NO AS A3,
							to_char(DECODE(KMD.PERIOD,0,null,KMD.PERIOD),'9G999G999') AS A8,
							KMD.DESCRIPTION AS A4,
							to_char(DECODE(KMD.PRINCIPAL_PAYMENT,0,null,KMD.PRINCIPAL_PAYMENT),'99G999G999G999D00') AS A5,
							to_char(DECODE(KMD.INTEREST_PAYMENT,0,null,KMD.INTEREST_PAYMENT),'99G999G999G999D00') AS A6,
							to_char(DECODE(KMD.ITEM_PAYMENT * KUK.SIGN_FLAG,0,null,KMD.ITEM_PAYMENT * KUK.SIGN_FLAG),'99G999G999G999D00') AS A7,
							to_char(DECODE(KMD.PRINCIPAL_BALANCE,0,null,KMD.PRINCIPAL_BALANCE),'99G999G999G999D00') AS A9,
							(KMD.CALINTTO_DATE - KMD.CALINTFROM_DATE) AS A10, 
							TO_CHAR(KMD.POSTING_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') AS  A11,
							KMD.SEQ_NO AS SEQ
						FROM 
							KPMASTRECEIVEDET KMD, KPUCFKEEPITEMTYPE KUK 
						WHERE 
							KMD.KEEPITEMTYPE_CODE = KUK.KEEPITEMTYPE_CODE
							AND KMD.MEMBER_NO = '$member_no'
							AND KMD.RECV_PERIOD = '$slip_date'
                                                        AND KMD.KEEPITEM_STATUS = '1'
					) ORDER BY SEQ ";
	$value = array('A0','A1','A2','A12','A3','A4','A5','A6','A7','A8','A9','A10','A11');		
	list($Num_Rows,$slip_show) = get_value_many_oci($strSQL,$value);	
	$totalpayment = 0;
	$j=0;
	for($i=0;$i<$Num_Rows;$i++){ 
		$slip_no[$i] 		= $slip_show[$i][$j++];   				
		$slip_itemtype[$i] 	= $slip_show[$i][$j++];			
		$slip_itemdesc[$i]	= $slip_show[$i][$j++];
        $keepitem_status[$i]	        = $slip_show[$i][$j++];
		$slip_loanno[$i] 	= $slip_show[$i][$j++];
		$slip_desc[$i] 		= $slip_show[$i][$j++];
		$slip_principal[$i]	= $slip_show[$i][$j++];
		$slip_interest[$i] 	= $slip_show[$i][$j++];
		$slip_pay[$i] 		= $slip_show[$i][$j++];
		$period[$i]		= $slip_show[$i][$j++];
		$itembalance[$i] 	= $slip_show[$i][$j++];
	    $rate_day[$i] 		= $slip_show[$i][$j++];
		$slipdate		= $slip_show[$i][$j++];
                //$keepitem_status	= $slip_show[$i][$j++];
		$j=0;
		$totalpayment 		= $totalpayment + str_replace( ',','', $slip_pay[$i] );	
                
                //echo $test1[$i]; exit;
               
	}	
        
        
        
        
        $strSQL2 = "SELECT * FROM (     
						SELECT 
							KPD.REF_MEMBNO AS B0,
							KUK.KEEPITEMTYPE_GRP AS B1,
							KUK.KEEPITEMTYPE_DESC AS B2,
                                                        KPD.KEEPITEM_STATUS AS B12,
							KPD.LOANCONTRACT_NO AS B3,
							to_char(DECODE(KPD.PERIOD,0,null,KPD.PERIOD),'9G999G999') AS B8,
							KPD.DESCRIPTION AS B4,
							to_char(DECODE(KPD.PRINCIPAL_PAYMENT,0,null,KPD.PRINCIPAL_PAYMENT),'99G999G999G999D00') AS B5,
							to_char(DECODE(KPD.INTEREST_PAYMENT,0,null,KPD.INTEREST_PAYMENT),'99G999G999G999D00') AS B6,
							to_char(DECODE(KPD.ITEM_PAYMENT * KUK.SIGN_FLAG,0,null,KPD.ITEM_PAYMENT * KUK.SIGN_FLAG),'99G999G999G999D00') AS B7,
							to_char(DECODE(KPD.ITEM_BALANCE,0,null,KPD.ITEM_BALANCE),'99G999G999G999D00') AS B9,
							(KPD.CALINTTO_DATE - KPD.CALINTFROM_DATE) AS B10, 
							TO_CHAR(KPD.POSTING_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') AS B11,
							KPD.SEQ_NO AS SEQ
                                                        
						FROM 
							KPTEMPRECEIVEDET KPD, KPUCFKEEPITEMTYPE KUK
						WHERE 
							KPD.KEEPITEMTYPE_CODE = KUK.KEEPITEMTYPE_CODE
							AND KPD.MEMBER_NO = '$member_no'
							AND KPD.RECV_PERIOD = '$slip_date'
							AND KPD.POSTING_STATUS = 0
                                                        AND KPD.KEEPITEM_STATUS = '1'
					UNION
						SELECT 
							KMD.REF_MEMBNO AS B0,
							KUK.KEEPITEMTYPE_GRP AS B1,
							KUK.KEEPITEMTYPE_DESC AS B2,
                                                        KMD.KEEPITEM_STATUS AS B12,
							KMD.LOANCONTRACT_NO AS B3,
							to_char(DECODE(KMD.PERIOD,0,null,KMD.PERIOD),'9G999G999') AS B8,
							KMD.DESCRIPTION AS B4,
							to_char(DECODE(KMD.PRINCIPAL_PAYMENT,0,null,KMD.PRINCIPAL_PAYMENT),'99G999G999G999D00') AS B5,
							to_char(DECODE(KMD.INTEREST_PAYMENT,0,null,KMD.INTEREST_PAYMENT),'99G999G999G999D00') AS B6,
							to_char(DECODE(KMD.ITEM_PAYMENT * KUK.SIGN_FLAG,0,null,KMD.ITEM_PAYMENT * KUK.SIGN_FLAG),'99G999G999G999D00') AS B7,
							to_char(DECODE(KMD.ITEM_BALANCE,0,null,KMD.ITEM_BALANCE),'99G999G999G999D00') AS B9,
							(KMD.CALINTTO_DATE - KMD.CALINTFROM_DATE) AS B10, 
							TO_CHAR(KMD.POSTING_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') AS  B11,
							KMD.SEQ_NO AS SEQ
						FROM 
							KPMASTRECEIVEDET KMD, KPUCFKEEPITEMTYPE KUK
						WHERE 
							KMD.KEEPITEMTYPE_CODE = KUK.KEEPITEMTYPE_CODE
							AND KMD.MEMBER_NO = '$member_no'
							AND KMD.RECV_PERIOD = '$slip_date'
                                                        AND KMD.KEEPITEM_STATUS = '-9'
					) ORDER BY SEQ ";
	$value2 = array('B0','B1','B2','B12','B3','B4','B5','B6','B7','B8','B9','B10','B11');		
	list($Num_Rows2,$slip_show2) = get_value_many_oci($strSQL2,$value2);	
	$totalpayment_cancel = 0;
	$l=0;
	for($k=0;$k<$Num_Rows2;$k++){ 
		$slip_no_cancel[$k] 		= $slip_show2[$k][$l++];   				
		$slip_itemtype_cancel[$k] 	= $slip_show2[$k][$l++];			
		$slip_itemdesc_cancel[$k]	= $slip_show2[$k][$l++];
                $keepitem_status_cancel[$k]	                = $slip_show2[$k][$l++];
		$slip_loanno_cancel[$k] 	= $slip_show2[$k][$l++];
		$slip_desc_cancel[$k] 		= $slip_show2[$k][$l++];
		$slip_principal_cancel[$k]	= $slip_show2[$k][$l++];
		$slip_interest_cancel[$k] 	= $slip_show2[$k][$l++];
		$slip_pay_cancel[$k] 		= $slip_show2[$k][$l++];
		$period_cancel[$k]		= $slip_show2[$k][$l++];
		$itembalance_cancel[$k] 	= $slip_show2[$k][$l++];
		$rate_day_cancel[$k] 		= $slip_show2[$k][$l++];
                //$keepitem_status[$k] 		= $slip_show2[$k][$l++];
		$slipdate_cancel		= $slip_show2[$k][$l++];
		$l=0;
		$totalpayment_cancel 		= $totalpayment_cancel + str_replace( ',','', $slip_pay_cancel[$k] );
                
                //echo $test[$k]; exit();
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
		$moneytype_code	= $slip_show1[$n][$m++];   
		$expense_accid		= $slip_show1[$n][$m++];   
		$item_payment		= $slip_show1[$n][$m++];   
		$m=0;
		$payment_a = str_replace( ',','',$item_payment);
	}

	$strSQL3 = "SELECT CLOSEMONTH_ID AS Q0 FROM CMCLSLOGMONTH WHERE CLOSEMONTH_SYSTEM = '$slip_date'";
	$value3 = array('Q0');		
	list($Num_Rows3,$slip_show3) = get_value_many_oci($strSQL3,$value3);	
	
	$j=0;
	for($i=0;$i<$Num_Rows3;$i++){ 
		 
               $closemonth_id = $slip_show3[$i][$j++];   				

		$j=0;
			
	}
?>

