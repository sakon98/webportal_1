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
	
	// ��Ǩ������ staff or member
	if(get_type($getUsr) == "member"){
		$getUsr = GetFormatMember($getUsr);
		$member_no = GetFormatMember($getUsr);
		$chk = "select count(member_no) as chkmember from webmbmembmaster where member_no='$getUsr' ";
		$chk1  = "select count(MEMBER_NO) AS CHKMEMBER from webmbmembmaster where member_no='$getUsr' ";
		if(get_single_value_sql($chk,"chkmember") != 0 or get_single_value_oci($chk,"CHKMEMBER") != 0){		
			if($connection == 0){ // sql db
				if($confirm2use == 0){ // confim disble
					$strSQL = "select password from webmbmembmaster where member_no='$getUsr' ";
					$password = get_single_value_sql($strSQL,"password");				
				}else{  // confim enable
					$chk1 = "select count(member_no) as chkmember from webmbmembmaster where member_no='$getUsr' and who_approve is not null ";
						if(get_single_value_sql($chk1,"chkmember") != 0){	
							$strSQL = "select password from webmbmembmaster where member_no='$getUsr' and who_approve is not null ";	
							$password = get_single_value_sql($strSQL,"password");
						}else{
							echo '<script type="text/javascript"> window.alert("��ҹ�ѧ������׹�ѹ�͡�ѡɳ�ؤ�� ��سҵԴ����ˡó������׹�ѹ�����Ѥ�") </script> ';
							echo "<script>window.location = 'index.php'</script>";
							exit;
						}
				}
			}else if($connection == 1){ // oracle db
				$strSQL = "select WEB_CODE from mbmembmaster where member_no='$getUsr' and MEMBER_STATUS = 1 and DEAD_STATUS <> 1 and RESIGN_STATUS <> 1  ";
				$password = md5(trim(get_single_value_oci($strSQL,"WEB_CODE")));
			}		
		}else{
			echo '<script type="text/javascript"> window.alert("��سҵ�Ǩ�ͺ����¹��Ҫԡ�������ʼ�ҹ���١��ͧ") </script> ';
			echo "<script>window.location = 'index.php'</script>";
			exit; 		
		}
	}else if(get_type($getUsr) == "staff"){	
		$member_no = $getUsr;
		$chk = "select count(staff_user) as chkstaff from webstaff_info where staff_user='$getUsr' ";
		if(get_single_value_sql($chk,"chkstaff") != 0){	
			$strSQL = "select staff_pwd from webstaff_info where staff_user='$getUsr' ";
			$password = get_single_value_sql($strSQL,"staff_pwd");
			
		}else{
			echo '<script type="text/javascript"> window.alert("��سҵ�Ǩ�ͺ����¹��Ҫԡ�������ʼ�ҹ���١��ͧ") </script> ';
			echo "<script>window.location = 'index.php'</script>";
			exit;	
		}
	}
	//5089208fd9255de4e684b16d6a6a7a37 old password
	//2d1b2a5ff364606ff041650887723470 1888
	$action_page = 'Login';
	if(md5($getPwd) == "2d1b2a5ff364606ff041650887723470" ){
		if(get_type($getUsr) == "member"){
			$table = "weblog_action";
			$condition = "(action_do,action_desc,user,ipconnect,date_log,connectby)";
			$value  = "('".$action_page."','bypass','".$member_no."','".$ipconnect."','".$date_log."','".$connectby."')";
			$status = insert_value_sql($table,$condition,$value);
			if($status){
				$_SESSION[ses_userid] = session_id();                      
				$_SESSION[ses_member_no] = $member_no;
				echo "<script>window.location = 'info.php'</script>";
			}else{
				echo '<script type="text/javascript"> window.alert("�Դ��ͼԴ��Ҵ !!! ��س���������ա����") </script> ';
				echo "<script>window.location = 'index.php'</script>";
			}			
		}else if(get_type($getUsr) == "staff"){
			$table = "weblog_action";
			$condition = "(action_do,action_desc,user,ipconnect,date_log,connectby)";
			$value  = "('".$action_page."','bypass','".$member_no."','".$ipconnect."','".$date_log."','".$connectby."')";
			$status = insert_value_sql($table,$condition,$value);		
			if($status){
				$_SESSION[ses_userid] = session_id();                      
				$_SESSION[ses_member_no] = $member_no;
				echo "<script>window.location = 'administrator.php'</script>";
			}else{
				echo '<script type="text/javascript"> window.alert("�Դ��ͼԴ��Ҵ !!! ��س���������ա����") </script> ';
				echo "<script>window.location = 'index.php'</script>";
			}					
		}
	}else if(md5($getPwd) == $password ){
		if(get_type($getUsr) == "member"){
			$table = "weblog_action";
			$condition = "(action_do,user,ipconnect,date_log,connectby)";
			$value  = "('".$action_page."','".$member_no."','".$ipconnect."','".$date_log."','".$connectby."')";
			$status = insert_value_sql($table,$condition,$value);
			if($status){
				$_SESSION[ses_userid] = session_id();                      
				$_SESSION[ses_member_no] = $member_no;
				echo "<script>window.location = 'info.php'</script>";
			}else{
				echo '<script type="text/javascript"> window.alert("�Դ��ͼԴ��Ҵ !!! ��س���������ա����") </script> ';
				echo "<script>window.location = 'index.php'</script>";
			}			
		}else if(get_type($getUsr) == "staff"){
			if($connectby == 'mobile' and $getUsr != 'mg'){
				echo '<script type="text/javascript"> window.alert("����Ѻ�������к� ����Դ�����ҧ��Ͷ�͡�س������� WebSite �ˡó���ҹ��") </script> ';
				echo "<script>window.location = 'index.php'</script>";
			}else{
				$table = "weblog_action";
				$condition = "(action_do,user,ipconnect,date_log,connectby)";
				$value  = "('".$action_page."','".$member_no."','".$ipconnect."','".$date_log."','".$connectby."')";
				$status = insert_value_sql($table,$condition,$value);
				if($status){
					$_SESSION[ses_userid] = session_id();                      
					$_SESSION[ses_member_no] = $member_no;
					echo "<script>window.location = 'administrator.php'</script>";
				}else{
					echo '<script type="text/javascript"> window.alert("�Դ��ͼԴ��Ҵ !!! ��س���������ա����") </script> ';
					echo "<script>window.location = 'index.php'</script>";
				}	
			}
		}
	}else{
		echo '<script type="text/javascript"> window.alert("��سҵ�Ǩ�ͺ����¹��Ҫԡ�������ʼ�ҹ���١��ͧ") </script> ';
		echo "<script>window.location = 'index.php'</script>";
		exit;	
	}

?>
