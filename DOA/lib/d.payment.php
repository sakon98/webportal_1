<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <link rel="stylesheet" href="../css/validationEngine.jquery.css" type="text/css">
	<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />	
    <script src="../js/jquery-1.6.min.js" type="text/javascript"></script>
	<script src="../js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="tis-620"></script>
	<script src="../js/jquery.validationEngine.js" type="text/javascript" charset="tis-620"></script>
	<script type="text/javascript" src="../js/jquery-ui-1.8.10.offset.datepicker.min.js"></script>
	<script type="text/javascript">
		  $(function () {
		    var d = new Date();
		    var toDay = d.getDate() + '/'
        + (d.getMonth() + 1) + '/'
        + (d.getFullYear() + 543);
		    $("#datepicker-th").datepicker({ dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay, dayNames: ['�ҷԵ��', '�ѹ���', '�ѧ���', '�ظ', '����ʺ��', '�ء��', '�����'],
              dayNamesMin: ['��.','�.','�.','�.','��.','�.','�.'],
              monthNames: ['���Ҥ�','����Ҿѹ��','�չҤ�','����¹','����Ҥ�','�Զع�¹','�á�Ҥ�','�ԧ�Ҥ�','�ѹ��¹','���Ҥ�','��Ȩԡ�¹','�ѹ�Ҥ�'],
              monthNamesShort: ['�.�.','�.�.','��.�.','��.�.','�.�.','��.�.','�.�.','�.�.','�.�.','�.�.','�.�.','�.�.']});			  
		    $("#datepicker-th1").datepicker({ dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay, dayNames: ['�ҷԵ��', '�ѹ���', '�ѧ���', '�ظ', '����ʺ��', '�ء��', '�����'],
              dayNamesMin: ['��.','�.','�.','�.','��.','�.','�.'],
              monthNames: ['���Ҥ�','����Ҿѹ��','�չҤ�','����¹','����Ҥ�','�Զع�¹','�á�Ҥ�','�ԧ�Ҥ�','�ѹ��¹','���Ҥ�','��Ȩԡ�¹','�ѹ�Ҥ�'],
              monthNamesShort: ['�.�.','�.�.','��.�.','��.�.','�.�.','��.�.','�.�.','�.�.','�.�.','�.�.','�.�.','�.�.']});
			  $("#inline").datepicker({ dateFormat: 'dd/mm/yy', inline: true });
			});
			function popup_statment(form) {
				var w = 910;
				var h = 530;
				var left = (screen.width/2)-(w/2);
				var top = (screen.height/3)-(h/3);
				var slip = $("#slip").val();
				if(slip != ""){
			 window.open ('', 'formpopup', 'toolbar=no, location=no, directories=no, status=no, menubar=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
				 form.target = 'formpopup';
				}
			} 

			jQuery(document).ready(function(){
						jQuery("#formID1").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});
			});
        </script>
		<style type="text/css">
			body{ font: 80% "Tamaho"; margin: 0px;}
			.demoHeaders { margin-top: 2em; }
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
			ul.test {list-style:none; line-height:30px;}
		</style>	

<?php require "../s/s.payment.php"; ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="82%" align="left"><strong><font size="4" face="Tahoma">��¡���ѡ��Ш���͹ <?=$show_month?></font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Monthly Payment</font></td>
    <td width="18%" align="right" valign="top">
    <form id="formID1" name="formID1" method="post" action="" >
        <select name="slip_date" id="slip_date"  onchange="this.form.submit()" >
            <option value=""> --- ��س����͡ ---</option>
                  <?php  	
                    for($i=0;$i<count($slip);$i++){
		if($slip[$i] < 255810){
			continue;
                                }else{
			echo '<option value="'.$slip[$i].'">'.$slip_m[$i].'</option>';
		}
                    }
                    ?>
    	</select>
    </form>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="left"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<br />
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="30%" height="25" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">��¡�� / �ѭ��</font></strong></td>
        <td width="5%" align="center" bgcolor="#6699FF"><font color="#FFFFFF">�/�<br />(�ѹ)</font></td>
        <td width="5%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">�Ǵ���</font></strong></td>
        <td width="13%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">�Թ��</font></strong></td>
        <td width="13%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">�͡����</font></strong></td>
        <td width="13%" align="center" bgcolor="#FFCC33"><strong>�ӹǹ�Թ</strong></td>
        <td width="15%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">�������</font></strong></td>
      </tr>
      <?php for($i=0;$i<$Num_Rows;$i++){?>  
      <tr>
        <td height="28" bgcolor="#FFFFFF"><?=($i+1).'. '?><?=$slip_itemdesc[$i]	.' '.$slip_loanno[$i]?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$rate_day[$i]?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$period[$i]?></td>
        <td align="right" bgcolor="#FFFFFF"><?=$slip_principal[$i]?></td>
        <td align="right" bgcolor="#FFFFFF"><?=$slip_interest[$i]?></td>
        <td align="right" bgcolor="#FFFF99"><?=$slip_pay[$i]?></td>
        <td align="right" bgcolor="#FFFFFF"><?=$itembalance[$i]?></td>
      </tr>
      <?php } ?>  
      <?php if($Num_Rows1 > 0){ ?>  
      <tr>
        <td height="28" bgcolor="#FFFFFF"><?=($Num_Rows+1).'. '?><?=$moneytype_code	.' '.$expense_accid?></td>
        <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
        <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
        <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
        <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
        <td align="right" bgcolor="#FFFF99">-<?=$item_payment?></td>
        <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <?php } ?>    
