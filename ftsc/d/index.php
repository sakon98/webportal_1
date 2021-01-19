<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
require "../include/conf.conn.php";
require "../include/conf.c.php";
$connectby = "desktop";

	if(isset($_SESSION['admin'])==false){
		$_SESSION['admin']="none";
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$title?></title>
	<link href="../css/jquery-ui-1.10.4.css" rel="stylesheet">
	<link rel="shortcut icon" href="../img/logo_.png">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <script src="../js/jquery.js"></script>
	<script src="../js/index.js"></script>
</head>
<body  style="background-color:  #314f60;">
<?php require "../include/conf.d.php" ?>
<?php if(( $_REQUEST["usr"] == null or $_REQUEST["pwd"] == null ) and ($_REQUEST["idcard"] ==null)){ ?>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="middle" background="../img/bg_gsb_.jpg">
    <table width="995" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#fff">
      <tr>
        <td height="120" background="../img/head_info_bg.png">
<table width="994" border="0" cellspacing="3" cellpadding="0">
          <tr>
            <td width="140" height="100" align="right"><img src="../img/logo_.png" width="138" height="100"></td>
            <td width="845"><table width="100%" border="0" cellspacing="5" cellpadding="0">
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
        <td height="390"  background="../img/bg.png">
        <table width="995" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="580" align="center">
		<!--<br><br><br><br><img src="../img/confirm.png" border="0"><br><br><br><br><br><br>-->
		</td>
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
                  <table width="400" border="0" align="center" cellpadding="0" cellspacing="8">
                    <tr style="display:<?=$_SESSION['admin']==""?"none":""?>;">
                        <td>เลขบัตรประชาชน : </td>
                      <td><input name="idcard" type="text"class="inputs" id="idcard" placeholder="เลขบัตรประชาชน" autocomplete="on" /></td>
                    </tr>
                    <tr style="display:<?=$_SESSION['admin']?>;">
                        <td>ทะเบียนสมาชิก : </td>
                      <td><input name="usr" type="text"class="inputs" id="usr" placeholder="ทะเบียนสมาชิก" autocomplete="off" /></td>
                    </tr>
                    <tr style="display:<?=$_SESSION['admin']?>;">
                        <td>รหัสผ่าน : </td>
                      <td><input name="pwd" type="password"class="inputs" id="pwd" placeholder="รหัสผ่าน"  autocomplete="off"/></td>
                    </tr>
                    <tr>
                         <td></td>
                      <td><input name="Submit" type="submit" value="เข้าสู่ระบบ" class="button1">
                        <input name="button" type="reset" value="ยกเลิก" class="button2"></td>
                    </tr>
					<!--
                    <tr>
                         <td></td>
                      <td><span class="class1">
                        <?php if($connection == 0){ ?>
                        <font face='Tahoma' size="3"><a href="register.php">สมัครใช้บริการ</a></font>
	          &nbsp;&nbsp;&nbsp;&nbsp;
	        <font face='Tahoma' size="3"><a href="description.html">แนะนำการใช้งาน</a></font>
                        <?php } ?>
                      </span></td>
                    </tr>
					-->
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
                <!--<td align="center"><a href="browser.html" target="_blank" alt="คลิกเพื่ออ่าน"><img src="../img/extra_btn.png" border="0"></a></td>-->
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
