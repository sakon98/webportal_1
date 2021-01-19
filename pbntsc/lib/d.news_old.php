<?php
session_start();
header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php   require "../include/jquery.popup.php";   ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left"><strong><font size="4" face="Tahoma">ข่าวสารสมาชิก</font></strong><br />
      <font face="Tahoma" size="2" color="#FF6600">News</font></td>
  </tr>
  <tr>
    <td align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<?php  require "../s/my.news.php";   ?>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="3">

  <tr>
    <td width="74%" align="left" valign="top">
	 <?php 	for($i=0;$i<$Num_Rows;$i++){ ?>
				<ul>
					<li>
						<font face="Tahoma" size="2"> <a class="popup-link-<?=$i?>"><?= $n_topic[$i]	?></a></font>
						<hr size="1" color="#CCCCCC" />
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
					</li>
				</ul>
	    <?php } ?>
		<img src="img/news_1.jpg" alt="" width="" height="400" />
	</td>
	<td width="26%" align="right" valign="top"><img src="img/President.gif" width="150" height="" alt=""/></td>
  </tr>
  
    
  
  <tr>
    <td></td>
	<td align="center"><!--<strong>เจษฎา หอมจันทร์<br>ประธานกรรมการ<br>สหกรณ์ออมทรัพย์ครูเพชรบูรณ์ จำกัด</strong>--></td>
  </tr>

</table>
<!--<table width="100%" border="0">
  <tbody>
    <tr>
      <td width="72%" valign="top"><h2>&nbsp;&nbsp;&nbsp;สารจากประธานกรรมการ</h2>
      <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ยินดีต้อนรับเข้าสู่ระบบบริการสมาชิก สหกรณ์ออมทรัพย์ครูเพชรบูรณ์ จำกัด</h4>
      </td>
      <td width="28%" align="center"><img src="img/President.gif" width="150" height="" alt=""/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center"><strong>เจษฎา หอมจันทร์<br>ประธานกรรมการ<br>สหกรณ์ออมทรัพย์ครูเพชรบูรณ์ จำกัด</strong></td>
    </tr>
  </tbody>
</table>-->

<br />
<br />