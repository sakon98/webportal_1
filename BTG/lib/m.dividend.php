<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?><head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php
require "../s/s.member_info.php";
?><center><div ><a href="index.php" data-role="button" data-corners="false"  data-icon="arrow-l" data-theme="f">เมนูหลัก </a></div></center>
<?php  require "../s/s.dividend.php";  ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="86%" align="right"><strong><font size="3" face="Tahoma">ปันผล - เฉลี่ยคืน ประจำปี  <?=$divyear?></font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Dividend & Returning</font></td>
    <td width="14%" align="right" valign="top">
   </td>
  </tr>
  <tr>
    <td colspan="2" align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>

<table width="90%" border="0" align="center" cellpadding="0" cellspacing="3">
  <tr>
    <td align="left" valign="top"><font face="Tahoma" size="3"><strong>ปันผล</strong></font></td>
  </tr>
  <tr>
    <td align="right" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="5%" valign="top">&nbsp;</td>
        <td width="95%" valign="top"><font face="Tahoma" size="3"><?=$div_balamt?>  บาท</font></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr color="#CCCCCC" size="1"/></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top"><font face="Tahoma" size="3"><strong>เฉลี่ยคืน</strong></font></td>
  </tr>
  <tr>
    <td align="right" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="5%" valign="top">&nbsp;</td>
        <td width="95%" valign="top"><font face="Tahoma" size="3"><?=$avg_balamt?>  บาท</font></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr color="#CCCCCC" size="1"/></td>
        </tr>
    </table></td>
  </tr>
  <!--
  <tr>
    <td align="left" valign="top"><font face="Tahoma" size="3"><strong>รายการหัก</strong> </font></td>
  </tr>
  <tr>
    <td align="right" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="5%" valign="top">&nbsp;</td>
        <td width="95%" valign="top"><font face="Tahoma" size="3"><?=($etc_balamt==""?$totalpay_:$etc_balamt)?>  บาท</font></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr color="#CCCCCC" size="1"/></td>
        </tr>
    </table></td>
  </tr>
  -->
  <tr>
    <td align="left" valign="top"><font face="Tahoma" size="3"><strong>ปันผล-เฉลี่ยคืนรวม</strong></font></td>
  </tr>
  <tr>
    <td align="right" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="5%" valign="top">&nbsp;</td>
        <td width="95%" valign="top"><font face="Tahoma" size="3"><font size="3" color="#FF6600"> <?=$sumdiv?> </font> บาท</strong></font></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><hr color="#CCCCCC" size="1"/></td>
        </tr>
    </table></td>
  </tr>
</table>


<?php if($Num_div2 != 0){ ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="86%" align="right"><strong><font size="4" face="Tahoma">รายการหัก</font></strong>
      <!--<br /><font color="#FF6600" size="2" face="Tahoma">How to Get Paid</font> -->
	  </td>
    <td width="14%" align="right" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
<!--
  <tr>
    <td>รายละเอียด</td>
    <td>จำนวนเงิน</td>
  </tr>
  -->
  <?php 
    
	for($i=0;$i<$Num_div2;$i++){
	
  ?>
  <tr>
    <td><?=$divpaytype_desc[$i]?></td>
    <td  align="right"><?=$item_amt_[$i]?> บาท</td>
  </tr>
  <?php } ?>
</table>
<table width="90%" border="0" align="center" cellpadding="1" cellspacing="4">
  <tr>
    <td height="21" colspan="3" align="left"><font size="3"><strong>รวมหัก<font color="#0000CC">  <?=$totalpay_?> </font> บาท</strong></font></td>
  </tr>
</table>

<?php } ?>

<?php if($Num_div1 != 0){ ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="86%" align="right"><strong><font size="4" face="Tahoma">วิธีการรับเงิน</font></strong>
      <!--<br /><font color="#FF6600" size="2" face="Tahoma">How to Get Paid</font>-->
	  </td>
    <td width="14%" align="right" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<table width="90%" border="0" align="center" cellpadding="1" cellspacing="4">
  <tr>
    <td height="21" colspan="3" align="left"><p><font size="3">
      <?=$typepay ?> 
      เข้า <?=$bank_desc ?>
      <br />
    </font><font size="3">เลขที่บัญชี
  <?=$bank_acc ?> <strong><br />จำนวนเงิน<font color="#0000CC"> 
<?=$totalpay ?>
    </font>
   บาท</strong></font></p></td>
  </tr>
</table>

<?php } ?>


<table width="75%" border="0" align="center" cellpadding="0" cellspacing="3">
  <tr>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><font color="#FF0000">* กรุณาตรวจสอบอีกครั้งกับทางสหกรณ์</font></td>
  </tr>
</table>


