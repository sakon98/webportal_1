<?php
session_start();
header('Content-Type: text/html; charset=tis-620');
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php require "../s/s.Benefits.php";  ?>

<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right"><strong><font size="4" face="Tahoma">ข้อมูลกองทุน</font></strong><br />
      <font color="#FF6600" size="2" face="Tahoma">Fund Information</font></td>
  </tr>
</table>
<hr color="#999999" size="1"/>

<div data-role="collapsible-set" data-theme="b" data-content-theme="d">
    <div data-role="collapsible" class="contant">
        <h2>เงินกองทุนสะสมคงเหลือ</h2>
		 <ul data-role="listview" data-theme="d" data-divider-theme="d">
				<li><?php echo $fundbalance_2_full." บาท"; ?></li>
		 </ul>
    </div>