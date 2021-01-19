<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
$strSQL = "SELECT 
					SHARESTK_AMT*10 AS SHARESTK_AMT ,
					PERIODSHARE_AMT*10 AS PERIODSHARE_AMT,
					LAST_PERIOD AS LAST_PERIOD,
					(SELECT MAX(OPERATE_DATE) FROM SHSHARESTATEMENT WHERE MEMBER_NO = '$member_no') AS LASTA
				FROM 
					SHSHAREMASTER
				WHERE
					MEMBER_NO = '$member_no' 
					AND SHAREMASTER_STATUS = '1' ";
//$value = array('SHARESTK_AMT','PERIODSHARE_AMT','LAST_PERIOD','LASTA'); 
//list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
$resultData = sqlsrv_query($objConnect,$strSQL);
if($resultData == 0){
	echo '<script type="text/javascript"> window.alert("ไม่พบรายการบัญชีหุ้นของท่าน") </script> ';
	echo "<script>window.location = 'info.php'</script>";
	exit;
}
$j=0;

while($list_info = sqlsrv_fetch_array($resultData)){

$SHARE_AMT = $list_info['SHARESTK_AMT'];
$PERIODSHARE_AMT = $list_info['PERIODSHARE_AMT'];
$LAST_PERIOD = $list_info['LAST_PERIOD'];
$LASTA = $list_info['LASTA'];

}

/*for($i=0;$i<$Num_Rows;$i++){
	$SHARE_AMT = $list_info[$i][$j++];
	$PERIODSHARE_AMT = $list_info[$i][$j++];
	$LAST_PERIOD = $list_info[$i][$j++];
	$LASTA = $list_info[$i][$j++];
	$j=0;
}*/

?>

