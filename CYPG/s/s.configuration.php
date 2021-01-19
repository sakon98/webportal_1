<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
	$strSQLa = "SELECT value as valuestype FROM configuration where groupconfig = 'confirm' ORDER BY id ";
	$valuea = array('valuestype');
	list($valueconfig,$row_conf) = get_value_many_sql($strSQLa,$valuea);
	$confirm_day = $row_conf[0][0];
	$confirm_start = $row_conf[1][0];
	$confirm_end = $row_conf[2][0];
?>



<?php

if($_REQUEST["button"] == "ปรับปรุง"){
	$tb_update = array('1','2','3');
	$value_update[0] = ConvertDate($_REQUEST["date1"],"ad_num");
	$value_update[1] = ConvertDate($_REQUEST["date2"],"ad_num");
	$value_update[2] = ConvertDate($_REQUEST["date3"],"ad_num");
		
		for($i=0 ; $i<count($tb_update) ; $i++){
			$table = "webconfiguration";
			$condition = "WHERE  id =$tb_update[$i] ";
			$value  = " value = '".$value_update[$i]."' ";

			$status = update_value_sql($table,$condition,$value);
				if($status){
					echo '<script type="text/javascript"> window.alert("ปรับปรุงข้อมูลเรียบร้อยแล้ว") </script> ';
					echo "<script>window.location = 'administrator.php?menu=Configuration'</script>";
				}else{
					echo 'กรุณาติดต่อโปรแกรมเมอร์';
				}	
		}
}
?>

