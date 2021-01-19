<?php @header('Content-Type: text/html; charset=tis-620'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />

<table width="100%" border="0" cellspacing="1" cellpadding="6">

<?php for($i=0;$i<count($admin_menu);$i++){ ?>
    <tr bgcolor="<?=$menu_color?>" class="class1"><td height="30"><strong><a href="administrator.php?menu=<?=$admin_link[$i]?>"><?=$admin_menu[$i]?></a></strong></td></tr>
<?php } ?>
	<tr bgcolor="" class="class3"><td height="30" bgcolor="#0776bd"><strong><a href="administrator.php?menu=SigeOut" onclick="return confirm('ท่านต้องการออกจากผู้ดูแลระบบ ใช่ หรือ ไม่ ?');">ออกจากระบบ</a></strong></td></tr>

</table>
