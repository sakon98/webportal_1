<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require "../include/conf.conn.php";
require "../include/conf.c.php";
$connectby = "desktop";
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$title?></title>
	<link href="../css/jquery-ui-1.10.4.css" rel="stylesheet">
	<link rel="shortcut icon" href="../img/logo.png">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <script src="../js/jquery.js"></script>
	<script src="../js/index.js"></script>
	
	 <script type="text/javascript">
	 
	 
	 
	 alert("กรุณากรอกเลขพนักงาน เป็นข้อมูลเเรก");
	 
	function check() {
	
	 // disabled text
	
		document.getElementById("emp_name").disabled = true;
		document.getElementById("emp_surname").disabled = true;
		document.getElementById("emp_ename").disabled = true;
		document.getElementById("emp_esurname").disabled = true;
		document.getElementById("position_work").disabled = true;
		document.getElementById("birth_date").disabled = true;
		document.getElementById("nationality").disabled = true;
		document.getElementById("card_person").disabled = true;
		document.getElementById("salary_amt").disabled = true;
		document.getElementById("work_str_date").disabled = true;
		document.getElementById("work_date").disabled = true;
		document.getElementById("periodshare_value").disabled = true;
		document.getElementById("expense_accid").disabled = true;
		document.getElementById("memb_addr").disabled = true;
		document.getElementById("addr_group").disabled = true;
		document.getElementById("soi").disabled = true;
		document.getElementById("mooban").disabled = true;
		document.getElementById("road").disabled = true;
		document.getElementById("postcode").disabled = true;
		document.getElementById("email_address").disabled = true;
		document.getElementById("mem_tel").disabled = true;
		document.getElementById("email_address").disabled = true;
		document.getElementById("mem_tel").disabled = true;
		document.getElementById("mem_telmobile").disabled = true;
		document.getElementById("curraddr_no").disabled = true;
		document.getElementById("curraddr_moo").disabled = true;
		document.getElementById("curraddr_soi").disabled = true;
		document.getElementById("curraddr_village").disabled = true;
		document.getElementById("curraddr_road").disabled = true;
		document.getElementById("curraddr_postcode").disabled = true;
		document.getElementById("refer_name").disabled = true;
		document.getElementById("refer_name_tel").disabled = true;
		document.getElementById("referaddr_no").disabled = true;
		document.getElementById("referaddr_moo").disabled = true;
		document.getElementById("referaddr_soi").disabled = true;
		document.getElementById("referaddr_village").disabled = true;
		document.getElementById("referaddr_road").disabled = true;
		document.getElementById("referaddr_postcode").disabled = true;

	}
	
	
	

