<?php
@header('Content-Type: text/html; charset=tis-620');


?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php
//$showslip = '255703';
$showslip = Show_Slip(date('d-m-Y'));

 $strSQL = "SELECT 
					
                                        TO_CHAR(LNM.LASTPAYMENT_DATE,'dd') AS LASTPAYMENT_DATE_DAY,
					 (case when TO_CHAR(LNM.LASTPAYMENT_DATE,'mm') = '01' then 'มกราคม' 
                                                        when TO_CHAR(LNM.LASTPAYMENT_DATE,'mm') = '02' then 'กุมภาพันธ์'
                                                        when TO_CHAR(LNM.LASTPAYMENT_DATE,'mm') = '03' then 'มีนาคม'
                                                        when TO_CHAR(LNM.LASTPAYMENT_DATE,'mm') = '04' then 'เมษายน'
                                                        when TO_CHAR(LNM.LASTPAYMENT_DATE,'mm') = '05' then 'พฤษภาคม'
                                                        when TO_CHAR(LNM.LASTPAYMENT_DATE,'mm') = '06' then 'มิถุนายน'
							when TO_CHAR(LNM.LASTPAYMENT_DATE,'mm') = '07' then 'กรกฎาคม'
							when TO_CHAR(LNM.LASTPAYMENT_DATE,'mm') = '08' then 'สิงหาคม'
							when TO_CHAR(LNM.LASTPAYMENT_DATE,'mm') = '09' then 'กันยายน'
							when TO_CHAR(LNM.LASTPAYMENT_DATE,'mm') = '10' then 'ตุลาคม'
							when TO_CHAR(LNM.LASTPAYMENT_DATE,'mm') = '11' then 'พฤศจิกายน'
							when TO_CHAR(LNM.LASTPAYMENT_DATE,'mm') = '12' then 'ธันวาคม'
							else '' end)
							AS LASTPAYMENT_DATE_MONTH,
					 TO_CHAR(TO_NUMBER(TO_CHAR(LNM.LASTPAYMENT_DATE,'yyyy')) + 543) AS LASTPAYMENT_DATE_YEAR
				FROM 
					LNCONTMASTER LNM , LNLOANTYPE LT
				WHERE 
					LNM.LOANTYPE_CODE = LT.LOANTYPE_CODE 
					AND LNM.MEMBER_NO = '$member_no'
					AND LNM.CONTRACT_STATUS = '1'
					AND LNM.STARTCONT_DATE IS NOT NULL " ;
$value=array('LASTPAYMENT_DATE_DAY','LASTPAYMENT_DATE_MONTH','LASTPAYMENT_DATE_YEAR');
list($Num_Rows2,$list_info2) = get_value_many_oci($strSQL,$value);
		$a=0;
		for($b=0;$b<$Num_Rows2;$b++){
                        $lastpayment_date_day[$b] = $list_info2[$b][$a++];
                        $lastpayment_date_month[$b] = $list_info2[$b][$a++];
                        $lastpayment_date_year[$b] = $list_info2[$b][$a++];
                        $show_date = "ณ วันที่" . " " .$lastpayment_date_day[$b]." ".$lastpayment_date_month[$b]." ".$lastpayment_date_year[$b];
                        
			$a=0;
		}

?>