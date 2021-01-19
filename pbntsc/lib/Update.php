<?php 


			session_start();
			@header('Content-Type: text/html; charset=tis-620');

	          require "../include/lib.MySql.php"; 
	
			$member_no = $_POST["member"];
				

				
				$servername = "localhost";
                $username = "root";
                $password = "WebServer";
                $dbname = "pbntsc_new";

					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					} 
				 	//mysqli_set_charset($conn,"tis-620");
					$conn->set_charset("tis620");

					  $sql = "UPDATE mbmembmaster SET password='25d55ad283aa400af464c76d713c07ad' WHERE member_no='$member_no'"; 
					  $sql2 = "UPDATE memberclare SET member_password='12345678' WHERE member_no='$member_no'"; 
					 
					

					if ($conn->query($sql) == TRUE && $conn->query($sql2) == TRUE) {
						echo '<script type="text/javascript"> window.alert("ระบบได้เปลี่ยนรหัสสมาชิกให้เป็น 12345678 แล้วกรุณาเข้าด้วยรหัสผ่านดังกล่าว") </script> ';
				        echo '<script>window.location = "../d/administrator.php?menu=Management_Member"</script>';
					} else {
						echo '<script type="text/javascript"> window.alert("กรุณาตรวจสอบระบบไม่สามารถเปลี่ยนแปลงได้") </script> ';
				        echo '<script>window.location = "../d/administrator.php?menu=Management_Member"</script>';
					}

					
				
				
			/*	$repwd = md5("12345678");
				$table_u_pwd ="mbmembmaster";
				$condition_u_pwd = "WHERE member_no = '$member_no' ";
				$value_u_pwd = "password = '$repwd'";
				$update_status = update_value_sql($table_u_pwd,$condition_u_pwd,$value_u_pwd);
				
				$table_u_pwd_clare ="memberclare";
				$condition_u_pwd_clare = "WHERE member_no = '$member_no' ";
				$value_u_pwd_clare = "member_password = '12345678'";
				$update_status_clare = update_value_sql($table_u_pwd_clare,$condition_u_pwd_clare,$value_u_pwd_clare);
				
				if(!$update_status && !$update_status_clare){
				
				echo '<script type="text/javascript"> window.alert("กรุณาตรวจสอบระบบไม่สามารถเปลี่ยนแปลงได้") </script> ';
				echo '<script>window.location = "../d/administrator.php?menu=Management_Member"</script>';
			
				
				}else{
				
				echo '<script type="text/javascript"> window.alert("ระบบได้เปลี่ยนรหัสสมาชิกให้เป็น 12345678 แล้วกรุณาเข้าด้วยรหัสผ่านดังกล่าว") </script> ';
				echo '<script>window.location = "../d/administrator.php?menu=Management_Member"</script>';
				
				
				}*/
				
				
				
				


?>