<?php

$dbhost="localhost";
	$dbuser = "root";
	$dbpass = "WebServer";
	$conn=mysql_connect($dbhost,$dbuser,$dbpass);
	mysql_query("SET character_set_results=utf8");
    	mysql_query("SET character_set_client=utf8");
   	mysql_query("SET character_set_connection=utf8");
   	$objDB = mysql_select_db("dol");
	if (!$conn) {
		echo '<script type="text/javascript"> window.alert("ไม่สามารถเชื่อมต่อกับ ฐานข้อมูล Mysql ได้ กรุณาลองใหม่ภายหลัง") </script> ';	
	}
	
$contract_no = $_POST['contract_no'];
$member_no = $_POST['member_no'];
$seq_no = $_POST['seq_no'];
$loantype_code = $_POST['loantype_code'];
$getlast = "SELECT MAX(loanreq_docno) as loanreq_docno FROM mdbreqloan WHERE SUBSTR(loanreq_docno,1,2) = '".$loantype_code."' and member_no = '".$member_no."'";
$result = mysql_query($getlast,$conn);
$row = mysql_fetch_assoc($result);
$insertoffset = "INSERT INTO mdbreqoffset(loanrequest_no,member_no,seq_no,loancontact_no) 
VALUES('".($row['loanreq_docno'] + 1)."','".$member_no."','".$seq_no."','".$contract_no."')";
$result2 = mysql_query($insertoffset,$conn);
if($result2 == '1'){
	echo 'success';
}else{
	echo mysql_error($conn);
}
?>