<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
/*

1. ส่วนใหญ๋จะต้องตรวจสอบจาก table lnloantypecustom
2. ข้อมูลที่ต้องเตรียมไว้สำหรับตรวจสอบ
 - งวดหุ้น
 - ทุนเรือนหุ้น
 - เงินดือน
3. เอาข้อมูลทั้ง 3 ไปค้นหาว่าสิทธิอยู่ในช่วงไหน
- เงินเดือน between startsalary_amt and endsalary_amt
- หุ้น between startshare_amt and endshare_amt
- งวดหุ้น between startmember_time and endmember_time
4. เมื่อได้ว่าอยู่ในช่วงไหน ก็นำค่าจำนวนเท่าของหุ้นและเงินเดือน มาคำนวณ
5. กรณีมีช่วงสิทธิมากกว่า 1 แถว ให้คำนวณทังหมดแล้วเอาสิทธ์ที่น้อยที่สุด

*/
$strSQL = "select 
					m.member_no
					,lt.loantype_desc
					,s.sharestk_amt*sh.unitshare_value*l.percentshare  as credit_share_amt
					,nvl(m.salary_amount,15000)*l.percentsalary  as credit_salary_amt
					,(s.sharestk_amt*sh.unitshare_value*l.percentshare ) + (nvl(m.salary_amount,15000)*l.percentsalary ) as credit_amt
					,s.sharestk_amt
					,sh.unitshare_value
					,l.percentshare
					,l.percentsalary
					,s.last_period
					,m.salary_amount
				from lnloantypecustom l ,mbmembmaster m ,shsharemaster s,shsharetype sh,lnloantype lt
				where m.member_no='$member_no'  
					and s.SHAREMASTER_STATUS = '1' 
					and LT.LOANGROUP_CODE in ( '01','02' )
					and l.loantype_code = lt.loantype_code
					and s.member_no=m.member_no 
					and s.sharestk_amt*sh.unitshare_value between l.startshare_amt and l.endshare_amt 
					and s.last_period between l.startage_amt and l.endage_amt 
					and nvl(m.salary_amount,15000) between l.startsalary_amt and l.endsalary_amt 
				order by l.loantype_code asc ";
$value = array('LOANTYPE_DESC','CREDIT_AMT'); 
list($Num_Rows,$list_info) = get_value_many_oci($strSQL,$value);
if($Num_Rows == 0){
	echo '<script type="text/javascript"> window.alert("ไม่พบรายการบัญชีหุ้นของท่าน") </script> ';
	echo "<script>window.location = 'info.php'</script>";
	exit;
}

?>

