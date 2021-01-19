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
	<link rel="shortcut icon" href="../img/logo.png">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <script src="../js/jquery.js"></script>
	<script src="../js/index.js"></script>
</head>
<body>
<?php //echo str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT); ?>
<?php require "../include/conf.d.php" ?>
<?php if($_REQUEST["usr"] == null or $_REQUEST["pwd"] == null){ ?>
<table width="995" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#fff">
  <tr>
    <td height="120" colspan="2" background="../img/head_info_bg.png"><table width="994" border="0" cellspacing="3" cellpadding="0" style="width: 1050px; height: 100px;">
      <tr>
        <td width="140" height="100" align="right"><img src="../img/logo.png" alt="" width="100" height="100"></td>
        <td width="845"><table width="100%" border="0" cellspacing="5" cellpadding="0">
          <tr>
            <td><font face='Tahoma' size="5" color="#FFFFFF"><strong>
              <?=$title?>
              </strong></font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <?php
                                                              
                                                              require "../include/lib.MySql.php";
                                                              
                                                               
                                                                $strSQL = " SELECT filesname FROM upload_file";
                                                                $value = array('filesname');
                                                                list($Num_Rows,$list_info) = get_value_many_sql($strSQL,$value);
                                                                //$filesname = $list_info[0][0];
        
                                                           
                                                                    ?>
              <!--<a href="../d/myfile_index/<?php echo $list_info[0][0]; ?>"> <u><font face="Tahoma" size="2">  donwload เอกสาร/แบบฟอร์ม </font></u> </a>-->
              <br/>
              <font face='Tahoma' size="2" color="#FFFFFF">
                <?=$sub_title1?>
                </font>
              <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="http://intranet.betagro.com/?page_id=2488"> <u><font face="Tahoma" size="2">  Donwload เอกสารแบบฟอร์มการทำรายการ </font></u> </a>--></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="390" colspan="2"  background="../img/bg.png"><table width="995" border="0" cellspacing="0" cellpadding="0" >
      <tr>
        <td width="580" align="center"><!--<br><br><br><br><img src="../img/confirm.png" border="0"><br><br><br><br><br><br>-->
          <?php include("index.slide.php");?></td>
        <td align="center"><table width="350" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top: 55px;">
          <tr>
            <td align="left" bgcolor="<?=$bg_login_color?>">&nbsp;</td>
          </tr>
          <tr>
            <td height="35" align="center" bgcolor="<?=$bg_bar_login_color?>"><font face='Tahoma' size="4" color="<?=$font_bar_login_color?>"><strong>
              <?=$sub_title?>
            </strong></font></td>
          </tr>
          <tr>
            <td align="left" ><form name="formID1" method="post" action="">
              <input type="hidden" name="p" value="<?=$_REQUEST["p"]?>"/>
              <table width="430" height="250" border="0" align="center" cellpadding="0" cellspacing="8" valign="middle" bgcolor="<?=$bg_login_color?>" >
                <tr>
                  <td><font face='Tahoma' color="#ffffff" size="3">ทะเบียนสมาชิก : </font></td>
                  <td><input name="usr" type="text"class="inputs" id="usr" placeholder="ทะเบียนสมาชิก" autocomplete="off" value="<?=$_REQUEST["u"]?>" /></td>
                </tr>
                <tr>
                  <td><font face='Tahoma' color="#ffffff" size="3">รหัสผ่าน : </td>
                  <td><input name="pwd" type="password"class="inputs" id="pwd" placeholder="รหัสผ่าน"  autocomplete="off"/></td>
                </tr>
                <tr>
                  <td></td>
                  <td><input name="Submit" type="submit" value="เข้าสู่ระบบ" class="button1">
                    <input name="button" type="reset" value="ยกเลิก" class="button2"></td>
                </tr>
                <tr>
                  <td></td>
                  <td><span class="class1">
                    <?php if($connection == 0){ ?>
                    <font face='Tahoma' size="3"><a href="registermember.php">สมัครสมาชิก</a></font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <font face='Tahoma' size="3"><a href="for_got_your_password.php">ลืมรหัสผ่าน</a></font>
                    <?php } ?>
                  </span></td>
                </tr>
                <tr>
                  <td></td>
                  <td><span class="class1">
                    <?php if($connection == 0){ ?>
                    <font face='Tahoma' size="3"><a href="register.php">ลงทะเบียน</a></font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <font face='Tahoma' size="3"><a href="getmemberno.php">ลืมเลขทะเบียน</a></font>
                    <?php } ?>
                  </span></td>
                </tr>
              </table>
            </form>
              <br/></td>
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
    <td colspan="2">
  </tr>
  <tr>
    <td width="650" height="50" align="center" background="../img/footer_info_bg.png" border="0" style="padding-top: 11px; padding-bottom: 10px;"><span class="class1"> <font size="3" color="#FFFFFF"> <strong>
      <?=$title?>
      </strong> </font><br/>
      <font size="3" color="#FFFFFF">
        <?=$address?>
        <br/>
        <?=$credite?>
      </font> </span></td>
    <td width="200" align="left" background="../img/footer_info_bg.png" border="0"><table width="300" border="0">
      <tr>
        <td></td>
      </tr>
      <tr>
        <td><font size ="3" color="#FFFFFF">Hot Link</font></td>
      </tr>
      <tr>
        <td><a href = "slide.pdf" target = "new"> <font size ="2" color="#FFFFFF">แผ่นประชาสัมพันธ์</font></a></td>
		<td><a href = "manual.pdf" target = "new"> <font size ="2" color="#FFFFFF">คู่มือสมาชิกสหกรณ์</font></a></td>
      </tr>
      <tr>
        <td><a href="http://public.betagro.com/SitePages/Home.aspx?RootFolder=%2FShared%20Documents%2F%E0%B8%AA%E0%B8%AB%E0%B8%81%E0%B8%A3%E0%B8%93%E0%B9%8C&FolderCTID=0x0120009CB9B0152C683B4CB4A16982D8D712ED&View=%7B399485A0-7795-474C-80BE-A104091E808B%7D" target="new"><font size="2" color="#FFFFFF">ดาวน์โหลดเอกสาร</a></font></td>
		<td><a href="mailto:coop@betagro.com" target="new"><font size="2" color="#FFFFFF">Contact Us </a></font></td>
      </tr>
      <tr>
        <td><a href="https://docs.google.com/document/d/1HRjNYLuq7GZ-VHRrQHYmey0jKUDekNmuzNxL2sU-ua0/edit" target="new"><font size="2" color="#FFFFFF">คู่มือการใช้งาน</a></font></td>
      </tr>
    </table></td>
    <!-- <td width="4" align="left" valign="top" background="../img/footer_info_bg.png">&nbsp;</td> -->
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
