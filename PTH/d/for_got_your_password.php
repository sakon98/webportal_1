<?php
session_start();
header('Content-Type: text/html; charset=tis-620');
	require "../include/conf.conn.php";
	require "../include/conf.c.php";
	require "../include/lib.Etc.php";
	require "../include/lib.Oracle.php";
	require "../include/lib.MySql.php";
	$connectby = "desktop";
	
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
        
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$title?></title>
	<link rel="shortcut icon" href="../img/logo.png">
    <link rel="stylesheet" href="../css/validationEngine.jquery.css" type="text/css">
	<link rel="stylesheet" href="../css/template.css" type="text/css">
    <script src="../js/jquery-1.6.min.js" type="text/javascript"></script>
	<script src="../js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="tis-620"></script>
	<script src="../js/jquery.validationEngine.js" type="text/javascript" charset="tis-620"></script>
	<script type="text/javascript">
			jQuery(document).ready(function(){
						jQuery("#formID1").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});
						jQuery("#formID2").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});
			});
	</script>
	
		<script type="text/javascript">
	function chkConfirm()
{

if(confirm('ไม่พบ email ต้องการติดต่อ กรุณาติดต่อสหกรณ์ Tel.02-979-1163 ใช่หรือไม่')==true)
{


//location.href = "tel:029791163";

location.reload();	


//window.location = 'index.php';


//cation.replace("tel://029791163");
//window.location.href = 'tel:029791163';
//document.location.assign('tel://029791163');
}

}
	</script>

	<script>          
	function functionAlert(msg, myYes) {             
	var confirmBox = $("#confirm");             
	confirmBox.find(".message").text(msg);             
	confirmBox.find(".yes").unbind().click(
	function() {  

//alert('1');
	//window.history.go(-1);
	
	window.location = 'for_got_your_password.php';
	
//location.reload();		
	//confirmBox.hide();  



	});             
	confirmBox.find(".yes").click(myYes);             
	confirmBox.show();          }       
	</script>       
	<style>          
	#confirm {             display: none;             
	background-color: #F3F5F6;             color: #000000;             
	border: 1px solid #aaa;             position: absolute;             width: 300px;             height: 100px;             left: 40%;             top: 40%;            
	box-sizing: border-box;             text-align: center;          }          
	#confirm button {             background-color: #FFFFFF;             
	display: inline-block;             border-radius: 12px;            
	border: 4px solid #aaa;             padding: 5px;             text-align: center;          
	width: 60px;             cursor: pointer;          }          #confirm .message {            
	text-align: left;          }       </style>
	
	
	<!-- ** -->
        
        
        <script>          
	function functionAlert1(msg, myYes) {             
	var confirmBox = $("#confirm1");             
	confirmBox.find(".message").text(msg);             
	confirmBox.find(".yes").unbind().click(
	function() {    
       // location.reload();		
	//confirmBox.hide(); 
        //document.getElementById('phone_input').focus();
          window.location = 'for_got_your_password.php';
    });             
	confirmBox.find(".yes").click(myYes);             
	confirmBox.show();          }       
	</script>       
	<style>          
	#confirm1 {             display: none;             
	background-color: #F3F5F6;             color: #000000;             
	border: 1px solid #aaa;             position: absolute;             width: 300px;             height: 100px;             left: 40%;             top: 40%;            
	box-sizing: border-box;             text-align: center;          }          
	#confirm1 button {             background-color: #FFFFFF;             
	display: inline-block;             border-radius: 12px;            
	border: 4px solid #aaa;             padding: 5px;             text-align: center;          
	width: 60px;             cursor: pointer;          }          #confirm1 .message {            
	text-align: left;          }       </style>
        

</head>
	

</head>



<body>
<div id="confirm">          <div class="message">ไม่พบ email ต้องการติดต่อ กรุณาติดต่อสหกรณ์ <a href="tel:02-000-6704">Tel.02-000-6704</a>&nbsp;โปรดติดต่อในเวลาราชการ</div><br>          <button class="yes">ตกลง</button>       </div>
<div id="confirm1"> <div class="message">ข้อมูลที่ใช้ในการขอ password ไม่ถูกต้อง กรุณาติดต่อสหกรณ์ <a href="tel:02-000-6704">Tel.02-000-6704</a>&nbsp;โปรดติดต่อในเวลาราชการ</div><br><button class="yes">ตกลง</button></div>



