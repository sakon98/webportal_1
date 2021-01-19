<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?>
<?php require "../include/jquery.popup.php"; ?>
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
	
	 $mailtype_code='M05';
	 $mailtype_desc='5.ส่งอีเมลแจ้งข้อมูลการจ่ายเงินกู้ ';
	 $duedate=45;

	 $sql="create table cmmaillog (
				pk_id varchar2(50) not null ,
				mailtype_code varchar2(10) not null,
				member_no varchar2(10) not null,
				memb_fullname varchar2(250) ,
				salary_id varchar2(10) ,
				addr_email varchar2(150) not null,
				mailtype_desc varchar2(150),
				ref_pk varchar2(255),
				sentmail_date date,
				sentmail_flag number(1,0) default 0 not null,
				sentmail_remark varchar2(150),
				entry_id varchar2(50),
				entry_date date
				)";
	 get_single_value_oci($sql,$value1);			
	 $sql="ALTER TABLE cmmaillog ADD ( CONSTRAINT cmmaillog_PK PRIMARY KEY ( PK_ID,mailtype_code, MEMBER_NO,sentmail_date )) "; 
	 get_single_value_oci($sql,$value1);
	 $sql="ALTER TABLE cmmaillog modify ref_pk varchar2(255) "; 
	 get_single_value_oci($sql,$value1);
 

if(isset($_REQUEST["save"])){
	
	/*
	$sql="update yrconfirmmaster 
				set confirm_id='$member_no' ,confirm_email='$email',confirm_date=sysdate 
				,confirm_flag='".$_REQUEST["confirm_flag"]."',confirm_remark='".str_replace("'","^",$_REQUEST["confirm_remark"])."' 
				where member_no='$member_no' 
				and to_char(balance_date,'dd-MM-')||to_char(to_number(to_char(balance_date,'yyyy'))+543)='".$_REQUEST["slip_date"]."' ";
	//echo $sql;			
    get_single_value_oci($sql,$value1);
	
	echo "<script>alert('ระบบได้รับการบันทึกเรียบร้อย');</script>";
	*/
}

