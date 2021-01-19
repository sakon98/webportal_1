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
require "../s/s.member_info.php";
require "../s/s.share.php";
require "../s/s.ref_collno.php";
require "../s/s.payment.php";

 $receipt_no = $_POST["receipt_no"];
 $slip_date_lpx = $_POST["slip_date_lpx"];
 $show_date = $_POST["show_date"];

?>
<div id="div_print1">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
    <table width="800" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF">
      <tr>
        <td valign="top">
        <table width="100%" border="0" cellspacing="3" cellpadding="0">
          <tr>
            <td align="right" valign="top"><table width="100%" border="0" cellspacing="5" cellpadding="0">
              <tr>
                <td width="12%" height="45" align="center"><font face='Tahoma' size="5"><strong>
                  <img src="../img/logo.png" alt="" width="80" height="80"></strong></font><br/></td>
                <td width="88%" align="center">
                <font face='Tahoma' size="5"><strong><?=$title?></strong></font><br/>
                <font face='Tahoma' size="5"><strong>ใบเสร็จรับเงิน</strong></font>
                </td>
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
              <td align="center" valign="top"><table width="100%" border="0" cellspacing="4" cellpadding="1">
                <tr>
                  <td width="20%"><strong>เลขที่</strong></td>
                  <td width="47%"><?=$receipt_no?> </td>
                  <td width="15%"><strong>วันที่</strong></td>
                  <td width="30%" align="right"><?=$show_date ?></td>
                </tr>
                <tr>
                  <td><strong>ได้รับเงินจาก</strong></td>
                  <td><?=$full_name ?> </td>
                  <td><strong>เลขทะเบียนสมาชิก</strong></td>
                  <td align="right"><?=$member_no ?></td>
                </tr>
                <tr>
                  <td><strong>หน่วยงาน</strong>&nbsp;&nbsp;</td>
                  <td><?=$membgroup_code ?> - <?=$membgroup ?></td>
                  <td><strong>ดอกเบี้ยสะสม</strong></td>
                  <td align="right"><?=$accum_interest ?></td>
                  </tr>
				   <tr>
                  <td><strong>ทุนเรือนหุ้นยกมา(ต้นปี)</strong>&nbsp;&nbsp;</td>
                  <td><?=$sharebegin_amt ?></td>
                  <td><strong>ทุนเรือนหุ้นสะสม</strong>&nbsp;&nbsp;</td></td>
                  <td align="right"><?=$share_now ?></td>
                  </tr>
              </table></td>
              </tr>
            <tr>
              <td align="center"><hr size="1" color="#CCCCCC"></td>
            </tr>
            <tr>
              <td align="center"><table width="100%" border="0" cellspacing="6" cellpadding="1">
                <tr>
                  <td width="30%" align="center"><strong>รายการชำระ</strong></td>
                  <td width="10%" align="center"><strong>งวดที่</strong></td>
                  <td width="10%" align="right"><strong>เงินต้น</strong></td>
                  <td width="15%" align="right"><strong>ดอกเบี้ย</strong></td>
                  <td width="15%" align="right"><strong>รวมเป็นเงิน</strong></td>
                  <td width="25%" align="right"><strong>เงินต้นคงเหลือ</strong></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td align="center"><hr size="1" color="#CCCCCC"></td>
            </tr>
            <tr>
              <td align="center"><table width="101%" border="0" cellspacing="4" cellpadding="1">
              <?php 
			  
			   $strSQL4 = " 
			   SELECT * FROM (
				SELECT 'ชำระหนี้พิเศษ ' || LM.LOANCONTRACT_NO || 
			' ' || TO_CHAR(LM.SLIP_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') AS LOANCONTRACT_NO,
			LM.PRINCIPAL_PAYMENT,
			LM.INTEREST_PAYMENT,
			LM.PRINCIPAL_PAYMENT + LM.INTEREST_PAYMENT AS SUM_P,
			LM.PRINCIPAL_BALANCE,
			TO_CHAR(LM.SLIP_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') AS SLIP_DATE_LPX,
			LM.REF_DOCNO,L.LOANTYPE_CODE AS LC
			FROM 
			LNCONTMASTER L, LNCONTSTATEMENT LM
			WHERE 
			L.LOANCONTRACT_NO = LM.LOANCONTRACT_NO
			AND LM.REF_DOCNO = '$receipt_no' 
			AND LM.LOANITEMTYPE_CODE = 'LPX' AND LM.ITEM_STATUS = 1
			UNION
			SELECT 'ชำระหุ้นพิเศษ ' || 
			' ' || TO_CHAR(SH.SLIP_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') AS LOANCONTRACT_NO,
			SH.SHARE_AMOUNT * 10 AS PRINCIPAL_PAYMENT,
			0 AS INTEREST_PAYMENT,
			SH.SHARE_AMOUNT * 10 AS SUM_P,
			SH.SHARESTK_AMT * 10 AS PRINCIPAL_BALANCE,
			TO_CHAR(SH.SLIP_DATE, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') AS SLIP_DATE,
			SH.REF_DOCNO,'01' as LC
			FROM 
			SHSHARESTATEMENT SH
			WHERE  
			SH.REF_DOCNO = '$receipt_no' 
			AND SH.SHRITEMTYPE_CODE = 'SPX' AND SH.ITEM_STATUS = 1
			) ORDER BY to_number(LC)
					 ";
					
	$value4 = array('LOANCONTRACT_NO','PRINCIPAL_PAYMENT','INTEREST_PAYMENT','SUM_P','PRINCIPAL_BALANCE','SLIP_DATE_LPX','REF_DOCNO');		
	list($Num_Rows4,$slip_show4) = get_value_many_oci($strSQL4,$value4);
			  $w=0;
			  
			  for($u=0;$u<$Num_Rows4;$u++){
			  
			    $loancontract_no[$u] = $slip_show4[$u][$w++]; 
				$principal_payment[$u] = $slip_show4[$u][$w++];
				$interest_payment[$u] = $slip_show4[$u][$w++];
				$sum_p[$u] = $slip_show4[$u][$w++];
				$principal_balance[$u] = $slip_show4[$u][$w++];
				$slip_date_lpx[$u] = $slip_show4[$u][$w++];
				$ref_docno[$u] = $slip_show4[$u][$w++];		
				$w=0;
				
				
			  
			  ?>  
                <tr>
                  <td width="30%" align="left"><?=$loancontract_no[$u]?></td>
                  <td width="10%" align="center"></td>
				  <td width="10%" align="right"><?=number_format($principal_payment[$u],2)?></td>
                  <td width="15%" align="right"><?=number_format($interest_payment[$u],2)?></td>
                  <td width="15%" align="right"><?=number_format($sum_p[$u],2)?></td>
                  <td width="25%" align="right"><?=number_format($principal_balance[$u],2)?></td>
				  
                </tr>
                <?php } ?>
                <tr>
                  <td colspan="7" align="center" valign="middle"><hr size="1" color="#CCCCCC"></td>
                  </tr>
                <tr>
				
				<?php 
				
				  $strSQLL = " 
					SELECT * FROM (
			SELECT
			SUM(LM.PRINCIPAL_PAYMENT) + SUM(LM.INTEREST_PAYMENT) AS SUM_L,
             0 AS SHARE_AMOUNT
			
			FROM 
			LNCONTMASTER L, LNCONTSTATEMENT LM
			WHERE 
			L.LOANCONTRACT_NO = LM.LOANCONTRACT_NO
			AND LM.REF_DOCNO = '$receipt_no' 
			AND LM.LOANITEMTYPE_CODE = 'LPX' AND LM.ITEM_STATUS = 1
			UNION
			SELECT
			0 AS SUM_L,
            NVL(SUM(SH.SHARE_AMOUNT) *10,0) AS SHARE_AMOUNT
			FROM 
			SHSHARESTATEMENT SH
			WHERE 
			SH.REF_DOCNO = '$receipt_no' 
			AND SH.SHRITEMTYPE_CODE = 'SPX' AND SH.ITEM_STATUS = 1)
					 ";
					
				$valuel = array('SUM_L','SHARE_AMOUNT');		
				list($Num_Rowsl,$slip_showl) = get_value_many_oci($strSQLL,$valuel);	
				$m=0;
			  
			  for($l=0;$l<$Num_Rowsl;$l++){
			  
			   $totalpayment_lpx1 = $slip_showl[0][0];  
			   $totalpayment_lpx2 = $slip_showl[0][1];  
               $totalpayment_spx1 = $slip_showl[1][0];   
			   $totalpayment_spx2 = $slip_showl[1][1];  
			   $totalpayment_lpx  = $totalpayment_lpx1 + $totalpayment_lpx2 + $totalpayment_spx1 + $totalpayment_spx2;
			  
		      $m=0;
				
				
			  }
				?>
				
                  <td height="30" colspan="3" align="center" valign="middle"><strong>( -<?=convertthai($totalpayment_lpx)?>- )</strong></td>
                  <td align="right" valign="middle"><strong>รวมเงิน</strong></td>
                  <td width="13%" align="right" valign="middle"><strong><?=number_format($totalpayment_lpx,2)?> </strong></td>
                  <td align="left" valign="middle"><strong>บาท</strong></td>
			 
                </tr>
              </table></td>
            </tr>
            <tr>
              <td align="center"><hr size="1" color="#CCCCCC"></td>
            </tr>

            <tr>
			
			  <tr>
                  <td colspan="4" align="center">&nbsp;</td>
                  </tr>
				  <tr>
             <td colspan="6" align="left"><font size="2" color="blue">*คำอธิบาย*</font></td>
			
            </tr>
			
			<tr>
              <td align="center" valign="top"><table width="100%" border="0" cellspacing="4" cellpadding="1">
			  <?php 
			  
			    $strSQL2 = " 
					SELECT LN.LOANTYPE_CODE,L.PREFIX || ' หมายถึง ' || L.LOANTYPE_DESC as LOANTYPE_DESC
				FROM LNCONTSTATEMENT LM , LNLOANTYPE L , LNCONTMASTER LN
				WHERE   
				LM.LOANCONTRACT_NO = LN.LOANCONTRACT_NO
				AND LN.LOANTYPE_CODE = L.LOANTYPE_CODE(+)
				AND LM.REF_DOCNO = '$receipt_no'  AND LM.ITEM_STATUS = 1 ORDER BY LN.LOANTYPE_CODE
					 ";
					
				$value2 = array('LOANTYPE_DESC');		
				list($Num_Rows2,$slip_show2) = get_value_many_oci($strSQL2,$value2);	
				$a=0;
			  
			  for($b=0;$b<$Num_Rows2;$b++){
			  
			   $loantype_desc1[$b] = $slip_show2[$b][$a++]; 
			  
		      $a=0;
			  
			  ?> 
                <tr>
                  <td width="100%"><font size="2" color="blue"><?php echo $loantype_desc1[$b] ?></font></td>
                </tr>
				<?php } ?>
              </table></td>
              </tr>
			   <tr>
                  <td>&nbsp;</td>
                  </tr>
			
				   
			<!--<tr>
             <td colspan="6" align="left"><font size="3">หลักประกัน</font></td>
            </tr>
			
			 <tr>
              <td align="center" colspan="4"><hr size="1" color="#CCCCCC"></td>
            </tr>
			<td align="center" colspan="6" ><table width="100%" border="0" cellspacing="6" cellpadding="1">
			
		
			
                <tr>
				 <td width="10%" align="center"><strong>ลำดับที่</strong></td>
                  <td width="10%" align="center"><strong>เลขสัญญา</strong></td>
                  <td width="30%" align="center"><strong>ผู้ค้ำประกัน</strong></td>
                  <td width="10%" align="center"><strong>เลขทะเบียนสมาชิก</strong></td>
                </tr>-->
					<?php   /*$strSQL2 = "SELECT LM.LOANCONTRACT_NO,
								CT.LOANCOLLTYPE_DESC,
								LC.REF_COLLNO,
								LC.DESCRIPTION,
								NVL(LM.PRINCIPAL_BALANCE,0)+NVL(LM.WITHDRAWABLE_AMT,0) AS PRNBAL_AMT,
								LC.COLLACTIVE_PERCENT,
								(NVL(LM.PRINCIPAL_BALANCE,0) + NVL(LM.WITHDRAWABLE_AMT,0)) * (LC.COLLACTIVE_PERCENT/100) AS COLLACTIVE_AMT
								FROM LNCONTMASTER LM , LNCONTCOLL LC , LNUCFLOANCOLLTYPE CT
								WHERE (LM.LOANCONTRACT_NO = LC.LOANCONTRACT_NO)
								AND (CT.LOANCOLLTYPE_CODE = LC.LOANCOLLTYPE_CODE)
								AND (LM.CONTRACT_STATUS > 0)
								AND (LM.MEMBER_NO = '$member_no')
								ORDER BY LC.LOANCONTRACT_NO
                        ";
	$value2 = array('LOANCONTRACT_NO','DESCRIPTION','REF_COLLNO');		
	list($Num_Rows2,$slip_show2) = get_value_many_oci($strSQL2,$value2);	

	$b=0;
	for($a=0;$a<$Num_Rows2;$a++){ 
		$loancontract_no 	= $slip_show2[$a][$b++];   				
		$fullname 	= $slip_show2[$a][$b++];			
		$member_no	= $slip_show2[$a][$b++];
		$b=0;*/
			
	?>
			<!-- <tr>
              <td align="center" colspan="6"><hr size="1" color="#CCCCCC"></td>
            </tr>
                <tr>
				  <td width="7%" align="center"><?//=($a+1).'. '?></td>
                  <td width="10%" align="center"><?//=$loancontract_no?></td>
                  <td width="30%" align="center"><?//=$fullname?></td>
                  <td width="10%" align="center"><?//=$member_no?></td>
                </tr>
              <tr>
              <td align="center" colspan="6"><hr size="1" color="#CCCCCC"></td>
            </tr> -->
<?php 	//}  ?>
              <!--</table></td>
			  
			  
			  
            </tr>
	    <tr>
             <td colspan="6" align="left"><font size="2" color="blue">*คำอธิบาย*</font></td>
			
            </tr>
	    <tr>
              <td align="center" valign="top"><table width="100%" border="0" cellspacing="4" cellpadding="1">
			  
			  
			  
			  <?php //for($f=0;$f<$Num_Rows4;$f++){?> 
                <tr>
                  <td width="100%"><font size="2" color="blue"><?php //echo $loantype_desc1[$f] ?></font></td>
                </tr>
				<?php //} ?>
				
				
              </table></td>
              </tr>-->
	       <tr>
                  <td>&nbsp;</td>
                  </tr>	
              <td align="center"><table width="95%" border="0" cellspacing="3" cellpadding="1">
                <tr>
                  <td width="24%" align="center" valign="middle"><strong>ผู้จัดการ</strong></td>
                  <td width="27%" height="50" align="center" valign="middle"><img src="../img/mg.png" width="125" height="47"></td>
                  <td width="17%" align="center" valign="middle"><strong>เจ้าหน้าที่ผู้รับเงิน</strong></td>
                  <td width="32%" align="center" valign="middle"><img src="../img/fn.png" width="99" height="55"></td>
                </tr>
                <tr>
                  <td colspan="4" align="center">&nbsp;</td>
                  </tr>
                <tr>
                  <td colspan="4" align="center"><!--ใบเสร็จรับเงินประจำเดือนจะสมบูรณ์ก็ต่อเมื่อทางสหกรณ์ได้รับเงินที่เรียกเก็บเรียบร้อยแล้ว --></td>
                </tr>
				<tr></tr>
				<tr>
                  <td colspan="4" align="center">เบอร์โทรศัพท์สหกรณ์ : 02-1942377-79</td>
                </tr>
				<tr>
                  <td colspan="4" align="center">&nbsp;&nbsp;เวลาพิมพ์ใบเสร็จ : <?php echo  $s_date;  ?></td>
                </tr>
              </table></td>
            </tr>
          </table>        </td>
        </tr>
    </table></td>
  </tr>
</table>
</div>
</body>
</html>
