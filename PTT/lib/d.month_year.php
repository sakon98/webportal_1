<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?>

<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left"><strong><font size="4" face="Tahoma">แจ้งสถานะภาพ</font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Status Report</font></td>
  </tr>
  <tr>
    <td align="left"><hr color="#999999" size="1"/></td>
  </tr>
</table>


<?php 


$year = date("Y"); // ปีปัจจุบัน เป็น ค.ศ 
$year_min = $year - 5; // config ว่าจะเอา ปีย้อนหลังกี่ปี ในที่นี้เอาเป็นย้อนหลัง 5 ปี


?>
<center><h3><font color="red">กรุณาเลือกข้อมูลที่ต้องการตรวจสอบ เเจ้งสถานะภาพ</font></h3></center>

<center><div>
        <form id="form1" name="form1" method="post" action="d.month_year_show.php">
 
        <select name="month" id="month">
      	<option value="">-- กรุณาเลือกเดือน --</option>	
        <option value="01">มกราคม</option>
        <option value="02">กุมภาพันธ์</option>
        <option value="03">มีนาคม</option>
        <option value="04">เมษายน</option>
        <option value="05">พฤษภาคม</option>
        <option value="06">มิถุนายน</option>
        <option value="07">กรกฎาคม</option>
        <option value="08">สิงหาคม</option>
        <option value="09">กันยายน</option>
        <option value="10">ตุลาคม</option>
        <option value="11">พฤศจิกายน</option>
        <option value="12">ธันวาคม</option>	
        </select>
        
        <select name="year" id="year">
      	<option value="">-- กรุณาเลือกปี --</option>	
        <?php for($i=$year;$i >= $year_min; $i--) {?>
        <option value="<?=$i?>"><?=$i + 543?></option>
		<?php } ?>
        </select>
        <br><br>
        
        <input type="button" name="button" id="button" value="Submit" class="addnews" onclick="this.form.submit();" />
        
    </form>
  
    </div></center>