if($_REQUEST["sentmail_action"]=="1"){
	
/*	
config in include/conf.c.php 
$WEB_LINK="http://127.0.0.1/BTG/webportal/d/index.php";
$MAIL_HOST="smtp.gmail.com";
$MAIL_PORT=587;
$MAIL_USR="isocare.iscobtg@gmail.com";
$MAIL_PWD="0815501888";
$MAIL_FROM="isocare.iscobtg@gmail.com";
$MAIL_FROM_NM="สอ.เบทาโกร";
$MAIL_DEBUG=1;// 0 =disable , 1=enable
$MAIL_AUTH_FLAG=true;
$MAIL_SECURE='tls';
*/	

$SLIP_DATE=ConvertDateYmd(date("Y-m-d"),"long");
$MEMB_NO=$_REQUEST["memb_no"];

				  $strSQL_ = "SELECT 
										 m.member_no,
										 m.salary_id,
										 m.memb_name,
										 m.memb_surname,
										 mb.membgroup_desc,
										 m.addr_email 
										FROM mbmembmaster m,mbucfmembgroup mb
										where m.membgroup_code=mb.membgroup_code 
										and m.member_no='".$MEMB_NO."'";
					//echo 	$strSQL_;				
					$value_ = array('MEMBER_NO','SALARY_ID','MEMB_NAME','MEMB_SURNAME','MEMBGROUP_DESC','ADDR_EMAIL');		
					list($Num_Rows_,$mbdata) = get_value_many_oci($strSQL_,$value_);	
					
$SALARY_ID=$mbdata[0][1];
$MEMB_NAME=$mbdata[0][2];
$MEMB_SURNAME=$mbdata[0][3];
$MEMBGROUP_DESC=$mbdata[0][4];
$MEMBER_EMAIL=$mbdata[0][5];
$LOANCONTRACT_NO=$_REQUEST["loancontract_no"];
$LOANAPPROVE_AMT=$_REQUEST["loanapprove_amt"];
$PRINCIPAL_BALANCE=$_REQUEST["principal_balance"];
$INTEREST_PAYMENT=$_REQUEST["interest_payment"];
$PAYOUTNET_AMT=$_REQUEST["payoutnet_amt"];
$PERIOD_PAYAMT=$_REQUEST["period_payamt"];
$PERIOD_PAYMENT=$_REQUEST["period_payment"];
$STARTKEEP_DATE=$_REQUEST["startkeep_date"];
$LOANTYPE_DESC=$_REQUEST["loantype_desc"];
$INTEREST_RATE=$_REQUEST["interest_rate"];
$SLIP_DATE=$_REQUEST["slip_date"];
$SLIP_DATE_=ConvertDateYmd($SLIP_DATE,"long");

if($MAIL_TEST_MODE){
$MEMBER_EMAIL=$MAIL_TEST_EMAIL;
}

$Subject=conv("แจ้งการจ่ายเงินกู้");//conv($MAIL_FROM_NM." "."หนังสือยืนยันยอดหุ้นหนี้ และเงินฝาก ณ วันที่ ".$SLIP_DATE);	
$body=file_get_contents('../include/emailloanpay_template.html', true);
$body=str_replace("COOP_NAME",conv($MAIL_FROM_NM),$body);
$body=str_replace("COOP_ADDR",conv($COOP_ADDR),$body);
$body=str_replace("SENT_DATE",conv(ConvertDate(date("d-m-Y"),"long")),$body);
$body=str_replace("SLIP_DATE",conv($SLIP_DATE_),$body);
$body=str_replace("MEMBER_NO",$MEMB_NO,$body);
$body=str_replace("WEB_LINK",$WEB_LINK,$body);
$body=str_replace("MEMB_NAME",conv($MEMB_NAME),$body);
$body=str_replace("MEMB_SURNAME",conv($MEMB_SURNAME),$body);
$body=str_replace("SALARY_ID",$SALARY_ID,$body);
$body=str_replace("MEMBGROUP_DESC",conv($MEMBGROUP_DESC),$body);
$body=str_replace("LOANTYPE_DESC",conv($LOANTYPE_DESC),$body);
$body=str_replace("LOANCONTRACT_NO",conv($LOANCONTRACT_NO),$body);
$body=str_replace("LOANAPPROVE_AMT",$LOANAPPROVE_AMT,$body);
$body=str_replace("PRINCIPAL_BALANCE",$PRINCIPAL_BALANCE,$body);
$body=str_replace("INTEREST_PAYMENT",$INTEREST_PAYMENT,$body);
$body=str_replace("PAYOUTNET_AMT",$PAYOUTNET_AMT,$body);
$body=str_replace("PERIOD_PAYAMT",$PERIOD_PAYAMT,$body);
$body=str_replace("PERIOD_PAYMENT",$PERIOD_PAYMENT,$body);
$body=str_replace("STARTKEEP_DATE",conv($STARTKEEP_DATE),$body);
$body=str_replace("INTEREST_RATE",$INTEREST_RATE,$body);
//$body=conv($body);
$mail_to=array($MEMBER_EMAIL);
$mail_to_nm=array(conv($MEMB_NAME." ".$MEMB_SURNAME));	
$MAIL_FROM_NM=conv($MAIL_FROM_NM);

$msg=sendMail(
	$MAIL_HOST,
	$MAIL_PORT,
	$MAIL_USR,
	$MAIL_PWD,
	$MAIL_FROM,
	$MAIL_FROM_NM,
	$mail_to,
	$mail_to_nm,
	$Subject,
	$body,
	$MAIL_DEBUG,
	$MAIL_AUTH_FLAG,
	$MAIL_SECURE
	);
	
  //echo $msg;	
  
 if($msg=="1"){ 
    /*
	$sql="update yrconfirmmaster 
				set sentmail_date=sysdate 
				,sentmail_flag='1'
				,sentmail_remark='"."success"."'
				where member_no='".$MEMB_NO."' 
				and to_char(balance_date,'yyyy-mm-dd')='".$_REQUEST["slip_date"]."' ";
	//echo $sql;			
    get_single_value_oci($sql,$value1);
  	*/
	
	 $sql="insert into cmmaillog (
				pk_id,
				mailtype_code ,
				member_no ,
				memb_fullname  ,
				salary_id  ,
				addr_email ,
				mailtype_desc ,
				ref_pk ,
				sentmail_date ,
				sentmail_flag ,
				sentmail_remark ,
				entry_id ,
				entry_date 
				)values(
				to_char(systimestamp,'YYYY-MM-DD.HH24:MI:SS:FF'),
				'".$mailtype_code."' ,
				'".$MEMB_NO."' ,
				'".($MEMB_NAME." ".$MEMB_SURNAME)."'  ,
				'',
				'".$MEMBER_EMAIL."' ,
				'".$mailtype_desc."'  ,
				'".$LOANCONTRACT_NO."|".$SLIP_DATE."|".$PAYOUTNET_AMT."'  ,
				sysdate ,
				1 ,
				'success' ,
				'".$member_no."' ,
				sysdate 
				)";
	 get_single_value_oci($sql,$value1);		
     
     //echo $sql;	 
	 
	echo "<script>alert('ระบบได้ส่ง Email เรียบร้อย ".$MEMB_NO."  ไปที่ ".$MEMBER_EMAIL."');</script>";
	
 }else{
	 
	/*
	$sql="update yrconfirmmaster 
				set sentmail_date=sysdate 
				,sentmail_flag='1'
				,sentmail_remark='".$msg."'
				where member_no='".$MEMB_NO."' 
				and to_char(balance_date,'yyyy-mm-dd')='".$_REQUEST["slip_date"]."' ";				
    get_single_value_oci($sql,$value1);
	*/
	
	 $sql="insert into cmmaillog (
				pk_id,
				mailtype_code ,
				member_no ,
				memb_fullname  ,
				salary_id  ,
				addr_email ,
				mailtype_desc ,
				ref_pk ,
				sentmail_date ,
				sentmail_flag ,
				sentmail_remark ,
				entry_id ,
				entry_date 
				)values(
				to_char(systimestamp,'YYYY-MM-DD.HH24:MI:SS:FF'),
				'".$mailtype_code."' ,
				'".$MEMB_NO."' ,
				'".($MEMB_NAME." ".$MEMB_SURNAME)."'  ,
				'',
				'".$MEMBER_EMAIL."' ,
				'".$mailtype_desc."'  ,
				'".$LOANCONTRACT_NO."|".$SLIP_DATE."|".$PAYOUTNET_AMT."'  ,
				sysdate ,
				1 ,
				'".$msg."' ,
				'".$member_no."' ,
				sysdate 
				)";
	 get_single_value_oci($sql,$value1);		
	 
    echo $msg;
	
 } 
 
}



	   ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
    <form id="formID1" name="formID1" method="post" action="" >
  <tr>
    <td align="left" ><strong><font size="4" face="Tahoma">แจ้งข้อมูลการจ่ายเงินกู้ <br/> ทาง Email</font></strong></td>
    <td  align="right" valign="top">
	    <b>เลขทะเบียนสมาชิก : </b>
		<input type="text" name="memb_no" value="<?=$_REQUEST["memb_no"]?>" style="width:100px;"/>
	    <b>ประเภทเงินกู้ : </b>
		<select id="loantype_code" name="loantype_code" onchange="this.form.submit()">
		<option value="" <?=$_REQUEST["loantype_code"]==""?"selected":""?> >**:ทั้งหมด</option>
		  <?php 
				$strSQL="select * from lnloantype order by loantype_code asc ";
				//echo $strSQL;
				$value = array('LOANTYPE_CODE','LOANTYPE_DESC');
				 list($Num_Rows_,$list_info_) = get_value_many_oci($strSQL,$value); 
						
				$j=0;
				for($i=0;$i<$Num_Rows_;$i++){
					$loantype_code=$list_info_[$i][$j++];
					$loantype_desc=$list_info_[$i][$j++];
					$j=0;
					?>
			<option value="<?=$loantype_code?>" <?=$_REQUEST["loantype_code"]==$loantype_code?"selected":""?> ><?=$loantype_code?>:<?=$loantype_desc?></option>
		  <?php } ?>	
		</select>
		<div style="display:none;">
	    <b>เลขพนักงาน : </b>
		<input type="text" name="salary_id" value="<?=$_REQUEST["salary_id"]?>" style="width:100px;"/>
	    <b>Email : </b>
		<input type="text" name="addr_email" value="<?=$_REQUEST["addr_email"]?>" style="width:100px;"/>		
		</div>
    </td>
  </tr>
  <tr>
    <td align="left">
    <font color="#0000FF" size="2" face="Tahoma">Send Loan payment by Email</font></td>
	<?php 
	
	if(isset($_REQUEST["due_date_yyyy"])==false){
		$_REQUEST["due_date_yyyy"]=date('Y', strtotime(' +1 day'));
	}
	if(isset($_REQUEST["due_date_mm"])==false){
		$_REQUEST["due_date_mm"]=date('m', strtotime(' +1 day'));
	}
	if(isset($_REQUEST["due_date_d"])==false){
		$_REQUEST["due_date_d"]=$duedate;//30 วัน
	}
	$_REQUEST["due_date_yyyymmdd"]=date('Y-m-d', strtotime(' -'.$_REQUEST["due_date_d"].' day'));
	
	if(isset($_REQUEST["sentmail_flag"])==false){
		 $_REQUEST["sentmail_flag"]="0";
	}
	?>
	
    <td  align="right" valign="top">
		<b>ส่งEmail : </b>
        <select name="sentmail_flag" id="sentmail_flag"  onchange="this.form.submit()" >
            <option value="" <?=((strlen($_REQUEST["sentmail_flag"])==0)?"selected":"")?>>ทั้งหมด</option>
            <option value="0" <?=(($_REQUEST["sentmail_flag"]=="0")?"selected":"")?>>รอส่ง</option>
            <option value="1" <?=(($_REQUEST["sentmail_flag"]=="1")?"selected":"")?>>ส่งแล้ว</option>
    	</select>
	    <b>วันที่ทำจ่ายย้อนหลัง : </b>
		<input type="text" name="due_date_d" value="<?=$_REQUEST["due_date_d"]?>" style="width:30px;"/>
	    <b>วัน ย้อนไป ตั้งแต่วันที่ : </b>
		<input type="text" name="due_date_yyyymmdd" value="<?=$_REQUEST["due_date_yyyymmdd"]?>" style="width:100px;" readonly="true"/>		
		<input type="submit" id="re" name="retr" value="ดึง"/>
    </td>
  </tr>
    </form>
  <tr>
    <td colspan="2" align="left"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<br />
