<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php   require "../include/jquery.popup.php";   ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"><strong><font size="4" face="Tahoma">ข่าวสารสมาชิก</font></strong><br />
      <font face="Tahoma" size="2" color="#FF6600">News</font></td>
  </tr>
  <tr>
    <td align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<?php  require "../s/my.news.php";   ?>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="3">
<?php 	for($i=0;$i<$Num_Rows;$i++){ ?>
  <tr>
    <td width="98%" align="left" valign="top">> <font face="Tahoma" size="2"> <a class="popup-link-<?=$i?>"><?= $n_topic[$i]	?></a></font>
    <?php if($i < 3) { ?> <img src="../img/new1.gif" style="border-width:0px;"> <?php } ?>
    </td>
  </tr>
  
    <div class="popup-box" id="popup-box-<?=$i?>">
        <div class="close">X</div>
            <div class="top" align="left">
                <strong><font size="4" face="Tahoma">ข่าวสารสมาชิก</font></strong><br />
            <font face="Tahoma" size="2" color="#FF6600">News</font>            </div>
            <div class="bottom">
            	<p><strong><?= $n_topic[$i]?></strong>
				<textarea name="a" rows="15" readonly="readonly" id="a" style="width:100%; resize:none; font-size:14px; font-family:Tahoma" ><?= $n_details[$i]?></textarea></font>
                <div align="right">ผู้ประกาศ  : <font face="Tahoma" size="2" color="FF6600"><?= $who_post[$i]?></font>     &nbsp;&nbsp;&nbsp;วันที่ประกาศ : <font face="Tahoma" size="2" color="FF6600"><?= DateThai($n_date[$i])?></font></div>
             </div>
        </div>
    		<div id="blackout"></div>
  
  <tr>
    <td><hr size="1" color="#CCCCCC" /></td>
  </tr>
    <?php } ?>
</table>

<br />
<br />