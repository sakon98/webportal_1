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
		    $("#startpay_date").datepicker({ dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay, dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
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
		
	$LOANTYPE_CODE=array("'10','20','21'"); //Fix เฉพาะ เงินกู้ ฉ เท่านั้น
	$PROVINCE_CODE=array("'010'"); //Fix จ. กทม.
	$LOANTYPE_DESC="ฉุกเฉิน"; //Fix เฉพาะ เงินกู้ ฉ เท่านั้น
	$LOAN_CONDITION=1; // 1 เท่าของเงินเดือน
	$COLL_CON_LIMIT=2;// ค้ำได้กี่สัญญา 
	
	
	$LOAN_CONDITION_SARARY=array("10"=>1,"20"=>10,"21"=>10); // 1 เท่าของเงินเดือน
	$LOAN_CONDITION_PERIOD_MIN=array("10"=>6,"20"=>12,"21"=>12); // 1 เท่าของเงินเดือน
	$LOAN_CONDITION_PERIOD_MAX=array("10"=>6,"20"=>60,"21"=>60); // 1 เท่าของเงินเดือน
	$LOAN_CONDITION_MAX_AMT=array("10"=>1000000,"20"=>1000000,"21"=>1000000); // 1 เท่าของเงินเดือน
	
	  if(isset($_REQUEST["startpay_date"])==false||$_REQUEST["loanrequest_status"]=="0"){
		  $_REQUEST["startpay_date"]=date("d/m/").(date("Y")+543);
	  }
	  
	  $sqlX="select 
						to_char(case when to_number(to_char(sl.slip_date,'dd') ) >=20 then  
										LAST_DAY(ADD_MONTHS(sl.slip_date,1)) 
									else LAST_DAY(sl.slip_date)  end ,'dd/mm/yyyy'
									, 'NLS_CALENDAR=''THAI BUDDHA'' NLS_DATE_LANGUAGE=THAI'
								 ) as STARTKEEP_DATE
					from (select to_date('".$_REQUEST["startpay_date"]."','dd/mm/yyyy','NLS_CALENDAR=''THAI BUDDHA'' NLS_DATE_LANGUAGE=THAI') as slip_date from dual ) sl ";
	  $value = array('STARTKEEP_DATE');
      list($Num_RowsX,$list_infoX) = get_value_many_oci($sqlX,$value); 
	  $_REQUEST["startpay_date"]=$list_infoX[0][0];
	  
      /*
	--  table mdbreqloan
	--  =======================	 
	CREATE TABLE IF NOT EXISTS mdbreqloan (	  	  
      loanreq_docno	varchar(20) NOT NULL ,
	  --เลขที่ใบคำขอ
	  loantype_code	 varchar(2) default '10' not null,
	  --ประเภทเงินกู้
	  member_no	varchar(10) NOT NULL ,
	  --เลขทะเบียนสมาชิก
	  entry_date	datetime   not null,
	  --วันที่บันทึก
	  update_date	datetime  not null,
	  --วันที่ปรับปรุง
      position_desc	varchar(150) ,
	  --ตำแหน่ง
	  membgroup_desc	varchar(150) ,
	  --สังกัด
	  workplace	varchar(150) ,
	  --โรงเรียน
	  amphur_desc varchar(150) ,
	  --อำเภอ
	  province_desc	varchar(150) ,
	  --จังหวัด
	  salary_amt	decimal(10,2)  default 0 not null ,
	  --เงินเดือน
	  loan_rate	decimal(10,2)  default 0 not null ,
	  --อัตราดอกเบี้ย
	  objective_desc	varchar(150) ,
	  --วัตถุประสงค์ 
	  loanreqmax_amt	decimal(15,2) default 0 not null,
	  --วงเงินกู้สุงสุด = เงินเดือน*ค่าคงที่ 
	  loanrequest_amt	decimal(15,2) default 0 not null,
	  --วงเงินขอกู้	  //เปลี่ยนได้ไม่เกิน loanreqmax_amt
	  loanpayment_type decimal(1,0)  default 1 not null,
	  --สถานะ 1 คงต้น 2 คงยอด
	  period_max	 decimal(3,0)  default 1 not null,
	  --จำนวนงวดสูงสุด	    
	  period		 decimal(3,0)  default 1 not null,
	  --จำนวนงวด	  //เปลี่ยนได้ไม่เกิน period_max
	  period_payment	decimal(15,2) default 0 not null,
	  --ชำระต่องวด  *** ต้องมีสูตร การคิด ทั้งแบบ คงยอด และ คงต้น ***** เกิดจาก loanrequest_amt และ period และ loan_rate
	  startpay_date	datetime  not null,
	  --เริ่มส่งคืนวันที่ 
	  loanrequest_status decimal(1,0)  default 0 not null,
	  --สถานะ  0 รอยืนยัน ,8 ลงรับรอยืนยัน , -1 ยกเลิก  , 1  ทำสัญญาเรียบร้อย 	 
	  --สมาชิก บันทึกมาเป็น 0 ถ้าเป็น 8 แล้วแก้ไม่ได้ 	  
	  --ส่วนจากนี้สำหรับ เจ้าหน้าที่ administrator ปรับปรุงเรียกดู 
      remark	varchar(150) ,
	  --หมายเหตุ	
	  noticedoc_no varchar(20) ,
	  --เลขลงรับ
	  noticedoc_date datetime ,
	  --วันที่ลงรับ
	  loanrequestdoc_no varchar(20) ,
	  --เลขใบคำขอในระบบ
	  loancontract_no varchar(20) ,
	  --เลขที่สัญญา
	   PRIMARY KEY (loanreq_docno,loantype_code,member_no)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

	*/
	 $strSQL="CREATE TABLE if not exists `mdbreqloan` (
					  `loanreq_docno` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
					  `loantype_code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '10',
					  `member_no` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
					  `phone_no` varchar(20) COLLATE utf8mb4_unicode_ci  NULL,
					  `email` varchar(50) COLLATE utf8mb4_unicode_ci  NULL,
					  `entry_date` datetime NOT NULL,
					  `update_date` datetime NOT NULL,
					  `position_desc` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
					  `membgroup_desc` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
					  `workplace` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
					  `amphur_desc` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
					  `province_desc` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
					  `salary_amt` decimal(10,2) NOT NULL DEFAULT '0.00',
					  `loan_rate` decimal(10,2) NOT NULL DEFAULT '0.00',
					  `objective_desc` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
					  `loanreqmax_amt` decimal(15,2) NOT NULL DEFAULT '0.00',
					  `loanrequest_amt` decimal(15,2) NOT NULL DEFAULT '0.00',
					  `loanpayment_type` decimal(1,0) NOT NULL DEFAULT '1',
					  `period_max` decimal(3,0) NOT NULL DEFAULT '1',
					  `period` decimal(3,0) NOT NULL DEFAULT '1',
					  `period_payment` decimal(15,2) NOT NULL DEFAULT '0.00',
					  `startpay_date` datetime NOT NULL,
					  `loanrequest_status` decimal(1,0) NOT NULL DEFAULT '0',
					  `remark` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
					  `noticedoc_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
					  `noticedoc_date` datetime DEFAULT NULL,
					  `loanrequestdoc_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
					  `loancontract_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
					    ,PRIMARY KEY (loanreq_docno,loantype_code,member_no)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
	 mysql_query($strSQL) ;
	 
	 $strSQL="alter table mdbreqloan add phone_no varchar(20) ";
	 mysql_query($strSQL) ;
	 $strSQL="alter table mdbreqloan add email varchar(50)  ";
	 mysql_query($strSQL) ;
	 $strSQL="alter table mdbreqloan add salary_id varchar(50)  ";
	 mysql_query($strSQL) ;
	 $strSQL="alter table mdbreqloan add (expense_bank varchar(50) ,expense_bankbranch varchar(50) ,expense_banktype varchar(50),expense_accid varchar(20) )  ";
	 mysql_query($strSQL) ;
	 $strSQL="alter table mdbreqloan add (phonework_no  varchar(50),member_age varchar(5) )";
	 mysql_query($strSQL) ;
	 
	/*
	--  table mdbreqloanfiles
	--   ======================= 
	CREATE TABLE IF NOT EXISTS mdbreqloanfiles (	 
      loanreq_docno	 varchar(20) not null,
	  --เลขที่ใบคำขอ
	  loantype_code  varchar(2) not null,
	  --ประเภทเงินกู้
	  member_no  varchar(10) not null,
	  --เลขทะเบียนสมาชิก
	  seq_no  decimal(10,0) not null,
	  --ลำดับ
	  reqfiletype_code  varchar(4) not null,
	  --ประเภทเอกสาร  
	  filename varchar(150) not null,
	  --ชื่อแฟ้มเอกสาร
	   PRIMARY KEY (loanreq_docno,loantype_code,member_no,seq_no)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
	  
	  */
	  
	$strSQL="
	CREATE TABLE if not exists `mdbreqloanfiles` (
	  `loanreq_docno` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `loantype_code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `member_no` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `seq_no` decimal(10,0) NOT NULL,
	  `reqfiletype_code` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `filename` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
	   ,PRIMARY KEY (loanreq_docno,loantype_code,member_no,seq_no)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
	 mysql_query($strSQL) ;
	 
	  /*
	--  table mdbucfreqfiles 
	--   =======================
	CREATE TABLE IF NOT EXISTS mdbucfreqfiles (	
      reqfiletype_code  varchar(4) not null,
	  --รหัสประเภทเอกสาร
	  reqfiletype_desc  varchar(150) not null,
	  --ประเภทเอกสาร	 
	  loantype_code   varchar(2) not null,
	  --ประเภทเงินกู้
	   PRIMARY KEY (reqfiletype_code,loantype_code)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
	  
	  */
	$strSQL="	  
	CREATE TABLE if not exists `mdbucfreqfiles` (
	  `reqfiletype_code` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `reqfiletype_desc` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `loantype_code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL
	   ,PRIMARY KEY (reqfiletype_code,loantype_code)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
	 mysql_query($strSQL) ;
	$strSQL="INSERT INTO `mdbucfreqfiles` (`reqfiletype_code`, `reqfiletype_desc`, `loantype_code`) VALUES
	('1001', '1.สำเนาหน้าบัญชีธนาคาร เห็นเลขที่บัญชีชัดเจน (เซ็นรับรองสำเนาถูกต้อง)<br/>', '10'),
	('1002', '2.สำเนาบัตรประชาชน (เซ็นรับรองสำเนาถูกต้อง)<br/>', '10'),
	('1003', '3.สำเนาทะเบียนบ้าน (เซ็นรับรองสำเนาถูกต้อง)<br/>', '10'),
	('1004', '4.สำเนาสลิปเงินเดือนล่าสุด (เซ็นรับรองสำเนาถูกต้อง)<br/>', '10'),
	('2001', '1.สำเนาบัตรประชาชน / ทะเบียนบ้าน / ทะเบียนสมรส  ผู้กู้และคู่สมรส  (เซ็นรับรองสำเนาถูกต้อง)<br/>', '20'),
	('2002', '2.สำเนาบัตรประชาชน / ทะเบียนบ้าน / ทะเบียนสมรส  ผู้ค้ำประกันและคู่สมรส(เซ็นรับรองสำเนาถูกต้อง)<br/>', '20'),
	('2003', '3.สำเนาสลิปเงินเดือนล่าสุด  ผู้กู้และผู้ค้ำประกันทั้ง 2 คน (เซ็นรับรองสำเนาถูกต้อง)<br/>', '20'),
	('2004', '4.สำเนาหน้าบัญชีธนาคาร เห็นเลขที่บัญชีชัดเจน (เซ็นรับรองสำเนาถูกต้อง)<br/>', '20'),
	('2101', '1.สำเนาบัตรประจำตัวประชาชน (เซ็นรับรองสำเนาถูกต้อง)<br/>', '21'),
	('2102', '2.สำเนาทะเบียนบ้าน (เซ็นรับรองสำเนาถูกต้อง)<br/>', '21'),
	('2103', '3.สำเนาหน้าบัญชีธนาคาร (เซ็นรับรองสำเนาถูกต้อง)<br/>', '21'),
	('2104', '4.สำเนาสลิปเงินเดือนล่าสุด<br/>', '21')
	";
	 mysql_query($strSQL) ;
	  /*
	--หา เลขที่ใบคำขอล่าสุด
	select CAST(ifnull(max(loanreq_docno),(concat(DATE_FORMAT(now(), "%Y")+543,"000001")))  as  DECIMAL(10,0) )  as maxloanreq_docno
    from mdbreqloan where DATE_FORMAT(entry_date, "%Y%")=DATE_FORMAT(now(), "%Y%")
	;  
	 
	  
	  */

$target_dir = "uploads/".$member_no."/".$_REQUEST["loanreq_docno"]."/";
		
    if($_REQUEST["cancelBtn"]!=""){		  
	
		  $strSQL="delete from mdbreqloanfiles where loanreq_docno='".$_REQUEST["loanreq_docno"]."' "; 	 
		  $result = mysql_query($strSQL);
		  
		  $strSQL="delete from  mdbreqloan where loanreq_docno='".$_REQUEST["loanreq_docno"]."'";		 
		  $result = mysql_query($strSQL);
		  
								 
		  if($result==1){
			echo "<script>alert('บันทึกสำเร็จ');</script>";
			unset($_REQUEST);
		   $_REQUEST["save_mode"]="insert";
		  }else{ 	
			echo "<script>alert('บันทึกไม่สำเร็จ');</script>";
		  }
		  //echo $_REQUEST["save_mode"].":".$strSQL;
	}

    if($_REQUEST["saveBtn"]!=""){
      
	  if($_REQUEST["save_mode"]=="insert"){
		  
		  $startpay_date_=explode("/",$_REQUEST["startpay_date"]);
		  settype($startpay_date_[2],"integer");
		  //print_r($startpay_date_);
		  $startpay_date=($startpay_date_[2]-543)."-".$startpay_date_[1]."-".$startpay_date_[0];
		 
		 //ป้องกันเลขซ้ำดึงเลขมาอีกรอบ
		    $strSQL="select CAST(ifnull(max(loanreq_docno)+1,concat('".$_REQUEST["loantype_code"]."',(concat(DATE_FORMAT(now(), '%Y')+543,'0001'))))  as  DECIMAL(10,0) )  as maxloanreq_docno from mdbreqloan where loanreq_docno like '".$_REQUEST["loantype_code"]."%' and DATE_FORMAT(entry_date, '%Y%')=DATE_FORMAT(now(), '%Y%')";
			//echo $_REQUEST["loanreq_docno"]."|".($_REQUEST["loantype_code"].(date("Y")+543))."|".strpos($_REQUEST["loanreq_docno"],($_REQUEST["loantype_code"].(date("Y")+543)));
			$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
			$q = mysql_fetch_array($objQuery);
			$_REQUEST["loanreq_docno"]=$q["maxloanreq_docno"];
			
		  $strSQL="insert into `mdbreqloan` (
						  loanreq_docno,
						  loantype_code,
						  member_no,
						  member_age,
						  phone_no,
						  phonework_no,
						  email,
						  entry_date ,
						  update_date,
						  position_desc ,
						  membgroup_desc ,
						  workplace ,
						  amphur_desc,
						  province_desc,
						  salary_amt ,
						  loan_rate ,
						  objective_desc ,
						  loanreqmax_amt ,
						  loanrequest_amt,
						  loanpayment_type ,
						  period_max ,
						  period,
						  period_payment ,
						  startpay_date ,
						  loanrequest_status,
						  remark ,
						 expense_bank,
						 expense_bankbranch,
						 expense_banktype,
						 expense_accid ,
						 salary_id
						)values(
						  '".$_REQUEST["loanreq_docno"]."',
						  '".$_REQUEST["loantype_code"]."',
						  '".$_REQUEST["member_no"]."',
						  '".$_REQUEST["member_age"]."',
						  '".$_REQUEST["phone_no"]."',
						  '".$_REQUEST["phonework_no"]."',
						  '".$_REQUEST["email"]."',
						  '".$_REQUEST["entry_date"]."' ,
						  '".$_REQUEST["update_date"]."',
						  '".$_REQUEST["position_desc"]."' ,
						  '".$_REQUEST["membgroup_desc"]."' ,
						  '".$_REQUEST["workplace"]."' ,
						  '".$_REQUEST["amphur_desc"]."',
						  '".$_REQUEST["province_desc"]."',
						  '".$_REQUEST["salary_amt"]."' ,
						  '".$_REQUEST["loan_rate"]."' ,
						  '".$_REQUEST["objective_desc"]."' ,
						  '".$_REQUEST["loanreqmax_amt"]."' ,
						  '".$_REQUEST["loanrequest_amt"]."',
						  '".$_REQUEST["loanpayment_type"]."' ,
						  '".$_REQUEST["period_max"]."' ,
						  '".$_REQUEST["period"]."',
						  '".$_REQUEST["period_payment"]."' ,
						  '".$startpay_date."' ,
						  '".$_REQUEST["loanrequest_status"]."',
						  '".$_REQUEST["remark"]."' ,
						  '".$_REQUEST["expense_bank"]."', 
						  '".$_REQUEST["expense_bankbranch"]."' ,
						  '".$_REQUEST["expense_banktype"]."' ,
						  '".$_REQUEST["expense_accid"]."',
						  '".$_REQUEST["salary_id"]."'
						)";
		  $result = mysql_query($strSQL);
		 // echo $strSQL;
		  if($result==1){
			  
						$sql="update mbmembmaster 
						         set salary_amount  ='".$_REQUEST["salary_amt"]."'
						         where member_no='".$member_no."' ";
						get_single_value_oci($sql,$value);
						
			echo "<script>alert('บันทึกสำเร็จ');</script>";
			$_REQUEST["save_mode"]="update";
		  }else{ 	
			echo "<script>alert('บันทึกไม่สำเร็จ');</script>";
		  }
		 //echo $_REQUEST["save_mode"].":".$strSQL;
	  }else if($_REQUEST["save_mode"]=="update"){
		    
		  $startpay_date_=explode("/",$_REQUEST["startpay_date"]);
		  //print_r($startpay_date_);
		  settype($startpay_date_[2],"integer");
		  $startpay_date=($startpay_date_[2]-543)."-".$startpay_date_[1]."-".$startpay_date_[0];
		  		  
		  $strSQL="update mdbreqloan set 
						  loantype_code='".$_REQUEST["loantype_code"]."',
						  member_no= '".$_REQUEST["member_no"]."',
						  member_age= '".$_REQUEST["member_age"]."',
						  phone_no= '".$_REQUEST["phone_no"]."',
						  phonework_no= '".$_REQUEST["phonework_no"]."',
						  email= '".$_REQUEST["email"]."',
						  entry_date='".$_REQUEST["entry_date"]."' ,
						  update_date=now(),
						  position_desc='".$_REQUEST["position_desc"]."' ,
						  membgroup_desc='".$_REQUEST["membgroup_desc"]."' ,
						  workplace='".$_REQUEST["workplace"]."' ,
						  amphur_desc='".$_REQUEST["amphur_desc"]."',
						  province_desc='".$_REQUEST["province_desc"]."',
						  salary_amt='".$_REQUEST["salary_amt"]."' ,
						  loan_rate='".$_REQUEST["loan_rate"]."' ,
						  objective_desc='".$_REQUEST["objective_desc"]."' ,
						  loanreqmax_amt='".$_REQUEST["loanreqmax_amt"]."' ,
						  loanrequest_amt='".$_REQUEST["loanrequest_amt"]."',
						  loanpayment_type='".$_REQUEST["loanpayment_type"]."' ,
						  period_max='".$_REQUEST["period_max"]."' ,
						  period='".$_REQUEST["period"]."',
						  period_payment='".$_REQUEST["period_payment"]."' ,
						  startpay_date='".$startpay_date."' ,
						  loanrequest_status='".$_REQUEST["loanrequest_status"]."',
						  remark='".$_REQUEST["remark"]."' ,
						 expense_bank='".$_REQUEST["expense_bank"]."', 
						 expense_bankbranch='".$_REQUEST["expense_bankbranch"]."' ,
						 expense_banktype='".$_REQUEST["expense_banktype"]."' ,
						 expense_accid='".$_REQUEST["expense_accid"]."' ,
						 salary_id='".$_REQUEST["salary_id"]."'
						where 
						  loanreq_docno='".$_REQUEST["loanreq_docno"]."'";
		 
		  $result = mysql_query($strSQL);
		  if($result==1){
			  
						$sql="update mbmembmaster 
						         set salary_amount  ='".$_REQUEST["salary_amt"]."'
						         where member_no='".$member_no."' ";
						get_single_value_oci($sql,$value);
						
			echo "<script>alert('บันทึกสำเร็จ');</script>";
		  }else{ 	
			echo "<script>alert('บันทึกไม่สำเร็จ');</script>";
		  }
		  //echo $_REQUEST["save_mode"].":".$strSQL;
	  }
	  
	}	
				
     if($_REQUEST["action"]=="delete"){
		 if(file_exists($target_dir )==false)
					mkdir($target_dir );
					
						$sql="delete from mdbreqloanfiles 
						         where filename = '".$_REQUEST["filename"]."' 
						         and loanreq_docno='".$_REQUEST["loanreq_docno"]."'  
								 and loantype_code='".$_REQUEST["loantype_code"]."' 
								 and member_no='".$member_no."' ";
						mysql_query($sql) ;
						
					unlink($_REQUEST["filename"]);
					echo "<script>alert('ลบสำเร็จ File ".$_REQUEST["filename"]." เรียบร้อย');</script>";
	 }	
	
	  
	$strSQL_="select * from  mdbucfreqfiles u
								where u.loantype_code='".$_REQUEST["loantype_code"]."' 
								order by u.reqfiletype_code asc ";
    //echo 	$strSQL_;				
	$objQuery_ = mysql_query($strSQL_) ;
	$numrows_=mysql_num_rows($objQuery_);
	while($q = mysql_fetch_array($objQuery_)){		
	
	   $file_param_nm="file".$_REQUEST["loanreq_docno"].$q["reqfiletype_code"];
			  
			if(isset($_FILES[$file_param_nm])&&$_FILES[$file_param_nm]["size"]>0){
				
				
			$target_dir = "uploads/";
			if(!file_exists($target_dir) && !is_dir($target_dir))
			mkdir($target_dir);
			$target_dir = $target_dir.$member_no."/";
			if(!file_exists($target_dir) && !is_dir($target_dir))
			mkdir($target_dir);
			$target_dir = $target_dir.$_REQUEST["loanreq_docno"]."/";
			if(!file_exists($target_dir) && !is_dir($target_dir))
			mkdir($target_dir);
			
			$imageFileType = strtolower(pathinfo($_FILES[$file_param_nm]["name"],PATHINFO_EXTENSION));
			$target_dir = $target_dir.$q["reqfiletype_code"].".".$imageFileType;
			
			$target_file = $target_dir;
			$uploadOk = 1;
			// Check if image file is a actual image or fake image

				// Check if file already exists
				/*
				if (file_exists($target_file)) {
					echo "<script>alert('Upload ".$q["reqfiletype_desc"]." ไม่สำเร็จพบว่ามี File นี้อยู่แล้ว ".$target_file."');</script>";
					$uploadOk = 0;
				} */
				// Check file size
				if ($_FILES[$file_param_nm]["size"] > 500000) {
					echo "<script>alert('Upload ".$q["reqfiletype_desc"]." ไม่สำเร็จ File ".$_FILES[$file_param_nm]["tmp_name"]." มีขนานใหญ่เกิน 500k');</script>";
					$uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" 
				&& $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "pdf"&& $imageFileType != "xls"&& $imageFileType != "xlsx" && $imageFileType != "zip") {
					echo "<script>alert('Upload ".$q["reqfiletype_desc"]." ไม่สำเร็จ File type ไม่ถูกต้อง ".$imageFileType."');</script>";
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					//echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
					if (move_uploaded_file($_FILES[$file_param_nm]["tmp_name"], $target_file)) {
						
						$sql="insert into mdbreqloanfiles ( loanreq_docno,loantype_code,member_no,seq_no,reqfiletype_code,filename)
						         values('".$_REQUEST["loanreq_docno"]."','".$_REQUEST["loantype_code"]."','".$member_no."','".$q["reqfiletype_code"]."','".$q["reqfiletype_code"]."','".$target_file."')";
						mysql_query($sql) ;
						
						$sql="update mdbreqloanfiles 
						         set filename = '".$target_file."' 
						         where  loanreq_docno='".$_REQUEST["loanreq_docno"]."'  
								 and loantype_code='".$_REQUEST["loantype_code"]."' 
								 and member_no='".$member_no."'  
								 and seq_no='".$q["reqfiletype_code"]."' 
								 and reqfiletype_code='".$q["reqfiletype_code"]."' ";
						mysql_query($sql) ;
						
						echo "<script>alert('ระบบได้รับการบันทึก ".$q["reqfiletype_desc"]." เรียบร้อย ". basename( $_FILES[$file_param_nm]["name"]). "');</script>";
					} else {
						echo "<script>alert('ระบบได้รับการบันทึก ".$q["reqfiletype_desc"]." ไม่สำเร็จ ". basename( $_FILES[$file_param_nm]["name"]). "');</script>";
					}
				}
			}
	}
?>	
<?php 
  $strSQL="select * from mdbreqloan where member_no='$member_no' order by update_date desc";
  $objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
  $numrows=mysql_num_rows($objQuery);
  $i=0;
  if($numrows>0){
?>

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="30%" align="left"><strong><font size="4" face="Tahoma">รายการใบคำขอกู้</font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Loan Request</font></td>
    <td width="70%" align="right" valign="top">
    </td>
  </tr>
  <tr>
    <td colspan="2" align="left"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<br />
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">วันที่บันทึก</font></strong></td>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">เลขที่</font></strong></td>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">ประเภท</font></strong></td>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">วงเงิน</font></strong></td>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">งวด</font></strong></td>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">ชำระต่องวด</font></strong></td>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">ประเภทชำระ</font></strong></td>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">สถานะ</font></strong></td>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">เลขรับ</font></strong></td>
        <td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">หมายเหตุ</font></strong></td>
        <td height="25" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">-</font></strong></td>
      </tr>
      <tr>
	 <?php 
		while($q = mysql_fetch_array($objQuery)){			
			$update_date			=		$q['update_date'];
			$loantype_code			=		$q['loantype_code'];
			$loanreq_docno			=		$q['loanreq_docno'];
			$noticedoc_no			=		$q['noticedoc_no'];
			$loanrequest_amt		=		$q['loanrequest_amt'];
			$period						=		$q['period'];
			$period_payment		=		$q['period_payment'];
			$loanpayment_type		=		$q['loanpayment_type'];
			$loanrequest_status	=		$q['loanrequest_status'];
			$remark						=		$q['remark'];
			if($loanrequest_status==0){
				$loanrequest_status="รอลงรับ";
			}else if($loanrequest_status==8){
				$loanrequest_status="ลงรับ";
			}else if($loanrequest_status==1){
				$loanrequest_status="เอกสารครบถ้วน";
			}else {
				$loanrequest_status="ยกเลิก";
			}
		?>
      <tr>
        <td align="center" bgcolor="#FFFFFF"><?=$update_date?></td>
        <td align="center" bgcolor="#FFFFFF"><strong><?=$loanreq_docno?></strong></td>
        <td align="center" bgcolor="#FFFFFF"><strong><?=($loantype_code=="10"?"ฉุกเฉิน":($loantype_code=="20"?"สามัญคนค้ำ":"สามัญหุ้นค้ำ"))?></strong></td>
        <td align="center" bgcolor="#FFFFFF"><?=number_format($loanrequest_amt, 2)?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$period?></td>
        <td align="center" bgcolor="#FFFFFF"><?=number_format($period_payment,2)?></td>
        <td align="center" bgcolor="#FFFFFF"><?=($loanpayment_type==1?"คงต้น":"คงยอด")?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$loanrequest_status?></td>
        <td align="center" bgcolor="#FFFFFF"><?=$noticedoc_no?></td>
        <td align="center" bgcolor="#FFFFFF"><font color=red><?=$remark?></font></td>
        <td align="center" bgcolor="#FFFFFF" height="25" >
		<a href="?menu=LoanRequest&action=edit&loanreq_docno=<?=$loanreq_docno?>" onclick="return confirm('ยืนยันการทำรายการ')" >
		<strong>พิมพ์/แก้ไข</strong></a>
		</td>
      </tr>
		<?php } ?>
    </table></td>
  </tr>
</table>
<br>
<?php 
  }
  
  if($_REQUEST["action"]=="edit"){
  
  $strSQL="select * from mdbreqloan where loanreq_docno='".$_REQUEST["loanreq_docno"]."' order by update_date desc";
  $objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
  $numrows=mysql_num_rows($objQuery);
  $i=0;
  if($numrows>0){
	  if($q = mysql_fetch_array($objQuery)){		
	  
	  
		 $startpay_date_=explode("-",$q["startpay_date"]);
		  //print_r($startpay_date_);
		  settype($startpay_date_[0],"integer");
		  $startpay_date=explode(" ",$startpay_date_[2])[0]."/".$startpay_date_[1]."/".($startpay_date_[0]+543);
		  
		 $update_date_=explode("-",$q["update_date"]);
		  //print_r($startpay_date_);
		  settype($update_date_[0],"integer");
		  $update_date=explode(" ",$update_date_[2])[0]."/".$update_date_[1]."/".($update_date_[0]);
						 
						 $_REQUEST["noticedoc_no"]=$q["noticedoc_no"];
						 $_REQUEST["loanreq_docno"]=$q["loanreq_docno"];
						 $_REQUEST["loantype_code"]=$q["loantype_code"];
						 $_REQUEST["member_no"]=$q["member_no"];
						 $_REQUEST["phone_no"]=$q["phone_no"];
						 $_REQUEST["member_age"]=$q["member_age"];
						 $_REQUEST["phonework_no"]=$q["phonework_no"];
						 $_REQUEST["email"]=$q["email"];
						 $_REQUEST["entry_date"]=$q["entry_date"];
						 $_REQUEST["update_date"]=$q["update_date"];
						 $_REQUEST["update_date_"]=$update_date;
						 $_REQUEST["position_desc"]=$q["position_desc"];
						 $_REQUEST["membgroup_desc"]=$q["membgroup_desc"];
						 $_REQUEST["workplace"]=$q["workplace"];
						 $_REQUEST["amphur_desc"]=$q["amphur_desc"];
						 $_REQUEST["province_desc"]=$q["province_desc"];
						 $_REQUEST["salary_amt"]=$q["salary_amt"];
						 $_REQUEST["loan_rate"]=$q["loan_rate"];
						 $_REQUEST["objective_desc"]=$q["objective_desc"];
						 $_REQUEST["loanreqmax_amt"]=$q["loanreqmax_amt"];
						 $_REQUEST["loanrequest_amt"]=$q["loanrequest_amt"];
						 $_REQUEST["loanpayment_type"]=$q["loanpayment_type"];
						 $_REQUEST["period_max"]=$q["period_max"];
						 $_REQUEST["period"]=$q["period"];
						 $_REQUEST["period_payment"]=$q["period_payment"];
						 $_REQUEST["startpay_date"]=$startpay_date;
						 $_REQUEST["loanrequest_status"]=$q["loanrequest_status"];
						 $_REQUEST["remark"]=$q["remark"];
						 $_REQUEST["expense_bank"]=$q["expense_bank"];
						 $_REQUEST["expense_bankbranch"]=$q["expense_bankbranch"];
						 $_REQUEST["expense_banktype"]=$q["expense_banktype"];
						 $_REQUEST["expense_accid"]=$q["expense_accid"];
						 $_REQUEST["salary_id"]=$q["salary_id"];
						 $_REQUEST["save_mode"]="update";
						 
		
			  $strSQL="select * from mdbreqloancoll where loanreq_docno='".$_REQUEST["loanreq_docno"]."' order by seq_no asc";
			  $objQuery__ = mysql_query($strSQL) ;
			  
			  $i=1;
			  while($q = mysql_fetch_array($objQuery__)){		
 			  
			    $_REQUEST["coll".$i."mem_no"]=$q['collmemb_no'];
			    $_REQUEST["coll".$i."mem_nm"]=$q['collmemb_name'];
			    $_REQUEST["coll".$i."workplace"]=$q['collworkplace'];
			    $_REQUEST["coll".$i."position"]=$q['collposition_desc'];
			    $_REQUEST["coll".$i."havemoreflag"]=$q['collhavemore_flag'];
			    $_REQUEST["coll".$i."refmembname"]=$q['collrefmembname'];
			    $_REQUEST["coll".$i."refmembno"]=$q['collrefmembno'];
				
				$_REQUEST["Coll".$i."name"]= $_REQUEST["coll".$i."mem_nm"];
				$_REQUEST["Mem".$i."no"]= $_REQUEST["coll".$i."mem_no"];
				$_REQUEST["Work".$i."place"]= $_REQUEST["coll".$i."workplace"];
				$_REQUEST["Position".$i."desc"]= $_REQUEST["coll".$i."position"];
				$_REQUEST["Havemore".$i."coll"] = $_REQUEST["coll".$i."havemoreflag"];
				$_REQUEST["Coll".$i."refmembname"] = $_REQUEST["coll".$i."refmembname"];
				$_REQUEST["Coll".$i."refmembno"] = $_REQUEST["coll".$i."refmembno"];
				
				$i++;
			  }
		  	
	  }
  }
  
  }
?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="30%" align="left"><strong><font size="4" face="Tahoma">บันทึกใบคำขอกู้</font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Loan Request</font></td>
    <td width="70%" align="right" valign="top"><input type="button" name="newBtn" id="newBtn" value="สร้างใบคำขอใหม่" onclick="window.location='info.php?menu=LoanRequest';" /></td>
  </tr>
  <tr>
    <td colspan="2" align="left"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<br />

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#CCCCCC">
	<?php
       
	?>
    <form id="formID1" name="formID1" method="post" action="" enctype="multipart/form-data"
	    onsubmit="return formValidation()&&confirm('กรุณายืนยันการทำรายการ')" >
<?php
	 
	$strSQL="select * from lnloantype where loantype_code in (".implode(",",$LOANTYPE_CODE).")";
	//echo $strSQL;
	$value = array('LOANTYPE_CODE','LOANTYPE_DESC');
	 list($Num_Rows_,$list_info_) = get_value_many_oci($strSQL,$value); 
			
	  if(isset($_REQUEST["loantype_code"])==false){
		  $_REQUEST["loantype_code"]=$list_info_[0][0];
	  }
	  
	  if(isset($_REQUEST["save_mode"])==false){
		  $_REQUEST["save_mode"]="insert";
	  }
	  
	  
	  if($_REQUEST["save_mode"]=="insert"){
		  //ตรวจสอบว่าระหว่างบันทึกมีคนบันทึกซ้ำแล้วหรือไม่
		 $strSQL="select * from mdbreqloan where loanreq_docno='".$_REQUEST["loantype_code"].$_REQUEST["loanreq_docno"]."' ";
		 $objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
		 $q = mysql_fetch_array($objQuery);
		  if(mysql_num_rows($objQuery)>0&&$q["member_no"]!=$member_no){
			  unset($_REQUEST["loanreq_docno"]);
		  }
	  }
	  //echo ($_REQUEST["loantype_code"].date("Y")+543)."|".$_REQUEST["loanreq_docno"]."|".(strpos($_REQUEST["loanreq_docno"],($_REQUEST["loantype_code"].date("Y")+543))!==false)."|";
	  if(isset($_REQUEST["loanreq_docno"])==false||$_REQUEST["save_mode"]=="insert"){
		    $strSQL="select CAST(ifnull(max(loanreq_docno)+1,concat('".$_REQUEST["loantype_code"]."',(concat(DATE_FORMAT(now(), '%Y')+543,'0001'))))  as  DECIMAL(10,0) )  as maxloanreq_docno from mdbreqloan where loanreq_docno like '".$_REQUEST["loantype_code"]."%' and DATE_FORMAT(entry_date, '%Y%')=DATE_FORMAT(now(), '%Y%')";
			//echo $_REQUEST["loanreq_docno"]."|".($_REQUEST["loantype_code"].(date("Y")+543))."|".strpos($_REQUEST["loanreq_docno"],($_REQUEST["loantype_code"].(date("Y")+543)));
			$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
			$q = mysql_fetch_array($objQuery);
			$_REQUEST["loanreq_docno"]=$q["maxloanreq_docno"];
	  }
	  	
	  if(isset($_REQUEST["entry_date"])==false){
		  $_REQUEST["entry_date"]=date("Y-m-d h:i:s");
	  }
	
	  if(isset($_REQUEST["noticedoc_no"])==false){
		  $_REQUEST["noticedoc_no"]="";
	  }
	  
	 $_REQUEST["update_date"]=date("Y-m-d h:i:s");
	  
	  if(isset($_REQUEST["phone_no"])==false){
		  $_REQUEST["phone_no"]=$mobile;
	  }
	  
	  if(isset($_REQUEST["phonework_no"])==false){
		  $_REQUEST["phonework_no"]=$mobile;
	  }
	  
	  if(isset($_REQUEST["email"])==false){
		  $_REQUEST["email"]=$email;
	  }
	  
	  if(isset($_REQUEST["position_desc"])==false){
		  $_REQUEST["position_desc"]=$position;
	  }
	
	  if(isset($_REQUEST["member_age"])==false){
		  $_REQUEST["member_age"]=0;
	  }
	
	  if(isset($_REQUEST["membgroup_desc"])==false){
		  $_REQUEST["membgroup_desc"]=$membgroup;
	  }
	  
	  if(isset($_REQUEST["salary_amt"])==false){
		  $_REQUEST["salary_amt"]=0;//$salary;
	  }
	  
	  if(isset($_REQUEST["workplace"])==false){
		  $_REQUEST["workplace"]=$membgroup;
	  }
	  
	  if(isset($_REQUEST["salary_id"])==false){
		  $_REQUEST["salary_id"]=$salary_id;
	  }
	  
	  if(isset($_REQUEST["loanrequest_status"])==false){
		  $_REQUEST["loanrequest_status"]=0;
	  }
	  
	  //if(isset($_REQUEST["loanpayment_type"])==false){
		  $_REQUEST["loanpayment_type"]=1;
		  if($_REQUEST["loantype_code"]!="10")
			$_REQUEST["loanpayment_type"]=2;  
	  //}
	  
	  /*
	  
	  บันทึกขอกู้ประเภท 10 เท่านั้น
	  ====================================================
	  1.วงเงินสูงสุด  3 เท่า ของเงินเดือน ไม่เกิน 100,000 ส่ง 25 งวด
	  2.กรณีพบ เงินกู้ ประเภท 88 กู้  ที่ contract_status=1 ได้ 3 เท่าของเงินเดือน ไม่เกิน 50,000 ส่ง 12 งวด
	  3.บันทึกแล้ว แก้ได้ จนกว่า เจ้าหน้าที่ จะเอ้า web portal ไปใส่เลขลงรับ ถือว่า ดูได้อย่างเดียว
	  4.บังคับ ให้ Upload เอกสาร แนบ 2 ตัว  1.สลิปเงินเดือน  2.บัตรประชาชน
	  5.select count(*) as cnt from dpdeptmaster where depttype_code = '88' and deptclose_status = 0 and member_no=''; ต้องมีบัญชี
	  
	  */
	  
	  //if(isset($_REQUEST["loan_rate"])==false){
	   //$_REQUEST["loan_rate"]=0;		  
		$strSQL="select * from lncfloanintratedet where loanintrate_code ='INT". $_REQUEST["loantype_code"]."' and effective_date < sysdate order by effective_date desc";
		//echo $strSQL;
		$value = array('INTEREST_RATE');
		 list($Num_Rows_,$list_info_) = get_value_many_oci($strSQL,$value); 
		 $_REQUEST["loan_rate"]=$list_info_[0][0]/100;
	  //}
	  
	  // 1.วงเงินสูงสุด  3 เท่า ของเงินเดือน ไม่เกิน 100,000 ส่ง 25 งวด
	  //if(isset($_REQUEST["loanreqmax_amt"])==false){
		  $_REQUEST["loanreqmax_amt"]=$_REQUEST["salary_amt"]*$LOAN_CONDITION_SARARY[$_REQUEST["loantype_code"]];
		  if($_REQUEST["loanreqmax_amt"]>$LOAN_CONDITION_MAX_AMT[$_REQUEST["loantype_code"]]){
			   $_REQUEST["loanreqmax_amt"]=$LOAN_CONDITION_MAX_AMT[$_REQUEST["loantype_code"]];
		  }
	  //}
	  
	  $loanrequest_valid_flag=true;
	  $SHARE_PERIOD_MIN=6;
	  //กรณีกู้สามัญหุ้นค้ำจะคำนวณ วงเงินตามหุ้น
	  if($_REQUEST["loantype_code"]=="21"){
		$strSQL="select s.sharestk_amt*st.unitshare_value as  sharestk_amt,s.last_period from shsharemaster  s,shsharetype st where st.sharetype_code=s.sharetype_code and s.member_no ='".$member_no."' ";
		//echo $strSQL;
		$value = array('SHARESTK_AMT','LAST_PERIOD');
		 list($Num_Rows_,$list_info_) = get_value_many_oci($strSQL,$value); 
		 $_REQUEST["loanreqmax_amt"]= $list_info_[0][0];
		 $_REQUEST["share_period"]=$list_info_[0][1];
		 
		 $loanrequest_valid_flag=($_REQUEST["share_period"]>=$SHARE_PERIOD_MIN);
	  }
	  
	  //if(isset($_REQUEST["period_max"])==false){
		  $_REQUEST["period_max"]=$LOAN_CONDITION_PERIOD_MAX[$_REQUEST["loantype_code"]];
	  //}
	  	  
	  // 2.กรณีพบ เงินกู้ ประเภท 88 กู้  ที่ contract_status=1 ได้ 3 เท่าของเงินเดือน ไม่เกิน 50,000 ส่ง 12 งวด
	  /*
	  $strSQL="select count(*) as cnt from lncontmaster where loantype_code ='88' and contract_status=1 and member_no='$member_no' ";
		//echo $strSQL;
		$value = array('CNT');
		 list($Num_Rows_,$list_info_) = get_value_many_oci($strSQL,$value); 
		 if($list_info_[0][0]>0){
			  if($_REQUEST["loanreqmax_amt"]>50000){
			   $_REQUEST["loanreqmax_amt"]=50000;
			  }
			  $_REQUEST["period_max"]=12;
		 }
	  */
	  //if(isset($_REQUEST["period_max"])==false){
	  //}
	  	
	  if(isset($_REQUEST["period_payment"])==false){
		  $_REQUEST["period_payment"]=0;
	  }
	  
	  
	  if(isset($_REQUEST["period"])==false){
		  $_REQUEST["period"]=$LOAN_CONDITION_PERIOD_MIN[$_REQUEST["loantype_code"]];
	  }
	  
	  if(isset($_REQUEST["loanrequest_amt"])==false){
		  $_REQUEST["loanrequest_amt"]=$_REQUEST["loanreqmax_amt"];
	  }
	  if($_REQUEST["loanrequest_amt"]<=0||$_REQUEST["loanrequest_amt"]>$_REQUEST["loanreqmax_amt"]){
		  $_REQUEST["loanrequest_amt"]=$_REQUEST["loanreqmax_amt"];
	  }	
	  if($_REQUEST["period"]<=0||$_REQUEST["period"]>$_REQUEST["period_max"]){
		  $_REQUEST["period"]=$_REQUEST["period_max"];
	  }  

	    
	  /*

	   การคำนวนงวดชำระ 
	  ====================================================
		สามารถเลือกได้ทั้ง 2 แบบ
		1 คงต้น (เงินต้นยังไม่รวมดอกเบี้ย ณ วันสิ้นเดือน)
		   ยอดชำระรายเดือน = ยอดกู้/งวดชำระ 
		   งวดชำระ = ยอดกู้/ยอดชำระรายเดือน
			   * ไม่ต้องคำนวณดอกเบี้ยครับ เเค่บอกว่ายอดนี้ไม่รวมดอกเบี้ย

		2. คงยอด (เงินต้นรวมดอกเบี้ยส่งเท่ากันทุกเดือน)
		  ยอดชำระรายเดือน = (ยอดกู้ * (อัตราดอกเบี้ย  * 30 / 365)) / (1 - Exp(-งวดชำระ * Log(1 + (อัตราดอกเบี้ย * (30 / 365)))))
		  งวดชำระ = (ln(ยอดชำระรายเดือน/(ยอดชำระรายเดือน-(ยอดกู้*(อัตราดอกเบี้ย*(30/365)))))) / log(1+(อัตราดอกเบี้ย*(30/365)))

		การปัด
      ยอดชำระรายเดือน  = ปัดขึ้นให้เต็มหลักร้อย -> 1,240 = 1,300 บาท
      งวดชำระ = ปัดขึ้นเต็มหลักหน่วย - > 24.22 = 25 งวด
	  

      */	  
		
      $_REQUEST["period_payment"]=0;
	  $CAL_PERIOD=false;
	  if($_REQUEST["loanpayment_type"]==1){ //คงต้น
		  $_REQUEST["period_payment"]=ceil($_REQUEST["loanrequest_amt"]/$_REQUEST["period"]/100)*100; 
		  //ยอดชำระรายเดือน = ยอดกู้/งวดชำระ 
		  if($CAL_PERIOD)
		  $_REQUEST["period"]=ceil($_REQUEST["loanrequest_amt"]/$_REQUEST["period_payment"]);
		  //งวดชำระ = ยอดกู้/ยอดชำระรายเดือน
	  }else { //คงยอด
		  $_REQUEST["period_payment"]= ceil(($_REQUEST["loanrequest_amt"] * ($_REQUEST["loan_rate"]  * 30 / 365)) / (1 - exp(-$_REQUEST["period"] * log(1 + ($_REQUEST["loan_rate"] * (30 / 365))))) /100)*100;
		  // (ยอดกู้ * (อัตราดอกเบี้ย  * 30 / 365)) / (1 - Exp(-งวดชำระ * Log(1 + (อัตราดอกเบี้ย * (30 / 365)))))
		  if($CAL_PERIOD)
		  $_REQUEST["period"]=ceil((log($_REQUEST["period_payment"]/($_REQUEST["period_payment"]-($_REQUEST["loanrequest_amt"]*($_REQUEST["loan_rate"] *(30/365)))))) / log(1+($_REQUEST["loan_rate"] *(30/365))));
		  // งวดชำระ = (ln(ยอดชำระรายเดือน/(ยอดชำระรายเดือน-(ยอดกู้*(อัตราดอกเบี้ย*(30/365)))))) / log(1+(อัตราดอกเบี้ย*(30/365)))
	  }
	  	  
	  if($_REQUEST["period"]<=0||$_REQUEST["period"]>$_REQUEST["period_max"]){
		  $_REQUEST["period"]=$_REQUEST["period_max"];
	  }  
	  
	  
	  //ที่กาญจน์ ตรวจเงื่อนไข ต้องมีบัญชี เงินฝาก 88 
	  $_REQUEST["deptaccount_flag"]=true;
	  //ต้อง ByPass ส่วนนนี้
      //$_REQUEST["deptaccount_flag"]=false;	  
	  //if($_REQUEST["save_mode"]=="insert"){
	  $_REQUEST["deptaccount_no"]="-";	 
	  $_REQUEST["expense_accno"]="-";	  
	  $strSQL="select deptaccount_no,expense_accno from dpdeptmaster where depttype_code = '88' and deptclose_status = 0 and member_no='$member_no'";
	  $value = array('DEPTACCOUNT_NO','EXPENSE_ACCNO');
	  list($Num_Rows_,$list_info_) = get_value_many_oci($strSQL,$value); 
	  if($Num_Rows_>0){
		  $_REQUEST["deptaccount_no"]="";	 
		  $_REQUEST["expense_accno"]="";	
	  }
		 for($i=0;$i<$Num_Rows_;$i++){
			   $_REQUEST["deptaccount_flag"]=true;
			   $_REQUEST["deptaccount_no"]=$_REQUEST["deptaccount_no"].$list_info_[$i][0];
			   $_REQUEST["expense_accno"]=$_REQUEST["expense_accno"].$list_info_[$i][1];
			   if($i+1<$Num_Rows_){
			   $_REQUEST["deptaccount_no"]=$_REQUEST["deptaccount_no"].",";
			   $_REQUEST["expense_accno"]=$_REQUEST["expense_accno"].",";
			   }
		  }
	 //  }	
  $SHARE_PERIOD_MIN_MEM=6;
  $strSQL="select p.prename_desc||' '||m.memb_name||' '||m.memb_surname as memb_fullname 
							 ,g.membgroup_desc ,m.position_desc ,m.member_no,s.last_period,m.resign_status,
							 (select count(l.member_no) as cnt from lncontmaster l,lncontcoll lc  where l.loancontract_no=lc.loancontract_no and l.contract_status=1 and lc.coll_status=1 and lc.ref_collno=m.member_no ) as collrefmembnocnt ,
							 (select l.member_no from lncontmaster l,lncontcoll lc  where l.loancontract_no=lc.loancontract_no and l.contract_status=1 and lc.coll_status=1 and lc.ref_collno=m.member_no and rownum=1) as collrefmembno ,
							 (select pp.prename_desc||' '||mm.memb_name||' '||mm.memb_surname as memb_fullname  from lncontmaster l,lncontcoll lc ,mbmembmaster mm,mbucfprename pp where  pp.prename_code=mm.prename_code and mm.member_no=l.member_no and l.loancontract_no=lc.loancontract_no and l.contract_status=1 and lc.coll_status=1 and lc.ref_collno=m.member_no and rownum=1) as collrefmembname 
			                 from mbmembmaster m,mbucfprename p ,mbucfmembgroup g ,shsharemaster  s,shsharetype st 
							 where  m.prename_code=p.prename_code and m.membgroup_code=g.membgroup_code and st.sharetype_code=s.sharetype_code and s.member_no=m.member_no  
							 and m.member_no= '$member_no' and ( m.resign_status = 0 or m.resign_date > sysdate ) ";
			 //echo $strSQL;
			  $valueM = array('LAST_PERIOD');
		      list($Num_RowsM,$list_infoM) = get_value_many_oci($strSQL,$valueM); 
  $_REQUEST["share_last_period"]=$list_infoM[0][0];
  if($_REQUEST["share_last_period"]<$SHARE_PERIOD_MIN_MEM){
	  ?>
	  <script>
		   valid=false;
		    alert("ท่านต้องส่งค่าหุ้นอย่างน้อย <?=$SHARE_PERIOD_MIN_MEM?> งวดจึงจะสามารถทำรายการ ได้");
	  </script>		
	  <?php
  }else{
?>
<?php if($_REQUEST["deptaccount_flag"]==false&&$_REQUEST["save_mode"]=="insert"){ ?><h4><b><font color=red>ไม่สามารถทำรายการได้เนื่องจาก ท่านต้องไม่ได้เปิดบัญชีเงินฝากฉุกเฉิน ATM กับทางสหกรณ์</font></b></h4><?php } ?>
	<table width="100%" border="0" cellspacing="1" cellpadding="3" style="display:<?php if($_REQUEST["deptaccount_flag"]==false&&$_REQUEST["save_mode"]=="insert"){ ?>none<?php } ?>;">
	<input type="hidden" name="action" value=""/>
	<input type="hidden" name="save_mode" value="<?=$_REQUEST["save_mode"]?>"/>
	<input type="hidden" name="chang_step" value="<?=$_REQUEST["chang_step"]?>"/>
	<input type="hidden" name="member_no" value="<?=$member_no?>"/>
      <tr>
        <td width="25%" bgcolor="#6699FF"><strong><font color="#FFFFFF"> ประเภทเงินกู้ : <font color=red><b>(*)</b></font></font></strong></td>
        <td  height="25"  bgcolor="#FFFFFF">
		<?php ?>
		<select id="loantype_code" name="loantype_code" onchange="onChangeLoanType(this);submitForm(this)">
		  <?php 
				$strSQL="select * from lnloantype where loantype_code in (".implode(",",$LOANTYPE_CODE).")";
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
		</select></td>
        <td width="25%" bgcolor="#6699FF"><strong><font color="#FFFFFF"> เลขที่ใบคำขอ : </font></strong></td>
        <td  height="25"  bgcolor="#FFFFFF"><input type="hidden" name="loanreq_docno" id="loanreq_docno" value="<?=$_REQUEST["loanreq_docno"]?>"  ><?=$_REQUEST["loanreq_docno"]?></td>
      </tr>
      <tr style="display:;">
        <td width="25%"  bgcolor="#6699FF"><strong><font color="#FFFFFF"> เบอร์โทร : <font color=red><b>(*)</b></font></font></strong></td>
        <td  height="25" bgcolor="#FFFFFF"><input type="text" name="phone_no" id="phone_no" value="<?=$_REQUEST["phone_no"]?>"  style="background-color:yellow;"></td>
        <td width="25%" bgcolor="#6699FF"><strong><font color="#FFFFFF"> Email : </font></strong></td>
        <td  height="25"  bgcolor="#FFFFFF"><input type="text" name="email" id="email" value="<?=$_REQUEST["email"]?>" style="background-color:yellow;width:200px;" ></td>
      </tr>
      <tr style="display:none;">
        <td width="25%" bgcolor="#6699FF"><strong><font color="#FFFFFF"> เลขบัญชีเงินฝาก ATM : </font></strong></td>
        <td  height="25"  bgcolor="#FFFFFF"><input type="hidden" name="deptaccount_no" id="deptaccount_no" value="<?=$_REQUEST["deptaccount_no"]?>"  ><?=$_REQUEST["deptaccount_no"]?></td>
        <td width="25%" bgcolor="#6699FF"><strong><font color="#FFFFFF"> เลขบัญชีธนาคารผูก ATM : </font></strong></td>
        <td  height="25"  bgcolor="#FFFFFF"><input type="hidden" name="expense_accno" id="expense_accno" value="<?=$_REQUEST["expense_accno"]?>"  ><?=$_REQUEST["expense_accno"]?></td>
      </tr>
      <tr>
        <td width="25%" bgcolor="#6699FF"><strong><font color="#FFFFFF"> เลขที่พนักงาน : <font color=red><b>(*)</b></font></font></strong></td>
        <td  height="25"  bgcolor="#FFFFFF"><input type="hidden" name="entry_date" id="entry_date" value="<?=$_REQUEST["entry_date"]?>"  >
		<input type="text" name="salary_id" id="salary_id" value="<?=$_REQUEST["salary_id"]?>"  style="background-color:yellow;" readonly ></td>
        <td width="25%" bgcolor="#6699FF"><strong><font color="#FFFFFF"> ตำแหน่ง : <font color=red><b>(*)</b></font></font></strong></td>
        <td  height="25" bgcolor="#FFFFFF"><input type="text" name="position_desc" id="position_desc" value="<?=$_REQUEST["position_desc"]?>"  style="background-color:yellow;"  ></td>
      </tr>
      <tr style="display:none;">
        <td width="25%" bgcolor="#6699FF"><strong><font color="#FFFFFF"> สังกัด : </font></strong></td>
        <td  height="25"  bgcolor="#FFFFFF"><input type="hidden" name="membgroup_desc" id="membgroup_desc" value="<?=$_REQUEST["membgroup_desc"]?>"  ><?=$_REQUEST["membgroup_desc"]?></td>
      </tr>
      <tr>
        <td width="25%"  bgcolor="#6699FF"><strong><font color="#FFFFFF"> บริษัทฯ: <font color=red><b>(*)</b></font></font></strong></td>
        <td  height="25"  bgcolor="#FFFFFF"><input type="text" name="workplace" id="workplace" value="<?=$_REQUEST["workplace"]?>"  style="background-color:yellow;"></td>		
        <td width="25%"   bgcolor="#6699FF"><strong><font color="#FFFFFF"> เงินเดือน : <font color=red><b>(*)</b></font></font></strong></td>
        <td  height="25" bgcolor="#FFFFFF" ><input type="text" name="salary_amt" id="salary_amt" value="<?=$_REQUEST["salary_amt"]?>" size=8  style="background-color:yellow;" onchange="submitForm(this)" > (บาท)</td>
        
        <!--<td width="25%"  bgcolor="#6699FF"><strong><font color="#FFFFFF"> จังหวัด/อำเภอ : <font color=red><b>(*)</b></font></font></strong></td>
        <td  height="25" bgcolor="#FFFFFF">-->
		<?php 
		    $strSQL="select * from mbucfprovince where province_code in (".implode(",",$PROVINCE_CODE).")";
			$value = array('PROVINCE_CODE','PROVINCE_DESC');
			list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value); ?>
		<select id="province_desc" name="province_desc" onchange="submitForm(this)" style="display:none;">
		  <?php 
				$j=0;
				for($i=0;$i<$Num_Rows;$i++){
					$province_code=$list_info[$i][$j++];
					$province_desc=$list_info[$i][$j++];
					
					if(isset($_REQUEST["province_desc"])==false){
						  $_REQUEST["province_desc"]=$province_desc;
					}
	
					if($_REQUEST["province_desc"]==$province_desc){
						 $province_code_=$province_code;
					}
					
					$j=0;
					?>
			<option value="<?=$province_desc?>" <?=$_REQUEST["province_desc"]==$province_desc?"selected":""?> ><?=$province_desc?></option>
		  <?php } ?>	
		</select>
		 <?php 
		    $strSQL="select * from mbucfdistrict where province_code ='".$province_code_."'";
			$value = array('DISTRICT_CODE','DISTRICT_DESC');
			list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value); ?>
		<select id="amphur_desc" name="amphur_desc" style="display:none;">
		  <?php 
				$j=0;
				for($i=0;$i<$Num_Rows;$i++){
					$district_code=$list_info[$i][$j++];
					$district_desc=$list_info[$i][$j++];
					$j=0;
					?>
			<option value="<?=$district_desc?>" <?=$_REQUEST["amphur_desc"]==$district_desc?"selected":""?> ><?=$district_desc?></option>
		  <?php } ?>	
		</select>
		<!--</td>-->
      </tr>
	  <tr>
        <td width="25%"  bgcolor="#6699FF"><strong><font color="#FFFFFF"> เบอร์ที่ทำงาน: <font color=red><b>(*)</b></font></font></strong></td>
        <td  height="25"  bgcolor="#FFFFFF"><input type="text" name="phonework_no" id="phonework_no" value="<?=$_REQUEST["phonework_no"]?>"  style="background-color:yellow;"></td>		
        <td width="25%"   bgcolor="#6699FF"><strong><font color="#FFFFFF"> อายุ : <font color=red><b>(*)</b></font></font></strong></td>
        <td  height="25" bgcolor="#FFFFFF" ><input type="text" name="member_age" id="member_age" value="<?=$_REQUEST["member_age"]?>" size=8  style="background-color:yellow;"  > (ปี)</td>        
	  </tr>
      <tr><td width="25%" bgcolor="#6699FF"><strong><font color="#FFFFFF"> วัตถุประสงค์ : <font color=red><b>(*)</b></font></font></strong></td>
        <td  height="25"  bgcolor="#FFFFFF" colspan="3"><input type="text" name="objective_desc" id="objective_desc" value="<?=$_REQUEST["objective_desc"]?>"  style="background-color:yellow;width:650px;"  ></td>
      </tr>
      <tr>
        <td width="25%"   bgcolor="#6699FF"><strong><font color="#FFFFFF"> เริ่มส่งคืนวันที่ : <font color=red><b>(*)</b></font></font></strong></td>
        <td  height="25" bgcolor="#FFFFFF" ><input type="text" name="startpay_date" id="startpay_date" value="<?=$_REQUEST["startpay_date"]?>" size=8 > (dd/mm/yyyy)  </td>
        <td width="25%" bgcolor="#6699FF"><strong><font color="#FFFFFF"> สถานะ : </font></strong></td>
        <td  height="25"  bgcolor="#FFFFFF">
		<input type="hidden" name="loanrequest_status" id="loanrequest_status" value="<?=$_REQUEST["loanrequest_status"]?>"  >
		<?php
			if($_REQUEST["loanrequest_status"]==0){
				echo "0:รอยืนยัน";
		    }else if($_REQUEST["loanrequest_status"]==8){
				echo "8:ลงรับ";
		    }else if($_REQUEST["loanrequest_status"]==1){
				echo "1:เอกสารครบถ้วน";
		    }else {
				echo "-9:ยกเลิก";
			}
			?>
		</td>
      </tr>
      <tr>
        <td width="25%"   bgcolor="#6699FF"><strong><font color="#FFFFFF"> อัตราดอกเบี้ย : </font></strong></td>
        <td  height="25" bgcolor="#FFFFFF" ><input type="hidden" name="loan_rate" id="loan_rate" value="<?=$_REQUEST["loan_rate"]?>" > <?=$_REQUEST["loan_rate"]*100?>(ร้อยละ)</td>
        <td width="25%" bgcolor="#6699FF"><strong><font color="#FFFFFF"> วงเงินกู้สุงสุด : </font></strong></td>
        <td  height="25"  bgcolor="#FFFFFF"><input type="hidden" name="loanreqmax_amt" id="loanreqmax_amt" value="<?=$_REQUEST["loanreqmax_amt"]?>"  ><?=number_format($_REQUEST["loanreqmax_amt"],2)?> (บาท)</td>
      </tr>
      <tr>
        <td width="25%"   bgcolor="#6699FF"><strong><font color="#FFFFFF"> การชำระ : <font color=red><b>(*)</b></font></font></strong></td>
        <td  height="25" bgcolor="#FFFFFF" ><? //=$_REQUEST["loanpayment_type"]?>
		<select id="loanpayment_type" name="loanpayment_type" style="background-color:yellow;" onchange="submitForm(this)">
		   <option value="1" <?=($_REQUEST["loanpayment_type"]==1?"selected":"")?> style="background-color:yellow;">1:คงต้น</option>
		   <option value="2" <?=($_REQUEST["loanpayment_type"]==2?"selected":"")?> style="background-color:yellow;">2:คงยอด</option>
	    </select></td>
        <td width="25%" bgcolor="#6699FF"><strong><font color="#FFFFFF"> จำนวนงวดสูงสุด : </font></strong></td>
        <td  height="25"  bgcolor="#FFFFFF"><input type="hidden" name="period_max" id="period_max" value="<?=$_REQUEST["period_max"]?>"  > <?=$_REQUEST["period_max"]?> (งวด)</td>
      </tr>
      <tr>
        <td width="25%" bgcolor="#6699FF"><strong><font color="#FFFFFF"> วงเงินขอกู้ : <font color=red><b>(*)</b></font></font></strong></td>
        <td  height="25"  bgcolor="#FFFFFF"><input type="text" name="loanrequest_amt" id="loanrequest_amt" value="<?=$_REQUEST["loanrequest_amt"]?>"  size=8  style="background-color:yellow;" onchange="submitForm(this)"> (บาท)</td>
        <td width="25%"   bgcolor="#6699FF"><strong><font color="#FFFFFF"> จำนวนงวดที่ขอกู้ : <font color=red><b>(*)</b></font></font></strong></td>
        <td  height="25" bgcolor="#FFFFFF" ><input type="text" name="period" id="period" value="<?=$_REQUEST["period"]?>"  size=8  style="background-color:yellow;"  onchange="submitForm(this)">(งวด)</td>
      </tr>
      <tr>
        <td width="25%"   bgcolor="#6699FF"><strong><font color="#FFFFFF"> ชำระต่องวด : </font></strong></td>
        <td  height="25" bgcolor="#FFFFFF" ><input type="hidden" name="period_payment" id="period_payment" value="<?=$_REQUEST["period_payment"]?>"  ><?=number_format($_REQUEST["period_payment"],2)?>(บาท)</td>
        <td width="25%" bgcolor="#6699FF"><strong><font color="#FFFFFF"> เลขลงรับ : </font></strong></td>
        <td  height="25"  bgcolor="#FFFFFF"><input type="hidden" name="noticedoc_no" id="noticedoc_no" value="<?=$_REQUEST["noticedoc_no"]?>"  ><?=$_REQUEST["noticedoc_no"]?> </td>
      </tr>
      <tr>
        <td width="25%" bgcolor="#6699FF"><strong><font color="#FFFFFF">ธนาคารที่รับโอน  : <font color=red><b>(*)</b></font></font></strong></td>
        <td  height="25"  bgcolor="#FFFFFF">
		<?php 
		    $strSQL="select '' as bank_code , '---กรุณาเลือก---' as bank_desc from dual union all select bank_code, bank_desc from cmucfbank  where bank_code in ('002','004','006','011','014','030') ";
			$value = array('BANK_CODE','BANK_DESC');
			list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value); ?>
		<select id="expense_bank" name="expense_bank" style="background-color:yellow;">
		  <?php 
				$j=0;
				for($i=0;$i<$Num_Rows;$i++){
					$expense_code=$list_info[$i][$j++];
					$expense_bank=$list_info[$i][$j++];
					
					if(isset($_REQUEST["expense_bank"])==false){
						  $_REQUEST["expense_bank"]=$expense_bank;
					}
	
					$j=0;
					?>
			<option value="<?=$expense_bank?>" <?=$_REQUEST["expense_bank"]==$expense_bank?"selected":""?> ><?=$expense_bank?></option>
		  <?php } ?>	
		</select>
		</td>
        <td width="25%"   bgcolor="#6699FF"><strong><font color="#FFFFFF"> สาขาธนาคารที่รับโอน  : <font color=red><b>(*)</b></font></font></strong></td>
        <td  height="25" bgcolor="#FFFFFF" ><input type="text" name="expense_bankbranch" id="expense_bankbranch" value="<?=$_REQUEST["expense_bankbranch"]?>"  size=20  style="background-color:yellow;" ></td>
      </tr>
      <tr>
        <td width="25%" bgcolor="#6699FF"><strong><font color="#FFFFFF">ประเภทบัญชีธนาคารที่รับโอน  : <font color=red><b>(*)</b></font></font></strong></td>
        <td  height="25"  bgcolor="#FFFFFF">	
		<select id="expense_banktype" name="expense_banktype" style="display:;">
		  <?php 
					if(isset($_REQUEST["expense_banktype"])==false){
						  $_REQUEST["expense_banktype"]="ออมทรัพย์";
					}
					?>
			<option value="ออมทรัพย์" <?=$_REQUEST["expense_banktype"]=="ออมทรัพย์"?"selected":""?> >ออมทรัพย์</option>
			<option value="กระแส" <?=$_REQUEST["expense_banktype"]=="กระแส"?"selected":""?> >กระแส</option>
		</select>
		</td>
        <td width="25%"   bgcolor="#6699FF"><strong><font color="#FFFFFF"> เลขที่บัญชีธนาคารที่รับโอน  : <font color=red><b>(*)</b></font></font></strong></td>
        <td  height="25" bgcolor="#FFFFFF" ><input type="text" name="expense_accid" id="expense_accid" value="<?=$_REQUEST["expense_accid"]?>"  size=20  style="background-color:yellow;" maxlength="15" ></td>
      </tr>
      <tr>
        <td width="25%" align="left" bgcolor="#6699FF"><strong><font color="#FFFFFF">
		 รายการเอกสารแนบ : </font></strong></td>
        <td  height="25" align="left" bgcolor="#FFFFFF" colspan="3"> 
		<?php
				
			  
			 //print_r($filesList);
				
			  $strSQL_="select * from  mdbucfreqfiles u
								where u.loantype_code='".$_REQUEST["loantype_code"]."' 
								order by u.reqfiletype_code asc ";
			  //echo 	$strSQL_;			
			  $filesListUpload=array();		
			  $objQuery_ = mysql_query($strSQL_) ;
			  $numrows_=mysql_num_rows($objQuery_);
			  $numrows_a=0;
			  $i=0;
			  while($q = mysql_fetch_array($objQuery_)){					   
		  ?>
      <li>
	  <?=$q["reqfiletype_desc"]?> = 
	  <?php
			$strSQL_="select * from  mdbreqloanfiles f
								where loantype_code='".$_REQUEST["loantype_code"]."' 
								and reqfiletype_code='".$q["reqfiletype_code"]."'  
								and loanreq_docno='".$_REQUEST["loanreq_docno"]."'
								order by reqfiletype_code asc ";
			  //echo 	$strSQL_;				
			 $objQuery__ = mysql_query($strSQL_) ;
             $q_ = mysql_fetch_array($objQuery__);
			 $target_dir = $q_["filename"];
			  if(file_exists($target_dir)){ 
			  $numrows_a++;
			  ?>
			   <a href="<?=$target_dir?>" target="_blank" ><font color=blue><b>Download</b></font></a>
			  |<a href="?menu=LoanRequest&action=delete&loanreq_docno=<?=$_REQUEST["loanreq_docno"]?>&save_mode=<?=$_REQUEST["save_mode"]?>&reqfiletype_code=<?=$_REQUEST["reqfiletype_code"]?>&filename=<?=$target_dir?>" 
				onclick="return confirm('ยืนยันการลบเอกสาร')" ><font color=red><b>ลบ</b></font></a>
			  <?php } ?>
		   <input type="file" <?php  if($_REQUEST["save_mode"]!="update"){ ?>  <?php } ?> name="<?="file".$_REQUEST["loanreq_docno"].$q["reqfiletype_code"]?>" id="<?="file".$_REQUEST["loanreq_docno"].$q["reqfiletype_code"]?>" onclick="return checkCanUpload(this);"></li>
		  <?php 
             $filesListUpload[$i++]= $target_dir;
			 }
			 
			 
			$target_dir_root = "uploads/";
			$target_dir_root = $target_dir_root.$member_no."/";
			$target_dir_root = $target_dir_root.$_REQUEST["loanreq_docno"]."/";
			if(file_exists($target_dir_root)==false)
			mkdir($target_dir_root);
			$filesList = array_slice(scandir($target_dir_root ), 2);
			 
			$k=0;
			$filesListUploadClear=array();		
			for($i=0;$i<count($filesList);$i++){
				$found=false;
				for($j=0;$j<count($filesListUpload);$j++){
					if(strpos($filesListUpload[$j],$filesList[$i])!== false){
						$found=true;
					}
				}
				if($found==false){
				   $filesListUploadClear[$k++]=$filesList[$i];
				   //echo $k.")".$filesListUploadClear[$k-1]."<br/>";
				   unlink($target_dir_root.$filesListUploadClear[$k-1]);
				}
			}
			
			if($numrows_a<$numrows_){
				?>
					<script>
					saveBtn="<?=$_REQUEST["saveBtn"]?>";
					if(saveBtn.length>0){
					alert("ท่านยังไม่ได้แนบหลักฐานประกอบการบันทึกคำขอกู้ให้ครบถ้วนตามเงื่อนไขที่กำหนด");
					}
					</script> 
				<br/><font color=red><b>ท่านยังไม่ได้แนบหลักฐานประกอบการบันทึกคำขอกู้ให้ครบถ้วนตามเงื่อนไขที่กำหนด <b></font>
				<?php 
			}				
			//print_r($filesListUploadClear);	 
	  ?>   
		</td>
      </tr>
      <tr>
        <td width="25%"   bgcolor="#6699FF"><strong><font color="#FFFFFF"> หมายเหตุ : </font></strong></td>
        <td  height="25" bgcolor="#FFFFFF" ><input type="text" name="remark" id="remark" value="<?=$_REQUEST["remark"]?>"  size="30"> </td>		
        <td width="25%" bgcolor="#6699FF"><strong><font color="#FFFFFF"> วันที่ปรับปรุง : </font></strong></td>
        <td  height="25" bgcolor="#FFFFFF"><input type="hidden" name="update_date" id="update_date" value="<?=$_REQUEST["update_date"]?>"  ><?=$_REQUEST["update_date"]?></td>
      </tr>
	  <?php 
	    
		 if($_REQUEST["loantype_code"]=="20"){
		 $collmax=4;	 
	 
			$strSQL="
			CREATE TABLE if not exists `mdbreqloancoll` (
			  `loanreq_docno` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
			  `loantype_code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
			  `member_no` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
			  `seq_no` decimal(10,0) NOT NULL,
			  `collmemb_no` varchar(10) COLLATE utf8mb4_unicode_ci ,
			  `collmemb_name` varchar(150) COLLATE utf8mb4_unicode_ci ,
			  `collworkplace` varchar(150) COLLATE utf8mb4_unicode_ci ,
			  `collposition_desc` varchar(150) COLLATE utf8mb4_unicode_ci ,
			  `collhavemore_flag` varchar(10) COLLATE utf8mb4_unicode_ci  
			   ,PRIMARY KEY (loanreq_docno,loantype_code,member_no,seq_no)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
			 mysql_query($strSQL) ;
					 
			 $strSQL="alter table mdbreqloancoll add ( collrefmembno varchar(50),collrefmembname varchar(150)) ";
			 mysql_query($strSQL) ;
			 
			for($c=1;$c<=$collmax;$c++){ 
			 
			if($_REQUEST["saveBtn"]!=""){
				
			  $strSQL="delete from mdbreqloancoll where loanreq_docno='".$_REQUEST["loanreq_docno"]."' ";
			  mysql_query($strSQL) ;
			  
					for($c=1;$c<=$collmax;$c++){ 
							$strSQL="insert into mdbreqloancoll  (loanreq_docno,loantype_code,member_no,seq_no,
										  collmemb_no,collmemb_name,collworkplace,collposition_desc,collhavemore_flag,collrefmembname,collrefmembno)values 
										  ('".$_REQUEST["loanreq_docno"]."','".$_REQUEST["loantype_code"]."','".$_REQUEST["member_no"]."','".$c."' ,
									      '".$_REQUEST["coll".$c."mem_no"]."' ,
									      '".$_REQUEST["coll".$c."mem_nm"]."' ,
									      '".$_REQUEST["coll".$c."workplace"]."' ,
									      '".$_REQUEST["coll".$c."position"]."' ,
									      '".$_REQUEST["coll".$c."havemoreflag"]."',
									      '".$_REQUEST["coll".$c."refmembname"]."',
									      '".$_REQUEST["coll".$c."refmembno"]."')";
							mysql_query($strSQL) ;		
							//echo $strSQL.";<br/>";		
					}
					
				
			  $strSQL="select * from mdbreqloancoll where loanreq_docno='".$_REQUEST["loanreq_docno"]."' order by seq_no asc";
			  $objQuery__ = mysql_query($strSQL) ;
			  
			  $i=1;
			  while($q = mysql_fetch_array($objQuery__)){		
 			  
			    $_REQUEST["coll".$i."mem_no"]=$q['collmemb_no'];
			    $_REQUEST["coll".$i."mem_nm"]=$q['collmemb_name'];
			    $_REQUEST["coll".$i."workplace"]=$q['collworkplace'];
			    $_REQUEST["coll".$i."position"]=$q['collposition_desc'];
			    $_REQUEST["coll".$i."havemoreflag"]=$q['collhavemore_flag'];
			    $_REQUEST["coll".$i."refmembname"]=$q['collrefmembname'];
			    $_REQUEST["coll".$i."refmembno"]=$q['collrefmembno'];
				
				$_REQUEST["Coll".$i."name"]= $_REQUEST["coll".$i."mem_nm"];
				$_REQUEST["Mem".$i."no"]= $_REQUEST["coll".$i."mem_no"];
				$_REQUEST["Work".$i."place"]= $_REQUEST["coll".$i."workplace"];
				$_REQUEST["Position".$i."desc"]= $_REQUEST["coll".$i."position"];
				$_REQUEST["Havemore".$i."coll"] = $_REQUEST["coll".$i."havemoreflag"];
				$_REQUEST["Coll".$i."refmembname"] = $_REQUEST["coll".$i."refmembname"];
				$_REQUEST["Coll".$i."refmembno"] = $_REQUEST["coll".$i."refmembno"];
				
				$i++;
			  }
					
			}
			
		  ?>      
	  <tr>
	  <td colspan="4">		  
	  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
	  <tr>
		<td bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="1" cellpadding="3">
		  <tr>
			<td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">ลำดับผู้ค้ำ</font></strong></td>
			<td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">เลขทะเบียนสมาชิกผู้ค้ำ</font></strong></td>
			<td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">ชื่อ-สกุลผู้ค้ำ</font></strong></td>
			<td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">สถานที่ทำงานผู้ค้ำ</font></strong></td>
			<td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">ตำแหน่งผู้ค้ำ</font></strong></td>
			<td align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">ยังคงมีภาระค้ำสัญญาอื่นๆ</font></strong></td>
		  </tr>
		  <?php 
		  
		  for($c=1;$c<=$collmax;$c++){
			  if(isset($_REQUEST["coll".$c."havemoreflag"])==false){
				  $_REQUEST["coll".$c."havemoreflag"]="-";
			  }
			  $_REQUEST["coll".$c."mem_no"]=GetFormatMember($_REQUEST["coll".$c."mem_no"]);
			  //$strSQL="select s.sharestk_amt*st.unitshare_value as  sharestk_amt,s.last_period from shsharemaster  s,shsharetype st where st.sharetype_code=s.sharetype_code and s.member_no ='".$member_no."' ";
			   //echo $strSQL;
			  $strSQL="select p.prename_desc||' '||m.memb_name||' '||m.memb_surname as memb_fullname 
							 ,g.membgroup_desc ,m.position_desc ,m.member_no,s.last_period,m.resign_status,
							 (select count(*) as cnt  from ( select distinct l.member_no from lncontmaster l,lncontcoll lc  where l.loancontract_no=lc.loancontract_no and l.contract_status=1 and lc.coll_status=1 and lc.ref_collno=m.member_no ) ) as collrefmembnocnt ,
							 (select l.member_no from lncontmaster l,lncontcoll lc  where l.loancontract_no=lc.loancontract_no and l.contract_status=1 and lc.coll_status=1 and lc.ref_collno=m.member_no and rownum=1) as collrefmembno ,
							 (select pp.prename_desc||' '||mm.memb_name||' '||mm.memb_surname as memb_fullname  from lncontmaster l,lncontcoll lc ,mbmembmaster mm,mbucfprename pp where  pp.prename_code=mm.prename_code and mm.member_no=l.member_no and l.loancontract_no=lc.loancontract_no and l.contract_status=1 and lc.coll_status=1 and lc.ref_collno=m.member_no and rownum=1) as collrefmembname 
			                 from mbmembmaster m,mbucfprename p ,mbucfmembgroup g ,shsharemaster  s,shsharetype st 
							 where  m.prename_code=p.prename_code and m.membgroup_code=g.membgroup_code and st.sharetype_code=s.sharetype_code and s.member_no=m.member_no  
							 and m.member_no= '".$_REQUEST["coll".$c."mem_no"]."' and ( m.resign_status = 0 or m.resign_date > sysdate ) ";
			 //echo $strSQL;
			  $value = array('MEMB_FULLNAME','MEMBGROUP_DESC','POSITION_DESC','COLLREFMEMBNO','COLLREFMEMBNAME','LAST_PERIOD','RESIGN_STATUS','COLLREFMEMBNOCNT');
		      list($Num_Rows_,$list_info_) = get_value_many_oci($strSQL,$value); 
			  $_REQUEST["coll".$c."mem_nm"]=$list_info_[0][0];
			  if(($_REQUEST["coll".$c."workplace"])=="")
			  $_REQUEST["coll".$c."workplace"]=$list_info_[0][1];
			  if(($_REQUEST["coll".$c."position"])=="")
			  $_REQUEST["coll".$c."position"]=$list_info_[0][2];
			  $_REQUEST["coll".$c."refmembno"]=$list_info_[0][3];
			  $_REQUEST["coll".$c."refmembname"]=$list_info_[0][4];
			  $_REQUEST["coll".$c."last_period"]=$list_info_[0][5];
			  $_REQUEST["coll".$c."resign_status"]=$list_info_[0][6];
			  $_REQUEST["coll".$c."refmembnocnt"]=$list_info_[0][7];
			  $collrefmembno_coll=$_REQUEST["coll".$c."mem_no"];
			  settype($collrefmembno_coll,"double");
			  //echo "<script>alert(' พบว่า กรอกรายการผู้ค้ำ สมาชิก เลขที่ ".$collrefmembno_coll." ไม่สามารถค้ำได้ เนื่องด้วยยังส่งค่างวดหุ้น  น้อยกว่า ".$_REQUEST["coll".$c."last_period"]." ตามเงื่อนไขที่กำหนด ');</script>";
			  if( $collrefmembno_coll>0&&$_REQUEST["coll".$c."resign_status"]!="0"){
				   $_REQUEST["coll".$c."mem_nm"]="";
				   $_REQUEST["coll".$c."refmembname"]="";
				   echo "<script>alert(' พบว่า กรอกรายการผู้ค้ำ สมาชิก เลขที่ ".$_REQUEST["coll".$c."mem_no"]." ไม่สามารถค้ำได้ เนื่องด้วย ลาออกแล้ว ');</script>";
			  }else 
			  if($collrefmembno_coll>0&&$_REQUEST["coll".$c."last_period"]<$SHARE_PERIOD_MIN){
				   $_REQUEST["coll".$c."mem_nm"]="";
				   $_REQUEST["coll".$c."refmembname"]="";
				   echo "<script>alert(' พบว่า กรอกรายการผู้ค้ำ สมาชิก เลขที่ ".$_REQUEST["coll".$c."mem_no"]." ไม่สามารถค้ำได้ เนื่องด้วยยังส่งค่างวดหุ้น  น้อยกว่า ".$SHARE_PERIOD_MIN." ตามเงื่อนไขที่กำหนด ');</script>";
			  }/*else 
			  if($_REQUEST["coll".$c."refmembnocnt"]>$COLL_CON_LIMIT){
				   $_REQUEST["coll".$c."mem_nm"]="";
				   $_REQUEST["coll".$c."refmembname"]="";
				   echo "<script>alert(' พบว่า กรอกรายการผู้ค้ำ สมาชิก เลขที่ ".$_REQUEST["coll".$c."mem_no"]." ไม่สามารถค้ำได้ เนื่องด้วยค้ำต้องไม่มากกว่า ".$COLL_CON_LIMIT." สัญญา ตามเงื่อนไขที่กำหนด ');</script>";
			  }*/
		  ?>
		  <tr>
			<td align="center" ><strong><font color="#FFFFFF"><input type="text" name="coll<?=$c?>seq_no" id="coll<?=$c?>seq_no" value="<?=$c?>"  size="5" readonly></font></strong></td>
			<td align="center" ><strong><font color="#FFFFFF"><input type="text" name="coll<?=$c?>mem_no" id="coll<?=$c?>mem_no" value="<?=$_REQUEST["coll".$c."mem_no"]?>"  size="10" onchange="submitForm(this)" ></font></strong></td>
			<td align="center" ><strong><font color="#FFFFFF"><input type="text" name="coll<?=$c?>mem_nm" id="coll<?=$c?>mem_nm" value="<?=$_REQUEST["coll".$c."mem_nm"]?>"  size="18" readonly></font></strong></td>
			<td align="center" ><strong><font color="#FFFFFF"><input type="text" name="coll<?=$c?>workplace" id="coll<?=$c?>workplace" value="<?=$_REQUEST["coll".$c."workplace"]?>"  size="15"></font></strong></td>
			<td align="center" ><strong><font color="#FFFFFF"><input type="text" name="coll<?=$c?>position" id="coll<?=$c?>position" value="<?=$_REQUEST["coll".$c."position"]?>"  size="15"></font></strong></td>
			<td align="center" ><strong><font color="#FFFFFF">
			<input type="hidden" name="coll<?=$c?>havemoreflag" id="coll<?=$c?>havemoreflag" value="<?=$_REQUEST["coll".$c."havemoreflag"]?>"  >
			<input type="hidden" name="coll<?=$c?>refmembno" id="coll<?=$c?>refmembno" value="<?=$_REQUEST["coll".$c."refmembno"]?>"  >
			<input type="text" name="coll<?=$c?>refmembname" id="coll<?=$c?>refmembname" value="<?=$_REQUEST["coll".$c."refmembname"]?>"  size="18" readonly></font></strong></td>
		  </tr>
		  <?php 
		  }
		}
		  ?>
	  </table>
	  </td>
	  </tr>
	  <?php } ?>
      <tr style="display:<?php if($_REQUEST["save_mode"]=="update"){?>none<?php } ?>;">
        <td  height="25" bgcolor="#FFFFFF" colspan="4" ><iframe src="LoanRequestAccept<?=$_REQUEST["loantype_code"]?>.html" width="100%" height="150"></iframe></td>
      </tr>
	  <?php if($loanrequest_valid_flag){ ?>
      <tr>
        <td bgcolor="#FFFFFF" colspan="4" align="center">
		<input type="checkbox" id="accept_policy" name="accept_policy" value="1" <?php if($_REQUEST["save_mode"]=="update"){?>checked<?php }else { echo "";} ?> style="display:<?php if($_REQUEST["save_mode"]=="update"){?>none<?php } ?>;" /><?php if($_REQUEST["save_mode"]!="update"){?> ยอมรับเงื่อนไข <br/><br/><?php } ?>
		<font color=red>* รายละเอียดที่บันทึกในใบคำขอนี้ต้องผ่านการ ตรวจสอบสิทธิ์ จากเจ้าหน้าที่สหกรณ์ อีกครั้ง <br/>ข้อมูลใบคำขอที่บันทึกได้ มิได้ ยืนยันว่า สหกรณ์จะยืนยัน การให้กู้ ตามรายละเอียดที่บันทึกนี้ </font><br/><br/>
		<input type="submit" name="saveBtn" id="saveBtn" value="บันทึกใบคำขอ" <?=($_REQUEST["loanrequest_status"]!=0)?"disabled":""?> />
		<?php if($_REQUEST["save_mode"]=="update"){?>		
		<input type="submit" name="cancelBtn" id="cancelBtn" value="บันทึกยกเลิกใบคำขอ" <?=($_REQUEST["loanrequest_status"]==0||$_REQUEST["loanrequest_status"]==-9)?"":"disabled"?> />
		
		<?php
		
				$LoanDocPrint = array(
				   "10"=>array('LoanReqdoc'.$_REQUEST["loantype_code"].''),
				   "21"=>array('LoanReqdoc'.$_REQUEST["loantype_code"].''),
				   "20"=>array(
					'LoanReqdoc'.$_REQUEST["loantype_code"].'_1',
					'LoanReqdoc'.$_REQUEST["loantype_code"].'_2',
					'LoanReqdoc'.$_REQUEST["loantype_code"].'_3',
					'LoanReqdoc'.$_REQUEST["loantype_code"].'_4',
					'LoanReqdoc'.$_REQUEST["loantype_code"].'_5',
					'LoanReqdoc'.$_REQUEST["loantype_code"].'_6',
					'LoanReqdoc'.$_REQUEST["loantype_code"].'_7'
					)
				);
				
				for($z=0;$z<count($LoanDocPrint[$_REQUEST["loantype_code"]]);$z++){
				
				$file_print=$LoanDocPrint[$_REQUEST["loantype_code"]][$z];
				//echo $file_print;
				//$file_print='LoanReqdoc'.$_REQUEST["loantype_code"].'.html';
				if(file_exists($file_print.".html")){
				$body=file_get_contents($file_print.".html", true);
				 
				$body=str_replace("COOP_NAME",$title,$body);				
				$body=str_replace("noticedoc_no","<u>".$_REQUEST["noticedoc_no"]."</u>",$body);
				$body=str_replace("loanreq_docno","<u>".$_REQUEST["loanreq_docno"]."</u>",$body);
				$body=str_replace("update_date","<u>".ConvertDate($_REQUEST["update_date_"],"long")."</u>",$body);
				$body=str_replace("member_fullname","<u>".$full_name."</u>",$body);
				$body=str_replace("member_no","<u>".$member_no."</u>",$body);
				$body=str_replace("member_age","<u>".$_REQUEST["member_age"]."</u>",$body);
				$body=str_replace("salary_id","<u>".$_REQUEST["salary_id"]."</u>",$body);
				$body=str_replace("phone_no","<u>".$_REQUEST["phone_no"]."</u>",$body);
				$body=str_replace("phonework_no","<u>".$_REQUEST["phonework_no"]."</u>",$body);
				$body=str_replace("position_desc","<u>".$_REQUEST["position_desc"]."</u>",$body);
				$body=str_replace("workplace","<u>".$_REQUEST["workplace"]."</u>",$body);
				$body=str_replace("amphur_desc","<u>".$_REQUEST["amphur_desc"]."</u>",$body);
				$body=str_replace("province_desc","<u>".$_REQUEST["province_desc"]."</u>",$body);
				$body=str_replace("membgroup_desc","<u>".$_REQUEST["membgroup_desc"]."</u>",$body);
				$body=str_replace("objective_desc","<u>".$_REQUEST["objective_desc"]."</u>",$body);
				$body=str_replace("salary_amt","<u>".number_format($_REQUEST["salary_amt"],2)."</u>",$body);
				$body=str_replace("loanrequest_amt","<u>".number_format($_REQUEST["loanrequest_amt"],2)."</u>",$body);
				$body=str_replace("loanrequestamt_txt","<u>".convertthai($_REQUEST["loanrequest_amt"])."</u>",$body);
				$body=str_replace("period_payment","<u>".number_format($_REQUEST["period_payment"],2)."</u>",$body);
				$body=str_replace("period","<u>".$_REQUEST["period"]."</u>",$body);
				$body=str_replace("startpay_date","<u>".ConvertDate(str_replace("/","-",$_REQUEST["startpay_date"]),"long")."</u>",$body);
				$body=str_replace("expense_bank","<u>".$_REQUEST["expense_bank"]."</u>",$body);
				$body=str_replace("expense_branch","<u>".$_REQUEST["expense_bankbranch"]."</u>",$body);
				$body=str_replace("expense_type","<u>".$_REQUEST["expense_banktype"]."</u>",$body);
				$body=str_replace("expense_accid","<u>".$_REQUEST["expense_accid"]."</u>",$body);
				$body=str_replace("loan_rate","<u>".($_REQUEST["loan_rate"]*100)."</u>",$body);
				
				$msuppervisor_nm="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				$msuppervisor_postition="………………………………………………";
				
			 $strSQLm="select msuppervisor_nm||' '||msuppervisor_surnm as msuppervisor_nm,msuppervisor_postition
								from hremployee where salary_id='".$_REQUEST["salary_id"]."' ";	
				 //echo $strSQL;
			  $value = array('MSUPPERVISOR_NM','MSUPPERVISOR_POSTITION');
		      list($Num_Rowsm,$list_infom) = get_value_many_oci($strSQLm,$value); 
			  
			  //try{
				  if(strlen($list_infom[0][1])>0){
					  $msuppervisor_nm="<u>&nbsp;&nbsp;".$list_infom[0][0]."&nbsp;&nbsp;</u>";
					  $msuppervisor_postition="<u>&nbsp;&nbsp;".$list_infom[0][1]."&nbsp;&nbsp;</u>";
				  }
			  //}catch(Exception esx){}
			  
			    $_REQUEST["msuppervisor_nm"]=$msuppervisor_nm;
			    $_REQUEST["msuppervisor_postition"]=$msuppervisor_postition;
			  
				$body=str_replace("msuppervisor_nm",$_REQUEST["msuppervisor_nm"],$body);
				$body=str_replace("msuppervisor_postition",$_REQUEST["msuppervisor_postition"],$body);
				
				//$body=str_replace("002.gif",(($_REQUEST["expense_accid"]!=""&&$_REQUEST["loantype_code"]=="20")?"002_.gif":"002.gif"),$body);
				//$body=str_replace("002.gif",(($_REQUEST["expense_accid"]!=""&&$_REQUEST["loantype_code"]=="21")?"002_.gif":"002.gif"),$body);
				
				
				 if($_REQUEST["loantype_code"]!="10"){
					for($c=1;$c<=$collmax;$c++){ 
					$body=str_replace("Coll".$c."name",$_REQUEST["Coll".$c."name"],$body);
					$body=str_replace("Mem".$c."no",$_REQUEST["Mem".$c."no"],$body);
					$body=str_replace("Work".$c."place",$_REQUEST["Work".$c."place"],$body);
					$body=str_replace("Position".$c."desc",$_REQUEST["Position".$c."desc"],$body);
					$body=str_replace("Havemore".$c."coll",$_REQUEST["Havemore".$c."coll"],$body);
					$body=str_replace("Coll".$c."refmembname",$_REQUEST["coll".$c."refmembname"],$body);
					$body=str_replace("Coll".$c."refmembno",$_REQUEST["coll".$c."refmembno"],$body);
					}
				 }
				
				$body=str_replace("\"".$file_print."_files","\"../".$file_print."_files",$body);
				
				$path_root="loadreqdoc/";
				if(!file_exists($path_root) && !is_dir($path_root))
				mkdir($path_root);
				$loanreq_docfile=$path_root.$file_print.$_REQUEST["loanreq_docno"].'.html';
				$f=fopen($loanreq_docfile, 'wa+');
				fwrite($f, $body);
				fclose($f);
				?>
				<br/>
				<input type="button" name="printBtn" id="printBtn" value="พิมพ์ใบคำขอ <?=($_REQUEST["loantype_code"]!="20"?"":("ส่วนที่".($z+1)))?>" onclick="printFrame('LoanReqdoc<?=$_REQUEST["loanreq_docno"].$z?>')"/>
				<input type="button" name="printDocBtn" id="printDocBtn" value="คู่มือพิมพ์ใบคำขอ" onclick="window.open('set_scale.pdf','printDoc','_blank')"/>
				<iframe src="<?=$loanreq_docfile?>" width="100%" height="<?=$_REQUEST["loantype_code"]!="20"?"2050":"350"?>" id="LoanReqdoc<?=$_REQUEST["loanreq_docno"].$z?>" style="display:;"><?=$body?></iframe>
				<?php
				
				 }
				}	
		} ?>
		</td>
      </tr>
	  <?php }else{ ?>
		  
      <tr>
        <td bgcolor="#FFFFFF" colspan="4" align="center">
		   <script>alert("ส่งเงินค่าหุ้นมาน้อยกว่า 6 งวด ไม่สามารถทำรายการขอกู้ประเภทนี้ได้");</script>
		   <font color=red><b> ส่งเงินค่าหุ้นมาน้อยกว่า 6 งวด ไม่สามารถทำรายการขอกู้ประเภทนี้ได้<b/></font>
		</td>
	  </tr>	
		  
	 <?php }?>
    </table>
		   
    </form>
	</td></tr></table>
  <?php } ?>	
	<script>
	  
	 function checkCanUpload(item){
		<?php  if($_REQUEST["save_mode"]!="update"){ ?>
		 alert("ท่านต้องบันทึกใบคำขอกู้ก่อน จึงจะสามารถ Upload เอกสารแนบได้ ");
		 return false;
		<?php } ?>
	 }	 
	
	 function onChangeLoanType(item){
		  if(item.value=="10"){
			  document.getElementById('period').value="6";
		  }else{
			  document.getElementById('period').value="60";
		  }
		  document.getElementById('startpay_date').value='<?=date("d/m/").(date("Y")+543)?>';
	 }
	 function submitForm(item){
		 if(item.value!=""){
		  document.getElementById('formID1').submit();
		 }else{
		   alert("กรุณากรอกรายละเอียดให้ถูกต้อง");	  
		   item.focus();	 
		   item.value=0;
		 }
	 }
	 
	 function formValidation(){
		 var valid=false;
		 
		 if(document.getElementById('position_desc').value.length<=0){
			 alert("กรุณากรอกตำแหน่ง");
			 document.getElementById('position_desc').focus();
			 return valid;
		 }else if(isNaN((document.getElementById('member_age').value))||parseFloat(document.getElementById('member_age').value)<=0){
			 alert("กรุณากรอกอายุเป็นตัวเลขเท่านั้น");
			 document.getElementById('member_age').focus();
			 return valid;
		 }else if(document.getElementById('phone_no').value.length<=0){
			 alert("กรุณากรอกเบอร์โทรที่ติดต่อได้");
			 document.getElementById('phone_no').focus();
			 return valid;
		 }else if(document.getElementById('workplace').value.length<=0){
			 alert("กรุณากรอกสถานที่ทำงาน");
			 document.getElementById('workplace').focus();
			 return valid;
		 }else if(document.getElementById('salary_id').value.length<=0){
			 alert("กรุณากรอกเลขที่พนักงาน");
			 document.getElementById('salary_id').focus();
			 return valid;
		 }else if(document.getElementById('phonework_no').value.length<=0){
			 alert("กรุณากรอกเบอร์ที่ทำงาน");
			 document.getElementById('phonework_no').focus();
			 return valid;
		 }else if(isNaN((document.getElementById('salary_amt').value))||parseFloat(document.getElementById('salary_amt').value)<=0){
			 alert("กรุณาระบุเงินเดือนเป็นตัวเงินเท่านั้น");
			 document.getElementById('salary_amt').focus();
			 return valid;
		 }else if(document.getElementById('objective_desc').value.length<=0){
			 alert("กรุณากรอกวัตถุประสงค์");
			 document.getElementById('objective_desc').focus();
			 return valid;
		 }else if(document.getElementById('startpay_date').value.length<=0){
			 alert("กรุณาระบุกำหนดวันที่เริ่มชำระ");
			 document.getElementById('startpay_date').focus();
			 return valid;
		 }else if(document.getElementById('period').value.length<=0){
			 alert("กรุณากำหนดจำนวนงวดเป็นตัวเลขเท่านั้น");
			 document.getElementById('period').focus();
			 return valid;
		 }else if(isNaN((document.getElementById('loanrequest_amt').value))||document.getElementById('loanrequest_amt').value.length<=0){
			 alert("กรุณากำหนดจำนวนเงินที่จะขอกู้เป็นตัวเงินเท่านั้น");
			 document.getElementById('loanrequest_amt').focus();
			 return valid;
		 }else if(parseFloat(document.getElementById('period').value)<parseFloat('3')){
			 alert("กรุณากำหนดจำนวนงวดไม่น้อยกว่าจำนวนงวดต่ำสุด");
			 document.getElementById('period').value=document.getElementById('period_max').value;
			 document.getElementById('period').focus();
			 return valid;
		 }else if(parseFloat(document.getElementById('period').value)>parseFloat(document.getElementById('period_max').value)){
			 alert("กรุณากำหนดจำนวนงวดไม่เกินจำนวนงวดสูงสุด");
			 document.getElementById('period').value=document.getElementById('period_max').value;
			 document.getElementById('period').focus();
			 return valid;
		 }else if(parseFloat(document.getElementById('loanrequest_amt').value)>parseFloat(document.getElementById('loanreqmax_amt').value)){
			 alert("กรุณากำหนดจำนวนเงินที่จะขอกู้ไม่เกินจำนวนงวดสูงสุด");
			 document.getElementById('loanrequest_amt').value=document.getElementById('loanreqmax_amt').value;
			 document.getElementById('loanrequest_amt').focus();
			 return valid;
		 }else if(document.getElementById('expense_bank').value == '---กรุณาเลือก---' ){
			 alert("กรุณาระบุธนาคาร");
			 document.getElementById('expense_bank').focus();
			 return valid;
		 }else if(document.getElementById('expense_bankbranch').value.length<=0){
			 alert("กรุณาระบุสาขาธนาคาร");
			 document.getElementById('expense_bankbranch').focus();
			 return valid;
		 }else if(document.getElementById('expense_accid').value.length<10||document.getElementById('expense_accid').value.length>15){
			 alert("กรุณาระบุเลขบัญชีธนาคาร ในรูปแบบเฉพาะตัวเลข เท่านั้น จำนวน 10 หลักขึ้นไป ");
			 document.getElementById('expense_accid').focus();
			 return valid;
		 }else if(isNaN((document.getElementById('expense_accid').value))){
			 alert("กรุณาระบุเลขบัญชีธนาคาร ในรูปแบบเฉพาะตัวเลข เท่านั้น จำนวน 10 หลักขึ้นไป ");
			 document.getElementById('expense_accid').focus();
			 return valid;
		 }else if(document.getElementById('accept_policy').checked==false){
			 alert("กรุณาเลือกยอมรับเงื่อนไขการทำรายการ");
			 document.getElementById('accept_policy').focus();
			 return valid;
		 }
		 
		 valid=true;
		 <?php if($_REQUEST["deptaccount_flag"]==false){?>
		   valid=false;
		    alert("ท่านต้องเปิดบัญชี เงินฝาก ฉุกเฉิน ATM ก่อนจึงจะสามารถทำรายการ ได้");
		 <?php } ?>
		 return valid;
	 }
	 
	 function printFrame(id) {
		    var is_chrome = ((navigator.userAgent.toLowerCase().indexOf('chrome') > -1) &&(navigator.vendor.toLowerCase().indexOf("google") > -1));
			if(is_chrome==false){
				alert("ระบบรองรับการพิมพ์บน Google Chrome Browser เท่านั้น");
				return false;
			}
			if(confirm("กรุณายืนยันการพิมพ์")){
				var frm = document.getElementById(id).contentWindow;
				frm.focus();// focus on contentWindow is needed on some ie versions
				frm.print();
			}
            return true;
	}
	</script>
	
<br/>