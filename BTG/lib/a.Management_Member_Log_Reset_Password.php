<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php require "../include/conf.d.php" ?>
<?php require "../include/jquery.popup.php"; ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"><strong><font size="4" face="Tahoma">ดู Log Password</font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Management_Member_Log_Reset_Password</font></td>
  </tr>
  <tr>
    <td align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<form id="formID1" name="formID1" method="post" action="">
  <table width="95%" border="0" align="center" cellpadding="3" cellspacing="6">
    <tr>
      <td align="center"><strong><font size="2" face="Tahoma">กรุณากรอกเลขทะเบียน
        <label for="search"></label>
        <input name="search" type="text" id="search" size="35" />
         <input type="submit" name="button" id="button" value="ค้นหา" class="button4" />
      </font></strong></td>
    </tr>
  </table>
</form>
<?php 
if($_POST["button"] == "ค้นหา"){
	
                $name = GetFormatMember ($_POST["search"]);
	
                $host = "localhost";
                $user = "root";
                $pass = "WebServer";
                $dbname = "iscobtgdata";

                $conn = mysql_connect($host, $user, $pass) or die("ไม่สามารถติดต่อฐานข้อมูลได้ " . mysql_error());

                mysql_select_db($dbname) or die("เชื่อมต่อฐานข้อมูลไม่ได้ " . mysql_error());
                mysql_db_query($dbname,"SET NAMES TIS620");

                $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = 'WebServer';
   
   $conn = mysql_connect($dbhost, $dbuser, $dbpass);
   
   if(! $conn ) {
      die('Could not connect: ' . mysql_error());
   }
   
   $sql = "select 
(case when l.action_do = 'Change Password' then 'Change Password' 
      when l.action_do = 'For_Got_Password' then 'Forgot Password'
      when l.action_do = 'Reset Password' then 'Reset Password ' 
	  when l.action_do = 'Login' and l.action_desc is null then 'Login Success'
	  when l.action_do = 'Login Fail' then 'Login Fail'
	  when l.action_do = 'SigeOut' then 'SigeOut'
	  when l.action_do = 'LockID' then 'LockID'
	  else '' end)
 as action_do, 
l.action_desc as action_desc, 
l.user as user, 
l.ipconnect as ipconnect, 
date_format(l.date_log,'%d/%m/%Y') as date_log,
date_format(l.date_log,'%T') as time,
m.memb_fullname as memb_fullname,
l.system_os
from log_action l left join mbmembmaster m on l.user = m.member_no
where (l.action_do in ('Change Password','For_Got_Password','Reset Password','Login','Login Fail','SigeOut','LockID') and l.user = '$name' and l.action_desc is null) order by l.date_log desc";
   mysql_select_db('iscobtgdata');
   $retval = mysql_query( $sql, $conn );
   
   if(! $retval ) {
      die('Could not get data: ' . mysql_error());
   }
 mysql_close($conn);

		?>
<div style="width: 100%; height: 340px; overflow-y: scroll; scrollbar-arrow-color:blue; scrollbar-face-color: #e7e7e7; scrollbar-3dlight-color: #a0a0a0; scrollbar-darkshadow-color:#888888">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#999999"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="13%" align="center" bgcolor="#CCCCFF"><strong>ทะเบียนสมาชิกที่ reset</strong></td>
        <td width="16%" align="center" bgcolor="#CCCCFF"><strong>ชื่อ - สกุล</strong></td>
        <td width="13%" align="center" bgcolor="#CCCCFF"><strong>ประเภทรายการ</strong></td>
        <td width="10%" align="center" bgcolor="#CCCCFF"><strong>IP</strong></td>
		<!--<td width="16%" align="center" bgcolor="#CCCCFF"><strong>ชื่อเครื่อง</strong></td>-->
        <td width="13%" align="center" bgcolor="#CCCCFF"><strong>วันที่ทำรายการ</strong></td>
         <td width="13%" align="center" bgcolor="#CCCCFF"><strong>เวลา</strong></td>
      </tr>
    <?php while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {       
        ?>
      <tr>
        <td align="center" bgcolor="#FFFFFF"><?=$row['user']?></td>
        <td align="left" bgcolor="#FFFFFF"><?=$row['memb_fullname']?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$row['action_do']?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$row['ipconnect']?></td>
        <td align="center" bgcolor="#FFFFFF"><?=ConvertDate($row['date_log'],"short")?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$row['time']?></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
</table>
</div>
		
<?php } ?>
 
 