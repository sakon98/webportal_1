<?php
session_start();
$member_no =$_SESSION[ses_repass]; 
require "../include/conf.conn.php" ;
require "../include/lib.MySql.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<title>Untitled Document</title>
</head>

<body>
<?php 
if($_POST["button"] == ""){ ?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="180" align="center" bgcolor="#CCCCCC">
    <p>เปลี่ยนรหัสสมาชิกให้เป็น <font size="4" color="#FF0000">&quot;1234&quot;</font>    </p>
<form id="form1" name="form1" method="post" action="">
      <input type="submit" name="button" id="button" value="ยืนยัน" />
</form> 
    </td>
  </tr>
</table>
<?php  }

$date_log = date("Y-m-d H:i:s");
$member_no;
if($_POST["button"] == "ยืนยัน"){
	$npwd = md5("1234");

	$table="mbmembmaster";
	$value="password = '".$npwd."'";
	$condition="where member_no = '$member_no'";
	$status = update_value_sql($table,$condition,$value);

		if($status){
                    
                    $action_page = 'Reset Password';
                                $table = "log_action";
                                $condition = "(action_do,action_desc,action_id,user,date_log)";
                                $value  = "('".$action_page."','Update','".$member_no."','".$_SESSION[ses_member_no]."','".$date_log."')";
                                $status = insert_value_sql($table,$condition,$value);
                    
			echo '<script type="text/javascript"> window.alert("ระบบได้แก้ไขแล้วให้สมาชิกใช้ รหัสผ่าน 1234 เพื่อเข้าไปไปตั้งรหัสผ่านใหม่") </script> ';
			echo "<script>window.close()</script>";
		}else{
			echo '<script type="text/javascript"> window.alert("เกิดข้อผิดพลาด !!! กรุณาเข้าใหม่อีกครั้ง") </script> ';
			echo "<script>window.close()";
		}
}
?>

</body>
</html>