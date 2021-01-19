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
   		<input name="b_print2" type="button" class="ipt button1"  onclick="printdiv('div_print1');checkconfirmclosewindow()" value="�����"  />
      	<input name="aa2" type="submit" id="aa3" value="�Դ"  onclick="checkconfirmclosewindow()" class="button2" />
    </form>
    </td>
  </tr>
</table>
<?php 
require "../s/s.member_info.php";
require "../s/s.share.php";
require "../s/s.ref_collno.php";
require "../s/s.payment_slip.php";
require "../s/s.payment_slip_1.php";



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
                  <img src="../img/sahakorn.png" alt="" width="100" height="85"></strong></font><br/></td>
                <td width="88%" align="center">
                <font face='Tahoma' size="5"><strong><?=$title?></strong></font><br/>
                <font face='Tahoma' size="5"><strong>��Ѻ�Թ</strong></font>
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
                  <td width="12%"><strong>�Ţ���</strong></td>
                  <td width="47%"><?=$slip_no?> </td>
                  <?php for($i=0;$i<$Num_Rows;$i++){?> 
                       <?php  
                if($slip_loantype_code[$i] == 30 || $slip_loantype_code[$i] == 32 || $slip_loantype_code[$i] == 39 || $slip_loantype_code[$i] == 52){
                     //echo $slip_loantype_code[$i];
                ?>
                  <td width="11%"><strong>�ѹ���</strong></td>
                  <td width="30%"><?=$slipdate_3 ?></td>
                  <?php } ?>
                <?php } ?>
                </tr>
                <tr>
                  <td><strong>���Ѻ�Թ�ҡ</strong></td>
                  <td><?=$full_name ?> </td>
                  <td><strong>�Ţ����¹</strong></td>
                  <td><?=$member_no ?></td>
                </tr>
                <tr>
                  <td><strong>˹��§ҹ</strong>&nbsp;&nbsp;</td>
                  <td><?=$membgroup_code ?> - <?=$membgroup ?></td>
                  <td><strong>�������</strong></td>
                  <td><?=$sum_sharestk_amt ?></td>
                  </tr>
              </table></td>
              </tr>
            <tr>
              <td align="center"><hr size="1" color="#CCCCCC"></td>
            </tr>
            <tr>
              <td align="center"><table width="100%" border="0" cellspacing="6" cellpadding="1">
                <tr>
                  <td width="7%" align="center"><strong>�ӴѺ���</strong></td>
                  <td width="30%" align="center"><strong>��¡��/�ѭ��</strong></td>
                  <td width="7%" align="center"><strong>�Ǵ���</strong></td>
                  <td width="10%" align="right"><strong>�Թ��</strong></td>
                  <td width="10%" align="right"><strong>�͡����</strong></td>
                  <td width="13%" align="right"><strong>����Թ</strong></td>
                  <td width="20%" align="right"><strong>�������</strong></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td align="center"><hr size="1" color="#CCCCCC"></td>
            </tr>
            <tr>
                
               
                
              <td align="center"><table width="100%" border="0" cellspacing="4" cellpadding="1">
              <?php for($i=0;$i<$Num_Rows;$i++){?> 
                       <?php  
                if($slip_loantype_code[$i] == 30 || $slip_loantype_code[$i] == 32 || $slip_loantype_code[$i] == 39 || $slip_loantype_code[$i] == 52){
                     //echo $slip_loantype_code[$i];
                ?>
                      
                <tr>
                  <td width="7%" align="center"><?=($i+1).'. '?></td>
                  <td width="30%" align="left"><?=$slip_itemdesc_3[$i]?>                    <?=$slip_loanno_3[$i]?></td>
                  <td width="7%" align="center"><?=$period_3[$i]?></td>
                  <td width="10%" align="right"><?=$slip_principal_3[$i]?></td>
                  <td width="10%" align="right"><?=$slip_interest_3[$i]?></td>
                  <td width="13%" align="right"><?=$slip_pay_3[$i]?></td>
                  <td width="20%" align="right"><?=$itembalance_3[$i]?></td>
                </tr>
                <?php } ?>
                <?php } ?>
                <tr>
                  <td colspan="7" align="center" valign="middle"><hr size="1" color="#CCCCCC"></td>
                  </tr>
                  <?php for($i=0;$i<$Num_Rows;$i++){?> 
                       <?php  
                if($slip_loantype_code[$i] == 30 || $slip_loantype_code[$i] == 32 || $slip_loantype_code[$i] == 39 || $slip_loantype_code[$i] == 52){
                     //echo $slip_loantype_code[$i];
                ?>
                <tr>
                  <td height="30" colspan="4" align="center" valign="middle"><strong>( -<?=convertthai($totalpayment_3-$payment_a)?>- )</strong></td>
                  <td align="right" valign="middle"><strong>�ʹ�ط��</strong></td>
                  <td width="13%" align="right" valign="middle"><strong><?=number_format($totalpayment_3-$payment_a,2)?></strong></td>
                  <td align="right" valign="middle">&nbsp;</td>
                </tr>
                <?php } ?>
                <?php } ?>
                
                
                
                  </table>  
              </td>
            </tr>
            <tr>
              <td align="center"><hr size="1" color="#CCCCCC"></td>
            </tr>
            <tr>
              <td align="center"><table width="95%" border="0" cellspacing="3" cellpadding="1">
                <tr>
                  <td width="24%" align="center" valign="middle"><strong>���Ѵ���</strong></td>
                  <td width="27%" height="50" align="center" valign="middle"><img src="../img/mg.png" width="125" height="47"></td>
                  <td width="17%" align="center" valign="middle"><strong>�ͧ���Ѵ���/���˹�ҷ�����Ѻ�Թ</strong></td>
                  <td width="32%" align="center" valign="middle"><img src="../img/fn.png" width="99" height="55"></td>
                </tr>
                <tr>
                  <td colspan="4" align="center">&nbsp;</td>
                  </tr>
                <tr>
                  <td colspan="4" align="center">��Ѻ�Թ��Ш���͹������ó��������ͷҧ�ˡó����Ѻ�Թ������¡�����º��������</td>
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