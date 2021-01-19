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

<?php $insgroupdoc_no = $_POST["insgroupdoc_no"]; ?>

<!-- <table width="100%" border="0" cellspacing="1" cellpadding="6">
  <tr>
    <td align="right">
    <form id="form3" name="form1" method="post" action="">
   		<input name="b_print2" type="button" class="ipt; button1"  onclick="printdiv('div_print1');checkconfirmclosewindow()" value="พิมพ์"  />
      	<input name="aa2" type="submit" id="aa3" value="ปิด"  onclick="checkconfirmclosewindow()" class="button2" />
    </form>
    </td>
  </tr>
</table>-->

<div id="div_print1">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
    <table width="890" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF">
      <tr>
        <td valign="top">
        <table width="100%" border="0" cellspacing="3" cellpadding="0">
          <tr>
            <td width="110" height="85" align="center" valign="middle"><img src="../img/logo.png" width="101" height="72"></td>
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
                  <td height="30" colspan="6" align="center" valign="top"><font size="3" face="Tahoma"><strong>รายละเอียดผู้ทำประกัน</strong></font></td>
                </tr>
               
               
              </table></td>
              </tr>
            <tr>
              <td align="center"><hr size="1" color="#CCCCCC"></td>
            </tr>
            <tr>
              <td align="center"><table width="95%" border="0" cellspacing="3" cellpadding="1">
                <tr>
                  <td width="9%" align="center"><strong><font size="2" face="Tahoma">ลำดับ</font></strong></td>
                  <td width="13%" height="25" align="center"><strong><font size="2" face="Tahoma">วันที่ทำการ</font></strong></td>
                  <td width="13%" align="center"><strong><font size="2" face="Tahoma">วันที่ใบเสร็จ</font></strong></td>
                  <td width="13%" align="right"><strong><font size="2" face="Tahoma">อ้างอิง</font></strong></td>
                  <td width="13%" align="right"><strong><font size="2" face="Tahoma">รายการ</font></strong></td>
                  <td width="13%" align="right"><strong><font size="2" face="Tahoma">งวดชำระ</font></strong></td>
				  <td width="13%" align="right"><strong><font size="2" face="Tahoma">เบี้ยประกัน</font></strong></td>
                  <td width="13%" align="right"><strong><font size="2" face="Tahoma">เบี้ยสะสม</font></strong></td>
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
	                         IGS.MEMBER_NO,   
							 IGS.SEQ_NO,
							 NVL(TO_CHAR(IGS.OPERATE_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA'),'') AS OPERATE_DATE,	
							 NVL(TO_CHAR(IGS.INSGROUPSLIP_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA'),'') AS INSGROUPSLIP_DATE,							   
							 IGS.REFDOC_NO,    
							 IGS.INSITEMTYPE_CODE,  
							 IGS.INSPERIOD_AMT,   
							 IGS.INSPERIOD_PAYMENT,  
							 IGS.INSPRINCE_BALANCE,    
							 IGS.INSTYPE_CODE,     
							 NVL(TO_CHAR(IGS.ENTRY_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA'),'') AS ENTRY_DATE,
							 IGS.ENTRY_ID,   
							 IGS.INSPAYMENT_ARREAR,     
							 IGS.COOPBRANCH_ID,   
							 IGS.MONEYTYPE_CODE,   
							 IGS.INSGROUPDOC_NO,   
							 IGS.INSARREAR_MONTH,   
							 IGS.INSGROUP_ID,   
							 IUIT.INSITEM_DESC  
						FROM INSGROUPSTATEMENT IGS,   
							 INSUCFITEMPTYPE IUIT 
					   WHERE ( IGS.INSITEMTYPE_CODE = IUIT.INSITEMTYPE_CODE (+)) AND  
							  ( ( TRIM(IGS.MEMBER_NO) = '$member_no' ) AND 
							  (TRIM(IGS.INSGROUPDOC_NO) = '$insgroupdoc_no' ) ) ORDER BY IGS.SEQ_NO  ";
					$value = array('MEMBER_NO','SEQ_NO','OPERATE_DATE','INSGROUPSLIP_DATE','REFDOC_NO','INSITEMTYPE_CODE','INSPERIOD_AMT','INSPERIOD_PAYMENT','INSPRINCE_BALANCE','INSTYPE_CODE',
					'ENTRY_DATE','ENTRY_ID','INSPAYMENT_ARREAR','COOPBRANCH_ID','MONEYTYPE_CODE','INSGROUPDOC_NO','INSARREAR_MONTH','INSGROUP_ID','INSITEM_DESC');
					list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
					
					
					
					$j=0;
					for($i=0;$i<$Num_Rows;$i++){
						$member_no[$i] = $list_info[$i][$j++];
						$seq_no[$i] = $list_info[$i][$j++];
						$operate_date[$i] = $list_info[$i][$j++];
						$insgroupslip_date[$i] = $list_info[$i][$j++];
						$refdoc_no[$i] = $list_info[$i][$j++];
						$insitemtype_code[$i] = $list_info[$i][$j++];
						$insperiod_amt[$i] = $list_info[$i][$j++];
						$insperiod_payment[$i] = $list_info[$i][$j++];
						$insprince_balance[$i] = number_format($list_info[$i][$j++],2);
						$instype_code[$i] = $list_info[$i][$j++];
						$entry_date[$i] = $list_info[$i][$j++];
						$entry_id[$i] = $list_info[$i][$j++];
						$inspayment_arrear[$i] = number_format($list_info[$i][$j++],2);
						$coopbranch_id[$i] = $list_info[$i][$j++];
						$moneytype_code[$i] = $list_info[$i][$j++];
						$insgroupdoc_no[$i] = $list_info[$i][$j++];
						$insarrear_month[$i] = $list_info[$i][$j++];
						$insgroup_id[$i] = $list_info[$i][$j++];
						$insitem_desc[$i] = $list_info[$i][$j++];
						
						$j=0;
						
					}
				?>
              <table width="95%" border="0" cellspacing="3" cellpadding="1">
              <?php for($i=0;$i<$Num_Rows;$i++){ ?>
                <tr>
                  <td width="12%" align="center"><font size="2" face="Tahoma"><?=$i+1?></font></td>
                  <td width="6%" height="23" align="left"><font size="2" face="Tahoma"><?=$operate_date[$i]?></font></td>
                  <td width="25%" align="center"><font size="2" face="Tahoma"><?=$insgroupslip_date[$i]?></font></td>
                  <td width="13%" align="center"><font size="2" face="Tahoma"><?=$refdoc_no[$i]?></font></td>
                  <td width="13%" align="center"><font size="2" face="Tahoma"><?=$insitemtype_code[$i]?></font></td>
                  <td width="15%" align="center"><font size="2" face="Tahoma"><?=$insperiod_amt[$i]?></font></td>
                  <td width="16%" align="center"><font size="2" face="Tahoma"><?=$insperiod_payment[$i]?></font></td>
				  <td width="16%" align="right"><font size="2" face="Tahoma"><?=$insprince_balance[$i]?></font></td>
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
