<?php
$IPSERVER = '172.17.30.45';
	$SERVICEDB = 'gcoop';
	$USER = 'iscobtg';
	$PASSWORD = 'iscobtg';

   $objConnect = oci_connect($USER,$PASSWORD,$IPSERVER.'/'.$SERVICEDB,'AL32UTF8');                      
        
    if(!$objConnect){
        echo '<script type="text/javascript"> window.alert("ไม่สามารถเชื่อมต่อกับ ฐานข้อมูล Oracle ได้ กรุณาลองใหม่ภายหลัง") </script> ';
    }
	$member_no = $_POST["member_no"];
	
	$strSQL1 = "select count(salary_id) as salary_id_ap from mbreqappl where salary_id = '$member_no' and appl_status = '1'";
	$objParse1 = oci_parse($objConnect, $strSQL1);
	oci_execute ($objParse1,OCI_DEFAULT);
	$objResult1 = oci_fetch_array($objParse1,OCI_BOTH);
	
	$strSQL_null = "select salary_id as salary_id_ap from mbreqappl where salary_id = '$member_no' and appl_status in ('1','8')";
	$objParse_null = oci_parse($objConnect, $strSQL_null);
	oci_execute ($objParse_null,OCI_DEFAULT);
	$objResult_null = oci_fetch_array($objParse_null,OCI_BOTH);
	
	$strSQL8 = "select count(salary_id) as salary_id_ap from mbreqappl where salary_id = '$member_no' and appl_status = '8'";
	$objParse8 = oci_parse($objConnect, $strSQL8);
	oci_execute ($objParse8,OCI_DEFAULT);
	$objResult8 = oci_fetch_array($objParse8,OCI_BOTH);
	
	$strSQL2 = "select count(salary_id) as salary_id_mb  from mbmembmaster where salary_id = '$member_no' and resign_status <> 1";
	$objParse2 = oci_parse($objConnect, $strSQL2);
	oci_execute ($objParse2,OCI_DEFAULT);
	$objResult2 = oci_fetch_array($objParse2,OCI_BOTH);
	
	$strSQL_r = "select count(salary_id) as salary_id_mb  from mbmembmaster where salary_id = '$member_no' and resign_status = 1";
	$objParse_r = oci_parse($objConnect, $strSQL_r);
	oci_execute ($objParse_r,OCI_DEFAULT);
	$objResult_r = oci_fetch_array($objParse_r,OCI_BOTH);
	
	$strSQL_hr = "select count(emp_no) as emp_no_hr  from hremployee where emp_no = '$member_no'";
	$objParse_hr = oci_parse($objConnect, $strSQL_hr);
	oci_execute ($objParse_hr,OCI_DEFAULT);
	$objResult_hr = oci_fetch_array($objParse_hr,OCI_BOTH);

		/*echo $objResult1[0]; echo '<br>';  1
	echo $objResult2[0]; echo '<br>'; 0
	echo $objResult_r[0]; echo '<br>'; 1
	echo $objResult8[0];   1 */ 
	
	if($objResult_hr[0] > 0){ // คนที่ไม่มี hremployee ให้ฟ้องว่าไม่เป็นพนักงานบริษัทไม่สามารถสมัครสมาชิกสหกรณ์ได้
	
	
	if($objResult_null[0] == "" && $objResult2[0] == 0 || $objResult1[0] == 1 && $objResult_r[0] == 1 || $objResult8[0] != 1 && $objResult2[0] == 0) {
		
		$strSQL3 = "select count(1) as check_work from hremployee where emp_status = 1 and emp_no = '$member_no' and work_date < sysdate";
	        $objParse3 = oci_parse($objConnect, $strSQL3);
			oci_execute ($objParse3,OCI_DEFAULT);
			$objResult3 = oci_fetch_array($objParse3,OCI_BOTH);

		
	if($objResult3[0] == 1){
		
		
		    $strSQL5 = "select 
											FLOOR(MONTHS_BETWEEN(SYSDATE,resign_date)) as month_resign
											from mbmembmaster where resign_status = 1 and salary_id = '$member_no' and resign_date = (select max(resign_date) from mbmembmaster where resign_status = 1 and salary_id = '$member_no')";
	        $objParse5 = oci_parse($objConnect, $strSQL5);
			oci_execute ($objParse5,OCI_DEFAULT);
			$objResult5 = oci_fetch_array($objParse5,OCI_BOTH);
			
			if($objResult5[0] > 5 || $objResult5[0]  == "")  {
			
	
	$strSQL4 = "select h.prename_code,
h.emp_name,
h.emp_surname,
h.emp_ename,
h.emp_esurname,
h.sex,
h.adn_email,
h.id_card,
TO_CHAR(h.birth_date, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') as birth_date,
TO_CHAR(h.work_date, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') as contain_date,
TO_CHAR(DECODE(h.salary_amt,0,null,h.salary_amt),'99G999G999G999D00') as salary_amt,
trim(h.nation) as nation,
trim(h.work_level) as level_code,
h.memb_group as membgroup_code,
h.adn_tel,
h.adn_postcode,
TO_CHAR(h.work_str_date, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') as work_str_date,
h.position_work,
h.adn_province,
md.district_code,
(select mt.tambol_code from hremployee h1 , mbucftambol mt where md.district_code = mt.district_code(+) and trim(REPLACE(REPLACE(h1.adn_tambol,'ต.',''),'อ.','')) = trim(mt.tambol_desc(+)) and h1.emp_status = 1 and h1.emp_no = '$member_no') as tambol_code,
mup.position_code
from hremployee h , mbucfdistrict md , mbucfposition mup
where h.adn_province = md.province_code(+)
and trim(REPLACE(REPLACE(h.adn_amphur,'ต.',''),'อ.','')) = trim(md.district_desc(+))
and trim(h.position_name) = trim(mup.position_desc(+))
and h.emp_status = 1 
and h.emp_no = '$member_no'";
	$objParse4 = oci_parse($objConnect, $strSQL4);
	oci_execute ($objParse4,OCI_DEFAULT);
	$objResult4 = oci_fetch_array($objParse4,OCI_BOTH);
	$arr = array();
	$arr["prename"] = isset($objResult4[0])?$objResult4[0]:"";
	$arr["emp_name"] = isset($objResult4[1])?$objResult4[1]:"";
	$arr["emp_surname"] = isset($objResult4[2])?$objResult4[2]:"";
	$arr["emp_ename"] = isset($objResult4[3])?$objResult4[3]:"";
	$arr["emp_esurname"] = isset($objResult4[4])?$objResult4[3]:"";
	$arr["sex"] = isset($objResult4[5])?$objResult4[5]:"";
	$arr["adn_email"] = isset($objResult4[6])?$objResult4[6]:"";
	$arr["id_card"] = isset($objResult4[7])?$objResult4[7]:"";
	$arr["birth_date"] = isset($objResult4[8])?$objResult4[8]:"";
	$arr["contain_date"] = isset($objResult4[9])?$objResult4[9]:"";
	$arr["salary_amt"] =isset($objResult4[10])?$objResult4[10]:"";
	$arr["nation"] =isset($objResult4[11])?$objResult4[11]:"";
	$arr["level_code"] = isset($objResult4[12])?$objResult4[12]:"";
	$arr["membgroup_code"] = isset($objResult4[13])?$objResult4[13]:"";
	$arr["adn_tel"] =isset($objResult4[14])?$objResult4[14]:"";
	$arr["adn_postcode"] =isset($objResult4[15])?$objResult4[15]:"";
	$arr["work_str_date"] =isset($objResult4[16])?$objResult4[16]:"";
	$arr["position_work"] =isset($objResult4[17])?$objResult4[17]:"";
	$arr["province_code"] =isset($objResult4[18])?$objResult4[18]:"";
	$arr["district_code"] =isset($objResult4[19])?$objResult4[19]:"";
	$arr["tambol_code"] =isset($objResult4[20])?$objResult4[20]:"";
	$arr["position_code"] =isset($objResult4[21])?$objResult4[21]:"";
	echo json_encode($arr,JSON_UNESCAPED_UNICODE);
	
			}else{
				
				$arr = array();
	$arr["prename"] = "8";
	$arr["emp_name"] = "8";
	$arr["emp_surname"] = "8";
	$arr["emp_ename"] = "8";
	$arr["emp_esurname"] = "8";
	$arr["sex"] = "8";
	$arr["adn_email"] = "8";
	$arr["id_card"] = "8";
	$arr["birth_date"] = "8";
	$arr["contain_date"] = "8";
	$arr["salary_amt"] = "8";
	$arr["nation"] = "8";
	$arr["level_code"] = "8";
	$arr["membgroup_code"] = "8";
	$arr["adn_tel"] = "8";
	$arr["adn_postcode"] = "8";
	$arr["work_str_date"] = "8";
	$arr["position_work"] = "8";
	$arr["province_code"] = "8";
	$arr["district_code"] = "8";
	$arr["tambol_code"] = "8";
	$arr["position_code"] = "8";
	echo json_encode($arr,JSON_UNESCAPED_UNICODE);
				
				
			}
	
	}else{
		
		$arr = array();
	$arr["prename"] = "-9";
	$arr["emp_name"] = "-9";
	$arr["emp_surname"] = "-9";
	$arr["emp_ename"] = "-9";
	$arr["emp_esurname"] = "-9";
	$arr["sex"] = "-9";
	$arr["adn_email"] = "-9";
	$arr["id_card"] = "-9";
	$arr["birth_date"] = "-9";
	$arr["contain_date"] = "-9";
	$arr["salary_amt"] = "-9";
	$arr["nation"] = "-9";
	$arr["level_code"] = "-9";
	$arr["membgroup_code"] = "-9";
	$arr["adn_tel"] = "-9";
	$arr["adn_postcode"] = "-9";
    $arr["work_str_date"] = "-9";
	$arr["position_work"] = "-9";
	$arr["province_code"] = "-9";
	$arr["district_code"] = "-9";
	$arr["tambol_code"] = "-9";
	$arr["position_code"] = "-9";
	echo json_encode($arr,JSON_UNESCAPED_UNICODE);
		
	}
	
	}else{
		
		 $arr = array();
	$arr["prename"] = "0";
	$arr["emp_name"] = "0";
	$arr["emp_surname"] = "0";
	$arr["emp_ename"] = "0";
	$arr["emp_esurname"] = "0";
	$arr["sex"] = "0";
	$arr["adn_email"] = "0";
	$arr["id_card"] = "0";
	$arr["birth_date"] = "0";
	$arr["contain_date"] = "0";
	$arr["salary_amt"] = "0";
	$arr["nation"] = "0";
	$arr["level_code"] = "0";
	$arr["membgroup_code"] = "0";
	$arr["adn_tel"] = "0";
	$arr["adn_postcode"] = "0";
	$arr["work_str_date"] = "0";
	$arr["position_work"] = "0";
	$arr["province_code"] = "0";
	$arr["district_code"] = "0";
	$arr["tambol_code"] = "0";
	$arr["position_code"] = "0";
	echo json_encode($arr,JSON_UNESCAPED_UNICODE);
		
	}
	}else{
	
	$arr = array();
	$arr["prename"] = "2";
	$arr["emp_name"] = "2";
	$arr["emp_surname"] = "2";
	$arr["emp_ename"] = "2";
	$arr["emp_esurname"] = "2";
	$arr["sex"] = "2";
	$arr["adn_email"] = "2";
	$arr["id_card"] = "2";
	$arr["birth_date"] = "2";
	$arr["contain_date"] = "2";
	$arr["salary_amt"] = "2";
	$arr["nation"] = "2";
	$arr["level_code"] = "2";
	$arr["membgroup_code"] = "2";
	$arr["adn_tel"] = "2";
	$arr["adn_postcode"] = "2";
	$arr["work_str_date"] = "2";
	$arr["position_work"] = "2";
	$arr["province_code"] = "2";
	$arr["district_code"] = "2";
	$arr["tambol_code"] = "2";
	$arr["position_code"] = "2";
	echo json_encode($arr,JSON_UNESCAPED_UNICODE);
	
	
	}
	
	?>