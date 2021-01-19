<?php
@header('Content-Type: text/html; charset=tis-620');
?>

	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />

<?php

	//$strSQLa = "SELECT value as valuestype FROM configuration where groupconfig = 'confirm' ORDER BY id ";
	//$valuea = array('valuestype');
	//list($valueconfig,$row_conf) = get_value_many_sql($strSQLa,$valuea);
	//echo $confirm_day = $row_conf[0][0];
	//$confirm_start = $row_conf[1][0];
	//$confirm_end = $row_conf[2][0];
	
	$strsqln = "	SELECT 
								MUP.PRENAME_DESC || MB.MEMB_NAME ||'  '|| MB.MEMB_SURNAME AS FULLNAME
						FROM 
								MBMEMBMASTER MB,
								MBUCFPRENAME MUP				
						WHERE 
								MB.PRENAME_CODE = MUP.PRENAME_CODE
								AND MB.MEMBER_NO = '$member_no' 
					";
	$valuen = "FULLNAME";
	$fullname = get_single_value_oci($strsqln,$valuen);
	
		
	$strSQL = "SELECT 
						FROM_SYSTEM AS TYPE_SHOW,
						BIZZACCOUNT_NO AS NAME_ACC,
						BALANCE_AMT AS AMT
					FROM 
						YRCONFIRMSTATEMENT 
					WHERE 
						MEMBER_NO='$member_no' 
						AND TO_CHAR(BALANCE_DATE,'DD/MM/YYYY') = '$confirm_day'
						ORDER BY SEQ_NO ";
										
	$value = array('TYPE_SHOW','NAME_ACC','AMT');	
	list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
	
	$Num_Rows = 1;
	if($Num_Rows == 0){
		echo '<script type="text/javascript"> window.alert("ไม่พบการยืนยันยอดของท่านกรุณาติดต่อสหกรณ์") </script> ';
		echo "<script>window.location = 'info.php'</script>";
		exit;
	}
	
	$j=0; 
	for($i=0;$i<$Num_Rows;$i++){
		$type_show[$i] = $list_info[$i][$j++];
		$type_details[$i]  = $list_info[$i][$j++];
		$amt[$i]  = $list_info[$i][$j++];
		$j=0;
	}
	
	$newArray = array_count_values($type_show);
	$s_c = 0;
	$l_c  = 0;
	$d_c = 0;
	
	foreach ($newArray as $key => $value) {
		if($key == 'SHR'){
			//echo 'shr = ';
			 $s_c = $value;
		}else if($key == 'LON'){
			//echo 'lon = ';
			 $l_c = $value;
		}else if($key == 'DEP'){
			//echo 'dep = ';
			 $d_c = $value;
		}
	}
	
	
	
?>

