<?php
	session_start();
	@header('Content-Type: text/html; charset=tis-620');
	require "../include/conf.conn.php";
	require "../include/conf.c.php";
	require "../include/lib.Etc.php";
	require "../include/lib.Oracle.php";
	require "../include/lib.MySql.php";

	$ipconnect = $_SERVER['REMOTE_ADDR'];
	$date_log = date('Y-m-d H:i:s');
	$connectby = "mobile";
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$title?></title>
	<link rel="stylesheet"  href="../css/jquery.mobile-1.3.2.min.css">
	<link rel="stylesheet" href="../css/jqm-demos.css">
	<link rel="shortcut icon" href="../img/logo.png">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <script src="../js/jquery.js"></script>
	<script src="../js/index.js"></script>
	<script src="../js/jquery.mobile-1.3.2.min.js"></script>
</head>
<body>
<div data-role="page" class="jqm-demos jqm-demos-home" >
<div data-role="header">
    <center><p><?=$title1?></p></center>
</div>
<?php require "../include/conf.m.php" ?>
<center>
<?php if ($_POST["agree"] != "agree") { ?>

	<form name="formID1" id="formID1" method="post" action="" >
	
			<div style=" height:100%; width:80%" > 
				<div style="width:100%; text-align:left;">
					<h4>*** reset password เป็นค่าเริ่มต้น</h4>
						
					</div>
				<div>
					<input type="text" name="member_no" id="member_no" value=""  placeholder="กรอกทะเบียนสมาชิก" autocomplete="off" required >
				</div>			 

			    <input value="ค้นหา" data-iconpos="right" data-theme="b" type="submit">
                            <label><input type="hidden" name="agree" value="agree"  required/></label>

				<br>
		</div>
	</form>
<?php
            } else {
                require "../s/s.member_info.php";
                //echo $card_person;
                //echo $Num_Rows;
                $check_member = true;
                if ($Num_Rows == 0) { // ไม่พบทะเบียน 
                    $check_member = false;
                    echo '<script type="text/javascript"> window.alert("ไม่สามารถดำเนินการได้ กรุณาติดต่อสหกรณ์ เพื่อตรวจสถานะการเป็นสมาชิก") </script> ';
                    echo "<script>window.location = 'administrator.php'</script>";
                    exit;
                }

                if ($countmemb == 0) { // ยังไม่ได้สมัครสมาชิก
                    $check_member = false;
                    echo '<script type="text/javascript"> window.alert("ไม่สามารถดำเนินการได้ ท่านยังไม่ได้สมัครเป็นสมาชิก") </script> ';
                    echo "<script>window.location = 'administrator.php'</script>";
                    exit;
                }




                if ($check_member) {//เริ่มการ reset password
                    ?>
                    <form action="" method="post" id="formID2">
						<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right"><font face="Tahoma" size="4"><strong>เปลี่ยนรหัสสมาชิกเป็นค่าเริ่มต้น</strong></font><br />
      <font face="Tahoma" size="2" color="#FF6600">Change password to default</font></td>
  </tr>
</table>
<hr color="#999999" size="1"/>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="3">
  <tr>
    <td align="left" valign="top"><font face="Tahoma" size="3"><strong>เลขสมาชิก</strong></font></td>
  </tr>
  <tr>
    <td align="right" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="5%" valign="top">&nbsp;</td>
        <td width="95%" valign="top"><font face="Tahoma" size="3"><?=$member_no?> (<?=$member_type?>)</font></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr color="#CCCCCC" size="1"/></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top"><font face="Tahoma" size="3"><strong>ชื่อ-สกุล</strong></font></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="5%" valign="top">&nbsp;</td>
        <td width="95%" valign="top"><font size="3" face="Tahoma"><?=$full_name?></font></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr color="#CCCCCC" size="1"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top"><font face="Tahoma" size="3"><strong>เลขบัตรประชาชน</strong></font></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="5%" valign="top">&nbsp;</td>
        <td width="95%" valign="top"><font face="Tahoma" size="3"><?=GetFormatidcare($card_person)?></font></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr color="#CCCCCC" size="1"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
 
</table>
<input type="submit" name="button"  id="button2" data-iconpos="right" data-theme="b"  value="Change password to default">
<input name="reg" type="hidden" id="reg" value="done">
<input name="mb" type="hidden" id="reg" value="<?=$member_no?>">
                    </form>
                    <?php
                }
            }
            ?>
			<?php
                        
                      if ($_POST["reg"] == "done") {
                                   
					require "../s/s.reset_password.php";
				}

            ?>  
    
    <div data-role="footer" class="jqm-footer">
		<p><?=$credite?></p>
	</div><!-- /footer -->
</div>
</center>
</body>
</html>
