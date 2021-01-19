<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <link rel="stylesheet" href="../css/validationEngine.jquery.css" type="text/css">
	<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />	
    <script src="../js/jquery-1.6.min.js" type="text/javascript"></script>
	<script src="../js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="tis-620"></script>
	<script src="../js/jquery.validationEngine.js" type="text/javascript" charset="tis-620"></script>
	<script type="text/javascript">
		jQuery(document).ready(function(){
						jQuery("#formID1").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});
		});
		function popup_statment(form) {
			var w = 910;
			var h = 530;
			var left = (screen.width/2)-(w/2);
			var top = (screen.height/3)-(h/3);
			 window.open ('', 'formpopup', 'toolbar=no, location=no, directories=no, status=no, menubar=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
				 form.target = 'formpopup';
			} 
	</script>

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"><strong><font size="4" face="Tahoma">เพิ่มข่าวสารประกาศ</font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Editor News</font></td>
  </tr>
  <tr>
    <td align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<form action="../lib/a.News_editer_add.php" method="post" name="formID1" id="formID1" onsubmit="popup_statment(this);">
  <table width="630" border="0" align="center" cellpadding="2" cellspacing="2">
    <tr>
      <td height="25" colspan="2" align="left"><strong>เพื่มข่าวสารประกาศหน้าระบบสมาชิก</strong></td>
    </tr>
    <tr>
      <td width="94" align="right" valign="top">หัวเรื่อง :</td>
      <td width="522" align="left"><textarea name="topic" rows="2" class="validate[required,minSize[15]]" id="topic" style="width:95%" ></textarea></td>
    </tr>
    <tr>
      <td align="right" valign="top">รายละเอียด :</td>
      <td align="left" valign="top"><textarea name="details"  rows="10" class="validate[required,minSize[15]]" id="details" style="width:95%" autocomplete="off"></textarea></td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="top"><input type="submit" name="button" id="button" value="เพิ่มประกาศ" />
      <input type="reset" name="button2" id="button2" value="ยกเลิก" /></td>
    </tr>
  </table>
</form>
