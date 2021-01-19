<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?><head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php  require "../s/s.dividend.php";  ?>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right"><font face="Tahoma" size="4"><strong>ปันผล-เฉลี่ยคืน</strong></font><br />
      <font face="Tahoma" size="2" color="#FF6600">Dividend &amp; Returning</font></td>
  </tr>
</table>
<hr color="#999999" size="1"/>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="3">
  <tr>
    <td height="25" colspan="3" align="left" valign="middle"><font face="Tahoma" size="3"><strong>ประจำปี
        <?=$divyear?>
    </strong></font></td>
  </tr>
  <tr>
    <td align="right" valign="top">ปันผล :</td>
    <td width="244" align="right" valign="top"><?=$div_balamt?></td>
    <td width="278" align="right" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" valign="top">เฉลี่ยคืน :</td>
    <td align="right" valign="top"><?=$avg_balamt?></td>
    <td align="right" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" valign="top">อื่น :</td>
    <td align="right" valign="top"><?=$etc_balamt?></td>
    <td align="right" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="517" align="right" valign="top">รวม :</td>
    <td align="right" valign="top"><?=$sumdiv?> </td>
    <td align="right" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="right" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
    </table></td>
  </tr>
</table>
<hr color="#999999" size="1"/>
	
