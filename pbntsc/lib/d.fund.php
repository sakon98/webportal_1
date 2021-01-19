<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?><head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php  require "../s/s.dividend.php";  ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  <td width="86%" align="left"><strong><font size="4" face="Tahoma">ข้อมูลกองทุน</font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Fund Information</font></td>
    <td width="14%" align="right" valign="top">
    <tr>
	</table>
	
	 <tr>
    <td colspan="2" align="right"><hr color="#999999" size="1"/></td>
  </tr>

<!--<table width="75%" border="0" align="center" cellpadding="0" cellspacing="3">
  <tr>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><font size = "5" color="#FF0000">** รอปรับปรุงข้อมูล **</font></td>
  </tr>
</table>-->

<?php require "../s/s.Benefits.php";  ?>

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
 
  <tr>
    <td bgcolor="#999999"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align="left" bgcolor="#CCCCFF"><table width="100%" border="0" cellspacing="3" cellpadding="3">
          
        </table></td>
        </tr>
      <tr>
        <td align="left" bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr>
            <!--<td width="20%" height="25" align="center" bgcolor="#FFFFFF"><strong>จ่ายคืนดอกเบี้ย <br>ณ 31 พ.ค. 2559</strong></td>
            <td width="13%" align="center" bgcolor="#FFFFFF"><strong>เงินกองทุนสะสม</strong></td>
	    <td width="47%" align="center" bgcolor="#FFFFFF"><strong>จ่ายคืนเงินกองทุน ตามระเบียบกองทุน พ.ศ. 2557 <br>แก้ไขเพิ่มเติม (ครั้งที่1) พ.ศ. 2559 <font color = "green">ณ วันที่ 8 ก.ย. 2559</font></strong></td>
		   <td width="20%" align="center" bgcolor="#FFFFFF"><strong>เงินกองทุนสะสมคงเหลือ</strong></td>-->
		   
		   <td width="100%" align="center" bgcolor="#FFFFFF"><strong>เงินกองทุนสะสมคงเหลือ</strong></td>
            
          </tr>
		<!--  <tr>
		    <?php //if($interest_return != 0){ ?>
            <td height="25" align="right" bgcolor="#FFFFFF"><font color = "red"><b><?php //$interest_return_full ?></b></font></td>
			<?php //} else { ?>
			<td height="25" align="right" bgcolor="#FFFFFF"></td>
			<?php //} ?>
            <td align="right" align="right" bgcolor="#FFFFFF"><?php //echo $fundbalance_full; ?></td>
            <td align="right" align="right" bgcolor="#FFFFFF"><font color = "#3633FF"><b><?php //echo $fundarrear_amt_full ; ?><b></font></td>
			 <td align="right" align="right" bgcolor="#FFFFFF"><?php //echo $fundbalance_2_full; ?></td>

          </tr>-->
		      <tr>
			   <td align="center" align="center" bgcolor="#FFFFFF"><?php echo $fundbalance_2_full; ?></td>
			      </tr>
		   <!--<tr>
		  <td height="25" bgcolor="#FFFFFF"></td>
		  <td height="25" bgcolor="#FFFFFF"></td>
		  <td height="25" bgcolor="#FFFFFF"></td>
		  <td height="25" bgcolor="#FFFFFF"></td>
		  </tr>-->
		  <tr>
		  <td height="25" bgcolor="#FFFFFF" colspan="4" align="center"><font color = "purple"><b>**จ่ายเงินคืนกองทุนช่วยเหลือผู้ค้ำประกันแก่สมาชิกที่สะสมเกิน 10,000 บาทขึ้นไปเท่านั้น</b></font></td>
		  <!--<td height="25" bgcolor="#FFFFFF"></td>
		  <td height="25" bgcolor="#FFFFFF"></td>
		  <td height="25" bgcolor="#FFFFFF"></td>-->
		  </tr>
		  
		  
          <?php ?>
        </table></td>
      </tr>
	  
    </table></td>
  </tr>
 
</table>
