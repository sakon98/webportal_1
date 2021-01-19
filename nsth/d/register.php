<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
	require "../include/conf.conn.php";
	require "../include/conf.c.php";
	require "../include/lib.Etc.php";
	require "../include/lib.Oracle.php";
	require "../include/lib.MySql.php";
	$connectby = "desktop";
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$title?></title>
	<link rel="shortcut icon" href="../img/logo.png">
    <link rel="stylesheet" href="../css/validationEngine.jquery.css" type="text/css">
	<link rel="stylesheet" href="../css/template.css" type="text/css">
    <script src="../js/jquery-1.6.min.js" type="text/javascript"></script>
	<script src="../js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="tis-620"></script>
	<script src="../js/jquery.validationEngine.js" type="text/javascript" charset="tis-620"></script>
	<script type="text/javascript">
			jQuery(document).ready(function(){
						jQuery("#formID1").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});
						jQuery("#formID2").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});
			});
	</script>

</head>
<body>
<?php require "../include/conf.d.php" ?>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="middle" bgcolor="#333333">
    <table width="995" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF">
      <tr>
        <td height="120"  background="../img/head_info_bgh.png"><table width="994" border="0" cellspacing="3" cellpadding="0">
          <tr>
            <td width="109" height="100" align="right"><img src="../img/logo.png" width="138" height="138"></td>
            <td width="876"><table width="100%" border="0" cellspacing="5" cellpadding="0">
              <tr>
                <td><font face='Tahoma' size="5" color="#FFFFFF"><strong>
                  <?=$title?>
                </strong></font><br/>
                <font face='Tahoma' size="2" color="#FFFFFF">
                <?=$address?>
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
        <td height="390">
