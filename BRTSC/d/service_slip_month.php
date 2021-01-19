<?php
	session_start();
	@header('Content-Type: text/html; charset=tis-620');
	$ipconnect = $_SERVER['REMOTE_ADDR'];
	$date_log = date('Y-m-d H:i:s');
	require "../include/conf.conn.php";
	require "../include/conf.c.php";
	require "../include/lib.Etc.php";
	require "../include/lib.Oracle.php";
	require "../include/lib.MySql.php";
	$connectby = "desktop";
	$member_no = $_SESSION[ses_member_no];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><?=$title?></title>
<style>
html, body{
	padding:0px;
	margin:0px;
	height:100%;
}

.ok{
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
}


body {
	background-color: #000;
}
</style>
</head>
<body>
<table width="100%" height="99%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><form action="service_print_slip.php" method="post" name="form1" target="_self">
      <?php 
		$strSQL = "SELECT MAX(RECV_PERIOD) AS MAXSLIP FROM KPTEMPRECEIVEDET WHERE MEMBER_NO = '$member_no' ";
		$value = ('MAXSLIP');
		$listslip = get_single_value_oci($strSQL,$value);
		$thisshow = Show_Slip(date('d-m-Y'));
	
		if($listslip != $thisshow){
			$listslip = $listslip-1;
		}
				
		list($slip,$slip_m,$slip_s,$slipsum) =show_list($listslip,6,$member_no);

		$m=0;
	?>
      <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
        <?php for($i=0;$i<(count($slip)/2);$i++){ ?>
        <tr>
          <td align="center"><button type="submit" name="slip_date" value="<?=$slip[$m]?>" style="height:105; width:305; background:#fa800a; font-size:36;" class="ok" >
            <?=$slip_m[$m++]?>
          </button></td>
          <td align="center"><button type="submit" name="slip_date" value="<?=$slip[$m]?>" style="height:105; width:305; background:#fa800a; font-size:36;" class="ok" >
            <?=$slip_m[$m++]?>
          </button></td>
        </tr>
        <tr>
          <td height="55" align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <?php } ?>
      </table>
    </form>
</td>
  </tr>
</table>
</body>
</html>

