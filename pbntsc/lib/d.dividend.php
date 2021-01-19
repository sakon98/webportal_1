<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?><head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php  require "../s/s.dividend.php";  ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  <td width="86%" align="left"><strong><font size="4" face="Tahoma">ปันผล - เฉลี่ยคืน</font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Dividend & Returning</font></td>
    <td width="14%" align="right" valign="top">
    <form id="formID1" name="formID1" method="post" action="" >
        <select name="divyear" id="divyear"  onchange="this.form.submit()" >
            <option value=""> --- กรุณาเลือกปี ---</option>
                 <?php  					  
                    for($i=0  ; $i <= (($maxdiv)-$mindiv) ; $i++){
						echo '<option value="'.(($maxdiv )-$i).'">ปี :  '.(($maxdiv )-$i).'</option>';
                    }
                   ?>
    	</select>
    </form></td>
  </tr>
  <tr>
    <td colspan="2" align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<table width="96%" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td colspan="6" align="center" bgcolor="#F3C182" style=" height:35px;color:#2005D1; border-bottom:solid; border-bottom-color:#000000; border-top:solid; border-top-color:#000000; font-size:18px;"><strong> ปันผลเฉลี่ยคืนประจำปี  <?=$divyear?></strong></td>
    </tr>
    <tr style="font-weight:bold; text-align:center; height:25px;">
      <td style="color:#2005D1">ปันผล</td>
      <td bgcolor="#D8F99F" style="border-bottom:solid"><?=$div_balamt?></td>
      <td style="color:#2005D1">เฉลี่ยคืน</td>
      <td bgcolor="#D8F99F" style="border-bottom:solid"><?=$avg_balamt?></td>
      <td style="color:#8E10BD">รวมเงินปันผลเฉลี่ยคืน</td>
      <td bgcolor="#D8F99F" style="color:#2005D1; border-bottom:solid; border-bottom-color:#000000;"><?=$sumdiv?></td>
    </tr>
    <tr style="font-weight:bold; text-align:center; height:25px;">
       <td style="color:#2005D1">อัตราปันผล</td>
      <td bgcolor="#D8F99F" style="border-bottom:solid"><?=$divpercent_rate?></td>
      <td style="color:#2005D1">อัตราเฉลี่ยคืน</td>
      <td bgcolor="#D8F99F" style="border-bottom:solid"><?=$avgpercent_rate?></td>
      <td style="color:#8E10BD"></td>
      <td bgcolor="#D8F99F" style="color:#2005D1; border-bottom:solid; border-bottom-color:#000000;"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td style="font-weight:bold">
      	เงินกู้ปันผล<br>
      	สสอค.<br>
        สส.ชสอ.<br>
        สส.พช.<br>
        ประกัน ภาคสมัครใจ<br>
        ประกัน สคส.<br>
        ประกัน สินเชื่อ<br>
	สฌอน
      </td>
      <td align="right" bgcolor="#D8F99F" style="color:#F1373A; font-weight:bold">
      	<?php  if($totalpay_lon!=0) {echo $totalpay_lon;}else{echo "-" ;}?> <br>
      	<?php if($totalpay_cmt!=0) {echo $totalpay_cmt;}else{echo "-" ;}?> <br>
        <?php  if($totalpay_cso>0) {echo $totalpay_cso;}else{echo "-" ;}?> <br>
        <?php  if($totalpay_skp>0) {echo $totalpay_skp;}else{echo "-" ;}?> <br>
        <?php  if($totalpay_inh>0) {echo $totalpay_inh;}else{echo "-" ;}?> <br>
        <?php  if($totalpay_sks >0) {echo $totalpay_sks ;}else{echo "-" ;}?> <br>
        <?php  if($totalpay_et4>0) {echo $totalpay_et4;}else{echo "- " ;}?> <br>
	<?php  if($totalpay_csn>0) {echo $totalpay_csn;}else{echo "- " ;}?>
      </td>
    </tr>
    <tr>
      <td style="border-bottom:solid 2px; border-bottom-color:#000; border-top:solid 2px; border-top-color:#000;">&nbsp;</td>
      <td style="border-bottom:solid 2px; border-bottom-color:#000; border-top:solid 2px; border-top-color:#000;">&nbsp;</td>
      <td style="border-bottom:solid 2px; border-bottom-color:#000; border-top:solid 2px; border-top-color:#000;">&nbsp;</td>
      <td style="border-bottom:solid 2px; border-bottom-color:#000; border-top:solid 2px; border-top-color:#000;">&nbsp;</td>
      <td style="font-weight:bold;border-bottom:solid 2px; border-bottom-color:#000; border-top:solid 2px; border-top-color:#000; height:25px;color:F8070B;">รวมรายการหัก</td>
      <td align="right" style="color:#F8070B; font-weight:bold;border-bottom:solid 2px; border-bottom-color:#000; border-top:solid 2px; border-top-color:#000;"><?=number_format($total_sub, 2, '.', ',');?></td>
    </tr>
    <tr>
      <td bgcolor="#F3E2B8"  colspan="5" align="center" style="border-bottom:solid; border-bottom-color:#000000; height:30px;"><strong>คงเหลือรับเงินปันผลเฉลี่ยคืน </strong></td>
      <td bgcolor="#F3E2B8"  align="right" style="border-bottom:solid; border-bottom-color:#000;color:#2005D1; font-weight:bold;">
	  <?php
	 // $c_total=number_format($sumdiv-$total_deduction, 2, '.', ',');
	  $c_tatal= $sumdiv_begin - $total_sub;
	  echo number_format($c_tatal, 2, '.', ',');
	  ?></td>
    </tr>
  </tbody>
</table>
<!------------------------------------------------------------------------------------------------------------>



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