<?php require "../include/conf.d.php" ?>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="middle" bgcolor="#333333">
    <table width="995" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF">
      <tr>
        <td height="120"  background="../img/head_info_bg.png"><table width="994" border="0" cellspacing="3" cellpadding="0">
          <tr>
            <td width="109" height="100" align="right"><img src="../img/logo.png" width="101" height="101"></td>
            <td width="876"><table width="100%" border="0" cellspacing="5" cellpadding="0">
              <tr>
                <td><font face='Tahoma' size="5" color="#FFFFFF"><strong>
                  <?=$title?>
                </strong></font><br/>
				<font face='Tahoma' size="3" color="#FFFFFF">
					<?=$title2?>
					</font><br/>
                <font face='Tahoma' size="2" color="#FFFFFF">
                <?=$sub_title2?>
                </font></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td height="390">
<?php if($_POST["agree"] != "agree" ){  ?>
        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="6">
          <tr>
            <td align="center"><table width="75%" border="1" align="center" bordercolor = "red" cellpadding="20" cellspacing="0">
					<tr><td><B>
              **เงื่อนไขในการยืนยันตัวตนการลืมรหัสผ่าน**<br><br>

					1. กรอกเลขทะเบียนสมาชิก<br>
					2. กรอกรหัสบัตรประชาชนของสมาชิก<br>
					3. กรอกเบอร์โทรศัพท์ของสมาชิก<br>
					4. เมื่อกรอกครบทุกช่องเเล้ว ทำเครื่องหมายถูก"ข้าพเจ้ายอมรับเงื่อนไขในการขอ Password" แล้วเลือกตกลง &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;<font color="red" size=2>ระบบจะ Reset Password เเล้วส่ง Password ไปยัง E-Mail ของท่าน กรณีไม่มี E-Mail กรุณาติดต่อสหกรณ์ &nbsp;&nbsp;Tel. <a href="tel:029791163">02-979-1163</a></font><br>
					<!--5. จากนั้นระบบจะเเสดงหน้าจอเปลี่ยนรหัสผ่านอัตโนมัติเพื่อให้สมาชิกทำการกำหนดรหัสผ่านใหม่ด้วยตัวเอง<br>-->
					5. กรุณาเก็บรหัสผ่านของท่านไว้เป็นความลับ</td></tr></table>
			</td>
          </tr>
          <tr>
            <td align="center">
            <form name="formID1" id="formID1" method="post" action="" ><br><br><br>
              <table width="70%" border="0" align="center" cellpadding="2" cellspacing="2">
                <tr>
                  <td width="39%" align="right"><font face="Tahoma" size="2"><strong><strong>เลขทะเบียนสมาชิก :</strong></strong></font></td>
                  <td width="61%"><input name="member_no" type="text" class="validate[required,custom[integer_member_no]]" id="member_no" size="20" maxlength="8" autocomplete="off" style="width: 161px;" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/></td>
                </tr>
                <tr>
                  <td align="right"><font face="Tahoma" size="2"><strong><strong>เลขที่บัตรประชาชน :</strong></strong></font></td>
                  <td><input name="idchk" type="text" id="idchk" size="20" maxlength="13" autocomplete="off" style="width: 161px;" oninput="this.value=this.value.replace(/[^0-9]/g,'');" required /></td>
                </tr>
                <tr>
                  <td align="right"><font face="Tahoma" size="2"><strong><strong>เบอร์โทรศัพท์ :</strong></strong></font></td>
                  <td><input name="phone_input" type="text" class="validate[required,custom[integer_phone]]" id="phone_input" size="20" maxlength="10" autocomplete="off" style="width: 161px;" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/></td>
                </tr>
				  </tr>
				  <tr>
                  <td align="right">
                    <label for="agree"></label></td>
                  <td><font face="Tahoma" size="2"><font></td>
                </tr>
				  <tr>
                  <td align="right">
                    <label for="agree"></label></td>
                  <td><font face="Tahoma" size="2"><font></td>
                </tr>
				  <tr>
                  <td align="right">
                    <label for="agree"></label></td>
                  <td><font face="Tahoma" size="2"><font></td>
                </tr>
				  <tr>
                  <td align="right">
                    <label for="agree"></label></td>
                  <td><font face="Tahoma" size="2"><font></td>
                </tr>
				  <tr>
                  <td align="right">
                    <label for="agree"></label></td>
                  <td><font face="Tahoma" size="2"><font></td>
                </tr>
                <tr>
                  <td align="right"><input name="agree" type="checkbox" class="validate[required]" id="agree" value="agree">
                    <label for="agree"></label></td>
                  <td><font face="Tahoma" size="2">ข้าพเจ้ายอมรับเงื่อนไขในการขอ Password</font></td>
                </tr>
                <tr>
                  <td align="right">&nbsp;</td>
                  <td><input type="submit" name="Submit" id="button" value="ตกลง" />
                    <input name="ยกเลิก" type="reset" id="ยกเลิก" onclick="location.href='index.php'" value="ยกเลิก" />
                    <input name="ref" type="hidden" id="ref" value="checkuser" /></td>
                </tr>
              </table>
            </form>
            </td>
          </tr>
        </table>
<?php
}else{
 	require "../s/s.member_info.php" ;
	$repassword = true;
	if($Num_Rows == 0){ // ไม่พบทะเบียน 
		$repassword = false;
		/*echo '<script type="text/javascript"> window.alert("ไม่สามารถดำเนินการได้ กรุณาติดต่อสหกรณ์ เพื่อตรวจสถานะการเป็นสมาชิก") </script> ';
		echo "<script>window.location = 'for_got_your_password.php'</script>";
		exit;*/
		

			 /*echo "
								   <script type='text/javascript'>
								   sessionStorage.setItem('member_no','".$member_no."')   
								   sessionStorage.setItem('idchk','".$idchk."') 
								   sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 	
								 
								   alert('ไม่สามารถดำเนินการได้ กรุณาติดต่อสหกรณ์ เพื่อตรวจสถานะการเป็นสมาชิก'); 
										window.history.go(-1)
																									
									</script>"; exit;*/
									
									echo "
								   <script type='text/javascript'>
								   sessionStorage.setItem('member_no','".$member_no."')   
								   sessionStorage.setItem('idchk','".$idchk."') 
								   sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 	
																
									</script>";  
                
                echo " <script type='text/javascript'> functionAlert1();</script>";  exit;
									
	}	
        

	if($card_person	 != $idchk){ // เลขบัตรไม่ถูกต้อง
		$repassword = false;
		//echo '<script type="text/javascript"> window.alert("ไม่สามารถดำเนินการได้ ทะเบียนสมาชิกหรือเลขบัตรประชาชนไม่ถูกต้อง กรุณาตรวจสอบหรือติดต่อสหกรณ์") </script> ';
		//echo "<script>window.location = 'register.php'</script>";
		//exit;
		
		/*echo $member_no; 
		echo $idchk;
		echo $_POST["phone_input"];*/
		
	
      $phone_input = $_POST["phone_input"];
	   $phone_input = str_replace("-","",$phone_input);
	   
	   $phone = str_replace("-","",$phone);
	   $mobile = str_replace("-","",$mobile);
	   
	   if($mobile == null || $mobile == ""){
	   
	   $mobile = $phone;
	   
	   }
           
           
           
 
		if($card_person == ""){
		
		
                                                                        
           if($card_person == "" && $mobile != $phone_input){ // ไม่พบเลขบัตรเเละเบอร์โทรศัพท์ไม่ถูกต้อง

               
                /*echo "
								   <script type='text/javascript'>
								        sessionStorage.setItem('member_no','".$member_no."')   
										sessionStorage.setItem('idchk','".$idchk."') 
										sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 
												
								   alert('ไม่พบเลขบัตรประชาชนของท่านในฐานข้อมูล เเละเบอร์โทรศัพท์ของท่านไม่ถูกต้อง กรุณาตรวจสอบหรือติดต่อสหกรณ์'); 
										window.history.go(-1)	;
                                                                              
									</script>";  exit;*/
									
									echo "
								   <script type='text/javascript'>
								   sessionStorage.setItem('member_no','".$member_no."')   
								   sessionStorage.setItem('idchk','".$idchk."') 
								   sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 	
																
									</script>";  
                
                echo " <script type='text/javascript'> functionAlert1();</script>";  exit;
									
               
           }else if($card_person == "" && $mobile == ""){ // ไม่พบเลขบัตรเเละไม่พบเบอร์โทรศัพท์
               
             /*  echo "
								   <script type='text/javascript'>
								        sessionStorage.setItem('member_no','".$member_no."')   
										sessionStorage.setItem('idchk','".$idchk."') 
										sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 
												
								   alert('ไม่พบเลขบัตรประชาชนของท่านในฐานข้อมูล เเละไม่พบเบอร์โทรศัพท์ของท่านในฐานข้อมูล กรุณาตรวจสอบหรือติดต่อสหกรณ์'); 
										window.history.go(-1)	;
                                                                              
									</script>";  exit;*/
									
									echo "
								   <script type='text/javascript'>
								   sessionStorage.setItem('member_no','".$member_no."')   
								   sessionStorage.setItem('idchk','".$idchk."') 
								   sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 	
																
									</script>";  
                
                echo " <script type='text/javascript'> functionAlert1();</script>";  exit;
               
           }else{
               
               /*echo "
								   <script type='text/javascript'>
								        sessionStorage.setItem('member_no','".$member_no."')   
										sessionStorage.setItem('idchk','".$idchk."') 
										sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 
												
								   alert('ไม่พบเลขบัตรประชาชนของท่านในฐานข้อมูล กรุณาตรวจสอบหรือติดต่อสหกรณ์'); 
										window.history.go(-1)	;
                                                                                
									</script>";  exit;*/
									
									echo "
								   <script type='text/javascript'>
								   sessionStorage.setItem('member_no','".$member_no."')   
								   sessionStorage.setItem('idchk','".$idchk."') 
								   sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 	
																
									</script>";  
                
                echo " <script type='text/javascript'> functionAlert1();</script>";  exit;
               
           }
                                                                        
                                                                        
                                                                        
                                                                        
		
		}else{
		
                    if ($card_person != $idchk && $mobile != $phone_input){ // บัตรผิดเเละเบอร์โทรผิด
               
               /* echo "
								   <script type='text/javascript'>
								        sessionStorage.setItem('member_no','".$member_no."')   
										sessionStorage.setItem('idchk','".$idchk."') 
										sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 
												
								   alert('ไม่สามารถดำเนินการได้ เลขบัตรประชาชนไม่ถูกต้อง เเละเบอร์โทรศัพท์ไม่ถูกต้อง กรุณาตรวจสอบหรือติดต่อสหกรณ์'); 
										window.history.go(-1)	;
                                                                                document.getElementById('idchk').focus();
									</script>";  exit;*/
									
									echo "
								   <script type='text/javascript'>
								   sessionStorage.setItem('member_no','".$member_no."')   
								   sessionStorage.setItem('idchk','".$idchk."') 
								   sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 	
																
									</script>";  
                
                echo " <script type='text/javascript'> functionAlert1();</script>";  exit;
									
               
               
           }else if ($card_person != $idchk && $mobile == ""){ // บัตรผิดเเละไม่พบเบอร์โทรศัพท์
               
                /*echo "
								   <script type='text/javascript'>
								        sessionStorage.setItem('member_no','".$member_no."')   
										sessionStorage.setItem('idchk','".$idchk."') 
										sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 
												
								   alert('ไม่สามารถดำเนินการได้ เลขบัตรประชาชนไม่ถูกต้อง เเละเบอร์โทรศัพท์ไม่พบในฐานข้อมูล กรุณาตรวจสอบหรือติดต่อสหกรณ์'); 
										window.history.go(-1)	;
                                                                                document.getElementById('idchk').focus();
									</script>";  exit;*/
									
									echo "
								   <script type='text/javascript'>
								   sessionStorage.setItem('member_no','".$member_no."')   
								   sessionStorage.setItem('idchk','".$idchk."') 
								   sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 	
																
									</script>";  
                
                echo " <script type='text/javascript'> functionAlert1();</script>";  exit;
               
               
           }else{
		
		/* echo "
								   <script type='text/javascript'>
								        sessionStorage.setItem('member_no','".$member_no."')   
										sessionStorage.setItem('idchk','".$idchk."') 
										sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 
												
								   alert('ไม่สามารถดำเนินการได้ เลขบัตรประชาชนไม่ถูกต้อง กรุณาตรวจสอบหรือติดต่อสหกรณ์'); 
										window.history.go(-1)	;
                                                                                document.getElementById('idchk').focus();
									</script>";  exit;*/
									
									echo "
								   <script type='text/javascript'>
								   sessionStorage.setItem('member_no','".$member_no."')   
								   sessionStorage.setItem('idchk','".$idchk."') 
								   sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 	
																
									</script>";  
                
                echo " <script type='text/javascript'> functionAlert1();</script>";  exit;
									
									}
                }
		
	}
        
     
        
       //start process check mobile
	
	$phone_input = $_POST["phone_input"];
	   $phone_input = str_replace("-","",$phone_input);
	   
	   $phone = str_replace("-","",$phone);
	   $mobile = str_replace("-","",$mobile);
	   
	   if($mobile == null || $mobile == ""){
	   
	   $mobile = $phone;
	   
	   }
        
        if($mobile != $phone_input){ // เบอร์โทรศัพท์ไม่ถูก
		$register_status = false;
		/*echo '<script type="text/javascript"> window.alert("ไม่สามารถดำเนินการได้ เบอร์โทรศัพท์ของท่านไม่ถูกต้อง กรุณาติดต่อสหกรณ์") </script> ';
		echo "<script>window.location = 'for_got_your_password.php'</script>";
		exit;*/
		
	
	if($mobile == ""){
	
	 /*echo "
								   <script type='text/javascript'>
								   sessionStorage.setItem('member_no','".$member_no."')   
								   sessionStorage.setItem('idchk','".$idchk."') 
								   sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 	
								   
								    alert('ไม่พบเบอร์โทรศัพท์ของท่านในฐานข้อมูล กรุณาติดต่อสหกรณ์'); 
										window.history.go(-1)
																									
									</script>"; exit;*/
									
									echo "
								   <script type='text/javascript'>
								   sessionStorage.setItem('member_no','".$member_no."')   
								   sessionStorage.setItem('idchk','".$idchk."') 
								   sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 	
																
									</script>";  
                
                echo " <script type='text/javascript'> functionAlert1();</script>";  exit;
	
	}else{
	
			/* echo "
								   <script type='text/javascript'>
								   sessionStorage.setItem('member_no','".$member_no."')   
								   sessionStorage.setItem('idchk','".$idchk."') 
								   sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 	
								   
								   alert('ไม่สามารถดำเนินการได้ เบอร์โทรศัพท์ของท่านไม่ถูกต้อง กรุณาติดต่อสหกรณ์'); 
										window.history.go(-1)
																									
									</script>"; exit;*/
									
									echo "
								   <script type='text/javascript'>
								   sessionStorage.setItem('member_no','".$member_no."')   
								   sessionStorage.setItem('idchk','".$idchk."') 
								   sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 	
																
									</script>";  
                
                echo " <script type='text/javascript'> functionAlert1();</script>";  exit;
									
									}
		
	}
	
	// end process check mobile

        $strMySQL = "SELECT member_no AS check_member  FROM webmbmembmaster where member_no = '$member_no'";
        $valueSQL = "check_member";
        $check_member = get_single_value_sql($strMySQL,$valueSQL);
		
		
        
        if($check_member == ""){
            $repassword = false;
                echo '<script type="text/javascript"> window.alert("ไม่สามารถดำเนินการได้ ท่านยังไม่ได้สมัครใช้บริการ กรุณาสมัครใช้บริการก่อน") </script> ';
		echo "<script>window.location = 'register.php'</script>";
		exit;
        }
        
        
		$strSQL = " SELECT EMAIL,MEMB_FULLNAME FROM webmbmembmaster where member_no = $member_no ";
		$value = array('EMAIL','MEMB_FULLNAME');
		list($Num_Rows,$list_info) = get_value_many_sql($strSQL,$value);
		$mail_user = $list_info[0][0]; 
		$memb_fullname = $list_info[0][1]; 
		
		if($mail_user != ""){
		
	if($repassword){ // เริ่มเปลี่ยนรหัสผ่าน
		?>
        <?php 
        //$npwd = md5("12345678");
		$rand_dom = mt_rand(0, 99999999);
		$npwd = md5($rand_dom);
	$table="webmbmembmaster";
	$value="password = '".$npwd."',chang_flag = 1 , pwd ='".$rand_dom."' ";
	$condition="where member_no = '$member_no'";
	$status = update_value_sql($table,$condition,$value);
        $_SESSION[ses_userid] = session_id();                      
	$_SESSION[ses_member_no] = $member_no;
		if($status){
		
		// ส่งเมล
		
		$mail = new PHPMailer(true);     
     try { 
				  //ตั้งค่า Server
				  $mail->SMTPDebug = 0;                                
				  $mail->isSMTP();                                     
				  $mail->Host = 'mail.isocare.co.th'; 
				  $mail->SMTPAuth = true;                              
				  $mail->Username = 'no-reply@isocare.co.th';                 
				  $mail->Password = '@Iso1888';                     
				  $mail->SMTPSecure = 'tls';                           
				  $mail->Port = 587;                                

				  //ผู้รับ
				  $mail->CharSet = 'UTF-8';
				  $mail->setFrom('no-reply@isocare.co.th', 'Reset Password Imember');
				  //$mail->addAddress('sakon__aum@hotmail.com');	// ทดสอบเข้า mail isocare พี่เล็ก		  
				  $mail->addAddress($mail_user);	// ใช้จริงยิงเข้า mail user ตามที่กรอกยืนยันตัวตน / get mail จากฐานข้อมูลที่กรอกตอนสมัคร webportal

				  //เนื้อหา
				  $mail->isHTML(true);                                  // ตั้งค่า Mail เป็นแบบ HTML
				  //$sendsubject="=?utf-8?b?".base64_encode('Reset Password Imember')."?=";
				  $sendsubject=('Reset Password Imember');
				  $mail->Subject = $sendsubject;
				  //$mail->Subject = 'ระบบเเจ้งเตือนคำขอสมัครสมาชิก iMember';
				  $html1 = '
					<html>
					  <head>
						  <style>
							  table {
								width:100%;
								height:70%;
								margin:auto;
								box-shadow: 3px 2px 12px 0px rgba(0,0,0,0.75);
								border-radius: 5px 5px 5px 5px;
								border: 0px solid #000000;
							  }
						  </style>
					  </head>
						<body>
						   <table>
							   <thead>
								   <tr style="height:30%;">
										<th >
									   </th>
									   <th style="text-align:center;color:black">
										   <h2> ระบบเเจ้ง Reset Password ระบบ Imember </h2>
									   </th>
								   </tr>
							  </thead>
							  <tbody>
								  <tr style="text-align:left;color:black;height:60%;">
									 <td style="width:10%">
									 </td>
									 <td style="width:80%;" valign="top">เรียน สมาชิกสหกรณ์
										 <p style="color:black;">&nbsp;&nbsp;&nbsp;'.$memb_fullname.'&nbsp;&nbsp;&nbsp;เลขที่สมาชิก&nbsp;'.$member_no.' &nbsp;&nbsp;&nbsp;รหัสผ่านของท่านคือ :  '.$rand_dom.'
										
									 </td> 
									 <td style="width:10%">
									 </td>
								   </tr>
									<tr style="height:10%;">
								   </tr>
							  </tbody>
						  </table>
						</body>
				  </html>
				  ';
				   
				  $mail->Body    = iconv( 'TIS-620', 'UTF-8', $html1);

				 if(!$mail->send()){
				 'not send';
				 }else{
				  'send';
					
				 }
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}
		
		//
		
			echo '<script type="text/javascript"> window.alert("ระบบได้ทำการ reset password เเล้วทำการส่ง mail ไปยังท่านเรียบร้อยเเล้ว") </script> ';
			//echo "<script>window.location = 'Change_Pwd.php'</script>";
            echo "<script>window.location = 'index.php'</script>";
		}else{
			echo '<script type="text/javascript"> window.alert("เกิดข้อผิดพลาด !!! กรุณาลองใหม่อีกครั้ง") </script> ';
			echo "<script>window.location = 'for_got_your_password.php'</script>";
		}
        
	}
	}else{
	                             
	
	 echo "
								   <script type='text/javascript'>
								   sessionStorage.setItem('member_no','".$member_no."')   
								   sessionStorage.setItem('idchk','".$idchk."') 
								   sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 															
									</script>";
	
	    echo '<script type="text/javascript"> 		   
		functionAlert(); 
		</script> ';
		// echo '<script type="text/javascript"> if(cofirm("ต้องติดต่อ กรุณาติดต่อสหกรณ์ Tel.02-979-1163 ใช่หรือไม่")){  window.location.href="tel:029791163"; } </script> ';
		//echo "<script>window.location = 'for_got_your_password.php'</script>";

		exit;
	
	}
}
?> 
<?php 
	if($_POST["reg"] == "done"){  
		 	require "../s/s.register_1.php" ;
	}
