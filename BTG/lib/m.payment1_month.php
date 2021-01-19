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
    <td align="right"><strong><font size="4" face="Tahoma">ชำระรายเดือน</font></strong><br />
      <font color="#FF6600" size="2" face="Tahoma">Monthly Payment</font></td>
  </tr>
</table>
<hr color="#999999" size="1"/>
<?php require "../s/s.payment_month.php"; 
	require "../s/s.bankcode.php";
	require "../s/s.moneytype.php";
?>
<form action="../s/s.payment_insert.php" method="post" target="iframe_target">
<ul data-role="listview" data-inset="true">
    <li data-role="list-divider" data-theme="b">ชำระรายเดือน</li>
	<li>
	<input type="hidden" name="member_no" value="<?=$member_no?>">
		<input type="hidden" name="coop_id" value="<?=$coop_id?>">
        <p>ต้นค้าง<input type="text" value="<?=$adjprn ?> บาท" readonly> </p>
        <p>ดอกค้าง<input type="text" value="<?=$adjint ?> บาท" readonly> </p>
		<p>ยอดค้างชำระ<input type="text" value="<?=$sumamt ?> บาท" readonly> </p>
    </li>
    <li>
        <p>ยอดชำระ<input type="text" name="item_payment" value="<?=$sumamt ?>" required></p>
		
        <p>วิธีการชำระ
		<select name="moneytype_code" required>
			<option value="">กรุณาเลือกวิธีชำระ</option>
			<?php 
			for($i=0;$i<$Num_Rows2;$i++){
				$moneytype_code = $list_info2[$i][0];
				$moneytype_desc = $list_info2[$i][1];	
			?>
			<option value="<?=$moneytype_code?>"><?=$moneytype_code?> - <?=$moneytype_desc?></option>
			<?php } ?>
		</select>
		<p>Bank
		<select name="expense_bank" id="bank" required>
			<option value="">กรุณาเลือกธนาคารค่ะ</option>
			<?php 
			for($i=0;$i<$Num_Rows;$i++){
				$bank_code = $list_info[$i][0];
				$bank_desc = $list_info[$i][1];	
			?>
			<option value="<?=$bank_code?>"><?=$bank_code?> - <?=$bank_desc?></option>
			<?php } ?>
		</select>
		</p>
		<p id="branch"></p>
		<p>เลขบัญชี<input type="text" name="expense_accid" value="" required> </p>
		<p>วันที่ทำรายการ<input type="date" name="entry_date" value="" required> </p>
		<input type="hidden" name="approve_status" value="8">
    </li>
	<li>
		<h3 align="right"><button type="submit" class="btn btn-success">ชำระ</h3>
	</li>
</ul>
</form>
<iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
<center><div ><a href="info.php?menu=Payment_month" data-role="button" data-corners="false"  data-icon="arrow-l" data-theme="b">กลับไป </a></div></center>
<script>
$(document).ready(function() {
	$('#bank').change(function(){
		 var bank = $('#bank').val();
		if(bank!=""){
		
			$.ajax({
					   type: "POST",
					   url: "../s/s.branchbank.php",
					   data: {bank : bank},
					   success: function(result){
						  $('#branch').html(result);
					   }
			});
		}	
	});
});
</script>
