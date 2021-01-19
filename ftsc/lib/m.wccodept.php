<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?><head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php
require "../s/s.wccodept.php";
?>
<center><div ><a href="index.php" data-role="button" data-corners="false"  data-icon="arrow-l" data-theme="f">เมนูหลัก </a></div></center>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right"><strong><font size="4" face="Tahoma">ผู้รับเงินสงเคราะห์</font></strong><br />
      <font color="#FF6600" size="2" face="Tahoma">Beneficiary</font></td>
  </tr>
</table>
<hr color="#999999" size="1"/>
<div data-role="collapsible-set" data-theme="b" data-content-theme="d">
 <?php for($i = 0 ; $i < $Num_Rows ; $i ++) { ?>
    <div data-role="collapsible">
        <h2><?= $codept_name[$i] ?></h2>
        <ul data-role="listview" data-theme="d" data-divider-theme="d">
           <!-- <li data-role="list-divider">จำนวน <?=$count_loan[$i]?> คน</li>-->
            <li>                      
                <h3>ความสัมพันธ์ : <?= $codept_relation[$i]  ?></h3>                 
                <p>บัตรประชาชน : <?= $codept_id[$i]  ?></p>
                <p>ที่อยู่ : <?=$codept_addr[$i]?></p> 
                <p>เบอร์ติดต่อ : <?=$codept_tel[$i]?></p> 
                <!--<p>วงเงินที่ได้รับอนุมัติ : <?= number_format($codept_addr[$i],2)  ?> ฿</p>-->
                
            </li>
        </ul>
    </div>
 <?php } ?>   
</div>

