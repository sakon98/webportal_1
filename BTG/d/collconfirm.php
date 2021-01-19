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
<?php 
	require "../include/conf.conn.php";
	require "../include/conf.c.php";
	require "../include/lib.Etc.php";
	require "../include/lib.Oracle.php"; 
	require "../include/lib.MySql.php";
	

?>
<?php if($_REQUEST["loanrequest_docno"] != null and $_REQUEST["collmemb_no"] != null and $_REQUEST["confirm_flag"] != null){ 

	 $_REQUEST["loanrequest_docno"]=iconv("UTF-8","TIS-620",$_REQUEST["loanrequest_docno"]);
 
	 $sql="ALTER TABLE lnreqloancoll add (confirm_flag number(1,0)  default 8   not null  ,confirm_date date ) "; 
	 get_single_value_oci($sql,$value1);
	 	 
	 $sql="update lnreqloancoll set confirm_flag ='".$_REQUEST["confirm_flag"]."',confirm_date=sysdate where loanrequest_docno='".$_REQUEST["loanrequest_docno"]."' and  ref_collno='".$_REQUEST["collmemb_no"]."' "; 
	 get_single_value_oci($sql,$value1);
	 
	 //echo $sql;

	 $msg="สหกรณ์ได้รับการ <font color=yellow>".($_REQUEST["confirm_flag"]==1?"ยืนยันการคำประกัน":"ยืนยันการไม่ค้ำประกัน")." </font><br/>เลขที่ใบคำขอกู้ ".$_REQUEST["loanrequest_docno"]." <br/> เรียบร้อยแล้ว ";
?>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="middle" background="">
    <table width="995" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#fff">
      <tr>
        <td height="120" background="../img/head_info_bg.png">
<table width="994" border="0" cellspacing="3" cellpadding="0" style="width: 1050px; height: 100px;">
          <tr>
            <td width="140" height="100" align="right"><img src="../img/logo.png" width="100" height="100"></td>
            <td width="845"><table width="100%" border="0" cellspacing="5" cellpadding="0">
              <tr>
                <td><font face='Tahoma' size="5" color="#FFFFFF"><strong>
                  <?=$title?>
                </strong></font>
				
				
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                 
                                                                
                                                               <?php
                                                              
                                                                    ?>


				<br/>
                <font face='Tahoma' size="2" color="#FFFFFF">
                <?=$sub_title1?>
                </font>
				</td>
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
        <table width="995" border="0" cellspacing="0" cellpadding="0" >
          <tr>
            <td width="580" align="center">
		<!--<br><br><br><br><img src="../img/confirm.png" border="0"><br><br><br><br><br><br>-->
		</td>
            <td align="center"><table width="350" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top: 55px;">
              <tr>
                <td align="left" bgcolor="<?=$bg_login_color?>">&nbsp;</td>
              </tr>
              <tr>
                <td height="35" align="center" bgcolor="<?=$bg_bar_login_color?>"><font face='Tahoma' size="4" color="<?=$font_bar_login_color?>"><strong>
                  ระบบยืนยันการค้ำประกันเงินกู้
				  <hr/>
                </strong></font></td>
              </tr>
              <tr>
                <td  bgcolor="<?=$bg_login_color?>"><form name="formID1" method="post" action="">
				  <input type="hidden" name="p" value="<?=$_REQUEST["p"]?>"/> 
                  <table width="400" border="0" align="center" cellpadding="0" cellspacing="8">
                    <tr>
                        <td colspan="2" align="center"><font face='Tahoma' color="#ffffff" size="3"><?=$msg?></font></td>
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
                <!--<td align="center"><a href="browser.html" target="_blank" alt="คลิกเพื่ออ่าน"><img src="../img/extra_btn.png" border="0"></a></td>-->
              </tr>
            </table></td>
          </tr>
        </table></td>
        </tr>
		 <tr>
        <td>
            
      </tr>
      <tr>
        <td height="120" align="center" background="../img/footer_info_bg.png">
            <span class="class1">
                <font size="3" color="#FFFFFF">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <strong><?=$title?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </font><br/>
                <font size="3" color="#FFFFFF"><?=$address?><br/>
                                <?=$credite?></font>
            </span>
        </td>
         
      </tr>
    </table>     </td>
  </tr>
</table>
<?php }
 ?>
</body>
</html>
