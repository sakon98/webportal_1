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
	
	$day1 = substr($date1,0,2);
	$month1 = substr($date1,3,2);
	$year1 = substr($date1,6,4);
	$year1 = $year1 - 543;
	
	$date_where1 = $month1.'/'.$day1.'/'.$year1;
	
	$day2 = substr($date2,0,2);
	$month2 = substr($date2,3,2);
	$year2 = substr($date2,6,4);
	$year2 = $year2 - 543;
	
	$date_where2 = $month2.'/'.$day2.'/'.$year2;

	$list = DateDiff($date1,$date2);
	
	 if($list <= 0 or $list > 366){	
		echo "<script type='text/javascript'> window.alert('กรุณาระบุวันเริ่มต้น หรือ ท่านเลือกช่วงเวลาเกิดกว่า 1 ปี') </script>";
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
										convert(varchar,DAY(LNM.STARTCONT_DATE)) + '/' +
										convert(varchar,month(LNM.STARTCONT_DATE)) + '/' +
										convert(varchar,year(LNM.STARTCONT_DATE)+ 543) AS STARTCONT_DATE,
										LNM.PERIOD_PAYAMT AS PERIOD_PAYAMT,
										LNM.PRINCIPAL_BALANCE AS PRINCIPAL_BALANCE
									FROM 
										LNCONTMASTER LNM , LNLOANTYPE LT , MBMEMBMASTER MB, MBUCFPRENAME MBU
									WHERE 
										LNM.LOANTYPE_CODE = LT.LOANTYPE_CODE
										AND LNM.MEMBER_NO = MB.MEMBER_NO
										AND MB.PRENAME_CODE = MBU.PRENAME_CODE
										AND LNM.LOANCONTRACT_NO = '$acc_no' ";
					/*$value = array('LOANTYPE_DESC','PRENAME_DESC','MEMB_NAME','MEMB_SURNAME','LOANCONTRACT_NO','LOANAPPROVE_AMT','STARTCONT_DATE','PERIOD_PAYAMT','PRINCIPAL_BALANCE');
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
					}*/
					
						$resultData = sqlsrv_query($objConnect,$strSQL); 
						
						 while( $row = sqlsrv_fetch_array( $resultData, SQLSRV_FETCH_ASSOC) ) { 
					  
					    $loantype_desc = $row['LOANTYPE_DESC']; 
						$full_name = $row['PRENAME_DESC'].''.$row['MEMB_NAME'].' '.$row['MEMB_SURNAME']; 
						$loancontract_no = $row['LOANCONTRACT_NO']; 
						$loanapprove_amt = $row['LOANAPPROVE_AMT']; 
						$startcont_date = $row['STARTCONT_DATE']; 
						$period_payamt = $row['PERIOD_PAYAMT']; 
						$principal_balance = $row['PRINCIPAL_BALANCE']; 
						
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
					convert(varchar,DAY(LCS.OPERATE_DATE)) + '/' +
				    convert(varchar,month(LCS.OPERATE_DATE)) + '/' +
					SUBSTRING(convert(varchar,year(LCS.OPERATE_DATE)+ 543),3,2) AS OPERATE_DATE,
					convert(varchar,DAY(LCS.SLIP_DATE)) + '/' +
				    convert(varchar,month(LCS.SLIP_DATE)) + '/' +
					SUBSTRING(convert(varchar,year(LCS.SLIP_DATE)+ 543),3,2) AS SLIP_DATE,
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
										AND OPERATE_DATE BETWEEN '$date_where1' 
										AND '$date_where2' 
										AND LCS.LOANCONTRACT_NO = '$acc_no'
										ORDER BY LCS.SEQ_NO  ";
					/*$value=array('OPERATE_DATE','SLIP_DATE','LOANITEMTYPE_CODE','MONEYTYPE_DESC','PRINCIPAL_PAYMENT','INTEREST_PAYMENT','BALANCE','PRINCIPAL_BALANCE');
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
					}*/
					
					$resultData = sqlsrv_query($objConnect,$strSQL); 
		
				 while( $row = sqlsrv_fetch_array( $resultData, SQLSRV_FETCH_ASSOC) ) { 
					  
					    $operate_date = $row['OPERATE_DATE'];
						$slip_date = $row['SLIP_DATE'];
						$loanitemtype_code = $row['LOANITEMTYPE_CODE'];
						$moneytype_desc = $row['MONEYTYPE_DESC'];
						$principal_payment = $row['PRINCIPAL_PAYMENT'];
						$interest_payment = $row['INTEREST_PAYMENT'];
						$balance = $row['BALANCE'];
						$total_a = $row['PRINCIPAL_BALANCE'];						?>
                <tr>
                  <td width="12%" height="20" align="center"><font size="2" face="Tahoma"><?=$operate_date?></font></td>
                  <td width="12%" align="center"><font size="2" face="Tahoma"><?=$slip_date?></font></td>
                  <td width="6%" align="center"><font size="2" face="Tahoma"><?=$loanitemtype_code?></font></td>
                  <td width="11%" align="right"><font size="2" face="Tahoma"><?=number_format($principal_payment,2)?></font></td>
                  <td width="11%" align="right"><font size="2" face="Tahoma"><?=number_format($interest_payment,2)?></font></td>
                  <td width="14%" align="right"><font size="2" face="Tahoma"><?=number_format($balance,2)?></font></td>
                  <td width="13%" align="right"><font size="2" face="Tahoma"><?=number_format($total_a,2)?></font></td>
                  <td width="21%" align="center"><font size="2" face="Tahoma"><?=$moneytype_desc?></font></td>
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
