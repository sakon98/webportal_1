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
<?php


	$sql="alter table yrconfirmmaster add (confirm_id varchar2(50) ,confirm_email varchar2(150) ,confirm_date date ,confirm_flag number(1,0) default 0 not null ,confirm_remark varchar2(255) )";
    get_single_value_oci($sql,$value1);
	
	
if(isset($_REQUEST["save"])){
	
	
	$sql="update yrconfirmmaster 
				set confirm_id='$member_no' ,confirm_email='$email',confirm_date=sysdate 
				,confirm_flag='".$_REQUEST["confirm_flag"]."',confirm_remark='".str_replace("'","^",$_REQUEST["confirm_remark"])."' 
				where member_no='$member_no' 
				and to_char(balance_date,'yyyy-mm-dd')='".$_REQUEST["slip_date"]."' ";
	//echo $sql;			
    get_single_value_oci($sql,$value1);
	
	echo "<script>alert('ระบบได้รับการบันทึกเรียบร้อย');</script>";
}
?>
	   <?php
					$strSQL = "SELECT 
									      to_char(balance_date,'yyyy-mm-dd') as balance_date_str
										FROM 
											yrconfirmmaster 
										WHERE 
											MEMBER_NO = '$member_no' 
										order by balance_date desc ";
					//echo 	$strSQL;				
					$value = array('BALANCE_DATE_STR');		
					list($Num_Rows,$slip_show) = get_value_many_oci($strSQL,$value);	
					$j=0;

					for($i=0;$i<$Num_Rows;$i++){ 
					    $balance_date_str=$slip_show[$i][$j++];
						if(isset($_REQUEST["slip_date"])==false)
					       $_REQUEST["slip_date"]=$balance_date_str;	
						$j=0;
                    }
	   ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="82%" align="left"><strong><font size="4" face="Tahoma">รายการยืนยันยอด ณ <?=ConvertDateYmd($_REQUEST["slip_date"],"long")?></font></strong><br />
    <font color="#0000FF" size="2" face="Tahoma">Monthly Payment</font></td>
    <td width="18%" align="right" valign="top">
    <form id="formID1" name="formID1" method="post" action="" >
        <select name="slip_date" id="slip_date"  onchange="this.form.submit()" >
            <option value=""> --- กรุณาเลือก ---</option>
                  <?php  					  
					
					for($i=0;$i<$Num_Rows;$i++){ 
					    $balance_date_str=$slip_show[$i][$j++];
						if(isset($_REQUEST["slip_date"])==false)
					       $_REQUEST["slip_date"]=$balance_date_str;
						echo '<option value="'.$balance_date_str.'" '.(($_REQUEST["slip_date"]==$balance_date_str)?"selected":"").'>'.ConvertDateYmd($balance_date_str,"long").'</option>';		
						$j=0;
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
<?php 
if(isset($_REQUEST["slip_date"])&&$_REQUEST["slip_date"]!=""){

?>
<?php
					$strSQL = "SELECT 
									     yt.seq_no,
										 y.balance_date,
										 yt.FROM_SYSTEM,
										 yt.BIZZACCOUNT_NO,
										 yt.BALANCE_AMT,
										 y.CONFIRM_FLAG,
										 y.CONFIRM_REMARK,
										 y.CONFIRM_DATE
										FROM 
											yrconfirmstatement yt,yrconfirmmaster y
										WHERE 
											y.MEMBER_NO = '$member_no' 
											and to_char(y.balance_date,'yyyy-mm-dd')='".$_REQUEST["slip_date"]."'
											and y.member_no=yt.member_no 
											and y.balance_date=yt.balance_date 
										order by y.balance_date desc, yt.seq_no asc ";
					//echo 	$strSQL;				
					$value = array('SEQ_NO','FROM_SYSTEM','BIZZACCOUNT_NO','BALANCE_AMT','CONFIRM_FLAG','CONFIRM_REMARK','CONFIRM_DATE');		
					list($Num_Rows,$slip_show) = get_value_many_oci($strSQL,$value);	
					$j=0;

	   ?>
<table width="75%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="35%" height="25" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">รายการ</font></strong></td>
        <td width="15%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">เลขที่อ้างอิง</font></strong></td>
        <td width="35%" align="center" bgcolor="#FFCC33"><strong>จำนวนเงิน</strong></td>
      </tr>
      <?php for($i=0;$i<$Num_Rows;$i++){
		  
		  $case="หนี้";
		  if($slip_show[$i][1]=="DEP")$case="เงินฝาก";
		  if($slip_show[$i][1]=="SHR")$case="หุ้น";
		  if($slip_show[$i][1]=="GRT")$case="ค้ำประกัน";
		  $confirm_flag=$slip_show[$i][4];
		  $confirm_remark=$slip_show[$i][5];
		  $confirm_date=$slip_show[$i][6];
		  ?>  
      <tr>
        <td height="28" bgcolor="#FFFFFF"><?=($i+1).'. '?><?=$case?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$slip_show[$i][2]?></td>
        <td align="right" bgcolor="#FFFF99"><?=number_format($slip_show[$i][3],2)?></td>
      </tr>
      <?php } ?>   
    </table></td>
  </tr>
</table>
<form id="form1" name="form1" method="post" onsubmit="return confirm('กรุณายืนยันการทำรายการ ยืนยันยอด');">
<table  border="0" align="center" cellspacing="1" cellpadding="3">
  <tr>
    <td align="center" colspan=2><font color="blue">*ระบบจะแสดงข้อมูลรายการล่าสุด กรุณาตรวจสอบเพื่อบันทึกยืนยันยอด</font></td>
  </tr>
  <tr>
    <td align="right"  bgcolor="#6699FF" ><font color="#FFFFFF">เลือกการยืนยัน : </font></td> 
    <td bgcolor="#FFCC33" >
	 <input type="radio" name="confirm_flag" value="0" <?=$confirm_flag==0?"checked=\"checked\"":""?>  onchange="validConfirm()"  />รอยืนยันรายการ<br/>
	 <input type="radio" name="confirm_flag" value="1" <?=$confirm_flag==1?"checked=\"checked\"":""?>  onchange="validConfirm()"   />ขอยืนยันว่าจำนวนเงินและรายการทั้งหมดยอดถูกต้อง<br/>
	 <input type="radio" name="confirm_flag" value="-1" <?=$confirm_flag==-1?"checked=\"checked\"":""?> onchange="validConfirm()"   />ขอแจ้งรายละเอียดจำนวนเงินไม่ถูกต้องดังนี้<br/>
	</td>
	</tr>
  <tr>
    <td align="right"  bgcolor="#6699FF" ><font color="#FFFFFF">วันที่บันทึก: </font></td> 
    <td bgcolor="#FFCC33" ><?=$confirm_date?></td>
	</tr>
  <tr id="show_confirm_remark" style="display:<?=($confirm_flag==-1?"":"none")?> ;">
    <td align="right"  bgcolor="#6699FF">
	  <font color="#FFFFFF"> หมายเหตุ	: </font></td> 
    <td >	
	   <textarea id="confirm_remark" name="confirm_remark" rows=5 cols="70"><?=$confirm_remark?></textarea> 
	       </td>
  </tr>
  <tr>
    <td align="right"> </td> 
    <td >
      <input type="submit" name="save" id="save" value="บันทึก" />
      <input type="hidden" name="slip_date" value="<?=$_REQUEST["slip_date"]?>" id="slip_date" />
    </td>
  </tr>
</table>
    </form>
	<script>
	
	function validConfirm(){
		 var show_confirm_remark=document.getElementById("show_confirm_remark");
		 var confirm_flag=document.getElementsByName("confirm_flag");
		 var confirm_flag_value=0;
        for ( var i = 0; i < confirm_flag.length; i++) {
            if (confirm_flag.item(i).checked) {
                confirm_flag_value= confirm_flag.item(i).value;
				//alert("Check:"+confirm_flag.item(i).value);
            } else {
				//alert("UnCheck:"+confirm_flag.item(i).value);
                //if you find any in the group not a radio button return null
                //return null;
            }
        }
		
		 
		 if(confirm_flag_value=="-1"){
			 //alert("Check:"+confirm_flag_value);
			 document.getElementById("show_confirm_remark").style.display="";
		 }else{
			 //alert("Check:"+confirm_flag_value);
			 document.getElementById("show_confirm_remark").style.display="none";
			 document.getElementById("confirm_remark").value="";
		 }
	}
	</script>
<p>&nbsp;</p>
<?php } ?>