<?php 
//if((isset($_REQUEST["memb_no"])||isset($_REQUEST["salary_id"])||isset($_REQUEST["addr_email"]))&&isset($_REQUEST["retr"])){

?>

<?php 
if($_REQUEST["sentmail_action"]=="0"){
	
	$strSQL = "SELECT 
										 m.member_no,
										 m.salary_id,
										 m.memb_name||' '||m.memb_surname as memb_nm ,
										 to_char(m.member_date,'yyyy/mm/dd')  as member_date,
										 m.addr_email as MEMB_EMAIL,
										 ml.SENTMAIL_FLAG  as  SENTMAIL_FLAG,
										 to_char(ml.sentmail_date,'yyyy/mm/dd hh24:mi:ss')  as  SENTMAIL_DATE,
										 ml.SENTMAIL_REMARK as  SENTMAIL_REMARK,
										 ml.ref_pk as  ref_pk
										FROM 
											mbmembmaster m,cmmaillog ml 
										WHERE  ml.member_no=m.member_no and ml.mailtype_code='".$mailtype_code."' and m.member_no like '%".$_REQUEST["memb_no"]."%' 
										order by ml.SENTMAIL_DATE asc  ";
					//echo 	$strSQL;				
					$value = array('MEMBER_NO','SALARY_ID','MEMB_NM','MEMBER_DATE','MEMB_EMAIL','SENTMAIL_FLAG','SENTMAIL_DATE','SENTMAIL_REMARK','REF_PK');		
					list($Num_Rows,$slip_show) = get_value_many_oci($strSQL,$value);	
					$j=0;

?>	   
    <div class="popup-box" id="popup-box-0">
    <div class="close">X</div>
<br/>
<br/>
<br/>
	<table border="0" align="center" cellpadding="0" cellspacing="0">
	 <tr>
	 <td bgcolor="#CCCCCC">
	 <br/>
      <?php for($i=0;$i<$Num_Rows;$i++){
		  
		  
		  $member_no=$slip_show[$i][$j++];
		  $salary_id=$slip_show[$i][$j++];
		  $memb_nm=$slip_show[$i][$j++];
		  $member_date=$slip_show[$i][$j++];
		  $member_email=$slip_show[$i][$j++];
		  $sendmail_cnt=$slip_show[$i][$j++];
		  $sendmail_date=$slip_show[$i][$j++];
		  $sendmail_remark=$slip_show[$i][$j++];
		  $ref_pk=$slip_show[$i][$j++];
		  
		  if($sendmail_cnt==0){$sendmail_cnt_="#FFCC33";}
		  if($sendmail_cnt<0){$sendmail_cnt_="blue";}
		  if($sendmail_cnt>0){$sendmail_cnt_="green";}
		  
		  $j=0;
		  ?>  
		 <?php if($i==0){ ?>	 
				<table width="500" align="center" border="0" cellspacing="1" cellpadding="3">
				  <tr>
					<td align="center" bgcolor="#FFFFFF" colspan="5" ><strong><font color="#000000">ประวัติการส่ง Email <?=$mailtype_code?>: <?=$mailtype_desc?> สมาชิกทะเบียน : <?=($member_no)?></font></strong></td>
				  </tr>	
				  <tr>
					<td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">ทะเบียน</font></strong></td>
					<td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">พนักงาน</font></strong></td>
					<td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">ชื่อ-สกุล</font></strong></td>
					<td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">วันที่เป็นสมาชิก</font></strong></td>
					<td align="center" bgcolor="#FFCC33"><strong><font color="#FFFFFF">Email</font></strong></td> 	
				  </tr>
				  <tr>
					<td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($member_no)?></font></td>
					<td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($salary_id)?></font></td>
					<td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($memb_nm)?></font></td>
					<td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($member_date)?></font></td>
					<td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($member_email)?></font></td>
				  </tr> 	  
				</table>
				<table width="500"  align="center"  border="0" cellspacing="1" cellpadding="3">
				  <tr>  
					<td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">ลำดับ</font></strong></td>
					<td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">รายละเอียด</font></strong></td>
					<td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">วันที่ส่่งล่าสุด</font></strong></td>
					<td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">หมายเหตุ</font></strong></td>
				  </tr>
		  <?php } ?>	  
		  <?php if($i>=0){ ?>	
				  <tr>
					<td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($i+1)?></font></td>
					<td align="left" bgcolor="#FFFFFF"><font color="#000000"><?=str_replace("|","<br/>",$ref_pk)?></font></td>
					<td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($sendmail_date)?></font></td>
					<td align="center" bgcolor="<?=$sendmail_cnt_?>"><font color="#000000"><?=($sendmail_remark)?></font></td>
				  </tr> 
		  <?php } ?>	 
		  
		  <?php if($i>=$Num_Rows){ ?>	 
		  <?php } ?>  
      <?php } ?>  
	  
				</table>
	</td>
  </tr>
</table>
<br/>
<br/>
<br/>
</div>
<a class="popup-link-0" id="popup-link" style="display:none;">open</a><script>$('#popup-box-0').show();</script>
<?php } ?>	   
   
