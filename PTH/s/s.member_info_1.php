<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
if($_POST["agree"] == "agree" ){
	$member_no = GetFormatMember($_POST["member_no"]); 
	$idchk = $_POST["idchk"];
	$phone_input= $_POST["phone_input"];
	
	// เช็คว่าบัตรประชาชนนี่มีสถานะลาออกหรือไม่
        
        /*echo $c_card_person = "select count(card_person) as c_card_person from mbmembmaster where card_person='$idchk'";
        get_single_value_sql($c_card_person,"c_card_person");  exit();*/
		
		$strSQL_CARD = "SELECT COUNT(CARD_PERSON) AS C_CARD_PERSON FROM MBMEMBMASTER WHERE CARD_PERSON='$idchk'";
		$value_card = 'C_CARD_PERSON';
		$c_card_person = get_single_value_oci($strSQL_CARD,$value_card);
        
		
        if($c_card_person > 1){
            
        // delete คนที่มีใน mbmembmaster oracle มากกว่า 2 row เป้นเคสคนที่ลาออกเเล้วมาสมัครใหม่

             $strSQL_delete = "DELETE FROM webmbmembmaster WHERE idcard = '".$idchk."' ";
             $objQuery_delete = mysql_query($strSQL_delete);
 
        }
	
	$countmemb = get_single_value_sql("select count(member_no) as countmemb from webmbmembmaster where member_no ='$member_no' ","countmemb");
	$countidcard = get_single_value_sql("select count(idcard) as countidcard from webmbmembmaster where idcard ='$idchk' ","countidcard");
	$countphone = get_single_value_sql("select count(mobile) as countphone from webmbmembmaster where mobile ='$phone_input' ","countphone");
}

	$strSQL = "SELECT MUP.PRENAME_DESC AS PRENAME,
					MB.MEMB_NAME AS NAME,
					MB.MEMB_SURNAME AS SURNAME,
					MB.BIRTH_DATE AS BIRTH_DATE,
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
					TO_CHAR(DECODE(MB.ACCUM_INTEREST,0,null,MB.ACCUM_INTEREST),'99G999G999G999D00') AS ACCUM_INTEREST
				FROM 
					MBMEMBMASTER MB,
					MBUCFPRENAME MUP,
					MBUCFMEMBGROUP MBG1,
					MBUCFMEMBTYPE MBT
				WHERE 
					( MB.MEMBGROUP_CODE = MBG1.MEMBGROUP_CODE (+)) 
					AND ( MB.PRENAME_CODE = MUP.PRENAME_CODE ) 
					AND ( MB.MEMBTYPE_CODE = MBT.MEMBTYPE_CODE )  
					AND MB.MEMBER_NO = '$member_no' 
          			AND MB.RESIGN_STATUS <> '1'  AND MB.MEMBER_NO <> '00000000'";
/*					AND MB.MEMBER_STATUS = '1'
					AND MB.DEAD_STATUS <> 1 */
$value = array('PRENAME','NAME','SURNAME','BIRTH_DATE','CARD_PERSON','ADDR_EMAIL','ADDR_PHONE','ADDR_MOBILEPHONE','MEMBER_DATE','POSITION_DESC','MEMBGROUP_DESC1','SALARY_AMOUNT','SALARY_ID','WEB_CODE','MEMBTYPE_DESC','MEMBGROUP_CODE','ACCUM_INTEREST');
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
	$j=0;
}



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

