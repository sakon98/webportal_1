<?php
header('Content-Type: text/html; charset=tis-620');
$IPSERVER = '172.17.30.45';
	$SERVICEDB = 'gcoop';
	$USER = 'iscobtg';
	$PASSWORD = 'iscobtg';

    $objConnect = oci_connect($USER,$PASSWORD,$IPSERVER.'/'.$SERVICEDB,'TH8TISASCII');                      
        
    if(!$objConnect){
        echo '<script type="text/javascript"> window.alert("ไม่สามารถเชื่อมต่อกับ ฐานข้อมูล Oracle ได้ กรุณาลองใหม่ภายหลัง") </script> ';
    }

	$card_person = $_POST["card_person"];
	$strSQL4 = "select count(card_person) as count_card from mbreqappl where card_person = '$card_person' and appl_status <> 1";
	$objParse4 = oci_parse($objConnect, $strSQL4);
	oci_execute ($objParse4,OCI_DEFAULT);
	$objResult4 = oci_fetch_array($objParse4,OCI_BOTH);
	
	$strSQL5 = "select count(card_person) as count_card from mbmembmaster where card_person = '$card_person' and resign_status <> 1";
	$objParse5 = oci_parse($objConnect, $strSQL5);
	oci_execute ($objParse5,OCI_DEFAULT);
	$objResult5 = oci_fetch_array($objParse5,OCI_BOTH);
	
	if($objResult4[0]>0 || $objResult5[0]>0){
		echo '1';
	}else{
		echo '0';
	}


					
						?>