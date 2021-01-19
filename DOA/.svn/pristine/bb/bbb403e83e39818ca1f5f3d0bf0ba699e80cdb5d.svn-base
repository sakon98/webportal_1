<?php
session_start();
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<form id="formID_" name="formID_" method="post" action="" onsubmit="return confirm('กรุณายืนยันทำรายการ ?')" >
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left"><strong><font size="4" face="Tahoma">สิทธิ์ค้ำ </font></strong><br />       
    <font color="#0000FF" size="2" face="Tahoma">Coll Right</font></td>
  </tr>
  <tr>
    <td align="left"><hr color="#999999" size="1"/></td>
  </tr>
</table>
<?php 

$strSQL="select 

			m.birth_date
			,TRUNC(months_between(SYSDATE,m.birth_date)/12) as age_year
			,TRUNC(months_between(SYSDATE,m.birth_date)  - (TRUNC(months_between(SYSDATE,m.birth_date)/12)*12)) as age_month
			,TRUNC((months_between(SYSDATE,m.birth_date) - TRUNC(months_between(SYSDATE,m.birth_date)))*30) as age_day

			,m.member_date
			,TRUNC(months_between(SYSDATE,m.member_date)/12) as member_age_year
			,TRUNC(months_between(SYSDATE,m.member_date)  - (TRUNC(months_between(SYSDATE,m.member_date)/12)*12)) as member_age_month
			,TRUNC((months_between(SYSDATE,m.member_date) - TRUNC(months_between(SYSDATE,m.member_date)))*30) as member_age_day

			,m.retry_date
			,TRUNC(months_between(m.retry_date,SYSDATE)/12) as member_remain_year
			,TRUNC(months_between(m.retry_date,SYSDATE)  - (TRUNC(months_between(m.retry_date,SYSDATE)/12)*12)) as member_remain_month
			,TRUNC((months_between(m.retry_date,SYSDATE) - TRUNC(months_between(m.retry_date,SYSDATE)))*30) as member_remain_day

			,m.work_date
			,TRUNC(months_between(SYSDATE,m.work_date)/12) as work_age_year
			,TRUNC(months_between(SYSDATE,m.work_date)  - (TRUNC(months_between(SYSDATE,m.work_date)/12)*12)) as work_age_month
			,TRUNC((months_between(SYSDATE,m.work_date) - TRUNC(months_between(SYSDATE,m.work_date)))*30) as work_age_day

			,m.salary_amount as  
			,s.sharestk_amt*st.unitshare_value as sharestk_value
			,s.last_period
			,s.periodshare_amt*st.unitshare_value as  periodshare_amt
			,decode(s.payment_status,1,'ส่งหุ้นปกติ','งดส่งหุ้น') as payment_status
			
			,m.MEMBER_TYPE
			,m.MEMBTYPE_CODE
			
			from mbmembmaster m,shsharemaster s ,shsharetype st
			where m.member_no=s.member_no 
			and st.sharetype_code=s.sharetype_code 
			and m.member_no='".$member_no."'  ";
//echo 			$strSQL;
$value = array('BIRTH_DATE','AGE_YEAR','AGE_MONTH','AGE_DAY','MEMBER_DATE','MEMBER_AGE_YEAR','MEMBER_AGE_MONTH','MEMBER_AGE_DAY','RETRY_DATE','MEMBER_REMAIN_YEAR','MEMBER_REMAIN_MONTH','MEMBER_REMAIN_DAY','WORK_DATE','WORK_AGE_YEAR','WORK_AGE_MONTH','WORK_AGE_DAY','SALARY_AMOUNT','SHARESTK_VALUE','LAST_PERIOD','PERIODSHARE_AMT','PAYMENT_STATUS','MEMBER_TYPE','MEMBTYPE_CODE');
list($Num_Rows,$data) = get_value_many_oci($strSQL,$value);

$colltype_code="01";
$colltype_code_name="คนค้ำประกัน";

$i=0;
$birth_date=$data[0][$i++];
$age_year=$data[0][$i++];
$age_month=$data[0][$i++];
$age_day=$data[0][$i++];
$age=$age_year+($age_month/100);

$member_date=$data[0][$i++];
$member_age_year=$data[0][$i++];
$member_age_month=$data[0][$i++];
$member_age_day=$data[0][$i++];
$member_age=$member_age_year+($member_age_month/100);

$retry_date=$data[0][$i++];
$work_age_remain_year=$data[0][$i++];
$work_age_remain_month=$data[0][$i++];
$work_age_remain_day=$data[0][$i++];
$work_age_remain=$work_age_remain_year+($work_age_remain_month/100);

