<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
	$strSQL = "SELECT MAX(CMCSLCY.ACCOUNT_YEAR) AS MAXDIV ,MIN(CMCSLCY.ACCOUNT_YEAR) AS MINDIV 
                        FROM 
                            CMCLOSESHLNCOYEAR CMCSLCY,   
                            MBMEMBMASTER MBMAS,   
                            MBUCFMEMBGROUP MBGRP,   
                            MBUCFPRENAME MBPRN
                        WHERE ( CMCSLCY.MEMBER_NO = MBMAS.MEMBER_NO ) and  
                              ( MBGRP.MEMBGROUP_CODE = MBMAS.MEMBGROUP_CODE ) and  
                              ( MBPRN.PRENAME_CODE = MBMAS.PRENAME_CODE )  and 
                              ( CMCSLCY.MEMBER_NO = '$member_no' )";
	$value = array('MAXDIV','MINDIV');
	list($NumDIV,$listslip) = get_value_many_oci($strSQL,$value);	
	$maxdiv	 =  $listslip[0][0];   				
	$mindiv =  $listslip[0][1];		

	if($_REQUEST["divyear"] == ""){
		$divyear = $maxdiv ;
	}else{
		$divyear = $_REQUEST["divyear"];
	}	
	
	$strSQL = "SELECT 
                        TO_CHAR(DECODE(CMCSLCY.SHARE_DIVIDEND,0,null,CMCSLCY.SHARE_DIVIDEND),'99G999G999G999D00') AS DIV_BALAMT,
                        TO_CHAR(DECODE(CMCSLCY.AVERAGE_RETURN,0,null,CMCSLCY.AVERAGE_RETURN),'99G999G999G999D00') AS AVG_BALAMT,
                        TO_CHAR(DECODE(0,0,null,0),'99G999G999G999D00') AS ETC_BALAMT,
                        CMCSLCY.SHARE_DIVIDEND+CMCSLCY.AVERAGE_RETURN AS SUMDIV
                    FROM 
                        CMCLOSESHLNCOYEAR CMCSLCY,   
                        MBMEMBMASTER MBMAS,   
                        MBUCFMEMBGROUP MBGRP,   
                        MBUCFPRENAME MBPRN
                    WHERE ( CMCSLCY.MEMBER_NO = MBMAS.MEMBER_NO ) and  
                          ( MBGRP.MEMBGROUP_CODE = MBMAS.MEMBGROUP_CODE ) and  
                          ( MBPRN.PRENAME_CODE = MBMAS.PRENAME_CODE )  and 
                          ( MBMAS.MEMBER_NO	= '$member_no' ) and 
                          ( CMCSLCY.ACCOUNT_YEAR = '$divyear'  ) ";
	$value = array('DIV_BALAMT','AVG_BALAMT','ETC_BALAMT','SUMDIV');
	list($Num_div,$slip_show) = get_value_many_oci($strSQL,$value);
	$div_balamt = $slip_show[0][0]; 
	$avg_balamt = $slip_show[0][1];
	$etc_balamt = $slip_show[0][2];
	$sumdiv = $slip_show[0][3];

	if($Num_div  == 0){
		echo '<script type="text/javascript"> window.alert("ไม่พบปันผล-เฉลี่ยคืน ในปีที่ท่านเลือก") </script> ';
		echo "<script>window.location = 'info.php'</script>";
		exit;
	}
	
	$strSQL1 = "SELECT
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
	$typepay = $slip_show1[0][0]; 
	$totalpay = $slip_show1[0][1]; 
	$bank_desc = $slip_show1[0][2]; 
	$bank_acc = $slip_show1[0][3]; 
	
	
	$strSQL2 ="SELECT 
						TO_CHAR(DECODE(CMCSLCY.LOANDIV_AMT,0,null,CMCSLCY.LOANDIV_AMT),'99G999G999G999D00')  AS AMT1,
						TO_CHAR(DECODE(CMCSLCY.FTSCYEAR_AMT,0,null,CMCSLCY.FTSCYEAR_AMT),'99G999G999G999D00')  AS AMT2,
						TO_CHAR(DECODE(CMCSLCY.SKSYEAR_AMT,0,null,CMCSLCY.SKSYEAR_AMT),'99G999G999G999D00') AS AMT3,
						TO_CHAR(DECODE(CMCSLCY.INSYEAR_AMT,0,null,CMCSLCY.INSYEAR_AMT),'99G999G999G999D00')  AS AMT4,
						TO_CHAR(DECODE(CMCSLCY.FSCTYEAR_AMT,0,null,CMCSLCY.FSCTYEAR_AMT),'99G999G999G999D00')  AS AMT5,
						TO_CHAR(DECODE(CMCSLCY.WFYEAR_AMT,0,null,CMCSLCY.WFYEAR_AMT),'99G999G999G999D00')  AS AMT6,
						TO_CHAR(DECODE(CMCSLCY.INSHYEAR_AMT,0,null,CMCSLCY.INSHYEAR_AMT),'99G999G999G999D00') AS AMT7,
						CMCSLCY.LOANDIV_AMT + CMCSLCY.FTSCYEAR_AMT + CMCSLCY.SKSYEAR_AMT+ CMCSLCY.INSYEAR_AMT+CMCSLCY.FSCTYEAR_AMT+CMCSLCY.WFYEAR_AMT+CMCSLCY.INSHYEAR_AMT AS TOTALDEDUCTION
					FROM 
						CMCLOSESHLNCOYEAR  CMCSLCY
					WHERE 
						 CMCSLCY.MEMBER_NO='$member_no' AND
						 CMCSLCY.ACCOUNT_YEAR = '$divyear'";
	$value2 = array('AMT1','AMT2','AMT3','AMT4','AMT5','AMT6','AMT7','TOTALDEDUCTION');
	list($Num_div2,$slip_show2)=get_value_many_oci($strSQL2,$value2);
	$loandiv_amt=$slip_show2[0][0]; //เงินกู้ปันผล
	$ftscyear_amt=$slip_show2[0][1]; //ครูไทย
	$sksyear_amt=$slip_show2[0][2]; //สมัครใจ
	$insyear_amt=$slip_show2[0][3]; //ประกัน
	$fsctyear_amt=$slip_show2[0][4]; //ชุมนุม
	$wfyear_amt=$slip_show2[0][5]; //ถาปนกิจ
	$inshyear_amt=$slip_show2[0][6]; //สคส
	$total_deduction=$slip_show2[0][7]; //รวม
?>

