<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
require "../s/s.wcmember_info.php";
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
<table width="85%" border="0" align="center" cellpadding="1" cellspacing="6">
  <tr>
    <td width="17%" align="right">ทะเบียนสมาชิก :</td>
    <td width="31%" align="left"><?=$member_no?></td>
    <td width="17%" align="right">ประเภทสมาชิก :</td>
    <td width="35%" align="left"><?=$member_type?></td>
  </tr>
  <tr>
    <td align="right">ชื่อ - สกุล :</td>
    <td align="left"><?=$full_name?></td>
    <td align="right">วันเกิด :</td>
    <td align="left"><?=ConvertDate($birthday,"short")?> (<?=count_member($birthday,'ym')?>)</td>
  </tr>
  <tr>
    <td align="right">เลขที่บัตรประชาชน :</td>
    <td align="left"><?=GetFormatidcare($card_person)?></td>
    <td align="right">มือถือ :</td>
    <td align="left"><?=$mobile?></td>
  </tr>
  <tr>
    <td align="right">วันที่เป็นสมาชิก :</td>
    <td align="left"><?=ConvertDate($member_date,"short")?> (<?=count_member($member_date,'ym')?>)</td>
    <td align="right">ศูนย์ประสานงาน :</td>
    <td align="left"><?=$membgroup?></td>
  </tr>
  <tr>
    <td align="right">ชื่อคู่สมรส :</td>
    <td align="left"><?=$mate_name?></td>
    <td align="right">ผู้จัดการศพ :</td>
    <td align="left"><?=$manage_corpse_name?></td>
  </tr>
  <tr>
    <td align="right">ที่อยู่ ที่สามารถติดต่อได้ :</td>
    <td colspan="3" align="left"><?=$other_contact_address?></td>
  </tr>
  <tr>
    <td align="right">เลขที่สมาชิก สอ. :</td>
    <td align="left"><?=$member_no_coop?></td>
  </tr>
</table>
<br />
