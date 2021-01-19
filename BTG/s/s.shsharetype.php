<?php
$IPSERVER = '172.17.30.45';
	$SERVICEDB = 'gcoop';
	$USER = 'iscobtg';
	$PASSWORD = 'iscobtg';

   $objConnect = oci_connect($USER,$PASSWORD,$IPSERVER.'/'.$SERVICEDB,'AL32UTF8');                      
        
    if(!$objConnect){
        echo '<script type="text/javascript"> window.alert("ไม่สามารถเชื่อมต่อกับ ฐานข้อมูล Oracle ได้ กรุณาลองใหม่ภายหลัง") </script> ';
    }
	$salary_amt = $_POST["salary_amt"];

	$strSQL4 = "select trim(TO_CHAR(DECODE((s.minshare_amt * sh.unitshare_value),0,null,(s.minshare_amt * sh.unitshare_value)),'99G999G999G999D00')) as periodshare_value from shsharetypemthrate s , shsharetype sh 
where s.sharetype_code = sh.sharetype_code and $salary_amt between start_salary and end_salary ";
	$objParse4 = oci_parse($objConnect, $strSQL4);
	oci_execute ($objParse4,OCI_DEFAULT);
	$objResult4 = oci_fetch_array($objParse4,OCI_BOTH);
	$arr = array();
	$arr["periodshare_value"] = isset($objResult4[0])?$objResult4[0]:"";
	echo json_encode($arr,JSON_UNESCAPED_UNICODE);
	?>