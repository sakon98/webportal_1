<?php
$IPSERVER = '192.168.1.101';
	$SERVICEDB = 'gcoop';
	$USER = 'iscopth';
	$PASSWORD = 'iscopth';

   $objConnect = oci_connect($USER,$PASSWORD,$IPSERVER.'/'.$SERVICEDB,'AL32UTF8');                      
        
    if(!$objConnect){
        echo '<script type="text/javascript"> window.alert("ไม่สามารถเชื่อมต่อกับ ฐานข้อมูล Oracle ได้ กรุณาลองใหม่ภายหลัง") </script> ';
    }
	$member_no = $_POST["member_no"];

	$strSQL4 = "select (case when addr_mobilephone is null then addr_phone else addr_mobilephone end) as addr_mobilephone from mbmembmaster
                    where member_no = '$member_no' ";
	$objParse4 = oci_parse($objConnect, $strSQL4);
	oci_execute ($objParse4,OCI_DEFAULT);
	$objResult4 = oci_fetch_array($objParse4,OCI_BOTH);
	$arr = array();
	$arr["addr_mobilephone"] = isset($objResult4[0])?$objResult4[0]:"";
	echo json_encode($arr,JSON_UNESCAPED_UNICODE);
	?>