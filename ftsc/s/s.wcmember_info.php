<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
if($_POST["agree"] == "agree" ){
	$member_no = GetFormatMember($_POST["member_no"]); 
	$idchk = $_POST["idchk"];
	$countmemb = get_single_value_sql("select count(member_no) as countmemb from mbmembmaster where member_no ='$member_no' ","countmemb");
	$countidcard = get_single_value_sql("select count(idcard) as countidcard from mbmembmaster where idcard ='$idchk' ","countidcard");
}

	$strSQL = "SELECT 
					trim(MB.DEPTACCOUNT_NO) AS MEMBER_NO,
					'' AS PRENAME,
					MB.WFACCOUNT_NAME AS NAME,
					'' AS SURNAME,
					MB.WFBIRTHDAY_DATE AS BIRTH_DATE,
					trim(MB.CARD_PERSON) AS CARD_PERSON,
					'' AS ADDR_EMAIL,
					MB.PHONE AS ADDR_PHONE,
					MB.PHONE AS ADDR_MOBILEPHONE,
					MB.DEPTOPEN_DATE AS MEMBER_DATE,
					MB.CARREER AS POSITION_DESC,
					MBG1.COOPBRANCH_DESC  AS MEMBGROUP_DESC1,
				  	MB.DEPTMONTH_AMT AS SALARY_AMOUNT,
				  	'' AS SALARY_ID,
				  	'' AS WEB_CODE,
					MBT.WCMEMBERTYPE_DESC AS MEMBTYPE_DESC,
					MB.MEMBGROUP_CODE AS MEMBGROUP_CODE,
					'' AS ACCUM_INTEREST,
					TO_CHAR(MB.PRNCBAL,'99G999G999G999D00') as PRNCBAL,
					MB.TOTAL_AGE as TOTAL_AGE,
					MB.DIE_DATE as DIE_DATE,
					MB.MATE_NAME as MATE_NAME,
					MB.MANAGE_CORPSE_NAME as MANAGE_CORPSE_NAME,
					MB.CONTACT_ADDRESS||' อ.'||(select p.district_desc from mbucfdistrict p where p.district_code = mb.ampher_code)||' จ.'||(select p.province_desc from mbucfprovince p where p.province_code = mb.province_code)||' '||MB.postcode as OTHER_CONTACT_ADDRESS,
					MB.MEMBER_NO as MEMBER_NO_
				FROM 
					WCDEPTMASTER MB,
					CMUCFCOOPBRANCH MBG1,
					WCMEMBERTYPE MBT
				WHERE 
					( MB.COOP_ID = MBG1.COOP_ID ) 
					AND ( MBG1.COOP_CONTROL ='010000'  )  
					AND ( MB.WFTYPE_CODE = MBT.WFTYPE_CODE  )  
          			AND MB.DEPTCLOSE_STATUS = '0' 
					AND trim(MB.DEPTACCOUNT_NO) = '$member_no' ";
/*					AND MB.RESIGN_STATUS <> '1' 
					AND MB.DEAD_STATUS <> 1 */
$value = array('PRENAME','NAME','SURNAME','BIRTH_DATE','CARD_PERSON','ADDR_EMAIL','ADDR_PHONE','ADDR_MOBILEPHONE','MEMBER_DATE','POSITION_DESC','MEMBGROUP_DESC1','SALARY_AMOUNT','SALARY_ID','WEB_CODE','MEMBTYPE_DESC','MEMBGROUP_CODE','ACCUM_INTEREST'
						,'PRNCBAL','TOTAL_AGE','DIE_DATE','MATE_NAME','MANAGE_CORPSE_NAME','OTHER_CONTACT_ADDRESS','MEMBER_NO_');
list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
//echo $Num_Rows;
$j=0;
for($i=0;$i<$Num_Rows;$i++){
	$full_name = $list_info[$i][$j++].''.$list_info[$i][$j++].'  '.$list_info[$i][$j++];
	$birthday = $list_info[$i][$j++];
	$card_person = $list_info[$i][$j++];
	$email = $list_info[$i][$j++];
	$phone = $list_info[$i][$j++];
	$mobile = $list_info[$i][$j++];
	$member_date = $list_info[$i][$j++];
	$position = $list_info[$i][$j++];
	$membgroup = $list_info[$i][$j++];
	$salary = $list_info[$i][$j++];
	$salary_id = $list_info[$i][$j++];
	$web_code = $list_info[$i][$j++];
	$member_type = $list_info[$i][$j++];
	$membgroup_code = $list_info[$i][$j++];
	$accum_interest = $list_info[$i][$j++];
	$prncbal = $list_info[$i][$j++];
	$totalage=$list_info[$i][$j++];
	$die_date=$list_info[$i][$j++];
	$mate_name=$list_info[$i][$j++];
	$manage_corpse_name=$list_info[$i][$j++];
	$other_contact_address=$list_info[$i][$j++];
	$member_no_coop=$list_info[$i][$j++];
	$j=0;
}

$strSQL1 = " SELECT 
						MEMBER_CARD AS WF1,
						(SELECT count(mumembtype_code) FROM mumembmaster WHERE MEMBER_NO = '$member_no' AND mumembtype_code = '02') AS WF2
					FROM 
						MBMEMBMASTER 
					WHERE
						MEMBER_NO = '$member_no' ";
$value1 = array('WF1','WF2');
list($Num_Rows1,$list_wf) = get_value_many_oci($strSQL1,$value1);
$wf1 = $list_wf[0][0];
$wf2 = $list_wf[0][1];

$strSQL2 = "SELECT COUNT(CARD_PERSON) AS WF3 FROM WCDEPTMASTER WHERE CARD_PERSON ='$card_person' ";
$value2 = 'WF3';
$wf3 = get_single_value_oci($strSQL2,$value2);

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
	}
?>

