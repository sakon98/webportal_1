<?php
session_start();
header('Content-Type: text/html; charset=tis-620');
?><head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"><strong><font size="4" face="Tahoma">ข่าวสารสมาชิก</font></strong><br />
      <font face="Tahoma" size="2" color="#FF6600">News</font></td>
  </tr>
  <tr>
    <td align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<?php require "../s/my.news.php";   ?>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="3">
<?php 	for($i=0;$i<$Num_Rows;$i++){ ?>
  <tr>
    <td align="left" valign="top"><font face="Tahoma" size="2"> <a href="#popupPadded<?=$i?>" data-rel="popup"  data-inline="true"><?= $n_topic[$i]?></a></font>
    <div data-role="popup" id="popupPadded<?=$i?>" class="ui-content">
     	<font face="Tahoma" size="2" >
		<p><strong><?= $n_topic[$i]?></strong></p>
		<p><?= $n_details[$i]?></p> </font> 
     <div align="right" style="width:98%"><font face="Tahoma" size="2">ผู้ประกาศ   </font><font face="Tahoma" size="2" color="FF6600"><?= $who_post[$i]?></font>  <br/><font face="Tahoma" size="2">วันที่ประกาศ  </font><font face="Tahoma" size="2" color="FF6600"><?= DateThai($n_date[$i])?></font></div>
    </div>
</td>
  </tr>
  <tr>
    <td align="right" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td width="100%" valign="top"><hr color="#CCCCCC" size="1"/></td>
      </tr>
    </table></td>
  </tr>
<?php } ?>  
</table>
