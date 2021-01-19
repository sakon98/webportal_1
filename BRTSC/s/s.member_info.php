<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
if($_POST["agree"] == "agree" ){
	$member_no = GetFormatMember($_POST["member_no"]); 
	$idchk = $_POST["idchk"];
	$idhbd = $_POST["idhbd"];
	$countmemb = get_single_value_sql("select count(member_no) as countmemb from webmbmembmaster where member_no ='$member_no' ","countmemb");
	$countidcard = get_single_value_sql("select count(idcard) as countidcard from webmbmembmaster where idcard ='$idchk' ","countidcard");
}


    $slip_date = $_POST["slip_date"];
		
	    $strSQL_C1 = "SELECT MAX(RECV_PERIOD) AS C1 FROM KPTEMPRECEIVEDET WHERE MEMBER_NO = '$member_no'";
		$value_c1 = ('C1');
		$c1 = get_single_value_oci($strSQL_C1,$value_c1);
		
		if($slip_date == ""){
			
		$slip_date = $c1;
			
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
					TO_CHAR(DECODE(MB.ACCUM_INTEREST,0,null,MB.ACCUM_INTEREST),'99G999G999G999D00') AS ACCUM_INTEREST1,
					(select TO_CHAR(DECODE(interest_accum,0,null,interest_accum),'99G999G999G999D00') from kptempreceive where member_no = '$member_no' and recv_period = '$slip_date') as ACCUM_INTEREST,
					to_char(MB.BIRTH_DATE,'DD') || ' ' ||  (case when to_char(MB.BIRTH_DATE,'MM') = '01' then 'ม.ค.'
                               when to_char(MB.BIRTH_DATE,'MM') = '02' then 'ก.พ.'
                               when to_char(MB.BIRTH_DATE,'MM') = '03' then 'มี.ค.'
						    when to_char(MB.BIRTH_DATE,'MM') = '04' then 'เม.ย.'
					         when to_char(MB.BIRTH_DATE,'MM') = '05' then 'พ.ค.'
						    when to_char(MB.BIRTH_DATE,'MM') = '06' then 'มิ.ย.'
							when to_char(MB.BIRTH_DATE,'MM') = '07' then 'ก.ค.'
							when to_char(MB.BIRTH_DATE,'MM') = '08' then 'ส.ค.'
							when to_char(MB.BIRTH_DATE,'MM') = '09' then 'ก.ย.'
							when to_char(MB.BIRTH_DATE,'MM') = '10' then 'ต.ค.'
							when to_char(MB.BIRTH_DATE,'MM') = '11' then 'พ.ย.'
                               when to_char(MB.BIRTH_DATE,'MM') = '12'  then 'ธ.ค.'
                          else '' end ) || ' ' ||
                      to_char(to_number(to_char(MB.BIRTH_DATE,'YYYY') +543 )) as YEAR_B,
					  to_char(MB.MEMBER_DATE,'DD') || ' ' ||  (case when to_char(MB.MEMBER_DATE,'MM') = '01' then 'ม.ค.'
                               when to_char(MB.MEMBER_DATE,'MM') = '02' then 'ก.พ.'
                               when to_char(MB.MEMBER_DATE,'MM') = '03' then 'มี.ค.'
						    when to_char(MB.MEMBER_DATE,'MM') = '04' then 'เม.ย.'
					         when to_char(MB.MEMBER_DATE,'MM') = '05' then 'พ.ค.'
						    when to_char(MB.MEMBER_DATE,'MM') = '06' then 'มิ.ย.'
							when to_char(MB.MEMBER_DATE,'MM') = '07' then 'ก.ค.'
							when to_char(MB.MEMBER_DATE,'MM') = '08' then 'ส.ค.'
							when to_char(MB.MEMBER_DATE,'MM') = '09' then 'ก.ย.'
							when to_char(MB.MEMBER_DATE,'MM') = '10' then 'ต.ค.'
							when to_char(MB.MEMBER_DATE,'MM') = '11' then 'พ.ย.'
                               when to_char(MB.MEMBER_DATE,'MM') = '12'  then 'ธ.ค.'
                          else '' end ) || ' ' ||
                      to_char(to_number(to_char(MB.MEMBER_DATE,'YYYY') +543 )) as YEAR_M,
TRUNC(MONTHS_BETWEEN (SYSDATE,MB.MEMBER_DATE ) /12 )  || ' ปี' || ' ' ||
                 TRUNC(MOD(MONTHS_BETWEEN(SYSDATE,MB.MEMBER_DATE),12)) || ' เดือน' as AGE_M,
TRUNC(MONTHS_BETWEEN (SYSDATE,MB.BIRTH_DATE ) /12 )  || ' ปี' || ' ' ||
                 TRUNC(MOD(MONTHS_BETWEEN(SYSDATE,MB.BIRTH_DATE),12)) || ' เดือน' as AGE_B
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
          			AND MB.RESIGN_STATUS <> '1' ";
/*					AND MB.RESIGN_STATUS <> '1' 
					AND MB.DEAD_STATUS <> 1 */
$value = array('PRENAME','NAME','SURNAME','BIRTH_DATE','CARD_PERSON','ADDR_EMAIL','ADDR_PHONE','ADDR_MOBILEPHONE','MEMBER_DATE','POSITION_DESC','MEMBGROUP_DESC1','SALARY_AMOUNT','SALARY_ID','WEB_CODE','MEMBTYPE_DESC','MEMBGROUP_CODE','ACCUM_INTEREST1','ACCUM_INTEREST','YEAR_B','YEAR_M','AGE_M','AGE_B');
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
	$accum_interest_mb = $list_info[$i][$j++];
	$accum_interest = $list_info[$i][$j++];
	$year_b = $list_info[$i][$j++];
	$year_m = $list_info[$i][$j++];
	$age_m = $list_info[$i][$j++];
	$age_b = $list_info[$i][$j++];
	$j=0;
}

