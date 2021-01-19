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

	$bank = $_POST["bank"];
	$strSQL4 = "SELECT branch_id as expense_branch,   branch_id || ' - ' || branch_name as branch_name FROM cmucfbankbranch 
where bank_code = '$bank' order by branch_id ASC";
	$objParse4 = oci_parse($objConnect, $strSQL4);
	oci_execute ($objParse4,OCI_DEFAULT);
	while($objResult4 = oci_fetch_array($objParse4,OCI_BOTH)){
	?>
		<option value="<?=$objResult4[0]?>"><?=$objResult4[1]?></option>
	<?php  }



					
						