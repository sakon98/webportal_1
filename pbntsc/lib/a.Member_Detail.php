<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.3.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
</head>
<body>
<?php
	session_start();
	$ses_userid =$_SESSION['ses_userid'];
	$member_no = $_SESSION['ses_member_no'];
	require "../include/conf.conn.php";
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
}

$strMySQL = "SELECT mm.member_no,mm.memb_fullname,mm.idcard,mm.email,mm.mobile,mm.date_reg,mc.member_password FROM mbmembmaster mm LEFT JOIN memberclare mc on mm.member_no=mc.member_no ORDER BY mm.date_reg DESC";
$colunmMySQL = array('member_no','memb_fullname','idcard','email','mobile','date_reg','member_password');
list($rowSQL,$listMySql) = get_value_many_sql($strMySQL,$colunmMySQL);
$ms = 0;
for($sq = 0 ; $sq < $rowSQL ; $sq++){
    
	$_member_no[$sq] = $listMySql[$sq][$ms++]; 
	$_memb_fullname[$sq] = $listMySql[$sq][$ms++]; 
	$_idcard[$sq] = $listMySql[$sq][$ms++]; 
	$_email[$sq] = $listMySql[$sq][$ms++]; 
	$_mobile[$sq] = $listMySql[$sq][$ms++]; 
	$_date_reg[$sq] = $listMySql[$sq][$ms++]; 
	$_member_password[$sq] = $listMySql[$sq][$ms++]; 
	$ms = 0;
	
	$strSQL2 = " SELECT MBUCFMEMBGROUP.MEMBGROUP_CODE || ' - ' || MBUCFMEMBGROUP.MEMBGROUP_DESC as  MEMBGROUP_DESC
					FROM 
						MBMEMBMASTER  , MBUCFMEMBGROUP
					WHERE
						MEMBER_NO = '$_member_no[$sq]'  and MBMEMBMASTER.MEMBGROUP_CODE = MBUCFMEMBGROUP.MEMBGROUP_CODE";
						$value2 = array('MEMBGROUP_DESC');
						list($Num_Rows2,$list_wf) = get_value_many_oci($strSQL2,$value2);
						$membgroup[$sq] = $list_wf[0][0];
	
	}
        
        $strMySQL1 = "SELECT COUNT(DISTINCT member_no) AS sum_member  FROM mbmembmaster";
        $valueSQL1 = "sum_member";
        $sum_member1 = get_single_value_sql($strMySQL1,$valueSQL1);

?>
<div class="container">
<h3>แสดงรายชื่อสมาชิกทั้งหมด สหกรณ์ออมทรัพย์ครูเพชรบูรณ์ จำกัด</h3>
<h4>สมาชิกทั้งหมด <?=$sum_member1?> คน</h4>
<table id="tbAll" class="table table-striped table-bordered" cellspacing="0" width="100%">
	 <thead>
		  <tr>
			<td width="7%" align="center" >ลำดับ</td>
			<td width="9%" align="center" >เลขทะเบียนสมาชิก</td>
			<td width="9%" align="center" >เลขบัตรประชาชน</td>
			<td width="18%" align="center" >ชื่อ - นามสกุล</td>
			<td width="10%" align="center" >รหัสผ่าน</td>
			<td width="10%" align="center" >เบอร์โทร</td>
			<td width="11%" align="center" >วันที่ลงทะเบียน</td>
			<td width="14%" align="center" >สังกัด</td>
		  </tr>
	</thead>
	<tbody>
	 <?php   for($sq = 0 ; $sq < $rowSQL ; $sq++){    ?>
		  <tr>
			<td align="center" ><?=$sq+1?></td>
			<td align="center"><?=$_member_no[$sq]?></td>
			<td align="center"><?=$_idcard[$sq]?></td>
			<td ><?=$_memb_fullname[$sq]?></td>
			<td ><?php if($_member_password[$sq]==""){echo "ถูกเข้ารหัส";}else{echo $_member_password[$sq]; }?></td>
			<td><?=$_mobile[$sq]?></td>
			<td align="center"><?=$_date_reg[$sq];?></td>
			<td align="left"><?=$membgroup[$sq];?></td>
		  </tr>
	<?php } ?>
	</tbody>
  </table>
  <script type="text/javascript">
	  $(document).ready(function() {
			$('#tbAll').DataTable();
		} );
  </script>
</div>
</body>
</html>

 