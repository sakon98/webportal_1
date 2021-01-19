<?php
session_start();
header('Content-Type: text/html; charset=tis-620');
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
    <td align="right" valign="top">อื่นๆ :</td>
    <td align="right" valign="top"><?=$etc_balamt?></td>
    <td align="right" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="517" align="right" valign="top">รวมรายรับ :</td>
    <td align="right" valign="top"><font color="green"><?=$sumdiv?> </font></td>
    <td align="right" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="517" align="right" valign="top"></td>
    <td align="right" valign="top">---------------</td>
    <td align="right" valign="top"></td>
  </tr>
  <tr>
    <td width="517" align="right" valign="top">เงินกู้ปันผล :</td>
    <td align="right" valign="top"><?php  if($totalpay_lon!=0) {echo $totalpay_lon;}else{echo "-" ;}?> </td>
    <td align="right" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="517" align="right" valign="top">สสอค. :</td>
    <td align="right" valign="top"><?php if($totalpay_cmt!=0) {echo $totalpay_cmt;}else{echo "-" ;}?> </td>
    <td align="right" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="517" align="right" valign="top">สส.ชสอ. :</td>
    <td align="right" valign="top"><?php  if($totalpay_cso>0) {echo $totalpay_cso;}else{echo "-" ;}?> </td>
    <td align="right" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="517" align="right" valign="top">สส.พช. :</td>
    <td align="right" valign="top"><?php  if($totalpay_skp>0) {echo $totalpay_skp;}else{echo "-" ;}?> </td>
    <td align="right" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="517" align="right" valign="top">ประกัน ภาคสมัครใจ :</td>
    <td align="right" valign="top"><?php  if($totalpay_inh>0) {echo $totalpay_inh;}else{echo "-" ;}?></td>
    <td align="right" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="517" align="right" valign="top">ประกัน สคส. :</td>
    <td align="right" valign="top"><?php  if($totalpay_sks >0) {echo $totalpay_sks ;}else{echo "-" ;}?> </td>
    <td align="right" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="517" align="right" valign="top">ประกัน สินเชื่อ :</td>
    <td align="right" valign="top"><?php  if($totalpay_et4>0) {echo $totalpay_et4;}else{echo "- " ;}?>  </td>
    <td align="right" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="517" align="right" valign="top">สฌอน :</td>
    <td align="right" valign="top"><?php  if($totalpay_csn>0) {echo $totalpay_csn;}else{echo "- " ;}?>  </td>
    <td align="right" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="517" align="right" valign="top">รวมรายการหัก :</td>
    <td align="right" valign="top"><font color="red"><?=number_format($total_sub, 2, '.', ',');?></font>  </td>
    <td align="right" valign="top">&nbsp;</td>
  </tr>
  
  <tr>
    <td width="517" align="right" valign="top"></td>
    <td align="right" valign="top">---------------</td>
    <td align="right" valign="top"></td>
  </tr>
 <tr>
    <td width="517" align="right" valign="top">คงเหลือ :</td>
    <td align="right" valign="top"><font color="blue"><?php
	 // $c_total=number_format($sumdiv-$total_deduction, 2, '.', ',');
	  $c_tatal= $sumdiv_begin-$total_sub;
	  echo number_format($c_tatal, 2, '.', ',');
	  ?></font>  </td>
    <td align="right" valign="top">&nbsp;</td>
  </tr>

  
  <tr>
    <td colspan="3" align="right" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
    </table></td>
  </tr>
</table>
<hr color="#999999" size="1"/>
	
