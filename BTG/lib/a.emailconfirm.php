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
	
	 $mailtype_code='M03';
	 $mailtype_desc='3.ส่งเมลแจ้งหนังสือยืนยันยอดทุนเรือนหุ้น หนี้เงินกู้คงเหลือ และเงินฝาก';

	 $sql="create table cmmaillog (
				pk_id varchar2(50) not null ,
				mailtype_code varchar2(10) not null,
				member_no varchar2(10) not null,
				memb_fullname varchar2(250) ,
				salary_id varchar2(10) ,
				addr_email varchar2(150) not null,
				mailtype_desc varchar2(150),
				ref_pk varchar2(50),
				sentmail_date date,
				sentmail_flag number(1,0) default 0 not null,
				sentmail_remark varchar2(150),
				entry_id varchar2(50),
				entry_date date
				)";
	 get_single_value_oci($sql,$value1);			
	 $sql="ALTER TABLE cmmaillog ADD ( CONSTRAINT cmmaillog_PK PRIMARY KEY ( PK_ID,mailtype_code, MEMBER_NO,sentmail_date )) "; 
	 get_single_value_oci($sql,$value1);
 

	$sql="alter table yrconfirmmaster add (confirm_id varchar2(50) ,confirm_email varchar2(150) ,confirm_date date ,confirm_flag number(1,0) default 0 not null ,confirm_remark varchar2(255) )";
    get_single_value_oci($sql,$value1);
	
	$sql="alter table yrconfirmmaster add (sentmail_flag number(1,0) default 0 not null ,sentmail_date date )";
    get_single_value_oci($sql,$value1);
	
	$sql="alter table yrconfirmmaster add (sentmail_date date )";
    get_single_value_oci($sql,$value1);
	
	$sql="alter table yrconfirmmaster add (sentmail_remark varchar2(255) )";
    get_single_value_oci($sql,$value1);
	
	$sql="create index yrconfirmmaster_inx on yrconfirmmaster  (confirm_flag,balance_date,member_no)";
	get_single_value_oci($sql,$value1);
	
