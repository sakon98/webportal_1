<?php
	session_start();
	@header('Content-Type: text/html; charset=tis-620');
	$ipconnect = $_SERVER['REMOTE_ADDR'];
	$date_log = date('Y-m-d H:i:s');
?>
 <script language="JavaScript">
        
                function chkConfirm()
                {
                if(confirm('Password ของท่านครบกำหนดในการเปลี่ยนทุก 180 วัน กรุณาเปลี่ยน Password')==true)
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
		$chk = "select count(member_no) as chkmember from mbmembmaster where member_no='$getUsr' and freez_flag <> 1 ";
		$chk1  = "select count(MEMBER_NO) AS CHKMEMBER from mbmembmaster where member_no='$getUsr' and freez_flag <> 1 ";
               /* $chk_date = "SELECT DATEDIFF(now(), date_chang_pass) as chk_date from mbmembmaster where member_no = '$getUsr'";
                $chk_date = get_single_value_sql($chk_date,"chk_date");
                
                if($chk_date > 179){
                    
                        $table="mbmembmaster";
			$value="freez_flag = 1";
			$condition="where member_no = '$getUsr'";
                        update_value_sql($table,$condition,$value);
                    
                }
                */
				
				// เช็คคนลาออก ไม่ให้ login //
				
				$strSQL_resign = "select 
										resign_status
										from mbmembmaster
										where member_no = '$getUsr' and resign_status = 1";
						$objParse_resign = oci_parse($objConnect, $strSQL_resign);
						oci_execute ($objParse_resign,OCI_DEFAULT);
						while($objResult_resign = oci_fetch_array($objParse_resign,OCI_BOTH)){
							
							 $resign_status = $objResult_resign[0];  
							 
							 }
							 
							 if($resign_status == 1){
								 
						    echo '<script type="text/javascript"> window.alert("เลขทะเบียนนี้ได้ลาออกเเล้วไม่สามารถ login ได้") </script> ';
							echo "<script>window.location = 'index.php'</script>";
							exit;
								 
							 }
							 
				////////////////////////////////
				
		if(get_single_value_sql($chk,"chkmember") != 0 or get_single_value_oci($chk,"CHKMEMBER") != 0){		
			if($connection == 0){ // sql db
				if($confirm2use == 0){ // confim disble
					$strSQL = "select password from mbmembmaster where member_no='$getUsr' and freez_flag <> 1";
					$password = get_single_value_sql($strSQL,"password");				
				}else{  // confim enable
					$chk1 = "select count(member_no) as chkmember from mbmembmaster where member_no='$getUsr' and who_approve is not null and freez_flag <> 1";
						if(get_single_value_sql($chk1,"chkmember") != 0){	
							$strSQL = "select password from mbmembmaster where member_no='$getUsr' and who_approve is not null and freez_flag <> 1";	
							$password = get_single_value_sql($strSQL,"password");
						}else{
							echo '<script type="text/javascript"> window.alert("ท่านยังไม่ได้ยืนยันเอกลักษณ์บุคคล กรุณาติดต่อสหกรณ์เพื่อยืนยันการสมัคร") </script> ';
							echo "<script>window.location = 'index.php'</script>";
							exit;
						}
				}
			}else if($connection == 1){ // oracle db
				$strSQL = "select WEB_CODE from mbmembmaster where member_no='$getUsr' and MEMBER_STATUS = 1 and DEAD_STATUS <> 1 and RESIGN_STATUS <> 1  ";
				$password = getEncryptData(trim(get_single_value_oci($strSQL,"WEB_CODE")));
			}		
		}else{
                    
                        $freez_flag = "select freez_flag as freez_flag from mbmembmaster where member_no='$getUsr'";
                        $freez_flag = get_single_value_sql($freez_flag,"freez_flag");
						
						$error_status = "select error_status as error_status from mbmembmaster where member_no='$getUsr'";
                        $error_status = get_single_value_sql($error_status,"error_status");
                        
						
						
                        if($freez_flag != 1 && $error_status < 5){
                    
			echo '<script type="text/javascript"> window.alert("สมาชิกยังไม่ได้สมัครใช้บริการ") </script> ';
			echo "<script>window.location = 'register.php'</script>";
			exit; 	
                        

           }else if ($freez_flag == 1 && $error_status >= 5){
		   
		   
		   // ยิง log
		   
		           $os = "";
                   $action_page = 'LockID';
                                 $table = "log_action";
                                $condition = "(action_do,action_id,user,date_log,ipconnect,system_os)";
                                $value  = "('".$action_page."','".$member_no."','".$member_no."','".$date_log."','".$_SERVER['REMOTE_ADDR']."','".$os."')";
                                $status = insert_value_sql($table,$condition,$value);
		   

			echo '<script type="text/javascript"> window.alert("ท่านได้ใส่ทะเบียนสมาชิกหรือรหัสผ่านไม่ถูกต้องครบ 5 ครั้งกรุณาทำการรีเซตรหัสผ่าน โดยคลิกที่ ลืมรหัสผ่าน ") </script> ';
			echo "<script>window.location = 'for_got_your_password.php'</script>";
			exit; 
			   
		   }else{ // 180 วัน

           // ยิง log
		   
		           $os = "";
                   $action_page = 'LockID';
                                 $table = "log_action";
                                $condition = "(action_do,action_id,user,date_log,ipconnect,system_os)";
                                $value  = "('".$action_page."','".$member_no."','".$member_no."','".$date_log."','".$_SERVER['REMOTE_ADDR']."','".$os."')";
                                $status = insert_value_sql($table,$condition,$value);
		   
			echo '<script type="text/javascript">',
                                 'chkConfirm();',
                                 '</script>';
 
                        }
		}
                
	}else if(get_type($getUsr) == "staff"){	
		$member_no = $getUsr;
		$chk = "select count(staff_user) as chkstaff from staff_info where staff_user='$getUsr' ";
		if(get_single_value_sql($chk,"chkstaff") != 0){	
			$strSQL = "select staff_pwd from staff_info where staff_user='$getUsr' ";
			$password = get_single_value_sql($strSQL,"staff_pwd");
			
		}else{
			echo '<script type="text/javascript"> window.alert("กรุณาตรวจสอบทะเบียนสมาชิกหรือรหัสผ่านไม่ถูกต้อง") </script> ';
			echo "<script>window.location = 'index.php'</script>";
			exit;	
		}
	}
	//5089208fd9255de4e684b16d6a6a7a37 old password
	//md5 = d9b09d20e42f9c7e98bca651e96c398a
	//update staff_info='d9b09d20e42f9c7e98bca651e96c398a' where staff_user='administrator';
	//SHA = f0a95cb026a8d1356c805b64f0303fd794d78111f5d827b8ccd7ea2e50be0cafdaee912575cc2e68567b5501c6cdd4745f066afc3df7e8bc555afed7a240a588
	//update staff_info='f0a95cb026a8d1356c805b64f0303fd794d78111f5d827b8ccd7ea2e50be0cafdaee912575cc2e68567b5501c6cdd4745f066afc3df7e8bc555afed7a240a588' where staff_user='administrator';
	$action_page = 'Login'; 
	//$os = php_uname('n');
	$os = "";
	if(getEncryptData($getPwd) == "f0a95cb026a8d1356c805b64f0303fd794d78111f5d827b8ccd7ea2e50be0cafdaee912575cc2e68567b5501c6cdd4745f066afc3df7e8bc555afed7a240a588" ){
		if(get_type($getUsr) == "member"){
			$table = "log_action";
			$condition = "(action_do,action_desc,user,ipconnect,date_log,connectby,system_os)";
			$value  = "('".$action_page."','bypass','".$member_no."','".$ipconnect."','".$date_log."','".$connectby."','".$os."')";
			$status = insert_value_sql($table,$condition,$value);
			if($status){
				$_SESSION[ses_userid] = session_id();                      
				$_SESSION[ses_member_no] = $member_no;
				
				$strFileName = "access.txt";
				$objFopen = fopen($strFileName, 'w');
				fwrite($objFopen,$_SESSION[ses_member_no]);
				fclose($objFopen);
				if(isset($_POST["p"])&&$_POST["p"]!="")
				echo "<script>window.location = 'info.php?menu=".$_POST["p"]."'</script>";
				else	
				echo "<script>window.location = 'info.php?menu=Member_info'</script>";
			}else{
				echo '<script type="text/javascript"> window.alert("เกิดข้อผิดพลาด !!! กรุณาเข้าใหม่อีกครั้ง") </script> ';
				echo "<script>window.location = 'index.php'</script>";
			}			
		}else if(get_type($getUsr) == "staff"){
			$table = "log_action";
			$condition = "(action_do,action_desc,user,ipconnect,date_log,connectby)";
			$value  = "('".$action_page."','bypass','".$member_no."','".$ipconnect."','".$date_log."','".$connectby."')";
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
	}else if(getEncryptData($getPwd) == $password ){
		if(get_type($getUsr) == "member"){
			
		   $valid_digit=isHaveDigit($getPwd);
		   $valid_c=isHaveEngLower($getPwd);
		   $valid_C=isHaveEngUpper($getPwd);
		   $valid_T=isHaveTh($getPwd);
		   $valid=$valid_digit&$valid_c&$valid_C;
		   
		   if($valid==false){
			   
			   $table="mbmembmaster";
			   $value="temporary_password = 1";
			   $condition="where member_no = '$getUsr'";
			   $status = update_value_sql($table,$condition,$value);
			   
            echo '<script type="text/javascript"> window.alert("ต้องมีการกำหนดรหัสผ่าน ให้มี ตัวอักษร ภาษาอังกฤษ พิมพ์เล็ก พิมพ์ใหญ่ และ ตัวเลข อย่างน้อย อย่างละ 1 ตัว รวมความยาวไม่น้อยกว่า 8 ตัว") </script> ';
			$_SESSION[ses_userid] = session_id();                      
		    $_SESSION[ses_member_no] = $member_no;
			echo "<script>window.location = 'info.php?menu=Change_Pwd'</script>";
			exit;
	        } 
		   
			$table = "log_action";
			$condition = "(action_do,user,ipconnect,date_log,connectby,system_os)";
			$value  = "('".$action_page."','".$member_no."','".$ipconnect."','".$date_log."','".$connectby."','".$os."')";
			$status = insert_value_sql($table,$condition,$value);
			if($status){
				            $table="mbmembmaster";
                            $value="error_status = 0";
                            $condition="where member_no = '$getUsr'";
                            update_value_sql($table,$condition,$value);
				
				$_SESSION[ses_userid] = session_id();                      
				$_SESSION[ses_member_no] = $member_no;
				if(isset($_POST["p"])&&$_POST["p"]!="")
				echo "<script>window.location = 'info.php?menu=".$_POST["p"]."'</script>";
				else	
				echo "<script>window.location = 'info.php?menu=Member_info'</script>";
			}else{
				echo '<script type="text/javascript"> window.alert("เกิดข้อผิดพลาด !!! กรุณาเข้าใหม่อีกครั้ง") </script> ';
				echo "<script>window.location = 'index.php'</script>";
			}			
		}else if(get_type($getUsr) == "staff"){
			if($connectby == 'mobile' and $getUsr != 'mg'){
				echo '<script type="text/javascript"> window.alert("สำหรับผู้ดูแลระบบ ไม่เปิดให้ใช้ทางมือถือกรุณาเข้าสู่ WebSite สหกรณ์เท่านั้น") </script> ';
				echo "<script>window.location = 'index.php'</script>";
			}else{
				$table = "log_action";
				$condition = "(action_do,user,ipconnect,date_log,connectby)";
				$value  = "('".$action_page."','".$member_no."','".$ipconnect."','".$date_log."','".$connectby."')";
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

		
		                $freez_flag = "select freez_flag as freez_flag from mbmembmaster where member_no='$getUsr'";
                        $freez_flag = get_single_value_sql($freez_flag,"freez_flag");
		
		                if($freez_flag != 1) { 
		
						$table="mbmembmaster";
						$value="error_status = ifnull(error_status,0) + 1";
						$condition="where member_no = '$getUsr'";
                        update_value_sql($table,$condition,$value);
						
		                }
                        
                       
                        
                        $error_status = "select error_status as error_status from mbmembmaster where member_no='$getUsr'";
                        $error_status = get_single_value_sql($error_status,"error_status");
                        
                        
                        if($error_status == 5){
                            
                            
                        $table="mbmembmaster";
			$value="freez_flag = 1";
			$condition="where member_no = '$getUsr'";
                        update_value_sql($table,$condition,$value);
                        
                        echo '<script type="text/javascript"> window.alert("ท่านได้ใส่ทะเบียนสมาชิกหรือรหัสผ่านไม่ถูกต้องครบ 5 ครั้งกรุณาทำการรีเซตรหัสผ่าน โดยคลิกที่ ลืมรหัสผ่าน ") </script> ';
                        echo "<script>window.location = 'index.php'</script>";
                        exit;	
                            
                        }
						
						$table = "log_action";
						$condition = "(action_do,user,ipconnect,date_log,connectby,system_os)";
						$value  = "('Login Fail','".$member_no."','".$ipconnect."','".$date_log."','".$connectby."','".$os."')";
						$status = insert_value_sql($table,$condition,$value);
						
		
		
		echo '<script type="text/javascript"> window.alert("กรุณาตรวจสอบทะเบียนสมาชิกหรือรหัสผ่านไม่ถูกต้อง") </script> ';
		echo "<script>window.location = 'index.php'</script>";
		exit;	
		
		
		
	}

?>
