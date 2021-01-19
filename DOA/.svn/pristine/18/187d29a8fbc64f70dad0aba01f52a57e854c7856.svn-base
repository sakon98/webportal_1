<?php
session_start();
@$member_no = $_SESSION[ses_member_no];
header('Content-Type: text/html; charset=tis-620');
?><head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right"><strong><font size="4" face="Tahoma">รายการหักประจำเดือน</font></strong><br />
      <font color="#FF6600" size="2" face="Tahoma">Monthly Payment</font></td>
  </tr>
</table>
<hr color="#999999" size="1"/>
<?php require "../s/s.payment.php"; ?>
<ul data-role="listview" data-inset="true">
    <li data-role="list-divider" data-theme="b">ประจำเดือน <?=$show_month?> </li>
	<?php for($i=0;$i<$Num_Rows;$i++) { ?>
    <li>
        <p><strong><?=($i+1).'. '?><?=$slip_itemdesc[$i].' '.$slip_loanno[$i].' งวดที่ '.$period[$i]?></strong></p>
        <p align="left">คงเหลือ  <?=$itembalance[$i]?> ฿</p>
        <h3 align="right"><font color="#FF0000" ><?=$slip_pay[$i] ?> ฿ </font></h3>
        
        <?php if($slip_principal[$i] != null){  ?>
        <p align="left">เงินต้น  <?=$slip_principal[$i]?> ฿ </p> 
        <p align="left">ดอกเบี้ย  <?=$slip_interest[$i]?> ฿</p>
		<?php } ?>

    </li>
    <?php } ?>
    <?php  if($Num_Rows1 > 0) { ?>
    <li>
        <p><strong><?=($Num_Rows+1).' '.$moneytype_code?>?></strong></p>
        <p align="left">เลที่บัญชี  <?=$expense_accid[$i]?> ฿</p>
        <h3 align="right"><font color="#FF0000" ><?=$item_payment?> ฿ </font></h3>

    </li>
    <?php } ?>
     <li>
        <h3 align="right"><font color="#FF0000" >รวมชำระ <?=number_format($totalpayment-$payment_a,2)?> ฿ </font></h3>
    </li>
</ul>
<center>
<div ><a href="info.php?menu=Payment" data-role="button" data-corners="false"  data-icon="arrow-l" data-theme="b">กลับไป </a></div></center>
