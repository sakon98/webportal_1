<?php
session_start();
?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"><strong><font size="4" face="Tahoma">ล๊อคเข้าสู่ระบบ</font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Freez Login</font></td>
  </tr>
  <tr>
    <td align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<form id="formID1" name="formID1" method="post" action="">
  <table width="95%" border="0" align="center" cellpadding="3" cellspacing="6">
    <tr>
      <td align="center"><strong><font size="2" face="Tahoma">กรอกเลขทะเบียนที่จะทำการ Freez Login 
        <label for="search"></label>
        <input name="search" type="text" id="search" size="35" />
         <input type="submit" name="button" id="button" value="ล๊อคเข้าสู่ระบบ" class="button4" />
         <input type="submit" name="button1" id="button1" value="ปลดล๊อคเข้าสู่ระบบ" class="button4" />
      </font></strong></td>
    </tr>
  </table>
</form>
<?php 
if($_POST["button"] == "ล๊อคเข้าสู่ระบบ"){
	if(get_type($_POST["search"]) == "member"){
		$member_no = GetFormatMember ($_POST["search"]);
	}else{
		echo '<script type="text/javascript"> window.alert("เลขทะเบียนสมาชิกไม่ถูกต้องกรุณาตรวจสอบ") </script> ';
		echo '<script>window.location = "../d/administrator.php?menu=Management_Member"</script>';
		exit();	
	}
        
        /// update freez_flag lock การ login

				$table ="mbmembmaster";
				$condition = "WHERE member_no = '$member_no' ";
				$value = "freez_flag = '1'";
				$update_status = update_value_sql($table,$condition,$value);
                                
                                if($update_status){
			echo '<script type="text/javascript"> window.alert("ระบบได้ทำการล๊อคการเข้าสู่ระบบเรียบร้อยแล้ว") </script> ';
			echo "<script>window.location = '../d/administrator.php?menu=Freez_Login'</script>";
			exit();
		        }else{
			echo '<script type="text/javascript"> window.alert("เกิดข้อผิดพลาด !!! กรุณาทำรายการใหม่อีกครั้ง") </script> ';
			echo "<script>window.location = '../d/administrator.php?menu=Freez_Login'</script>";
			exit();
                        }
		

 }else if($_POST["button1"] == "ปลดล๊อคเข้าสู่ระบบ"){
     
     if(get_type($_POST["search"]) == "member"){
		$member_no = GetFormatMember ($_POST["search"]);
	}else{
		echo '<script type="text/javascript"> window.alert("เลขทะเบียนสมาชิกไม่ถูกต้องกรุณาตรวจสอบ") </script> ';
		echo '<script>window.location = "../d/administrator.php?menu=Management_Member"</script>';
		exit();	
	}
        
        /// update freez_flag lock การ login

				$table ="mbmembmaster";
				$condition = "WHERE member_no = '$member_no' ";
				$value = "freez_flag = '0'";
				$update_status = update_value_sql($table,$condition,$value);
                                
                                if($update_status){
			echo '<script type="text/javascript"> window.alert("ระบบได้ทำการปลดล๊อคการเข้าสู่ระบบเรียบร้อยแล้ว") </script> ';
			echo "<script>window.location = '../d/administrator.php?menu=Freez_Login'</script>";
			exit();
		        }else{
			echo '<script type="text/javascript"> window.alert("เกิดข้อผิดพลาด !!! กรุณาทำรายการใหม่อีกครั้ง") </script> ';
			echo "<script>window.location = '../d/administrator.php?menu=Freez_Login'</script>";
			exit();
                        }
     
     
 } ?>
 
 