<?php for($a=0;$a<$Num_Rows10;$a++){?>  
<tr>
        <td colspan="7" bgcolor="#6699FF"> �Ѻ�͹�ҡ : ����¹ <?php echo $memno[$a]?> <?php echo $full_name?>  �Ţ�ѭ�� <?php echo $contno[$a]?></td>
        
      </tr>
	 <?php } ?>    
      <tr>
        <td colspan="5" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="81%" align="center"><strong>( -<?=convertthai($totalpayment-$payment_a)?>- )</strong></td>
            <td width="19%" align="right"><strong>�������</strong></td>
          </tr>
        </table></td>
        <td height="28" align="right" bgcolor="#FFFF99"><strong><?=number_format($totalpayment-$payment_a,2)?></strong></td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"><font color="#FF0000">*�к����ʴ���������͹����ش ��سҵ�Ǩ�ͺ�ա���駡Ѻ�ҧ�ˡó�</font></td>
  </tr>
  <tr>
    <td align="center">
	
	<?php 
$servername = "localhost:3307";
$username = "root";
$password = "WebServer";
$dbname = "mobile_doa";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT CON_VALUE  FROM MDBCONSTANT";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {

          $con_value = $row["CON_VALUE"];
    }
	
	 // �������
	 
	 $month_now = date("m");
	  $date_now = date("d");
	  $month_pre = date('m', strtotime('-1 month'));
	  
	  if($_REQUEST["slip_date"] == ""){
	  
	  $recv_slip = substr(Show_Slip(date('d-m-Y')),4);

	  
	  }else{
	  
	  $recv_slip = substr($_REQUEST["slip_date"],4);
	 
	  }

	  
	  // end config //
	  
	  if($month_now == $recv_slip){
	  
	  //echo "��͹�Ѩ�غѹ";
	  
	  if($month_now == $recv_slip){
	  
	   $printslip_check = 0;
	  
	  }else if($recv_slip < $month_now){
	  
	    $printslip_check = 1;
	  
	  }
	  
	  
	  else if ($month_now > $recv_slip){
	  
	
	  
	         if($month_pre == $month_now){
	  
	                if($date_now >= $con_value){
	  
	                        $printslip_check = 1;
	  
	                }else{
	  
	                         $printslip_check = 0;
	  
	         }
	  
	  
	         }else{

			 
			 
	                          $printslip_check = 1;
	  
	        }
	  
	  
	  }else{
              
	          if($month_now == '01' && recv_slip == '12'){
       
	                      if($date_now >= $con_value){
		  
		   
		  
		                    $printslip_check = 1;
		
		               }else{
		
		                    $printslip_check = 0;
		
		    }
		
		   }else{
		   
		 
	
	                        $printslip_check = 0;
		
		   }
}

}else{

//echo "��͹���";

  $printslip_check = 1;

}

	

?>    
	
	
	
    <?php if($printslip == 1 && $printslip_check == 1){ ?>
    <form id="form1" name="form1" method="post" action="slip.php" onsubmit="popup_statment(this);">
      <input type="submit" name="button" id="button" value="�����" />
      <input type="hidden" name="slip_date" value="<?=$_REQUEST["slip_date"]?>" id="slip_date" />
    </form>
    <?php } ?>
    </td>
  </tr>
</table>
<p>&nbsp;</p>
