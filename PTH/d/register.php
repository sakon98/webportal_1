<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
	require "../include/conf.conn.php";
	require "../include/conf.c.php";
	require "../include/lib.Etc.php";
	require "../include/lib.Oracle.php";
	require "../include/lib.MySql.php";
	$connectby = "desktop";
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

<script>          
	function functionAlert(msg, myYes) {             
	var confirmBox = $("#confirm");             
	confirmBox.find(".message").text(msg);             
	confirmBox.find(".yes").unbind().click(
	function() {    
       // location.reload();		
	//confirmBox.hide(); 
        //document.getElementById('phone_input').focus();
          window.location = 'register.php';
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
          window.location = 'index.php';
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
<body>

<div id="confirm"> <div class="message">ข้อมูลที่ใช้ในการสมัครไม่ถูกต้อง กรุณาติดต่อสหกรณ์ <a href="tel:02-000-6704">Tel.02-000-6704</a>&nbsp;โปรดติดต่อในเวลาราชการ</div><br><button class="yes">ตกลง</button></div>
<div id="confirm1"> <div class="message">เลขทะเบียนสมาชิกนี้ได้ลงทะเบียนแล้ว หากท่านไม่ได้สมัคร โปรดติดต่อสหกรณ์ด่วน ที่เบอร์ <a href="tel:02-000-6704">&nbsp;02-000-6704</a>&nbsp;โปรดติดต่อในเวลาราชการ</div><br><button class="yes">ตกลง</button></div>  

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
                <font face='Tahoma' size="2" color="#FFFFFF">
                <?=$address?>
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
            <td align="center"><label for="textfield"></label>
              <textarea name="textfield" rows="9" readonly id="textfield" style="width:80%;resize:none;padding:16px;height: 219px;">เงื่อนไขและข้อตกลงในการสมัครสมาชิก
1.การเข้าใช้งานระบบข้อมูลสมาชิกจะต้องทำการสมัครเข้าใช้งานระบบและต้องเป็นสมาชิกของ <?=$title?> เท่านั้น 
2.เพื่อความเรียบร้อยในการสมัครใช้งาน ระบบฯ และเพื่อยืนยันผู้สมัคร กรุณาทำตามขั้นตอนที่ระบบแนะนำ 
3.หากปรากฏว่า ชื่อหรือหมายเลขสมาชิก ของท่านได้มีการสมัครใช้งานแล้ว โดยท่านไม่ทราบ หรือทำการสมัครด้วยตัวท่านเอง กรุณาแจ้งเจ้าหน้าที่เพื่อทำการตรวจสอบความถูกต้อง ต่อไปกรุณาเก็บรักษา username / password ของท่าน
4.เพื่อสิทธิและความปลอดภัยในข้อมูลของท่านเองหากปรากฏว่ามีบุคคลแอบอ้าง สมัครใช้งานระบบและเจ้าหน้าที่ตรวจสอบแล้วจะทำการลบรายชื่อนั้นๆ ออกจากระบบ โดยไม่ต้องแจ้งให้ทราบ 
5.ข้อมูลของสมาชิก ในระบบจะทำการปรับปรุงข้อมูล หากสมาชิกท่านใดพบข้อมูลไม่ตรงหรือมีข้อสงสัยกรุณาติดต่อเจ้าหน้าที่
6.ข้าพเจ้าได้อ่านข้อตกลงดังกล่าวแล้ว และยินยอมในเงื่อนไขต่างๆที่ทาง <?=$title?> กำหนดไว้</textarea>
			</td>
          </tr>
          <tr>
            <td align="center">
            <form name="formID1" id="formID1" method="post" action="" >
		<br><br><br>
              <table width="70%" border="0" align="center" cellpadding="2" cellspacing="2">
                <tr>
                  <td width="39%" align="right"><font face="Tahoma" size="2"><strong><strong>เลขทะเบียนสมาชิก :</strong></strong></font></td>
                  <td width="61%"><input name="member_no" type="text" class="validate[required,custom[integer_member_no]]" id="member_no" size="20" maxlength="8" autocomplete="off"  oninput="this.value=this.value.replace(/[^0-9]/g,'');" /></td>
                </tr>
                <tr>
                  <td align="right"><font face="Tahoma" size="2"><strong><strong>เลขที่บัตรประชาชน :</strong></strong></font></td>
                  <td><input name="idchk" type="text" id="idchk" size="20" maxlength="13"  autocomplete="off" oninput="this.value=this.value.replace(/[^0-9]/g,'');" /></td>
                </tr>
				<tr>
                  <td align="right"><font face="Tahoma" size="2"><strong><strong>เบอร์โทรศัพท์ :</strong></strong></font></td>
                  <td><input name="phone_input" type="text" class="validate[required,custom[integer_phone]]" id="phone_input" size="20" maxlength="10" autocomplete="off" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/></td>
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
                  <td><font face="Tahoma" size="2">ข้าพเจ้ายอมรับเงื่อนไขทั้งหมด</font></td>
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
 	require "../s/s.member_info_1.php" ;
	//echo $card_person;
	//echo $Num_Rows;
	$register_status = true;
	if($Num_Rows == 0){ // ไม่พบทะเบียน  ii
		$register_status = false;
		/*echo '<script type="text/javascript"> window.alert("ไม่สามารถดำเนินการได้ กรุณาติดต่อสหกรณ์ เพื่อตรวจสถานะการเป็นสมาชิก") </script> ';
		echo "<script>window.location = 'index.php'</script>";
		exit;*/
	
			/* echo "
								   <script type='text/javascript'>
								   sessionStorage.setItem('member_no','".$member_no."')   
								   sessionStorage.setItem('idchk','".$idchk."') 
								   sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 	
								
								   alert('ไม่สามารถดำเนินการได้ กรุณาติดต่อสหกรณ์ เพื่อตรวจสถานะการเป็นสมาชิก'); 
										window.history.go(-1)
																									
									</script>";  exit;*/
									
									echo "
								   <script type='text/javascript'>
								   sessionStorage.setItem('member_no','".$member_no."')   
								   sessionStorage.setItem('idchk','".$idchk."') 
								   sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 	
																
									</script>";  
                
                echo " <script type='text/javascript'> functionAlert();</script>";  exit;
		
	}	

	//echo $countphone; 
	
	if($countmemb	> 0 or $countidcard > 0 or $countphone > 0){ // เคยสมัครแล้ว
	
	$register_status = false;
	
	if($countphone > 0){
	
	//ii
	
	/*echo '<script type="text/javascript"> window.alert("ไม่สามารถดำเนินการได้ เบอร์โทรศัพท์นี้ถูกสมัครใช้บริการแล้ว กรุณาติดต่อสหกรณ์") </script> ';
		echo "<script>window.location = 'index.php'</script>";
		exit;*/
		
		 echo " <script type='text/javascript'> functionAlert1();</script>";  exit;
	
	}else{
	
		// ii
		
		/*echo '<script type="text/javascript"> window.alert("ไม่สามารถดำเนินการได้ ท่านเคยสมัครใช้บริการแล้ว กรุณาติดต่อสหกรณ์") </script> ';
		echo "<script>window.location = 'index.php'</script>";
		exit;*/
		
		 echo " <script type='text/javascript'> functionAlert1();</script>";  exit;
		
		}
	}
	
	if($card_person	 != $idchk){ // เลขบัตรไม่ถูกต้อง
		$register_status = false;
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
		
		
                                                                        
           if($card_person == "" && $mobile != $phone_input){ // ไม่พบเลขบัตรเเละเบอร์โทรศัพท์ไม่ถูกต้อง ii

               
               /* echo "
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
                
                echo " <script type='text/javascript'> functionAlert();</script>";  exit;
               
           }else if($card_person == "" && $mobile == ""){ // ไม่พบเลขบัตรเเละไม่พบเบอร์โทรศัพท์ ii
               
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
                
                echo " <script type='text/javascript'> functionAlert();</script>";  exit;
               
           }else{ // ii
               
              /* echo "
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
                
                echo " <script type='text/javascript'> functionAlert();</script>";  exit;
               
           }
                                                                        
                                                                        
                                                                        
                                                                        
		
		}else{
		
                    if ($card_person != $idchk && $mobile != $phone_input){ // บัตรผิดเเละเบอร์โทรผิด ii
               
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
                
                echo " <script type='text/javascript'> functionAlert();</script>";  exit;
               
               
           }else if ($card_person != $idchk && $mobile == ""){ // บัตรผิดเเละไม่พบเบอร์โทรศัพท์ ii
               
               /* echo "
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
                
                echo " <script type='text/javascript'> functionAlert();</script>";  exit;
               
               
           }else{ // ii
		
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
                
                echo " <script type='text/javascript'> functionAlert();</script>";  exit;
									
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
		echo "<script>window.location = 'register.php'</script>";
		exit;*/
		

		if($mobile == ""){ // ii
		
		/* echo "
								   <script type='text/javascript'>
								   sessionStorage.setItem('member_no','".$member_no."')   
										sessionStorage.setItem('idchk','".$idchk."') 
										sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 
									
								   alert('ไม่พบเบอร์โทรศัพท์ของท่านในฐานข้อมูล กรุณาติดต่อสหกรณ์'); 
										window.history.go(-1)
																										
									</script>";  exit;*/
									
									echo "
								   <script type='text/javascript'>
								   sessionStorage.setItem('member_no','".$member_no."')   
								   sessionStorage.setItem('idchk','".$idchk."') 
								   sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 	
																
									</script>";  
                
                echo " <script type='text/javascript'> functionAlert();</script>";  exit;
		
		}else{ // ii
		
		
			/* echo "
								   <script type='text/javascript'>
								   sessionStorage.setItem('member_no','".$member_no."')   
										sessionStorage.setItem('idchk','".$idchk."') 
										sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 
									
								   alert('ไม่สามารถดำเนินการได้ เบอร์โทรศัพท์ของท่านไม่ถูกต้อง กรุณาติดต่อสหกรณ์'); 
										window.history.go(-1)
																										
									</script>";  exit;*/
									
									echo "
								   <script type='text/javascript'>
								   sessionStorage.setItem('member_no','".$member_no."')   
								   sessionStorage.setItem('idchk','".$idchk."') 
								   sessionStorage.setItem('phone_input','".$_POST["phone_input"]."') 	
																
									</script>";  
                
                echo " <script type='text/javascript'> functionAlert();</script>";  exit;
				
									}
	}
	
	// end process check mobile
	
	if($register_status){ // เริ่มการสมัคร
		?>
        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="6">
          <tr>
            <td><form action="" method="post" id="formID2" >
              <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td bgcolor="#FFFFFF"><table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
                    <tr>
                      <td height="30" colspan="2" bgcolor="#666666"><table width="98%" border="0" align="center" cellpadding="2" cellspacing="2">
                        <tr>
                          <td><strong><font size="2" face="Tahoma" color="#FFFFFF">ข้อมูลสมาชิก</font></strong></td>
                        </tr>
                      </table></td>
                    </tr>
					<tr>
                      <td width="278" align="right"></td>
                      <td width="461" align="left"></td>
                      </tr>
					  <tr>
                      <td width="278" align="right"></td>
                      <td width="461" align="left"></td>
                      </tr><tr>
                      <td width="278" align="right"></td>
                      <td width="461" align="left"></td>
                      </tr>
					  
					 <tr>
                      <td width="278" align="right"></td>
                      <td width="461" align="left"></td>
                      </tr>
                    <tr>
                      <td width="278" align="right"><strong><font face="Tahoma" size="2">เลขทะเบียนสมาชิก :</font></strong></td>
                      <td width="461" align="left"><input name="memb_no" type="text" class="validate[required,custom[integer_member_no]]" id="memb_no" autocomplete="off"  value="<?=$member_no?>" size="10" readonly /></td>
                      </tr>
                    <tr>
                      <td align="right"><strong><font face="Tahoma" size="2">ชื่อ-สกุล :</font></strong></td>
                      <td align="left"><input name="memb_fullname" type="text" class="validate[required]" id="memb_fullname"  value="<?=$full_name?>" size="35"  maxlength="13" readonly /></td>
                      </tr>
                    <tr>
                      <td align="right"><strong><font face="Tahoma" size="2">เลขที่บัตรประชาชน :</font></strong></td>
                      <td align="left"><input name="idcard1" type="text" class="validate[required,custom[integer],minSize[13]]" id="idcard1"  value="<?=$card_person?>" size="35"  maxlength="13" readonly /></td>
                    </tr>
                    <tr>
                      <td align="right"><strong><font face="Tahoma" size="2">มือถือ :</font></strong></td>
                      <td align="left">
                      <?php if($mobile_register == 0){?>
                      <input name="mobile1" type="text" class="validate[required,minSize[10]]" id="mobile1" size="35" value="<?=$mobile?>" autocomplete="off" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/>
					  <?php }else { ?> 
                      <input name="mobile1" type="text" class="validate[minSize[10]]" id="mobile1" size="35" value="<?=$mobile?>" autocomplete="off" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/>
                      <?php } ?></td>
                    </tr>
                    <tr>
                      <!--td colspan="2" align="center"><font face="Tahoma" size="2" color="red"><strong><em>* หมายเลขโทรศัพท์ เพื่อรับข้อมูลผ่าน SMS รูปแบบ 0812345678</em></strong></font></td>-->
                      </tr>

					  
                    <tr>
                      <td align="right"><strong><font size="2" face="Tahoma">Email </font></strong>:</td>
                      <td align="left">
                        <?php 	if($email_register == 0){?>
                        	<input name="email1" type="text" id="email1" value="<?=$email?>" class="validate[required,custom[email]]	" size="35" autocomplete="off"/>	
					  	<?php }else { ?> 
                        	<input name="email1" type="text" id="email1" value="<?=$email?>" class="validate[custom[email]]	" size="35" autocomplete="off"/>			
                        <?php } ?>                   
                      </td>
                    </tr>
                    <tr>
                      <!--<td colspan="2" align="center"><font face="Tahoma" size="2" color="red"><strong><em>* Email เพื่อรับข่าวสารสหกรณ์</em></strong></font></td>-->
                      </tr>
                    <tr>
                      <td height="30" colspan="2" align="left" bgcolor="#666666"><table width="98%" border="0" align="center" cellpadding="2" cellspacing="2">
                        <tr>
                          <td><strong><font size="2" face="Tahoma" color="#FFFFFF">กำหนดรหัสผู้ใช้ 8 หลัก (ตัวเลข 0-9 หรือตัวอักษร a-z , A-Z)</font></strong></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td colspan="2" align="center"><table width="69%" border="0" cellspacing="2" cellpadding="2">
                        <tr>
                          <td width="32%" align="right"><strong><font size="2" face="Tahoma">รหัสผ่าน :</font></strong></td>
                          <td colspan="2"><input name="pwd_r" type="password" class="validate[required,minSize[8]]" id="pwd_r" size="35" maxlength="8" autocomplete="off"/></td>
                          </tr>
						   <tr>
                          <td align="right"><strong><font size="2" face="Tahoma"> </font></strong></td>
                          <td colspan="2"></td>
                          </tr>
						    <tr>
                          <td align="right"><strong><font size="2" face="Tahoma"> </font></strong></td>
                          <td colspan="2"></td>
                          </tr>
                        <tr>
                          <td align="right"><strong><font size="2" face="Tahoma">ยืนยันรหัสผ่าน :</font></strong></td>
                          <td colspan="2"><input name="pwd_r1" type="password" class="validate[required,equals[pwd_r]]" id="pwd_r1" size="35" maxlength="8" autocomplete="off"/></td>
                          </tr>
                        <tr>
                          <td align="right">&nbsp;</td>
                          <td width="4%">&nbsp;</td>
                          <td width="64%"><input type="submit" name="button" id="button2" value="ตกลงสมัคร" />
                            <input type="reset" name="button3" id="button3" value="ล้างข้อมูลทั้งหมด">
                            <input name="reg" type="hidden" id="reg" value="done"></td>
                          </tr>
                        </table></td>
                    </tr>
                    </table></td>
                </tr>
              </table>
              </form></td>
          </tr>
        </table>
        <?php
	}
}
?> 
<?php 
	if($_POST["reg"] == "done"){  
		 	require "../s/s.register.php" ;
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
$('#pwd_r').focus();
 
    $('#member_no').val(sessionStorage.getItem('member_no'));
	$('#idchk').val(sessionStorage.getItem('idchk'));
	$('#phone_input').val(sessionStorage.getItem('phone_input'));
		
	

})

$('#idchk').focus(function(e){
	event.preventDefault()
})

$('#idchk').change(function(){

if($(this).val() == '' ){

//console.log($(this).val());

 alert('กรุณากรอกเลขบัตรประชาชน');
 
}else{

    

}
});

function checkID(id) {
    if(id.length != 13 && id.length !=0) {

	//$('#phone_input').attr('readonly',true)
	$('#idchk').focus()
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
                            functionAlert();
                            
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

<!-- <script>          
	function functionAlert(msg, myYes) {             
	var confirmBox = $("#confirm");             
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
	#confirm {             display: none;             
	background-color: #F3F5F6;             color: #000000;             
	border: 1px solid #aaa;             position: absolute;             width: 300px;             height: 100px;             left: 40%;             top: 40%;            
	box-sizing: border-box;             text-align: center;          }          
	#confirm button {             background-color: #FFFFFF;             
	display: inline-block;             border-radius: 12px;            
	border: 4px solid #aaa;             padding: 5px;             text-align: center;          
	width: 60px;             cursor: pointer;          }          #confirm .message {            
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
	text-align: left;          }       </style> -->

