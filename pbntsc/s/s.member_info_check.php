<?php
header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
if($_POST["agree"] == "agree" ){
	$member_no = GetFormatMember($_POST["member_no"]); 
	$member_no  = str_replace('เธช', 'ส', $member_no);
	$idchk = $_POST["idchk"];
	$web_codechk = $_POST["web_codechk"];	
	$countmemb = get_single_value_sql("select count(member_no) as countmemb from mbmembmaster where member_no ='$member_no' ","countmemb");
	$countidcard = get_single_value_sql("select count(idcard) as countidcard from mbmembmaster where idcard ='$idchk' ","countidcard");
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
					TO_CHAR(DECODE(MB.ACCUM_INTEREST,0,null,MB.ACCUM_INTEREST),'99G999G999G999D00') AS ACCUM_INTEREST,
					MB.EXPENSE_ACCID AS EXPENSE_ACCID
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
          			        AND MB.MEMBER_STATUS = '1'
					AND MB.RESIGN_STATUS <> '1' 
					AND MB.DEAD_STATUS <> 1";
$value = array('PRENAME','NAME','SURNAME','BIRTH_DATE','CARD_PERSON','ADDR_EMAIL','ADDR_PHONE','ADDR_MOBILEPHONE','MEMBER_DATE','POSITION_DESC','MEMBGROUP_DESC1','SALARY_AMOUNT','SALARY_ID','WEB_CODE','MEMBTYPE_DESC','MEMBGROUP_CODE','ACCUM_INTEREST','BANK_DESC','EXPENSE_ACCID');
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
        $bank_desc = $list_info[$i][$j++];
        $expense_accid = $list_info[$i][$j++];
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


$strSQL3 = "	SELECT 
						WM.DEPTACCOUNT_NO AS WFMEMBER_NO,
						WFACCOUNT_NAME AS WF_NAME,
						WMT.WCMEMBERTYPE_DESC AS TYPE_DESC
					FROM 
						WCDEPTMASTER WM ,WCMEMBERTYPE WMT
					WHERE 
						WM.WFTYPE_CODE = WMT.WFTYPE_CODE 
						AND member_no='$member_no'
						ORDER BY WMT.WFTYPE_CODE ";
$value3 = array('WFMEMBER_NO','WF_NAME', 'TYPE_DESC');
list($Num_Rows3,$list_info3) = get_value_many_oci($strSQL3,$value3);
$j=0;
for($i=0;$i<$Num_Rows;$i++){
	$wfmember_no[$i] = $list_info3[$i][$j++];
	$wfname[$i] = $list_info3[$i][$j++];
	$wftype_desc[$i] = $list_info3[$i][$j++];
	$j=0;
}

$strSQL4 = "SELECT 
					MB.ADDR_NO AS ADDR_NO, 
                                        MB.ADDR_MOO AS ADDR_MOO,
					MB.ADDR_SOI AS ADDR_SOI,
					MB.ADDR_VILLAGE AS ADDR_VILLAGE,
					MB.ADDR_ROAD AS ADDR_ROAD,
					MBT.TAMBOL_DESC AS TAMBOL_DESC,
					MBD.DISTRICT_DESC AS DISTRICT_DESC,
					MBP.PROVINCE_DESC AS PROVINCE_DESC, 
					MBD.POSTCODE AS ADDR_POSTCODE
					

				FROM 
					MBMEMBMASTER MB,
					MBUCFDISTRICT MBD, 
					MBUCFPROVINCE MBP, 
					MBUCFTAMBOL MBT
				WHERE 
 
					 MB.MEMBER_NO = '$member_no'
          			AND MB.MEMBER_STATUS = '1'
					AND MB.RESIGN_STATUS <> '1'
					AND MB.TAMBOL_CODE = MBT.TAMBOL_CODE
					AND MB.AMPHUR_CODE = MBD.DISTRICT_CODE
					AND MB.PROVINCE_CODE = MBP.PROVINCE_CODE";
$value4 = array('ADDR_NO','ADDR_MOO','ADDR_SOI','ADDR_VILLAGE','ADDR_ROAD','TAMBOL_DESC','DISTRICT_DESC','PROVINCE_DESC','ADDR_POSTCODE');
list($Num_Rows4,$list_info4) = get_value_many_oci($strSQL4,$value4);
//echo $Num_Rows;

for($i=0;$i<$Num_Rows4;$i++){
    
         $ADDR_NO = $list_info4[$i][$j++];
         $ADDR_MOO = $list_info4[$i][$j++];
         $ADDR_SOI = $list_info4[$i][$j++];
         $ADDR_VILLAGE = $list_info4[$i][$j++];
         $ADDR_ROAD = $list_info4[$i][$j++];
         $TAMBOL_DESC = $list_info4[$i][$j++];
         $DISTRICT_DESC = $list_info4[$i][$j++];
         $PROVINCE_DESC = $list_info4[$i][$j++];
         $ADDR_POSTCODE = $list_info4[$i][$j++];
    
       /*  if($ADDR_MOO == "" ){
             
                $full_addr = $ADDR_NO .' เเขวง'.$TAMBOL_DESC.' เขต'.$DISTRICT_DESC.' จ.'.$PROVINCE_DESC.' '.$ADDR_POSTCODE;
         }
         elseif ($ADDR_MOO != "" && $PROVINCE_DESC == 'กรุงเทพมหานคร') {
             
              $full_addr = $ADDR_NO .' เเขวง'.$TAMBOL_DESC.' เขต'.$DISTRICT_DESC.' จ.'.$PROVINCE_DESC.' '.$ADDR_POSTCODE;
   
     }
         elseif ($ADDR_MOO != "" && $PROVINCE_DESC == 'กรุงเทพมหานคร') {
             
             $full_addr = $ADDR_NO .' หมู่ '.$ADDR_MOO.' เเขวง'.$TAMBOL_DESC.' เขต'.$DISTRICT_DESC.' จ.'.$PROVINCE_DESC.' '.$ADDR_POSTCODE;
   
     }
     elseif ($ADDR_MOO != "" && $PROVINCE_DESC != 'กรุงเทพมหานคร') {
         
         $full_addr = $ADDR_NO .' ต.'.$TAMBOL_DESC.' อ.'.$DISTRICT_DESC.' จ.'.$PROVINCE_DESC.' '.$ADDR_POSTCODE;
     }
     elseif ($ADDR_MOO != "" && $PROVINCE_DESC != 'กรุงเทพมหานคร') {
         
         $full_addr = $ADDR_NO .' หมู่ '.$ADDR_MOO.' ต.'.$TAMBOL_DESC.' อ.'.$DISTRICT_DESC.' จ.'.$PROVINCE_DESC.' '.$ADDR_POSTCODE;
     }*/
         if($ADDR_MOO == ""){
             
             $ADDR_MOO = ' -';
         }
         if($ADDR_SOI == ""){
             
             $ADDR_SOI = ' -';
         }
         if($ADDR_VILLAGE == ""){
             
             $ADDR_VILLAGE = ' -';
         }
         if($ADDR_ROAD == ""){
             
             $ADDR_ROAD = ' -';
         }
         if($ADDR_ROAD == ""){
             
             $ADDR_ROAD = ' -';
         }
         if($TAMBOL_DESC == ""){
             
             $TAMBOL_DESC = ' -';
         }
         if($DISTRICT_DESC == ""){
             
             $DISTRICT_DESC = ' -';
         }
         if($PROVINCE_DESC == ""){
             
             $PROVINCE_DESC = ' -';
         }
         if($ADDR_POSTCODE == ""){
             
             $ADDR_POSTCODE = ' -';
         }
         
     
     if ($PROVINCE_DESC == 'กรุงเทพมหานคร') {
             
             $full_addr = $ADDR_NO .' หมู่.'.$ADDR_MOO .' ซอย.'.$ADDR_SOI.' ชื่อหมู่บ้าน'.$ADDR_VILLAGE.' ถนน.'.$ADDR_ROAD .' เเขวง'.$TAMBOL_DESC.' เขต'.$DISTRICT_DESC.' จ.'.$PROVINCE_DESC.' '.$ADDR_POSTCODE;
         }
         elseif ($PROVINCE_DESC != 'กรุงเทพมหานคร') {
             
             $full_addr = $ADDR_NO .' หมู่.'.$ADDR_MOO .' ซอย.'.$ADDR_SOI.' ชื่อหมู่บ้าน'.$ADDR_VILLAGE.' ถนน.'.$ADDR_ROAD .' ตำบล'.$TAMBOL_DESC.' อำเภอ'.$DISTRICT_DESC.' จ.'.$PROVINCE_DESC.' '.$ADDR_POSTCODE;
   
     }
         
	
        
}

?>

