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
    <td width="86%" align="left"><strong><font size="4" face="Tahoma">ปันผล - เฉลี่ยคืน ประจำปี  <?=$divyear?></font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Dividend & Returning</font></td>
    <td width="14%" align="right" valign="top">
    <form id="formID1" name="formID1" method="post" action="" >
        <select name="divyear" id="divyear"  onchange="this.form.submit()" >
            <option value=""> --- กรุณาเลือก ---</option>
                  <?php  					  
                    for($i=0  ; $i <= ($maxdiv-$mindiv) ; $i++){
		if(($maxdiv-$i) < 2557){
			continue;
		}else{
			echo '<option value="'.($maxdiv-$i).'">ปี :  '.($maxdiv-$i).'</option>';
		}
                    }
                   ?>
    	</select>
    </form></td>
  </tr>
  <tr>
    <td colspan="2" align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<table width="75%" border="0" align="center" cellpadding="1" cellspacing="4">
  <tr>
    <td width="33%" height="35" align="center" bgcolor="#CCCCFF"><strong>ปันผล</strong></td>
    <td width="33%" align="center" bgcolor="#CCCCFF"><strong>เฉลี่ยคืน</strong></td>
    <td width="33%" align="center" bgcolor="#CCCCFF"><strong>รายการหัก</strong></td>
  </tr>
  <tr>
    <td height="35" align="center"><strong><?=number_format($div_balamt,2)?></strong></td>
    <td align="center"><strong><?=number_format($avg_balamt,2)?></strong></td>
    <td align="center"><strong><?=number_format($etc_balamt,2)?></strong></td>
  </tr>
  <tr>
    <td height="35" colspan="3" align="center" bgcolor="#CCCCFF"><font size="3" ><strong>รวมรับ : <font size="3" color="#FF6600"> <?=number_format($sumdiv2,2)?> </font> บาท</strong></font></td>
  </tr>
  
    <tr>
    <td height="21" colspan="3" align="center"><font color="#FF0000"><strong>*หมายเหตุ : กรุณาตรวจสอบอีกครั้งกับทางสหกรณ์</strong></font></td>
  </tr>
</table>
<?php if($Num_div1 != 0){ ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="86%" align="left"><strong><font size="4" face="Tahoma">วิธีการรับเงิน</font></strong><br />
      <font color="#FF6600" size="2" face="Tahoma">How to Get Paid</font></td>
    <td width="14%" align="right" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<table width="45%" border="0" align="center" cellpadding="1" cellspacing="4">
  <tr>
    <td height="21" colspan="3" align="left"><p><font size="3">
      <?=$typepay ?> 
            <?php if($bank_desc != "") {?>
      เข้า 
            <?php }else{ ?>
      
            <?php } ?>
     <?=$bank_desc ?>
      <br />
    </font><font size="3"> <?php if($bank_acc != "") {?> เลขที่บัญชี <?php }else{ ?> <?php } ?>
  <?=$bank_acc ?> <strong><font color="#0000CC"> <br />
  จำนวนเงิน
<?=$totalpay ?>
    </font></strong></font></p></td>
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
    <td align="right"><font color="#FF0000"><strong>&nbsp;</strong></font></td>
  </tr>
</table>
