<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php

	$strSQL = "SELECT 
					MB.MEMBER_NO AS MEMBER_NO,
					MUP.PRENAME_DESC AS PRENAME,
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
          			AND ( MB.MEMBER_STATUS > 0 AND MB.RESIGN_STATUS =0 ) ";
//					AND MB.MEMBER_NO = '$member_no' 					
/*					AND MB.RESIGN_STATUS <> '1' 
					AND MB.DEAD_STATUS <> 1 */
$value = array('MEMBER_NO','PRENAME','NAME','SURNAME','BIRTH_DATE','CARD_PERSON','ADDR_EMAIL','ADDR_PHONE','ADDR_MOBILEPHONE','MEMBER_DATE','POSITION_DESC','MEMBGROUP_DESC1','SALARY_AMOUNT','SALARY_ID','WEB_CODE','MEMBTYPE_DESC','MEMBGROUP_CODE','ACCUM_INTEREST');
list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
echo "นำเข้าข้อมูลสมาชิกทั้งหมด (".$Num_Rows.") ตั้ง Default User รหัสผ่าน คือ เลขที่บัตรประชาชน <br/>";
$j=0;
for($i=0;$i<$Num_Rows;$i++){
	$member_no=$list_info[$i][$j++];
	$full_name = $list_info[$i][$j++].''.$list_info[$i][$j++].'  '.$list_info[$i][$j++];
	$birthday = $list_info[$i][$j++];
	$card_person = trim($list_info[$i][$j++]);
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
	//$email="-";
	//$mobile="0000000000";
	$pwd=$card_person;
	$j=0;
	
	echo $i.") member_no=".$member_no.",pwd=".$pwd."<br/>";
	$ipconnect = $_SERVER["REMOTE_ADDR"];
	$date_log = date('Y-m-d H:i:s');
	$action_page = "Register";
	$table = "mbmembmaster";
	$condition = "(member_no,	memb_fullname,idcard,email,mobile,password,date_reg,ipconnect)";
	$value  = 	"('".$member_no."','".$full_name."','".$card_person."','".$email."',
					'".$mobile."','".md5($pwd)."','".$date_log."','".$ipconnect."')";
	$status = insert_value_sql($table,$condition,$value);
	
	$strSQL="update mbmembmaster set idcard='$card_person' where member_no='$member_no'";
	mysql_query($strSQL);
			
}
?>

