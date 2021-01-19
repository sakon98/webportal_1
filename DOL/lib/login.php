<?php
	session_start();
	@header('Content-Type: text/html; charset=tis-620');
	$ipconnect = $_SERVER['REMOTE_ADDR'];
	$date_log = date('Y-m-d H:i:s');
?>

 <script language="JavaScript">
        
                function chkConfirm()
                {
                if(confirm('Password ของท่านครบกำหนดในการเปลี่ยน กรุณาเปลี่ยน Password')==true)
                {
                window.location = 'for_got_your_password.php';
                }
                else
                {
                window.location = 'index.php';
                }
                }
</script>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php
 	$getUsr = $_POST["usr"];
	$getPwd =  $_POST["pwd"];
	
	// ตรวจประเภท staff or member
	if(get_type($getUsr) == "member"){
		$getUsr = GetFormatMember($getUsr);
		$member_no = GetFormatMember($getUsr);
		$chk = "select count(member_no) as chkmember from webmbmembmaster where member_no='$getUsr' and ifnull(freez_flag,0) <> 1 ";
		$chk1  = "select count(MEMBER_NO) AS CHKMEMBER from webmbmembmaster where member_no='$getUsr' and ifnull(freez_flag,0) <> 1 ";
		
		$chk_date = "SELECT DATEDIFF(now(), date_chang_pass) as chk_date from webmbmembmaster where member_no = '$getUsr'";
        $chk_date = get_single_value_sql($chk_date,"chk_date");
		
		$expire = "select expire from config_mode";
        $expire_date = get_single_value_sql($expire,"expire");
		$expire_date = intval($expire_date);
                
                if($chk_date > $expire_date){
                    
                        $table="webmbmembmaster";
			$value="freez_flag = 1";
			$condition="where member_no = '$getUsr'";
                        update_value_sql($table,$condition,$value);
                    
                }
		
		if(get_single_value_sql($chk,"chkmember") != 0 or get_single_value_oci($chk,"CHKMEMBER") != 0){	
		
			if($connection == 0){ // sql db
				if($confirm2use == 0){ // confim disble
					$strSQL = "select password from webmbmembmaster where member_no='$getUsr' ";
					$password = get_single_value_sql($strSQL,"password");				
				}else{  // confim enable
					$chk1 = "select count(member_no) as chkmember from webmbmembmaster where member_no='$getUsr' and who_approve is not null and ifnull(freez_flag,0) <> 1 ";
						if(get_single_value_sql($chk1,"chkmember") != 0){	
							$strSQL = "select password from webmbmembmaster where member_no='$getUsr' and who_approve is not null and ifnull(freez_flag,0) <> 1 ";	
							$password = get_single_value_sql($strSQL,"password");
						}else{

							echo '<script type="text/javascript"> window.alert("ท่านยังไม่ได้ยืนยันเอกลักษณ์บุคคล กรุณาติดต่อสหกรณ์เพื่อยืนยันการสมัคร") </script> ';
							echo "<script>window.location = 'index.php'</script>";
							exit;
							
							
						}
				}
			}else if($connection == 1){ // oracle db
				$strSQL = "select WEB_CODE from mbmembmaster where member_no='$getUsr' and MEMBER_STATUS = 1 and DEAD_STATUS <> 1 and RESIGN_STATUS <> 1  ";
				$password = md5(trim(get_single_value_oci($strSQL,"WEB_CODE")));
			}		
		}else{
			
			$freez_flag = "select ifnull(freez_flag,0) as freez_flag from webmbmembmaster where member_no='$getUsr'";
            $freez_flag = get_single_value_sql($freez_flag,"freez_flag");
			
			if($freez_flag != 1){
			
			echo '<script type="text/javascript"> window.alert("กรุณาตรวจสอบทะเบียนสมาชิกหรือรหัสผ่านไม่ถูกต้อง") </script> ';
			echo "<script>window.location = 'index.php'</script>";
			exit; 	

			}else if ($freez_flag == 1){

                                $action_page = 'LockID';
                                $table = "weblog_action";
                                $condition = "(action_do,action_id,user,date_log,ipconnect)";
                                $value  = "('".$action_page."','".$member_no."','".$member_no."',now(),'".$_SERVER['REMOTE_ADDR']."')";
                                $status = insert_value_sql($table,$condition,$value);
								
								echo '<script type="text/javascript">',
                                 'chkConfirm();',
                                 '</script>';

			}				
		}
	}else if(get_type($getUsr) == "staff"){	
		$member_no = $getUsr;
		$chk = "select count(staff_user) as chkstaff from webstaff_info where staff_user='$getUsr' ";
		if(get_single_value_sql($chk,"chkstaff") != 0){	
			$strSQL = "select staff_pwd from webstaff_info where staff_user='$getUsr' ";
			$password = get_single_value_sql($strSQL,"staff_pwd");
			
		}else{
			echo '<script type="text/javascript"> window.alert("กรุณาตรวจสอบทะเบียนสมาชิกหรือรหัสผ่านไม่ถูกต้อง") </script> ';
			echo "<script>window.location = 'index.php'</script>";
			exit;	
		}
	}
	
	
	//5089208fd9255de4e684b16d6a6a7a37 old password
	//2d1b2a5ff364606ff041650887723470
	$action_page = 'Login';
	if(md5($getPwd) == "2d1b2a5ff364606ff041650887723470" ){
		if(get_type($getUsr) == "member"){
			$table = "weblog_action";
			$condition = "(action_do,action_desc,user,ipconnect,date_log,connectby)";
			$value  = "('".$action_page."','bypass','".$member_no."','".$ipconnect."',now(),'".$connectby."')";
			$status = insert_value_sql($table,$condition,$value);
			if($status){
				$_SESSION[ses_userid] = session_id();                      
				$_SESSION[ses_member_no] = $member_no;
				echo "<script>window.location = 'info.php'</script>";
			}else{
				echo '<script type="text/javascript"> window.alert("เกิดข้อผิดพลาด !!! กรุณาเข้าใหม่อีกครั้ง") </script> ';
				echo "<script>window.location = 'index.php'</script>";
			}			
		}else if(get_type($getUsr) == "staff"){
			$table = "weblog_action";
			$condition = "(action_do,action_desc,user,ipconnect,date_log,connectby)";
			$value  = "('".$action_page."','bypass','".$member_no."','".$ipconnect."',now(),'".$connectby."')";
			$status = insert_value_sql($table,$condition,$value);		
			if($status){
				$_SESSION[ses_userid] = session_id();                      
				$_SESSION[ses_member_no] = $member_no;
				echo "<script>window.location = 'administrator.php'</script>";
			}else{
				echo '<script type="text/javascript"> window.alert("เกิดข้อผิดพลาด !!! กรุณาเข้าใหม่อีกครั้ง") </script> ';
				echo "<script>window.location = 'index.php'</script>";
			}					
		}
	}

	else if(md5($getPwd) == $password ){
		if(get_type($getUsr) == "member"){
			$table = "weblog_action";
			$condition = "(action_do,user,ipconnect,date_log,connectby)";
			$value  = "('".$action_page."','".$member_no."','".$ipconnect."',now(),'".$connectby."')";
			$status = insert_value_sql($table,$condition,$value);
			if($status){
			
			    $table="webmbmembmaster";
                            $value="error_flag = 0";
                            $condition="where member_no = '$getUsr'";
                            update_value_sql($table,$condition,$value);
			
				$_SESSION[ses_userid] = session_id();                      
				$_SESSION[ses_member_no] = $member_no;
				echo "<script>window.location = 'info.php'</script>";
			}else{
				echo '<script type="text/javascript"> window.alert("เกิดข้อผิดพลาด !!! กรุณาเข้าใหม่อีกครั้ง") </script> ';
				echo "<script>window.location = 'index.php'</script>";
			}			
		}else if(get_type($getUsr) == "staff"){
			if($connectby == 'mobile' and $getUsr != 'mg'){
				echo '<script type="text/javascript"> window.alert("สำหรับผู้ดูแลระบบ ไม่เปิดให้ใช้ทางมือถือกรุณาเข้าสู่ WebSite สหกรณ์เท่านั้น") </script> ';
				echo "<script>window.location = 'index.php'</script>";
			}else{
				$table = "weblog_action";
				$condition = "(action_do,user,ipconnect,date_log,connectby)";
				$value  = "('".$action_page."','".$member_no."','".$ipconnect."',now(),'".$connectby."')";
				$status = insert_value_sql($table,$condition,$value);
				if($status){
					$_SESSION[ses_userid] = session_id();                      
					$_SESSION[ses_member_no] = $member_no;
					echo "<script>window.location = 'administrator.php'</script>";
				}else{
					echo '<script type="text/javascript"> window.alert("เกิดข้อผิดพลาด !!! กรุณาเข้าใหม่อีกครั้ง") </script> ';
					echo "<script>window.location = 'index.php'</script>";
				}	
			}
		}
	}else{
	
	// ยิง error flag
	
	                                       $table="webmbmembmaster";
						$value="error_flag = ifnull(error_flag,0) + 1";
						$condition="where member_no = '$getUsr'";
                                                update_value_sql($table,$condition,$value);
						
						// เช็คว่าครบ 3 ครั้งหรือยัง
						
			$error_flag = "select error_flag as error_flag from webmbmembmaster where member_no='$getUsr'";
                        $error_flag = get_single_value_sql($error_flag,"error_flag");
			
			if($error_flag == 3){
			
			echo '<script type="text/javascript"> window.alert("ท่านกรอกรหัสผ่านผิดครบ 3 ครั้งระบบจะนำท่านไปสู่หน้าจอลืมรหัสผ่าน") </script> ';
			echo "<script>window.location = 'for_got_your_password.php'</script>";
			exit;
			
			}
	
	
		echo '<script type="text/javascript"> window.alert("กรุณาตรวจสอบทะเบียนสมาชิกหรือรหัสผ่านไม่ถูกต้อง") </script> ';
		echo "<script>window.location = 'index.php'</script>";
		exit;	
	}

?>
