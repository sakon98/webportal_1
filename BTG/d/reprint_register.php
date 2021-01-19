
<html>
<head> <title>ใบสมัครสมาชิก</title>

  <script type="text/javascript">
  function printDiv(divName) {
  var printContents = document.getElementById(divName).innerHTML;
  var originalContents = document.body.innerHTML;

  document.body.innerHTML = printContents;
  window.print();

  document.body.innerHTML = originalContents;
  }
        function chkConfirm()
                {
                
                window.location = 'index.php';
                
                }
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

<style>
  #pp{
    font-size: 16px;
    line-height: 16pt;
    font-family:"Angsana New";
	margin-left: 10px
  }
  #register{
    margin-top: 5pt;
    margin-right:15pt;
  }
  
</style>
</head>
<body>
  <!--<div id="register" >
  <a onclick="window.print()"> <img src="../img/pp.png" width="50px" height="50px" align = 'right'> &nbsp;&nbsp;&nbsp; &nbsp;</a>
</div>-->

<!--<form id="form3" name="form1" method="post" action="">
          <a onclick="chkConfirm()"> <img src="../img/close_page.png" width="50px" height="50px" align = 'right'> &nbsp;&nbsp;&nbsp; &nbsp;</a>
		<a onclick="printdiv('div_print1');checkconfirmclosewindow()"> <img src="../img/pp.png" width="50px" height="50px" align = 'right'> &nbsp;&nbsp;&nbsp; &nbsp;</a>
		
    </form>-->
  
   <?php
   
   require "../include/conf.conn.php";
   require "../include/lib.Etc.php";
   require "../include/lib.Oracle.php";
   
    $card_person = $_POST['card_person'];
   
						  $strSQL = "select TO_CHAR(sysdate, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') as date_now,
                                                mup.prename_desc || mb.memb_name || ' ' || mb.memb_surname as full_name,
                                                mb.memb_addr,
                                                mb.road,
                                                mt.tambol_desc as tambol_code,
                                                md.district_desc as district_code,
                                                mp.province_desc as province_code,
                                                TO_CHAR(mb.birth_date, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA') as birth_date,
                                                floor(floor(MONTHS_BETWEEN(sysdate,mb.birth_date )) /12) as year,
                                                mb.card_person,
                                                trim(mug.membgroup_desc)as membgroup_desc,
                                                mut.position_desc,
                                                mb.salary_id,
                                                (case when mb.mem_tel is null then mb.mem_telmobile 
                                                         when mb.mem_telmobile is null then mb.mem_tel
                                                else mb.mem_tel || ',' || mb.mem_telmobile end) as mem_tel,
                                                mb.periodshare_value,
                                                mb.refer_name,
                                                mb.referaddr_no, 
                                                mb.referaddr_road, 
                                                mt1.tambol_desc as refertambol_code, 
                                                md1.district_desc as referamphur_code, 
                                                mp1.province_desc as referprovince_code, 
                                                muc.gain_concern, 
                                                mb.referaddr_phone,ftreadtbath(mb.periodshare_value) as ftreadtbath , appl_docno
                                                from mbreqappl mb, 
                                                mbucfprename mup,
                                                mbucfmembgroup mug,
                                                mbucfposition mut,
                                                mbucfgainconcern muc,
                                                mbucftambol mt,
                                                mbucfdistrict md,
                                                mbucftambol mt1,
                                                mbucfdistrict md1,
                                                mbucfprovince mp,
                                                mbucfprovince mp1
                                                where mb.card_person = '$card_person' and 
                                                mb.prename_code = mup.prename_code(+) and
                                                mb.membgroup_code = trim(mug.membgroup_code(+)) and
                                                mb.position_code = mut.position_code(+) and
                                                mb.refer_relation = muc.concern_code(+) and
                                                mb.tambol_code = mt.tambol_code(+) and
                                                mb.refertambol_code = mt1.tambol_code(+) and
                                                mb.district_code = md.district_code(+) and
                                                mb.referamphur_code = md1.district_code(+) and
                                                mb.province_code = mp.province_code(+) and
                                                mb.referprovince_code = mp1.province_code(+)  and mb.appl_status <> '1' and mb.appl_docno = (select max(mb1.appl_docno) from mbreqappl mb1 where mb1.card_person = mb.card_person) ";
						$objParse = oci_parse($objConnect, $strSQL);
						oci_execute ($objParse,OCI_DEFAULT);
							while($objResult = oci_fetch_array($objParse,OCI_BOTH)){
					
                                                     $date_now  = $objResult[0];
                                                     $full_name = $objResult[1]; 
                                                     $memb_addr = $objResult[2];
                                                     $road = $objResult[3];
                                                     $tambol_code = $objResult[4];
                                                     $district_code = $objResult[5];
                                                     $province_code = $objResult[6];
                                                     $birth_date = $objResult[7];
                                                     $year = $objResult[8];
                                                     $card_person = $objResult[9];
                                                     $membgroup_desc = $objResult[10];
                                                     $position_desc = $objResult[11];
                                                     $salary_id = $objResult[12];
                                                     $mem_tel = $objResult[13];
                                                     $periodshare_value = $objResult[14];
													 $periodshare_value = number_format($periodshare_value, 2);
                                                     $refer_name = $objResult[15];
                                                     $referaddr_no = $objResult[16];
                                                     $referaddr_road = $objResult[17];
                                                     $refertambol_code = $objResult[18];
                                                     $referamphur_code = $objResult[19];
                                                     $referprovince_code = $objResult[20];
                                                     $gain_concern = $objResult[21];
                                                     $referaddr_phone = $objResult[22];
													  $ftreadtbath = $objResult[23];
													  $appl_docno = $objResult[24];

                                                    
                                                    ?>
							
    <div id="div_print1">
  <div id="pp"> <center><h4><b> ใบสมัครสมาชิก สหกรณ์ออมทรัพย์พนักงานเครือเบทาโกร จำกัด </b></h4></center> </div>
  <div id="pp"><center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

เขียนที่ ....................................................... </center></div>
  <div id="pp"><center>วันที่ <?php echo $date_now; ?></center></div><br><br>
  <div id="pp">เรียน&nbsp;&nbsp;&nbsp;คณะกรรมการดำเนินการ &nbsp;สหกรณ์ออมทรัพย์พนักงานเครือเบทาโกร จำกัด</div><br>
  <div id="pp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้า &nbsp;&nbsp;<?php echo $full_name; ?> &nbsp;อยู่บ้านเลขที่ <?php echo $memb_addr; ?> ถนน <?php echo $road; ?> ตำบล/แขวง <?php echo $tambol_code; ?> อำเภอ/เขต <?php echo $district_code; ?>  จังหวัด <?php echo $province_code; ?></div>
  <div id="pp"> ได้ทราบวัตถุประสงค์ของสหกรณ์โดยตลอดแล้วและเห็นชอบในวัตถุประสงค์ของสหกรณ์ จึงขอสมัครเข้าเป็นสมาชิกของสหกรณ์ และ</div>
 <div id="pp">ขอให้ถ้อยคำเป็นหลักฐานดังต่อไปนี้</div><br> 
  <div id="pp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อ 1. ข้าพเจ้ามีอายุ <?php echo $year; ?> ปี  &nbsp;&nbsp; (วัน/เดือน/ปีเกิด) <?php echo $birth_date; ?>&nbsp;&nbsp;
  บัตรประจำตัวประชาชนเลขที่ <?php echo $card_person; ?> </div><br>
  <div id="pp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อ 2. ข้าพเจ้าเป็นพนักงานประจำ  &nbsp;&nbsp;<?php echo $membgroup_desc; ?> 
  <br>ตำแหน่ง &nbsp;&nbsp;<?php echo $position_desc; ?>&nbsp;&nbsp; รหัสพนักงาน <?php echo $salary_id; ?>&nbsp;&nbsp; โทรศัพท์ที่ติดต่อ <?php echo $mem_tel; ?> </div><br>
  <div id="pp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อ 3. ข้าพเจ้ามิได้เป็นสมาชิกในสหกรณ์ออมทรัพย์อื่น   ซึ่งมีวัตถุประสงค์ในการกู้ยืมเงิน</div><br>
  <div id="pp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อ 4. เมื่อข้าพเจ้าได้เข้าเป็นสมาชิกสหกรณ์ฯ       ข้าพเจ้าขอแสดงความจำนงส่งเงินค่าหุ้นรายเดือนต่อสหกรณ์ในอัตราเดือนละ  <?php echo $periodshare_value; ?> บาท ( <?php echo $ftreadtbath; ?> )    มูลค่าหุ้นละ  10  บาท     และไม่น้อยกว่าอัตราที่กำหนด</div><br>
  <div id="pp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อ 5. ถ้าข้าพเจ้าได้เป็นสมาชิก      ข้าพเจ้ายินยอมให้ผู้บังคับบัญชาหรือเจ้าหน้าที่จ่ายเงินได้รายเดือนของข้าพเจ้าหักเงินได้ของข้าพเจ้า</div>
  <div id="pp">ตามจำนวนเงินค่าหุ้นรายเดือน      และจำนวนเงินค่างวดชำระหนี้        เพื่อส่งสหกรณ์ทุกครั้งที่มีการจ่ายเงินได้รายเดือนด้วย</div><br>
  <div id="pp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อ 6. ข้าพเจ้าสัญญาว่าถ้าสหกรณ์ตกลงให้ข้าพเจ้าเป็นสมาชิกได้       ข้าพเจ้าจะลงลายมือชื่อในทะเบียนสมาชิกทั้งชำระค่าธรรมเนียม</div>
  <div id="pp">แรกเข้าและเงินค่าหุ้นตามข้อบังคับสหกรณ์ให้เสร็จภายในวันที่สหกรณ์ได้กำหนดการชำระเงินจำนวนดังกล่าวนี้ และข้าพเจ้ายินยอมให้</div>
  <div id="pp">ปฏิบัติตามความในข้อ 5. ด้วย</div><br>
  <div id="pp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อ 7. ถ้าข้าพเจ้าได้เป็นสมาชิกจะปฏิบัติตามข้อบังคับระเบียบการ    และมติของสหกรณ์ฯทุกประการ</div><br><br>
  <div id="pp"><center> ....................................................ผู้สมัคร</center></div>
  <div id="pp"><center>(&nbsp; <?php echo $full_name; ?> &nbsp;)</center></div><br>
  <div id="pp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ขอรับรองว่าข้อความข้างต้นเป็นความจริง</div><br>
  <div id="pp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;............................................ผู้รับรอง (ผู้บังคับบัญชาตามสายงาน)</div>
  <div id="pp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(............................................)</div>
  <div id="pp">&nbsp;&nbsp;&nbsp;&nbsp;ตำแหน่ง............................................</div><br>
  <div id="pp"><b><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u> </b> </div>
  <div id="pp"><b><u>หมายเหตุ</u> ผู้สมัครจะต้องแนบสำเนาบัตรประชาชน และสำเนาหน้าบัญชีธนาคารที่เข้าเงินเดือน (เซ็นรับรองสำเนาถูกต้อง)</b> </div><br><br>
  <div id="pp"><b> บุคคลอ้างอิง &nbsp;&nbsp;&nbsp;</b></div>
  <div id="pp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $refer_name; ?>&nbsp;&nbsp;&nbsp; อยู่บ้านเลขที่ <?php echo $referaddr_no; ?> ถนน <?php echo $referaddr_road; ?>  ตำบล/แขวง <?php echo $refertambol_code; ?> อำเภอ/เขต <?php echo $referamphur_code; ?> จังหวัด <?php echo $referprovince_code; ?></div>
  <div id="pp">ความสัมพันธ์ <?php echo $gain_concern; ?>&nbsp;&nbsp; โทรศัพท์ที่ติดต่อ <?php echo $referaddr_phone; ?></div><br>
  <!--<div id="pp">โทรศัพท์ที่ติดต่อ <?php //echo $referaddr_phone; ?></div><br>-->
  
                        <?php }   if($appl_docno != "") { ?>
  
  <div id="pp"><b> ผู้รับผลประโยชน์ </b></div>
  <div id="pp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เงินค่าหุ้น เงินปันผล เงินเฉลี่ยคืนเมื่อข้าพเจ้าถึงแก่กรรม คือ </div>
  
   <?php 
 
   
					$strSQL = "SELECT MUP.PRENAME_DESC || MB.GAIN_NAME || ' ' || MB.GAIN_SURNAME AS FULLGAINNAME,
                                                    MB.GAIN_ADDR,
                                                    MUC.GAIN_CONCERN,
                                                    MB.GAIN_PERCENT,MB.SEQ_NO,MB.GAINCARD_PERSON
                                                    FROM MBREQAPPLGAIN MB , MBUCFPRENAME MUP , MBUCFGAINCONCERN MUC
                                                    WHERE MB.PRENAME_CODE = MUP.PRENAME_CODE(+) AND
                                                    MB.GAIN_RELATION = MUC.CONCERN_CODE(+) AND MB.APPL_DOCNO = '$appl_docno' ORDER BY  MB.SEQ_NO ";
					$value = array('FULLGAINNAME','GAIN_ADDR','GAIN_CONCERN','GAIN_PERCENT','SEQ_NO','GAINCARD_PERSON');
					list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
					$j=0;
					for($i=0;$i<$Num_Rows;$i++){
						$fullgainname = $list_info[$i][$j++];
						$gain_addr = $list_info[$i][$j++];
						$gain_concern = $list_info[$i][$j++];
                                                $gain_percent = $list_info[$i][$j++];
                                                $seq_no = $list_info[$i][$j++];
												$gaincard_person = $list_info[$i][$j++];
												
												if($gaincard_person == ""){
												
												$gaincard_person = " (ไม่ได้ระบุ) ";
												
												}
						$j=0;
					
				?>
  
  <div id="pp"> <?php echo $seq_no; ?>.&nbsp;<?php echo $fullgainname; ?> &nbsp;&nbsp; <?php echo $gain_addr; ?> &nbsp;&nbsp;  ความสัมพันธ์ <?php echo $gain_concern; ?> &nbsp;&nbsp;&nbsp;   เลขบัตรประชาชน <?php echo $gaincard_person; ?></div>
  <div id="pp">โทรศัพท์ที่ติดต่อ ...................................... ผลประโยชน์คิดเป็น  &nbsp;&nbsp; <?php echo $gain_percent; ?>%</div><br>
  
     <?php } 
	 
	 }else{  
	 echo '<script type="text/javascript"> window.alert("ไม่พบใบคำขอ !!! กรุณาทำรายการใหม่อีกครั้ง") </script> ';
     echo "<script>window.location = 'index.php'</script>";
	exit; 
	} 
	?>
	 
	 </div>
               
</body>
</html>
