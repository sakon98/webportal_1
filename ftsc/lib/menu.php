<?php @header('Content-Type: text/html; charset=tis-620'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<span class="class1">
<table width="100%" border="0" cellspacing="1" cellpadding="6">
<?php for($i=0;$i<count($user_memu);$i++){ ?>
    <tr bgcolor="<?=$menu_color?>"><td height="30"><strong><a href="info.php?menu=<?=$user_link[$i]?>"><?=$user_memu[$i]?></a></strong></td></tr>
<?php } ?>
<?php if($confirmmenu == 1){ ?>
    <tr bgcolor="<?=$menu_color?>"><td height="30"><strong><a href="Confirm.php" target="new">ยืนยันยอด</a></strong></td></tr>
<?php } ?>
<?php if($connection != 1){?>
	<!--<tr bgcolor="<?=$menu_color?>"><td height="30"><strong><a href="info.php?menu=Change_Pwd">เปลี่ยนรหัสผ่าน</a></strong></td></tr>-->
<?php } ?>    
	<tr bgcolor=""><td height="30" bgcolor="#333333"><strong><a href="info.php?menu=SigeOut" onclick="return confirm('ท่านต้องการออกจากระบบบริการสมาชิก ใช่ หรือ ไม่ ?');">ออกจากระบบ</a></strong></td></tr>
</table>
</span>