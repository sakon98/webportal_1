<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?><head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php
require "../s/s.loan.php";
?>
<center><div ><a href="index.php" data-role="button" data-corners="false"  data-icon="arrow-l" data-theme="f">เมนูหลัก </a></div></center>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right"><strong><font size="4" face="Tahoma">ข้อมูลเงินกู้</font></strong><br />
      <font color="#FF6600" size="2" face="Tahoma">Loan</font></td>
  </tr>
</table>
<hr color="#999999" size="1"/>
<div data-role="collapsible-set" data-theme="b" data-content-theme="d">
 <?php for($i = 0 ; $i < $Num_Rows ; $i ++) { ?>
    <div data-role="collapsible">
        <h2><?=$loan_desc[$i]?> </h2>
        <ul data-role="listview" data-theme="d" data-divider-theme="d">
            <li data-role="list-divider">จำนวน <?=$count_loan[$i]?> บัญชี</li>
          	  <?php 
			   require "../s/s.loan1.php";
			   for($n = 0 ; $n < $Num_Rows1 ; $n ++) {
			   ?>
            <li>
			<a href="info.php?menu=Loan_Show&n=<?=$n?>&i=<?=$i?>&acc_no=<?=$loancontract_no[$n]?>">
                <h3><?= $loancontract_no[$n] ?></h3>                            
                <p>ประเภทเงินกู้ : <?= $loantype_desc[$n]  ?></p>
                <p><font color="red" size="3"><strong>หนี้คงเหลือ : <?=  number_format($principal_balance[$n],2) ?> ฿</strong></font></p>   
                <p>วงเงินที่ได้รับอนุมัติ : <?= number_format($loanapprove_amt[$n],2)  ?> ฿</p>
                
                <p>วันที่อนุมัติ : <?=$startcont_date[$n]?></p>
                <p class="ui-li-aside">ชำระแล้ว <strong><?= number_format($pay_persent[$n] ,2) ?> %</strong></p>
			</a>	
				
            </li>
             <?php } ?>   
        </ul>
    </div>
 <?php } ?>   
</div>

