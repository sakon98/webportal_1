<?php
	session_start();
	header('Content-Type: text/html; charset=tis-620');
	require "../include/conf.conn.php";
	require "../include/conf.c.php";
	require "../include/lib.Etc.php";
	require "../include/lib.Oracle.php";
	require "../include/lib.MySql.php";

	$ipconnect = $_SERVER['REMOTE_ADDR'];
	$date_log = date('Y-m-d H:i:s');
	$connectby = "mobile";
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$title?></title>
	<link rel="stylesheet"  href="../css/jquery.mobile-1.3.2.min.css">
	<link rel="stylesheet" href="../css/jqm-demos.css">
	<link rel="shortcut icon" href="../img/logo.png">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <script src="../js/jquery.js"></script>
	<script src="../js/index.js"></script>
	<script src="../js/jquery.mobile-1.3.2.min.js"></script>
</head>
<body>
<div data-role="page" class="jqm-demos jqm-demos-home" >
<div data-role="header">
    <center><p><?=$title1?></p></center>
</div>
<?php require "../include/conf.m.php" ?>
<center>
<?php if ($_POST["agree"] != "agree") { ?>

	<form name="formID1" id="formID1" method="post" action="" >
	
			<div style=" height:100%; width:80%" > 
				<div style="width:100%; text-align:left;">
					<h4>*** เงื่อนไขและข้อตกลงในการสมัครสมาชิก***</h4>
						<p style="padding-left: 10px;">1.การเข้าใช้งานระบบข้อมูลสมาชิกจะต้องทำการสมัครเข้าใช้งานระบบและต้องเป็นสมาชิก เท่านั้น </p>
						<p style="padding-left: 10px;">2.เพื่อความเรียบร้อยในการสมัครใช้งาน ระบบฯ และเพื่อยืนยันผู้สมัคร กรุณาทำตามขั้นตอนที่ระบบแนะนำ </p>
						<p style="padding-left: 10px;">3.หากปรากฏว่า ชื่อหรือหมายเลขสมาชิก ของท่านได้มีการสมัครใช้งานแล้ว โดยท่านไม่ทราบ หรือทำการสมัครด้วยตัวท่านเอง กรุณาแจ้งเจ้าหน้าที่เพื่อทำการตรวจสอบความถูกต้อง ต่อไปกรุณาเก็บรักษา username / password ของท่าน</p>
						<p style="padding-left: 10px;">4.เพื่อสิทธิและความปลอดภัยในข้อมูลของท่านเองหากปรากฏว่ามีบุคคลแอบอ้าง สมัครใช้งานระบบและเจ้าหน้าที่ตรวจสอบแล้วจะทำการลบรายชื่อนั้นๆ ออกจากระบบ โดยไม่ต้องแจ้งให้ทราบ </p>
						<p style="padding-left: 10px;">5.ข้อมูลของสมาชิก ในระบบจะทำการปรับปรุงข้อมูล หากสมาชิกท่านใดพบข้อมูลไม่ตรงหรือมีข้อสงสัยกรุณาติดต่อเจ้าหน้าที่</p>
						<p style="padding-left: 10px;">6.ข้าพเจ้าได้อ่านข้อตกลงดังกล่าวแล้ว และยินยอมในเงื่อนไขต่าง ๆ ที่ทาง สหกรณ์ กำหนดไว้</p>
					</div>
				<div>
					<input type="text" name="member_no" id="member_no" value=""  placeholder="ทะเบียนสมาชิก" autocomplete="off" required >
				</div>			 
				<input type="text" name="idchk" id="idchk" value="" placeholder="เลขบัตรประชาชน" autocomplete="off" required> 
				<label><input type="checkbox" name="agree" value="agree"  required/>ยอมรับเงื่อนไข </label>
			    <input value="ตกลง" data-iconpos="right" data-theme="b" type="submit">
			    <input value="ยกเลิก" data-iconpos="right" data-theme="b" type="reset">
				<input name="ref" type="hidden" id="ref" value="checkuser" />
				<br>
		</div>
	</form>
<?php
            } else {
                require "../s/s.member_info.php";
                //echo $card_person;
                //echo $Num_Rows;
                $register_status = true;
                if ($Num_Rows == 0) { // ไม่พบทะเบียน 
                    $register_status = false;
                    echo '<script type="text/javascript"> window.alert("ไม่สามารถดำเนินการได้ กรุณาติดต่อสหกรณ์ เพื่อตรวจสถานะการเป็นสมาชิก") </script> ';
                    echo "<script>window.location = 'index.php'</script>";
                    exit;
                }

                if ($countmemb > 0 or $countidcard > 0) { // เคยสมัครแล้ว
                    $register_status = false;
                    echo '<script type="text/javascript"> window.alert("ไม่สามารถดำเนินการได้ ท่านเคยสมัครใช้บริการแล้ว กรุณาติดต่อสหกรณ์") </script> ';
                    echo "<script>window.location = 'index.php'</script>";
                    exit;
                }

                if ($card_person != $idchk) { // เลขบัตรไม่ถูกต้อง
                    $register_status = false;
                    echo '<script type="text/javascript"> window.alert("ไม่สามารถดำเนินการได้ ทะเบียนสมาชิกหรือเลขบัตรประชาชนไม่ถูกต้อง กรุณาตรวจสอบ") </script> ';
                    echo "<script>window.location = 'index.php'</script>";
                    exit;
                }


                if ($register_status) {//เริ่มการสมัคร
                    ?>
                    <form action="" method="post" id="formID2">
						<br>
						<div style=" height:100%; width:80%"> 
								<h4>ข้อมูลสมาชิกที่ใช้สมัคร</h4>
								<div class="ui-field-contain">
										<label for="memb_no">เลขทะเบียนสมาชิก:</label>
									<input type="text"  id="memb_no" name="memb_no"  value="<?= $member_no ?>" size="10" readonly>
								</div>
								
								<div class="ui-field-contain">
									<label for="memb_fullname">ชื่อ - นามสกุล:</label>
									<input type="text"  id="memb_fullname" name="memb_fullname"  value="<?= $full_name ?>"  maxlength="13" readonly>
								</div>
								
								<div class="ui-field-contain">
									<label for="idcard1">เลขบัตรประชาชน:</label>
									<input type="text"  id="idcard1" name="idcard1"  value="<?= $card_person ?>"  maxlength="13" readonly>
								</div>
								
								<div class="ui-field-contain">
									<label for="mobile1">เบอร์โทร:</label>
									<?php if ($mobile_register == 1) { ?>
										<input type="text" class=" validate[required,minSize[10]]" id="mobile1" name="mobile1"  value="<?= $mobile ?>"   required >
									<?php } else { ?> 
										<input type="text" class=" validate[required,minSize[10]]" id="mobile1" name="mobile1"  value="<?= $mobile ?>"  >
									<?php } ?>
								</div>
								
								<div class="ui-field-contain">
									<label for="email1">อีเมลล์:</label>
									<?php if ($email_register == 1) { ?>
										<input type="email"  id="email1" name="email1"  value="<?= $email ?>" >
									<?php } else { ?> 
										<input type="email"  id="email1" name="email1"  value="<?= $email ?>" >
									<?php } ?>
								</div>
								<label>กำหนดรหัสผู้ใช้อย่างน้อย 8 ตัวอักษร แต่ไม่เกิน 16 ตัวอักษร</label>
								<div class="ui-field-contain">
									<label for="pwd_r">รหัสผ่าน:</label>
									<input type="password" class=" validate[minSize[8]]" id="pwd_r" name="pwd_r"  maxlength="16"  required >
								</div>
                               
								<div class="ui-field-contain">
									<label for="pwd_r1">ยืนยันรหัสผ่าน :</label>
									<input type="password" class="validate[minSize[8]]" id="pwd_r1" name="pwd_r1"  maxlength="16" required>
								</div>
								<div class="ui-field-contain">
									<input type="submit" name="button"  id="button2" data-iconpos="right" data-theme="b"  value="ตกลง">
								</div>
								<div class="ui-field-contain">
									<input type="reset" class="btn btn-default" id="button3" data-iconpos="right" data-theme="b" value="ยกเลิก">
									<input name="reg" type="hidden" id="reg" value="done">
								</div>
								<br>
							</div>
                    </form>
                    <?php
                }
            }
            ?>
			<?php
				if ($_POST["reg"] == "done") {
					require "../s/s.register.php";
				}
            ?>  
    
    <div data-role="footer" class="jqm-footer">
		<p><?=$credite?></p>
	</div><!-- /footer -->
</div>
</center>
</body>
</html>
