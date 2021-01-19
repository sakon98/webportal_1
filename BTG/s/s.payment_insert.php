<?php
$IPSERVER = '192.168.1.231';
	$SERVICEDB = 'gcoop';
	$USER = 'iscomhs';
	$PASSWORD = 'iscomhs';
 $objConnect = oci_connect($USER,$PASSWORD,$IPSERVER.'/'.$SERVICEDB,'UTF8'); 
 
$dbhost="localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "webportal";
$conn= new mysqli($dbhost,$dbuser,$dbpass,$dbname);

if(isset($_POST["expense_branch"])){
	$expense_branch = $_POST["expense_branch"];
	$member_no = $_POST["member_no"];
	$coop_id = $_POST["coop_id"];
	$item_payment = $_POST["item_payment"];
	$moneytype_code = $_POST["moneytype_code"];
	$expense_bank = $_POST["expense_bank"];
	$expense_accid = $_POST["expense_accid"];
	$entry_date = $_POST["entry_date"];
	$approve_status = $_POST["approve_status"];
	$selcoop = "SELECT coop_control FROM cmcoopmaster where coop_id = '".$coop_id."' ";
	$objParse = oci_parse($objConnect, $selcoop);
	oci_execute ($objParse,OCI_DEFAULT);
	$objResult = oci_fetch_array($objParse,OCI_BOTH);
	$coop_control = $objResult["COOP_CONTROL"];
	$today = getdate();
	$countrd = "select count(LOANREQUEST_DOCNO) as count from LNREQMTHPAY";
	$result2 = $conn->query($countrd);
	$row2 = $result2->fetch_assoc();
	$loanrd = 'LRD'.$row2["count"].$today["mday"].$today["mon"].$today["year"];
	$insql = "INSERT INTO LNREQMTHPAY(COOP_ID,COOP_CONTROL,LOANREQUEST_DOCNO,MEMBER_NO,ITEM_PAYMENT,
	OPERATE_DATE,ENTRY_DATE,MONEYTYPE_CODE,EXPENSE_BANK,EXPENSE_BRANCH,EXPENSE_ACCID,APPROVE_STATUS) 
	VALUES('".$coop_id."','".$coop_control."','".$loanrd."','".$member_no."','".$item_payment."',NOW(),
	'".$entry_date."','".$moneytype_code."','".$expense_bank."','".$expense_branch."','".$expense_accid."',
	'".$approve_status."')";
	if($conn->query($insql) === TRUE){
		echo "<script language=\"JavaScript\">";
		echo "alert('เสร็จเรียบร้อยค่ะ');";
		echo "</script>";
	}else{
		echo "<script language=\"JavaScript\">";
		echo "alert('กรุณาลองใหม่ค่ะ');";
		echo "</script>";
	}
}else{
		echo "<script language=\"JavaScript\">";
		echo "alert('กรุณากรอกข้อมูลให้ครบถ้วน');";
		echo "</script>";
}
?>