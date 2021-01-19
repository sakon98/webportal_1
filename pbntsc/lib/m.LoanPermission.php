<?php
session_start();
header('Content-Type: text/html; charset=tis-620');
?><head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php
$spac="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
require "../s/s.LoanPermission.php";
?>
<style>
	.contant li{
			font-weight: normal;
			margin-left:5%;
			margin-top:0.5%;
	}
	.contant p{
		    font-size:100%;
	}
</style>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right"><strong><font size="4" face="Tahoma">สิทธิ์กู้</font></strong><br />
      <font color="#FF6600" size="2" face="Tahoma">Loan Permission</font></td>
  </tr>
</table>
<hr color="#999999" size="1"/>
<div data-role="collapsible-set" data-theme="b" data-content-theme="d">
    <div data-role="collapsible" class="contant">
	
        <h2>ข้อมูลที่ใช้พิจารณาสิทธิ์กู้</h2>
        <ul data-role="listview" data-theme="d" data-divider-theme="d">
            <li>
					<b>เป็นสมาชิกวันที่</b><br>
					<?php echo $spac,$spac,$member_date; ?> 
            </li>
			<li>
					<b>เงินเดือน</b><br>
					<?php echo $spac,$spac; ?><?php
						$check_member_type = substr($member_no,0,1);
						if($check_member_type !="ส")
						{
							echo $salary_amount_full," บาท";
						}else{ echo "-"; }
					?>
			</li>
			      <li>
					<b>เงินวิทยฐานะ</b><br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($incomeetc_amt!=0){echo $incomeetc_amt;}else{echo "<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-</b>";}?>
            </li>
			</li>
			      <li>
					<b>ทุนเรือนหุ้น</b><br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$sharestk_amt_full." บาท"?></td>
            </li>
			<li  bgcolor="#fff" style="color:blue">
					<b>**หมายเหตุ</b><br>
				<span style="padding-left:55px">สมาชิกที่มีอายุ 55 ปีบริบูรณ์</span> จะไม่นำเงินวิทยฐานะมาคำนวณสิทธิ์การกู้
			</li>
        </ul>
    </div>
    <div data-role="collapsible" class="contant">
        <h2>สิทธิ์กู้</h2>
        <ul data-role="listview" data-theme="d" data-divider-theme="d">
			
				
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
		 <li>
          <?php
            if($avg_maxloan > $max_loan || $tatol_2 > $max_loan){
               // echo '1'; echo '<br>';
             $avg  = $max_loan - $welfare_value; 
			     echo "<b>สิทธิ์กู้สามัญ</b><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
             echo $avg_format = number_format($avg, 2);
             echo ' บาท';
             } else if($avg_maxloan < $max_loan) {
                 // echo '2'; echo '<br>';
               echo $tatol_2_format;
               echo "&nbsp;";
               echo "&nbsp;";
               echo ' บาท';
             }  
            if ($max_month < 6) {

                echo $no_loan;
                 }
            
            ?>
			</li>
			<li>
				<b>สิทธิ์กู้สวัสดิการ</b><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php  // เงินกู้สวัสดิการ
                        if ($last_period >= 6) {
                echo $welfare_value_full = number_format($welfare_value, 2)." บาท";
                        }
                        if ($last_period < 6) {

                echo $no_loan." บาท";
                 }

            ?>
			</li>
            <li><b>สิทธิ์กู้ฉุกเฉิน</b><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php
            
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
            
            ?></li>

          
		  <?php }else{?>
					
			<?php } ?>
			<li bgcolor="#fff" style="color:blue"><strong>**หมายเหตุ</strong><br>
				<span style="padding-left:20px; text-align: justify;"  >&nbsp;&nbsp;<b style="color:black;">สิทธิการกู้เงินสามัญ</b> สมาชิกรายเดิมที่ใช้สิทธิกู้อยู่ก่อนระเบียบสหกรณ์ออมทรัพย์ครูเพชรบูรณ์ จำกัด ว่าด้วยเงินกู้สามัญ พ.ศ.2562 ก่อนถือใช้ให้ได้รับสิทธิตามเดิม </span><br>
				<span style="padding-left:20px; text-align: justify;">&nbsp;&nbsp;<b style="color:black;">สิทธิการกู้เงินสวัสดิการ</b>สมาชิกรายเดิมที่ใช้สิทธิกู้อยู่ก่อนระเบียบสหกรณ์ออมทรัพย์ครูเพชรบูรณ์ จำกัด ว่าด้วยเงินกู้สามัญเพื่อสวัสดิการสมาชิก พ.ศ.2562 ก่อนถือใช้ให้ได้รับสิทธิตามเดิม </span><br>
				<span style="padding-left:20px; text-align: justify;">&nbsp;&nbsp;<b style="color:black;">สิทธิการกู้เงินฉุกเฉิน</b>ให้ใช้ตามระเบียบสหกรณ์ออมทรัพย์ครูเพชรบูรณ์ จำกัด ว่าด้วยเงินกู้เพื่อเหตุฉุกเฉิน พ.ศ.2562</span><br>
				<span style="padding-left:20px; text-align: justify;">&nbsp;&nbsp;<b style="color:black;">**สมาชิกกรุณาตรวจสอบสิทธิ์การกู้อีกครั้งที่ฝ่ายสินเชื่อ ณ สหกรณ์ออมทรัพย์ครูเพชรบูรณ์ จำกัด หรือสาขาบริการอำเภอหล่มสัก และสาขาบริการอำเภอบึงสามพัน</b></span>
			</li>
        </ul>
    </div>
	 <div data-role="collapsible" class="contant">
        <h2>คุณมีสัญญาเงินกู้คงเหลือ</h2>
        <ul data-role="listview" data-theme="d" data-divider-theme="d">
           <?php require "../s/s.LoanPermission.php"; 
          for($n=0;$n<$Num_Rows1;$n++){ ?>
          <li>
				<p><b>เลขที่สัญญา&nbsp;:</b> <?=$loancontract_no[$n]?><p>
				<p><b>เงินที่ขอกู้ &nbsp;&nbsp;&nbsp;&nbsp;: </b><?=$loanapprove_amt_full[$n]?> บาท<p>
                <p><b> เงินคงเหลือ &nbsp;:</b> <?=$principal_balance_full[$n]?> บาท<p>
				<p><b>จำนวนงวด &nbsp;&nbsp;: </b><?=$period_payamt[$n]?> งวด</p>
		  
		  
          </li>
          <?php } ?>
        </ul>
	</div>
</div>

