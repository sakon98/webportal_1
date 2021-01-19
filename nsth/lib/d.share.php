<?php
@session_start();
@header('Content-Type: text/html; charset=tis-620');
?>

<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left"><strong><font size="4" face="Tahoma">ข้อมูลหุ้น</font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Share</font></td>
  </tr>
  <tr>
    <td align="left"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<?php  require "../s/s.share.php"; ?>
<table width="85%" border="0" align="center" cellpadding="1" cellspacing="6">
  <tr>
    <td width="32%" height="35" align="center" bgcolor="#CCCCFF">หุ้นสะสมรวม <font color="#FF6600"><strong><?= number_format($SHARE_AMT,2) ?></strong></font> บาท</td>
    <td width="40%" align="center" bgcolor="#CCCCFF">ส่งหุ้นงวดละ <font color="#FF6600"><strong><?= number_format($PERIODSHARE_AMT,2) ?></strong></font> บาท</td>
    <td width="28%" align="center" bgcolor="#CCCCFF">งวดปัจจุบัน <font color="#FF6600"><strong><?= $LAST_PERIOD ?></strong></font></td>
  </tr>
</table>
<br />
<?php
 require "../s/s.share1.php"; 
 if(@$_POST["shareyear"] == ""){
	 $show_share = $maxyear;
 }else{
	 $show_share = $_POST["shareyear"] ;
 }
 
 ?>

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="86%" align="left"><strong><font size="4" face="Tahoma">รายการเดินบัญชีหุ้นปีบัญชี <?=$show_share?></font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Share Statment</font></td>
    <td width="14%" align="right" valign="top">
    <form id="form1" name="form1" method="post" action="">
      <select name="shareyear" id="shareyear" onchange="this.form.submit()">
      	<option value="">-- กรุณาเลือกปีบัญชี --</option>	
        <?php for($i=$maxyear;$i >= $minyear; $i--) {?>
        <option value="<?=$i?>"><?=$i?></option>
		<?php } ?>
        </select>
    </form></td>
  </tr>
</table>
<?php
 require "../s/s.share2.php";  
 ?><br/>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#999999"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="13%" height="33" align="center" bgcolor="#CCCCFF"><strong>วันที่ใบเสร็จ</strong></td>
        <td width="13%" align="center" bgcolor="#CCCCFF"><strong>วันที่ทำรายการ</strong></td>
        <td width="13%" align="center" bgcolor="#CCCCFF"><strong>รหัสทำรายการ</strong></td>
        <td width="13%" align="center" bgcolor="#CCCCFF">&nbsp;</td>
        <td width="13%" align="center" bgcolor="#CCCCFF"><strong>ฝาก</strong></td>
        <td width="15%" align="center" bgcolor="#CCCCFF"><strong>ยอดคงเหลือ</strong></td>
        <td width="33%" align="center" bgcolor="#CCCCFF"><strong>หมายเหตุ</strong></td>
      </tr>
   
      <tr><?php while( $row = sqlsrv_fetch_array( $resultData, SQLSRV_FETCH_ASSOC) ) { 
	  
	  $slip_date = $row['SLIP_DATE'];
	   $operate_date = $row['OPERATE_DATE'];
	   $shritemtype_code = $row['SHRITEMTYPE_CODE'];
	   $shritemtype_desc = $row['SHRITEMTYPE_DESC'];
	   $share_amount = $row['SHARE_AMOUNT'];
	   $sharestk_amt = $row['SHARESTK_AMT'];
	  
	  
	  ?>
        <td height="27" align="center" bgcolor="#FFFFFF"><?=$slip_date?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$operate_date?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$shritemtype_code?></td>
        <?php if($share_amount < 0){?>
        <td align="right" bgcolor="#FFFFFF"><font color="#FF0000"><?=number_format($share_amount,2)?></font></td>
        <?php }else{?>
        <td align="right" bgcolor="#FFFFFF"></td>
        <?php }?>
        <?php if($share_amount > 0){?>
        <td align="right" bgcolor="#FFFFFF"><?=number_format($share_amount,2)?></td>
        <?php }else{?>
        <td align="right" bgcolor="#FFFFFF"></td>
        <?php }?>
        <td align="right" bgcolor="#FFFFFF"><?=number_format($sharestk_amt,2)?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$shritemtype_desc ?></td>
      </tr>
    <?php }?>
    </table></td>
  </tr>
</table>
<br/>
