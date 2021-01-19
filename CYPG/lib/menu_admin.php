<?php @header('Content-Type: text/html; charset=tis-620'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<table width="100%" border="0" cellspacing="1" cellpadding="6">
<?php for($i=0;$i<count($admin_memu);$i++){ ?>
    <tr bgcolor="<?=$menu_color?>"><td height="30"><strong><a href="info.php?menu=<?=$admin_link[$i]?>"><?=$admin_memu[$i]?></a></strong></td>
<?php } ?>
	<tr bgcolor=""><td height="30" bgcolor="#333333"><strong><a href="info.php?menu=SigeOut">ออกจากระบบ</a></strong></td></tr>
</table>
