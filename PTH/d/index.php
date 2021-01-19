<?php
session_start();
header('Content-Type: text/html; charset=tis-620');
require "../include/conf.conn.php";
require "../include/conf.c.php";
$connectby = "desktop";
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$title?></title>
	<link href="../css/jquery-ui-1.10.4.css" rel="stylesheet">
	<link rel="shortcut icon" href="../img/logo.png">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <script src="../js/jquery.js"></script>
	<script src="../js/index.js"></script>
	
	<script type="text/javascript">

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
<body>
<?php require "../include/conf.d.php" ?>
<?php if($_REQUEST["usr"] == null or $_REQUEST["pwd"] == null){ ?>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="middle" background="../img/bg_gsb.jpg">
    <table width="995" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#fff">
      <tr>
        <td height="120" background="../img/head_info_bg.png">
<table width="994" border="0" cellspacing="3" cellpadding="0">
          <tr>
            <td width="140" height="100" align="right"><img src="../img/logo.png" width="110" height="100"></td>
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
            <td width="580" align="center">
		<!--<br><br><br><br><img src="../img/confirm.png" border="0"><br><br><br><br><br><br>-->
		</td>
            <td align="center"><table width="350" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left" bgcolor="<?=$bg_login_color?>">&nbsp;</td>
              </tr>
              <tr>
                <td height="35" align="center" bgcolor="<?=$bg_bar_login_color?>"><font face='Tahoma' size="4" color="<?=$font_bar_login_color?>"><strong>
                  <?=$sub_title?>
                </strong></font></td>
              </tr>
              <tr>
                <td align="left" bgcolor="<?=$bg_login_color?>"><form name="formID1" method="post" action="" id="formID1">
                  <table width="400" border="0" align="center" cellpadding="0" cellspacing="8">
                    <tr>
                        <td><font color="#FFFFFF">ทะเบียนสมาชิก : </font></td>
                      <td><input name="usr" type="text"class="inputs" id="usr" placeholder="ทะเบียนสมาชิก" maxlength="8" autocomplete="off" required/></td>
					  <!-- onkeypress="return handleEnter(this, event)" ไม่ให้ enter submit -->
                    </tr>
                    <tr>
                        <td><font color="#FFFFFF">รหัสผ่าน : </font></td>
                      <td><input name="pwd" type="password"class="inputs" id="pwd" placeholder="รหัสผ่าน"   maxlength="8"  autocomplete="off" required/></td>
                    </tr>
                    <tr>
                         <td></td>
                      <td><input name="Submit" id = "Submit" type="submit" value="เข้าสู่ระบบ" class="button1">
                        <input name="button" type="reset" value="ยกเลิก" class="button2"></td>
                    </tr>
                    <tr>
                         <td></td>
                      <td><span class="class1">
                        <?php if($connection == 0){ ?>
                        <font face='Tahoma' size="3"><a href="register.php">สมัครใช้บริการ</a></font>
	          &nbsp;&nbsp;&nbsp;&nbsp;
	        <font face='Tahoma' size="3"><a href="for_got_your_password.php">ลืมรหัสผ่าน</a></font>
                        <?php } ?>
                      </span></td>
                    </tr>
                  </table>
                </form></td>
              </tr>
              <tr>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <!--<td align="center"><a href="browser.html" target="_blank" alt="คลิกเพื่ออ่าน"><img src="../img/extra_btn.png" border="0"></a></td>-->
              </tr>
            </table></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td height="120" align="center" background="../img/footer_info_bg.png"><span class="class1"><font size="2" color="#FFFFFF"><strong><?=$title?></strong></font><br/><font size="2" color="#FFFFFF"><?=$address?><br/><?=$credite?></font></span></td>
      </tr>
    </table>     </td>
  </tr>
</table>
<?php }else{ 
	require "../include/lib.Etc.php";
	require "../include/lib.MySql.php";
	require "../include/lib.Oracle.php";
	require "../lib/login.php";
	 }
 ?>
 <script>
 $(document).ready(function(){
	
	$('#usr').val(sessionStorage.getItem('usr'));
	$('#pwd').val(sessionStorage.getItem('pwd'));
	$('#usr').focus();
	
 })
 document.addEventListener('keydown', function(event) { 
 if(event.keyCode == 9){
 event.preventDefault()
 var length = $('#pwd').val().length
		if(length == 0){
		event.preventDefault()
		if($('#usr').val() != ''){
			event.preventDefault()
			alert('กรุณากรอกรหัสผ่าน 8 หลัก')
			$('#pwd').focus();
		}
		
		}else if(length < 8){
		 event.preventDefault()
			alert('กรุณากรอกรหัสผ่าน 8 หลัก')
			$('#pwd').focus();
		}else if(length == 8){
			
			sessionStorage.setItem('usr',$('#usr').val()) ;
			sessionStorage.setItem('pwd',$('#pwd').val());
			$('#formID1').submit()
		
			
		}
 }else if(event.keyCode == 13){
		var length = $('#pwd').val().length
		if(length == 0){
		event.preventDefault()
		if($('#usr').val() != ''){
			event.preventDefault()
			alert('กรุณากรอกรหัสผ่าน 8 หลัก')
			$('#pwd').focus();
		}
		
		}else if(length < 8){
		 event.preventDefault()
			alert('กรุณากรอกรหัสผ่าน 8 หลัก')
			$('#pwd').focus();
		}else if(length == 8){
		
	
            sessionStorage.setItem('usr',$('#usr').val()) ;
			sessionStorage.setItem('pwd',$('#pwd').val());
		
			$('#formID1').submit()
			
			
			
		}
 }
 })
 $('#Submit').click(function() {
	var length = $('#pwd').val().length
		if(length == 0){
		event.preventDefault()
		if($('#usr').val() != ''){
			event.preventDefault()
			alert('กรุณากรอกรหัสผ่าน 8 หลัก')
			$('#pwd').focus();
		}
		
		}else if(length < 8){
		 event.preventDefault()
			alert('กรุณากรอกรหัสผ่าน 8 หลัก')
			$('#pwd').focus();
		}else if(length == 8){
		
		
			sessionStorage.setItem('usr',$('#usr').val()) ;
			sessionStorage.setItem('pwd',$('#pwd').val());
		
			$('#formID1').submit()
			
		}
 })
/* 
 $('#usr').change(function(){
	var length = $(this).val().length
	if(length < 8 && length > 0){
		alert('กรุณากรอกเลขทะเบียนสมาชิก 8 หลัก')
		$('#pwd').attr('readonly',true)
		$('#usr').focus();
	}else{
	
	$('#pwd').attr('readonly',false)
	}
 })
 */
</script>
 
</body>
</html>
