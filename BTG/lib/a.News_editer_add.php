<?php
	session_start();
	@header('Content-Type: text/html; charset=tis-620');
	$ses_userid =$_SESSION['ses_userid'];
	$member_no = $_SESSION['ses_member_no'];
	require "../include/conf.conn.php";
	require "../include/conf.c.php";
	require "../include/lib.Etc.php";
	require "../include/lib.Oracle.php";
	require "../include/lib.MySql.php";
	$ipconnect = $_SERVER['REMOTE_ADDR'];
	$date_log = date('Y-m-d H:i:s');
	$connectby = "desktop";
	
	if(get_type($member_no) == "member"){
		header("Location: index.php");
	};
	
	if($ses_userid <> session_id() or $member_no ==""){
	header("Location: index.php");
	
	if($_POST["topic"] == null or $_POST["details"] == null){
		echo "<script type='text/javascript'> window.close(); </script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$title?></title>
	<link rel="shortcut icon" href="../img/logo_.png">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
       <link rel="stylesheet" href="../css/validationEngine.jquery.css" type="text/css">
	<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />	
    <script src="../js/jquery-1.6.min.js" type="text/javascript"></script>
	<script src="../js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="tis-620"></script>
	<script src="../js/jquery.validationEngine.js" type="text/javascript" charset="tis-620"></script>
    <?php require "../include/conf.d.php" ?>
    <script langauge="javascript">
    function checkconfirmclosewindow(){ if(true){	window.close();	}}
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
	jQuery(document).ready(function(){
		jQuery("#formID2").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});
	});
	</script>
    <style type="text/css">
        @page 
        {
            size: auto;   /* auto is the current printer page size */
            margin: 3mm;  /* this affects the margin in the printer settings */
        }
        body 
        {
            background-color:#FFFFFF; 
            border: solid 0px black ;
            margin: 0.2px;  /* the margin on the content before printing */
       }
		body,td,th {
			font-family: Tahoma, Geneva, sans-serif;
			font-size: 12px;
			color: #000;
		}

</style>
</head>

<body>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td align="right">
    <form id="form3" name="form1" method="post" action="">
      <input name="aa2" type="submit" id="aa3" value="ปิด"  onclick="checkconfirmclosewindow()" />
    </form>
    </td>
  </tr>
</table>
<?php if($_POST["ref"] == null){	?>
<form id="formID2" name="formID2" method="post" action="">
  <table width="95%" border="0" align="center" cellpadding="6" cellspacing="6">
    <tr>
      <td height="22" bgcolor="#FFCC33"><strong>หัวเรื่อง</strong></td>
    </tr>
    <tr>
      <td>
        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><label for="topic"></label>
            <textarea name="topic" readonly  class="validate[required]" id="topic" style="width:98%; border:0"><?= $_POST["topic"] ?></textarea></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="22" bgcolor="#FFCC33"><strong>รายละเอียด</strong></td>
    </tr>
    <tr>
      <td>
        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><textarea name="details" rows="10" readonly class="validate[required]" id="details" style="width:98%; border:0"><?= $_POST["details"] ?></textarea></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td><input name="status" type="checkbox" class="validate[required]" id="status" value="1">
        ลงประกาศทันที 
          <input type="submit" name="button" id="button" value="ตกลง">
        <input name="ref" type="hidden" id="ref" value="1"></td>
    </tr>
  </table>
</form>
<?php }	?>
</body>
</html>
<?php
if($_POST["ref"] != null){	
	$table = "news";
	$condition = "(n_topic,n_details,n_date,n_status,who_post)";
	$value  = "('".$_POST["topic"]."','".addslashes($_POST["details"])."','".$date_log."','".$_POST["status"]."','".$member_no."')";
	$status = insert_value_sql($table,$condition,$value);
	if($status){
		$action_page = 'News';
		$action_id = get_single_value_sql("select ID AS ID from news order by id desc limit 1 ","ID");
		$table = "log_action";
		$condition = "(action_do,action_desc,action_id,user,ipconnect,date_log,connectby)";
		$value  = "('".$action_page."','Add','".$action_id."','".$member_no."','".$ipconnect."','".$date_log."','".$connectby."')";
		$status = insert_value_sql($table,$condition,$value);
		if($status){
			echo '<script type="text/javascript"> window.alert("ระบบได้บันทึกประกาศและแสดงหน้าบริการสมาชิกเรียบร้อยแล้ว") </script> ';
			echo "<script type='text/javascript'> window.close(); </script>";
			exit();
		}else{
			echo $status;
			echo '<script type="text/javascript"> window.alert("เกิดข้อผิดพลาด !!! กรุณาเข้าใหม่อีกครั้ง") </script> ';
			echo "<script>window.location = 'index.php'</script>";
		}			
	}else{
		echo '<script type="text/javascript"> window.alert("ไม่สามารถบันทึกได้กรุณาติดต่อ โปรแกรมเมอร์เพื่อแก้ไข") </script> ';
		echo "<script type='text/javascript'> window.close(); </script>";
		exit();
	}
}
?>
