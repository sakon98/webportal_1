<?php
function getMname($mn){
$thai_months = array("01"=>"มกราคม","02"=>"กุมภาพันธ์","03"=>"มีนาคม","04"=>"เมษายน","05"=>"พฤษภาคม","06"=>"มิถุนายน","07"=>"กรกฏาคม","08"=>"สิงหาคม","09"=>"กันยายน","10"=>"ตุลาคม","11"=>"พฤศจิกายน","12"=>"ธันวาคม");

return $thai_months[$mn];
}

session_start();
header('Content-Type: text/html; charset=tis-620');
$ses_userid =$_SESSION['ses_userid'];
$member_no = $_SESSION['ses_member_no'];
if($ses_userid <> session_id() or $member_no ==""){
	header("Location: index.php");
}
	require "../include/conf.conn.php";
	require "../include/conf.c.php";
	require "../include/lib.Etc.php";
	require "../include/lib.MySQL.php";
	require "../include/lib.Oracle.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$title?></title>
	<link rel="shortcut icon" href="../img/logo.png">
    <link rel="stylesheet" href="../fonts/thsarabunnew.css" />
   
    <?php require "../include/conf.d.php"; ?>
    <script langauge="javascript">
    function checkconfirmclosewindow(){ if(true){	window.close();	}}
	function printdiv(printpage){
		var headstr = "<html><head><title></title></head><body>";
		var footstr = "</body>";
		var newstr = document.all.item(printpage).innerHTML;
		var oldstr = document.body.innerHTML;
		document.body.innerHTML = headstr+newstr+footstr;
		window.print();
		document.body.innerHTML = oldstr;
		return false;
	}
	</script>
    <style type="text/css">
        @page 
        {
            size: auto;   /* auto is the current printer page size */
            margin: 5mm;  /* this affects the margin in the printer settings */

        }

        body 
        {
            background-color:#FFFFFF; 
            border: solid 0px black ;
            margin: 0.2px;  /* the margin on the content before printing */
	
       }
	body,td,th {padding : 0px;
	font-family: 'THSarabunNew', sans-serif;
	font-size: 13px;
	color: #000;
		}

	#showMe{
    		width: 100%;
		height: 140px;
		background:#0034ae;
		font:15px 'Verdana';
		color:#fff;
		border:0px;
		padding:10px 0px;
		text-align:center;
	}
    </style>
</head>
<body >
<table width="100%" border="0" cellspacing="1" cellpadding="6">
  <tr>
    <td align="center">
    <form id="form3" name="form1" method="post" action="">
   	<input name="b_print2" type="button" class="ipt; button1"  onclick="printdiv('div_print1');checkconfirmclosewindow()" value="พิมพ์"  />
      	<input name="aa2" type="submit" id="aa3" value="ปิด"  onclick="checkconfirmclosewindow()" class="button2" />
    </form>
    </td>
  </tr>
</table>
<?php 
	require "../s/s.confirm.php" ;
?>

