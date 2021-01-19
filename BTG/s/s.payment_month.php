<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
$strSQL = "select coop_id,recv_period,sum(adjust_prnamt) as prnamt,sum(adjust_intamt) as intamt from kpmastreceivedet 
where keepitem_status <>1 and (adjust_prnamt >0 or adjust_intamt >0) and member_no = '".$member_no."'
group by recv_period,coop_id order by recv_period ASC";
$value = array('COOP_ID','RECV_PERIOD','PRNAMT','INTAMT');
list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
$j=0;
for($i=0;$i<$Num_Rows;$i++) { 
		$coop_id = $list_info[$i][0];
		$recv_period = $list_info[$i][1];
		$prnamt = $list_info[$i][2];
		$intamt = $list_info[$i][3];
		$adjprn = $adjprn + $prnamt;
		$adjint = $adjint + $intamt;
}
	$sumamt = $adjprn + $adjint;
?>

