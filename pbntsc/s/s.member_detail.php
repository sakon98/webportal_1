<?php
header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php

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
	}
	echo $rowSQL;
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" type="text/css">
<table id="tbAll" class="table table-striped table-bordered" cellspacing="0" width="100%">
	 <thead>
		  <tr>
			<td width="189" height="25" align="center" bgcolor="#ab25dd"><strong><font color="#FFFFFF">ลำดับ</font></strong></td>
			<td width="191" align="center" bgcolor="#ab25dd"><strong><font color="#FFFFFF">เลขทะเบียนสมาชิก</font></strong></td>
			<td width="149" align="center" bgcolor="#ab25dd"><strong><font color="#FFFFFF">เลขบัตรประชาชน</font></strong></td>
			<td width="142" align="center" bgcolor="#ab25dd"><strong><font color="#FFFFFF">ชื่อ - นามสกุล</font></strong></td>
			<td width="189" height="25" align="center" bgcolor="#ab25dd"><strong><font color="#FFFFFF">รหัสผ่าน</font></strong></td>
			<td width="191" align="center" bgcolor="#ab25dd"><strong><font color="#FFFFFF">ดำเนินการ</font></strong></td>
			<td width="149" align="center" bgcolor="#ab25dd"><strong><font color="#FFFFFF">IP Address</font></strong></td>
			<td width="142" align="center" bgcolor="#ab25dd"><strong><font color="#FFFFFF">อุปกรณ์เชื่อมต่อ</font></strong></td>
		  </tr>
	</thead>
	<tbody>
	 <?php   for($sq = 0 ; $sq < $rowSQL ; $sq++){    ?>
		  <tr>
			<td height="25" align="center" bgcolor="#FFFFFF"><?=$sq+1?></td>
			<td align="center" bgcolor="#FFFFFF"><?=$_member_no[$sq]?></td>
			<td align="center" bgcolor="#FFFFFF"><?=$_idcard[$sq]?></td>
			<td align="center" bgcolor="#FFFFFF"><?=$_memb_fullname[$sq]?></td>
			<td align="center" bgcolor="#FFFFFF"><?php if($_member_password[$sq]==""){echo "ถูกเข้ารหัส";}else{echo $_member_password[$sq]; }?></td>
			<td align="center" bgcolor="#FFFFFF"><?=$_email[$sq]?></td>
			<td align="center" bgcolor="#FFFFFF"><?=$_mobile[$sq]?></td>
			<td align="center" bgcolor="#FFFFFF"><?=$_date_reg[$sq]?></td>
		  </tr>
	<?php } ?>
	</tbody>
  </table>
  <script type="text/javascript">
	  $(document).ready(function() {
			$('#tbAll').DataTable();
		} );
  </script>

	