$work_date=$data[0][$i++];
$work_age_year=$data[0][$i++];
$work_age_month=$data[0][$i++];
$work_age_day=$data[0][$i++];
$work_age=$work_age_year+($work_age_month/100);

$salary_amt=$data[0][$i++];

$sharestk_value=$data[0][$i++];
$share_last_period=$data[0][$i++];
$share_cp_last_period=$data[0][$i++];

$share_payment_status=$data[0][$i++];

$MEMBER_TYPE=$data[0][$i++];
$MEMBERTYPE_CODE=$data[0][$i++];

$strSQL=" 
		  SELECT LNGRPMANGRTPERM.MANGRTPERMGRP_CODE,   
                LNGRPMANGRTPERM.MANGRTPERMGRP_DESC,   
                LNGRPMANGRTPERM.MANGRTTIME_TYPE,   
                LNGRPMANGRTPERM.EXPORTRIGTH_FLAG,   
                LNGRPMANGRTPERM.MEMBER_TYPE,   
				member_time, 
				mbtypeperm_flag,
                0.00 as coll_amt  
           FROM LNGRPMANGRTPERM  
           WHERE LNGRPMANGRTPERM.MEMBER_TYPE ='".$MEMBER_TYPE."'
                and MANGRTPERMGRP_CODE not in ('37','38') ";
//echo $strSQL;				
$value = array('MANGRTPERMGRP_CODE','MANGRTPERMGRP_DESC','MANGRTTIME_TYPE','EXPORTRIGTH_FLAG','MEMBER_TIME','MBTYPEPERM_FLAG');
list($Num_Rows,$data) = get_value_many_oci($strSQL,$value);

$i=0;
$MANGRTPERMGRP_CODE=$data[0][$i++];
$MANGRTPERMGRP_DESC=$data[0][$i++];
$MANGRTTIME_TYPE=$data[0][$i++];
$EXPORTRIGTH_FLAG=$data[0][$i++];
$MEMBER_TIME=$data[0][$i++];
$MBTYPEPERM_FLAG=$data[0][$i++];
$li_timechk=0;
//echo "MANGRTPERMGRP_CODE=".$MANGRTPERMGRP_CODE."<br/>";
//echo "MANGRTTIME_TYPE=".$MANGRTTIME_TYPE."<br/>";
if($MANGRTTIME_TYPE==3){
	 $li_timechk=$share_last_period;
	 
}else{
	
	 $li_timechk=($member_age_year*12)+$member_age_month;
}
//echo "li_timechk=".$li_timechk."<br/>";


$strSQL=" select multiple_share, multiple_salary, MAXGRT_AMT 
                        from lngrpmangrtpermdet
                        where mangrtpermgrp_code = '".$MANGRTPERMGRP_CODE."'
                        and ".$li_timechk." between startmember_time and endmember_time ";
						
 if ($MBTYPEPERM_FLAG == 1) {
     $strSQL.=" and membtype_code = '".$MEMBERTYPE_CODE."'";
}						
						
$strSQL.=" order by seq_no ";
//echo $strSQL;				
$value = array('MULTIPLE_SHARE','MULTIPLE_SALARY','MAXGRT_AMT');
list($Num_Rows,$data) = get_value_many_oci($strSQL,$value);

$collmax_amt=0;
$ldc_maxcredit=90000000;



for($j=0;$j<$Num_Rows;$j++){
	
	$i=0;
	$MULTIPLE_SHARE=$data[$j][$i++];
	$MULTIPLE_SALARY=$data[$j][$i++];
	$MAXGRT_AMT=$data[$j][$i++];

	//echo $j."===<br/>";	
	//echo "MULTIPLE_SHARE=".$MULTIPLE_SHARE."<br/>";
	//echo "MULTIPLE_SALARY=".$MULTIPLE_SALARY."<br/>";
	//echo "MAXGRT_AMT=".$MAXGRT_AMT."<br/>";
	
			   $ldc_salary=$salary_amt;
			   $ldc_shramt=$sharestk_value;
			   
               $ldc_mulsal = $MULTIPLE_SALARY;
               $ldc_mulshr = $MULTIPLE_SHARE;
               $ldc_maxstep = $MAXGRT_AMT;

               $ldc_collcredit = ($ldc_salary * $ldc_mulsal) + ($ldc_shramt * $ldc_mulshr);

				//echo "ldc_salary=".$ldc_salary."<br/>";
				//echo "ldc_shramt=".$ldc_shramt."<br/>";
				//echo "ldc_collcredit=(".$ldc_salary." * ".$ldc_mulsal.") + (".$ldc_shramt." * ".$ldc_mulshr.")<br/>";
				//echo "ldc_collcredit=".$ldc_collcredit."<br/>";
	
                if ($ldc_collcredit > $ldc_maxstep)
                {
                    $ldc_collcredit = $ldc_maxstep;
                }

                if ($ldc_collcredit < $ldc_maxcredit)
                {
                    $ldc_maxcredit = $ldc_collcredit;
                }
				//echo "ldc_maxcredit=".$ldc_maxcredit."<br/>";
				
	//echo "===<br/>";	
}

