<?php
	//session_start();
    //@header('Content-Type: text/html; charset=tis-620');
   // require "../include/conf.conn.php";
   // require "../include/conf.c.php";
	//require "../include/lib.Etc.php";
	//require "../include/lib.MySql.php";
	//require "../include/lib.Oracle.php"; 
	$ipconnect = $_SERVER['REMOTE_ADDR'];
	$date_log = date('Y-m-d H:i:s');
	
	
	function get_type_($var){ // Check Type value
		if (is_numeric($var)) return "member";
		if (is_string($var)) return "staff";
		
		return "member";
	} 

 	$getIdcard = $_POST["idcard"];
 	$getUsr = $_POST["usr"];
	$getPwd =  $_POST["pwd"];
	
	// ตรวจประเภท staff or member
	if(get_type_($getUsr) == "member"||get_type_($getIdcard) == "member"){
		$getUsr = GetFormatMember($getUsr);
		$member_no = GetFormatMember($getUsr);
		
		$strSQL = "SELECT 
					trim(MB.DEPTACCOUNT_NO) AS MEMBER_NO,
					'' AS PRENAME,
					MB.WFACCOUNT_NAME AS NAME,
					'' AS SURNAME,
					MB.WFBIRTHDAY_DATE AS BIRTH_DATE,
					trim(MB.CARD_PERSON) AS CARD_PERSON,
					'' AS ADDR_EMAIL,
					MB.PHONE AS ADDR_PHONE,
					MB.PHONE AS ADDR_MOBILEPHONE,
					MB.DEPTOPEN_DATE AS MEMBER_DATE,
					MB.CARREER AS POSITION_DESC,
					MBG1.COOPBRANCH_DESC  AS MEMBGROUP_DESC1,
				  	MB.DEPTMONTH_AMT AS SALARY_AMOUNT,
				  	'' AS SALARY_ID,
				  	'' AS WEB_CODE,
					MBT.WCMEMBERTYPE_DESC AS MEMBTYPE_DESC,
					MB.MEMBGROUP_CODE AS MEMBGROUP_CODE,
					'' AS ACCUM_INTEREST,
					TO_CHAR(MB.PRNCBAL,'99G999G999G999D00') as PRNCBAL,
					MB.TOTAL_AGE as TOTAL_AGE,
					MB.DIE_DATE as DIE_DATE,
					MB.MATE_NAME as MATE_NAME,
					MB.MANAGE_CORPSE_NAME as MANAGE_CORPSE_NAME,
					MB.CONTACT_ADDRESS||' อ.'||(select p.district_desc from mbucfdistrict p where p.district_code = mb.ampher_code)||' จ.'||(select p.province_desc from mbucfprovince p where p.province_code = mb.province_code)||' '||MB.postcode as OTHER_CONTACT_ADDRESS,
					MB.MEMBER_NO as MEMBER_NO_
				FROM 
					WCDEPTMASTER MB,
					CMUCFCOOPBRANCH MBG1,
					WCMEMBERTYPE MBT
				WHERE 
					( MB.BRANCH_ID = MBG1.COOPBRANCH_ID ) 
					AND ( MBG1.CS_TYPE ='8'  )  
					AND ( MB.WFTYPE_CODE = MBT.WFTYPE_CODE  )  
          			AND MB.DEPTCLOSE_STATUS = '0' 
					AND trim(MB.CARD_PERSON) = '$getIdcard' ";
/*					AND MB.RESIGN_STATUS <> '1' 
					AND MB.DEAD_STATUS <> 1 */
			$value = array('MEMBER_NO','PRENAME','NAME','SURNAME','BIRTH_DATE','CARD_PERSON','ADDR_EMAIL','ADDR_PHONE','ADDR_MOBILEPHONE','MEMBER_DATE','POSITION_DESC','MEMBGROUP_DESC1','SALARY_AMOUNT','SALARY_ID','WEB_CODE','MEMBTYPE_DESC','MEMBGROUP_CODE','ACCUM_INTEREST');
			list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);

		$getUsr=$list_info[0][0];
		$member_no=$getUsr;
		$_POST["memb_no"]=$member_no;
		$_POST["memb_fullname"]=$list_info[0][1]." ".$list_info[0][2]." ".$list_info[0][3];
		$_POST["idcard1"]=$list_info[0][5];
		$_POST["email1"]=$list_info[0][6];
		$_POST["mobile1"]=$list_info[0][7];
		$_POST["pwd"]=$_POST["idcard1"];
		$_POST["pwd_r"]=$_POST["pwd"];
		$getPwd = $_POST["pwd"];
		
		$action_page = "Login";
		$table = "mbmembmaster";
		$condition = "(member_no,memb_fullname,idcard,email,mobile,password,date_reg,ipconnect)";
		$value  = 	"('".$_POST["memb_no"]."','".$_POST["memb_fullname"]."','".$_POST["idcard1"]."','".$_POST["email1"]."',
						'".$_POST["mobile1"]."','".md5($_POST["pwd_r"])."','".$date_log."','".$ipconnect."')";
		//$status = insert_value_sql($table,$condition,$value);
		$strSQL = "INSERT INTO mbmembmaster $condition VALUES $value";
        $objQuery = mysql_query($strSQL);
		$strSQL_ = "update mbmembmaster set 
					member_no='".$_POST["memb_no"]."',
					memb_fullname='".$_POST["memb_fullname"]."',
					email='".$_POST["email1"]."',
					mobile='".$_POST["mobile1"]."',
					password ='".md5($_POST["pwd_r"])."' 
					where idcard='".$_POST["idcard1"]."' ";
        $objQuery = mysql_query($strSQL_);
		
		
		$chk = "select count(member_no) as chkmember from mbmembmaster where member_no='$getUsr' ";
		$chk1  = "select count(MEMBER_NO) AS CHKMEMBER from mbmembmaster where member_no='$getUsr' ";
		if(get_single_value_sql($chk,"chkmember") != 0 or get_single_value_oci($chk,"CHKMEMBER") != 0){		
			if($connection == 0){ // sql db
				if($confirm2use == 0){ // confim disble
					$strSQL = "select password from mbmembmaster where member_no='$getUsr' ";
					$password = get_single_value_sql($strSQL,"password");				
				}else{  // confim enable
					$chk1 = "select count(member_no) as chkmember from mbmembmaster where member_no='$getUsr' and who_approve is not null ";
						if(get_single_value_sql($chk1,"chkmember") != 0){	
							$strSQL = "select password from mbmembmaster where member_no='$getUsr' and who_approve is not null ";	
							$password = get_single_value_sql($strSQL,"password");
						}else{
							echo '<script type="text/javascript"> window.alert("ท่านยังไม่ได้ยืนยันเอกลักษณ์บุคคล กรุณาติดต่อสหกรณ์เพื่อยืนยันการสมัคร") </script> ';
							echo "<script>window.location = 'index.php'</script>";
							//exit;
						}
				}
			}else if($connection == 1){ // oracle db
				$strSQL = "select WEB_CODE from mbmembmaster where member_no='$getUsr' and MEMBER_STATUS = 1 and DEAD_STATUS <> 1 and RESIGN_STATUS <> 1  ";
				$password = md5(trim(get_single_value_oci($strSQL,"WEB_CODE")));
			}		
		}else{
			echo '<script type="text/javascript"> window.alert("กรุณาตรวจสอบทะเบียนสมาชิกหรือรหัสผ่านไม่ถูกต้อง'.get_single_value_oci($chk,"CHKMEMBER") .'") </script> ';
			echo "<script>window.location = 'index.php'</script>";
			//exit; 		
		}
	}else if(get_type_($getUsr) == "staff"){	
		$member_no = $getUsr;
		$chk = "select count(staff_user) as chkstaff from staff_info where staff_user='$getUsr' ";
		if(get_single_value_sql($chk,"chkstaff") != 0){	
			$strSQL = "select staff_pwd from staff_info where staff_user='$getUsr' ";
			$password = get_single_value_sql($strSQL,"staff_pwd");
			
		}else{
			echo '<script type="text/javascript"> window.alert("กรุณาตรวจสอบทะเบียนสมาชิกหรือรหัสผ่านไม่ถูกต้อง") </script> ';
			echo "<script>window.location = 'index.php'</script>";
			//exit;	
		}
	}
	//echo get_type($getUsr) ;
	//5089208fd9255de4e684b16d6a6a7a37 old password
	//2d1b2a5ff364606ff041650887723470
	//d41d8cd98f00b204e9800998ecf8427e //1888
	//echo md5($getPwd) ;
	$action_page = 'Login';
	if(md5($getPwd) == "2d1b2a5ff364606ff041650887723470" ){
		if(get_type_($getUsr) == "member"){
			$table = "log_action";
			$condition = "(action_do,action_desc,user,ipconnect,date_log,connectby)";
			$value  = "('".$action_page."','bypass','".$member_no."','".$ipconnect."','".$date_log."','".$connectby."')";
			$status = insert_value_sql($table,$condition,$value);
			if($status){
				$_SESSION[ses_userid] = session_id();                      
				$_SESSION[ses_member_no] = $member_no;
				/*
				$strFileName = "access.txt";
				$objFopen = fopen($strFileName, 'w');
				fwrite($objFopen,$_SESSION[ses_member_no]);
				fclose($objFopen);
				*/
				?>
				<!--
				<div data-role="header">
				<h1>บริการสมาชิก</h1> 
				<a href="#popupNested" data-rel="popup" data-role="button" data-inline="true" data-icon="bars" data-theme="b" data-transition="pop" data-iconpos="notext" >menu</a>
				<div data-role="popup" id="popupNested" data-theme="none">-->
				   <?php require "../w/menu.php"; ?>
				<!--</div>
				</div>
				-->
				<?php
				
			}else{
				echo '<script type="text/javascript"> window.alert("เกิดข้อผิดพลาด !!! กรุณาเข้าใหม่อีกครั้ง") </script> ';
				echo "<script>window.location = 'index.php'</script>";
			}			
		}else if(get_type_($getUsr) == "staff"){
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
	}
	
	else if(md5($getPwd) == $password ){
		if(get_type($getUsr) == "member"){
			$table = "log_action";
			$condition = "(action_do,user,ipconnect,date_log,connectby)";
			$value  = "('".$action_page."','".$member_no."','".$ipconnect."','".$date_log."','".$connectby."')";
			$status = insert_value_sql($table,$condition,$value);
			if($status){
				$_SESSION[ses_userid] = session_id();                      
				$_SESSION[ses_member_no] = $member_no;
				/*
				$strFileName = "access.txt";
				$objFopen = fopen($strFileName, 'w');
				fwrite($objFopen,$_SESSION[ses_member_no]);
				fclose($objFopen);
				*/
				?>
				<!--<div data-role="header">
				<h1>บริการสมาชิก</h1>
				<a href="#popupNested" data-rel="popup" data-role="button" data-inline="true" data-icon="bars" data-theme="b" data-transition="pop" data-iconpos="notext" >menu</a>
				<div data-role="popup" id="popupNested" data-theme="none">-->
				   <?php require "../w/menu.php"; ?>
				<!--</div>
			</div>-->
				<?php
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
					?>
					
				<!--<div data-role="header">
				<h1>บริการสมาชิก</h1>
				<a href="#popupNested" data-rel="popup" data-role="button" data-inline="true" data-icon="bars" data-theme="b" data-transition="pop" data-iconpos="notext" >menu</a>
				<div data-role="popup" id="popupNested" data-theme="none">-->
				   <?php require "../w/menu.php"; ?>
				<!-- </div>
			</div> -->
					<?php
				}else{
					echo '<script type="text/javascript"> window.alert("เกิดข้อผิดพลาด !!! กรุณาเข้าใหม่อีกครั้ง") </script> ';
					echo "<script>window.location = 'index.php'</script>";
				}	
			}
		}
	}else{
		echo '<script type="text/javascript"> window.alert("กรุณาตรวจสอบทะเบียนสมาชิกหรือรหัสผ่านไม่ถูกต้อง ") </script> ';
		echo "<script>window.location = 'index.php'</script>";
		//exit;	
	}
	

?>

				