<?php 
if(isset($_REQUEST["sentmail_action_all"])){
	
/*	
config in include/conf.c.php 
$WEB_LINK="http://127.0.0.1/BTG/webportal/d/index.php";
$MAIL_HOST="smtp.gmail.com";
$MAIL_PORT=587;
$MAIL_USR="isocare.iscobtg@gmail.com";
$MAIL_PWD="0815501888";
$MAIL_FROM="isocare.iscobtg@gmail.com";
$MAIL_FROM_NM="สอ.เบทาโกร";
$MAIL_DEBUG=1;// 0 =disable , 1=enable
$MAIL_AUTH_FLAG=true;
$MAIL_SECURE='tls';
*/	

$SLIP_DATE=ConvertDateYmd(date("Y-m-d"),"long");

				  $strSQL_ = "SELECT * FROM (
									SELECT e.* from (
									SELECT c.*,
									(select count(*) from cmmaillog ml where ml.member_no=c.member_no and ml.mailtype_code='".$mailtype_code."' and ml.ref_pk =(c.loancontract_no||'|'||c.slip_date||'|'||replace(to_char(c.payoutnet_amt,'999,999,990.00'),' ','')||'') ) as  SENTMAIL_CNT
									FROM ( SELECT 
										 m.member_no,
										 m.salary_id,
										 m.memb_name,
										 m.memb_surname,
										 mb.membgroup_desc,
										 m.addr_email ,
											 l.loancontract_no  as loancontract_no,su.moneytype_code ,su.moneytype_desc,
											 l.loanapprove_amt,sl.payoutnet_amt,lt.loantype_desc,l.PERIOD_PAYAMT,l.PERIOD_PAYMENT,
											 to_char(case when to_number(to_char(sl.slip_date,'dd') ) >20 then  LAST_DAY(ADD_MONTHS(sl.slip_date,1)) else LAST_DAY(sl.slip_date)  end ,'yyyy-mm-dd') as STARTKEEP_DATE,
											 to_char(l.STARTKEEP_DATE,'yyyy-mm-dd')  as STARTKEEP_DATE_,
											 nvl((select sum( case when b.slipitemtype_code = 'LON' then b.principal_payamt else 0 end )  
											  from  slslippayin a join slslippayindet b on a.coop_id = b.coop_id and a.payinslip_no = b.payinslip_no 
											  where sl.slipclear_no =a.payinslip_no  and a.slip_status <> -9  and a.sliptype_code = 'CLC' 
											  ),0) as PRINCIPAL_BALANCE,
											 nvl((select sum( case when b.slipitemtype_code = 'LON' then b.interest_payamt else 0 end )  
											  from  slslippayin a join slslippayindet b on a.coop_id = b.coop_id and a.payinslip_no = b.payinslip_no 
											  where sl.slipclear_no =a.payinslip_no  and a.slip_status <> -9  and a.sliptype_code = 'CLC' 
											  ),0) as INTEREST_PAYMENT,
											 (select INTEREST_RATE from (select INTEREST_RATE,effective_date from lncfloanintratedet where loanintrate_code ='INT'||l.loantype_code order by effective_date desc) where effective_date < sysdate and rownum=1) as INTEREST_RATE,
											 to_char(sl.slip_date,'yyyy-mm-dd')  as slip_date,
											 to_char(sl.slip_date,'dd/mm/yyyy','NLS_CALENDAR=''THAI BUDDHA')  as slip_date_th
											FROM mbmembmaster m,mbucfmembgroup mb,slslippayout sl ,cmucfmoneytype su , lncontmaster l ,lnloantype lt
											WHERE  m.membgroup_code=mb.membgroup_code  
											and sl.member_no=m.member_no and sl.loancontract_no=l.loancontract_no  and su.moneytype_code=sl.moneytype_code and lt.loantype_code=l.loantype_code 
											and ( m.resign_status = 0 or m.resign_date > sysdate ) and sl.payoutnet_amt > 0 and l.contract_status = 1 
											and sl.slip_date >= trunc(sysdate -".$_REQUEST["due_date_d"]."d ) and sl.slip_date <= trunc(sysdate  ) 	
											".($_REQUEST["loantype_code"]!=""?(" and l.loantype_code = '".$_REQUEST["loantype_code"]."' "):"")."						 										
										order by m.member_no asc ) c  
										) e where e.SENTMAIL_CNT <= 0 
									   ) where  rownum <=".$MAIL_SENT_NUM." 	";
					//echo 	$strSQL_;				
					$value_ = array('MEMBER_NO','SALARY_ID','MEMB_NAME','MEMB_SURNAME','MEMBGROUP_DESC','ADDR_EMAIL','LOANCONTRACT_NO','LOANAPPROVE_AMT','PRINCIPAL_BALANCE','INTEREST_PAYMENT','PAYOUTNET_AMT','PERIOD_PAYAMT','PERIOD_PAYMENT','STARTKEEP_DATE','LOANTYPE_DESC','INTEREST_RATE','SLIP_DATE','SLIP_DATE_TH');		
					list($Num_Rows_,$mbdata) = get_value_many_oci($strSQL_,$value_);	
					$_REQUEST["sentmail_cnt"]=$_REQUEST["sentmail_cnt"]+$Num_Rows_;
					$_REQUEST["sentmail_action_auto"]=1;	
					

					for($i=0;$i<$Num_Rows_;$i++){ 	
							$MEMB_NO=$mbdata[$i][0];				
							$SALARY_ID=$mbdata[$i][1];
							$MEMB_NAME=$mbdata[$i][2];
							$MEMB_SURNAME=$mbdata[$i][3];
							$MEMBGROUP_DESC=$mbdata[$i][4];
							$MEMBER_EMAIL=$mbdata[$i][5];
							$LOANCONTRACT_NO=$mbdata[$i][6];//$_REQUEST["loancontract_no"];
							$LOANAPPROVE_AMT=number_format($mbdata[$i][7],2);//$_REQUEST["loanapprove_amt"];
							$PRINCIPAL_BALANCE=number_format($mbdata[$i][8],2);//$_REQUEST["principal_balance"];
							$INTEREST_PAYMENT=number_format($mbdata[$i][9],2);//$_REQUEST["interest_payment"];
							$PAYOUTNET_AMT=number_format($mbdata[$i][10],2);//$_REQUEST["payoutnet_amt"];
							$PERIOD_PAYAMT=$mbdata[$i][11];//$_REQUEST["period_payamt"];
							$PERIOD_PAYMENT=number_format($mbdata[$i][12],2);//$_REQUEST["period_payment"];
							$STARTKEEP_DATE=ConvertDateYmd($mbdata[$i][13],"long");//$_REQUEST["startkeep_date"];
							$LOANTYPE_DESC=$mbdata[$i][14];//$_REQUEST["loantype_desc"];
							$INTEREST_RATE=$mbdata[$i][15];//$_REQUEST["loantype_desc"];
							$SLIP_DATE=$mbdata[$i][16];
							$SLIP_DATE_=ConvertDateYmd($SLIP_DATE,"long");

							if($MAIL_TEST_MODE){
							$MEMBER_EMAIL=$MAIL_TEST_EMAIL;
							}

							$Subject=conv("แจ้งการจ่ายเงินกู้");//conv($MAIL_FROM_NM." "."หนังสือยืนยันยอดหุ้นหนี้ และเงินฝาก ณ วันที่ ".$SLIP_DATE);	
							$body=file_get_contents('../include/emailloanpay_template.html', true);
							$body=str_replace("COOP_NAME",conv($MAIL_FROM_NM),$body);
							$body=str_replace("COOP_ADDR",conv($COOP_ADDR),$body);
							$body=str_replace("SENT_DATE",conv(ConvertDate(date("d-m-Y"),"long")),$body);
							$body=str_replace("SLIP_DATE",conv($SLIP_DATE_),$body);
							$body=str_replace("MEMBER_NO",$MEMB_NO,$body);
							$body=str_replace("WEB_LINK",$WEB_LINK,$body);
							$body=str_replace("MEMB_NAME",conv($MEMB_NAME),$body);
							$body=str_replace("MEMB_SURNAME",conv($MEMB_SURNAME),$body);
							$body=str_replace("SALARY_ID",$SALARY_ID,$body);
							$body=str_replace("MEMBGROUP_DESC",conv($MEMBGROUP_DESC),$body);
							$body=str_replace("LOANTYPE_DESC",conv($LOANTYPE_DESC),$body);
							$body=str_replace("LOANCONTRACT_NO",conv($LOANCONTRACT_NO),$body);
							$body=str_replace("LOANAPPROVE_AMT",$LOANAPPROVE_AMT,$body);
							$body=str_replace("PRINCIPAL_BALANCE",$PRINCIPAL_BALANCE,$body);
							$body=str_replace("INTEREST_PAYMENT",$INTEREST_PAYMENT,$body);
							$body=str_replace("PAYOUTNET_AMT",$PAYOUTNET_AMT,$body);
							$body=str_replace("PERIOD_PAYAMT",$PERIOD_PAYAMT,$body);
							$body=str_replace("PERIOD_PAYMENT",$PERIOD_PAYMENT,$body);
							$body=str_replace("STARTKEEP_DATE",conv($STARTKEEP_DATE),$body);
							$body=str_replace("INTEREST_RATE",$INTEREST_RATE,$body);
							//$body=conv($body);
							$mail_to=array($MEMBER_EMAIL);
							$mail_to_nm=array(conv($MEMB_NAME." ".$MEMB_SURNAME));	
							//$MAIL_FROM_NM=conv($MAIL_FROM_NM);

							$msg=sendMail(
								$MAIL_HOST,
								$MAIL_PORT,
								$MAIL_USR,
								$MAIL_PWD,
								$MAIL_FROM,
								conv($MAIL_FROM_NM),
								$mail_to,
								$mail_to_nm,
								$Subject,
								$body,
								$MAIL_DEBUG,
								$MAIL_AUTH_FLAG,
								$MAIL_SECURE
								);
									
								
							  //echo $msg;	
							  
							 if($msg=="1"){ 
							    
								/*
								$sql="update yrconfirmmaster 
											set sentmail_date=sysdate 
											,sentmail_flag='1'
											,sentmail_remark='"."success"."'
											where member_no='".$MEMB_NO."' 
											and to_char(balance_date,'yyyy-mm-dd')='".$_REQUEST["slip_date"]."' ";
								//echo $sql;			
								get_single_value_oci($sql,$value1);
								*/
								
								 $sql="insert into cmmaillog (
											pk_id,
											mailtype_code ,
											member_no ,
											memb_fullname  ,
											salary_id  ,
											addr_email ,
											mailtype_desc ,
											ref_pk ,
											sentmail_date ,
											sentmail_flag ,
											sentmail_remark ,
											entry_id ,
											entry_date 
											)values(
											to_char(systimestamp,'YYYY-MM-DD.HH24:MI:SS:FF'),
											'".$mailtype_code."' ,
											'".$MEMB_NO."' ,
											'".($MEMB_NAME." ".$MEMB_SURNAME)."'  ,
											''  ,
											'".$MEMBER_EMAIL."' ,
											'".$mailtype_desc."'  ,
											'".$LOANCONTRACT_NO."|".$SLIP_DATE."|".$PAYOUTNET_AMT."'  ,
											sysdate ,
											1 ,
											'success' ,
											'".$member_no."' ,
											sysdate 
											)";
								 get_single_value_oci($sql,$value1);			
	 
							 }else{
								 
								 /*
								$sql="update yrconfirmmaster 
											set sentmail_date=sysdate 
											,sentmail_flag='1'
											,sentmail_remark='".$msg."'
											where member_no='".$MEMB_NO."' 
											and to_char(balance_date,'yyyy-mm-dd')='".$_REQUEST["slip_date"]."' ";
								//echo $sql;		
								get_single_value_oci($sql,$value1);
								*/
								
								 $sql="insert into cmmaillog (
											pk_id,
											mailtype_code ,
											member_no ,
											memb_fullname  ,
											salary_id  ,
											addr_email ,
											mailtype_desc ,
											ref_pk ,
											sentmail_date ,
											sentmail_flag ,
											sentmail_remark ,
											entry_id ,
											entry_date 
											)values(
											to_char(systimestamp,'YYYY-MM-DD.HH24:MI:SS:FF'),
											'".$mailtype_code."' ,
											'".$MEMB_NO."' ,
											'".($MEMB_NAME." ".$MEMB_SURNAME)."'  ,
											''  ,
											'".$MEMBER_EMAIL."' ,
											'".$mailtype_desc."'  ,
											'".$LOANCONTRACT_NO."|".$SLIP_DATE."|".$PAYOUTNET_AMT."'  ,
											sysdate ,
											1 ,
											'".$msg."' ,
											'".$member_no."' ,
											sysdate 
											)";
								 get_single_value_oci($sql,$value1);		
							 } 
					}		 
							 
	if($Num_Rows_>0){						 
	 $msg_= "<h3>".$_REQUEST["sentmail_date"]." ระบบอยู่ระหว่างส่ง Email  ณ วันที่ ".$_REQUEST["slip_date"]."  <br/>".date("Y-m-d h:i:s")." ส่ง Email ไปแล้ว ".$_REQUEST["sentmail_cnt"]." รายการ  </h3>";
	}else{
	 $msg_="<h3>".$_REQUEST["sentmail_date"]." ระบบได้ส่ง Email  ณ วันที่ ".$_REQUEST["slip_date"]." ทั้งหมดเรียนร้อยแล้ว  <br/>".date("Y-m-d h:i:s")." ส่ง Email ทั้งหมด ".$_REQUEST["sentmail_cnt"]." รายการ  </h3>";
	 $_REQUEST["sentmail_action_auto"]=0;	
	}
 
}
?>	   
<center><?=$msg_?></center>
<?php


					$strSQL = "select * from ( select e.* from (
									select c.*,
										 (select count(*) from cmmaillog ml where ml.member_no=c.member_no and ml.mailtype_code='".$mailtype_code."' and ml.ref_pk =(c.loancontract_no||'|'||c.slip_date||'|'||replace(to_char(c.payoutnet_amt,'999,999,990.00'),' ','')||'') ) as  SENTMAIL_CNT,
										 (select to_char(max(ml.sentmail_date),'yyyy/mm/dd hh24:mi:ss')  from cmmaillog ml where ml.member_no=c.member_no and ml.mailtype_code='".$mailtype_code."' and ml.ref_pk =(c.loancontract_no||'|'||c.slip_date||'|'||replace(to_char(c.payoutnet_amt,'999,999,990.00'),' ','')||'') ) as  SENTMAIL_DATE,
										 (select ml.SENTMAIL_REMARK from cmmaillog ml where ml.member_no=c.member_no and ml.mailtype_code='".$mailtype_code."' and ml.ref_pk =(c.loancontract_no||'|'||c.slip_date||'|'||replace(to_char(c.payoutnet_amt,'999,999,990.00'),' ','')||'') and rownum=1) as  SENTMAIL_REMARK									
									from ( SELECT 
											 m.member_no,m.salary_id,
											 m.memb_name||' '||m.memb_surname as memb_nm ,
											 to_char(m.member_date,'dd/mm/yyyy','NLS_CALENDAR=''THAI BUDDHA')  as member_date,
											 m.addr_email as MEMB_EMAIL,
											 l.loancontract_no  as loancontract_no,su.moneytype_code ,su.moneytype_desc,
											 l.loanapprove_amt,sl.payoutnet_amt,lt.loantype_desc,l.PERIOD_PAYAMT,l.PERIOD_PAYMENT,
											 to_char(case when to_number(to_char(sl.slip_date,'dd') ) >20 then  LAST_DAY(ADD_MONTHS(sl.slip_date,1)) else LAST_DAY(sl.slip_date)  end ,'yyyy-mm-dd') as STARTKEEP_DATE,
											 to_char(l.STARTKEEP_DATE,'yyyy-mm-dd')  as STARTKEEP_DATE_,
											 nvl((select sum( case when b.slipitemtype_code = 'LON' then b.principal_payamt else 0 end )  
											  from  slslippayin a join slslippayindet b on a.coop_id = b.coop_id and a.payinslip_no = b.payinslip_no 
											  where sl.slipclear_no =a.payinslip_no  and a.slip_status <> -9  and a.sliptype_code = 'CLC' 
											  ),0) as PRINCIPAL_BALANCE,
											 nvl((select sum( case when b.slipitemtype_code = 'LON' then b.interest_payamt else 0 end )  
											  from  slslippayin a join slslippayindet b on a.coop_id = b.coop_id and a.payinslip_no = b.payinslip_no 
											  where sl.slipclear_no =a.payinslip_no  and a.slip_status <> -9  and a.sliptype_code = 'CLC' 
											  ),0) as INTEREST_PAYMENT,
											 l.PRINCIPAL_BALANCE as PRINCIPAL_BALANCE_,
											(SELECT SUM(INTEREST_PAYMENT) FROM KPTEMPRECEIVEDET WHERE LOANCONTRACT_NO=L.LOANCONTRACT_NO ) as  INTEREST_PAYMENT_, 
											 ( select INTEREST_RATE from (select INTEREST_RATE,effective_date from lncfloanintratedet where loanintrate_code ='INT'||l.loantype_code order by effective_date desc) where effective_date < sysdate and rownum=1 ) as INTEREST_RATE,
											 to_char(sl.slip_date,'yyyy-mm-dd')  as slip_date,
											 to_char(sl.slip_date,'dd/mm/yyyy','NLS_CALENDAR=''THAI BUDDHA')  as slip_date_th
											FROM slslippayout sl ,cmucfmoneytype su , lncontmaster l ,mbmembmaster m,lnloantype lt
											WHERE  sl.member_no=m.member_no and sl.loancontract_no=l.loancontract_no  and su.moneytype_code=sl.moneytype_code and lt.loantype_code=l.loantype_code  
											and ( m.resign_status = 0 or m.resign_date > sysdate ) and sl.payoutnet_amt > 0 and l.contract_status = 1 
											and sl.slip_date >= trunc(sysdate -".$_REQUEST["due_date_d"]."d ) and sl.slip_date <= trunc(sysdate ) 
											".($_REQUEST["memb_no"]!=""?(" and m.member_no like '%".$_REQUEST["memb_no"]."%' "):"")."
											".($_REQUEST["salary_id"]!=""?("and m.salary_id like '%".$_REQUEST["salary_id"]."%' "):"")."
											".($_REQUEST["addr_email"]!=""?("and m.addr_email like '%".$_REQUEST["addr_email"]."%' "):"")."
											".($_REQUEST["loantype_code"]!=""?("and l.loantype_code = '".$_REQUEST["loantype_code"]."' "):"")."
										) c 	
										) e ) ".($_REQUEST["sentmail_flag"]!=""?("where ".$_REQUEST["sentmail_flag"]."=decode(SENTMAIL_CNT,0,0,1) "):"")."
										order by slip_date asc,member_no asc ,loancontract_no asc ";
					//echo 	$strSQL;	
					$value = array('MEMBER_NO','SALARY_ID','MEMB_NM','MEMBER_DATE','MEMB_EMAIL','SENTMAIL_CNT','SENTMAIL_DATE','SENTMAIL_REMARK','LOANCONTRACT_NO','LOANAPPROVE_AMT','PRINCIPAL_BALANCE','INTEREST_PAYMENT','PAYOUTNET_AMT','PERIOD_PAYAMT','PERIOD_PAYMENT','STARTKEEP_DATE','LOANTYPE_DESC','INTEREST_RATE','SLIP_DATE','SLIP_DATE_TH');		
					list($Num_Rows,$slip_show) = get_value_many_oci($strSQL,$value);	
					$j=0;

	   ?>
	
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">ลำดับ</font></strong></td>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">ทะเบียน</font></strong></td>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">พนักงาน</font></strong></td>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">ชื่อ-สกุล</font></strong></td>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">เลขที่สัญญา</font></strong></td>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">ยอดจ่าย</font></strong></td>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">วันที่จ่าย</font></strong></td>
        <td align="center" bgcolor="#FFCC33"><strong>Email</strong></td>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">จำนวนครั้งที่ส่ง</font></strong></td>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">วันที่ส่่งล่าสุด</font></strong></td>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">หมายเหตุ</font></strong></td>
        <td align="center" bgcolor="#6699FF">
		<form id="formIDA" name="formIDA" method="post" action="" onsubmit="return confirm('กรุณายืนยันทำรายการ ส่ง Email ทุกคน ใช่หรือไม่?')" >
		<input name="slip_date"  type="hidden" value="<?=$_REQUEST["slip_date"]?>"/>
		<input name="sentmail_action_all" id="sentmail_action_all"  type="hidden" value="1"/>
		<input name="sentmail_action_auto" id="sentmail_action_auto"  type="hidden" value="<?=$_REQUEST["sentmail_action_auto"]?>"/>
		<input name="sentmail_flag"  type="hidden" value="1"/>
		<input name="confirm_flag"  type="hidden" value="0"/>
		<input name="sentmail_cnt"  type="hidden" value="<?=$_REQUEST["sentmail_cnt"]?>"/>
		<input name="sentmail_date"  type="hidden" value="<?=$_REQUEST["sentmail_date"]?>"/>
		<input name="due_date_d"  type="hidden" value="<?=$_REQUEST["due_date_d"]?>"/>
		<input name="loantype_code"  type="hidden" value="<?=$_REQUEST["loantype_code"]?>"/>
		<input type="submit" id="sentmailall_btn" name="sentmailall_btn" value="ส่งMail ทั้งหมด"/>
		</form>
		</td>
        <td align="center" bgcolor="#6699FF"></td>
      </tr>
		<form id="formID_" name="formID_" method="post" action="" onsubmit="return confirm('กรุณายืนยันทำรายการ ส่ง Email ใช่หรือไม่?')" >
		<input name="salary_id"  type="hidden" value="<?=$_REQUEST["salary_id"]?>"/>
		<input name="memb_no" id="memb_no"  type="hidden" value="<?=$_REQUEST["memb_no"]?>"/>
		<input name="addr_email"  type="hidden" value="<?=$_REQUEST["addr_email"]?>"/>
		<input name="due_date_d"  type="hidden" value="<?=$_REQUEST["due_date_d"]?>"/>
		<input name="sentmail_action" id="sentmail_action"  type="hidden" value="1"/>
		<input name="loancontract_no" id="loancontract_no"  type="hidden" value=""/>
		<input name="loanapprove_amt" id="loanapprove_amt"  type="hidden" value=""/>
		<input name="principal_balance" id="principal_balance"  type="hidden" value=""/>
		<input name="interest_payment" id="interest_payment"  type="hidden" value=""/>
		<input name="payoutnet_amt" id="payoutnet_amt"  type="hidden" value=""/>
		<input name="period_payamt" id="period_payamt"  type="hidden" value=""/>
		<input name="period_payment" id="period_payment"  type="hidden" value=""/>
		<input name="startkeep_date" id="startkeep_date"  type="hidden" value=""/>
		<input name="loantype_desc" id="loantype_desc"  type="hidden" value=""/>
		<input name="interest_rate" id="interest_rate"  type="hidden" value=""/>
		<input name="slip_date" id="slip_date"  type="hidden" value=""/>
		<input name="sentmail_flag"  type="hidden" value="1"/>
		<input name="loantype_code"  type="hidden" value="<?=$_REQUEST["loantype_code"]?>"/>
		<input name="retr"  type="hidden" value="1"/>
      <?php for($i=0;$i<$Num_Rows;$i++){
		  
		  
		  $member_no=$slip_show[$i][$j++];
		  $salary_id=$slip_show[$i][$j++];
		  $memb_nm=$slip_show[$i][$j++];
		  $member_date=$slip_show[$i][$j++];
		  $member_email=$slip_show[$i][$j++];
		  $sendmail_cnt=$slip_show[$i][$j++];
		  $sendmail_date=$slip_show[$i][$j++];
		  $sendmail_remark=$slip_show[$i][$j++];
		  
		  $loancontract_no=$slip_show[$i][$j++];//$_REQUEST["loancontract_no"];
		  $loanapprove_amt=number_format($slip_show[$i][$j++],2);//$_REQUEST["loanapprove_amt"];
		  $principal_balance=number_format($slip_show[$i][$j++],2);//$_REQUEST["principal_balance"];
		  $interest_payment=number_format($slip_show[$i][$j++],2);//$_REQUEST["interest_payment"];
		  $payoutnet_amt=number_format($slip_show[$i][$j++],2);//$_REQUEST["payoutnet_amt"];
		  $period_payamt=$slip_show[$i][$j++];//$_REQUEST["period_payamt"];
		  $period_payment=number_format($slip_show[$i][$j++],2);//$_REQUEST["period_payment"];
		  $startkeep_date=ConvertDateYmd($slip_show[$i][$j++],"long");//$_REQUEST["startkeep_date"];
		  $loantype_desc=$slip_show[$i][$j++];//$_REQUEST["loantype_desc"];
		  $interest_rate=$slip_show[$i][$j++];//$_REQUEST["interest_rate"];
		  $slip_date=$slip_show[$i][$j++];//'SLIP_DATE',	
		  $slip_date_th=$slip_show[$i][$j++];//'SLIP_DATE_TH',	
		  $sendmail_cnt_=$sendmail_cnt;
		  
		  if($sendmail_cnt==0){$sendmail_cnt_="#FFCC33";}
		  if($sendmail_cnt<0){$sendmail_cnt_="blue";}
		  if($sendmail_cnt>0){$sendmail_cnt_="green";}
		  
		  $j=0;
		  ?>  
      <tr>
        <td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($i+1)?></font></td>
        <td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($member_no)?></font></td>
        <td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($salary_id)?></font></td>
        <td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($memb_nm)?></font></td>
        <td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($loancontract_no)?></font></td>
        <td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($payoutnet_amt)?></font></td>
        <td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($slip_date_th)?></font></td>
        <td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($member_email)?></font></td>
        <td align="center" bgcolor="<?=$sendmail_cnt_?>"><?=($sendmail_cnt)?></td>
        <td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($sendmail_date)?></font></td>
        <td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($sendmail_remark)?></font></td>
        <td align="center" bgcolor="#FFFFFF"><font color="#000000">	
		<input type="button" id="sentmail_btn" name="sentmail_btn" value="ส่งMail" onclick="sendMailBy('<?=($member_no)?>','<?=($loancontract_no)?>','<?=($loanapprove_amt)?>','<?=($principal_balance)?>','<?=($interest_payment)?>','<?=($payoutnet_amt)?>','<?=($period_payamt)?>','<?=($period_payment)?>','<?=($startkeep_date)?>','<?=($loantype_desc)?>','<?=($interest_rate)?>','<?=$slip_date?>')"/>
		</td>
        <td align="center" bgcolor="#FFFFFF"><font color="#000000">	
		<?php if($sendmail_cnt>0) { ?><input type="button" id="viewreport" name="viewreport" value="ประวัติ" onclick="viewReportBy('<?=($member_no)?>','<?=($loancontract_no)?>','<?=($loanapprove_amt)?>','<?=($principal_balance)?>','<?=($interest_payment)?>','<?=($payoutnet_amt)?>','<?=($period_payamt)?>','<?=($period_payment)?>','<?=($startkeep_date)?>','<?=($loantype_desc)?>','<?=($interest_rate)?>','<?=$slip_date?>')"/><?php } ?>
		</font></td>
      </tr>
      <?php } ?>   
		</form>
    </table></td>
  </tr>
