<?php
@header('Content-Type: text/html; charset=tis-620');
$IPSERVER = '172.17.30.45';
	$SERVICEDB = 'gcoop';
	$USER = 'iscobtg';
	$PASSWORD = 'iscobtg';

    $objConnect = oci_connect($USER,$PASSWORD,$IPSERVER.'/'.$SERVICEDB,'TH8TISASCII');                      
        
    if(!$objConnect){
        echo '<script type="text/javascript"> window.alert("ไม่สามารถเชื่อมต่อกับ ฐานข้อมูล Oracle ได้ กรุณาลองใหม่ภายหลัง") </script> ';
    }

	$member_no = $_POST["member_no"];
	$strSQL4 = "SELECT ADDR_EMAIL FROM mbmembmaster 
where member_no = '$member_no'";
	$objParse4 = oci_parse($objConnect, $strSQL4);
	oci_execute ($objParse4,OCI_DEFAULT);
	$objResult4 = oci_fetch_array($objParse4,OCI_BOTH);
        echo $objResult4["ADDR_EMAIL"];
	?>



					
						