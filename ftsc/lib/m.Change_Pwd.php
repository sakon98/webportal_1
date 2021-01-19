<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?><head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<center><div ><a href="index.php" data-role="button" data-corners="false"  data-icon="arrow-l" data-theme="f">เมนูหลัก </a></div>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right"><strong><font size="4" face="Tahoma">เปลี่ยนรหัสผ่าน</font></strong><br />
      <font color="#FF6600" size="2" face="Tahoma">Changing your password</font></td>
  </tr>
</table>
<hr color="#999999" size="1"/>
<form id="formID1" name="formID1" method="post" action="">
	<input name="oldpwd" type="password" class="validate[required]" id="oldpwd" size="25" maxlength="13" autocomplete="off"  placeholder="รหัสผ่านเดิม ">
	<strong><font size="2" face="Tahoma" color="#FF0000">กำหนดรหัสผู้ใช้ใหม่อย่างน้อย 8 ตัวอักษร<br/> แต่ไม่เกิน 13 ตัวอักษร</font></strong>
	<input name="npwd" type="password" class="validate[required,minSize[8]]" id="npwd" size="25" maxlength="13" autocomplete="off"  placeholder="รหัสผ่านใหม่"/>
	<input name="npwd1" type="password" class="validate[required,equals[npwd]]" id="npwd1" size="25" maxlength="13" autocomplete="off"  placeholder="รหัสผ่านใหม่(ยืนยัน) "/>
	<input type="submit" name="button" id="button" value="ยืนยัน"  data-theme="b"  />
	<input name="ChkPwd" type="hidden" id="ChkPwd" value="ChkPwd" />
	<input name="menu" type="hidden" id="menu" value="Change_Pwd" />
</form>
<?php
//echo "case 000".$_POST["ChkPwd"] ;
if($_POST["ChkPwd"] != null){

	$chkpassword = md5($_POST["oldpwd"]);
	$npwd = md5($_POST["npwd"]);
	$npwd1 = md5($_POST["npwd1"]);
	$strSQL = "select password from mbmembmaster where member_no = '$member_no' "; 		
	$value = "password"; 
	$oldPassword = get_single_value_sql($strSQL,$value);
    //echo "case ".$_POST["oldpwd"]." ".$_POST["npwd"]." ".$_POST["npwd1"];
	if($chkpassword == $oldPassword){
		if($npwd == $oldPassword){
			echo '<script type="text/javascript"> window.alert("ไม่สามารถเปลี่ยนรหัสผ่านใหม่ได้ กรุณาเปลี่ยนรหัสผ่านใหม่ไม่ต่างจากเดิม") </script> ';
			echo "<script>window.location = 'info.php?menu=Change_Pwd'</script>";
			$ChkPwd = null;
			exit;
		}else if($npwd != $npwd1){
			echo "case 2";
			echo '<script type="text/javascript"> window.alert("ไม่สามารถเปลี่ยนรหัสผ่านใหม่ได้ กรุณากรอกรหัสผ่านใหม่ยืนยันให้ตรงกัน") </script> ';
			echo "<script>window.location = 'info.php?menu=Change_Pwd'</script>";
			$ChkPwd = null;
			exit;
		}else{
			$table="mbmembmaster";
			$value="password = '".$npwd."'";
			$condition="where member_no = '$member_no'";
			if(update_value_sql($table,$condition,$value)){
				$action_page = 'Change Password';
				$table = "log_action";
				$condition = "(action_do,user,ipconnect,date_log,connectby)";
				$value  = "('".$action_page."','".$member_no."','".$ipconnect."','".$date_log."','".$connectby."')";
				$status = insert_value_sql($table,$condition,$value);
				if($status){
					echo '<script type="text/javascript"> window.alert("ระบบได้บันทึกรหัสผ่านใหม่ของท่านแล้ว กรุณาเข้าใช้โดยรหัสผ่านใหม่") </script> ';								
					session_destroy(); 			
					echo "<script>window.location = 'index.php'</script>";
				}else{
					echo '<script type="text/javascript"> window.alert("เกิดข้อผิดพลาด !!! กรุณาเข้าใหม่อีกครั้ง") </script> ';
					echo "<script>window.location = 'index.php'</script>";
				}	
      		}else{
				echo '<script type="text/javascript"> window.alert("ไม่สามารถเปลี่ยนรหัสผ่านใหม่ได้ กรุณาลองใหม่ในภายหลัง") </script> ';
				echo "<script>window.location = 'info.php?menu=Change_Pwd'</script>";
				$ChkPwd = null;
				exit;
      	 	}
		}
	}else{
		echo '<script type="text/javascript"> window.alert("ไม่สามารถเปลี่ยนรหัสผ่านใหม่ได้ ท่านใส่รหัสเดิมไม่ถูกต้อง") </script> ';
		echo "<script>window.location = 'info.php?menu=Change_Pwd'</script>";
		$ChkPwd = null;
		exit;
	}

}
?>
</center>