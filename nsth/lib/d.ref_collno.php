<?php
@session_start();
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left"><strong><font size="4" face="Tahoma">ข้อมูลการค้ำประกัน</font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Guarantee</font></td>
  </tr>
  <tr>
    <td align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<?php //require "../s/s.ref_collno.php"; ?>
<?php 

$strSQL = "SELECT
						LCC.LOANCONTRACT_NO AS LOANCONTRACT_NO,
						PRE.PRENAME_DESC AS PRENAME_DESC,
						MEMB.MEMB_NAME AS MEMB_NAME,
						MEMB.MEMB_SURNAME AS MEMB_SURNAME,
						LCM.MEMBER_NO AS MEMBER_NO,
                        FORMAT((CASE WHEN LCM.PRINCIPAL_BALANCE = 0 THEN NULL ELSE LCM.PRINCIPAL_BALANCE END), '#,#.##') as PRINCIPAL_BALANCE	
                         					   
					FROM
						LNCONTCOLL LCC, LNCONTMASTER LCM, MBMEMBMASTER MEMB, MBUCFPRENAME PRE
					WHERE
						LCC.LOANCONTRACT_NO = LCM.LOANCONTRACT_NO
						AND LCM.MEMBER_NO = MEMB.MEMBER_NO
						AND MEMB.PRENAME_CODE = PRE.PRENAME_CODE
						AND LCM.CONTRACT_STATUS = '1'
						AND LCC.LOANCOLLTYPE_CODE = '01' AND LCC.COLL_STATUS = 1
						AND LCC.REF_COLLNO = '$member_no' ORDER BY LCC.LOANCONTRACT_NO ";
	
		
			$resultData = sqlsrv_query($objConnect,$strSQL); 

if($resultData != 0){ ?>  
<table width="85%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="13%" align="center" bgcolor="#FF9900"><strong><font color="#FFFFFF">คุณค้ำใคร</font></strong></td>
    <td width="88%" bgcolor="#999999"><table width="100%" border="0" cellspacing="1" cellpadding="5">
      <tr>
        <td width="20%" align="center" bgcolor="#FFCC33">สัญญาเลขที่</td>
        <td width="56%" align="center" bgcolor="#FFCC33">ชื่อ-สกุล (ทะเบียนสมาชิก)</td>
       <!-- <td width="24%" align="center" bgcolor="#FFCC33">หนี้คงเหลือ</td> -->
        <td width="24%" align="center" bgcolor="#FFCC33">หมายเหตุ</td>
      </tr>
  	<?php  while( $row = sqlsrv_fetch_array( $resultData, SQLSRV_FETCH_ASSOC) ) { 
					  
					    $coll_loan = $row['LOANCONTRACT_NO'];
						$coll_name = $row['PRENAME_DESC'].''.$row['MEMB_NAME'].' '.$row['MEMB_SURNAME'];
						$ref_no = $row['MEMBER_NO'];
						$coll_balance = $row['PRINCIPAL_BALANCE'];
						$coll_name_m = $coll_name;
						$coll_name = $coll_name.' ('.$ref_no.')';
						
						
						$strSQL2 = " SELECT LCC.COLLACTIVE_AMT
                     FROM LNCONTCOLL LCC , LNCONTMASTER LCM, MBMEMBMASTER MEMB, MBUCFPRENAME PRE
                     WHERE LCC.REF_COLLNO = '$member_no' 
                     AND LCC.LOANCONTRACT_NO = LCM.LOANCONTRACT_NO
                     AND LCM.MEMBER_NO = MEMB.MEMBER_NO
                     AND MEMB.PRENAME_CODE = PRE.PRENAME_CODE
                     AND LCM.CONTRACT_STATUS = '1'
                     AND LCC.LOANCOLLTYPE_CODE = '01' AND LCC.COLL_STATUS = 1 AND LCC.LOANCONTRACT_NO = '$coll_loan' ORDER BY LCM.LOANCONTRACT_NO";
					 
					 $resultData2 = sqlsrv_query($objConnect,$strSQL2); 
					 
					 while( $row = sqlsrv_fetch_array( $resultData2, SQLSRV_FETCH_ASSOC) ) {
					 
					 $collactive_amt = $row['COLLACTIVE_AMT'];
                     $collactive_amt = number_format($collactive_amt,2);
					 
					 }
						
						
						?>    
      <tr>
        <td align="center" bgcolor="#FFFFFF"><?=$coll_loan?></td>
        <td align="left" bgcolor="#FFFFFF"><?=$coll_name?></td>
       <!-- <td align="right" bgcolor="#FFFFFF"><//?=$coll_balance[$a]?> บาท</td> -->
         <td align="right" bgcolor="#FFFFFF"><?//=$collactive_amt?> <!-- บาท --></td>
		 
	
		 
      </tr>
      <?php } ?>   
    </table></td>
  </tr>
</table>
<?php } ?>  
<br />
<?php 

