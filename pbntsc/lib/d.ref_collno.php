<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left"><strong><font size="4" face="Tahoma">ข้อมูลการค้ำประกัน</font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Guarantee</font></td>
  </tr>
  <tr>
    <td align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<?php require "../s/s.ref_collno.php"; ?>
<?php if($Num_Rows != 0){?>  
<table width="85%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="13%" align="center" bgcolor="#FF9900"><strong><font color="#FFFFFF">คุณค้ำใคร</font></strong></td>
    <td width="88%" bgcolor="#999999"><table width="100%" border="0" cellspacing="1" cellpadding="5">
      <tr>
        <td width="20%" align="center" bgcolor="#FFCC33">สัญญาเลขที่</td>
        <td width="56%" align="center" bgcolor="#FFCC33">ชื่อ-สกุล (ทะเบียนสมาชิก)</td>
        <td width="24%" align="center" bgcolor="#FFCC33">หนี้คงเหลือ</td>
      </tr>
  	<?php for($a=0;$a<$Num_Rows;$a++) { ?>    
      <tr>
        <td align="center" bgcolor="#FFFFFF"><?=$coll_loan[$a]?></td>
        <td align="left" bgcolor="#FFFFFF"><?=$coll_name[$a]?></td>
        <td align="right" bgcolor="#FFFFFF"><?=$coll_balance[$a]?> บาท</td>
      </tr>
      <?php } ?>   
    </table></td>
  </tr>
</table>
<?php } ?>  
<br />
<?php if($Num_Rows1 != 0){?>  
<table width="85%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="13%" align="center" bgcolor="#3399FF"><strong><font color="#FFFFFF">ใครค้ำคุณ</font></strong></td>
    <td width="88%" bgcolor="#999999"><table width="100%" border="0" cellspacing="1" cellpadding="5">
      <tr>
        <td width="20%" align="center" bgcolor="#66CCCC">สัญญาเลขที่</td>
        <td width="56%" align="center" bgcolor="#66CCCC">ชื่อ-สกุล (ทะเบียนสมาชิก)</td>
        <td width="24%" align="center" bgcolor="#66CCCC">หมายเหตุ</td>
      </tr>
      <?php for($b=0;$b<$Num_Rows1;$b++) { ?>    
      <tr>
        <td align="center" valign="middle" bgcolor="#FFFFFF"><?=$coll_loan_r[$b]?></td>
        <td align="left" valign="top" bgcolor="#FFFFFF">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <?php require "../s/s.ref_collno1.php"; ?>
            <?php for($c=0;$c<$Num_Rows2;$c++) { ?>    
              <tr>
                <td align="left"><?=$who_coll_name[$c]?></td>
              </tr>
              <?php } ?> 
            </table>
        </td>
        <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <?php }  ?>  
      
    </table>
    </td>
  </tr>
</table>
<?php } ?>  
<table width="85%" border="0" align="center" cellpadding="0" cellspacing="3">
  <tr>
    <td align="right"><font color="#FF0000">* ระบบจะแสดงเฉพาะสัญญาที่มี <strong>บุคคล</strong>  ค้ำประกันเท่านั้น</font></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
  </tr>
</table>