?>     
        </td>
        </tr>
      <tr>
        <td height="120" align="center" background="../img/footer_info_bg.png"><span class="class1"><font size="2" color="#FFFFFF"><strong><?=$title?></strong></font><br/><font size="2" color="#FFFFFF"><?=$address?><br/><?=$credite?></font></span></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

<script>
document.addEventListener('keydown', function(event) { 
if(event.keyCode == 9){
event.preventDefault()
if($('#idchk').val() == ''){
$('#idchk').focus() 
}else{
if(!checkID($('#idchk').val())){
		alert('หมายเลขบัตรประชาชนนี้ไม่ถูกต้อง');
		$('#phone_input').attr('readonly',true)
		$('#idchk').focus() 
	
	}else{
		$('#formID1').submit()
	}
}
}else if(event.keyCode == 13){
if($('#idchk').val() == ''){
$('#idchk').focus() 
}else{
	if(!checkID($('#idchk').val())){
		alert('หมายเลขบัตรประชาชนนี้ไม่ถูกต้อง');
		$('#phone_input').attr('readonly',true)
		$('#idchk').focus() 
	}else{
		$('#formID1').submit()
	}
}
}


});
$('#formID1').submit(function() {
	if($('#member_no').val() == ''){
		$('#member_no').focus()
	}else if($('#idchk').val() == '') {
		$('#idchk').focus() 
		
	}else if($('#phone_input').val() == ''){
		$('#phone_input').focus()
	}
})
$(document).ready(function(){

 //alert(sessionStorage.getItem('ch'));
 
 //var check = sessionStorage.getItem('ch');

 $('#member_no').focus();
 
    $('#member_no').val(sessionStorage.getItem('member_no'));
	$('#idchk').val(sessionStorage.getItem('idchk'));
	$('#phone_input').val(sessionStorage.getItem('phone_input'));
		
		

})

