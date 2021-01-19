<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
require "../s/s.member_info.php";
?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"><font face="Tahoma" size="4"><strong>ข้อมูลสมาชิก</strong></font><br />
      <font face="Tahoma" size="2" color="#FF6600">Member Information</font></td>
  </tr>
  <tr>
    <td align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<table width="90%" border="0" align="center" cellpadding="1" cellspacing="6">
  <tr>
    <td width="17%" align="right"><font size="2">ทะเบียนสมาชิก :</font></td>
    <td width="31%" align="left"><font size="2"><?=$member_no?></font></td>
    <td width="17%" align="right"><font size="2">ประเภทสมาชิก :</font></td>
    <td width="35%" align="left"><font size="2"><?=$member_type?></font></td>
  </tr>
  <tr>
    <td align="right"><font size="2">ชื่อ - สกุล :</font></td>
    <td align="left"><font size="2"><?=$full_name?></font></td>
    <td align="right"><font size="2">วันเกิด :</font></td>
    <td align="left"><font size="2"><?=ConvertDate($birthday,"short")?> (<?=count_member($birthday,'ym')?>)</font></td>
  </tr>
  <tr>
    <td align="right"><font size="2">เลขที่บัตรประชาชน :</font></td>
    <td align="left"><font size="2"><?=GetFormatidcare($card_person)?></font></td>
    <td align="right"><font size="2">มือถือ :</font></td>
    <td align="left"><font size="2"><?=$mobile?></font></td>
  </tr>
  <tr>
    <td align="right"><font size="2">วันที่เป็นสมาชิก :</font></td>
    <td align="left"><font size="2"><?=ConvertDate($member_date,"short")?> (<?=count_member($member_date,'ym')?>)</font></td>
    <td align="right"><font size="2">ตำแหน่ง :</font></td>
    <td align="left"><font size="2"><?=$position?></font></td>
  </tr>
  <tr>
    <td align="right"><font size="2">สังกัด :</font></td>
    <td colspan="3" align="left"><font size="2"><?=$membgroup?></font></td>
  </tr>
</table>
<br />
