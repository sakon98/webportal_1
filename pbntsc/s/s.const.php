<?php
header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
$strSQL = "SELECT 
					COOP_NAME AS COOP_NAME ,
					CHAIRMAN AS CHAIRMAN,
					MANAGER AS MANAGER,
					OFFICE_FINANCE AS OFFICE_FINANCE
				FROM 
					CMCOOPCONSTANT";
$value = array('COOP_NAME','CHAIRMAN','MANAGER','OFFICE_FINANCE'); 
list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
if($Num_Rows == 0){
	echo '<script type="text/javascript"> window.alert("ไม่พบรายการค่าคงที่ของสหกรณ์") </script> ';
	echo "<script>window.location = 'info.php'</script>";
	exit;
}
$j=0;
for($i=0;$i<$Num_Rows;$i++){
	$COOP_NAME = $list_info[$i][$j++];
	$CHAIRMAN = $list_info[$i][$j++];
	$MANAGER = $list_info[$i][$j++];
	$OFFICE_FINANCE = $list_info[$i][$j++];
	$j=0;
}

?>

