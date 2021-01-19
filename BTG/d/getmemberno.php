<?php
session_start();
header('Content-Type: text/html; charset=tis-620');
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

</head>
<body>
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
					<?=$sub_title1?>
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

        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="6">
          <tr>
            <td align="center"><table width="75%" border="1" align="center" bordercolor = "#0000FF" cellpadding="20" cellspacing="0">
					<tr><td><B>
              **เงื่อนไขการดึงเลขทะเบียน**<br><br>

					1. ทำการกรอกรหัสบัตรประชาชน <br>
					2. ทำการกรอกวันเกิดของท่าน<br>
					3. เมื่อกรอกครบทุกช่องเเล้วเลือกตกลง ระบบจะ เเสดงเลขทะเบียนของท่าน<br>
					</td></tr></table>
			</td>
          </tr>
          <tr>
            <td align="center">
            <form name="formID1" id="formID1" method="post" action="" >
              <table width="70%" border="0" align="center" cellpadding="2" cellspacing="2">
                <tr>
                  <td align="right"><font face="Tahoma" size="2"><strong><strong>เลขที่บัตรประชาชน :</strong></strong></font></td>
                  <td><input name="idchk" type="text" class="validate[required,custom[integer],minSize[5]]" id="idchk" size="20" maxlength="13" autocomplete="off" style="width: 161px;"/></td>
                </tr>
                <tr>
                  <td align="right"><font face="Tahoma" size="2"><strong><strong>วันเกิด :</strong></strong></font></td>
                  <td><input name="idhbd" type="text" id="idhbd" size="20" maxlength="13" autocomplete="off" style="width: 161px;"/> <font color="#0000FF">** ตัวอย่างเช่น 22112523 (วันเดือนปี(พ.ศ))</font></td>
                </tr>
                <tr>
                  <td align="right">&nbsp;</td>
                  <td> <input type="submit" name="button" id="button" value="ตกลง" />
                    <input name="ยกเลิก" type="reset" id="ยกเลิก" onclick="location.href='index.php'" value="ยกเลิก" />
                </tr>
              </table>
            </form>
            </td>
          </tr>
        </table>
<?php
if($_POST["button"] == "ตกลง"){
    
     
    $idhbd = $_POST["idhbd"];
    $idchk = $_POST["idchk"];
 	 
					 $strSQL = "SELECT MB.MEMBER_NO
				FROM 
					MBMEMBMASTER MB
				WHERE 
					MB.CARD_PERSON = '$idchk' AND MB.RESIGN_STATUS <> '1' AND TO_CHAR(MB.BIRTH_DATE, 'DDMMYYYY','NLS_CALENDAR=''THAI BUDDHA') = '$idhbd' ";
					$value = array('MEMBER_NO');
					list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
					$j=0;
					for($i=0;$i<$Num_Rows;$i++){
						$member_no = $list_info[$i][$j++];
						$j=0;
					}
				
	
        $check_member_no = true;	

       
	if($member_no == "" || $member_no == null){ // ไม่พบทะเบียน
		$check_member_no = false;
		echo '<script type="text/javascript"> window.alert("กรอกข้อมูลไม่ถูกต้อง ไม่พบทะเบียน") </script> ';
		echo "<script>window.location = 'getmemberno.php'</script>";
		exit;
	}else{ ?>
            
            
            
         <table width="70%" border="0" align="center" cellpadding="2" cellspacing="2">
                <tr>
                  <td style=" width: 176px;" align="right"><font face="Tahoma" size="2"><strong><strong>เลขทะเบียน :</strong></strong></font></td>
                  <td><input name="member_no" type="text" id="member_no" size="20" maxlength="13" autocomplete="off" style="width: 161px;" value="<?php echo $member_no ?>" readonly/></td>
                </tr>
              </table>
            
            
      <?php  }
        
      
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