if(isset($_REQUEST["save"])){
	
	
	$sql="update yrconfirmmaster 
				set confirm_id='$member_no' ,confirm_email='$email',confirm_date=sysdate 
				,confirm_flag='".$_REQUEST["confirm_flag"]."',confirm_remark='".str_replace("'","^",$_REQUEST["confirm_remark"])."' 
				where member_no='$member_no' 
				and to_char(balance_date,'dd-MM-')||to_char(to_number(to_char(balance_date,'yyyy'))+543)='".$_REQUEST["slip_date"]."' ";
	//echo $sql;			
    get_single_value_oci($sql,$value1);
	
	echo "<script>alert('ระบบได้รับการบันทึกเรียบร้อย');</script>";
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

$SLIP_DATE=ConvertDateYmd($_REQUEST["slip_date"],"long");
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

if($MAIL_TEST_MODE){
$MEMBER_EMAIL=$MAIL_TEST_EMAIL;
}

$Subject=conv("หนังสือยืนยันยอดหุ้นหนี้ และ เงินฝาก");//conv($MAIL_FROM_NM." "."หนังสือยืนยันยอดหุ้นหนี้ และเงินฝาก ณ วันที่ ".$SLIP_DATE);	
$body=file_get_contents('../include/confirm_template.html', true);
$body=str_replace("COOP_NAME",conv($MAIL_FROM_NM),$body);
$body=str_replace("SENT_DATE",conv(ConvertDate(date("d-m-Y"),"long")),$body);
$body=str_replace("SLIP_DATE",conv($SLIP_DATE),$body);
$body=str_replace("MEMBER_NO",$MEMB_NO,$body);
$body=str_replace("WEB_LINK",$WEB_LINK,$body);
$body=str_replace("MEMB_NAME",conv($MEMB_NAME),$body);
$body=str_replace("MEMB_SURNAME",conv($MEMB_SURNAME),$body);
$body=str_replace("SALARY_ID",$SALARY_ID,$body);
$body=str_replace("MEMBGROUP_DESC",conv($MEMBGROUP_DESC),$body);
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
	$sql="update yrconfirmmaster 
				set sentmail_date=sysdate 
				,sentmail_flag='1'
				,sentmail_remark='"."success"."'
				where member_no='".$MEMB_NO."' 
				and to_char(balance_date,'yyyy-mm-dd')='".$_REQUEST["slip_date"]."' ";
	//echo $sql;			
    get_single_value_oci($sql,$value1);
  	
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
				'".$_REQUEST["slip_date"]."' ,
				sysdate ,
				1 ,
				'success' ,
				'".$member_no."' ,
				sysdate 
				)";
	 get_single_value_oci($sql,$value1);		
     
     //echo $sql;	 
	 
	echo "<script>alert('ระบบได้ส่ง รายการยืนยันยอด ณ วันที่ ".$_REQUEST["slip_date"]." เรียบร้อย ".$MEMB_NO."  ไปที่ ".$MEMBER_EMAIL."');</script>";
	
 }else{
	 
	$sql="update yrconfirmmaster 
				set sentmail_date=sysdate 
				,sentmail_flag='1'
				,sentmail_remark='".$msg."'
				where member_no='".$MEMB_NO."' 
				and to_char(balance_date,'yyyy-mm-dd')='".$_REQUEST["slip_date"]."' ";				
    get_single_value_oci($sql,$value1);
		
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
				'".$_REQUEST["slip_date"]."' ,
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

$SLIP_DATE=ConvertDateYmd($_REQUEST["slip_date"],"long");

				  $strSQL_ = "SELECT * FROM ( SELECT 
										 m.member_no,
										 m.salary_id,
										 m.memb_name,
										 m.memb_surname,
										 mb.membgroup_desc,
										 m.addr_email 
										FROM mbmembmaster m,mbucfmembgroup mb, yrconfirmmaster y
										where m.membgroup_code=mb.membgroup_code										
											and y.member_no=m.member_no 
											and y.sentmail_flag = 0 and ( m.resign_status = 0 or m.resign_date > y.balance_date )
											and y.balance_date =to_date('".$_REQUEST["slip_date"]."','yyyy-mm-dd')
										order by y.member_no asc ) d 
									   where  rownum <=".$MAIL_SENT_NUM." 	";
					//echo 	$strSQL_;				
					$value_ = array('MEMBER_NO','SALARY_ID','MEMB_NAME','MEMB_SURNAME','MEMBGROUP_DESC','ADDR_EMAIL');		
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

							if($MAIL_TEST_MODE){
							$MEMBER_EMAIL=$MAIL_TEST_EMAIL;
							}

							$Subject=conv("หนังสือยืนยันยอดหุ้นหนี้ และ เงินฝาก");//conv($MAIL_FROM_NM." "."หนังสือยืนยันยอดหุ้นหนี้ และเงินฝาก ณ วันที่ ".$SLIP_DATE);	
							$body=file_get_contents('../include/confirm_template.html', true);
							$body=str_replace("COOP_NAME",conv($MAIL_FROM_NM),$body);
							$body=str_replace("SENT_DATE",conv(ConvertDate(date("d-m-Y"),"long")),$body);
							$body=str_replace("SLIP_DATE",conv($SLIP_DATE),$body);
							$body=str_replace("MEMBER_NO",$MEMB_NO,$body);
							$body=str_replace("WEB_LINK",$WEB_LINK,$body);
							$body=str_replace("MEMB_NAME",conv($MEMB_NAME),$body);
							$body=str_replace("MEMB_SURNAME",conv($MEMB_SURNAME),$body);
							$body=str_replace("SALARY_ID",$SALARY_ID,$body);
							$body=str_replace("MEMBGROUP_DESC",conv($MEMBGROUP_DESC),$body);
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
								$sql="update yrconfirmmaster 
											set sentmail_date=sysdate 
											,sentmail_flag='1'
											,sentmail_remark='"."success"."'
											where member_no='".$MEMB_NO."' 
											and to_char(balance_date,'yyyy-mm-dd')='".$_REQUEST["slip_date"]."' ";
								//echo $sql;			
								get_single_value_oci($sql,$value1);
								
								
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
											'".$_REQUEST["slip_date"]."' ,
											sysdate ,
											1 ,
											'success' ,
											'".$member_no."' ,
											sysdate 
											)";
								 get_single_value_oci($sql,$value1);			
	 
							 }else{
								 
								$sql="update yrconfirmmaster 
											set sentmail_date=sysdate 
											,sentmail_flag='1'
											,sentmail_remark='".$msg."'
											where member_no='".$MEMB_NO."' 
											and to_char(balance_date,'yyyy-mm-dd')='".$_REQUEST["slip_date"]."' ";
								//echo $sql;		
								get_single_value_oci($sql,$value1);
								
								
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
											'".$_REQUEST["slip_date"]."' ,
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
	 $msg_= "<h3>".$_REQUEST["sentmail_date"]." ระบบอยู่ระหว่างส่ง Email รายการยืนยันยอด ณ วันที่ ".$_REQUEST["slip_date"]."  <br/>".date("Y-m-d h:i:s")." ส่ง Email ไปแล้ว ".$_REQUEST["sentmail_cnt"]." รายการ  </h3>";
	}else{
	 $msg_="<h3>".$_REQUEST["sentmail_date"]." ระบบได้ส่ง Email รายการยืนยันยอด ณ วันที่ ".$_REQUEST["slip_date"]." ทั้งหมดเรียนร้อยแล้ว  <br/>".date("Y-m-d h:i:s")." ส่ง Email ทั้งหมด ".$_REQUEST["sentmail_cnt"]." รายการ  </h3>";
	 $_REQUEST["sentmail_action_auto"]=0;	
	}
 
}


					$strSQL = "SELECT 
										 distinct balance_date,
									      to_char(balance_date,'yyyy-mm-dd') as balance_date_str
										FROM 
											yrconfirmmaster 
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
					
					if(isset($_REQUEST["confirm_flag"])==false)
					       $_REQUEST["confirm_flag"]=0;	
					   
					if(isset($_REQUEST["sentmail_flag"])==false)
					       $_REQUEST["sentmail_flag"]=0;	
					   
					if(isset($_REQUEST["sentmail_action_auto"])==false)
					       $_REQUEST["sentmail_action_auto"]=0;	
					   
					if(isset($_REQUEST["sentmail_cnt"])==false)
					       $_REQUEST["sentmail_cnt"]=0;	
					   
					if(isset($_REQUEST["sentmail_date"])==false)
					       $_REQUEST["sentmail_date"]=date("Y-m-d h:i:s");	
	   ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left"><strong><font size="4" face="Tahoma">รายการยืนยันยอด <br/>ณ <?=ConvertDateYmd($_REQUEST["slip_date"],"long")?></font></strong><br />
    <font color="#0000FF" size="2" face="Tahoma">Monthly Payment</font></td>
    <td  align="right" valign="top">
    <form id="formID1" name="formID1" method="post" action="" >
	    <b>เลขทะเบียนสมาชิก : </b>
		<input type="text" name="memb_no" value="<?=$_REQUEST["memb_no"]?>" style="width:100px;"/>
		<br/>
		<b>ส่งEmail : </b>
        <select name="sentmail_flag" id="sentmail_flag"  onchange="this.form.submit()" >
            <option value="0" <?=(($_REQUEST["sentmail_flag"]==0)?"selected":"")?>>รอส่ง</option>
            <option value="1" <?=(($_REQUEST["sentmail_flag"]==1)?"selected":"")?>>ส่งสำเร็จ</option>
            <option value="-1" <?=(($_REQUEST["sentmail_flag"]==-1)?"selected":"")?>>ส่งไม่เสร็จ</option>
    	</select>
		<b>สถานะยืนยัน : </b>
        <select name="confirm_flag" id="confirm_flag"  onchange="this.form.submit()" >
            <option value="-1" <?=(($_REQUEST["confirm_flag"]==-1)?"selected":"")?>>ไม่ยืนยัน</option>
            <option value="0" <?=(($_REQUEST["confirm_flag"]==0)?"selected":"")?>>รอยืนยัน</option>
            <option value="1" <?=(($_REQUEST["confirm_flag"]==1)?"selected":"")?>>ยืนยัน</option>
    	</select>
		<b>ณ วันที่ : </b>
        <select name="slip_date" id="slip_date"  onchange="this.form.submit()" >
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
		<input type="submit" id="re" name="retr" value="ดึง"/>
    </form>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="left"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<br />
