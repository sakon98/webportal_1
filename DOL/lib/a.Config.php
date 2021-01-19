<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <link rel="stylesheet" href="../css/validationEngine.jquery.css" type="text/css">
	<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />	
    <script src="../js/jquery-1.6.min.js" type="text/javascript"></script>
	<script src="../js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="tis-620"></script>
	<script src="../js/jquery.validationEngine.js" type="text/javascript" charset="tis-620"></script>
	<script type="text/javascript">
				jQuery(document).ready(function(){
						jQuery("#formID1").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});
			});
     </script>
	 
	 <?php
	 
	    $strSQL = " select time_out , expire from config_mode ";
		$value = array('time_out','expire');
		list($Num_Rows,$list_info) = get_value_many_sql($strSQL,$value);
		$time_out = $list_info[0][0];
		$expire = $list_info[0][1];
	 
	 
	 ?>
	 
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"><strong><font size="4" face="Tahoma">เปลี่ยนรหัสผ่าน</font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Change Password</font></td>
  </tr>
  <tr>
    <td align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<form id="formID1" name="formID1" method="post" action="">
  <table width="427" border="0" align="center" cellpadding="6" cellspacing="2">
   
    <tr>
      <td width="140" align="right">เวลา Timeout / นาที:</td>
      <td width="280" align="left"><center><input name="timeout" type="text" id="timeout" size="25" value="<?php echo intval($time_out) ;?>" autocomplete="off" /></center>
      
      </td>
    </tr>
    <tr>
      <td align="right">Expire date / วัน :</td>
      <td align="left"><center><input name="expire" type="text" id="expire" size="25" value="<?php echo intval($expire) ;?>" autocomplete="off" /></center>
      
      </td>
    </tr>
  </table>
 
  <table width="400" border="0" align="center" cellpadding="6" cellspacing="2">
    
   
    <tr>
      <td align="center"><input type="submit" name="button" id="button" value="ยืนยัน" />
      <input name="Config" type="hidden" id="Config" value="Config" /></td>
    </tr>
  </table>

<?php
if($_POST["Config"] != null){

$timeout=$_POST["timeout"];
$expire=$_POST["expire"];
	

			$table="config_mode";
			$value="time_out = ".$timeout." , expire = ".$expire."";
			$condition="where id = 1";
			if(update_value_sql($table,$condition,$value)){
					echo '<script type="text/javascript"> window.alert("ระบบได้บันทึกค่าคงที่เรียบร้อบเเล้ว") </script> ';
					echo "<script>window.location = 'administrator.php?menu=Config'</script>";
				}else{
					echo '<script type="text/javascript"> window.alert("เกิดข้อผิดพลาด !!! กรุณาทำรายการอีกครั้ง") </script> ';
					echo "<script>window.location = 'administrator.php?menu=Change_Pwd'</script>";
					exit;
				}

}

?>