<div id="div_print1">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
    <table width="890" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF">
      <tr>
        <td valign="top">
        <table width="100%" border="0" cellspacing="3" cellpadding="0">
          <tr>
            <td width="110" height="85" align="right" valign="middle"><img src="../img/logo.png" width="101" height="72"></td>
            <td width="658"><table width="100%" border="0" cellspacing="5" cellpadding="0">
              <tr>
                <td align="center"><font size="5"><strong><?=$title?></strong></font><br/>
                  <font face='Tahoma' size="2" >
                    
                    </font></td>
              </tr>
              <tr>
                <td align="center"><font  size="3"><strong>หนังสือยืนยันหนี้ / เงินฝากออมทรัพย์</strong></font></td>
              </tr>
              </table></td>
            <td width="110">&nbsp;</td>
          </tr>
          <tr>
            <td align="right" valign="middle">&nbsp;</td>
            <td height="25" align="center"><strong>วันที่ &nbsp;&nbsp;&nbsp;
	<?php  echo date("j"); ?>&nbsp;&nbsp;&nbsp;
	 เดือน&nbsp;&nbsp;&nbsp;
	<?php echo getMname(date("m")); ?>&nbsp;&nbsp;&nbsp;
	 พ.ศ.&nbsp;&nbsp;&nbsp;
	<?php echo date("Y")+543; ?></strong></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="middle"><table width="97%" border="0" align="center" cellpadding="4" cellspacing="2">
              <tr>
                <td width="6%" align="left"><strong>เรียน</strong></td>
                <td colspan="3" align="left"><?=$fullname?></td>
                <td width="10%" align="center"><strong>เลขทะเบียน</strong></td>
                <td width="18%" align="center"><?=$member_no?></td>
                <td width="6%" align="center"><strong>สังกัด</strong></td>
                <td width="36%"><strong>สหกรณ์ออมทรัพย์พนักงานธนาคารออมสิน จำกัด</strong></td>
              </tr>
              <tr>
                <td align="left">&nbsp;</td>
                <td colspan="2" align="left"><strong>ขอเรียนว่าเพียงสิ้นวันที่ 
	  </strong></td>
                <td colspan="2" align="center"><strong>
		<?php
			include("../s/s.getlastconfirmdate.php");
			list( $day,$month, $year) = split('-',$cfdate);
			echo $day . "&nbsp;&nbsp;";
			echo getMname($month) . "&nbsp;&nbsp;";
			echo $year + 543;
		?></strong></td>
                <td colspan="3" align="left"><strong>ท่านเป็นลูกหนี้ มีทุนเรือนหุ้น และเงินฝากออมทรัพย์ ดังนี้</strong></td>
                </tr>
              <tr>
                <td align="left">&nbsp;</td>
                <td width="3%" align="left"><strong>1.</strong></td>
                <td width="16%" align="left"><strong>ทุนเรือนหุ้น</strong></td>
                <td colspan="2" align="left">
	<?PHP 
		$syscode = "SHR";
		include ("../s/s.confirm_data.php");
		echo number_format($mybal[0], 2 , ".",","); ?>
	</td>
                <td align="left"><strong>บาท</strong></td>
                <td align="left">&nbsp;</td>
                <td align="left">&nbsp;</td>
                </tr>
              <tr>
                <td align="left">&nbsp;</td>
                <td align="left"><strong>2.</strong></td>
                <td colspan="6" align="left"><strong>ลูกหนี้เงินกู้</strong></td>
                </tr>
              <tr>
                <td align="left">&nbsp;</td>
                <td colspan="7" align="left" valign="top">
                
                <table width="98%" border="0" align="center" cellpadding="3" cellspacing="2">
                  <?php 
		$syscode = "LON";
		include ("../s/s.confirm_data.php");
		$ab =0;
		$emp_col = 0;
		$end_col = 0;
		
		for($i = 0 ; $i < $Num_Rows; $i++){
		
			if($ab == 0){
			echo "<tr>";
			}

			echo "<td >" . $myacc[$i] . "</td>";
			echo "<td  align='left'>" . number_format($mybal[$i],2 , ".",",") .   "</td>";
			$ab = $ab+1;
			$end_col = $Num_Rows - 1;
			if($i == $end_col){
				$emp_col = 5-$ab;
				for($q = 0 ; $q < $emp_col ; $q++){
				echo "<td ></td>";
				echo "<td ></td>";
				}
			}
			
			if($ab == 4){
			echo "</tr>";
			$ab = 0;
			}
			
		}
	   ?>
                </table>
                
                </td>
                </tr>
              <tr>
                <td align="left">&nbsp;</td>
                <td align="left"><strong>3.</strong></td>
                <td colspan="6" align="left"><strong>เงินฝากออมทรัพย์</strong></td>
              </tr>
              <tr>
                <td align="left">&nbsp;</td>
                <td colspan="7" align="left">
	<table width="98%" border="0" align="left" cellpadding="0" ellspacing="0">
	
	
                  <?php 
		//แสดงข้อมูลเงินฝากแถวละ 5 รายการ
		$syscode = "DEP";
		include ("../s/s.confirm_data.php");
		$ab =0;
		$emp_col = 0;
		$end_col = 0;
		
		for($i = 0 ; $i < $Num_Rows; $i++){
		
			//ถ้าเป็นคอลัมภ์แรก ให้พิมพ์แท็กแสดงแถวก่อน
			if($ab == 0){
			echo "<tr>";
			}

			echo "<td width='10%'>" . $myacc[$i] . "</td>";
			echo "<td width='10%' align='center'>" . number_format($mybal[$i],2 , ".",",") .   "</td>";
			$ab = $ab+1;
			$end_col = $Num_Rows - 1;
			if($i == $end_col){ //ถ้าแถวสุดท้าย มีจำนวนคอลัมภ์น้อยกว่า 5 ให้พิมพ์ซ่อมคอลัมภ์ที่เหลือ
				$emp_col = 5-$ab;
				for($q = 0 ; $q < $emp_col ; $q++){
				echo "<td width='10%'></td>";
				echo "<td width='10%'></td>";
				}
			}
			
			// ถ้าครบทุกๆ 5 บัญชีให้ตัดแถวตารางใหม่
			if($ab == 5){
			echo "</tr>";
			$ab = 0;
			}
			
		}


	    ?>
                </table></td>
                </tr>
         <?php require "../s/s.ref_collno.php"; 
	if($Num_Rows != 0){
	?>
              <tr>
                <td align="left">&nbsp;</td>
                <td align="left"><strong>4.</strong></td>
                <td colspan="6" align="left"><strong>ค้ำประกัน</strong></td>
              </tr>
              <tr>
                <td align="left">&nbsp;</td>
                <td colspan="7" align="left"><table width="98%" border="0" cellspacing="2" cellpadding="3">
               <?php
			   $ao = 0;
			   for($i=0; $i<ceil($Num_Rows/3); $i++){ ?>
                  <tr>
                    <td><?=$coll_name[$ao++]?></td>
                    <td><?=$coll_name[$ao++]?></td>
                    <td><?=$coll_name[$ao++]?></td>
                  </tr>
               <?php }?>
                </table></td>
                </tr>
      <?php } ?>          
              <tr>
                <td colspan="8" align="left">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="8" align="left">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>หนังสือนี้ไม่ใช่เป็นการทวงหนี้ เพียงแต่แจ้งยอดเงินที่เป็นหนี้ มีทุนเรือนหุ้น และเงินฝากออมทรัพย์ของสมาชิกเพื่อตรวจสอบความถูกต้องเมื่อท่านได้ตรวจสอบความถูกต้อง เมื่อท่านได้ตรวจสอบจำนวนเงินดังกล่าวข้างต้นแล้ว ขอได้โปรดส่งหนังสือยืนยันหนี้/เงินฝากออมทรัพย์ ฉบับนี้ไปยัง บริษัท สำนักงานสามสิบสี่ ออดิต จำกัด ผู้สอบบัญชีของสหกรณ์ตามแบบข้างล่างนี้ โดยส่งคืนทั้งฉบับภายใน 7 วัน นับแต่วันรับหนังสือนี้</strong></td>
                </tr>
              <tr>
                <td colspan="8" align="center">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="8" align="center"><strong>ขอแสดงความนับถือ</strong></td>
              </tr>
              <tr>
                <td colspan="8" align="center"><img src="../img/licent.jpg" width="150" ></td>
              </tr>
              <tr>
                <td colspan="8" align="center"><strong>( นายสรศักดิ์&nbsp;&nbsp;&nbsp;พุุทธรักษา )<br>
                  ผู้จัดการสหกรณ์</strong></td>
              </tr>
              <tr> 
				<td valign="top"><hr size="1" color="#FFFFFF"></td>
              </tr>			  
            </table></td>			
            </tr>		
        </table>
		<tr>
			<td valign="top"><hr size="1" color="#999999"></td>
        </tr>
        </td>
        </tr> 
      <tr>
        <td valign="top"><br>
          <table width="97%" border="0" align="center" cellpadding="4" cellspacing="2">
            <tr>
              <td width="6%" align="left"><strong>เรียน</strong></td>
              <td colspan="3" align="left"><strong>คุณศิลป์ชัย รักษาผล </strong></td>
              <td align="left"><strong>ผู้สอบบัญชี</strong></td>
              <td align="left">&nbsp;</td>
              <td width="5%" align="center">&nbsp;</td>
              <td width="34%">&nbsp;</td>
            </tr>
            <tr>
              <td align="left">&nbsp;</td>
              <td colspan="7" align="left"><strong>[ &nbsp;&nbsp;&nbsp; ] ข้าพเจ้าขอเรียนว่ายอดเงินที่แสดงดังกล่าวถูกต้อง</strong></td>
              </tr>
            <tr>
              <td align="left">&nbsp;</td>
              <td width="3%" align="left">1.</td>
              <td width="16%" align="left">ทุนเรือนหุ้น</td>
              <td colspan="2" align="left">
	<?PHP 
		$syscode = "SHR";
		include ("../s/s.confirm_data.php");
		echo number_format($mybal[0], 2 , ".",","); ?>
	</td>
              <td width="18%" align="left">บาท</td>
              <td align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
            </tr>
            <tr>
              <td align="left">&nbsp;</td>
              <td align="left">2.</td>
              <td colspan="6" align="left">ลูกหนี้เงินกู้</td>
            </tr>
            <tr>
              <td align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
              <td colspan="6" align="left">
              
              <table width="98%" border="0" align="center" cellpadding="3" cellspacing="2">
                <?php 
		$syscode = "LON";
		include ("../s/s.confirm_data.php");
		$ab =0;
		$emp_col = 0;
		$end_col = 0;
		
		for($i = 0 ; $i < $Num_Rows; $i++){
		
			if($ab == 0){
			echo "<tr>";
			}

			echo "<td >" . $myacc[$i] . "</td>";
			echo "<td  align='left'>" . number_format($mybal[$i],2 , ".",",") .   "</td>";
			$ab = $ab+1;
			$end_col = $Num_Rows - 1;
			if($i == $end_col){
				$emp_col = 5-$ab;
				for($q = 0 ; $q < $emp_col ; $q++){
				echo "<td ></td>";
				echo "<td ></td>";
				}
			}
			
			if($ab == 4){
			echo "</tr>";
			$ab = 0;
			}
			
		}
	   ?>
              </table></td>
            </tr>
            <tr>
              <td align="left">&nbsp;</td>
              <td align="left">3.</td>
              <td colspan="6" align="left">เงินฝากออมทรัพย์</td>
            </tr>
            <tr>
              <td align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
              <td colspan="6" align="left">
	<table width="98%" border="0" align="left" cellpadding="0" ellspacing="0">
                <?php 
		$syscode = "DEP";
		include ("../s/s.confirm_data.php");
		$ab =0;
		$emp_col = 0;
		$end_col = 0;
		
		for($i = 0 ; $i < $Num_Rows; $i++){
		
			if($ab == 0){
			echo "<tr>";
			}

			echo "<td width='10%'>" . $myacc[$i] . "</td>";
			echo "<td width='10%' align='center'>" . number_format($mybal[$i],2 , ".",",") .   "</td>";
			$ab = $ab+1;
			$end_col = $Num_Rows - 1;
			if($i == $end_col){
				$emp_col = 5-$ab;
				for($q = 0 ; $q < $emp_col ; $q++){
				echo "<td width='10%'></td>";
				echo "<td width='10%'></td>";
				}
			}
			
			if($ab == 5){
			echo "</tr>";
			$ab = 0;
			}
			
		}
	?>
	</table></td>
                </tr>
         <?php require "../s/s.ref_collno.php"; 
	if($Num_Rows != 0){
	?>
              <tr>
                <td align="left">&nbsp;</td>
                <td align="left"><strong>4.</strong></td>
                <td colspan="6" align="left"><strong>ค้ำประกัน</strong></td>
              </tr>
              <tr>
                <td align="left">&nbsp;</td>
                <td colspan="7" align="left"><table width="98%" border="0" cellspacing="2" cellpadding="3">
               <?php
			   $ao = 0;
			   for($i=0; $i<ceil($Num_Rows/3); $i++){ ?>
                  <tr>
                    <td><?=$coll_name[$ao++]?></td>
                    <td><?=$coll_name[$ao++]?></td>
                    <td><?=$coll_name[$ao++]?></td>
                  </tr>
               <?php }?>
                </table></td>
                </tr>
      <?php } ?>          
              <tr>
                <td
	
	
	
            
            
            <tr>
              <td align="center">&nbsp;</td>
              <td colspan="7" align="left"><strong>[ &nbsp;&nbsp;&nbsp; ] ข้าพเจ้าขอเรียนว่ายอดเงินดังกล่าวไม่ถูกต้องทุกจำนวน</strong></td>
            </tr>
            <tr>
              <td align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
              <td colspan="6" align="left">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="8" align="left"><table width="95%" border="0" align="center" cellpadding="3" cellspacing="3">
                <tr align="left" valign="bottom">
                  <td width="6%" height="44" align="right"><strong>ลงชื่อ</strong></td>
                  <td width="28%" align="left">..........................................................</td>
                  <td width="66%"><strong>เลขทะเบียน</strong>
                    <?= $member_no?></td>
                </tr>
                <tr>
                  <td align="center" valign="bottom">&nbsp;</td>
                  <td align="center" valign="bottom">( <?=$fullname?> )</td>
                  <td valign="bottom">&nbsp;</td>
                </tr>
                <tr>
                  <td align="center" valign="bottom">&nbsp;</td>
                  <td valign="bottom">&nbsp;</td>
                </tr>
              </table></td>
              </tr>
          </table></td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><form id="form" name="form1" method="post" action="">
      <input name="b_print" type="button" class="ipt; button1"  onclick="printdiv('div_print1');checkconfirmclosewindow()" value="พิมพ์"  />
      <input name="aa" type="submit" id="aa" value="ปิด"  onclick="checkconfirmclosewindow()" class="button2" />
    </form></td>
  </tr>
