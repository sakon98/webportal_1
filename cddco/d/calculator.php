<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="35%" align="left"><strong><font size="4" face="Tahoma">คำนวณสิทธิกู้</font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Calculator</font></td>
    <td width="65%" align="right" valign="middle"><form id="form1" name="form1" method="post" action="">
      <strong>กรุณาเลือกประเภทเงินกู้ที่ต้องการคำนวณ</strong>
      <select name="loan_type" id="loan_type" onchange="this.form.submit()">
        <option value="">-- ประเภทเงินกู้ --</option>
        <option value="1"> เงินกู้ประเภทสามัญ</option>
        <option value="2"> เงินกู้ประเภทพิเศษ</option>
      </select>
    </form></td>
  </tr>
  <tr>
    <td colspan="2" align="left"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<?php if($_REQUEST["loan_type"] != ""){?>
<table width="825" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="800" align="center" valign="middle">
  <link rel="stylesheet" href="../css/validationEngine.jquery.css" type="text/css">
	<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />	
    <script src="../js/jquery-1.6.min.js" type="text/javascript"></script>
	<script src="../js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="tis-620"></script>
	<script src="../js/jquery.validationEngine.js" type="text/javascript" charset="tis-620"></script>
	<script type="text/javascript" src="../js/jquery-ui-1.8.10.offset.datepicker.min.js"></script>
	<script type="text/javascript">
		  $(function () {
		    var d = new Date();
		    var toDay = d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getFullYear()+543);

		    $("#datepicker-th").datepicker({ dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay, dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});

		    $("#datepicker-th-2").datepicker({ changeMonth: true, changeYear: true,dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay,dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});

     		$("#datepicker-en").datepicker({ dateFormat: 'dd/mm/yy'});

		    $("#inline").datepicker({ dateFormat: 'dd/mm/yy', inline: true });

			$('#loan_amt').keypress(function(e){ 
						   if(e.which == 13) {
							   $( "#rate" ).focus();
							   return false
						   }
						});
						$('#rate').keypress(function(e){ 
						   if(e.which == 13) {
							   $( "#period" ).focus();
							   return false
						   }
						});
						$('#period').keypress(function(e){ 
						   if(e.which == 13) {
							   $( "#datepicker-th-2" ).focus();
							   return false
						   }
			});
	});
	function popup_statment(form) {
				var w = 910;
				var h = 530;
				var left = (screen.width/2)-(w/2);
				var top = (screen.height/3)-(h/3);
				var loan_amt = $("#loan_amt").val();
				var date1 =  $("#date1").val();
				if(loan_amt != "" && date1 != ""){
			 window.open ('', 'formpopup', 'toolbar=no, location=no, directories=no, status=no, menubar=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
				 form.target = 'formpopup';
				}
			}
	jQuery(document).ready(function(){
						jQuery("#formID1").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});
			});
	function addCommas(nStr)
			{
				nStr += '';
				x = nStr.split('.');
				x1 = x[0];
				x2 = x.length > 1 ? '.' + x[1] : '';
				var rgx = /(\d+)(\d{3})/;
				while (rgx.test(x1)) {
					x1 = x1.replace(rgx, '$1' + ',' + '$2');
				}
				return x1 + x2;
			}

			function chkNum(ele)
			{
				var num = parseFloat(ele.value);
				ele.value = addCommas(num.toFixed(2));
			}
		</script> 
<style type="text/css">
body,td,th {
	font-family: Tahoma;
	font-size: 13px;
	color: #000;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #999;
}
.demoHeaders { margin-top: 2em; }
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
			ul.test {list-style:none; line-height:30px;}
			
