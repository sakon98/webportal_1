<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
	$strSQL = "select 
						replace(fd.slipitem_desc,'ทุนจัดสวัสดิการสมาชิก','สวัสดิการ') as slipitem_desc,
						to_char(DECODE(fd.itempayamt_net,0,null,fd.itempayamt_net),'99G999G999G999D00') as itempayamt_net,
						TO_CHAR(f.operate_date, 'DD/MM/YYYY','NLS_CALENDAR=''THAI BUDDHA')  as operate_date,
						f.member_no from finslipdet fd,finslip f where 
						f.member_no='$member_no' and
						fd.account_id = '31020050' and f.payment_status =1 and f.slip_no=fd.slip_no 
					order by f.operate_date desc ,f.slip_no desc, fd.seq_no asc ";
	$value = array('SLIPITEM_DESC','ITEMPAYAMT_NET','OPERATE_DATE');		
	list($Num_Rows,$slip_show) = get_value_many_oci($strSQL,$value);	
	$totalpayment = 0;
	$j=0;
	for($i=0;$i<$Num_Rows;$i++){ 
		$slipitem_desc[$i] 			= $slip_show[$i][$j++];   				
		$itempayamt_net[$i] 	= $slip_show[$i][$j++];			
		$operate_date[$i]	= $slip_show[$i][$j++];
		$j=0;
		$totalpayment 		= $totalpayment + str_replace( ',','', $itempayamt_net[$i] );		
	}	
	
?>