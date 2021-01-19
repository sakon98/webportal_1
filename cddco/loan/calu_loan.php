<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>คำนวณการผ่อนชำระเงินกู้</title>
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />	
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css">
<link rel="stylesheet" href="css/template.css" type="text/css">
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.10.offset.datepicker.min.js"></script>
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

function addCommas(nStr){
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

function chkNum(ele){
	var num = parseFloat(ele.value);
	ele.value = addCommas(num.toFixed(2));
}

function chkLoanType(amt){
	var amount = amt.value;
	amount = parseFloat(amount.replace(/,/g , ""));
	var loanType = document.getElementById('loan_type').value;
	var setRate = 0.00;
	var errorMsg = "";
	
	if(loanType == 1 && amount > 120000){
		document.getElementById("loan_amt").value = "";
		document.getElementById("loan_amt").focus();
		errorMsg = "<strong><font size='3'> จำนวนเงินสูงสุดไม่เกิน 120,000.00 บาท </font></strong>";
	}else if(loanType == 2 && amount > 3000000){
		document.getElementById("loan_amt").value = "";
		document.getElementById("loan_amt").focus();
		errorMsg = "<strong><font size='3'> จำนวนเงินสูงสุดไม่เกิน 3,000,000.00 บาท </font></strong>";
	}else if((loanType == 3 || loanType == 4) && amount > 3000000){
		document.getElementById("loan_amt").value = "";
		document.getElementById("loan_amt").focus();
		errorMsg = "<strong><font size='3'> จำนวนเงินสูงสุดไม่เกิน 3,000,000.00 บาท </font></strong>";
	}
	document.getElementById("errorMsg").innerHTML = errorMsg;
	
}

function chkPeriod(period){
	var period = period.value;
	period = parseFloat(period.replace(/,/g , ""));
	var loanType = document.getElementById('loan_type').value
	var errorMsg = "";
	
	if(loanType == 1 && period > 12){
		document.getElementById("period").value = "";
		document.getElementById("period").focus();
		errorMsg = "<strong><font size='3'> ระยะเวลาในการผ่อนชำระสูงสุด 12 งวด </font></strong>";
	}else if(loanType == 2 && period > 180){
		document.getElementById("period").value = "";
		document.getElementById("period").focus();
		errorMsg = "<strong><font size='3'> ระยะเวลาในการผ่อนชำระสูงสุด 180 งวด </font></strong>";
	}else if((loanType == 3 || loanType == 4)  && period > 240){
		document.getElementById("period").value = "";
		document.getElementById("period").focus();
		errorMsg = "<strong><font size='3'> ระยะเวลาในการผ่อนชำระสูงสุด 240 งวด </font></strong>";
	}
	document.getElementById("errorMsg").innerHTML = errorMsg;
	
}

function cleanNewLoan(){
	document.getElementById("loan_amt").value = "";
	document.getElementById("rate").value = "";
	document.getElementById("period").value = "";
	document.getElementById("errorMsg").innerHTML = "";
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
</head>

<body>
<?php
$currentdate = date('d/m/Y');
$cutYear = explode("/", $currentdate);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
if($_POST["rate"] == null or $_POST["period"] == null or $_POST["loan_amt"] == null or $_POST["date1"] == null){
?>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td height="450" align="center" ><table width="500" border="0" cellspacing="0" cellpadding="0" >
      <tr>
        <td bgcolor="#FFFFFF">
        <form id="theForm" name="theForm"  action="" method="post" >
          <table width="556" border="0" align="center" cellpadding="3" cellspacing="0">
            <tr>
              <td colspan="4" align="center" bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
            <tr>
              <td height="35" colspan="4" align="center" bgcolor="#F3F35D"><strong><font size="3">ประมาณการคำนวณการผ่อนชำระเงินกู้</font></strong></td>
            </tr>
            <tr>
              <td colspan="4" align="right" bgcolor="#FFFFFF"><hr size="1" /></td>
            </tr>
            <tr>
              <td width="188" rowspan="6" align="center" valign="top" bgcolor="#FFFFFF"><img src="images/logo2.png" width="174" height="146" alt=""/></td>
              <td align="right" bgcolor="#FFFFFF"><strong>ประเภทเงินกู้ :</strong></td>
              <td colspan="2" bgcolor="#FFFFFF">
              <select name="loan_type" id="loan_type" tabindex="1" onchange="JavaScript:cleanNewLoan()">
                <option value="1"> ---  เงินกู้ฉุกเฉิน  --- </option>
                <option value="2"> ---  เงินกู้สามัญ  --- </option>
                <option value="3"> ---  เงินกู้พิเศษ  --- </option>
                <option value="4"> ---  เพื่อการเคหะสงเคราะห์ --- </option>
              </select></td>
            </tr>
            <tr>
              <td width="109" align="right" bgcolor="#FFFFFF"><strong>จำนวนเงินกู้ :</strong></td>
              <td width="144" bgcolor="#FFFFFF"><label for="loan_amt"></label>
                <input name="loan_amt" type="text" id="loan_amt" style="text-align:center" tabindex="2" autocomplete="off" onchange="JavaScript:chkNum(this);chkLoanType(this)"/></td>
              <td width="91" align="left" bgcolor="#FFFFFF"><strong>บาท</strong></td>
            </tr>
            <tr>
              <td align="right" bgcolor="#FFFFFF"><strong>อัตราดอกเบี้ย :</strong></td>
              <td bgcolor="#FFFFFF"><label for="rate"></label>
                <input name="rate" type="text" id="rate"  style="text-align:center" tabindex="3" autocomplete="off"/></td>
              <td align="left" bgcolor="#FFFFFF"><strong>ต่อปี</strong></td>
            </tr>
            <tr>
              <td align="right" bgcolor="#FFFFFF"><strong>จำนวนงวด :</strong></td>
              <td bgcolor="#FFFFFF"><label for="period"></label>
                <input name="period" type="text" id="period"  style="text-align:center" tabindex="4" autocomplete="off" onchange="JavaScript:chkPeriod(this)"/></td>
              <td align="left" bgcolor="#FFFFFF"><strong>งวด</strong></td>
            </tr>
            <tr>
              <td align="right" bgcolor="#FFFFFF"><strong>วันที่รับเงิน :</strong></td>
              <td colspan="2" bgcolor="#FFFFFF"><input name="date1" type="text" id="datepicker-th-2" style="text-align:center" tabindex="5" autocomplete="off" value="<?php  echo $cutYear[0]."/".$cutYear[1]."/".($cutYear[2]+543); ?>" /></td>
            </tr>
            <tr>
              <td colspan="3" align="center" bgcolor="#FFFFFF"><input type="submit" name="button" id="button" value="คำนวณ" />
                <input type="reset" name="button2" id="button2" value="ยกเลิก" /></td>
              </tr>
            <tr>
              <td colspan="4" align="center" bgcolor="#FFFFFF"><div class="ui-state-error" id="errorMsg"> </div></td>
              </tr>
          </table>
        </form> 
        </td>
      </tr>
    </table></td>
  </tr>
</table>
<?php
}else{
	include ("lib/lib.etc.php");
	$type = $_POST["loan_type"];
	$loan_amt = str_replace(',', '', $_POST["loan_amt"]);
	$rate = $_POST["rate"];	
	$period = $_POST["period"];
	$date1 = $_POST["date1"];
	
	if($type == 1){
		include "loan_type1.php";
	}else if($type == 2){
		include "loan_type2.php";
	}else if($type == 3){
		include "loan_type3.php";
	}else if($type == 4){
		include "loan_type4.php";
	}
}
?>
</body>
</html>