<center><?=$msg_?></center>

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
										 ml.SENTMAIL_REMARK as  SENTMAIL_REMARK
										FROM 
											mbmembmaster m,cmmaillog ml 
										WHERE  ml.member_no=m.member_no and ml.mailtype_code='".$mailtype_code."' and m.member_no like '%".$_REQUEST["memb_no"]."%' 
										order by ml.SENTMAIL_DATE asc  ";
					//echo 	$strSQL;				
					$value = array('MEMBER_NO','SALARY_ID','MEMB_NM','MEMBER_DATE','MEMB_EMAIL','SENTMAIL_FLAG','SENTMAIL_DATE','SENTMAIL_REMARK');		
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
					<td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">วันที่ส่่งล่าสุด</font></strong></td>
					<td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">หมายเหตุ</font></strong></td>
				  </tr>
		  <?php } ?>	  
		  <?php if($i>=0){ ?>	
				  <tr>
					<td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($i+1)?></font></td>
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
if(isset($_REQUEST["slip_date"])&&$_REQUEST["slip_date"]!=""){

?>
<?php
					$strSQL = "SELECT 
										 y.balance_date,
										 y.CONFIRM_FLAG,
										 y.SENTMAIL_FLAG,
										 y.SENTMAIL_DATE,
										 y.SENTMAIL_REMARK,
										 y.CONFIRM_REMARK,
										 y.CONFIRM_DATE,
										 nvl(y.CONFIRM_EMAIL,m.addr_email) as CONFIRM_EMAIL,
										 y.CONFIRM_ID,
										 m.member_no,
										 m.salary_id,
										 m.memb_name||' '||m.memb_surname as memb_nm 
										FROM 
											yrconfirmmaster y,mbmembmaster m
										WHERE 
											y.member_no=m.member_no and ( m.resign_status = 0 or m.resign_date > y.balance_date )
											and y.member_no like '%".$_REQUEST["memb_no"]."%' 
											and y.confirm_flag = ".$_REQUEST["confirm_flag"]." 
											and y.sentmail_flag = ".$_REQUEST["sentmail_flag"]." 
											and y.balance_date =to_date('".$_REQUEST["slip_date"]."','yyyy-mm-dd')
										order by y.member_no asc  ";
					//echo 	$strSQL;				
					$value = array('CONFIRM_FLAG','CONFIRM_REMARK','CONFIRM_DATE','CONFIRM_EMAIL','CONFIRM_ID','MEMBER_NO','SALARY_ID','MEMB_NM','SENTMAIL_FLAG','SENTMAIL_DATE','SENTMAIL_REMARK');		
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
        <td align="center" bgcolor="#FFCC33"><strong>ส่ง Email</strong></td>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">วันที่ส่ง</font></strong></td>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">สถานะส่ง Email </font></strong></td>
        <td align="center" bgcolor="#FFCC33"><strong>ยืนยัน</strong></td>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">วันที่</font></strong></td>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">หมายเหตุ</font></strong></td>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">Email</font></strong></td>
        <td align="center" bgcolor="#6699FF">
		<form id="formIDA" name="formIDA" method="post" action="" onsubmit="return confirm('กรุณายืนยันทำรายการ ส่ง Email ยืนยันยอด  ณ วันที่ <?=$_REQUEST["slip_date"]?> ทุกคน ใช่หรือไม่?')" >
		<input name="slip_date"  type="hidden" value="<?=$_REQUEST["slip_date"]?>"/>
		<input name="sentmail_action_all" id="sentmail_action_all"  type="hidden" value="1"/>
		<input name="sentmail_action_auto" id="sentmail_action_auto"  type="hidden" value="<?=$_REQUEST["sentmail_action_auto"]?>"/>
		<input name="sentmail_flag"  type="hidden" value="1"/>
		<input name="confirm_flag"  type="hidden" value="0"/>
		<input name="sentmail_cnt"  type="hidden" value="<?=$_REQUEST["sentmail_cnt"]?>"/>
		<input name="sentmail_date"  type="hidden" value="<?=$_REQUEST["sentmail_date"]?>"/>
		<input type="submit" id="sentmailall_btn" name="sentmailall_btn" value="ส่งMail ทั้งหมด"/>
		</form></td>
        <td align="center" bgcolor="#6699FF"></td>
      </tr>
		<form id="formID_" name="formID_" method="post" action="" onsubmit="return confirm('กรุณายืนยันทำรายการ ส่ง Email ยืนยันยอด ณ วันที่ <?=$_REQUEST["slip_date"]?> ให้กับ สมาชิก <?=($member_no)?> ใช่หรือไม่?')" >
		<input name="slip_date"  type="hidden" value="<?=$_REQUEST["slip_date"]?>"/>
		<input name="memb_no" id="memb_no"  type="hidden" value="<?=$_REQUEST["memb_no"]?>"/>
		<input name="sentmail_action" id="sentmail_action"  type="hidden" value="1"/>
		<input name="sentmail_flag"  type="hidden" value="1"/>
		<input name="confirm_flag"  type="hidden" value="0"/>
      <?php for($i=0;$i<$Num_Rows;$i++){
		  
		  $confirm_flag=$slip_show[$i][$j++];
		  $confirm_flag_=$confirm_flag;
		  
		  if($confirm_flag==0){$confirm_flag="-";$confirm_flag_="#FFCC33";}
		  if($confirm_flag==-1){$confirm_flag="X";$confirm_flag_="blue";}
		  if($confirm_flag==1){$confirm_flag="/";$confirm_flag_="green";}
		  
		  $confirm_remark=$slip_show[$i][$j++];
		  $confirm_date=$slip_show[$i][$j++];
		  $confirm_email=$slip_show[$i][$j++];
		  $confirm_id=$slip_show[$i][$j++];
		  $member_no=$slip_show[$i][$j++];
		  $salary_id=$slip_show[$i][$j++];
		  $memb_nm=$slip_show[$i][$j++];
		  
		  $sentmail_flag=$slip_show[$i][$j++];
		  $sentmail_flag_=$sentmail_flag;
		  
		  if($sentmail_flag==0){$sentmail_flag="-";$sentmail_flag_="#FFCC33";}
		  if($sentmail_flag==-1){$sentmail_flag="X";$sentmail_flag_="blue";}
		  if($sentmail_flag==1){$sentmail_flag="/";$sentmail_flag_="green";}
		  
		  $sentmail_date=$slip_show[$i][$j++];
		  $sentmail_remark=$slip_show[$i][$j++];
		  
		  $j=0;
		  ?>  
      <tr>
        <td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($i+1)?></font></td>
        <td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($member_no)?></font></td>
        <td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($salary_id)?></font></td>
        <td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($memb_nm)?></font></td>
        <td align="center" bgcolor="<?=$sentmail_flag_?>"><?=($sentmail_flag)?></td>
        <td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($sentmail_date)?></font></td>
        <td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($sentmail_remark)?></font></td>
        <td align="center" bgcolor="<?=$confirm_flag_?>"><?=($confirm_flag)?></td>
        <td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($confirm_date)?></font></td>
        <td align="center" bgcolor="#FFFFFF"><font color="#000000"><?=($confirm_remark)?></font></td>
        <td align="center" bgcolor="#FFFFFF"><font color="#000000"><a href="mailto:<?=($confirm_email)?>"><?=($confirm_email)?></a></font></td>
        <td align="center" bgcolor="#FFFFFF"><font color="#000000">	
		<input type="button" id="sentmail_btn" name="sentmail_btn" value="ส่งMail" onclick="sendMailBy('<?=($member_no)?>')"/>
		</font></td>
        <td align="center" bgcolor="#FFFFFF"><font color="#000000">	
		<?php if($sentmail_flag=="/") { ?><input type="button" id="viewreport" name="viewreport" value="ประวัติ" onclick="viewReportBy('<?=($member_no)?>')"/><?php } ?>
		</font></td>
      </tr>
      <?php } ?>   
		</form>
    </table></td>
  </tr>
</table>
<script>
    function viewReportBy(memb_no){    
	   var msg="กรุณายืนยันทำออกรายงาน ประวัติการส่ง Email "+memb_no+" ใช่หรือไม่?";
	  if(confirm(msg)){
	    document.getElementById("memb_no").value=memb_no;
	    document.getElementById("sentmail_action").value="0";
	    document.getElementById("formID_").submit();
	  }
	}	

    function sendMailBy(memb_no){    
	   var msg="กรุณายืนยันทำรายการ ส่ง Email ยืนยันยอด ณ วันที่ <?=$_REQUEST["slip_date"]?> ให้กับ สมาชิก "+memb_no+" ใช่หรือไม่?";
	  if(confirm(msg)){
	    document.getElementById("memb_no").value=memb_no;
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
<?php } ?>
