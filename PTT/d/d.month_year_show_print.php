<?php
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
	require "../include/lib.Oracle.php";
?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$title?></title>
	<link rel="shortcut icon" href="../img/logo.png">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <?php require "../include/conf.d.php" ?>

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
            margin: 0mm;  /* this affects the margin in the printer settings */

        }

        body 
        {
            background-color:#FFFFFF; 
            border: solid 0px black ;
  	    margin: 0.0px; 
            

       }
		body,td,th {
			font-family: Tahoma, Geneva, sans-serif;
			font-size: 12px;
			color: #000;
  	    margin: 0.0px; 
		}

</style>
<script>
function myFunction() {
    window.print();
}
</script>
</head>
<body >

<?php 
 $month = $_POST["month"]; 
 $year = $_POST["year"];



$year_th = $year + 543;

if($month == "01" || $month == "03" || $month == "05" || $month == "07" || $month == "08" || $month == "10" || $month == "12"){
    
    $day = "31";
    
}else if ($month == "04" || $month == "06" || $month == "09" || $month == "11"){
    
    $day = "30";
    
}else if ($month == "02"){
    
    $day = "28";
    
}

$date_th = $day."/".$month."/".$year;

?>

<?php
require "../s/s.member_status.php";
?>

    <form id="form3" name="form1" method="post" action="">
   		<input name="b_print2" type="button" class="ipt; button1"  onclick="printdiv('div_print1');checkconfirmclosewindow()" value="พิมพ์" style="margin-left: 200px;" />
      	<!--<input name="aa2" type="submit" id="aa3" value="ปิด"  onclick="checkconfirmclosewindow()" class="button2" style="margin-right: 0px;"/>-->
    </form>


<div id="div_print1">
<center><h3>ใบเเจ้งสถานะสภาพสมาชิก</h3></center>
<center><h3>สหกรณ์ออมทรัพย์ ปตท จำกัด</h3></center>

<table width="850px" border="0" align="center" cellpadding="1" cellspacing="6">
  <tr>
    <td width="170px" align="right">ทะเบียนสมาชิก :</td>
    <td width="90px" align="left" bgcolor="#D3D3D3"><?= $member_no?></td>
    <td width="140px" align="right">ชื่อ - สกุล :</td>
    <td width="200px" align="left" bgcolor="#D3D3D3"><?= $full_name?></td>
    <td width="170px" align="right">รหัสหน่วยงาน :</td>
    <td width="110px" align="left" bgcolor="#D3D3D3"><?= $membgroup_code?></td>
  </tr>
  <tr>
    <td align="right">รหัสสังกัด :</td>
    <td align="left" bgcolor="#D3D3D3"><?= $membgroup_code?></td>
    <td align="right">ชื่อหน่วยงาน :</td>
    <td align="left" bgcolor="#D3D3D3"><?= $membgroup_desc?></td>
    <td align="right">วันที่เป็นสมาชิก :</td>
    <td align="left" bgcolor="#D3D3D3"><?= ConvertDate($member_date,"short")?></td>
  </tr>
  <tr>
    <td align="right">อายุการเป็นสมาชิก :</td>
    <td align="left" bgcolor="#D3D3D3">(<?= count_member($member_date,'ym')?>)</td>
    <td align="right">สถานะภาพสมาชิก :</td>
    <td align="left" bgcolor="#D3D3D3"><?= $member_status?></td>
    <td align="right">ว.ด.ป ที่รับรองสถานะภาพ :</td>
    <td align="left" bgcolor="#D3D3D3"><?= ConvertDate($date_th,"short") ?></td>
  </tr>
  <tr>
    <td align="right">ส่งค่าหุ้นงวดละ(บาท) :</td>
    <td align="left" bgcolor="#D3D3D3"><?= $periodshare_amt?></td>
    <td align="right">จำนวนหุ้นสะสม(หุ้น) :</td>
    <td align="left" bgcolor="#D3D3D3"><?= $sharestk_amt?></td>
    <td align="right">ค่าหุ้นสะสม(บาท) :</td>
    <td align="left" bgcolor="#D3D3D3"><?= $sharestk_amt_th?></td>
  </tr>
</table>



