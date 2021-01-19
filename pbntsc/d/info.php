<?php
session_start();
header('Content-Type: text/html; charset=tis-620');
$ses_userid =$_SESSION['ses_userid'];
$member_no = $_SESSION['ses_member_no'];
if($ses_userid <> session_id() or $member_no ==""){
	header("Location: index.php");
}
	require "../include/conf.conn.php";
	require "../include/conf.c.php";
	require "../include/lib.Etc.php";
	require "../include/lib.Oracle.php";
	require "../include/lib.MySql.php";
	$ipconnect = $_SERVER['REMOTE_ADDR'];
	$date_log = date('Y-m-d H:i:s');
	$connectby = "desktop";
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$title?></title>
	<link rel="shortcut icon" href="../img/logo.png">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <?php require "../include/conf.d.php" ?>
</head>
<body>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top" bgcolor="#333333">
    <table width="995" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF">
      <tr>
        <td height="138" colspan="2" background="../img/bgheader.jpg">
      <!--  <table width="994" border="0" cellspacing="3" cellpadding="0">
          <tr>
            <td width="92" height="105" align="center"><img src="../img/logo.png" width="74" height="100"></td>
            <td width="893"><table width="100%" border="0" cellspacing="5" cellpadding="0">
              <tr>
                <td><font face='Tahoma' size="5" color="#FFFFFF"><strong>
                  <?=$title?>
                  </strong></font><br/>
                  <font face='Tahoma' size="2" color="#FFFFFF">
                    <?=$sub_title?>
                  </font></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table>--></td>
        </tr>
      <tr bgcolor="#666666">
        <td height="20" colspan="2" align="right" valign="top" bgcolor="<?=$undertop?>">&nbsp;</td>
        </tr>
      <tr>
        <td width="170" valign="top"><?php require "../lib/menu.php" ?></td>
        <td width="825" height="400" valign="top">
        <span class="class2">
        <table width="100%" border="0" cellspacing="1" cellpadding="6">
          <tr>
            <td>
			<?php  
				if($_REQUEST["menu"] == ""){
					 require "../lib/d.news.php";
				}else if($_REQUEST["menu"] == "Share"){
					require "../lib/d.member_info.php";
					require "../lib/d.share.php";
				}else if($_REQUEST["menu"] == "Deposit"){
					require "../lib/d.member_info.php";
					require "../lib/d.deposit.php";
				}else if($_REQUEST["menu"] == "Loan"){
					require "../lib/d.member_info.php";
					require "../lib/d.loan.php";
                                }else if($_REQUEST["menu"] == "LoanPermission"){
					require "../lib/d.member_info.php";
					require "../lib/d.LoanPermission.php";
				}else if($_REQUEST["menu"] == "Ref_collno"){
					require "../lib/d.member_info.php";
					require "../lib/d.ref_collno.php";
				}else if($_REQUEST["menu"] == "Payment"){
					require "../lib/d.member_info.php";
					require "../lib/d.payment.php";
				}else if($_REQUEST["menu"] == "Dividend"){
					require "../lib/d.member_info.php";
					require "../lib/d.dividend.php";
				}else if($_REQUEST["menu"] == "Benefits"){
					require "../lib/d.member_info.php";
					require "../lib/d.benefits.php";
				}else if($_REQUEST["menu"] == "Fund"){
					require "../lib/d.member_info.php";
					require "../lib/d.fund.php";
				}else if($_REQUEST["menu"] == "WF"){
					require "../lib/d.member_wf.php";
				}else if($_REQUEST["menu"] == "Change_Pwd" and $connection != 1){
					require "../lib/d.Change_Pwd.php";
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
        <td height="80" colspan="2" align="center" background="../img/footer_info_bg.png"><br><font size="2" color="#FFFFFF"><?=$address?><br/><span class="class1"><?=$credite?></span></font><br></td>
      </tr>
    </table></td>
  </tr>
</table>

</body>
</html>
