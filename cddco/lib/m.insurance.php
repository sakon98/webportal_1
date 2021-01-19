<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?><head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php
require "../s/s.Insurance.php";
?>



<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right"><strong><font size="4" face="Tahoma">ข้อมูลประกัน</font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Insurance</font></td>
  </tr>
</table>
<hr color="#999999" size="1"/>
<div data-role="collapsible-set" data-theme="b" data-content-theme="d">
     <ul data-role="listview" data-inset="true">
        <?php for($i=0;$i<$Num_Rows;$i++) {  ?>
    <li>ปี  <?php echo $insure_year[$i] ?> (เริ่มคุ้มครอง  <?php echo $startinsure_date[$i] ?> - <?php echo $expinsure_date[$i] ?>)</li>
        <?php } ?>
	</ul>
    <div data-role="collapsible">
        <h2>ข้อมูลประกันสมาชิก</h2>
        <ul data-role="listview" data-theme="d" data-divider-theme="d">
            
          	  <?php 

 			for($i=0;$i<$Num_Rows;$i++) { 
			
			//echo $insuretype_code_f[$i] ;
			
			   ?>
            <li>             
                <p>ชื่อ - สกุล : <?=$fullname[$i] ?></p>
                <p>แผน : <?=$insuretype_code_f[$i] ?></p>
                <p>ค่าเบี้ย : <?=$insurance_amt_f[$i] ?></p>
                <p>เงินประกัน : <?=$insurance_money[$i] ?></p>
            </li>
             <?php } ?>   
        </ul>
    </div>
    <?php 
		if($Num_Rows1 > 0 ){
	?>
     <div data-role="collapsible">
        <h2>สมาชิกประกันสมทบ</h2>
        <ul data-role="listview" data-theme="d" data-divider-theme="d">
            
          	  <?php 

 			for($n=0; $n <$Num_Rows1; $n++) { 
			   ?>
            <li>             
                <p>ชื่อ - สกุล : <?=$insurejoin_name[$n] ?></p>
                <p>แผน : <?=$insuretype_code[$n] ?></p>
                <p>ค่าเบี้ย : <?=$insurance_amt[$n] ?></p>
                <p>ความสัมพันธ์ : <?=$gain_concern[$n] ?></p>
            </li>
             <?php } ?>   
        </ul>
    </div>
     <?php } ?>  
    <ul data-role="listview" data-inset="true">
        <?php for($i=0;$i<$Num_Rows;$i++) {  ?>
    <li><font color="#FF0000">** สำหรับสมาชิกสหกรณ์ออกค่าเบี้ยประกันให้ 550.00 บาท</font></li>
	<li><font color="#3300FF">** ข้อมูลประกัน แผน1 = 100,000 บาท/ แผน2 = 200,000 บาท / แผน3 = 300,000 บาท</font></li>
        <?php } ?>
	</ul>
</div>