$strSQL1 = "	SELECT 
							DISTINCT(LCM.LOANCONTRACT_NO) AS LOAN_NO,
							LT.LOANGROUP_CODE
					 	FROM
							LNCONTMASTER LCM , LNCONTCOLL LCC, LNLOANTYPE LT
						WHERE 
							LCM.LOANCONTRACT_NO = LCC.LOANCONTRACT_NO
							AND LCM.LOANTYPE_CODE = LT.LOANTYPE_CODE 
							AND CONTRACT_STATUS = '1' 
							AND LCC.LOANCOLLTYPE_CODE = '01'  AND LCC.COLL_STATUS = 1
							AND MEMBER_NO = '$member_no'
							ORDER BY LT.LOANGROUP_CODE ";
							
							$resultData1 = sqlsrv_query($objConnect,$strSQL1); 

if($resultData1 != 0){?>  
<table width="85%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="13%" align="center" bgcolor="#3399FF"><strong><font color="#FFFFFF">ใครค้ำคุณ</font></strong></td>
    <td width="88%" bgcolor="#999999"><table width="100%" border="0" cellspacing="1" cellpadding="5">
      <tr>
        <td width="20%" align="center" bgcolor="#66CCCC">สัญญาเลขที่</td>
        <td width="56%" align="center" bgcolor="#66CCCC">ชื่อ-สกุล (ทะเบียนสมาชิก)</td>
        <td width="24%" align="center" bgcolor="#66CCCC">หมายเหตุ</td>
       <!-- <td width="24%" align="center" bgcolor="#66CCCC">ยอดค้ำประกัน</td>  -->
      </tr>
      <?php while( $row1 = sqlsrv_fetch_array( $resultData1, SQLSRV_FETCH_ASSOC) ) {
					 
					 $coll_loan_r = $row1['LOAN_NO']; ?>    
      <tr>
        <td align="center" valign="middle" bgcolor="#FFFFFF"><?=$coll_loan_r?></td>
        <td align="left" valign="top" bgcolor="#FFFFFF">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <?php require "../s/s.ref_collno1.php"; ?>
            <?php while( $row3 = sqlsrv_fetch_array( $resultData3, SQLSRV_FETCH_ASSOC) ) {
					 
					 $who_coll_name = $row3['PRENAME'].''.$row3['MBNAME'].' '.$row3['MBSURNAME']; 
					 $who_coll_no = $row3['COLLMEMBER_NP']; 
					 $who_coll_name = $who_coll_name.' ('.$who_coll_no.') ';
					 
					 ?>
					 
					 
					 
              <tr>
                <td align="left"><?=$who_coll_name?></td>
                
              </tr>
              <?php } ?> 
            </table>
        </td>
        <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
       <!-- <td align="right" bgcolor="#FFFFFF"><?//=$collactive_amt1[$c]?></td>  -->
      </tr>
      <?php //} ?> 
      <?php } ?>  
      
    </table>
    </td>
  </tr>
</table>
<?php } ?>  
<table width="85%" border="0" align="center" cellpadding="0" cellspacing="3">
  <tr>
    <td align="right"><font color="#FF0000">* ระบบจะแสดงเฉพาะสัญญาที่มี <strong>บุคคล</strong>  ค้ำประกันเท่านั้น</font></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
  </tr>
</table>
