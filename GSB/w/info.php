<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');

if(isset($_SESSION['ses_userid'])==false ||isset($_SESSION['ses_member_no'])==false){

$filename='access.txt';
$fp = fopen($filename,'r');
$length=filesize($filename);

if($length >0){

$member_no = fread($fp, $length);
fclose($fp);
if( $member_no !=""){
 //$member_no = $_SESSION['ses_member_no'];
 $_SESSION['ses_member_no']= $member_no;
 $_SESSION['ses_userid']  = session_id(); 
}

}
}

if(isset($_SESSION['ses_userid'])&&isset($_SESSION['ses_member_no'])){

$ses_userid =$_SESSION['ses_userid'];
$member_no = $_SESSION['ses_member_no'];

}

if( isset($ses_userid) ==false or  $ses_userid <> session_id() or $member_no ==""){
	//header("Location: index.php");
	
	echo "<br/><br/><br/><br/><br/><br/><br/><br/><div align=\"center\"><img src=\"../img/find.png\"/><br/><font color=red><b>กรุณาเข้าสู่ระบบก่อน<b/></font></div>";
	
}else{
	require "../include/conf.conn.php";
	require "../include/conf.c.php";
	require "../include/lib.Etc.php";
	require "../include/lib.Oracle.php";
	require "../include/lib.MySql.php";
	$ipconnect = $_SERVER['REMOTE_ADDR'];
	$date_log = date('Y-m-d H:i:s');
	//$connectby = "desktop";
	$connectby = "mobile";
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$title?></title>
	<link rel="stylesheet"  href="../css/jquery.mobile-1.3.2.min.css">
	<link rel="stylesheet" href="../css/jqm-demos.css">
	<link rel="shortcut icon" href="../img/logo_.png">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <script src="../js/jquery.js"></script>
	<script src="../js/index.js"></script>
	<script src="../js/jquery.mobile-1.3.2.min.js"></script>
    <?php require "../include/conf.d.php" ?>
</head>
<body>

				<script type="text/javascript"> 
				function redirect(uri) {
					if (((navigator.userAgent.toLowerCase().indexOf('mozilla/5.0') > -1 && navigator.userAgent.toLowerCase().indexOf('android ') > -1 && navigator.userAgent.toLowerCase().indexOf('applewebkit') > -1) && !(navigator.userAgent.toLowerCase().indexOf('chrome') > -1))) {
						  window.history.replaceState({}, document.title, uri);
					  } else {
						  location.replace(uri);
					  }
				}
				
				</script>
				
<center><div ><a href="index.php" data-role="button" data-corners="false"  data-icon="arrow-l" data-theme="f">เมนูหลัก </a></div></center>
			<?php
				if($_REQUEST["menu"] == "Member_info"){
					require "../lib/m.member_info.php";
				}else if($_REQUEST["menu"] == "Share"){
					require "../lib/m.share.php";
					//require "../d/closed.php";
				}else if($_REQUEST["menu"] == "Deposit"){
					require "../lib/m.deposit.php";
					//require "../d/closed.php";
				}else if($_REQUEST["menu"] == "Loan"){
					require "../lib/m.loan.php";
					//require "../d/closed.php";
				}else if($_REQUEST["menu"] == "Credit"){
					require "../lib/m.credit.php";
					//require "../d/closed.php";
				}else if($_REQUEST["menu"] == "Ref_collno"){
					require "../lib/m.ref_collno.php";
					//require "../d/closed.php";
				}else if($_REQUEST["menu"] == "Payment_Show"){
					require "../lib/m.payment1.php";
					//require "../d/closed.php";
				}else if($_REQUEST["menu"] == "Payment"){
					require "../lib/m.payment.php";
					//require "../d/closed.php";
				}else if($_REQUEST["menu"] == "Dividend"){
					require "../lib/m.dividend.php";
					//require "../d/closed.php";
				}else if($_REQUEST["menu"] == "WF"){
					require "../lib/d.member_wf.php";
				}else if($_REQUEST["menu"] == "Change_Pwd" and $connection != 1){
					require "../lib/m.Change_Pwd.php";
				}else if($_REQUEST["menu"] == "SigeOut"){
					unset ( $_SESSION['ses_userid'] );
					unset ( $_SESSION['ses_member_no'] );
					session_destroy(); 
					oci_close($objConnect);
					
					$strFileName = "access.txt";
					$objFopen = fopen($strFileName, 'w');
					fwrite($objFopen,"");
					fclose($objFopen);
					?>
				   <br/><br/><br/><br/><br/><br/><br/><br/>
				   <div align="center"><img src="../img/find.png">
				   <br/><font color=red><b>ออกจากระบบเรียบร้อย<b/></font>
				   </div>
					<center><div >
					<a href="index.php" data-role="button" data-corners="false"  data-icon="arrow-l" data-theme="f">เข้าสู่ระบบ</a>
					</div></center>
					<?php
				}
				?>
</body>
</html>
<?php
  }
 
 
?>
