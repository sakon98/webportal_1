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
		$divyear = $maxdiv;
	}else{
		$divyear = $_REQUEST["divyear"];
	}	
	
	$strSQL = "SELECT 
                        TO_CHAR(DECODE(CMCSLCY.SHARE_DIVIDEND,0,null,CMCSLCY.SHARE_DIVIDEND),'99G999G999G999D00') AS DIV_BALAMT,
                        TO_CHAR(DECODE(CMCSLCY.AVERAGE_RETURN,0,null,CMCSLCY.AVERAGE_RETURN),'99G999G999G999D00') AS AVG_BALAMT,
                        TO_CHAR(DECODE(0,0,null,0),'99G999G999G999D00') AS ETC_BALAMT,
                        TO_CHAR(DECODE((CMCSLCY.SHARE_DIVIDEND+CMCSLCY.AVERAGE_RETURN),0,null,(CMCSLCY.SHARE_DIVIDEND+CMCSLCY.AVERAGE_RETURN)),'99G999G999G999D00') AS SUMDIV
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


?>

