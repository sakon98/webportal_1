<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
require "../include/conf.conn.php";
require "../include/conf.c.php";
require "../include/lib.Etc.php";
require "../include/lib.MySql.php";
require "../include/lib.Oracle.php";
$connectby = "mobile";

//http://web.coopsiam.com:8080/GSB/w/info.php?menu=Member_info
//http://web.coopsiam.com:8080/GSB/w/info.php?menu=Share
//http://web.coopsiam.com:8080/GSB/w/info.php?menu=Deposit
//http://web.coopsiam.com:8080/GSB/w/info.php?menu=Loan
//http://web.coopsiam.com:8080/GSB/w/info.php?menu=Payment_Show
//http://web.coopsiam.com:8080/GSB/w/info.php?menu=Payment
//http://web.coopsiam.com:8080/GSB/w/index.php
//http://web.coopsiam.com:8080/GSB/w/info.php?menu=SigeOut

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$title?></title>
	<link rel="stylesheet"  href="../css/jquery.mobile-1.3.2.min.css">
	<link rel="stylesheet" href="../css/jqm-demos.css">
	<link rel="shortcut icon" href="../img/ic_launcher.png">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <script src="../js/jquery.js"></script>
	<script src="../js/index.js"></script>
	<script src="../js/jquery.mobile-1.3.2.min.js"></script>
