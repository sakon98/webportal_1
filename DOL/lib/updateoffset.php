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
if($_POST['type'] == 'offset'){
	$contract_no = $_POST['contract_no'];
	$req_no = $_POST['req_no'];
	$member_no = $_POST['member_no'];
	$seq_no = $_POST['seq_no'];
	$loantype_code = $_POST['loantype_code'];
	$check = (isset($_POST['check']) ? $_POST['check'] : 'unchecked');
	$deleteoffset = "DELETE FROM mdbreqoffset WHERE loanrequest_no = '".$req_no."' and loancontact_no = '".$contract_no."'";
	$result2 = mysql_query($deleteoffset,$conn);
	if($check == 'checked'){
		$insertoffset = "INSERT INTO mdbreqoffset(loanrequest_no,member_no,seq_no,loancontact_no) 
		VALUES('".$req_no."','".$member_no."','".$seq_no."','".$contract_no."')";
		$result = mysql_query($insertoffset,$conn);
	
	
		if($result2 == '1'){
			echo 'success';
		}else{
			echo mysql_error($conn);
		}
	}else{
	echo 'success';
	}
}else{
	$req_no = $_POST['req_no'];
	$etc_desc = $_POST['etc_desc'];
	$amount = $_POST['amount'];
	$member_no = $_POST['member_no'];
	$seq_no = $_POST['seq_no'];
	$loantype_code = $_POST['loantype_code'];
	$deleteetc = "DELETE FROM mdbreqpaymentetc WHERE loanrequest_no = '".$req_no."' and deception = '".$etc_desc."'";
	$result2 = mysql_query($deleteetc,$conn);
	$insertoffset = "INSERT INTO mdbreqpaymentetc(loanrequest_no,member_no,seq_no,deception,paymentetc_amt,loantype_code) 
	VALUES('".$req_no."','".$member_no."','".$seq_no."','".$etc_desc."','".$amount."','".$loantype_code."')";
	$result = mysql_query($insertoffset,$conn);
	if($result2 == '1'){
		echo 'success';
	}else{
		echo mysql_error($conn);
	}
}
?>