$('#idchk').focus(function(e){
	event.preventDefault()
})

$('#idchk').change(function(){

if($(this).val() == '' ){

 alert('กรุณากรอกเลขบัตรประชาชน');
 
}else{

    

}
});

function checkID(id) {
    if(id.length != 13 && id.length !=0) {

	//$('#phone_input').attr('readonly',true)
	//$('#idchk').focus()
	return false;
      
	}
    else if (id.length ==0){
         alert('กรุณากรอกเลขบัตรประชาชน');
            return false;
        }else{
		$('#phone_input').removeAttr('readonly')
	
		
		}

    for(i=0, sum=0; i < 12; i++)
        sum += parseFloat(id.charAt(i))*(13-i);
    if((11-sum%11)%10!=parseFloat(id.charAt(12)))
        return false;
    return true;
}
/*function checkForm() {
    if(!checkID(document.formID1.idchk.value))
        alert('รหัสประชาชนไม่ถูกต้อง');
    else
        alert('รหัสประชาชนถูกต้อง เชิญผ่านได้');
}	*/

/*$('#phone_input').change(function(){

		var member_no = $('#member_no').val();
                var phone_input = $('#phone_input').val();
                phone_input = phone_input.replace("-","");
                phone_input = phone_input.trim();
                

		$.post('../s/s.phone_input.php',{
			member_no : member_no
		},function(data){

			var obj = JSON.parse(data);

                        var check = obj.addr_mobilephone; 
                        check = obj.addr_mobilephone.replace("-","");
                        check = check.trim();
                        
                        if(check == ""){ // ไม่พบใน db
                            
                            //alert('ไม่พบใน db');
                            document.getElementById('button').disabled = true;
                            functionAlert1();
                            
                        }else if (check != phone_input){ // ไม่ตรงกัน
                            
                             functionAlert2();
                             document.getElementById('button').disabled = true;
                          
                             //alert('ไม่ตรงกัน');
                            
                        }else{
                            
                            document.getElementById('button').disabled = false;
                            
                        }

                        });
                    });*/
					
					 $('#phone_input').change(function(){
        
        
        var length = $('#phone_input').val().length
        
        if(length == 9 || length ==10){
            
           
                
           }else{
               
               alert('ท่านกรอกเบอร์โทรศัพท์ไม่ครบ 9 หรือ 10 หลัก');
            	$('#phone_input').focus(); 
               
           }
        
        });