$collmax_amt=$ldc_maxcredit;

$strSQL="SELECT sum( LNCONTCOLL.COLLACTIVE_AMT) as COLLACTIVE_AMT
                                FROM LNCONTCOLL,   
                                     LNCONTMASTER,   
                                     MBMEMBMASTER,   
                                     MBUCFPRENAME,   
                                     LNLOANTYPE  
                               WHERE ( LNCONTMASTER.LOANCONTRACT_NO = LNCONTCOLL.LOANCONTRACT_NO ) and  
                                     ( MBMEMBMASTER.MEMBER_NO = LNCONTMASTER.MEMBER_NO ) and  
                                     ( MBMEMBMASTER.PRENAME_CODE = MBUCFPRENAME.PRENAME_CODE ) and  
                                     ( LNCONTMASTER.LOANTYPE_CODE = LNLOANTYPE.LOANTYPE_CODE ) and  
                                     ( MBMEMBMASTER.COOP_ID = LNCONTMASTER.COOP_ID ) and  
                                     ( LNCONTMASTER.COOP_ID = LNCONTCOLL.COOP_ID ) and  
                                     ( LNCONTMASTER.COOP_ID = LNLOANTYPE.COOP_ID ) and  
                                     ( ( lncontcoll.loancolltype_code = '".$colltype_code."' ) AND  
                                     ( lncontcoll.ref_collno = '".$member_no."') AND  
                                     ( lncontmaster.contract_status > 0 ) AND  
                                     ( lncontcoll.coll_status = 1 ) )   
					";
//echo $strSQL;				
$value = array('COLLACTIVE_AMT');
list($Num_Rows,$data) = get_value_many_oci($strSQL,$value);
$colluse_amt=$data[0][0];

$collbalance_amt=$collmax_amt-$colluse_amt;

?>
<table border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td width="80"  height="35" align="center" bgcolor="#CCCCFF">ประเภทหลักประกัน : </td>
	<td width="150"   bgcolor="#FFFFFF"><?=$colltype_code?>:<?=$colltype_code_name?></td>
	<td width="80"  height="35" align="center" bgcolor="#CCCCFF">วันเกิด: </td>
	<td width="150"  bgcolor="#FFFFFF"><?=ConvertDate($birth_date,"short")?>(<?=$age?>)</td>
	<td width="80"  height="35" align="center" bgcolor="#CCCCFF">วันเกษียน: </td>
	<td width="150"   bgcolor="#FFFFFF"><?=ConvertDate($retry_date,"short")?>(<?=$work_age_remain?>)</td>
  </tr>  
  <tr>
    <td  height="35" align="center" bgcolor="#CCCCFF">วันที่เป็นสมาชิก : </td>
	<td  bgcolor="#FFFFFF"><?=ConvertDate($member_date,"short")?>(<?=$member_age?>)</td>
    <td  height="35" align="center" bgcolor="#CCCCFF">วันที่เข้างาน : </td>
	<td  bgcolor="#FFFFFF"><?=ConvertDate($work_date,"short")?>(<?=$work_age?>)</td>
    <td  height="35" align="center" bgcolor="#CCCCFF">เงินเดือน : </td>
	<td  bgcolor="#FFFFFF"><?=number_format($salary_amt,2)?></td>
  </tr>
  <tr>    
	<td  height="35" align="center" bgcolor="#CCCCFF">ทุนเรื่อนหุ้น : </td>
	<td  bgcolor="#FFFFFF"><?=number_format($sharestk_value,2)?></td>
    <td  height="35" align="center" bgcolor="#CCCCFF">หุ้น/เดือน : </td>
	<td  bgcolor="#FFFFFF"><?=$share_last_period?>/<?=$share_cp_last_period?></td>
    <td  height="35" align="center" bgcolor="#CCCCFF">การส่งหุ้น : </td>
	<td  bgcolor="#FFFFFF"><?=$share_payment_status?></td>
  </tr>
  <tr>
	<td  height="35" align="center" bgcolor="#CCCCFF">สิทธิ์ค้ำสูงสุด : </td>
	<td  bgcolor="red"><?=number_format($collmax_amt,2)?></td>
    <td  height="35" align="center" bgcolor="#CCCCFF">สิทธิ์ค้ำคงเหลือ : </td>
	<td  bgcolor="Lime"><?=number_format($collbalance_amt,2)?></td>
</table>
<br />
</form>
