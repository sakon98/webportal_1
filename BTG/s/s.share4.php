<?php
@header('Content-Type: text/html; charset=tis-620');
?>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
$strSQL = " select * from ( SELECT 
					TO_CHAR(SHS.OPERATE_DATE,'dd') AS OPERATE_DATE_DAY,
					 (case when TO_CHAR(SHS.OPERATE_DATE,'mm') = '01' then 'มกราคม' 
                                                        when TO_CHAR(SHS.OPERATE_DATE,'mm') = '02' then 'กุมภาพันธ์'
                                                        when TO_CHAR(SHS.OPERATE_DATE,'mm') = '03' then 'มีนาคม'
                                                        when TO_CHAR(SHS.OPERATE_DATE,'mm') = '04' then 'เมษายน'
                                                        when TO_CHAR(SHS.OPERATE_DATE,'mm') = '05' then 'พฤษภาคม'
                                                        when TO_CHAR(SHS.OPERATE_DATE,'mm') = '06' then 'มิถุนายน'
							when TO_CHAR(SHS.OPERATE_DATE,'mm') = '07' then 'กรกฎาคม'
							when TO_CHAR(SHS.OPERATE_DATE,'mm') = '08' then 'สิงหาคม'
							when TO_CHAR(SHS.OPERATE_DATE,'mm') = '09' then 'กันยายน'
							when TO_CHAR(SHS.OPERATE_DATE,'mm') = '10' then 'ตุลาคม'
							when TO_CHAR(SHS.OPERATE_DATE,'mm') = '11' then 'พฤศจิกายน'
							when TO_CHAR(SHS.OPERATE_DATE,'mm') = '12' then 'ธันวาคม'
							else '' end)
							AS OPERATE_DATE_MONTH,
					 TO_CHAR(TO_NUMBER(TO_CHAR(SHS.OPERATE_DATE,'yyyy')) + 543) AS OPERATE_DATE_YEAR
				FROM 
					SHSHARESTATEMENT SHS , SHUCFSHRITEMTYPE SUS 
				WHERE 
					  SHS.SHRITEMTYPE_CODE = SUS.SHRITEMTYPE_CODE(+)
				 	AND SHS.MEMBER_NO = '$member_no' 
					ORDER BY SHS.SEQ_NO desc ) where rownum <=1";
$value=array('OPERATE_DATE_DAY','OPERATE_DATE_MONTH','OPERATE_DATE_YEAR');
list($Num_Rows5,$list_info5) = get_value_many_oci($strSQL,$value);
$a=0;
for($b=0;$b<$Num_Rows;$b++){
	$operate_date_day[$b]= $list_info5[$b][$a++];
	$operate_date_month[$b]  = $list_info5[$b][$a++];
	$operate_date_year[$b]= $list_info5[$b][$a++];
        $show_date = "ณ วันที่" . " " .$operate_date_day[$b]." ".$operate_date_month[$b]." ".$operate_date_year[$b];
	$a=0;
}
?>

