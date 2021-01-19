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
		table{
			border-collapse: collapse;
		}
		th{
			border-bottom: 1px dashed  #000;
			border-top: 1px dashed #000;
}
.end{
		border-bottom: 1px dashed  #000;
}
		

</style>
</head>
<body>

<?php 
   $Submit = $_POST["Submit"];
    $Submit1 = $_POST["Submit1"];
	$acc_no = $_POST["acc_no"];
	$date1 = $_POST["date1"];
	$date2 =  $_POST["date2"];
	?>


<?php if($Submit == "แสดงข้อมูล Th"){ ?>
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
<div id="div_print1">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
    <table width="890" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF">
      <tr>
        <td valign="top">
        <table width="100%" border="0" cellspacing="3" cellpadding="0">
          <tr>
            <td width="110" height="85" align="center" valign="middle"><img src="../img/logo.png" width="101" height="101"></td>
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
                  <td height="30" colspan="6" align="center" valign="top"><font size="3" face="Tahoma"><strong>รายการเคลื่อนไหวบัญชีเงินฝาก</strong></font></td>
                </tr>
                <?php 
					$strSQL = "SELECT 
										DUG.DEPTGROUP_DESC AS DEP_DESC,
										DM.DEPTACCOUNT_NAME AS DEPTACCOUNT_NAME,
										DM.PRNCBAL AS PRNCBAL
									FROM 
										DPDEPTMASTER DM , DPDEPTTYPE DT ,DPUCFDEPTGROUP DUG
									WHERE
										DM.DEPTCLOSE_STATUS!= '1'
										AND DM.DEPTTYPE_CODE = DT.DEPTTYPE_CODE(+)
										AND DT.DEPTGROUP_CODE = DUG.DEPTGROUP_CODE(+)
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
                  <!--<td height="25" align="left"><strong>ประเภทบัญชี</strong></td>-->
                  <td style="width:11%" align="left"><strong>ประเภทเงินฝาก</strong></td>
				  <td style="width:24%"> <?=$dep_desc?></td>
                  <td style="width:13%" align="left"><strong>ชื่อบัญชี</strong></td>
                  <td style="width:30%" align="left"> <?=$acc_name?> (<?=$member_no?>)</td>
                  <td style="width:12%" align="right"><strong>ตั้งแต่วันที่</strong></td>
                  <td style="width:12%" align="right"><?=$date1?> </td>
                  </tr>
                <tr>
                  <td height="25" align="left"><strong>เลขที่บัญชี</strong></td>
				  <td style="width:5%"> <?= GetFormatDep($acc_no)?></td>
                  <td align="left"><strong>จำนวนเงินคงเหลือ</strong> </td>
                  <td align="left"><?=number_format($prncbal,2)?> <strong>บาท</strong></td>
                  <td align="right"><strong>ถึงวันที่</strong></td>
                  <td align="right"><?=$date2?> </td>
                  </tr>
              </table></td>
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
			  <br>
			  <tr>
                  <th width="12%" align="center"><strong><font size="2" face="Tahoma">&nbsp;วันที่ทำรายการ</font></strong></th>
                  <th width="11%" height="25" align="center"><strong><font size="2" face="Tahoma">รหัสทำรายการ</font></strong></th>
				  <th width="20%" height="25" align="center"><strong><font size="2" face="Tahoma"></font></strong></th>
                  <th width="13%" align="right"><strong><font size="2" face="Tahoma">ถอน</font></strong></th>
                  <th width="13%" align="right"><strong><font size="2" face="Tahoma">ฝาก</font></strong></th>
                  <th width="15%" align="right"><strong><font size="2" face="Tahoma">ยอดคงเหลือ</font></strong></th>
                  <th width="16%" align="center"><strong><font size="2" face="Tahoma">หมายเหตุ</font></strong></th>
                </tr>
              <?php for($i=0;$i<$Num_Rows;$i++){ ?>
                <tr>
                  <td width="12%" align="center"><font size="2" face="Tahoma"><?=$operate_date[$i]?></font></td>
                  <td width="11%" height="23" align="center"><font size="2" face="Tahoma"><?=$item_code[$i]?></font></td>
                  <td width="20%" align="left"><font size="2" face="Tahoma">
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
              <td height="30" align="center"><table width="95%" border="0" cellspacing="3" cellpadding="1">
			  <tr>
				<td>&nbsp;</td>
			  </tr>
                <tr>
                  <td height="23" align="center" class="end"><strong>(-<?=convertthai($prncbal)?>-)</strong></td>
                  <td width="15%" align="right" class="end"><strong><?=number_format($prncbal,2)?></strong></td>
                  <td width="16%" align="center" class="end">&nbsp;<br></td>
                </tr>
              </table></td>
            </tr>
			<tr>
           
            <tr>
              <td align="center">&nbsp;</td>
            </tr>
          </table>        </td>
        </tr>
    </table></td>
  </tr>
</table>
</div>
<?php }else if($Submit1 == "แสดงข้อมูล En"){ ?>
<table width="100%" border="0" cellspacing="1" cellpadding="6">
  <tr>
    <td align="right">
    <form id="form3" name="form1" method="post" action="">
   		<input name="b_print2" type="button" class="ipt; button1"  onclick="printdiv('div_print1');checkconfirmclosewindow()" value="print"  />
      	<input name="aa2" type="submit" id="aa3" value="close"  onclick="checkconfirmclosewindow()" class="button2" />
    </form>
    </td>
  </tr>
</table>
<div id="div_print1">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
    <table width="890" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF">
      <tr>
        <td valign="top">
        <table width="100%" border="0" cellspacing="3" cellpadding="0">
          <tr>
            <td width="110" height="85" align="center" valign="middle"><img src="../img/logo.png" width="101" height="101"></td>
            <td width="771"><table width="100%" border="0" cellspacing="5" cellpadding="0">
              <tr>
                <td><font face='Tahoma' size="4"><strong>
                 National Institute of Development Administration Savings Co-Operative Ltd.
                  </strong></font><br/><br/>
                  <center><font face='Tahoma' size="3" ><strong>
                    Individual posting report From <?php echo $date1;?> To <?php echo $date2;?>
                    </font></strong></center></td>
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
               
                <?php 
					 $strSQL = "SELECT distinct
									DPDEPTSTATEMENT.DEPTACCOUNT_NO,   
									 TO_CHAR(DPDEPTMASTER.DEPTOPEN_DATE,'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA')  AS DEPTOPEN_DATE,   
									 DPDEPTMASTER.MEMBER_NO,   
									 DPDEPTMASTER.PRNCBAL,   
									 DPDEPTMASTER.DEPTACCOUNT_ENAME,   
									 DPDEPTTYPE.DEPTTYPE_DESCENG,   
									 mbmembmaster.memb_ename || '  ' || mbmembmaster.memb_esurname as mem_ename  
								FROM DPDEPTMASTER,   
									 DPDEPTSTATEMENT,   
									 DPDEPTTYPE,   
									 DPUCFDEPTITEMTYPE,   
									 CMCOOPCONSTANT,   
									 MBMEMBMASTER  
							   WHERE ( dpdeptmaster.deptaccount_no = dpdeptstatement.deptaccount_no (+)) and  
									 ( DPDEPTTYPE.DEPTTYPE_CODE = DPDEPTMASTER.DEPTTYPE_CODE ) and  
									 ( DPUCFDEPTITEMTYPE.DEPTITEMTYPE_CODE = DPDEPTSTATEMENT.DEPTITEMTYPE_CODE ) and  
									 ( DPDEPTSTATEMENT.COOP_ID = DPDEPTMASTER.COOP_ID ) and  
									 ( DPDEPTMASTER.COOP_ID = DPDEPTTYPE.COOP_ID ) and  
									 ( DPDEPTSTATEMENT.COOP_ID = DPUCFDEPTITEMTYPE.COOP_ID ) and  
									 ( DPDEPTMASTER.COOP_ID = CMCOOPCONSTANT.COOP_CONTROL ) and  
									 ( DPDEPTMASTER.COOP_ID = MBMEMBMASTER.COOP_ID ) and  
									 ( DPDEPTMASTER.MEMBER_NO = MBMEMBMASTER.MEMBER_NO ) and  
									 ( ( DPDEPTSTATEMENT.OPERATE_DATE between TO_DATE('$date1', 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') 
									AND TO_DATE('$date2', 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA' )) AND  
									 ( DPDEPTMASTER.DEPTACCOUNT_NO = '$acc_no') AND  
									 ( DPDEPTSTATEMENT.FORPRNBK_FLAG = 1)) ";
					$value = array('DEPTACCOUNT_NO','DEPTOPEN_DATE','MEMBER_NO','PRNCBAL','DEPTACCOUNT_ENAME','DEPTTYPE_DESCENG','MEM_ENAME');
					list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
					$j=0;
					for($i=0;$i<$Num_Rows;$i++){
						$deptaccount_no = $list_info[$i][$j++];
						$deptopen_date = $list_info[$i][$j++];
					    $mem = $list_info[$i][$j++];
						$prncbal = $list_info[$i][$j++];
						$deptaccount_ename = $list_info[$i][$j++];
						$depttype_desceng = $list_info[$i][$j++];
						$mem_ename = $list_info[$i][$j++];
						$j=0;
					}
				?>
                <tr>
                  <td  style="width:10%;" height="25" align="left"><b>ACCOUNT NUMBER :</b></td>
                  <td  style="width:12%;" align="left"><?php echo  GetFormatDep($deptaccount_no);?></td>
                  <td   align="left" style="width:12%;" ><b>ACCOUNT OPENING DATE :</b></td>
				  <td style="width:10%"><?php echo  $deptopen_date;?></td>
                  <td style="width:5%;" align="right"><b>BALANCE :</b></td>
                  <td style="width:7%;" align="right"><?php echo  number_format($prncbal,2);?></td>
                  </tr>
                <tr>
                  <td  height="25" align="left"><b>ACCOUNT TYPE :</b></td>
                  <td align="left"><?php echo  $depttype_desceng;?></td>
                  <td  align="left" colspan="2" ><b>ACCOUNT : &nbsp;</b> <?php echo  $deptaccount_ename;?></td>
				  
                  <td  align="right"><b>REGISTER :</b></td>
                  <td  align="right"><?php echo  $mem;?></td>
                  </tr>
              </table></td>
              </tr>
          
              <td align="center"> 
				<?php 
					 $strSQL = "SELECT   
									 DPDEPTSTATEMENT.SEQ_NO,  
									 DPDEPTSTATEMENT.DEPTITEMTYPE_CODE,
									 TO_CHAR(DPDEPTSTATEMENT.OPERATE_DATE,'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') as OPERATE_DATE,
									 DPDEPTSTATEMENT.DEPTITEM_AMT,  
									 DPDEPTSTATEMENT.PRNCBAL,    
									 DPUCFDEPTITEMTYPE.SIGN_FLAG,  
									 DPDEPTTYPE.DEPTTYPE_CODE,
									 DPDEPTSTATEMENT.ACCUINT_AMT,     
									 DPDEPTSTATEMENT.ENTRY_ID,  
									 DPUCFDEPTITEMTYPE.PRINT_CODE,
									 DPDEPTSTATEMENT.NO_BOOK_FLAG,  
									 DPUCFDEPTITEMTYPE.PRINT_CODENOBOOK
								FROM DPDEPTMASTER,   
									 DPDEPTSTATEMENT,   
									 DPDEPTTYPE,   
									 DPUCFDEPTITEMTYPE,   
									 CMCOOPCONSTANT,   
									 MBMEMBMASTER  
							   WHERE ( dpdeptmaster.deptaccount_no = dpdeptstatement.deptaccount_no (+)) and  
									 ( DPDEPTTYPE.DEPTTYPE_CODE = DPDEPTMASTER.DEPTTYPE_CODE ) and  
									 ( DPUCFDEPTITEMTYPE.DEPTITEMTYPE_CODE = DPDEPTSTATEMENT.DEPTITEMTYPE_CODE ) and  
									 ( DPDEPTSTATEMENT.COOP_ID = DPDEPTMASTER.COOP_ID ) and  
									 ( DPDEPTMASTER.COOP_ID = DPDEPTTYPE.COOP_ID ) and  
									 ( DPDEPTSTATEMENT.COOP_ID = DPUCFDEPTITEMTYPE.COOP_ID ) and  
									 ( DPDEPTMASTER.COOP_ID = CMCOOPCONSTANT.COOP_CONTROL ) and  
									 ( DPDEPTMASTER.COOP_ID = MBMEMBMASTER.COOP_ID ) and  
									 ( DPDEPTMASTER.MEMBER_NO = MBMEMBMASTER.MEMBER_NO ) and  
									 ( (DPDEPTSTATEMENT.OPERATE_DATE between TO_DATE('$date1', 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') 
								   AND TO_DATE('$date2', 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA' )) AND  
									 ( DPDEPTMASTER.DEPTACCOUNT_NO = '$acc_no') AND  
									 ( DPDEPTSTATEMENT.FORPRNBK_FLAG = 1)) order by DPDEPTSTATEMENT.SEQ_NO";
					$value = array('SEQ_NO','DEPTITEMTYPE_CODE','OPERATE_DATE','DEPTITEM_AMT','PRNCBAL','SIGN_FLAG','DEPTTYPE_CODE','ACCUINT_AMT','ENTRY_ID','PRINT_CODE','NO_BOOK_FLAG','PRINT_CODENOBOOK');
					list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
					$j=0;
					for($i=0;$i<$Num_Rows;$i++){
						$seq_no[$i] = $list_info[$i][$j++];
						$deptitemtype_code[$i] = $list_info[$i][$j++];
						$operate_date[$i] = $list_info[$i][$j++];
						$deptitem_amt[$i] = $list_info[$i][$j++];
						$total[$i] = $list_info[$i][$j++];
						$sign_flag[$i] = $list_info[$i][$j++];
						$deptype_code[$i] = $list_info[$i][$j++];
						$accuint_amt[$i] = $list_info[$i][$j++];
						$entry_id[$i] = $list_info[$i][$j++];
						$print_code[$i] = $list_info[$i][$j++];
						$no_book_flag[$i] = $list_info[$i][$j++];
						$print_codenobook[$i] = $list_info[$i][$j++];
						
						if($no_book_flag[$i] == 1){
						
						$item[$i] = $print_codenobook[$i];
						
						}else{
						
						$item[$i] = $print_code[$i];
						
						}
						
						
						if($sign_flag[$i] < 0){
						
						$withdraw[$i] = $deptitem_amt[$i];
						$withdraw[$i] = $withdraw[$i] * -1;
						
						}else if($sign_flag[$i] > 0){
						
						$dep[$i] = $deptitem_amt[$i];
						
						}

						$j=0;
					}
				?>
				<br>
              <table width="95%" border="0" cellspacing="3" cellpadding="1">
			   <tr >
                  <th width="12%" align="center"><strong><font size="2" face="Tahoma">&nbsp;Date</font></strong></th>
                  <th width="31%" height="25" align="center"><strong><font size="2" face="Tahoma">Code</font></strong></th>
                  <th width="13%" align="right"><strong><font size="2" face="Tahoma">Withdraw</font></strong></th>
                  <th width="13%" align="right"><strong><font size="2" face="Tahoma">Deposit</font></strong></th>
                  <th width="15%" align="right"><strong><font size="2" face="Tahoma">Balance</font></strong></th>
                  <th width="16%" align="center"><strong><font size="2" face="Tahoma">Int./Div.</font></strong></th>
				  <th width="16%" align="center"><strong><font size="2" face="Tahoma">Transaction person</font></strong></th>
                </tr>
              <?php for($i=0;$i<$Num_Rows;$i++){ ?>
                <tr>
                  <td width="12%" align="center"><font size="2" face="Tahoma"><?=$operate_date[$i]?></font></td>
                  <td width="31%" height="23" align="center"><font size="2" face="Tahoma"><?=$item[$i]?></font></td>
				    <?php if($withdraw[$i] == "") { ?>
                  <td width="13%" align="right"><font size="2" face="Tahoma" color="#FF0000"></font></td>
				    <?php }else{ ?>
					<td width="13%" align="right"><font size="2" face="Tahoma" color="#FF0000"><?=number_format($withdraw[$i],2)?></font></td>
					 <?php } ?>
				  <?php if($dep[$i] == "") { ?>
                  <td width="15%" align="right"><font size="2" face="Tahoma"></font></td>
				  <?php }else{ ?>
				  <td width="15%" align="right"><font size="2" face="Tahoma"><?=number_format($dep[$i],2)?></font></td>
				  <?php } ?>
                  <td width="15%" align="right"><font size="2" face="Tahoma"><?=number_format($total[$i],2)?></font></td>
				   <td width="16%" align="center"><font size="2" face="Tahoma"><?=number_format($accuint_amt[$i],2)?></font></td>
                  <td width="16%" align="center"><?=$entry_id[$i]?></td>
				  
                </tr>
                <?php } ?>
				<tr>
					<td colspan="7" class="end">&nbsp;</td>
				</tr>
              </table></td>
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

<?php } ?>
</body>
</html>
