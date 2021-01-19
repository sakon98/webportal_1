<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
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
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$title?></title>
	<link rel="shortcut icon" href="../img/logo.gif">
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
            margin: 5mm;  /* this affects the margin in the printer settings */

        }

        body 
        {
            background-color:#FFFFFF; 
            border: solid 0px black ;
            margin: 0.2px;  /* the margin on the content before printing */

       }
		body,td,th {
			font-family: Tahoma, Geneva, sans-serif;
			font-size: 12px;
			color: #000;
		}

</style>
</head>
<body>
<table width="100%" border="0" cellspacing="1" cellpadding="6">
  <tr>
    <td align="right">
    <form id="form3" name="form1" method="post" action="">
   		<input name="b_print2" type="button" class="ipt button1"  onclick="printdiv('div_print1');checkconfirmclosewindow()" value="พิมพ์"  />
      	<input name="aa2" type="submit" id="aa3" value="ปิด"  onclick="checkconfirmclosewindow()" class="button2" />
    </form>
    </td>
  </tr>
</table>
<?php 
	$acc_no = $_POST["acc_no"];
	$date1 = $_POST["date1"];
	$date2 =  $_POST["date2"];

	$list = DateDiff($date1,$date2);
        
        //echo DateDiff($date1,$date2);
        
        //ฝฝexit();
	
	 if($list <= 0 or $list > 99999){	
		echo "<script type='text/javascript'> window.alert('กรุณาระบุวันเริ่มต้น หรือ ท่านเลือกช่วงเวลาไม่ถูกต้อง) </script>";
		echo "<script type='text/javascript'> window.close(); </script>";
	 }
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
            <td width="85" height="85" align="right" valign="bottom"><img src="../img/sahakorn.png" width="80" height="80"></td>
            <td width="801"><table width="100%" border="0" cellspacing="5" cellpadding="0">
              <tr>
                <td><font face='Tahoma' size="5"><strong>
                  <?=$title?>
                  </strong></font><br/>
                  <font face='Tahoma' size="2" >
                    <?=$address?>
                    </font></td>
              </tr>
              </table></td>
          </tr>
        </table>
        </td>
        </tr>
    
      <tr>
        <td valign="top">
          
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center"><table width="95%" border="0" cellspacing="3" cellpadding="1">
                <tr>
                  <td height="30" colspan="6" align="center" valign="top"><font size="3" face="Tahoma"><strong>รายการเคลื่อนไหวบัญชีเงินฝาก</strong></font></td>
                </tr>
                <?php 
					$strSQL = "SELECT 
										DT.DEPTTYPE_DESC AS DEP_DESC,
										DM.DEPTACCOUNT_NAME AS DEPTACCOUNT_NAME,
										DM.PRNCBAL AS PRNCBAL
									FROM 
										DPDEPTMASTER DM , DPDEPTTYPE DT
									WHERE
										DM.DEPTCLOSE_STATUS!= '1'
										AND DM.DEPTTYPE_CODE = DT.DEPTTYPE_CODE
										AND DM.DEPTACCOUNT_NO = '$acc_no' ";
					$value = array('DEP_DESC','DEPTACCOUNT_NAME','PRNCBAL');
					list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
					$j=0;
					for($i=0;$i<$Num_Rows;$i++){
						$dep_desc = $list_info[$i][$j++];
						$acc_name = $list_info[$i][$j++];
						$prncbal = $list_info[$i][$j++];
						$j=0;
					}
				?>
                <tr>
                  <td width="10%" height="25" align="left"><strong>ประเภทบัญชี</strong></td>
                  <?php if($dep_desc != "ออมทรัพย์พิเศษเปี่ยมสุข 2") {?>
                  <td width="25%" align="left">เงินฝาก<?=$dep_desc?></td>
                  <?php } else { ?>
                  <td width="20%" align="left">เงินฝากออมทรัพย์พิเศษเปี่ยมสุข 4</td>
                  <?php } ?>
                  <td width="6%" align="left"><strong>ชื่อบัญชี</strong></td>
                  <td width="43%" align="left"><?=$acc_name?> (<?=$member_no?>)</td>
                  <td width="7%" align="right"><strong>ตั้งแต่วันที่</strong></td>
                  <td width="9%" align="right"><?=$date1?> </td>
                  </tr>
                <tr>
                  <td height="25" align="left"><strong>เลขที่บัญชี</strong></td>
                  <td align="left"><?= GetFormatDep($acc_no)?></td>
                  <td colspan="2" align="left"><strong>จำนวนเงินคงเหลือ</strong> <?=number_format($prncbal,2)?> <strong>บาท</strong></td>
                  <td align="right"><strong>ถึงวันที่</strong></td>
                  <td align="right"><?=$date2?> </td>
                  </tr>
              </table></td>
              </tr>
            <tr>
              <td align="center"><hr size="1" color="#CCCCCC"></td>
            </tr>
            <tr>
              <td align="center"><table width="95%" border="0" cellspacing="3" cellpadding="1">
                <tr>
                  <td width="12%" align="center"><strong><font size="2" face="Tahoma">&nbsp;วันที่ทำรายการ</font></strong></td>
                  <td width="31%" height="25" align="center"><strong><font size="2" face="Tahoma">รหัสทำรายการ</font></strong></td>
                  <td width="13%" align="right"><strong><font size="2" face="Tahoma">ถอน</font></strong></td>
                  <td width="13%" align="right"><strong><font size="2" face="Tahoma">ฝาก</font></strong></td>
                  <td width="15%" align="right"><strong><font size="2" face="Tahoma">ยอดคงเหลือ</font></strong></td>
                  <td width="16%" align="center"><strong><font size="2" face="Tahoma">หมายเหตุ</font></strong></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td align="center"><hr size="1" color="#CCCCCC"></td>
            </tr>
            <tr>
              <td align="center">
				<?php 
					$strSQL = "SELECT 
										TO_CHAR(DDS.OPERATE_DATE, 'DD/MM/YY','NLS_CALENDAR=''THAI BUDDHA')AS OPERATE_DATE,
										DDS.DEPTITEMTYPE_CODE AS ITEM_CODE,
										(SELECT DEPTITEMTYPE_DESC FROM DPUCFDEPTITEMTYPE WHERE DEPTITEMTYPE_CODE=DDS.DEPTITEMTYPE_CODE ) AS ITEM_DESC ,
										(SELECT SIGN_FLAG FROM DPUCFDEPTITEMTYPE WHERE DEPTITEMTYPE_CODE=DDS.DEPTITEMTYPE_CODE ) * DDS.DEPTITEM_AMT AS DEPTITEM_AMT,
										DDS.PRNCBAL AS PRNCBAL
									FROM 
										DPDEPTSTATEMENT DDS
									WHERE 
										DEPTACCOUNT_NO = '$acc_no'
										AND  OPERATE_DATE BETWEEN TO_DATE('$date1', 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') 
										AND TO_DATE('$date2', 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') 
										ORDER BY DDS.SEQ_NO  ";
					$value = array('OPERATE_DATE','ITEM_CODE','ITEM_DESC','DEPTITEM_AMT','PRNCBAL');
					list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
					$j=0;
					for($i=0;$i<$Num_Rows;$i++){
						$operate_date[$i] = $list_info[$i][$j++];
						$item_code[$i] = $list_info[$i][$j++];
						$item_desc[$i] = $list_info[$i][$j++];
						$deptitem_amt[$i] = $list_info[$i][$j++];
						$total[$i] = number_format($list_info[$i][$j++],2);
						
						if($deptitem_amt[$i] > 0 ){ $dep[$i] = number_format($deptitem_amt[$i],2); }
						else if($deptitem_amt[$i] < 0 ){ $withdraw[$i] = number_format($deptitem_amt[$i],2); }
						else{ $dep[$i] = ""; $withdraw[$i] = ""; }
						$j=0;
					}
				?>
              <table width="95%" border="0" cellspacing="3" cellpadding="1">
              <?php for($i=0;$i<$Num_Rows;$i++){ ?>
                <tr>
                  <td width="12%" align="center"><font size="2" face="Tahoma"><?=$operate_date[$i]?></font></td>
                  <td width="6%" height="23" align="center"><font size="2" face="Tahoma"><?=$item_code[$i]?></font></td>
                  <td width="25%" align="left"><font size="2" face="Tahoma">
                    <?=$item_desc[$i]?>
                  </font></td>
                  <td width="13%" align="right"><font size="2" face="Tahoma" color="#FF0000"><?=$withdraw[$i]?></font></td>
                  <td width="13%" align="right"><font size="2" face="Tahoma"><?=$dep[$i]?></font></td>
                  <td width="15%" align="right"><font size="2" face="Tahoma"><?=$total[$i]?></font></td>
                  <td width="16%" align="center">&nbsp;</td>
                </tr>
                <?php } ?>
              </table></td>
            </tr>
            <tr>
              <td align="center"><hr size="1" color="#CCCCCC"></td>
            </tr>
            <tr>
              <td height="30" align="center"><table width="95%" border="0" cellspacing="3" cellpadding="1">
                <tr>
                  <td height="23" align="center"><strong>(-<?=convertthai($prncbal)?>-)</strong></td>
                  <td width="15%" align="right"><strong><?=number_format($prncbal,2)?></strong></td>
                  <td width="16%" align="center">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td align="center"><hr size="1" color="#CCCCCC"></td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
            </tr>
          </table>        </td>
        </tr>
    </table></td>
  </tr>
</table>
</div>
</body>
</html>