</style>
    
    
    
    </td>
  </tr>
  <tr>
    <td align="right" valign="middle"><table width="97%" border="0" align="center" cellpadding="3" cellspacing="4">
      <tr>
        <td><strong>
	<?php
	$dm = ConvertDate_cu(date('d/m/Y'),'bc','num1');
	
 	if($_REQUEST["loan_type"] == 1){ 
		echo 'เงินกู้ประเภทสามัญ';
		$max_pay = 150;
		$max_loan = 48;
		$max_share = 30;
	}else if($_REQUEST["loan_type"] == 2){
		echo 'เงินกู้ประเภทพิเศษ';
		$max_pay = 250;
		$max_loan = 78;
		$max_share = 25;
	}
	
	require "../s/s.member_info.php";
	require "../s/s.share.php"; 
	//echo $salary*$max_loan;
	$loan_can_pay = (floor(($salary*$max_loan)/100))*100;
	$shs_bay = $SHARE_AMT - ($loan_can_pay *$max_share)/100 ;

	?>
        </strong></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="right" valign="middle"><form action="loan_type.php" method="post" name="formID1" target="new" id="formID1" onsubmit="popup_statment(this);">
      <table width="90%" border="0" align="center" cellpadding="3" cellspacing="4">
        <tr>
          <td width="39%" align="right">วงเงินสูงสุดคำนวณจากฐานเงินเดือน :</td>
          <td colspan="2"><label for="textfield"></label>
              <input name="loan_amt_show" type="text" id="loan_amt_show" style="text-align:center;" autocomplete="off" value="<?=number_format($loan_can_pay,2)?>" readonly   />
            บาท
            
             (
            <?=$max_loan?>
เท่า )</td>
          </tr>

        <tr>
          <td align="right">จำนวนเงินที่ขอกู้ :</td>
          <td colspan="2"><input type="text" name="loan_amt" id="loan_amt" class="validate[required]" style="text-align:center;background-color:#FFFF66; border: groove"  autocomplete="off" onchange="JavaScript:chkNum(this)"/>   (พิมพ์จำนวนเงิน)</td>
        </tr>

        <tr>
          <td align="right">อัตราดอกเบี้ย :</td>
          <td colspan="2">
            <input name="rate" type="text" id="rate"  style="text-align:center" autocomplete="off" value='7.00' readonly/>
            % ต่อปี</td>
          </tr>
        <tr>
          <td align="right">จำนวนงวด  :</td>
          <td colspan="2">
            <input name="period" type="text" id="period"  style="text-align:center;background-color:#FFFF66; border: groove" autocomplete="off" value="<?=$max_pay?>"/>             งวด(สูงสุด
            <?=$max_pay?>
            งวด)</td>
          </tr>
        <tr>
          <td align="right">วันที่รับเงิน :</td>
          <td colspan="2"><input type="text" id="datepicker-th-2" name="date1" style="text-align:center;background-color:#FFFF66; border: groove" autocomplete="off" value="<?=$dm?>">            (กรุณาเลือก)</td>
          </tr>
        <tr>
          <td align="right" valign="top">ชำระแบบ :</td>
          <td colspan="2" align="left"><input name="type_pay" type="radio" id="type_pay" value="1" checked="checked" />
            คงต้น 
              <br />
              <input type="radio" name="type_pay" id="type_pay2" value="2" />
            คงยอด</td>
          </tr>
        <tr>
          <td colspan="3" align="center"><input type="submit" name="button" id="button" value="คำนวณ">
            <input type="reset" name="button2" id="button2" value="ล้างข้อมูล"></td>
          </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td width="35%">&nbsp;</td>
          <td width="26%">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3" align="left">* การคำนวณนี้เป็นเพียงแค่การประมาณการเท่านั้น<br>
            ** เงินกู้ สามัญและพิเศษ สมาชิกต้องมีเงินเดือนคงเหลือสุทธิ 10% ของเงินเดือน<br>
            *** เงินกู้สามัญ ต้องมีหุ้น 30% ของวงเงินที่ได้รับอนุมัติ
            ,เงินกู้พิเศษ ต้องมีหุ้น 25% ของวงเงินที่ได้รับอนุมัติ<br></td>
          </tr>
      </table>
    </form></td>
  </tr>

</table>
<?php }?>