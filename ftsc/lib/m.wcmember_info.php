<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?><head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php
require "../s/s.wcmember_info.php";
?><center><div ><a href="index.php" data-role="button" data-corners="false"  data-icon="arrow-l" data-theme="f">เมนูหลัก </a></div></center>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right"><font face="Tahoma" size="4"><strong>ข้อมูลสมาชิก</strong></font><br />
      <font face="Tahoma" size="2" color="#FF6600">Member Information</font></td>
  </tr>
</table>
<hr color="#999999" size="1"/>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="3">
  <tr>
    <td align="left" valign="top"><font face="Tahoma" size="3"><strong>เลขทะเบียนฌาปนกิจ</strong></font></td>
  </tr>
  <tr>
    <td align="right" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="5%" valign="top">&nbsp;</td>
        <td width="95%" valign="top"><font face="Tahoma" size="3"><?=$member_no?> (<?=$member_type?>)</font></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr color="#CCCCCC" size="1"/></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top"><font face="Tahoma" size="3"><strong>เลขที่สมาชิก สอ.</strong></font></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="5%" valign="top">&nbsp;</td>
        <td width="95%" valign="top"><font face="Tahoma" size="3"><?=$member_no_coop?></font></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr color="#CCCCCC" size="1"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top"><font face="Tahoma" size="3"><strong>ชื่อ-สกุล</strong></font></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="5%" valign="top">&nbsp;</td>
        <td width="95%" valign="top"><font size="3" face="Tahoma"><?=$full_name?></font></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr color="#CCCCCC" size="1"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top"><font face="Tahoma" size="3"><strong>เลขบัตรประชาชน</strong></font></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="5%" valign="top">&nbsp;</td>
        <td width="95%" valign="top"><font face="Tahoma" size="3"><?=GetFormatidcare($card_person)?></font></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr color="#CCCCCC" size="1"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top"><strong><font size="3" face="Tahoma">วันเกิด</font></strong></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="5%" valign="top">&nbsp;</td>
        <td width="95%" valign="top"><font face="Tahoma" size="3"><?=ConvertDate($birthday,"short")?> (<?=count_member($birthday,'ym')?>)</font></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr color="#CCCCCC" size="1"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top"><font face="Tahoma" size="3"><strong>วันรับสิทธิ์</strong></font></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="5%" valign="top">&nbsp;</td>
        <td width="95%" valign="top"><font face="Tahoma" size="3"><?=ConvertDate($member_date,"short")?> (<?=count_member($member_date,'ym')?>)</font></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr color="#CCCCCC" size="1"/></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td align="left" valign="top"><font face="Tahoma" size="3"><strong>เงินสงเคราะห์ล่วงหน้าคงเหลือ</strong></font></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="5%" valign="top">&nbsp;</td>
        <td width="95%" valign="top"><font face="Tahoma" size="3"><?=$prncbal?></font></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr color="#CCCCCC" size="1"/></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td align="left" valign="top"><font face="Tahoma" size="3"><strong>โทรศัพท์มือถือ</strong></font></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="5%" valign="top">&nbsp;</td>
        <td width="95%" valign="top"><font face="Tahoma" size="3"><?=$mobile?></font></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr color="#CCCCCC" size="1"/></td>
      </tr>
    </table></td>
  </tr>
   <tr>
    <td align="left" valign="top"><font face="Tahoma" size="3"><strong>ที่อยู่ ที่สามารถติดต่อได้</strong></font></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="5%" valign="top">&nbsp;</td>
        <td width="95%" valign="top"><font face="Tahoma" size="3"><?=$other_contact_address?></font></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr color="#CCCCCC" size="1"/></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td align="left" valign="top"><font face="Tahoma" size="3"><strong>ศูนย์ประสานงาน</strong></font></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="5%" valign="top">&nbsp;</td>
        <td width="95%" valign="top"><font face="Tahoma" size="3"><?=$membgroup?></font></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr color="#CCCCCC" size="1"/></td>
      </tr>
    </table></td>
  </tr>
  
   <tr>
    <td align="left" valign="top"><font face="Tahoma" size="3"><strong>ชื่อคู่สมรส</strong></font></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="5%" valign="top">&nbsp;</td>
        <td width="95%" valign="top"><font face="Tahoma" size="3"><?=$mate_name?></font></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr color="#CCCCCC" size="1"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top"><font face="Tahoma" size="3"><strong>ผู้จัดการศพ</strong></font></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="5%" valign="top">&nbsp;</td>
        <td width="95%" valign="top"><font size="3" face="Tahoma"><?=$manage_corpse_name?></font></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr color="#CCCCCC" size="1"/></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
</table>


<br/>


