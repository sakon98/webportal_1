<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
require "../include/conf.conn.php";
require "../include/conf.c.php";
$connectby = "mobile";

//http://web.coopsiam.com:8080/GSB/w/info.php?menu=Member_info
//http://web.coopsiam.com:8080/GSB/w/info.php?menu=Share
//http://web.coopsiam.com:8080/GSB/w/info.php?menu=Deposit
//http://web.coopsiam.com:8080/GSB/w/info.php?menu=Loan
//http://web.coopsiam.com:8080/GSB/w/info.php?menu=Payment_Show
//http://web.coopsiam.com:8080/GSB/w/info.php?menu=Payment
//http://web.coopsiam.com:8080/GSB/w/index.php
//http://web.coopsiam.com:8080/GSB/w/info.php?menu=SigeOut

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$title?></title>
	<link rel="stylesheet"  href="../css/jquery.mobile-1.3.2.min.css">
	<link rel="stylesheet" href="../css/jqm-demos.css">
	<link rel="shortcut icon" href="../img/ic_launcher.png">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <script src="../js/jquery.js"></script>
	<script src="../js/index.js"></script>
	<script src="../js/jquery.mobile-1.3.2.min.js"></script>
</head>
<body>
<?php require "../include/conf.d.php" ?>
<?php
if((isset($_SESSION['ses_userid'])&&isset($_SESSION['ses_member_no']))==false){

 if($_REQUEST["usr"] == null or $_REQUEST["pwd"] == null){ ?>
<div data-role="content" align="center">
					   <br/>
					   
						  <ul data-role="listview" data-ajax="false" data-inset="false" data-theme="e">
						  <li><a><?=$sub_title?></a></li>
						  </ul>
						<br/>  
						<br/>  
						<img src="../img/ic_launcher.png" width="150" />
						<br/>
					
						<div id="login_from">	
					   <form name="form" method="post" action="">
						<input type="text" name="usr" id="usr" value=""  placeholder="ทะเบียนสมาชิก" autocomplete="off" >
						<input type="password" name="pwd" id="pwd" value="" placeholder="รหัสผ่าน" autocomplete="off"> 
					    <input  id="login" name="login"  value="เข้าสู่ระบบ" data-iconpos="right" data-theme="b" type="submit"><br/>
				        </form>
						<div>				   
					   <center><img src="../img/qrcode_mhs.png" width="100" /> </center>
					   <br/>
					    <input  id="register" name="register"  value="สมัครใช้บริการ" data-iconpos="right" data-theme="c" type="button" onclick="window.location='register.php';">
					    <!--<a href="http://line.me/ti/p/~@cuc7485b"  target="_blank">Line ID @cuc7485b </a>-->
						<div class="line-it-button" data-lang="th" data-type="friend" data-lineid="@cuc7485b" data-count="true" data-home="true" style="display: ;"></div>
						<script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script>Line ID @cuc7485b
                       <div data-role="footer" class="jqm-footer">
					   <p><?=$credite?></p>	
					   </div>
					   
</div>
<?php 

}else{

  
	require "../include/lib.Etc.php";
	require "../include/lib.MySql.php";
	require "../include/lib.Oracle.php";
	require "../lib/w.login.php";
	
	 }
	 
 }else{
	 
	require "../w/menu.php";
	
	 } 
?>
</body>
</html>
