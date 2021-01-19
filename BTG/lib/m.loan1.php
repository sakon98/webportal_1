<?php
session_start();
$member_no = $_SESSION['ses_member_no'];
@header('Content-Type: text/html; charset=tis-620');
?><head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<center><div ><a href="index.php" data-role="button" data-corners="false"  data-icon="arrow-l" data-theme="f">เมนูหลัก </a></div></center>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right"><strong><font size="4" face="Tahoma">ทำรายการเงินกู้</font></strong><br />
      <font color="#FF6600" size="2" face="Tahoma">Loan Statement</font></td>
  </tr>
</table>
<hr color="#999999" size="1"/>

<?php 
	$acc_no = $_GET["acc_no"];

?>

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
										LNM.PRINCIPAL_BALANCE AS PRINCIPAL_BALANCE,
										(((LNM.LOANAPPROVE_AMT-LNM.PRINCIPAL_BALANCE)*100)/LNM.LOANAPPROVE_AMT) AS PAY_PERSENT
									FROM 
										LNCONTMASTER LNM , LNLOANTYPE LT , MBMEMBMASTER MB, MBUCFPRENAME MBU
									WHERE 
										LNM.LOANTYPE_CODE = LT.LOANTYPE_CODE
										AND LNM.MEMBER_NO = MB.MEMBER_NO
										AND MB.PRENAME_CODE = MBU.PRENAME_CODE
										AND LNM.LOANCONTRACT_NO = '$acc_no' ";
					$value = array('LOANTYPE_DESC','PRENAME_DESC','MEMB_NAME','MEMB_SURNAME','LOANCONTRACT_NO','LOANAPPROVE_AMT','STARTCONT_DATE','PERIOD_PAYAMT','PRINCIPAL_BALANCE','PAY_PERSENT');
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
						$pay_persent = $list_info[$i][$j++];
						$j=0;
					}
				?>
<ul data-role="listview" data-inset="true">

          <li>
                 <h3><?= $loancontract_no ?></h3>                            
                <p>ประเภทเงินกู้ : <?= $loantype_desc  ?></p>
                <p><font color="red" size="3"><strong>หนี้คงเหลือ : <?=  number_format($principal_balance,2) ?> ฿</strong></font></p>   
                <p>วงเงินที่ได้รับอนุมัติ : <?= number_format($loanapprove_amt,2)  ?> ฿</p>
                
                <p>วันที่อนุมัติ : <?=$startcont_date?></p>
                <p class="ui-li-aside">ชำระแล้ว <strong><?= number_format($pay_persent ,2) ?> %</strong></p>
            </li> 
			
          <li>
				<h2>รายละเอียด</h2>
				<table > 
				<tr><td align="center"><p><strong>รายการ</strong></p></td> 
				<td align="right"><p><strong>เงินต้น</strong></p></td>
				<td align="right"><p><strong>ดอกเบี้ย</strong></p></td>
				<td align="right"><p><strong>รวมชำระ/งวด</strong></p></td>
				<td align="right"><p><strong>คงเหลือ</strong></p></td>
				</tr>
				 <?php
					$strSQL = "select * from ( SELECT
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
										AND LCS.LOANCONTRACT_NO = '$acc_no'
										ORDER BY LCS.SEQ_NO desc ) where rownum <=5";
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
				   <tr valign="middle"> 
				   <td align="right" valign="middle" colspan="3"><p><?=$moneytype_desc[$i]?></p></td>
				   </tr>
				   <tr valign="middle"> 
				   <td align="right"><p><?=$operate_date[$i] ?><br> <?=$loanitemtype_code[$i] ?></p></td>
				   <td align="right" valign="middle"><p><?=number_format($principal_payment[$i] ,2)?></p></td>
				   <td align="right" valign="middle"><p><?=number_format($interest_payment[$i] ,2)?></p></td>
				   <td align="right" valign="middle"><p><?=number_format($balance[$i],2) ?></p></td>
				   <td align="left" valign="middle"><p><?=number_format($total_a[$i],2) ?></p></td>
				   </tr>
			   <?php } ?> 
				</table>
				</li>
</ul>
<center><div ><a href="info.php?menu=Loan" data-role="button" data-corners="false"  data-icon="arrow-l" data-theme="b">กลับไป </a></div></center>
