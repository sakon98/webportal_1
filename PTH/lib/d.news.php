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
    <td align="right"><font face="Tahoma" size="2" color="#FF6600">****</font></td>
  </tr>
   <tr>
 
 <?php 
 
  $strSQL2 = " select id as id , action_do from weblog_action where user = '$member_no'  and action_do <> 'Change Password' order by id desc limit 0,2";
		$value2 = array('id','action_do');
		list($Num_Rows2,$list_info2) = get_value_many_sql($strSQL2,$value2);
		   $id_now = $list_info2[0][0];  
                  $action_do_now = $list_info2[0][1]; 
		  $id_2 = $list_info2[1][0]; 
                  $action_do_2 = $list_info2[1][1];
                  
                  if($action_do_now == "Register"){
                      
                      $id_2 = 0;
                      
                  } 
				  
				  
				  
				  

 $strSQL = " SELECT w.memb_fullname ,
concat(concat(concat(concat(date_format(l.date_log,'%d'),'/'),
date_format(l.date_log,'%m')),'/') ,
date_format(l.date_log,'%Y') + 543) as date_log1,
date_format(l.date_log,'%T') as time
FROM webmbmembmaster w left join weblog_action l on w.member_no = l.user and l.id = '$id_2'
where w.member_no = '$member_no'  ";
		$value = array('memb_fullname','date_log1','time');
		list($Num_Rows,$list_info) = get_value_many_sql($strSQL,$value);
		 $memb_fullname = $list_info[0][0];
		 $date_log1 = $list_info[0][1];
		 $time = $list_info[0][2]; ?>
 
  <tr>
    <td align="right"><strong><font size="2" face="Tahoma" color="#3300FF">สวัสดี  <?php echo $memb_fullname; ?></font></strong><br />

  </tr>
  
  <tr>
    <td align="right"><strong><font size="2" face="Tahoma" color="#3300FF">เข้าสู่ระบบล่าสุดวันที่ : <?php echo $date_log1. " เวลา " . $time?></font></strong><br />

  </tr>
    <tr>
    <td align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<?php  require "../s/my.news.php";   ?>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="3">
<?php 	for($i=0;$i<$Num_Rows;$i++){ ?>
  <tr>
    <td width="98%" align="left" valign="top"><font face="Tahoma" size="2"> <a class="popup-link-<?=$i?>" style="cursor:pointer;"><?= $n_topic[$i]	?></a></font></td>
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