</script>

<!--<script>          
	function functionAlert1(msg, myYes) {             
	var confirmBox = $("#confirm1");             
	confirmBox.find(".message").text(msg);             
	confirmBox.find(".yes").unbind().click(
	function() {    
//location.reload();		
	confirmBox.hide(); 
        document.getElementById('phone_input').focus();
    });             
	confirmBox.find(".yes").click(myYes);             
	confirmBox.show();          }       
	</script>       
	<style>          
	#confirm1 {             display: none;             
	background-color: #F3F5F6;             color: #000000;             
	border: 1px solid #aaa;             position: absolute;             width: 300px;             height: 100px;             left: 40%;             top: 40%;            
	box-sizing: border-box;             text-align: center;          }          
	#confirm1 button {             background-color: #FFFFFF;             
	display: inline-block;             border-radius: 12px;            
	border: 4px solid #aaa;             padding: 5px;             text-align: center;          
	width: 60px;             cursor: pointer;          }          #confirm1 .message {            
	text-align: left;          }       </style>
        
        
       
        
        <script>          
	function functionAlert2(msg, myYes) {             
	var confirmBox = $("#confirm2");             
	confirmBox.find(".message").text(msg);             
	confirmBox.find(".yes").unbind().click(
	function() {    
//location.reload();		
	confirmBox.hide();
           document.getElementById('phone_input').focus();
    });             
	confirmBox.find(".yes").click(myYes);             
	confirmBox.show();          }       
	</script>       
	<style>          
	#confirm2 {             display: none;             
	background-color: #F3F5F6;             color: #000000;             
	border: 1px solid #aaa;             position: absolute;             width: 300px;             height: 100px;             left: 40%;             top: 40%;            
	box-sizing: border-box;             text-align: center;          }          
	#confirm2 button {             background-color: #FFFFFF;             
	display: inline-block;             border-radius: 12px;            
	border: 4px solid #aaa;             padding: 5px;             text-align: center;          
	width: 60px;             cursor: pointer;          }          #confirm2 .message {            
	text-align: left;          }       </style>-->

