<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
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
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="3">

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
		<link href="../d/slideshow/css/number_slideshow.css" rel="stylesheet" type="text/css"></link>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" src="../d/slideshow/js/number_slideshow.js"></script>
		<script language="javascript" type="text/javascript">
            $(function() {
               $("#number_slideshow1").number_slideshow({
                    slideshow_autoplay: 'enable',//enable disable
                    slideshow_time_interval: 6000,
                    slideshow_transition_speed: 'slow',//'normal','slow','fast' or numeral
                    slideshow_window_background_color: "#FFF",
                    slideshow_window_padding: '0',
                    slideshow_window_width: 'auto',
                    slideshow_window_height: '300',
                    slideshow_button_current_text_color: '#fff',
                    slideshow_border_size: '1',
                    //slideshow_border_color: '#13A4EB',
                     slideshow_border_color: '#555555',
                    slideshow_show_button: 'enable',//enable disable
                    slideshow_show_title: 'enable',//enable disable
                    slideshow_button_text_color: '#FFF',
                   // slideshow_button_background_color: '#13A4EB',
                    //slideshow_button_current_background_color: '#13A4EB',
                    //slideshow_button_border_color: '#13A4EB',
                    slideshow_button_background_color: '#555555',
                    slideshow_button_current_background_color: '#555555',
                    slideshow_button_border_color: '#555555',
                    slideshow_loading_gif: 'loading.gif',//loading pic, you can replace it use youself gif.
                    slideshow_button_border_size: '0'
                });

            });
        </script>
		<br>
		<div id="number_slideshow1" class="number_slideshow" style="margin-left:20px;">
          <ul>
				<li><a href="#"><img src="../d/slideshow/images/1.jpg" width="560" height="300" alt=" "/></a></li>
				<li><a href="#"><img src="../d/slideshow/images/2.jpg" width="560" height="300" alt=" "/></a></li>
				<!--<li><a href="#"><img src="../d/slideshow/images/3.jpg" width="560" height="300" alt=" "/></a></li>
				<li><a href="#"><img src="../d/slideshow/images/4.jpg" width="560" height="300" alt=" "/></a></li>
                <li><a href="#"><img src="../d/slideshow/images/5.jpg" width="560" height="300" alt=" "/></a></li>
				 <li><a href="#"><img src="../d/slideshow/images/5.jpg" width="560" height="300" alt=" "/></a></li>  -->            
            </ul>
            <ul class="number_slideshow_nav">
                <li><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<!--<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>-->
            </ul>
            <div style="clear: both"></div>
        </div>
	</td>
	<td width="26%" align="center" valign="top">
	
				<img src="img/President.gif" width="130" height="" alt=""/>

				</td>
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