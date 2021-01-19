<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?><head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<center><div ><a href="index.php" data-role="button" data-corners="false"  data-icon="arrow-l" data-theme="f">เมนูหลัก </a></div></center>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right"><strong><font size="4" face="Tahoma">ตรวจสอบสิทธิ์กู้</font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Credit</font></td>
  </tr>
</table>
<?php  require "../s/s.credit.php"; ?>
<hr color="#999999" size="1"/>
<div data-role="collapsible-set" data-theme="b" data-content-theme="d">
<?php

$j=0;
for($i=0;$i<$Num_Rows;$i++){
	$loantype_desc = $list_info[$i][$j++];
	$credit_amt = $list_info[$i][$j++];
	?>
    <div data-role="collapsible">
        <h2><?=$loantype_desc?></h2>
        <ul data-role="listview" data-theme="d" data-divider-theme="d">
            <li>
                <h3 align="center"><font color="#FF0000"><?=number_format($credit_amt,2)?> ฿</font></h3>
            </li>
        </ul>
    </div>
	<?php
	$j=0;
}
?>
</div>
