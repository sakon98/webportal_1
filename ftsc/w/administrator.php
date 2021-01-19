<?php
	session_start();
	@header('Content-Type: text/html; charset=tis-620');
	$ses_userid =$_SESSION['ses_userid'];
	$member_no = $_SESSION['ses_member_no'];
	require "../include/conf.conn.php";
	require "../include/conf.c.php";
	require "../include/lib.Etc.php";
	require "../include/lib.Oracle.php";
	require "../include/lib.MySql.php";
	$ipconnect = $_SERVER['REMOTE_ADDR'];
	$date_log = date('Y-m-d H:i:s');
	$connectby = "desktop";
	
	if(get_type($member_no) == "member"){
		header("Location: index.php");
	};
	
	if($ses_userid <> session_id() or $member_no ==""){
	header("Location: index.php");
}

	
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$title?></title>
	<link rel="shortcut icon" href="../img/logo_.png">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <?php require "../include/conf.d.php" ?>
</head>
<body>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top" bgcolor="#333333">
    <table width="995" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF">
      <tr>
        <td height="110" colspan="2" background="../img/head_info_bg1.png"><table width="994" border="0" cellspacing="3" cellpadding="0">
          <tr>
            <td width="109" height="105" align="right"><img src="../img/logo_.png" width="101" height="101"></td>
            <td width="876"><table width="100%" border="0" cellspacing="5" cellpadding="0">
              <tr>
                <td><font face='Tahoma' size="5" color="#FFFFFF"><strong>
                  <?=$title?>
                  </strong></font><br/>
                  <font face='Tahoma' size="2" color="#FFFFFF">
                    <?='ผู้ดูแลระบบ'?>
                  </font></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
        </tr>
      <tr bgcolor="#666666">
        <td height="20" colspan="2" valign="top">&nbsp;</td>
        </tr>
      <tr>
        <td width="170" valign="top"><?php require "../lib/a.menu.php" ?></td>
        <td width="825" height="400" valign="top">
        <span class="class2">
        <table width="100%" border="0" cellspacing="1" cellpadding="6">
          <tr>
            <td>
			<?php
				if($_REQUEST["menu"] == ""){
					if($connection != 1){
					require "../lib/a.Status.php";	
					}else{ 
						echo "<script>window.location = 'administrator.php?menu=News_editer'</script>"; 
					}
				}else if($_REQUEST["menu"] == "News_editer"){
					require "../lib/a.News.php";
				}else if($_REQUEST["menu"] == "Management_Member" and $connection != 1){
					require "../lib/a.Management_Member.php";
				}else if($_REQUEST["menu"] == "Management_Staff" and $connection != 1){
					require "../lib/a.Management_Staff.php";
				}else if($_REQUEST["menu"] == "Reports" and $connection != 1){
					require "../lib/a.Reports.php";
				}else if($_REQUEST["menu"] == "ConfirmReport" and $connection != 1){
					require "../d/confirmframe.html";
				}else if($_REQUEST["menu"] == "Change_Pwd"){
					require "../lib/a.Change_Pwd.php";
				}else if($_REQUEST["menu"] == "Configuration"){
					require "../lib/a.Configuration.php";
				}else if($_REQUEST["menu"] == "Information"){
					require "../lib/a.Information.php";
				}else if($_REQUEST["menu"] == "SigeOut"){
					unset ( $_SESSION['ses_userid'] );
					unset ( $_SESSION['ses_member_no'] );
					session_destroy(); 
					oci_close($objConnect);
					echo "<script>window.location = 'index.php'</script>";
				}
				?>
                </td>
          </tr>
        </table>
        </span>
        </td>
      </tr>
      <tr>
        <td height="80" colspan="2" align="center" background="../img/footer_info_bg.png"><font size="2" color="#FFFFFF"><strong><?=$title?></strong></font><br/><font size="2" color="#FFFFFF"><?=$address?><br/><span class="class1"><?=$credite?></span></font></td>
      </tr>
    </table></td>
  </tr>
</table>

</body>
</html>
