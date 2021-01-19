<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?>
<style>
	.p{
		
		text-indent:30px;
	}
</style>
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
		
		<?php $check  = "1" ?>
		
		<?php if ($check == "1") { ?>
		
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left"><strong><font size="4" face="Tahoma">ข้อมูลสิทธิ์กู้</font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">LoanPermission</font></td>
  </tr>
  <tr>
    <td align="right"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<?php require "../s/s.LoanPermission.php"; ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
 
  <tr>
    <td bgcolor="#999999"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align="left" bgcolor="#CCCCFF"><table width="100%" border="0" cellspacing="3" cellpadding="3">
          <tr>
            <td width="84%" height="20" align="left"><strong>::ข้อมูลที่ใช้พิจารณาสิทธิ์กู้::</strong></td>
            
            </tr>
        </table></td>
        </tr>
      <tr>
        <td align="left" bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr>
            <td width="22%" height="25" align="center" bgcolor="#FFFFFF"><strong>เป็นสมาชิกวันที่</strong></td>
            <td width="22%" align="center" bgcolor="#FFFFFF"><strong>เงินเดือน</strong></td>
			<td width="22%" align="center" bgcolor="#FFFFFF"><strong>เงินวิทยฐานะ</strong></td>
            <td width="22%" align="center" bgcolor="#FFFFFF"><strong>ทุนเรือนหุ้น</strong></td>
            <!--<td width="22%" align="center" bgcolor="#FFFFFF"><strong>งวดชำระ</strong></td>-->
          </tr>
          <?php //require "../s/s.deposit1.php"; 
          //for($n=0;$n<$Num_Rows1;$n++){ ?>
          <tr>
            <td height="25" align="center" bgcolor="#FFFFFF"><?=$member_date?></td>
            <td align="center" bgcolor="#FFFFFF">
			<?php
				$check_member_type = substr($member_no,0,1);
				if($check_member_type !="ส")
				{
					echo $salary_amount_full;
				}else{ echo "-"; }
			 ?>
			</td>
			<td align="center" bgcolor="#FFFFFF"><?php if($incomeetc_amt!=0){echo $incomeetc_amt;}else{echo "-";}?></td>
            <td align="center" bgcolor="#FFFFFF"><?=$sharestk_amt_full?></td>
            <!--<td align="center" bgcolor="#FFFFFF"><?=$last_period?></td>-->
          </tr>
		  
          <?php //} ?>
        </table></td>
      </tr>
	  <tr>
				<td colspan="4" bgcolor="#fff" style="color:blue">
				<br>
				<b>**หมายเหตุ</b><br>
				<span style="padding-left:20px">สมาชิกที่มีอายุ 55 ปีบริบูรณ์</span> จะไม่นำเงินวิทยฐานะมาคำนวณสิทธิ์การกู้
				</td>
		  </tr>
    </table></td>
  </tr>
 
</table>
                <br><br>
                
                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
 
  <tr>
    <td bgcolor="#999999"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align="left" bgcolor="#CCCCFF"><table width="100%" border="0" cellspacing="3" cellpadding="3">
          <tr>
            <td width="84%" height="20" align="left"><strong>::สิทธิ์กู้::</strong></td>
            
            </tr>
        </table></td>
        </tr>
      <tr>
        <td align="left" bgcolor="#CCCCCC">
		<table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr>
            <td width="35%" height="25" align="center" bgcolor="#FFFFFF"><strong>สิทธิ์กู้สามัญ</strong></td>
			<td width="35%" align="center" bgcolor="#FFFFFF"><strong>สิทธิ์กู้สวัสดิการ</strong></td>
            <td width="30%" align="center" bgcolor="#FFFFFF"><strong>สิทธิ์กู้ฉุกเฉิน</strong></td>
          </tr>
          <?php 
		      $check_member_type = substr($member_no,0,1);
			  //echo $last_period ; echo '<br>'; echo $salary_amount;
		  if($check_member_type!="ส")
		  {
		       $max_loan = 4100000;
                $no_loan = 'ท่านยังไม่มีสิทธิ์กู้กรุณาติดต่อสหกรณ์';

          if ($last_period >= 6 && $last_period < 12) {

             $shar_2 = $sharestk_amt * 0; //echo '<br>';
             $salary_2 = $salary_amount * 40; //echo '<br>';
             $tatol_2 = $shar_2 + $salary_2; //echo '<br>';
             $tatol_2_format = number_format($tatol_2, 2);

            if ($tatol_2 <= $max_loan) {
			
               $tatol_2_format;
            } else {
             $max_loan;
            }
            } else if ($last_period >= 12 && $last_period < 24) {

            $shar_2 = $sharestk_amt * 0;
            $salary_2 = $salary_amount * 50;
            $tatol_2 = $shar_2 + $salary_2;
            $tatol_2_format = number_format($tatol_2, 2);

            if ($tatol_2 <= $max_loan) {

             $tatol_2_format;
            } else {
             $max_loan;
            }
            } else if ($last_period >= 24 && $last_period < 36) {

            $shar_2 = $sharestk_amt * 0;
            $salary_2 = $salary_amount * 60;
            $tatol_2 = $shar_2 + $salary_2;
            $tatol_2_format = number_format($tatol_2, 2);

            if ($tatol_2 <= $max_loan) {
             $tatol_2_format;
            } else {
             $max_loan;
              }
              } else if ($last_period >= 36 && $last_period < 99999) {

              $shar_2 = $sharestk_amt * 0;
              $salary_2 = $salary_amount * 70;
              $tatol_2 = $shar_2 + $salary_2;
              $tatol_2_format = number_format($tatol_2, 2);

              if ($tatol_2 <= $max_loan) {
              //echo 'A';
               $tatol_2_format;
              } else {
                  //echo 'B';
               $max_loan;
              }

                }
                
               //echo $max_month; exit();
                
                if ($last_period == 6 ) 
				{ $welfare_value="150000";  
            } else if ($last_period >= 7 && $last_period <=12) 
				{ $welfare_value="250000";  
            } else if ($last_period >= 13 && $last_period <=18) 
				{ $welfare_value="350000";  
            } else if ($last_period >= 19 && $last_period <=24) 
				{ $welfare_value="450000";                
            } else if ($last_period >=25) { $welfare_value="600000";  
			}
                        
                        if($tatol_2 < $max_loan){
                         $avg_maxloan = $tatol_2 + $welfare_value;
                         if($avg_maxloan > $max_loan){  
                         $avg  = $tatol_2 - $welfare_value;   
                         }
                               } else {
                                   
                               $avg  = $max_loan - $welfare_value;   
                         
                           }    
		
         ?>
          <tr>
            <td height="25" align="center" bgcolor="#FFFFFF"><?php
            
            
            if($avg_maxloan > $max_loan || $tatol_2 > $max_loan){
               // echo '1'; echo '<br>';
             $avg  = $max_loan - $welfare_value; 
             echo $avg_format = number_format($avg, 2);
             echo "&nbsp;";
             echo "&nbsp;";
             echo 'บาท';
             } else if($avg_maxloan < $max_loan) {
                 // echo '2'; echo '<br>';
               echo $tatol_2_format;
               echo "&nbsp;";
               echo "&nbsp;";
               echo 'บาท';
             }  
            if ($max_month < 6) {

                echo $no_loan;
                 }
            
            ?>
			</td>
			<td height="25" align="center" bgcolor="#FFFFFF">
			<?php  // เงินกู้สวัสดิการ
			
			
			
                        if ($last_period >= 6) {
						
					
						
						if($pb > 500000){
						
						echo "500,000.00";
						
						}else{
						
						echo $welfare_value_full = number_format($welfare_value, 2);
						
						}
						
                
                        }
                        if ($last_period < 6) {

                echo $no_loan;
                 }

            ?>
			</td>
            <td align="center" bgcolor="#FFFFFF"><?php
            
            if ($max_month >= $startmember_time && $max_month <= $endmember_time) {

         $shar = $sharestk_amt * $percentshare;
                                                                              
         $salary = $salary_amount * $percentsalary;
                                                                              
         $tatol = $shar + $salary;
                                                                                                                
                                                 
        //$tatol = number_format($tatol, 2);
		
		require "../s/s.LoanPermission.php"; 
		
		

         if ($tatol <= $maxloan_amt && $check == "1") {   
      					//echo  '1';		 
            echo '-';
           // echo "&nbsp;";
           // echo "&nbsp;";
          //  echo 'บาท';
			
			}else if ($tatol <= $maxloan_amt && $check == "2") {
			
			$tatol = number_format($tatol, 2);
			//echo  '2';
			echo   $tatol;
            echo "&nbsp;";
            echo "&nbsp;";
            echo 'บาท';
			
            } else {
           echo $maxloan_amt_full;
		   
           echo "&nbsp;";
           echo "&nbsp;";
           echo 'บาท';
             }
            } else {

          echo $no_loan;
            }
            
            ?></td>

          </tr>
		  <?php }else{?>
			<tr>
				<td colspan="3"></td>
			</tr>
			<?php } ?>
          
        </table></td>
      </tr>
	  <tr>
		<td colspan="3" bgcolor="#fff" style="color:blue">
			<br><strong>**หมายเหตุ</strong><br>
		<!--	<span style="padding-left:20px;">สิทธิ์การกู้เงิน</span>สามัญคำนวณจากเงินเดือนคูณจำนวน 70 เท่าของเงินเดือน และหรืออายุการเป็นสมาชิก เพื่อเป็นข้อมูลเบื้องต้นในการคำนวณสิทธิ์กู้<br>และการตัดสินใจ กรุณาตรวจสอบสิทธิ์การกู้อีกครั้งที่สหกรณ์ ขอบคุณครับ -->
		<p class="p"><b style="color:black; ">สิทธิการกู้เงินสามัญ</b> สมาชิกรายเดิมที่ใช้สิทธิกู้อยู่ก่อนระเบียบสหกรณ์ออมทรัพย์ครูเพชรบูรณ์ จำกัด ว่าด้วยเงินกู้สามัญ พ.ศ.2562 ก่อนถือใช้ให้ได้รับสิทธิตามเดิม</p>
		<p class="p"><b style="color:black">สิทธิการกู้เงินสวัสดิการ</b> สมาชิกรายเดิมที่ใช้สิทธิกู้อยู่ก่อนระเบียบสหกรณ์ออมทรัพย์ครูเพชรบูรณ์ จำกัด ว่าด้วยเงินกู้สามัญเพื่อสวัสดิการสมาชิก พ.ศ.2562 ก่อนถือใช้ให้ได้รับสิทธิตามเดิม</p>
		<p class="p"><b style="color:black">สิทธิการกู้เงินฉุกเฉิน</b> ให้ใช้ตามระเบียบสหกรณ์ออมทรัพย์ครูเพชรบูรณ์ จำกัด ว่าด้วยเงินกู้เพื่อเหตุฉุกเฉิน พ.ศ.2562</p>
		<p class="p"><b  style="color:black">**สมาชิกกรุณาตรวจสอบสิทธิ์การกู้อีกครั้งที่ฝ่ายสินเชื่อ ณ สหกรณ์ออมทรัพย์ครูเพชรบูรณ์ จำกัด หรือสาขาบริการอำเภอหล่มสัก<br>และสาขาบริการอำเภอบึงสามพัน</b></p>
			</td>
			
	  </tr>
    </table></td>
  </tr>
 
</table>
                <br>
               
                <br><br>
                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
 
  <tr>
    <td bgcolor="#999999"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align="left" bgcolor="#CCCCFF"><table width="100%" border="0" cellspacing="3" cellpadding="3">
          <tr>
            <td width="84%" height="20" align="left"><strong>::คุณมีสัญญาเงินกู้คงเหลือ ดังนี้::</strong></td>
            
            </tr>
        </table></td>
        </tr>
      <tr>
        <td align="left" bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr>
            <td width="25%" height="25" align="center" bgcolor="#FFFFFF"><strong>เลขที่สัญญา</strong></td>
            <td width="25%" align="center" bgcolor="#FFFFFF"><strong>เงินที่ขอกู้</strong></td>
            <td width="25%" align="center" bgcolor="#FFFFFF"><strong>เงินคงเหลือ</strong></td>
            <td width="25%" align="center" bgcolor="#FFFFFF"><strong>จำนวน(งวด)</strong></td>
          </tr>
          <?php require "../s/s.LoanPermission.php"; 
          for($n=0;$n<$Num_Rows1;$n++){ ?>
          <tr>

		  <td height="25" align="center" bgcolor="#FFFFFF"><?=$loancontract_no[$n]?></td>
            <td align="center" bgcolor="#FFFFFF"><?=$loanapprove_amt_full[$n]?></td>
            <td align="center" bgcolor="#FFFFFF"><?=$principal_balance_full[$n]?></td>
            <td align="center" bgcolor="#FFFFFF"><?=$period_payamt[$n]?></td>
		  
		  
          </tr>
          <?php } ?>
        </table></td>
      </tr>
    </table></td>
  </tr>
 
</table>
              <br><br>  
<br />

<p>&nbsp;</p>

<?php }else{ 

        echo '<script type="text/javascript"> window.alert("ขออภัยอยู่ในช่วงดำเนินการปรับปรุงเมนูนี้") </script> ';
		echo "<script>window.location = 'info.php'</script>";

} ?>
