<?php
@header('Content-Type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
 $strSQL = "select mup.prename_desc || mbi.insure_name || '  ' || mbi.insure_surname as A0,
                mbi.insuretype_code as A1,
                mbi.insurance_money as A2,
			    TO_CHAR(mbi.startinsure_date,'dd MON yyyy', 'NLS_CALENDAR=''THAI BUDDHA'' NLS_DATE_LANGUAGE=THAI') as A3,
                TO_CHAR(mbi.expinsure_date,'dd MON yyyy', 'NLS_CALENDAR=''THAI BUDDHA'' NLS_DATE_LANGUAGE=THAI') as A4,
				mbi.insure_year as A5,
                mbi.insurance_amt as A6
                from mbinsurance mbi , mbmembmaster mb , mbucfprename mup
           where mbi.member_no = mb.member_no and
           mup.prename_code = mb.prename_code
           and mbi.member_no = '$member_no'
           and insure_year = to_char((select max(m.insure_year) as insure_year from mbinsurance m where m.member_no ='$member_no'))";
$value = array('A0','A1','A2','A3','A4','A5','A6');
list($Num_Rows,$list) = get_value_many_oci($strSQL,$value);
$j=0;
for($i=0;$i<$Num_Rows;$i++){
	$fullname[$i] = $list[$i][$j++];
        $insuretype_code_f[$i] = $list[$i][$j++];
        $insurance_money[$i] = $list[$i][$j++];
        $insurance_money[$i] = number_format($insurance_money[$i],2);
		$startinsure_date[$i] = $list[$i][$j++];
		$expinsure_date[$i] = $list[$i][$j++];
		$insure_year[$i] = $list[$i][$j++];
	    $insurance_amt_f[$i] = $list[$i][$j++];
		$insurance_amt_f[$i] = number_format($insurance_amt_f[$i],2);
		
	
	$j=0;
}

$j=0;
         $strSQL1 = "select insurejoin_name as A0,
                            (case when insuretype_code = '2' then '2'
                            when insuretype_code = '1' then '1' else '' end) 
                            as A1,
                            insurance_amt as A2,
                            (case when insurepay_status = '0' then 'ยังไม่ได้ชำระ'
                            when insurepay_status = '1' then 'ชำระเเล้ว' else '' end)
                            as A3,
                            muc.gain_concern as A4
                    from mbinsurejoin mbij , mbucfgainconcern muc
                    where mbinsurance_no =  (select max(m.mbinsurance_no) from mbinsurance m where m.member_no ='$member_no' and m.insure_year = to_char((select max(m.insure_year) from mbinsurance m where m.member_no ='$member_no'))) and
                    muc.concern_code = mbij.insurejoin_code(+) ";
		$value1 = array ('A0','A1','A2','A3','A4');
		list($Num_Rows1,$list1) = get_value_many_oci($strSQL1,$value1);
		$k=0;

		for($n=0; $n <$Num_Rows1; $n++)
		{
			$insurejoin_name[$n] = $list1[$n][$k++];
                        $insuretype_code[$n] = $list1[$n][$k++];
                        $insurance_amt[$n] = $list1[$n][$k++];
                        $insurance_amt[$n] = number_format($insurance_amt[$n],2);
                        $insurepay_status[$n] = $list1[$n][$k++];
                        $gain_concern[$n] = $list1[$n][$k++];
			
			$k=0;
		}
	$k=0;
?>

