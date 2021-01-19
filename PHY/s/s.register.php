<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
$ipconnect = $_SERVER["REMOTE_ADDR"];
$date_log = date('Y-m-d H:i:s');
$action_page = "Register";
$table = "webmbmembmaster";
$condition = "(member_no,	memb_fullname,idcard,email,mobile,password,date_reg,ipconnect)";
$value  = 	"('".$_POST["memb_no"]."','".$_POST["memb_fullname"]."','".$_POST["idcard1"]."','".$_POST["email1"]."',
				'".$_POST["mobile1"]."','".md5($_POST["pwd_r"])."','".$date_log."','".$ipconnect."')";
$status = insert_value_sql($table,$condition,$value);
		if($status){
			$table = "weblog_action";
			$condition = "(action_do,user,ipconnect,date_log,connectby)";
			$value  = "('".$action_page."','".$_POST["memb_no"]."','".$ipconnect."','".$date_log."','".$connectby."')";
			$status1 = insert_value_sql($table,$condition,$value);
			if($status1){
				$_SESSION[ses_userid] = session_id();                      
				$_SESSION[ses_member_no] = $_POST["memb_no"];
				if($confirm2use == 0){
					echo '<script type="text/javascript"> window.alert("ระบบได้ทำการบันทึกข้อมูลของท่านเรียบร้อยแล้ว ระบบจะนำท่านเข้าสู่ระบบบริการสมาชิก") </script> ';
					echo "<script>window.location = 'info.php'</script>";
				}else{
					echo '<script type="text/javascript"> window.alert("ระบบได้ทำการบันทึกข้อมูลของท่านเรียบร้อยแล้ว กรุณายืนยันเอกลักษณ์บุคคลกับทางสหกรณ์ เพื่อเข้าใช้บริการ") </script> ';
					echo "<script>window.location = 'index.php'</script>";	
				}
			}else{
				echo '<script type="text/javascript"> window.alert("เกิดข้อผิดพลาด !!! กรุณาเข้าใหม่อีกครั้ง") </script> ';
				echo "<script>window.location = 'index.php'</script>";
			}	
		}else{
			echo '<script type="text/javascript"> window.alert("เกิดข้อผิดพลาด !!! กรุณาเข้าใหม่อีกครั้ง") </script> ';
			echo "<script>window.location = 'index.php'</script>";
		    exit();
		}
?>

