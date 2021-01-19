<?php
session_start();
header('Content-Type: text/html; charset=tis-620');
require "../include/conf.conn.php";
require "../include/conf.c.php";
$connectby = "desktop";
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$title?></title>
	<link href="../css/jquery-ui-1.10.4.css" rel="stylesheet">
	<link rel="shortcut icon" href="../img/logo.gif">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <script src="../js/jquery.js"></script>
	<script src="../js/index.js"></script>
</head>
<body>
<?php require "../include/conf.d.php" ?>
<?php if($_REQUEST["usr"] == null or $_REQUEST["pwd"] == null){ ?>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="middle" bgcolor="#333333">
    <table width="995" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF">
      <tr>
        <td height="120" background="../img/head_info_bg.png"><table width="994" border="0" cellspacing="3" cellpadding="0" >
          <tr>
            <td width="109" height="100" align="right"><img src="../img/logo.gif" width="101" height="101"></td>
            <td width="876"><table width="100%" border="0" cellspacing="5" cellpadding="0">
              <tr>
                <td><font face='Tahoma' size="5" color="#FFFFFF"><strong>
                  <?=$title?>
                </strong></font><br/>
                <font face='Tahoma' size="2" color="#FFFFFF">
                <?=$sub_title1?>
                </font></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td height="390" background="../img/bg.jpg">
        <table width="995" border="0" cellspacing="0" cellpadding="0" style="margin-top: 125px;margin-left: 46px;">
          <tr>
	<td width="580" align="center">
		<br><br><br><br><br><br><br><br><br><br>
		<a href="browser.html" target="_blank" alt="คลิกเพื่ออ่าน"><img src="../img/extra_btn.png" border="0"></a></td>
            <td width="580">&nbsp;</td>
            <td align="center"><table width="350" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left" bgcolor="<?=$bg_login_color?>">&nbsp;</td>
              </tr>
              <tr>
                <td height="35" align="center" bgcolor="<?=$bg_bar_login_color?>"><font face='Tahoma' size="4" color="<?=$font_bar_login_color?>"><strong>
                  <?=$sub_title?>
                </strong></font></td>
              </tr>
              <tr>
                <td align="left" bgcolor="<?=$bg_login_color?>"><form name="formID1" method="post" action="">
                  <table width="252" border="0" align="center" cellpadding="0" cellspacing="8">
                    <tr>
                      <td><input name="usr" type="text"class="inputs" id="usr" placeholder="ทะเบียนสมาชิก" autocomplete="off" /></td>
                    </tr>
                    <tr>
                      <td><input name="pwd" type="password"class="inputs" id="pwd" placeholder="รหัสผ่าน"  autocomplete="off"/></td>
                    </tr>
                    <tr>
                      <td><input name="Submit" type="submit" value="เข้าสู่ระบบ" class="button1">
                        <input name="button" type="reset" value="ยกเลิก" class="button2"></td>
                    </tr>
                    <tr>
                      <td><span class="class1">
                        <?php if($connection == 0){ ?>
                        <font face='Tahoma' size="3"><a href="register.php">สมัครใช้บริการ</a></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <font face='Tahoma' size="3"><a href="check_1.php">ตรวจสอบข้อมูล</a></font>
                        <?php } ?>
                      </span></td>
                      
                    </tr>
                  </table>
                </form></td>
              </tr>
              <tr>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td align="left">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td height="120" align="center" background="../img/footer_info_bg.png"><span class="class1"><font size="2" color="#FFFFFF"><strong><?=$title?></strong></font><br/><font size="2" color="#FFFFFF"><?=$address?><br/><?=$credite?></font></span></td>
      </tr>
    </table>     </td>
  </tr>
</table>
<?php }else{ 
	require "../include/lib.Etc.php";
	require "../include/lib.MySql.php";
	require "../include/lib.Oracle.php";
	require "../lib/login.php";
	 }
 ?>
</body>
</html>
