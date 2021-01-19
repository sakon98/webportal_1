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
		    $("#datepicker-th").datepicker({ dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay, dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});			  
		    $("#datepicker-th1").datepicker({ dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay, dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});
			  $("#inline").datepicker({ dateFormat: 'dd/mm/yy', inline: true });
			});
			function popup_statment(form) {
				var w = 910;
				var h = 530;
				var left = (screen.width/2)-(w/2);
				var top = (screen.height/3)-(h/3);
				var acc_no = $("#acc_no").val();
				var date1 =  $("#date1").val();
				var date2 =  $("#date2").val();
				if(acc_no != "" && date1 != "" && date2 != ""){
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
		
		<?php $check  = "0" ?>
		
		<?php if ($check == "1") { ?>
		
		<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left"><strong><font size="4" face="Tahoma">ข้อมูลสวัสดิการ</font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Benefits</font></td>
  </tr>
  <tr>
    <td align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<?php require "../s/s.Benefits.php"; 
 $check_member_type = substr($member_no,0,1);
		  if($check_member_type !="ส")
		  {
				$year =  (date("Y")+543)-(substr($member_date,-4)+543); 
				$month = substr($member_date,-7,-5);
				//เงื่อนไขเกี่ยวกับนับจำนวนอายุปีการเป็นสมาชิกเพื่อไปคำนวณ รายการ	จำนวนเงินคุ้มครอง	หมายเหตุ สวัสดิการสงเคราะห์ครอบครัวสมาชิก ไม่เกิน 250,000 บาท
				if($month>=8)
				{
					$skscoopanti  = (50000+($year*5000))+5000;
				}
				else
				{
					$skscoopanti  = 50000+($year*5000);
				}

				if($skscoopanti <=250000)
				{
					$skscoopanti_sum=number_format($skscoopanti);
				}
				else
				{
					$skscoopanti_sum = "250,000";
				}
			}else{$skscoopanti_sum=0;}
?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
 
  <tr>
    <td bgcolor="#999999"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align="left" bgcolor="#CCCCFF"><table width="100%" border="0" cellspacing="3" cellpadding="3">
          
        </table></td>
        </tr>
      <tr>
        <td align="left" bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr>
            <td width="38%" height="25" align="center" bgcolor="#FFFFFF"><strong>รายการ</strong></td>
            <td width="10%" align="center" bgcolor="#FFFFFF"><strong>จำนวนเงินคุ้มครอง</strong></td>
	    <td width="30%" align="center" bgcolor="#FFFFFF"><strong>หมายเหตุ</strong></td>
            
          </tr>
		  <tr>
            <td height="25" bgcolor="#FFFFFF">สวัสดิการสงเคราะห์ครอบครัวสมาชิก ไม่เกิน 250,000 บาท</td>
            <td align="right" bgcolor="#FFFFFF"><?=$skscoopanti_sum?> บาท</td>
            <td bgcolor="#FFFFFF">เริ่มต้น 50,000 บาท อายุสมาชิก ปีละ 5,000 บาท</td>
            
          </tr>
		  <tr>
            <td height="25"  bgcolor="#FFFFFF">สหกรณ์ฯประกัน 100 % สหกรณ์จ่ายเบี้ยประกันให้</td>
            <td align="right" bgcolor="#FFFFFF"><?=number_format($skscoop100) ?> บาท</td>
            <td  bgcolor="#FFFFFF">เสียชิวิตด้วยอุบัติเหตุได้ 2 เท่า</td>
            
          </tr>
		  <tr>
            <td height="25"  bgcolor="#FFFFFF">สมาคมณาปนกิจ สอ.ครูเพชรบูรณ์</td>
            <td align="right" bgcolor="#FFFFFF"><?=number_format($skscoop) ?> บาท</td>
            <td  bgcolor="#FFFFFF">ตามจำนวนสมาชิก ณ วันเสียชีวิต</td>
            
          </tr>
		  <tr>
            <td height="25" bgcolor="#FFFFFF">สสอค.ครูไทย</td>
            <td align="right" bgcolor="#FFFFFF"><?=number_format($ftscins) ?> บาท</td>
            <td  bgcolor="#FFFFFF">(ขั้นต่ำ)เบี้ยประกัน 4,800 ต่อปีหักจากปันผล</td>
            
          </tr>
		  <tr>
            <td height="25"  bgcolor="#FFFFFF">สส.ชสอ.ชุมนุม</td>
            <td align="right" bgcolor="#FFFFFF"><?=number_format($fsctins) ?> บาท</td>
            <td  bgcolor="#FFFFFF">(ขั้นต่ำ)เบี้ยประกัน 4,800 ต่อปีหักจากปันผล</td>
            
          </tr>
		  <tr>
            <td height="25"  bgcolor="#FFFFFF">ประกันฯ ภาคสมัครใจ</td>
            <td align="right" bgcolor="#FFFFFF"><?=number_format($voluntary) ?> บาท</td>
            <td  bgcolor="#FFFFFF"><?php ?></td>
            
          </tr>
		  <tr>
            <td height="25" bgcolor="#FFFFFF">ประกันฯ ส.ค.ส.</td>
            <td align="right" bgcolor="#FFFFFF"><?=number_format($voluntaryold) ?> บาท</td>
            <td align="center" bgcolor="#FFFFFF"><?php ?></td>
            
          </tr>
		   <tr>
            <td height="25"  bgcolor="#FFFFFF">ประกันสินเชื่อ </td>
            <td align="right" bgcolor="#FFFFFF"><?=number_format($credits) ?> บาท</td>
            <td align="center" bgcolor="#FFFFFF"><?php ?></td>
            
          </tr>
		   <tr>
            <td height="25"  bgcolor="#FFFFFF">รวมเงินสวัสดิการ </td>
            <td align="right" bgcolor="#FFFFFF"><?=number_format($sum_benefit+$skscoopanti) ?> บาท</td>
            <td align="center" bgcolor="#FFFFFF"><?php ?></td>
            
          </tr>
		  <!--< <tr>
            <td height="25"  bgcolor="#FFFFFF">กองทุนค้ำประกันเงินกู้ </td>
            <td align="right" bgcolor="#FFFFFF"><?//=number_format($fundcoll) ?> บาท</td>
            
                   <?php //if($interest_return != 0){ ?>
            
            <td bgcolor="#FFFFFF"><?//=$interest_return ?> บาท (ดอกเบี้ย ณ ที่จ่าย วันที่ 31 พ.ค 59)</td>
            
                   <?php //}  else { ?>
            
            <td height="25" bgcolor="#FFFFFF"></td>
             <?php //} ?>
			 </tr>-->
			<!--  <tr>
		  <td height="25" bgcolor="#FFFFFF"></td>
		  <td height="25" bgcolor="#FFFFFF"></td>
		  <td height=-->
			<!-- <tr>
			 <td height="25"  bgcolor="#FFFFFF">จ่ายคืนกองทุนค้ำประกันแก่สมาชิก (จ่าย  ณ วันที่ 08 ก.ย 2559)</td>
			 
			 <?php //if($fundbalance > 10000){ ?>
			 
			 <td align="right" bgcolor="#FFFFFF"><?php //echo $fundbalance_full; ?> บาท</td>
			 <td bgcolor="#FFFFFF">เงินจ่ายคืน <?php //echo $avg_full ; ?>  บาท  คงเหลือ 10,000 บาท</td>
			 
			 <?php //} else { ?>
			 <td align="right" bgcolor="#FFFFFF"><?php// echo $fundbalance_full; ?> บาท</td>
			 <td bgcolor="#FFFFFF">เงินจ่ายคืน - บาท  คงเหลือ <?php //echo $fundbalance_full; ?> บาท </td>
            <?php //} ?>
          </tr>
		   <tr>
		  <td height="25" bgcolor="#FFFFFF"></td>
		  <td height="25" bgcolor="#FFFFFF"></td>
		  <td height="25" bgcolor="#FFFFFF"></td>
		  </tr>
		  <tr>
		  <td height="25" bgcolor="#FFFFFF">**จ่ายเงินคืนกองทุนช่วยเหลือผู้ค้ำประกันแก่สมาชิกที่สะสมเกิน 10,000 <br> บาทขึ้นไปเท่านั้น</td>
		  <td height="25" bgcolor="#FFFFFF"></td>
		  <td height="25" bgcolor="#FFFFFF"></td>
		  </tr>-->
		  <tr>
		  <td height="25" bgcolor="#FFFFFF">***กรณีมีข้อสงสัยให้ติดต่อกับสหกรณ์ออมทรัพย์ครูเพชรบูรณ์ จำกัด</td>
		  <td height="25" bgcolor="#FFFFFF"></td>
		  <td height="25" bgcolor="#FFFFFF"></td>
		  </tr>
		 <!--  <tr>
            <td height="25"  bgcolor="#FFFFFF" colspan="3">***กรณีมีข้อสงสัยให้ติดต่อกับสหกรณ์ออมทรัพย์ครูเพชรบูรณ์ จำกัด </td>
			
          </tr>-->
		  
		  
          <?php ?>
        </table></td>
      </tr>
	  
    </table></td>
  </tr>
 
</table>
<?php //if($fundbalance > 10000){ ?>
<!--<p><span style="font-size:10pt; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ยอดเงินกองทุนค้ำประกันสะสม  <?php //echo $fundbalance_full; ?> บาท  ยอดจ่ายคืน 10,000 บาท คงเหลือ <?php// echo $avg_full ; ?> บาท จ่าย ณ วันที่ </span></p>-->
<?php //} else { ?>
<!--<center><p><span style="font-size:10pt;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ยอดเงินกองทุนค้ำประกันสะสม  <?php //echo $fundbalance_full; ?> บาท  ยอดจ่ายคืน - บาท คงเหลือ <?php //echo $fundbalance_full; ?> บาท จ่าย ณ วันที่ </span></p>-->
<?php //} ?>
<!--<p><span style="font-size:10pt;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>การจ่ายคืนเงินกองทุนค้ำประกันเงินกู้ จ่ายคืนสำหรับยอดสะสมตั้งเเต่  10,000 บาทขึ้นไปเท่านั้น</span></p>-->
<br>
<p><span style="font-size:11pt; color:#3633FF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>***หมายเหตุ</b> ผู้รับผลประโยชน์แต่ละสวัสดิการอยู่ระหว่างการจัดทำข้อมูล</span></p>
<!--
              <br><br>
              
              
              <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
 
  <tr>
    <td bgcolor="#999999"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align="left" bgcolor="#CCCCFF"><table width="100%" border="0" cellspacing="3" cellpadding="3">
        </table></td>
        </tr>
      <tr>
        <td align="left" bgcolor="#CCCCCC">
		<table width="100%" border="0" cellspacing="1" cellpadding="3">
		  <tr>
			<td colspan="3"><b>ผู้รับโอนผลประโยชน์</b></td>
		  </tr>
          <tr>
            <td align="center" height="25" width="22%"  bgcolor="#FFFFFF"><strong>ชื่อผู้รับโอน</strong></td>
			<td align="center"  width="40%"  bgcolor="#FFFFFF"><strong>ที่อยู่ผู้รับโอน</strong></td>
            <td  align="center"  width="20%"  bgcolor="#FFFFFF"><strong>ความสัมพันธ์</strong></td>
            
          </tr>
		  <?php if($Num_Rows1>0){?>
          <tr>
            <td height="25"  align="center" bgcolor="#FFFFFF"><?=$fullname_gain ?></td>
            <td  bgcolor="#FFFFFF"><?=$address_gain ?></td>
            <td align="center" bgcolor="#FFFFFF"><?=$concern_gain ?></td>
            
          </tr>
		  <?php }else{?>
		  <tr>
				<td colspan="3">ยังไม่มีข้อมูล</td>
		  </tr>
          <?php } ?>
        </table></td>
      </tr>
	  
    </table></td>
  </tr>
 
</table>
-->
             
<br />
<p>&nbsp;</p>

<?php } else { 

        echo '<script type="text/javascript"> window.alert("ขออภัยอยู่ในช่วงดำเนินการปรับปรุงเมนูนี้") </script> ';
		echo "<script>window.location = 'info.php'</script>";


} ?>


