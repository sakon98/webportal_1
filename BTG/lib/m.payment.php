<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
$fixdate = date('01-m-Y'); //กำหนดเพื่อให้แสดง หักรายเดือนหลังวันที่ กำหนด
//$fixdate = null; //กำหนดเพื่อให้แสดง หักรายเดือน ทั้งหมด
?><head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<center><div ><a href="index.php" data-role="button" data-corners="false"  data-icon="arrow-l" data-theme="f">เมนูหลัก </a></div></center>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right"><strong><font size="4" face="Tahoma">เรียกเก็บประจำเดือน</font></strong><br />
      <font color="#FF6600" size="2" face="Tahoma">Monthly Payment</font></td>
  </tr>
</table>
<hr color="#999999" size="1"/>
<?php require "../s/s.payment.php"; ?>
<ul data-role="listview" data-theme="d"  data-count-theme="a" data-inset="true">
<?php for($i=0;$i<count($slip);$i++) { ?>
    <li><a href="info.php?menu=Payment_Show&slip_date=<?=$slip[$i] ?>"><font size="3"><?=$slip_s[$i] ?></font><span class="ui-li-count"><font size="1"><?=$slipsum[$i]?></font></span></a></li>
<?php } ?>
</ul>