<table width="650px" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td valign="top"   > 
          
          <table width="650px" border="0" cellspacing="0" cellpadding="0">
            <tr>
               <td align="center"><hr size="1" color="#CCCCCC"></td> 
            </tr>
            <tr>
              <td align="center"><table width="650px" border="0" cellspacing="1" cellpadding="1">
                <tr>
                  <td width="25%" align="center" bgcolor="#6699FF">ประเภทเงินกู้</td>
                  <td width="10%" align="center" bgcolor="#6699FF">เลขที่สัญญา</td>
                  <td width="10%" align="center" bgcolor="#6699FF">ว.ด.ป ขอกู้</td>
                  <td width="10%" align="right" bgcolor="#6699FF">จำนวนเงินกู้</td>
                  <td width="10%" align="right" bgcolor="#6699FF">จำนวนเงินคงเหลือ</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td align="center"><hr size="1" color="#CCCCCC"></td>
            </tr>
            <tr>
              <td align="center"><table width="650px" border="0" cellspacing="2" cellpadding="1">
              <?php for($b=0;$b<$Num_Rows1;$b++){?>  
                <tr>
                  <td width="25%" align="left" bgcolor="#FFFFFF"><?=$loantype[$b]?></td>
                  <td width="10%" align="center" bgcolor="#FFFFFF"><?=$loancontract_no[$b]?></td>
                  <td width="10%" align="center" bgcolor="#FFFFFF"><?=ConvertDate($statcont_date[$b],"short")?></td>
                  <td width="10%" align="right" bgcolor="#FFFFFF"><?=$loanapprove_amt[$b]?></td>
                  <td width="10%" align="right" bgcolor="#FFFFFF"><?=$principal_balance[$b]?></td>
                </tr>
                <?php } ?>
                <tr>
                  <td colspan="7" align="center" valign="middle"><hr size="1" color="#CCCCCC"></td>
                  </tr>
                
              </table></td>
            </tr>
            
            <tr>
              <td align="center"></td>
            </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
</table>



<table width="650px" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center" valign="top">
    <table width="650px" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF">
      
    
      <tr>
        <td valign="top">
          
          <table width="650px" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center" valign="top"></td>
              </tr>
            <tr>
              <td align="center"><hr size="1" color="#CCCCCC"></td>
            </tr>
            <tr>
              <td align="center"><table width="650px" border="0" cellspacing="1" cellpadding="0">
                <tr>
                  <td width="25%" align="center" bgcolor="#6699FF">ประเภทเงินฝาก</td>
                  <td width="20%" align="center" bgcolor="#6699FF">เลขที่บัญชี</td>
                  <td width="20%" align="center" bgcolor="#6699FF">รวมจำนวนเงินฝาก</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td align="center"><hr size="1" color="#CCCCCC"></td>
            </tr>
            <tr>
              <td align="center"><table width="650px" border="0" cellspacing="1" cellpadding="0">
              <?php for($d=0;$d<$Num_Rows2;$d++){?>  
                <tr>
                  <td width="25%" align="left" bgcolor="#FFFFFF"><?=$depttype_desc[$d]?></td>
                  <td width="20%" align="center" bgcolor="FFFFFF"><?=$deptaccount_no[$d]?></td>
                  <td width="20%" align="right" bgcolor="#FFFFFF"><?=$prncbal[$d]?></td>
                </tr>
                <?php } ?>
                <tr>
                  <td colspan="7" align="left" valign="middle"><hr size="1" color="#CCCCCC">***ส่วนนี้สมาชิกเก็บไว้เป็นหลักฐาน
		<br>.................................................................................................................................................................</br></td>
                  </tr>
              </table></td>
            </tr>

          </table></td>
        </tr>
    </table></td>
  </tr>
</table>


<center><h3>ใบเเจ้งสถานะสภาพสมาชิก</h3></center>
<center><h3>สหกรณ์ออมทรัพย์ ปตท จำกัด</h3></center>

<table width="850" border="0" align="center" cellpadding="1" cellspacing="6">
  <tr>
    <td width="170px" align="right">ทะเบียนสมาชิก :</td>
    <td width="90px" align="left" bgcolor="#D3D3D3"><?= $member_no?></td>
    <td width="140px" align="right">ชื่อ - สกุล </td>
    <td width="200px" align="left" bgcolor="#D3D3D3"><?= $full_name?></td>
    <td width="170px" align="right">รหัสหน่วยงาน :</td>
    <td width="110px" align="left" bgcolor="#D3D3D3"><?= $membgroup_code?></td>
  </tr>
  <tr>
    <td align="right">รหัสสังกัด :</td>
    <td align="left" bgcolor="#D3D3D3"><?= $membgroup_code?></td>
    <td align="right">ชื่อหน่วยงาน :</td>
    <td align="left" bgcolor="#D3D3D3"><?= $membgroup_desc?></td>
    <td align="right">วันที่เป็นสมาชิก :</td>
    <td align="left" bgcolor="#D3D3D3"><?= ConvertDate($member_date,"short")?></td>
  </tr>
  <tr>
    <td align="right">อายุการเป็นสมาชิก :</td>
    <td align="left" bgcolor="#D3D3D3">(<?= count_member($member_date,'ym')?>)</td>
    <td align="right">สถานะภาพสมาชิก :</td>
    <td align="left" bgcolor="#D3D3D3"><?= $member_status?></td>
    <td align="right">ว.ด.ป ที่รับรองสถานะภาพ :</td>
    <td align="left" bgcolor="#D3D3D3"><?= ConvertDate($date_th,"short") ?></td>
  </tr>
  <tr>
    <td align="right">ส่งค่าหุ้นงวดละ(บาท) :</td>
    <td align="left" bgcolor="#D3D3D3"><?= $periodshare_amt?></td>
    <td align="right">จำนวนหุ้นสะสม(หุ้น) :</font></td>
    <td align="left" bgcolor="#D3D3D3"><?= $sharestk_amt?></td>
    <td align="right">ค่าหุ้นสะสม(บาท) :</td>
    <td align="left" bgcolor="#D3D3D3"><?= $sharestk_amt_th?></td>
  </tr>
