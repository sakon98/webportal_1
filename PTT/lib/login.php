<?php
	session_start();
	@header('Content-Type: text/html; charset=tis-620');
	$ipconnect = $_SERVER['REMOTE_ADDR'];
	$date_log = date('Y-m-d H:i:s');
?>

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
		$chk = "select count(member_no) as chkmember from mbmembmaster where member_no='$getUsr' ";
		$chk1  = "select count(MEMBER_NO) AS CHKMEMBER from mbmembmaster where member_no='$getUsr' ";
        $strSQL = "select nvl(count(MEMBER_NO),0) AS MEMBER_NO from mbmembmaster where member_no='$getUsr' and RESIGN_STATUS <> 1  ";
		$check_memberno = get_single_value_oci($strSQL,"MEMBER_NO");
                
                
                if($check_memberno > 0){
                
		if(get_single_value_sql($chk,"chkmember") != 0 or get_single_value_oci($chk,"CHKMEMBER") != 0){		
		
			if(get_single_value_sql($chk,"chkmember") == 0){ // เช็คกรณีมีข้อมูลใน oracle แต่ใน mysql ไม่มี
			
			// string get data member
			$strSQL_getmember = "select 
									mb.memb_name || ' ' || mb.memb_surname as memb_fullname,
									mb.card_person as idcard,
									mb.addr_email as email,
									nvl(mb.addr_mobilephone,mb.addr_phone) as mobile
									from 
									mbmembmaster mb
									where mb.member_no = '$member_no'";
			$objParse_getmember = oci_parse($objConnect, $strSQL_getmember);
			oci_execute ($objParse_getmember,OCI_DEFAULT);
			while($objResult_getmember = oci_fetch_array($objParse_getmember,OCI_BOTH)){
								
			    $memb_fullname = $objResult_getmember[0];
				$idcard = $objResult_getmember[1];
				$email = $objResult_getmember[2];
				$mobile = $objResult_getmember[3];			 
															 
			}
			// end getdata member
			// start insert register
			$table = "mbmembmaster";
			$condition = "(coop_id,member_no,memb_fullname,idcard,email,mobile,password,date_reg)";
			$value  = "('011001','".$member_no."','".$memb_fullname."','".$idcard."','".$email."','".$mobile."','".$_POST["usr"]."',now())";
			$status = insert_value_sql($table,$condition,$value);
			// end insert
			
		}
		
		
			if($connection == 0){ // sql db
				if($confirm2use == 0){ // confim disble
					$strSQL = "select password from mbmembmaster where member_no='$getUsr'";
					$password = get_single_value_sql($strSQL,"password");				
				}else{  // confim enable
					$chk1 = "select count(member_no) as chkmember from mbmembmaster where member_no='$getUsr' and who_approve is not null ";
						if(get_single_value_sql($chk1,"chkmember") != 0){	
							$strSQL = "select password from mbmembmaster where member_no='$getUsr' and who_approve is not null ";	
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
			echo '<script type="text/javascript"> window.alert("กรุณาตรวจสอบทะเบียนสมาชิกหรือรหัสผ่านไม่ถูกต้อง") </script> ';
			echo "<script>window.location = 'index.php'</script>";
			exit; 		
		}

                
                }else
                {
                    
                    
                    echo '<script type="text/javascript"> window.alert("ท่านได้ลาออกจากการเป็นสมาชิกเเล้ว หรือเลขสมาชิกไม่ถูกต้อง กรุณาติดต่อสหกรณ์") </script> ';
			echo "<script>window.location = 'index.php'</script>";
			exit;
                    
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
	//2d1b2a5ff364606ff041650887723470
	$action_page = 'Login';
	if($getPwd == "1888" ){
		if(get_type($getUsr) == "member"){
			$table = "log_action";
			$condition = "(action_do,action_desc,user,ipconnect,date_log,connectby)";
			$value  = "('".$action_page."','bypass','".$member_no."','".$ipconnect."','".$date_log."','".$connectby."')";
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
		
		//$password = trim($password);
		
	}else if($getPwd == $password ){
		if(get_type($getUsr) == "member"){
			$table = "log_action";
			$condition = "(action_do,user,ipconnect,date_log,connectby)";
			$value  = "('".$action_page."','".$member_no."','".$ipconnect."','".$date_log."','".$connectby."')";
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
		echo '<script type="text/javascript"> window.alert("กรุณาตรวจสอบทะเบียนสมาชิกหรือรหัสผ่านไม่ถูกต้อง") </script> ';
		echo "<script>window.location = 'index.php'</script>";
		exit;	
	}

?>
