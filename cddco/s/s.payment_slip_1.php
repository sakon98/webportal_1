<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php

        $date = date("Y-m-d");
        $year = date("Y");
        $month = date("m");
        $day = date("d");
       // $day = 15;
        
        if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12){
            
           $maxday = 31;
        }
        elseif ($month == 4 || $month == 6 || $month == 9 || $month == 11) {
            $maxday = 30;  
           }
        elseif ($month == 2) {
           $maxday = 28;  
           }
            
       // if($day != $maxday){*/


	  $strSQL = "SELECT MAX(RECV_PERIOD) AS MAXSLIP FROM KPTEMPRECEIVEDET WHERE MEMBER_NO = '$member_no' ";
	$value = ('MAXSLIP');
	$listslip = get_single_value_oci($strSQL,$value);
        $listslip = $listslip -1 ; //////
	$thisshow = Show_Slip(date('d-m-Y'));
	
	if($listslip != $thisshow){
		$listslip = $listslip-1;
	}
		
	list($slip,$slip_m,$slip_s,$slipsum) =show_list($listslip,40,$member_no);
		
     if($day != $maxday){   
	if($_REQUEST["slip_date"] == ""){
            
            
		$slip_date = Show_Slip(date('d-m-Y'));
                 $slip_date = $slip_date - 1 ;/////
                if(substr($slip_date,4,2) == 00){
                   $slip_date = substr($slip_date,0,4) - 1 . 12;
                }else{
                   $slip_date = $slip_date;
                }
		$show_month = show_month($slip_date);
	}else{
           // echo '1';
		$slip_date = $_REQUEST["slip_date"];
                  $slip_date = $slip_date ;/////
		$show_month = show_month($slip_date);
        }
     }  else {
       if($_REQUEST["slip_date"] == ""){
            
           
		$slip_date = Show_Slip(date('d-m-Y'));
                 $slip_date = $slip_date;/////
		$show_month = show_month($slip_date);
	}else{
            //echo '2';
		$slip_date = $_REQUEST["slip_date"];
                  $slip_date = $slip_date ;/////
		$show_month = show_month($slip_date);
        }  
}
    /* }else{
        $strSQL = "SELECT MAX(RECV_PERIOD) AS MAXSLIP FROM KPTEMPRECEIVEDET WHERE MEMBER_NO = '$member_no' ";
	$value = ('MAXSLIP');
        $listslip = get_single_value_oci($strSQL,$value);
        $listslip = $listslip ; //////
	$thisshow = Show_Slip(date('d-m-Y'));
	
	if($listslip != $thisshow){
		$listslip = $listslip-1;
	}
		
	list($slip,$slip_m,$slip_s,$slipsum) =show_list($listslip,40,$member_no);
			
	if($_REQUEST["slip_date"] == ""){
	        $slip_date = Show_Slip(date('d-m-Y'));
                $slip_date = $slip_date -1;/////
		$show_month = show_month($slip_date);
	}else{
	        $slip_date = $_REQUEST["slip_date"];
                $slip_date = $slip_date ;/////
		$show_month = show_month($slip_date);
	} 
         
     }*/

	$strSQL = "SELECT 
							KMD.REF_MEMBNO AS A0,
							KUK.KEEPITEMTYPE_GRP AS A1,
							NVL(LNT.LOANTYPE_DESC, KUK.KEEPITEMTYPE_DESC) AS A2,
							KMD.LOANCONTRACT_NO AS A3,
							to_char(DECODE(KMD.PERIOD,0,null,KMD.PERIOD),'9G999G999') AS A8,
							KMD.DESCRIPTION AS A4,
                                                        DECODE(KEEPITEM_STATUS, -99,	
                                                            to_char(DECODE(KMD.PRINCIPAL_KEPTAMT,0,null,KMD.PRINCIPAL_KEPTAMT),'99G999G999G999D00'), 						
                                                            to_char(DECODE(KMD.PRINCIPAL_PAYMENT,0,null,KMD.PRINCIPAL_PAYMENT),'99G999G999G999D00')) AS A5,
							DECODE(KEEPITEM_STATUS, -99,	
                                                            to_char(DECODE(KMD.INTEREST_KEPTAMT,0,null,KMD.INTEREST_KEPTAMT),'99G999G999G999D00'),
                                                            to_char(DECODE(KMD.INTEREST_PAYMENT,0,null,KMD.INTEREST_PAYMENT),'99G999G999G999D00')) AS A6,
							DECODE(KEEPITEM_STATUS, -99,	
                                                            to_char(DECODE(KMD.ITEM_KEPTAMT * KUK.SIGN_FLAG,0,null,KMD.ITEM_KEPTAMT * KUK.SIGN_FLAG),'99G999G999G999D00'),
                                                            to_char(DECODE(KMD.ITEM_PAYMENT * KUK.SIGN_FLAG,0,null,KMD.ITEM_PAYMENT * KUK.SIGN_FLAG),'99G999G999G999D00')) AS A7,
							to_char(DECODE(KMD.ITEM_BALANCE,0,null,KMD.ITEM_BALANCE),'99G999G999G999D00') AS A9,
							(KMD.CALINTTO_DATE - KMD.CALINTFROM_DATE) AS A10, 
							TO_CHAR(KMD.POSTING_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') AS  A11,
							LNT.LOANTYPE_CODE AS  A12,
							KMD.SEQ_NO AS SEQ
						FROM 
							KPMASTRECEIVEDET KMD, KPUCFKEEPITEMTYPE KUK, LNLOANTYPE LNT
						WHERE 
							KMD.KEEPITEMTYPE_CODE = KUK.KEEPITEMTYPE_CODE
                               AND KMD.SHRLONTYPE_CODE = LNT.LOANTYPE_CODE(+)
							AND LNT.LOANTYPE_CODE in ('30','32','39','52') 
							AND KMD.MEMBER_NO = '$member_no'
							AND KMD.RECV_PERIOD = '$slip_date'
 							ORDER BY SEQ ";
	$value = array('A0','A1','A2','A3','A4','A5','A6','A7','A8','A9','A10','A11','A12');		
	list($Num_Rows,$slip_show) = get_value_many_oci($strSQL,$value);	
	$totalpayment_3 = 0;
	$j=0;
	for($i=0;$i<$Num_Rows;$i++){ 
		$slip_no1_3[$i] 	= $slip_show[$i][$j++];   				
		$slip_itemtype_3[$i] 	= $slip_show[$i][$j++];			
		$slip_itemdesc_3[$i]	= $slip_show[$i][$j++];
		$slip_loanno_3[$i] 	= $slip_show[$i][$j++];
		$slip_desc_3[$i] 	= $slip_show[$i][$j++];
		$slip_principal_3[$i]	= $slip_show[$i][$j++];
		$slip_interest_3[$i] 	= $slip_show[$i][$j++];
		$slip_pay_3[$i] 	= $slip_show[$i][$j++];
		$period_3[$i]		= $slip_show[$i][$j++];
		$itembalance_3[$i] 	= $slip_show[$i][$j++];
		$rate_day_3[$i] 	= $slip_show[$i][$j++];
		$slipdate_3		= $slip_show[$i][$j++];
                $slip_loantype_code[$i]	= $slip_show[$i][$j++];
		$j=0;
		$totalpayment_3 		= $totalpayment_3 + str_replace( ',','', $slip_pay_3[$i] );
                
                //echo $slip_loantype_code[$i];
	}	
        
        $strSQL2 = "select receipt_no as SLIP_NO from kptempreceive where member_no = '$member_no' and recv_period = '$slip_date'"; 
        
        $value2 = array('SLIP_NO');
	list($Num_Rows1,$slip_show1) = get_value_many_oci($strSQL2,$value2);
        $slip_no = $slip_show1[0][0];
        
       /* $strSQL3 = "SELECT 
							KMD.REF_MEMBNO AS B0,
							KUK.KEEPITEMTYPE_GRP AS B1,
							NVL(LNT.LOANTYPE_DESC, KUK.KEEPITEMTYPE_DESC) AS B2,
							KMD.LOANCONTRACT_NO AS A3,
							to_char(DECODE(KMD.PERIOD,0,null,KMD.PERIOD),'9G999G999') AS B8,
							KMD.DESCRIPTION AS B4,
                                                        DECODE(KEEPITEM_STATUS, -99,	
                                                            to_char(DECODE(KMD.PRINCIPAL_KEPTAMT,0,null,KMD.PRINCIPAL_KEPTAMT),'99G999G999G999D00'), 						
                                                            to_char(DECODE(KMD.PRINCIPAL_PAYMENT,0,null,KMD.PRINCIPAL_PAYMENT),'99G999G999G999D00')) AS B5,
							DECODE(KEEPITEM_STATUS, -99,	
                                                            to_char(DECODE(KMD.INTEREST_KEPTAMT,0,null,KMD.INTEREST_KEPTAMT),'99G999G999G999D00'),
                                                            to_char(DECODE(KMD.INTEREST_PAYMENT,0,null,KMD.INTEREST_PAYMENT),'99G999G999G999D00')) AS B6,
							DECODE(KEEPITEM_STATUS, -99,	
                                                            to_char(DECODE(KMD.ITEM_KEPTAMT * KUK.SIGN_FLAG,0,null,KMD.ITEM_KEPTAMT * KUK.SIGN_FLAG),'99G999G999G999D00'),
                                                            to_char(DECODE(KMD.ITEM_PAYMENT * KUK.SIGN_FLAG,0,null,KMD.ITEM_PAYMENT * KUK.SIGN_FLAG),'99G999G999G999D00')) AS B7,
							to_char(DECODE(KMD.ITEM_BALANCE,0,null,KMD.ITEM_BALANCE),'99G999G999G999D00') AS B9,
							(KMD.CALINTTO_DATE - KMD.CALINTFROM_DATE) AS B10, 
							TO_CHAR(KMD.POSTING_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') AS  B11,
							LNT.LOANTYPE_CODE AS  B12,
							KMD.SEQ_NO AS SEQ
						FROM 
							KPMASTRECEIVEDET KMD, KPUCFKEEPITEMTYPE KUK, LNLOANTYPE LNT
						WHERE 
							KMD.KEEPITEMTYPE_CODE = KUK.KEEPITEMTYPE_CODE
                               AND KMD.SHRLONTYPE_CODE = LNT.LOANTYPE_CODE(+)
							AND LNT.LOANTYPE_CODE = '32' 
							AND KMD.MEMBER_NO = '$member_no'
							AND KMD.RECV_PERIOD = '$slip_date'
 							ORDER BY SEQ ";
	$value3 = array('B0','B1','B2','B3','B4','B5','B6','B7','B8','B9','B10','B11','B12');		
	list($Num_Rows3,$slip_show3) = get_value_many_oci($strSQL3,$value3);	
	$totalpayment_32 = 0;
	$j=0;
	for($i=0;$i<$Num_Rows3;$i++){ 
		$slip_no1_32[$i] 	= $slip_show3[$i][$j++];   				
		$slip_itemtype_32[$i] 	= $slip_show3[$i][$j++];			
		$slip_itemdesc_32[$i]	= $slip_show3[$i][$j++];
		$slip_loanno_32[$i] 	= $slip_show3[$i][$j++];
		$slip_desc_32[$i] 	= $slip_show3[$i][$j++];
		$slip_principal_32[$i]	= $slip_show3[$i][$j++];
		$slip_interest_32[$i] 	= $slip_show3[$i][$j++];
		$slip_pay_32[$i] 	= $slip_show3[$i][$j++];
		$period_32[$i]		= $slip_show3[$i][$j++];
		$itembalance_32[$i] 	= $slip_show3[$i][$j++];
		$rate_day_32[$i] 	= $slip_show3[$i][$j++];
		$slipdate_32		= $slip_show3[$i][$j++];
                $slip_loantype_code_32[$i]	= $slip_show3[$i][$j++];
                //exit();
		$j=0;
		$totalpayment_32 		= $totalpayment_32 + str_replace( ',','', $slip_pay_32[$i] );
                
                //echo $slip_loantype_code[$i];
	}
        
        
        
        echo $strSQL4 = "SELECT 
							KMD.REF_MEMBNO AS C0,
							KUK.KEEPITEMTYPE_GRP AS C1,
							NVL(LNT.LOANTYPE_DESC, KUK.KEEPITEMTYPE_DESC) AS C2,
							KMD.LOANCONTRACT_NO AS C3,
							to_char(DECODE(KMD.PERIOD,0,null,KMD.PERIOD),'9G999G999') AS C8,
							KMD.DESCRIPTION AS C4,
                                                        DECODE(KEEPITEM_STATUS, -99,	
                                                            to_char(DECODE(KMD.PRINCIPAL_KEPTAMT,0,null,KMD.PRINCIPAL_KEPTAMT),'99G999G999G999D00'), 						
                                                            to_char(DECODE(KMD.PRINCIPAL_PAYMENT,0,null,KMD.PRINCIPAL_PAYMENT),'99G999G999G999D00')) AS C5,
							DECODE(KEEPITEM_STATUS, -99,	
                                                            to_char(DECODE(KMD.INTEREST_KEPTAMT,0,null,KMD.INTEREST_KEPTAMT),'99G999G999G999D00'),
                                                            to_char(DECODE(KMD.INTEREST_PAYMENT,0,null,KMD.INTEREST_PAYMENT),'99G999G999G999D00')) AS C6,
							DECODE(KEEPITEM_STATUS, -99,	
                                                            to_char(DECODE(KMD.ITEM_KEPTAMT * KUK.SIGN_FLAG,0,null,KMD.ITEM_KEPTAMT * KUK.SIGN_FLAG),'99G999G999G999D00'),
                                                            to_char(DECODE(KMD.ITEM_PAYMENT * KUK.SIGN_FLAG,0,null,KMD.ITEM_PAYMENT * KUK.SIGN_FLAG),'99G999G999G999D00')) AS C7,
							to_char(DECODE(KMD.ITEM_BALANCE,0,null,KMD.ITEM_BALANCE),'99G999G999G999D00') AS C9,
							(KMD.CALINTTO_DATE - KMD.CALINTFROM_DATE) AS C10, 
							TO_CHAR(KMD.POSTING_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') AS  C11,
							LNT.LOANTYPE_CODE AS  C12,
							KMD.SEQ_NO AS SEQ
						FROM 
							KPMASTRECEIVEDET KMD, KPUCFKEEPITEMTYPE KUK, LNLOANTYPE LNT
						WHERE 
							KMD.KEEPITEMTYPE_CODE = KUK.KEEPITEMTYPE_CODE
                               AND KMD.SHRLONTYPE_CODE = LNT.LOANTYPE_CODE(+)
							AND LNT.LOANTYPE_CODE = '39' 
							AND KMD.MEMBER_NO = '$member_no'
							AND KMD.RECV_PERIOD = '$slip_date'
 							ORDER BY SEQ ";
	$value4 = array('C0','C1','C2','C3','C4','C5','C6','C7','C8','C9','C10','C11','C12');		
	list($Num_Rows4,$slip_show4) = get_value_many_oci($strSQL4,$value4);	
	$totalpayment_39 = 0;
	$j=0;
	for($i=0;$i<$Num_Rows3;$i++){ 
		$slip_no1_39[$i] 	= $slip_show4[$i][$j++];   				
		$slip_itemtype_39[$i] 	= $slip_show4[$i][$j++];			
		$slip_itemdesc_39[$i]	= $slip_show4[$i][$j++];
		$slip_loanno_39[$i] 	= $slip_show4[$i][$j++];
		$slip_desc_39[$i] 	= $slip_show4[$i][$j++];
		$slip_principal_39[$i]	= $slip_show4[$i][$j++];
		$slip_interest_39[$i] 	= $slip_show4[$i][$j++];
		$slip_pay_39[$i] 	= $slip_show4[$i][$j++];
		$period_39[$i]		= $slip_show4[$i][$j++];
		$itembalance_39[$i] 	= $slip_show4[$i][$j++];
		$rate_day_39[$i] 	= $slip_show4[$i][$j++];
		$slipdate_39		= $slip_show4[$i][$j++];
                $slip_loantype_code_39[$i]	= $slip_show4[$i][$j++];
                //exit();
		$j=0;
		$totalpayment_39 		= $totalpayment_39 + str_replace( ',','', $slip_pay_39[$i] );
                
                //echo $slip_loantype_code[$i];
	}*/
        
    /*    $strSQL4 = "SELECT SH.SHARESTK_AMT AS E0
                   FROM SHSHAREMASTER SH ,SHSHARETYPE ST
                   WHERE SH.SHARETYPE_CODE = ST.SHARETYPE_CODE
                   AND SH.MEMBER_NO = '$member_no' ";
	$value4 = array('E0');		
	list($Num_Rows4,$slip_show4) = get_value_many_oci($strSQL4,$value4);	
	
	$j=0;
	for($i=0;$i<$Num_Rows4;$i++){ 
		 
             $sharestk_amt = $slip_show4[$i][$j++];   				
             $sum_sharestk_amt = $sharestk_amt * 10;
             $sum_sharestk_amt = number_format($sum_sharestk_amt, 2);
               
               
		$j=0;
			
	}*/	
        
?>

