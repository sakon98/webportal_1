<?php
header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php

 $memb = $_POST["memb_no"];
 $memb = str_replace('เธช', 'ส', $memb);
 //$memb = "00".$memb;
 
 //echo $full_name_insert; exit();

$ipconnect = $_SERVER["REMOTE_ADDR"];
$date_log = date('Y-m-d H:i:s');
$action_page = "Register";
$table = "mbmembmaster";
$condition = "(member_no,	memb_fullname,idcard,email,mobile,password,date_reg,ipconnect)";
$value  = 	"('".$memb."','".$full_name_insert."','".$_POST["idcard1"]."','".$_POST["email1"]."',
				'".$_POST["mobile1"]."','".md5($_POST["pwd_r"])."','".$date_log."','".$ipconnect."')";
echo $status = insert_value_sql($table,$condition,$value);

$table_memberclare = "memberclare";		
$condition_memberclare = "(member_no,member_password)";
$value_memberclare = "('".$memb."','".$_POST["pwd_r"]."')";
insert_value_sql($table_memberclare,$condition_memberclare,$value_memberclare);

		if($status){
			$table = "log_action";
			$condition = "(action_do,user,ipconnect,date_log,connectby)";
			$value  = "('".$action_page."','".$memb."','".$ipconnect."','".$date_log."','".$connectby."')";
			$status1 = insert_value_sql($table,$condition,$value);
			if($status1){
				$_SESSION[ses_userid] = session_id();                      
				$_SESSION[ses_member_no] = $memb;
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

