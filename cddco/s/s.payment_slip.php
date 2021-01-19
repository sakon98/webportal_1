<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
	
        $date = date("Y-m-d");
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        //$day = 30;
        
        if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12){
            
           $maxday = 31;
        }
        elseif ($month == 4 || $month == 6 || $month == 9 || $month == 11) {
            $maxday = 30;  
           }
        elseif ($month == 2) {
           $maxday = 28;  
           }
           
          // echo $day;   echo  $maxday;
            
        //if($day != $maxday){

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
            echo '2';
		$slip_date = Show_Slip(date('d-m-Y'));
                 $slip_date = $slip_date -1 ;/////
		$show_month = show_month($slip_date);
	}else{
		  $slip_date = $_REQUEST["slip_date"];
                  $slip_date = $slip_date ;/////
		$show_month = show_month($slip_date);
	}   
       }*/
        
        
        //echo $slip_date;
        

	$strSQL = "SELECT * FROM (     
						SELECT 
							KPD.REF_MEMBNO AS A0,
							KUK.KEEPITEMTYPE_GRP AS A1,
							KUK.KEEPITEMTYPE_DESC AS A2,
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
							KPTEMPRECEIVEDET KPD, KPUCFKEEPITEMTYPE KUK, LNLOANTYPE LNT
						WHERE 
							KPD.KEEPITEMTYPE_CODE = KUK.KEEPITEMTYPE_CODE
                                                        AND KPD.SHRLONTYPE_CODE = LNT.LOANTYPE_CODE(+)
							AND KPD.MEMBER_NO = '$member_no'
							AND KPD.RECV_PERIOD = '$slip_date'
							AND KPD.POSTING_STATUS = 0
                                                        AND NVL(LNT.LOANTYPE_CODE, KUK.KEEPITEMTYPE_CODE) not in ('30','32','39','52') and KPD.KEEPITEM_STATUS = '1'
							
                                                        
                                                        
					UNION
						SELECT 
							KMD.REF_MEMBNO AS A0,
							KUK.KEEPITEMTYPE_GRP AS A1,
							KUK.KEEPITEMTYPE_DESC AS A2,
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
							to_char(DECODE(KMD.PRINCIPAL_BALANCE,0,null,KMD.PRINCIPAL_BALANCE),'99G999G999G999D00') AS A9,
							(KMD.CALINTTO_DATE - KMD.CALINTFROM_DATE) AS A10, 
							TO_CHAR(KMD.POSTING_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') AS  A11,
							KMD.SEQ_NO AS SEQ
						FROM 
							KPMASTRECEIVEDET KMD, KPUCFKEEPITEMTYPE KUK, LNLOANTYPE LNT
						WHERE 
							KMD.KEEPITEMTYPE_CODE = KUK.KEEPITEMTYPE_CODE
                                                        AND KMD.SHRLONTYPE_CODE = LNT.LOANTYPE_CODE(+)
							AND KMD.MEMBER_NO = '$member_no'
							AND KMD.RECV_PERIOD = '$slip_date'
                                                        AND NVL(LNT.LOANTYPE_CODE, KUK.KEEPITEMTYPE_CODE) not in ('30','32','39','52') and KMD.KEEPITEM_STATUS = '1'
							
                                                        
                                                        
					) ORDER BY SEQ ";
	$value = array('A0','A1','A2','A3','A4','A5','A6','A7','A8','A9','A10','A11');		
	list($Num_Rows,$slip_show) = get_value_many_oci($strSQL,$value);	
	$totalpayment = 0;
	$j=0;  $period_stm = "";
	for($i=0;$i<$Num_Rows;$i++){ 
		 $slip_no1[$i] 		= $slip_show[$i][$j++];   				
		 $slip_itemtype[$i] 	= $slip_show[$i][$j++];			
		 $slip_itemdesc[$i]	= $slip_show[$i][$j++];
		 $slip_loanno[$i] 	= $slip_show[$i][$j++];
		 $slip_desc[$i] 		= $slip_show[$i][$j++];
		 $slip_principal[$i]	= $slip_show[$i][$j++];
		 $slip_interest[$i] 	= $slip_show[$i][$j++];
		 $slip_pay[$i] 		= $slip_show[$i][$j++];
		 $period[$i]		= $slip_show[$i][$j++];
		 $itembalance[$i] 	= $slip_show[$i][$j++];
                 $rate_day[$i] 		= $slip_show[$i][$j++];
                 $slipdate		= $slip_show[$i][$j++];
                 $period_stm = $period[0];
               
		$j=0;
		$totalpayment 		= $totalpayment + str_replace( ',','', $slip_pay[$i] );		
	}	
        
                 $period_stm;
        
        
        $strSQL2 = "select kpt.receipt_no as SLIP_NO,
                           TO_CHAR(kpm.posting_date, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') AS POSTING_DATE
                           from kptempreceive kpt, kpmastreceivedet kpm
                          where kpt.member_no = '$member_no' 
                          and kpt.recv_period = '$slip_date'
                          and kpt.member_no = kpm.member_no
                          and kpt.recv_period = kpm.recv_period"; 
        
        $value2 = array('SLIP_NO','POSTING_DATE');
	list($Num_Rows1,$slip_show1) = get_value_many_oci($strSQL2,$value2);
       
          $slip_no = $slip_show1[0][0];
          $posting_date = $slip_show1[0][1]; 
       
        
           $strSQL3 = "SELECT SH.SHARESTK_AMT AS E0
                    FROM SHSHARESTATEMENT SH 
                    WHERE SH.MEMBER_NO = '$member_no' AND SH.PERIOD = '$period_stm'";
	$value3 = array('E0');		
	list($Num_Rows3,$slip_show3) = get_value_many_oci($strSQL3,$value3);	
	
	$j=0;
	for($i=0;$i<$Num_Rows3;$i++){ 
		 
             $sharestk_amt = $slip_show3[$i][$j++];   				
             $sum_sharestk_amt = $sharestk_amt * 10;
             $sum_sharestk_amt = number_format($sum_sharestk_amt, 2);
               
               
		$j=0;
			
	}	
        
        
        //exit();
        
       /* $strSQL3 = "SELECT KUK.KEEPITEMTYPE_DESC AS B0,
                          KPM.PERIOD AS B1,
                          KPM.ITEM_PAYMENT AS B2 
                    FROM KPMASTRECEIVEDET KPM , KPUCFKEEPITEMTYPE KUK
                    WHERE MEMBER_NO = '$member_no' 
                    AND RECV_PERIOD = '$slip_date'
                    AND KUK.KEEPITEMTYPE_CODE = KPM.KEEPITEMTYPE_CODE
                    AND KUK.KEEPITEMTYPE_CODE = 'S01' ";
	$value3 = array('B0','B1','B2');		
	list($Num_Rows3,$slip_show3) = get_value_many_oci($strSQL3,$value3);	
	$totalpayment = 0;
	$j=0;
	for($i=0;$i<$Num_Rows3;$i++){ 
		 $s_desc[$i]            = $slip_show3[$i][$j++];   				
		 $s_period[$i]          = $slip_show3[$i][$j++];			
		 $s_item_payment[$i]	= $slip_show3[$i][$j++];

		$j=0;
		$s_totalpayment 		= $s_otalpayment + str_replace( ',','', $s_slip_pay[$i] );		
	}*/	
	
	
       /* $strSQL1 = "SELECT 
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

