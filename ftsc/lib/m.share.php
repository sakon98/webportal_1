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
    <td align="right"><strong><font size="4" face="Tahoma">ทำรายการหุ้น</font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Share</font></td>
  </tr>
</table>
<?php  require "../s/s.share.php"; ?>
<hr color="#999999" size="1"/>
<div data-role="collapsible-set" data-theme="b" data-content-theme="d">
    <div data-role="collapsible">
        <h2>หุ้นสะสมรวม</h2>
        <ul data-role="listview" data-theme="d" data-divider-theme="d">
            <li>
                <h3 align="center"><font color="#FF0000"><?=number_format($SHARE_AMT,2)?> ฿</font></h3>
            </li>
        </ul>
    </div>
    <div data-role="collapsible">
        <h2>ยอดชำระต่อเดือน</h2>
        <ul data-role="listview" data-theme="d" data-divider-theme="d">
            <li>
                <h3 align="center"><font color="#FF0000"><?=number_format($PERIODSHARE_AMT,2)?> ฿</font></h3>
            </li>
        </ul>
    </div>
    <ul data-role="listview" data-inset="true">
    <li><a href="#">งวดล่าสุด : <?=ConvertDate($LASTA,"short")?></a></li>
	</ul>
</div>
