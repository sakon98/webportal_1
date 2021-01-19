<?php
header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
//echo $member_no;
$strMySQL = "SELECT 	id,date_log,action_do,ipconnect,connectby FROM log_action where user = '$member_no' order by id desc LIMIT 0 , 10";
$colunmMySQL = array('id','date_log','action_do','ipconnect','connectby');
list($rowSQL,$listMySql) = get_value_many_sql($strMySQL,$colunmMySQL);
$ms = 0;
for($sq = 0 ; $sq < $rowSQL ; $sq++){
	$log_id[$sq] = $listMySql[$sq][$ms++]; 
	$log_date_log[$sq] = $listMySql[$sq][$ms++]; 
	$log_action_do[$sq] = $listMySql[$sq][$ms++]; 
	$log_ipconnect[$sq] = $listMySql[$sq][$ms++]; 
	$log_connectby[$sq] = $listMySql[$sq][$ms++]; 
	$ms = 0;
	}
?>
<table width="700" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="#999999"><table width="700" border="0" cellpadding="3" cellspacing="1">
      <tr>
        <td width="189" height="25" align="center" bgcolor="#ab25dd"><strong><font color="#FFFFFF">วันเวลา</font></strong></td>
        <td width="191" align="center" bgcolor="#ab25dd"><strong><font color="#FFFFFF">ดำเนินการ</font></strong></td>
        <td width="149" align="center" bgcolor="#ab25dd"><strong><font color="#FFFFFF">IP Address</font></strong></td>
        <td width="142" align="center" bgcolor="#ab25dd"><strong><font color="#FFFFFF">อุปกรณ์เชื่อมต่อ</font></strong></td>
      </tr>
 <?php   for($sq = 0 ; $sq < $rowSQL ; $sq++){    ?>
      <tr>
        <td height="25" align="center" bgcolor="#FFFFFF"><?=$log_date_log[$sq]?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$log_action_do[$sq]?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$log_ipconnect[$sq]?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$log_connectby[$sq]?></td>
      </tr>
<?php } ?>
    </table></td>
  </tr>
</table>