$strSQL2 = "SELECT 
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
					AND MB.RESIGN_STATUS <> '1'
					AND MB.TAMBOL_CODE = MBT.TAMBOL_CODE(+)
					AND MB.AMPHUR_CODE = MBD.DISTRICT_CODE(+)
					AND MB.PROVINCE_CODE = MBP.PROVINCE_CODE(+)";
$value2 = array('ADDR_NO','ADDR_MOO','ADDR_SOI','ADDR_VILLAGE','ADDR_ROAD','TAMBOL_DESC','DISTRICT_DESC','PROVINCE_DESC','ADDR_POSTCODE');
list($Num_Rows2,$list_info2) = get_value_many_oci($strSQL2,$value2);
//echo $Num_Rows;

for($i=0;$i<$Num_Rows2;$i++){
    
         $ADDR_NO = $list_info2[$i][$j++];
         $ADDR_MOO = $list_info2[$i][$j++];
         $ADDR_SOI = $list_info2[$i][$j++];
         $ADDR_VILLAGE = $list_info2[$i][$j++];
         $ADDR_ROAD = $list_info2[$i][$j++];
         $TAMBOL_DESC = $list_info2[$i][$j++];
         $DISTRICT_DESC = $list_info2[$i][$j++];
         $PROVINCE_DESC = $list_info2[$i][$j++];
         $ADDR_POSTCODE = $list_info2[$i][$j++];

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
             
              $full_addr = $ADDR_NO .' หมู่ '.$ADDR_MOO .' ซ.'.$ADDR_SOI.' หมู่บ้าน'.$ADDR_VILLAGE.' ถ.'.$ADDR_ROAD .' เเขวง'.$TAMBOL_DESC.' เขต'.$DISTRICT_DESC.' จ.'.$PROVINCE_DESC.' '.$ADDR_POSTCODE;
         }
         elseif ($PROVINCE_DESC != 'กรุงเทพมหานคร') {
             
             $full_addr = $ADDR_NO .' หมู่ '.$ADDR_MOO .' ซ.'.$ADDR_SOI.' หมู่บ้าน'.$ADDR_VILLAGE.' ถ.'.$ADDR_ROAD .' ต.'.$TAMBOL_DESC.' อ.'.$DISTRICT_DESC.' จ.'.$PROVINCE_DESC.' '.$ADDR_POSTCODE;
   
     }
         
	
        
}





/*$strSQL2 = "SELECT COUNT(CARD_PERSON) AS WF3 FROM WCDEPTMASTER WHERE CARD_PERSON ='$card_person' ";
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
	}*/
?>

