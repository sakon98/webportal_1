<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php

	$strSQL = "SELECT 
					 MB.DEPTACCOUNT_NO AS MEMBER_NO,
					'' AS PRENAME,
					MB.WFACCOUNT_NAME AS NAME,
					'' AS SURNAME,
					MB.WFBIRTHDAY_DATE AS BIRTH_DATE,
					MB.CARD_PERSON AS CARD_PERSON,
					MB.CONTACT_ADDRESS AS ADDR_EMAIL,
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
					'' AS ACCUM_INTEREST
				FROM 
					WCDEPTMASTER MB,
					CMUCFCOOPBRANCH MBG1,
					WCMEMBERTYPE MBT
				WHERE 
					( MB.COOP_ID = MBG1.COOP_ID ) 
					AND ( MBG1.COOP_CONTROL ='080000'  )  
					AND ( MB.WFTYPE_CODE = MBT.WFTYPE_CODE  )  
          			AND MB.DEPTCLOSE_STATUS = '0' 
					and mb.deptaccount_no='".$_GET["member_no"]."' ";
					
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
	$pwd=trim($card_person);
	$j=0;
	
	echo $i.") member_no=".$member_no.",pwd=".$pwd.",md5=".md5($pwd)."<br/>";
	$ipconnect = $_SERVER["REMOTE_ADDR"];
	$date_log = date('Y-m-d H:i:s');
	$action_page = "Register";
	$table = "mbmembmaster";
	$condition = "(member_no,	memb_fullname,idcard,email,mobile,password,date_reg,ipconnect)";
	$value  = 	"('".$member_no."','".$full_name."','".$card_person."','".$email."',
					'".$mobile."','".md5($pwd)."','".$date_log."','".$ipconnect."')";
	$status = insert_value_sql($table,$condition,$value);
			
}
?>