</head>
<body>
<?php require "../include/conf.d.php" ?>
<center>
<br/><ul data-role="listview" data-ajax="false" data-inset="false" data-theme="e">
<li><a><?=$sub_title?></a></li>
</ul><br/> <br/>  <img src="../img/ic_launcher.png" width="150" /><br/>
<?php if($_POST["agree"] != "agree" ){  ?>
<textarea name="textfield" rows="9" readonly id="textfield" style="width:80%; resize:none; padding:16px">
เงื่อนไขและข้อตกลงในการสมัครสมาชิก
1.การเข้าใช้งานระบบข้อมูลสมาชิกจะต้องทำการสมัครเข้าใช้งานระบบและต้องเป็นสมาชิกของ <?=$title?> เท่านั้น 
2.เพื่อความเรียบร้อยในการสมัครใช้งาน ระบบฯ และเพื่อยืนยันผู้สมัคร กรุณาทำตามขั้นตอนที่ระบบแนะนำ 
3.หากปรากฏว่า ชื่อหรือหมายเลขสมาชิก ของท่านได้มีการสมัครใช้งานแล้ว โดยท่านไม่ทราบ หรือทำการสมัครด้วยตัวท่านเอง กรุณาแจ้งเจ้าหน้าที่เพื่อทำการตรวจสอบความถูกต้อง ต่อไปกรุณาเก็บรักษา username / password ของท่าน
4.เพื่อสิทธิและความปลอดภัยในข้อมูลของท่านเองหากปรากฏว่ามีบุคคลแอบอ้าง สมัครใช้งานระบบและเจ้าหน้าที่ตรวจสอบแล้วจะทำการลบรายชื่อนั้นๆ ออกจากระบบ โดยไม่ต้องแจ้งให้ทราบ 
5.ข้อมูลของสมาชิก ในระบบจะทำการปรับปรุงข้อมูล หากสมาชิกท่านใดพบข้อมูลไม่ตรงหรือมีข้อสงสัยกรุณาติดต่อเจ้าหน้าที่
6.ข้าพเจ้าได้อ่านข้อตกลงดังกล่าวแล้ว และยินยอมในเงื่อนไขต่างๆที่ทาง <?=$title?> กำหนดไว้
</textarea>
            <form name="formID1" id="formID1" method="post" action="" >
			  <label><input type="checkbox" name="agree" value="agree"  required/>ยอมรับเงื่อนไข </label>
              <input name="member_no" type="text" class="validate[required,custom[integer]]" id="member_no" size="20" maxlength="10" autocomplete="off" placeholder="ทะเบียนสมาชิก"  required/>
              <input name="idchk" type="text" class="validate[required,custom[integer],minSize[13]]" id="idchk" size="20" maxlength="13" autocomplete="off" placeholder="เลขที่บัตรประชาชน" required/>
			  <input type="submit" name="Submit" id="button" value="ตกลง"  data-iconpos="right" data-theme="b" />
			  <!--<input name="ยกเลิก" type="reset" id="ยกเลิก"  data-iconpos="right" data-theme="b" onclick="location.href='index.php'" value="ยกเลิก" />-->
              <input name="ref" type="hidden" id="ref" value="checkuser" />
            </form>
<?php
}else{
 	require "../s/s.member_info.php" ;
	//echo $card_person;
	//echo $Num_Rows;
	$register_status = true;
	if($Num_Rows == 0){ // ไม่พบทะเบียน 
		$register_status = false;
		echo '<script type="text/javascript"> window.alert("ไม่สามารถดำเนินการได้ กรุณาติดต่อสหกรณ์ เพื่อตรวจสถานะการเป็นสมาชิก") </script> ';
		echo "<script>window.location = 'index.php'</script>";
		exit;
	}	

	/*if($countmemb	> 0 or $countidcard > 0){ // เคยสมัครแล้ว
		$register_status = false;
		echo '<script type="text/javascript"> window.alert("ไม่สามารถดำเนินการได้ ท่านเคยสมัครใช้บริการแล้ว กรุณาติดต่อสหกรณ์") </script> ';
		echo "<script>window.location = 'index.php'</script>";
		exit;
	}*/
	
	if($card_person	 != $idchk){ // เลขบัตรไม่ถูกต้อง
		$register_status = false;
		echo '<script type="text/javascript"> window.alert("ไม่สามารถดำเนินการได้ ทะเบียนสมาชิกหรือเลขบัตรประชาชนไม่ถูกต้อง กรุณาตรวจสอบ") </script> ';
		echo "<script>window.location = 'index.php'</script>";
		exit;
	}
	if($register_status){ // เริ่มการสมัคร
		?>
        <form action="" method="post" id="formID2">
              <input name="memb_no" type="text" class="validate[required,custom[integer]]" id="memb_no" autocomplete="off"  value="<?=$member_no?>" size="10" readonly  placeholder="ทะเบียนสมาชิก" /></td>
              <input name="memb_fullname" type="text" class="validate[required]" id="memb_fullname"  value="<?=$full_name?>" size="35"  maxlength="13" readonly  placeholder="ชื่อ-สกุล "  /></td>
              <input name="idcard1" type="text" class="validate[required,custom[integer],minSize[13]]" id="idcard1"  value="<?=$card_person?>" size="35"  maxlength="13" readonly placeholder="เลขที่บัตรประชาชน " /></td>
              <?php if($mobile_register == 1){?>
                      <input name="mobile1" type="text" class="validate[required,minSize[10]]" id="mobile1" size="35" value="<?=$mobile?>" autocomplete="off" placeholder="มือถือ " />
			 <?php }else { ?> 
                      <input name="mobile1" type="text" class="validate[minSize[10]]" id="mobile1" size="35" value="<?=$mobile?>" autocomplete="off" placeholder="มือถือ(ยืนยัน) " />
             <?php } ?><br/>
			 <font face="Tahoma" size="2" color="red"><strong><em>* หมายเลขโทรศัพท์ เพื่อรับข้อมูลผ่าน SMS รูปแบบ 0812345678</em></strong></font>
			 <?php 	if($email_register == 1){?>
                        	<input name="email1" type="text" id="email1" value="<?=$email?>" class="validate[required,custom[email]]	" size="35" autocomplete="off" placeholder="Email "/>	
			 <?php }else { ?> 
                        	<input name="email1" type="text" id="email1" value="<?=$email?>" class="validate[custom[email]]	" size="35" autocomplete="off" placeholder="Email(ยืนยัน) "/>			
             <?php } ?> <br/>
			 <font face="Tahoma" size="2" color="red"><strong><em>* Email เพื่อรับข่าวสารสหกรณ์ กำหนดรหัสผู้ใช้อย่างน้อย 8 ตัวอักษร แต่ไม่เกิน 13 ตัวอักษร</em></strong></font>
              <input name="pwd_r" type="password" class="validate[required,minSize[8]]" id="pwd_r" size="35" maxlength="13" autocomplete="off" placeholder="รหัสผ่าน "/>
              <input name="pwd_r1" type="password" class="validate[required,equals[pwd_r]]" id="pwd_r1" size="35" maxlength="13" autocomplete="off" placeholder="รหัสผ่าน(ยืนยัน) "/>
              <input type="submit" name="button" id="button2" value="ตกลงสมัคร" data-iconpos="right" data-theme="b" />
              <input type="reset" name="button3" id="button3" value="ล้างข้อมูลทั้งหมด"data-iconpos="right" data-theme="b" >
              <input name="reg" type="hidden" id="reg" value="done">
              </form>
        <?php
	}
}
?> 
<?php 
	if($_POST["reg"] == "done"){  
		 	require "../s/s.register.php" ;
	}
?>     
<div ><a href="index.php" data-role="button" data-corners="false"  data-icon="arrow-l" data-theme="f">กลับเข้าสู่ระบบ</a></div></center>
</body>
</html>

