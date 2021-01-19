<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
if(@$_POST["agree"] == "agree" ){
	$member_no = GetFormatMember($_POST["member_no"]); 
	$idchk = $_POST["idchk"];
	$countmemb = get_single_value_sql("select count(member_no) as countmemb from webmbmembmaster where member_no ='$member_no' ","countmemb");
	$countidcard = get_single_value_sql("select count(idcard) as countidcard from webmbmembmaster where idcard ='$idchk' ","countidcard");
}

	$strSQL = "SELECT MUP.PRENAME_DESC AS PRENAME,
					MB.MEMB_NAME AS NAME,
					MB.MEMB_SURNAME AS SURNAME,
					CONVERT(DATE,MB.BIRTH_DATE) AS BIRTH_DATE,
					MB.CARD_PERSON AS CARD_PERSON,
					MB.ADDR_EMAIL AS ADDR_EMAIL,
					MB.ADDR_PHONE AS ADDR_PHONE,
					MB.ADDR_MOBILEPHONE AS ADDR_MOBILEPHONE,
					MB.MEMBER_DATE AS MEMBER_DATE,
					MB.POSITION_DESC AS POSITION_DESC,
					MBG1.MEMBGROUP_DESC  AS MEMBGROUP_DESC1,
				  	MB.SALARY_AMOUNT AS SALARY_AMOUNT,
				  	MB.SALARY_ID AS SALARY_ID,
				  	MB.WEB_CODE AS WEB_CODE,
					MBT.MEMBTYPE_DESC AS MEMBTYPE_DESC,
					MB.MEMBGROUP_CODE AS MEMBGROUP_CODE,
					FORMAT((CASE WHEN MB.ACCUM_INTEREST = 0 THEN NULL ELSE MB.ACCUM_INTEREST END), '#,#.##') AS ACCUM_INTEREST
				FROM 
					MBMEMBMASTER MB LEFT JOIN MBUCFMEMBGROUP MBG1 ON MB.MEMBGROUP_CODE = MBG1.MEMBGROUP_CODE,
					MBUCFPRENAME MUP,
					MBUCFMEMBTYPE MBT
				WHERE 
					MB.PRENAME_CODE = MUP.PRENAME_CODE 
					AND  MB.MEMBTYPE_CODE = MBT.MEMBTYPE_CODE   
					AND MB.MEMBER_NO = '$member_no' 
          			AND MB.RESIGN_STATUS = '0' ";
/*					AND MB.RESIGN_STATUS <> '1' 
					AND MB.DEAD_STATUS <> 1 */
					/*
$value = array('PRENAME','NAME','SURNAME','BIRTH_DATE','CARD_PERSON','ADDR_EMAIL','ADDR_PHONE','ADDR_MOBILEPHONE','MEMBER_DATE','POSITION_DESC','MEMBGROUP_DESC1','SALARY_AMOUNT','SALARY_ID','WEB_CODE','MEMBTYPE_DESC','MEMBGROUP_CODE','ACCUM_INTEREST');*/
$resultData = sqlsrv_query($objConnect,$strSQL);
//echo $Num_Rows;
$j=0;
while($rowDataMS = sqlsrv_fetch_array($resultData)){
	$full_name = $rowDataMS['PRENAME'].''.$rowDataMS['NAME'].' ' .$rowDataMS['SURNAME'];
	$birthday = $rowDataMS['BIRTH_DATE'];
	$birthday = $birthday->format('d-m-Y');
	$card_person = $rowDataMS['CARD_PERSON'];
	$email = $rowDataMS['ADDR_EMAIL'];
	$phone = $rowDataMS['ADDR_PHONE'];
	$mobile = $rowDataMS['ADDR_MOBILEPHONE'];
	$member_date = $rowDataMS['MEMBER_DATE'];
	$member_date = $member_date->format('d-m-Y');
	$position = $rowDataMS['POSITION_DESC'];
	$membgroup = $rowDataMS['MEMBGROUP_DESC1'];
	$salary = $rowDataMS['SALARY_AMOUNT'];
	$salary_id = $rowDataMS['SALARY_ID'];
	$web_code = $rowDataMS['WEB_CODE'];
	$member_type = $rowDataMS['MEMBTYPE_DESC'];
	$membgroup_code = $rowDataMS['MEMBGROUP_CODE'];
	$accum_interest = $rowDataMS['ACCUM_INTEREST'];
}




/*$strSQL2 = "SELECT COUNT(CARD_PERSON) AS WF3 FROM WCDEPTMASTER WHERE CARD_PERSON ='$card_person' ";
//$value2 = 'WF3';
$wf3 = sqlsrv_query($objConnect,$strSQL2);

$chkdate1 = date('01-10-2006');
$chkdate2 = date($member_date);

$showpay_wf = count_member($member_date,'m');
	if($showpay_wf < 12){
		$pay_wf = "110000";
	}else if($showpay_wf >= 12 and $showpay_wf < 36 ){
		$pay_wf = "120000";
	}else if($showpay_wf >= 36 and $showpay_wf < 60 ){
		$pay_wf = "130000";
	}else if($showpay_wf >= 60 and $showpay_wf < 84 ){
		$pay_wf = "150000";
	}else if($showpay_wf >= 84 and $showpay_wf < 120 ){
		$pay_wf = "160000";
	}else if($showpay_wf >= 120 and $showpay_wf < 180 ){
		$pay_wf = "190000";
	}else if($showpay_wf >= 180 and $showpay_wf < 240 ){
		$pay_wf = "220000";
	}else if($showpay_wf >= 240 and $showpay_wf < 300 ){
		$pay_wf = "250000";
	}else if($showpay_wf >= 300 and $showpay_wf < 360 ){
		$pay_wf = "280000";
	}else if($showpay_wf >= 360 and $showpay_wf < 420 ){
		$pay_wf = "310000";	
	}else if($showpay_wf >= 420 ){
		$pay_wf = "350000";
	}*/
?>

