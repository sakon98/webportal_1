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
   		<input name="b_print2" type="button" class="ipt; button1"  onclick="printdiv('div_print1');checkconfirmclosewindow()" value="พิมพ์"  />
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
	
	/* if($list <= 0 or $list > 366){	
		echo "<script type='text/javascript'> window.alert('กรุณาระบุวันเริ่มต้น หรือ ท่านเลือกช่วงเวลาเกิดกว่า 1 ปี') </script>";
		echo "<script type='text/javascript'> window.close(); </script>";
	 }*/
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
            <td width="110" height="85" align="center" valign="middle"><img src="../img/logo.png" alt="" width="101" height="72"></td>
            <td width="771"><table width="100%" border="0" cellspacing="5" cellpadding="0">
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
                  <td height="30" colspan="6" align="center" valign="top"><font size="3" face="Tahoma"><strong>รายการเคลื่อนไหวบัญชีเงินกู้</strong></font></td>
                </tr>
                <?php 
					$strSQL = "SELECT   
										LT.LOANTYPE_DESC AS LOANTYPE_DESC,
										MBU.PRENAME_DESC AS PRENAME_DESC,
										MB.MEMB_NAME AS MEMB_NAME,
										MB.MEMB_SURNAME AS MEMB_SURNAME,
										LNM.LOANCONTRACT_NO AS LOANCONTRACT_NO,
										LNM.LOANAPPROVE_AMT AS LOANAPPROVE_AMT,
										TO_CHAR(LNM.STARTCONT_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA')AS STARTCONT_DATE,
										LNM.PERIOD_PAYAMT AS PERIOD_PAYAMT,
										LNM.PRINCIPAL_BALANCE AS PRINCIPAL_BALANCE
									FROM 
										LNCONTMASTER LNM , LNLOANTYPE LT , MBMEMBMASTER MB, MBUCFPRENAME MBU
									WHERE 
										LNM.LOANTYPE_CODE = LT.LOANTYPE_CODE
										AND LNM.MEMBER_NO = MB.MEMBER_NO
										AND MB.PRENAME_CODE = MBU.PRENAME_CODE
										AND LNM.LOANCONTRACT_NO = '$acc_no' ";
					$value = array('LOANTYPE_DESC','PRENAME_DESC','MEMB_NAME','MEMB_SURNAME','LOANCONTRACT_NO','LOANAPPROVE_AMT','STARTCONT_DATE','PERIOD_PAYAMT','PRINCIPAL_BALANCE');
					list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
					$j=0;
					for($i=0;$i<$Num_Rows;$i++){
						$loantype_desc = $list_info[$i][$j++];
						$full_name = $list_info[$i][$j++].''.$list_info[$i][$j++].'  '.$list_info[$i][$j++];
						$loancontract_no = $list_info[$i][$j++];
						$loanapprove_amt = $list_info[$i][$j++];
						$startcont_date = $list_info[$i][$j++];
						$period_payamt = $list_info[$i][$j++];
						$principal_balance = $list_info[$i][$j++];
						$j=0;
					}
				?>
                <tr>
                  <td width="10%" height="25" align="left"><strong>ประเภทเงินกู้</strong></td>
                  <td width="24%" align="left"><?=$loantype_desc?></td>
                  <td colspan="2" align="left"><strong>ผู้กู้</strong>
                    <?=$full_name?> 
                    (<?=$member_no?>)</td>
                  <td width="8%" align="right"><strong>ตั้งแต่วันที่</strong></td>
                  <td width="9%" align="right"><?=$date1?> </td>
                  </tr>
                <tr>
                  <td height="25" align="left"><strong>เลขที่สัญญา</strong></td>
                  <td align="left"><?= $loancontract_no?></td>
                  <td colspan="2" align="left"><strong>จำนวนงวดทั้งหมด</strong>
                    <?=$period_payamt?>
                    <strong>งวด</strong></td>
                  <td align="right"><strong>ถึงวันที่</strong></td>
                  <td align="right"><?=$date2?> </td>
                  </tr>
                <tr>
                  <td height="25" align="left"><strong>วันที่รับเงินกู้</strong></td>
                  <td align="left"><?=$startcont_date?></td>
                  <td width="26%" align="left"><strong>ยอดหนี้คงเหลือ</strong>
                    <?=number_format($principal_balance,2)?>
                    <strong>บาท </strong></td>
                  <td colspan="3" align="center"><strong>(-
                      <?=convertthai($principal_balance)?>
-)</strong></td>
                  </tr>
              </table></td>
              </tr>
            <tr>
              <td align="center"><hr size="1" color="#CCCCCC"></td>
            </tr>
            <tr>
              <td align="center">
              <table width="95%" border="0" align="center" cellpadding="1" cellspacing="3">
                <tr>
                  <td width="12%" height="25" align="center"><strong><font size="2" face="Tahoma">วันที่ทำรายการ</font></strong></td>
                  <td width="12%" align="center"><font size="2" face="Tahoma"><strong>วันที่ใบเสร็จ</strong></font></td>
                  <td width="6%" align="center"><font size="2" face="Tahoma"><strong>รายการ</strong></font></td>
                  <td width="11%" align="right"><font size="2" face="Tahoma"><strong>เงินต้น</strong></font></td>
                  <td width="11%" align="right"><font size="2" face="Tahoma"><strong>ดอกเบี้ย</strong></font></td>
                  <td width="14%" align="right"><font size="2" face="Tahoma"><strong>รวมชำระ/งวด</strong></font></td>
                  <td width="13%" align="right"><font size="2" face="Tahoma"><strong>คงเหลือ</strong></font></td>
                  <td width="21%" align="center"><font size="2" face="Tahoma"><strong>หมายเหตุ</strong></font></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td align="center"><hr size="1" color="#CCCCCC"></td>
            </tr>
            <tr>
              <td align="center">
              <table width="95%" border="0" align="center" cellpadding="1" cellspacing="3">
                <?php
					$strSQL = "SELECT
										TO_CHAR(LCS.OPERATE_DATE, 'DD/MM/YY','NLS_CALENDAR=''THAI BUDDHA')AS OPERATE_DATE,
										TO_CHAR(LCS.SLIP_DATE, 'DD/MM/YY','NLS_CALENDAR=''THAI BUDDHA')AS SLIP_DATE,
										LCS.LOANITEMTYPE_CODE AS LOANITEMTYPE_CODE,
										CUM.LOANITEMTYPE_DESC AS MONEYTYPE_DESC,
										LCS.PRINCIPAL_PAYMENT AS PRINCIPAL_PAYMENT,
										LCS.INTEREST_PAYMENT AS INTEREST_PAYMENT,
										LCS.PRINCIPAL_PAYMENT + LCS.INTEREST_PAYMENT  AS BALANCE,
										LCS.PRINCIPAL_BALANCE AS PRINCIPAL_BALANCE
									FROM
										LNCONTSTATEMENT LCS, LNUCFLOANITEMTYPE CUM 
									WHERE
										LCS.LOANITEMTYPE_CODE = CUM.LOANITEMTYPE_CODE 
										AND OPERATE_DATE BETWEEN TO_DATE('$date1','DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') 
										AND TO_DATE('$date2', 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') 
										AND LCS.LOANCONTRACT_NO = '$acc_no'
										ORDER BY LCS.SEQ_NO  ";
					$value=array('OPERATE_DATE','SLIP_DATE','LOANITEMTYPE_CODE','MONEYTYPE_DESC','PRINCIPAL_PAYMENT','INTEREST_PAYMENT','BALANCE','PRINCIPAL_BALANCE');
					list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
					$j=0;
					for($i=0;$i<$Num_Rows;$i++){
						$operate_date[$i] = $list_info[$i][$j++];
						$slip_date[$i] = $list_info[$i][$j++];
						$loanitemtype_code[$i] = $list_info[$i][$j++];
						$moneytype_desc[$i] = $list_info[$i][$j++];
						$principal_payment[$i] = $list_info[$i][$j++];
						$interest_payment[$i] = $list_info[$i][$j++];
						$balance[$i] = $list_info[$i][$j++];
						$total_a[$i] = $list_info[$i][$j++];
						$j=0;
					}
		
				 for($i=0;$i<$Num_Rows;$i++){ ?>
                <tr>
                  <td width="12%" height="20" align="center"><font size="2" face="Tahoma"><?=$operate_date[$i]?></font></td>
                  <td width="12%" align="center"><font size="2" face="Tahoma"><?=$slip_date[$i]?></font></td>
                  <td width="6%" align="center"><font size="2" face="Tahoma"><?=$loanitemtype_code[$i]?></font></td>
                  <td width="11%" align="right"><font size="2" face="Tahoma"><?=number_format($principal_payment[$i],2)?></font></td>
                  <td width="11%" align="right"><font size="2" face="Tahoma"><?=number_format($interest_payment[$i],2)?></font></td>
                  <td width="14%" align="right"><font size="2" face="Tahoma"><?=number_format($balance[$i],2)?></font></td>
                  <td width="13%" align="right"><font size="2" face="Tahoma"><?=number_format($total_a[$i],2)?></font></td>
                  <td width="21%" align="center"><font size="2" face="Tahoma"><?=$moneytype_desc[$i]?></font></td>
                </tr>
              <?php } ?>
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
