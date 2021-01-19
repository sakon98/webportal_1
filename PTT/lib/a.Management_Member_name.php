<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php require "../include/conf.d.php" ?>
<?php require "../include/jquery.popup.php"; ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"><strong><font size="4" face="Tahoma">ระบบจัดการสมาชิก</font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Member Management</font></td>
  </tr>
  <tr>
    <td align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<form id="formID1" name="formID1" method="post" action="">
  <table width="95%" border="0" align="center" cellpadding="3" cellspacing="6">
    <tr>
      <td align="center"><strong><font size="2" face="Tahoma">ค้นหาสมาชิก 
        <label for="search"></label>
        <input name="search" type="text" id="search" size="35" />
         <input type="submit" name="button" id="button" value="ค้นหา" class="button4" />
      </font></strong></td>
    </tr>
  </table>
</form>
<?php 
if($_POST["button"] == "ค้นหา"){
	
		$name = $_POST["search"];
	
                $host = "localhost";
                $user = "root";
                $pass = "WebServer";
                $dbname = "ptt";

                $conn = mysql_connect($host, $user, $pass) or die("ไม่สามารถติดต่อฐานข้อมูลได้ " . mysql_error());

                mysql_select_db($dbname) or die("เชื่อมต่อฐานข้อมูลไม่ได้ " . mysql_error());
                mysql_db_query($dbname,"SET NAMES TIS620");

               /* $sql=mysql_query("select member_no,
                           memb_fullname,
                           password,
                           DATE_FORMAT(date_reg,'%d/%m/%Y') as date_reg
                           from 
                           mbmembmaster where memb_fullname like '%$name%' or member_no like '%$name%'");

                $num=mysql_num_rows($sql);*/
                
                 $strMySQL = "select member_no,
                           memb_fullname,
                           password,
                           DATE_FORMAT(date_reg,'%d/%m/%Y') as date_reg
                           from 
                           mbmembmaster where memb_fullname like '%$name%' or member_no like '%$name%'";
$colunmMySQL = array('member_no','memb_fullname','password','date_reg');
list($rowSQL,$listMySql) = get_value_many_sql($strMySQL,$colunmMySQL);
$ms = 0;
for($sq = 0 ; $sq < $rowSQL ; $sq++){
    
	$_member_no[$sq] = $listMySql[$sq][$ms++]; 
	$_memb_fullname[$sq] = $listMySql[$sq][$ms++]; 
	$_password[$sq] = $listMySql[$sq][$ms++]; 
	$_date_reg[$sq] = $listMySql[$sq][$ms++]; 
$ms = 0;

$strSQL2 = " SELECT MBUCFMEMBGROUP.MEMBGROUP_DESC as  MEMBGROUP_DESC , MBUCFPRENAME.PRENAME_DESC || MBMEMBMASTER.MEMB_NAME || ' ' || MBMEMBMASTER.MEMB_SURNAME AS FULL_NAME
					FROM 
						MBMEMBMASTER  , MBUCFMEMBGROUP ,MBUCFPRENAME
					WHERE
						MEMBER_NO = '$_member_no[$sq]'  and MBMEMBMASTER.MEMBGROUP_CODE = MBUCFMEMBGROUP.MEMBGROUP_CODE and MBUCFPRENAME.PRENAME_CODE = MBMEMBMASTER.PRENAME_CODE";
						$value2 = array('MEMBGROUP_DESC','FULL_NAME');
						list($Num_Rows2,$list_wf) = get_value_many_oci($strSQL2,$value2);
						$membgroup[$sq] = $list_wf[0][0];
                                                $full_name[$sq] = $list_wf[0][1];

}
		?>
<div style="width: 100%; height: 340px; overflow-y: scroll; scrollbar-arrow-color:blue; scrollbar-face-color: #e7e7e7; scrollbar-3dlight-color: #a0a0a0; scrollbar-darkshadow-color:#888888">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#999999"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="13%" align="center" bgcolor="#CCCCFF"><strong>ทะเบียนสมาชิก</strong></td>
        <td width="16%" align="center" bgcolor="#CCCCFF"><strong>ชื่อ - สกุล</strong></td>
        <td width="10%" align="center" bgcolor="#CCCCFF"><strong>Login</strong></td>
        <td width="13%" align="center" bgcolor="#CCCCFF">Password</td>
        <td width="13%" align="center" bgcolor="#CCCCFF"><strong>วันที่สมัครระบบ</strong></td>
        <td width="13%" align="center" bgcolor="#CCCCFF"><strong>สังกัด</strong></td>
      </tr>
    <?php for($sq = 0 ; $sq < $rowSQL ; $sq++){       
        ?>
      <tr>
        <td align="center" bgcolor="#FFFFFF"><?=$_member_no[$sq]?></td>
        <td align="left" bgcolor="#FFFFFF"><?=$full_name[$sq]?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$_member_no[$sq]?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$_password[$sq]?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$_date_reg[$sq]?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$membgroup[$sq]?></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
</table>
</div>
		
<?php } ?>
 
 