</table>
<br />


<table width="650px" border="0" cellspacing="0" cellpadding="0" align="center"> 
        <tr>
        <td valign="top"   > 
          
          <table width="650px" border="0" cellspacing="0" cellpadding="0">
            <tr>
               <td align="center"><hr size="1" color="#CCCCCC"></td> 
            </tr>
            <tr>
              <td align="center"><table width="650px" border="0" cellspacing="1" cellpadding="1">
                <tr>
                  <td width="25%" align="center" bgcolor="#6699FF">ประเภทเงินกู้</td>
                  <td width="10%" align="center" bgcolor="#6699FF">เลขที่สัญญา</td>
                  <td width="10%" align="center" bgcolor="#6699FF">ว.ด.ป ขอกู้</td>
                  <td width="10%" align="right" bgcolor="#6699FF">จำนวนเงินกู้</td>
                  <td width="10%" align="right" bgcolor="#6699FF">จำนวนเงินคงเหลือ</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td align="center"><hr size="1" color="#CCCCCC"></td>
            </tr>
            <tr>
              <td align="center"><table width="650px" border="0" cellspacing="1" cellpadding="1">
              <?php for($b=0;$b<$Num_Rows1;$b++){?>  
                <tr>
                  <td width="25%" align="left" bgcolor="#FFFFFF"><?=$loantype[$b]?></td>
                  <td width="10%" align="center" bgcolor="#FFFFFF"><?=$loancontract_no[$b]?></td>
                  <td width="10%" align="center" bgcolor="#FFFFFF"><?=ConvertDate($statcont_date[$b],"short")?></td>
                  <td width="10%" align="right" bgcolor="#FFFFFF"><?=$loanapprove_amt[$b]?></td>
                  <td width="10%" align="right" bgcolor="#FFFFFF"><?=$principal_balance[$b]?></td>
                </tr>
                <?php } ?>
                <tr>
                  <td colspan="7" align="center" valign="middle"><hr size="1" color="#CCCCCC"></td>
                  </tr>
                
              </table></td>
            </tr>
            
            <tr>
              <td align="center"></td>
            </tr>
          </table>        </td>
        </tr>
    </table></td>
  </tr>
</table>



<table width="650px" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center" valign="top">
    <table width="650px" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF">

      <tr>
        <td valign="top">
          
          <table width="650px" border="0" cellspacing="0" cellpadding="0" align="center">
            <tr>
              <td align="center" valign="top"></td>
              </tr>
            <tr>
              <td align="center"><hr size="1" color="#CCCCCC"></td>
            </tr>
            <tr>
              <td align="center"><table width="650px" border="0" cellspacing="1" cellpadding="0" >
                <tr>
                  <td width="25%" align="center" bgcolor="#6699FF">ประเภท</td>
                  <td width="20%" align="center" bgcolor="#6699FF">เลขที่บัญชี</td>
                  <td width="20%" align="center" bgcolor="#6699FF">รวมจำนวนเงินฝาก</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td align="center"><hr size="1" color="#CCCCCC"></td>
            </tr>
            <tr>
              <td align="center"><table width="650px" border="0" cellspacing="1" cellpadding="0">
              <?php for($d=0;$d<$Num_Rows2;$d++){?>  
                <tr>
                  <td width="25%" align="left" bgcolor="#FFFFFF"><?=$depttype_desc[$d]?></td>
                  <td width="20%" align="center" bgcolor="#FFFFFF"><?=$deptaccount_no[$d]?></td>
                  <td width="20%" align="right" bgcolor="#FFFFFF"><?=$prncbal[$d]?></td>
                </tr>
                <?php } ?>
                <tr>
                  <td colspan="7" align="left" valign="middle"><hr size="1" color="#CCCCCC">
			<br>เรียน ผู้สอบบัญชีสหกรณ์ออมทรัพย์ ปตท. จำกัด </br>
			<br>( ) ถูกต้อง  ( ) ไม่ถูกต้อง</br>
			<br>ระบุ ...........................................................</br>
			<br>ลงชื่อสมาชิก ...............................................</br>
			<br>กรุณาตรวจสอบเเละส่งกลับมายังตู้รับใบเเจ้งสถานะภาพสมาชิก ณ ที่ทำการสหกรณ์</br>
</td>
                </tr>

              </table></td>

            </tr>

          </table>        </td>
        </tr>
    </table></td>
  </tr>
</table>
 </div>