<tr>
<td>
<?php 
	include "../s/s.checkconfirm.php" ;
	if($chk_cf == true){
?>

<div id="showMe"><center>
<b>ท่านยังไม่ได้ยืนยันยอดกับทางสหกรณ์ กรุณากรอกข้อมูลด้านล่างเพื่อยืนยันการตรวจยอดของท่าน</center></b><br>
    <form name="cfbal" method="post" action = "saveconfirm.php">
	<input type="radio" name="cfstatus" value="1" checked>ข้าพเจ้าขอรับรองยอดคงเหลือทั้งหมดตามนี้ &nbsp;&nbsp; | &nbsp;&nbsp;
	<input type="radio" name="cfstatus" value="-1" > ยังไม่ถูกต้อง&nbsp;&nbsp;&nbsp;โปรดระบุยอดที่ไม่ตรง
	&nbsp;&nbsp;<input type="text" name="remark" size="35" maxlength ="100">
	<br><font size=2>* เช่น เงินฝาก หุ้น (สัญญาเลขที่) xx12345 เป็นต้น (จำกัด 100 ตัวอักษร)</font>
	<input type="hidden" name="mem_no" value= "<?= $member_no?>">
	<input type="hidden" name="mem_name" value = "<?=$fullname?>">
	<input type="hidden" name="conf_period" value = "<?=$year.'-'.$month.'-'. $day?>">
	<br><br><input  type="submit" value="ตกลง" class="ipt; button1">
    </form>
</center>
<br>
   </div>

<?PHP
	}else{
?>
	<div style="width:100%;height:140;border:0px;text-align:center;font:16px Verdana;color:#fff;background:#008612;"><br><br>
		<img src="../img/tick.png" width="25px"> ท่านทำการยืนยันยอดกับทางสหกรณ์ในรอบนี้ไปเรียบร้อยแล้ว
   	</div>

<?PHP } ?>
</td>
</tr>
</table>
</body>
</html>
