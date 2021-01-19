<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <link rel="stylesheet" href="../css/validationEngine.jquery.css" type="text/css">
	<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />	
    <script src="../js/jquery-1.6.min.js" type="text/javascript"></script>
	<script src="../js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="tis-620"></script>
	<script src="../js/jquery.validationEngine.js" type="text/javascript" charset="tis-620"></script>
	<script type="text/javascript">
				jQuery(document).ready(function(){
						jQuery("#formID1").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});
			});
     </script>
     
      <script>
        function myFunction() {
  var x = document.getElementById("npwd");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
 </script>
 
  <script>
        function myFunction1() {
  var x = document.getElementById("npwd1");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
 </script>
 
 <script>
        function myFunction2() {
  var x = document.getElementById("oldpwd");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
 </script>

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"><strong><font size="4" face="Tahoma">เปลี่ยนรหัสผ่าน</font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Change Password</font></td>
  </tr>
  <tr>
    <td align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<form id="formID1" name="formID1" method="post" action="">
  <table width="427" border="0" align="center" cellpadding="6" cellspacing="2">
    <tr>
      <td colspan="2" align="center"><strong><font size="2" face="Tahoma, Geneva, sans-serif" color="#FF0000">กำหนดรหัสผู้ใช้ใหม่อย่างน้อย 8 ตัวอักษร แต่ไม่เกิน 13 ตัวอักษร</font></strong></td>
    </tr>
	<tr>
      <td colspan="2" align="center"><strong><font size="2" face="Tahoma" color="#FF0000">ประกอบด้วยอักขระดังต่อไปนี้อย่างน้อย 2 ใน 3</font></strong></td>
    </tr>
	<tr>
      <td colspan="2" align="left"><strong><font size="2" face="Tahoma" color="#FF0000">- ตัวเลข (0-9)</font></strong></td>
    </tr>
	<tr>
      <td colspan="2" align="left"><strong><font size="2" face="Tahoma" color="#FF0000">- ตัวอักษร (a-z, A-Z)</font></strong></td>
    </tr>
	<tr>
      <td colspan="2" align="left"><strong><font size="2" face="Tahoma" color="#FF0000">- อักขระพิเศษ (!@#$%^&*()_+|~-=\`{}[]:";'<>?,./)</font></strong></td>
    </tr>
    <tr>
      <td width="140" align="right">รหัสใหม่ :</td>
      <td width="280" align="left"><input name="npwd" type="password" class="validate[required,minSize[8]]" id="npwd" size="25" maxlength="13" autocomplete="off" />
       <input type="checkbox" onclick="myFunction()">
      </td>
    </tr>
    <tr>
      <td align="right">ยืนยันรหัสใหม่ :</td>
      <td align="left"><input name="npwd1" type="password" class="validate[required,equals[npwd]]" id="npwd1" size="25" maxlength="13" autocomplete="off" />
       <input type="checkbox" onclick="myFunction1()">
      </td>
    </tr>
  </table>
  <hr align="center" size="1"  color="#999999" style="width:95%"/>
  <table width="400" border="0" align="center" cellpadding="6" cellspacing="2">
    <tr>
      <td align="center"><strong><font color="#FF0000">ยึนยันรหัสเดิมเพื่อยืนยันการเปลี่ยนรหัสผ่าน</font></strong></td>
    </tr>
    <tr>
      <td align="center"><label for="textfield"></label>
      <input name="oldpwd" type="password" class="validate[required]" id="oldpwd" size="25" maxlength="13" autocomplete="off">
       <input type="checkbox" onclick="myFunction2()">
      </td>
    </tr>
    <tr>
      <td align="center"><input type="submit" name="button" id="button" value="ยืนยัน" />
      <input name="ChkPwd" type="hidden" id="ChkPwd" value="ChkPwd" /></td>
    </tr>
  </table>

<?php
if($_POST["ChkPwd"] != null){

$pwd=$_POST["npwd"];
	$valid_digit=isHaveDigit($pwd);
	$valid_c=isHaveEngLower($pwd);
	$valid_C=isHaveEngUpper($pwd);
	$valid_T=isHaveTh($pwd);
	$valid=$valid_digit&$valid_c&$valid_C;
	
	if($valid==false){
            echo '<script type="text/javascript"> window.alert("กำหนดรหัสผ่านใหม่ไม่ได้ กรุณาลองใหม่") </script> ';
			echo "<script>window.location = 'administrator.php?menu=Change_Pwd'</script>";
			$ChkPwd = null;
			exit;
	}

	$chkpassword = md5($_POST["oldpwd"]);
	$npwd = md5($_POST["npwd"]);
	$strSQL = "select staff_pwd from webstaff_info where staff_user = '$member_no' "; 		
	$value = "staff_pwd"; 
	$oldPassword = get_single_value_sql($strSQL,$value);

	if($chkpassword == $oldPassword){
		if($npwd == $oldPassword){
			echo '<script type="text/javascript"> window.alert("ไม่สามารถเปลี่ยนรหัสผ่านใหม่ได้ กรุณาเปลี่ยนรหัสผ่านใหม่ไม่ต่างจากเดิม") </script> ';
			echo "<script>window.location = 'administrator.php?menu=Change_Pwd'</script>";
			$ChkPwd = null;
			exit;
		}else{
			$table="webstaff_info";
			$value="staff_pwd = '".$npwd."'";
			$condition="where staff_user = '$member_no'";
			if(update_value_sql($table,$condition,$value)){
				$action_page = 'Change Password';
				$table = "weblog_action";
				$condition = "(action_do,user,ipconnect,date_log,connectby)";
				$value  = "('".$action_page."','".$member_no."','".$ipconnect."',now(),'".$connectby."')";
				$status = insert_value_sql($table,$condition,$value);
				if($status){
					echo '<script type="text/javascript"> window.alert("ระบบได้บันทึกรหัสผ่านใหม่ของท่านแล้ว กรุณาเข้าใช้โดยรหัสผ่านใหม่") </script> ';
					echo "<script>window.location = 'administrator.php'</script>";
				}else{
					echo '<script type="text/javascript"> window.alert("เกิดข้อผิดพลาด !!! กรุณาเข้าใหม่อีกครั้ง") </script> ';
					echo "<script>window.location = 'index.php'</script>";
				}
      		}else{
				echo '<script type="text/javascript"> window.alert("ไม่สามารถเปลี่ยนรหัสผ่านใหม่ได้ กรุณาลองใหม่ในภายหลัง") </script> ';
				echo "<script>window.location = 'administrator.php?menu=Change_Pwd'</script>";
				$ChkPwd = null;
				exit;
      	 	}
		}
	}else{
		echo '<script type="text/javascript"> window.alert("ไม่สามารถเปลี่ยนรหัสผ่านใหม่ได้ ท่านใส่รหัสเดิมไม่ถูกต้อง") </script> ';
		echo "<script>window.location = 'administrator.php?menu=Change_Pwd'</script>";
		$ChkPwd = null;
		exit;
	}

}

?>