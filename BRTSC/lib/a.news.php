<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" /> 
<?php require "../include/conf.d.php" ?>
<?php require "../include/jquery.popup.php"; ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="97%" align="left"><strong><font size="4" face="Tahoma">ข่าวสารสมาชิก</font></strong><br />
    <font face="Tahoma" size="2" color="#FF6600">News</font></td>
    <td width="3%" align="right"><strong><font size="4" face="Tahoma"><a class="popup-alink-1"><b>+</b></a></font></strong></td>
  </tr>
    <div class="popup-box" id="popup-abox-1">
        <div class="close">X</div>
        	<div class="top" align="left">
                <strong><font size="4" face="Tahoma">เพิ่มข่าวสารสมาชิก</font></strong><br />
            	<font face="Tahoma" size="2" color="#FF6600">Add News</font>           
            </div>
         <form id="form1" name="form1" method="post" action="">
        <div class="bottom">
        	<font size="2" face="Tahoma"><strong>หัวข้อ</strong></font>
        	<textarea name="topic"  id="topic" style="width:100%; resize:none; font-size:14px; font-family:Tahoma" rows="1"></textarea>
            <font size="2" face="Tahoma"><strong>รายละเอียด</strong></font>
            <textarea name="details" id="details" style="width:100%; resize:none; font-size:14px; font-family:Tahoma"  rows="10"></textarea>
<p>
            <div align="right">
			<input type="button" name="button" id="button" value="เพิ่มข่าวสาร" class="addnews" onclick="this.form.submit();" /> <input type="reset" name="button" id="button" value="ล้างข้อมูล" class="button2"  />   
            <input name="ref" type="hidden" value="addnew" />
            </div>
        </div>
        </form>
    </div>
    <div id="blackout"></div>
  <tr>
    <td colspan="2" align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<?php  require "../s/my.news.php";   ?>
<table width="96%" border="0" align="center" cellpadding="0" cellspacing="3">
<?php 	for($i=0;$i<$Num_Rows;$i++){ ?>
  <tr>
    <td width="98%" align="left" valign="top"><font face="Tahoma" size="2"> <a class="popup-link-<?=$i?>"><?= $n_topic[$i]	?></a></font></td>
  </tr>
    <div class="popup-box" id="popup-box-<?=$i?>">
        <div class="close">X</div>
            <div class="top" align="left">
                <strong><font size="4" face="Tahoma">ข่าวสารสมาชิก</font></strong><br />
            	<font face="Tahoma" size="2" color="#FF6600">News</font>           
            </div>
            <form id="form1" name="form1" method="post" action="">
            <div class="bottom" >
            	<textarea name="n_topic"  id="n_topic" style="width:100%; resize:none; font-size:14px; font-family:Tahoma" rows="1"><?= $n_topic[$i]?></textarea>
                <textarea name="n_details" id="n_details" style="width:100%; resize:none; font-size:14px; font-family:Tahoma"  rows="13"><?= $n_details[$i]?></textarea>
                <div align="right">ผู้ประกาศ  : <font face="Tahoma" size="2" color="FF6600"><?= $who_post[$i]?></font>
                 &nbsp;&nbsp;&nbsp;วันที่ประกาศ : <font face="Tahoma" size="2" color="FF6600"><?= DateThai($n_date[$i])?></font></div>
                 <input type="submit" name="actions" id="actions" value="Delete" class="button3" onclick="return confirm('ท่านต้องการลบข้อมูลใช่ หรือ ไม่ !!!')">
                 <input type="submit" name="actions" id="actions" value="Update" class="button4" onclick="return confirm('ท่านต้องการปรับปรุงข้อมูลใช่ หรือ ไม่ !!!')">
                 <input name="id" type="hidden" value="<?=$id[$i]?>" />
                 <input name="table" type="hidden" value="webnews" />
             </div>
      </form>
        </div>
    <div id="blackout"></div>
  
  <tr>
    <td><hr size="1" color="#CCCCCC" /></td>
  </tr>
<?php } ?>
</table>
<br />
