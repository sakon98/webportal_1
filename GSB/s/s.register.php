<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
$ipconnect = $_SERVER["REMOTE_ADDR"];

$memb_no = strip_tags($_POST["memb_no"]);
$memb_no = str_replace("{","", $memb_no); $memb_no = str_replace("}","", $memb_no); $memb_no = str_replace(";","", $memb_no); $memb_no = str_replace("[","", $memb_no); $memb_no = str_replace("]","", $memb_no); $memb_no = str_replace("(","", $memb_no); 
$memb_no = str_replace(")","", $memb_no);

$memb_fullname = strip_tags($_POST["memb_fullname"]);
$memb_fullname = str_replace("{","", $memb_fullname); $memb_fullname = str_replace("}","", $memb_fullname); $memb_fullname = str_replace(";","", $memb_fullname); $memb_fullname = str_replace("[","", $memb_fullname); $memb_fullname = str_replace("]","", $memb_fullname); $memb_fullname = str_replace("(","", $memb_fullname); 
$memb_fullname = str_replace(")","", $memb_fullname);

$idcard1 = strip_tags($_POST["idcard1"]);
$idcard1 = str_replace("{","", $idcard1); $idcard1 = str_replace("}","", $idcard1); $idcard1 = str_replace(";","", $idcard1); $idcard1 = str_replace("[","", $idcard1); $idcard1 = str_replace("]","", $idcard1); $idcard1 = str_replace("(","", $idcard1); 
$idcard1 = str_replace(")","", $idcard1);

$email1 = strip_tags($_POST["email1"]);
$email1 = str_replace("{","", $email1); $email1 = str_replace("}","", $email1); $email1 = str_replace(";","", $email1); $email1 = str_replace("[","", $email1); $email1 = str_replace("]","", $email1); $email1 = str_replace("(","", $email1); 
$email1 = str_replace(")","", $email1);

$mobile1 = strip_tags($_POST["mobile1"]);
$mobile1 = str_replace("{","", $mobile1); $mobile1 = str_replace("}","", $mobile1); $mobile1 = str_replace(";","", $mobile1); $mobile1 = str_replace("[","", $mobile1); $mobile1 = str_replace("]","", $mobile1); $mobile1 = str_replace("(","", $mobile1); 
$mobile1 = str_replace(")","", $mobile1);

$pwd_r = strip_tags($_POST["pwd_r"]);
$pwd_r = str_replace("{","", $pwd_r); $pwd_r = str_replace("}","", $pwd_r); $pwd_r = str_replace(";","", $pwd_r); $pwd_r = str_replace("[","", $pwd_r); $pwd_r = str_replace("]","", $pwd_r); $pwd_r = str_replace("(","", $pwd_r); 
$pwd_r = str_replace(")","", $pwd_r);

$date_log = date('Y-m-d H:i:s');
$action_page = "Register";
/*$table = "mbmembmaster";
$condition = "(member_no,	memb_fullname,idcard,email,mobile,password,date_reg,ipconnect)";
$value  = 	"('".$_POST["memb_no"]."','".$_POST["memb_fullname"]."','".$_POST["idcard1"]."','".$_POST["email1"]."',
				'".$_POST["mobile1"]."','".md5($_POST["pwd_r"])."','".$date_log."','".$ipconnect."')";*/
// prepare and bind

$servername = "localhost";
$username = "root";
$password = "WebServer";
$dbname = "webportal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"TIS620");

$stmt = $conn->prepare("INSERT INTO mbmembmaster (member_no,memb_fullname,idcard,email,mobile,password,date_reg,ipconnect)VALUES (?,?,?,?,?,?,?,?)");
$stmt->bind_param("ssssssss", $memb_no, $memb_fullname, $idcard1,$email1,$mobile1,md5($pwd_r),$date_log,$ipconnect);
$stmt->execute();

//$status = insert_value_sql($table,$condition,$value);
		if($stmt){
			/*$table = "log_action";
			$condition = "(action_do,user,ipconnect,date_log,connectby)";
			$value  = "('".$action_page."','".$_POST["memb_no"]."','".$ipconnect."','".$date_log."','".$connectby."')";
			$status1 = insert_value_sql($table,$condition,$value);*/
                    $stmt1 = $conn->prepare("INSERT INTO log_action (action_do,user,ipconnect,date_log,connectby)"
                     . " VALUES (?,?,?,?,?)");
                    $stmt1->bind_param("sssss", $action_page,$memb_no,$ipconnect,$date_log,$connectby);
                    $stmt1->execute();
                    
			if($stmt1){
				$_SESSION[ses_userid] = session_id();                      
				$_SESSION[ses_member_no] = $memb_no;
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

