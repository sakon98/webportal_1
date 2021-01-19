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


//	$sql="alter table yrconfirmmaster add (confirm_id varchar2(50) ,confirm_email varchar2(150) ,confirm_date date ,confirm_flag number(1,0) default 0 not null ,confirm_remark varchar2(255) )";
 //   get_single_value_oci($sql,$value1);
	
$target_dir = "uploads/";
	
if(isset($_REQUEST["action"])){
		unlink($_REQUEST["filename"]);
		echo "<script>alert('ลบสำเร็จ File ".$_REQUEST["filename"]." เรียบร้อย');</script>";
}	
	
if(isset($_REQUEST["uploadBtn"])){
	
mkdir($target_dir);
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

	// Check if file already exists
	if (file_exists($target_file)) {
		echo "<script>alert('Upload ไม่สำเร็จพบว่ามี File นี้อยู่แล้ว ".$target_file."');</script>";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
		echo "<script>alert('Upload ไม่สำเร็จ File ".$_FILES["fileToUpload"]["tmp_name"]." มีขนานใหญ่เกิน 500k');</script>";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" 
	&& $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "pdf"&& $imageFileType != "xls"&& $imageFileType != "xlsx" && $imageFileType != "zip") {
		echo "<script>alert('Upload ไม่สำเร็จ File type ไม่ถูกต้อง ".$imageFileType."');</script>";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		//echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "<script>alert('ระบบได้รับการบันทึกเรียบร้อย ". basename( $_FILES["fileToUpload"]["name"]). "');</script>";
		} else {
			echo "<script>alert('ระบบได้รับการบันทึกไม่สำเร็จ ". basename( $_FILES["fileToUpload"]["name"]). "');</script>";
		}
	}
}

	   ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="30%" align="left"><strong><font size="4" face="Tahoma">รายการ เอกสาร/แบบฟอร์ม เพื่อ Download</font></strong><br />
    <font color="#FF6600" size="2" face="Tahoma">Download</font></td>
    <td width="70%" align="right" valign="top">
    <form id="formID1" name="formID1" method="post" action="" enctype="multipart/form-data"
	    onsubmit="return confirm('กรุณายืนยันการทำรายการ')" >
	    เลือก File เพื่อ Upload : 
	   <input type="file" name="fileToUpload" id="fileToUpload">
	  <input type="submit" name="uploadBtn" id="uploadBtn" value="Upload"/>
    </form>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="left"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<br />
<table width="75%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="80%" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">รายการเอกสาร/แบบฟอร์ม</font></strong></td>
        <td width="15%" height="25" align="center" bgcolor="#6699FF"><strong><font color="#FFFFFF">-</font></strong></td>
      </tr>
      <?php
	         $files = array_slice(scandir($target_dir ), 2);
			 sort($files);
			 $i=0;
			 foreach($files as $file){
				 $i++;
		  ?>  
      <tr>
        <td bgcolor="#FFFFFF"><a href="<?=$target_dir?><?=$file?>" target="_blank"><?=$file?></a></td>
        <td align="center" bgcolor="#FFFFFF"><a href="?menu=Download&action=d&filename=<?=$target_dir?><?=$file?>" onclick="return confirm('ยืนยันการลบเอกสาร')" >ลบ</a></td>
      </tr>
      <?php 
			 }
	  ?>   
    </table></td>
  </tr>
</table>