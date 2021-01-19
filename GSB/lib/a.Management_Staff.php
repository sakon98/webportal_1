<?php
session_start();
header('Content-Type: text/html; charset=tis-620');
?>
<?php 
if($_POST["userid"] == "userid"){
	//$staff_name =  $_POST["staff_name"];
	$staff_user =  $_POST["staff_user"];
	//$staff_pwd =  $_POST["staff_pwd"];
	//$re_pwd =  $_POST["re_pwd"];

	$strSQL = "select count(staff_user) as staff_user from staff_info where staff_user = '$staff_user' "; 		
	$value = "staff_user"; 
	$intableuser = get_single_value_sql($strSQL,$value);
	
	
	if($intableuser > 0 ){ // ซ้ำอย่างใดอย่างหนึ่ง	
		return "1";
	}

	
}else if($_POST["username"] == "username"){
	$staff_name =  $_POST["staff_name"];
	$strSQL = "select count(staff_name) as staff_name  from staff_info where staff_user = '$staff_name' "; 		
	$value = "staff_name"; 
	$intablename = get_single_value_sql($strSQL,$value);
	if( $intablename >0){ // ซ้ำอย่างใดอย่างหนึ่ง	
		return "1";
	}
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <link rel="stylesheet" href="../css/validationEngine.jquery.css" type="text/css">
	<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />	
    <script type="text/javascript" src="../js/jquery.min.js"></script>
	<script src="../js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="tis-620"></script>
	<script src="../js/jquery.validationEngine.js" type="text/javascript" charset="tis-620"></script>
	
<?php require "../include/conf.d.php" ?>
<?php require "../include/jquery.popup.php"; ?>
<script type="text/javascript">
				jQuery(document).ready(function(){
						jQuery("#formID1").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});
			});
			
			$(function(){
				$("#staff_name").change(ajaxusername);
				$("#staff_user").change(ajaxuserid);
			});
				
				function ajaxuserid(){
						$.post('a.Management.php',
							{
							userid : "userid",
							staff_user : $("#staff_user").val()
							},
							function(text){
								alert(text)
								if(text == "1"){
									alert($("#staff_user").val() + " ซ้ำ"  );
									$("#staff_user").val("");
								}
							}
						)
				}
				
				function ajaxusername(){
					$.post('a.Management.php',
						{
							username : "username",
							staff_name : $("#staff_name").val()
						},
						function(text){
							alert(text)
							if(text == "1"){
								alert($("#staff_name").val() + " ซ้ำ"  );
								$("#staff_name").val("")
							}
						}
					)
				}
     </script>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="97%" align="left"><strong><font size="4" face="Tahoma">ระบบจัดการผู้ดูแล</font></strong><br />
    <font face="Tahoma" size="2" color="#FF6600">Administrator Management</font></td>
    <td width="3%" align="right"><strong><font size="4" face="Tahoma"><a class="popup-alink-1"><b><img src="../img/find.png" width="25" height="26" /></b></a></font></strong></td>
  </tr>
    <tr>
    <td colspan="2" align="right"><hr color="#999999" size="1"/></td>
  </tr>
  </table>


<form id="formID1" name="formID1" method="post" action="">
  <table width="400" border="0" align="center" cellpadding="6" cellspacing="2">
    <tr>
      <td colspan="2" align="center"><strong><font size="2" face="Tahoma, Geneva, sans-serif">เพิ่มผู้ดูแลระบบ</font></strong></td>
    </tr>
    <tr>
      <td align="right">ชื่อเรียก :</td>
      <td align="left"><input name="staff_name" type="text" class="validate[required,minSize[8]]" id="staff_name" size="25" maxlength="13" autocomplete="off" /></td>
    </tr>
    <tr>
      <td align="right">USER :</td>
      <td align="left"><input name="staff_user" type="text" class="validate[required,minSize[8]]" id="staff_user" size="25" maxlength="13" autocomplete="off" /></td>
    </tr>
    <tr>
      <td width="140" align="right">รหัสใหม่ :</td>
      <td width="280" align="left"><input name="npwd" type="password" class="validate[required,minSize[8]]" id="npwd" size="25" maxlength="13" autocomplete="off" /></td>
    </tr>
    <tr>
      <td align="right">ยืนยันรหัสใหม่ :</td>
      <td align="left"><input name="npwd1" type="password" class="validate[required,equals[npwd]]" id="npwd1" size="25" maxlength="13" autocomplete="off" /></td>
    </tr>
  </table>
  <hr align="center" size="1"  color="#999999" style="width:95%"/>
  <table width="400" border="0" align="center" cellpadding="6" cellspacing="2">
    <tr>
      <td align="center"><strong>โปรยึนยันโดยการใช้รหัส Main Administrator</strong></td>
    </tr>
    <tr>
      <td align="center"><label for="textfield"></label>
      <input name="mainadmin" type="password" class="validate[required]" id="mainadmin" size="25" maxlength="13" autocomplete="off"></td>
    </tr>
    <tr>
      <td align="center"><input type="submit" name="button" id="button" value="ยืนยัน" />
      <input name="ChkPwd" type="hidden" id="ChkPwd" value="ChkPwd" /></td>
    </tr>
  </table>
</form>
</form>
    <div class="popup-box" id="popup-abox-1">
      <div class="close">X</div>
		<div class="top" align="left">
			<strong><font size="4" face="Tahoma">เพิ่มผู้ดูแลระบบ</font></strong><br />
			<font face="Tahoma" size="2" color="#FF6600">Add New Administrator</font>           
		</div>
        <form id="formID1" name="formID1" method="post" action="">
        <div class="bottom">
            <div class="mask">
                <div class="colleft">
                    <div class="col1"><input type="text" name="staff_name" id="staff_user" size="35" cla/></div>
                    <div class="col2">ชื่อเรียก :  </div> 
                    <div class="col1"><input type="text" name="staff_user" id="staff_user" size="35" /></div>
                    <div class="col2">รหัสผู้ใช้ :  </div> 
                    <div class="col1"><input type="password" name="staff_pwd" id="staff_pwd" size="35" /></div>
                    <div class="col2">รหัสผ่าน :  </div> 
                    <div class="col1"><input type="password" name="re_pwd" id="re_pwd"  size="35"/></div>
                    <div class="col2">ยืนยันรหัสผ่าน :  </div> 
                </div>
                <center> <input type="submit" name="button" id="button" value="เพิ่มผู้ดูแล" class="button1" /></center>
            </div>			
			
         </div>
       </form>
    </div><div id="blackout"></div>