<?php if(@$_POST["agree"] != "agree" ){  ?>
        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="6">
          <tr>
            <td align="center"><label for="textfield"></label>
              <textarea name="textfield" rows="9" readonly id="textfield" style="width:80%; resize:none; padding:16px">เงื่อนไขและข้อตกลงในการสมัครสมาชิก
1.การเข้าใช้งานระบบข้อมูลสมาชิกจะต้องทำการสมัครเข้าใช้งานระบบและต้องเป็นสมาชิกของ <?=$title?> เท่านั้น 
2.เพื่อความเรียบร้อยในการสมัครใช้งาน ระบบฯ และเพื่อยืนยันผู้สมัคร กรุณาทำตามขั้นตอนที่ระบบแนะนำ 
3.หากปรากฏว่า ชื่อหรือหมายเลขสมาชิก ของท่านได้มีการสมัครใช้งานแล้ว โดยท่านไม่ทราบ หรือทำการสมัครด้วยตัวท่านเอง กรุณาแจ้งเจ้าหน้าที่เพื่อทำการตรวจสอบความถูกต้อง ต่อไปกรุณาเก็บรักษา username / password ของท่าน
4.เพื่อสิทธิและความปลอดภัยในข้อมูลของท่านเองหากปรากฏว่ามีบุคคลแอบอ้าง สมัครใช้งานระบบและเจ้าหน้าที่ตรวจสอบแล้วจะทำการลบรายชื่อนั้นๆ ออกจากระบบ โดยไม่ต้องแจ้งให้ทราบ 
5.ข้อมูลของสมาชิก ในระบบจะทำการปรับปรุงข้อมูล หากสมาชิกท่านใดพบข้อมูลไม่ตรงหรือมีข้อสงสัยกรุณาติดต่อเจ้าหน้าที่
6.ข้าพเจ้าได้อ่านข้อตกลงดังกล่าวแล้ว และยินยอมในเงื่อนไขต่างๆที่ทาง <?=$title?> กำหนดไว้</textarea>
			</td>
          </tr>
          <tr>
            <td align="center">
            <form name="formID1" id="formID1" method="post" action="" >
              <table width="70%" border="0" align="center" cellpadding="2" cellspacing="2">
                <tr>
                  <td width="39%" align="right"><font face="Tahoma" size="2"><strong><strong>เลขทะเบียนสมาชิก :</strong></strong></font></td>
                  <td width="61%"><input name="member_no" type="text" class="validate[required,custom[integer]]" id="member_no" size="20" maxlength="10" autocomplete="off" /></td>
                </tr>
                <tr>
                  <td align="right"><font face="Tahoma" size="2"><strong><strong>เลขที่บัตรประชาชน :</strong></strong></font></td>
                  <td><input name="idchk" type="text" class="validate[required,custom[integer],minSize[13]]" id="idchk" size="20" maxlength="13" autocomplete="off"/></td>
                </tr>
                <tr>
                  <td align="right"><input name="agree" type="checkbox" class="validate[required]" id="agree" value="agree">
                    <label for="agree"></label></td>
                  <td><font face="Tahoma" size="2">ข้าพเจ้ายอมรับเงิ่อนไขทั้งหมด</font></td>
                </tr>
                <tr>
                  <td align="right">&nbsp;</td>
                  <td><input type="submit" name="Submit" id="button" value="ตกลง" />
                    <input name="ยกเลิก" type="reset" id="ยกเลิก" onclick="location.href='index.php'" value="ยกเลิก" />
                    <input name="ref" type="hidden" id="ref" value="checkuser" /></td>
                </tr>
              </table>
            </form>
            </td>
          </tr>
        </table>
<?php
}else{
 	require "../s/s.member_info.php" ;
	//echo $card_person;
	//echo $Num_Rows;
	$register_status = true;
	if($resultData == 0){ // ไม่พบทะเบียน 
		$register_status = false;
		echo '<script type="text/javascript"> window.alert("ไม่สามารถดำเนินการได้ กรุณาติดต่อสหกรณ์ เพื่อตรวจสถานะการเป็นสมาชิก") </script> ';
		echo "<script>window.location = 'index.php'</script>";
		exit;
	}	

	if($countmemb	> 0 or $countidcard > 0){ // เคยสมัครแล้ว
		$register_status = false;
		echo '<script type="text/javascript"> window.alert("ไม่สามารถดำเนินการได้ ท่านเคยสมัครใช้บริการแล้ว กรุณาติดต่อสหกรณ์") </script> ';
		echo "<script>window.location = 'index.php'</script>";
		exit;
	}
	
	if($card_person	 != $idchk){ // เลขบัตรไม่ถูกต้อง
		$register_status = false;
		echo '<script type="text/javascript"> window.alert("ไม่สามารถดำเนินการได้ ทะเบียนสมาชิกหรือเลขบัตรประชาชนไม่ถูกต้อง กรุณาตรวจสอบ") </script> ';
		echo "<script>window.location = 'index.php'</script>";
		exit;
	}
	if($register_status){ // เริ่มการสมัคร
		?>
        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="6">
          <tr>
            <td><form action="" method="post" id="formID2">
              <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td bgcolor="#FFFFFF"><table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
                    <tr>
                      <td height="30" colspan="2" bgcolor="#666666"><table width="98%" border="0" align="center" cellpadding="2" cellspacing="2">
                        <tr>
                          <td><strong><font size="2" face="Tahoma" color="#FFFFFF">ข้อมูลสมาชิก</font></strong></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td width="278" align="right"><strong><font face="Tahoma" size="2">เลขทะเบียนสมาชิก :</font></strong></td>
                      <td width="461" align="left"><input name="memb_no" type="text" class="validate[required,custom[integer]]" id="memb_no" autocomplete="off"  value="<?=$member_no?>" size="10" readonly /></td>
                      </tr>
                    <tr>
                      <td align="right"><strong><font face="Tahoma" size="2">ชื่อ-สกุล :</font></strong></td>
                      <td align="left"><input name="memb_fullname" type="text" class="validate[required]" id="memb_fullname"  value="<?=$full_name?>" size="35"  maxlength="13" readonly /></td>
                      </tr>
                    <tr>
                      <td align="right"><strong><font face="Tahoma" size="2">เลขที่บัตรประชาชน :</font></strong></td>
                      <td align="left"><input name="idcard1" type="text" class="validate[required,custom[integer],minSize[13]]" id="idcard1"  value="<?=$card_person?>" size="35"  maxlength="13" readonly /></td>
                    </tr>
                    <tr>
                      <td align="right"><strong><font face="Tahoma" size="2">มือถือ :</font></strong></td>
                      <td align="left">
                      <?php if($mobile_register == 0){?>
                      <input name="mobile1" type="text" class="validate[required,minSize[10]]" id="mobile1" size="35" value="<?=$mobile?>" autocomplete="off"/>
					  <?php }else { ?> 
                      <input name="mobile1" type="text" class="validate[minSize[10]]" id="mobile1" size="35" value="<?=$mobile?>" autocomplete="off"/>
                      <?php } ?></td>
                    </tr>
                    <tr>
                      <!--td colspan="2" align="center"><font face="Tahoma" size="2" color="red"><strong><em>* หมายเลขโทรศัพท์ เพื่อรับข้อมูลผ่าน SMS รูปแบบ 0812345678</em></strong></font></td>-->
                      </tr>
                    <tr>
                      <td align="right"><strong><font size="2" face="Tahoma">Email </font></strong>:</td>
                      <td align="left">
                        <?php 	if($email_register == 0){?>
                        	<input name="email1" type="text" id="email1" class="validate[required,custom[email]]	" size="35" autocomplete="off"/>	
					  	<?php }else { ?> 
                        	<input name="email1" type="text" id="email1" class="validate[custom[email]]	" size="35" autocomplete="off"/>			
                        <?php } ?>                   
                      </td>
                    </tr>
                    <tr>
                      <!--<td colspan="2" align="center"><font face="Tahoma" size="2" color="red"><strong><em>* Email เพื่อรับข่าวสารสหกรณ์</em></strong></font></td>-->
                      </tr>
                    <tr>
                      <td height="30" colspan="2" align="left" bgcolor="#666666"><table width="98%" border="0" align="center" cellpadding="2" cellspacing="2">
                        <tr>
                          <td><strong><font size="2" face="Tahoma" color="#FFFFFF">กำหนดรหัสผู้ใช้อย่างน้อย 8 ตัวอักษร แต่ไม่เกิน 13 ตัวอักษร</font></strong></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td colspan="2" align="center"><table width="69%" border="0" cellspacing="2" cellpadding="2">
                        <tr>
                          <td width="32%" align="right"><strong><font size="2" face="Tahoma">รหัสผ่าน :</font></strong></td>
                          <td colspan="2"><input name="pwd_r" type="password" class="validate[required,minSize[8]]" id="pwd_r" size="35" maxlength="13" autocomplete="off"/></td>
                          </tr>
                        <tr>
                          <td align="right"><strong><font size="2" face="Tahoma">ยืนยันรหัสผ่าน :</font></strong></td>
                          <td colspan="2"><input name="pwd_r1" type="password" class="validate[required,equals[pwd_r]]" id="pwd_r1" size="35" maxlength="13" autocomplete="off"/></td>
                          </tr>
                        <tr>
                          <td align="right">&nbsp;</td>
                          <td width="4%">&nbsp;</td>
                          <td width="64%"><input type="submit" name="button" id="button2" value="ตกลงสมัคร" />
                            <input type="reset" name="button3" id="button3" value="ล้างข้อมูลทั้งหมด">
                            <input name="reg" type="hidden" id="reg" value="done"></td>
                          </tr>
                        </table></td>
                    </tr>
                    </table></td>
                </tr>
              </table>
              </form></td>
          </tr>
        </table>
        <?php
	}
}
?> 
<?php 
	if(@$_POST["reg"] == "done"){  
		 	require "../s/s.register.php" ;
	}
?>     
        </td>
        </tr>
      <tr>
        <td height="120" align="center" background="../img/footer_info_bgf.png"><span class="class1"><font size="2" color="#FFFFFF"><strong><?=$title?></strong></font><br/><font size="2" color="#FFFFFF"><?=$address?><br/><?=$credite?></font></span></td>
      </tr>
    </table></td>
  </tr>
</table>


</body>
</html>