/***********************************************
* Disable "Enter" key in Form script- By Nurul Fadilah(nurul@REMOVETHISvolmedia.com)
* This notice must stay intact for use
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/
                
function handleEnter (field, event) {
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13) {
			var i;
			for (i = 0; i < field.form.elements.length; i++)
				if (field == field.form.elements[i])
					break;
			i = (i + 1) % field.form.elements.length;
			field.form.elements[i].focus();
			return false;
		} 
		else
		return true;
	}      

</script>
	
</head>
<body onload="check()">
<?php require "../include/conf.d.php" ?>
<?php if($_REQUEST["usr"] == null or $_REQUEST["pwd"] == null){ ?>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="middle" background="">
    <table width="995" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#fff">
      <tr>
        <td height="120" background="../img/head_info_bg.png">
<table width="994" border="0" cellspacing="3" cellpadding="0">
          <tr>
            <td width="140" height="100" align="right"><img src="../img/logo.png" width="100" height="100"></td>
            <td width="845"><table width="100%" border="0" cellspacing="5" cellpadding="0">
              <tr>
                <td><font face='Tahoma' size="5" color="#FFFFFF"><strong>
                  <?=$title?>
                </strong></font><br/>
                <font face='Tahoma' size="2" color="#FFFFFF">
                <?=$sub_title1?>
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
        <td height="390"  background="../img/bg.png">
        <table width="995" border="0" cellspacing="0" cellpadding="0">
          <tr>
           <td align="center"><table width="1000px" style="height:390;" border="0" align="center" cellpadding="0" cellspacing="0">
           
              <tr>
                <td height="35" align="center" bgcolor="#FFFFFF"><font face='Tahoma' size="4" color="#000000"><strong>
                  สมัครสมาชิกสหกรณ์
                </strong></font></td>
              </tr>
              <tr >
                <td style="opacity: 0.85;" align="left" bgcolor="#FFFFFF">
                   <form name="formID1" id = "formarray" method="post" action="insert_req.php" >
                   <div style="margin-left:10px;">
						<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="คำนำหน้า"> 
                   <select id="prename" name="prename" style="width:100px;" class="inputs" required>
					  <option value="">คำนำหน้า</option>
					  <?php
						$strSQL = "SELECT prename_code, prename_desc  FROM mbucfprename 
								 order by prename_code ASC";
						$objParse = oci_parse($objConnect, $strSQL);
						oci_execute ($objParse,OCI_DEFAULT);
							while($objResult = oci_fetch_array($objParse,OCI_BOTH)){
					  ?>
					  <option value="<?=$objResult[0]?>" id="<?=$objResult[0]?>"><?=$objResult[1]?></option>
							<?php  } ?>
					</select>
			
				   <input name="memb_name" id="emp_name" type="text" style="width:180px;" class="inputs" placeholder="ชื่อ (ไทย)"  required>
				    <input name="memb_surname" id="emp_surname" type="text" style="width:180px;" class="inputs" placeholder="นามสกุล (ไทย)"  required>
                   <br> 
				   <input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="เพศ"> 
                   <select id="sex" name="sex" style="width:100px;" class="inputs" required>
					  <option value="">เพศ</option>
						<option value="F" id="F">หญิง</option>
						<option value="M" id="M">ชาย</option>
					</select>
				   <input name="memb_ename" id="emp_ename" type="text" style="width:180px;" class="inputs" placeholder="ชื่อ (Eng)" >
				    <input name="memb_esurname" id="emp_esurname" type="text" style="width:180px;" class="inputs" placeholder="นามสกุล (Eng)" >
					<br> 
				   <input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="สังกัด"> 
                   <select id="membgroup_code" name="membgroup_code" style="width:400px;" class="inputs" required>
					   <option value="">สังกัด</option>
					  <?php
						$strSQL2 = "select membgroup_code,membgroup_desc from mbucfmembgroup 
									order by membgroup_code";
						$objParse2 = oci_parse($objConnect, $strSQL2);
						oci_execute ($objParse2,OCI_DEFAULT);
							while($objResult2 = oci_fetch_array($objParse2,OCI_BOTH)){
					  ?>
					  <option value="<?=$objResult2[0]?>" class="<?=$objResult2[0]?>"><?=$objResult2[0].' - '.$objResult2[1]?></option>
							<?php  } ?>
					</select><br>
					 <input type="text" class="inputs" style="width:115px;background-color:#D0D0E9;color:#000000;" readonly value="สถานที่ปฏิบัติงาน"> 
					 <input name="position_work" id="position_work" type="text" style="width:355px;" class="inputs" placeholder="สถานที่ปฏิบัติงาน" >
					<br>
					</div>
					<fieldset style="width:550px;">
					<legend style="color:#000000;font-size:medium;">ข้อมูลส่วนตัว</legend>
					<input type="text" class="inputs" style="width:100px;background-color:#D0D0E9;color:#000000;" readonly value="วันเกิด"> 
					<input name="birth_date" id="birth_date" type="text" style="width:180px;" class="inputs"  placeholder="วว/ดด/ปปปป (พ.ศ)"  required>
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="สัญชาติ"> 
					<input name="nationality" id="nationality" type="text" style="width:180px;" class="inputs" placeholder="สัญชาติ"  required>
					<br>
					<input type="text" class="inputs" style="width:100px;background-color:#D0D0E9;color:#000000;" readonly value="บัตรประชาชน"> 
				    <input name="card_person" id="card_person" type="text" style="width:180px;" maxlength="13" class="inputs" placeholder="เลขบัตรประชาชน"  required>
					</fieldset>
					<fieldset style="margin-right:10px;margin-top:-180px;float:right;width:380px;">
					<legend style="color:#000000;font-size:medium;">ข้อมูลการทำงาน</legend>
					<input type="text" class="inputs" style="width:80px;background-color:#D0D0E9;color:#000000;" readonly value="ตำแหน่ง"> 
                                        <select id="position_code" name="position_code" style="width:100px;" class="inputs">
					   <option value="">ตำแหน่ง</option>
					  <?php
						$strSQL_p = "select position_code,position_desc from mbucfposition
									order by position_code";
						$objParse_p = oci_parse($objConnect, $strSQL_p);
						oci_execute ($objParse_p,OCI_DEFAULT);
							while($objResult_p = oci_fetch_array($objParse_p,OCI_BOTH)){
					  ?>
					  <option value="<?=$objResult_p[0]?>" class="pos<?=$objResult_p[0]?>"><?=$objResult_p[0].' - '.$objResult_p[1]?></option>
							<?php  } ?>
					</select>
					<input type="text" class="inputs" style="width:80px;background-color:#D0D0E9;color:#000000;" readonly value="ระดับ"> 
                                        <select id="level_code" name="level_code" style="width:100px;" class="inputs" required>
					   <option value="">ระดับ</option>
					  <?php
						$strSQL_L = "select trim(level_code) as level_code,level_desc from mbucflevel
									order by level_code";
						$objParse_L = oci_parse($objConnect, $strSQL_L);
						oci_execute ($objParse_L,OCI_DEFAULT);
							while($objResult_L = oci_fetch_array($objParse_L,OCI_BOTH)){
					  ?>
					  <option value="<?=$objResult_L[0]?>" id="<?=$objResult_L[0]?>"><?=$objResult_L[1]?></option>
							<?php  } ?>
					</select>
					<br>
					<input type="text" class="inputs" style="width:80px;background-color:#D0D0E9;color:#000000;" readonly value="เลขพนักงาน"> 
				    <input name="member_no" type="text" style="width:100px;" class="inputs" id="member_no" placeholder="เลขพนักงาน" autofocus required>
					<input type="text" class="inputs" style="width:80px;background-color:#D0D0E9;color:#000000;" readonly value="เงินเดือน"> 
				    <input name="salary_amount" id="salary_amt" type="text" style="width:100px;" class="inputs" placeholder="เงินเดือน"  required>
					<br>
					<input type="text" class="inputs" style="width:80px;background-color:#D0D0E9;color:#000000;" readonly value="วันที่เริ่มงาน"> 
					<input name="work_str_date" id="work_str_date" type="text" style="width:120px;" class="inputs"  placeholder="วว/ดด/ปปปป (พ.ศ)"><br>
					<input type="text" class="inputs" style="width:80px;background-color:#D0D0E9;color:#000000;" readonly value="วันที่บรรจุ"> 
					<input name="work_date" id="work_date" type="text" style="width:120px;" class="inputs"  placeholder="วว/ดด/ปปปป (พ.ศ)">

					</fieldset><br><br>
						<fieldset style="margin-right:10px;margin-top:-50px;float:right;width:380px;">
					<legend style="color:#000000;font-size:medium;">ข้อมูลการส่งหุ้น</legend>
					<input type="text" class="inputs" style="width:100px;background-color:#D0D0E9;color:#000000;" readonly value="มูลค่าหุ้น/เดือน"> 
					<input name="periodshare_value" id="periodshare_value" type="text" style="width:100px;" class="inputs" placeholder="0.00"  required>
					</fieldset>
					<fieldset style="margin-right:-405px;margin-top:10px;float:right;width:330px;">
					<legend style="color:#000000;font-size:medium;">บัญชีหลัก</legend>
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="ธนาคาร"> 
					<select id="expense_bank" name="expense_bank" style="width:250px;" class="inputs" required>
					 <option value="">ธนาคาร</option>
					 <?php
						$strSQL34 = "SELECT bank_code as expense_bank,   bank_code || ' - ' || bank_desc as bank_desc FROM cmucfbank 
						order by bank_code ASC";
						$objParse34 = oci_parse($objConnect, $strSQL34);
						oci_execute ($objParse34,OCI_DEFAULT);
							while($objResult34 = oci_fetch_array($objParse34,OCI_BOTH)){
					  ?>
					  <option value="<?=$objResult34[0]?>"><?=$objResult34[1]?></option>
							<?php  } ?>
					</select>
					<br>
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="สาขา"> 
					<select id="expense_branch" name="expense_branch" style="width:250px;" class="inputs" >
					<option value="">กรุณาเลือกสาขาธนาคาร</option>
					</select>
					<br>
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="เลขบัญชี"> 
				    <input name="expense_accid" id="expense_accid" type="text" style="width:240px;" class="inputs" placeholder="เลขบัญชี" required>
					</fieldset>
					<fieldset style="width:600px;">
					<legend style="color:#000000;font-size:medium;">ที่อยู่ตามทะเบียนบ้าน</legend>
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="ที่อยู่"> 
					<input name="memb_addr" id="memb_addr" type="text" style="width:100px;" class="inputs" placeholder="บ้านเลขที่" required>
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="หมู่"> 
					<input name="addr_group" id="addr_group" type="text" style="width:100px;" class="inputs" placeholder="หมู่ที่" >
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="ซอย"> 
					<input name="soi" id="soi" type="text" style="width:130px;" class="inputs" placeholder="ซอย"  >
					<br>
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="หมู่บ้าน"> 
					<input name="mooban" id="mooban" type="text" style="width:100px;" class="inputs" placeholder="หมู่บ้าน" >
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="ถนน"> 
					<input name="road" id="road" type="text" style="width:100px;" class="inputs" placeholder="ถนน"  >
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="จังหวัด"> 
					 <select id="province_code" name="province_code" style="width:130px;" class="inputs" required>
					   <option value="">กรุณาเลือกจังหวัด</option>
					  <?php
						$strSQL3 = "SELECT province_code, province_desc FROM mbucfprovince
						order by province_code ASC";
						$objParse3 = oci_parse($objConnect, $strSQL3);
						oci_execute ($objParse3,OCI_DEFAULT);
							while($objResult3 = oci_fetch_array($objParse3,OCI_ASSOC)){
					  ?>
					  <option value="<?=$objResult3["PROVINCE_CODE"]?>" class="p<?=$objResult3["PROVINCE_CODE"]?>"><?=$objResult3["PROVINCE_DESC"]?></option>
							<?php  } ?>
					</select>
					<br>
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="อำเภอ"> 
					 <select id="district_code" name="district_code" style="width:150px;" class="inputs" required>
					 <option value="">กรุณาเลือกอำเภอ</option>
					</select>
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="ตำบล"> 
					 <select id="tambol_code" name="tambol_code" style="width:200px;" class="inputs" required>
					 <option value="">กรุณาเลือกตำบล</option>
					</select>
					<br>
					<input type="text" class="inputs" style="width:100px;background-color:#D0D0E9;color:#000000;" readonly value="รหัสไปรษณีย์"> 
					<input name="postcode" id="postcode" type="text" style="width:120px;" class="inputs" placeholder="รหัสไปรษณีย์" required>
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="Email"> 
					<input name="email_address" id="email_address" type="text" style="width:200px;" class="inputs" placeholder="Email" required>
					<br>
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="โทรศัพท์"> 
					<input name="mem_tel" id="mem_tel" type="text" style="width:150px;" class="inputs" placeholder="โทรศัพท์">
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="มือถือ"> 
					<input name="mem_telmobile" id="mem_telmobile" type="text" style="width:200px;" class="inputs" placeholder="มือถือ" required>
					</fieldset>
					<br>
                        <!----   --> <input type="button" name="button1" id="copyaddress" value="ที่อยู่ตามทะเบียนบ้าน --> ที่อยู่ปัจจุบัน" class="button4" style="width: 223px;"/> 
                        <br><br>
					
					<fieldset style="width:600px;">
					<legend style="color:#000000;font-size:medium;">ที่อยู่ปัจจุบัน</legend>
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="ที่อยู่"> 
					<input name="curraddr_no" id="curraddr_no" type="text" style="width:100px;" class="inputs" placeholder="บ้านเลขที่" required>
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="หมู่"> 
					<input name="curraddr_moo" id="curraddr_moo" type="text" style="width:100px;" class="inputs" placeholder="หมู่ที่" >
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="ซอย"> 
					<input name="curraddr_soi" id="curraddr_soi" type="text" style="width:130px;" class="inputs" placeholder="ซอย"  >
					<br>
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="หมู่บ้าน"> 
					<input name="curraddr_village" id="curraddr_village" type="text" style="width:100px;" class="inputs" placeholder="หมู่บ้าน" >
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="ถนน"> 
					<input name="curraddr_road" id="curraddr_road" type="text" style="width:100px;" class="inputs" placeholder="ถนน"  >
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="จังหวัด"> 
					 <select id="currprovince_code" name="currprovince_code" style="width:130px;" class="inputs" required>
					   <option value="">กรุณาเลือกจังหวัด</option>
					  <?php
						$strSQL_curr = "SELECT province_code, province_desc FROM mbucfprovince
						order by province_code ASC";
						$objParse_curr = oci_parse($objConnect, $strSQL_curr);
						oci_execute ($objParse_curr,OCI_DEFAULT);
							while($objResult_curr = oci_fetch_array($objParse_curr,OCI_ASSOC)){
					  ?>
					  <option value="<?=$objResult_curr["PROVINCE_CODE"]?>" id="<?=$objResult_curr["PROVINCE_CODE"]?>"><?=$objResult_curr["PROVINCE_DESC"]?></option>
							<?php  } ?>
					</select>
					<br>
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="อำเภอ"> 
					 <select id="curramphur_code" name="curramphur_code" style="width:150px;" class="inputs" required>
					 <option value="">กรุณาเลือกอำเภอ</option>
					</select>
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="ตำบล"> 
					 <select id="currtambol_code" name="currtambol_code" style="width:200px;" class="inputs" required>
					 <option value="">กรุณาเลือกตำบล</option>
					</select>
					<br>
					<input type="text" class="inputs" style="width:100px;background-color:#D0D0E9;color:#000000;" readonly value="รหัสไปรษณีย์"> 
					<input name="curraddr_postcode" id="curraddr_postcode" type="text" style="width:120px;" class="inputs" placeholder="รหัสไปรษณีย์" required>
					</fieldset>
					
					<!--  -->
					
					<fieldset style="width:600px;">
					<legend style="color:#000000;font-size:medium;">ข้อมูลอื่น ๆ </legend>
					<input type="text" class="inputs" style="width:220px;background-color:#D0D0E9;color:#000000;" readonly value="บุคคลอ้างอิง (ในครอบครัว/เครือญาติ)"> 
					<input name="refer_name" id="refer_name" type="text" style="width:250px;" class="inputs" placeholder="บุคคลอ้างอิง" required>
					<br>
					<input type="text" class="inputs" style="width:100px;background-color:#D0D0E9;color:#000000;" readonly value="ความสัมพันธ์" > 
					 <select id="concern_code" name="concern_code" style="width:250px;" class="inputs" required>
					   <option value="">ความสัมพันธ์</option>
					  <?php
						$strSQL8 = "SELECT concern_code, gain_concern  FROM mbucfgainconcern 
						order by concern_code ASC";
						$objParse8 = oci_parse($objConnect, $strSQL8);
						oci_execute ($objParse8,OCI_DEFAULT);
							while($objResult8 = oci_fetch_array($objParse8,OCI_BOTH)){
					  ?>
					  <option value="<?=$objResult8[0]?>"><?=$objResult8[1]?></option>
							<?php  } ?>
					</select>
					<br>
					<input type="text" class="inputs" style="width:100px;background-color:#D0D0E9;color:#000000;" readonly value="เบอร์โทรศัพท์"> 
					<input name="refer_name_tel" id="refer_name_tel" type="text" style="width:200px;" class="inputs" placeholder="เบอร์โทรศัพท์" required>
					<br>
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="ที่อยู่"> 
					<input name="referaddr_no" id="referaddr_no" type="text" style="width:100px;" class="inputs" placeholder="บ้านเลขที่" required>
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="หมู่"> 
					<input name="referaddr_moo" id="referaddr_moo" type="text" style="width:100px;" class="inputs" placeholder="หมู่ที่" >
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="ซอย"> 
					<input name="referaddr_soi" id="referaddr_soi" type="text" style="width:130px;" class="inputs" placeholder="ซอย"  >
					<br>
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="หมู่บ้าน"> 
					<input name="referaddr_village" id="referaddr_village" type="text" style="width:100px;" class="inputs" placeholder="หมู่บ้าน" >
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="ถนน"> 
					<input name="referaddr_road" id="referaddr_road" type="text" style="width:100px;" class="inputs" placeholder="ถนน"  >
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="จังหวัด"> 
					 <select id="referprovince_code" name="referprovince_code" style="width:130px;" class="inputs" required>
					   <option value="">กรุณาเลือกจังหวัด</option>
					  <?php
						$strSQL_a = "SELECT province_code, province_desc FROM mbucfprovince
						order by province_code ASC";
						$objParse_a = oci_parse($objConnect, $strSQL_a);
						oci_execute ($objParse_a,OCI_DEFAULT);
							while($objResult_a = oci_fetch_array($objParse_a,OCI_ASSOC)){
					  ?>
					  <option value="<?=$objResult_a["PROVINCE_CODE"]?>"><?=$objResult_a["PROVINCE_DESC"]?></option>
							<?php  } ?>
					</select>
					<br>
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="อำเภอ"> 
					 <select id="referamphur_code" name="referamphur_code" style="width:150px;" class="inputs" required>
					 <option value="">กรุณาเลือกอำเภอ</option>
					</select>
					<input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;" readonly value="ตำบล"> 
					 <select id="refertambol_code" name="refertambol_code" style="width:200px;" class="inputs" required>
					 <option value="">กรุณาเลือกตำบล</option>
					</select>
					<br>
					<input type="text" class="inputs" style="width:100px;background-color:#D0D0E9;color:#000000;" readonly value="รหัสไปรษณีย์"> 
					<input name="referaddr_postcode" id="referaddr_postcode" type="text" style="width:120px;" class="inputs" placeholder="รหัสไปรษณีย์" required>
					</fieldset>
         
                        <br>
						
						<input type="hidden" name="doc_no" id="doc_no" >
                                        
                                        <fieldset>
					<legend style="color:#000000;font-size:medium;">ข้อมูลผู้รับผลประโยชน์</legend>
					<table id="gain">
					<thead>
					<tr>
					<th><input type="text" class="inputs" style="width:50px;background-color:#D0D0E9;color:#000000;text-align:center;" readonly value="ลำดับ"> </th>
                                        <th><input type="text" class="inputs" style="width:100px;background-color:#D0D0E9;color:#000000;text-align:center;" readonly value="คำนำหน้า"> </th>
					<th><input type="text" class="inputs" style="width:100px;background-color:#D0D0E9;color:#000000;text-align:center;" readonly value="ชื่อ"> </th>
					<th><input type="text" class="inputs" style="width:100px;background-color:#D0D0E9;color:#000000;text-align:center;" readonly value="นามสกุล"> </th>
					<th><input type="text" class="inputs" style="width:150px;background-color:#D0D0E9;color:#000000;text-align:center;" readonly value="ที่อยู่ผู้รับผลประโยชน์"> </th>
					<th><input type="text" class="inputs" style="width:150px;background-color:#D0D0E9;color:#000000;text-align:center;" readonly value="ความสัมพันธ์"> </th>
					<th><input type="text" class="inputs" style="width:130px;background-color:#D0D0E9;color:#000000;text-align:center;" readonly value="เลขบัตรประชาชน"> </th>
					<th><input type="text" class="inputs" style="width:70px;background-color:#D0D0E9;color:#000000;text-align:center;" readonly value="%"> </th>
					<th><button type="button" id="addgain" style="background-color:#D0D0E9;color:#000000;text-align:center;"> + </button> </th>
					</tr>
					</thead>
					<tbody id="bodygain">
					
					</tbody>
					</table>
					</fieldset>
						   <br>
                          <center><input type="submit" name="button" id="button" value="ตกลง" class="button4" style="width: 104px;"/> 
						  <input type="submit" onclick="location.href='index.php';" value="ยกเลิก" class="button4" style="width: 104px;"/>
						  <input type="submit" onclick="location.href='search_reprint_register.php';" value="Reprint" class="button4" style="width: 104px;"/>
						  <input type="submit" onclick="location.href='set_scale2.pdf';" value="คู่มือการพิมพ์" class="button4" style="width: 104px;"/>
						  </center>
                        
                </form>
				</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td height="120" align="center" background="../img/footer_info_bg.png"><span class="class1"><font size="3" color="#FFFFFF"><strong><?=$title?></strong></font><br/><font size="3" color="#FFFFFF"><?=$address?><br/><?=$credite?></font></span></td>
      </tr>
    </table>     </td>
  </tr>
</table>   
<script>






///เช็คขั้นต่ำหุ้น


$('#periodshare_value').blur(function(){

var periodshare_value = $('#periodshare_value').val();
var salary_amt = $('#salary_amt').val();

periodshare_value = periodshare_value.replace(",", "");
periodshare_value = periodshare_value.replace(".00", "");

salary_amt = salary_amt.replace(",", "");
salary_amt = salary_amt.replace(".00", "");

if(salary_amt <= 10000 ){

    if(periodshare_value > 99){
     
	}else{
	  
	  alert("หุ้นขั้นต่ำของฐานเงินเดือนท่านต้องไม่ต่ำกว่า 100.00");
	  $('#periodshare_value').val(100);
	  }
	  
}else if(salary_amt > 10000 && salary_amt < 20001){

if(periodshare_value > 199){
     
	}else{
	  
	  alert("หุ้นขั้นต่ำของฐานเงินเดือนท่านต้องไม่ต่ำกว่า 200.00");
	  $('#periodshare_value').val(200);
	  
	  }

}else if(salary_amt > 20000 && salary_amt < 50001){

if(periodshare_value > 499){
     
	}else{
	  
	  alert("หุ้นขั้นต่ำของฐานเงินเดือนท่านต้องไม่ต่ำกว่า 500.00");
	  $('#periodshare_value').val(500);
	  
	  }

}else if(salary_amt > 50000){

if(periodshare_value > 999){
     
	}else{
	  
	  alert("หุ้นขั้นต่ำของฐานเงินเดือนท่านต้องไม่ต่ำกว่า 1,000.00");
	  $('#periodshare_value').val(1000);
	  
	  }

}

});


$(document).ready(function(){
     $('#copyaddress').click(function(){
        var memb_addr = $('#memb_addr').val();
        var addr_group = $('#addr_group').val();
        var soi = $('#soi').val();
        var mooban = $('#mooban').val();
        var road = $('#road').val();
        var province_code = $('#province_code').val();
        var district_code = $('#district_code').val();
        var tambol_code = $('#tambol_code').val();
        var postcode = $('#postcode').val();
        $('#curraddr_no').val(memb_addr)
        $('#curraddr_moo').val(addr_group)
        $('#curraddr_soi').val(soi)
        $('#curraddr_village').val(mooban)
        $('#curraddr_road').val(road)
        $('#'+province_code).prop("selected",true)
        $.post('../s/s.district.php',{
            province : province_code
        },function(data){
            $('#curramphur_code').html(data);
            var val2 = $('#curramphur_code').val(); 
            val2 = district_code;
            $.post('../s/s.district.php',{
            district : val2,
            tambol_old : tambol_code
            },function(data){
                console.log(data);
                $('#currtambol_code').html(data);
                $.post('../s/s.district.php',{
                district2 : val2,
                province2 : province_code
                },function(data){
                    $('#curraddr_postcode').val(postcode);
                });
            });
            //alert(tambol_code);
       // $('#currtambol_code').val(tambol_code)
        $('#curramphur_code').val(district_code);
       
            
            
        });
    });
	$('#birth_date').blur(function(){
		var birth = $('#birth_date').val();
		var slash = birth.indexOf('/')
		if(slash == -1){
			var one = birth.substr(0,2);
			var two = birth.substr(2,2);
			var three = birth.substr(4,4);
			var value = one+'/'+two+'/'+three
			$('#birth_date').val(value)
		}
	})
	$('#work_date').blur(function(){
		var birth = $('#work_date').val();
		var slash = birth.indexOf('/')
		if(slash == -1){
			var one = birth.substr(0,2);
			var two = birth.substr(2,2);
			var three = birth.substr(4,4);
			var value = one+'/'+two+'/'+three
			$('#work_date').val(value)
		}
	})
	
	$('#work_str_date').blur(function(){
		var birth = $('#work_str_date').val();
		var slash = birth.indexOf('/')
		if(slash == -1){
			var one = birth.substr(0,2);
			var two = birth.substr(2,2);
			var three = birth.substr(4,4);
			var value = one+'/'+two+'/'+three
			$('#work_str_date').val(value)
		}
	})
	$('#formarray').on('submit', function(e){
	e.preventDefault();
		var size = $('.mbgain').length;
		var j = 1; 
		var arr = []
		$.when($('.mbgain').each(function(){
             
                  
                    
			var seq_no = $('#seq_no'+j).val();
                        var prename_code = $('#prename_code'+j).val();
			var gain_name = $('#gain_name'+j).val();
			var gain_surname = $('#gain_surname'+j).val();
			var gain_addr = $('#gain_addr'+j).val();
			var gain_relation = $('#gain_relation'+j).val();
			var gaincard_person = $('#gaincard_person'+j).val();
			var gain_percent = $('#gain_percent'+j).val();
			var gain = jQuery.parseJSON( '{ "seq_no": "'+seq_no+'","prename_code": "'+prename_code+'","gain_name": "'+gain_name+'","gain_surname": "'+gain_surname+'","gain_addr": "'+gain_addr+'","gain_relation": "'+gain_relation+'","gaincard_person": "'+gaincard_person+'","gain_percent": "'+gain_percent+'" }' );
			arr.push(JSON.stringify('{ "seq_no": "'+seq_no+'","prename_code": "'+prename_code+'","gain_name": "'+gain_name+'","gain_surname": "'+gain_surname+'","gain_addr": "'+gain_addr+'","gain_relation": "'+gain_relation+'","gaincard_person": "'+gaincard_person+'","gain_percent": "'+gain_percent+'" }' )
			)
                        
  			
			$.ajax({
                type: "POST",
				url: "insert_req_gian.php",
				data: { "mbgain": gain },
				success: function(data){
					
					$('#doc_no').val(data)
					
                    console.log(j)
				}
			});
			j++;
		})).done(
			setTimeout(function (){
			if(size == j-1){
							sessionStorage.setItem('mbgain', arr);
							sessionStorage.setItem('sizeArr', size);
							$('#formarray').unbind('submit').submit();
				}
				console.log('Size :' + size + 'j :' + j)
			}, 2000)
		)
			  
	})
	
	
   var i = 1;
   var percent = 100;
    $('#addgain').click(function(){
		$.post('../s/s.mbgain.php',{
			row : i
		},function(data2){
		
		$.post('../s/s.mbgain_prename.php',{
			row : i
		},function(data){
			percent = 100 / i;
		$('input[name*="gain_percent"]').val(Math.floor(percent));
		$('#bodygain').append( '<tr id="tr'+i+'" class="mbgain">'+
		'<td><input type="text" class="inputs" style="width:50px;text-align:center;" id="seq_no'+i+'" name="seq_no" value="'+i+'"></td>'+
                '<td id="prename_code_gain'+i+'" ></td>'+
		'<td><input type="text" class="inputs" style="width:100px;text-align:center;" id="gain_name'+i+'" name="gain_name" onkeypress="return handleEnter(this, event)" required></td>'+
		'<td><input type="text" class="inputs" style="width:100px;text-align:center;" id="gain_surname'+i+'" name="gain_surname" onkeypress="return handleEnter(this, event)" required></td>'+
		'<td><input type="text" class="inputs" style="width:150px;text-align:center;" id="gain_addr'+i+'" name="gain_addr" onkeypress="return handleEnter(this, event)" required></td>'+
		'<td id="relation'+i+'" ></td>'+
		'<td><input type="text" class="inputs" style="width:130px;text-align:center;" id="gaincard_person'+i+'" name="gaincard_person" onkeypress="return handleEnter(this, event)" required></td>'+
		//'<td><input type="text" class="inputs" style="width:70px;text-align:center;" id="gain_percent'+i+'" name="gain_percent" value="'+Math.floor(percent)+'"></td>'+
		'<td><input type="text" class="inputs per percent'+i+'" style="width:70px;text-align:center;" id="gain_percent'+i+'" name="gain_percent" value="'+Math.floor(percent)+'" onkeypress="return handleEnter(this, event)" ></td>'+
		'<td><button type="button" data-id="tr'+i+'" class="delgain" > ลบ </button></td>'+
		'</tr>' );
		$('#relation'+i).html(data2);
                $('#prename_code_gain'+i).html(data);
		i++;
		});
                	});
	});
	
	////
	
	
	$('#bodygain').delegate('.per','change',function(){
		var x = 1;
		var total = 0;
		$.when($('.mbgain').each(function(){
			total += parseInt($('.percent'+x).val());
			x++;
		})).done(
		function(){
			if(total > 100){
				alert("ผลรวมเกิน 100% กรุณากรอก % ใหม่");
				var size = $('.mbgain').length;
				var percent = 100 / size;
				$('.per').val(percent);
			}
			}
		)
	});
	
	////
	
	$('#bodygain').delegate('button','click',function(){
		i--;
		$('#tr'+i).remove();
		percent = 100 / (i-1);
		$('input[name*="gain_percent"]').val(Math.floor(percent));
		console.log(percent);
	});
	
	 $('#salary_amt').blur(function(){
            var salary = $(this).val();
            var salarydot = salary.replace(/,/g, '')
            var res = salarydot.indexOf('.');
            var dot = salarydot.split(".");
             console.log(dot)
            if(res == '-1'){
               var total = dot[0].split(/(?=(?:\d{3})+$)/).join(",") + ".00";
            }else{
               var total = dot[0].split(/(?=(?:\d{3})+$)/).join(",") +"."+ dot[1];
            }
            console.log(res)
            $('#salary_amt').val(total);
        })
        
        $('#periodshare_value').blur(function(){

            var periodshare_value = $(this).val();
            var periodshare_valuedot = periodshare_value.replace(/,/g, '')
            var res = periodshare_valuedot.indexOf('.');
            var dot = periodshare_valuedot.split(".");
             console.log(dot)
            if(res == '-1'){
               var total = dot[0].split(/(?=(?:\d{3})+$)/).join(",") + ".00";
            }else{
               var total = dot[0].split(/(?=(?:\d{3})+$)/).join(",") +"."+ dot[1];
            }
            console.log(res)
            $('#periodshare_value').val(total);
        })
   
	 $('#salary_amt').change(function(){

		var salary_amt = $('#salary_amt').val();
		$.post('../s/s.shsharetype.php',{
			salary_amt : salary_amt
		},function(data){
			var obj = JSON.parse(data);
                        
                        $('#periodshare_value').val(obj.periodshare_value);
                        
                        });
                    });
    
	$('#member_no').change(function(){

		var member_no = $('#member_no').val();
		$.post('../s/s.retrivemember.php',{
			member_no : member_no
		},function(data){
			var obj = JSON.parse(data);
			
			if(obj.emp_name == "-9" || obj.emp_ename == "-9" || obj.emp_esurname == "-9" || obj.prename == "-9" || obj.emp_surname == "-9" || obj.sex == "-9" || obj.adn_email == "-9" || obj.id_card == "-9" || obj.salary_amt == "-9" || obj.birth_date == "-9" || obj.contain_date == "-9" || obj.nation == "-9" || obj.level_code == "-9" || obj.membgroup_code == "-9" || obj.adn_tel == "-9" || obj.adn_postcode == "-9" || obj.work_str_date == "-9" || obj.position_work == "-9" || obj.province_code == "-9" || obj.district_code == "-9" || obj.tambol_code == "-9" || obj.position_code == "-9"){
			
			    
				alert("ไม่สามารถสมัครสมาชิกได้ เนื่องจากอายุงานไม่ครบ 120 วัน  !! ");
	

			
			}else  if (obj.emp_name == "0" || obj.emp_ename == "0" || obj.emp_esurname == "0" || obj.prename == "0" || obj.emp_surname == "0" || obj.sex == "0" || obj.adn_email == "0" || obj.id_card == "0" || obj.salary_amt == "0" || obj.birth_date == "0" || obj.contain_date == "0" || obj.nation == "0" || obj.level_code == "0" || obj.membgroup_code == "0" || obj.adn_tel == "0" || obj.adn_postcode == "0" || obj.work_str_date == "0" || obj.position_work == "0" || obj.province_code == "0" || obj.district_code == "0" || obj.tambol_code == "0" || obj.position_code == "0"){
				
				alert("เลขพนักงานได้ทำการสมัครใบคำขอไปเเล้ว  !! ");
				
			}else  if (obj.emp_name == "8" || obj.emp_ename == "8" || obj.emp_esurname == "8" || obj.prename == "8" || obj.emp_surname == "8" || obj.sex == "8" || obj.adn_email == "8" || obj.id_card == "8" || obj.salary_amt == "8" || obj.birth_date == "8" || obj.contain_date == "8" || obj.nation == "8" || obj.level_code == "8" || obj.membgroup_code == "8" || obj.adn_tel == "8" || obj.adn_postcode == "8" || obj.work_str_date == "8" || obj.position_work == "8" || obj.province_code == "8" || obj.district_code == "8" || obj.tambol_code == "8" || obj.position_code == "8"){
				
				alert("ท่านยังลาออกไม่ครบ 6 เดือนไม่สามารถสมัครใบคำขอได้  !! ");
				
			}else{
				
				$('#'+obj.prename).prop("selected",true);
			$('#emp_name').val(obj.emp_name);
			$('#emp_surname').val(obj.emp_surname);
			$('#emp_ename').val(obj.emp_ename);
			$('#emp_esurname').val(obj.emp_esurname);
			$('#'+obj.sex).prop("selected",true);
			$('#email_address').val(obj.adn_email);
			$('#card_person').val(obj.id_card);
			$('#salary_amt').val(obj.salary_amt);
			$('#birth_date').val(obj.birth_date);
			$('#work_date').val(obj.contain_date);
			$('#nationality').val(obj.nation);
			$('#'+obj.level_code).prop("selected",true);
			$('.'+obj.membgroup_code).prop("selected",true);
			$('#mem_telmobile').val(obj.adn_tel);
			$('#postcode').val(obj.adn_postcode);
			$('#work_str_date').val(obj.work_str_date);
			$('#position_work').val(obj.position_work);
			$('.pos'+obj.position_code).prop("selected",true);
			$('.p'+obj.province_code).prop("selected",true);
			
			
		   var val3 = obj.province_code;   /// ดึง auto 
			$.post('../s/s.district.php',{
			province : val3,
			district_old: obj.district_code
			},function(data){
				$('#district_code').html(data);
			});
		
			var val2 = obj.district_code;  /// ดึง auto 
			$.post('../s/s.district.php',{
			district : val2,
			tambol_old: obj.tambol_code
			},function(data){
				$('#tambol_code').html(data);
			});
			
			// enabled text
			
		document.getElementById("emp_name").disabled = false;
	    document.getElementById("emp_surname").disabled = false;
		document.getElementById("emp_ename").disabled = false;
		document.getElementById("emp_esurname").disabled = false;
		document.getElementById("position_work").disabled = false;
		document.getElementById("birth_date").disabled = false;
		document.getElementById("nationality").disabled = false;
		document.getElementById("card_person").disabled = false;
		document.getElementById("salary_amt").disabled = false;
		document.getElementById("work_str_date").disabled = false;
		document.getElementById("work_date").disabled = false;
		document.getElementById("periodshare_value").disabled = false;
		document.getElementById("expense_accid").disabled = false;
		document.getElementById("memb_addr").disabled = false;
		document.getElementById("addr_group").disabled = false;
		document.getElementById("soi").disabled = false;
		document.getElementById("mooban").disabled = false;
		document.getElementById("road").disabled = false;
		document.getElementById("postcode").disabled = false;
		document.getElementById("email_address").disabled = false;
		document.getElementById("mem_tel").disabled = false;
		document.getElementById("email_address").disabled = false;
		document.getElementById("mem_tel").disabled = false;
		document.getElementById("mem_telmobile").disabled = false;
		document.getElementById("curraddr_no").disabled = false;
		document.getElementById("curraddr_moo").disabled = false;
		document.getElementById("curraddr_soi").disabled = false;
		document.getElementById("curraddr_village").disabled = false;
		document.getElementById("curraddr_road").disabled = false;
		document.getElementById("curraddr_postcode").disabled = false;
		document.getElementById("refer_name").disabled = false;
		document.getElementById("refer_name_tel").disabled = false;
		document.getElementById("referaddr_no").disabled = false;
		document.getElementById("referaddr_moo").disabled = false;
		document.getElementById("referaddr_soi").disabled = false;
		document.getElementById("referaddr_village").disabled = false;
		document.getElementById("referaddr_road").disabled = false;
		document.getElementById("referaddr_postcode").disabled = false;

			}
		});
	});
	$('#province_code').change(function(){
		var val = $('#province_code').val();
		$.post('../s/s.district.php',{
			province : val
		},function(data){
			$('#district_code').html(data);
			var val2 = $('#district_code').val();
			$.post('../s/s.district.php',{
			district : val2
			},function(data){
				$('#tambol_code').html(data);
				$.post('../s/s.district.php',{
				district2 : val2,
				province2 : val
				},function(data){
					$('#postcode').val(data);
				});
			});
		});
	});
	$('#district_code').change(function(){
		var val2 = $('#province_code').val();
		var val = $('#district_code').val();
		$.post('../s/s.district.php',{
			district : val
		},function(data){
			$('#tambol_code').html(data);
				$.post('../s/s.district.php',{
				district2 : val,
				province2 : val2
				},function(data){
					$('#postcode').val(data);
				});
		});
	});
	
	
	 $('#currprovince_code').change(function(){
		var val = $('#currprovince_code').val();
		$.post('../s/s.district.php',{
			province : val
		},function(data){
			$('#curramphur_code').html(data);
			var val2 = $('#curramphur_code').val();
			$.post('../s/s.district.php',{
			district : val2
			},function(data){
				$('#currtambol_code').html(data);
				$.post('../s/s.district.php',{
				district2 : val2,
				province2 : val
				},function(data){
					$('#curraddr_postcode').val(data);
				});
			});
		});
	});
	$('#curramphur_code').change(function(){
		var val2 = $('#currprovince_code').val();
		var val = $('#curramphur_code').val();
		$.post('../s/s.district.php',{
			district : val
		},function(data){
			$('#currtambol_code').html(data);
				$.post('../s/s.district.php',{
				district2 : val,
				province2 : val2
				},function(data){
					$('#curraddr_postcode').val(data);
				});
		});
	});
        
        $('#referprovince_code').change(function(){
		var val = $('#referprovince_code').val();
		$.post('../s/s.district.php',{
			province : val
		},function(data){
			$('#referamphur_code').html(data);
			var val2 = $('#referamphur_code').val();
			$.post('../s/s.district.php',{
			district : val2
			},function(data){
				$('#refertambol_code').html(data);
				$.post('../s/s.district.php',{
				district2 : val2,
				province2 : val
				},function(data){
					$('#referaddr_postcode').val(data);
				});
			});
		});
	});
	$('#referamphur_code').change(function(){
		var val2 = $('#referprovince_code').val();
		var val = $('#referamphur_code').val();
		$.post('../s/s.district.php',{
			district : val
		},function(data){
			$('#refertambol_code').html(data);
				$.post('../s/s.district.php',{
				district2 : val,
				province2 : val2
				},function(data){
					$('#referaddr_postcode').val(data);
				});
		});
	});
        
	$('#expense_bank').change(function(){
		var val = $('#expense_bank').val();
		$.post('../s/s.branch.php',{
			bank : val
		},function(data){
			$('#expense_branch').html(data);
		});
	});
	$('#card_person').change(function(){
		var val = $('#card_person').val();
		$.post('../s/s.countcard.php',{
			card_person : val
		},function(data){
			if(data=='1'){
				alert("หมายเลขบัตรประชาชนของท่านซ้ำ !! ");
				$('#card_person').css("border-color","red");
				$('#button').prop("disabled",true);
			}else{
				$('#card_person').css("border-color","");
				$('#button').prop("disabled",false);
			}
		});
	});
		$('#button').click(function(){
		var val = $('#card_person').val();
		$.post('../s/s.countcard.php',{
			card_person : val
		},function(data){
			if(data=='1'){
				alert("หมายเลขบัตรประชาชนของท่านซ้ำ !! ");
				$('#card_person').css("border-color","red");
				return false;
			}else{
				$('#card_person').css("border-color","");
				return true;
			}
		});
	});
	
	///////

	
});
</script>



<?php }else{ 
	require "../include/lib.Etc.php";
	require "../include/lib.MySql.php";
	require "../include/lib.Oracle.php";
	require "../lib/login.php";
	 }
 ?>





</body>
</html>
