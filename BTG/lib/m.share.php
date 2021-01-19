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
        <h2>รายละเอียดหุ้น</h2>
        <ul data-role="listview" data-theme="d" data-divider-theme="d">
            <li>
                 <table  class="table"> 
				<tr  > <td align="center"><strong>รายการ</strong></td> 
				<td align="right"><strong>ยอดชำระ</strong></td>
				<td align="right"><strong>คงเหลือ</strong></td></tr>  
				
				<?php
				require "../s/s.share3.php";
				for($n=0;$n<$Num_Rows;$n++){ 
				 ?>      
              
 
			 <?php if($shritemtype_code[$n]=="B/F"){ ?>
			 <tbody> <tr class="info"   valign="middle"> 
			    
			   <td align="center"> <?=$slip_date[$n] ?><br> <?=$shritemtype_desc[$n] ?> </td>
			   <td align="right" valign="middle"> <strong><?=number_format($share_amount[$n] ,0)?></strong> </td>
			   <td align="right" valign="middle"> <strong><?=number_format($sharestk_amt[$n],0) ?></strong></td>
			   <?php }else if($shritemtype_code[$n]=="SWD"){  ?>
			    <tr class="danger"  valign="middle"> 
			   <td align="center"><font color="red"><?=$slip_date[$n] ?><br> <?=$shritemtype_desc[$n] ?></font></td>
			   <td align="right"><font color="red"><strong>-<?=number_format($share_amount[$n] ,0)?></strong></font></td>
			   <td align="right"><font color="red"><strong><?=number_format($sharestk_amt[$n],0) ?></strong></font></td>
			   
			   <?php }else {  ?>
			    <tr class="success"   valign="middle"> 
			   <td align="center"><font color="green"><?=$slip_date[$n] ?><br> <?=$shritemtype_desc[$n] ?></font></td>
			   <td align="right"><font color="green"><strong>+<?=number_format($share_amount[$n] ,0)?></strong></font></td>
			   <td align="right"><font color="green"><strong><?=number_format($sharestk_amt[$n],0) ?></strong></font></td>
			   
			   
			   <?php }} ?>
				</tr></tbody> </table>
				
            </li>
        </ul>
    </div>
    <ul data-role="listview" data-inset="true">
    <li><a href="#">งวดล่าสุด : <?=ConvertDate($LASTA,"short")?></a></li>
	</ul>
</div>
