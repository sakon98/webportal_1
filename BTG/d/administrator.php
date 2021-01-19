<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
$ses_userid =$_SESSION['ses_userid'];
$member_no = $_SESSION['ses_member_no'];
if($ses_userid <> session_id() or $member_no ==""){
	header("Location: index.php");
}
	require "../include/conf.conn.php";
	require "../include/conf.c.php";
	require "../include/lib.Etc.php";
	require "../include/lib.Oracle.php";
	require "../include/lib.MySql.php";
	$ipconnect = $_SERVER['REMOTE_ADDR'];
	$date_log = date('Y-m-d H:i:s');
	$connectby = "desktop";
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$title?></title>
	<link rel="shortcut icon" href="../img/logo.png">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <?php require "../include/conf.d.php" ?>
</head>
<body>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top" bgcolor="#333333">
    <table width="995" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" style="width: 1050px; height: 100px;">
      <tr>
        <td height="110" colspan="3" background="../img/head_info_bg.png"> <table width="1060" border="0" cellspacing="3" cellpadding="0" style="height: 120px;">
          <tr>
            <td width="107" height="105" align="right"><img src="../img/logo.png" width="100" height="100"></td>
            <td width="919"><table width="100%" border="0" cellspacing="5" cellpadding="0">
              <tr>
                <td><font face='Tahoma' size="5" color="#FFFFFF"><strong>
                  <?=$title?>
                  </strong></font><br/>
                  <font face='Tahoma' size="2" color="#FFFFFF">
                    <?='ผู้ดูแลระบบ'?>
                  </font></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
        </tr>
      <!--<tr bgcolor="#666666">
        <td height="20" colspan="2" valign="top">&nbsp;</td>
        </tr>-->
      <tr>
        <td width="155" valign="top"><?php require "../lib/a.menu.php" ?></td>
        <td width="797" height="400" valign="top">
        <span class="class2">
        <table width="100%" border="0" cellspacing="1" cellpadding="6">
          <tr>
            <td>
			<?php
				if($_REQUEST["menu"] == ""){
					if($connection != 1){
					require "../lib/a.Status.php";	
					}else{ 
						echo "<script>window.location = 'administrator.php?menu=News_editer'</script>"; 
					}
				}else if($_REQUEST["menu"] == "News_editer"){
					require "../lib/a.News.php";
				}else if($_REQUEST["menu"] == "Management_Member" and $connection != 1){
					require "../lib/a.Management_Member.php";
				}else if($_REQUEST["menu"] == "Management_Staff" and $connection != 1){
					require "../lib/a.Management_Staff.php";
				}else if($_REQUEST["menu"] == "EmailNews" and $connection != 1){
					require "../lib/a.emailnews.php";
				}else if($_REQUEST["menu"] == "EmailMemberNo" and $connection != 1){
					require "../lib/a.emailmemberno.php";
				}else if($_REQUEST["menu"] == "EmailConfirm" and $connection != 1){
					require "../lib/a.emailconfirm.php";
				}else if($_REQUEST["menu"] == "EmailDeptDue" and $connection != 1){
					require "../lib/a.emaildeptdue.php";
				}else if($_REQUEST["menu"] == "EmailLoanPay" and $connection != 1){
					require "../lib/a.emailloanpay.php";
				}else if($_REQUEST["menu"] == "EmailLoanColl" and $connection != 1){
					require "../lib/a.emailloancoll.php";
				}else if($_REQUEST["menu"] == "EmailLoanCollResign" and $connection != 1){
					require "../lib/a.emailloancollresign.php";
				}else if($_REQUEST["menu"] == "Reports" and $connection != 1){
					require "../lib/a.Reports.php";

				}else if($_REQUEST["menu"] == "LoanRequest"){
					require "../lib/a.loanrequest.php";
				}else if($_REQUEST["menu"] == "Upload_File"){
					require "../lib/a.Upload_File.php";
				}else if($_REQUEST["menu"] == "Delete_File"){
					require "../lib/a.Delete_File.php";
				}/*else if($_REQUEST["menu"] == "ConfirmReport" and $connection != 0){
					require "../d/confirmframe.html";
				}*/else if($_REQUEST["menu"] == "Change_Pwd"){
					require "../lib/a.Change_Pwd.php";
				}else if($_REQUEST["menu"] == "Configuration"){
					require "../lib/a.Configuration.php";

				}else if($_REQUEST["menu"] == "Management_Member_Log_Reset_Password"){
					require "../lib/a.Management_Member_Log_Reset_Password.php";
				
				}else if($_REQUEST["menu"] == "SigeOut"){

					unset ( $_SESSION['ses_userid'] );
					unset ( $_SESSION['ses_member_no'] );
					session_destroy(); 
					oci_close($objConnect);
					echo "<script>window.location = 'index.php'</script>";
				}
				?>
                </td>
          </tr>
        </table
        ></span>
        </td>
        <td width="108" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td height="80" colspan="2" align="center" background="../img/footer_info_bg.png">
  <font size="3" color="#FFFFFF"><br>
  <strong><?=$title?></strong></font><br/>
  <font size="2" color="#FFFFFF">
  <?=$address?><br/><span class="class1"><?=$credite?></span></font></td>
        <td height="80" align="center" background="../img/footer_info_bg.png"><table width="108" border="0">
          <tr>
            <td></td>
          </tr>
          <tr>
            <td><font size ="3" color="#FFFFFF">Hot Link</font></td>
          </tr>
          <tr>
            <td><a href = "slide.pdf" target = "new"> <font size ="2" color="#FFFFFF">แผ่นประชาสัมพันธ์</font></a></td>
          </tr>
          <tr>
            <td><a href="http://public.betagro.com/SitePages/Home.aspx?RootFolder=%2FShared%20Documents%2F%E0%B8%AA%E0%B8%AB%E0%B8%81%E0%B8%A3%E0%B8%93%E0%B9%8C&FolderCTID=0x0120009CB9B0152C683B4CB4A16982D8D712ED&View=%7B399485A0-7795-474C-80BE-A104091E808B%7D" target="new"><font size="2" color="#FFFFFF">ดาวน์โหลดเอกสาร</a></font></td>
          </tr>
          <tr>
            <td><a href="https://docs.google.com/document/d/1HRjNYLuq7GZ-VHRrQHYmey0jKUDekNmuzNxL2sU-ua0/edit" target="new"><font size="2" color="#FFFFFF">คู่มือการใช้งาน</a></font></td>
          </tr>
          <tr>
            <td><a href="mailto:coop@betagro.com" target="new"><font size="2" color="#FFFFFF">Contact Us </a></font></td>
          </tr>
        </table></td>
        </tr>
    </table></td>
  </tr>
</table>

</body>
</html>