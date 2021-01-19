<?php
session_start();
header('Content-Type: text/html; charset=tis-620');
	require "../include/conf.conn.php";
	require "../include/conf.c.php";
	$ipconnect = $_SERVER['REMOTE_ADDR'];
	$date_log = date('Y-m-d H:i:s');
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
	<link rel="shortcut icon" href="../img/logo_kls.png">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <script src="../js/jquery.js"></script>
	<script src="../js/index.js"></script>
	<script src="../js/jquery.mobile-1.3.2.min.js"></script>
</head>
<body>
<div data-role="page" class="jqm-demos jqm-demos-home" >
<center>
<div data-role="header">
    <p><?=$title1?></p>
</div>
<?php require "../include/conf.m.php" ?>
<?php if($_REQUEST["usr"] == null or $_REQUEST["pwd"] == null){ ?>
<form name="form" method="post" action="">
    <div style=" height:100%; width:65%" align="center" > 
    <input type="text" name="usr" id="usr" value=""  placeholder="ทะเบียนสมาชิก" autocomplete="off" >
    <input type="password" name="pwd" id="pwd" value="" placeholder="รหัสผ่าน" autocomplete="off"> 
   <input value="เข้าสู่ระบบ" data-iconpos="right" data-theme="b" type="submit">
    </div>
</form>
<?php }else{ 
	require "../include/lib.Etc.php";
	require "../include/lib.MySql.php";
	require "../include/lib.Oracle.php";
	require "../lib/login.php";
	 }
 ?>
    
    <div data-role="footer" class="jqm-footer">
		<p><?=$credite?></p>
	</div><!-- /footer -->
</center>
</div>
</body>
</html>
