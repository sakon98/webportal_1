<?php
session_start();
$member_no =$_SESSION['ses_repass']; 
require "../include/conf.conn.php" ;
require "../include/conf.c.php";
require "../include/lib.MySql.php";
require "../include/lib.Etc.php";
require "../include/lib.Oracle.php";

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
    <p>ระบบได้แก้ไขและได้ส่งรหัสผ่านใหม่(ชั่วคราว) ให้สมาชิกทางอีเมลล์แล้ว <!--<font size="4" color="#FF0000">&quot;Sahakorn.xxx&quot;</font>-->    </p>
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
	require "../s/s.member_info.php" ;
	$pass_random = str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT);
	$pass_random = "Sahakorn.01".$pass_random;
	$npwd = getEncryptData($pass_random);
	$pass_ = $pass_random;

	$table="mbmembmaster";
	$value="password = '".$npwd."',freez_flag = 0 , error_status = 0 , date_chang_pass = '".$date_log."', temporary_password = 1";
	$condition="where member_no = '$member_no'";
	$status = update_value_sql($table,$condition,$value);

		if($status){
                   //$os = php_uname('n');
			         $os = "";
                   $action_page = 'Reset Password';
                                 $table = "log_action";
                                $condition = "(action_do,action_id,user,date_log,ipconnect,system_os)";
                                $value  = "('".$action_page."','".$member_no."','".$member_no."','".$date_log."','".$_SERVER['REMOTE_ADDR']."','".$os."')";
                                $status = insert_value_sql($table,$condition,$value);
								
								$strSQL = "select count(seq_no) as count_seq_no from check_password where member_no = '$member_no' "; 		
                                $value = "count_seq_no"; 
                                $count_seq_no = get_single_value_sql($strSQL,$value);
                                
                                if($count_seq_no == 3){ // ถ้า = 3 ลบ min seq_no ออกเเล้ว insert อันล่าสุดเเทน 1 member_no จะเก้บ password เเค่ 3 ครั้งล่าสุด
                                
                                $strSQL = "select min(seq_no) as min_seq_no from check_password where member_no = '$member_no' "; 		
                                $value = "min_seq_no"; 
                                $min_seq_no = get_single_value_sql($strSQL,$value);
                                $strSQL_delete = "DELETE FROM check_password WHERE seq_no = $min_seq_no ";
		                $objQuery_delete = mysql_query($strSQL_delete) or die ("Error Query [".$strSQL_delete."]");
                                    
                                }
                                
                                $strSQL = "select max(seq_no) as max_seq_no from check_password where member_no = '$member_no' "; 		
                                $value = "max_seq_no"; 
                                $max_seq_no = get_single_value_sql($strSQL,$value);
                                $max_seq_no = $max_seq_no + 1;
                                
				$table = "check_password";
				$condition = "(member_no,seq_no,password)";
				$value  = "('".$member_no."',$max_seq_no,'".$npwd."')";
				$status = insert_value_sql($table,$condition,$value);
								
								/// ส่งรหัสที่ reset เข้า เมล
                    
			$sql="CREATE TABLE if exists `weblogpwdreset` ( `weblogid` BIGINT NOT NULL AUTO_INCREMENT , `update_date` DATE NOT NULL , `member_no` VARCHAR(10) NOT NULL , `new_pwd` VARCHAR(20) NOT NULL , `remote_ip` VARCHAR(50) NOT NULL ) ENGINE = InnoDB";	
		mysql_query($sql);
			
		$sql="insert into weblogpwdreset (update_date,member_no,new_pwd,remote_ip) values(now(),'".$member_no."','".$pass_."','".$_SERVER['REMOTE_ADDR']."')";	
		mysql_query($sql);
		
		
		
			                $SLIP_DATE=ConvertDate(date("d-m-Y"),"long");
							$MEMB_NAME=$name;
							 $MEMB_SURNAME=$surname;
							 $MEMBER_EMAIL=$MAIL_TEST_MODE?$MAIL_TEST_EMAIL:$email;

							
							
							
							$SALARY_ID=$salary_id;
							$MEMBGROUP_DESC=$membgroup_code;
							
							$Subject=conv($MAIL_FROM_NM." "." รหัสผ่านได้ถูก Reset ณ วันที่ ".$SLIP_DATE);	
							$body=file_get_contents('../include/forgetpassword_template.html', true);
							$body=str_replace("COOP_NAME",conv($MAIL_FROM_NM),$body);
							$body=str_replace("SENT_DATE",conv(ConvertDate(date("d-m-Y"),"long")),$body);
							$body=str_replace("SLIP_DATE",conv($SLIP_DATE),$body);
							$body=str_replace("MEMBER_NO",$member_no,$body);
							$body=str_replace("WEB_LINK",$WEB_LINK,$body);
							$body=str_replace("MEMB_NAME",conv($MEMB_NAME),$body);
							$body=str_replace("MEMB_SURNAME",conv($MEMB_SURNAME),$body);
							$body=str_replace("SALARY_ID",$SALARY_ID,$body);
							$body=str_replace("MEMBGROUP_DESC",conv($MEMBGROUP_DESC),$body);
							$body=str_replace("PASSWORD",$pass_,$body);
							//$body=conv($body);
							$mail_to=array($MEMBER_EMAIL);
							$mail_to_nm=array(conv($MEMB_NAME." ".$MEMB_SURNAME));	
							//$MAIL_FROM_NM=conv($MAIL_FROM_NM);

							$msg=sendMail(
								$MAIL_HOST,
								$MAIL_PORT,
								$MAIL_USR,
								$MAIL_PWD,
								$MAIL_FROM,
								conv($MAIL_FROM_NM),
								$mail_to,
								$mail_to_nm,
								$Subject,
							    $body,
								$MAIL_DEBUG,
								$MAIL_AUTH_FLAG,
								$MAIL_SECURE
								);
									
			//echo $msg;

			echo '<script type="text/javascript"> window.alert("ระบบได้แก้ไขและได้ส่งรหัสผ่านใหม่(ชั่วคราว) ให้สมาชิกทางอีเมลล์แล้ว")</script> '; //'.$pass_.'
			echo "<script>window.close()</script>";
			
		    //echo "<script>window.location = 'administrator.php?menu=Management_Member'</script>";

            //echo "<script>window.location = 'administrator.php?menu=Management_Member'</script>";
		}else{
			echo '<script type="text/javascript"> window.alert("เกิดข้อผิดพลาด !!! กรุณาลองใหม่อีกครั้ง") </script> ';
			echo "<script>window.close()</script>";
			//echo "<script>window.location = 'administrator.php?menu=Management_Member'</script>";
		}
}
?>

</body>
</html>