</table>
<script>

    function viewReportBy(memb_no,loancontract_no,loanapprove_amt,principal_balance,interest_payment,payoutnet_amt,period_payamt,period_payment,startkeep_date,loantype_desc,interest_rate,slip_date){    
	   var msg="กรุณายืนยันทำออกรายงาน ประวัติการส่ง Email "+memb_no+" ใช่หรือไม่?";
	  if(confirm(msg)){
	    document.getElementById("memb_no").value=memb_no;
	    document.getElementById("loancontract_no").value=loancontract_no;
	    document.getElementById("loanapprove_amt").value=loanapprove_amt;
	    document.getElementById("principal_balance").value=principal_balance;
	    document.getElementById("interest_payment").value=interest_payment;
	    document.getElementById("payoutnet_amt").value=payoutnet_amt;
	    document.getElementById("period_payamt").value=period_payamt;
	    document.getElementById("period_payment").value=period_payment;
	    document.getElementById("startkeep_date").value=startkeep_date;
	    document.getElementById("loantype_desc").value=loantype_desc;
	    document.getElementById("interest_rate").value=interest_rate;
		//alert(interest_rate);
	    document.getElementById("slip_date").value=slip_date;
	    document.getElementById("sentmail_action").value="0";
	    document.getElementById("formID_").submit();
	  }
	}	

    function sendMailBy(memb_no,loancontract_no,loanapprove_amt,principal_balance,interest_payment,payoutnet_amt,period_payamt,period_payment,startkeep_date,loantype_desc,interest_rate,slip_date){    
	   var msg="กรุณายืนยันทำรายการ ส่ง Email  ให้กับ สมาชิก "+memb_no+" ใช่หรือไม่?";
	  if(confirm(msg)){
	    document.getElementById("memb_no").value=memb_no;
	    document.getElementById("loancontract_no").value=loancontract_no;
	    document.getElementById("loanapprove_amt").value=loanapprove_amt;
	    document.getElementById("principal_balance").value=principal_balance;
	    document.getElementById("interest_payment").value=interest_payment;
	    document.getElementById("payoutnet_amt").value=payoutnet_amt;
	    document.getElementById("period_payamt").value=period_payamt;
	    document.getElementById("period_payment").value=period_payment;
	    document.getElementById("startkeep_date").value=startkeep_date;
	    document.getElementById("loantype_desc").value=loantype_desc;
	    document.getElementById("interest_rate").value=interest_rate;
		
		//alert(interest_rate);
	    document.getElementById("slip_date").value=slip_date;
	    document.getElementById("formID_").submit();
	  }
	}	

	<?php
		if($_REQUEST["sentmail_action_auto"]==1){			
		?>
		<?php if($MAIL_TEST_MODE&&$MAIL_TEST_CONFIRM){?>if(confirm("กดเพื่อทำรายการต่อไป")){ <?php } ?>
			document.getElementById("formIDA").submit();	
		<?php if($MAIL_TEST_MODE&&$MAIL_TEST_CONFIRM){?>}<?php } ?>
		<?php
		}
		?>
</script>
<?php //} ?>
