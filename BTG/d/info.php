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
    <td align="center" valign="top" background="../img/bg_gsb.jpg">
    <table width="1009" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" style="width: 1050px; height: 100px;">
      <tr>
        <td height="110" colspan="3" background="../img/head_info_bg.png">
        <table width="1051" border="0" cellspacing="3" cellpadding="0" style="height: 120px;">
          <tr>
            <td width="140" height="105" align="right"><img src="../img/logo.png" width="100" height="100"></td>
            <td width="902"><table width="100%" border="0" cellspacing="5" cellpadding="0">
              <tr>
                <td><font face='Tahoma' size="5" color="#FFFFFF"><strong>
                  <?=$title?>
                  </strong></font><br/>
                  <font face='Tahoma' size="2" color="#FFFFFF">
                    <?=$sub_title?>
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
        <td height="20" colspan="2" align="right" valign="top">&nbsp;</td>
        </tr>-->
      <tr>
        <td width="152" valign="top"><?php require "../lib/menu.php" ?></td>
        <td width="749" height="400" valign="top">
        <span class="class2">
        <table width="100%" border="0" cellspacing="1" cellpadding="6">
          <tr>
            <td>
			<?php
			
			 $servername = "localhost";
                        $username = "root";
                        $password = "WebServer";
                        $dbname = "iscobtgdata";

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        $sql = "SELECT temporary_password FROM mbmembmaster where member_no = '$_SESSION[ses_member_no]'";
                        $result = $conn->query($sql);

                        while($row = $result->fetch_assoc()) {
                           $temporary_password = $row["temporary_password"];
                        
                        if($temporary_password != 1){
			
				if($_REQUEST["menu"] == ""){
					 require "../lib/d.news.php";
				}else if($_REQUEST["menu"] == "Beneficiary"){
					require "../lib/d.member_info.php";
					require "../lib/d.Beneficiary.php";
					//require "../d/closed.php";
				}else if($_REQUEST["menu"] == "Share"){
					require "../lib/d.member_info.php";
					require "../lib/d.share.php";
					//require "../d/closed.php";
				}else if($_REQUEST["menu"] == "Deposit"){
					require "../lib/d.member_info.php";
					require "../lib/d.deposit.php";
					//require "../d/closed.php";
				}else if($_REQUEST["menu"] == "Loan"){
					require "../lib/d.member_info.php";
					require "../lib/d.loan.php";
					//require "../d/closed.php";
				}else if($_REQUEST["menu"] == "Ref_collno"){
					require "../lib/d.member_info.php";
					require "../lib/d.ref_collno.php";
					//require "../d/closed.php";
				}else if($_REQUEST["menu"] == "LoanRequest"){
					require "../lib/d.member_info.php";
					require "../lib/d.loanrequest.php";
					//require "../d/closed.php";
				}else if($_REQUEST["menu"] == "Confirm"){
					require "../lib/d.member_info.php";
					require "../lib/d.confirm.php";
					//require "../d/closed.php";
				}else if($_REQUEST["menu"] == "Payment"){
					require "../lib/d.member_info.php";
					require "../lib/d.payment.php";
					//require "../d/closed.php";
				}else if($_REQUEST["menu"] == "Dividend"){
					require "../lib/d.member_info.php";
					require "../lib/d.dividend.php";
					//require "../d/closed.php";
				}else if($_REQUEST["menu"] == "Order"){
					require "../lib/d.member_info.php";
					require "../lib/d.order.php";
					//require "../d/closed.php";
				}else if($_REQUEST["menu"] == "Overall_Result"){
					require "../lib/d.member_info.php";
					require "../lib/d.overall_result.php";
					//require "../d/closed.php";
				}else if($_REQUEST["menu"] == "Report_Consult"){
					require "../lib/d.member_info.php";
					require "../lib/d.report_consult.php";
					//require "../d/closed.php";
				}else if($_REQUEST["menu"] == "Standard_Result"){
					require "../lib/d.member_info.php";
					require "../lib/d.standard_result.php";
					//require "../d/closed.php";
				}else if($_REQUEST["menu"] == "ServiceCoop"){
					require "../lib/d.member_info.php";
					require "../lib/d.servicecoop.php";
					//require "../d/closed.php";
				}else if($_REQUEST["menu"] == "Download"){
					require "../lib/d.member_info.php";
					require "../lib/d.loadfile.php";
					//require "../d/closed.php";
				}else if($_REQUEST["menu"] == "WF"){
					require "../lib/d.member_wf.php";
				}else if($_REQUEST["menu"] == "Change_Pwd" and $connection != 1){
					require "../lib/d.Change_Pwd.php";
				}else if($_REQUEST["menu"] == "SigeOut"){


						$ipconnect = $_SERVER['REMOTE_ADDR'];
						$date_log = date('Y-m-d H:i:s');
						//$os = php_uname('n');
			              $os = "";
                        $table = "log_action";
						$condition = "(action_do,user,ipconnect,date_log,connectby,system_os)";
						$value  = "('SigeOut','".$_SESSION['ses_member_no']."','".$ipconnect."','".$date_log."','".$connectby."','".$os."')";
						$status = insert_value_sql($table,$condition,$value);


					unset ( $_SESSION['ses_userid'] );
					unset ( $_SESSION['ses_member_no'] );
					session_destroy(); 
					oci_close($objConnect);
					echo "<script>window.location = 'index.php'</script>";
				}
				
				 }else{
                            
                            if(($_REQUEST["menu"] == "Member_info" or $_REQUEST["menu"] == "Change_Pwd") and $connection != 1){
					require "../lib/d.Change_Pwd.php";
			    }else if($_REQUEST["menu"] == "SigeOut"){

						$ipconnect = $_SERVER['REMOTE_ADDR'];
						$date_log = date('Y-m-d H:i:s');
                        $table = "log_action";
						$condition = "(action_do,user,ipconnect,date_log,connectby)";
						$value  = "('SigeOut','".$_SESSION['ses_member_no']."','".$ipconnect."','".$date_log."','".$connectby."')";
						$status = insert_value_sql($table,$condition,$value);

					unset ( $_SESSION['ses_userid'] );
					unset ( $_SESSION['ses_member_no'] );
					session_destroy(); 
					oci_close($objConnect);
					echo "<script>window.location = 'index.php'</script>";
				}
                            
                        }
                    }
				
				?>
                </td>
          </tr>
        </table>
        </span>
        </td>
        <td width="150" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td height="80" colspan="2" align="center" background="../img/footer_info_bg.png">
  <font size="3" color="#FFFFFF"><br>
  <strong><?=$title?></strong>
    
   
  </font><br/>
  <font size="2" color="#FFFFFF">
  <?=$address?><br/><span class="class1"><?=$credite?></span></font></td>
        <td height="80" align="center" background="../img/footer_info_bg.png"><table width="150" border="0">
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
